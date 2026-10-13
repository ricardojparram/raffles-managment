<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Validation\ValidationException;

class UserObserver
{
    public function deleting(User $user)
    {
        if ($user->hasRole('super_admin')) {
            throw ValidationException::withMessages([
                'email' => 'No puedes eliminar a un usuario con el rol de super_admin.'
            ]);
        }
    }
}
