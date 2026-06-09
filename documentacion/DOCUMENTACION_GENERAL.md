# Documentación General — JM y JS Alimentos
## Plataforma de Capacitación en Línea

---

## 1. Objetivos

### 1.1 Objetivo General

Desarrollar una plataforma web de e-learning para la empresa **JM y JS Alimentos**, con sede en Huancayo, Junín, que permita a profesionales de la industria alimentaria peruana acceder a cursos de certificación en línea, gestionar sus inscripciones y pagos, y recibir asistencia mediante inteligencia artificial; centralizando además la administración de usuarios y comunicaciones en un panel de control.

---

### 1.2 Objetivos Específicos

| # | Objetivo | Indicador de cumplimiento |
|---|---|---|
| OE-01 | Publicar un catálogo dinámico de cursos administrado desde base de datos, organizado por categoría y nivel (Básico, Intermedio, Avanzado) con información de duración, precio y certificación | El usuario puede ver, filtrar (por nivel, categoría y búsqueda) y seleccionar cursos publicados desde `/cursos`, con detalle por curso en `/cursos/{slug}` |
| OE-02 | Implementar un sistema de registro e inicio de sesión seguro para estudiantes | Los usuarios pueden crear una cuenta, autenticarse y acceder a su panel personal |
| OE-03 | Habilitar un carrito de compras y flujo de checkout que registre la venta y genere inscripciones automáticamente | El checkout crea un registro en `sales` (con `sale_items`) y una inscripción en `enrollments` con estado `activo` por cada curso |
| OE-04 | Proveer un aula virtual y un panel personal donde el estudiante consuma el contenido y visualice su progreso | El estudiante accede a los módulos y materiales de sus cursos inscritos y `/mi-cuenta` muestra inscripciones, progreso y estadísticas en tiempo real |
| OE-05 | Implementar un sistema de contacto asíncrono para consultas de los visitantes | Los mensajes se guardan en la BD y el administrador los gestiona desde `/admin/contacts` |
| OE-06 | Crear un panel de administración LMS con gestión de cursos, módulos, materiales, estudiantes, ventas, cupones, roles, configuración y auditoría | El administrador accede a estadísticas (KPIs y gráficos) y a los módulos de gestión bajo `/admin` |
| OE-07 | Integrar un asistente virtual con IA para orientación en tiempo real | El chatbot responde consultas sobre cursos y servicios usando Google Gemini |
| OE-08 | Garantizar que la plataforma sea responsive y funcional en dispositivos móviles | El diseño se adapta a pantallas desde 320px sin pérdida de funcionalidad |
| OE-09 | Implementar control de acceso basado en roles y permisos (RBAC) | El acceso a cada acción administrativa se valida por permiso (`permission:*`) según el rol del usuario (administrador, instructor, soporte, estudiante) |
| OE-10 | Habilitar la gestión comercial con ventas y cupones de descuento | El administrador gestiona cupones (vigencia, límite, estado) y consulta las ventas registradas; el cupón aplica descuento validado en el checkout |
| OE-11 | Registrar auditoría de las operaciones sensibles de administración | Las acciones de crear, editar, publicar y eliminar quedan registradas en `audit_logs` con usuario, IP y datos previos/nuevos |
| OE-12 | Centralizar la configuración del sistema en parámetros editables | El administrador edita ajustes (empresa, contacto, etc.) desde `/admin/settings`, leídos por la aplicación mediante el helper `setting()` con caché |

---

## 2. Requerimientos

### 2.1 Requerimientos Funcionales

Los requerimientos funcionales describen **qué debe hacer** el sistema.

#### RF-01 — Gestión de cuentas de usuario

| ID | Descripción |
|---|---|
| RF-01.1 | El sistema debe permitir el registro de nuevos usuarios con nombre, correo, contraseña y datos opcionales (DNI, teléfono) |
| RF-01.2 | El sistema debe validar que el correo electrónico sea único en el momento del registro |
| RF-01.3 | El sistema debe requerir contraseñas de mínimo 8 caracteres con confirmación |
| RF-01.4 | El sistema debe permitir el inicio de sesión con correo y contraseña |
| RF-01.5 | El sistema debe soportar la opción "Recuérdame" para sesiones persistentes |
| RF-01.6 | El sistema debe invalidar completamente la sesión al cerrar sesión |
| RF-01.7 | El sistema debe redirigir al administrador al panel admin y al estudiante a su cuenta tras el login |

#### RF-02 — Catálogo de cursos

| ID | Descripción |
|---|---|
| RF-02.1 | El sistema debe mostrar el catálogo de cursos **publicados** desde la base de datos, con nombre, categoría, nivel, duración, precio y si incluye certificación |
| RF-02.2 | El sistema debe permitir filtrar los cursos por nivel (Básico, Intermedio, Avanzado), por categoría y por término de búsqueda |
| RF-02.3 | El sistema debe mostrar un curso destacado en la sección hero de la página de cursos |
| RF-02.4 | El sistema debe ofrecer una página de detalle por curso (`/cursos/{slug}`) con su descripción, módulos y materiales; los cursos en borrador solo son visibles para administradores |

#### RF-03 — Carrito de compras

| ID | Descripción |
|---|---|
| RF-03.1 | El sistema debe permitir agregar cursos al carrito sin requerir autenticación |
| RF-03.2 | El sistema debe impedir agregar el mismo curso dos veces al carrito |
| RF-03.3 | El sistema debe permitir eliminar cursos del carrito individualmente |
| RF-03.4 | El sistema debe mostrar el conteo de cursos en el carrito de forma persistente en la barra de navegación |
| RF-03.5 | El sistema debe requerir autenticación para acceder al checkout |
| RF-03.6 | El sistema debe calcular y mostrar el subtotal, el IGV (18%) y el total en el checkout |

#### RF-04 — Proceso de pago e inscripción

| ID | Descripción |
|---|---|
| RF-04.1 | El sistema debe validar los datos de la tarjeta (nombre, número mínimo de 16 dígitos, expiración, CVC mínimo de 3 dígitos) en el checkout |
| RF-04.2 | El sistema debe registrar la operación creando un registro en `sales` con sus `sale_items`, y una inscripción en `enrollments` con estado `activo` por cada curso del carrito |
| RF-04.3 | El sistema debe permitir aplicar un cupón de descuento válido (vigencia y límite de usos) sobre el subtotal antes de calcular el total |
| RF-04.4 | El sistema debe impedir la inscripción duplicada si el usuario ya está inscrito en un curso del carrito (reactivando la inscripción si estaba pendiente o suspendida) |
| RF-04.5 | El sistema debe vaciar el carrito y el cupón aplicado inmediatamente después de procesar el pago, e invalidar la caché de métricas del dashboard |
| RF-04.6 | El sistema debe redirigir al usuario a una página de confirmación tras el pago exitoso |
| RF-04.7 | El sistema debe redirigir al catálogo de cursos si se intenta pagar con el carrito vacío |
| RF-04.8 | El cobro se procesa actualmente de forma **simulada**; la integración con Stripe está preparada a nivel de infraestructura (`config/stripe.php`, `StripeService` y la columna `sales.stripe_payment_id`) para activarse a futuro sin rehacer el flujo |

#### RF-05 — Panel del estudiante

| ID | Descripción |
|---|---|
| RF-05.1 | El sistema debe mostrar todos los cursos inscritos del usuario con nombre, nivel, precio, estado y fecha |
| RF-05.2 | El sistema debe calcular y mostrar estadísticas del estudiante: cursos inscritos, pagados, completados e inversión total |
| RF-05.3 | El sistema debe mostrar el perfil del usuario con todos sus datos registrados |
| RF-05.4 | El sistema debe desbloquear logros automáticamente según condiciones (primera inscripción, primer pago, 3+ cursos, primer curso completado) |

#### RF-06 — Formulario de contacto

| ID | Descripción |
|---|---|
| RF-06.1 | El sistema debe permitir a cualquier visitante enviar un mensaje de consulta |
| RF-06.2 | El sistema debe mostrar el campo de selección de curso solo cuando el tema seleccionado sea "Cursos" |
| RF-06.3 | El sistema debe guardar el mensaje en la base de datos con estado `no leído` |
| RF-06.4 | El sistema debe confirmar el envío al usuario mediante una notificación sin recargar la página |

#### RF-07 — Panel de administración

| ID | Descripción |
|---|---|
| RF-07.1 | El sistema debe restringir cada acción del panel admin mediante permisos (`permission:*`) evaluados según el rol del usuario; las rutas administrativas requieren autenticación más el permiso correspondiente |
| RF-07.2 | El sistema debe mostrar un dashboard con KPIs reales (cursos, estudiantes, ventas e ingresos, tasa de finalización) y gráficos de ventas e inscripciones mensuales (Chart.js), con caché de métricas |
| RF-07.3 | El sistema debe permitir la gestión de roles y la asignación de roles a usuarios (sin depender del flag heredado `is_admin`) |
| RF-07.4 | El sistema debe mostrar los mensajes de contacto con distinción visual entre leídos y no leídos |
| RF-07.5 | El sistema debe permitir al administrador marcar mensajes como leídos y eliminarlos |

#### RF-08 — Asistente virtual con IA

| ID | Descripción |
|---|---|
| RF-08.1 | El sistema debe integrar un chatbot accesible desde cualquier página de la plataforma |
| RF-08.2 | El chatbot debe responder preguntas sobre los cursos, servicios y empresa usando Google Gemini |
| RF-08.3 | El sistema debe manejar errores de la API de IA con mensajes descriptivos al usuario |

#### RF-09 — Gestión de cursos (administración)

| ID | Descripción |
|---|---|
| RF-09.1 | El sistema debe permitir el CRUD de cursos (general, comercial y SEO), preservando la imagen de portada si no se reemplaza |
| RF-09.2 | El sistema debe permitir publicar/despublicar un curso, validando contenido mínimo antes de publicar y registrando la acción en auditoría |
| RF-09.3 | El sistema debe permitir duplicar un curso (con sus módulos y materiales) en estado borrador |
| RF-09.4 | El sistema debe impedir eliminar un curso con inscripciones activas sin una confirmación reforzada |

#### RF-10 — Módulos y materiales

| ID | Descripción |
|---|---|
| RF-10.1 | El sistema debe permitir el CRUD de módulos dentro de un curso y su reordenamiento mediante arrastrar y soltar (persistiendo el campo `order`) |
| RF-10.2 | El sistema debe permitir el CRUD de materiales por módulo, con formulario dinámico según el tipo (video, documento, presentación, texto enriquecido o recurso descargable) |
| RF-10.3 | El sistema debe soportar video por URL (YouTube/Vimeo, con embed seguro) y video subido (MP4/WebM con reproductor HTML5) |
| RF-10.4 | El sistema debe validar los archivos por extensión, MIME y tamaño según los límites definidos en `config/lms.php`, y eliminar archivos huérfanos al reemplazar o borrar un material |
| RF-10.5 | El sistema debe sanitizar el HTML del texto enriquecido (editor Quill) antes de almacenarlo y mostrarlo |

#### RF-11 — Aula virtual y progreso del estudiante

| ID | Descripción |
|---|---|
| RF-11.1 | El sistema debe ofrecer un aula (`/mi-cuenta/cursos/{course}`) accesible solo para estudiantes con inscripción **activa** en el curso |
| RF-11.2 | El sistema debe permitir marcar materiales como completados, actualizando el progreso del curso y la última fecha de acceso |
| RF-11.3 | El sistema debe servir los archivos privados de los materiales solo a usuarios autorizados (inscritos, instructor o administrador), impidiendo el acceso directo no autorizado |

#### RF-12 — Roles, permisos y configuración

| ID | Descripción |
|---|---|
| RF-12.1 | El sistema debe definir roles (administrador, instructor, soporte, estudiante) y permisos por módulo, y validar el acceso por permiso |
| RF-12.2 | El sistema debe permitir gestionar la configuración del sistema (parámetros clave/valor) leída mediante el helper `setting()` con caché |

#### RF-13 — Ventas, cupones y auditoría

| ID | Descripción |
|---|---|
| RF-13.1 | El sistema debe permitir el CRUD de cupones (código, tipo, valor, vigencia, límite de usos y estado) |
| RF-13.2 | El sistema debe listar y mostrar el detalle de las ventas registradas |
| RF-13.3 | El sistema debe permitir la gestión de estudiantes (suspender, reactivar y reiniciar progreso de inscripciones), auditando cada acción |
| RF-13.4 | El sistema debe registrar en `audit_logs` las operaciones sensibles (usuario, acción, entidad, valores previos/nuevos, IP y user-agent), consultables con filtros |

---

### 2.2 Requerimientos No Funcionales

Los requerimientos no funcionales describen **cómo debe comportarse** el sistema.

#### Seguridad

| ID | Descripción |
|---|---|
| RNF-01 | Las contraseñas deben almacenarse como hash bcrypt con mínimo 12 rondas |
| RNF-02 | El sistema debe regenerar el ID de sesión tras cada inicio de sesión para prevenir session fixation |
| RNF-03 | Todas las rutas POST deben estar protegidas por tokens CSRF |
| RNF-04 | Las rutas del panel admin deben validarse por permiso; un usuario sin el permiso requerido recibe HTTP 403 |
| RNF-05 | Las claves de API (Gemini, Stripe) deben almacenarse en variables de entorno, nunca en el código fuente |
| RNF-05.1 | El login y el endpoint del chatbot (`/api/chat`) deben aplicar limitación de tasa (rate limiting); las respuestas deben incluir cabeceras de seguridad (`SecurityHeadersMiddleware`) |

#### Rendimiento

| ID | Descripción |
|---|---|
| RNF-06 | Las operaciones del carrito (agregar/eliminar) deben responder en menos de 500ms usando AJAX |
| RNF-07 | Las páginas públicas deben cargar en menos de 3 segundos en conexiones de 10 Mbps |
| RNF-08 | El chatbot debe tener un timeout máximo de 30 segundos para las respuestas de Gemini |

#### Usabilidad

| ID | Descripción |
|---|---|
| RNF-09 | La interfaz debe ser completamente funcional en pantallas desde 320px de ancho (móvil) |
| RNF-10 | El sistema debe mostrar mensajes de error claros y en español para todas las validaciones |
| RNF-11 | Las operaciones de éxito y error deben comunicarse mediante notificaciones toast no intrusivas |
| RNF-12 | La barra de navegación debe permanecer visible al hacer scroll en todas las páginas |

#### Mantenibilidad

| ID | Descripción |
|---|---|
| RNF-13 | El código debe seguir el estándar PSR-12 de PHP, verificable con Laravel Pint |
| RNF-14 | Los cambios en la estructura de la base de datos deben gestionarse exclusivamente mediante migraciones de Laravel |
| RNF-15 | Las variables de configuración sensibles deben definirse en `.env` y nunca ser subidas al repositorio |

#### Disponibilidad

| ID | Descripción |
|---|---|
| RNF-16 | El sistema debe funcionar en un entorno local con XAMPP sin requerir conexión a Internet para las funcionalidades principales (excepto el chatbot) |
| RNF-17 | El sistema debe manejar la ausencia de la clave de API de Gemini sin detener el funcionamiento del resto de la plataforma |

---

## 3. Actores Involucrados

El sistema define los siguientes actores con distintos niveles de acceso. El acceso administrativo ya no depende de un único flag, sino de un modelo de **roles y permisos**: existen los roles **administrador**, **instructor**, **soporte** y **estudiante**, y cada acción se valida por permiso. A continuación se describen los perfiles principales.

---

### Actor 1 — Visitante (no autenticado)

```
┌────────────────────────────────────────────────────────┐
│  VISITANTE                                             │
│  Perfil: Cualquier persona que accede al sitio sin     │
│          haber iniciado sesión                         │
│                                                        │
│  Puede hacer:                                          │
│  ✓ Ver la página de inicio                             │
│  ✓ Ver la página "Nosotros"                            │
│  ✓ Explorar el catálogo de cursos y filtrarlos         │
│  ✓ Agregar cursos al carrito (sesión temporal)         │
│  ✓ Enviar mensajes de contacto                         │
│  ✓ Usar el chatbot de IA                               │
│  ✓ Registrarse como nuevo usuario                      │
│  ✓ Iniciar sesión si ya tiene cuenta                   │
│                                                        │
│  No puede hacer:                                       │
│  ✗ Ver el checkout (redirige a login)                  │
│  ✗ Acceder a "Mi cuenta"                               │
│  ✗ Realizar pagos                                      │
│  ✗ Ver el panel de administración                      │
└────────────────────────────────────────────────────────┘
```

**Ejemplo de usuario real:** Un técnico en producción alimentaria de Huancayo que llega al sitio buscando capacitación en HACCP, navega los cursos, los agrega al carrito y luego se registra para completar la compra.

---

### Actor 2 — Estudiante (usuario autenticado)

```
┌────────────────────────────────────────────────────────┐
│  ESTUDIANTE                                            │
│  Perfil: Usuario registrado que ha iniciado sesión.    │
│          Puede ser profesional del sector alimentario, │
│          técnico, ingeniero o emprendedor.             │
│                                                        │
│  Puede hacer (todo lo del Visitante, más):             │
│  ✓ Acceder al checkout y completar el pago             │
│  ✓ Ver su historial de inscripciones                   │
│  ✓ Ver su progreso en cada curso                       │
│  ✓ Ver y actualizar su perfil personal                 │
│  ✓ Desbloquear logros según su actividad               │
│  ✓ Ver su inversión total acumulada                    │
│  ✓ Cerrar sesión de forma segura                       │
│                                                        │
│  No puede hacer:                                       │
│  ✗ Acceder al panel de administración                  │
│  ✗ Ver datos de otros usuarios                         │
│  ✗ Modificar el estado de sus inscripciones            │
│  ✗ Alterar roles de usuario                            │
└────────────────────────────────────────────────────────┘
```

**Ejemplo de usuario real:** Una supervisora de calidad de una planta de alimentos que ya pagó el curso de BPM y quiere revisar cuántos cursos lleva y cuánto ha invertido en su formación.

---

### Actor 3 — Administrador

```
┌────────────────────────────────────────────────────────┐
│  ADMINISTRADOR                                         │
│  Perfil: Usuario con el rol "administrador". General-  │
│          mente el equipo interno de JM y JS Alimentos  │
│          encargado de la operación del sitio.            │
│                                                        │
│  Puede hacer (todo lo del Estudiante, más):            │
│  ✓ Acceder al panel de administración (/admin)         │
│  ✓ Ver el dashboard con KPIs y gráficos                │
│  ✓ Gestionar cursos, módulos y materiales (CRUD)       │
│  ✓ Publicar/despublicar y duplicar cursos              │
│  ✓ Gestionar estudiantes e inscripciones               │
│  ✓ Gestionar ventas y cupones                          │
│  ✓ Gestionar roles, permisos y usuarios                │
│  ✓ Editar la configuración del sistema (settings)      │
│  ✓ Consultar los registros de auditoría                │
│  ✓ Gestionar los mensajes de contacto                  │
│                                                        │
│  Notas:                                                │
│  • El acceso a cada acción se valida por permiso.      │
│  • El antiguo flag is_admin se mantiene sincronizado   │
│    con el rol, por compatibilidad.                     │
└────────────────────────────────────────────────────────┘
```

**Ejemplo de usuario real:** El coordinador académico de JM y JS que revisa cada mañana los mensajes nuevos de contacto, responde consultas sobre cursos y monitorea cuántos estudiantes se inscribieron en la semana.

---

### Roles adicionales — Instructor y Soporte

Además de administrador y estudiante, el modelo de roles incluye dos perfiles administrativos acotados:

- **Instructor:** gestiona el contenido de sus propios cursos (módulos y materiales), sin acceso a la administración global de la plataforma.
- **Soporte:** accede únicamente a las áreas de soporte/operación habilitadas por sus permisos (por ejemplo, mensajes de contacto), sin permisos de gestión de cursos, ventas ni roles.

Los permisos efectivos de cada rol se definen en `database/seeders/RoleAndPermissionSeeder.php`.

---

### Resumen de permisos por actor

| Funcionalidad | Visitante | Estudiante | Administrador |
|---|:---:|:---:|:---:|
| Ver páginas públicas (inicio, nosotros, cursos, contacto) | ✓ | ✓ | ✓ |
| Usar el chatbot de IA | ✓ | ✓ | ✓ |
| Agregar cursos al carrito | ✓ | ✓ | ✓ |
| Enviar formulario de contacto | ✓ | ✓ | ✓ |
| Registrarse / Iniciar sesión | ✓ | — | — |
| Acceder al checkout | — | ✓ | ✓ |
| Realizar pagos | — | ✓ | ✓ |
| Ver "Mi cuenta" (cursos, perfil, logros) | — | ✓ | ✓ |
| Panel de administración | — | — | ✓ |
| Gestionar usuarios | — | — | ✓ |
| Gestionar mensajes de contacto | — | — | ✓ |
| Ver estadísticas globales | — | — | ✓ |

---

## 4. Alcance del Proyecto

### 4.1 Lo que incluye el sistema (dentro del alcance)

| Área | Funcionalidades incluidas |
|---|---|
| **Sitio público** | Páginas de inicio, nosotros, cursos (catálogo dinámico) y contacto con diseño responsivo completo |
| **Autenticación** | Registro, login, logout y sesiones seguras con control de acceso por roles y permisos (RBAC) |
| **Catálogo** | Catálogo dinámico administrado desde BD, con categorías, filtros por nivel/categoría/búsqueda, página de detalle por curso, precios en soles e información de certificación |
| **Gestión de cursos (LMS)** | CRUD de cursos, módulos y materiales; publicación/despublicación con validación de contenido; duplicación; tipos de material (video URL/subido, documento, presentación, texto enriquecido, recurso) con límites de archivo |
| **Aula y progreso** | Aula del estudiante con consumo de materiales, seguimiento de progreso por material y entrega protegida de archivos privados |
| **Comercio** | Carrito en sesión, checkout con validación de tarjeta, cupones de descuento, registro de ventas (`sales`/`sale_items`) e inscripciones automáticas |
| **Panel de estudiante** | Historial de inscripciones, progreso, estadísticas personales, perfil y sistema de logros |
| **Contacto** | Formulario asíncrono con campos dinámicos y almacenamiento en base de datos |
| **Administración** | Dashboard con KPIs y gráficos; gestión de cursos, estudiantes, ventas, cupones, roles, configuración y usuarios |
| **Seguridad y auditoría** | Roles/permisos, middleware de permisos, rate limiting (login y chatbot), cabeceras de seguridad y registro de auditoría |
| **IA** | Chatbot integrado con Google Gemini con system prompt especializado en la empresa |
| **Pagos** | Checkout simulado en operación, con la integración de **Stripe preparada** a nivel de infraestructura (paquete, configuración y servicio) |
| **Base de datos** | MySQL (XAMPP) en desarrollo/producción local; SQLite en memoria para el entorno de pruebas; cambios gestionados por migraciones versionadas |
| **Frontend** | CSS personalizado, React (chatbot), Tailwind CSS, Chart.js (gráficos), Quill (texto enriquecido) y SortableJS (reordenamiento); diseño mobile-first |
| **Pruebas** | Suite automatizada con PHPUnit (Feature + Unit), factories y seeder de datos demo, BD en memoria para tests |

---

### 4.2 Lo que NO incluye el sistema (fuera del alcance)

| Área | Descripción |
|---|---|
| **Cobro real con tarjeta** | El checkout procesa los pagos de forma simulada. La integración con Stripe está preparada (paquete `stripe/stripe-php`, `config/stripe.php` y `StripeService`), pero el cobro real y el webhook aún **no están activados** |
| **Sistema de correo electrónico** | No se envían correos de confirmación, recuperación de contraseña ni notificaciones por email (el mailer está en modo `log`/`array`) |
| **Recuperación de contraseña** | No existe el flujo de "olvidé mi contraseña" con envío de enlace al email |
| **Pagos recurrentes o suscripciones** | El modelo de negocio es pago único por curso, sin planes de membresía |
| **App móvil nativa** | La plataforma es web responsiva; no hay apps para iOS ni Android |
| **Integración con LMS externo** | No se conecta con Moodle, Canvas ni otras plataformas de gestión de aprendizaje |
| **Certificados digitales** | El sistema registra el progreso y la finalización de un curso (con el dato preparado para certificación), pero aún no genera ni emite certificados en PDF |
| **Múltiples idiomas** | La plataforma está diseñada exclusivamente en español |
| **Analítica externa** | El dashboard incluye KPIs y gráficos propios, pero no se integra Google Analytics, Hotjar ni herramientas de métricas externas |
| **Despliegue en nube** | El sistema está diseñado para entorno local (XAMPP con MySQL). No incluye configuración para AWS, DigitalOcean, Heroku, etc. |

---

### 4.3 Restricciones del proyecto

| Restricción | Detalle |
|---|---|
| **Tecnológica** | El sistema debe construirse con Laravel (PHP) como framework principal |
| **De datos** | La base de datos de desarrollo/producción local debe ser MySQL (XAMPP); el entorno de pruebas usa SQLite en memoria |
| **De entorno** | El sistema debe funcionar sobre XAMPP (Apache + PHP + MySQL) sin requerir Docker ni servicios adicionales |
| **De idioma** | Toda la interfaz, mensajes de error y documentación deben estar en español |
| **De pago** | El flujo de pago opera de forma simulada; el cobro real con Stripe queda preparado pero desactivado |
| **De IA** | La inteligencia artificial depende de un servicio externo (Google Gemini); su disponibilidad está sujeta a la cuota gratuita de la API |

---

### 4.4 Supuestos del proyecto

- Los usuarios tienen acceso a un navegador web moderno (Chrome 90+, Firefox 90+, Edge 90+).
- La empresa JM y JS Alimentos proporcionará su propia clave de API de Google AI Studio para el chatbot.
- El contenido de los cursos (videos, documentos, presentaciones y recursos) se gestiona y entrega **dentro de la plataforma** a través de los materiales de cada módulo.
- Un único administrador técnico será responsable de mantener la aplicación en el servidor XAMPP local.

---

*Documentación general — JM y JS Alimentos — Actualizada a junio de 2026 (plataforma LMS)*
