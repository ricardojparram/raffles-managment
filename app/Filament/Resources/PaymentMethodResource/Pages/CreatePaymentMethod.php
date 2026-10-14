<?php

namespace App\Filament\Resources\PaymentMethodResource\Pages;

use App\Enums\PaymentMethodType;
use App\Filament\Resources\PaymentMethodResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePaymentMethod extends CreateRecord
{
    protected static string $resource = PaymentMethodResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $type = $data['type'] ?? null;
        $enum = $type instanceof PaymentMethodType ? $type : PaymentMethodType::tryFrom((string) $type);

        if ($enum === PaymentMethodType::Custom || ($enum === null && ! empty($data['custom_description']))) {
            $data['description'] = $data['custom_description'] ?? [];
        } elseif (isset($data['description']) && is_array($data['description'])) {
            $data['description'] = array_filter($data['description'], fn ($v) => filled($v));
        } else {
            $data['description'] = [];
        }

        unset($data['custom_description']);

        return $data;
    }
}
