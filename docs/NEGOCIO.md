# Negocio

> **Actualización del 13 de octubre de 2026.** Después de escribir este documento se hizo una investigación web. Su resultado está en [INVESTIGACION-VENEZUELA.md](INVESTIGACION-VENEZUELA.md) y corrige varias partes de este archivo, sobre todo la sección 7: las rifas y el software de rifas están regulados por CONALOT desde octubre de 2025, hay plataformas homologadas y hubo detenciones en 2026. Donde ambos documentos difieran, vale la investigación.

**Aviso sobre este documento.** Lo técnico de esta carpeta está comprobado. Lo de este archivo no: es análisis razonado a partir del código, de lo que dijo el dueño y de conocimiento general del mercado venezolano. No se investigó competencia, precios de mercado ni legislación vigente. Cada sección dice qué habría que validar. Tratarlo como un punto de partida para hablar con organizadores reales, no como una conclusión.

## 1. Diagnóstico

El dueño describió el proyecto como estancado y sin saber cómo llevarlo a generar dinero.

La causa no era técnica. El proyecto tenía el panel de administración y le faltaba el producto. Un organizador de rifas no paga por un formulario para registrar clientes y pagos: eso ya lo hace con Excel y WhatsApp. Paga por lo que le ahorra trabajo o le trae ventas:

1. Un enlace que pueda poner en Instagram donde el comprador elige número y reporta su pago sin escribirle.
2. Que el número quede apartado solo, sin anotar a mano.
3. Que el comprador pueda verificar que su ticket está pago, sin preguntar.
4. Un sorteo que se vea transparente.

Los puntos 1, 2 y 3 quedaron hechos en esta rama. El 4 no. Tampoco existe todavía ninguna forma de cobrarle al organizador.

## 2. A quién venderle

Hipótesis, de mayor a menor prioridad.

| Segmento | Por qué primero o después |
|---|---|
| Organizadores recurrentes en Instagram y TikTok que rifan carros, motos, teléfonos o dinero | Hacen rifas todos los meses, manejan cientos o miles de tickets y sufren el trabajo manual. Son los que más ganan con la herramienta |
| Comercios que rifan para promocionarse | Volumen menor, pero pagan por imagen profesional |
| Rifas benéficas, escolares o de comunidades | Ocasionales. Sirven para el plan gratis y para el boca a boca |
| Redes de vendedores o promotores | Requieren comisiones por vendedor, que no existe |

**Por validar:** hablar con cinco organizadores recurrentes y preguntar cómo llevan hoy el control, cuánto tiempo les toma confirmar pagos, cuántas veces les repiten un comprobante, y cuánto pagarían.

## 3. Posicionamiento

**Software de gestión para el organizador. Nunca operador de la rifa ni intermediario del dinero.**

Esto ya está reflejado en el producto y conviene no romperlo:

- El dinero va directo del comprador al organizador. La plataforma no lo toca.
- El organizador confirma cada pago a mano mirando su banco.
- El pie de la página pública dice que la rifa la organiza y administra el organizador.

Cobrar una comisión por ticket vendido cambiaría esa posición. Convertiría a la plataforma en parte del negocio de la rifa, con el riesgo legal que eso trae.

## 4. Contexto de Venezuela

Conocimiento general. Confirmar cada punto con organizadores.

**Cómo se paga.** Pago Móvil en bolívares es lo más común. Zelle y Binance para quien tiene dólares, incluida la diáspora. Efectivo en ventas presenciales. Casi nadie paga con tarjeta, así que una pasarela tipo Stripe no sirve ni para los compradores ni para cobrarle al organizador.

**Tasa de cambio.** Las rifas grandes se anuncian en dólares y se cobran en bolívares a tasa BCV del día. Algunos organizadores usan otra tasa. La página ya convierte a tasa BCV y guarda la tasa usada en cada pago.

**Formato de las rifas.** Suelen ser de 100, 1.000 o 10.000 números, porque el ganador se decide con las últimas dos, tres o cuatro cifras de una lotería conocida. Es habitual que haya premios anticipados en fechas anteriores al premio mayor, y descuentos por cantidad. El producto ya modela todo eso: numeración con ceros, premios con fecha propia y ofertas.

**Canales.** Instagram y TikTok para anunciar, WhatsApp para vender y cobrar. El comprador llega desde un enlace en una historia o en la biografía.

**Fraudes y roces habituales.** El mismo comprobante enviado dos veces. Capturas editadas. Compradores que dicen haber pagado y no lo hicieron. Dos personas a las que se les vendió el mismo número por error. El producto ya rechaza una referencia repetida y hace imposible vender dos veces un número.

**Conectividad.** Datos móviles lentos e inestables y teléfonos Android modestos. Por eso la página pesa poco, la selección de números no espera al servidor y el comprobante se comprime antes de subir.

**Diáspora.** Muchos compradores están fuera del país. El formulario acepta teléfonos internacionales.

## 5. Cómo cobrar

Propuesta. Ningún precio está validado.

| Plan | Qué incluye | Para qué sirve |
|---|---|---|
| Gratis | Una rifa activa, hasta 100 números, con la marca de la plataforma en la página pública | Adquisición. Cada comprador ve la marca |
| Pro, mensual en dólares | Rifas ilimitadas, rifas grandes, sin marca, avisos por WhatsApp, exportación, vendedores | El ingreso recurrente |
| Por rifa | Un pago único para una rifa grande | Organizadores ocasionales que no quieren suscripción |

**Cobrar con el mismo sistema.** En Venezuela no hace falta una pasarela para empezar. El organizador puede pagar su plan por Pago Móvil, Zelle o USDT y reportarlo con comprobante, usando el mismo flujo que ya existe para los tickets. Se confirma a mano.

**Lo que no hay que hacer:** comisión por ticket. Ver la sección 3.

**Por validar:** cuánto pagan hoy por diseño, por community manager o por otras herramientas, para ubicar el precio. Como referencia de orden de magnitud, un organizador que rifa un carro maneja miles de dólares por rifa.

## 6. Salida al mercado

1. Conseguir tres organizadores recurrentes y ofrecerles el servicio gratis a cambio de usarlo en una rifa real y dar su opinión. Migrarles a mano su lista si hace falta.
2. Arreglar lo que esas tres rifas revelen. Va a aparecer algo.
3. Usar esas rifas como casos: capturas reales, cifras reales.
4. Buscar más organizadores donde ya están: etiquetas de rifas en Instagram y TikTok, y los seguidores de los primeros clientes.
5. Dejar que la marca en el pie de la página gratis traiga organizadores nuevos. Cada rifa la ven cientos de compradores, y algunos organizan las suyas.

Hace falta una página de inicio que explique el producto y sus planes. Hoy `/` muestra la bienvenida de Laravel.

## 7. Riesgo legal

**No es asesoría legal y no se verificó la normativa vigente.** Hay que consultar a un abogado venezolano antes de cobrar.

Lo que se sabe en general: las rifas son juegos de azar y en casi todos los países están reguladas.

| País | Punto de partida para investigar |
|---|---|
| Venezuela | La Ley Nacional de Lotería y la Comisión Nacional de Lotería, CONALOT. Muchas rifas informales operan sin permiso |
| Colombia | Coljuegos y las autoridades territoriales regulan rifas según su alcance |
| México | La Secretaría de Gobernación otorga permisos de sorteos |
| Estados Unidos | En general solo las organizaciones sin fines de lucro pueden rifar, y varía por estado |

Lo que el producto ya hace para reducir exposición: no toca el dinero, no decide ganadores y dice de forma visible quién organiza. Conviene añadir términos de uso donde el organizador declare que su rifa cumple la ley de su país, y un canal para denunciar rifas fraudulentas.

Otro riesgo es de reputación: si un organizador estafa usando la plataforma, el nombre de la plataforma aparece en la página. Un registro de auditoría y poder suspender organizadores son la defensa mínima.

## 8. Reglas de negocio

### Ya implementadas

| Regla | Dónde |
|---|---|
| Números de 0 a N-1 con ceros a la izquierda | `Raffle::formatNumber` |
| Un número no se puede vender dos veces | Índice único en `tickets` y `ReserveTickets` |
| Un pago reportado aparta los números hasta que el organizador decida | `ReserveTickets` |
| Rechazar un pago libera sus números | `Payment::booted` |
| Mínimo de tickets por compra, relajado si quedan menos | `ReserveTickets` y `TicketPurchase` |
| Máximo de 100 tickets por compra | `Raffle::MAX_TICKETS_PER_PURCHASE` |
| El precio usa la combinación de ofertas más barata | `Raffle::priceTable` |
| Las ventas cierran a la hora del sorteo | `Raffle::salesStatus` |
| Una rifa en borrador no es visible | `PublicRaffleController` |
| Una referencia no se reporta dos veces por método | `ReserveTickets` |
| Conversión entre dólares y bolívares a tasa BCV, guardando la tasa | `PaymentMethod::quoteFor` |
| El público no modifica clientes existentes | `ReserveTickets` |
| La cantidad de números no cambia cuando ya hay vendidos | `RaffleResource` |

### Faltantes

| Regla | Por qué importa |
|---|---|
| Vencimiento de reservas sin confirmar | Hoy un número puede quedar apartado indefinidamente por un pago falso |
| Confirmar un pago con autorización y registro de quién lo hizo | Es dinero. Hoy es un clic sin rastro |
| Asignar números desde el admin | Para ventas presenciales o por WhatsApp |
| Validar el monto pagado contra el esperado | El admin puede escribir cualquier monto |
| Transiciones de estado válidas | Hoy una rifa finalizada puede volver a activa |
| Mínimo vendido para sortear, o posponer | El campo `minimum_tickets` significa mínimo por compra, no esto |
| Registrar el resultado y el ganador de cada premio | No existe. Es la mitad de la confianza |
| Devoluciones al cancelar una rifa | No existe ni el concepto |
| Tasa de cambio propia del organizador | Algunos no usan BCV |
| Límite de tickets por comprador y lista de bloqueados | Contra acaparadores y estafadores conocidos |
| Vendedores con comisión | Las rifas grandes se venden por red de promotores |
| Tipo de documento: V, E, J, pasaporte | Hoy solo dígitos |

## 9. Otros países

El dueño dijo que por ahora el producto saldrá solo para Venezuela. Si se expande, lo que cambia por país es poco y está localizado:

| Qué | Hoy | Para varios países |
|---|---|---|
| Monedas | USD y VED, escritas a mano en tres sitios | Un enum de monedas y moneda base por equipo |
| Zona horaria | `America/Caracas` global | Por equipo |
| Teléfono | Sin código se asume Venezuela | País por defecto del equipo |
| Documento | Dígitos, 6 a 9 | Tipos y formato por país |
| Tasa de cambio | BCV | Fuente por par de monedas |
| Métodos de pago | Libres, los crea el organizador | Igual. Ya sirve |
| Idioma | Español con claves en inglés | Ya está preparado |
| Marco legal | Sin tratar | Términos por país |

Métodos típicos a considerar: Nequi y Daviplata en Colombia, Yape y Plin en Perú, SPEI y OXXO en México, Mercado Pago en Argentina.

## 10. Qué medir

No hay ninguna analítica instalada. Lo mínimo:

| Métrica | Qué dice |
|---|---|
| Organizadores que publican su primera rifa tras registrarse | Si el producto se entiende |
| Visitas a la página de rifa que terminan en pago reportado | Si la página vende |
| Pagos reportados que se confirman | Calidad de las ventas y nivel de fraude |
| Tiempo entre reporte y confirmación | El cuello de botella del organizador |
| Organizadores que hacen una segunda rifa | Retención. Es la métrica que importa |
| Organizadores nuevos que llegan desde el pie de una página pública | Si el canal viral funciona |

## 11. Preguntas abiertas

- ¿Qué herramientas usan hoy los organizadores y cuánto pagan? No se investigó competencia.
- ¿Prefieren elegir números uno por uno o comprar una cantidad y que se asignen al azar? La página permite las dos cosas.
- ¿Quieren que el comprador vea cuántos números quedan? Hoy se muestra el porcentaje, y la cantidad exacta solo cuando queda el 20 % o menos.
- ¿Les sirve la tasa BCV automática o necesitan fijar la suya?
- ¿Cómo quieren enterarse de un pago nuevo: WhatsApp, correo, notificación en el panel?
- ¿Cuál es el nombre y la marca del producto? Hoy la aplicación se llama "Laravel".
