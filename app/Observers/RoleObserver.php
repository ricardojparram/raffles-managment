<?php

namespace App\Observers;

use App\Models\Role;
use Illuminate\Validation\ValidationException;

class RoleObserver
{
    public function deleting(Role $role)
    {
        if ($role->name === 'super_admin') {
            throw ValidationException::withMessages([
                'name' => 'El rol super_admin es fundamental para el sistema y no puede ser eliminado.'
            ]);
        }
    }

    public function updating(Role $role)
    {
        if ($role->getOriginal('name') === 'super_admin' && $role->name !== 'super_admin') {
            throw ValidationException::withMessages([
                'name' => 'No puedes cambiar el nombre del rol super_admin.'
            ]);
        }
    }
}
