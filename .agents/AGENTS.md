# Reglas del Proyecto: Raffles Management

Bienvenido agente. Este proyecto utiliza Laravel 13, Filament 5 y Livewire 4 bajo una arquitectura monolítica con multitenancy nativa de Filament (un `Team` por organizador). Estás **obligado** a seguir estas reglas al trabajar en este workspace.

**Antes de empezar, lee `docs/TRASPASO.md`.** Ahí están el estado actual, cómo levantar el entorno, las decisiones ya tomadas y las trampas conocidas. El resto de `docs/` cubre la página pública, los hallazgos técnicos, el negocio y el roadmap.

## 1. Stack y Scaffolding
- Usa **exclusivamente** los comandos de consola `php artisan` para generar la base de archivos (Modelos, Controladores, Migraciones, Recursos de Filament). **Nunca** crees los archivos estructurales de cero a mano.
  - Ej. `php artisan make:filament-resource NombreRecurso`
  - Ej. `php artisan make:model NombreModelo -mcs` (Migración, Controlador, Seeder)

## 2. Multitenancy y Tenencia de Datos
- Este proyecto es Multi-Tenant por columna usando la tenancy de Filament. `spatie/laravel-multitenancy` fue eliminado.
- Antes de crear migraciones o relaciones, determina si la entidad es global o pertenece a un `Team`.
- Si pertenece a un `Team`, añade la columna `team_id` y usa el trait `App\Models\Concerns\BelongsToTeam` en el modelo.
- Las rutas públicas no tienen tenant de Filament. Ahí se consulta siempre a través de la relación del equipo o de la rifa.

## 3. Testing Estricto (TDD)
- **Modo TDD Estricto ESTÁ ACTIVO**.
- Todo nuevo requerimiento o arreglo de bug debe incluir tests de Unidad (Unit) o Integración (Feature) *antes* de finalizarse.
- Corre siempre `php artisan test` para validar. Si tocas las páginas públicas, corre también `tests/Browser/run.sh behaviour`: hay errores que PHPUnit no ve. La configuración de pruebas se hace en memoria mediante SQLite, por lo que tus pruebas nunca deben impactar la base de datos local de desarrollo.
- Asegúrate de limpiar siempre el estado usando el trait `RefreshDatabase` en tus tests.

## 4. Filosofía y Estilo (Laravel/Filament standard)
- Evita código o librerías externas si Laravel o Filament proveen la solución *out of the box*.
- Mantén las clases de Filament declarativas. No sobrecargues un Resource de Filament con lógica de negocio; colócala en Modelos o Actions.
- Sigue los estándares PSR-12 para estilo de código en PHP.
