<?php

namespace App\Filament\Superadmin\Resources\SubscriptionPayments\Pages;

use App\Filament\Superadmin\Resources\SubscriptionPayments\SubscriptionPaymentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSubscriptionPayment extends CreateRecord
{
    protected static string $resource = SubscriptionPaymentResource::class;
}
