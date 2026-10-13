# Traspaso

## 1. Estado en una pantalla

El proyecto es un SaaS multi-tenant para organizadores de rifas, pensado por ahora solo para Venezuela. Cada organizador es un `Team` con su panel de Filament.

Hasta el 13 de octubre de 2026 solo existía el panel de administración. En esa fecha se construyó, en la rama `feat/public-raffle-page`, lo que faltaba para vender: la página pública de cada organizador y de cada rifa, la compra de números con reporte de pago, y la consulta de tickets.

| Punto | Estado |
|---|---|
| Rama de trabajo | `feat/public-raffle-page`, 10 commits sobre `main` |
| Subida a GitHub | **Pendiente.** Ver la sección 7 |
| Tests PHPUnit | 164 pasando, 482 aserciones |
| Chequeos de navegador | 23 de comportamiento y 6 de admin, todos pasando |
| Formato | `vendor/bin/pint --dirty` limpio |
| Página pública | Hecha y probada en Chrome móvil a 320 y 390 px, en claro y oscuro |
| Notificaciones, roles, sorteo, cobro de planes | No existen. Ver [ROADMAP.md](ROADMAP.md) |

### Lo que se hizo en esta sesión

1. Análisis completo del proyecto, técnico y de negocio. Está en [HALLAZGOS-TECNICOS.md](HALLAZGOS-TECNICOS.md) y [NEGOCIO.md](NEGOCIO.md).
2. Se confirmó que la página pública que el dueño recordaba nunca estuvo en git. Se rehízo desde cero.
3. Se corrigió un error de dinero en el admin que hacía inservible cualquier precio.
4. Se construyó el dominio de venta, las páginas públicas y los cambios mínimos del admin para usarlas.
5. Se rediseñó la interfaz dos veces por pedido del dueño. El estilo vigente está descrito en [PAGINA-PUBLICA.md](PAGINA-PUBLICA.md#5-sistema-de-diseño).
6. Se dejaron en el repo las herramientas de prueba en navegador y un seeder de demostración.

### Commits de la rama, del más antiguo al más nuevo

| Commit | Contenido |
|---|---|
| `test: run suite on in-memory sqlite and add model factories` | `phpunit.xml` a SQLite en memoria y factories de todos los modelos |
| `fix(money): persist admin amounts in cents` | `MoneyInput`. El admin guardaba 12.50 como 12 y lo listaba como $0.12 |
| `feat(raffle): add ticket reservation domain for public sales` | Slug, numeración, precios con ofertas, estados de venta, `ReserveTickets`, tasa BCV, zona horaria |
| `feat(public): add shareable raffle pages with ticket purchase` | Rutas, controladores, componentes Livewire y vistas |
| `feat(admin): let organizers configure and share public raffles` | Campos de tickets, enlaces para compartir, imágenes al disco público |
| `feat(public): polish checkout feedback, board navigation and uploads` | Validación al salir del campo, selector de rango, subidas solo raster |
| `fix(public): keep checkout memory out of the session payload` | La memoria del checkout pasa de la sesión a la caché |
| `test: add browser checks and a demo seeder` | `tests/Browser` y `DemoSeeder` |
| `feat(public): restyle public pages as a quiet, bank-like interface` | Estilo vigente y arreglo de la carrera de campos |
| `docs: ...` | Esta documentación |

## 2. Stack real

Verificado en `composer.lock` y `package.json`. No confiar en los archivos de instrucciones para agentes, que dicen Laravel 12, Filament 4 y Spatie multitenancy.

| Pieza | Versión real | Nota |
|---|---|---|
| PHP | 8.3 o superior | La imagen de desarrollo usa 8.4 |
| Laravel | 13.19 | Estructura nueva: sin `Kernel`, middleware en `bootstrap/app.php` |
| Filament | 5.6 | El disco por defecto es `local`, privado |
| Livewire | 4.3 | Cambió `wire:model`. Ver la sección 6 |
| Tailwind CSS | 4 | Vía `@tailwindcss/vite`, configurado en CSS con `@theme` |
| Vite | 6 | Entradas `app.css`, `app.js`, `public.css`, `public.js` |
| Tenancy | Nativa de Filament | `->tenant(Team::class, 'slug')` más el trait `BelongsToTeam`. Spatie multitenancy fue eliminado |
| Dinero | `akaunting/laravel-money` | Llega como dependencia transitiva de `ariaieboy/filament-currency` |
| Base de datos | SQLite | Las migraciones existentes solo funcionan en SQLite. Ver hallazgos |

## 3. Cómo levantar el entorno

La máquina del dueño es Fedora con SELinux activo y **no tiene PHP instalado**. Todo corre en Docker. El `compose.yaml` de Sail existe pero no se usó, porque construirlo es lento. Se usó una imagen mínima.

### Imagen de PHP

Si `docker image inspect raffles-dev:8.4` falla, se construye así:

```bash
docker build -t raffles-dev:8.4 - <<'DOCKERFILE'
FROM php:8.4-cli
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions intl gd zip bcmath pcntl exif \
    && apt-get update && apt-get install -y --no-install-recommends git unzip \
    && rm -rf /var/lib/apt/lists/*
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN printf 'memory_limit=1G\nupload_max_filesize=20M\npost_max_size=25M\n' > /usr/local/etc/php/conf.d/dev.ini
ENV COMPOSER_HOME=/tmp/composer
WORKDIR /app
DOCKERFILE
```

### Atajo para ejecutar comandos

```bash
dr() { docker run --rm --security-opt label=disable -e HOME=/tmp -u "$(id -u):$(id -g)" -v "$PWD":/app -w /app raffles-dev:8.4 "$@"; }
```

Las dos banderas raras son necesarias. Sin `--security-opt label=disable` SELinux impide leer el volumen. Sin `-e HOME=/tmp` falla `tinker`.

### Comandos de todos los días

```bash
dr composer install
dr php artisan test
dr php artisan test --filter=TicketPurchaseTest
dr vendor/bin/pint --dirty
dr php artisan migrate:fresh --seed
dr php artisan db:seed --class=DemoSeeder
npm install --no-package-lock && npm run build
```

`npm` sí corre en el host, que tiene Node 24. El repo no versiona `package-lock.json`, por eso se instala sin crearlo.

### Servir la aplicación

```bash
docker run -d --name raffles-app -p 127.0.0.1:8000:8000 --security-opt label=disable \
  -e HOME=/tmp -e APP_URL=http://localhost:8000 -e PHP_CLI_SERVER_WORKERS=4 \
  -u "$(id -u):$(id -g)" -v "$PWD":/app -w /app raffles-dev:8.4 \
  php artisan serve --host=0.0.0.0 --port=8000 --no-reload
```

`--no-reload` es obligatorio para que el contenedor respete las variables `-e`. Sin esa bandera `artisan serve` solo deja pasar una lista corta de variables y toma el resto del `.env`.

Direcciones una vez arriba:

| Qué | Dónde |
|---|---|
| Admin | `http://localhost:8000/admin/login` con `admin@admin.com` / `admin123` |
| Página del organizador de demostración | `http://localhost:8000/r/rifas-el-chamo` |
| Rifa de demostración | `http://localhost:8000/r/rifas-el-chamo/toyota-fortuner-2012-combo-playero` |

El `DemoSeeder` crea el organizador "Rifas El Chamo" con rifas en todos los estados públicos. No forma parte de `DatabaseSeeder`.

### Pruebas en navegador

```bash
tests/Browser/run.sh behaviour     # 23 chequeos en teléfono y escritorio
tests/Browser/run.sh screens       # capturas de cada estado; SCHEME=dark para oscuro
tests/Browser/run.sh admin         # 6 chequeos del panel
```

El script construye su propia imagen con Chromium, usa una base de datos aparte en `database/qa.sqlite` y un servidor propio en el puerto 8001. No toca `database/database.sqlite`. Las capturas quedan en `storage/app/private/browser-checks`. Detalles en [PAGINA-PUBLICA.md](PAGINA-PUBLICA.md#7-pruebas).

## 4. Mapa del código

Solo lo que importa para continuar. Lo marcado como nuevo se creó en esta rama.

| Archivo | Qué hace |
|---|---|
| `routes/web.php` | Rutas públicas `raffles.index` y `raffles.show` con bindings anidados por slug |
| `app/Http/Controllers/PublicTeamController.php` | Nuevo. Página del organizador |
| `app/Http/Controllers/PublicRaffleController.php` | Nuevo. Página de la rifa. Devuelve 404 si la rifa está en borrador |
| `app/Livewire/TicketPurchase.php` | Nuevo. Tablero, checkout y confirmación. Es la pieza central |
| `app/Livewire/TicketChecker.php` | Nuevo. Consulta de tickets por cédula |
| `app/Actions/ReserveTickets.php` | Nuevo. Única puerta para crear un pago reportado con sus tickets |
| `app/Exceptions/ReservationFailed.php` | Nuevo. Motivos por los que una compra no se puede registrar |
| `app/Services/ExchangeRateService.php` | Nuevo. Tasa BCV con caché y respaldo |
| `app/Services/TenantService.php` | Existente. Resuelve el tenant actual para `BelongsToTeam` |
| `app/Enums/SalesStatus.php` | Nuevo. Estado de venta de cara al público |
| `app/Enums/Status.php` | Existente. Estado de la rifa en base de datos |
| `app/Models/Raffle.php` | Slug, numeración, precios, disponibilidad y estado de venta |
| `app/Models/Payment.php` | Relación `tickets` y liberación de números al rechazar |
| `app/Models/PaymentMethod.php` | `quoteFor`: cuánto cobrar por un método en otra moneda |
| `app/Models/Customer.php` | `normalizePhone`: teléfono a formato E.164 |
| `app/Filament/Schemas/Components/MoneyInput.php` | Nuevo. Campo que edita en unidades y guarda centavos |
| `app/Filament/Resources/RaffleResource.php` | Campos de tickets, menú Compartir, imágenes públicas |
| `resources/views/raffles/` | Nuevo. Vistas de las dos páginas |
| `resources/views/livewire/` | Nuevo. Vistas de los dos componentes y parciales del checkout |
| `resources/views/components/public/` | Nuevo. Piezas compartidas: organizador, estado, progreso, paso, pie |
| `resources/views/components/layouts/public.blade.php` | Nuevo. Layout con metadatos para compartir y precarga de fuente |
| `resources/css/public.css` | Nuevo. Tokens y componentes de estilo. Único lugar donde vive el diseño |
| `resources/js/public.js` | Nuevo. Comportamiento Alpine: selección, hojas, subida, copiar, cuenta regresiva |
| `resources/fonts/` | Nuevo. Manrope auto-hospedada con su licencia |
| `database/seeders/DemoSeeder.php` | Nuevo. Datos de demostración |
| `tests/Browser/` | Nuevo. Chequeos con Playwright |
| `lang/es.json` | Todas las cadenas públicas en español de Venezuela |

## 5. Contratos y decisiones

Cada decisión tiene su porqué para que nadie la revierta por accidente.

**El dinero se guarda en centavos enteros.** Las migraciones de julio de 2026 convirtieron las columnas a entero y la columna `->currency()` de las tablas formatea unidades menores. Los formularios seguían escribiendo unidades mayores. `MoneyInput` resuelve la diferencia. Cualquier campo de dinero nuevo en Filament debe usar `MoneyInput`, y cualquier vista debe formatear con `money($centavos, $moneda)->format()`.

**Los números de una rifa van de 0 a `ticket_amount - 1`, rellenados con ceros.** Una rifa de 100 usa `00` a `99`, una de 1000 usa `000` a `999`. El largo sale de `Raffle::numberLength()`. Por eso el admin bloquea `ticket_amount` cuando ya hay un número tomado: cambiarlo cambiaría el relleno de los números vendidos.

**Un pago reportado reserva los números.** `ReserveTickets` crea el `Payment` en estado `pending` y un `Ticket` por número con `payment_id`. El índice único `(raffle_id, number)` impide vender dos veces el mismo número aun con peticiones simultáneas.

**Rechazar o borrar un pago libera sus números para siempre.** Está en `Payment::booted()` y en la clave foránea con borrado en cascada. Si un pago rechazado se vuelve a confirmar, sus números ya no existen. Es una limitación conocida.

**La página pública nunca modifica un cliente existente.** Si la cédula ya existe en el equipo se reutiliza ese `Customer` sin tocar su nombre ni teléfono. Un visitante anónimo no debe poder reescribir datos ajenos escribiendo una cédula.

**El precio aplica la combinación de ofertas más barata.** `Raffle::priceTable()` resuelve con programación dinámica el costo mínimo de comprar exactamente N tickets. El cliente no calcula nada: recibe la tabla de precios ya formateada.

**Máximo 100 tickets por compra.** `Raffle::MAX_TICKETS_PER_PURCHASE`. Acota el abuso y el tamaño de la tabla de precios.

**El estado de venta se deriva, no se guarda.** `Raffle::salesStatus()` combina el estado en base de datos, la fecha del sorteo y los números disponibles. Una rifa `pending` es un borrador y no es visible. Las ventas cierran solas a la hora del sorteo.

**Imágenes de marketing en disco público, comprobantes en disco privado.** Portadas, imágenes de premios e íconos de métodos de pago van al disco `public` para servirse rápido y aparecer en la vista previa de WhatsApp. Los comprobantes van al disco `local`. Como lo público se sirve desde el mismo dominio que el admin, esas subidas solo aceptan JPG, PNG y WEBP. Un SVG podría ejecutar código.

**Zona horaria `America/Caracas`.** Los organizadores escriben la fecha del sorteo como hora local. Con UTC las ventas cerraban cuatro horas antes. Se configura con `APP_TIMEZONE`.

**Textos con `__()` y claves en inglés.** Es la convención del admin. La traducción está en `lang/es.json`. Si `APP_LOCALE` no es `es`, la página pública sale en inglés.

**Tasa BCV desde un servicio de terceros.** `ExchangeRateService` lee `ve.dolarapi.com`, guarda la tasa 30 minutos y conserva la última conocida hasta 4 días. Si no hay tasa, la página dice que se pague el equivalente a tasa BCV y registra el monto en la moneda de la rifa. La tasa se fija al entrar al checkout y se guarda en `payments.exchange_rate`.

**Teléfonos en E.164.** Un número sin código de país se lee como celular venezolano. Un comprador en el exterior debe empezar con `+`. No se aceptan fijos.

**Cédula solo en dígitos**, de 6 a 9. Es el formato que ya usaba el admin.

**Una referencia no se puede reportar dos veces** para el mismo método de pago, salvo que el primer pago haya sido rechazado. Exige de 6 a 30 caracteres para que las coincidencias por azar sean raras.

**Límites por visitante.** 15 reportes de pago cada 10 minutos por IP y rifa, y 20 consultas de tickets por minuto. Son generosos a propósito, porque los operadores móviles venezolanos comparten IP entre muchos usuarios.

**La memoria del checkout vive en la caché, bajo el id de sesión.** No en la sesión misma. Ver la sección 6.

## 6. Trampas que costaron tiempo

Leer antes de tocar las páginas públicas.

1. **`wire:model.blur` ya no envía nada al servidor.** En Livewire 4 los modificadores antes de `.live` solo controlan cuándo se actualiza el estado en el navegador. El comportamiento viejo es `wire:model.live.blur`. Los tests de PHP no lo detectan. La especificación está en `vendor/livewire/livewire/PRD-wire-model-modifiers.md`.
2. **`wire:model.live` se envía en paralelo.** Dos actualizaciones `live` del mismo componente no se esperan entre sí. Con varios procesos PHP, una respuesta vieja puede llegar después de una nueva y borrar un campo recién escrito. Por eso los campos del checkout usan `wire:model` sin modificador más `x-on:change="$wire.$commit()"`, que sí se encola. El chequeo `typing fast keeps every field` lo vigila.
3. **Con un solo worker las carreras no aparecen.** `artisan serve` sin `--no-reload` crea un único proceso y responde en orden. El script de pruebas usa cuatro a propósito.
4. **Laravel reescribe la sesión completa al final de cada petición.** Una petición lenta en paralelo, como la subida del comprobante, guardaba una copia vieja encima de lo que el comprador había escrito mientras tanto. Por eso lo recordado se guarda con `Cache::put` usando el id de sesión como parte de la clave.
5. **El disco por defecto de Filament 5 es privado.** En el primer análisis se afirmó que los comprobantes eran públicos. Era falso.
6. **`->image()` de Filament acepta SVG.** Hay que añadir `->acceptedFileTypes([...])` en cualquier subida que termine en disco público.
7. **`peer-checked:` de Tailwind no llega a los hijos del hermano.** Para un ícono dentro del elemento hermano se usa `peer-checked:[&>svg]:opacity-100`.
8. **`navigator.clipboard` solo existe en HTTPS o en `localhost`.** Los botones de copiar de la página pública tienen respaldo. El de "Copiar enlace" del admin no.
9. **Las capturas a mitad de un scroll suave salen corridas.** La página usa `scroll-behavior: smooth`. Hay que esperar antes de capturar.
10. **Los seeders corren sin protección de asignación masiva.** Por eso sí pueden escribir `status` o `team_id` aunque no estén en `$fillable`.
11. **El MCP de Laravel Boost no conecta** en esta máquina porque no hay PHP en el host. La documentación se consultó leyendo `vendor/`.
12. **`gh` tiene dos cuentas.** La activa, `rp-essertech`, no puede escribir en el repo, que es de `ricardojparram`.

## 7. Pendientes inmediatos

| Pendiente | Detalle |
|---|---|
| Subir la rama | `gh auth switch --user ricardojparram`, luego `git push -u origin feat/public-raffle-page`, luego `gh auth switch --user rp-essertech`. No se hizo porque implicaba usar otra cuenta sin permiso expreso del dueño |
| `.env` local | Quedó con `APP_URL=http://raffles-app:8000` de las pruebas. La edición fue denegada por permisos. No afecta al contenedor de la sección 3, que recibe su propia `APP_URL` |
| `APP_NAME` | Sigue en "Laravel" y aparece en el pie de la página pública y en el título de la pestaña |
| Archivos locales sobrantes | `storage/app/private/shots`, `storage/app/private/tenant-2` y `storage/app/public/livewire-tmp` son restos de pruebas. Git los ignora. El borrado fue denegado por permisos |
| Contenedor `raffles-app` | Quedó corriendo en el puerto 8000 por pedido del dueño. Se detiene con `docker rm -f raffles-app` |
| Imágenes Docker | `raffles-dev:8.4` y `raffles-browser:latest` quedan en la máquina |

## 8. Antes de producción

No abrir a organizadores reales sin esto. El detalle de cada punto está en [HALLAZGOS-TECNICOS.md](HALLAZGOS-TECNICOS.md).

- [ ] Roles y policies. Hoy cualquier miembro de un equipo puede cambiar la contraseña de otro.
- [ ] Verificación de correo y recuperación de contraseña en el panel.
- [ ] Quitar la cédula y el teléfono reales de los seeders, y la cuenta `admin@admin.com`.
- [ ] Pasar a MySQL o PostgreSQL y arreglar las migraciones que solo funcionan en SQLite.
- [ ] HTTPS, `APP_DEBUG=false`, `APP_ENV=production`, `APP_URL`, `APP_NAME`, `APP_LOCALE=es`.
- [ ] `php artisan storage:link` y `npm run build` en el despliegue.
- [ ] Un worker de colas y el programador de tareas, cuando existan notificaciones.
- [ ] Respaldos de la base de datos y de `storage/app`.
- [ ] Decidir si la tasa BCV de terceros es aceptable o si hace falta una tasa manual por equipo.
- [ ] Consultar a un abogado sobre el marco legal de rifas. Ver [NEGOCIO.md](NEGOCIO.md#7-riesgo-legal).
