<?php

namespace App\Filament\Superadmin\Resources\SubscriptionPayments\Pages;

use App\Filament\Superadmin\Resources\SubscriptionPayments\SubscriptionPaymentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSubscriptionPayment extends EditRecord
{
    protected static string $resource = SubscriptionPaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
