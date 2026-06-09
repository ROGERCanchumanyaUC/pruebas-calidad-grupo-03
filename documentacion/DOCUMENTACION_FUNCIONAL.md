# Documentación Funcional — JM y JS Alimentos
## Plataforma de Capacitación en Línea

---

## 1. Descripción General del Sistema

La plataforma **JM y JS Alimentos** es un sistema de e-learning especializado en la industria alimentaria peruana. Permite a profesionales del sector inscribirse en cursos de certificación (BPM, HACCP, ISO), gestionar sus pagos y acceder a su historial académico. La empresa está ubicada en Huancayo, Junín, Perú.

**Stack tecnológico:**
- Backend: Laravel 12 (PHP) con base de datos MySQL (XAMPP); SQLite en memoria para pruebas
- Frontend: Blade templates, CSS personalizado, JavaScript; React (chatbot), Chart.js (gráficos del dashboard), Quill (texto enriquecido) y SortableJS (reordenamiento)
- Fuente tipográfica: Poppins (Google Fonts)
- Hosting local: XAMPP

---

## 2. Flujo de Pantallas

### 2.1 Flujo de Usuario No Autenticado (Visitante)

```
[Inicio /]
    ├── [Nosotros /nosotros]
    ├── [Cursos /cursos]  (catálogo dinámico: filtros por nivel, categoría y búsqueda)
    │       ├── [Detalle de curso /cursos/{slug}]
    │       └── Agregar al carrito → [Checkout /checkout]
    │                                       ├── Aplicar cupón de descuento
    │                                       └── [Pago Éxito /pago/exito]
    ├── [Contacto /contacto]
    ├── [Iniciar Sesión /login]
    │       └── Login exitoso → [Mi Cuenta /mi-cuenta]
    └── [Registrarse /register]
            └── Registro exitoso → [Mi Cuenta /mi-cuenta]
```

### 2.2 Flujo de Usuario Autenticado (Estudiante)

```
[Mi Cuenta /mi-cuenta]
    ├── Tab: Mis Cursos     → Ver cursos inscritos con progreso
    ├── Tab: Mi Perfil      → Ver datos personales
    ├── Tab: Logros         → Ver insignias desbloqueadas
    ├── [Aula /mi-cuenta/cursos/{slug}] → Consumir módulos y materiales,
    │                                     marcar completados, ver progreso
    ├── [Cursos /cursos]    → Explorar y agregar nuevos cursos
    └── [Cerrar Sesión]     → Regresa a [Inicio /]
```

### 2.3 Flujo de Administrador

```
[Admin Dashboard /admin]   (KPIs + gráficos; acceso por permiso)
    ├── [Cursos /admin/courses]      → CRUD, publicar/despublicar, duplicar
    │       └── Módulos y materiales (reordenar, subir/enlazar contenido)
    ├── [Estudiantes /admin/students] → Ver, suspender, reactivar, reiniciar progreso
    ├── [Ventas /admin/sales]        → Listado y detalle de ventas
    ├── [Cupones /admin/coupons]     → CRUD de cupones de descuento
    ├── [Roles /admin/roles]         → Roles y permisos asignados
    ├── [Usuarios /admin/users]      → Gestión y asignación de roles
    ├── [Settings /admin/settings]   → Configuración del sistema
    ├── [Auditoría /admin/audit]     → Registro de operaciones con filtros
    └── [Contactos /admin/contacts]  → Ver, marcar como leído, eliminar
```

### 2.4 Flujo de Compra (Carrito → Pago)

```
[Cursos /cursos]
    └── Clic "Agregar al carrito"
            ↓ (AJAX — sin recargar la página)
        Badge del carrito actualizado en navbar
            ↓
    [Checkout /checkout]
        ├── Ver resumen del carrito
        ├── Seleccionar método de pago
        ├── Ingresar datos de tarjeta
        └── Confirmar pago
                ↓ (POST /pago)
            Se crean Enrollments con estado "pagado"
            Carrito se vacía de la sesión
                ↓
    [Pago Éxito /pago/exito]
        └── Ver cursos en [Mi Cuenta /mi-cuenta]
```

---

## 3. Diseño de Cada Página

### 3.1 Inicio (`/`)

**Secciones:**

| Sección | Descripción |
|---|---|
| Hero | Fondo animado con degradado azul, título principal, subtítulo y dos CTA (Ver Cursos / Registrarse) |
| Barra de confianza | Íconos con texto: Certificaciones reconocidas, Instructores expertos, Soporte continuo, Acceso de por vida |
| Cursos destacados | Tabs filtrables (Básico / Intermedio / Avanzado) con tarjetas de curso |
| ¿Por qué elegirnos? | Cuatro tarjetas con ícono y texto descriptivo |
| Proceso en 3 pasos | Numerado: Regístrate → Elige tu curso → Obtén tu certificado |
| Testimonios | Tarjetas con foto, nombre, cargo y cita de profesionales del sector |
| CTA final | Banner con llamada a registrarse |

**Paleta aplicada:** Azul principal `#0284c7`, degradados de azul oscuro `#0f2a5e`, blanco para texto sobre fondos oscuros.

---

### 3.2 Nosotros (`/nosotros`)

**Secciones:**

| Sección | Descripción |
|---|---|
| Historia | Texto narrativo sobre el origen y trayectoria de la empresa |
| Metodología | Tres tarjetas: Diagnóstico → Plan → Implementación |
| Valores (Bento layout) | Cuatro bloques: Calidad (grande), Claridad, Cercanía, Mejora |
| Misión y Visión | Dos tarjetas lado a lado con ícono y texto |
| CTA | Invitación a explorar los cursos |

**Layout especial:** El bloque de valores usa un *bento grid* asimétrico donde "Calidad" ocupa el doble de espacio vertical, jerarquizando el valor más importante de la empresa.

---

### 3.3 Cursos (`/cursos`)

**Secciones:**

| Sección | Descripción |
|---|---|
| Hero | Tarjeta destacada con el curso principal, nivel, duración y precio |
| Catálogo filtrable | Grid dinámico de cursos publicados, con filtros por nivel, categoría y búsqueda |
| Indicador de scroll | Flecha animada que invita a desplazarse |

**Cursos disponibles:**

| Curso | Nivel | Precio (S/) |
|---|---|---|
| BPM en Industria Alimentaria | Básico | 350 |
| Procesamiento de Alimentos Artesanales | Básico | 280 |
| Pasteurización y Tratamiento Térmico | Básico | 290 |
| Gestión de Calidad ISO 9001 | Intermedio | 450 |
| Elaboración de Alimentos Fermentados | Intermedio | 320 |
| Análisis Fisicoquímico de Alimentos | Intermedio | 360 |
| Control Microbiológico en Alimentos | Avanzado | 380 |
| HACCP en Plantas de Alimentos | Avanzado | 420 |
| Gestión de Inocuidad Alimentaria ISO 22000 | Avanzado | 480 |

Cada tarjeta muestra: imagen representativa, badge de nivel con color (verde/amarillo/rojo), duración, formato (virtual), si incluye certificado, precio y botón de agregar al carrito.

---

### 3.4 Contacto (`/contacto`)

**Secciones:**

| Sección | Descripción |
|---|---|
| Información de contacto | Tarjeta con dirección (Huancayo), WhatsApp, correo electrónico y horario de atención |
| Formulario de contacto | Campos dinámicos según el tema seleccionado |

**Campos del formulario:**

- Nombre completo (requerido)
- Correo electrónico (requerido)
- Tema de consulta: dropdown con opciones (Cursos, Consultoría, Certificación, Otro)
- Selección de curso (aparece condicionalmente si el tema es "Cursos")
- Mensaje (requerido)

El formulario se envía via AJAX sin recargar la página y muestra una notificación toast de éxito o error.

---

### 3.5 Checkout (`/checkout`)

**Secciones:**

| Sección | Descripción |
|---|---|
| Header fijo | Logo, badge de seguridad SSL, botón cerrar |
| Métodos de pago | Tabs: Tarjeta de crédito/débito / Billeteras digitales |
| Formulario de tarjeta | Nombre en tarjeta, número, fecha de expiración, CVC |
| Resumen del carrito | Lista scrolleable de cursos, subtotal, IGV (18%), total |
| Badges de seguridad | SSL Seguro, PCI Compliant, Pago Protegido |

---

### 3.6 Pago Exitoso (`/pago/exito`)

Pantalla minimalista de confirmación con:
- Ícono de verificación animado (checkmark)
- Mensaje de éxito
- Dos botones: "Ver mis cursos" → `/mi-cuenta` y "Explorar más cursos" → `/cursos`

---

### 3.7 Iniciar Sesión (`/login`)

Formulario centrado con:
- Campo de correo electrónico
- Campo de contraseña
- Checkbox "Recuérdame"
- Botón de envío
- Enlace a registro
- Mensajes de error en línea para credenciales inválidas

---

### 3.8 Registrarse (`/register`)

Formulario con:
- Nombre completo (requerido)
- Correo electrónico (requerido)
- DNI o RUC (opcional)
- Teléfono (opcional)
- Contraseña (requerido)
- Confirmación de contraseña (requerido)
- Mensajes de validación por campo

---

### 3.9 Mi Cuenta (`/mi-cuenta`) — Solo usuarios autenticados

**Estructura:**

| Sección | Descripción |
|---|---|
| Hero banner | Avatar del usuario, nombre, correo, badges de estado |
| Estadísticas | Cursos inscritos, pagados, completados, inversión total (S/) |
| Tab: Mis Cursos | Grid de cursos con imagen, nivel, estado, barra de progreso, precio y fecha |
| Tab: Mi Perfil | Tabla con datos: nombre, correo, DNI, teléfono, miembro desde, estado de cuenta |
| Tab: Logros | Cuatro insignias desbloqueables con condición de desbloqueo |
| Sidebar | Acciones rápidas, resumen del perfil, métricas de progreso |

**Sistema de logros:**

| Insignia | Condición |
|---|---|
| Primer Paso | Primera inscripción en un curso |
| Inversión en ti | Primer pago realizado |
| Aprendiz Dedicado | 3 o más cursos inscritos |
| Certificado | Primer curso completado |

---

### 3.10 Admin Dashboard (`/admin`) — Solo administradores

**Secciones:**

| Sección | Descripción |
|---|---|
| Banner de bienvenida | Saludo al administrador con fecha |
| Tarjetas de estadísticas | Total de usuarios, admins, nuevos (semanal/mensual) |
| Usuarios recientes | Tabla con últimos 8 registros |
| Estadísticas de contactos | Total, no leídos, recientes |
| Estadísticas de inscripciones | Total inscritos, pagados, completados, ingresos |
| Sidebar de navegación | Accesos a Usuarios y Contactos |

---

### 3.11 Gestión de Usuarios (`/admin/users`)

Lista de todos los usuarios con:
- Avatar generado, nombre, correo y badge de rol
- Gestión de roles del usuario (asignación de rol; el flag is_admin se sincroniza con el rol)

---

### 3.12 Gestión de Contactos (`/admin/contacts`)

Lista de mensajes del formulario de contacto con:
- Nombre del remitente, tema, fecha
- Badge visual para mensajes no leídos
- Botón para marcar como leído
- Botón para eliminar el mensaje

---

## 4. Justificación del Diseño

### 4.1 Paleta de colores — Azul y blanco

**Decisión:** Se eligió azul como color principal (`#0284c7`, `#1e40af`, `#0f2a5e`) con fondos blancos y gris claro.

**Justificación:**
- El azul transmite **confianza, profesionalismo y autoridad técnica**, valores clave para una empresa que certifica a profesionales de la industria alimentaria.
- En el contexto regulatorio (BPM, HACCP, ISO), el usuario espera seriedad institucional, no creatividad visual.
- El blanco como fondo secundario garantiza **legibilidad máxima** para contenido denso (listas de cursos, formularios, tablas de datos).

---

### 4.2 Tipografía — Poppins

**Decisión:** Una sola fuente Poppins en distintos pesos (400, 600, 700).

**Justificación:**
- Poppins es **geométrica y moderna**, proyecta tecnología sin ser fría.
- Al ser una fuente sin serif, es más legible en pantalla a tamaños pequeños, importante para interfaces con mucho texto técnico.
- Usar una sola familia tipográfica mantiene **coherencia visual** sin añadir complejidad de carga.

---

### 4.3 Navbar fija con badge de carrito

**Decisión:** La barra de navegación permanece visible al hacer scroll y muestra el conteo del carrito en tiempo real.

**Justificación:**
- En una tienda de cursos, el usuario necesita **acceso permanente al carrito** sin perder su posición en la página.
- El badge numérico reduce la fricción: el usuario sabe cuántos cursos ha seleccionado sin necesidad de navegar al checkout.
- La posición fija es un estándar reconocido en e-commerce que el usuario ya conoce (Amazon, Mercado Libre).

---

### 4.4 Filtros por nivel en la página de Cursos

**Decisión:** Tabs filtrables (Básico / Intermedio / Avanzado) en lugar de mostrar todos los cursos a la vez.

**Justificación:**
- Con un catálogo de varios cursos, mostrarlos todos simultáneamente crea **sobrecarga cognitiva**.
- Los profesionales de la industria alimentaria tienen distintos niveles de experiencia; el filtro les permite ir directo a lo relevante.
- Los tabs son más rápidos que un dropdown y visualmente más claros que un sidebar de filtros para un catálogo de este tamaño.

---

### 4.5 Sistema de tabs en Mi Cuenta

**Decisión:** Tres tabs (Mis Cursos, Mi Perfil, Logros) en lugar de una página larga.

**Justificación:**
- Separa contextos distintos — el usuario rara vez necesita ver su perfil y sus cursos al mismo tiempo.
- Reduce el tiempo de carga visual: cada tab muestra solo la información relevante al momento.
- El patrón de tabs es familiar para el usuario de plataformas como Udemy o Coursera.

---

### 4.6 Formulario de contacto dinámico

**Decisión:** El campo "Curso específico" aparece condicionalmente cuando el tema es "Cursos".

**Justificación:**
- Mostrar campos irrelevantes aumenta la **tasa de abandono del formulario**.
- La aparición progresiva de campos guía al usuario paso a paso sin abrumarlo.
- Mejora la calidad de los datos recibidos por el administrador: los mensajes sobre cursos siempre incluirán el curso específico.

---

### 4.7 Checkout en página dedicada con header propio

**Decisión:** El checkout tiene un header diferente al resto del sitio (sin navbar principal, con badge de seguridad).

**Justificación:**
- Es una práctica estándar de UX para **reducir distracciones** en el momento de pago.
- El badge SSL y PCI visible en el header aumenta la **percepción de seguridad** en el momento más sensible del flujo.
- Eliminar la navegación evita que el usuario abandone el checkout por accidente.

---

### 4.8 Bento grid en Nosotros

**Decisión:** Layout asimétrico para la sección de valores, con "Calidad" ocupando mayor espacio.

**Justificación:**
- El bento grid rompe la monotonía visual de las cuadrículas uniformes.
- La jerarquía visual refuerza el mensaje: **Calidad es el valor principal** de la empresa.
- Es un patrón de diseño contemporáneo que proyecta modernidad sin sacrificar claridad.

---

### 4.9 Sistema de logros (gamificación)

**Decisión:** Insignias desbloqueables en la cuenta del estudiante.

**Justificación:**
- La gamificación aumenta el **engagement y la retención** del usuario.
- Motiva comportamientos deseables: inscribirse al primer curso, completar pagos, tomar más cursos.
- En formación profesional, los logros visuales complementan la validación formal (certificados) y generan un sentido de progreso continuo.

---

### 4.10 Toast notifications en lugar de alerts del navegador

**Decisión:** Sistema de notificaciones tipo toast en la esquina de la pantalla.

**Justificación:**
- Las alertas nativas del navegador (`alert()`) **bloquean la interfaz** y tienen apariencia de sistema operativo, rompiendo la identidad visual.
- Los toasts son no intrusivos: informan al usuario sin interrumpir su flujo de trabajo.
- Permiten personalizar color, ícono y duración según el tipo de mensaje (éxito, error, advertencia).

---

## 5. Procesos Automatizados de la Plataforma

### 5.1 Gestión del Carrito de Compras (Sesión PHP)

**Mecanismo:** `CartController` + sesión de Laravel

**Descripción:** Cuando el usuario hace clic en "Agregar al carrito", se envía una solicitud AJAX al endpoint `/carrito/agregar`. El controlador valida que el curso no esté ya en el carrito (evita duplicados), lo agrega al array de la sesión y devuelve el nuevo conteo. El badge del carrito en el navbar se actualiza automáticamente sin recargar la página.

Al visitar `/checkout`, el sistema lee la sesión y construye el resumen del carrito con subtotal, IGV (18%) y total calculados dinámicamente.

**Validaciones automáticas:**
- Prevención de duplicados en el carrito
- Cálculo automático de IGV al 18%
- Estado de carrito vacío con redirección

---

### 5.2 Creación Automática de Inscripciones al Pagar

**Mecanismo:** `PaymentController@process` → Modelo `Enrollment`

**Descripción:** Al confirmar el pago en el checkout, el sistema itera sobre cada curso en el carrito de sesión y crea automáticamente un registro en la tabla `enrollments` con:
- `user_id`: usuario autenticado
- `course_name`: nombre del curso
- `level`: nivel del curso
- `price`: precio
- `status`: `"pagado"`
- `enrolled_at`: timestamp actual

Inmediatamente después, el carrito se vacía de la sesión y el usuario es redirigido a la página de éxito.

---

### 5.3 Cálculo Automático de Estadísticas en Mi Cuenta

**Mecanismo:** `MiCuentaController` + relaciones Eloquent

**Descripción:** Al cargar la página `/mi-cuenta`, el controlador calcula automáticamente en tiempo real:
- Total de cursos inscritos
- Total de cursos con estado "pagado"
- Total de cursos con estado "completado"
- Inversión total acumulada (suma de precios de inscripciones pagadas)

Estos valores se pasan a la vista sin almacenarse por separado, garantizando que siempre reflejen el estado actual.

---

### 5.4 Desbloqueo Automático de Logros

**Mecanismo:** Lógica en la vista `mi-cuenta.blade.php` con datos del controlador

**Descripción:** El sistema evalúa condiciones automáticamente al cargar la cuenta:

| Logro | Condición evaluada |
|---|---|
| Primer Paso | `count($enrollments) >= 1` |
| Inversión en ti | `count($pagados) >= 1` |
| Aprendiz Dedicado | `count($enrollments) >= 3` |
| Certificado | `count($completados) >= 1` |

Los logros no desbloqueados se muestran en escala de grises; los desbloqueados se muestran en color con su ícono.

---

### 5.5 Contador de Mensajes No Leídos en Admin

**Mecanismo:** `AdminMiddleware` + consulta a tabla `contacts`

**Descripción:** El sidebar del panel de administración muestra automáticamente el conteo de mensajes no leídos (`leido = false`) como badge numérico. Este valor se recalcula en cada carga de página, sin almacenamiento en caché, garantizando que el administrador siempre vea el número actualizado.

---

### 5.6 Formulario de Contacto con Campos Condicionales

**Mecanismo:** JavaScript en `contacto.blade.php` + listener en el select de tema

**Descripción:** Al cambiar el valor del dropdown "Tema de consulta", un listener de JavaScript evalúa si el valor seleccionado es `"cursos"`. Si es así, muestra el campo adicional de selección de curso específico con animación de aparición (display toggle). Si el usuario cambia a otro tema, el campo se oculta automáticamente y se limpia su valor para evitar envíos de datos vacíos.

---

### 5.7 Envío Asíncrono del Formulario de Contacto

**Mecanismo:** Fetch API → `ContactController@store`

**Descripción:** El formulario de contacto no hace submit tradicional. JavaScript intercepta el evento `submit`, serializa los datos del formulario y los envía via `fetch()` al endpoint `POST /contacto`. El controlador valida los campos, guarda el registro en la base de datos con `leido = false` y devuelve una respuesta JSON. El frontend entonces muestra un toast de éxito o error según la respuesta, sin recargar la página.

---

### 5.8 Toggle de Estado de Administrador

**Mecanismo:** asignación de roles desde `/admin/users` y `/admin/roles` (`UserController` / `RoleController`), validada por permiso `users.manage` / `roles.manage`

**Descripción:** Desde el panel admin se gestionan los **roles** de cada usuario (administrador, instructor, soporte, estudiante). El acceso ya no depende de un único flag: cada acción se valida por permiso mediante `PermissionMiddleware`. El método `assignRole()` mantiene el flag `is_admin` **sincronizado** con el rol por compatibilidad, y se conservan las protecciones para no dejar al sistema sin administradores.

---

### 5.9 Middleware de Control de Acceso

**Mecanismo:** `AdminMiddleware` registrado en las rutas del grupo `/admin`

**Descripción:** Antes de ejecutar cualquier controlador del panel admin, el middleware verifica que:
1. El usuario esté autenticado
2. El usuario tenga el permiso requerido para la acción (RBAC); el rol "administrador" los concede todos

Si alguna condición falla, redirige automáticamente al inicio con un mensaje de error. Esto protege todas las rutas administrativas sin necesidad de validación manual en cada controlador.

---

## 6. Modelos de Base de Datos

### Tabla: `users`
| Campo | Tipo | Descripción |
|---|---|---|
| id | integer | Clave primaria |
| name | string | Nombre completo |
| email | string unique | Correo electrónico |
| password | string | Hash de contraseña |
| dni | string nullable | DNI o RUC |
| phone | string nullable | Teléfono de contacto |
| is_admin | boolean | Flag de administrador heredado, sincronizado con el rol (default: false) |
| roles | relación | Roles asignados al usuario vía pivote `role_user` (RBAC) |
| created_at / updated_at | timestamps | Auditoría |

### Tabla: `enrollments`
| Campo | Tipo | Descripción |
|---|---|---|
| id | integer | Clave primaria |
| user_id | foreign key | Referencia a users |
| course_id | foreign key | Referencia a courses (reemplaza el antiguo `course_name`/`level` de texto) |
| status | enum | Estado: pendiente / activo / suspendido / completado |
| progress | decimal | Porcentaje de avance del curso |
| last_accessed_at | timestamp | Última vez que el estudiante accedió |
| total_time_minutes | integer | Tiempo acumulado de estudio |
| completed_at | timestamp | Fecha de finalización (si aplica) |
| enrolled_at | timestamp | Fecha de inscripción |

### Tabla: `contacts`
| Campo | Tipo | Descripción |
|---|---|---|
| id | integer | Clave primaria |
| name | string | Nombre del remitente |
| email | string | Correo del remitente |
| topic | string | Tema de consulta |
| course | string nullable | Curso específico (si aplica) |
| message | text | Contenido del mensaje |
| leido | boolean | Estado de lectura (default: false) |
| created_at / updated_at | timestamps | Auditoría |

---

### Otras tablas del LMS

Además de las anteriores, el sistema incorpora las tablas del LMS: `roles`, `permissions`, `role_user`, `role_permission` (RBAC); `categories`, `courses`, `course_modules`, `course_materials`, `course_material_user` (catálogo y contenido); `coupons`, `sales`, `sale_items` (comercio); `audit_logs` y `settings` (operación). El detalle de su esquema está en `IMPLEMENTACION.md`.

---

## 6. Pantallas del LMS (etapa 2)

Estas pantallas se incorporaron al evolucionar la plataforma a un LMS completo.

### 6.1 Catálogo dinámico (`/cursos`)

El catálogo se sirve desde la base de datos (`CourseController@index`) mostrando solo cursos **publicados**. Permite filtrar por **nivel**, por **categoría** y por **término de búsqueda**. Cada tarjeta enlaza a la página de detalle del curso.

### 6.2 Detalle de curso (`/cursos/{slug}`)

Página dedicada por curso (`CourseController@show`) con su descripción, información comercial (precio, nivel, duración, certificación) y la estructura de módulos y materiales. Los cursos en **borrador** solo son visibles para administradores; un visitante que intente abrir un curso no publicado no puede verlo.

### 6.3 Aula virtual del estudiante (`/mi-cuenta/cursos/{slug}`)

Accesible solo para estudiantes con inscripción **activa** (`StudentCourseController@show`). Presenta los módulos del curso con su contenido (video por URL/embed seguro o subido, documentos, presentaciones, texto enriquecido y recursos descargables). El estudiante puede **marcar materiales como completados**, lo que actualiza su **progreso** y su última fecha de acceso. Los archivos privados se sirven mediante un endpoint controlado (`serveFile`) que valida la autorización antes de entregar el archivo.

### 6.4 Gestión de cursos, módulos y materiales (admin)

- **Cursos** (`/admin/courses`): tabla paginada con filtros; formularios de creación/edición con pestañas (General, Comercial, SEO); publicar/despublicar (con validación de contenido mínimo) y duplicar.
- **Módulos**: CRUD por curso y **reordenamiento por arrastrar y soltar** (SortableJS) que persiste el orden.
- **Materiales**: CRUD por módulo con **formulario dinámico según el tipo** (video, documento, presentación, texto enriquecido con Quill, recurso). Validación por extensión, MIME y tamaño según `config/lms.php`, y limpieza de archivos huérfanos al reemplazar o eliminar.

### 6.5 Estudiantes, ventas y cupones (admin)

- **Estudiantes** (`/admin/students`): listado con progreso; perfil con cursos e inscripciones; acciones de **suspender, reactivar y reiniciar progreso** (auditadas).
- **Ventas** (`/admin/sales`): listado y detalle de las ventas registradas (`sales`/`sale_items`).
- **Cupones** (`/admin/coupons`): CRUD con código, tipo, valor, vigencia, límite de usos y estado; el descuento se valida en el checkout.

### 6.6 Roles, configuración y auditoría (admin)

- **Roles** (`/admin/roles`): roles con sus permisos y usuarios asignados.
- **Settings** (`/admin/settings`): parámetros del sistema (empresa, contacto, etc.), leídos mediante el helper `setting()` con caché.
- **Auditoría** (`/admin/audit`): registro de operaciones sensibles (usuario, acción, entidad, valores previos/nuevos, IP, user-agent) con filtros.

### 6.7 Dashboard analítico (admin)

`/admin` muestra KPIs reales (cursos, estudiantes, ventas e ingresos, tasa de finalización) y **gráficos** de ventas e inscripciones mensuales (Chart.js), con caché de métricas que se invalida al registrarse una venta.

---

*Documentación funcional — JM y JS Alimentos — Actualizada a junio de 2026 (plataforma LMS)*
