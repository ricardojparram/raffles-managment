# Investigación para lanzar en Venezuela

Investigación web hecha el 13 de octubre de 2026 en seis frentes. Este archivo es la síntesis y la recomendación. Las notas completas, con cada fuente, están en [investigacion/notas/](investigacion/notas/).

**Límites de esta investigación.** Se cortó por tiempo y el cupo de búsquedas se agotó a mitad de camino. No se pudo leer el texto oficial de la providencia de CONALOT: su contenido viene de prensa, de formularios archivados de CONALOT y del blog de un proveedor de software de rifas. Varias cifras salen solo del resumen de un buscador y están marcadas así en las notas. Nada de esto es asesoría legal.

## 1. La conclusión

**El entorno legal cambió y el plan original ya no sirve tal cual.** Desde octubre de 2025 las rifas en Venezuela son una actividad regulada y vigilada, y el software de rifas también. Lanzar una herramienta abierta a cualquier organizador, sin tratar el tema regulatorio, expone al producto y a sus clientes.

**Recomendación:** no gastar en mercadeo ni abrir registro público todavía. Antes, resolver una sola pregunta con un abogado y con CONALOT: si un proveedor de software que no organiza rifas ni toca el dinero necesita homologarse. La respuesta define cuál de estos tres caminos tomar.

| Camino | En qué consiste | A favor | En contra |
|---|---|---|---|
| A. Homologarse | Registrar el programa informático y la página ante CONALOT | Queda como plataforma autorizada, que es lo que la norma pide a los organizadores | Los formularios piden empresa con objeto exclusivo de juegos, estructura contra legitimación de capitales, oficial de cumplimiento e inspección del código. Costo y plazo desconocidos |
| B. Aliarse con una homologada | Ofrecer el producto como tecnología a una de las tres empresas ya homologadas | Es la vía legal más rápida. El producto ya resuelve lo que ellas necesitan mostrar | Se pierde independencia y margen |
| C. Herramienta solo para organizadores con RUNLOT | Exigir el número RUNLOT al registrarse y mostrarlo en la página | Se puede hacer ya, y convierte el cumplimiento en ventaja | No está claro que baste: la norma habla de "plataformas autorizadas" |

Lo sensato es preparar C en el producto, porque sirve en los tres casos, mientras se consulta A y se explora B.

## 2. Marco legal de las rifas

| Punto | Lo hallado | Solidez |
|---|---|---|
| Norma central | Providencia Administrativa CONALOT/P/2025-001, del 2 de octubre de 2025, bajo la Ley Nacional de Lotería | Media. Texto oficial no leído |
| Qué exige | Toda rifa, presencial o en línea, inscrita en el registro RUNLOT. Un comunicado de julio de 2026 añade una autorización por cada rifa | Media |
| Pequeñas rifas | No se halló ninguna exención | Media |
| Persona natural | Sin resolver. La prensa dice que basta cédula o RIF. Los formularios de CONALOT están hechos para empresas | Baja |
| Costo | 7 % a CONALOT por rifa. Las fuentes discrepan sobre si es sobre tickets emitidos o vendidos | Media |
| Otros límites reportados | Máximo cuatro rifas ocasionales al año. Sin premios en divisas. Sin cobrar solo en divisas. Sin vender a menores. RUNLOT visible en toda la publicidad | Media |
| Software | CONALOT tiene registros para "Programa Informático", su responsable y "Página Web". Exige a las plataformas digitales "trazabilidad total" | Media. Sale de formularios archivados |
| Plataformas autorizadas | Lista "Empresas Homologadas para Rifas", tres al 6 de octubre de 2026: IMNOVAGAMES.COM, SEVEN HILL'S SISTEMAS con SEVENLOT, y GLOBAL TECH 11-11 con SUR | Media |
| Usar una lotería para decidir | No se halló regla que lo prohíba. El método debe declararse en el reglamento de la rifa que aprueba CONALOT | Baja |

**Persecución en 2026.** Desde el 16 de marzo se reportaron operativos en al menos cinco estados y la detención de los tres influencers de rifas más grandes. Se citan hasta 180 detenidos, sin confirmación oficial. Un hombre fue arrestado en Maracaibo en julio por una rifa en Instagram sin autorización. Tener número RUNLOT no protegió a uno de los detenidos. De 35 perfiles vigilados por un medio en abril, al menos la mitad seguía rifando, casi todos con menos de 100 mil seguidores.

**Sin precedente** hallado de sanción a un proveedor de software, y sin opinión publicada de abogados.

## 3. Competencia

No hay un SaaS venezolano de rifas consolidado, con precio público y registro libre. Lo local son instalaciones a medida, y varios dominios vistos en buscadores ya no existen.

| Producto | País | Precio | Nota |
|---|---|---|---|
| Las tres homologadas de la sección 2 | Venezuela | No investigado | Son la competencia que importa, o los posibles aliados |
| VendeTuRifa | Venezuela | Licencia única, sin precio público | Detecta Pago Móvil solo de Mercantil |
| RifaPlus | Venezuela | Cotiza por WhatsApp | Grilla, comprobante, consulta por cédula |
| Simple Rifa | Perú | 150 a 400 dólares al año | Sin comisión |
| Rifas Blu | Colombia | Gratis hasta 100 tickets | Luego tarifa por rifa |
| Rifas MX | México | Gratis hasta 1.000 tickets, luego mensual | El modelo más parecido al nuestro |
| Laooz | Colombia | Por rifa o 2 a 10 % de ventas | Precios contradictorios |

**Huecos que nadie cubre bien:** verificación automática de Pago Móvil en varios bancos, conversión BCV automática, avisos al comprador, y funciones de cumplimiento como RUNLOT, registro de auditoría y reporte del 7 %.

## 4. Mercado

- No existe ninguna estimación publicada del tamaño del mercado.
- Rifa digital típica: ticket de 0,50 a 5 dólares, rifas de 100, 1.000 o 10.000 números, compra por cantidad con asignación al azar, ganador por resultados de Lotería del Táchira.
- 17,6 millones de usuarios de internet. Android cerca de 86 %. TikTok alcanza 16,6 millones de adultos e Instagram unos 10 millones.
- Pago Móvil supera los 20 millones de afiliados. La mayoría de las transacciones son en bolívares aunque los precios se fijen en dólares.
- Fraudes documentados: rifas falsas de beneficencia y premios no entregados. CONALOT ahora le dice al comprador que exija el número RUNLOT.

## 5. Pagos y mensajería

| Tema | Lo hallado |
|---|---|
| Verificar Pago Móvil | Banesco tiene una API oficial y gratuita que valida pagos de cualquier banco por referencia, teléfono, banco y fecha. Casi todas las APIs bancarias piden cuenta jurídica |
| Verificación para plataformas | Pabilo, servicio venezolano, cubre varios bancos y Binance. Desde 35 dólares al mes por 2.000 validaciones |
| Tasa BCV | El BCV no tiene API. Publica en su web cada tarde hábil, con fecha valor del día hábil siguiente. El servicio que usa hoy el proyecto es comunitario y sin garantías |
| Tasa paralela | No usarla ni mostrarla. En 2025 hubo 58 detenidos por publicarla |
| Zelle | Sin forma de verificar por programa. Riesgo de cierre de cuentas personales con uso comercial |
| Binance | Tiene API de comercios. USDT se puede verificar en la cadena |
| WhatsApp por API | Su política prohíbe los juegos de azar y nombra las rifas. Venezuela no está entre los cinco países con excepción. **No construir sobre la API** |
| Enlaces `wa.me` | Siguen siendo la opción sin costo y sin riesgo de política |
| Cobrar las suscripciones | Stripe y Paddle no admiten Venezuela. Lo realista es cobro manual por Pago Móvil, Zelle y Binance |

## 6. Operar el negocio

- Se puede empezar como persona natural con RIF. Una compañía anónima exige dos socios.
- IVA de 16 % sobre servicios. Impuesto municipal de hasta 3 % del ingreso bruto.
- El IGTF de 3 % sobre divisas solo lo cobran los contribuyentes especiales.
- Quien vende por medios electrónicos debe facturar digitalmente con una imprenta digital autorizada. Hubo cambios en agosto de 2026 y su vigencia exacta quedó sin confirmar.
- Cobrar en divisas es legal.
- Una LLC en Estados Unidos tropieza con la banca: Mercury y Firstbase restringen a venezolanos.
- Las sanciones no afectan a ciudadanos ni a empresas privadas. GitHub y Twilio no bloquean a Venezuela.
- No hay ley general de protección de datos. Aplican los artículos 28 y 60 de la Constitución. Hace falta política de privacidad y términos de uso.

## 7. Plataformas y captación

- **Anuncios pagos:** descartados por ahora. Meta exige autorización con prueba de licencia. TikTok no permite promocionar juegos de azar. Google Ads no incluye a Venezuela.
- **Contenido orgánico en Instagram:** permitido, restringido a mayores de 18.
- **Aplicación en tiendas:** descartada. Google Play y Apple exigen ser operador licenciado.
- **Precios de referencia:** herramientas para microempresas en Venezuela cobran de 10 a 15 dólares al mes. El ancla regional en rifas es 150 dólares al año o gratis hasta 100 tickets.
- **Modelo:** el uso es por rachas, así que cobrar por rifa encaja mejor que una mensualidad. Es una inferencia, sin datos comparativos.

## 8. Qué cambia en el producto

Vale en cualquiera de los tres caminos.

| Cambio | Por qué |
|---|---|
| Número RUNLOT obligatorio por organizador y visible en la página pública | La norma lo exige en toda publicidad y CONALOT le dice al comprador que lo pida |
| Registro de auditoría de pagos y cambios | Es la "trazabilidad total" que se exige a las plataformas |
| Reporte del 7 % por rifa | Ahorra trabajo al organizador y demuestra cumplimiento |
| Exigir al menos un método en bolívares y mostrar precios en bolívares | Está prohibido cobrar solo en divisas |
| Aviso y confirmación de mayoría de edad | Está prohibido vender a menores |
| Tope de cuatro rifas al año para organizadores ocasionales | Límite reportado de la norma |
| Tasa BCV leída de la web oficial, con el servicio actual como respaldo, respetando la fecha valor | Hoy depende de un tercero sin garantías |
| Verificación automática de Pago Móvil con Pabilo o la API de Banesco | Es el hueco más claro frente a la competencia |
| No usar la API de WhatsApp | Política de la plataforma |

## 9. Preguntas para el abogado

1. ¿Un proveedor de software que no organiza rifas ni maneja el dinero debe homologarse ante CONALOT?
2. ¿Qué exige exactamente la Providencia CONALOT/P/2025-001 y dónde se publicó?
3. ¿Puede una persona natural obtener RUNLOT y organizar rifas?
4. ¿El 7 % se calcula sobre tickets emitidos o vendidos, y cuándo se paga?
5. ¿Qué responsabilidad tiene la plataforma si un organizador sin RUNLOT la usa?
6. ¿Sigue vigente la obligación de facturación digital para un SaaS tras los cambios de agosto de 2026?

## 10. Lo que no se pudo averiguar

- Costos y plazos de la homologación y de constituir una empresa en 2026.
- Precios y tracción de las tres plataformas homologadas.
- Comisión típica de vendedores, estacionalidad y qué tasa aplican los organizadores.
- Costo de anunciar hacia Venezuela y si Meta acepta cuentas publicitarias venezolanas.
- Cómo cobran otros SaaS venezolanos.
