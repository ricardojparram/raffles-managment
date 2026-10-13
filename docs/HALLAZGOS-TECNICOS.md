# Hallazgos técnicos

Auditoría del proyecto al 13 de octubre de 2026, incluyendo lo que cambió en la rama `feat/public-raffle-page`.

**Cómo leer las tablas**

- **Evidencia.** "Ejecutado" significa que se reprodujo corriendo código o un test. "Leído" significa que se dedujo leyendo el código y no se reprodujo.
- **Estado.** "Resuelto" quiere decir resuelto en la rama. "Pendiente" quiere decir que sigue igual.

## 1. Correcciones al primer análisis

El primer análisis de la sesión se hizo sin poder ejecutar nada. Estas afirmaciones resultaron falsas o imprecisas y quedan corregidas aquí.

| Lo que se dijo | Lo que es |
|---|---|
| Los comprobantes de pago se guardan en disco público | Falso. Filament 5 usa por defecto el disco `local`, que es privado |
| El admin guarda 25.00 y la tabla lo muestra como $25.00 | Falso. Guardaba 25 y la tabla mostraba $0.25, porque formatea centavos |
| El seeder pasa `status` y `ticket_amount` y Eloquent los descarta | Falso. Los seeders corren sin protección de asignación masiva. Lo cierto era que el formulario no tenía esos campos |
| `PaymentResource` importa una clase de Spatie que no existe | Era cierto. Pint lo eliminó al formatear el archivo |

## 2. Seguridad

| # | Hallazgo | Evidencia | Estado |
|---|---|---|---|
| S1 | **No hay roles ni policies.** El pivote `team_user.role` se escribe al crear el equipo y nunca se lee. No existe `app/Policies` ni ningún `Gate`. Cualquier miembro de un equipo puede editar a otro miembro en `UserResource`, incluida su contraseña y su correo, y puede borrar rifas y pagos | Leído | Pendiente. Es lo más grave |
| S2 | **Registro abierto sin verificación.** El panel tiene `->registration()` y no tiene `->emailVerification()` ni `->passwordReset()`. `User::canAccessPanel()` devuelve `true` siempre | Leído | Pendiente |
| S3 | **El estado de un pago cambia con un clic.** `IconSelectColumn` en la tabla de pagos pasa de pendiente a confirmado sin confirmación, sin autorización y sin dejar registro de quién lo hizo. Lo mismo para el estado de la rifa | Leído | Pendiente |
| S4 | **Datos personales reales en los seeders.** `CustomerSeeder` y `PaymentMethodsSeeder` tienen una cédula y un teléfono reales, y el repositorio es público | Leído | Pendiente. Requiere además limpiar el historial de git |
| S5 | **Cuenta por defecto.** `UserSeeder` crea `admin@admin.com` con `admin123` sin comprobar el entorno | Leído | Pendiente |
| S6 | **Modelos sin aislamiento por equipo.** `Ticket`, `Offer` y `RafflePrize` no tienen `team_id` ni usan `BelongsToTeam`. Hoy solo se accede a ellos a través de su rifa, pero un relation manager o un endpoint nuevo los expondría entre equipos | Leído | Pendiente |
| S7 | **Subidas públicas aceptaban SVG.** `->image()` de Filament acepta `image/svg+xml`. Al pasar portadas, premios e íconos al disco público, un SVG con script quedaba servido desde el mismo dominio que el admin | Ejecutado: un test lo demostró antes del arreglo | Resuelto con `acceptedFileTypes` |
| S8 | **La descripción de la rifa es HTML del organizador.** Se muestra al público | Ejecutado | Resuelto. Se sanea con `Str::sanitizeHtml()` y hay test |
| S9 | **Página del tablero manipulable.** Un valor enorme en `page` hacía generar al servidor un rango gigantesco. El test tardó casi 5 segundos antes del arreglo | Ejecutado | Resuelto con `#[Locked]` |
| S10 | **Subidas temporales de Livewire en disco público.** `config/livewire.php` fija `temporary_file_upload.disk` en `public`. Los comprobantes pasan por ahí antes de guardarse | Leído | Mitigado: el componente borra el temporal apenas lo guarda o lo descarta. Pendiente cambiar la configuración a un disco privado y comprobar que el admin sigue mostrando vistas previas |
| S11 | **Se pueden reservar números sin pagar.** Basta una referencia inventada y cualquier imagen. Es inherente a verificar pagos a mano | Leído | Mitigado con límite por visitante, tope de 100 por compra y referencia única. Pendiente un vencimiento automático de reservas |
| S12 | **Código muerto de Spatie.** `app/Http/Middleware/ApplyTenantScopes.php` importa una clase que ya no está instalada. No está registrado, así que no corre. También sobran `config/multitenancy.php` y `config/permission.php` | Leído | Pendiente borrar |
| S13 | **Copiar enlace en el admin** usa `navigator.clipboard` sin respaldo. No funciona fuera de HTTPS o `localhost` | Ejecutado en navegador | Pendiente. Irrelevante con HTTPS |
| S14 | **Avatares por un tercero.** Filament pide los avatares por defecto a `ui-avatars.com` con la inicial del usuario | Ejecutado en navegador | Informativo |

**Cómo resolver S1.** Crear un enum de rol, por ejemplo dueño, administrador, vendedor y solo lectura. Añadir una policy por modelo que consulte el rol del usuario en el tenant actual. Limitar `UserResource` a dueño y administrador. Cambiar la creación de usuarios por una invitación por correo, porque hoy invitar a alguien que ya tiene cuenta falla por correo duplicado. Añadir tests que prueben que un miembro no puede tocar lo de otro equipo: hoy no hay ninguno.

## 3. Datos e integridad

| # | Hallazgo | Evidencia | Estado |
|---|---|---|---|
| D1 | **Dinero inconsistente.** Columnas en centavos, formularios en unidades | Ejecutado: los tests fallaron con 12 en lugar de 1250 | Resuelto con `MoneyInput` |
| D2 | **`customers.fullname` usa `||`.** Es una columna virtual con sintaxis de SQLite. En MySQL `||` es un OR lógico | Leído, `2025_04_05_231811_customer.php:20` | Pendiente. Bloquea salir de SQLite |
| D3 | **Orden de migraciones.** `customers`, `raffles` y `payment_methods` referencian `teams` en migraciones de abril de 2025, y `teams` se crea en junio. SQLite lo tolera. MySQL y PostgreSQL no | Leído | Pendiente. Bloquea salir de SQLite |
| D4 | **Claves foráneas sin cascada.** `tickets`, `payments`, `offers` y `raffle_prizes` apuntan a `raffles` sin `cascadeOnDelete`. Borrar una rifa con datos debería fallar con error de base de datos | Leído | Pendiente |
| D5 | **Los pagos se borran de verdad.** No hay `SoftDeletes` en ningún modelo. Un pago es un registro contable | Leído | Pendiente |
| D6 | **Fecha de premio obligatoria en base de datos y opcional en el formulario.** `raffle_prizes.date` no admite nulos y el repeater no la exige | Leído | Pendiente |
| D7 | **`payment_methods.description` es `string(255)`** y guarda el JSON del `KeyValue`. Con varias filas se trunca o falla fuera de SQLite | Leído | Pendiente. Debe ser `json` |
| D8 | **Cédula duplicada sin validación.** `customers` tiene índice único por cédula y equipo, y el formulario no valida. El duplicado produce un error de base de datos en lugar de un mensaje | Leído | Pendiente |
| D9 | **`->required('El icono es requerido')`** en `PaymentMethodResource`. `required()` recibe un booleano. El texto no es un mensaje, solo se evalúa como verdadero | Leído | Pendiente |
| D10 | **Ofertas sin validar.** `ticket_amount` no es obligatorio ni tiene mínimo | Leído | Pendiente. El cálculo de precios ignora ofertas con cantidad inválida |
| D11 | **Tres formatos de teléfono.** `CustomerResource` usa el plugin que guarda E.164. El formulario rápido dentro de pagos pone un prefijo `+58` visual y guarda el número local. La página pública guarda E.164 | Leído | Parcial. Lo nuevo es consistente |
| D12 | **Campos de la rifa inaccesibles.** `ticket_amount` y `minimum_tickets` existían en la tabla y no en el formulario | Ejecutado | Resuelto |
| D13 | **Zona horaria UTC** con fechas escritas en hora de Venezuela | Leído | Resuelto |
| D14 | **Un pago creado a mano en el admin no genera tickets.** No hay forma de asignar números desde el panel | Leído | Pendiente. Es la siguiente pieza del flujo de venta |
| D15 | **Rechazar un pago es irreversible** para sus números | Ejecutado, hay test | Limitación aceptada. Documentada |
| D16 | **Columnas `enum` en base de datos** para estados. Complican cada cambio de estado | Leído | Informativo |

## 4. Calidad y mantenimiento

| # | Hallazgo | Estado |
|---|---|---|
| C1 | `CLAUDE.md`, `.agents/AGENTS.md` y `.github/copilot-instructions.md` describen Laravel 12, Filament 4 y Spatie multitenancy. `CLAUDE.md` además pide PHP 8.2, y Laravel 13 exige 8.3 | Parcial. `AGENTS.md` y `CLAUDE.md` ahora apuntan a `docs/`. El bloque generado por Laravel Boost se regenera con `php artisan boost:update` |
| C2 | Relaciones sin tipo de retorno en casi todos los modelos. `Ticket::raffles()` y `Ticket::customers()` son `belongsTo` con nombre en plural | Pendiente |
| C3 | Unos modelos usan la propiedad `$casts` y otros el método `casts()` | Pendiente |
| C4 | `Status` y `PaymentStatus` existen como enums y los modelos no los castean. `Payment` duplica el enum con constantes y `statusOptions()` | Pendiente |
| C5 | Venezuela escrita a mano en varios sitios: el mapa de monedas y banderas está copiado tres veces, más `defaultCountry('ve')` y el prefijo `+58` | Pendiente |
| C6 | `akaunting/laravel-money` se usa directamente y no está en `composer.json` | Pendiente. Declararla |
| C7 | CSS con `!important` inyectado por `renderHook` en `AdminPanelProvider` y en `public/css/custom.css` | Pendiente. Filament 5 ofrece `->viteTheme()` |
| C8 | `FilamentInfoWidget` visible en el escritorio. El escritorio no muestra nada del negocio | Pendiente |
| C9 | Ninguna tabla tiene filtros ni orden por defecto. No hay relation managers | Pendiente |
| C10 | Los recursos de Filament tienen formulario y tabla en la misma clase. La convención actual separa `Schemas/` y `Tables/` | Pendiente |
| C11 | `CustomerFactory` fija `team_id` en 1 | Pendiente. Los tests nuevos pasan el equipo a mano |
| C12 | Cuatro textos del admin sin traducir: `Payment Context`, `Payment Details`, `Proof of Payment`, `Currency` | Pendiente |
| C13 | La tabla de rifas del admin desborda a lo ancho por debajo de 1440 px | Pendiente. Ya ocurría antes de añadir el menú Compartir |
| C14 | `config/livewire.php` es el archivo publicado de Livewire 3. Faltan las claves nuevas de la versión 4 | Pendiente. Funciona porque Livewire tiene valores por defecto |
| C15 | `User::currentTeam()` lee `session('current_team_id')`, que nada escribe | Pendiente. Parece resto de la etapa Spatie |
| C16 | `composer.json` conserva el nombre `laravel/laravel` y `APP_NAME` es "Laravel" | Pendiente |
| C17 | No hay integración continua | Pendiente. Un flujo de GitHub Actions con `php artisan test` y Pint basta para empezar |
| C18 | `phpunit.xml` dejaba una base de datos llamada `testing` en la raíz del repo | Resuelto |
| C19 | La ruta `/` muestra la página de bienvenida de Laravel | Pendiente |

## 5. Cobertura de pruebas

| Momento | PHPUnit | Navegador |
|---|---|---|
| Antes de la rama | 6 tests, 4 de ellos de `UserResource` | Nada |
| Ahora | 164 tests, 482 aserciones | 23 chequeos de comportamiento y 6 de admin |

**Lo que sigue sin ninguna prueba**

- Que un usuario de un equipo no pueda ver ni tocar datos de otro equipo en el admin. Es la prueba más importante que falta.
- `CustomerResource` y `PaymentMethodResource`.
- El registro de usuario y de equipo.
- La creación de rifas desde el formulario. Los tests actuales editan rifas existentes.
- Las migraciones en un motor que no sea SQLite.

## 6. Tecnología: qué mantener y qué cambiar

| Pieza | Recomendación |
|---|---|
| Laravel 13, Filament 5, Livewire 4 | Mantener. Son las versiones actuales |
| Tenancy nativa de Filament más `BelongsToTeam` | Mantener. Es simple y suficiente. Extender el trait a los modelos de S6 |
| SQLite | Cambiar a MySQL o PostgreSQL antes de producción, tras resolver D2 y D3 |
| Sail | Opcional. La imagen mínima de [TRASPASO.md](TRASPASO.md#3-cómo-levantar-el-entorno) es más rápida de construir |
| `ve.dolarapi.com` | Aceptable para empezar. Añadir una tasa manual por equipo como respaldo y como opción |
| Notificaciones | No hay nada. Empezar con enlaces `wa.me` prearmados y pasar a la API de WhatsApp Business cuando haya volumen |
| Colas | `QUEUE_CONNECTION=database` ya está en `.env.example`. Hará falta un worker cuando existan notificaciones |
| Almacenamiento | Local por ahora. Los discos ya están separados, así que pasar los comprobantes a S3 privado es un cambio de configuración |
