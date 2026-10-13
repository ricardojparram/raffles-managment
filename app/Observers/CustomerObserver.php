<?php

namespace App\Observers;

use App\Models\Customer;

class CustomerObserver
{
    public function created(Customer $customer): void
    {
        $team = $customer->team;

        if ($team && $team->subscribed() && $team->canConsume('customers')) {
            $team->consume('customers');
        }
    }

    public function deleted(Customer $customer): void
    {
        $team = $customer->team;

        if ($team && $team->subscribed()) {
            $team->release('customers');
        }
    }
}
