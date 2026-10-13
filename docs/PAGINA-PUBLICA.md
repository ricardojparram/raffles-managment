# Página pública

Lo que un organizador comparte por Instagram o WhatsApp para vender. No requiere cuenta ni instalar nada.

## 1. Rutas

| Ruta | Nombre | Qué muestra |
|---|---|---|
| `/r/{team:slug}` | `raffles.index` | Rifas en venta del organizador y, debajo, hasta 12 anteriores |
| `/r/{team:slug}/{raffle:slug}` | `raffles.show` | La rifa, con compra y consulta de tickets |

Los bindings están anidados con `scopeBindings()`, así que una rifa solo responde bajo el slug de su propio equipo. El slug de la rifa es único por equipo, se genera del título al crearla y no cambia si el título se edita, para no romper enlaces ya compartidos.

`Raffle::publicUrl()` devuelve la dirección completa. El admin la ofrece en el menú Compartir de cada rifa y en el enlace "Mi página pública" del menú lateral.

## 2. Qué ve el público según el estado

`Raffle::salesStatus()` devuelve un `App\Enums\SalesStatus`.

| Estado | Condición | Efecto en la página |
|---|---|---|
| `Unpublished` | Rifa `pending` | 404. Es un borrador |
| `Open` | Rifa `active`, fecha futura, quedan números | Tablero y compra |
| `SoldOut` | Rifa `active`, fecha futura, sin números | Aviso, sin compra. Sigue la cuenta regresiva |
| `Closed` | Rifa `active`, fecha pasada | Aviso, sin compra |
| `Finished` | Rifa `finished` | Aviso, sin compra, sin progreso ni formas de pago |
| `Canceled` | Rifa `canceled` | Igual que finalizada |

La consulta de tickets aparece en todos los estados visibles.

## 3. Flujo de compra

Todo ocurre en `App\Livewire\TicketPurchase`. Tiene tres pasos, guardados en la propiedad bloqueada `step`.

```
pick  ──checkout()──▶  pay  ──submit()──▶  done  ──finish()──▶  pick
  ▲                      │
  └────backToNumbers()───┘
```

**Paso `pick`: el tablero.** El comprador toca números. La selección vive en el navegador y no hace peticiones, para que responda al instante con mala conexión. Solo hay petición al cambiar de rango, buscar un número, pedir números al azar o continuar. El servidor recibe la selección en esa misma petición.

**Paso `pay`: el reporte.** Es una hoja a pantalla completa con tres bloques: elegir método y ver a dónde pagar, datos del comprador, y referencia con comprobante. Al entrar se limpian de la selección los números que alguien más tomó, se fija la tasa de cambio y, si el organizador tiene un solo método, se preselecciona.

**Paso `done`: la confirmación.** Muestra los números reservados y el resumen del pago, en estado "Por confirmar".

`submit()` valida, aplica el límite por visitante y llama a `App\Actions\ReserveTickets`. Esa acción vuelve a comprobar todo por su cuenta, porque es la única puerta de entrada y no debe confiar en el componente. Si falla, lanza `ReservationFailed` con uno de cuatro motivos:

| Motivo | Qué hace el componente |
|---|---|
| `numbers_taken` | Vuelve al tablero, quita esos números y dice cuáles fueron |
| `raffle_closed` | Vuelve al tablero y avisa que las ventas cerraron |
| `duplicate_reference` | Se queda en el pago y marca la referencia |
| `invalid_selection` | Vuelve al tablero y limpia la selección |

### Lo que sobrevive a una recarga

El comprador sale del navegador para pagar en la app del banco. Al volver, es común que el teléfono recargue la pestaña. Por eso el componente guarda en caché, bajo el id de sesión y por dos horas, la selección, el paso, los datos del comprador, el método y la referencia. Al montarse los restaura, y si el paso era `pay` vuelve a ejecutar `checkout()` para revalidar. El comprobante no se puede conservar y hay que volver a subirlo. Después de una compra solo se recuerdan los datos del comprador, para que comprar de nuevo sea rápido.

### Propiedades que el navegador no puede cambiar

`raffle`, `step`, `page`, `rate` y `paymentId` llevan `#[Locked]`. `page` está bloqueada por una razón concreta: sin el bloqueo, pedir una página enorme hacía que el servidor generara un rango gigantesco de números.

## 4. Consulta de tickets

`App\Livewire\TicketChecker`. El comprador escribe su cédula y ve sus números en esa rifa, cada uno "Confirmado" o "Por confirmar". Un ticket sin pago asociado cuenta como confirmado, pensando en tickets que el organizador asigne a mano en el futuro. Si un pago suyo fue rechazado, lo dice y muestra los últimos cuatro caracteres de la referencia.

Cualquiera que conozca una cédula puede consultarla. Por eso el nombre se muestra enmascarado, como `M•••• P••••`, y no se muestra teléfono ni montos.

## 5. Sistema de diseño

### Historia, para no repetirla

| Versión | Aspecto | Qué dijo el dueño |
|---|---|---|
| 1 | Fondo crema, acento naranja, tarjetas muy redondeadas, fuente del sistema | "Se nota mucho que está hecho con Claude, tiene hasta los colores típicos" |
| 2 | Fondo azul rey, amarillo, tickets con muescas, tipografía de cartel en mayúsculas, sellos | "Parece un cine". Pidió algo "más minimalista, un estilo que a la gente le dé más confianza" |
| 3, vigente | Blanco, grises fríos, un solo verde, líneas finas, Manrope | Pendiente de su opinión |

Conclusión para quien siga: el dueño quiere sobriedad y confianza, no espectáculo. Tampoco quiere la paleta cálida crema con naranja.

### Principios del estilo vigente

1. **Parece una app bancaria, no una promoción.** El comprador va a enviarle dinero a alguien que encontró en Instagram.
2. **Un solo color.** El verde se usa solo para el siguiente paso y para lo que ya está confirmado. Todo lo demás es tinta y gris.
3. **Líneas finas en lugar de sombras.** Las tarjetas tienen borde de un píxel y no flotan.
4. **La foto de la rifa es lo único vistoso.**
5. **Texto en minúsculas normales.** Nada de mayúsculas de cartel.

### Dónde vive

Todo el estilo está en `resources/css/public.css`. Las vistas solo usan utilidades de Tailwind y unas pocas clases de componente definidas ahí. Para cambiar la paleta basta editar el bloque `@theme` y su versión oscura.

| Token | Claro | Uso |
|---|---|---|
| `canvas`, `surface` | `#ffffff` | Fondo de página y de tarjetas |
| `sunken` | `#f4f6f8` | Rellenos suaves: celdas, números disponibles |
| `line`, `line-strong` | `#e4e8ed`, `#cbd2db` | Bordes de tarjetas y de campos |
| `ink`, `ink-soft`, `ink-faint` | `#0f1720`, `#4a5563`, `#6b7684` | Texto principal, secundario y de apoyo |
| `brand`, `brand-strong` | `#0a7a5a`, `#086349` | Botón principal y número elegido |
| `brand-soft`, `brand-ink` | `#e8f5f0`, `#086349` | Fondo y texto de estados confirmados y enlaces |
| `warning`, `danger` y sus `-soft` | Ámbar y rojo | "Por confirmar" y errores |

El modo oscuro redefine los mismos tokens dentro de `@media (prefers-color-scheme: dark)`. Las vistas no llevan ninguna clase `dark:`.

Clases de componente: `.card`, `.btn` con `.btn-primary`, `.btn-secondary` y `.btn-sm`, `.icon-btn`, `.icon-btn-flat`, `.field`, `.field-label`, `.field-error`, `.caption`, `.section-title`, `.pill`, `.number-tile`, `.number-chip`, `.meter` y `.rich-text`.

### Tipografía

Manrope variable, un solo archivo de 25 KB con el subconjunto latino, en `resources/fonts` junto a su licencia SIL OFL. Se precarga desde el layout. No se carga nada de terceros.

### Decisiones de usabilidad en móvil

- Objetivos táctiles de 44 px o más. Los números miden 48 px de alto en una grilla de 5 columnas.
- Campos con texto de 16 px para que iOS no haga zoom al enfocar.
- `inputmode` numérico en cédula, búsqueda y teléfono.
- El total y el botón de continuar viven en una barra fija abajo, con margen para la zona segura del teléfono.
- El botón atrás del teléfono cierra la hoja abierta en vez de sacar al comprador de la rifa.
- Tras un envío con errores, la hoja se desplaza al primer campo con problema.
- El comprobante se reduce en el teléfono a 1600 px y JPEG antes de subir, para que pese poco y no choque con límites de subida del servidor.
- Nada depende de deslizar hacia los lados. Un carrusel anterior de premios no se podía mover con ratón.
- Se respeta `prefers-reduced-motion`.

### Accesibilidad

Los números son botones con `aria-pressed`. Los vendidos están deshabilitados y su etiqueta lo dice. Las hojas son `role="dialog"` con `aria-modal` y reciben el foco al abrirse. Los errores usan `role="alert"` y cada campo inválido lleva `aria-invalid` y `aria-describedby`. No hay trampa de foco dentro de las hojas: es una mejora pendiente.

## 6. Peso y rendimiento

Medido en la compilación de producción.

| Recurso | Tamaño comprimido |
|---|---|
| `public.css` | 7 KB |
| `public.js` | 2 KB |
| Fuente Manrope | 25 KB |
| Livewire con Alpine | Lo inyecta Livewire, fuera de nuestro control |

El HTML de la rifa de demostración mide 73 KB sin comprimir y 11 KB con gzip. Esa medida es en local, donde Laravel Boost inyecta además su script de registro del navegador. El servidor de producción debe servir con gzip o brotli.

## 7. Pruebas

### PHPUnit

| Archivo | Qué cubre |
|---|---|
| `RaffleTest` | Slug, numeración, precios con ofertas, disponibilidad, estados de venta |
| `ReserveTicketsTest` | La acción de reserva: cliente, montos, conversión, comprobante, todos los rechazos |
| `PaymentTest` | Liberación de números al rechazar o borrar |
| `PaymentMethodTest` | Cotización entre monedas |
| `ExchangeRateServiceTest` | Caché, respaldo, caducidad y fallos del proveedor |
| `CustomerTest` | Normalización de teléfonos, con casos válidos e inválidos |
| `PublicTeamPageTest`, `PublicRafflePageTest` | Rutas, 404, estados, saneado del HTML, metadatos para compartir |
| `TicketPurchaseTest` | El componente completo: tablero, checkout, validación, límites, memoria |
| `TicketCheckerTest` | Consulta, enmascarado, aislamiento entre rifas y equipos, límite |
| `RaffleResourceTest`, `PaymentResourceTest` | Centavos, campos de tickets, discos, enlaces para compartir |

`tests/TestCase.php` bloquea cualquier petición HTTP no simulada y desactiva Vite. Un test que toque la tasa de cambio debe usar `Http::fake`.

### Navegador

`tests/Browser/run.sh` levanta una copia desechable de la app con cuatro workers y la recorre con Chromium. Existe porque los dos últimos errores reales eran invisibles para PHPUnit.

| Script | Qué hace |
|---|---|
| `behaviour.mjs` | 23 chequeos de pasa o falla. Sale con error si alguno falla o si el navegador registra un error de consola o de red |
| `screens.mjs` | Recorre la compra y guarda 13 capturas. `SCHEME=dark` para el modo oscuro |
| `admin.mjs` | 6 chequeos del panel: enlaces públicos, tabla, campo bloqueado, precio en unidades |
| `lib.mjs` | Abre la página como un teléfono, recoge errores y ofrece ayudas de captura |

Qué vigila `behaviour.mjs`: que la página y la hoja quepan en 320 px, que la fuente cargue, que tocar un número responda sin esperar al servidor, que el botón atrás cierre las hojas, que una recarga a mitad del pago no pierda nada, que un envío con errores lleve al primer problema, que escribir más rápido de lo que responde el servidor no borre campos, y que en escritorio nada necesite scroll lateral.

Correr `behaviour` después de tocar cualquier Blade, Alpine o atributo `wire:` de las páginas públicas.

## 8. Límites conocidos

- El organizador no recibe ningún aviso cuando entra un pago. Tiene que mirar la lista de pagos.
- El comprador tampoco recibe aviso cuando se confirma o rechaza. Debe consultar con su cédula.
- Un visitante puede reservar números con una referencia y una captura falsas. El organizador los libera al rechazar. No hay vencimiento automático de reservas.
- No hay tasa de cambio manual por equipo. Si el organizador cobra a otra tasa que la BCV, la página mostrará un monto distinto al suyo.
- El título y descripción para compartir salen de la rifa. No hay imagen ni texto de marca propios de la plataforma.
- La página principal `/` sigue siendo la de bienvenida de Laravel.
