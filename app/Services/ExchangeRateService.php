<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

/**
 * Official (BCV) bolivar rate for one US dollar, cached so public pages never wait on the provider.
 */
class ExchangeRateService
{
    private const CACHE_KEY = 'exchange-rate:usd-ved';

    private const LAST_KNOWN_CACHE_KEY = 'exchange-rate:usd-ved:last-known';

    private const FRESH_FOR_MINUTES = 30;

    private const RETRY_AFTER_MINUTES = 5;

    private const LAST_KNOWN_VALID_FOR_DAYS = 4;

    public function usdToVed(): ?float
    {
        $cached = Cache::get(self::CACHE_KEY);

        if (is_array($cached)) {
            return $cached['rate'];
        }

        $rate = $this->fetchRate();

        if ($rate !== null) {
            Cache::put(self::CACHE_KEY, ['rate' => $rate], now()->addMinutes(self::FRESH_FOR_MINUTES));
            Cache::forever(self::LAST_KNOWN_CACHE_KEY, ['rate' => $rate, 'fetched_at' => now()->getTimestamp()]);

            return $rate;
        }

        $rate = $this->lastKnownRate();

        Cache::put(self::CACHE_KEY, ['rate' => $rate], now()->addMinutes(self::RETRY_AFTER_MINUTES));

        return $rate;
    }

    private function fetchRate(): ?float
    {
        $url = config('services.exchange_rate.url');

        if (blank($url)) {
            return null;
        }

        try {
            $response = Http::acceptJson()->connectTimeout(2)->timeout(3)->get($url);
        } catch (ConnectionException) {
            return null;
        }

        $rate = $response->successful() ? $response->json('promedio') : null;

        return is_numeric($rate) && $rate > 0 ? (float) $rate : null;
    }

    private function lastKnownRate(): ?float
    {
        $lastKnown = Cache::get(self::LAST_KNOWN_CACHE_KEY);

        if (! is_array($lastKnown)) {
            return null;
        }

        $expiresAt = $lastKnown['fetched_at'] + self::LAST_KNOWN_VALID_FOR_DAYS * 86400;

        return now()->getTimestamp() <= $expiresAt ? $lastKnown['rate'] : null;
    }
}
