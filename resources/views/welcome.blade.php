<x-layouts.public
    :title="config('app.name') . ' · Gestión de Rifas y Sorteos Digitales'"
    :description="'Crea, administra y vende tus rifas de forma transparente, segura y adaptada a la normativa.'"
    :url="url('/')"
>
    <div class="mx-auto w-full max-w-4xl px-4 pt-6 pb-16 sm:pt-10">
        <!-- Navigation Header -->
        <header class="flex items-center justify-between gap-4 pb-8 border-b border-line">
            <div class="flex items-center gap-3">
                <span class="bg-brand text-on-brand flex size-11 items-center justify-center rounded-xl text-lg font-extrabold shadow-sm">
                    <x-heroicon-o-ticket class="size-6" />
                </span>
                <div>
                    <span class="text-xl font-extrabold tracking-tight">{{ config('app.name') }}</span>
                    <span class="block text-xs font-medium text-ink-faint">Plataforma de Rifas Digitales</span>
                </div>
            </div>

            <nav class="flex items-center gap-3">
                @auth
                    <a href="{{ route('filament.admin.tenant') }}" class="btn btn-primary btn-sm">
                        {{ __('Ir al Panel') }}
                        <x-heroicon-m-arrow-right class="size-4" />
                    </a>
                @else
                    <a href="{{ route('filament.admin.auth.login') }}" class="btn btn-secondary btn-sm">
                        {{ __('Iniciar Sesión') }}
                    </a>
                    @if (Route::has('filament.admin.auth.register'))
                        <a href="{{ route('filament.admin.auth.register') }}" class="btn btn-primary btn-sm hidden sm:inline-flex">
                            {{ __('Crear Organización') }}
                        </a>
                    @endif
                @endauth
            </nav>
        </header>

        <!-- Hero Section -->
        <section class="py-12 sm:py-16 text-center max-w-2xl mx-auto">
            <div class="inline-flex items-center gap-2 rounded-full bg-brand-soft px-3.5 py-1.5 text-xs font-bold text-brand-ink mb-6">
                <x-heroicon-m-shield-check class="size-4 shrink-0" />
                <span>Gestión transparente y trazabilidad total</span>
            </div>

            <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-balance leading-[1.15]">
                Organiza y vende tus rifas con seguridad y control
            </h1>

            <p class="mt-5 text-base sm:text-lg text-ink-soft text-pretty leading-relaxed">
                Tablero interactivo de números en tiempo real, cobro multimoneda en bolívares y divisas, verificación de comprobantes auditada y consulta inmediata para tus compradores.
            </p>

            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3">
                @if (Route::has('filament.admin.auth.register'))
                    <a href="{{ route('filament.admin.auth.register') }}" class="btn btn-primary w-full sm:w-auto">
                        <span>{{ __('Comenzar ahora') }}</span>
                        <x-heroicon-m-arrow-right class="size-4" />
                    </a>
                @endif
                <a href="{{ route('filament.admin.auth.login') }}" class="btn btn-secondary w-full sm:w-auto">
                    <span>{{ __('Acceder a tu organización') }}</span>
                </a>
            </div>
        </section>

        <!-- Feature Pillars -->
        <section class="mt-6 pt-10 border-t border-line">
            <h2 class="text-center section-title text-xl mb-2">Todo lo que tu organización necesita</h2>
            <p class="text-center text-ink-faint text-sm mb-10">Diseñado especialmente para la dinámica y requerimientos de sorteos en Venezuela.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                <div class="card p-5">
                    <span class="bg-brand-soft text-brand-ink flex size-10 items-center justify-center rounded-xl mb-3">
                        <x-heroicon-o-squares-2x2 class="size-5" />
                    </span>
                    <h3 class="font-bold text-base mb-1.5">Tablero en Tiempo Real</h3>
                    <p class="text-ink-soft text-sm leading-relaxed">
                        Selección ágil de boletos por grilla o asignación al azar. Los números reservados se bloquean al instante para evitar compras duplicadas.
                    </p>
                </div>

                <div class="card p-5">
                    <span class="bg-brand-soft text-brand-ink flex size-10 items-center justify-center rounded-xl mb-3">
                        <x-heroicon-o-banknotes class="size-5" />
                    </span>
                    <h3 class="font-bold text-base mb-1.5">Multimoneda y Tasa BCV</h3>
                    <p class="text-ink-soft text-sm leading-relaxed">
                        Fija tus precios en USD y permite pagos en Bolívares (Pago Móvil / Transferencia) calculados con la tasa oficial BCV del día hábil.
                    </p>
                </div>

                <div class="card p-5">
                    <span class="bg-brand-soft text-brand-ink flex size-10 items-center justify-center rounded-xl mb-3">
                        <x-heroicon-o-check-badge class="size-5" />
                    </span>
                    <h3 class="font-bold text-base mb-1.5">Auditoría de Pagos</h3>
                    <p class="text-ink-soft text-sm leading-relaxed">
                        Revisión de capturas bancarias con confirmación o rechazo seguro. Cada aprobación registra el usuario y la fecha exacta de revisión.
                    </p>
                </div>

                <div class="card p-5">
                    <span class="bg-brand-soft text-brand-ink flex size-10 items-center justify-center rounded-xl mb-3">
                        <x-heroicon-o-chat-bubble-left-ellipsis class="size-5" />
                    </span>
                    <h3 class="font-bold text-base mb-1.5">Avisos por WhatsApp</h3>
                    <p class="text-ink-soft text-sm leading-relaxed">
                        Envía con un clic el comprobante oficial con los números asignados y el enlace de verificación directamente al WhatsApp del comprador.
                    </p>
                </div>

                <div class="card p-5">
                    <span class="bg-brand-soft text-brand-ink flex size-10 items-center justify-center rounded-xl mb-3">
                        <x-heroicon-o-identification class="size-5" />
                    </span>
                    <h3 class="font-bold text-base mb-1.5">Consulta por Cédula</h3>
                    <p class="text-ink-soft text-sm leading-relaxed">
                        Página pública donde cada comprador puede verificar sus boletos y estado de pago en segundos, ingresando su documento de identidad.
                    </p>
                </div>

                <div class="card p-5">
                    <span class="bg-brand-soft text-brand-ink flex size-10 items-center justify-center rounded-xl mb-3">
                        <x-heroicon-o-scale class="size-5" />
                    </span>
                    <h3 class="font-bold text-base mb-1.5">Marco Normativo y RUNLOT</h3>
                    <p class="text-ink-soft text-sm leading-relaxed">
                        Visibilidad de registro RUNLOT / permiso CONALOT, verificación de mayoría de edad (+18) y control estricto de accesos por roles.
                    </p>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="mt-16 pt-8 border-t border-line text-center text-xs text-ink-faint space-y-2">
            <p class="font-semibold text-ink-soft">
                {{ config('app.name') }} &copy; {{ date('Y') }} · Plataforma Tecnológica de Gestión de Sorteos
            </p>
            <p>
                Las rifas y sorteos son organizados y operados de manera independiente por cada entidad registrada bajo su respectiva autorización.
            </p>
            <p class="text-[11px]">
                Prohibida la venta a menores de 18 años. Juega con responsabilidad.
            </p>
        </footer>
    </div>
</x-layouts.public>
