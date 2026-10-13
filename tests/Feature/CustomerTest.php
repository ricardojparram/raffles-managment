<?php

namespace Tests\Feature;

use App\Models\Customer;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    #[DataProvider('reachablePhones')]
    public function test_it_normalizes_reachable_phones_to_e164(string $typed, string $expected): void
    {
        $this->assertSame($expected, Customer::normalizePhone($typed));
    }

    #[DataProvider('unreachablePhones')]
    public function test_it_rejects_phones_it_cannot_reach(string $typed): void
    {
        $this->assertNull(Customer::normalizePhone($typed));
    }

    /**
     * @return array<string, array{string, string}>
     */
    public static function reachablePhones(): array
    {
        return [
            'national with leading zero' => ['04121234567', '+584121234567'],
            'national without leading zero' => ['4121234567', '+584121234567'],
            'national with separators' => ['0412-123.45 67', '+584121234567'],
            'country code without plus' => ['584241234567', '+584241234567'],
            'country code with plus' => ['+58 414 1234567', '+584141234567'],
            'country code followed by the trunk zero' => ['+58 0416 1234567', '+584161234567'],
            'international call prefix' => ['00584261234567', '+584261234567'],
            'newer digitel prefix' => ['0422 1234567', '+584221234567'],
            'united states' => ['+1 (305) 555-0199', '+13055550199'],
            'colombia with call prefix' => ['0057 300 1234567', '+573001234567'],
        ];
    }

    /**
     * @return array<string, array{string}>
     */
    public static function unreachablePhones(): array
    {
        return [
            'empty' => [''],
            'letters' => ['no tengo'],
            'too short' => ['0412 123'],
            'too long' => ['0412 12345678'],
            'venezuelan landline' => ['0212 5551234'],
            'unknown mobile prefix' => ['0499 1234567'],
            'venezuelan landline with country code' => ['+58 212 5551234'],
            'international too short' => ['+1 555'],
            'international starting with zero' => ['+0 1234567890'],
        ];
    }
}
