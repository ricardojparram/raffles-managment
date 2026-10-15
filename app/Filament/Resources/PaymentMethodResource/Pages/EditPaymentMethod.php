<?php

namespace App\Filament\Resources\PaymentMethodResource\Pages;

use App\Enums\PaymentMethodType;
use App\Filament\Resources\PaymentMethodResource;
use Filament\Resources\Pages\EditRecord;

class EditPaymentMethod extends EditRecord
{
    protected static string $resource = PaymentMethodResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $type = $data['type'] ?? $this->record?->type;
        $enum = $type instanceof PaymentMethodType ? $type : PaymentMethodType::tryFrom((string) $type);

        if ($enum === PaymentMethodType::Custom || $enum === null) {
            $data['custom_description'] = $data['description'] ?? [];
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $type = $data['type'] ?? $this->record?->type;
        $enum = $type instanceof PaymentMethodType ? $type : PaymentMethodType::tryFrom((string) $type);

        if ($enum === PaymentMethodType::Custom || ($enum === null && ! empty($data['custom_description']))) {
            $data['description'] = $data['custom_description'] ?? [];
        } elseif (isset($data['description']) && is_array($data['description'])) {
            $data['description'] = array_filter($data['description'], fn ($v) => filled($v));
        }

        unset($data['custom_description']);

        return $data;
    }
}
