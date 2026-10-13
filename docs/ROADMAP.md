# Roadmap y evaluación de funcionalidades

Todas las funcionalidades que tiene sentido considerar, evaluadas. Las evaluaciones son criterio de quien escribió esto, no datos: sirven para ordenar, no para prometer fechas.

**Escalas**

- **Valor:** Alto, Medio o Bajo, pensando en que un organizador pague o se quede.
- **Esfuerzo:** S es hasta un día, M es de dos a cuatro días, L es de una a dos semanas, XL es más.
- **Riesgo:** lo que puede salir mal o lo que hay que decidir antes.

Las referencias como S1 o D4 apuntan a [HALLAZGOS-TECNICOS.md](HALLAZGOS-TECNICOS.md).

## Orden recomendado

> **Antes de todo lo demás:** resolver la pregunta regulatoria descrita en [INVESTIGACION-VENEZUELA.md](INVESTIGACION-VENEZUELA.md). De ella depende si el producto se lanza solo, homologado o aliado a una plataforma homologada. Los cambios de producto de la sección 8 de ese documento pasan a ser parte de la fase 0.

1. **Fase 0.** Sin esto no se puede dar acceso a un organizador real.
2. **Fase 1.** Con esto un organizador puede llevar una rifa completa de principio a fin.
3. Probar con tres organizadores reales. Ver [NEGOCIO.md](NEGOCIO.md#6-salida-al-mercado).
4. **Fase 2.** Cobrar.
5. **Fase 3.** Solo lo que los organizadores pidan.

## Fase 0: saneamiento

| Funcionalidad | Valor | Esfuerzo | Riesgo | Notas |
|---|---|---|---|---|
| Roles y policies por equipo (S1) | Alto | M | Decidir qué roles existen | Enum de rol sobre el pivote `team_user.role`, que ya existe. Una policy por modelo. Restringir `UserResource` |
| Test de aislamiento entre equipos | Alto | S | Ninguno | Para cada recurso: un usuario del equipo A no ve ni edita registros del equipo B |
| Verificación de correo y recuperar contraseña (S2) | Alto | S | Necesita correo saliente configurado | `->emailVerification()` y `->passwordReset()` en el panel. `User` debe implementar `MustVerifyEmail` |
| Confirmar y rechazar pagos como acción (S3) | Alto | S | Ninguno | Reemplazar `IconSelectColumn` por `Action` con `requiresConfirmation()`. Guardar `reviewed_by` y `reviewed_at` |
| Quitar datos reales y cuenta por defecto (S4, S5) | Alto | S | Limpiar el historial de git reescribe la rama principal | Usar faker en los seeders y crear el admin solo en entorno local |
| Soft deletes en pagos y cascadas correctas (D4, D5) | Medio | S | Ninguno | Impedir borrar una rifa con pagos confirmados |
| Migraciones portables y cambio de motor (D2, D3) | Alto | M | Hay que reescribir migraciones ya aplicadas | Como no hay producción, lo más limpio es consolidarlas |
| Correcciones menores de formularios (D6 a D10) | Medio | S | Ninguno | Fecha de premio, columna JSON, cédula única, mensaje de requerido, validación de ofertas |
| Extender `BelongsToTeam` a tickets, ofertas y premios (S6) | Medio | S | Ninguno | O un scope que pase por la rifa |
| Integración continua (C17) | Medio | S | Ninguno | GitHub Actions con tests y Pint |
| Términos de uso y aviso legal | Alto | S | Requiere abogado | El organizador acepta al registrarse |
| Limpieza de restos de Spatie y dependencia declarada (S12, C6) | Bajo | S | Ninguno | |
| Actualizar las instrucciones para agentes (C1) | Bajo | S | Ninguno | `php artisan boost:update` regenera el bloque de `CLAUDE.md` |

## Fase 1: cerrar el ciclo de venta

| Funcionalidad | Valor | Esfuerzo | Riesgo | Notas |
|---|---|---|---|---|
| Avisar al organizador de un pago nuevo | Alto | S | Ninguno | Notificaciones de base de datos de Filament con `->databaseNotifications()`. Disparar desde `ReserveTickets` |
| Avisar al comprador al confirmar o rechazar | Alto | S | Ninguno | Empezar con un botón en el admin que abra `wa.me` con el mensaje armado: números, estado y enlace de consulta. No cuesta nada y no necesita API |
| Botón de WhatsApp del organizador en la página pública | Alto | S | Ninguno | Requiere un teléfono de contacto en el equipo |
| Perfil del equipo | Alto | S | Ninguno | Hay un `->tenantProfile()` comentado en `AdminPanelProvider`. Campos: nombre, teléfono, logo, tasa propia |
| Tasa de cambio propia por organizador | Alto | S | Ninguno | Columna nula en `teams`. Si está vacía se usa BCV. `ExchangeRateService` ya centraliza la lectura |
| Vender desde el admin asignando números | Alto | M | Reutilizar reglas sin duplicarlas | Usar `ReserveTickets` con comprobante opcional. Resuelve D14 |
| Ver los tickets de una rifa | Alto | S | Ninguno | Relation manager de tickets en la rifa, con comprador y estado. Una grilla de números vendidos sería el paso siguiente |
| Vencimiento de reservas sin confirmar | Alto | S | Decidir el plazo | Comando programado que rechaza pagos pendientes viejos. Avisar antes al organizador |
| Registrar resultado y ganador | Alto | M | Decidir el modelo | Por cada premio: número ganador, fecha, evidencia. Mostrar en la página pública. Es la mitad de la confianza |
| Escritorio con cifras | Medio | S | Ninguno | Widgets de Filament: vendido por rifa, pagos por confirmar, ingresos. Quitar `FilamentInfoWidget` |
| Exportar tickets y pagos | Medio | S | Ninguno | Filament trae acciones de exportación |
| Filtros y orden en las tablas | Medio | S | Ninguno | Pagos por estado y rifa, primero los pendientes |
| Página de inicio y marca | Alto | M | Falta nombre y marca | Hoy `/` es la bienvenida de Laravel |

## Fase 2: cobrar

| Funcionalidad | Valor | Esfuerzo | Riesgo | Notas |
|---|---|---|---|---|
| Planes con límites | Alto | M | Definir precios | Plan por equipo. Límites: rifas activas, tamaño de rifa, miembros |
| Cobro de planes con comprobante | Alto | M | Trabajo manual de confirmación | Reutilizar el flujo de pagos existente, con la plataforma como "organizador" |
| Panel del dueño de la plataforma | Alto | M | Es un segundo panel de Filament | Ver equipos, confirmar pagos de planes, suspender organizadores |
| Marca en las páginas del plan gratis | Alto | S | Ninguno | Pie con enlace a la página de inicio. Es el canal de adquisición |
| Cobro en línea con pasarela | Bajo | L | Poca adopción de tarjetas en Venezuela | Solo si se expande a otros países |

## Fase 3: crecer

| Funcionalidad | Valor | Esfuerzo | Riesgo | Notas |
|---|---|---|---|---|
| Vendedores con comisión | Alto | L | Modelo de comisiones | Rol de vendedor, enlace propio por vendedor, `seller_id` en el pago, reporte por vendedor |
| Registro de auditoría | Alto | M | Añadir una dependencia requiere aprobación | Quién confirmó qué y cuándo. Defensa ante reclamos |
| Importar clientes y tickets desde Excel | Medio | M | Formatos sucios | Baja la barrera para migrar una rifa en curso |
| Logo, color y redes del organizador en su página | Medio | M | No romper la sobriedad del diseño | El color del organizador podría reemplazar solo el token `brand` |
| Lista de bloqueados y tope por comprador | Medio | S | Ninguno | |
| Recordatorios a pagos pendientes | Medio | M | Necesita canal de mensajería | |
| Leer el comprobante automáticamente | Medio | M | Precisión y costo | Prellenar referencia y monto, y avisar si no coinciden |
| Conciliar pagos con el extracto del banco | Alto | XL | Alto. Cada banco es distinto | Subir el extracto y cruzar referencias. Más realista que una API bancaria |
| API de WhatsApp Business | Medio | L | Costo por mensaje y aprobación de plantillas | Solo cuando el volumen justifique dejar los enlaces `wa.me` |
| Sorteo aleatorio verificable | Medio | M | Explicarlo bien | Para rifas que no dependen de una lotería |
| Devoluciones al cancelar | Medio | M | Ninguno | Marcar pagos como devueltos, con comprobante |
| Analítica de la página pública | Medio | S | Privacidad | Eventos propios, sin terceros |
| Varios países | Medio | L | Legal por país | Ver [NEGOCIO.md](NEGOCIO.md#9-otros-países) |
| Tickets de cortesía | Bajo | S | Ninguno | |
| Códigos de descuento | Bajo | M | Complica el precio | Las ofertas por cantidad ya cubren lo principal |
| Referidos entre compradores | Bajo | M | Ninguno | |
| Cuenta para el comprador | Bajo | L | Fricción | La consulta por cédula ya resuelve lo esencial sin registro |
| Dominio propio por organizador | Bajo | L | Certificados y DNS | |
| API pública y webhooks | Bajo | L | Ninguno | Sin demanda conocida |
| Aplicación móvil nativa | Bajo | XL | Costo de mantener | No recomendada. La web móvil ya cubre al comprador |

## Mejoras a lo que ya existe

### Página pública

| Mejora | Valor | Esfuerzo |
|---|---|---|
| Miniaturas de las imágenes. Hoy se sirve la imagen original | Medio | S |
| Trampa de foco dentro de las hojas | Bajo | S |
| Imagen de vista previa propia de la plataforma cuando la rifa no tiene foto | Bajo | S |
| Mostrar ganadores en rifas finalizadas | Alto | Depende de registrar ganadores |
| Aviso si el comprador abre una rifa donde ya tiene números reservados | Bajo | S |
| Grilla de 4 columnas para rifas de 5 dígitos o más | Bajo | S |

### Panel de administración

| Mejora | Valor | Esfuerzo |
|---|---|---|
| Tema propio con `->viteTheme()` en lugar del CSS inyectado (C7) | Bajo | S |
| Separar formulario y tabla de cada recurso (C10) | Bajo | M |
| Castear los enums de estado en los modelos (C4) | Bajo | S |
| Un solo lugar para monedas y banderas (C5) | Bajo | S |
| Invitar miembros por correo en lugar de crearles la contraseña | Medio | M |
| Traducir los cuatro textos faltantes (C12) | Bajo | S |
| Reducir columnas de la tabla de rifas para que no desborde (C13) | Bajo | S |

## Funcionalidades descartadas por ahora

| Idea | Por qué no |
|---|---|
| Comisión por ticket vendido | Cambia la posición legal de la plataforma. Ver [NEGOCIO.md](NEGOCIO.md#3-posicionamiento) |
| Custodiar el dinero de las rifas | Lo mismo, y además exige licencias financieras |
| Chat dentro de la plataforma | WhatsApp ya es el canal. No se le gana |
| Carrusel horizontal de premios u ofertas | No se podía mover con ratón. Se reemplazó por lista y grilla |
