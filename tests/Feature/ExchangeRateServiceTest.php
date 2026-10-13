<?php

namespace Tests\Feature;

use App\Services\ExchangeRateService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ExchangeRateServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config(['services.exchange_rate.url' => 'https://rates.test/oficial']);
    }

    public function test_it_reads_the_official_rate_from_the_provider(): void
    {
        Http::fake(['rates.test/*' => Http::response(['fuente' => 'oficial', 'promedio' => 876.7976])]);

        $this->assertSame(876.7976, app(ExchangeRateService::class)->usdToVed());
    }

    public function test_it_caches_the_rate_between_calls(): void
    {
        Http::fake(['rates.test/*' => Http::response(['promedio' => 876.5])]);

        app(ExchangeRateService::class)->usdToVed();
        app(ExchangeRateService::class)->usdToVed();

        Http::assertSentCount(1);
    }

    public function test_it_refreshes_the_rate_after_the_cache_expires(): void
    {
        Http::fake(['rates.test/*' => Http::sequence()
            ->push(['promedio' => 876.5])
            ->push(['promedio' => 880.0])]);

        app(ExchangeRateService::class)->usdToVed();
        $this->travel(31)->minutes();

        $this->assertSame(880.0, app(ExchangeRateService::class)->usdToVed());
    }

    public function test_it_falls_back_to_the_last_known_rate_when_the_provider_fails(): void
    {
        Http::fake(['rates.test/*' => Http::sequence()
            ->push(['promedio' => 876.5])
            ->push('down', 500)]);

        app(ExchangeRateService::class)->usdToVed();
        $this->travel(2)->hours();

        $this->assertSame(876.5, app(ExchangeRateService::class)->usdToVed());
    }

    public function test_it_gives_up_on_a_last_known_rate_that_is_too_old(): void
    {
        Http::fake(['rates.test/*' => Http::sequence()
            ->push(['promedio' => 876.5])
            ->push('down', 500)]);

        app(ExchangeRateService::class)->usdToVed();
        $this->travel(5)->days();

        $this->assertNull(app(ExchangeRateService::class)->usdToVed());
    }

    public function test_it_returns_null_when_the_provider_is_unreachable(): void
    {
        Http::fake(fn () => throw new ConnectionException('timeout'));

        $this->assertNull(app(ExchangeRateService::class)->usdToVed());
    }

    public function test_it_does_not_hammer_a_failing_provider(): void
    {
        Http::fake(['rates.test/*' => Http::response('down', 500)]);

        app(ExchangeRateService::class)->usdToVed();
        app(ExchangeRateService::class)->usdToVed();

        Http::assertSentCount(1);
    }

    public function test_it_rejects_a_malformed_rate(): void
    {
        Http::fake(['rates.test/*' => Http::response(['promedio' => 0])]);

        $this->assertNull(app(ExchangeRateService::class)->usdToVed());
    }

    public function test_it_does_not_call_out_when_no_provider_is_configured(): void
    {
        config(['services.exchange_rate.url' => null]);
        Http::fake();

        $this->assertNull(app(ExchangeRateService::class)->usdToVed());
        Http::assertNothingSent();
    }
}
