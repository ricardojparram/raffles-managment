# Informe completo: lanzar un SaaS de rifas en Venezuela

Fecha de la investigación: 13 de octubre de 2026.

**Qué es este documento.** Reúne en un solo lugar todo lo que encontraron los seis frentes de investigación, pregunta por pregunta, con sus fuentes. Empieza por la conclusión y los cambios de producto, que son lo que hay que leer si solo hay cinco minutos. El resto es la evidencia.

**Cómo está construido.** Las secciones 1 a 4 son la síntesis. De la 5 en adelante, cada pregunta trae cuatro partes: la conclusión, los hallazgos con su fuente, las inferencias de quien investigó y los vacíos. Esas partes son las notas originales de cada frente, sin reescribir, para no alterar lo que dicen las fuentes.

**Límites.** La investigación se cortó por tiempo y el cupo de búsquedas web se agotó a mitad de camino, así que la cobertura es desigual. No se pudo leer el texto oficial de la Providencia CONALOT/P/2025-001: su contenido viene de prensa, de formularios archivados de CONALOT y del blog de un proveedor de software de rifas. Los hallazgos marcados como "extracto", "snippet" o "no verificado" salen solo del resumen de un buscador. Nada de esto es asesoría legal.

## Índice

1. La conclusión
2. Qué cambia en el producto
3. Preguntas para el abogado
4. Lo que no se pudo averiguar

5. Marco legal de las rifas
6. Competencia
7. Mercado
8. Pagos e integraciones
9. Operación legal y fiscal del negocio
10. Políticas de plataformas y salida al mercado

## 1. La conclusión

**El entorno legal cambió y el plan original ya no sirve tal cual.** Desde octubre de 2025 las rifas en Venezuela son una actividad regulada y vigilada, y el software de rifas también. Lanzar una herramienta abierta a cualquier organizador, sin tratar el tema regulatorio, expone al producto y a sus clientes.

**Recomendación:** no gastar en mercadeo ni abrir registro público todavía. Antes, resolver una sola pregunta con un abogado y con CONALOT: si un proveedor de software que no organiza rifas ni toca el dinero necesita homologarse. La respuesta define cuál de estos tres caminos tomar.

| Camino | En qué consiste | A favor | En contra |
|---|---|---|---|
| A. Homologarse | Registrar el programa informático y la página ante CONALOT | Queda como plataforma autorizada, que es lo que la norma pide a los organizadores | Los formularios piden empresa con objeto exclusivo de juegos, estructura contra legitimación de capitales, oficial de cumplimiento e inspección del código. Costo y plazo desconocidos |
| B. Aliarse con una homologada | Ofrecer el producto como tecnología a una de las tres empresas ya homologadas | Es la vía legal más rápida. El producto ya resuelve lo que ellas necesitan mostrar | Se pierde independencia y margen |
| C. Herramienta solo para organizadores con RUNLOT | Exigir el número RUNLOT al registrarse y mostrarlo en la página | Se puede hacer ya, y convierte el cumplimiento en ventaja | No está claro que baste: la norma habla de "plataformas autorizadas" |

Lo sensato es preparar C en el producto, porque sirve en los tres casos, mientras se consulta A y se explora B.

## 2. Qué cambia en el producto

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

## 3. Preguntas para el abogado

1. ¿Un proveedor de software que no organiza rifas ni maneja el dinero debe homologarse ante CONALOT?
2. ¿Qué exige exactamente la Providencia CONALOT/P/2025-001 y dónde se publicó?
3. ¿Puede una persona natural obtener RUNLOT y organizar rifas?
4. ¿El 7 % se calcula sobre tickets emitidos o vendidos, y cuándo se paga?
5. ¿Qué responsabilidad tiene la plataforma si un organizador sin RUNLOT la usa?
6. ¿Sigue vigente la obligación de facturación digital para un SaaS tras los cambios de agosto de 2026?

## 4. Lo que no se pudo averiguar

- Costos y plazos de la homologación y de constituir una empresa en 2026.
- Precios y tracción de las tres plataformas homologadas.
- Comisión típica de vendedores, estacionalidad y qué tasa aplican los organizadores.
- Costo de anunciar hacia Venezuela y si Meta acepta cuentas publicitarias venezolanas.
- Cómo cobran otros SaaS venezolanos.

## 5. Marco legal de las rifas

Qué leyes y qué organismos rigen las rifas en Venezuela, qué necesita un organizador, qué se persigue en la práctica y qué exposición tiene quien provee el software.

### ¿Qué leyes aplican? (nombres, Gacetas, fechas, normas 2023-2026)

**Conclusión**

La norma central hoy es la Providencia Administrativa N° CONALOT/P/2025-001 del 02-10-2025, dictada bajo la Ley Nacional de Lotería, que somete toda rifa (presencial o virtual) a registro y autorización de CONALOT; se complementa con el Comunicado N° 003 (diciembre 2025) y la providencia antilavado CNL-DP-2016-0029. No pude leer el texto oficial de la Providencia 2025-001 ni confirmar su Gaceta: casi todo lo que se sabe de su contenido viene de prensa y de un vendedor de sistemas de rifas.

**Hallazgos con fuente**

- CONALOT publica en su web una entrada titulada "Providencia N° CONALOT/P/2025-001 de fecha 02-10-2025" (categoría Providencias), que enlaza al PDF `wp-content/uploads/2026/03/Prov-001.pdf`; la entrada figura modificada el 19-03-2026. El PDF no estaba archivado y no se pudo leer. — [CONALOT, captura 13-04-2026](http://web.archive.org/web/20260413113919/https://www.conalot.gob.ve/2025/03/19/providencia-n-conalot-p-2025-001-de-fecha-02-10-2025/)
- La Providencia N° CONALOT/P/2025-001 (02-10-2025) fue publicada en el Instagram de CONALOT el 19-03-2026 y ya estaba en su web; exige declaración jurada de bienes, documentación de propiedad de los bienes, declaración de origen y destino de fondos, establece que "el dinero o los bienes objeto de la rifa deben ser de origen lícito" y que cada sorteo paga a CONALOT 7% de la venta de boletos. — [La Gran Aldea, 25-03-2026](https://lga.lagranaldea.com/2026/03/25/quienes-son-y-que-pasa-con-los-riferos-en-venezuela/)
- "Toda rifa —ya sea presencial o virtual— debe cumplir con la Providencia Administrativa N.º CONALOT/P/2025-001"; la normativa se actualizó en octubre de 2025 y se reafirmó en marzo de 2026. — [La Nación (Táchira), 20-03-2026](https://lanacionweb.com/nacional/rifas-en-redes-sociales-en-venezuela-conalot-advierte-sobre-requisitos-legales-para-evitar-estafas/)
- Categorías de rifa según la Providencia (resumen de un proveedor comercial, no texto oficial): Rifas Permanentes; Rifas Ocasionales "limitadas a cuatro eventos anuales con intervalos de tres meses"; Rifas Publicitarias y Promocionales; Rifas Benéficas. Artículo 15: contenido del "Medio de Apuesta" (identificador RUNLOT, valor, descripción del premio, fecha/hora/lugar del sorteo, advertencias de juego responsable y prohibición a menores). — [Diseño Digital (vendedor de sistemas de rifas)](https://disenodigitalec.com/informativo/todo-sobre-la-nueva-providencia-001-de-conalot-guia-para-realizar-rifas-legales-en-venezuela/)
- Antecedente 2023: Aviso Oficial de CONALOT del 17-10-2023, firmado por Néstor Eduardo Gil, Presidente (E), que "ha procedido a la modificación de la definición del tipo de juego de lotería denominado Rifa, la inclusión del tipo de Juego con Fines Publicitarios y el tipo de Juego con fines Promocionales, así como el establecimiento de las condiciones para su respectiva explotación", con base en los artículos 15, 16.1, 16.4, 16.5, 16.8 y 16.12 de la Ley Nacional de Lotería. — [CONALOT, imagen del aviso, captura 30-03-2024](http://web.archive.org/web/20240330120259/https://pagina.conalot.gob.ve/content/notification/aviso%20oficial%20rifa%20.jpg)
- Ley Nacional de Lotería: CONALOT dice que fue creada por la ley "publicada en la Gaceta Oficial N.º 38.270, el 12 de septiembre de 2005". — [CONALOT, nota de 21.º aniversario, 12-09-2026](http://web.archive.org/web/20261006084229/https://www.conalot.gob.ve/2026/09/comision-nacional-de-loteria-conmemora-21-anos-de-trayectoria-en-la-regulacion-y-el-control-de-la-actividad-de-juegos-de-loteria/); en conflicto con el Aviso Oficial de 2023, que cita la Ley Nacional de Lotería "publicada en Gaceta Oficial No. 38.480 de fecha 17 de julio de 2006" — [CONALOT, aviso 17-10-2023](http://web.archive.org/web/20240330120259/https://pagina.conalot.gob.ve/content/notification/aviso%20oficial%20rifa%20.jpg)
- Comunicado N° 003 de CONALOT (difundido el 20-12-2025): prohíbe promocionar y exhibir premios en moneda extranjera, sorteos de cirugías plásticas o modificaciones estéticas ("rifas de lipos"), uso de menores en publicidad, explotación sexual como persuasión e incitación al alcohol; sanción: suspensión temporal de licencias; lo vigila la "unidad de observatorio de la actividad de lotería"; invoca el "Plan de las 7T", sin citar ley ni Gaceta. — [Diario 2001, 20-12-2025](https://2001online.com/nacionales/se-acaban-los-premios-en-divisas-y-las-rifas-esteticas-sepa-las-nuevas-regulaciones-en-venezuela-2025122013500)
- Otras normas listadas por CONALOT en su marco jurídico (títulos de sus propias entradas): Ley de Impuestos a las Actividades de Juegos de Envite o Azar, G.O. N° 38.698 del 05-06-2007; Ley Orgánica contra la Delincuencia Organizada y Financiamiento al Terrorismo, G.O. N° 39.912 del 30-04-2012; Providencia N° CNL-DP-2016-0029 del 04-04-2016 (legitimación de capitales y financiamiento al terrorismo en loterías), G.O. N° 40.952 del 26-07-2016. — [CONALOT, PDF de la Providencia 0029, captura 11-02-2026](http://web.archive.org/web/20260211065455/https://www.conalot.gob.ve/wp-content/uploads/2026/01/PROVIDENCIA-No-CNLDP2016-0029-LEGITIMACION-DE-CAPITALES-FINANCIAMIENTO-AL-TERRORISMO-EN-LOTERIAS.pdf)
- Providencia SNAT/2009/0102 del 22-10-2009 (G.O. N° 39.290 del 22-10-2009) y Providencia N° 2008-0022 (G.O. N° 39.049 del 31-10-2008) figuran como "entradas relacionadas" en la web de CONALOT; el nombre de archivo de la primera es "PROVIDENCIA-RETENCION-ISLR-PREMIOS-LOTERIA". — [CONALOT, captura 13-04-2026](http://web.archive.org/web/20260413113919/https://www.conalot.gob.ve/2025/03/19/providencia-n-conalot-p-2025-001-de-fecha-02-10-2025/)
- Meridiano describe que las rifas digitales "hasta ahora, operaban en una zona gris legal" antes de las nuevas disposiciones de CONALOT. — [Meridiano, 19-03-2026](https://meridiano.net/farandula/creadores-de-contenido-venezolanos-habrian-sido-detenidos-por-violar-las-leyes-202631911280)

**Inferencias de quien investigó**

- Lo más probable es que G.O. 38.270 (12-09-2005) sea la publicación original de la Ley Nacional de Lotería y G.O. 38.480 (17-07-2006) una reforma o reimpresión; CONALOT usa ambas referencias. No verificado contra el texto de la Gaceta.
- La Providencia 2025-001 parece ser la formalización del cambio anunciado en el Aviso Oficial de octubre de 2023. Es norma sublegal de un ente administrativo; su jerarquía frente a la ley no fue analizada por ninguna fuente consultada.

**Vacíos**

- Texto íntegro y número de Gaceta Oficial de la Providencia CONALOT/P/2025-001: no localizados. Una búsqueda por el código no devolvió ninguna Gaceta.
- Reglamento de la Ley Nacional de Lotería: no confirmé decreto, Gaceta ni fecha.
- Ley para el Control de los Casinos, Salas de Bingo y Máquinas Traganíqueles: sin fuente consultada (ni Gaceta ni vigencia).
- Código Penal (juegos de azar ilegales y estafa): no consulté el texto; no puedo dar artículos ni penas con fuente.
- No pude confirmar si alguna de las normas anteriores a 2023 fue reformada o derogada; todas deben tratarse como posiblemente desactualizadas.

### ¿Quién regula y qué hace cada organismo respecto a rifas?

**Conclusión**

CONALOT (adscrita al ministerio de economía y finanzas) se declara regulador exclusivo de loterías y rifas y lleva el registro RUNLOT; las IOBPAS (loterías estadales) otorgan licencias. En la práctica, las detenciones de 2026 las ejecutaron cuerpos de seguridad (SEBIN, policías estadales), no CONALOT.

**Hallazgos con fuente**

- CONALOT se presenta como "el órgano que regula las actividades de loterías y rifas, ejerciendo de manera exclusiva las labores de inspección", fiscalización, supervisión y control de los Sujetos Obligados; sus inspectores deben portar credencial y pueden recibir apoyo de otros organismos del Estado. — [Focus Gaming News, 21-09-2026](https://focusgn.com/latinoamerica/conalot-reafirma-su-trabajo-de-fiscalizacion-y-regulacion-de-loterias-y-rifas-en-venezuela)
- CONALOT está adscrita al Ministerio de Economía, Finanzas y Comercio Exterior. — [El Diario, 30-01-2026](https://eldiario.com/2026/01/30/conalot-inicio-auditoria-nacional-sistemas-de-rifas/)
- CONALOT exige a los sujetos obligados "inscripción en el RUNLOT, la obtención de licencias emitidas por las IOBPAS y la visibilidad de los reglamentos vigentes". — [CONALOT, 01-10-2026](http://web.archive.org/web/20261008203044/https://www.conalot.gob.ve/2026/10/conalot-despliega-operativo-de-fiscalizacion-en-caracas-y-supervisa-34-centros-de-apuestas/)
- En junio de 2025 CONALOT declaró que las IOBPAS de Zulia, Aragua, Cojedes y Nueva Esparta (13-06-2025) y de Lara, Sucre y Bolívar (16-06-2025) no habían cumplido el registro/renovación exigido por el artículo 2 de la Ley Nacional de Lotería, que la continuidad de sus actividades "carecen de validez legal, constituyendo una explotación ilícita", y dio 30 días para regularizarse. — [CONALOT, comunicado 13-06-2025](http://web.archive.org/web/20251006203605/https://pagina.conalot.gob.ve/content/marcos/COMUNICADO%20CESE%20DE%20IOBPAS.pdf-1.pdf); [CONALOT, comunicado 16-06-2025](http://web.archive.org/web/20251006203555/https://pagina.conalot.gob.ve/content/marcos/COMUNICADO%20LAPSO%20REGULARIZACION.pdf)
- Dirección de CONALOT: Antonio "Potro" Álvarez fue director de septiembre de 2024 a septiembre de 2025 — [La Gran Aldea, 25-03-2026](https://lga.lagranaldea.com/2026/03/25/quienes-son-y-que-pasa-con-los-riferos-en-venezuela/); en abril de 2026 la encabezaba Carlos Carvallo, ex oficial de la Guardia Nacional — [La Gran Aldea, 18-04-2026](https://lagranaldea.com/2026/04/18/en-medio-de-la-tormenta-el-negocio-de-las-rifas-digitales-sigue-viento-en-popa/)
- Los requisitos de CONALOT para rifas incluyen un certificado de SENCAMER. — [CONALOT, planilla Rifa Ocasional, captura 04-01-2026](http://web.archive.org/web/20260104191942/https://www.conalot.gob.ve/wp-content/uploads/2025/11/PLANILLA-DE-RIFA-OCASIONAL.docx)
- Las detenciones de marzo de 2026 se atribuyen al SEBIN; el Ministerio Público aparece en la detención de Maracaibo (Fiscalía 39). — [La Nación, 23-03-2026](https://lanacionweb.com/sucesos/procedimientos-contra-riferos-en-tachira-y-otros-estados/); [El Nacional, 12-07-2026](https://www.elnacional.com/2026/07/detenido-un-hombre-en-maracaibo-por-promover-rifas-ilegales-a-nombre-de-los-damnificados-por-terremotos/)
- (Solo snippet) El presidente de la Lotería del Táchira, Marcos Albarrán, habló de frenar ~60% de la venta fraudulenta de lotería colombiana y de campañas para poner al día a los puntos legales ante CONALOT. — [Focus Gaming News](https://focusgn.com/latinoamerica/el-estado-venezolano-de-tachira-busca-combatir-la-venta-ilegal-de-loteria)
- Contexto político relevante para "octubre 2026": la web de CONALOT publica desde enero de 2026 noticias de la "presidenta (E) Delcy Rodríguez". — [CONALOT, 01-10-2026](http://web.archive.org/web/20261008203044/https://www.conalot.gob.ve/2026/10/conalot-despliega-operativo-de-fiscalizacion-en-caracas-y-supervisa-34-centros-de-apuestas/)

**Inferencias de quien investigó**

- Para un organizador hay dos ventanillas: CONALOT (RUNLOT y autorización) y, según el tipo de juego, una IOBPAS (licencia). Qué tipo de rifa necesita además licencia de IOBPAS no quedó claro en las fuentes.

**Vacíos**

- Comisión Nacional de Casinos, SENIAT y SUNDDE: no encontré ninguna fuente sobre su papel en rifas.
- No hallé un comunicado oficial del Ministerio Público sobre rifas en línea.

### ¿Es legal una rifa privada? Permisos, requisitos, costos, exenciones, promociones

**Conclusión**

Las rifas no están prohibidas pero, según CONALOT y la prensa, sin RUNLOT y sin autorización previa por sorteo son ilegales. Los formularios oficiales están diseñados para sociedades mercantiles, lo que deja en duda que una persona natural (el caso típico del influencer) pueda cumplir. No encontré ninguna exención para rifas pequeñas.

**Hallazgos con fuente**

- El RUNLOT (Registro Único Nacional de Loterías) es obligatorio, "personal e intransferible"; "la falta de este registro convierte la actividad en ilegal"; el número debe aparecer en toda la publicidad. — [La Nación, 20-03-2026](https://lanacionweb.com/nacional/rifas-en-redes-sociales-en-venezuela-conalot-advierte-sobre-requisitos-legales-para-evitar-estafas/)
- Vigencia del RUNLOT: un año. — [Diseño Digital](https://disenodigitalec.com/informativo/todo-sobre-la-nueva-providencia-001-de-conalot-guia-para-realizar-rifas-legales-en-venezuela/)
- (Solo snippet) El RUNLOT no basta: hace falta una "Autorización de Rifa" previa para cada sorteo; vender boletos sin ella es infracción. — [El Aragüeño](https://elaragueno.com.ve/conalot-exige-autorizacion-previa-para-ejecutar-rifas-en-venezuela/)
- Trámites que ofrece CONALOT: Registro de Rifa Ocasional, de Juego de Rifa Permanente, de Rifa Promocional, de Centros de Apuestas, de Comercializadora, de IOBPAS, de Autorización de Programa Informático, de Página Web (Centro de Apuesta Virtual), de Responsable de Programa Informático, de Juego y de Operador de Juego. La tasa se informa por correo mediante "Planilla Única de Pago"; no se publica el monto. — [CONALOT, Solicitudes, captura 14-12-2025](http://web.archive.org/web/20251214073008/https://www.conalot.gob.ve/solicitudes/)
- Recaudos de Rifa Ocasional (10): documento constitutivo registrado; acta de asamblea con representación; relación de accionistas; RIF; título de propiedad o arrendamiento autenticado del inmueble; Reglamento del Juego; certificado SENCAMER; identificación y valor comercial del premio "en moneda de curso legal"; prueba de plena propiedad del premio "sin reserva de dominio" ni gravamen; declaración jurada de origen lícito de fondos. La planilla pide "INFORMACIÓN DE LA SOCIEDAD MERCANTIL" y "MODALIDAD DEL SORTEO". — [CONALOT, planilla Rifa Ocasional](http://web.archive.org/web/20260104191942/https://www.conalot.gob.ve/wp-content/uploads/2025/11/PLANILLA-DE-RIFA-OCASIONAL.docx)
- Recaudos de Rifa Promocional/Publicitaria (8): los societarios, RIF, Reglamento del Juego, certificado SENCAMER, prueba de propiedad y valor del premio. — [CONALOT, planilla Rifa Promocional](http://web.archive.org/web/20260104110859/https://www.conalot.gob.ve/wp-content/uploads/2025/11/PLANILLA-DE-RIFA-PROMOCIONAL.docx)
- Operador de Rifa Permanente: sociedad "cuyo objeto sea exclusivamente la explotación de actividades de envite y azar", estructura y manual antilavado, y oficial de cumplimiento con dedicación exclusiva. — [CONALOT, planilla Operador de Rifa Permanente](http://web.archive.org/web/20260104190059/https://www.conalot.gob.ve/wp-content/uploads/2025/11/PLANILLA-OPERADOR-DE-RIFA-PERMANENTE.docx)
- Límite de cuatro rifas ocasionales al año por persona o empresa; promocionales de 1 a 3 meses; las de fin social deben explicar el destino de los fondos; prohibida la venta a menores; documentos citados para el RUNLOT: cédula o RIF, carta de residencia, pago de tasa, reglamento. — [La Nación, 20-03-2026](https://lanacionweb.com/nacional/rifas-en-redes-sociales-en-venezuela-conalot-advierte-sobre-requisitos-legales-para-evitar-estafas/)
- CONALOT atiende solicitudes de RUNLOT para "entes y personas jurídicas que deseen operar de manera legal". — [CONALOT, 21-10-2025](http://web.archive.org/web/20251214072655/https://www.conalot.gob.ve/2025/10/21/jornada-de-registro-de-sujetos-obligados/)
- Una rifera (Daniela López) dijo haber retirado su Runlot en CONALOT el 23-03-2026 y siguió rifando; el sitio de Brayan Lucena mostraba el Runlot CNL-ORF-2025-000661. — [La Gran Aldea, 25-03-2026](https://lga.lagranaldea.com/2026/03/25/quienes-son-y-que-pasa-con-los-riferos-en-venezuela/)
- Freddy Bernal (gobernador de Táchira, abril 2025): las rifas "pueden hacerlo siempre y cuando estén acorde a ley". — [La Gran Aldea, 25-03-2026](https://lga.lagranaldea.com/2026/03/25/quienes-son-y-que-pasa-con-los-riferos-en-venezuela/)

**Inferencias de quien investigó**

- Conflicto no resuelto: la prensa dice que basta cédula o RIF y carta de residencia (persona natural), pero las planillas oficiales exigen documento constitutivo y accionistas (persona jurídica). Tratar como incierto si una persona natural puede registrarse.
- Tener RUNLOT no evitó problemas: Lucena exhibía un número de Runlot y aun así fue reportado como detenido.

**Vacíos**

- Costo de tasas, fianzas o garantías: no publicado en ninguna fuente consultada.
- Exención para rifas pequeñas, escolares o vecinales: no encontré ninguna. Las "benéficas" son una categoría regulada, no una exención.
- "Combos" y promociones comerciales con premio: solo sé que existe la categoría "Rifa Publicitaria/Promocional" con registro propio; no hallé regla de SUNDDE.

### Aplicación real 2023-2026: detenciones, operativos, advertencias

**Conclusión**

Hubo una ofensiva real en marzo de 2026 contra "riferos" de redes, atribuida al SEBIN y enmarcada públicamente como lavado de dinero, pero casi sin confirmación oficial ni cargos conocidos. Muchos riferos siguieron operando.

**Hallazgos con fuente**

- 16/19-03-2026: se reporta la detención de Brayan Lucena, Yeimmy Rodríguez (más de 4 millones de seguidores, rifas "Lotoyei") y Cruzangelo Pasquale por funcionarios del SEBIN; el padre de Pasquale dijo el 22-03 que su hijo estaba en el SEBIN. Las autoridades no lo confirmaron. — [Meridiano, 19-03-2026](https://meridiano.net/farandula/creadores-de-contenido-venezolanos-habrian-sido-detenidos-por-violar-las-leyes-202631911280); [La Gran Aldea, 25-03-2026](https://lga.lagranaldea.com/2026/03/25/quienes-son-y-que-pasa-con-los-riferos-en-venezuela/)
- 20/21-03-2026: versiones extraoficiales de allanamientos del SEBIN en dos agencias de rifas en Barrio Obrero y Capacho (Táchira), con vehículos retirados en grúas; "Hasta el momento no existe una versión oficial sobre estos procedimientos". — [La Nación, 23-03-2026](https://lanacionweb.com/sucesos/procedimientos-contra-riferos-en-tachira-y-otros-estados/)
- Despliegue del SEBIN en Zulia, Táchira, Portuguesa, Anzoátegui y Distrito Capital; en Maracaibo (operativo "Tus Coches") se mencionan armas, drogas y dólares falsos; en Lechería, flotas de vehículos de alta gama. Sin fuentes oficiales con nombre. — [Noticias Barquisimeto, 23-03-2026](https://www.noticiasbarquisimeto.com/rifas-en-la-mira-venezuela-lanza-fuerte-ofensiva-contra-los-riferos-ilegales/)
- Única declaración oficial identificada: Diosdado Cabello (ministro de Interior y Justicia), 25-03-2026: "Es una lavadora de dinero, dinero sucio". — [La Gran Aldea, 18-04-2026](https://lagranaldea.com/2026/04/18/en-medio-de-la-tormenta-el-negocio-de-las-rifas-digitales-sigue-viento-en-popa/)
- De 35 perfiles de "riferos digitales" monitoreados, al menos la mitad seguía rifando en abril de 2026; "de forma extraoficial" se habla de hasta 180 detenidos (cifra no verificada). — [La Gran Aldea, 18-04-2026](https://lagranaldea.com/2026/04/18/en-medio-de-la-tormenta-el-negocio-de-las-rifas-digitales-sigue-viento-en-popa/)
- 12-07-2026, Maracaibo: detenido Gustavo Adolfo Márquez Márquez (52) por la policía del Zulia tras ciberpatrullaje; promovía en Instagram la "Rifa El Quinto Sueño Mundial" con premios en divisas; "no contaba con la autorización de la Comisión Nacional de Loterías (Conalot)"; a la orden de la Fiscalía 39 del Ministerio Público. El artículo no cita ley. — [El Nacional, 12-07-2026](https://www.elnacional.com/2026/07/detenido-un-hombre-en-maracaibo-por-promover-rifas-ilegales-a-nombre-de-los-damnificados-por-terremotos/)
- 29-01-2026: CONALOT anunció un operativo nacional de fiscalización de operadores de rifas, físicos y digitales; su Unidad de Observatorio revisa redes sociales. — [El Diario, 30-01-2026](https://eldiario.com/2026/01/30/conalot-inicio-auditoria-nacional-sistemas-de-rifas/)
- 14 al 18-09-2026, Carabobo: 52 centros de apuestas recorridos, 16 clausurados (6 reabiertos), 16 sujetos obligados fiscalizados en antilavado, 11 nuevos registros. — [CONALOT, 26-09-2026](http://web.archive.org/web/20261006083928/https://www.conalot.gob.ve/2026/09/conalot-consolida-la-transparencia-y-el-renacer-economico-del-sector-lotero-desde-el-estado-carabobo/)
- 01-10-2026, Caracas: 34 centros de apuestas inspeccionados, 5 en regla, 29 sin RUNLOT, 9 cierres, 3 reaperturas. — [CONALOT, 01-10-2026](http://web.archive.org/web/20261008203044/https://www.conalot.gob.ve/2026/10/conalot-despliega-operativo-de-fiscalizacion-en-caracas-y-supervisa-34-centros-de-apuestas/)
- (Solo titular) Abril de 2025, Lara: una mujer detenida por estafar organizando rifas y colectas. — [El Diario, 15-04-2025](https://eldiario.com/2025/04/15/detuvieron-mujer-por-estafar-organizando-rifas-colectas-lara)
- (Solo snippet) Táchira: un influencer dedicado a rifas binacionales fue detenido en la frontera, según Marcos Albarrán. — [Focus Gaming News](https://focusgn.com/latinoamerica/el-estado-venezolano-de-tachira-busca-combatir-la-venta-ilegal-de-loteria)

**Inferencias de quien investigó**

- El riesgo observado no es una multa administrativa sino detención por cuerpos de inteligencia con narrativa de legitimación de capitales, sin debido proceso visible.
- Las inspecciones documentadas por CONALOT en septiembre-octubre de 2026 son a centros de apuestas físicos, no a rifas en línea.

**Vacíos**

- Cargos formales, imputaciones o sentencias contra los riferos de marzo de 2026: no encontrados. Tampoco su situación actual.
- No encontré casos de 2023 ni de 2024.
- No hallé cierres de cuentas de Instagram/TikTok ordenados por autoridad.

### ¿Existen operadores o plataformas de rifas autorizados?

**Conclusión**

Sí: CONALOT publica una lista de "Empresas Homologadas para Rifas" que al 06-10-2026 tenía solo tres empresas. No encontré qué tuvieron que hacer para ser homologadas más allá de los recaudos de los formularios.

**Hallazgos con fuente**

- Lista al 06-10-2026: IMNOVAGAMES.COM, C.A. (J-50817179-9); SEVEN HILL'S SISTEMAS, C.A. (SEVENLOT) (J-30466401-0); GLOBAL TECH 11-11, C.A. (SUR) (J-50708099-4). — [CONALOT, Empresas Autorizadas, captura 06-10-2026](http://web.archive.org/web/20261006083911/https://www.conalot.gob.ve/empresas-autorizadas/)
- Al 13-04-2026 la lista tenía dos: INNOVA GAMES y SEVEN HILL'S SISTEMAS, C.A. (SEVENLOT). — [CONALOT, captura 13-04-2026](http://web.archive.org/web/20260413104437/https://www.conalot.gob.ve/empresas-autorizadas/)
- Los vendedores "deben operar en plataformas autorizadas" y con contratos directos. — [La Nación, 20-03-2026](https://lanacionweb.com/nacional/rifas-en-redes-sociales-en-venezuela-conalot-advierte-sobre-requisitos-legales-para-evitar-estafas/)
- CONALOT opera el sistema SITCON (app.conalot.gob.ve) y un portal de denuncias (denuncias.conalot.gob.ve). — [CONALOT, captura 06-10-2026](http://web.archive.org/web/20261006083911/https://www.conalot.gob.ve/empresas-autorizadas/)

**Inferencias de quien investigó**

- Que solo haya tres empresas homologadas un año después de la Providencia indica una barrera de entrada alta o un proceso lento/discrecional.

**Vacíos**

- Proceso, plazos y costo de la homologación: no documentados. No sé si las tres empresas son proveedores de software, operadores de rifas, o ambos.

### Impuestos sobre rifas y premios

**Conclusión**

Lo único documentado es un pago de 7% a CONALOT por cada rifa, con fuentes que discrepan sobre la base de cálculo. No obtuve fuentes sobre ISLR, impuesto especial de juegos ni impuestos municipales.

**Hallazgos con fuente**

- 7% de la venta de boletos de cada sorteo a CONALOT. — [La Gran Aldea, 25-03-2026](https://lga.lagranaldea.com/2026/03/25/quienes-son-y-que-pasa-con-los-riferos-en-venezuela/)
- 7% "de sus ingresos", pagado por el portal digital de CONALOT. — [La Nación, 20-03-2026](https://lanacionweb.com/nacional/rifas-en-redes-sociales-en-venezuela-conalot-advierte-sobre-requisitos-legales-para-evitar-estafas/); contradicho en la base por [Diseño Digital](https://disenodigitalec.com/informativo/todo-sobre-la-nueva-providencia-001-de-conalot-guia-para-realizar-rifas-legales-en-venezuela/), que habla de pago previo "fijada inicialmente en un 7% del valor total de los boletos emitidos".
- Los operadores que no paguen los impuestos que les correspondan se exponen a multas o suspensión del permiso; las multas se calculan a la tasa oficial del BCV según la Ley Nacional de Lotería. — [El Diario, 30-01-2026](https://eldiario.com/2026/01/30/conalot-inicio-auditoria-nacional-sistemas-de-rifas/); [La Nación, 20-03-2026](https://lanacionweb.com/nacional/rifas-en-redes-sociales-en-venezuela-conalot-advierte-sobre-requisitos-legales-para-evitar-estafas/)
- Existe una providencia del SENIAT sobre retención de ISLR en premios de lotería (SNAT/2009/0102, G.O. 39.290 del 22-10-2009). — [CONALOT, captura 13-04-2026](http://web.archive.org/web/20260413113919/https://www.conalot.gob.ve/2025/03/19/providencia-n-conalot-p-2025-001-de-fecha-02-10-2025/)

**Inferencias de quien investigó**

- La diferencia entre 7% sobre boletos emitidos (pago previo, se venda o no) y 7% sobre lo vendido cambia mucho la economía de una rifa; hay que confirmarlo en el texto de la Providencia.

**Vacíos**

- Tarifa de ISLR a ganancias fortuitas, quién retiene, alícuotas de la Ley de Impuesto a las Actividades de Juegos de Envite o Azar e impuestos municipales: sin fuente consultada.

### Responsabilidad del proveedor de tecnología

**Conclusión**

El software de rifas es en sí un objeto regulado: CONALOT exige registrar y autorizar el "Programa Informático", a su "Responsable" y la página web donde se vende. No encontré ningún precedente de un proveedor de software sancionado o detenido, ni análisis de firmas de abogados.

**Hallazgos con fuente**

- Autorización de Programa Informático: RIF del propietario; manual con lenguaje, versión y gestor de base de datos; "presentar a la vista las fuentes del software a fin de certificar la lógica de programación" (CONALOT ofrece confidencialidad); descripción de módulos; seguridad por roles; para sorteos, algoritmo aleatorio y pruebas de aleatoriedad; URL/IP y usuario de prueba; certificado de marca del SAPI; ubicación del hosting. — [CONALOT, planilla Programa Informático, captura 04-01-2026](http://web.archive.org/web/20260104034557/http://www.conalot.gob.ve/wp-content/uploads/2025/11/PLANILLA-PROGRAMA-INFORMATICO.docx)
- Responsable de Programa Informático: sociedad propietaria del software "cuyo objeto sea exclusivamente la explotación de actividades de envite y azar", estructura y manual antilavado, oficial de cumplimiento con dedicación exclusiva, relación de juegos comercializados y marca SAPI. — [CONALOT, planilla Responsable de Programa Informático](http://web.archive.org/web/20260104015223/https://www.conalot.gob.ve/wp-content/uploads/2025/11/PLANILLA-RESPONSABLE-DE-PROGRAMA-INFORMATICO.docx)
- Registro de Página Web (Centro de Apuesta Virtual): pide dominio y "ubicación de los servidores en los cuales se desarrollan las actividades de la página web". — [CONALOT, planilla Página Web](http://web.archive.org/web/20260105074647/https://www.conalot.gob.ve/wp-content/uploads/2025/11/PLANILLA-PAGINA-WEB.docx)
- Para que un operador sea legal, las plataformas digitales deben tener "sistemas de trazabilidad total". — [El Diario, 30-01-2026](https://eldiario.com/2026/01/30/conalot-inicio-auditoria-nacional-sistemas-de-rifas/)
- Las comercializadoras deben entregar copia del contrato con la sociedad dueña del software de comercialización. — [CONALOT, planilla Comercializadora](http://web.archive.org/web/20260104112627/https://www.conalot.gob.ve/wp-content/uploads/2025/11/PLANILLA-COMERCIALIZADORA.docx)
- Opiniones de abogados halladas (generales, no sobre software): Lorena Rojas, "el desconocimiento no te exime de la responsabilidad ni de las consecuencias" — [Noticias Barquisimeto, 23-03-2026](https://www.noticiasbarquisimeto.com/rifas-en-la-mira-venezuela-lanza-fuerte-ofensiva-contra-los-riferos-ilegales/); Tamara Adrián, sobre el juego como vía de lavado — [La Gran Aldea, 25-03-2026](https://lga.lagranaldea.com/2026/03/25/quienes-son-y-que-pasa-con-los-riferos-en-venezuela/)
- Ninguna de las notas sobre la ofensiva de marzo-abril de 2026 menciona a proveedores de software como objetivo. — [La Gran Aldea, 18-04-2026](https://lagranaldea.com/2026/04/18/en-medio-de-la-tormenta-el-negocio-de-las-rifas-digitales-sigue-viento-en-popa/)

**Inferencias de quien investigó**

- Un SaaS que aloja las páginas públicas de venta de números encaja en lo que CONALOT llama "programa informático" y "página web (centro de apuesta virtual)". Que no toque el dinero ni elija ganadores no aparece como criterio de exclusión en ninguna fuente.
- El requisito de objeto social exclusivo en envite y azar es difícil de cumplir para una empresa de software general, y la exigencia de mostrar el código fuente y declarar la ubicación de servidores afecta a un SaaS alojado fuera del país.
- Si los organizadores clientes carecen de RUNLOT, el proveedor quedaría facilitando una actividad que la autoridad califica de ilegal y asocia a lavado; no hay fuente que diga cómo se trataría penalmente.

**Vacíos**

- Precedente venezolano contra un proveedor de software: ninguno encontrado.
- Comentario de firmas (Baker McKenzie, D'Empaire, Araquereyna, Dentons, LEĜA, Badell & Grau, Acceso a la Justicia): no llegué a buscarlo.
- No sé si un proveedor extranjero sin presencia en Venezuela queda alcanzado, ni si la homologación la pide el proveedor o cada organizador.

### ¿Está regulado usar el resultado de una lotería oficial para decidir una rifa privada?

**Conclusión**

No encontré ninguna norma que lo prohíba o lo regule expresamente. El método de adjudicación debe declararse en el Reglamento del Juego que aprueba CONALOT.

**Hallazgos con fuente**

- La solicitud de rifa exige declarar la "MODALIDAD DEL SORTEO" y presentar el Reglamento del Juego y un certificado SENCAMER. — [CONALOT, planilla Rifa Ocasional](http://web.archive.org/web/20260104191942/https://www.conalot.gob.ve/wp-content/uploads/2025/11/PLANILLA-DE-RIFA-OCASIONAL.docx)
- El Reglamento de Juego debe especificar premios, fechas de venta y método de adjudicación. — [Diseño Digital](https://disenodigitalec.com/informativo/todo-sobre-la-nueva-providencia-001-de-conalot-guia-para-realizar-rifas-legales-en-venezuela/)
- El sitio de Brayan Lucena mostraba su Runlot junto a los logos de la Lotería del Táchira y de CONALOT. — [La Gran Aldea, 25-03-2026](https://lga.lagranaldea.com/2026/03/25/quienes-son-y-que-pasa-con-los-riferos-en-venezuela/)
- Un proveedor comercial cita Triple Táchira como fuente de resultados y dice que las IOBPAS otorgan autorizaciones y licencias para sorteos. — [Diseño Digital](https://disenodigitalec.com/informativo/guia-legal-para-sistemas-de-rifas-en-venezuela-permisos-requisitos-y-como-evitar-sanciones/)

**Inferencias de quien investigó**

- Decidir con un sorteo oficial evita tener que certificar un algoritmo aleatorio propio, pero no sustituye el registro ni la autorización de la rifa.

**Vacíos**

- Si usar la marca o los resultados de una lotería estadal requiere su permiso o un convenio: sin fuente.

### Contraste breve: Colombia, México, Perú

**Conclusión**

Solo obtuve datos de Colombia, donde Coljuegos persigue activamente a influencers que hacen rifas sin autorización. De México y Perú no consulté fuentes.

**Hallazgos con fuente**

- Colombia: Coljuegos abrió 35 procesos sancionatorios contra influencers y empresas por rifas en redes sin autorización. — [Focus Gaming News](https://focusgn.com/latinoamerica/lucha-contra-el-juego-ilegal-coljuegos-investiga-a-influencers-y-empresas)
- Colombia: Coljuegos sometió a consulta pública un proyecto de requerimientos técnicos para la operación de rifas (julio de 2025). — [Yogonet, 25-07-2025](https://www.yogonet.com/latinoamerica/noticias/2025/07/25/105124-coljuegos-somete-a-consulta-publica-el-proyecto-de-requerimientos-tecnicos-para-la-operacion-de-rifas)
- Colombia: Javier Arias, "el rey de las rifas", fue detenido en 2025 por porte ilegal de armas y presunto lavado para el Clan del Golfo; quedó libre y volvió a rifar. — [La Gran Aldea, 18-04-2026](https://lagranaldea.com/2026/04/18/en-medio-de-la-tormenta-el-negocio-de-las-rifas-digitales-sigue-viento-en-popa/)

**Inferencias de quien investigó**

- Colombia y Venezuela convergen en dos puntos: autorización previa obligatoria y regulación técnica del software de rifas.

**Vacíos**

- México (SEGOB) y Perú: sin fuentes. Tratamiento del software de rifas en los tres países: sin fuentes.

## 6. Competencia

Qué puede usar hoy un organizador venezolano, cuánto cuesta y dónde se queda corto.

### ¿Qué productos existen específicamente para rifas venezolanas?

**Conclusión**

Sí existe oferta dirigida a Venezuela, pero es joven, pequeña y muy volátil: de ~12 productos detectados, solo 3-4 son verificables y operativos hoy (VendeTuRifa/Boletos Ya, RifaPlus de Arcadys Web, Srapido y los regionales Simple Rifa, Laooz y Rifarito que hacen marketing hacia Venezuela); el resto son dominios caídos, suspendidos, aparcados o re-registrados por terceros. No se encontró ningún SaaS venezolano consolidado con precio público, autoservicio y tracción demostrable.

**Hallazgos con fuente**

**Operativos y verificados (13-10-2026)**
- **VendeTuRifa / "Boletos Ya"** (Desoftsis, contacto 0424-345-4032, desoftsis@gmail.com): SaaS con mapa de boletos en tiempo real, "conexión directa" con Banco Mercantil para detectar pagos móviles automáticamente, "Modo Manual" para aprobar pagos de otros bancos, sorteo interno o carga manual del número ganador de lotería (Triple Táchira, Zulia), hosting incluido. Licencia de **pago único** en "Oferta de Lanzamiento", pero **el precio no se muestra** (campos "$--"). Cobra su licencia por Pago Móvil (Bs. a tasa del día), PayPal, Zelle. Sin clientes ni testimonios publicados; usa dominio de demo `.vercel.app`. — [vendeturifa.com](https://vendeturifa.com/)
- El dominio vendeturifa.com fue registrado el 21-02-2026 (producto con ~8 meses). — [RDAP Verisign](https://rdap.verisign.com/com/v1/domain/vendeturifa.com)
- **RifaPlus ("Ecosistema RifaPlus")** de **Arcadys Web**, agencia venezolana (WhatsApp +58 424-3677450, Instagram @arcadysweb): selección visual de números, búsqueda de tickets por cédula/teléfono, ranking "Top Compradores", multi-rifa, historial público de sorteos; pagos Zelle, Binance, Pago Móvil y PayPal. **Sin precios publicados**; demo solo por WhatsApp. Clientes citados: Rifas El Javi (rifaseljavi.com) y Juega con Juan (juegaconjuan.rifaplusapp.com, "multi-tenant"). Artículo del 05-06-2026. — [Arcadys Web](https://arcadysweb.com/blog/como-hacer-rifa-online-venezuela/)
- Inquilino real de RifaPlus funcionando: JuegaConJuan vende una moto CFMOTO NK 300 a US$12,50/ticket (paquetes 2×$25, 3×$35, 5×$55, 10×$100), sortea por Triple Táchira "A" 10:10 pm, tiene "Buscar Tickets" por cédula, soporte +58 414-7008440 y pie "Desarrollado por Arcadys Web"; lleva al menos 12 rifas creadas (IDs hasta 12) y 9 cerradas. — [juegaconjuan.rifaplusapp.com](https://juegaconjuan.rifaplusapp.com/)
- El sitio matriz rifaplusapp.com sigue mostrando "Próximamente — 75% completado" (© 2024): no hay registro autoservicio. — [rifaplusapp.com](https://rifaplusapp.com/)
- El otro cliente citado, rifaseljavi.com, muestra en producción marcadores de conflicto de git sin resolver ("<<<<<<< HEAD … >>>>>>> pre-main") y el texto "¡Hola Rifas los Hermanos!", señal de despliegues por copia y poca QA. — [rifaseljavi.com](https://rifaseljavi.com/)
- **Srapido** ("El Marketplace de Rifas más grande de Venezuela", Mérida, WhatsApp +58 412-2389852): directorio/marketplace que lista rifas de agencias y enlaza a sus sitios propios (ej. botón "Comprar" de "Adriana Rifas • Maracaibo", Toyota Fortuner, 10.000 tickets a $5, enlaza a rifasvalera.com). Declara "+500 rifas activas", "50+ agencias", "10 estados", pero las categorías suman 193; no publica comisiones ni proceso de verificación; el pie usa otra marca ("RifasPro", contacto@rifaspro.com) y los enlaces legales apuntan a "#". — [srapido.com](https://srapido.com/)

**Regionales que hacen marketing explícito hacia Venezuela** (detalle en sección 2 y 3)
- **Simple Rifa** (Marketeros Expertos S.A.C., Lima, Perú) publica una guía "Sistema de Rifas Venezuela 2026" y lista Pago Móvil, Zelle y Binance Pay como métodos configurables. — [Simple Rifa](https://simplerifa.com/); [guía Venezuela](https://simplerifa.com/blog/sistema-de-rifas-venezuela-plataforma-acepta-dolares-pagos-locales)
- **Laooz Studios** (WhatsApp +57, Colombia) tiene varios artículos "rifas en Venezuela" y ofrece pago móvil, transferencia, Zelle y Binance directos al organizador. — [Laooz Venezuela](https://laooz.com/blog/sistema-de-rifas/sistema-de-rifas-online-venezuela-100-numeros/)
- **Rifarito** declara operar en 14 países incluida Venezuela. — [Rifarito](https://www.rifarito.com/)

**Desaparecidos, suspendidos o NO VERIFICADOS (dato relevante: alta mortalidad)**
- **Paga Tu Rifa** (pagaturifa.com, atribuido a "Will AI", con subdominio juega.pagaturifa.com basado en Mérida): el sitio responde hoy HTTP 503 con una página en chino de "sitio en construcción". El dominio fue re-registrado el 15-04-2026 en el registrador Gname, lo que sugiere que el producto original caducó. Según el fragmento del buscador (NO VERIFICADO), se vendía como pago único o suscripción "según lo acordado", sin comisión, soporte gratis el primer mes y luego mensualidad "personalizada", con actualización manual de la tasa VES/USD y validación por hash de Binance Pay. — [pagaturifa.com](https://pagaturifa.com/); [RDAP](https://rdap.verisign.com/com/v1/domain/pagaturifa.com)
- **"Sistema de Rifas Premium" (sistemaderifasmaracay.com)**: dominio registrado el 29-09-2025 y hoy en estado **"client hold"** (suspendido por el registrador OVH), no resuelve. Según el fragmento del buscador (NO VERIFICADO): US$350 de puesta en marcha (pago único) + US$30/mes de gestión obligatoria, US$100 por adelantado, entrega en <12 h, alertas por Telegram por cada venta, correos automáticos, "validación masiva de pagos por código único". — [RDAP](https://rdap.verisign.com/com/v1/domain/sistemaderifasmaracay.com); [URL original](https://www.sistemaderifasmaracay.com/)
- **YeaZ Rifas (yeazrifas.com)**: el dominio **no figura registrado** hoy (sin registro RDAP, NXDOMAIN). Según el fragmento del buscador (NO VERIFICADO): instalación US$150 pago único + mantenimiento US$30/mes o US$240/año (VPS, gateway de WhatsApp y dominio .com), notificaciones automáticas por WhatsApp, validación de Pago Móvil/Zelle/Binance. — [URL original](https://yeazrifas.com/); [RDAP](https://rdap.verisign.com/com/v1/domain/yeazrifas.com)
- **Mi Rifa Online (mirifaonline.com)**: hoy es un dominio aparcado ("This domain may be for sale"). — [mirifaonline.com](https://mirifaonline.com/inicio/)
- **RifasVE (rifasve.com, subdominios por organizador, "Plataforma #1 en rifas y sorteos en Venezuela")**, **RifaVe (rifasve.shop)** y **Sorteo Venezuela (sorteove.com)**: aparecen en el índice del buscador pero los dominios no están registrados/no resuelven hoy. NO VERIFICADOS. — [RDAP rifasve.com](https://rdap.verisign.com/com/v1/domain/rifasve.com); [RDAP sorteove.com](https://rdap.verisign.com/com/v1/domain/sorteove.com)
- **MercadoLibre Venezuela**: el buscador devolvió un anuncio "Página Web Para Rifas Administrable" por US$50; el listado no pudo abrirse (HTTP 403 / verificación de cuenta). NO VERIFICADO. — [MercadoLibre VE](https://listado.mercadolibre.com.ve/rifas)

**Scripts, plantillas y código abierto**
- CodeCanyon ("raffle"): 12 ítems relevantes, todos genéricos de lotería/competencias en inglés, ninguno menciona español, LatAm ni pago manual con comprobante. Ej.: RaffleLab (ViserLab, Laravel) US$99 y 141 ventas; LottoLab US$79 y 375 ventas; WooCommerce Lottery (wpgenie) US$69 y 4,3 mil ventas; RaffleFlow "con WhatsApp" US$12 y 4 ventas. — [CodeCanyon](https://codecanyon.net/search/raffle)
- GitHub (topic "rifas"): 7 repos, casi todos brasileños o juguetes; el mayor es valdeirpsr/psr-rifas (Laravel, 21 estrellas). Ninguno menciona Venezuela, pago móvil ni comprobantes. — [GitHub topics](https://github.com/topics/rifas)

**Inferencias de quien investigó**

- El segmento venezolano es mayormente **informal y de "instalaciones" hechas por agencias/freelancers**, no de SaaS: los proveedores locales venden implementación + mensualidad de mantenimiento, sin registro autoservicio ni precios públicos estables.
- La mortalidad es altísima: de 9 marcas con foco Venezuela detectadas, al menos 6 tienen el dominio caído, suspendido, aparcado o re-registrado en octubre de 2026. Coincide en el tiempo con la ofensiva regulatoria y policial de marzo de 2026 contra "riferos" (sección 4), aunque no hay evidencia directa de causalidad.
- No hay un líder claro ni marca reconocida: el espacio "SaaS de rifas hecho para Venezuela, con precio público" está vacío hoy.

**Vacíos**

- No se pudo revisar vendedores de "sistema de rifas" en Instagram/TikTok/Facebook, ni Hotmart, ni bots de Telegram/WhatsApp (la única búsqueda de bots no arrojó nada venezolano). Es probable que ahí esté buena parte de la oferta informal.
- Los precios de YeaZ, Sistema de Rifas Premium, Paga Tu Rifa y el anuncio de MercadoLibre provienen solo del fragmento del buscador y no pudieron comprobarse en la fuente.
- No se pudo confirmar por qué desaparecieron esos dominios.

### Ficha por producto y tabla comparativa (precios, funciones, tracción)

**Conclusión**

Los precios verificables para un organizador venezolano van de **US$0 a ~US$400 al año** en SaaS regionales (Simple Rifa US$150-400/año; Rifas Blu ≈ COP 190.000-490.000 por rifa; RifaBase desde US$24/mes) y de **US$150-450 de instalación + ~US$30/mes** en instalaciones tipo agencia. Ningún producto verificado combina verificación automática multibanco de Pago Móvil, tasa BCV automática y WhatsApp.

**Hallazgos con fuente**

**Tabla comparativa (observado 13-10-2026; "n/p" = no publicado; "NV" = no verificado, solo fragmento de buscador)**

| Producto | País / quién | Modelo y precio | Comisión | Elegir nº / azar | Subir comprobante | Verificación automática de pago | WhatsApp | Verificador de tickets | Multi-rifa | Vendedores | Dominio propio | Sorteo | Tracción declarada | Estado |
|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|
| VendeTuRifa / Boletos Ya | Venezuela, Desoftsis | Licencia pago único, precio n/p | n/p | Mapa de boletos | Referencia/recibo | Solo Banco Mercantil; resto manual | Solo enlace de venta | n/p | n/p | n/p | n/p | Interno o lotería (Táchira, Zulia) | Ninguna | Activo, dominio de feb-2026 |
| RifaPlus | Venezuela, Arcadys Web | n/p (cotización por WhatsApp) | n/p | Sí / sí | Sí + nº de referencia | No | No | Sí (por cédula) | Sí | n/p | Sí (rifaseljavi.com) o subdominio | Manual por Triple Táchira | 2 clientes nombrados | Activo; matriz "Próximamente" |
| Srapido | Venezuela (Mérida) | Marketplace/directorio, precio n/p | n/p | En sitio del organizador | — | — | — | — | — | — | — | — | "+500 rifas, 50+ agencias" (inconsistente) | Activo |
| Simple Rifa | Perú, Marketeros Expertos S.A.C. | Anual: Básico US$150, Pro US$400; demo 7 días | 0% | Sí / sí | Sí ("verificación de comprobantes") | No | n/p | n/p | Solo Pro (Básico: 1) | "Ventas manuales (promotores)" | Sí, .com incluido | Lotería, aleatorio, ruleta | "100+ clientes", 9 países; +80 sitios listados | Activo, dominio de mar-2026 |
| Laooz Studios | Colombia (+57) | Web: US$250 / 750 / 1.500 por sorteo, o modo comisión 10% / 5% / 2%. Blog 26-05-2026: US$29 / 89 / 199 pago único | 0% o 2-10% | Sí / sí | n/p | Con pasarela (~5%); manual si no | "Próximamente" | Sí (correo o teléfono) | Sí | Plan Profesional | Sí | Algoritmo o lotería | "+US$18M procesados", "480 rifas" | Activo desde 2017 |
| Rifarito | n/p (LatAm, 14 países) | Basic / Premium "consulta el precio vigente". Blog Laooz: desde US$19 por rifa; fragmento buscador: US$15 y desde US$34 por rifa | 0% | Sí | Sí (ambos planes) | Solo Premium vía Mercado Pago, PayU, Wompi (no disponibles en Venezuela) | Solo soporte | Sí, público | n/p | Premium | Basic subdominio / Premium propio | Sorteador | Sin cifras; 1 testimonio | Activo, dominio de 2020 |
| Rifas Blu | Colombia (+57) | Por rifa: Gratis ≤100 tickets; COP 190.000 (1.000); COP 490.000 (10.000); COP 2.450.000 (100.000) | 0% | Sí / sí | Sí | No | Pedidos por WhatsApp | Sí | 1 en Gratis | Equipo | Growth+ | Aleatorio | 4 rifas visibles | Activo, dominio de sep-2026 |
| RifaBase | México/LatAm | 100 créditos gratis (1 crédito = 1 boleto); planes desde US$24/mes; paquetes únicos desde US$100; marca blanca en plan tope (US$199/mes según buscador) | 0% | Sí | Transferencia | Stripe, Mercado Pago, Wompi, PayPal | n/p | n/p | Sí | n/p | Plan Premium | Tómbola | Testimonios con fotos de banco de imágenes | Activo, dominio de mar-2025 |
| Paga Tu Rifa (NV) | Venezuela, "Will AI" | Pago único o suscripción acordada; mensualidad de soporte "personalizada" | 0% | — | — | Hash de Binance Pay | — | — | — | — | — | — | — | Caído (dominio re-registrado abr-2026) |
| Sistema de Rifas Premium, Maracay (NV) | Venezuela | US$350 único + US$30/mes obligatorio | — | — | — | "Validación masiva por código único" | Alertas por Telegram | — | — | — | — | — | — | Dominio suspendido (client hold) |
| YeaZ Rifas (NV) | Venezuela | US$150 instalación + US$30/mes o US$240/año | — | — | — | Declarada (Pago Móvil, Zelle, Binance) | Sí, gateway propio | — | — | — | .com incluido | — | — | Dominio no registrado |

**Detalle por producto**
- **Simple Rifa**: planes anuales Básico US$150 (hasta 10.000 tickets por sorteo, 3 premios, dominio .com, métodos de pago ilimitados, correos automáticos) y Pro US$400 (sorteos simultáneos ilimitados, hasta 1.000.000 de tickets, ruleta, píxeles Meta/TikTok/GA4, SMTP propio); cupón HALLOWEN -10% / -20% hasta 31-10-2026; 0% comisión; al vencer queda en solo lectura; entrega el mismo día. La página es inconsistente en el número de clientes ("100+", "+100", "88+") y en si el Básico permite 1 sorteo o ilimitados. — [simplerifa.com](https://simplerifa.com/)
- Simple Rifa muestra además precios distintos en su calculadora (US$100 y US$250) frente a US$149,99 y US$399,99 en el blog; no explica la discrepancia. No menciona tasa BCV automática (solo recomienda "usar el BCV como referencia"). Un testimonio propio admite que el cliente "no logró vender de forma digital y vendió manualmente". Cliente nombrado: Rifas Las Guaras. — [guía Venezuela](https://simplerifa.com/blog/sistema-de-rifas-venezuela-plataforma-acepta-dolares-pagos-locales); [pagos en dólares](https://www.simplerifa.com/blog/pagos-dolares-rifas-venezuela)
- El dominio simplerifa.com se registró el 01-03-2026, lo que contrasta con "100+ clientes en 9 países". — [RDAP](https://rdap.verisign.com/com/v1/domain/simplerifa.com)
- **Laooz Studios**: la página comercial publica US$250 / 750 / 1.500 por sorteo (2.000 / 10.000 / ilimitados números) o "modo gratis" con 10% / 5% / 2% de lo recaudado; dice que hoy **no acepta rifas gratis** por alta demanda y deriva a Rifas Blu; programa solidario gratis para ONG; demo en demorifas.laooz.com. Sus 10 testimonios (uno por país, incluido "LuckyHome VE, Caracas") no son verificables. — [Laooz sistema de rifas](https://laooz.com/sistema-de-rifas/)
- El propio blog de Laooz (26-05-2026) da otros precios: Básico US$29, Profesional US$89, Empresarial US$199, pago único sin mensualidad, con renovación anual de hosting y dominio en el Empresarial. **Conflicto de fuentes del mismo proveedor.** — [Laooz blog 2026](https://laooz.com/blog/los-mejores-sistemas-para-de-rifas-en-este-2026/)
- Laooz para Venezuela: pagos directos al organizador (pago móvil, transferencia, Zelle, Binance), aprobación manual o pasarela con ~5% por transacción, correo automático de confirmación, WhatsApp automatizado "Próximamente", sin mención a tasa BCV (artículo del 11-10-2025). — [Laooz Venezuela](https://laooz.com/blog/sistema-de-rifas/sistema-de-rifas-online-venezuela-100-numeros/)
- **Rifarito**: lema "Pagas por la herramienta, no por vender"; 0% comisión; Basic incluye landing, verificador público, sorteador y carga de comprobante con 1 administrador; Premium agrega pasarela automática con webhook (Mercado Pago, PayU, Wompi), vendedores, descuentos y múltiples administradores; hoy no publica montos. — [Rifarito precios](https://www.rifarito.com/precios/)
- Rifarito según un competidor: desde US$19 por rifa, tope de 9.999 tickets, cambios avanzados hay que pedirlos al equipo, soporte solo por correo. — [Laooz blog 2026](https://laooz.com/blog/los-mejores-sistemas-para-de-rifas-en-este-2026/)
- **Rifas Blu**: 0% comisión, dinero directo al organizador, transferencia o WhatsApp, plan gratis hasta 100 tickets sin vencimiento. — [rifasblu.com](https://rifasblu.com/)
- **RifaBase**: "Puedes empezar gratis con 100 créditos… planes desde $24 USD/mes o paquetes de pago único desde $100 USD"; cobros con Stripe, Mercado Pago, Wompi, transferencia; sus testimonios usan retratos de randomuser.me (no son clientes reales verificables). — [rifabase.com](https://rifabase.com/)
- Fechas de registro de dominios como indicador de antigüedad: laooz.com 2017, rifarito.com 2020, srapido.com 2024, rifabase.com 2025, rifaplusapp.com sep-2025, vendeturifa.com feb-2026, simplerifa.com mar-2026, rifasblu.com sep-2026. — [RDAP Verisign](https://rdap.verisign.com/com/v1/domain/rifarito.com)

**Inferencias de quien investigó**

- **Ancla de precio para Venezuela**: un organizador informado hoy puede obtener página propia, dominio y comprobantes por ~US$150/año (Simple Rifa) o gratis hasta 100 tickets (Rifas Blu). Las instalaciones locales rondaban US$150-350 + US$30/mes (no verificado). Un entrante que cobre más de ~US$30/mes necesita justificarlo con algo que nadie da: verificación automática de pagos venezolanos, tasa BCV y confianza.
- Las cifras de tracción de los proveedores son poco creíbles (dominios de meses con "100+ clientes", contadores inconsistentes, testimonios de banco de imágenes). Publicar clientes reales y verificables sería en sí un diferenciador.
- El cobro **por rifa** o **anual** domina sobre la mensualidad; encaja con que el organizador típico hace rifas ocasionales.

**Vacíos**

- No se obtuvo ningún precio de VendeTuRifa ni de RifaPlus (los dos únicos productos venezolanos verificados y activos); habría que pedir cotización por WhatsApp.
- No se pudo verificar número real de clientes de ningún proveedor.
- No se revisaron las demos (demo.simplerifa.com, demorifas.laooz.com, demo de VendeTuRifa) por límite de tiempo.

### ¿Qué plataformas de LatAm o globales podrían usarse desde Venezuela o entrar?

**Conclusión**

Las plataformas hispanas de "pago directo al organizador con comprobante" (México, Colombia, Perú) ya son utilizables desde Venezuela porque no procesan dinero; las brasileñas y las de EE. UU./Canadá/Reino Unido dependen de Pix, Stripe/PayPal o estatus de ONG y en la práctica no sirven a un rifero venezolano.

**Hallazgos con fuente**

**México**
- **Rifas MX (rfs.mx)**: Gratis (1.000 boletos, 1 rifa, no vence), Básico MXN 499/mes o 2.999/año (10.000 boletos), Pro MXN 999/mes o 7.999/año (100.000 boletos, rifas ilimitadas, comprobantes en la página); dominio .com +MXN 299/año; **sin comisión; el dinero no pasa por la plataforma y el organizador confirma cada pago a mano**; sorteo por Lotería Nacional o "Ruletazo". Declara +370 organizadores, +MXN 35M en ventas y +6,2M boletos. Es el modelo más parecido al nuestro. — [Rifas MX](https://www.rfs.mx/)
- **LosRifados** (Nova Soluciones Tecnológicas): MXN 7.000 por rifa o MXN 5.000/mes (con "50% de descuento": 3.500 / 2.500), hasta 200.000 boletos, reserva de 10 minutos, vendedores ilimitados, ganador por lotería nacional. — [LosRifados](https://www.losrifados.com/)
- **Lottery Site**: MXN 1.000/mes + MXN 300 de instalación, dominio .com y VPS incluidos; "plataforma de renta" que no organiza las rifas. — [Lottery Site](https://lotterysite.mx/)
- **T-RIFAS**: pago único US$450 (Implementado) o US$650 (Premium); hosting y dominio a nombre del cliente; sin comisión; el organizador valida cada pago; afiliados y QR. — [T-RIFAS](https://t-rifas.com/)

**Colombia / Perú / sin país declarado**
- Laooz (Colombia), Rifas Blu (Colombia) y Simple Rifa (Perú): ver sección 2.
- **Club de Rifas**: primeros 50 números gratis; PRO pago único por rifa según tamaño (ejemplo: 100 números US$2,50; rango 20-10.000); sin suscripción ni comisión; el organizador recibe el dinero directo. — [Club de Rifas](https://clubderifas.com/)
- **Rifary**: talonario digital con QR, app en Google Play, "desde US$4" y talonarios de 50 números gratis. — [Rifary](https://rifary.com/)
- **Talonarios de Rifas Virtual** (app iOS, CODE FUSION TECH LTDA): gratis con compras internas desde S/ 2,90 semanal hasta S/ 29,90 anual; 4,8/5 con 18 valoraciones. — [App Store Perú](https://apps.apple.com/pe/app/talonarios-de-rifas-virtual/id6461217379)
- Colombia regula: decreto de diciembre de 2024 permite operar rifas mediante plataformas tecnológicas y generadores aleatorios, con autorización de Coljuegos. — [Sigma](https://sigma.world/es/news/colombia-regula-rifas-requisitos-tecnicos-y-transicion-digital/)

**Brasil (segmento grande, modelos variados)**
- **Riffas**: sin mensualidad ni porcentaje; tasa única de activación por rifa según cantidad de números: R$ 14,90 (hasta 100), R$ 36,90 (hasta 1.000), R$ 69,90 (hasta 5.000), R$ 129,90 (hasta 10.000), R$ 329,90 (hasta 100.000), R$ 999,90 (hasta 1 millón); el dinero va directo al productor; Pix manual o Mercado Pago automático; afiliados con comisión; ONG exentas. — [Riffas](https://riffas.com.br/)
- **Plataforma Rifa** (Flyout Tecnologia LTDA) clasifica los modelos del mercado: tasa anticipada por campaña, software vitalicio, Pix directo con tasa de activación (conciliación manual y "riesgo de comprobante falso") y porcentaje sobre venta con gateway. — [Plataforma Rifa](https://plataformarifa.com.br/comparativo-taxas-plataformas-rifa)
- **Rifa 321**: tasa única anticipada calculada sobre la recaudación estimada, sin porcentaje por venta; afiliados, gamificación, WhatsApp. — [iDinheiro, act. 27-07-2026](https://www.idinheiro.com.br/ganhar-dinheiro/renda-extra/qual-melhor-site-para-rifa-online/); [Rifa 321](https://www.rifa321.com/)

**EE. UU. / global**
- **RallyUp**: plan Free 0% con propina opcional; plan Flex 6,9% sobre rifas; más procesador 1,9-2,9% + US$0,30; exige cuenta propia de Stripe o PayPal. — [RallyUp pricing](https://rallyup.com/pricing/)
- **Zeffy** (solo ONG registradas de EE. UU. y Canadá, propina sugerida 15-17%, sin sorteo automático), **GalaBid** (gratis con propinas o 4,9%, Stripe; EE. UU., Canadá, Reino Unido, UE, Australia, NZ), **Givebutter** (3% sin propinas, EE. UU.), **BetterWorld** (2,2-5%), **Raffall** (Reino Unido, 15% o 10% benéficas; planes desde £8/mes). Fuente: comparativa publicada por GalaBid el 25-09-2026. — [GalaBid](https://www.galabid.com/raffle/free-raffle-software-popular-options-compared-2026)
- **Rafflecopter cerró el 01-10-2025** (era widget de giveaways, no de boletos pagos). — [Rafflecopter](https://www.rafflecopter.com/pricing)
- Easypromos, Sortea2, AppSorteos, Gleam, Woobox: herramientas de sorteos gratuitos en redes, no venden boletos numerados. — [Laooz, 21-01-2025](https://laooz.com/blog/sistema-de-rifas/10-mejores-plataformas-rifas-sorteos/)

**Inferencias de quien investigó**

- La amenaza regional real son los SaaS hispanos baratos sin pasarela (Simple Rifa, Rifas MX, Rifas Blu, Club de Rifas): pueden atender Venezuela hoy sin adaptar nada, pero ninguno resuelve Pago Móvil automático ni bolívares/BCV.
- Las plataformas con pasarela (Rifarito Premium, RifaBase, brasileñas, globales) pierden su principal ventaja en Venezuela porque Mercado Pago, Wompi, PayU, Pix y Stripe no operan para comercios locales.
- Rifas MX demuestra que el modelo "no tocamos el dinero + confirmación manual + suscripción barata con plan gratis" puede escalar (cifras declaradas, no auditadas).

**Vacíos**

- No se obtuvo precio de RaffleBox (la URL de precios dio 404) ni tablas de Rifei, RifaUp, Rife-me o Rifa Digital.
- No se encontraron plataformas específicas de Argentina, Ecuador ni República Dominicana.
- No se evaluó si alguna plataforma extranjera tiene clientes venezolanos reales.

### ¿Cómo venden hoy los organizadores venezolanos más grandes?

**Conclusión**

Los grandes riferos vendían desde **sitios propios hechos a medida** (dominio con su marca, registro con cédula, pago por Zelle/Binance/PayPal/Pago Móvil, sorteo atado a la Lotería del Táchira) y promoción en Instagram/TikTok; en marzo de 2026 una ofensiva de Conalot y cuerpos de seguridad descabezó a los más visibles y el mercado se fragmentó hacia organizadores de menos de 100.000 seguidores.

**Hallazgos con fuente**

- **Brayan Lucena** (Portuguesa) vendía por brayanlucena.com, tickets de ~US$1 o menos, con logos de Lotería del Táchira y Conalot y número Runlot CNL-ORF-2025-000661; aceptaba Zelle. **Yeimmy Rodríguez / Lotoyei** (más de 4 millones de seguidores en Instagram) vendía por Lotoyei.com desde 2024: registro con nombre, cédula, fecha de nacimiento, correo, teléfono y dirección; pagos por Zelle, Binance, PayPal y pago móvil; tickets de US$0,50 a US$2; una compradora dijo que pagar a una cuenta corporativa le daba confianza. **Cruzangelo Pasquale**: 640.000 seguidores, sitio propio sin datos de Conalot. — [La Gran Aldea, 25-03-2026](https://lga.lagranaldea.com/2026/03/25/quienes-son-y-que-pasa-con-los-riferos-en-venezuela/)
- Ambos sitios no cargan hoy desde el entorno de investigación: brayanlucena.com (registrado 27-09-2025) no resuelve y lotoyei.com (registrado 23-11-2023, vence 23-11-2026) corta la conexión. — [RDAP brayanlucena.com](https://rdap.verisign.com/com/v1/domain/brayanlucena.com); [RDAP lotoyei.com](https://rdap.verisign.com/com/v1/domain/lotoyei.com)
- Tras los operativos de marzo, de 35 perfiles monitoreados al menos la mitad seguía sorteando; los activos son mayormente influencers de menos de 100.000 seguidores con premios más modestos; nuevos actores como @elgrancombove (cara: Carlos Rodríguez, 1,4 millones de seguidores) y @emprendeconsupergana_; extraoficialmente hasta 180 detenidos. — [La Gran Aldea, 18-04-2026](https://lagranaldea.com/2026/04/18/en-medio-de-la-tormenta-el-negocio-de-las-rifas-digitales-sigue-viento-en-popa/)
- El ministro Diosdado Cabello confirmó el 25-03-2026 investigaciones contra creadores que hacen rifas ("lavadora de dinero"); reportes extraoficiales de allanamientos en Táchira y Portuguesa. — [El Diario, 26-03-2026](https://eldiario.com/2026/03/26/todo-lo-que-se-sabe-sobre-investigacion-riferos-redes-sociales-venezuela/)
- Reglas Conalot: RUNLOT obligatorio, personal e intransferible; **7% de los ingresos** a Conalot; número de RUNLOT visible en toda la publicidad; máximo cuatro rifas ocasionales al año; vendedores con contrato directo en "plataformas autorizadas"; prohibidas las rifas que captan solo en divisas fuera de norma y los premios quirúrgicos; multas calculadas a tasa BCV. — [La Nación, 20-03-2026](https://lanacionweb.com/nacional/rifas-en-redes-sociales-en-venezuela-conalot-advierte-sobre-requisitos-legales-para-evitar-estafas/)
- Conalot anunció el 29-01-2026 una fiscalización nacional de operadores físicos y digitales y exige a las plataformas digitales "sistemas de trazabilidad total"; lineamientos de diciembre de 2025 prohíben premios en divisas. — [El Diario, 30-01-2026](https://eldiario.com/2026/01/30/conalot-inicio-auditoria-nacional-sistemas-de-rifas/)
- Organizador mediano típico en plataforma compartida (JuegaConJuan sobre RifaPlus): el comprador elige números en cuadrícula, por búsqueda o con botones +1/+2/+5/+10/+20/+50 al azar; ingresa cédula, nombre, correo y teléfono (+58 por defecto); paga por Pago Móvil (Banco de Venezuela), Zelle, efectivo, Bancolombia, Nequi, Binance o "apartado"; sube imagen del comprobante y número de referencia obligatorio; total mostrado solo en USD, **campo "Tasa" vacío**, sin temporizador de reserva visible. — [JuegaConJuan, detalle de rifa](https://juegaconjuan.rifaplusapp.com/detalles-rifa/12)
- Tecnología observada: los sitios de Arcadys comparten el mismo bundle JS (`app-B7Fv8Kzs.js`) en dominios distintos, es decir, una misma base de código desplegada por cliente o por subdominio. — [rifaseljavi.com](https://rifaseljavi.com/); [juegaconjuan.rifaplusapp.com](https://juegaconjuan.rifaplusapp.com/)
- Referencia regional de build a medida: "Gran Rifa Camionera" (Colombia, Inversiones Castaño Asociados S.A.S.) usa sitio propio en Next.js, boleta de COP 150.000, reserva en la web y **pago enviado por WhatsApp**. — [elgrancamion.com](https://elgrancamion.com/)

**Inferencias de quien investigó**

- Los grandes usaban **builds a medida con marca propia**, no plataformas compartidas; los medianos y pequeños usan instalaciones de agencia (RifaPlus) o WhatsApp + listas.
- El cliente objetivo realista hoy no es el mega-influencer (golpeado o bajo escrutinio) sino el organizador pequeño y mediano que sigue activo y necesita **demostrar legalidad**: mostrar el RUNLOT, llevar trazabilidad, reportar ventas para el 7%.
- Riesgo de producto: Conalot habla de "plataformas autorizadas" y "trazabilidad total"; una plataforma que facilite rifas sin RUNLOT o solo en divisas puede quedar expuesta. Convertir el cumplimiento (campo RUNLOT obligatorio, bitácora auditable, reporte de recaudación) en función es a la vez mitigación y posicionamiento.

**Vacíos**

- No se pudo abrir ningún sitio de los grandes riferos para describir su flujo de primera mano; lo descrito viene de prensa.
- No se identificó qué desarrolladores construyeron Lotoyei.com o brayanlucena.com.
- No hay cifras de tamaño de mercado (número de organizadores activos, volumen de tickets) en ninguna fuente consultada.
- El artículo de El Pitazo sobre los riferos no pudo leerse (403).

### ¿Cuánto cobran desarrolladores y agencias en Venezuela por un sitio de rifas a medida?

**Conclusión**

No hay listas de precios públicas verificables de agencias venezolanas; los únicos números (no verificados) sitúan una instalación entre US$50 y US$350 de entrada más ~US$30/mes, y las implementaciones "llave en mano" regionales cuestan US$450-650.

**Hallazgos con fuente**

- Arcadys Web (agencia venezolana con producto de rifas) no publica precios; cotiza por WhatsApp. — [Arcadys Web](https://arcadysweb.com/blog/como-hacer-rifa-online-venezuela/)
- VendeTuRifa/Desoftsis anuncia licencia de pago único "sin pagos ocultos", sin monto visible. — [vendeturifa.com](https://vendeturifa.com/)
- NO VERIFICADO (fragmentos de buscador de sitios hoy caídos): Sistema de Rifas Premium US$350 + US$30/mes; YeaZ Rifas US$150 + US$30/mes o US$240/año; anuncio en MercadoLibre de "Página Web Para Rifas Administrable" por US$50. — [sistemaderifasmaracay.com](https://www.sistemaderifasmaracay.com/); [yeazrifas.com](https://yeazrifas.com/); [MercadoLibre VE](https://listado.mercadolibre.com.ve/rifas)
- Referencia regional verificada: T-RIFAS cobra US$450-650 de pago único por implementar el sistema en hosting del cliente; LosRifados MXN 7.000 por rifa. — [T-RIFAS](https://t-rifas.com/); [LosRifados](https://www.losrifados.com/)
- En Workana hay demanda recurrente de builds a medida y los presupuestos no son públicos. El encargo del 18-09-2025 describe exactamente el flujo venezolano: botones "Comprar tickets" y "Verificar tickets", porcentaje de tickets disponibles, formulario con cédula, estado, **referencia del pago y captura del comprobante**. — [Workana, 18-09-2025](https://www.workana.com/es/job/desarrollo-de-pagina-web-de-rifas-con-sistema-de-compra-y-gestion-de-tickets)
- Otro encargo (18-03-2025) pide un sistema "similar a Rifas El Águila" que el cliente pueda "reimplementar y administrar sin depender del programador original", replicable en varios dominios. — [Workana, 18-03-2025](https://www.workana.com/job/desarrollo-de-sistema-de-rifas-online-con-implementacion-autonoma)
- Un tercero (28-12-2025) busca una plataforma de sorteos "con potencial de marca blanca" adaptable a normativas de LatAm. — [Workana, 28-12-2025](https://www.workana.com/job/desarrollo-de-plataforma-web-de-sorteos-y-rifas-digitales-con-gestion-completa-y-escalabilidad)

**Inferencias de quien investigó**

- El sustituto real de un SaaS es "un programador conocido que me monta la página": barato de entrada, pero con dependencia del desarrollador, mensualidad de hosting y riesgo de que el sitio desaparezca (como muestran los dominios caídos).
- Los encargos de Workana confirman dos dolores: dependencia del programador y necesidad de replicar rifas sin rehacer el sitio. Ambos los resuelve un SaaS autoservicio.

**Vacíos**

- No se consiguió ninguna lista de precios verificable de un desarrollador o agencia venezolana.
- No se pudo ver presupuestos ni ofertas de los proyectos de Workana (requieren sesión).

### ¿De qué se quejan los usuarios de las herramientas existentes?

**Conclusión**

Casi no hay reseñas independientes de estas herramientas; las quejas documentadas son de Brasil (comisiones poco transparentes, reservas que vencen con Pix manual) y, del lado venezolano, la evidencia es indirecta: desorden con comprobantes en chats, clientes que no logran vender en digital y miedo a estafas.

**Hallazgos con fuente**

- Simple Rifa describe el dolor operativo del organizador: comprobantes dispersos en chats, números asignados a mano, riesgo de duplicar tickets, confirmaciones olvidadas y pérdida de evidencia de pago. — [Simple Rifa, 18-06-2026](https://www.simplerifa.com/blog/pagos-dolares-rifas-venezuela)
- Un testimonio publicado por Simple Rifa (cliente rifasjhosueavendano.com) reconoce que no logró vender de forma digital y terminó vendiendo manualmente. — [simplerifa.com](https://simplerifa.com/)
- Críticas entre competidores: Rifarito tendría tope de 9.999 tickets, cambios avanzados solo vía su equipo y soporte por correo; Rifary y Talonary no dan web propia ni soporte. Fuente interesada (Laooz). — [Laooz blog 2026](https://laooz.com/blog/los-mejores-sistemas-para-de-rifas-en-este-2026/)
- Brasil, Reclame Aqui (visto solo en fragmento de buscador, la página dio 403): un usuario de Rife-me reclama 6,80% de procesamiento más R$ 0,69 fijos por boleto en boletos de R$ 1,00, que consideró no informado con claridad. — [Reclame Aqui / Rife-me](https://www.reclameaqui.com.br/rife-me/falta-de-transparencia-e-cobranca-abusiva-de-taxa-fixa-por-bilhete-inviabilizam-campanha-de-arrecadacao_MQM-CxnCK58V50uw/)
- Brasil, Reclame Aqui (solo fragmento): en Rifa Digital una reserva venció porque la confirmación manual de Pix no se hizo dentro de un plazo no informado. — [Reclame Aqui / Rifa Digital](https://www.reclameaqui.com.br/rifa-digital/falta-de-transparencia_1N_bW50bs6FQCBk8/)
- Del lado del comprador venezolano: Conalot advierte sobre "rifas fantasma" y pide desconfiar de sorteos sin RUNLOT ni documentación del premio. — [La Nación, 20-03-2026](https://lanacionweb.com/nacional/rifas-en-redes-sociales-en-venezuela-conalot-advierte-sobre-requisitos-legales-para-evitar-estafas/)
- Señales de baja calidad en proveedores: conflicto de git visible en producción (Rifas El Javi), testimonios con fotos de stock (RifaBase), contadores de clientes inconsistentes (Simple Rifa), pie con otra marca y enlaces legales vacíos (Srapido). — [rifaseljavi.com](https://rifaseljavi.com/); [rifabase.com](https://rifabase.com/); [srapido.com](https://srapido.com/)

**Inferencias de quien investigó**

- El mayor "reclamo" implícito es la **continuidad**: sitios de proveedores que desaparecen dejan al organizador sin página ni datos. Exportación de datos y permanencia son argumentos de venta.
- La confirmación manual lenta y los plazos de reserva opacos generan conflicto con compradores (visto en Brasil); conviene mostrar el temporizador y el estado del pago al comprador.
- Comisiones por boleto son mal recibidas cuando el ticket es barato (US$1 o menos, típico en Venezuela).

**Vacíos**

- No se encontraron reseñas, hilos ni comentarios de usuarios venezolanos sobre ninguna herramienta (la búsqueda de quejas no pudo ejecutarse por el cupo agotado). Requiere entrevistas o revisión manual de comentarios en Instagram/TikTok.

### ¿Qué modelos de negocio dominan y cuáles parecen funcionar?

**Conclusión**

En el segmento "el dinero va directo al organizador" domina el **precio fijo sin comisión** (por rifa, anual o mensual, a menudo con plan gratis limitado por boletos); la comisión sobre ventas solo aparece donde la plataforma integra pasarela, algo inviable hoy en Venezuela.

**Hallazgos con fuente**

- Pago por rifa escalonado por cantidad de números: Riffas (R$ 14,90 a R$ 1.599,90), Rifas Blu (COP 0 a 2.450.000), Club de Rifas (desde US$2,50 por 100 números), Laooz (US$250-1.500 por sorteo). — [Riffas](https://riffas.com.br/); [Rifas Blu](https://rifasblu.com/); [Club de Rifas](https://clubderifas.com/); [Laooz](https://laooz.com/sistema-de-rifas/)
- Suscripción: Rifas MX (MXN 499-999/mes, con anual), Simple Rifa (US$150-400/año), RifaBase (desde US$24/mes), LosRifados (MXN 5.000/mes), Lottery Site (MXN 1.000/mes). — [Rifas MX](https://www.rfs.mx/); [Simple Rifa](https://simplerifa.com/); [RifaBase](https://rifabase.com/); [LosRifados](https://www.losrifados.com/); [Lottery Site](https://lotterysite.mx/)
- Créditos prepagados (1 crédito = 1 boleto): RifaBase. — [RifaBase](https://rifabase.com/)
- Instalación + mantenimiento o licencia única: T-RIFAS (US$450-650), VendeTuRifa (pago único), instaladores venezolanos (no verificado). — [T-RIFAS](https://t-rifas.com/); [vendeturifa.com](https://vendeturifa.com/)
- Comisión sobre ventas: Laooz "modo gratis" 10% / 5% / 2%, RallyUp Flex 6,9%, Raffall 10-15%, Plataforma Rifa (porcentaje decreciente con gateway). — [Laooz](https://laooz.com/sistema-de-rifas/); [RallyUp](https://rallyup.com/pricing/); [GalaBid](https://www.galabid.com/raffle/free-raffle-software-popular-options-compared-2026); [Plataforma Rifa](https://plataformarifa.com.br/comparativo-taxas-plataformas-rifa)
- Todos los proveedores "sin pasarela" se declaran solo software y trasladan la responsabilidad legal al organizador (Rifarito, Lottery Site, Rifas MX, Riffas). — [Rifarito](https://www.rifarito.com/precios/); [Lottery Site](https://lotterysite.mx/)
- La única plataforma con cifras de escala y modelo comparable al nuestro es Rifas MX (plan gratis + suscripción, 0% comisión, confirmación manual). — [Rifas MX](https://www.rfs.mx/)

**Inferencias de quien investigó**

- Para Venezuela lo más defendible es **plan gratis pequeño (≈100 boletos) + precio por rifa escalonado por boletos o suscripción baja**, sin comisión: no exige que la plataforma vea el dinero y coincide con el estándar regional.
- Una comisión porcentual es difícil de cobrar y auditar si el dinero nunca pasa por la plataforma, y choca con tickets de US$1.
- Cobrar por rifa encaja además con el límite regulatorio de cuatro rifas ocasionales al año por organizador.

**Vacíos**

- No hay datos de ingresos, churn ni conversión de ningún competidor; "qué funciona" se infiere de quién sobrevive y de cifras autodeclaradas.

### Brechas: ¿qué no ofrece bien nadie?

**Conclusión**

Nadie verificado ofrece a la vez verificación automática de Pago Móvil multibanco, conversión automática a tasa BCV, y herramientas de confianza y cumplimiento (RUNLOT, trazabilidad, antifraude de comprobantes); las piezas técnicas existen por separado y son baratas de integrar.

**Hallazgos con fuente**

- **Verificación de pagos**: VendeTuRifa solo automatiza Banco Mercantil; RifaPlus, Simple Rifa, Rifas Blu y Rifas MX son 100% manuales; Rifarito y RifaBase automatizan solo con pasarelas no disponibles en Venezuela. — [vendeturifa.com](https://vendeturifa.com/); [Rifarito precios](https://www.rifarito.com/precios/)
- **Pabilo** (Venezuela) verifica pagos móviles y transferencias contra movimientos reales de Banco de Venezuela, Mercantil, Banesco, Bancaribe, Banco Plaza y Binance; para plataformas ofrece plan "desde US$35 al mes" con 2.000 validaciones; no menciona rifas como cliente. — [Pabilo](https://pabilo.app/)
- En la API de Pabilo cada verificación cuesta 1 crédito (99 créditos = US$4,95, es decir ~US$0,05 por verificación); Mercantil exige teléfono, cédula y banco de origen del pagador; BDV Personas y Provincial se verifican solo con la referencia; Zelle no está soportado. — [Pabilo docs](https://pabilo.app/docs/verify-payments)
- **Antifraude de comprobantes**: Laooz vende un "Analizador de pagos manuales" (OCR + detección de comprobantes duplicados, reutilizados o editados, semáforo verde/amarillo/rojo) al 2% del valor verificado o mensualidad negociada, pero solo nombra Nequi, Bancolombia, SINPE y SPEI; **no menciona Venezuela ni pago móvil**. — [Laooz analizador](https://laooz.com/analizador-de-pagos-manuales/)
- **Tasa BCV**: ningún producto verificado la automatiza. En el inquilino de RifaPlus el campo "Tasa" aparece vacío y el total solo en USD; Simple Rifa solo recomienda "usar el BCV como referencia"; Laooz no la menciona; VendeTuRifa muestra bolívares "a la tasa del día" para cobrar su propia licencia. — [JuegaConJuan](https://juegaconjuan.rifaplusapp.com/detalles-rifa/12); [Simple Rifa](https://www.simplerifa.com/blog/pagos-dolares-rifas-venezuela); [vendeturifa.com](https://vendeturifa.com/)
- **WhatsApp**: Laooz lo marca "Próximamente"; Rifas MX y Rifas Blu lo usan solo para enviar comprobantes; ningún producto activo verificado notifica automáticamente al comprador por WhatsApp. — [Laooz Venezuela](https://laooz.com/blog/sistema-de-rifas/sistema-de-rifas-online-venezuela-100-numeros/); [Rifas MX](https://www.rfs.mx/)
- **Cumplimiento y confianza**: Conalot exige RUNLOT visible en la publicidad, 7% de los ingresos, trazabilidad total y máximo cuatro rifas ocasionales al año; ningún proveedor revisado menciona campo RUNLOT, reporte para el 7% ni bitácora auditable (Arcadys ni siquiera menciona a Conalot). — [La Nación](https://lanacionweb.com/nacional/rifas-en-redes-sociales-en-venezuela-conalot-advierte-sobre-requisitos-legales-para-evitar-estafas/); [El Diario](https://eldiario.com/2026/01/30/conalot-inicio-auditoria-nacional-sistemas-de-rifas/); [Arcadys Web](https://arcadysweb.com/blog/como-hacer-rifa-online-venezuela/)
- **Sorteo verificable**: el estándar local es atar el ganador a Triple Táchira/Zulia con carga manual del número; solo Simple Rifa promociona un compromiso criptográfico ("Bóveda Secreta SHA-256"). — [JuegaConJuan](https://juegaconjuan.rifaplusapp.com/); [Simple Rifa](https://simplerifa.com/blog/sistema-de-rifas-venezuela-plataforma-acepta-dolares-pagos-locales)
- **Autoservicio y precio público**: ningún proveedor venezolano activo permite registrarse y lanzar una rifa sin hablar con ventas. — [rifaplusapp.com](https://rifaplusapp.com/); [vendeturifa.com](https://vendeturifa.com/)

**Inferencias de quien investigó**

- Oportunidades de diferenciación, de mayor a menor evidencia: (1) registro autoservicio con precio público en USD pagable por Pago Móvil; (2) verificación semiautomática de Pago Móvil y Binance vía un tercero tipo Pabilo (~US$0,05 por verificación) manteniendo la confirmación manual como respaldo; (3) precio en USD con equivalente en Bs. a tasa BCV del día congelada al reservar; (4) "kit de confianza": RUNLOT visible, datos del premio, historial público de ganadores, bitácora inmutable y reporte de recaudación; (5) detección de comprobantes y referencias duplicadas; (6) avisos por WhatsApp; (7) continuidad y exportación de datos frente a proveedores que desaparecen.
- Mensaje de posicionamiento sugerido por la evidencia: "la única plataforma hecha para Venezuela que sigue en pie, con precio público y que te ayuda a operar en regla", en lugar de competir en precio con Simple Rifa o Rifas Blu.
- Riesgo a vigilar: Simple Rifa, Laooz o Rifas MX pueden añadir Pago Móvil/BCV con poco esfuerzo; la ventaja local es temporal salvo que se apoye en cumplimiento y verificación bancaria.

**Vacíos**

- No se verificó el costo ni las condiciones reales de integrar Pabilo u otros verificadores (PagoVE, Smart-Banking, Ubii aparecieron en búsqueda pero no se revisaron).
- No se confirmó si Conalot mantiene una lista de "plataformas autorizadas" ni qué requisitos técnicos concretos implica la "trazabilidad total".
- No se validó con organizadores cuáles de estas brechas pagarían; todo lo anterior es inferencia desde la oferta.

## 7. Mercado

Cómo funciona el fenómeno de las rifas, quién lo mueve y en qué contexto digital y de pagos.

### ¿Qué tan grande es el fenómeno de las rifas en Venezuela, por qué creció y qué dicen los expertos?

**Conclusión**

No existe ninguna estimación publicada del tamaño del mercado (ni organizadores, ni boletos, ni dinero movido); lo que sí está documentado es un fenómeno masivo que nació en la calle en 2021-2022 con la dolarización de facto, saltó a Instagram/TikTok en 2023-2025 con premios de vehículos y apartamentos a 1 USD el boleto, y fue golpeado en marzo de 2026 por una ofensiva estatal (Conalot + Sebin) que lo dejó activo pero más pequeño, más discreto y obligado a registrarse. Para un SaaS, el hecho más importante de 2026 no es el tamaño sino que la actividad pasó a ser regulada: RUNLOT, autorización por rifa, tasa del 7 % y exigencia de "trazabilidad total" en las plataformas digitales.

**Hallazgos con fuente**

**Tamaño: lo que existe y lo que no**
- **[Prensa]** El reportaje más completo sobre el tema (La Gran Aldea, 25-03-2026) no da ni número total de riferos ni estimación de dinero movido. — [La Gran Aldea, 25-03-2026](https://lga.lagranaldea.com/2026/03/25/quienes-son-y-que-pasa-con-los-riferos-en-venezuela/)
- **[Prensa]** La Gran Aldea monitoreó 35 perfiles de "riferos digitales" en abril de 2026: al menos la mitad seguía organizando sorteos; el resto dejó de rifar a mediados de marzo. Los que siguen activos tienen en su mayoría menos de 100.000 seguidores. — [La Gran Aldea, 18-04-2026](https://lagranaldea.com/2026/04/18/en-medio-de-la-tormenta-el-negocio-de-las-rifas-digitales-sigue-viento-en-popa/)
- **[Extraoficial]** "De forma extraoficial se habla de hasta 180 personas detenidas" por vínculos con estas prácticas; ninguna autoridad lo ha confirmado. — [La Gran Aldea, 12-06-2026](https://lagranaldea.com/2026/06/12/tres-meses-despues-el-caso-de-los-riferos-sigue-rodeado-de-rumores-sin-confirmar/)
- **[Oficial/Prensa]** En Táchira, el comisionado Marcos Albarrán dijo (oct. 2025) que el sector está "un 60 por ciento saneado y hay un 40 por ciento que está por allí… en alguna ilegalidad"; el artículo no aclara si el porcentaje es de ventas o de establecimientos, y se refiere sobre todo a venta fraudulenta de loterías colombianas y rifas binacionales. — [Focus Gaming News, 21-10-2025](https://focusgn.com/latinoamerica/el-estado-venezolano-de-tachira-busca-combatir-la-venta-ilegal-de-loteria)
- **[Anécdota]** Hilo de ForoBeta (05-08-2025): un usuario afirma ver "de dos a tres rifas diarias en estados de WhatsApp, Instagram y Facebook" y que hay gente que dejó de vender otros productos para hacer rifas; otro comenta "Venezuela ya no aguanta una rifa más". — [ForoBeta, 05-08-2025](https://forobeta.com/temas/que-pasa-en-venezuela-con-las-rifas.1063657/)
- **[Gremio]** El Seniat tiene una iniciativa para formalizar a "más de 3,5 millones de vendedores informales y usuarios en redes sociales" (cifra objetivo, no conteo; no es específica de rifas). — [El Nacional, 08-10-2026](https://www.elnacional.com/2026/10/sistema-de-pago-movil-concentra-63-de-las-operaciones-financieras-en-venezuela/)

**Insumos que alguien podría usar para estimar (sin extrapolar aquí)**
- **[Dato]** Numeración de registros Conalot vistos en webs de rifas: `CNL-ORF-2025-000661` (web de Brayan Lucena) y `CNL-ORF-2026-000140` (otra web de rifas, visto en extracto). — [La Gran Aldea, 25-03-2026](https://lga.lagranaldea.com/2026/03/25/quienes-son-y-que-pasa-con-los-riferos-en-venezuela/); [portuguesaaldia.com (extracto)](https://portuguesaaldia.com/conalot-regula-rifas-en-instagram-guia-para-evitar-estafas-2026/)
- **[Oficial]** Tasa a Conalot: 7 % (ver discrepancia de base de cálculo más abajo). Límite de 4 rifas "ocasionales" por año por persona o empresa. — [La Nación (Táchira), 20-03-2026](https://lanacionweb.com/nacional/rifas-en-redes-sociales-en-venezuela-conalot-advierte-sobre-requisitos-legales-para-evitar-estafas/)
- **[Prensa]** Rango de precio del boleto digital: participantes entrevistados compraron boletos de 0,50 a 2 USD; "desde 1 a 5 dólares" con vehículos de más de 60.000 USD como premio (desde 2023). — [La Gran Aldea, 25-03-2026](https://lga.lagranaldea.com/2026/03/25/quienes-son-y-que-pasa-con-los-riferos-en-venezuela/); [Noticias Barquisimeto, 25-03-2026](https://www.noticiasbarquisimeto.com/riferos-utilizan-dinero-sucio-de-mafias/)
- **[Prensa]** Rifa callejera de 2022: 1.000 boletos a 20 USD (camioneta + moto + 4 premios de 250 USD); a los cuatro días había vendido 60. — [EFE vía Diario de Los Andes, 06-10-2022](https://diariodelosandes.com/la-venta-de-rifas-para-sorteos-de-ocio-a-negocio)
- **[Prensa]** Bingo comunitario en San Félix (Bolívar), 2022: ~1.500 cartones a 3 USD financiaron un Mitsubishi 2007 (~2.000 USD usado) y premios menores. — [AFP vía Telemetro, 11-11-2022](https://www.telemetro.com/internacionales/carros-comida-efectivo-bingos-y-rifas-cobran-nuevo-auge-venezuela-n5801449)
- **[Anécdota]** Foro (ago. 2025): "la cantidad de boletos por sorteo suele ser siempre de 10k"; ejemplo de "cada ticket a 30$ por 10.000 personas" para una camioneta de 130.000 USD; "venden 10mil números en un día"; otro usuario estima que los premios equivalen hasta al 80 % de la recaudación (margen ~20 %); otro advierte que no siempre se venden todos los boletos. — [ForoBeta, 05-08-2025](https://forobeta.com/temas/que-pasa-en-venezuela-con-las-rifas.1063657/)
- **[Proveedor]** Una plantilla de software de rifas (Rifenix) contempla rifas de "un millón de tickets" (desactiva la selección manual en ese caso). — [rifassell.com (plantilla Rifenix), consultado 13-10-2026](https://rifassell.com/)
- **[Dato]** Ticket promedio de una operación de Pago Móvil: ~17,60 USD (Debates IESA, dic. 2025). — [Debates IESA, 08-12-2025](https://www.debatesiesa.com/el-pago-movil-es-el-rey-de-las-transferencias-inmediatas-en-venezuela/)

**Por qué creció**
- **[Prensa/Experto]** El economista Manuel Sutherland (2022) atribuye el auge de las rifas populares a "la pobreza y la incapacidad de acceder a un bien"; pagar 5 USD por la oportunidad de una moto es una "inversión de bajo riesgo"; la dolarización de facto da al organizador "mayor posibilidad de recuperar su plata fácilmente". — [EFE vía Diario de Los Andes, 06-10-2022](https://diariodelosandes.com/la-venta-de-rifas-para-sorteos-de-ocio-a-negocio)
- **[Dato, antiguo 2022]** Datanálisis: 55,5 % de la población ganaba menos de 150 USD/mes; Cendas-FVM: una familia de cuatro necesitaba ~800 USD/mes. — [EFE vía Diario de Los Andes, 06-10-2022](https://diariodelosandes.com/la-venta-de-rifas-para-sorteos-de-ocio-a-negocio)
- **[Prensa]** AFP (nov. 2022): los bingos comunitarios, "una vieja tradición", recuperaron impulso con la dolarización informal y la flexibilización de controles; comprar un carro nuevo es "cosa de élites" por falta de crédito; un comerciante de Catia: "Queda un poquito más rifándolos que vendiéndolos"; comercios rifan vehículos "para promocionar las ventas". — [AFP vía Telemetro, 11-11-2022](https://www.telemetro.com/internacionales/carros-comida-efectivo-bingos-y-rifas-cobran-nuevo-auge-venezuela-n5801449)
- **[Prensa]** La Gran Aldea (2026) encuadra el fenómeno en: contracción de la economía de más del 70 % (FMI), inflación de 548 % al cierre de 2025, un Toyota nuevo de hasta 100.000 USD y un apartamento nuevo de más de 200.000 USD; el juego fue prohibido en 2011 y Maduro autorizó más de 30 casinos en 2021, tras lo cual crecieron las rifas en línea. — [La Gran Aldea, 25-03-2026](https://lga.lagranaldea.com/2026/03/25/quienes-son-y-que-pasa-con-los-riferos-en-venezuela/)
- **[Dato]** Observatorio Venezolano de Finanzas (abr. 2025): canasta alimentaria 409 USD; salario mínimo ~1,3 USD; inflación interanual 172 %. — [Bloomberg Línea, 06-06-2025](https://www.bloomberglinea.com/latinoamerica/venezuela-esta-realmente-ante-una-rebolivarizacion-de-su-economia-el-dolar-sigue-fuerte/)
- **[Prensa]** Evolución descrita por la prensa regional: de "sorteos pequeños de un dólar" a esquemas con electrodomésticos, teléfonos de alta gama, camionetas, motos y viviendas. — [Noticias Barquisimeto, 23-03-2026](https://www.noticiasbarquisimeto.com/rifas-en-la-mira-venezuela-lanza-fuerte-ofensiva-contra-los-riferos-ilegales/)
- **[Prensa]** Una exparticipante afirmó que una rifera decía comprar los carros a crédito a mitad de precio y pagarlos con el ingreso de la rifa (modelo de financiamiento del premio con la propia venta). — [La Gran Aldea, 25-03-2026](https://lga.lagranaldea.com/2026/03/25/quienes-son-y-que-pasa-con-los-riferos-en-venezuela/)

**Marco regulatorio y ofensiva de 2026 (contexto decisivo para el lanzamiento)**
- **[Oficial]** Providencia Administrativa N.º CONALOT/P/2025-001, fechada 02-10-2025: exige declaración jurada de bienes, prueba de propiedad de los premios, declaración de origen y destino de fondos ("el dinero o los bienes objeto de la rifa deben ser de origen lícito") y el pago del 7 % de la venta de boletos de cada rifa a Conalot. — [La Gran Aldea, 25-03-2026](https://lga.lagranaldea.com/2026/03/25/quienes-son-y-que-pasa-con-los-riferos-en-venezuela/)
- **[Oficial]** Toda rifa "presencial o virtual" debe cumplir la providencia. RUNLOT (Registro Único Nacional de Loterías) obligatorio, "personal e intransferible", con una solvencia por cada rifa; debe aparecer en toda la publicidad. Documentos: cédula o RIF, carta de residencia, comprobante de tasa, reglamento del juego, certificado de propiedad del premio y disponibilidad inmediata. Máximo 4 rifas ocasionales al año; las promocionales duran de 1 a 3 meses. Prohibidas las rifas de cirugías o tratamientos estéticos (Comunicado N.º 003) y la venta a menores. Quedan excluidas las rifas que "captan fondos exclusivamente en divisas fuera de los parámetros legales". "Los vendedores deben tener contratos directos y operar en plataformas autorizadas" (no se permite tercerización). Multas calculadas al tipo de cambio oficial BCV. — [La Nación (Táchira), 20-03-2026](https://lanacionweb.com/nacional/rifas-en-redes-sociales-en-venezuela-conalot-advierte-sobre-requisitos-legales-para-evitar-estafas/)
- **[Proveedor, resume la norma]** Tipos de rifa: permanentes, ocasionales (4 eventos/año, espaciados tres meses), publicitarias/promocionales y benéficas. RUNLOT con vigencia de un año. Art. 15: el "medio de apuesta" (boleto físico o digital) debe llevar identificación RUNLOT, valor facial, descripción del premio y fecha, hora y lugar del sorteo. Conalot "homologa software" y los trámites y pagos van por el sistema SITCON. — [Diseño Digital (blog de proveedor)](https://disenodigitalec.com/informativo/todo-sobre-la-nueva-providencia-001-de-conalot-guia-para-realizar-rifas-legales-en-venezuela/)
- **[Prensa]** Publicidad: leyenda "Juego Responsable", prohibición de venta a menores, prohibido usar menores o contenido sexual; se "restringe la exhibición y promoción de premios en moneda extranjera"; el logo de Conalot no puede usarse sin autorización; ante cancelación por fuerza mayor hay 3 días hábiles para informar. — [Noticias Barquisimeto, 18-03-2026](https://www.noticiasbarquisimeto.com/haces-rifas-por-whatsapp-o-instagram-conoce-las-prohibiciones-y-requisitos-en-venezuela/)
- **[Oficial/Prensa]** Lineamientos obligatorios de diciembre de 2025 y auditoría nacional anunciada el 29-01-2026 a operadores "físicos y digitales": "se exige que las plataformas digitales cuenten con sistemas de trazabilidad total"; la Unidad de Observatorio de la Actividad de Lotería rastrea redes sociales; "prohibición de premios en divisas y la rifa de procedimientos quirúrgicos estéticos". — [El Diario, 30-01-2026](https://eldiario.com/2026/01/30/conalot-inicio-auditoria-nacional-sistemas-de-rifas/)
- **[Oficial] (extracto)** Comunicado de Conalot (julio 2026): la inscripción en el RUNLOT solo acredita como sujeto regulado; para cada sorteo hace falta además una "Autorización de Rifa" previa. — [El Aragueño (extracto)](https://elaragueno.com.ve/conalot-exige-autorizacion-previa-para-ejecutar-rifas-en-venezuela/)
- **Conflicto de fuentes sobre el 7 %:** "7 % del valor total de la boletería emitida", pagado antes del lanzamiento — [Noticias Barquisimeto, 18-03-2026](https://www.noticiasbarquisimeto.com/haces-rifas-por-whatsapp-o-instagram-conoce-las-prohibiciones-y-requisitos-en-venezuela/) y [Diseño Digital](https://disenodigitalec.com/informativo/todo-sobre-la-nueva-providencia-001-de-conalot-guia-para-realizar-rifas-legales-en-venezuela/); frente a "7 % de sus ingresos" — [La Nación, 20-03-2026](https://lanacionweb.com/nacional/rifas-en-redes-sociales-en-venezuela-conalot-advierte-sobre-requisitos-legales-para-evitar-estafas/). No se pudo abrir el PDF oficial.
- **[Prensa/Extraoficial]** Cronología de la ofensiva: desde el 16-03-2026 circulan reportes de detenciones por el Sebin (Yeimmy Rodríguez, Brayan Lucena, Cruzangelo Pasquale); allanamientos y vehículos remolcados en Táchira (sedes de "agencias de rifas" en Barrio Obrero y Capacho), Zulia, Portuguesa, Anzoátegui (Lechería), Carabobo y Caracas; "no existe ninguna versión oficial sobre lo ocurrido". — [La Nación (Táchira), 23-03-2026](https://lanacionweb.com/sucesos/procedimientos-contra-riferos-en-tachira-y-otros-estados/); [Noticias Barquisimeto, 23-03-2026](https://www.noticiasbarquisimeto.com/rifas-en-la-mira-venezuela-lanza-fuerte-ofensiva-contra-los-riferos-ilegales/)
- **[Oficial]** Diosdado Cabello (ministro de Interior, 25-03-2026, "Con el Mazo Dando"): "Es una lavadora de dinero, dinero sucio, seguramente vinculado a mafias de narcotráfico"; "¿De dónde sacan la plata para comprar esa camioneta?". Es el único funcionario que se ha pronunciado. — [El Diario, 26-03-2026](https://eldiario.com/2026/03/26/todo-lo-que-se-sabe-sobre-investigacion-riferos-redes-sociales-venezuela/); [La Gran Aldea, 12-06-2026](https://lagranaldea.com/2026/06/12/tres-meses-despues-el-caso-de-los-riferos-sigue-rodeado-de-rumores-sin-confirmar/)
- **[Prensa]** A junio de 2026 ninguna autoridad había confirmado el estatus legal de los detenidos; cargos reportados: legitimación de capitales y asociación para delinquir; familiares niegan que haya sentencias. — [La Gran Aldea, 12-06-2026](https://lagranaldea.com/2026/06/12/tres-meses-despues-el-caso-de-los-riferos-sigue-rodeado-de-rumores-sin-confirmar/)
- **[Prensa]** Consecuencia para compradores: si el premio se compró con dinero ilícito se confisca aunque ya esté adjudicado; el ganador pierde el bien y lo pagado. — [Noticias Barquisimeto, 23-03-2026](https://www.noticiasbarquisimeto.com/rifas-en-la-mira-venezuela-lanza-fuerte-ofensiva-contra-los-riferos-ilegales/)
- **[Prensa]** Después de la ofensiva: premios más bajos (efectivo en montos menores, vehículos usados), menos publicidad, audiencias más pequeñas; algunos migraron a "dinámicas" callejeras o a juegos en línea; aparecieron operadores nuevos con respaldo institucional aparente (@elgrancombove, @emprendeconsupergana_). — [La Gran Aldea, 18-04-2026](https://lagranaldea.com/2026/04/18/en-medio-de-la-tormenta-el-negocio-de-las-rifas-digitales-sigue-viento-en-popa/)
- **[Oficial/Prensa]** Sept. 2026: Conalot reafirma que ejerce "de manera exclusiva las labores de inspección" y que sus inspectores deben portar credencial y documentación. — [Focus Gaming News, 21-09-2026](https://focusgn.com/latinoamerica/conalot-reafirma-su-trabajo-de-fiscalizacion-y-regulacion-de-loterias-y-rifas-en-venezuela)
- **[Prensa]** Conalot fue dirigida por Antonio "Potro" Álvarez de sept. 2024 a sept. 2025 (El Pitazo lo vinculó a presuntas detenciones arbitrarias, amenazas y extorsión; él lo negó); en abril de 2026 la presidía Carlos Carvallo, exoficial de la Guardia Nacional. — [La Gran Aldea, 25-03-2026](https://lga.lagranaldea.com/2026/03/25/quienes-son-y-que-pasa-con-los-riferos-en-venezuela/); [La Gran Aldea, 18-04-2026](https://lagranaldea.com/2026/04/18/en-medio-de-la-tormenta-el-negocio-de-las-rifas-digitales-sigue-viento-en-popa/)
- **[Prensa]** Contexto político: el 03-01-2026 una operación militar de EE. UU. llevó a la detención de Nicolás Maduro; el gobierno posterior está encabezado por Delcy Rodríguez. — [La Gran Aldea, 25-03-2026](https://lga.lagranaldea.com/2026/03/25/quienes-son-y-que-pasa-con-los-riferos-en-venezuela/)

**Inferencias de quien investigó**

- (Inferencia propia) Si la numeración `CNL-ORF-AAAA-NNNNNN` es correlativa por año, habría habido al menos ~661 registros de ese tipo emitidos en 2025 y al menos ~140 en 2026 al momento de emitirse esos números. Es la única pista cuantitativa encontrada sobre el segmento formal; no mide a los informales, que según toda la prensa son mayoría.
- (Aritmética sobre cifras citadas, no estimación de mercado) Una rifa de 1.000 boletos a 20 USD recauda 20.000 USD; un bingo de 1.500 cartones a 3 USD, 4.500 USD; el ejemplo de foro de 10.000 boletos a 30 USD, 300.000 USD. El rango por rifa va de miles a cientos de miles de dólares según el nivel del organizador.
- (Inferencia) El mercado direccionable para un SaaS por suscripción en oct. 2026 es probablemente la cola larga de organizadores pequeños y medianos (<100 mil seguidores) que siguen activos, no los mega-riferos de 2024-2025, que están detenidos, inactivos o reconvertidos.
- (Inferencia) El cumplimiento normativo (mostrar RUNLOT y autorización en la página y en el boleto, valor facial, fecha/hora/lugar del sorteo, leyenda de juego responsable, bloqueo a menores, registro auditable de pagos, límite de 4 rifas ocasionales) es una característica de producto con valor de venta, no solo un riesgo legal. También hay riesgo regulatorio directo para el proveedor: Conalot "homologa software" y exige "trazabilidad total" a las plataformas.

**Vacíos**

- No hay estimación publicada de tamaño de mercado (organizadores, boletos o USD). Conalot no ha publicado (o no se pudo acceder a) el número de inscritos en RUNLOT ni la recaudación del 7 %.
- No se pudo leer el texto oficial de la Providencia 001 (conalot.gob.ve no resolvió): quedan sin confirmar la base exacta del 7 %, las sanciones, si los sorteos deben atarse a loterías oficiales, los requisitos de homologación de software y el número de Gaceta Oficial. Una fuente (extracto) dice que se "formalizó" el 20-03-2026, mientras la providencia está fechada 02-10-2025.
- No se encontraron análisis de sociólogos; el único economista citado sobre rifas es Sutherland (2022). No se encontraron piezas de BBC Mundo, El País, Bloomberg, AP o Reuters sobre los riferos.
- No hay series de crecimiento desde 2020; la cronología es periodística (2021-22 calle; 2023-25 redes; 2026 ofensiva).

### ¿Quiénes son los organizadores e "influencers de rifas" más conocidos?

**Conclusión**

Los tres nombres más grandes del ciclo 2024-2025 (Yeimmy Rodríguez/"Lotoyei", Brayan Lucena y Cruzangelo Pasquale) fueron reportados como detenidos en marzo de 2026 y sus rifas están paradas; el paisaje actual es de cuentas menores a 100 mil seguidores, más algunos operadores nuevos con cara de influencer y permiso visible. Varios llegaron a ser marcas con web propia, valla publicitaria, sedes físicas ("agencias de rifas") y registro Conalot.

**Hallazgos con fuente**

- **[Prensa]** **Yeimmy Rodríguez ("Lotoyei")**: modelo y exanimadora de "La Bomba" (Televen), más de 4 millones de seguidores en Instagram; rifas desde 2024; habría entregado un apartamento amoblado; aceptaba Zelle, Binance, PayPal y pago móvil; tuvo una valla en la autopista Francisco Fajardo que fue retirada tras su presunta detención; su web no mostraba Runlot. — [La Gran Aldea, 25-03-2026](https://lga.lagranaldea.com/2026/03/25/quienes-son-y-que-pasa-con-los-riferos-en-venezuela/); [La Gran Aldea, 12-06-2026](https://lagranaldea.com/2026/06/12/tres-meses-despues-el-caso-de-los-riferos-sigue-rodeado-de-rumores-sin-confirmar/)
- **[Prensa]** **Brayan Lucena** (Portuguesa): rifas desde 2025 de iPhones, motos, vehículos, efectivo y apartamentos equipados; boletos "a menudo a 1 dólar o menos"; un ganador habría recibido 50.000 USD; sus redes superaban el millón de seguidores; su web mostraba Runlot `CNL-ORF-2025-000661` y logos de la Lotería del Táchira; el 08-01-2026 se defendió: "Basta de decir que en Venezuela nadie puede surgir porque eso significa estar enchufado o lavando dinero". — [La Gran Aldea, 25-03-2026](https://lga.lagranaldea.com/2026/03/25/quienes-son-y-que-pasa-con-los-riferos-en-venezuela/); [La Gran Aldea, 18-04-2026](https://lagranaldea.com/2026/04/18/en-medio-de-la-tormenta-el-negocio-de-las-rifas-digitales-sigue-viento-en-popa/)
- **[Anécdota] (extracto)** Web de Brayan Lucena (marca "El Coroto de la Suerte" / "Gran Sorteo"): combo de Año Nuevo a Bs. 310; otros combos a Bs. 1.280 ("Combo Toyosaw") y Bs. 1.650 ("Combo Quinceañera"); premio de las 10 PM de 45.000 USD "por transferencia bancaria en Bs."; premio mayor una Toyota (4)Runner 2026 o efectivo, más motos; compra mínima 1 boleto; números aleatorios enviados por correo. Existen varios dominios parecidos (brayanlucena.com, .net, bryanlucena.com, brayanlucenas.com) sin que se pueda saber cuál es el oficial. — [brayanlucena.com (extracto, no se pudo abrir)](https://brayanlucena.com); [brayanlucena.com/compra (extracto)](https://brayanlucena.com/compra)
- **[Prensa]** **Cruzangelo Pasquale**: rifas desde ~2024, sobre todo carros y motos; 640.000 seguidores en Instagram ("cifra modesta frente a otros colegas del gremio"); extrabajador de delivery en Chile; reportado detenido por el Sebin. — [La Gran Aldea, 25-03-2026](https://lga.lagranaldea.com/2026/03/25/quienes-son-y-que-pasa-con-los-riferos-en-venezuela/)
- **[Prensa]** **Daniela López**: dijo tener "papeles en regla", retiró su Runlot el 23-03-2026 y promocionó una nueva rifa de 1.000 USD. **Ronald Valles**: organizador sin sorteos recientes ("lo sacamos de crear contenido día a día"). **@alerifas**: inactiva, presuntamente detenido. **Narbis Junior** (@ganaconnarbis, ganaconnarbis.com): inactivos; reapareció en mayo como @narbisjunior, aparentemente en Europa, invitando a ganar dinero con juegos en línea. — [La Gran Aldea, 18-04-2026](https://lagranaldea.com/2026/04/18/en-medio-de-la-tormenta-el-negocio-de-las-rifas-digitales-sigue-viento-en-popa/); [La Gran Aldea, 12-06-2026](https://lagranaldea.com/2026/06/12/tres-meses-despues-el-caso-de-los-riferos-sigue-rodeado-de-rumores-sin-confirmar/)
- **[Prensa]** Operadores surgidos tras la ofensiva: **@elgrancombove** (aparece el 13-03-2026, primer sorteo a inicios de abril; efectivo, motos y carros 0 km; su cara es Carlos Rodríguez, "Rafucho el Maracucho", con más de 1,4 millones de seguidores en Instagram) y **@emprendeconsupergana_** (estado Bolívar, "proyecto social y empresarial"). **@Keiberth_emprende** hace entregas callejeras ("Si me sigues en Instagram te voy a regalar una bendición"). — [La Gran Aldea, 18-04-2026](https://lagranaldea.com/2026/04/18/en-medio-de-la-tormenta-el-negocio-de-las-rifas-digitales-sigue-viento-en-popa/)
- **[Anécdota] (extracto)** **Rifas Jamás** (@rifasjamas, "Disponible para toda Venezuela"): 651 mil seguidores en Instagram; carros, camionetas y equipamiento para el hogar; web propia rifasjamass.com. **@rifacaracas.oficial**: 14 mil seguidores, sorteos de vehículos. (Cifras tomadas del extracto del buscador; Instagram no se pudo abrir; fecha del conteo desconocida.) — [Instagram @rifasjamas](https://www.instagram.com/rifasjamas/); [Instagram @rifacaracas.oficial](https://www.instagram.com/rifacaracas.oficial/)
- **[Prensa/Extraoficial]** Otros nombres: operativo **"Tus Coches"** en Maracaibo (se habrían hallado armas, sustancias y dólares falsos); **Luis Gustavo Angulo**, señalado por la creadora Mariam Valero por rifar terrenos y vehículos. — [Noticias Barquisimeto, 23-03-2026](https://www.noticiasbarquisimeto.com/rifas-en-la-mira-venezuela-lanza-fuerte-ofensiva-contra-los-riferos-ilegales/); [La Gran Aldea, 25-03-2026](https://lga.lagranaldea.com/2026/03/25/quienes-son-y-que-pasa-con-los-riferos-en-venezuela/)
- **[Prensa]** Influencers reclutados como rostro: Michelle Marín (más de 1 millón de seguidores, vive en República Dominicana) dijo en dic. 2025 que le ofrecieron un negocio de rifas y lo rechazó: "Ese sistema es de gente que quiere lavar dinero sucio de corrupción…". — [La Gran Aldea, 25-03-2026](https://lga.lagranaldea.com/2026/03/25/quienes-son-y-que-pasa-con-los-riferos-en-venezuela/)
- **[Prensa, 2022]** Riferos de calle en Caracas: Luis Sánchez (40 años, exmensajero, tres rifas en 2022, boleto a 20 USD; vive de eso: "Yo de ahí saco mis gastos") y Jonathan Bravo (39 años, empezó en feb. 2022, tercera rifa). — [EFE vía Diario de Los Andes, 06-10-2022](https://diariodelosandes.com/la-venta-de-rifas-para-sorteos-de-ocio-a-negocio)
- **[Prensa]** Comercios como organizadores (2022): una tienda de comida fina en Caracas rifaba una pick-up 0 km y una moto con boletos de 100 USD; un abasto en Catia rifaba una moto y dos carros usados. — [AFP vía Telemetro, 11-11-2022](https://www.telemetro.com/internacionales/carros-comida-efectivo-bingos-y-rifas-cobran-nuevo-auge-venezuela-n5801449)
- **[Anécdota] (extracto, baja calidad)** Páginas de descubrimiento de TikTok mencionan rifas de una Nissan Versa 2024 0 km con boletos a 100 USD y de una Denali a 200 USD, y la polémica de "El Manao" y Brayan Lucena por "rifas millonarias". — [TikTok Discover](https://www.tiktok.com/discover/rifas-de-carros-2024-caracas)
- **[Anécdota]** Marcas de rifa con web propia observadas (todas en plantillas de software de terceros): Rifas Maracaná, Rifas Premium WY, Gana con Rifas Isa, Rifas Sell, Sorteo LV ("Roques 2.0"), Rifas El Rojo ("El Resuelve Flash"), y subdominios de talleres en RifasVE (monstergarage, restauracionmonster). — [ganaconrifasisa.com](https://ganaconrifasisa.com/); [rifassell.com](https://rifassell.com/); [sorteolv.com](https://sorteolv.com/); [monstergarage.rifasve.com (extracto)](https://monstergarage.rifasve.com/)
- **[Prensa]** Referente regional: el colombiano Javier Arias, "el rey de las rifas", detenido en 2025 por presunto lavado para el Clan del Golfo y liberado en marzo de 2026; volvió a hacer sorteos. — [La Gran Aldea, 18-04-2026](https://lagranaldea.com/2026/04/18/en-medio-de-la-tormenta-el-negocio-de-las-rifas-digitales-sigue-viento-en-popa/)

**Inferencias de quien investigó**

- (Inferencia) Hay tres perfiles de organizador: (a) mega-rifero influencer (más de 500 mil seguidores, boleto ~1 USD, volumen masivo), hoy casi desaparecido o reconvertido; (b) rifero profesional pequeño/mediano con marca y web alquilada, que es el cliente natural de un SaaS; (c) comercio, taller o emprendimiento que rifa para promocionar o liquidar inventario, más cercano a la figura legal de "rifa promocional".
- (Inferencia) Bs. 310 por el combo de Año Nuevo de Lucena equivale a ~0,9 USD a la tasa oficial de enero de 2026 (~Bs. 330), coherente con "1 dólar o menos".
- (Inferencia) Que los nuevos operadores incorporen "Super Gana" en el nombre o exhiban logos de la Lotería del Táchira sugiere que asociarse a una lotería oficial es la vía de legitimación tras la ofensiva.

**Vacíos**

- No hay ranking verificable de cuentas por seguidores; no se pudieron abrir Instagram ni TikTok, así que los conteos provienen de prensa y de extractos.
- No se encontró el número de boletos por rifa ni la frecuencia de sorteos de los grandes riferos (solo indicios: varios premios diarios "10 PM", combos temáticos). La Gran Aldea no publicó la lista de los 35 perfiles monitoreados.
- No se pudo abrir el artículo de El Pitazo donde los riferos se pronuncian (403).

### ¿Cómo se estructura una rifa típica?

**Conclusión**

El formato digital dominante observado es: boleto barato (0,5 a 5 USD, cobrado en bolívares), números asignados al azar y enviados por correo o WhatsApp, botones de cantidad (2, 5, 10, 20, 50, 100), compra mínima de 1 o 2 boletos, fecha de sorteo que se anuncia al vender el 80 %, y ganador determinado por el resultado de una lotería oficial, sobre todo las de la Lotería del Táchira (Triple Táchira y Súper Gana, sorteos de la 1 PM, 4 PM y 10 PM). Conviven formatos pequeños de 100 y 1.000 números (000-999) con rifas de 10.000 números y hasta un millón.

**Hallazgos con fuente**

**Precio y tamaño**
- **[Prensa]** Boletos digitales de 0,50 a 2 USD (participantes entrevistados); "desde 1 a 5 dólares" para vehículos de más de 60.000 USD. — [La Gran Aldea, 25-03-2026](https://lga.lagranaldea.com/2026/03/25/quienes-son-y-que-pasa-con-los-riferos-en-venezuela/); [Noticias Barquisimeto, 25-03-2026](https://www.noticiasbarquisimeto.com/riferos-utilizan-dinero-sucio-de-mafias/)
- **[Prensa, 2022]** Rifas de calle: 5 USD (juego de electrodomésticos), 10 USD (moto), 20 USD (camioneta); 1.000 boletos por rifa; comercios con boletos de 100 USD. — [EFE vía Diario de Los Andes, 06-10-2022](https://diariodelosandes.com/la-venta-de-rifas-para-sorteos-de-ocio-a-negocio); [AFP vía Telemetro, 11-11-2022](https://www.telemetro.com/internacionales/carros-comida-efectivo-bingos-y-rifas-cobran-nuevo-auge-venezuela-n5801449)
- **[Prensa]** Rifa de 999/1.000 números (000 a 999) en planilla física y promoción por Instagram, caso de Maracaibo, julio 2026. — [El Nacional, 12-07-2026](https://www.elnacional.com/2026/07/detenido-un-hombre-en-maracaibo-por-promover-rifas-ilegales-a-nombre-de-los-damnificados-por-terremotos/)
- **[Proveedor]** Un proveedor vende expresamente un "sistema de rifas de 100 números" para Venezuela con cobro directo en bolívares o divisas. — [Laooz (blog de proveedor)](https://laooz.com/blog/sistema-de-rifas/sistema-de-rifas-online-venezuela-100-numeros/)
- **[Anécdota]** "La cantidad de boletos por sorteo suele ser siempre de 10k" (foro, ago. 2025). — [ForoBeta, 05-08-2025](https://forobeta.com/temas/que-pasa-en-venezuela-con-las-rifas.1063657/)
- **[Proveedor]** Plantilla Rifenix: botones de 2, 5, 10, 20, 50 y 100 tickets ("Elige la cantidad de Tickets"); selector "Aleatorio" / "Elegir números"; selección manual deshabilitada en rifas de un millón de tickets. — [rifassell.com](https://rifassell.com/); [ganaconrifasisa.com](https://ganaconrifasisa.com/)
- **[Anécdota]** Sorteo LV, rifa "Roques 2.0" (viaje): la página muestra el precio como "19.00 Bs / 20.00 $" (las dos cifras no son coherentes entre sí a la tasa vigente; tratar como dato dudoso), compra mínima 1 ticket, fecha de fin 28-10-2026. — [sorteolv.com, consultado 13-10-2026](https://sorteolv.com/)

**Compra mínima, asignación de números y reglas**
- **[Anécdota]** Compra mínima: "un ticket" en unas rifas y "2 tickets" en otras; en la plantilla Rifenix "se especifica en los detalles de cada sorteo". — [ganaconrifasisa.com](https://ganaconrifasisa.com/); [rifaspremiumwy.com (extracto)](https://www.rifaspremiumwy.com/)
- **[Anécdota]** Asignación: "Los números serán asignados aleatoriamente y enviados al correo electrónico" (Rifenix; Brayan Lucena igual). La misma plantilla ofrece la opción de elegir números. — [rifassell.com](https://rifassell.com/); [brayanlucena.com (extracto)](https://brayanlucena.com)
- **[Anécdota]** Fecha del sorteo: "La fecha se anunciará una vez que se haya vendido el 80% de los boletos" / "El sorteo se realizará al vender el 80% de los números". — [ganaconrifasisa.com](https://ganaconrifasisa.com/); [sorteolv.com](https://sorteolv.com/)
- **[Anécdota]** Plazos: tickets enviados en 24 h (Rifenix) o 24 a 48 h "por el alto volumen de pagos" (Sorteo LV); 72 horas para reclamar el premio; premios se retiran en persona; efectivo por transferencia en 24 a 48 h; el ganador debe aceptar aparecer en el contenido audiovisual. — [rifassell.com](https://rifassell.com/); [sorteolv.com](https://sorteolv.com/)
- **[Anécdota] (extracto)** RifasVE: "El comprador cuenta con un máximo de 20 minutos para concretar su compra y reportar su pago". — [monstergarage.rifasve.com (extracto)](https://monstergarage.rifasve.com/)
- **[Anécdota]** Elegibilidad: solo mayores de 18 años venezolanos o extranjeros con residencia legal en Venezuela; Sorteo LV añade que el participante extranjero debe autorizar a un familiar para recibir el premio. — [rifassell.com](https://rifassell.com/); [sorteolv.com](https://sorteolv.com/)
- **[Anécdota]** Modalidades alternas: rifas condicionadas a vender todos los boletos o con devolución; "caja sorpresa" con cajas numeradas. — [ForoBeta, 05-08-2025](https://forobeta.com/temas/que-pasa-en-venezuela-con-las-rifas.1063657/)
- **[Oficial]** Tras la norma, el boleto digital debe indicar RUNLOT, valor facial, premio y fecha, hora y lugar del sorteo; el organizador "ocasional" no puede hacer más de cuatro rifas al año. — [Diseño Digital](https://disenodigitalec.com/informativo/todo-sobre-la-nueva-providencia-001-de-conalot-guia-para-realizar-rifas-legales-en-venezuela/); [La Nación, 23-03-2026](https://lanacionweb.com/sucesos/procedimientos-contra-riferos-en-tachira-y-otros-estados/)

**Premios, premios anticipados y combos**
- **[Prensa]** Premios típicos antes de la ofensiva: apartamentos, camionetas, motos de alta cilindrada, grandes sumas en efectivo, iPhones. Después: efectivo en montos menores y vehículos usados. — [La Gran Aldea, 18-04-2026](https://lagranaldea.com/2026/04/18/en-medio-de-la-tormenta-el-negocio-de-las-rifas-digitales-sigue-viento-en-popa/)
- **[Anécdota] (extracto)** Estructura multi-premio en Brayan Lucena: premio de las "10PM" de 45.000 USD, primer premio Toyota Runner 2026 o efectivo, segundo y tercero motos, más extras; venta por "combos" temáticos (Año Nuevo, Quinceañera, Toyosaw). — [brayanlucena.com (extracto)](https://brayanlucena.com)
- **[Prensa, 2022]** Escalera de premios en rifas de calle: vehículo, moto y efectivo (1.000 USD) o cuatro premios de 250 USD. — [EFE vía Diario de Los Andes, 06-10-2022](https://diariodelosandes.com/la-venta-de-rifas-para-sorteos-de-ocio-a-negocio)
- **[Proveedor]** Las plantillas incluyen sección de "Promociones activas" (promos condicionadas al método de pago) y los SaaS ofrecen "descuentos y promociones" como módulo. — [ganaconrifasisa.com](https://ganaconrifasisa.com/); [Rifarito](https://www.rifarito.com/)

**Loterías de referencia y horarios**
- **[Anécdota]** "Los resultados serán tomados directamente de la Lotería del Táchira" (plantilla Rifenix, texto por defecto en dos sitios distintos). — [ganaconrifasisa.com](https://ganaconrifasisa.com/); [rifassell.com](https://rifassell.com/)
- **[Anécdota] (extracto)** RifasVE: "Fecha del Sorteo: 1 de diciembre por la lotería Super Gana avalada por la Lotería del Táchira". — [monstergarage.rifasve.com (extracto)](https://monstergarage.rifasve.com/)
- **[Dato]** Horarios publicados el 13-10-2026 (tuazar.com): Triple Táchira y Táchira Zodiacal 1:15 PM, 4:45 PM y 10:10 PM; Súper Gana 1:00 PM, 4:00 PM y 10:00 PM; Triple Zulia y Zodíaco del Zulia 12:45 PM, 4:45 PM y 7:05 PM; Triple Caliente 1:00 PM, 4:30 PM y 7:10 PM; Triple Gana 1:00 PM, 4:00 PM y 10:00 PM; Triple Zamorano 10:00 AM, 12:00 PM, 2:00 PM, 4:00 PM y 7:00 PM; Chance en Línea cada hora de 9:00 AM a 7:00 PM. Triple Caracas no aparece en esa página. — [tuazar.com, 13-10-2026](https://www.tuazar.com/loteria/resultados/)
- **[Dato, parcial]** Animalitos (lotoven.com, 13-10-2026): Lotto Activo y La Granjita con sorteos cada hora desde las 8:00 AM; Selva Plus desde 8:15 AM; Ruleta Activa desde 9:00 AM. La página solo mostraba resultados hasta las 4:00 PM, probablemente por la hora de la consulta; el horario diario completo puede extenderse más. — [lotoven.com, 13-10-2026](https://lotoven.com/animalitos/)
- **[Prensa]** La Lotería del Táchira opera siete juegos todos los días (Kino, SuperGana, Cóndor Gana, El Conejo de su Suerte, Triple Táchira, entre otros). — [Focus Gaming News (extracto)](https://focusgn.com/latinoamerica/loteria-del-tachira-presento-dos-nuevos-juegos)
- **[Extraoficial]** Se criticó que hubiera "sorteos sin transmisión pública"; la norma de Conalot pide mayor transparencia en la selección de ganadores. — [Bitácora 58, 19-03-2026](https://bitacora58.com/cae-la-mafia-de-los-riferos-supuestas-detenciones-son-un-secreto-a-vox-populi/); [Meridiano, 19-03-2026](https://meridiano.net/farandula/creadores-de-contenido-venezolanos-habrian-sido-detenidos-por-violar-las-leyes-202631911280)

**Inferencias de quien investigó**

- (Inferencia) El "premio de las 10 PM" de Lucena coincide con los sorteos nocturnos de Súper Gana (10:00 PM) y Triple Táchira (10:10 PM); los grandes riferos parecen atar varios premios al mismo día usando los tres sorteos diarios.
- (Inferencia) La cantidad de números se elige para calzar con el formato de la lotería de referencia: 100 números con terminales de dos cifras, 1.000 con un triple (000-999), 10.000 con cuatro cifras. El producto debería ofrecer estos tamaños como predeterminados y dejar configurar lotería y hora.
- (Inferencia) La regla "se sortea al vender el 80 %" traslada el riesgo de venta al comprador (fecha indefinida) y choca con la exigencia de Conalot de imprimir fecha, hora y lugar en el boleto; conviene soportar ambos modos y favorecer la fecha fija.
- (Inferencia) La asignación aleatoria domina en rifas masivas y la elección manual sobrevive en rifas pequeñas (100 a 1.000 números), donde elegir "mi número" es parte del hábito.

**Vacíos**

- "Premios anticipados" como término: no se halló prensa que lo documente; solo la evidencia indirecta de multi-premio y combos. No se pudo observar ninguna rifa activa completa (precio en Bs y USD, total de boletos, porcentaje vendido, top de compradores).
- No hay datos sobre descuentos por paquete (2x1, combos) más allá de la existencia de "combos" y "promociones activas".
- No se confirmó el uso de Triple Zulia, Triple Caracas, Lotto Activo o La Granjita como referencia en rifas concretas; solo Lotería del Táchira y Súper Gana aparecen en páginas reales.
- No se verificó si la norma obliga a atar el sorteo a una lotería oficial.

### ¿Cómo pagan los compradores y cómo se verifican los pagos? ¿Cómo se maneja la tasa BCV frente a la paralela?

**Conclusión**

El flujo real es manual: el comprador paga por Pago Móvil (lo dominante por precio y por hábito) o por Zelle/Binance/PayPal, luego reporta referencia y sube el comprobante, y el organizador valida a mano y envía los boletos en 24 a 48 horas. No existe ninguna cifra sobre la cuota de cada método en rifas. La brecha cambiaria bajó de más de 75 % en enero de 2026 a ~15 % en octubre, y la norma empuja a cobrar y premiar en bolívares.

**Hallazgos con fuente**

- **[Prensa]** Los boletos se pagan "por pago móvil o divisas" / "transferencias, pagos móviles o divisas". — [Noticias Barquisimeto, 23-03-2026](https://www.noticiasbarquisimeto.com/rifas-en-la-mira-venezuela-lanza-fuerte-ofensiva-contra-los-riferos-ilegales/); [Meridiano, 19-03-2026](https://meridiano.net/farandula/creadores-de-contenido-venezolanos-habrian-sido-detenidos-por-violar-las-leyes-202631911280)
- **[Prensa]** Lotoyei aceptaba Zelle, Binance, PayPal y pago móvil. — [La Gran Aldea, 25-03-2026](https://lga.lagranaldea.com/2026/03/25/quienes-son-y-que-pasa-con-los-riferos-en-venezuela/)
- **[Anécdota]** Verificación: el formulario de compra exige número de referencia y comprobante de pago; el formulario pide el WhatsApp del comprador; "Los tickets serán enviados en un lapso de 24 horas"; Sorteo LV justifica 24 a 48 h "por el alto volumen de pagos"; "Solo se aceptan pagos por los métodos oficiales publicados". — [ganaconrifasisa.com](https://ganaconrifasisa.com/); [rifassell.com](https://rifassell.com/); [sorteolv.com](https://sorteolv.com/)
- **[Anécdota] (extracto)** Reserva temporal: 20 minutos para completar la compra y reportar el pago (RifasVE). — [monstergarage.rifasve.com (extracto)](https://monstergarage.rifasve.com/)
- **[Proveedor]** Los SaaS del sector se venden con "carga de comprobante de pago", "verificador público de tickets", "el dinero llega directo a la cuenta del organizador" y 0 % de comisión por boleto; las pasarelas automáticas que ofrecen (Mercado Pago, PayU, Wompi) no son venezolanas. — [Rifarito](https://www.rifarito.com/); [Bendi (extracto)](https://bendi.digital/)
- **[Prensa]** Fraude con comprobantes en comercio por redes: un detenido en Caracas enviaba "capturas falsas" que aparentaban transferencias de bancos extranjeros. — [El Diario, 16-12-2024 (extracto)](https://eldiario.com/2024/12/16/detuvieron-hombre-presunta-estafa-en-el-paraiso/)
- **[Dato]** Cómo pagan los venezolanos en general (Ecoanalítica, cierre de 2024): 75,3 % de los pagos en bolívares, 16 % en dólares, 3,7 % en pesos, 3,1 % en euros, 1,8 % en cripto. De los pagos en divisas: efectivo 64 %, Zelle y similares 16 %, tarjetas internacionales 9 %, billeteras digitales 8 %, transferencias 1,6 %. De los pagos en bolívares: punto de venta 66 %, pago móvil 28,3 %, biopago 3,4 %, efectivo 2,4 %. — [Finanzas Digital, 11-02-2025](https://finanzasdigital.com/transacciones-bolivares-supermercados-venezuela-2025/)
- **[Oficial]** Reglas que afectan el cobro: prohibidos o restringidos los premios en divisas; excluidas las rifas que captan fondos "exclusivamente en divisas"; multas a tasa BCV. — [El Diario, 30-01-2026](https://eldiario.com/2026/01/30/conalot-inicio-auditoria-nacional-sistemas-de-rifas/); [La Nación, 20-03-2026](https://lanacionweb.com/nacional/rifas-en-redes-sociales-en-venezuela-conalot-advierte-sobre-requisitos-legales-para-evitar-estafas/)
- **[Anécdota] (extracto)** Lucena publicaba precios en bolívares y un premio de "45.000$ por transferencia bancaria en Bs." (premio denominado en dólares, pagado en bolívares). — [brayanlucena.com (extracto)](https://brayanlucena.com)
- **[Dato]** Tasas al 06-10-2026: BCV Bs. 873,87 por dólar; USDT en Binance P2P Bs. 999,35; brecha ~14,4 %. En enero de 2026: oficial ~Bs. 330, USDT ~Bs. 580, brecha superior a 75 %. "El comercio formal debe cobrar a la tasa oficial del BCV"; "USDT sigue siendo la referencia práctica del mercado informal". — [BeInCrypto vía Yahoo Finanzas, 07-10-2026](https://es.finance.yahoo.com/noticias/usdt-toca-bs-1-000-144800814.html)
- **[Dato] (extracto)** 12-10-2026: BCV Bs. 876,80; Binance P2P Bs. 1.010,80; brecha +15,28 %; paralelo Bs. 1.041,12. — [dolitoday.com (extracto)](https://dolitoday.com/)
- **[Gremio]** La brecha entre oficial y paralelo "se ha reducido de casi el 120 % al 30 %" (Juan Mendoza, Zinli, feb. 2026). — [AFP vía Banca y Negocios, 23-02-2026](https://www.bancaynegocios.com/expertos-preven-auge-de-remesas-electronicas-hacia-venezuelabilleteras-digitales-van-a-ser-las-grandes-ganadoras/)
- **[Dato]** 95 % de los precios se fijan en dólares (OVF, 2025), aunque se pague en bolívares. — [Bloomberg Línea, 06-06-2025](https://www.bloomberglinea.com/latinoamerica/venezuela-esta-realmente-ante-una-rebolivarizacion-de-su-economia-el-dolar-sigue-fuerte/)

**Inferencias de quien investigó**

- (Inferencia) El patrón de precio es "fijado en dólares, cobrado en bolívares a la tasa del día": el producto debe guardar el precio en USD, mostrar el equivalente en Bs y registrar la tasa aplicada a cada pago. Con una brecha de 15 % la elección de tasa (BCV frente a paralela) sigue alterando el ingreso real del organizador; con la brecha de 75 a 120 % de fines de 2025 e inicios de 2026 era crítica. Debe ser configurable, con BCV por defecto por ser la tasa legal.
- (Inferencia) Con boletos de 0,5 a 5 USD, Pago Móvil es el único medio sin fricción para el comprador local; Zelle, Binance y PayPal sirven para compras grandes (muchos boletos) y para quien tiene saldo en divisas o vive fuera. No se puede cuantificar.
- (Inferencia) El cuello de botella operativo es la conciliación manual de comprobantes (de ahí las 24 a 48 h de espera). La validación asistida (referencia única, detección de duplicados, lectura del comprobante, conciliación contra el estado de cuenta) es el mayor ahorro de tiempo que un SaaS puede ofrecer, y la captura falsa es el fraude típico contra el organizador.
- (Inferencia) Un registro auditable de pagos encaja con la "trazabilidad total" que exige Conalot.

**Vacíos**

- No existe (o no se halló) dato sobre la cuota de Pago Móvil, Zelle, Binance/USDT y efectivo en la venta de rifas.
- No hay evidencia directa de cómo los riferos eligen la tasa (BCV, paralelo o promedio) ni de si cobran recargo por pagar en bolívares.
- No se pudo abrir la guía "Pagos en dólares en rifas Venezuela 2026" de SimpleRifa (error de conexión) ni páginas con métodos de pago visibles (las abiertas no tenían rifa activa).

### ¿Qué canales se usan para vender y comunicar?

**Conclusión**

Instagram y TikTok son la vitrina (anuncio, contenido aspiracional, publicidad paga), WhatsApp es el canal de cierre y de entrega del boleto, y una web propia alquilada a un proveedor de software es el punto de venta. Hay evidencia secundaria de uso de Telegram, Facebook, vallas y calle; no se halló evidencia documental de sorteos en Kick o YouTube.

**Hallazgos con fuente**

- **[Prensa]** "Sorteos anunciados por Instagram o TikTok"; cuentas en esas dos plataformas vendían boletos de 1 a 5 USD desde 2023. — [Noticias Barquisimeto, 23-03-2026](https://www.noticiasbarquisimeto.com/rifas-en-la-mira-venezuela-lanza-fuerte-ofensiva-contra-los-riferos-ilegales/); [Noticias Barquisimeto, 25-03-2026](https://www.noticiasbarquisimeto.com/riferos-utilizan-dinero-sucio-de-mafias/)
- **[Oficial]** Conalot nombra expresamente Instagram, WhatsApp y TikTok como canales de las "dinámicas posiblemente ilegales" y su observatorio rastrea redes sociales. — [La Nación, 20-03-2026](https://lanacionweb.com/nacional/rifas-en-redes-sociales-en-venezuela-conalot-advierte-sobre-requisitos-legales-para-evitar-estafas/); [El Diario, 30-01-2026](https://eldiario.com/2026/01/30/conalot-inicio-auditoria-nacional-sistemas-de-rifas/)
- **[Anécdota]** Estados de WhatsApp, Instagram y Facebook como canal cotidiano ("dos a tres rifas diarias"); los organizadores "invierten poco en contenido y mucho en publicidad propia en historias y videos" y pagan anuncios en redes. — [ForoBeta, 05-08-2025](https://forobeta.com/temas/que-pasa-en-venezuela-con-las-rifas.1063657/)
- **[Anécdota]** Las webs de rifa enlazan a WhatsApp (número +58 en el pie), piden el WhatsApp del comprador y, en un caso, enlazan a un canal de Telegram; Sorteo LV enlaza a Instagram. — [ganaconrifasisa.com](https://ganaconrifasisa.com/); [rifassell.com](https://rifassell.com/); [sorteolv.com](https://sorteolv.com/)
- **[Prensa]** Canales fuera de línea: valla publicitaria en la principal autopista de Caracas (Lotoyei); sedes físicas de "agencias de rifas" en San Cristóbal y Capacho; venta en barrios populares; entregas callejeras a transeúntes grabadas para redes. — [La Gran Aldea, 12-06-2026](https://lagranaldea.com/2026/06/12/tres-meses-despues-el-caso-de-los-riferos-sigue-rodeado-de-rumores-sin-confirmar/); [La Nación, 23-03-2026](https://lanacionweb.com/sucesos/procedimientos-contra-riferos-en-tachira-y-otros-estados/); [La Gran Aldea, 18-04-2026](https://lagranaldea.com/2026/04/18/en-medio-de-la-tormenta-el-negocio-de-las-rifas-digitales-sigue-viento-en-popa/)
- **[Dato]** Alcance publicitario en Venezuela (finales de 2025): TikTok 16,6 millones de adultos (83,8 % de los mayores de 18), Facebook 15,6 millones, Instagram 9,80 millones (56,9 % mujeres), Messenger 5,45 millones, X 675 mil. — [DataReportal, Digital 2026: Venezuela](https://datareportal.com/reports/digital-2026-venezuela)
- **[Dato]** Sept. 2026: Instagram 10,93 millones de usuarios (33,3 % de la población; 57,8 % mujeres; grupo mayor 25 a 34 años); Facebook 20,10 millones; Messenger 16,07 millones. — [NapoleonCat, sept. 2026](https://napoleoncat.com/stats/social-media-users-in-venezuela/)
- **[Dato, antiguo 2022]** Entre internautas venezolanos: WhatsApp 90 %, Facebook 87 %, YouTube 85 %, Instagram 85 %, Telegram 63 %, TikTok 29 % (Tendencias Digitales). — [El Estímulo, 19-09-2022](https://elestimulo.com/tecnologia/2022-09-19/tendencias-digitales-que-dominan-internet-en-venezuela-en-2022/)
- **[Prensa]** La lotería oficial transmite sorteos por YouTube (Kingo Táchira, canal oficial), antecedente del sorteo en vivo. — [La República, 23-03-2024 (extracto)](https://larepublica.pe/datos-lr/venezuela/2024/03/23/kingo-tachira-resultados-de-hoy-numeros-ganadores-del-domingo-24-de-marzo-venezuela-lrtmv-367057)

**Inferencias de quien investigó**

- (Inferencia) El embudo es red social → enlace en bio → web de la rifa → pago → reporte → boleto por WhatsApp o correo. La página pública debe cargar rápido desde el navegador interno de Instagram y TikTok y tener salida a WhatsApp en un toque.
- (Inferencia) TikTok ya supera a Instagram en alcance adulto en Venezuela; Instagram es más femenino y está concentrado en 25 a 34 años. Compartir a estados de WhatsApp (imagen del boleto, progreso de venta) es probablemente el motor de difusión más barato.

**Vacíos**

- No se encontró evidencia de sorteos en vivo por Kick o YouTube hechos por riferos, ni datos de audiencia de transmisiones en vivo.
- No hay datos sobre el uso de canales o comunidades de WhatsApp frente a grupos, ni sobre Telegram en rifas (solo un enlace observado).
- No hay cifras de gasto publicitario de los riferos.

### Fraude y desconfianza: estafas documentadas (2022-2026) y qué exigen los compradores

**Conclusión**

La desconfianza tiene dos fuentes: estafas clásicas de pequeña escala (premio que no se entrega, rifa benéfica falsa, vendedor que cobra y desaparece) y, desde marzo de 2026, la sospecha oficial de que las grandes rifas eran lavado de dinero con "ganadores fantasmas" y "premios reciclados". La prueba de legitimidad pasó de ser social (video de entrega, cara del influencer) a documental (RUNLOT y autorización visibles, propiedad del premio, sorteo atado a lotería oficial).

**Hallazgos con fuente**

- **[Prensa/Extraoficial]** Patrones descritos en la ofensiva de 2026: "ganadores fantasmas" (el premiado es familiar o allegado del organizador), "premios reciclados" (el mismo vehículo se rifa durante meses o años en varios estados sin entregarse) y "montajes publicitarios". — [Noticias Barquisimeto, 23-03-2026](https://www.noticiasbarquisimeto.com/rifas-en-la-mira-venezuela-lanza-fuerte-ofensiva-contra-los-riferos-ilegales/)
- **[Prensa/Extraoficial]** Los detenidos "no pudieron presentar facturas de origen, trazabilidad bancaria ni registros legales de los vehículos sorteados" (fuentes no identificadas). — [Noticias Barquisimeto, 25-03-2026](https://www.noticiasbarquisimeto.com/riferos-utilizan-dinero-sucio-de-mafias/)
- **[Prensa]** Maracaibo, julio 2026: detenido Gustavo Adolfo Márquez (52) por vender por Instagram (@amandarifas_1) la "Rifa El Quinto Sueño Mundial", con 999 números casi todos vendidos, bajo la falsa promesa de donar lo recaudado a damnificados del sismo del 24 de junio en La Guaira; no tenía permiso de Conalot; cargos de oferta engañosa y estafa. — [El Nacional, 12-07-2026](https://www.elnacional.com/2026/07/detenido-un-hombre-en-maracaibo-por-promover-rifas-ilegales-a-nombre-de-los-damnificados-por-terremotos/); [La Iguana, 12-07-2026](https://www.laiguana.tv/articulos/1558719-maracaibo-detenido-estafas-rifas/)
- **[Prensa] (extracto)** En ese mismo caso otro medio reporta un premio ofrecido de 10.000 USD y que el detenido dijo ser solo vendedor de los números, señalando como organizador a un funcionario de la PNB (no aparece en las dos notas abiertas). — [Cactus24 (extracto), 10-07-2026](https://cactus24.com.ve/2026/07/10/detenido-por-estafa-mediante-oferta-enganosa-y-rifas-ilicitas/)
- **[Oficial]** Lara, abril 2025: el fiscal general informó la detención de una mujer que "utilizó fotografías e imágenes falsas para promover rifas y recaudar fondos" para la supuesta operación de una niña. — [El Diario, 15-04-2025](https://eldiario.com/2025/04/15/detuvieron-mujer-por-estafar-organizando-rifas-colectas-lara)
- **[Prensa] (extracto, año no confirmado)** Zulia: detenido Yixson Moisés Nava (32) tras negarse a entregar el premio de una rifa de moto; había pospuesto el sorteo alegando falta de pago de participantes. — [El Periódico de Monagas (extracto)](https://elperiodicodemonagas.com.ve/sucesos/detienen-a-un-individuo-por-estafar-con-rifa-de-una-motocicleta/)
- **[Prensa]** Táchira, oct. 2025: un influencer dedicado a rifas binacionales fue detenido en la frontera "hace algunas semanas". — [Focus Gaming News, 21-10-2025](https://focusgn.com/latinoamerica/el-estado-venezolano-de-tachira-busca-combatir-la-venta-ilegal-de-loteria)
- **[Prensa, 2022]** Bingos y rifas sin regulación; algunos organizados por bandas criminales; promotores que "contratan" policías como custodia. — [AFP vía Telemetro, 11-11-2022](https://www.telemetro.com/internacionales/carros-comida-efectivo-bingos-y-rifas-cobran-nuevo-auge-venezuela-n5801449)
- **[Prensa]** Estafa vecina (no es rifa): en Lara, un hombre cobraba de 150 a 600 USD por Zelle o Binance para "conseguir" carros y motos por redes y desaparecía (ago. 2026). — [La Patilla, 31-08-2026](https://lapatilla.com/2026/08/31/el-engano-detras-de-la-compra-de-carros-y-motos-por-redes-sociales-que-termino-con-un-detenido-en-lara/)
- **[Oficial]** Qué recomienda Conalot al comprador: exigir el RUNLOT en cualquier anuncio ("las promociones sin RUNLOT no ofrecen garantías legales"), desconfiar de premios irreales o sin documentación y denunciar. — [La Nación, 20-03-2026](https://lanacionweb.com/nacional/rifas-en-redes-sociales-en-venezuela-conalot-advierte-sobre-requisitos-legales-para-evitar-estafas/)
- **[Prensa]** Sin RUNLOT ni solvencia vigente el sorteo "carece de respaldo legal" y el participante queda sin protección ante impago. — [Noticias Barquisimeto, 18-03-2026](https://www.noticiasbarquisimeto.com/haces-rifas-por-whatsapp-o-instagram-conoce-las-prohibiciones-y-requisitos-en-venezuela/)
- **[Anécdota]** Señales de legitimidad que ya usan los riferos: Runlot y logos de la Lotería del Táchira en la web (Lucena); verificador o consulta pública de tickets ("Consultar Tickets" en Sorteo LV; "verificador público de tickets" y "sorteador" en Rifarito); obligación del ganador de aparecer en video; rifera que publica que tiene "todos mis permisos". — [La Gran Aldea, 25-03-2026](https://lga.lagranaldea.com/2026/03/25/quienes-son-y-que-pasa-con-los-riferos-en-venezuela/); [sorteolv.com](https://sorteolv.com/); [Rifarito](https://www.rifarito.com/); [rifassell.com](https://rifassell.com/)
- **[Prensa]** Suplantación: hay varios dominios casi idénticos con el nombre de Brayan Lucena, y Conalot tuvo que aclarar que solo sus inspectores acreditados pueden fiscalizar. — [brayanlucena.com (extracto)](https://brayanlucena.com); [Focus Gaming News, 21-09-2026](https://focusgn.com/latinoamerica/conalot-reafirma-su-trabajo-de-fiscalizacion-y-regulacion-de-loterias-y-rifas-en-venezuela)
- **[Prensa]** Reacción del público: división entre quienes piden debido proceso y quienes celebran las detenciones con alusiones a "lavadoras" y "enchufes"; ninguno de los participantes entrevistados había ganado. — [La Gran Aldea, 25-03-2026](https://lga.lagranaldea.com/2026/03/25/quienes-son-y-que-pasa-con-los-riferos-en-venezuela/)

**Inferencias de quien investigó**

- (Inferencia) Kit de confianza mínimo que el producto debería traer de fábrica: RUNLOT y número de autorización visibles; lotería, fecha y hora del sorteo fijas y publicadas antes de vender; verificador público de boleto por número, cédula o teléfono; lista pública de números vendidos con datos enmascarados; cálculo del ganador reproducible a partir del resultado oficial, con enlace a la fuente; galería de ganadores y entregas; dominio propio verificable para evitar clones.
- (Inferencia) Los patrones "ganador fantasma" y "premio reciclado" se neutralizan con sorteo atado a lotería externa, congelamiento de la lista antes del sorteo e historial inmutable de rifas anteriores con premio y ganador.
- (Inferencia) Los avisos sobre inspectores acreditados sugieren que hubo extorsión por falsos fiscalizadores; un organizador pequeño valorará tener sus documentos en regla a mano.

**Vacíos**

- No se hallaron estadísticas de denuncias por estafa en rifas (Cicpc, Ministerio Público, Conalot).
- No se encontraron casos documentados de 2022 a 2024 con nombre y fecha más allá de las advertencias generales de AFP (2022); la búsqueda se cortó por el límite de consultas.
- No hay encuestas sobre qué pruebas exige el comprador; lo listado es conducta observada del lado de la oferta y recomendaciones oficiales. No se pudo abrir la guía de 2001online sobre qué verificar antes de comprar una rifa.

### Vendedores y promotores: ¿hay redes de revendedores con comisión?

**Conclusión**

Sí existen vendedores a comisión (está documentado en bingos comunitarios y en el caso de Maracaibo, y los SaaS traen "módulo de vendedores" con comisión por promotor), pero no se encontró ninguna cifra de comisión típica. La norma de Conalot restringe el modelo: los vendedores necesitan contrato directo con el organizador y no se permite la tercerización.

**Hallazgos con fuente**

- **[Prensa, 2022]** En los bingos comunitarios de Ciudad Guayana "los cartones se venden con comisión" (sin porcentaje). — [AFP vía Telemetro, 11-11-2022](https://www.telemetro.com/internacionales/carros-comida-efectivo-bingos-y-rifas-cobran-nuevo-auge-venezuela-n5801449)
- **[Prensa] (extracto)** En el caso de Maracaibo (julio 2026) el detenido dijo que "únicamente se encargaba de vender los números" para un organizador tercero. — [Cactus24 (extracto), 10-07-2026](https://cactus24.com.ve/2026/07/10/detenido-por-estafa-mediante-oferta-enganosa-y-rifas-ilicitas/)
- **[Oficial]** "Los vendedores deben tener contratos de comercialización directos y procesar sus operaciones en las plataformas autorizadas"; no se permite la tercerización. — [La Nación, 20-03-2026](https://lanacionweb.com/nacional/rifas-en-redes-sociales-en-venezuela-conalot-advierte-sobre-requisitos-legales-para-evitar-estafas/); [El Pitazo (extracto)](https://elpitazo.net/economia/rifas-en-redes-sociales-son-legales-o-necesitas-permisos/)
- **[Proveedor]** Oferta de software: "cada promotor puede tener una cuenta con comisión personalizada" (Laooz); "módulo de vendedores" en el plan Premium (Rifarito). — [Laooz (extracto)](https://laooz.com/blog/sistema-de-rifas/sistema-de-rifas-online-venezuela-100-numeros/); [Rifarito](https://www.rifarito.com/)
- **[Anécdota]** Un usuario de foro dice administrar páginas de influencers venezolanos que promueven rifas (sin detallar pagos); otro resume: "Lo más difícil es la organización y vender los números". — [ForoBeta, 05-08-2025](https://forobeta.com/temas/que-pasa-en-venezuela-con-las-rifas.1063657/)
- **[Prensa]** Modelo "rostro alquilado": a influencers con más de un millón de seguidores se les ofrecen negocios de rifas para prestar su imagen. — [La Gran Aldea, 25-03-2026](https://lga.lagranaldea.com/2026/03/25/quienes-son-y-que-pasa-con-los-riferos-en-venezuela/)

**Inferencias de quien investigó**

- (Inferencia) Hay dos figuras distintas: el revendedor de barrio, que coloca números por comisión con planilla física o WhatsApp, y el influencer que cobra por imagen o participación. Un módulo de vendedores con enlace o código propio, bloque de números asignado, comisión configurable y liquidación sirve al primero; el segundo requiere atribución por enlace.
- (Inferencia) Por la exigencia de contrato directo, conviene que el vendedor quede registrado en la plataforma (identidad y relación con el organizador) y que el dinero entre a las cuentas del organizador, no del vendedor.

**Vacíos**

- Comisión típica: no se halló ninguna cifra (ni 10 %, ni 20 %, ni otra) en prensa ni en sitios abiertos. Hace falta entrevistar organizadores.
- No se sabe qué proporción de las ventas pasa por revendedores frente a venta directa en la web.

### Contexto digital para decisiones de producto

**Conclusión**

Venezuela es un mercado de móvil Android con datos modestos: ~62 % de la población en línea (17,6 millones), ~86 % Android, descarga móvil mediana de 25 a 28 Mbps, y casi todo internauta en redes sociales, con TikTok y Facebook a la cabeza en alcance y WhatsApp como mensajería universal. La diáspora ronda los 7 a 8 millones y envía del orden de 4.000 a 6.000 millones de dólares al año, pero no hay datos de su participación en rifas y las bases de las rifas suelen restringirla.

**Hallazgos con fuente**

**Conectividad y dispositivos**
- **[Dato]** Población 28,5 millones (oct. 2025), 88,6 % urbana, edad mediana 29,4 años. Usuarios de internet 17,6 millones (61,6 %); 11,0 millones fuera de línea (38,4 %). Conexiones móviles 21,8 millones (76,3 % de la población); 99,8 % son 3G/4G/5G. — [DataReportal, Digital 2026: Venezuela](https://datareportal.com/reports/digital-2026-venezuela)
- **[Dato]** Velocidad mediana (Ookla): móvil 25,42 Mbps y fija 92,09 Mbps a finales de 2025 (móvil +86 % en doce meses hasta ago. 2025). — [DataReportal, Digital 2026: Venezuela](https://datareportal.com/reports/digital-2026-venezuela)
- **[Dato]** Ookla, agosto 2026: descarga móvil 28,30 Mbps (puesto 96 de 149), subida móvil ~11 Mbps; banda ancha fija 127,20 Mbps de descarga (puesto 59) y 101,10 Mbps de subida. — [WorldData.info (Speedtest Global Index, ago. 2026)](https://www.worlddata.info/america/venezuela/telecommunication.php)
- **[Dato] (extracto)** Sistema operativo móvil, StatCounter: agosto 2026 Android 86,32 %, iOS 13,66 %; junio 2026 Android 85,65 %, iOS 14,33 %; mayo 2026 Android 83,42 %, iOS 16,55 %. — [StatCounter (extracto)](https://gs.statcounter.com/os-market-share/mobile/venezuela)
- **[Oficial] (extracto, cifras preliminares y con versiones contradictorias)** Conatel: 21.458.222 suscriptores de telefonía móvil (I trim. 2025); 25.354.391 suscriptores de internet (III trim. 2025); internet fijo 4.862.971 suscriptores, 56,86 % con fibra óptica; usuarios de internet +8,89 % interanual en el IV trim. 2025. — [Conatel, Internet III 2025 (extracto)](https://conatel.gob.ve/wp-content/uploads/2026/08/Presentacion_Internet-_III-2025.pdf); [Conatel, Telefonía Móvil I 2025 (extracto)](https://conatel.gob.ve/wp-content/uploads/2025/11/PRESENTACION_TM_I_2025.pdf)
- **[Dato, antiguo 2023]** Consultores 21: 48 % de hogares con internet; 68 % tiene teléfono inteligente; solo 54 % tenía datos de navegación al momento de la encuesta; 2 de cada 10 no están conectados a medios digitales; Andes, Capital y Central tienen mayor acceso. — [Finanzas Digital, 25-06-2023](https://finanzasdigital.com/solo-48-de-los-venezolanos-tiene-acceso-a-internet-en-sus-hogares/)
- **[Gremio]** Cavecom-e (feb. 2026): 79,1 % de adopción de telefonía móvil; 92 % de los más de 22,5 millones de usuarios móviles usa redes sociales, "especialmente WhatsApp"; 80 % del comercio electrónico se hace desde móviles. — [DPL News, 03-02-2026](https://dplnews.com/?p=304289)

**Redes sociales y mensajería**
- **[Dato]** 16,6 millones de identidades de usuario en redes sociales (oct. 2025; 58,1 % de la población; 94,3 % de los internautas; +14,3 % interanual). Por alcance publicitario: TikTok 16,6 millones (18+), Facebook 15,6 millones, Instagram 9,80 millones, LinkedIn 6,40 millones, Messenger 5,45 millones, Threads 940 mil, X 675 mil (-67 % en el año). — [DataReportal, Digital 2026: Venezuela](https://datareportal.com/reports/digital-2026-venezuela)
- **[Dato]** Sept. 2026: Facebook 20,10 millones; Messenger 16,07 millones; Instagram 10,93 millones; el grupo de 25 a 34 años es el mayor en todas. (Metodología distinta a DataReportal; no comparables.) — [NapoleonCat, sept. 2026](https://napoleoncat.com/stats/social-media-users-in-venezuela/)
- **[Dato, antiguo]** WhatsApp: 90 % de los internautas (Tendencias Digitales, 2022); 70 % de la población (Consultores 21, 2023). — [El Estímulo, 19-09-2022](https://elestimulo.com/tecnologia/2022-09-19/tendencias-digitales-que-dominan-internet-en-venezuela-en-2022/); [Finanzas Digital, 25-06-2023](https://finanzasdigital.com/solo-48-de-los-venezolanos-tiene-acceso-a-internet-en-sus-hogares/)
- **[Prensa]** Uso intensivo de redes para coordinarse: tras los sismos de mediados de 2026 los venezolanos usaron redes sociales para ubicar personas y coordinar ayuda. — [NPR vía WWNO, 15-07-2026](https://www.wwno.org/npr-news/2026-07-15/venezuelans-use-social-media-to-mobilize-recovery-efforts)

**Comercio electrónico**
- **[Dato, antiguo 2022]** Compradores en línea: 40 % de los internautas venezolanos frente a 60 % en Latinoamérica; banca digital 56 %; "entrar a los bancos" como uso de internet 77 %; 47 % familiarizado con pagar con criptomonedas (31 % en Latam). — [El Estímulo, 19-09-2022](https://elestimulo.com/tecnologia/2022-09-19/tendencias-digitales-que-dominan-internet-en-venezuela-en-2022/)
- **[Gremio]** "El 95 % de las transacciones del comercio electrónico se realizan de forma digital"; Cavecom-e prevé comercios 100 % automatizados para el último trimestre de 2026. — [DPL News, 03-02-2026](https://dplnews.com/?p=304289); [El Diario, 03-06-2026 (extracto)](https://eldiario.com/2026/06/03/comercios-automatizados-venezuela/)

**Diáspora y remesas**
- **[Dato]** R4V (actualización de agosto de 2026): 6.978.009 refugiados y migrantes venezolanos en América Latina y el Caribe. — [R4V, ago. 2026](https://www.r4v.info/es/refugiadosymigrantes)
- **[Dato] (extracto)** ~7,9 millones de venezolanos fuera del país a noviembre de 2024, más de 6,7 millones en los 17 países de R4V; principales receptores: Colombia, Perú, Ecuador, Chile y Brasil. — [The Objective, 08-12-2024 (extracto)](https://theobjective.com/internacional/2024-12-08/crisis-refugiados-venezuela-agrava/)
- **[Dato]** Diálogo Interamericano: Venezuela recibió ~6.000 millones de USD en remesas en 2025; ~8 millones viven fuera y 3,9 millones envían dinero regularmente; ~30 % de los hogares depende de remesas para consumo; solo ~15 % del mercado pasaba por vías tradicionales (bancos, casas de cambio); las remesas formales desde EE. UU. subieron de 5 % a 20 % en tres meses a inicios de 2026. — [AFP vía El Nacional, 23-02-2026](https://www.elnacional.com/2026/02/expertos-preven-que-las-remesas-a-venezuela-creceran-al-reducirse-la-brecha-cambiaria-con-las-aplicaciones-digitales-como-grandes-beneficiarias/)
- **Conflicto de cifras de remesas:** ~6.000 millones (Diálogo Interamericano, 2025) — [El Nacional, 23-02-2026](https://www.elnacional.com/2026/02/expertos-preven-que-las-remesas-a-venezuela-creceran-al-reducirse-la-brecha-cambiaria-con-las-aplicaciones-digitales-como-grandes-beneficiarias/); 3.500 a 4.000 millones y "más del 90 % fuera del sistema financiero formal" (Asdrúbal Oliveros, extracto) — [Diario Primicia (extracto)](https://primicia.com.ve/economia/remesas-en-venezuela-alcanzan-los-4-000-millones-anuales/); ~4.500 millones y 29 % de los hogares (sin fuente citada) — [Globovisión, 29-09-2025](https://www.globovision.com/economia/45350/migracion-venezolana-2025-el-impacto-de-las-remesas-y-los-desafios-de-la-diaspora)
- **[Gremio]** Expectativa 2026: billeteras digitales como "las grandes ganadoras"; depósitos en cuenta "creciendo enormemente" tras la caída de Maduro; hasta 3 millones de venezolanos podrían retornar en dos años (proyección de un directivo de Zinli). — [AFP vía Banca y Negocios, 23-02-2026](https://www.bancaynegocios.com/expertos-preven-auge-de-remesas-electronicas-hacia-venezuelabilleteras-digitales-van-a-ser-las-grandes-ganadoras/)
- **[Anécdota]** Diáspora y rifas: las bases de varias rifas limitan la participación a venezolanos o residentes legales en Venezuela y exigen retirar el premio en persona; Sorteo LV permite que un familiar autorizado reciba el premio; existen "rifas binacionales" en la frontera con Colombia. — [rifassell.com](https://rifassell.com/); [sorteolv.com](https://sorteolv.com/); [Focus Gaming News, 21-10-2025](https://focusgn.com/latinoamerica/el-estado-venezolano-de-tachira-busca-combatir-la-venta-ilegal-de-loteria)

**Inferencias de quien investigó**

- (Inferencia) Prioridades técnicas: web móvil ligera pensada para Android de gama de entrada (Tendencias Digitales atribuye el crecimiento del internet móvil a "móviles inteligentes de gama de entrada"), buen comportamiento con ~25 Mbps medianos y con usuarios que a veces no tienen datos (solo 54 % tenía datos al momento de la encuesta de 2023), imágenes comprimidas, subida de comprobantes tolerante a cortes y reintentos, y sin exigir instalar una app.
- (Inferencia) iOS ronda el 14 a 17 % y probablemente se concentra en compradores de mayor ingreso y en la diáspora; hay que probar la subida de comprobantes en Safari, pero el diseño base es Android con Chrome y los navegadores internos de Instagram, TikTok y WhatsApp.
- (Inferencia) La diáspora es un mercado potencial (3,9 millones de remitentes; Zelle, Binance y PayPal ya aceptados por algunos riferos), pero choca con las bases de las rifas y con la exclusión de rifas cobradas "exclusivamente en divisas". Un flujo de "comprar para un familiar en Venezuela" sería la forma compatible; es hipótesis.

**Vacíos**

- No se obtuvo el desglose por país de R4V a agosto de 2026 (está en una imagen) ni la cifra mundial vigente. No se accedió a ENCOVI ni al Banco Mundial.
- No hay cifra reciente (2025-2026) de penetración de WhatsApp ni de teléfonos inteligentes; las disponibles son de 2022-2023 o declaraciones gremiales.
- No se pudo abrir StatCounter ni Conatel directamente; sus cifras vienen de extractos. No se encontró un estudio de Tendencias Digitales de 2025-2026.
- No hay ningún dato sobre compra de boletos de rifa desde el exterior.

### Contexto de pagos: Pago Móvil, uso del dólar, Zelle, Binance y bancarización

**Conclusión**

Pago Móvil es la infraestructura de pago minorista del país: más de 20 millones de afiliados, cientos de millones de operaciones al mes, ticket promedio de ~17,6 USD y crecimiento a ~8.500 operaciones por minuto en 2026. La economía se "rebolivarizó" en el pago (75 a 80 % o más de las transacciones en bolívares en 2024-2025) aunque los precios se siguen pensando en dólares; Zelle es un segmento menor del pago en divisas (16 % de ese subconjunto) y USDT/Binance es la referencia cambiaria informal y un medio en crecimiento, sin cifra fiable de cuota.

**Hallazgos con fuente**

**Pago Móvil**
- **[Dato]** BCV (vía Debates IESA): 376 millones de operaciones con pago móvil a abril de 2025; concentra 41 % de las operaciones bancarias frente a 47 % de los puntos de venta; crecimiento de 68.134 % en ocho años (lanzado en octubre de 2017). "Más de veinte millones de venezolanos están afiliados"; más de veinte bancos. — [Debates IESA, 08-12-2025](https://www.debatesiesa.com/el-pago-movil-es-el-rey-de-las-transferencias-inmediatas-en-venezuela/)
- **[Prensa, sin atribución clara]** "El pago móvil interbancario mueve el equivalente a 3.000 millones de dólares por mes"; ticket promedio ~17,60 USD (llegó a ~20 USD en 2023); algo más del 60 % de las operaciones todavía se captan por digitación manual (Suiche 7B); cuatro bancos ofrecen pago móvil por NFC. — [Debates IESA, 08-12-2025](https://www.debatesiesa.com/el-pago-movil-es-el-rey-de-las-transferencias-inmediatas-en-venezuela/)
- **[Gremio]** Cavecom-e: Pago Móvil "concentra 63 % de las transacciones financieras"; superó las 8.500 transacciones por minuto para junio de 2026; el volumen acumulado "podría situarse en torno a los 70.000 millones de dólares para finales de año" (proyección). — [El Nacional, 08-10-2026](https://www.elnacional.com/2026/10/sistema-de-pago-movil-concentra-63-de-las-operaciones-financieras-en-venezuela/)
- **Conflicto de fuentes:** las 6.000 transacciones por minuto se fechan en 2023 — [El Nacional, 08-10-2026](https://www.elnacional.com/2026/10/sistema-de-pago-movil-concentra-63-de-las-operaciones-financieras-en-venezuela/) — o en 2025 — [Finanzas Digital, 27-08-2026](https://finanzasdigital.com/pago-movil-alcanza-8500-transacciones-por-minuto/). El volumen mensual aparece como más de 3.000 millones de USD o como más de 360 millones según la nota (extractos) — [Bitácora Económica](https://bitacoraeconomica.com/pago-movil-interbancario-transa-mas-de-3-000-millones-mensuales/); [Bitácora Económica](https://bitacoraeconomica.com/suiche-7b-mas-de-360-millones-mensuales-se-transan-en-venezuela-por-pago-movil/). El 63 % de Cavecom-e no cuadra con el 41 % del BCV (metodologías distintas).
- **[Oficial]** Tarifario BCV de 2026: el tope de comisión de Pago Móvil pasó de Bs. 2 a Bs. 14 (+600 %). — [Finanzas Digital, 27-08-2026](https://finanzasdigital.com/pago-movil-alcanza-8500-transacciones-por-minuto/)
- **[Oficial] (extracto)** Gaceta Oficial N.º 46.427 del 31-07-2026: comisiones de hasta 0,30 % para operaciones persona a persona (P2P), 1,5 % persona a comercio (P2C) y 2 % comercio a persona (C2P). — [Finanzas Digital (extracto)](https://finanzasdigital.com/pagar-un-pasaje-por-pago-movil-ahora-cuesta-mas-cuanto/)
- **[Gremio]** "El 99 % de las operaciones se realizan de forma digital y en bolívares" (Ujueta, ago. 2026). — [Finanzas Digital, 27-08-2026](https://finanzasdigital.com/pago-movil-alcanza-8500-transacciones-por-minuto/)

**Uso del dólar**
- **[Dato]** Ecoanalítica, cierre de 2024: 24,7 % de los pagos en divisas (16 % en dólares). — [Finanzas Digital, 11-02-2025](https://finanzasdigital.com/transacciones-bolivares-supermercados-venezuela-2025/)
- **[Dato]** Ecoanalítica, 2025 (49.000 transacciones, 604 establecimientos, 10 ciudades): más del 80 % de las operaciones comerciales en moneda local; las divisas cayeron a ~10 %, "principalmente en efectivo"; efectivo en dólares en circulación por debajo de 5.000 millones de USD en abril de 2025, más de 35 % menos que en noviembre de 2024. — [Bloomberg Línea, 06-06-2025](https://www.bloomberglinea.com/latinoamerica/venezuela-esta-realmente-ante-una-rebolivarizacion-de-su-economia-el-dolar-sigue-fuerte/)
- **[Dato]** OVF, abril 2025: 53 % de las transacciones en bolívares y 47 % en divisas; "no se puede hablar de una rebolivarización" (José Guerra); "los venezolanos tienden a conservar sus dólares". — [Bloomberg Línea, 06-06-2025](https://www.bloomberglinea.com/latinoamerica/venezuela-esta-realmente-ante-una-rebolivarizacion-de-su-economia-el-dolar-sigue-fuerte/)
- **[Gremio]** Supermercados: 95 % de las transacciones en bolívares a febrero de 2025 (ANSA). — [Finanzas Digital, 11-02-2025](https://finanzasdigital.com/transacciones-bolivares-supermercados-venezuela-2025/)
- **[Dato, antiguo 2021]** Pico de dolarización: 67 % de las transacciones en moneda distinta al bolívar en las diez principales ciudades (Ecoanalítica, marzo de 2021). — [Diario Las Américas, 11-04-2021](https://www.diariolasamericas.com/america-latina/mas-del-65-las-transacciones-venezuela-se-pagan-moneda-extranjera-n4220267)
- **[Gremio]** Se prevé escasez de dólares en billetes en 2026, lo que favorecería las transferencias electrónicas. — [AFP vía Banca y Negocios, 23-02-2026](https://www.bancaynegocios.com/expertos-preven-auge-de-remesas-electronicas-hacia-venezuelabilleteras-digitales-van-a-ser-las-grandes-ganadoras/)

**Zelle, Binance y cripto**
- **[Dato]** "Zelle y aplicaciones similares" representan 16 % de los pagos en divisas (no del total) y las billeteras digitales 8 %; cripto 1,8 % del total de pagos nacionales (Ecoanalítica, cierre de 2024). — [Finanzas Digital, 11-02-2025](https://finanzasdigital.com/transacciones-bolivares-supermercados-venezuela-2025/)
- **[Dato]** Venezuela ocupa el puesto 18 mundial en adopción cripto y el 9 ajustado por población (Chainalysis, 2025). TRM Labs: más del 38 % de las visitas desde IP venezolanas a sitios cripto iban a una sola plataforma global con P2P (es tráfico web, no volumen); el uso de stablecoins está "impulsado abrumadoramente por la necesidad" (nómina, remesas familiares, pagos a proveedores). — [Cointelegraph, 14-12-2025](https://cointelegraph.com/news/venezuela-crypto-reliance-stablecoins-economic-crisis)
- **[Prensa]** "La escasez de divisas catalizó un crecimiento práctico… del ecosistema de las criptomonedas" en el segundo semestre de 2025; USDT como "dólar digital cotidiano" (encuadre editorial, sin cifras). — [CriptoNoticias, 29-12-2025](https://www.criptonoticias.com/comunidad/adopcion/usdt-valvula-oxigeno-economia-venezuela-2025/)

**Bancarización**
- **[Gremio]** Cavecom-e (feb. 2026): 94 % de la población con acceso a servicios financieros digitales, "la tasa más alta de Latinoamérica" (sin estudio ni metodología citados). — [DPL News, 03-02-2026](https://dplnews.com/?p=304289)

**Inferencias de quien investigó**

- (Verificación aritmética propia) 8.500 operaciones por minuto sostenidas equivalen a ~12,2 millones al día y ~367 millones al mes, mismo orden de magnitud que los 376 millones del BCV. En cambio, 3.000 millones de USD al mes entre 17,60 USD da ~170 millones de operaciones: las cifras de volumen y de conteo no son coherentes entre sí, probablemente porque mezclan interbancario con total.
- (Inferencia) El precio típico de un boleto de rifa (0,5 a 5 USD) está muy por debajo del ticket promedio de Pago Móvil (17,6 USD): las rifas generan muchas operaciones pequeñas, con lo que conciliar referencias es el problema operativo central, y las nuevas comisiones porcentuales (hasta 1,5 % si el organizador cobra como comercio) pasan a ser un costo visible.
- (Inferencia) Zelle es minoritario a escala nacional; como método de rifas pesa en compras de varios boletos y en la diáspora. USDT importa más como referencia de tasa que como medio de pago masivo.
- (Inferencia) No hay pasarela venezolana integrada en los SaaS observados; la validación automática de Pago Móvil (API bancaria, C2P o conciliación) sería un diferenciador, sujeto a viabilidad con bancos locales.

**Vacíos**

- No se accedió a boletines de Sudeban ni del BCV; todas las cifras de Pago Móvil vienen de prensa o de gremios y son inconsistentes entre sí.
- No hay cifra pública del número de usuarios venezolanos de Zelle o de Binance, ni de cuentas bancarias por adulto de fuente independiente (el 94 % es declaración gremial).
- No se halló la cifra de Ecoanalítica para 2026 sobre el uso de divisas; la más reciente verificada es de mediados de 2025. La cifra de 44.600 millones de USD en volumen cripto (jul. 2024 a jun. 2025) aparece solo en blogs secundarios y no se pudo verificar contra Chainalysis.

### Estacionalidad: ¿hay picos en diciembre, Día de las Madres, Carnaval o regreso a clases?

**Conclusión**

Solo hay evidencia débil: la prensa de 2022 liga el repunte de bingos y rifas a la Navidad, y un gran rifero vendía "combos" temáticos de Año Nuevo. No se encontró ninguna medición ni reportaje sobre picos en Día de las Madres, Carnaval o regreso a clases.

**Hallazgos con fuente**

- **[Prensa, 2022]** "Con la llegada de la Navidad" los bingos comunitarios recuperaron impulso con premios más atractivos (vehículos, efectivo, cestas de comida, cuñetes de pintura). — [AFP vía Telemetro, 11-11-2022](https://www.telemetro.com/internacionales/carros-comida-efectivo-bingos-y-rifas-cobran-nuevo-auge-venezuela-n5801449)
- **[Anécdota] (extracto)** Brayan Lucena vendía un "combo de Año Nuevo" (Bs. 310) y un "Combo Quinceañera". — [brayanlucena.com/compra (extracto)](https://brayanlucena.com/compra)
- **[Anécdota] (extracto)** Una rifa en RifasVE fijó su sorteo para el 1 de diciembre. — [monstergarage.rifasve.com (extracto)](https://monstergarage.rifasve.com/)
- **[Prensa]** Oportunismo por evento: una rifa falsa "El Quinto Sueño Mundial" explotó a la vez el Mundial y el sismo de junio de 2026. — [El Nacional, 12-07-2026](https://www.elnacional.com/2026/07/detenido-un-hombre-en-maracaibo-por-promover-rifas-ilegales-a-nombre-de-los-damnificados-por-terremotos/)
- **[Oficial]** La norma limita las rifas ocasionales a cuatro por año espaciadas tres meses y las promocionales a una vigencia de 1 a 3 meses, lo que condiciona el calendario del organizador formal. — [Diseño Digital](https://disenodigitalec.com/informativo/todo-sobre-la-nueva-providencia-001-de-conalot-guia-para-realizar-rifas-legales-en-venezuela/); [La Nación, 20-03-2026](https://lanacionweb.com/nacional/rifas-en-redes-sociales-en-venezuela-conalot-advierte-sobre-requisitos-legales-para-evitar-estafas/)

**Inferencias de quien investigó**

- (Inferencia) Es plausible un pico en noviembre y diciembre (aguinaldos, utilidades, remesas navideñas y tradición de bingos), pero no está medido. Con un máximo de cuatro rifas ocasionales al año, un organizador formal tenderá a ubicarlas en fechas comerciales fuertes (diciembre, Día de las Madres en mayo, vacaciones de agosto); es hipótesis a validar con organizadores.
- (Inferencia) Lanzar en octubre de 2026 coincide con la preparación de la temporada decembrina, la única con respaldo documental.

**Vacíos**

- Sin datos ni reportajes sobre Día de las Madres, Carnaval, Semana Santa o regreso a clases. La búsqueda específica no pudo ejecutarse por el límite de consultas de la sesión.
- No hay series de ventas por mes de ningún organizador ni de proveedores de software.

### Diferencias regionales dentro de Venezuela

**Conclusión**

Táchira es el centro simbólico e institucional (la Lotería del Táchira y Súper Gana como referencia de sorteo, agencias de rifas con sede física, rifas binacionales con Colombia); Zulia aparece como "epicentro" de las rifas de vehículos y de varios casos policiales; Portuguesa, Lara, Carabobo, Anzoátegui, Bolívar y Caracas tienen operadores visibles. No hay cifras comparables por estado.

**Hallazgos con fuente**

- **[Prensa]** Táchira: la Lotería del Táchira es la referencia de resultados en plantillas de rifa de todo el país; procedimientos del Sebin en "reconocidas agencias de rifas" de Barrio Obrero (San Cristóbal) y Capacho; el gobernador Freddy Bernal dijo en abril de 2025 que algunas rifas seguían operando clandestinamente; rifas binacionales e influencer detenido en la frontera. — [rifassell.com](https://rifassell.com/); [La Nación, 23-03-2026](https://lanacionweb.com/sucesos/procedimientos-contra-riferos-en-tachira-y-otros-estados/); [La Gran Aldea, 25-03-2026](https://lga.lagranaldea.com/2026/03/25/quienes-son-y-que-pasa-con-los-riferos-en-venezuela/); [Focus Gaming News, 21-10-2025](https://focusgn.com/latinoamerica/el-estado-venezolano-de-tachira-busca-combatir-la-venta-ilegal-de-loteria)
- **[Extraoficial]** Zulia: señalado como "uno de los principales epicentros"; operativo "Tus Coches" en Maracaibo; rifa falsa de julio de 2026 y caso de la moto no entregada; "Rafucho el Maracucho" como rostro de un operador nuevo. — [Bitácora 58, 19-03-2026](https://bitacora58.com/cae-la-mafia-de-los-riferos-supuestas-detenciones-son-un-secreto-a-vox-populi/); [Noticias Barquisimeto, 23-03-2026](https://www.noticiasbarquisimeto.com/rifas-en-la-mira-venezuela-lanza-fuerte-ofensiva-contra-los-riferos-ilegales/); [La Gran Aldea, 18-04-2026](https://lagranaldea.com/2026/04/18/en-medio-de-la-tormenta-el-negocio-de-las-rifas-digitales-sigue-viento-en-popa/)
- **[Prensa/Extraoficial]** Procedimientos simultáneos en Zulia, Táchira, Portuguesa, Anzoátegui (Lechería: "flotas de vehículos de alta gama"), Carabobo y Distrito Capital; se esperaba extensión a Barquisimeto (Lara). Portuguesa: origen de Brayan Lucena e intervención de una "reconocida agencia de sorteos". — [Noticias Barquisimeto, 23-03-2026](https://www.noticiasbarquisimeto.com/rifas-en-la-mira-venezuela-lanza-fuerte-ofensiva-contra-los-riferos-ilegales/); [El Diario, 26-03-2026](https://eldiario.com/2026/03/26/todo-lo-que-se-sabe-sobre-investigacion-riferos-redes-sociales-venezuela/)
- **[Prensa]** Ciudades citadas con cuentas de rifas de vehículos: Barquisimeto, Maracaibo, Valencia y Caracas. Carabobo: Conalot inspeccionó 16 sujetos obligados en Valencia y Los Guayos (extracto). — [Noticias Barquisimeto, 25-03-2026](https://www.noticiasbarquisimeto.com/riferos-utilizan-dinero-sucio-de-mafias/); [Sigma World (extracto)](https://sigma.world/es/news/conalot-fiscaliza-loterias-rifas-no-registradas-venezuela/)
- **[Prensa]** Guayana (Bolívar): tradición de bingos comunitarios con vehículos de premio (San Félix, 2022) y el operador @emprendeconsupergana_ en 2026. — [AFP vía Telemetro, 11-11-2022](https://www.telemetro.com/internacionales/carros-comida-efectivo-bingos-y-rifas-cobran-nuevo-auge-venezuela-n5801449); [La Gran Aldea, 18-04-2026](https://lagranaldea.com/2026/04/18/en-medio-de-la-tormenta-el-negocio-de-las-rifas-digitales-sigue-viento-en-popa/)
- **[Prensa]** Caracas: rifas de calle en barrios populares (2022), comercios que rifan vehículos y la valla de Lotoyei. — [EFE vía Diario de Los Andes, 06-10-2022](https://diariodelosandes.com/la-venta-de-rifas-para-sorteos-de-ocio-a-negocio); [La Gran Aldea, 12-06-2026](https://lagranaldea.com/2026/06/12/tres-meses-despues-el-caso-de-los-riferos-sigue-rodeado-de-rumores-sin-confirmar/)
- **[Dato, antiguo 2021]** Moneda de pago por ciudad (Ecoanalítica, marzo de 2021): San Cristóbal 98 % en moneda distinta al bolívar y 90 % en pesos colombianos; Maracaibo 92 % en divisas; Nueva Esparta 97 %; Lechería 69 %; Caracas 61 %; Valencia 58 %; en Puerto Ordaz 15 % en reales y 7 % en oro. — [Diario Las Américas, 11-04-2021](https://www.diariolasamericas.com/america-latina/mas-del-65-las-transacciones-venezuela-se-pagan-moneda-extranjera-n4220267)
- **[Dato]** Loterías regionales con sorteos propios y horarios distintos: Triple Táchira (1:15 PM, 4:45 PM, 10:10 PM), Triple Zulia (12:45 PM, 4:45 PM, 7:05 PM), Triple Zamorano (cinco sorteos diarios). — [tuazar.com, 13-10-2026](https://www.tuazar.com/loteria/resultados/)
- **[Dato, antiguo 2023]** Andes, Capital y Central registran mayor acceso a internet en el hogar, a teléfonos inteligentes y a datos. — [Finanzas Digital, 25-06-2023](https://finanzasdigital.com/solo-48-de-los-venezolanos-tiene-acceso-a-internet-en-sus-hogares/)

**Inferencias de quien investigó**

- (Inferencia) Para producto: lotería de referencia configurable con las regionales precargadas (Táchira, Zulia, Zamorano y animalitos); posibilidad de mostrar pesos colombianos en la frontera andina, donde el peso fue la moneda de uso (dato de 2021 que habría que revalidar); y prioridad comercial en el eje Táchira, Zulia, Lara, Portuguesa y Carabobo, que concentra los operadores visibles.
- (Inferencia) Táchira tiene la cultura de rifa más institucionalizada (agencias con sede, vínculo con la lotería estatal) y Zulia la más asociada a vehículos e influencers; es una lectura cualitativa de la prensa, no una medición.

**Vacíos**

- No hay datos por estado de número de organizadores, ventas o preferencias de lotería. Oriente (Anzoátegui, Monagas, Sucre, Nueva Esparta) casi no aparece en las fuentes salvo Lechería.
- El dato de moneda por ciudad es de 2021 y la economía se rebolivarizó desde entonces; no se halló actualización regional.
- No se confirmó el uso de Triple Zulia o Triple Caracas como referencia en rifas reales.

## 8. Pagos e integraciones

Qué se puede automatizar en la confirmación de pagos, de dónde sacar la tasa, cómo avisar por mensajería y cómo cobrar las suscripciones.

### Automatización de Pago Móvil: qué bancos ofrecen API para verificar o cobrar (C2P, P2C, botón de pago, conciliación)

**Conclusión**

Sí existen APIs bancarias para verificar un Pago Móvil recibido por referencia y para cobrar por C2P o Débito Inmediato, pero son por banco, casi todas exigen cuenta jurídica, contrato y gestión con un ejecutivo, y solo Banesco, Banplus y Banco Activo las describen públicamente; del resto (BDV, Mercantil, BNC, BVC, Tesoro, R4) lo que se sabe proviene de integradores. No hay precios públicos de las APIs: el costo visible es la comisión regulada por el BCV (P2C hasta 1,50 %, C2P hasta 2 %, mínimo Bs. 14,00).

**Hallazgos con fuente**

**Banesco (oficial)**
- La página "APIs Banesco" describe tres servicios para empresas: Vuelto P2P, Confirmación de Transacción y Consulta de Cuenta — [Banesco, APIs Banesco](https://www.banesco.com/empresas/soluciones-digitales/apis-banesco/)
- Confirmación de Transacción valida transferencias y PagoMóvil recibidos desde cualquier banco (moneda nacional o extranjera, débitos y créditos); se consulta por referencia + teléfono + banco + fecha de pago, o por número de cuenta + rango de fechas; horario 2:00 a.m. a 11:55 p.m.; hasta 30 días hacia atrás; hasta 25.000 resultados; la página indica "sin costos ni comisiones" — [Banesco, APIs Banesco](https://www.banesco.com/empresas/soluciones-digitales/apis-banesco/)
- Vuelto P2P envía un PagoMóvil al cliente (solo a persona natural), con límite de Bs. 12.000,00 por vuelto; pide teléfono, cédula, banco, monto y concepto — [Banesco, APIs Banesco](https://www.banesco.com/empresas/soluciones-digitales/apis-banesco/)
- La página no publica requisitos de contratación, proceso de solicitud, tiempo de implementación ni sandbox; el menú enlaza a un portal "BanescoAPIs" sobre 3scale cuyo catálogo incluye "Consulta Transacciones" (snippet) — [Banesco, APIs Banesco](https://www.banesco.com/empresas/soluciones-digitales/apis-banesco/); [Portal 3scale Banesco](https://3scale.apps.proplakur.banesco.com/doc-apis/productsapi)
- Botón verde BanescoPagos: botón de cobro para web o app; el cliente Banesco paga con cargo en cuenta (credenciales BanescOnline + clave de operaciones especiales) y el cliente de otro banco paga por débito inmediato (banco, cuenta o teléfono, cédula y código de autorización) — [Banesco, Botón verde BanescoPagos](https://www.banesco.com/empresas/soluciones-digitales/boton-de-pagos-banescopagos/)
- Solo puede solicitarlo una persona jurídica que tenga sitio de comercio electrónico o app móvil; la puesta en marcha toma unas 3 semanas (trámites internos y configuración del banco) más unas 2 semanas para configurar la redirección; la comisión la paga la empresa recaudadora (el pagador no paga) y el monto no se publica: remite al ejecutivo o agencia — [Banesco, Botón verde BanescoPagos](https://www.banesco.com/empresas/soluciones-digitales/boton-de-pagos-banescopagos/)
- El botón no se concilia por archivo TXT: la empresa debe usar la "API Consulta" para validar el estado de cada transacción; los precios en divisas deben convertirse a bolívares antes del pago; cada cuenta bancaria requiere su propio botón — [Banesco, Botón verde BanescoPagos](https://www.banesco.com/empresas/soluciones-digitales/boton-de-pagos-banescopagos/)

**Mercantil (portal oficial; detalle vía terceros)**
- Existe un "Portal de APIs" de Mercantil; su contenido se carga dinámicamente y no pudo leerse en esta investigación (solo devolvió el título) — [Mercantil, Portal de APIs](https://apiportal.mercantilbanco.com/mercantil-banco/produccion/)
- Según el resumen del buscador sobre ese portal, la empresa debe ser cliente Mercantil, estar afiliada a Mercantil en Línea Empresas y afiliarse al servicio C2P para desarrollar la "API Pagos Móviles C2P" (snippet; el resumen advierte que la página tiene años de antigüedad) — [Mercantil, Portal de APIs](https://apiportal.mercantilbanco.com/mercantil-banco/produccion/)
- Un integrador documenta el alta: registrarse en el portal con los datos fiscales de la empresa, crear una aplicación y obtener Merchant ID, Client ID y Client Secret; requiere Cuenta Corriente Jurídica; habilita Validación de Pago Móvil, Cobro C2P y reembolsos; hay modo sandbox contra el entorno de certificación del banco — [Cachicamo, Pago Móvil Mercantil](https://docs.cachicamo.app/payments/pago-movil-mercantil)
- Para Mercantil la verificación no funciona solo con la referencia: es obligatorio el tipo de consulta `MOVIL_PAY`, que exige cédula del pagador, teléfono del pagador, banco de origen (código de 4 dígitos) y monto — [Pabilo, Verificar Pagos API](https://pabilo.app/docs/verify-payments)
- Un modelo de contrato describe el "Portal de API Mercantil" como el sitio donde el banco expone APIs y documentación, enfocado en pagos con tarjeta de crédito/débito para tiendas en línea (snippet) — [Law Insider, contrato Mercantil](https://www.lawinsider.com/es/contracts/hSfId3AaCnN)
- Existe una librería PHP de terceros para el botón de tarjetas de Mercantil que requiere client ID, merchant ID y clave de cifrado entregados por el banco, con bandera sandbox/producción (snippet) — [Packagist, josepratolopez/mercantil-ve](https://packagist.org/packages/josepratolopez/mercantil-ve)

**Banco de Venezuela (BDV) — sin documentación pública oficial hallada**
- Integradores describen una "API oficial" de conciliación de Pago Móvil del BDV, limitada a empresas con Cuenta Jurídica, sujeta a aprobación previa del banco y a "condiciones confidenciales"; el trámite se inicia en la agencia comercial y el proveedor advierte que no reembolsa si el banco rechaza el modelo de negocio o revoca el acceso — [Cujiware, plugin BDV para WooCommerce](https://cujiware.com/plugins/venezuela/woocommerce/boton-de-pago-movil-del-banco-de-venezuela-para-woocommerce)
- La credencial se denomina "API Token / Clave de Conciliación" y se solicita al ejecutivo de cuenta o a la gerencia de canales electrónicos del BDV; se configura con la cuenta corriente de 20 dígitos, RIF y teléfono de Pago Móvil del comercio; hay una "URL API de Pruebas" opcional del entorno de certificación — [Cachicamo, Pago Móvil BDV](https://docs.cachicamo.app/payments/pago-movil-bdv)
- En el plugin se configura un `X-API-Key` "proporcionada por el banco" y una URL de endpoint; el cliente debe aportar tipo y número de documento, teléfono, referencia de 6 dígitos, fecha, banco de origen y monto — [Cujiware Docs, BDV Conciliación](https://docs.cujiware.com/plugins/boton-de-pago-movil-del-banco-de-venezuela-para-woocommerce)
- La matriz de un integrador indica que BDV permite validación de Pago Móvil y vuelto/crédito, pero no cobro C2P ni Débito Inmediato por esta vía — [Cachicamo, Conciliación Bancaria Venezuela](https://docs.cachicamo.app/payments/venezuela)
- En la comunidad Odoo se describe que el BDV "permite consultar efectividad del pago y crear el registro; sin más endpoints" (snippet) — [OCA/l10n-venezuela, issue #65](https://github.com/OCA/l10n-venezuela/issues/65)
- El BDV también lanzó "Pago Clave a Comercios" vía SMS para clientes jurídicos (cobro sin punto de venta) (snippet) — [NTN24](https://www.ntn24.com/noticias-economia/banco-de-venezuela-activo-pago-clave-a-comercios-para-negocios-sin-punto-de-venta-97139)

**BNC, Banco Venezolano de Crédito (BVC), Banco del Tesoro — vía terceros**
- BNC: requiere cuenta jurídica y un "Contrato de Servicios Electrónicos BNC"; la afiliación al servicio de cobros electrónicos se pide al ejecutivo de cuentas en la agencia; las credenciales son Client GUID, Master Key, Terminal (terminal virtual), número de afiliación y cuenta de 20 dígitos; soporta validación de Pago Móvil (P2C), cobro C2P y Débito Inmediato; existe modo sandbox — [Cachicamo, Pago Móvil BNC](https://docs.cachicamo.app/payments/pago-movil-bnc)
- BVC: requiere cuenta jurídica y un paquete de credenciales (Key, HS, IV) que se solicita al ejecutivo de cuenta; soporta validación de Pago Móvil, C2P, Débito Inmediato, Crédito Inmediato para vueltos/reembolsos y tarjetas — [Cachicamo, Pago Móvil BVC](https://docs.cachicamo.app/payments/pago-movil-bvc)
- Banco del Tesoro: el integrador afirma que la validación funciona con cuenta jurídica o personal, solo con cédula/RIF y teléfono de Pago Móvil del titular, "sin solicitar tokens o claves complejas al banco"; no ofrece C2P por esa vía — [Cachicamo, Pago Móvil BT](https://docs.cachicamo.app/payments/pago-movil-bt); [Cachicamo, matriz de bancos](https://docs.cachicamo.app/payments/venezuela)
- Otro integrador sí lista para el Tesoro "BT Pagos" con C2P y validador de pagos móviles, y para R4 "C2P y validador clásico de pagos móviles" — [Cujiware, Pasarelas de pago Venezuela](https://cujiware.com/pasarelas-pago-venezuela)

**Banplus, Banco Activo, R4, Bancamiga, Banco Plaza**
- Banplus (oficial) publica "Integraciones APIs": Validación de pago móvil, Validación de transferencias, Notificación de transacciones, Consulta de estado de cuenta y Consulta de saldo; ofrece conexión directa o mediante un "aliado tecnológico" avalado por el banco; no publica requisitos, costos, sandbox ni documentación — [Banplus, Integraciones APIs](https://www.banplus.com/integraciones-apis/)
- Banco Activo habilitó una sección de APIs para empresas, fintech y desarrolladores: consultas de pago móvil, transferencias, movimientos y tasa oficial BCV; ejecución de pagos móviles a comercios (P2C) y transferencias; validadores automáticos y notificaciones por Webhooks; el alta es un formulario tras el cual contacta un equipo técnico-comercial; sin precios (nota de prensa del 24-ago-2026) — [Ecosistema Startup](https://ecosistemastartup.com/activo-banco-universal-lanza-apis-para-empresas-en-venezuela/)
- R4 (antes "Mi Banco"): los términos de R4 Cobro Móvil mencionan "R4 Rest API (Integración para Desarrolladores)" para integrar el servicio con sistemas internos de grandes empresas, y productos Flow (cobros individuales), Mass Flow (cobros masivos por CSV) y Recurring (cobros programados) (snippet) — [R4 Cobro Móvil, Términos y Condiciones](https://cobromovil.r4conecta.io/users/legal/terminos/)
- Bancamiga: un integrador indica que su API cubre solo tarjetas Visa/Mastercard internacionales; la app Bancamiga Suite ofrece pagos P2C y C2P a nivel de usuario (snippet) — [Cujiware](https://cujiware.com/pasarelas-pago-venezuela); [Google Play, Bancamiga Suite](https://play.google.com/store/apps/details?id=com.bancamiga&hl=en_US)
- Banco Plaza firmó la alianza INTERFINTECH con la Asociación Venezolana de FinTech y Nuevas Tecnologías, sobre plataforma de Ab4cus Tecnología, citada como precedente de banca abierta — [Ecosistema Startup](https://ecosistemastartup.com/activo-banco-universal-lanza-apis-para-empresas-en-venezuela/)

**Mecánica del C2P y comisiones reguladas**
- En C2P el comercio debita al cliente con una clave de un solo uso que el cliente genera en su banco: BDV por SMS al 2662 ("CLAVE DE PAGO"), Banesco por SMS al 2846 ("clave dinámica"), Mercantil por SMS al 24024 ("SCP"), Tesoro por app o SMS al 2383, Bancamiga desde Bancamiga Suite; se piden teléfono, cédula y banco del cliente más la clave — [Cujiware](https://cujiware.com/pasarelas-pago-venezuela)
- Tarifario oficial del BCV "vigente desde el 15/09/2026, Gaceta Oficial Extraordinaria N° 7.073": Pago Móvil Interbancario P2P hasta 0,30 % (mínimo Bs. 14,00); P2C hasta 1,50 % (mínimo Bs. 14,00); C2P hasta 2 % (mínimo Bs. 14,00); operaciones rechazadas o reversadas Bs. 14,00 cada una; entre cuentas del mismo banco el C2P baja a hasta 1,75 % — [BCV, tarifario (PDF)](https://www.bcv.org.ve/system/files/documentos/171.pdf)
- El mismo tarifario fija, vía Cámara de Compensación Electrónica: Crédito Inmediato de persona natural a persona jurídica privada hasta 1,50 % "pagado por el receptor" (mínimo Bs. 14,00); demás Crédito Inmediato hasta 0,30 % pagado por el ordenante; Débito Inmediato hasta 2 % "pagado por el ordenante" (mínimo Bs. 14,00) — [BCV, tarifario (PDF)](https://www.bcv.org.ve/system/files/documentos/171.pdf)
- La prensa atribuye el ajuste previo a la Gaceta Oficial N° 43.427 del 31-jul-2026 (mínimo de Pago Móvil de Bs. 2 a Bs. 14) y aclara que son topes, no necesariamente lo que cobra cada banco — [El Diario, 16-ago-2026](https://eldiario.com/2026/08/16/comisiones-bancarias-bcv/); [Acceso a la Justicia](https://accesoalajusticia.org/aumento-de-las-comisiones-y-tarifas-bancarias/); contradicho en el número de Gaceta por [Finanzas Digital](https://finanzasdigital.com/bcv-publica-nuevas-tarifas-bancarias-y-modifica-comisiones-de-pago-movil/), que escribe "N.º 46.427"

**Inferencias de quien investigó**

- Para un organizador de rifas que es persona natural, la verificación oficial por API está prácticamente cerrada en BDV, Mercantil, BNC, BVC y el Botón verde de Banesco (todas piden cuenta jurídica); las excepciones reportadas son Banco del Tesoro (según un integrador) y agregadores como Pabilo (ver pregunta 3).
- El patrón común de verificación es "consulta puntual": el sistema envía referencia y, según el banco, teléfono/cédula/banco de origen/monto/fecha, y el banco responde si el abono existe. Solo Banplus ("Notificación de transacciones") y Banco Activo (Webhooks) describen notificación entrante; el formulario de pago actual (referencia + captura) debería pedir también teléfono, cédula y banco de origen del pagador para ser compatible con Mercantil y BDV.
- Ninguna API pública cobra por consulta según lo publicado (Banesco declara costo cero); el costo real es la comisión P2C/C2P/Débito Inmediato que el banco descuenta al comercio. Con mínimo de Bs. 14,00 por operación (≈ USD 0,016 a la tasa BCV de 877,90 Bs/USD), el mínimo no es relevante para boletos de pocos dólares.
- Los tiempos de alta dependen del ejecutivo del banco; el único dato publicado es el de Banesco (≈3 + 2 semanas para el botón).
- "C2P" y "P2C" se usan de forma inconsistente entre proveedores; conviene confirmar con cada banco el sentido del flujo.

**Vacíos**

- No se halló documentación pública oficial de API para BDV, BNC, Provincial (BBVA), Bancaribe, 100% Banco ni Bancamiga (Pago Móvil); tampoco precios, SLA ni volúmenes mínimos de ninguna API bancaria.
- No se pudo leer el catálogo del Portal de APIs de Mercantil (render dinámico) ni confirmar la vigencia de sus requisitos C2P.
- No se confirmó si la afirmación de que el Tesoro valida cuentas personales sin credenciales del banco corresponde a un servicio oficial o a otra técnica del integrador.
- No se confirmó quién paga la comisión P2C en el tarifario (la línea de Pago Móvil no lo dice; la de Crédito Inmediato natural→jurídica sí: el receptor).
- Hay dos referencias de Gaceta para tarifarios de 2026 (N° 43.427 del 31-jul-2026 en prensa; Extraordinaria N° 7.073 vigente desde 15-sep-2026 en el PDF del BCV); no se verificó la relación entre ambas.

### Pasarelas y agregadores venezolanos utilizables por un negocio pequeño

**Conclusión**

El mercado de pasarelas locales está orientado a personas jurídicas con cuenta en un banco concreto y casi ninguna publica tarifas ni documentación abierta; lo más accesible para un negocio pequeño son los plugins/integradores sobre APIs bancarias y Binance Pay. No se halló ninguna pasarela local con alta autoservicio, API pública y precios publicados comparable a Stripe.

**Hallazgos con fuente**

- Mega Soft: descrita como validación automatizada de pagos y múltiples formas de pago; requiere cuenta jurídica en cualquier banco nacional (terceros, sin fecha, © 2026) — [Cujiware](https://cujiware.com/pasarelas-pago-venezuela)
- InstaPago: solo tarjetas de crédito; requiere cuenta jurídica en Banesco o Mercantil. Sitef: solo tarjetas de crédito; requiere cuenta en Mercantil (terceros) — [Cujiware](https://cujiware.com/pasarelas-pago-venezuela)
- Sitef ofrece además un plugin "Pago Móvil (P2C)" para WooCommerce en el que el cliente ingresa los datos de su pago y el sistema valida el estado automáticamente (snippet) — [PasarelasDePagos.com](https://www.pasarelasdepagos.com/shop/ecommerce-venezuela/woocommerce-venezuela/sitef-pago-movil-p2c-woocommerce-venezuela/)
- Biopago/IPG del BDV: cobros entre cuentas del mismo banco y tarjetas Visa/Mastercard emitidas en Venezuela con clave por SMS (terceros) — [Cujiware](https://cujiware.com/pasarelas-pago-venezuela)
- Ubii Pagos: fintech fundada en 2016, con licencia de Sudeban desde 2021 como emisor y procesador de transacciones financieras y más de 30.000 terminales (snippet) — [Latam Fintech](https://www.latamfintech.co/articles/fintech-venezolana-ubii-confia-en-jumio-para-protegerse-frente-a-los-potenciales-fraudes)
- Un "Manual API Botón de Pago" de Ubiipagos (documento de terceros en Scribd, vigencia no verificada) describe servicios de validación de pagos y de retiro con Pago Móvil, cifrado AES-256 y tipos de operación "C2P" o "C2C" (snippet) — [Scribd](https://es.scribd.com/document/660846738/Manual-API-Boton-de-Pago)
- Pagoflash: empresa venezolana fundada en 2013 (Caracas) con PaymentClick (enlaces de cobro), PaymentMail (solicitudes por correo y cobros recurrentes) y PaymentShop (botón de pago) (snippet) — [Lendsqr](https://lendsqr.com/providers/pagoflash)
- VEXPay publica un SDK PHP que se describe como SDK oficial de servidor para la API de pagos VEXPay en Venezuela, con C2P, tarjetas y Pago Móvil (snippet) — [Packagist, vexpay/vexpay-php](https://packagist.org/packages/vexpay/vexpay-php)
- Cashea (BNPL): ~11 millones de usuarios y ~40.000 comercios a julio de 2026; Serie A de USD 40 M (mar-2026) y Serie B de USD 60 M (jun-2026); un fallo antimonopolio de 2025 eliminó sus cláusulas de exclusividad con comercios — [Orinoco Capital, Fintech Directory 2026](https://www.orinoco.capital/fintech)
- Cashea para comercios (dato de 31-mar-2025, no confirmado como vigente): cuota de activación de unos USD 200 + IVA y comisiones de 3 % a 6 % según tipo de comercio y ventas (snippet) — [Descubre.vc](https://www.descubre.vc/noticia/condiciones-de-cashea-para-comercios-afiliados-2025-03-31)
- Kontigo: pagos en USDT/stablecoins, aliado con Disglobal para llevar USDT a ~40.000 puntos de venta; semilla de USD 20 M (dic-2025) — [Orinoco Capital](https://www.orinoco.capital/fintech)
- Zinli es una billetera panameña en USD (MFTech S.A.); su FAQ oficial indica pagos de servicios en Venezuela con máximo de USD 200 por pago (función de consumidor, no de comercio) (snippet) — [Orinoco Capital](https://www.orinoco.capital/fintech); [Zinli, Preguntas frecuentes](https://www.zinli.com/preguntas-frecuentes)
- El Dorado figura con Serie A de USD 9 M pero con cierre de operaciones en Venezuela fechado 31-may-2025 — [Orinoco Capital](https://www.orinoco.capital/fintech)
- Yummy: en septiembre de 2022 Sudeban emitió una circular que prohíbe a los bancos abrir cuentas y prestar servicios a Yummy por no estar registrada como compañía de tecnología financiera y realizar "cobros y compensaciones" sin autorización; Yummy suspendió sus billeteras y pasó a cobrar en divisas o por pago móvil directo al conductor — [NTN24, 29-sep-2022](https://www.ntn24.com/noticias-economia/yummy-venezuela-cambia-sus-metodos-de-pagos-tras-sancion-de-sudeban-401021)
- Opciones internacionales listadas por un integrador local: PayPal (aceptado, con reportes de bloqueo de cuentas y fondos; retiro requiere cuenta bancaria en EE. UU.), dLocal Go, AirTM (operatividad variable), Zelle y Binance Pay (USDT) — [Cujiware](https://cujiware.com/pasarelas-pago-venezuela)
- Los plugins de este integrador (WooCommerce/PrestaShop para BDV, Mercantil, BVC, BNC, Tesoro, R4, Mega Soft, Binance Pay, pagos offline Zelle/Binance) se venden por membresía desde USD 15 al mes por dominio — [Cujiware](https://cujiware.com/pasarelas-pago-venezuela)

**Inferencias de quien investigó**

- Para el SaaS de rifas, las pasarelas locales (Mega Soft, InstaPago, Sitef, Ubii) no resuelven el caso "el comprador paga directo al organizador": son productos de adquirencia para una empresa con cuenta jurídica, no verificadores multi-cuenta.
- El precedente Yummy indica que recibir fondos de terceros y compensarlos (modelo marketplace/billetera) sin licencia es el punto de mayor riesgo regulatorio; el modelo actual (el dinero va directo al organizador) lo evita.
- Cashea es un canal de ventas presencial/retail con costo de 3–6 %; no hay evidencia de API pública ni encaje con boletos de rifa.

**Vacíos**

- Sin información verificable sobre Luka Pay, PayBolívar, Wally, Reserve, billeteras de Ridery, ni APIs de comercio de Zinli; las búsquedas no devolvieron fuentes.
- Sin tarifas publicadas de Mega Soft, InstaPago, Sitef, Ubii ni Pagoflash; sin confirmación de quién puede afiliarse hoy (persona natural con firma personal vs. jurídica).
- Estado actual de El Dorado en Venezuela contradictorio: el directorio indica cierre en 2025, mientras guías de consumo de 2026 lo siguen citando para recargas P2P.

### ¿Puede un SaaS multi-tenant verificar pagos en nombre de muchos organizadores independientes?

**Conclusión**

Sí hay startups venezolanas que ya venden exactamente eso (Pabilo es la más documentada: API REST, webhooks, cuentas personales y jurídicas, plan para plataformas desde USD 35/mes), pero casi ninguna revela si usa APIs oficiales, credenciales de banca en línea o scraping. La vía oficial obliga a que cada organizador gestione sus propias credenciales con su banco, lo que en la práctica exige cuenta jurídica.

**Hallazgos con fuente**

- Pabilo ofrece verificación automática de pagos y conciliación: enlaces de pago, API REST, SDK oficial, webhooks firmados al acreditarse un pago y gestión de varias cajas; se define como plataforma de software independiente que no actúa como intermediario financiero ni billetera — [Pabilo](https://pabilo.app/)
- Bancos listados en su página principal: Banco de Venezuela, Mercantil, Banesco, Bancaribe, Banco Plaza y Binance; su documentación de API lista Banco de Venezuela Personas y Jurídico, Banco Provincial, Banesco, Banco Mercantil, Binance y un Sandbox — [Pabilo](https://pabilo.app/); [Pabilo, Verificar Pagos API](https://pabilo.app/docs/verify-payments)
- Afirma soportar transferencias y pago móvil en cuentas personales y jurídicas, con "conexión de solo lectura" autorizada por el titular; no especifica el mecanismo técnico de conexión al banco — [Pabilo](https://pabilo.app/)
- API: `Authorization: Bearer` con API key de Pabilo y `userBankId` de una cuenta ya configurada; campos `bank_reference`, `movement_type` (`GENERIC`, `MOVIL_PAY`, `TRANSFER`), `amount`, `dni_pagador`, `phone_pagador`, `bank_origin`, `fecha_pago`; la respuesta incluye `is_new` para evitar procesar dos veces la misma referencia; errores 402 (créditos insuficientes) y 404 `PAYMENT_NOT_FOUND` — [Pabilo, Verificar Pagos API](https://pabilo.app/docs/verify-payments)
- Precio: cada verificación nueva consume 1 crédito (duplicadas 0); el ejemplo muestra 99 créditos = 4,95 USD; plan para plataformas (B2B2B) "desde" USD 35 al mes con 2.000 validaciones mensuales (consultado 13-oct-2026; la tabla de planes no cargó) — [Pabilo, Verificar Pagos API](https://pabilo.app/docs/verify-payments); [Pabilo](https://pabilo.app/)
- Cachicamo (SaaS de punto de venta) usa el modelo "cada comercio trae sus credenciales": el comercio carga en su configuración las claves que le entrega su banco (BDV, BVC, Mercantil, BNC) y el sistema las guarda cifradas; afirma no confiar en capturas ni mensajes reenviados y bloquear referencias ya usadas — [Cachicamo, Conciliación Bancaria Venezuela](https://docs.cachicamo.app/payments/venezuela); [Cachicamo, BVC](https://docs.cachicamo.app/payments/pago-movil-bvc)
- Otros proveedores hallados solo por snippet (sus sitios no cargaron o no resolvieron el 13-oct-2026): PagoVE ("validación de pagos móviles mediante scraping bancario"), Contly (vincula cuentas de Bancamiga, Banco Plaza o Mercantil con las credenciales del usuario), Smart-Banking (API de conciliación de Pago Móvil de múltiples cuentas, bloqueo de referencias usadas) y Neracosu (afirma conexión directa con 39+ bancos) — [PagoVE](https://pagove.com/); [Contly](https://contly.com.ve/); [Smart Site, Smart-Banking](https://smartsite.com.ve/smart-banking); [Neracosu](https://neracosu.com/servicios/pasarelas-de-pago.html)
- Lectura de notificaciones por correo: un proyecto abierto concilia Pago Móvil leyendo los correos de notificación de Bancaribe con la API de Gmail (OAuth2, solo lectura, sondeo cada 2 minutos), extrae monto, teléfonos, referencia y fecha con expresiones regulares y empareja por monto exacto y ventana de tiempo; está en fase temprana y depende del formato del correo del banco — [GitHub, pattialberto1/Pago-movil](https://github.com/pattialberto1/Pago-movil)
- Marco regulatorio: la Resolución N° 001.21 de Sudeban (vigente desde junio de 2021) exige autorización previa para operar como Institución de Tecnología Financiera del Sector Bancario (ITFB), con opinión vinculante del OSFIN; la ITFB debe mantener una fianza no inferior al equivalente a 20.000 euros (snippet) — [Global Compliance News](https://www.globalcompliancenews.com/2021/07/05/venezuela-banking-authority-issues-regulations-for-fintech-services24062021); [Forvis Mazars](https://www.forvismazars.com/ve/en/insights/forvis-mazars-insights/fintech)
- Precedente de aplicación: la circular de Sudeban contra Yummy (2022) se basó en que realizaba cobros y compensaciones sin autorización, en contravención del artículo 15 de la Ley de Bancos — [NTN24](https://www.ntn24.com/noticias-economia/yummy-venezuela-cambia-sus-metodos-de-pagos-tras-sancion-de-sudeban-401021)
- El sitio del BCV mantiene una sección "Proveedores No Bancarios de Servicios de Pago" dentro de Sistemas de Pago (el contenido de la sección no se pudo extraer) — [BCV](https://www.bcv.org.ve/sistemas-de-pago/proveedores-servicios-pago)
- Límites operativos documentados: Banesco solo consulta 30 días hacia atrás y entre 2:00 a.m. y 11:55 p.m.; Mercantil exige datos del pagador; BDV exige aprobación del modelo de negocio y puede revocar el acceso — [Banesco](https://www.banesco.com/empresas/soluciones-digitales/apis-banesco/); [Pabilo](https://pabilo.app/docs/verify-payments); [Cujiware](https://cujiware.com/plugins/venezuela/woocommerce/boton-de-pago-movil-del-banco-de-venezuela-para-woocommerce)

**Inferencias de quien investigó**

- Que Pabilo soporte "BDV Personas", Provincial y cuentas personales —bancos y tipos de cuenta para los que no se halló API oficial— sugiere que al menos parte de su cobertura se apoya en credenciales de banca en línea o técnicas no oficiales; eso implica fragilidad (cambios de portal, 2FA) y posible conflicto con los términos de uso del banco. No está confirmado.
- Arquitectura viable por niveles: (1) manual con captura, como hoy; (2) organizadores con cuenta jurídica cargan sus propias credenciales oficiales (modelo Cachicamo); (3) un agregador tipo Pabilo como capa única por organizador, con su plan B2B2B (2.000 validaciones por USD 35/mes ≈ USD 0,0175 por validación, cálculo propio); (4) lectura de correos/notificaciones como último recurso.
- Un SaaS que solo consulta (solo lectura) y nunca custodia fondos queda fuera del supuesto que motivó la sanción a Yummy; el riesgo aparece si el SaaS recibe los pagos en su cuenta y los liquida a los organizadores.
- Mantener el control anti-duplicado propio (referencia única por organizador y banco) es necesario aunque se use un agregador, porque los bancos responden "existe" tantas veces como se consulte.

**Vacíos**

- No se confirmó el mecanismo de conexión de Pabilo ni su estatus legal/contractual con los bancos; tampoco su tabla de precios completa ni número de clientes.
- No se halló ningún servicio de "open banking" regulado ni estándar nacional de acceso de terceros a cuentas en Venezuela.
- No se encontraron términos de uso bancarios citables sobre la prohibición de compartir credenciales o de hacer scraping; es un supuesto razonable sin fuente.
- No se confirmó si un SaaS de solo verificación necesita registro ante Sudeban como ITFB.

### ¿Existe una API interbancaria o del regulador (Sudeban, BCV, Suiche 7B, Conexus, Pago Móvil Interbancario, Débito/Crédito Inmediato)?

**Conclusión**

No se halló ninguna API pública del BCV, Sudeban, Suiche 7B o Conexus a la que un comercio o SaaS pueda conectarse: la infraestructura interbancaria (Cámara de Compensación Electrónica, Crédito Inmediato, Débito Inmediato, Pago Móvil Interbancario) solo es accesible a través del banco del comercio. El regulador sí fija las comisiones máximas de esos rieles.

**Hallazgos con fuente**

- El tarifario del BCV regula como servicios de la "Cámara de Compensación Electrónica (CCE)" el Crédito Inmediato y el Débito Inmediato, y aparte el "servicio Pago Móvil Interbancario" con modalidades P2P, P2C y C2P (vigente desde 15-sep-2026) — [BCV, tarifario (PDF)](https://www.bcv.org.ve/system/files/documentos/171.pdf)
- El menú del sitio del BCV lista un "Sistema de Integración con Entes Externos (SINEX)" con acceso por inicio de sesión y la sección "Proveedores No Bancarios de Servicios de Pago"; no se observa ninguna API pública para comercios — [BCV](https://www.bcv.org.ve/)
- El Débito Inmediato se ofrece a comercios a través de bancos concretos: BNC y BVC (el banco del comercio solicita al banco del cliente una clave OTP que el cliente dicta) y el Botón verde de Banesco para clientes de otros bancos — [Cachicamo, BNC](https://docs.cachicamo.app/payments/pago-movil-bnc); [Cachicamo, BVC](https://docs.cachicamo.app/payments/pago-movil-bvc); [Banesco](https://www.banesco.com/empresas/soluciones-digitales/boton-de-pagos-banescopagos/)
- Suiche 7B impulsa el pago móvil con QR/NFC, disponible para clientes de BDV, BNC, Bancaribe y Bancamiga, y conversa con los cinco bancos de la red Conexus (Mercantil, Fondo Común, Banplus, 100% Banco y Mi Banco) para estandarizar el QR (snippet) — [Notizulia](https://notizulia.net/suiche-7b-pago-movil-nfc-esta-disponible-para-clientes-de-bdv-bnc-bancaribe-y-bancamiga/)
- Conexus se describe como infraestructura que procesa cerca del 40 % de las transferencias electrónicas del país — [Orinoco Capital](https://www.orinoco.capital/fintech)
- Sudeban presentó el Pago Móvil C2P como modalidad para que los comercios cobren a los clientes, quienes entregan cédula, teléfono y banco (snippet) — [DPL News](https://dplnews.com/venezuela-sudeban-presento-un-pago-movil-para-que-los-comercios-cobren-a-los-clientes/)
- En 2022 varios bancos (BNC, BDV, Banesco, Mercantil, Bancamiga, entre otros) anunciaron la adopción de la transferencia inmediata o "crédito inmediato" (snippet) — [La Verdad de Monagas, 10-ago-2022](https://laverdaddemonagas.com/2022/08/10/transferencias-inmediatas-2)

**Inferencias de quien investigó**

- Para el SaaS, "integrarse al sistema interbancario" significa siempre integrarse con uno o varios bancos; no hay atajo regulatorio.
- El Débito Inmediato (cobro iniciado por el comercio con OTP del banco del cliente) es el riel más cercano a un "botón de pago" universal, pero cuesta hasta 2 % al ordenante y requiere que el organizador sea cliente jurídico de un banco que lo exponga por API.

**Vacíos**

- No se encontró documentación técnica ni normativa (resolución del BCV) que describa el Débito Inmediato para comercios, sus límites ni los bancos participantes a octubre de 2026.
- No se pudo extraer el contenido de la sección del BCV sobre proveedores no bancarios de servicios de pago ni determinar qué es exactamente SINEX.

### Zelle: verificación programática y riesgos

**Conclusión**

No se halló ninguna vía legítima y pública para que un tercero verifique por API un pago Zelle recibido; las APIs de Zelle que existen son de bancos socios y para desembolsos. Los comercios venezolanos confirman en la app del banco o en el correo de notificación, y el uso comercial de cuentas personales es el principal motivo de bloqueos.

**Hallazgos con fuente**

- Las APIs de Zelle documentadas pertenecen a bancos (J.P. Morgan, U.S. Bank) y cubren desembolsos salientes y consulta de su estado, no la verificación de cobros entrantes de un comercio ajeno (snippet) — [J.P. Morgan Payments Developer](https://developer.payments.jpmorgan.com/docs/treasury/global-payments/capabilities/global-payments/zelle-disbursements/how-to/initiate-a-zelle-payment-request)
- Wells Fargo restringió el uso de Zelle desde Venezuela en 2020 y Chase en 2023; los motivos reportados incluyen cuentas personales que reciben pagos de comercios, cuentas usadas para recibir depósitos de terceros, aumento de estafas y la calificación de Venezuela como de "alto riesgo"; también se reportaron advertencias contra el uso de VPN (artículo del 20-nov-2023, basado en fuentes no oficiales) — [Diario Las Américas](https://www.diariolasamericas.com/america-latina/algunos-bancos-eeuu-bloquean-el-uso-zelle-venezuela-n5346881)
- Las suspensiones no obedecieron a una orden de Zelle ni a una política general de todos los bancos; el servicio siguió funcionando salvo casos vinculados a Chase (snippet) — [La Patilla, 20-nov-2023](https://lapatilla.com/2023/11/20/zelle-no-cesara-operaciones-en-venezuela-esto-es-lo-que-sabemos/); [NTN24](https://www.ntn24.com/noticias-economia/que-pasa-con-el-sistema-de-pago-zelle-en-venezuela-457466)
- Un volumen alto de pagos directos puede ser calificado como sospechoso por los bancos (snippet) — [Bloomberg Línea](https://www.bloomberglinea.com/latinoamerica/venezuela/zelle-el-mecanismo-de-pago-estadounidense-que-se-ha-convertido-en-una-opcion-para-venezolanos/)
- Guía de septiembre de 2026 para comercios: cobrar volúmenes altos por motivos comerciales desde una cuenta personal puede llevar a revisiones, límites o cierre ("es el riesgo número uno"); no hay reversión sencilla; las capturas se falsifican, por lo que el pago debe confirmarse en la app del banco o en el correo de Zelle, nunca solo con la imagen — [Tiendli, 11-sep-2026](https://tiendli.com/blog/zelle-binance-cobrar-venezuela)
- Tanto el comprador como el comercio necesitan cuenta en un banco de EE. UU. (snippet) — [VerCatálogo](https://vercatalogo.com/blog/cobrar-en-dolares-en-venezuela)
- Existe una app para iPhone, Check-Z, que dice verificar pagos Zelle entrantes para pequeños negocios, sin explicar el método (snippet) — [MWM, Check-Z](https://mwm.ai/apps/check-z/1535401283)
- Tratamiento fiscal: un proveedor contable local asimila Zelle al efectivo en divisas (fuera del sistema bancario nacional), gravado con 3 % de IGTF cuando quien recibe es Sujeto Pasivo Especial — [Gálac](https://galac.com/galac-blog/igtf-pagos-divisas-cripto/)

**Inferencias de quien investigó**

- La única automatización realista para Zelle es indirecta y a cargo del organizador: leer (con su autorización) el correo de notificación de su banco de EE. UU. o usar un agregador de cuentas estadounidense; ambas dependen de cada banco y no se documentaron para este caso.
- Para el SaaS conviene mantener Zelle como método "manual con evidencia" (captura + confirmación del organizador) y advertir a los organizadores sobre el riesgo de bloqueo por uso comercial.

**Vacíos**

- No se encontró documentación oficial de Early Warning Services (Zelle) sobre APIs para comercios ni sobre uso desde fuera de EE. UU.
- No hay reportes fechados en 2025–2026 de nuevas restricciones de bancos estadounidenses; la evidencia concreta es de 2020 y 2023.
- No se investigó la viabilidad de agregadores bancarios de EE. UU. (tipo Plaid) para organizadores venezolanos.

### Binance / USDT: Binance Pay, verificación on-chain y restricciones

**Conclusión**

Binance opera con normalidad en Venezuela en 2026 e incluso amplió servicios (bancos públicos en P2P desde abril de 2026, exención temporal de comisiones a comercios con Binance Pay, tarjeta en agosto de 2026); Binance Pay tiene API de comercio con webhooks, y las transferencias USDT on-chain se pueden verificar gratis contra APIs públicas de la red. No se confirmaron los requisitos de alta de comercio para una persona o empresa venezolana.

**Hallazgos con fuente**

- Binance Pay ofrece API de comercio: creación de órdenes (endpoint v3 `POST /binancepay/openapi/v3/order`), notificación por webhook del estado final (`PAY_SUCCESS`, `PAY_CLOSED`), hasta 6 reintentos y parámetro `webhookUrl` por orden; los endpoints se configuran en el Merchant Admin Portal (snippet) — [Binance Developers, Order Notification](https://developers.binance.com/en/docs/products/binance-pay-merchant/order-notification); [Binance Developers, Changelog](https://developers.binance.com/en/docs/products/binance-pay-merchant/changelog)
- La introducción oficial describe cobro C2B por QR y cobros C2C con OAuth; remite a Binance Merchant Operation para el alta y no detalla requisitos KYB, países ni comisiones — [Binance Developers, Binance Pay](https://developers.binance.com/docs/binance-pay/introduction)
- Tras los sismos del 24-jun-2026, Binance eximió de comisiones a los comercios que reciben pagos por Binance Pay en Venezuela y a todas las operaciones P2P en el país hasta el 2-jul-2026 — [CriptoNoticias, 26-jun-2026](https://www.criptonoticias.com/comunidad/binance-medidas-apoyo-venezuela/)
- En abril de 2026 Binance P2P volvió a mostrar como métodos de pago al Banco de Venezuela, Banco del Tesoro y Banco Digital de los Trabajadores, tras la Licencia General N° 57 de la OFAC; el artículo señala que el sistema sigue bajo supervisión estadounidense — [CriptoNoticias, 15-abr-2026](https://www.criptonoticias.com/comunidad/binance-integra-bancos-venezolanos-flexibiizacion-sanciones/)
- Antecedente de riesgo de acceso: el 9-ago-2024 se reportó el bloqueo de Binance para usuarios de CANTV; Binance reconoció restricciones de acceso y otros proveedores seguían funcionando — [CriptoNoticias, 10-ago-2024](https://www.criptonoticias.com/comunidad/binance-enfrenta-restricciones-acceso-venezuela/)
- Binance lanzó su tarjeta en Venezuela en agosto de 2026 con un cupo inicial de 3.000 usuarios (snippet) — [El Nacional](https://www.elnacional.com/2026/08/binance-lanza-su-tarjeta-en-venezuela-con-un-registro-limite-de-3-000-usuarios-conoce-los-requisitos/)
- Práctica comercial: las transferencias internas entre usuarios de Binance son inmediatas y sin costo; enviar a una billetera externa paga comisión de red; convertir USDT a bolívares por P2P expone a estafas y disputas; el ID de la transacción es el único respaldo — [Tiendli, 11-sep-2026](https://tiendli.com/blog/zelle-binance-cobrar-venezuela)
- Verificación on-chain TRC20: TronGrid es la API oficial de nodo y Tronscan la API de explorador; una verificación debe comprobar estado (confirmada/pendiente/fallida), emisor, receptor, contrato del token, monto y bloque; un método común es sondear los eventos de transferencia del contrato USDT cada ~3 segundos (tiempo de bloque de TRON), con 6 decimales para USDT (snippets) — [Bitquery](https://www.bitquery.io/blog/best-tron-api); [AMLBot](https://blog.amlbot.com/why-tron-network-transaction-verification-could-save-you-millions-of-dollars/); [Chainstack Docs](https://docs.chainstack.com/docs/tron-polling-for-trc20-transfers.md)
- Un agregador local ya ofrece verificación de pagos Binance junto con bancos venezolanos — [Pabilo](https://pabilo.app/docs/verify-payments)
- Fiscalmente, los pagos con criptoactivos se gravan con 3 % de IGTF cuando se hacen a un Sujeto Pasivo Especial, sea la plataforma custodiada (Binance) o autocustodiada — [Gálac](https://galac.com/galac-blog/igtf-pagos-divisas-cripto/)

**Inferencias de quien investigó**

- La mayoría de pagos "por Binance" entre compradores y organizadores son transferencias internas (Binance Pay entre usuarios, fuera de cadena): no aparecen en la blockchain, así que la verificación on-chain solo sirve cuando el organizador publica una dirección TRC20/BEP20 propia; para pagos internos se necesita la API de Binance Pay del organizador o un agregador.
- Que Binance anunciara exención de comisiones "a comercios que reciben por Binance Pay en Venezuela" implica que el producto de comercio está disponible en el país, pero no prueba que una persona natural pueda darse de alta como comercio.
- El bloqueo de 2024 muestra que la disponibilidad depende del ISP; conviene no hacer de Binance el único método.

**Vacíos**

- No se confirmaron requisitos KYB, tipos de cuenta de comercio, comisiones vigentes ni lista de países de Binance Pay para Venezuela.
- No se obtuvo documentación de verificación BEP20 (BscScan) en esta investigación.
- Un resultado de búsqueda mencionó que el 22-jul-2026 Binance exigió a comerciantes P2P actualizar datos de empleo y que hay límites de USD 1.000 diarios / 4.000 mensuales / 8.500 anuales para cuentas y tarjetas de personas naturales; no se pudo atribuir a una página concreta ni verificar.
- No se halló normativa venezolana vigente (Sunacrip o sucesora) sobre aceptación de criptoactivos por comercios.

### Tipo de cambio: publicación del BCV, fuentes y obligaciones legales

**Conclusión**

El BCV no ofrece API: publica la tasa en su web (portada y página de estadísticas con archivos XLS trimestrales) cada día hábil por la tarde, con "Fecha Valor" del siguiente día hábil; el 13-oct-2026 ya mostraba 877,9023 Bs/USD con fecha valor 14-oct-2026. Las fuentes de terceros (DolarAPI, librerías de scraping, sitios de tasa) derivan de esa web; desde las detenciones de mayo–junio de 2025 publicar o usar la tasa paralela es un riesgo penal práctico aunque no se halló una norma que lo prohíba expresamente.

**Hallazgos con fuente**

- La portada del BCV muestra el "Tipo de Cambio de Referencia" con la leyenda: "El tipo de cambio publicado por el BCV es el promedio ponderado resultante de las operaciones diarias de las mesas de cambio activas de las instituciones bancarias participantes"; el 13-oct-2026 indicaba USD 877,90230000 y EUR 982,75895071 con "Fecha Valor: Miércoles, 14 Octubre 2026" — [BCV](https://www.bcv.org.ve/)
- La misma portada lista "Tasas Informativas del Sistema Bancario (Bs/USD)" de compra y venta por banco (BBVA Provincial, Mercantil, N58 Banco Digital, Banesco) — [BCV](https://www.bcv.org.ve/)
- El histórico oficial se descarga como archivos XLS trimestrales (por ejemplo `2_1_2d26_smc.xls`) en "Tipo de Cambio de Referencia del SMC"; no hay enlace a API o servicio web — [BCV, Tipo de Cambio de Referencia SMC](https://www.bcv.org.ve/estadisticas/tipo-cambio-de-referencia-smc)
- Hora de publicación: un sitio que la mide indica que el BCV suele publicar por la tarde, alrededor de las 4:37 p.m. hora de Venezuela, con fecha valor del siguiente día hábil, y que un feriado puede desplazar la fecha valor; el 13-oct-2026 a las 16:30 mostraba 876,80 Bs como tasa vigente y 877,90 ya publicada para el 14-oct — [BCVHoy](https://bcvhoy.com/dolar-bcv)
- Otros sitios de terceros discrepan sobre la franja (2:00–4:00 p.m. frente a 4:00–6:00 p.m.) y coinciden en que sábados, domingos y feriados bancarios rige la última tasa publicada (snippets) — [Tiendli, Tasa BCV](https://tiendli.com/ve/tasa-bcv); [Arepa Tecnológica](https://arepatecnologica.com/dolar-bcv/); [usdt.com.ve](https://www.usdt.com.ve/tasa-bcv)
- Ritmo de variación en 2026: 540,0431 Bs/USD (27-may), 794,99 (31-ago), 842,21 (15-sep), 855,6625 (25-sep), 871,37 (5-oct), 876,80 (13-oct); la tasa cambia prácticamente cada día hábil — [Finanzas Digital, 27-may-2026](https://finanzasdigital.com/tasa-de-cambio-bcv-27-mayo-2026/); [Finanzas Digital, 25-sep-2026](https://finanzasdigital.com/tasa-de-cambio-bcv-25-septiembre-2026/); [BCVHoy](https://bcvhoy.com/dolar-bcv)
- El BCV informó una inflación de 8,4 % en septiembre de 2026 (titular del 3-oct-2026) — [BCV](https://www.bcv.org.ve/)
- DolarAPI (`https://ve.dolarapi.com`): proyecto de código abierto con licencia MIT que "brinda datos de fuentes públicas"; endpoints de Dólar Oficial, Dólar Paralelo, Euro Oficial/Paralelo, históricos por fecha y estado de la API; la documentación no nombra sus fuentes ni publica límites de uso ni frecuencia de actualización; repositorio `enzonotario/esjs-dolar-api` — [DolarAPI, docs Venezuela](https://dolarapi.com/docs/venezuela/); [GitHub](https://github.com/enzonotario/esjs-dolar-api)
- Un sitio de tasas declara que toma sus cifras directamente de la web del BCV y usa dolarapi.com como respaldo — [BCVHoy](https://bcvhoy.com/dolar-bcv)
- Librerías: pyDolarVenezuela (consulta varios monitores y el dólar oficial BCV, incluyendo fuentes del paralelo) y currency-rate-bcv (obtiene dólar y euro de la página del BCV) (snippets) — [PyPI, pyDolarVenezuela](https://pypi.org/project/pyDolarVenezuela/1.0.2); [PyPI, currency-rate-bcv](https://pypi.org/project/currency-rate-bcv/)
- Las APIs de Banco Activo incluyen la consulta de la tasa de cambio oficial del BCV — [Ecosistema Startup](https://ecosistemastartup.com/activo-banco-universal-lanza-apis-para-empresas-en-venezuela/)
- Base legal del pago en bolívares de precios en divisas: el Convenio Cambiario N° 1 (Gaceta Oficial Extraordinaria N° 6.405 del 7-sep-2018), artículo 8 literal a), establece que cuando la moneda extranjera es moneda de cuenta el deudor puede pagar en esa moneda o en bolívares al tipo de cambio vigente a la fecha del pago; el TSJ lo aplica en sus sentencias (snippets) — [Travieso Evans, memo Convenio Cambiario N° 1](https://www.traviesoevans.com/memos/memo-convenio-cambiario-1.pdf); [Acceso a la Justicia](https://accesoalajusticia.org/calculo-de-intereses-de-mora-e-indexacion-en-caso-de-condena-de-montos-en-divisas/)
- La Sundde aprobó un formato oficial y obligatorio para exhibir la tasa del BCV en todos los comercios, con un código QR para denunciar irregularidades de precios o en la aplicación de la tasa oficial (nota del 10-dic-2025; no cita base legal ni sanciones ni menciona comercios en línea) — [Finanzas Digital](https://finanzasdigital.com/sundde-formato-obligatorio-tasa-bcv-venezuela/)
- En febrero de 2025 la Sundde advirtió que no puede haber precios distintos según la moneda de pago y que sancionaría a los locales que vendan más barato si se paga en divisas (snippet) — [Ciudad CCS](https://www.ciudadccs.info/publicacion/27246-)
- Persecución del paralelo: a finales de mayo de 2025 fue detenido el presunto administrador de la cuenta de Instagram "Monitor Dólar"; al 11-jun-2025 el fiscal general informó 58 detenidos en siete entidades, imputados por terrorismo, legitimación de capitales, asociación para delinquir, oferta engañosa y captación indebida, y 12 páginas sacadas de circulación; la nota no cita una norma que prohíba publicar tasas paralelas — [Swissinfo/EFE, 12-jun-2025](https://www.swissinfo.ch/spa/investigaciones-sobre-el-d%C3%B3lar-%27paralelo%27-en-venezuela-dejan-58-detenidos%2C-dice-el-fiscal/89501548)
- Tras las detenciones los portales dejaron de reflejar el dólar paralelo y la tasa BCV quedó como referencia única; algunos comercios pasaron a fijar precios en euros (snippet) — [La Patilla, 1-jul-2025](https://lapatilla.com/2025/07/01/dolar-bcv-sigue-en-alza-en-medio-de-persecucion-del-chavismo-al-mercado-paralelo/)
- Recomendación de una guía comercial de 2026: fijar precios en dólares, usar la tasa BCV del día como única referencia de conversión y facturar en bolívares al tipo de cambio oficial del día de la operación — [Tiendli, 11-sep-2026](https://tiendli.com/blog/zelle-binance-cobrar-venezuela)

**Inferencias de quien investigó**

- Como la tasa publicada por la tarde lleva fecha valor del día hábil siguiente, el SaaS debe guardar la "fecha valor" y no la fecha de consulta; convertir con la tasa cuya fecha valor corresponde al día del pago, y registrar la tasa usada en cada compra.
- La fuente más defendible es leer directamente bcv.org.ve (portada o XLS) con un respaldo como DolarAPI, que es un proyecto comunitario sin SLA; el endpoint de BCV de DolarAPI depende en última instancia del mismo sitio.
- Durante esta investigación la descarga de bcv.org.ve falló con verificación TLS estricta ("unable to verify the first certificate") y funcionó al omitirla; un scraper propio debe contemplar esa cadena de certificados incompleta.
- DolarAPI sigue exponiendo "Dólar Paralelo"; por el contexto de 2025, el SaaS no debería consumir ni mostrar ese endpoint.
- Con variaciones diarias (≈10 % entre el 31-ago y el 13-oct de 2026, cálculo propio sobre los datos citados), cachear la tasa más de un día hábil produce diferencias visibles para el comprador.

**Vacíos**

- No se encontró el texto de una norma (providencia de la Sundde o artículo de ley) que obligue expresamente a convertir a la tasa BCV ni que prohíba publicar tasas paralelas; lo documentado son notas de prensa y acciones penales.
- No se verificó el estado de mantenimiento actual de pyDolarVenezuela ni si eliminó fuentes del paralelo.
- No hay hora oficial de publicación declarada por el BCV; solo mediciones de terceros.
- No se verificó la disponibilidad ni el historial de caídas de ve.dolarapi.com.

### IGTF: alícuota vigente, quién lo percibe y si afecta a boletos de rifa o a las suscripciones

**Conclusión**

Las fuentes coinciden en que el IGTF sobre pagos en divisas y criptoactivos sigue en 3 % en 2026 y que solo lo perciben los Sujetos Pasivos Especiales (SPE) designados por el SENIAT; un organizador o un SaaS que no sea SPE no puede ni debe cobrarlo. No se pudo confirmar si el decreto de exoneración para pagos en divisas a no-SPE (2023, prorrogado en 2024) fue renovado en 2025–2026.

**Hallazgos con fuente**

- Guías de 2026 indican que la alícuota de 3 % para pagos en divisas o criptoactivos sigue vigente mientras el Ejecutivo no fije otra (snippet) — [CriptoInforme](https://criptoinforme.com/legal/impuestos-criptomonedas-venezuela-seniat-2026/)
- El Decreto N° 4.972 (Gaceta Oficial Extraordinaria N° 6.821 del 12-jul-2024) modificó alícuotas: según el boletín de PwC redujo de 2 % a 0 % la alícuota para ciertas operaciones de sujetos pasivos especiales y mantuvo 3 % para pagos en divisas y criptoactivos (snippet; el PDF devolvió error 403) — [PwC Venezuela](https://www.pwc.com/ve/es/publicaciones/assets/PublicacionesNew/Boletines/Modificaci%C3%B3n%20de%20la%20Al%C3%ADcuota%20de%20IGTF%202%20al%200%20(Julio%202024).pdf)
- Quién lo percibe: el cliente paga el IGTF y el comercio que es SPE lo percibe y lo entera al SENIAT; sin la calificación de SPE el comercio no puede percibir el impuesto aunque reciba divisas o criptoactivos — [Gálac](https://galac.com/galac-blog/igtf-pagos-divisas-cripto/)
- Aplica 3 % a divisas en efectivo, billeteras digitales (se citan Zelle y Zinli) y criptoactivos (se cita Binance Pay) cuando el receptor es SPE; 0 % para tarjeta de débito nacional cuando el banco liquida en bolívares — [Gálac](https://galac.com/galac-blog/igtf-pagos-divisas-cripto/)
- Decreto de exoneración publicado en la Gaceta Oficial N° 42.575 del 23-feb-2023, por un año: exonera, entre otros, los pagos en moneda extranjera o criptoactivos distintos a los emitidos por Venezuela hechos a personas naturales, jurídicas y entidades sin personalidad jurídica que no estén calificadas como sujetos pasivos especiales, las operaciones cambiarias y las remesas — [Banca y Negocios, 25-feb-2023](https://www.bancaynegocios.com/gacetaoficial-prorrogan-por-un-ano-exoneraciones-del-igtf-a-operaciones-bursatiles-remesas-y-otras-transacciones/)
- Prórroga: Decreto N° 4.924, Gaceta Oficial N° 42.823 del 21-feb-2024, por un año (hasta febrero de 2025) (snippets) — [El Universal](https://www.eluniversal.com/venezuela/175647/gaceta-oficial-publican-prorroga-de-exoneracion-del-impuesto-a-las-grandes-transacciones); [Grant Thornton](https://www.grantthornton.com.ve/globalassets/1.-member-firms/venezuela/2024/notas-informativas-2024/nota-informativa-exoneracion-del-impuesto-a-las-grandes-transacciones-financieras.pdf)
- El único decreto de exoneración de IGTF de 2026 hallado es sectorial: Decreto N° 5.207 (Gaceta Oficial N° 43.292 del 9-ene-2026) para combustibles y aditivos (snippet) — [Finanzas Digital](https://finanzasdigital.com/exoneracion-impuestos-combustibles-venezuela-2026/)
- Una guía de agosto de 2026 afirma que los pagos en cripto entre contribuyentes no especiales tienen alícuota 0 % bajo el Decreto 4.972 y que el 3 % se mantiene para pagos a sujetos pasivos especiales; la propia página advierte que no es asesoría fiscal — [Awake Trader, 5-ago-2026](https://www.awaketrader.com/educacion/igtf-venezuela-2026-guia); no respaldado por el resumen de [PwC Venezuela](https://www.pwc.com/ve/es/publicaciones/assets/PublicacionesNew/Boletines/Modificaci%C3%B3n%20de%20la%20Al%C3%ADcuota%20de%20IGTF%202%20al%200%20(Julio%202024).pdf)
- Las operaciones liquidadas en bolívares a través de la banca nacional no están sujetas al 3 % — [Gálac](https://galac.com/galac-blog/igtf-pagos-divisas-cripto/)

**Inferencias de quien investigó**

- Un comprador que paga un boleto por Pago Móvil en bolívares a un organizador no-SPE no genera IGTF de 3 %; un pago en Zelle o USDT a un organizador no-SPE tampoco es percibido por nadie, porque solo el SPE actúa como agente de percepción. Si el organizador fuese SPE (improbable en este segmento), debería percibir 3 % en cobros en divisas/cripto.
- Las suscripciones del SaaS cobradas en divisas o USDT no llevan IGTF mientras la entidad que cobra no sea SPE; cobradas en bolívares vía banca nacional, tampoco.
- El SaaS no necesita un módulo de IGTF en el flujo del comprador para el lanzamiento, pero sí debería poder activarlo por organizador si alguno es SPE.

**Vacíos**

- No se confirmó si la exoneración general (pagos en divisas/cripto a no-SPE) fue prorrogada después de febrero de 2025; las fuentes solo muestran los decretos de 2023 y 2024.
- Conflicto no resuelto sobre el rango legal de la alícuota (una fuente indica 2 %–8 %, otra 0 %–20 %) y sobre el alcance exacto del Decreto 4.972; no se leyó el texto de la Gaceta.
- No se investigó el tratamiento de IVA ni la normativa específica de rifas/loterías (fuera del alcance asignado).

### WhatsApp: precios de la plataforma, requisitos de acceso, BSP, alternativas no oficiales y enlaces wa.me

**Conclusión**

Venezuela cae en la región "Rest of Latin America" del tarifario de Meta: USD 0,0740 por mensaje de marketing y USD 0,0113 por mensaje de utilidad o autenticación (tarifario 2026), cobrado por mensaje de plantilla entregado. Varias fuentes de BSP reportan que desde el 1-oct-2026 también se cobran los mensajes de servicio tras 1.000 gratis por número al mes y las plantillas de utilidad dentro de la ventana de 24 h, aunque la página de precios de Meta leída el 13-oct-2026 aún mostraba el texto anterior; debe confirmarse en el tarifario oficial.

**Hallazgos con fuente**

- Modelo oficial: precio por mensaje desde el 1-jul-2025 (reemplazó al precio por conversación); categorías Marketing, Utility y Authentication; se cobra solo cuando se entrega un mensaje de plantilla; los mensajes de usuarios al negocio no se cobran — [Meta for Developers, Pricing](https://developers.facebook.com/documentation/business-messaging/whatsapp/pricing)
- Venezuela (ISO VE, código +58) pertenece a la región de precios "Rest of Latin America" — [Meta for Developers, Pricing](https://developers.facebook.com/documentation/business-messaging/whatsapp/pricing)
- Texto oficial leído el 13-oct-2026: los mensajes que no son plantilla solo pueden enviarse dentro de una ventana de servicio al cliente abierta (24 h) y son gratuitos; las plantillas de utilidad entregadas dentro de la ventana son gratuitas; todo mensaje es gratuito durante 72 h si se envía dentro de una ventana de punto de entrada gratuito (anuncio Click to WhatsApp o botón de página de Facebook); las tarifas vigentes figuran como "effective July 1, 2026" — [Meta for Developers, Pricing](https://developers.facebook.com/documentation/business-messaging/whatsapp/pricing); [WhatsApp Business, Platform Pricing](https://whatsappbusiness.com/products/platform-pricing/)
- Hay niveles de volumen que reducen las tarifas de utilidad y autenticación según el volumen mensual por mercado y categoría, agregando todos los WABA de un portafolio — [Meta for Developers, Pricing](https://developers.facebook.com/documentation/business-messaging/whatsapp/pricing)
- Tarifas "Rest of Latin America" (USD por mensaje entregado): marketing 0,0740; utilidad 0,0113; autenticación 0,0113; sin tarifa de autenticación internacional — [Zernio (tarifario 1-jul-2026)](https://zernio.com/blog/whatsapp-business-api-pricing); [Flowcall (tarifario 1-oct-2026, verificado 28-sep-2026)](https://www.flowcall.co/blog/whatsapp-business-api-pricing)
- ManyChat lista para la misma región 0,0851 marketing, 0,0130 utilidad y 0,0113 servicio con vigencia 1-oct-2026 (snippet; la página devolvió 403) — [ManyChat Help](https://help.manychat.com/hc/en-us/articles/14281380243740-WhatsApp-pricing-guide); difiere de [Flowcall](https://www.flowcall.co/blog/whatsapp-business-api-pricing)
- Cambio del 1-oct-2026 reportado por BSP: los mensajes de servicio dentro de la ventana de 24 h pasan a cobrarse por mensaje entregado a la tarifa de utilidad del mercado, con 1.000 mensajes de servicio gratis por número de teléfono de negocio al mes (sin acumulación); las plantillas de utilidad dentro de la ventana se cobran desde el primer mensaje; los mensajes dentro de una ventana de punto de entrada gratuito siguen gratis y la ventana de anuncios Click to WhatsApp se amplía hasta 7 días (el botón de página queda en 72 h) — [respond.io (actualizado 6-oct-2026)](https://respond.io/blog/whatsapp-pricing-change-2026); [YCloud](https://www.ycloud.com/blog/whatsapp-api-message-pricing-update-effective-october-1-2026); [wha.tools](https://wha.tools/whatsapp-api-pricing); contradicho por el texto de [Meta for Developers](https://developers.facebook.com/documentation/business-messaging/whatsapp/pricing) leído el 13-oct-2026
- Un blog reporta que las propias páginas de Meta se contradijeron sobre las cuentas sin método de pago (versión del 25-ago frente a la del 10-sep-2026) (snippet) — [Overads](https://overads.io/blog/whatsapp-business-api-pricing-october-2026)
- Requisitos contractuales: se necesita un portafolio de negocio en Meta Business Suite e información veraz; la plataforma "may not be available in all locations"; los términos no mencionan a Venezuela ni listan países sancionados; se prohíbe acceder por medios automatizados no autorizados o extraer datos — [Meta Terms for WhatsApp Business Platform](https://www.facebook.com/legal/Meta-Terms-for-WhatsApp-Business-Platform)
- Verificación del negocio: sin verificación la cuenta queda limitada a 250 conversaciones iniciadas por el negocio al día; el nombre legal, la dirección y el país deben coincidir con los documentos y se requiere un sitio web activo (snippet) — [Exotel Docs](https://developer.exotel.com/docs/whatsapp-support/business-verification)
- Vías de verificación según un BSP: verificación liderada por el partner, verificación estándar en el Security Centre y Meta Verified for Business (de pago) (snippet) — [360dialog Docs](https://docs.360dialog.com/docs/resources/meta-business-verification)
- Un proveedor afirma que "WhatsApp Business API is fully available in Venezuela", sin restricciones a nivel de país, y que para pymes suele bastar un nombre comercial registrado y un sitio web o perfil social (blog comercial del 14-abr-2026; no menciona RIF ni registro mercantil) — [ChatDaddy](https://chatdaddy.tech/blog/whatsapp-business-api-venezuela)
- Twilio: cobra USD 0,005 por mensaje de WhatsApp, entrante o saliente, más la tarifa de Meta que traslada sin recargo; precios "current as of September 2026"; menciona un nivel gratuito que se reinicia mensualmente y no se acumula — [Twilio, WhatsApp Pricing](https://www.twilio.com/en-us/whatsapp/pricing)
- 360dialog: suscripción mensual por canal de 49 EUR / 59 USD (Regular), 99 EUR / 119 USD (Premium) o 249 EUR / 299 USD (Higher Throughput); aplica 7 % de recargo sobre la tarifa de Meta a plantillas de marketing enviadas por el endpoint estándar; el resto de tarifas son las de Meta — [360dialog Docs, Prices](https://docs.360dialog.com/docs/360dialog/prices-plans-and-payment-options)
- Comparativas de terceros (no verificadas) atribuyen a Wati una cuota de plataforma de unos USD 49/mes y un recargo de ~20 % sobre Meta; no se halló precio confirmado de Gupshup (snippet) — [EZContact, comparativa](https://ezcontact.ai/en/blog/whatsapp-api-pricing-comparison-meta-twilio-360dialog-ezcontact/)
- Alternativas no oficiales: la documentación de Evolution API describe Baileys como implementación libre de la API de WhatsApp Web que conecta "without official business API credentials", califica el riesgo de baneo como "Possible if misused", advierte que la mensajería masiva o el spam automatizado "can get your number banned" y recomienda retrasos entre mensajes; no soporta plantillas — [Evolution API Docs, Baileys](https://mintlify.wiki/EvolutionAPI/evolution-api/whatsapp/baileys)
- Un blog técnico sostiene que la vía Baileys viola los términos de WhatsApp, puede causar bloqueo permanente del número y no admite apelación, a diferencia de la vía oficial (fuente única, comercial) (snippet) — [Pasquale Pillitteri](https://pasqualepillitteri.it/en/news/12969/integrate-whatsapp-evolution-api-vs-cloud-api)
- Enlaces wa.me ("click to chat"): función oficial y gratuita documentada en el Centro de Ayuda de WhatsApp; formato `https://wa.me/<número en formato internacional>?text=<texto codificado en URL>` (la página no pudo extraerse en esta sesión; formato citado de la documentación conocida) — [WhatsApp Help Center, How to use click to chat](https://faq.whatsapp.com/5913398998672934)

**Inferencias de quien investigó**

- Costo orientativo en Venezuela con plantillas de utilidad: USD 0,0113 por notificación (≈ Bs. 9,9 a 877,90 Bs/USD); 1.000 confirmaciones de pago ≈ USD 11,30 de tarifa Meta, más USD 5,00 si se usa Twilio (0,005 × 1.000) o una cuota fija de USD 59/mes con 360dialog. Marketing cuesta 6,5 veces más (USD 0,0740), así que conviene que las plantillas se aprueben como "utility".
- Si el cambio del 1-oct-2026 está vigente, responder dentro de la ventana de 24 h deja de ser ilimitadamente gratis: cada número tendría 1.000 mensajes de servicio gratis al mes y luego USD 0,0113 por mensaje; el diseño de "el comprador escribe primero y respondemos gratis" sigue sirviendo solo hasta ese tope.
- El enlace wa.me prellenado es la opción de costo cero y sin riesgo de baneo: el comprador o el organizador inicia el chat desde su propio WhatsApp; no permite automatizar envíos ni confirmar entrega.
- Las librerías no oficiales son técnicamente viables para volúmenes bajos por organizador (cada uno con su número), pero trasladan al organizador el riesgo de perder su número comercial; no deberían usarse con el número de la plataforma.
- Con un SaaS multi-tenant, un solo WABA de la plataforma enviando en nombre de todos los organizadores concentra costo y reputación; cada organizador con su propio WABA exige verificación de negocio individual, poco realista para personas naturales.

**Vacíos**

- No se obtuvo el tarifario CSV/PDF oficial de Meta (la página bloquea descargas automatizadas); las cifras de "Rest of Latin America" provienen de terceros coincidentes y deben confirmarse en la tarjeta de tarifas oficial.
- Contradicción sin resolver entre el texto de Meta leído el 13-oct-2026 (servicio gratis, tarifas "effective July 1, 2026") y los BSP (servicio cobrado desde el 1-oct-2026): puede ser una versión en caché de la página o un cambio aún no reflejado.
- No se encontró evidencia directa (casos, documentación de Meta) sobre si una empresa venezolana con RIF/registro mercantil, o una persona natural, logra la verificación de negocio de Meta, ni sobre medios de pago aceptados por Meta para facturar a entidades venezolanas.
- Sin precios confirmados de Gupshup, Infobip, Wati, Zoko, Kommo ni de proveedores locales venezolanos; sin confirmación de qué BSP aceptan clientes y medios de pago de Venezuela.
- No se hallaron estadísticas independientes de tasas de baneo con Baileys, whatsapp-web.js o Evolution API.

### SMS y correo como respaldo

**Conclusión**

El SMS a Venezuela vía proveedores internacionales cuesta entre USD 0,19 y 0,26 por mensaje, unas 17–20 veces una plantilla de utilidad de WhatsApp, por lo que solo se justifica como respaldo puntual (por ejemplo OTP). No se hallaron proveedores locales con precios públicos.

**Hallazgos con fuente**

- Twilio (oficial): USD 0,2257 por segmento saliente a Venezuela, tanto con números internacionales como con remitente alfanumérico; cargo de USD 0,001 por mensaje fallido; números internacionales desde USD 1,15/mes; precios sujetos a cambio sin aviso; no desglosa por operadora — [Twilio, SMS Pricing Venezuela](https://www.twilio.com/en-us/sms/pricing/ve)
- Plivo (oficial, snippet): Movistar USD 0,1914, Digitel USD 0,1938, Movilnet USD 0,1980 y otras redes USD 0,6435 por SMS — [Plivo, SMS Pricing Venezuela](https://www.plivo.com/sms/pricing/ve/)
- D7 Networks: USD 0,26 por SMS; exige registro de Sender ID para Venezuela y menciona el cumplimiento ante CONATEL (snippet) — [D7 Networks](https://d7networks.com/sms/venezuela/)
- Una guía secundaria cita USD 0,1987 para Twilio a enero de 2025 y cerca de USD 0,30 para Infobip (datos de 2025, no coinciden con la página actual de Twilio) (snippet) — [Sent.dm](https://www.sent.dm/en/resources/sms-pricing/venezuela-sms-pricing)
- Los bancos venezolanos envían correos de notificación de Pago Móvil que algunos desarrolladores ya usan como fuente de conciliación (caso Bancaribe) — [GitHub, pattialberto1/Pago-movil](https://github.com/pattialberto1/Pago-movil)

**Inferencias de quien investigó**

- Relación de costos (cálculo propio): 0,2257 / 0,0113 ≈ 20 veces (Twilio) y 0,1914 / 0,0113 ≈ 17 veces (Plivo/Movistar) frente a una plantilla de utilidad de WhatsApp.
- El correo transaccional es el respaldo de costo casi nulo para comprobantes y avisos al organizador; el SMS debería reservarse para casos sin WhatsApp.

**Vacíos**

- No se encontraron agregadores SMS venezolanos con precios públicos ni datos de entregabilidad por operadora (Movistar, Digitel, Movilnet) en 2026.
- No se investigaron proveedores de correo transaccional ni su entregabilidad hacia dominios usados en Venezuela, ni si aceptan clientes venezolanos.

### Cómo puede el propio SaaS cobrar las suscripciones a los organizadores

**Conclusión**

Las plataformas de suscripción globales no admiten vendedores venezolanos (Stripe no lista a Venezuela; Paddle la incluye entre los países no soportados), así que las opciones reales son: una entidad extranjera (LLC en EE. UU. u otra jurisdicción) con Stripe para quien pueda pagar con tarjeta internacional, y cobro local manual o semiautomático por Pago Móvil, Zelle y Binance/USDT. No se encontró evidencia sistemática de qué hacen otras SaaS venezolanas; los pocos casos visibles cobran en USD por membresía o créditos con contacto por WhatsApp.

**Hallazgos con fuente**

- Stripe lista 51 países/regiones de disponibilidad; Venezuela no figura y de América Latina solo aparecen Brasil y México; Stripe Atlas se ofrece para constituir una empresa en EE. UU. "from anywhere in the world" — [Stripe, Global availability](https://stripe.com/global)
- Paddle declara que trabaja con negocios de software de cualquier lugar salvo los países no soportados, lista en la que figura Venezuela, por normas de sanciones y políticas de sus socios bancarios y de pagos (snippet) — [Paddle Help](https://www.paddle.com/help/start/intro-to-paddle/which-countries-are-supported-by-paddle)
- Lemon Squeezy (adquirida por Stripe en 2024) cobra 5 % + USD 0,50 por transacción y +1,5 % en transacciones internacionales (snippets) — [TechCrunch, 26-jul-2024](https://techcrunch.com/2024/07/26/stripe-acquires-payment-processing-startup-lemon-squeezy/); [Dodo Payments, reseña 2026](https://dodopayments.com/blogs/lemonsqueezy-review)
- Testimonio de un desarrollador venezolano (15-may-2025): Stripe solo permite retiros a cuentas bancarias de EE. UU. y, según él, Stripe Atlas no está disponible para venezolanos; PayPal es fácil de integrar pero cobra 4,4 % + USD 0,30, ha congelado fondos sin explicación y obliga a retirar vía Binance P2P; Lemon Squeezy soporta suscripciones pero la descarta por costo; recomienda CoinGate (cripto y tarjetas, ~1 %) y menciona Payeer (~2 %, sin suscripciones automáticas) — [jawuil.dev](https://jawuil.dev/blog/procesadores-de-pago-para-saas-alternativas-para-devs-indie-en-latam-venezuela-y-latam-en-general); en tensión con [Stripe](https://stripe.com/global) sobre Atlas
- Una guía de 2026 presenta "LLC en EE. UU. + Stripe + Mercury o Wise" como la ruta más completa y escalable, y como alternativa constituir la empresa en Colombia, España o México (snippet) — [Cursio](https://cursio.app/blog/como-vender-cursos-online-en-venezuela-2026)
- Recomendación práctica local: ofrecer al menos dos métodos de cobro en dólares y uno en bolívares (pago móvil) (snippet) — [VerCatálogo](https://vercatalogo.com/blog/cobrar-en-dolares-en-venezuela)
- Ejemplos de SaaS/herramientas venezolanas: Cujiware vende membresías desde USD 15/mes por dominio con contacto por WhatsApp; Pabilo vende créditos prepagados (1 crédito por verificación) y un plan de plataforma desde USD 35/mes — [Cujiware](https://cujiware.com/pasarelas-pago-venezuela); [Pabilo](https://pabilo.app/)
- Opciones locales de cobro automatizable si el SaaS tiene persona jurídica y cuenta en el banco: Botón verde BanescoPagos (cargo en cuenta Banesco y débito inmediato de otros bancos), APIs de Mercantil (C2P) y los cobros programados "Recurring" de R4 Cobro Móvil — [Banesco](https://www.banesco.com/empresas/soluciones-digitales/boton-de-pagos-banescopagos/); [Cachicamo, Mercantil](https://docs.cachicamo.app/payments/pago-movil-mercantil); [R4 Cobro Móvil, Términos](https://cobromovil.r4conecta.io/users/legal/terminos/)
- Binance Pay dispone de API de comercio con webhooks, utilizable para cobrar en USDT — [Binance Developers](https://developers.binance.com/docs/binance-pay/introduction)
- Un usuario venezolano reportó no poder pagar un plan de un SaaS extranjero facturado con Stripe, citando que Venezuela no está en la lista de países soportados (snippet) — [Make Community](https://community.make.com/t/i-am-from-venezuela-how-do-i-buy-a-plan/108831)

**Inferencias de quien investigó**

- Para el lanzamiento, la combinación de menor fricción es cobro manual prepagado (mensual o por paquete de rifas/boletos) por Pago Móvil a tasa BCV, Zelle y Binance, reutilizando el mismo flujo de "referencia + comprobante" del producto y, cuando el SaaS tenga cuenta jurídica, verificando sus propios cobros con la API de su banco o un agregador.
- Un modelo de créditos o prepago (como Pabilo) evita la necesidad de cobro recurrente automático, que hoy no existe en Venezuela salvo productos bancarios puntuales (R4 Recurring, C2P con clave en cada cobro).
- Una entidad extranjera con Stripe solo sirve a organizadores con tarjeta internacional o saldo en USD; no sustituye al cobro local en bolívares, que es el medio que usa el cliente objetivo.
- Los cobros en divisas/USDT de las suscripciones no generan IGTF mientras la entidad no sea Sujeto Pasivo Especial (ver pregunta 8), pero sí obligaciones de facturación en bolívares a tasa BCV que deben validarse con un contador.

**Vacíos**

- No se confirmó en fuentes oficiales si Lemon Squeezy, PayPal, Polar, Dodo Payments o CoinGate aceptan vendedores con residencia o entidad venezolana a octubre de 2026.
- No se verificó si Stripe Atlas, Mercury o Wise aceptan fundadores residentes en Venezuela (dos fuentes se contradicen sobre Atlas).
- No se encontró ningún estudio ni conjunto de casos documentados sobre cómo cobran las SaaS venezolanas; la evidencia son páginas de precios de dos proveedores y guías de blogs.
- No se investigaron las implicaciones fiscales y cambiarias de facturar desde una entidad extranjera a clientes en Venezuela.

## 9. Operación legal y fiscal del negocio

Cómo constituirse, qué impuestos y facturación aplican, qué pasa con los datos personales y cómo afectan las sanciones.

### Constitución de empresa en Venezuela (vehículos, pasos, costo, tiempo, capital, obligaciones, régimen de emprendimiento)

**Conclusión**

Hay tres caminos reales: firma personal (un solo dueño, sin separación patrimonial), C.A./S.R.L. (mínimo dos socios, responsabilidad limitada) y el Registro Nacional de Emprendimientos (personalidad jurídica por inscripción, máximo 2 años, luego obliga a pasar al Registro Mercantil). No pude confirmar aranceles SAREN ni plazos vigentes en 2026: las únicas cifras encontradas son de 2022-2023.

**Hallazgos con fuente**

- Una C.A./S.A. no tiene capital mínimo legal, pero el capital debe suscribirse íntegro y pagarse al menos 20% al constituir; requiere al menos dos accionistas; el acta constitutiva se inscribe en el Registro Mercantil y se publica en un diario; debe apartarse 5% de la utilidad neta anual como reserva legal (guía 2026). — [Baker McKenzie, Doing Business in Venezuela 2026](https://www.bakermckenzie.com/-/media/files/insight/guides/2026/doing-business-venezuela-2026.pdf)
- La S.R.L. se constituye con las mismas reglas que la C.A.; su capital se divide en cuotas no representables en acciones; los cuotistas responden solidariamente por 5 años por el valor atribuido a aportes en especie. — [Baker McKenzie 2026](https://www.bakermckenzie.com/-/media/files/insight/guides/2026/doing-business-venezuela-2026.pdf)
- KPMG Venezuela (guía de inversiones de marzo 2026) confirma que las sociedades anónimas requieren al menos inicialmente dos socios (solo extracto; el PDF devolvió 404 al abrirlo). — [KPMG Guía de Inversiones 2026](https://assets.kpmg.com/content/dam/kpmg/ve/pdf/2026/3/Gu%C3%ADa%20de%20Inversiones%202026.3.pdf)
- Toda empresa que realice actividad económica debe inscribirse en el RUPDAE que lleva la SUNDDE, según la guía 2026. — [Baker McKenzie 2026](https://www.bakermckenzie.com/-/media/files/insight/guides/2026/doing-business-venezuela-2026.pdf)
- Los aranceles registrales se rigen por la Ley de Registros y Notarías (Gaceta Oficial 6.668, diciembre 2021); el precio varía según tipo y extensión del documento. — [Baker McKenzie 2026](https://www.bakermckenzie.com/-/media/files/insight/guides/2026/doing-business-venezuela-2026.pdf)
- En 2022 los aranceles SAREN se calculaban con base en el petro, lo que gremios de abogados calificaron de impagable y fuente de inseguridad jurídica (nota del 4-ago-2022). — [Diario de Los Andes](https://diariodelosandes.com/colegio-de-abogados-de-el-vigia-costos-de-aranceles-impuestos-por-el-saren-generan-inseguridad-juridica-a-los-ciudadanos)
- Estimación de 2022: una pequeña empresa necesitaba entre USD 3.000 y 5.000 para formalizarse; costo mínimo de una compañía básica de unos USD 453 antes de honorarios de contador, comisario y abogado (solo extracto; dato viejo). — [La Patilla, 28-feb-2022](https://lapatilla.com/2022/02/28/cuanto-dinero-necesita-un-emprendedor-para-constituir-su-negocio-en-venezuela/)
- Una circular SAREN de abril 2023 fijaba montos por tipo de negocio (p. ej. Bs. 71.000.000 para firmas personales); no está claro si son capitales mínimos o aranceles (solo extracto). — [NTN24](https://www.ntn24.com/noticias-actualidad/saren-establece-entre-100-y-400-millones-de-bolivares-monto-para-constituir-una-empresa-en-venezuela-108882)
- Pasos SAREN (portal saren.gob.ve): reserva de nombre, carga de datos de la persona jurídica y accionistas, carga de documentos, emisión de planilla bancaria, firma presencial en la fecha asignada; luego RIF en SENIAT y, obtenido el RIF, inscripción en INCES, IVSS e Inspectoría del Trabajo. — [El Diario, 2024](https://eldiario.com/2024/04/16/pasos-a-seguir-para-formalizar-emprendimiento-venezuela/)
- Firma personal: regulada por el art. 26 del Código de Comercio; no tiene personalidad jurídica separada del dueño, quien asume la responsabilidad legal y financiera; pasos: reserva de nombre (debe incluir el apellido del solicitante), documentos, inscripción en Registro Mercantil, publicación en diario y RIF de persona natural (nota del 21-may-2025, sin cifras de costo ni plazo). — [Bloomberg Línea](https://www.bloomberglinea.com/latinoamerica/venezuela/requisitos-para-registrar-un-firma-personal-en-venezuela/)
- Ley para el Fomento y Desarrollo de Nuevos Emprendimientos (G.O. 6.656 Ext., 15-oct-2021): el emprendimiento adquiere personalidad jurídica al inscribirse en el Registro Nacional de Emprendimientos (RNE), a cargo del ministerio de Economía y Finanzas; la inscripción tiene vigencia máxima de 2 años y luego debe inscribirse en el Registro Mercantil bajo una figura del Código de Comercio, so pena de ilícitos tributarios. — [Forvis Mazars, InfoMazars 09-2021](https://forvismazars.com/ve/en/content/download/1069154/file/InfoMazars-09-2021-Ley-para-el-Fomento-y-Desarrollo-de-Nuevos-Emprendimientos-1-.pdf)
- Estímulos de esa ley: fórmulas para facilitar el pago de impuestos nacionales y exoneración total o parcial de impuestos directos para emprendimientos con ventas anuales de hasta 10.000 veces el tipo de cambio oficial de la moneda de mayor valor del BCV; estados y municipios deben procurar incentivos propios. — [Forvis Mazars, InfoMazars 09-2021](https://forvismazars.com/ve/en/content/download/1069154/file/InfoMazars-09-2021-Ley-para-el-Fomento-y-Desarrollo-de-Nuevos-Emprendimientos-1-.pdf)
- Decreto 4.719 (G.O. 42.432, 3-ago-2022): dispensa del pago de inscripción en IVSS, INCES, FAOV y ministerio del Trabajo para emprendimientos inscritos en el RNE que se formalizaran dentro de 90 días; exige presentar el certificado RNE para el régimen simplificado y provisional. — [Acceso a la Justicia](https://accesoalajusticia.org/dispensa-de-la-obligacion-de-pago-de-inscripcion-y-registro-en-el-ivss-inces-foav-y-mpp-trabajo-en-beneficio-de-los-nuevos-emprendimientos/)
- Los emprendimientos debidamente inscritos en el RNE están excluidos de la contribución especial de la Ley de Protección de las Pensiones (9% de nómina). — [Baker McKenzie 2026](https://www.bakermckenzie.com/-/media/files/insight/guides/2026/doing-business-venezuela-2026.pdf)
- El certificado RNE vigente se pide para créditos bancarios a emprendedores y para tramitar el RIF del emprendimiento. — [El Diario, 2024](https://eldiario.com/2024/04/16/pasos-a-seguir-para-formalizar-emprendimiento-venezuela/)
- En abril de 2026 la Cámara de Comercio de La Guaira pedía revisar "IGTF, Ley de Pensiones y trámites mercantiles", señal de que el costo registral sigue siendo una queja vigente. — [Finanzas Digital, etiqueta IGTF](https://finanzasdigital.com/tag/igtf/)

**Inferencias de quien investigó**

- Para un desarrollador solo, el RNE es la vía de menor costo de entrada y da 2 años de exclusión de la contribución de pensiones; la C.A. exige un segundo socio (aunque sea minoritario) y costos registrales no confirmados.
- La firma personal es rápida pero expone el patrimonio personal, lo que pesa en un producto que custodia cédulas y comprobantes bancarios de terceros.
- El umbral de 10.000 veces el tipo de cambio equivale en la práctica a unos 10.000 euros o dólares anuales de ventas según la moneda de mayor valor que publique el BCV; es un techo bajo para un SaaS que crezca.

**Vacíos**

- Aranceles SAREN vigentes en 2026, honorarios típicos y tiempos reales de constitución: sin fuente actual.
- No confirmé si existe un decreto de exoneración de ISLR vigente en 2026 que desarrolle el estímulo de la ley de emprendimiento, ni el estado operativo del portal emprenderjuntos.gob.ve.
- Patente municipal (licencia de actividades económicas): requisitos y costo dependen de cada alcaldía; no encontré ordenanzas 2025-2026.
- No verifiqué si el RUPDAE sigue exigiéndose en la práctica.

### Operar como persona natural

**Conclusión**

Es legal: quien realice actividad económica gravada debe tener RIF y facturar, sea persona natural o jurídica. Desde agosto de 2026 el RIF ya no vence.

**Hallazgos con fuente**

- Providencia SNAT/2026/00080 (G.O. 43.435, 12-ago-2026): elimina la vigencia de 3 años y la renovación del RIF, y la obligación de exhibirlo en el local; toda persona natural o jurídica que realice actividades económicas gravadas debe inscribirse; quien inicia actividades tiene 30 días hábiles; el RIF debe figurar en facturas, contratos, libros y publicidad, incluida la de medios digitales; los cambios (actividad, domicilio fiscal o electrónico, cese) se notifican en un mes. — [Forvis Mazars FMI 08-2026](https://www.forvismazars.com/ve/es/insights/forvis-mazars-insights/fmi-0826-reforma-de-regimen-legal-aplicable-al-rif)
- Para el RIF de persona natural se piden cédula y prueba de domicilio (solo extracto). — [El Diario, 2021](https://eldiario.com/2021/12/08/sacar-renovar-rif-venezuela/)
- Personas naturales deben declarar ISLR si su enriquecimiento neto anual supera 1.000 U.T. o sus ingresos brutos 1.500 U.T. (Bs. 43.000 y Bs. 64.500 con la U.T. de junio 2025) (solo extracto). — [PwC Venezuela, junio 2025](https://www.pwc.com/ve/es/assets/documentos/stl/NAC-Reajuste-Valor-UT-Junio2025-v3-2.pdf)
- La U.T. pasó de Bs. 9,00 a Bs. 43,00 en junio de 2025; la guía Baker 2026 sigue citando Bs. 43. — [Forvis Mazars FMI 05-2025](https://www.forvismazars.com/ve/es/insights/forvis-mazars-insights/fmi-0525-reajuste-del-valor-de-la-u.t); [Baker McKenzie 2026](https://www.bakermckenzie.com/-/media/files/insight/guides/2026/doing-business-venezuela-2026.pdf)
- Desde la reforma de 2002 no hay monto mínimo de operaciones para ser contribuyente ordinario del IVA: toda persona natural que realice hechos imponibles lo es (solo extracto, fuente académica antigua). — [Redalyc](https://www.redalyc.org/pdf/257/25712300004.pdf)

**Inferencias de quien investigó**

- Con la U.T. en Bs. 43 los umbrales de declaración de ISLR son ínfimos frente a ingresos en dólares: en la práctica cualquier ingreso de un SaaS obliga a declarar.
- Una persona natural que cobra suscripciones de forma habitual debería cobrar y declarar IVA mensualmente y emitir facturas con su RIF.

**Vacíos**

- No confirmé con fuente primaria de 2026 la tarifa 1 del ISLR (6% a 34%) ni el desgravamen único.
- No encontré límites de facturación para persona natural ni reglas municipales para quien trabaja desde su casa.

### Impuestos sobre un SaaS que vende a clientes venezolanos

**Conclusión**

IVA general 16% sobre bienes y servicios, ISLR societario progresivo de 15% a 34%, impuesto municipal hasta 3% del ingreso bruto y contribuciones parafiscales. El IGTF de 3% sobre pagos en divisas o cripto fuera de la banca solo se percibe cuando quien cobra es sujeto pasivo especial: un contribuyente ordinario no lo cobra. No hallé reforma del IVA, ISLR ni IGTF publicada en 2026.

**Hallazgos con fuente**

- IVA: grava compras e importaciones de bienes y servicios; alícuota general 16%, reducida 8% y adicional de lujo; se liquida mensualmente (débito menos crédito). Los sujetos pasivos especiales retienen 75% del IVA a sus proveedores ordinarios (100% si la factura no cumple requisitos). — [Baker McKenzie 2026](https://www.bakermckenzie.com/-/media/files/insight/guides/2026/doing-business-venezuela-2026.pdf)
- ISLR de sociedades: tarifa progresiva de 15% a 34% según renta en U.T.; prescripción general de 6 años; multas indexadas a la moneda de mayor valor publicada por el BCV. — [Baker McKenzie 2026](https://www.bakermckenzie.com/-/media/files/insight/guides/2026/doing-business-venezuela-2026.pdf)
- IGTF, ley reformada en G.O. 6.687 Ext. (25-feb-2022), vigente desde 28-mar-2022: 3% para operaciones en moneda distinta al bolívar o criptoactivos distintos al petro. Los pagos en divisas o cripto hechos a personas que NO son sujetos pasivos especiales quedaron como supuesto de no sujeción (Decreto 4.647, art. 5), de modo que solo los pagos a especiales están gravados. — [Venamcham, Law by Experts 13 (E. Dupouy, mayo 2022)](https://www.venamcham.org/wp-content/uploads/2022/06/LAW-BY-EXPERTS-13-Reforma-IGTF.pdf)
- Solo los sujetos pasivos especiales fueron designados agentes de percepción del IGTF (Providencia SNAT/2022/000013, G.O. 42.339, 17-mar-2022): perciben el mismo día del pago, enteran quincenalmente y deben mostrar alícuota y monto en la factura. — [Forvis Mazars](https://www.forvismazars.com/ve/es/insights/forvis-mazars-insights/designacion-de-los-spe)
- El SENIAT ha considerado a Zelle y plataformas similares como cancelación de deudas sin mediación del sistema financiero nacional, por lo que un especial que cobra por Zelle debe percibir IGTF. — [Venamcham, Law by Experts 13](https://www.venamcham.org/wp-content/uploads/2022/06/LAW-BY-EXPERTS-13-Reforma-IGTF.pdf)
- Decreto 4.972 (G.O. 6.821 Ext., 12-jul-2024, vigente 15-jul-2024): fija en 0% el IGTF de los numerales 1 a 4 (operaciones en bolívares de especiales y vinculados) y mantiene 3% para pagos en divisas o cripto dentro de la banca nacional sin corresponsal extranjero y para pagos en divisas o cripto a especiales sin mediación financiera. El tributo no fue derogado y el Ejecutivo puede cambiar la alícuota. — [Acceso a la Justicia](https://accesoalajusticia.org/fijada-en-cero-por-ciento-0-la-alicuota-del-impuesto-a-las-grandes-transacciones-financieras-igtf/)
- La guía Baker 2026 resume el IGTF como 2% (bolívares) o 3% (divisas) según el caso, sin recoger el 0% de 2024: hay discrepancia entre fuentes sobre la tasa en bolívares. — [Baker McKenzie 2026](https://www.bakermckenzie.com/-/media/files/insight/guides/2026/doing-business-venezuela-2026.pdf); contrastar con [Acceso a la Justicia](https://accesoalajusticia.org/fijada-en-cero-por-ciento-0-la-alicuota-del-impuesto-a-las-grandes-transacciones-financieras-igtf/)
- En 2025-2026 el IGTF en divisas sigue vigente y cuestionado: jornadas AVDT (dic-2025), gremios (abr-2026) y propuesta de reforma integral de L. Palacios (may-2026); no aparece una reforma aprobada. — [Finanzas Digital, etiqueta IGTF](https://finanzasdigital.com/tag/igtf/)
- En julio de 2026 el SENIAT revocó de oficio la calificación de sujeto pasivo especial a algunos contribuyentes. — [Forvis Mazars Insights (índice 2026)](https://www.forvismazars.com/ve/es/insights/forvis-mazars-insights)
- Impuesto municipal a las actividades económicas: exige licencia municipal; la Ley de Armonización Tributaria (10-ago-2023) limita la alícuota a 3% del ingreso bruto (hasta 6,5% en actividades especiales) y obliga a pagar en bolívares usando como unidad de cuenta la moneda de mayor valor del BCV. — [Baker McKenzie 2026](https://www.bakermckenzie.com/-/media/files/insight/guides/2026/doing-business-venezuela-2026.pdf)
- Ley de Protección de las Pensiones (8-may-2024): contribución de 9% sobre pagos salariales y bonos a trabajadores (tope legal 15%), a cargo de personas jurídicas privadas, con exclusión de emprendimientos inscritos en el RNE. — [Baker McKenzie 2026](https://www.bakermckenzie.com/-/media/files/insight/guides/2026/doing-business-venezuela-2026.pdf)
- Sentencia PJ0662026000050 (17-jun-2026, Tribunal Superior Contencioso Tributario de Guayana): anuló una multa de 1.000 veces el tipo de cambio del euro por no declarar la contribución de pensiones a una empresa sin trabajadores; el fallo es apelable y el portal no admite cero empleados. — [Forvis Mazars FMI 06-2026](https://www.forvismazars.com/ve/es/insights/forvis-mazars-insights/fmi-0626-anulacion-de-multa-de-la-ley-de-pensiones)
- LOCTI (2022): aporte de 0,5% del ingreso bruto solo para empresas con ingresos superiores a 150.000 veces el tipo de cambio de la moneda de mayor valor. Ley del Deporte: 1% de la utilidad neta si supera 20.000 U.T. Fondo Antidrogas: 1% de la utilidad para entidades con 50 o más trabajadores. — [Baker McKenzie 2026](https://www.bakermckenzie.com/-/media/files/insight/guides/2026/doing-business-venezuela-2026.pdf)
- Empleadores aportan además a seguridad social, vivienda (FAOV), régimen de empleo e INCES. — [Baker McKenzie 2026](https://www.bakermckenzie.com/-/media/files/insight/guides/2026/doing-business-venezuela-2026.pdf)

**Inferencias de quien investigó**

- Un SaaS pequeño (contribuyente ordinario) que cobra por Zelle, efectivo o USDT no debe cobrar IGTF a sus clientes; si recibe en una cuenta en divisas de un banco venezolano, el 3% lo debita el banco al pagador.
- El riesgo fiscal principal es el IVA: 16% sobre cada suscripción, declarado mensualmente en bolívares a tasa BCV aunque se cobre en dólares o USDT.
- Si un cliente es sujeto pasivo especial, retendrá 75% del IVA facturado, lo que afecta el flujo de caja.
- Sin empleados no hay base para la contribución de pensiones, pero conviene declarar para evitar multas mientras el criterio judicial no sea firme.

**Vacíos**

- No encontré fuente que trate expresamente el software como servicio en la Ley del IVA; la gravabilidad a 16% se infiere de la regla general de servicios.
- Alícuota municipal para servicios de software en municipios concretos (Libertador, Chacao, Baruta, etc.): sin ordenanza 2025-2026 localizada.
- Valor de la U.T. para 2026 y tipo de cambio BCV a la fecha: no confirmados (bcv.org.ve no cargó).
- Régimen simplificado o umbral de exención para pequeños contribuyentes: no hallé ninguno vigente fuera del estímulo de la ley de emprendimiento.

### Facturación (reglas SENIAT, factura digital, imprentas digitales, divisas)

**Conclusión**

La Providencia de factura digital de diciembre de 2024 obliga a quienes venden por medios electrónicos o portales web a facturar digitalmente mediante una imprenta digital autorizada; un SaaS encaja en esa descripción. En agosto de 2026 el SENIAT derogó la providencia hermana sobre homologación de software de facturación y abrió un período de transición: no pude confirmar si la providencia de factura digital sigue plenamente exigible.

**Hallazgos con fuente**

- Providencia sobre medios digitales para emitir facturas (G.O. 43.032, 19-dic-2024; citada como SNAT/2024/000102): obligados son las personas naturales y jurídicas "que efectúen operaciones comerciales mediante medios electrónicos o portales web", y quienes usan máquina fiscal y además venden electrónicamente; exigible desde el 1-mar-2025. — [Forvis Mazars FMI 01-2025](https://www.forvismazars.com/ve/es/insights/forvis-mazars-insights/fmi-0125-facturacion-digital)
- Requisitos del emisor: conexión permanente a internet, contratar una imprenta digital autorizada, medios para procesar y resguardar la información y dar al SENIAT acceso electrónico permanente por 10 años; la solicitud de autorización va a la Intendencia Nacional de Tributos Internos, que responde en 30 días hábiles. — [Forvis Mazars FMI 01-2025](https://www.forvismazars.com/ve/es/insights/forvis-mazars-insights/fmi-0125-facturacion-digital)
- La imprenta digital autorizada asigna el número de control y valida el documento; solo pueden serlo cooperativas y personas jurídicas domiciliadas autorizadas (parte solo extracto). — [Edicom](https://edicomgroup.com/es/factura-electronica/venezuela); [Forvis Mazars FMI 01-2025](https://www.forvismazars.com/ve/es/insights/forvis-mazars-insights/fmi-0125-facturacion-digital)
- Providencia SNAT/2026/00084 (G.O. 43.435, 12-ago-2026): deroga la SNAT/2024/000121 (misma G.O. 43.032) que regulaba la homologación de proveedores de sistemas de facturación; mientras no haya norma nueva rige el régimen general de facturación de las leyes de IVA e ISLR; se espera más regulación, posiblemente dentro de una reforma tributaria. — [Forvis Mazars FMI 07-2026](https://www.forvismazars.com/ve/es/insights/forvis-mazars-insights/fmi-0726-derogatoria-de-sistemas-homologados)
- La prensa describe la medida como inicio de un "período de transición regulatoria" y señala que el SENIAT no ha detallado el nuevo marco. — [Finanzas Digital, 14-ago-2026](https://finanzasdigital.com/seniat-deroga-norma-sobre-proveedores-de-sistemas-fiscales/)
- Las facturas en formato libre deben cumplir la Providencia SNAT/2011/00071, norma general de facturación aún citada como vigente. — [Forvis Mazars](https://www.forvismazars.com/ve/es/insights/forvis-mazars-insights/designacion-de-los-spe)
- El tipo de cambio de referencia a todos los efectos es el promedio ponderado que publica el BCV (Convenio Cambiario N° 1, art. 9). — [Travieso Evans](https://www.traviesoevans.com/memos/memo-convenio-cambiario-1.pdf)
- Puede prescindirse del RIF del comprador cuando es persona natural que no requiere la factura a efectos tributarios (solo extracto). — [Acceso a la Justicia](https://accesoalajusticia.org/eliminacion-del-domicilio-del-cliente-como-requisito-formal-en-las-facturas/)

**Inferencias de quien investigó**

- Un SaaS que cobra suscripciones en línea debe asumir que está obligado a factura digital con imprenta autorizada, salvo que su contador confirme lo contrario tras la providencia de agosto de 2026.
- La derogatoria de agosto de 2026 parece liberar el software propio de facturación del requisito de homologación, lo que facilitaría integrar la emisión en la propia aplicación Laravel.

**Vacíos**

- Vigencia actual de la SNAT/2024/000102 tras la G.O. 43.435: no confirmada.
- Costo de las imprentas digitales autorizadas y lista vigente: sin datos.
- Reglas exactas para facturar en divisas (mención de la tasa BCV y contravalor en bolívares): no pude citar la norma; verificar con contador.
- Hay discrepancia de numeración entre fuentes (000102 frente a 000121) para la G.O. 43.032; Mazars indica que la 000121 era la de homologación.

### Cobrar en dólares y cripto

**Conclusión**

Cobrar y pactar en divisas es legal desde 2018 (libre convertibilidad y cuentas en moneda extranjera). El USDT se usa masivamente pero carece de regulación específica y no es moneda de curso legal; Sunacrip sigue en reestructuración desde 2023. El punto débil es Zelle: bancos de EE.UU. cierran cuentas personales usadas para cobros comerciales.

**Hallazgos con fuente**

- Convenio Cambiario N° 1 (G.O. 6.405 Ext., 7-sep-2018): restablece la libre convertibilidad; ratifica el art. 128 de la Ley del BCV: si la divisa es moneda de cuenta se puede pagar en divisa o en bolívares a la tasa del día de pago; si es moneda de pago debe pagarse en divisa. — [Travieso Evans](https://www.traviesoevans.com/memos/memo-convenio-cambiario-1.pdf)
- Personas naturales residentes y personas jurídicas pueden mantener cuentas en moneda extranjera en bancos universales y microfinancieros, sin monto mínimo y sin más requisitos que los de cuentas en bolívares (arts. 32 y 33). — [Travieso Evans](https://www.traviesoevans.com/memos/memo-convenio-cambiario-1.pdf)
- El decreto constituyente de 2018 (G.O. 41.452) derogó la Ley de Ilícitos Cambiarios. — [Baker McKenzie 2026](https://www.bakermckenzie.com/-/media/files/insight/guides/2026/doing-business-venezuela-2026.pdf)
- Sunacrip fue intervenida en marzo de 2023 (Decreto 4.788) y la reestructuración se prorrogó tres veces, la última por Decreto 5.003 (G.O. 42.964, 16-sep-2024), por seis meses. — [Acceso a la Justicia](https://accesoalajusticia.org/prorrogado-por-tercera-vez-el-proceso-de-reestructuracion-de-la-sunacrip/)
- En 2026 Sunacrip sigue renovando licencias de exchanges; el abogado Raymond Orta sostiene que autorizar un exchange "no convierte a USDT en moneda de curso legal", que cambiar USDT por bienes es una permuta y que faltan reglas contables, fiscales y de trazabilidad (20-feb-2026). — [CriptoNoticias](https://www.criptonoticias.com/regulacion/usdt-debe-regulado-venezuela-raymondorta/)
- Solo dos plataformas tenían autorización formal de Sunacrip en agosto de 2026 (Crixto y Kontigo); Binance opera por P2P sin licencia local, en "zona gris". Crixto es agregador de Binance Pay: el cliente paga por QR en USDT y el comercio recibe bolívares. — [Ecosistema Startup, 30-ago-2026](https://ecosistemastartup.com/cripto-en-venezuela-tarjetas-licencias-y-us44-600m/)
- Tether prohíbe al Gobierno venezolano como usuario directo y ha congelado billeteras ligadas a evasión de sanciones; no alcanza a particulares. — [CriptoNoticias](https://www.criptonoticias.com/regulacion/usdt-debe-regulado-venezuela-raymondorta/)
- Existe el boletín contable BA VEN-NIF 12 sobre tenencia de criptoactivos propios y su tratamiento tributario. — [Forvis Mazars Insights (FMI 10-2025)](https://www.forvismazars.com/ve/es/insights/forvis-mazars-insights)
- Zelle: Wells Fargo y Chase restringieron su uso desde Venezuela en 2020; comerciantes reportan cuentas cerradas en EE.UU. por recibir pagos comerciales en cuentas personales (solo extractos). — [Bloomberg Línea](https://www.bloomberglinea.com/latinoamerica/venezuela/que-esta-ocurriendo-con-las-transacciones-a-traves-de-zelle-en-venezuela/); [Diario Las Américas](https://www.diariolasamericas.com/america-latina/algunos-bancos-eeuu-bloquean-el-uso-zelle-venezuela-n5346881)
- Kontigo anunció en mayo de 2026 que habilitaría Zelle, PayPal y transferencias de EE.UU. para operaciones en Venezuela apoyándose en la Licencia General 57 (solo extracto, reporte único). — [Descubre.vc](https://www.descubre.vc/noticia/kontigo-integrar-pagos-con-zelle-y-paypal-en-venezuela-2026-05-25)
- Cavecom-e pidió en febrero de 2026 reglas urgentes para pago móvil y puntos de venta por falta de normas tributarias. — [Finanzas Digital](https://finanzasdigital.com/cavecome-ley-derechos-socioeconomicos/)

**Inferencias de quien investigó**

- La combinación de menor riesgo legal local es: precio en dólares como moneda de cuenta, cobro en bolívares por Pago Móvil a tasa BCV, o en divisas a una cuenta en moneda extranjera a nombre del negocio, siempre con factura.
- Cobrar por Zelle en cuenta personal ajena o propia es práctica común pero frágil (riesgo de cierre por el banco estadounidense) y deja ingresos fuera de la banca venezolana que igual deben declararse.
- Aceptar USDT es tolerado y masivo, pero conviene documentar origen de fondos y registrar cada cobro a tasa BCV del día.

**Vacíos**

- Estado de Sunacrip después de marzo de 2025 (nuevas prórrogas o cierre de la reestructuración): no confirmado.
- Requisitos de bancos venezolanos para abrir cuenta en divisas o Pago Móvil comercial (C2P, botón de pago) a un emprendimiento: no investigado.
- Norma que obligue a aceptar bolívares o a publicar precios en bolívares: no localizada.

### Opción de entidad extranjera (LLC en EE.UU. u otra)

**Conclusión**

Stripe no opera en Venezuela y solo se accede con una entidad en un país soportado. La barrera real no es constituir la LLC sino el KYC bancario: Mercury listaba a Venezuela como país prohibido en 2024 y Firstbase la incluye entre 22 países cuyos residentes no puede atender. La LLC no elimina la tributación venezolana del dueño residente.

**Hallazgos con fuente**

- Stripe lista 51 países disponibles; de Latinoamérica solo Brasil y México; Venezuela no figura. Atlas permite constituir una empresa estadounidense "desde cualquier parte del mundo". — [Stripe Global](https://stripe.com/global)
- Stripe Atlas constituye C-Corp o LLC en Delaware en 1 a 2 días hábiles, tramita el EIN (10 a 30 días hábiles sin SSN), pide dirección y teléfono de EE.UU. (pueden ser virtuales) y advierte que no garantiza la aprobación de Stripe Payments; Delaware exige agente registrado e informe y franquicia anual antes del 1 de marzo. — [Stripe Docs, Atlas](https://docs.stripe.com/atlas/signup)
- Mercury: en julio de 2024 su lista de 37 países prohibidos incluía a Venezuela; la política ha alternado entre criterio de pasaporte y de residencia del fundador (solo extractos; la página oficial devolvió 403). — [Techpoint Africa, jul-2024](https://techpoint.africa/2024/07/23/mercury-bank-closes-african-accounrs/); [Mercury, Prohibited countries](https://support.mercury.com/hc/en-us/articles/35628854440468-Prohibited-countries)
- Firstbase publica una lista de 22 países restringidos que incluye a Venezuela; cobra USD 399 de constitución más USD 299 anuales por agente registrado; declaración fiscal de LLC unipersonal de dueño extranjero USD 899 anuales. doola cobra USD 297 anuales más tasas estatales e incluye EIN y agente; no se menciona lista de restringidos (comparador con relaciones comerciales, revisado jul-2026). — [GlobalSolo](https://www.globalsolo.global/compare/services/firstbase-vs-doola)
- Una LLC unipersonal de dueño extranjero debe presentar Formulario 5472 con 1120 pro forma aunque no deba impuesto federal; la omisión puede costar USD 25.000 por año; el ingreso solo tributa en EE.UU. si hay comercio o negocio dentro del país (solo extractos). — [Terms.law](https://terms.law/2023/06/01/guia-para-la-creacion-de-una-llc-en-los-ee-uu-para-no-residentes/); [Mercado](https://mercado.com.ar/negocios/llc-en-ee-uu-el-formulario-que-puede-impactar-en-miles-de-dolares)
- Venezuela aplica transparencia fiscal internacional: el residente debe declarar como propios, por devengo, ingresos y gastos de entidades en jurisdicciones de baja imposición, definidas como las que no tienen convenio de doble imposición con Venezuela o gravan a menos de 20%. Venezuela tiene 33 convenios vigentes, incluido Estados Unidos. — [Baker McKenzie 2026](https://www.bakermckenzie.com/-/media/files/insight/guides/2026/doing-business-venezuela-2026.pdf)
- Payoneer sí abre cuentas a venezolanos y permite retirar a bancos locales; Wise exige cuenta bancaria de un país soportado, por lo que generalmente no sirve directamente (solo extracto de un blog de 2026). — [RemoteStack](https://remotestack.in/blog/remote-jobs-for-venezuelans-2026)
- Un proveedor comercial ofrece la ruta de una Ltd. británica para acceder a Stripe desde Venezuela, sin evidencia independiente (marketing; fechas inconsistentes). — [IncorpUK](https://incorpuk.com/blog/how-to-open-stripe-account-in-venezuela/)
- Qash (neobanco de stablecoins) dijo en mayo de 2026 que bancos socios de EE.UU. aprobaron abrir cuentas a empresas venezolanas bajo las nuevas licencias y que estaba incorporando a la primera. — [CriptoNoticias, 13-may-2026](https://www.criptonoticias.com/comunidad/qash-conexion-empresas-venezolanas-banca-estadounidense/)

**Inferencias de quien investigó**

- Para clientes que pagan por Pago Móvil, Zelle y USDT, una LLC aporta poco: Stripe sirve para tarjetas internacionales, que no son el medio de pago del mercado objetivo.
- Una LLC unipersonal es fiscalmente transparente en EE.UU., así que su renta probablemente caiga en el régimen de transparencia venezolano pese al convenio; requiere opinión de un tributarista.
- La LLC tampoco elimina IVA ni facturación venezolana si el servicio se presta a clientes en Venezuela desde Venezuela.
- Costo orientativo del primer año: unos USD 300 a 700 de constitución y agente más unos USD 900 de cumplimiento del 5472 si se terceriza.

**Vacíos**

- Listas oficiales vigentes de Mercury, Relay, Wise, Payoneer, PayPal y doola respecto a residentes venezolanos en octubre de 2026: no verificadas en fuente primaria.
- Si Stripe Atlas rechaza fundadores residentes en Venezuela: la documentación leída no lo dice.
- Qué tan común es la LLC entre desarrolladores venezolanos: sin datos ni testimonios (búsquedas en foros no realizadas).

### Sanciones y disponibilidad de servicios

**Conclusión**

Las sanciones bloquean al Gobierno de Venezuela y a personas designadas, no a los ciudadanos ni a la empresa privada; en 2026 OFAC las ha flexibilizado por sectores, incluidos banca pública (LG 57) y telecomunicaciones (LG 61A). Las restricciones que sufre un desarrollador son sobre todo de política comercial de cada proveedor. No encontré evidencia de bloqueo de GitHub, Twilio ni WhatsApp Business.

**Hallazgos con fuente**

- OFAC, pregunta frecuente 680: las personas estadounidenses no tienen prohibido realizar transacciones que involucren al país o al pueblo de Venezuela, siempre que no participen personas bloqueadas ni conductas prohibidas; tratar con el Gobierno y entidades que posea en 50% o más sí requiere autorización. — [OFAC FAQ 680](https://ofac.treasury.gov/faqs/680)
- Siguen listadas las órdenes ejecutivas 13692, 13808, 13827, 13835, 13850, 13857 y 13884, más la 14373 (9-ene-2026). Licencias generales vigentes listadas: LG 56 y LG 57 (14-abr-2026), LG 60 de ayuda por terremoto (25-jun-2026), LG 61A de telecomunicaciones (27-ago-2026), LG 62 (21-ago-2026), y enmiendas del 28-sep-2026. — [OFAC, sanciones relacionadas con Venezuela](https://ofac.treasury.gov/sanctions-programs-and-country-information/venezuela-related-sanctions)
- LG 57 autoriza servicios financieros con el BCV, Banco de Venezuela, Banco Digital de los Trabajadores y Banco del Tesoro: cuentas, transferencias, ACH, tarjetas, billeteras digitales, corresponsalía en dólares. No desbloquea bienes ni releva de la Ley de Secreto Bancario. — [Finanzas Digital, 14-abr-2026](https://finanzasdigital.com/ofac-banco-central-venezuela-2026/); [Crowell (cmtradelaw)](https://www.cmtradelaw.com/2026/04/ofac-expands-venezuela-sanctions-relief-new-general-licenses-56-and-57-and-guidance-on-reporting-obligations/)
- LG 61 y 61A autorizan a personas de EE.UU. proveer bienes, tecnología, software y servicios para telecomunicaciones en Venezuela, incluso con CONATEL y CANTV, que se consideran bloqueadas por ser del Estado; la FAQ 1266 incluye servicios en la nube, almacenamiento de datos y sistemas de facturación a clientes; excluye contrapartes de China, Cuba, Irán, Corea del Norte y Rusia. — [Cleary Gottlieb, 27-ago-2026](https://www.clearygottlieb.com/-/media/files/alert-memos-2026/ofac-issues-general-licenses-authorizing-activity-in-venezuelan-telecommunications-sector.pdf); [Forvis Mazars, cuadro de licencias 2026](https://www.forvismazars.com/ve/es/content/download/1314036/file/FMI%201126%20-%20Licencias%20Generales%20OFAC%202026%20relacionadas%20con%20Venezuela.pdf)
- La LG 60 es un corredor humanitario temporal vigente hasta el 23-oct-2026, no una apertura general. — [Ecosistema Startup](https://ecosistemastartup.com/cripto-en-venezuela-tarjetas-licencias-y-us44-600m/)
- GitHub: su política de controles comerciales nombra Crimea, Donetsk, Luhansk, Cuba, Irán, Corea del Norte y Siria; Venezuela no aparece. — [GitHub Docs](https://docs.github.com/en/site-policy/other-site-policies/github-and-trade-controls)
- Stripe no está disponible para negocios en Venezuela; servicios que cobran solo por Stripe (ejemplo: Make) no pueden venderse a clientes venezolanos (parte solo extracto). — [Stripe Global](https://stripe.com/global); [Make Community](https://community.make.com/t/i-am-from-venezuela-how-do-i-buy-a-plan/108831)
- Algunos proveedores de hosting sí excluyen a Venezuela por política propia: InMotion Hosting la lista junto a Cuba, Irán, Corea del Norte, Rusia y Siria (actualizado sep-2025; solo extracto). — [InMotion Hosting](https://www.inmotionhosting.com/support/billing/countries.md)
- DigitalOcean: una cita de sus términos lista Cuba, Irán, Corea del Norte, Siria y Crimea, sin Venezuela (solo extracto, posiblemente antiguo). — [DigitalOcean Community](https://www.digitalocean.com/community/questions/why-digitalocean-block-ir-tld)
- Twilio en Venezuela: envío de SMS soportado pero sin SMS bidireccional, sin mensajes concatenados, sin números locales; el remitente alfanumérico solo se registra para Digitel (unos 21 días). — [Twilio, guía SMS Venezuela](https://www.twilio.com/en-us/guidelines/ve/sms)
- WhatsApp Business API: la lista de países no elegibles reportada es Cuba, Irán, Corea del Norte, Siria y regiones ocupadas de Ucrania; Venezuela no figura (página de tercero, jul-2024; solo extracto). — [Deskpro](https://support.deskpro.com/en-US/guides/admin-guide/channels/whatsapp/whatsapp-country-restrictions)
- Precedente de 2019: Adobe desactivó todas las cuentas en Venezuela tras la orden ejecutiva 13884 (solo extracto). — [The Hacker News](https://thehackernews.com/2019/10/adobe-venezuela-sanctions.html?m=0)
- Bloqueos internos: al 6-oct-2026 seguían bloqueados 143 dominios (24 de noticias) tras dos oleadas de desbloqueo en septiembre; los bloqueos varían por proveedor; CONATEL no publica sus órdenes. — [VE sin Filtro](https://vesinfiltro.org/)
- Entre el 4 y el 11 de enero de 2025 CANTV bloqueó por TCP/IP más de 30 DNS públicos (8.8.8.8, 1.1.1.1, 9.9.9.9) y los principales proveedores bloquearon al menos 21 sitios de VPN; desde agosto de 2024 X y Signal estuvieron bloqueados. — [Internet Society Pulse](https://pulse.internetsociety.org/en/shutdowns/content-blocking-in-venezuela-4-january-2025/)
- Entre 2019 y 2025 Venezuela usó bloqueos de servicios y no apagones nacionales de internet (análisis ISOC, ago-2026). — [VE sin Filtro](https://vesinfiltro.org/)

**Inferencias de quien investigó**

- El riesgo regulatorio de usar nube estadounidense para un negocio privado venezolano es bajo y bajó más en 2026; el riesgo operativo es el pago (tarjeta internacional) y la verificación de identidad de cada proveedor.
- Conviene elegir proveedores sin Venezuela en su lista de exclusión, pagar con tarjeta internacional estable, y tener respaldo exportable y un segundo proveedor por si hay cierre unilateral.
- El riesgo de bloqueo por operadores venezolanos para una app de rifas es bajo (los bloqueos apuntan a medios, política, VPN y tasas paralelas), pero no nulo: no hay transparencia ni recurso efectivo.
- Para mensajería transaccional, WhatsApp es más viable que SMS dadas las limitaciones de SMS en el país.

**Vacíos**

- Políticas oficiales vigentes de AWS, Google Cloud, Azure, Hetzner, Vercel, Cloudflare, PayPal, Google Workspace y cuentas de desarrollador Apple/Google respecto a Venezuela: no verificadas (búsquedas agotadas; varias páginas no cargaron).
- Latencia y mejor región de hosting para usuarios venezolanos: sin mediciones ni fuente.
- Renovación de la LG 60 después del 23-oct-2026 y cualquier levantamiento amplio de sanciones posterior al 5-oct-2026: no confirmado.
- Efecto de los terremotos de junio de 2026 y de los cortes eléctricos sobre la conectividad: sin fuente.

### Dominios (.ve y .com.ve frente a .com)

**Conclusión**

NIC.ve, dependiente de CONATEL, registra dominios .ve en línea por unos Bs. 15.712 anuales (aproximadamente 16 euros) y existe un .emprende.ve más barato. Un .com evita depender del registrador estatal.

**Hallazgos con fuente**

- Tarifas publicadas en nic.ve (consultadas 13-oct-2026): registro y renovación anual Bs. 15.712,07; dominio .ve de segundo nivel y transferencia Bs. 31.424,15; registro .emprende.ve Bs. 6.874,03. Soporte: soporte@nic.ve. — [NIC.ve](https://nic.ve/)
- Tarifas reportadas por un registrador: 16 euros por asignación y 32 euros para transferencias y dominios de segundo nivel; abierto a personas naturales y jurídicas nacionales y extranjeras; .com.ve concentraba 82,80% de las asignaciones en el segundo trimestre de 2025 (solo extracto, blog comercial de may-2026). — [Nominus](https://www.nominus.com/blog/ve-most-popular-domains-in-venezuela-and-how-to-register-them)
- Marco: Plan Nacional de Nombres de Dominio ".ve" (Providencia 046 de CONATEL, G.O. 42.723, 2023); el solicitante tramita ante CONATEL por la plataforma NIC.ve (solo extracto). — [Acceso a la Justicia](https://accesoalajusticia.org/plan-nacional-de-nombres-de-dominio-ve/)
- GoDaddy indica que desde abril de 2020 los nuevos registros .ve requieren RIF o documento de identidad; otro registrador dice que no hay requisitos (fuentes en conflicto; solo extractos). — [GoDaddy](https://www.godaddy.com/es/help/about-ve-domains-9078); [Marcaria](https://whois.marcaria.com/es/américa/ve-busqueda-de-dominio)

**Inferencias de quien investigó**

- Los números sin etiqueta junto a los precios en nic.ve (16, 32, 7) coinciden con las tarifas en euros de Nominus, lo que sugiere tarifas ancladas al euro y cobradas en bolívares.
- Estrategia razonable: .com como dominio principal en un registrador internacional y el .com.ve como registro defensivo y señal de confianza local.

**Vacíos**

- Requisitos documentales exactos, medios de pago y tiempos de activación en NIC.ve: no confirmados.
- Registradores internacionales que aceptan clientes y tarjetas de Venezuela: no verificado.

### Protección de datos y privacidad

**Conclusión**

Venezuela sigue sin ley general de protección de datos ni autoridad de control. Rigen los artículos 28 y 60 de la Constitución y los principios vinculantes de la Sala Constitucional (sentencia 1318 de 2011), más sanciones penales de leyes especiales. No encontré proyecto de ley en trámite en 2025-2026.

**Hallazgos con fuente**

- No existe ley general ni autoridad general de protección de datos (solo extracto). — [DataGuidance](https://www.dataguidance.com/taxonomy/term/176)
- Art. 28: derecho a acceder y conocer los datos propios en registros oficiales o privados, su uso y finalidad, y a pedir actualización, rectificación o destrucción. Art. 60: derecho a la privacidad y límite al uso de la informática. — [IAPP, 19-ago-2025](https://iapp.org/news/a/venezuela-data-breach-highlights-scattered-privacy-regulation)
- Sentencia 1318 del 4-ago-2011 (Sala Constitucional): consentimiento previo, libre, informado, inequívoco y revocable; legalidad; finalidad y calidad (datos adecuados, pertinentes y no excesivos); temporalidad y derecho al olvido; exactitud y autodeterminación; previsión e integralidad; seguridad y confidencialidad, incluso tras terminar la relación, con prohibición de transferir bases de datos a Estados sin protección adecuada; tutela; y responsabilidad civil, penal y administrativa no limitada a la banca. — [Baker McKenzie, Global Compliance News](https://www.globalcompliancenews.com/data-privacy/data-protection-enforcement-in-venezuela/)
- La Sala Constitucional fijó con carácter vinculante el procedimiento de habeas data (sentencia 1511 de 2009) hasta que la Asamblea legisle; una decisión de 2022 (N° 0650) trató la competencia de tribunales de municipio (solo extracto). — [Acceso a la Justicia](https://accesoalajusticia.org/competencia-juzgados-municipio-habeas-data/)
- Sanciones: la ley de delitos informáticos prevé multas de 200 a 600 U.T. y prisión de 2 a 6 años; la ley de privacidad de las comunicaciones, de 3 meses a 5 años; no hay agencia administrativa, los casos van a tribunales. — [Baker McKenzie, Global Compliance News](https://www.globalcompliancenews.com/data-privacy/data-protection-enforcement-in-venezuela/)
- No hay obligación clara de notificar brechas a una autoridad. Caso Movistar (abril 2025): expuestos datos de más de 3,25 millones de personas (cédula, nombre, ciudad, teléfono) sin notificación pública de la empresa. — [IAPP](https://iapp.org/news/a/venezuela-data-breach-highlights-scattered-privacy-regulation)
- En agosto de 2024 se creó el Consejo Nacional de Ciberseguridad, sin claridad sobre su papel en protección de datos. — [IAPP](https://iapp.org/news/a/venezuela-data-breach-highlights-scattered-privacy-regulation)
- Un informe de VE sin Filtro y Atlantic Council (26-mar-2026) afirma que la infraestructura de vigilancia persiste tras el 3-ene-2026. — [VE sin Filtro](https://vesinfiltro.org/)

**Inferencias de quien investigó**

- La política de privacidad debe mapear los principios de la 1318: quién es el responsable, qué datos (nombre, cédula, teléfono, comprobante), finalidad, base de consentimiento, plazo de conservación, canal para acceso, rectificación y supresión, medidas de seguridad, encargados y países de alojamiento.
- El SaaS actúa como encargado de datos que recolecta el organizador de la rifa; conviene que los términos atribuyan al organizador la condición de responsable y la obligación de obtener el consentimiento del comprador.
- Alojar datos fuera de Venezuela choca en teoría con la prohibición de transferir a Estados sin protección adecuada; el consentimiento expreso del titular a la transferencia internacional es la mitigación razonable.
- Cédula más comprobante bancario es justo el tipo de combinación que la Sala trata como perfil: minimizar, cifrar en reposo, limitar accesos y fijar borrado tras cerrar cada rifa.

**Vacíos**

- Texto primario de la sentencia 1318 no consultado (el sitio del TSJ falló por certificado).
- Proyecto de ley de protección de datos en la Asamblea Nacional 2025-2026: no hallé evidencia de su existencia ni de su ausencia definitiva.
- Reglas específicas sobre almacenar números de cédula o comprobantes bancarios; alcance de la Ley de Infogobierno y de la Ley de Mensajes de Datos en este punto: no localizadas.

### Consumidor y comercio electrónico

**Conclusión**

La protección al consumidor sigue bajo la Ley Orgánica de Precios Justos de 2015 y la SUNDDE, que reconoce derecho de devolución y reembolso inmediato en ventas por medios electrónicos. Hay dos proyectos en movimiento, una Ley de Derechos Socioeconómicos aprobada en primera discusión en enero de 2026 y una Ley de Comercio Electrónico aún sin aprobar.

**Hallazgos con fuente**

- Ley de Precios Justos (G.O. 40.787, 12-nov-2015): el art. 10 da a quien adquiere bienes o servicios por teléfono, catálogo, televisión, medios electrónicos o a domicilio el derecho a devolver y obtener reembolso inmediato; el art. 54 sanciona con 200 a 20.000 U.T. a quien menoscabe derechos de las personas. — [Baker McKenzie 2026](https://www.bakermckenzie.com/-/media/files/insight/guides/2026/doing-business-venezuela-2026.pdf)
- El proyecto de Ley de Derechos Socioeconómicos fue aprobado en primera discusión en enero de 2026, menciona el comercio electrónico y da a la SUNDDE rol de supervisión; Cavecom-e lo describe como un giro de controles hacia educación y acompañamiento (10-feb-2026). — [Finanzas Digital](https://finanzasdigital.com/cavecome-ley-derechos-socioeconomicos/)
- Ley de Comercio Electrónico: aprobada en primera discusión en noviembre de 2014 (preveía factura electrónica obligatoria); en febrero de 2025 el Ejecutivo ordenó llevar un nuevo proyecto a la Asamblea; Cavecom-e presentó propuesta en 2025; sin aprobación final conocida. — [Elyex, 2014](https://elyex.com/aprobado-en-primera-discusion-proyecto-de-ley-de-comercio-electronico/); [DPL News, 25-feb-2025](https://dplnews.com/?p=266617); [Finanzas Digital](https://finanzasdigital.com/cavecome-ley-derechos-socioeconomicos/)
- Se exige usar la tasa oficial del BCV en transacciones en divisas; el ministerio de Comercio fiscaliza su cumplimiento (solo extracto). — [Portafolio](https://www.portafolio.co/internacional/comerciantes-venezolanos-exigen-el-uso-del-tipo-de-cambio-oficial-en-ventas-con-divisas-611417)
- La publicidad en medios digitales debe mostrar el RIF (Providencia SNAT/2026/00080). — [Forvis Mazars FMI 08-2026](https://www.forvismazars.com/ve/es/insights/forvis-mazars-insights/fmi-0826-reforma-de-regimen-legal-aplicable-al-rif)

**Inferencias de quien investigó**

- El sitio debería mostrar razón social o nombre del titular, RIF, domicilio, contacto, precio total con IVA, moneda y tasa aplicable, y una política de reembolso clara.
- El derecho de devolución en ventas electrónicas se pensó para bienes; para una suscripción digital conviene ofrecer cancelación en cualquier momento y definir contractualmente qué se reembolsa.
- Usar una tasa distinta a la del BCV para convertir precios expone a sanción.

**Vacíos**

- Texto y estado en segunda discusión de la Ley de Derechos Socioeconómicos, y si deroga la Ley de Precios Justos: no confirmado.
- Lista legal de información obligatoria en sitios web de comercio electrónico: no hallada.

### Contratos electrónicos y términos de uso

**Conclusión**

Los mensajes de datos tienen el mismo valor probatorio que los documentos escritos, lo que sostiene la validez de términos aceptados por clic. No existe un régimen de puerto seguro para plataformas: la ley Resorte-ME permite sancionar a sitios por contenido de terceros.

**Hallazgos con fuente**

- Decreto-Ley sobre Mensajes de Datos y Firmas Electrónicas (2001), art. 4: los mensajes de datos tienen la misma eficacia probatoria que los documentos escritos; su promoción en juicio sigue las reglas de pruebas libres del Código de Procedimiento Civil; la firma electrónica se define ampliamente como información asociada al mensaje que permite atribuir autoría (solo extractos académicos). — [SciELO Venezuela](https://ve.scielo.org/pdf/frone/v15n3/art12.pdf); [Redalyc](https://www.redalyc.org/pdf/181/18118941022.pdf)
- La doctrina sostiene que la contratación electrónica es válida con o sin ley que la admita expresamente (solo extracto). — [Themis PUCP](https://revistas.pucp.edu.pe/index.php/themis/article/download/10075/10512)
- Ley Resorte-ME (G.O. 39.579; reforma de diciembre de 2010 que la extendió a medios electrónicos): los sitios web pueden ser multados por contenido publicado por terceros (art. 27) y los proveedores que no atiendan requerimientos del Estado arriesgan multas altas y suspensión; CONATEL abre procedimientos administrativos sin control judicial previo. — [Stanford WILMap](https://wilmap.stanford.edu/node/30203)
- Los tribunales venezolanos y el arbitraje están disponibles para disputas comerciales; la Constitución reconoce los medios alternativos. — [Baker McKenzie 2026](https://www.bakermckenzie.com/-/media/files/insight/guides/2026/doing-business-venezuela-2026.pdf)

**Inferencias de quien investigó**

- Para que el clic sea defendible: casilla no premarcada, texto accesible antes de aceptar, registro de fecha, hora, IP, cuenta y versión aceptada, y copia enviada por correo.
- Cláusulas recomendables: el organizador es el único responsable de la rifa, de sus permisos, de los premios y de los datos de sus compradores; declaración de que cuenta con la autorización legal exigible; indemnidad a favor de la plataforma; derecho a suspender cuentas ante denuncia o requerimiento de autoridad; límite de responsabilidad al monto pagado; procedimiento de reclamos; ley venezolana y domicilio especial o arbitraje.
- Las limitaciones de responsabilidad frente a consumidores pueden ser tratadas como cláusulas de adhesión abusivas; frente a organizadores que son comerciantes son más sólidas.
- Atender con rapidez requerimientos de CONATEL u otra autoridad es la única defensa práctica ante la falta de puerto seguro.

**Vacíos**

- Jurisprudencia del TSJ sobre aceptación por clic o contratos de adhesión en línea: no localizada.
- Texto del art. 15 de la Ley de Mensajes de Datos y de los arts. 27 a 29 de Resorte-ME: no leídos en fuente primaria.

### Propiedad intelectual (marca en el SAPI y software)

**Conclusión**

Registrar una marca en el SAPI toma de 12 a 24 meses sin oposición y dura 15 años; exige búsqueda previa y una solicitud por clase. No pude confirmar las tasas vigentes.

**Hallazgos con fuente**

- Proceso (may-2026): búsqueda obligatoria en WEBPI (fonética unos 3 días; gráfica al menos 7), presentación, examen de forma de 1 a 2 meses, publicación en diario a costa del solicitante dentro de 2 meses y en el Boletín, 30 días hábiles para oposiciones, examen de fondo de 3 a 4 meses, pago de derechos de registro en 30 días hábiles tras la concesión. — [Harris Sliwoski, 18-may-2026](https://harris-sliwoski.com/blog/registering-a-trademark-in-venezuela/)
- Plazo total: 12 a 24 meses sin oposición; 4 años o más si hay oposición. Vigencia de 15 años renovable; cancelable por falta de uso durante 2 años consecutivos; clasificación de Niza sin solicitudes multiclase. — [Harris Sliwoski](https://harris-sliwoski.com/blog/registering-a-trademark-in-venezuela/)
- Las tasas oficiales se fijan en moneda venezolana, han cambiado repetidamente y deben confirmarse antes de presentar. — [Harris Sliwoski](https://harris-sliwoski.com/blog/registering-a-trademark-in-venezuela/)
- En enero de 2022 el SAPI anunció que no cobraría al usuario por registrar una marca (solo extracto; vigencia en 2026 no confirmada). — [SAPI, periódico 7-ene-2022](https://sapi.gob.ve/wp-content/uploads/2022/01/Periodico-SAPI-Edicion-07-de-enero-de-2022.pdf)
- En julio de 2024 se restableció el plazo de gracia de 6 meses para renovar, con recargo (solo extracto). — [EU IP Helpdesk](https://intellectual-property-helpdesk.ec.europa.eu/news-events/news/venezuela-re-establishes-grace-period-trade-mark-renewals-2024-07-19_en)

**Inferencias de quien investigó**

- Para un SaaS las clases relevantes serían la 42 (software como servicio) y eventualmente la 9 y la 35; cada una es una solicitud y una tasa aparte.
- Conviene presentar pronto: la prioridad nace con la solicitud y el trámite es largo.

**Vacíos**

- Tasas SAPI 2026 y honorarios de agentes: sin datos.
- Protección del software (derecho de autor, registro en la Dirección de Derecho de Autor del SAPI, titularidad del código): no investigado.

### Experiencia práctica de fundadores y startups venezolanas

**Conclusión**

La evidencia pública es escasa y de empresas con capital de riesgo, no de SaaS pequeños. El patrón visible es una entidad en EE.UU. para levantar capital y operación local en Venezuela, con rieles de pago locales y cripto.

**Hallazgos con fuente**

- Yummy fue descrita en 2021 como una aplicación con sede en San Francisco y operaciones en Venezuela (solo extracto). — [LAVCA](https://www.lavca.org/?p=22136); [Bloomberg Línea](https://www.bloomberglinea.com/english/yummy-closes-largest-funding-round-ever-for-a-venezuelan-startup/)
- Cashea, fintech de compra ahora y paga después fundada en 2022, levantó USD 100 millones en 2026 (serie A en marzo y serie B en junio), la mayor ronda de una startup venezolana; se reporta que todo el capital se invertirá en Venezuela (solo extracto). — [Ecosistema Startup](https://ecosistemastartup.com/cashea-capto-us100m-y-el-vc-en-venezuela-sigue-en-mapeo/)
- Kontigo opera con licencia de Sunacrip renovada hasta 2027 y bancos aliados (BNC, Activo, Plaza, Bancamiga): el usuario deposita dólares en taquilla y recibe USDC. — [Ecosistema Startup](https://ecosistemastartup.com/cripto-en-venezuela-tarjetas-licencias-y-us44-600m/)
- En 2026 volvieron o entraron actores internacionales: Uphold (13-may-2026), tarjeta Visa de OKX (julio), Coinbase habilitó funciones limitadas (5-ago-2026); Venezuela Tech Week se celebró en Caracas del 11 al 13 de mayo de 2026. — [Ecosistema Startup](https://ecosistemastartup.com/cripto-en-venezuela-tarjetas-licencias-y-us44-600m/); [CriptoNoticias](https://www.criptonoticias.com/comunidad/qash-conexion-empresas-venezolanas-banca-estadounidense/)
- Un usuario venezolano en un foro de un constructor de embudos afirma que no puede usar Stripe ni otro procesador sin una LLC (solo extracto). — [Funnelish Community](https://community.funnelish.com/t/using-paypal-as-the-only-payment-option/3702)
- Venezuela movió USD 44.600 millones en criptoactivos entre julio de 2024 y junio de 2025 según Chainalysis. — [Ecosistema Startup](https://ecosistemastartup.com/cripto-en-venezuela-tarjetas-licencias-y-us44-600m/)

**Inferencias de quien investigó**

- Para un SaaS de nicho local, el camino habitual es operar con entidad venezolana y cobrar por los rieles que el cliente ya usa; la estructura con entidad estadounidense responde a la necesidad de inversión, no a la de cobrar.
- La apertura de 2026 puede ampliar opciones de cobro internacional en los próximos meses; conviene diseñar el cobro como módulo intercambiable.

**Vacíos**

- Testimonios de SaaS B2B pequeños venezolanos sobre estructura y cobros (Reddit, X, Indie Hackers, YouTube): no consultados por agotamiento de búsquedas.
- Estructura societaria de Ridery, Cashea, Kontigo y Wynwood House: sin fuente.

### Dónde hace falta asesoría profesional y por qué

**Conclusión**

Tres decisiones no deberían tomarse sin un contador público y un abogado venezolanos: el régimen de facturación tras agosto de 2026, la elección de vehículo y cualquier estructura con entidad extranjera.

**Hallazgos con fuente**

- El SENIAT no ha detallado el nuevo marco de facturación tras derogar la homologación de sistemas, y se espera más regulación. — [Finanzas Digital](https://finanzasdigital.com/seniat-deroga-norma-sobre-proveedores-de-sistemas-fiscales/); [Forvis Mazars FMI 07-2026](https://www.forvismazars.com/ve/es/insights/forvis-mazars-insights/fmi-0726-derogatoria-de-sistemas-homologados)
- La aplicación del IGTF tiene zonas de interpretación reconocidas por tributaristas, y el Ejecutivo puede modificar la alícuota en cualquier momento. — [Venamcham](https://www.venamcham.org/wp-content/uploads/2022/06/LAW-BY-EXPERTS-13-Reforma-IGTF.pdf); [Acceso a la Justicia](https://accesoalajusticia.org/fijada-en-cero-por-ciento-0-la-alicuota-del-impuesto-a-las-grandes-transacciones-financieras-igtf/)
- Las multas tributarias se indexan a la moneda de mayor valor del BCV, lo que encarece cualquier incumplimiento formal. — [Baker McKenzie 2026](https://www.bakermckenzie.com/-/media/files/insight/guides/2026/doing-business-venezuela-2026.pdf)
- El régimen de transparencia fiscal internacional puede atribuir al residente la renta de su entidad extranjera. — [Baker McKenzie 2026](https://www.bakermckenzie.com/-/media/files/insight/guides/2026/doing-business-venezuela-2026.pdf)
- Las licencias OFAC son revocables en cualquier momento y cambian con frecuencia (enmiendas el 28-sep-2026). — [Cleary Gottlieb](https://www.clearygottlieb.com/-/media/files/alert-memos-2026/ofac-issues-general-licenses-authorizing-activity-in-venezuelan-telecommunications-sector.pdf); [OFAC](https://ofac.treasury.gov/sanctions-programs-and-country-information/venezuela-related-sanctions)

**Inferencias de quien investigó**

- Preguntas concretas para el contador: si el SaaS debe usar imprenta digital hoy; cómo facturar en divisas y registrar cobros en USDT; si la exoneración de la ley de emprendimiento está operativa; alícuota municipal aplicable.
- Preguntas para el abogado: RNE frente a C.A. con segundo socio; redacción de términos y política de privacidad conforme a la sentencia 1318; exposición de la plataforma por rifas de terceros.

**Vacíos**

- Honorarios de mercado de contadores y abogados para estos servicios: sin datos.

## 10. Políticas de plataformas y salida al mercado

Qué permiten Meta, WhatsApp, TikTok, Google y las tiendas de apps, y qué referencias hay para precio y captación.

### Meta (Instagram y Facebook): rifas, loterías, sorteos y "online gambling and games"

**Conclusión**

Meta trata la rifa pagada como "online gambling and games": en anuncios exige autorización previa con prueba de licencia o legalidad en el país objetivo, y en contenido orgánico no la prohíbe pero la restringe a mayores de 18. No hallé evidencia documentada de cierres masivos de cuentas de riferos venezolanos por parte de Meta; el riesgo demostrado en 2026 es estatal (Conalot, SEBIN), no de la plataforma.

**Hallazgos con fuente**

**Texto de política (anuncios), observado 13-oct-2026; registro de cambios con entradas del 18-may-2026, 2-mar-2026 y 6-feb-2026:**
- Definición: "Meta defines online gambling and games as any product or service where anything of monetary value is included as part of a method of entry and prize." — [Meta Ad Standards](https://transparency.meta.com/policies/ad-standards/restricted-goods-services/gambling-games/)
- "Ads that promote online gambling and gaming are only allowed once an ad account has obtained authorization." La autorización se pide en la pestaña "Authorizations and Verifications" de Meta Business Suite y exige "evidence that the gambling activities are appropriately licensed by a regulator or otherwise established as lawful in the territory they want to target". — [Meta Ad Standards](https://transparency.meta.com/policies/ad-standards/restricted-goods-services/gambling-games/)
- Las rifas están nombradas: requiere autorización "All forms of online gambling. Some common types of gambling include betting, lotteries, raffles, casino games, fantasy sports, bingo, poker, skill game tournaments and sweepstakes." — [Meta Ad Standards](https://transparency.meta.com/policies/ad-standards/restricted-goods-services/gambling-games/)
- También requiere autorización: "Ads with destination (landing) pages that contain promotions for online gambling or games, even if there is no opportunity to gamble or game directly on that page, such as aggregator or affiliate sites." — [Meta Ad Standards](https://transparency.meta.com/policies/ad-standards/restricted-goods-services/gambling-games/)
- No hay lista de países "elegibles"; hay lista de 19 mercados no admitidos (Azerbaiyán, Bangladés, Camboya, Egipto, Hong Kong, India, Indonesia, Corea, Kirguistán, Malasia, Mongolia, Myanmar, Pakistán, Filipinas, Arabia Saudita, Singapur, Taiwán, Tailandia, Vietnam). Venezuela no figura en esa lista. — [Meta Ad Standards](https://transparency.meta.com/policies/ad-standards/restricted-goods-services/gambling-games/)
- Sin autorización se puede anunciar: juego físico ("brick and mortar"), loterías estatales cuando el anunciante es el responsable directo o exclusivo, "Prize promotions that involve purchasing a product at the usual retail price, as long as online gambling isn't the primary business model of the advertiser or any featured brand", y juegos totalmente gratuitos. — [Meta Ad Standards](https://transparency.meta.com/policies/ad-standards/restricted-goods-services/gambling-games/); mismo texto en [Meta Business Help Center](https://www.facebook.com/business/help/345214789920228)
- Mínimo: no dirigir a menores de 18. "Meta is not responsible for how authorized ad accounts comply with local gambling laws and regulations." — [Meta Ad Standards](https://transparency.meta.com/policies/ad-standards/restricted-goods-services/gambling-games/)

**Texto de política (contenido orgánico), observado 13-oct-2026; última entrada del registro de cambios 9-sep-2026:**
- "For the following content, we restrict visibility to adults 18 years of age and older: Online Gambling and Games. Content that attempts to sell, trade, depict or promote online gaming and gambling services where anything of monetary value (...) is required to play and anything of monetary value forms part of the prize. This includes but is not limited to: Games of skill, lotteries/raffles, betting, sports betting, casino games, games of chance, or sweepstakes/prize draws." — [Meta Community Standards, Restricted Goods and Services](https://transparency.meta.com/policies/community-standards/restricted-goods-services/)
- La justificación de la norma prohíbe "attempts by individuals, manufacturers, and retailers to purchase, sell, raffle, gift, transfer or trade certain goods and services": rifar bienes restringidos (armas, alcohol, tabaco, fármacos) sí es infracción. — [Meta Community Standards](https://transparency.meta.com/policies/community-standards/restricted-goods-services/)

**Texto de política (Instagram Promotion Guidelines), observado 13-oct-2026:**
- "If you use Instagram to communicate or administer a promotion (example: a contest or sweepstakes, among others), you are responsible for the lawful operation of that promotion, including: The official rules; Offer terms and eligibility requirements (...); and Compliance with applicable rules and regulations governing the promotion and all prizes offered (example: registration and obtaining necessary regulatory approvals, among others)". — [Instagram Help](https://help.instagram.com/179379842258600)
- Debe incluir "A complete release of Instagram by each entrant or participant" y "Acknowledgement that the promotion is in no way sponsored, endorsed or administered by, or associated with, Instagram." — [Instagram Help](https://help.instagram.com/179379842258600)
- La página ya tiene una cláusula específica para Brasil que remite a la Secretaria de Prêmios e Apostas; no hay cláusula para Venezuela. — [Instagram Help](https://help.instagram.com/179379842258600)

**Aplicación reportada (Venezuela, 2025-2026):**
- La Unidad de Observatorio de Conalot "realiza verificaciones constantes en redes sociales"; Conalot anunció el 29-ene-2026 una fiscalización nacional de operadores de rifas físicos y digitales, y exige a las plataformas digitales "sistemas de trazabilidad total". — [El Diario, 30-ene-2026](https://eldiario.com/2026/01/30/conalot-inicio-auditoria-nacional-sistemas-de-rifas/)
- En marzo de 2026 el SEBIN ejecutó procedimientos contra riferos en Zulia, Táchira, Portuguesa, Anzoátegui y Distrito Capital; los sorteos se anunciaban por Instagram y TikTok y se cobraban por pago móvil o divisas. — [Noticias Barquisimeto, 23-mar-2026](https://www.noticiasbarquisimeto.com/rifas-en-la-mira-venezuela-lanza-fuerte-ofensiva-contra-los-riferos-ilegales/)
- De 35 perfiles de "riferos digitales" monitoreados, al menos la mitad seguía rifando en abril de 2026; el resto paró desde mediados de marzo. Cifra extraoficial de hasta 180 detenidos (no confirmada). Las cuentas de los riferos más grandes superaban 1 millón de seguidores; las activas hoy suelen tener menos de 100.000. El artículo no reporta cierres de cuentas por Meta. — [La Gran Aldea, 18-abr-2026](https://lagranaldea.com/2026/04/18/en-medio-de-la-tormenta-el-negocio-de-las-rifas-digitales-sigue-viento-en-popa/)
- Diosdado Cabello (25-mar-2026) calificó las rifas de "lavadora de dinero". — [La Gran Aldea](https://lagranaldea.com/2026/04/18/en-medio-de-la-tormenta-el-negocio-de-las-rifas-digitales-sigue-viento-en-popa/)
- Reglas Conalot (Providencia CONALOT/P/2025-001, reafirmadas el 19-mar-2026): RUNLOT obligatorio y visible en toda la publicidad, 7 % de los ingresos a Conalot, máximo cuatro rifas ocasionales al año, solvencia por cada rifa que pruebe que el premio existe, prohibidos premios de cirugías estéticas y venta a menores, ventas en "plataformas autorizadas". — [La Nación, 20-mar-2026](https://lanacionweb.com/nacional/rifas-en-redes-sociales-en-venezuela-conalot-advierte-sobre-requisitos-legales-para-evitar-estafas/)
- Meta sí inhabilita cuentas venezolanas por otras vías: a mediados de 2026 varios medios (p. ej. El Nacional) perdieron Instagram tras denuncias de derechos de autor presuntamente fraudulentas. — [La Verdad de Vargas](https://laverdaddevargas.com/meta-golpea-a-la-prensa-venezolana-con-inhabilitaciones-de-cuentas)

**Aplicación reportada (referencia Brasil, no Venezuela):**
- Un acuerdo entre la Secretaria de Prêmios e Apostas y Meta llevó a revisar unos 5.000 perfiles de influencers que promovían apuestas sin licencia, con suspensión, exclusión o bloqueo según el caso; la herramienta de IA usada "comete muchos errores" (artículo sin fecha). — [SiGMA](https://sigma.world/pt-br/news/governo-e-meta-derrubam-perfis-no-instagram/)

**Inferencias de quien investigó**

- Un organizador sin RUNLOT no puede acreditar que su rifa está "licensed (...) or otherwise established as lawful", por lo que en la práctica no obtendrá autorización para pautar rifas en Meta. Pautar sin autorización expone la cuenta publicitaria.
- Nuestros propios anuncios (software para organizadores) no venden entradas, pero si la página de destino muestra o enlaza rifas activas de clientes puede caer en la cláusula de "landing pages that contain promotions for online gambling". Conviene una landing B2B limpia, sin rifas en vivo ni premios.
- El contenido orgánico de rifas está permitido con restricción de edad; el alcance a menores y a no logueados se pierde, lo que puede sentirse como "shadow ban" sin serlo formalmente.
- El precedente brasileño indica que Meta actúa por país cuando un regulador la presiona. Con Conalot vigilando redes, una colaboración Conalot-Meta es un riesgo plausible, no un hecho reportado.
- El enlace "powered by" hacia nuestro dominio desde miles de páginas de rifas puede asociar el dominio a gambling ante los sistemas de Meta; separar dominio de marketing y dominio de páginas públicas reduce ese riesgo.

**Vacíos**

- No encontré casos documentados (prensa, foros, Reddit) de cuentas de rifas venezolanas inhabilitadas, con restricción de enlaces o shadow ban por Meta entre 2023 y 2026. Ausencia de evidencia, no evidencia de ausencia.
- No pude leer la página de solicitud de autorización (help/4740325989340856) para saber qué documentos acepta Meta ni si procesa solicitudes de Venezuela.
- No verifiqué si Meta acepta hoy cuentas publicitarias con ubicación comercial en Venezuela (ver sección 13).

### WhatsApp y WhatsApp Business

**Conclusión**

WhatsApp es el punto más duro: la política de mensajería comercial (actualizada el 23-sep-2026) prohíbe usar WhatsApp for Business para "Real Money Gambling and Gaming", define rifas como gambling, y solo permite excepciones vía API en Australia, Japón, Colombia, México y Perú. Venezuela no está, y en la app WhatsApp Business el tema está vetado en todos los países.

**Hallazgos con fuente**

**Texto de política, "Last updated: September 23, 2026", observado 13-oct-2026:**
- Sección 4: "We prohibit use of WhatsApp for Business for buying, selling, promoting, or otherwise facilitating the exchange of certain regulated or restricted goods and services listed below, as determined in our sole discretion", lista que incluye "Real Money Gambling and Gaming (Online Gambling and Gaming is a subset of Real Money Gambling and Gaming. See Section 5 and Section 6 for limited exceptions.)". — [WhatsApp Business Messaging Policy](https://whatsappbusiness.com/policy/)
- "These prohibitions apply irrespective of the global or local licenses, registrations, or other approvals your business may hold." — [WhatsApp Business Messaging Policy](https://whatsappbusiness.com/policy/)
- Sección 5: "You are prohibited from messaging about any Regulated Verticals on the WhatsApp Business App." y "You are prohibited from providing any commerce experiences to buy or sell goods or services that are Regulated Verticals". — [WhatsApp Business Messaging Policy](https://whatsappbusiness.com/policy/)
- "Online Gambling and Gaming – Allowed Countries": Australia, Japan, Colombia, Mexico, Peru. Venezuela aparece en las listas de otras verticales (p. ej. medicamentos sin receta) pero no en la de gambling. — [WhatsApp Business Messaging Policy](https://whatsappbusiness.com/policy/)
- Sección 6: "We define online gambling and gaming as any product or service where anything of monetary value is included as part of entry or prize." Incluye "betting, lotteries, raffles, casino games, fantasy sports, bingo, poker, skill game tournaments, and sweepstakes" y "Promotions for online gambling or games, even if there is no opportunity to gamble or game directly within the WhatsApp chat." — [WhatsApp Business Messaging Policy](https://whatsappbusiness.com/policy/)
- Para los países permitidos hay que pedir permiso a Meta y aportar "evidence that the online gambling and gaming activities are appropriately licensed by a regulator, or otherwise established as lawful". — [WhatsApp Business Messaging Policy](https://whatsappbusiness.com/policy/)
- No requieren permiso (pero sí cumplir ley local): juego físico, loterías estatales, "Prize promotions that involve purchasing a product at the usual retail price, so long as online gambling isn't the primary business model", y juegos gratuitos. — [WhatsApp Business Messaging Policy](https://whatsappbusiness.com/policy/)
- Plantillas y opt-in: solo se puede iniciar conversación con una plantilla aprobada y con opt-in del usuario; fuera de la ventana de 24 horas solo plantillas. — [WhatsApp Business Messaging Policy](https://whatsappbusiness.com/policy/)
- Sección 7: "We may limit or remove your access to or use of WhatsApp for Business, or limit your ability to send messages, if you receive significant amounts of negative feedback (...) violate or encourage others to violate our terms or policies". "Users can block or report businesses." — [WhatsApp Business Messaging Policy](https://whatsappbusiness.com/policy/)
- Canales: "Channels should not be used to (...) offer and/or transact in regulated or restricted goods"; "Do not engage in fraud"; la detección usa "automated tools, human review, and user reports". — [WhatsApp Channels Guidelines](https://www.whatsapp.com/legal/channels-guidelines)

**Aplicación reportada:**
- La apertura de la API a verticales reguladas data del 27-ago-2024 para negocios con licencia en partes de India, APAC y LATAM; se permite marketing pero no mensajes de compra, venta o pago de esos bienes. — [ChatArchitect](https://chatarchitect.com/news/new-business-verticals-from-whatsapp-what-you-need-to-know)
- Causas generales de baneo: spam, mensajes no solicitados, apps no oficiales, suplantación; muchas denuncias o bloqueos disparan revisión. No es un caso de rifas. — [Wati](https://www.wati.io/es/blog/unblock-whatsapp-account/)

**Inferencias de quien investigó**

- Un organizador de rifas venezolano no puede usar legítimamente ni la app WhatsApp Business ni la API para vender o promover rifas. Lo hacen igual desde cuentas personales o Business, bajo riesgo permanente de baneo por denuncias.
- Nosotros, como empresa de software, sí podemos usar la API para soporte y onboarding de nuestros clientes (mensajes sobre nuestro SaaS), siempre que las plantillas no promuevan rifas concretas. Es una lectura propia: la norma veta "promoting, or otherwise facilitating" gambling, y Meta decide "in our sole discretion".
- No debemos ofrecer como función el envío de mensajes de rifa por la API en nombre del organizador (recordatorios de pago, anuncio de ganadores): eso sí es mensajería de una vertical regulada hacia un país no permitido.
- La excepción de "prize promotions" con compra a precio habitual cubre sorteos promocionales de comercios, no la rifa cuyo producto es el boleto.
- Diseño defensivo: enlaces `wa.me` que abren el chat con el organizador (iniciado por el comprador) en vez de envíos salientes automatizados.

**Vacíos**

- No hallé reportes específicos de números baneados por vender rifas en Venezuela ni datos de frecuencia de baneo.
- No pude leer las páginas de enforcement de la plataforma (la URL de 360dialog devolvió 404) ni las reglas de grupos y comunidades; las Channels Guidelines no nombran gambling de forma expresa, solo "regulated or restricted goods".

### TikTok

**Conclusión**

TikTok es más restrictivo que Instagram en orgánico: sus Community Guidelines (vigentes desde el 24-sep-2026) no permiten "trading, marketing, or providing access to" gambling, hacen inelegible para el feed Para Ti y restringen por edad lo que lo muestre, y vetan participar en gambling en LIVE en todas las regiones. En anuncios y contenido de marca, Venezuela no aparece en ninguna lista de mercados habilitados.

**Hallazgos con fuente**

**Texto de política (Community Guidelines, "Released August 25, 2026 / Effective September 24, 2026"), observado 13-oct-2026:**
- NOT ALLOWED: "Trading, marketing, or providing access to regulated goods and services including (...) Gambling, gambling-like activities, or mystery value products"; "In some regions, showing or promoting gambling or gambling-like activities"; "Showing or promoting young people participating in gambling". — [TikTok Community Guidelines](https://www.tiktok.com/community-guidelines/en/regulated-commercial-activities)
- FYF INELIGIBLE & AGE-RESTRICTED: "Showing or promoting gambling and gambling-like activities". — [TikTok Community Guidelines](https://www.tiktok.com/community-guidelines/en/regulated-commercial-activities)
- NOT ALLOWED (LIVE sessions), "In all regions": "Participating in gambling or gambling-like activities". — [TikTok Community Guidelines](https://www.tiktok.com/community-guidelines/en/regulated-commercial-activities)
- ALLOWED: "In some regions, content from verified business accounts or TikTok Shop Sellers that meet our eligibility standards that sell, market, or provide access to: (...) Gambling, gambling-like activities, or mystery value products". — [TikTok Community Guidelines](https://www.tiktok.com/community-guidelines/en/regulated-commercial-activities)
- Definición: "Gambling: Betting money or something of value on uncertain outcomes for financial gain." — [TikTok Community Guidelines](https://www.tiktok.com/community-guidelines/en/regulated-commercial-activities)

**Texto de política (anuncios, "Last updated: October 2026"):**
- "Gambling ads are only allowed in specified markets where gambling is legal and when all local certifications and requirements are met." "To advertise gambling services, you must go through our certification process." — [TikTok Ads, Gambling and Games](https://ads.tiktok.com/help/article/tiktok-ads-policy-gambling-and-games?lang=en)
- Clasifica "Lotteries: Games of chance that require payment to enter, where winnings are based entirely on chance" como gambling-like, y los distingue de "Sweepstakes or giveaways: Promotional events where participants can win prizes by chance, typically with no purchase required. These are product-focused promotions, not ongoing games of chance". — [TikTok Ads, Gambling and Games](https://ads.tiktok.com/help/article/tiktok-ads-policy-gambling-and-games?lang=en)

**Texto de política (Branded Content Policy, "Effective date: 31 August 2026"):**
- "Gambling, lotteries and real money games": restringido a mayores de 18 y al mercado de origen en Argentina, Australia, Brasil, Canadá, Colombia, Francia, Alemania, Israel, Japón, México, Filipinas, Arabia Saudita, Singapur, España, Taiwán, Turquía, EAU, Reino Unido, EE. UU. y Vietnam; "not allowed" en una lista que incluye Bolivia, Chile, Costa Rica, República Dominicana, Ecuador, Guatemala, Panamá, Paraguay, Perú y Uruguay. Venezuela no aparece en ninguna de las dos listas. — [TikTok Branded Content Policy](https://www.tiktok.com/legal/page/global/bc-policy/en)

**Aplicación reportada (no Venezuela):**
- TikTok Shop publicó el 27-may-2026 una política que veta loterías y rifas, entradas a sweepstakes y "lucky spins"; los giveaways deben ser gratuitos y usar la función oficial. Aplica a TikTok Shop en EE. UU. — [PPC Land, 8-jun-2026](https://ppc.land/tiktok-shops-gambling-policy-bans-raffles-and-lucky-spins-sellers-beware/)
- Reino Unido: la Gambling Commission registró en 2025 más reportes de rifas ilegales en TikTok que en 2024; los anfitriones evitan la palabra "raffle" ("competition", "giveaway", "waffles", "razzles") y cobran fuera de la plataforma; no publica cifras de cuentas removidas. Encuesta a 4.233 personas (13-17 mar-2026): participó en rifas el 5 % en Facebook, 3 % en TikTok y 3 % en Instagram. — [UK Gambling Commission, 13-ago-2026](https://www.gamblingcommission.gov.uk/print/exploring-online-illegal-individual-led-lotteries-and-raffles)
- En Venezuela los sorteos se anunciaban "por Instagram o TikTok" hasta la ofensiva de marzo de 2026. — [Noticias Barquisimeto](https://www.noticiasbarquisimeto.com/rifas-en-la-mira-venezuela-lanza-fuerte-ofensiva-contra-los-riferos-ilegales/)

**Inferencias de quien investigó**

- En TikTok el riesgo para organizadores es doble: pérdida de alcance (fuera del FYF) y remoción por "marketing or providing access". El sorteo en vivo por TikTok LIVE es el formato más expuesto.
- No hay vía de certificación publicitaria para rifas en Venezuela: no pautar rifas ni contratar contenido de marca de rifas en TikTok.
- Nuestro marketing en TikTok debe ser B2B (cómo organizar, control de pagos, transparencia) sin mostrar compra de boletos ni premios como gancho.
- El vocabulario evasivo que documenta el regulador británico probablemente exista también en español; indica que la moderación es por palabras clave y denuncias, es decir, irregular.

**Vacíos**

- No pude leer la sección "Market-specific requirements" de anuncios (requiere sesión): no confirmo qué países de LATAM tienen gambling ads habilitados.
- No hallé reportes de enforcement de TikTok contra rifas en mercados hispanohablantes.
- No confirmé si TikTok Ads Manager admite anunciantes registrados en Venezuela.

### Google: Ads, Play y Search

**Conclusión**

Google Ads solo permite gambling en los países listados y Venezuela no está, así que nadie puede pautar rifas pagadas hacia Venezuela. En Google Play una app que permita participar con dinero por un premio está prohibida salvo operadores licenciados en países seleccionados.

**Hallazgos con fuente**

**Texto de política (Google Ads), observado 13-oct-2026:**
- Gambling es lo definido por ley local y también "Staking something of value on the outcome of events or processes determined by an element of chance with the opportunity to win something of value". — [Google Ads Gambling and games](https://support.google.com/adspolicy/answer/6018017?hl=en)
- "We only allow advertising of online gambling and online gambling-promoting content in the countries listed below and where the country-specific certification criteria are met." "Online gambling of any type not listed under 'Online gambling' for a particular country is not eligible for certification and may not be advertised." — [Google Ads Gambling and games](https://support.google.com/adspolicy/answer/6018017?hl=en)
- La lista por país incluye de LATAM a Argentina, Brasil, Colombia, México, Panamá y Perú. Venezuela no figura. — [Google Ads Gambling and games](https://support.google.com/adspolicy/answer/6018017?hl=en)
- "Note: Prize promotions run by retailers and service providers (other than social casino games advertisers) to promote their goods and services are out of scope of this policy." — [Google Ads Gambling and games](https://support.google.com/adspolicy/answer/6018017?hl=en)
- Contenido que promueve gambling: solo se admiten "Aggregator or affiliate sites that provide information about, or a comparison of, other gambling services", que "must not offer gambling services themselves or link to gambling services they own". — [Google Ads Gambling and games](https://support.google.com/adspolicy/answer/6018017?hl=en)

**Texto de política (Google Play), observado 13-oct-2026:**
- Para apps que no sean de operadores licenciados: "we don't allow content or services that enable or facilitate users' ability to wager, stake, or participate using real money (...) to obtain a prize of real world monetary value. This includes but is not limited to, online casinos, sports betting, lotteries, and games that accept money and offer prizes of cash or other real world value". — [Google Play, Real-Money Gambling, Games, and Contests](https://support.google.com/googleplay/android-developer/answer/9877032?hl=en)
- Ejemplos de infracción: "Games that accept money in exchange for an opportunity to win a physical or monetary prize"; "Apps that have navigational elements or features (for example, menu items, tabs, buttons, webviews, etc.) that provide a 'call to action' to wager, stake, or participate in real-money games, contests or tournaments"; "Apps that accept or manage wagers, in-app currencies, winnings, or deposits in order to gamble for, or obtain a physical or monetary prize." — [Google Play](https://support.google.com/googleplay/android-developer/answer/9877032?hl=en)
- Las apps de gambling permitidas exigen que el desarrollador sea operador gubernamental o licenciado, con licencia válida por país, gratuitas, sin Google Play Billing y con clasificación solo adultos. — [Google Play](https://support.google.com/googleplay/android-developer/answer/9877032?hl=en)
- Una app con anuncios de gambling no puede ofrecer "gambling or real money game, lottery, or tournament support or companion functionality (for example, functionality that assists with wagering, payouts (...) or management of participation funds)". — [Google Play](https://support.google.com/googleplay/android-developer/answer/9877032?hl=en)

**Precedentes observados:**
- Rifatuber (México) distribuye su app de seguimiento como APK descargable desde su web ("Descargar APK", "100+ Descargas"), no desde Play. — [Rifatuber](https://rifatuber.com/)
- Rifei (Brasil) anuncia "Baixe o app" y aclara que "Os valores no aplicativo para iOS podem variar", es decir, tiene app en iOS para administradores de campañas. — [Rifei, precios](https://rifei.com.br/precos)

**Inferencias de quien investigó**

- Una app Android (o un wrapper TWA de la PWA) donde el comprador elige números y reporta un pago encaja en "accept money in exchange for an opportunity to win a physical or monetary prize" y arriesga rechazo o suspensión de la cuenta de desarrollador. La mención expresa de "webviews" cierra la vía del envoltorio.
- Una app solo para el organizador (panel: ver ventas, aprobar comprobantes, sin compra de boletos dentro) es más defendible, pero "management of participation funds" muestra que Google también mira las apps de soporte. Riesgo medio, no nulo.
- Recomendación operativa: mantener el producto como web y PWA instalable desde el navegador, sin tiendas, al menos el primer año.
- Para Google Ads, anunciar el software a organizadores no es anunciar gambling en sentido estricto, pero una landing con rifas pagadas activas puede ser tratada como "gambling-promoting content", no permitido en Venezuela.

**Vacíos**

- La lista de países elegibles para apps de gambling en Play no aparece en la página pública consultada.
- No investigué el trato en Search (SafeSearch, advertencias, desindexación): sin fuentes.
- No verifiqué en las tiendas si la app de Rifei está en Google Play ni en qué categoría.

### Apple App Store (guideline 5.3)

**Conclusión**

Apple exige licencia y geo-restricción para loterías y juego con dinero real, y que las reglas de sorteos y rifas aparezcan en la app. Una app de compra de boletos sin licencia venezolana no pasaría la revisión; un envoltorio web tampoco por la guideline 4.2.

**Hallazgos con fuente**

**Texto de política, observado 13-oct-2026:**
- "5.3.1 Sweepstakes and contests must be sponsored by the developer of the app." — [App Store Review Guidelines](https://developer.apple.com/app-store/review/guidelines/)
- "5.3.2 Official rules for sweepstakes, contests, and raffles must be presented in the app and make clear that Apple is not a sponsor or involved in the activity in any manner." — [App Store Review Guidelines](https://developer.apple.com/app-store/review/guidelines/)
- "5.3.3 Apps may not use in-app purchase to purchase credit or currency for use in conjunction with real money gaming of any kind." — [App Store Review Guidelines](https://developer.apple.com/app-store/review/guidelines/)
- "5.3.4 Apps that offer real money gaming (e.g. sports betting, poker, casino games, horse racing) or lotteries must have necessary licensing and permissions in the locations where the app is used, must be geo-restricted to those locations, and must be free on the App Store. (...) Lottery apps must have consideration, chance, and a prize." — [App Store Review Guidelines](https://developer.apple.com/app-store/review/guidelines/)
- "4.2 Minimum Functionality: Your app should include features, content, and UI that elevate it beyond a repackaged website." — [App Store Review Guidelines](https://developer.apple.com/app-store/review/guidelines/)

**Inferencias de quien investigó**

- 5.3.1 choca con el modelo multi-organizador: en nuestra app el sorteo lo patrocina el organizador, no el desarrollador.
- El caso Rifei sugiere que una app de gestión para el organizador, que cobra la tarifa de plataforma y no vende boletos, puede ser aprobada; es un precedente brasileño y no garantiza el resultado.

**Vacíos**

- La página no muestra fecha de última actualización de las guidelines.
- No encontré rechazos documentados de apps de rifas en español.

### YouTube, Kick, Telegram y X (sorteos en vivo y promoción)

**Conclusión**

YouTube y Kick castigan dirigir a la audiencia a sitios de juego no certificados o cobrar "buy-ins"; X solo admite publicidad de gambling en países listados (Venezuela no está); Telegram es el más permisivo en sus términos. Transmitir el sorteo (el acto de elegir ganador) es menos riesgoso que vender boletos en la misma transmisión.

**Hallazgos con fuente**

**Texto de política:**
- YouTube: "Don't post content on YouTube if it aims to directly sell, link to, or facilitate access to any of the regulated goods and services listed below", lista que incluye "Uncertified online gambling sites". Ejemplo vetado: "Facilitating access to an online gambling or sports betting site that is not certified." "these policies also apply to external links in your content (...) clickable URLs, verbally directing users to other sites in video". — [YouTube Help](https://support.google.com/youtube/answer/9229611?hl=en)
- Kick, Guideline 11: "Creators must follow the gambling laws in their jurisdiction. Gambling involving funds provided by other users, such as requiring 'buy-ins' to participate in giveaways, is strictly prohibited." "Sponsored gambling is permitted only for platforms holding valid licenses in the relevant jurisdiction." — [Kick Community Guidelines](https://kick.com/community-guidelines)
- Telegram: prohíbe "send spam or scam users" y "Engage in activities that are recognized as illegal in the majority of countries"; sobre giveaways: "If you run a giveaway, you are solely responsible for complying with" las normas locales. No menciona gambling. — [Telegram ToS](https://telegram.org/tos)
- X (anuncios y monetización; leído en copia archivada del 22-sep-2026): "X prohibits the promotion of gambling content, except for campaigns targeting specified countries where it is allowed with restrictions". El alcance incluye "Lotteries" y "Gambling-related software, such as gambling software and poker odds calculators". LATAM listado: Argentina, Chile, Colombia, República Dominicana, Ecuador, Honduras, México, Panamá, Perú, Uruguay. Venezuela no figura. — [X Ads Policies, Gambling content](https://business.x.com/en/help/ads-policies/ads-content-policies/gambling-content.html)

**Aplicación reportada:**
- YouTube endureció la norma desde el 19-mar-2025: veta dirigir a sitios no aprobados mediante enlaces, logos, texto, imágenes o mención verbal, y restringe por edad el contenido de casinos en línea. — [CNN vía ABC7, mar-2025](https://abc7news.com/amp/post/youtube-cracks-down-gambling-videos-trying-lure-viewers-unapproved-sites/15976808/)

**Inferencias de quien investigó**

- Un directo de YouTube que diga "compra tu boleto en [nuestra URL]" puede leerse como facilitar acceso a un sitio de juego no certificado. El directo del sorteo sin llamada a compra es más seguro.
- En Kick, una rifa pagada es literalmente un giveaway con "buy-in": prohibida.
- X es el único que nombra el software de gambling dentro del alcance; refuerza que la distinción herramienta/operador no es un salvoconducto en publicidad.
- Telegram sirve como canal de respaldo para comunidades de organizadores y para publicar resultados; su riesgo es reputacional (estafas), no de política.

**Vacíos**

- La política de X se leyó en copia archivada porque el sitio bloqueó la lectura directa; verificar la versión vigente.
- No hallé enforcement de estas plataformas contra sorteos venezolanos en vivo.

### Reglas del lado de pagos: Binance, Zelle, PayPal (y Stripe como referencia)

**Conclusión**

PayPal y Stripe tratan rifas como gambling que requiere aprobación previa o está prohibido. Zelle es frágil para venezolanos por decisiones de los bancos, con independencia de las rifas. Para Binance no encontré una regla ni casos sobre rifas.

**Hallazgos con fuente**

**Texto de política:**
- PayPal ("Last updated on October 29, 2022"): requiere pre-aprobación para "Gambling, Gaming, Prize Draws and Contests: Activities involving gambling, gaming and/or any other activity with an entry fee and a prize, including, but not limited to (...) lottery tickets, other ventures that facilitate gambling, games of skill (...) and sweepstakes, if the operator and customers are located exclusively in jurisdictions where such activities are permitted by law." También prohíbe transacciones "by payment processors to collect payments on behalf of merchants". — [PayPal Acceptable Use Policy](https://www.paypal.com/us/legalhub/paypal/acceptableuse-full)
- Stripe, negocios restringidos: "Games of chance including gambling, internet gambling, casino games, sweepstakes and contests (...) with a monetary or material prize", "Payments of an entry or player fee that promise the entrant or player will win a prize of value", "Lotteries". Excepción: "Charity sweepstakes and raffles for the explicit purpose of fundraising (Note: Supported in Australia, Brazil, Canada, Hong Kong, Ireland, Mexico, the United Kingdom, and the United States. Prohibited in all other countries.)". — [Stripe Restricted Businesses](https://stripe.com/legal/restricted-businesses)
- Stripe FAQ: la política de gambling cubre "sweepstakes, pay-in auctions, office pools, or charity raffles" y que sea legal localmente no cambia el resultado. — [Stripe Support](https://support.stripe.com/questions/prohibited-and-restricted-businesses-list-faqs)

**Aplicación reportada:**
- PayPal limitó la cuenta de una vendedora británica al determinar que vendía boletos de lotería o rifa. Caso único. — [UK Financial Ombudsman, DRN-2956805](https://www.financial-ombudsman.org.uk/decision/DRN-2956805.pdf)
- Citibank y Wells Fargo cerraron sin aviso cuentas de clientes venezolanos que usaban Zelle; los bancos no publicaron criterios. — [El Nacional](https://www.elnacional.com/economia/wells-fargo-citibank-y-otros-bancos-cierran-cuentas-a-venezolanos-por-uso-de-zelle/)
- Wells Fargo retiró Zelle a clientes en Venezuela en junio de 2020 por "uso inconsistente". — [Voz de América](https://www.vozdeamerica.com/a/venezuela_wells-fargo-suspende-zelle-en-venezuela/6063847.html)
- Binance sí retira métodos de pago en Venezuela: eliminó al Banco de Venezuela de su P2P en agosto de 2023. — [El Diario, 28-ago-2023](https://eldiario.com/2023/08/28/binance-elimino-banco-de-venezuela-como-metodo-p2p/)
- La fintech Kontigo perdió acceso a socios como JPMorgan, Stripe y Bridge, y su licencia cripto venezolana expiró en enero de 2026. — [SaaSholic, 15-jun-2026](https://blog.saasholic.com/p/venezuela-is-not-back-its-being-rebuilt)
- Volumen cripto de Venezuela: USD 44.600 millones (Chainalysis, jul-2024 a jun-2025); stablecoins y Binance Pay son de uso cotidiano. — [SaaSholic](https://blog.saasholic.com/p/venezuela-is-not-back-its-being-rebuilt)

**Inferencias de quien investigó**

- Como no custodiamos el dinero de los boletos, nuestro riesgo de pagos se limita a cobrar nuestra suscripción. Facturar "software de gestión" reduce el riesgo, pero recibir muchos pagos pequeños por Zelle desde Venezuela en una cuenta personal es el patrón que los bancos han cerrado.
- El organizador que recibe cientos de Zelle por una rifa asume un riesgo real de cierre de cuenta. El producto debe advertir ese riesgo; no debe enseñar a disimular el concepto del pago.
- PayPal y Stripe no son vías viables para rifas venezolanas, ni para nosotros si se nos clasifica como "ventures that facilitate gambling".

**Vacíos**

- No pude leer los términos de Binance (la página no cargó) ni el acuerdo de usuario de Zelle (acceso denegado): no confirmo cláusulas sobre gambling.
- No hallé casos de cuentas Binance congeladas por rifas.
- No hay una licencia general de OFAC leída que confirme el trato a servicios de software hacia Venezuela; OFAC emitió las GL 46E, 48D y 49B el 28-sep-2026 sin levantar las sanciones por completo. — [Baker McKenzie Sanctions Blog](https://sanctionsnews.bakermckenzie.com/ofac-updates-venezuela-general-licenses-and-issues-new-venezuela-faqs/)

### Hosting, dominios e infraestructura

**Conclusión**

Cloudflare, AWS, DigitalOcean y Vercel no nombran el gambling en sus políticas: prohíben lo ilegal. Hetzner sí lo nombra. El riesgo de baja viene de que la actividad sea declarada ilegal o de una orden regulatoria, no de la categoría en sí.

**Hallazgos con fuente**

**Texto de política, observado 13-oct-2026:**
- Cloudflare: prohíbe "engage in any activities that are illegal"; el texto no menciona gambling. — [Cloudflare Terms](https://www.cloudflare.com/terms/)
- AWS: "You may not use (...) the Services (...) for any illegal or fraudulent activity". Sin mención a gambling. — [AWS Acceptable Use Policy](https://aws.amazon.com/aup/)
- DigitalOcean ("Last Updated on March 20, 2026"): prohíbe "Any use of the Services to engage in, further, promote, or encourage illegal conduct or activities". Sin mención a gambling. — [DigitalOcean AUP](https://www.digitalocean.com/legal/acceptable-use-policy)
- Vercel: prohíbe "Fraud, deceptive practices, or other scams" y "Sale, promotion or facilitation of illegal goods and services". Sin mención a gambling. — [Vercel AUP](https://vercel.com/legal/acceptable-use-policy)
- Hetzner: el cliente no puede publicar contenido que viole la ley, "in particular (...) pornographic or obscene material, extremist content (...), gambling". — [Hetzner Terms](https://www.hetzner.com/legal/terms-and-conditions/)

**Aplicación reportada:**
- Un usuario reporta que soporte de Cloudflare le confirmó que el gambling es aceptable si cumple la ley aplicable (testimonio informal). — [Cloudflare Community](https://community.cloudflare.com/t/using-the-services-for-online-gambling-according-to-terms-of-use/519346)
- El regulador neerlandés KSA ordenó a Cloudflare dejar de servir a sitios ilegales y luego sustituyó la orden por un acuerdo de cooperación. — [iGaming Business](https://igamingbusiness.com/legal-compliance/legal/cloudflare-to-assist-dutch-gambling-regulator-in-tackling-illegal-providers/)
- Bélgica (abril de 2026) obligó a Cloudflare y Google a impedir el acceso a sitios de juego ilegal, con multa de EUR 500.000 por incumplimiento. — [European Gaming, 5-may-2026](https://europeangaming.eu/portal/latest-news/2026/05/05/203490/belgium-made-google-and-cloudflare-responsible-for-illegal-gambling-europe-is-watching/)

**Inferencias de quien investigó**

- Evitar Hetzner. En los demás, el detonante realista es una denuncia de fraude contra una rifa alojada o un requerimiento de autoridad.
- Mitigaciones: proceso de denuncias y baja de rifas fraudulentas, términos que exijan al organizador cumplir la ley (RUNLOT), y respaldo portable para migrar de proveedor.
- Los competidores entregan dominio propio por cliente (Simple Rifa, Laooz); eso aísla el riesgo por organizador. Un dominio compartido concentra el riesgo de bloqueo en un solo punto.

**Vacíos**

- No pude leer la política de Namecheap ni de otros registradores.
- No investigué bloqueos de CONATEL a sitios de rifas o apuestas ni el régimen de dominios .ve.

### Herramienta para organizadores frente a operador de juego: distinción y precedentes

**Conclusión**

Ninguna política consultada da un refugio explícito al proveedor de software: Meta, WhatsApp, Google Play, PayPal y X extienden sus reglas a quien "facilita", "promueve" o da "soporte". La distinción se sostiene en la práctica cuando el proveedor no vende boletos, no custodia fondos y no promociona rifas concretas.

**Hallazgos con fuente**

- Lenguaje de alcance amplio: Meta incluye landings "even if there is no opportunity to gamble or game directly on that page" ([Meta](https://transparency.meta.com/policies/ad-standards/restricted-goods-services/gambling-games/)); WhatsApp veta "promoting, or otherwise facilitating" ([WhatsApp](https://whatsappbusiness.com/policy/)); Google Play veta apps que "enable or facilitate" y la funcionalidad "companion" ([Google Play](https://support.google.com/googleplay/android-developer/answer/9877032?hl=en)); PayPal incluye "other ventures that facilitate gambling" ([PayPal](https://www.paypal.com/us/legalhub/paypal/acceptableuse-full)); X incluye "Gambling-related software" ([X](https://business.x.com/en/help/ads-policies/ads-content-policies/gambling-content.html)).
- Rifei (Brasil, activo desde 2021) se posiciona como herramienta: "O Rifei organiza campanhas online? Não. O Rifei disponibiliza toda a plataforma para os administradores das campanhas"; "Todo o valor arrecadado (...) vão diretamente para a sua conta bancária"; "A plataforma não requer eventuais autorizações que o organizador entender necessárias". Usa "campanhas" en vez de "rifas" en su interfaz y mantiene app. — [Rifei](https://rifei.com.br/)
- Simple Rifa se describe como "plataforma SaaS que permite a emprendedores y negocios organizar sorteos y rifas promocionales" y declara 88 a 100+ plataformas activas con dominio propio. — [Simple Rifa](https://simplerifa.com/)
- RallyUp y Zeffy ofrecen rifas en línea restringidas a recaudación benéfica; RallyUp cobra 6,9 % en rifas y sweepstakes en su plan Flex. — [RallyUp](https://rallyup.com/pricing/); [Zeffy](https://www.zeffy.com/pricing)
- En Venezuela el regulador sí mira a los proveedores: las "plataformas digitales" deben tener "sistemas de trazabilidad total" y permitir la revisión de sus estructuras operativas. — [El Diario, 30-ene-2026](https://eldiario.com/2026/01/30/conalot-inicio-auditoria-nacional-sistemas-de-rifas/)
- Las ventas deben hacerse en "plataformas autorizadas", sin que la prensa liste cuáles. — [La Nación, 20-mar-2026](https://lanacionweb.com/nacional/rifas-en-redes-sociales-en-venezuela-conalot-advierte-sobre-requisitos-legales-para-evitar-estafas/)

**Inferencias de quien investigó**

- Rasgos que nos acercan a "herramienta": no tocar el dinero de los boletos, cobrar tarifa fija y no porcentaje de lo recaudado, no operar un marketplace o directorio público de rifas, no promocionar rifas de clientes, exigir y mostrar el RUNLOT del organizador.
- Rasgos que nos acercan a "operador": cobrar comisión sobre ventas, listar rifas activas en nuestra home, pautar rifas de clientes, ejecutar nosotros el sorteo.
- El "powered by" en páginas gratuitas es un arma de doble filo: es el canal de crecimiento más barato y también la huella que nos vincula con cada rifa, incluidas las fraudulentas.
- El mayor riesgo de plataforma no es Meta ni Google sino Conalot: si exige autorización a los sistemas, operar sin ella puede convertirnos en parte de la infracción.

**Vacíos**

- No encontré un caso documentado de una empresa de software de rifas suspendida o aprobada explícitamente por Meta, Google, Apple o un proveedor de pagos.
- No pude confirmar si Conalot publica un registro de sistemas o plataformas autorizadas, ni su costo.

### Benchmarks de precios: SaaS de bajo ticket y herramientas para microempresas

**Conclusión**

En Venezuela las herramientas para emprendedores se venden entre USD 10 y 15 al mes; los sistemas de rifas se cobran más caro y casi nunca como suscripción barata: pago anual de USD 135 a 400, mensual de USD 30 a 99, o tarifa por sorteo. Un plan gratuito con marca más un pago de USD 10 a 20 por rifa o al mes quedaría por debajo de todos los competidores vistos.

**Hallazgos con fuente**

**Sistemas de rifas (precios observados 13-oct-2026):**
- Simple Rifa: Básico USD 150 al año (1 sorteo activo, hasta 10.000 tickets, dominio propio), Pro USD 400 al año (ilimitado, hasta 1.000.000 de tickets); demo de 7 días; "Sin mensualidades · Sin comisiones"; soporte incluido solo 30 días; declara "+100 plataformas activas" y más de 100 clientes en nueve países. Con cupón vigente: USD 135 y 320. — [Simple Rifa](https://simplerifa.com/); [blog](https://simplerifa.com/blog/sistema-de-rifas-venezuela-plataforma-acepta-dolares-pagos-locales)
- Bendi (Venezuela, loterías Zulia, Caracas, Táchira): Nivel 1 USD 32 al mes (hasta 1.000 clientes, 1 proyecto), Nivel 2 USD 62,5 al mes (hasta 10.000 clientes, 3 proyectos); 0 % de comisión; activación por WhatsApp; sin prueba gratuita. — [Bendi](https://bendi.digital/)
- Laooz (Colombia y LATAM): "Empieza gratis o con pago fijo por sorteo"; Básico USD 250 por sorteo más 10 % de lo recaudado (hasta 2.000 números); Profesional USD 750 por sorteo más 5 % (hasta 10.000 números); Empresarial USD 1.500; declara más de USD 18 millones vendidos por sus operadores. — [Laooz](https://laooz.com/sistema-de-rifas/)
- Rifei (Brasil): pago único por campaña, R$ 97 (hasta 1.000 boletos, máximo R$ 5 por boleto), R$ 199,90 (hasta 100.000), R$ 697 (hasta 1.000.000), R$ 1.997 (hasta 10.000.000); soporte por WhatsApp de lunes a sábado. — [Rifei, precios](https://rifei.com.br/precos)
- Rifatuber (México): créditos por rifa, Básico MXN 100 (1 rifa, 100 números, 6 meses), Plus MXN 270 (2 rifas, 60.000 números), Premium MXN 792 (ilimitado, 1 año); plan con web propia MXN 150 al mes más MXN 200 de instalación. — [Rifatuber](https://rifatuber.com/)
- RifaBase (México y LATAM): plan gratuito y Premium de USD 99 al mes (dato de resultado de búsqueda, no verificado en la página). — [RifaBase](https://rifabase.com/)

**Herramientas para emprendedores en Venezuela:**
- Syntiweb (catálogo con carrito por WhatsApp, tasa BCV automática): USD 12 al mes hasta 20 productos, 15 días gratis. — [Syntiweb](https://syntiweb.com/cat)
- Exhibe: USD 15 al mes más 16 % de IVA, precios en USD, EUR y Bs a tasa BCV. — [Exhibe](https://www.exhibe.store/)
- Takla (catálogo e inventario): desde USD 10 al mes. — [Takla](https://landing.taklaweb.com/)
- Estimación de un blog comercial: desde USD 35 al mes para un emprendedor individual con tienda y pasarela local. — [Sellibrí](https://sellibri.com/cuanto-cuesta-crear-una-tienda-online-en-venezuela-en-2026-guia-real-de-costos/)
- Fina (gestión para pymes venezolanas): unos 4.200 clientes activos y más de USD 1,5 millones de ARR al año de lanzar, lo que implica cerca de USD 30 al mes por cliente (cálculo propio); cliente típico de 2 a 10 empleados y USD 1.000 a 5.000 de ingreso mensual. — [SaaSholic, 15-jun-2026](https://blog.saasholic.com/p/venezuela-is-not-back-its-being-rebuilt)

**Referencias LATAM y globales (no Venezuela):**
- Kyte (POS y catálogo): gratis, PRO USD 19,99, GROW USD 29,99, PRIME USD 39,99 al mes. — [Kyte](https://www.kyteapp.com/es/precios)
- Linktree: gratis; Starter USD 8 al mes (6 anual); Pro USD 15 (12 anual), que es el que permite "Remove Linktree branding"; Premium USD 35. — [Linktree](https://linktr.ee/s/pricing)
- Beacons: gratis con 9 % de comisión de venta; Creator USD 10 al mes. — [Beacons](https://beacons.ai/i/pricing)
- Ticketing: Eventbrite 3,7 % más USD 1,79 por entrada más 2,9 % de procesamiento ([Eventbrite](https://www.eventbrite.com/organizer/pricing/)); Luma gratis con 5 % en eventos pagos o Plus USD 59 al mes con 0 % ([Luma](https://lu.ma/pricing)); Uneticket (Perú) dice cobrar 7 % frente a 12 % de otras ticketeras ([Gestión](https://gestion.pe/economia/empresas/uneticket-las-claves-para-alcanzar-los-70-conciertos-y-captar-mas-publico-plataforma-digital-espectaculos-lenny-kravitz-entradas-cantantes-noticia/)).

**Lo que pagan los emprendedores venezolanos por servicios:**
- Un community manager en Venezuela gana entre USD 250 y 600 al mes atendiendo empresas o emprendimientos. — [El Diario, 27-ene-2025](https://eldiario.com/2025/01/27/cuanto-gana-community-manager-venezuela-y-otros-paises/)

**Inferencias de quien investigó**

- Hay un hueco de precio claro por debajo de USD 30 al mes: ningún sistema de rifas visto ofrece un nivel gratuito real y autoservicio con pago de USD 10 a 20.
- El ancla del organizador no es Canva sino lo que cobra un programador por un "sistema de rifas": USD 135 a 400 al año. Un precio por rifa de USD 10 a 25 o un mensual de USD 15 a 20 se lee como barato frente a esa referencia.
- Cobrar porcentaje (modelo Laooz) rinde más con rifas grandes pero nos acerca al perfil de operador y exige auditar ventas que no custodiamos; la tarifa fija es más coherente con el posicionamiento de herramienta.
- "Sin comisiones" es un mensaje de venta que los competidores repiten: el mercado lo valora.

**Vacíos**

- No obtuve precios en Venezuela de Canva, CapCut, hosting ni presupuestos típicos de pauta de emprendedores.
- No obtuve tarifas de ticketeras venezolanas (Ticketplate, Goliiive, MakeTicket).
- No verifiqué precios de herramientas de reservas (AgendaPro) ni de facturación.

### Poder adquisitivo y economía de una rifa

**Conclusión**

El ingreso de referencia en 2026 es de USD 240 al mes (mínimo integral) y unos USD 300 para un obrero industrial, con una canasta alimentaria de USD 550 o más. Un plan de USD 15 equivale al 6 % del ingreso mínimo, pero frente a lo que recauda una rifa mediana es marginal.

**Hallazgos con fuente**

- Ingreso mínimo integral: USD 240 al mes desde mayo de 2026 (USD 200 de "bono de guerra" más USD 40 de alimentación), 26 % más que los USD 190 previos; el salario mínimo legal sigue en Bs 130, menos de USD 0,27. — [Bloomberg Línea, 5-may-2026](https://www.bloomberglinea.com/latinoamerica/venezuela/para-que-alcanza-el-nuevo-salario-minimo-de-venezuela-este-2026/)
- Pensionados: bono de USD 70 al mes. Canasta alimentaria Cendas-FVM: unos USD 550; los USD 240 cubren el 43,6 %. — [Bloomberg Línea, 5-may-2026](https://www.bloomberglinea.com/latinoamerica/venezuela/para-que-alcanza-el-nuevo-salario-minimo-de-venezuela-este-2026/)
- Inflación interanual de 611,9 % en abril de 2026; acumulada de enero a abril de 90 % (BCV). — [Bloomberg Línea, 5-may-2026](https://www.bloomberglinea.com/latinoamerica/venezuela/para-que-alcanza-el-nuevo-salario-minimo-de-venezuela-este-2026/)
- Ingreso promedio del sector privado (OVF, primer trimestre de 2025): USD 237 al mes; gerentes USD 531, profesionales y técnicos USD 340, obreros USD 217. — [Bloomberg Línea, 21-abr-2025](https://www.bloomberglinea.com/latinoamerica/venezuela/salarios-de-sector-privado-se-erosionan-en-venezuela-por-inflacion-esto-gana-un-gerente/)
- Obrero industrial (Conindustria, segundo trimestre de 2026): USD 298 al mes; USD 256 en empresas pequeñas y USD 455 en grandes. — [Bloomberg Línea](https://www.bloomberglinea.com/latinoamerica/venezuela/el-salario-de-un-obrero-industrial-en-venezuela-cubre-apenas-el-41-de-su-canasta-familiar/)
- Brecha cambiaria al 29-may-2026: Binance P2P Bs 742,65 frente a BCV Bs 549,37 (35,2 %); el bolívar pierde cerca de 1 % diario; las tarjetas de crédito son menos del 1 % de las transacciones. — [SaaSholic](https://blog.saasholic.com/p/venezuela-is-not-back-its-being-rebuilt)
- Economía de rifas: los sorteos pasaron de "un dólar" por boleto a premios de camionetas, motos y viviendas, cobrados por pago móvil o divisas. — [Noticias Barquisimeto, 23-mar-2026](https://www.noticiasbarquisimeto.com/rifas-en-la-mira-venezuela-lanza-fuerte-ofensiva-contra-los-riferos-ilegales/)
- En 2022 (reportaje de EFE; cifras tomadas del resumen de búsqueda, el artículo original devolvió error 403) había boletos de USD 20 para camioneta y moto, rifas de USD 5 para línea blanca, y un vendedor con 60 de 1.000 boletos vendidos en cuatro días. — [Diario El Tiempo](https://diarioeltiempo.com.ve/la-venta-de-rifas-para-sorteos-en-venezuela-de-ocio-a-negocio/)
- Tras la ofensiva, los premios se redujeron: menos efectivo y vehículos usados en vez de lujo. — [La Gran Aldea, 18-abr-2026](https://lagranaldea.com/2026/04/18/en-medio-de-la-tormenta-el-negocio-de-las-rifas-digitales-sigue-viento-en-popa/)
- Carga regulatoria: 7 % de los ingresos de la rifa a Conalot. — [La Nación](https://lanacionweb.com/nacional/rifas-en-redes-sociales-en-venezuela-conalot-advierte-sobre-requisitos-legales-para-evitar-estafas/)

**Inferencias de quien investigó**

- Ilustración aritmética (no dato de mercado): una rifa de 1.000 números a USD 2 recauda USD 2.000; una tarifa de USD 15 es el 0,75 % de lo recaudado, una décima parte del 7 % de Conalot.
- El precio debe fijarse en USD y cobrarse en Bs a tasa del día, como hacen Exhibe y Syntiweb; con 1 % de depreciación diaria, un precio fijo en bolívares se erosiona en semanas.
- Los organizadores grandes fueron los golpeados por la ofensiva; el mercado restante es de cuentas menores de 100.000 seguidores y rifas más pequeñas, lo que favorece un producto barato y autoservicio.

**Vacíos**

- No hay datos publicados de ingresos, margen ni tamaño típico de una rifa mediana de Instagram en 2025-2026; las cifras de boletos son de 2022.
- No encontré el dato OVF de ingreso promedio para 2026.

### Modelo de precios para un cliente de uso esporádico

**Conclusión**

Los productos de uso por evento cobran por evento o por unidad vendida, no por mes: ticketeras, Rifei, Rifatuber y Laooz lo confirman. Para rifas esporádicas, el crédito o pago por rifa con un plan gratuito encaja mejor que una mensualidad; no hallé evidencia cuantitativa que compare conversión y retención entre modelos en este segmento.

**Hallazgos con fuente**

- Rifei: "Pague somente uma vez por campanha", escalado por número de boletos; "Você não tem limite de campanhas, mas (...) cada campanha criada é necessário pagar a taxa". — [Rifei, precios](https://rifei.com.br/precos); [Rifei](https://rifei.com.br/)
- Rifatuber vende "Compra de Créditos (Rifas)" con vigencia de 6 meses a 1 año. — [Rifatuber](https://rifatuber.com/)
- Ticket Tailor ofrece dos vías: "Pay as you go" a GBP 0,60 por entrada o "Pay upfront: Buy credits in advance" desde GBP 0,22, con "No time limit to use credits"; gratis para entradas gratuitas. — [Ticket Tailor](https://www.tickettailor.com/pricing)
- Luma combina gratis con 5 % por evento pago y una suscripción que elimina la comisión. — [Luma](https://lu.ma/pricing)
- Simple Rifa eligió pago anual único "sin mensualidades" con límite de un sorteo activo en el plan básico. — [Simple Rifa](https://simplerifa.com/)
- Fina (Venezuela): la deserción se concentra en los tres primeros meses, en parte por la falta de cobros recurrentes locales tipo Stripe. — [SaaSholic](https://blog.saasholic.com/p/venezuela-is-not-back-its-being-rebuilt)
- OpenView (2021): las empresas de software cotizadas con precio por uso tenían 120 % de retención neta frente a 110 % de sus pares. Dato de B2B grande, no de microclientes. — [PR Newswire](https://www.prnewswire.com/news-releases/usage-based-pricing-adoption-up-32-according-to-new-openview-report-301416075.html)

**Inferencias de quien investigó**

- Sin débito automático local, cada mes de suscripción es una nueva decisión de pago manual (Zelle, pago móvil, USDT): la suscripción mensual en Venezuela se comporta como una recompra y castiga la retención. El pago por rifa alinea el cobro con el momento en que el organizador tiene caja y motivación.
- Propuesta coherente con la evidencia: gratis con marca y límite de números; pago por rifa escalado por cantidad de números (por ejemplo hasta 1.000, hasta 10.000); paquetes de créditos con descuento y sin vencimiento corto; plan mensual o anual solo para quien hace rifas continuas.
- Escalar por número de boletos, no por precio del boleto ni por recaudación, evita parecer comisión.

**Vacíos**

- No encontré estudios que midan qué modelo convierte o retiene mejor en ticketing, crowdfunding o rifas.
- No hay datos de frecuencia real de rifas por organizador en Venezuela (la norma permite cuatro ocasionales al año).

### Canales y costos de adquisición en Venezuela

**Conclusión**

La audiencia está: TikTok alcanza 16,6 millones de adultos e Instagram 9,8 millones de usuarios. No hay benchmarks públicos de CPM o CPC para Venezuela, y la pauta desde el país ha tenido históricamente trabas de pago; la adquisición inicial debe apoyarse en contacto directo, "powered by" y referidos.

**Hallazgos con fuente**

- Instagram: 9,80 millones de usuarios en Venezuela a fines de 2025 (34,3 % de la población; 49,3 % de los adultos); 56,9 % mujeres. — [DataReportal, Digital 2026 Venezuela](https://datareportal.com/reports/digital-2026-venezuela)
- TikTok: 16,6 millones de usuarios mayores de 18, equivalente al 83,8 % de los adultos. — [DataReportal](https://datareportal.com/reports/digital-2026-venezuela)
- Facebook: 15,6 millones. Internet: 17,6 millones de usuarios (61,6 % de penetración); 21,8 millones de conexiones móviles; velocidad móvil mediana de 25,42 Mbps. — [DataReportal](https://datareportal.com/reports/digital-2026-venezuela)
- Pauta desde Venezuela (dato de 2019, posiblemente desactualizado): Facebook suspendía administradores comerciales que pautaban desde Venezuela "por un tema de restricción comercial" y rechazaba tarjetas de un país distinto al de la pauta. — [La Patilla, 27-ago-2019](https://lapatilla.com/2019/08/27/que-paso-con-las-publicidades-de-facebook-e-instagram-en-venezuela/)
- Meta cambió en abril de 2026 el cobro de algunos anunciantes de alto gasto a facturación mensual o débito directo; los pequeños siguen con tarjeta. — [Payments Dive](https://www.paymentsdive.com/news/meta-revamps-ad-payment-policy/814295/)
- Referencias globales de costo (no Venezuela): mediana mundial de Instagram Feed de USD 5,00 de CPM y USD 0,70 de CPC (Emplifi) ([AdsUploader](https://adsuploader.com/pt/blog/instagram-ads-cost)); mediana de Meta en 2026 cercana a USD 14 de CPM y USD 0,78 de CPC ([ContentStudio](https://contentstudio.io/blog/meta-ads-benchmarks)).
- Influencers en Venezuela (dato de más de tres años): una creadora cobraba unos USD 50 por contenido en TikTok y otros conocidos cerca de USD 200 si se publicaba también en Instagram; las tarifas "se mantienen en reserva". — [La Nación](https://lanacionweb.com/nacional/cuanto-puede-ganar-un-influencer-en-venezuela/)
- Referencia global 2025 (unas 12.000 campañas): nano-influencer (1.000 a 10.000 seguidores) USD 75 a 250 por publicación en Instagram; micro (10.000 a 50.000) USD 250 a 600. — [CreatorsJet](https://www.creatorsjet.com/es/blog/tarifas-de-influencers-por-plataforma-y-numero-de-seguidores-basadas-en-12000-campanas)
- Los competidores venden por WhatsApp (Bendi activa por WhatsApp; Rifei da soporte por WhatsApp) y usan afiliados o vendedores como función del producto. — [Bendi](https://bendi.digital/); [Rifei](https://rifei.com.br/)
- Fina logró recuperar su costo de adquisición en menos de dos meses. — [SaaSholic](https://blog.saasholic.com/p/venezuela-is-not-back-its-being-rebuilt)

**Inferencias de quien investigó**

- Nuestros clientes son identificables uno a uno en Instagram y TikTok (cuentas que publican rifas): el contacto directo por mensaje es el canal de menor costo y mayor precisión para los primeros 100.
- La pauta B2B debe evitar creatividades con premios o compra de boletos (secciones 1 y 3) y excluir menores.
- Un programa de referidos pagado en créditos de rifa calza con el modelo por rifa y con que los competidores ya tratan a "vendedores" y "afiliados" como algo natural.
- Los influencers de rifas son a la vez canal y cliente; un rifero conocido que use la herramienta es la mejor prueba social, pero tras marzo de 2026 asociarse a figuras grandes es riesgo reputacional y legal.

**Vacíos**

- Sin datos de CPM o CPC para audiencias venezolanas.
- Sin confirmación de si Meta Ads y TikTok Ads aceptan hoy cuentas y medios de pago venezolanos, ni del efecto de las sanciones sobre cuentas publicitarias en 2026.
- Sin datos de efectividad de grupos de WhatsApp o comunidades de Telegram, ni tarifas actuales de influencers venezolanos.

### Crecimiento por producto con marca "powered by"

**Conclusión**

El mecanismo está bien descrito pero no hallé cifras publicadas de qué porcentaje de registros genera el distintivo en Linktree, Typeform o Calendly. La práctica estándar es dejar la marca en el plan gratuito y cobrar por quitarla.

**Hallazgos con fuente**

- Linktree reserva "Remove Linktree branding" para el plan Pro (USD 15 al mes; USD 12 anual). — [Linktree](https://linktr.ee/s/pricing)
- Beacons también ofrece "Remove Beacons branding" como función de pago. — [Beacons](https://beacons.ai/i/pricing)
- El distintivo "powered by" es un bucle pasivo: los destinatarios ven la marca y una parte se registra; Calendly y Typeform son los ejemplos habituales (descripción cualitativa). — [HackerNoon](https://hackernoon.com/10-viral-loops-that-drive-sustainable-product-growth)
- En Calendly el bucle lo impulsa el enlace de agenda, que funciona como demo en vivo para quien recibe la invitación (análisis, no medición). — [Sean Ellis](https://seanellis.substack.com/p/cracking-the-viral-loop-calendlys)
- Advertencia: los bucles virales solo funcionan tras lograr encaje producto-mercado y pueden traer usuarios que no son el cliente ideal. — [North Star Dispatch](https://northstardispatch.substack.com/p/the-viral-loop-illusion)

**Inferencias de quien investigó**

- En nuestro caso quien ve el distintivo es el comprador de boletos, y solo una fracción pequeña es organizador potencial; el bucle es más débil que en Calendly, donde el receptor suele ser un par profesional. Lo compensa el volumen: una rifa expone la página a cientos o miles de visitantes.
- El distintivo debe llevar a una landing específica para organizadores ("crea tu rifa gratis") con origen medible por parámetro de referencia, para construir nuestro propio benchmark desde el primer día.
- Riesgo propio del rubro: si la rifa resulta fraudulenta, el distintivo nos señala. Requiere canal de denuncia visible y política de baja.

**Vacíos**

- Sin benchmarks numéricos (porcentaje de registros atribuibles, coeficiente viral) de Linktree, Typeform, Calendly, Tally ni equivalentes latinoamericanos.

### Tácticas de confianza en un mercado de baja confianza

**Conclusión**

Las señales de fraude que la prensa enseña a detectar son ganadores fantasma, premios reciclados y ausencia de registro; la señal de legalidad que promueve el Estado es el RUNLOT visible. Un producto que muestre RUNLOT, prueba del premio, sorteo atado a una lotería oficial y un historial público de ganadores responde a lo que el consumidor ya sabe mirar.

**Hallazgos con fuente**

- Conalot: el RUNLOT debe aparecer en toda la publicidad; sin él "el premio no está respaldado legalmente". Cada rifa necesita una solvencia que confirme que el premio existe (facturas, títulos de propiedad). — [La Nación, 20-mar-2026](https://lanacionweb.com/nacional/rifas-en-redes-sociales-en-venezuela-conalot-advierte-sobre-requisitos-legales-para-evitar-estafas/)
- Irregularidades señaladas: "ganadores fantasmas" (familiar o allegado del organizador) y "premios reciclados" (el mismo vehículo sorteado durante meses sin entregarse); un premio de origen ilícito puede ser confiscado al ganador. — [Noticias Barquisimeto](https://www.noticiasbarquisimeto.com/rifas-en-la-mira-venezuela-lanza-fuerte-ofensiva-contra-los-riferos-ilegales/)
- Suplantación con rifas falsas: una cuenta falsa de Instagram "rifaba" una camioneta por el centenario de Banco Mercantil; ocho cuentas suplantaron a Ivoo. Señales de alarma: urgencia, promesas irreales, enlaces o pagos fuera de canales oficiales. — [Efecto Cocuyo, 5-ene-2026](https://efectococuyo.com/cocuyo-chequea/estafas-digitales-2025/)
- Los competidores venden transparencia: Simple Rifa ofrece finalización por "Lotería nacional" y 13 testimonios en video ([Simple Rifa](https://simplerifa.com/)); Bendi ata los sorteos a loterías oficiales ([Bendi](https://bendi.digital/)); Laooz incluye "Verificador de boletos" ([Laooz](https://laooz.com/sistema-de-rifas/)); Rifatuber ofrece verificación de boletos con QR y calificaciones ([Rifatuber](https://rifatuber.com/)).
- Señales de confianza observadas en rifas británicas: ganadores visibles, exposición repetida, anfitriones conocidos y comentarios de otros jugadores. — [UK Gambling Commission](https://www.gamblingcommission.gov.uk/print/exploring-online-illegal-individual-led-lotteries-and-raffles)
- Cashea redujo su morosidad con niveles de usuario que se ganan con historial. — [Caracas Chronicles, 3-oct-2024](https://www.caracaschronicles.com/2024/10/03/after-venezuelas-credit-crunch-cashea-a-bnpl-app-is-booming/)

**Inferencias de quien investigó**

- Funciones de confianza prioritarias: campo RUNLOT visible, foto y documento del premio, resultado tomado de una lotería oficial con fecha fijada de antemano, verificador público de boleto, historial de rifas con ganadores, y distintivo de organizador verificado por niveles.
- Un distintivo de "verificado" otorgado por nosotros nos hace corresponsables de lo que avalamos; debe basarse en hechos comprobables (RUNLOT, rifas entregadas) y no en una opinión.
- No ofrecer garantías de pago del premio: no custodiamos fondos.

**Vacíos**

- Sin encuestas sobre a qué señales responde el consumidor venezolano ni estadísticas de estafas con rifas.
- Sin confirmar si Conalot ofrece un verificador público de RUNLOT que podamos enlazar.

### Casos de estudio: primeros clientes

**Conclusión**

Los casos venezolanos documentados (Cashea, Fina) crecieron con concentración geográfica y presencia física, luego densidad; no hay postmortems publicados de SaaS de rifas. El referente más cercano es Rifei, que escaló con autoservicio, pago por campaña y soporte por WhatsApp.

**Hallazgos con fuente**

- Cashea lanzó el 3-oct-2022 con "presupuesto pequeño", firmó primero tiendas individuales (Depofit, Doctor Lentes), luego ganó centros comerciales uno a uno (Sambil Chacao, Tolón, Líder, CCCT) con promotores uniformados, y después ciudades; en octubre de 2024 tenía más de 5 millones de usuarios y unas 5.000 tiendas. — [Caracas Chronicles](https://www.caracaschronicles.com/2024/10/03/after-venezuelas-credit-crunch-cashea-a-bnpl-app-is-booming/)
- Fina alcanzó unos 4.200 clientes activos y más de USD 1,5 millones de ARR en un año, con clientes que venían de Excel o cuadernos. — [SaaSholic, 15-jun-2026](https://blog.saasholic.com/p/venezuela-is-not-back-its-being-rebuilt)
- Las plataformas globales se mantuvieron fuera por sanciones y riesgo de cumplimiento, lo que dejó espacio a alternativas locales; las apps deben funcionar en Android antiguos y con velocidad cercana a 3G. — [SaaSholic](https://blog.saasholic.com/p/venezuela-is-not-back-its-being-rebuilt)
- Yummy opera en dólares y ofrece a comercios Wink, un chatbot de WhatsApp con sitio de comercio electrónico. — [Realistic Optimist](https://www.realisticoptimist.io/yummy-venezuelas-first-superapp/)
- Rifei (desde 2021) opera hasta 10 millones de boletos por campaña con creación en minutos, pago por campaña y WhatsApp. — [Rifei](https://rifei.com.br/)
- Simple Rifa muestra los dominios reales de sus clientes como prueba social y entrega el mismo día. — [Simple Rifa](https://simplerifa.com/)

**Inferencias de quien investigó**

- Para los primeros 100 clientes de pago: elegir una o dos ciudades con tradición rifera (Táchira, Zulia y Lara aparecen en los testimonios de Bendi), incorporar a mano a 20 o 30 organizadores pequeños con RUNLOT, y exhibir sus páginas como casos.
- El equivalente a "ganar un centro comercial" es ganar una comunidad: un grupo de organizadores de una ciudad o un nicho (motos, teléfonos).

**Vacíos**

- Sin entrevistas ni postmortems de fundadores de SaaS de rifas en Brasil, Colombia o México.
- El artículo de Yummy está tras muro de pago; no obtuve sus tácticas iniciales.

### Expectativas de soporte

**Conclusión**

El estándar del rubro es soporte y venta por WhatsApp más tutoriales en video; los competidores limitan el soporte gratuito, lo que abre espacio para diferenciarse.

**Hallazgos con fuente**

- Rifei: "Suporte: Segunda a sábado via WhatsApp", más centro de ayuda. — [Rifei, precios](https://rifei.com.br/precos)
- Bendi: activación y asesoría por WhatsApp, videotutoriales en "Academia", soporte "prioritario VIP" en el plan superior. — [Bendi](https://bendi.digital/)
- Simple Rifa: "Soporte 30 días" incluido; configuración en 30 minutos. — [Simple Rifa](https://simplerifa.com/)
- Rifatuber: tutoriales en YouTube en todos los planes. — [Rifatuber](https://rifatuber.com/)
- Kyte reserva "Asistencia vía WhatsApp", videollamada de bienvenida y atención los sábados para su plan más caro (USD 39,99). — [Kyte](https://www.kyteapp.com/es/precios)
- WhatsApp exige vías de escalamiento a humano cuando se automatizan respuestas. — [WhatsApp Business Messaging Policy](https://whatsappbusiness.com/policy/)

**Inferencias de quien investigó**

- Ofrecer WhatsApp con persona real, también en el plan gratuito durante el lanzamiento, y videos cortos verticales de onboarding.
- El pico de soporte será las noches y fines de semana cercanos al sorteo; cubrir sábados.

**Vacíos**

- Sin datos de tiempos de respuesta esperados ni de preferencia de canal del consumidor venezolano.

### Churn y retención en SaaS para microempresas

**Conclusión**

Con un precio menor a USD 25 al mes hay que esperar una deserción mensual del orden de 6 %; en un producto episódico la métrica útil es la tasa de segunda rifa, no la retención mensual.

**Hallazgos con fuente**

- Deserción mensual mediana de 6,1 % para empresas con ingreso por cuenta menor a USD 25, frente a 1,8 % con más de USD 1.000 (atribuido a ChartMogul por una fuente secundaria; año no indicado). — [LiveX](https://www.livex.ai/blog/average-saas-churn-rates)
- SaaS para pymes: 3 % a 7 % mensual (citando informes de Recurly y Paddle de 2025). Otras fuentes secundarias dan cifras muy distintas. — [Vena](https://www.venasolutions.com/blog/saas-churn-rate)
- Fina: deserción concentrada en los tres primeros meses. — [SaaSholic](https://blog.saasholic.com/p/venezuela-is-not-back-its-being-rebuilt)
- Tope regulatorio de uso: cuatro rifas ocasionales al año por persona o empresa. — [La Nación](https://lanacionweb.com/nacional/rifas-en-redes-sociales-en-venezuela-conalot-advierte-sobre-requisitos-legales-para-evitar-estafas/)

**Inferencias de quien investigó**

- Medir por cohortes: porcentaje de organizadores que crean una segunda rifa en 90 días y rifas por organizador al año.
- Palancas de recompra: base de compradores reutilizable para la siguiente rifa, historial público que acumula reputación, créditos prepagados y duplicar una rifa anterior con un toque.
- El tope de cuatro rifas al año limita el ingreso por cliente cumplidor; sostiene el argumento a favor del pago por rifa sobre la mensualidad.

**Vacíos**

- No verifiqué las cifras de deserción en los informes primarios de ChartMogul, Recurly o Paddle.
- Sin benchmarks de recompra para herramientas episódicas (ticketing, rifas).
