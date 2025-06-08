<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Spatie\Multitenancy\Models\Tenant;

class ApplyTenantScopes
{
    public function handle($request, Closure $next)
    {

        // 1. Obtener el tenant de la URL si existe

        if ($tenant = $request->route('tenant')) {
            $tenant = Tenant::where('slug', $tenant)->first();
        }

        // 2. Si no hay tenant en URL, usar el del usuario
        if (!$tenant && Auth::check()) {
            $tenant = Auth::user()->currentTeam();
        }

        // 3. Si encontramos tenant, inicializarlo
        if ($tenant) {
            $tenant->makeCurrent();
            return $next($request);
        }

        // 4. Redirigir si no hay tenant (ajusta según tu flujo)
        // if (Auth::check()) {
        //     return redirect()->route('filament.admin.pages.team-selection');
        // }

        return $next($request);
    }
}
