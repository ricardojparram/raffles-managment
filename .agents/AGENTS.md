# Reglas del Proyecto: Raffles Management

Bienvenido agente. Este proyecto utiliza Laravel 12 y Filament v4 bajo una arquitectura monolítica con multitenancy (`spatie/laravel-multitenancy`). Estás **obligado** a seguir estas reglas al trabajar en este workspace:

## 1. Stack y Scaffolding
- Usa **exclusivamente** los comandos de consola `php artisan` para generar la base de archivos (Modelos, Controladores, Migraciones, Recursos de Filament). **Nunca** crees los archivos estructurales de cero a mano.
  - Ej. `php artisan make:filament-resource NombreRecurso`
  - Ej. `php artisan make:model NombreModelo -mcs` (Migración, Controlador, Seeder)

## 2. Multitenancy y Tenencia de Datos
- Este proyecto es Multi-Tenant usando Spatie.
- Antes de crear migraciones o relaciones, determina si la entidad pertenece al **Landlord** (Global) o al **Tenant** (Generalmente un `Team`). 
- Si pertenece al Tenant, asegúrate de aplicar el Trait correcto de Spatie para la conexión de Tenant en el modelo o estructurar las llaves foráneas necesarias si se usa multi-tenancy por columna (ej. `team_id`).

## 3. Testing Estricto (TDD)
- **Modo TDD Estricto ESTÁ ACTIVO**.
- Todo nuevo requerimiento o arreglo de bug debe incluir tests de Unidad (Unit) o Integración (Feature) *antes* de finalizarse.
- Corre siempre `php artisan test` para validar. La configuración de pruebas se hace en memoria mediante SQLite, por lo que tus pruebas nunca deben impactar la base de datos local de desarrollo.
- Asegúrate de limpiar siempre el estado usando el trait `RefreshDatabase` en tus tests.

## 4. Filosofía y Estilo (Laravel/Filament standard)
- Evita código o librerías externas si Laravel o Filament proveen la solución *out of the box*.
- Mantén las clases de Filament declarativas. No sobrecargues un Resource de Filament con lógica de negocio; colócala en Modelos o Actions.
- Sigue los estándares PSR-12 para estilo de código en PHP.
