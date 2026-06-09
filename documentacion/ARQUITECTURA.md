# Arquitectura del Proyecto — JM y JS Alimentos

---

## 1. Estructura de Carpetas y Archivos

El proyecto está construido con **Laravel 12**, que impone una estructura de directorios estándar y bien definida. A continuación se detalla cada carpeta con su responsabilidad dentro del sistema.

```
boceto/
│
├── app/                          ← Núcleo de la aplicación
│   ├── Helpers/
│   │   └── helpers.php           (helpers globales, p. ej. setting())
│   ├── Http/
│   │   ├── Controllers/          ← Lógica de cada pantalla
│   │   │   ├── Controller.php        (clase base abstracta de Laravel)
│   │   │   ├── AuthController.php    (login, registro, logout)
│   │   │   ├── CartController.php    (carrito en sesión + cupones)
│   │   │   ├── ContactController.php (formulario de contacto)
│   │   │   ├── CourseController.php  (catálogo público y detalle)
│   │   │   ├── StudentCourseController.php (aula, progreso, archivos)
│   │   │   ├── EnrollmentController.php (inscripciones)
│   │   │   ├── MiCuentaController.php   (panel del estudiante)
│   │   │   ├── PaymentController.php    (checkout: ventas e inscripciones)
│   │   │   ├── Admin/
│   │   │   │   ├── DashboardController.php  (KPIs y gráficos)
│   │   │   │   ├── CourseController.php     (CRUD de cursos)
│   │   │   │   ├── CourseModuleController.php   (módulos)
│   │   │   │   ├── CourseMaterialController.php (materiales)
│   │   │   │   ├── StudentController.php    (gestión de estudiantes)
│   │   │   │   ├── SaleController.php       (ventas)
│   │   │   │   ├── CouponController.php     (cupones)
│   │   │   │   ├── RoleController.php       (roles y permisos)
│   │   │   │   ├── SettingController.php    (configuración)
│   │   │   │   ├── AuditController.php      (registros de auditoría)
│   │   │   │   ├── UserController.php       (usuarios)
│   │   │   │   └── ContactsController.php   (mensajes)
│   │   │   └── Api/
│   │   │       └── ChatController.php       (chatbot IA con Gemini)
│   │   ├── Middleware/
│   │   │   ├── AdminMiddleware.php       (compatibilidad; usa isAdmin())
│   │   │   ├── RoleMiddleware.php        (acceso por rol)
│   │   │   ├── PermissionMiddleware.php  (acceso por permiso)
│   │   │   └── SecurityHeadersMiddleware.php (cabeceras de seguridad)
│   │   └── Requests/
│   │       └── Admin/               ← Form Requests de validación
│   │           ├── StoreCourseRequest.php / UpdateCourseRequest.php
│   │           ├── StoreCourseModuleRequest.php / UpdateCourseModuleRequest.php
│   │           └── StoreCourseMaterialRequest.php / UpdateCourseMaterialRequest.php
│   ├── Models/                      ← Modelos Eloquent
│   │   ├── User.php  Role.php  Permission.php
│   │   ├── Category.php  Course.php  CourseModule.php  CourseMaterial.php
│   │   ├── Enrollment.php  Coupon.php  Sale.php  SaleItem.php
│   │   ├── AuditLog.php  Setting.php
│   │   └── Contact.php
│   ├── Services/                    ← Lógica de negocio reutilizable
│   │   ├── AuditService.php          (registro de auditoría)
│   │   ├── CoursePublishingService.php (reglas de publicación)
│   │   ├── StripeService.php         (integración de pago, preparada)
│   │   └── VideoEmbedService.php     (embed seguro de YouTube/Vimeo)
│   └── Providers/
│       └── AppServiceProvider.php
│
├── bootstrap/
│   ├── app.php                   ← Configuración de Laravel 12 (alias de middleware)
│   └── providers.php
│
├── config/                       ← Configuración del sistema
│   ├── app.php  auth.php  session.php  cache.php  queue.php  mail.php
│   ├── database.php              (conexión a MySQL)
│   ├── services.php              (claves de Gemini y Stripe)
│   ├── lms.php                   (límites de archivos y rutas de materiales)
│   └── stripe.php                (claves y webhook de Stripe)
│
├── database/
│   ├── migrations/               ← Historial de cambios en la BD
│   │   ├── 0001_01_01_* (users, cache, jobs)
│   │   ├── 2026_05_06_* (is_admin, contacts, enrollments, dni/phone)
│   │   └── 2026_06_07_* / 2026_06_08_*  (roles y permisos, categories,
│   │        courses, course_modules, course_materials, enrollments
│   │        recreada, sales y coupons, audit_logs, settings,
│   │        course_material_user)
│   ├── factories/                ← Factories de todos los modelos del LMS
│   │   ├── UserFactory.php  CategoryFactory.php  CourseFactory.php
│   │   ├── CourseModuleFactory.php  CourseMaterialFactory.php
│   │   ├── EnrollmentFactory.php  SaleFactory.php  SaleItemFactory.php
│   │   └── CouponFactory.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── RoleAndPermissionSeeder.php  SettingSeeder.php
│       ├── CourseSeeder.php  DemoLmsSeeder.php
│
├── public/                       ← Único directorio expuesto al navegador
│   ├── index.php                 (punto de entrada HTTP)
│   ├── css/site.css              (hoja de estilos principal)
│   ├── img/                      (imágenes estáticas)
│   ├── storage/                  (enlace simbólico a archivos públicos)
│   └── build/                    (assets compilados por Vite)
│
├── resources/
│   ├── js/
│   │   ├── app.jsx               (punto de entrada de React)
│   │   └── components/           (componentes React, p. ej. el chatbot)
│   └── views/                    ← Plantillas Blade
│       ├── layouts/              (app.blade.php, admin.blade.php)
│       ├── auth/                 (login, register, inscripcion)
│       ├── admin/
│       │   ├── dashboard.blade.php  users.blade.php  contacts.blade.php
│       │   ├── courses/  (index, create, edit)
│       │   ├── coupons/  (index, create, edit)
│       │   ├── sales/    (index, show)
│       │   ├── students/ (index, show)
│       │   ├── roles/    (index, show)
│       │   ├── settings/ (index)
│       │   ├── audit/    (index)
│       │   └── users/    (edit)
│       ├── student/
│       │   └── aula.blade.php    (aula virtual del estudiante)
│       ├── inicio.blade.php  nosotros.blade.php  contacto.blade.php
│       ├── cursos.blade.php  curso-detalle.blade.php
│       ├── mi-cuenta.blade.php  checkout.blade.php  pago-exito.blade.php
│
├── routes/
│   ├── web.php                   ← Rutas del sitio web (HTML)
│   ├── api.php                   ← Rutas de la API (JSON, chatbot)
│   └── console.php
│
├── storage/                      ← Archivos en tiempo de ejecución
│   ├── app/private/materials/    (materiales privados de cursos)
│   ├── app/public/               (archivos públicos enlazados)
│   ├── framework/                (caché, sesiones, vistas compiladas)
│   └── logs/
│
├── tests/
│   ├── Feature/                  (PublicCourseCatalog, AdminCourseCrud,
│   │                              AdminCourseMaterial, AdminSalesAndCoupons,
│   │                              AdminDashboardAnalytics, AdminSecurityAndRoles,
│   │                              PermissionMiddleware, StudentCourseAccess,
│   │                              LmsReleaseReadiness, ...)
│   └── Unit/                     (CoursePublishingService, LmsRelationships,
│                                  VideoEmbedService, ...)
│
├── .env / .env.example           ← Variables de entorno
├── artisan                       ← CLI de Laravel
├── composer.json                 (dependencias PHP, incl. stripe/stripe-php)
├── package.json                  (dependencias JS, incl. chart.js, quill, sortablejs)
└── vite.config.js                (configuración del bundler)
```

---

## 2. Paradigmas Utilizados: MVC, CDD y SDD

Este proyecto combina tres paradigmas complementarios: **MVC** como arquitectura base del backend, **CDD** (Component-Driven Development) para el frontend, y **SDD** (Separation of Domains Design) como principio organizativo entre capas.

---

### 2.1 MVC — Model-View-Controller

**¿Qué es?**
MVC es el patrón arquitectónico central de Laravel. Divide la aplicación en tres capas con responsabilidades distintas e independientes:

| Capa | Responsabilidad | En este proyecto |
|---|---|---|
| **Model** | Representa los datos y las reglas de negocio | `User`, `Enrollment`, `Contact` |
| **View** | Presenta los datos al usuario | Archivos `.blade.php` en `resources/views/` |
| **Controller** | Recibe peticiones, coordina Model y View | Archivos en `app/Http/Controllers/` |

**Flujo de una solicitud HTTP bajo MVC:**

```
Navegador
    │
    ▼
[routes/web.php]              ← El Router recibe la URL y la asigna a un Controller
    │
    ▼
[Controller]                  ← Procesa la lógica, consulta el Model si es necesario
    │
    ▼
[Model / Eloquent ORM]        ← Interactúa con la base de datos MySQL
    │
    ▼
[Controller → View]           ← Pasa los datos al archivo Blade correspondiente
    │
    ▼
[Blade Template → HTML]       ← Se renderiza y se envía al navegador
```

**Ejemplo concreto — Página "Mi Cuenta":**

```
GET /mi-cuenta
    │
    ▼
routes/web.php → Route::get('/mi-cuenta', [MiCuentaController::class, 'index'])
    │
    ▼
MiCuentaController@index()
    ├── $user = auth()->user()
    ├── $enrollments = $user->enrollments()->get()
    └── return view('mi-cuenta', compact('user', 'enrollments'))
    │
    ▼
resources/views/mi-cuenta.blade.php
    └── Renderiza la vista con los datos del usuario y sus inscripciones
```

---

### 2.2 CDD — Component-Driven Development (Desarrollo Basado en Componentes)

**¿Qué es?**
CDD es el enfoque de construir interfaces de usuario dividiéndolas en **componentes reutilizables e independientes**, desde los más pequeños (botones, badges) hasta los más grandes (layouts completos). Cada componente encapsula su estructura, estilo y comportamiento.

En este proyecto se aplica en **dos niveles**:

#### Nivel 1: Blade Layouts (Componentes de servidor)

Las vistas no se escriben desde cero en cada página. En su lugar, todas heredan de un **layout base** que contiene los elementos comunes:

```
layouts/app.blade.php
    ├── <head> (meta, CSS, fuentes, Vite assets)
    ├── <nav> (navbar con logo, links, carrito, avatar de usuario)
    ├── @yield('content')   ← Cada página inyecta su contenido aquí
    └── <footer> + scripts JS
```

Cada página individual extiende este layout y solo define su contenido propio:

```blade
{{-- cursos.blade.php --}}
@extends('layouts.app')

@section('content')
    {{-- Solo el contenido exclusivo de la página de cursos --}}
@endsection
```

Esto significa que la navbar, el footer, los estilos base y el badge del carrito se definen **una sola vez** y se reutilizan en todas las páginas automáticamente.

El panel admin tiene su propio layout base:

```
layouts/admin.blade.php
    ├── Sidebar de navegación admin
    ├── @yield('content')
    └── Scripts del panel
```

#### Nivel 2: Componentes React (Componentes de cliente)

El chatbot de IA está implementado como un **componente React** independiente en `resources/js/components/`. React permite construir UIs reactivas que se actualizan sin recargar la página, manteniendo el principio CDD en el frontend.

```
resources/js/
    ├── app.jsx               ← Monta los componentes React en el DOM
    └── components/
        └── [ChatBot.jsx]     ← Componente del asistente de IA
```

El componente del chatbot:
- Es autocontenido (tiene su propio estado, lógica y presentación)
- Se monta en un `<div>` específico del layout sin afectar el resto
- Se comunica con el backend via `POST /api/chat` de forma asíncrona

#### Beneficios del CDD en este proyecto

| Problema sin CDD | Solución con CDD |
|---|---|
| Cambiar el logo requiere editar 12 archivos | Se edita solo `layouts/app.blade.php` |
| La navbar tiene bugs distintos en cada página | La navbar es un único bloque de código |
| Agregar una nueva página requiere reescribir el HTML base | Solo se crea el archivo y se extiende el layout |
| El chatbot estaría acoplado al HTML de la página | El componente React es independiente y portátil |

---

### 2.3 SDD — Separation of Domains Design (Separación por Dominios)

**¿Qué es?**
SDD es el principio de organizar el código **por dominio funcional** en lugar de por tipo técnico. Cada dominio agrupa todo lo que le concierne: sus rutas, su controlador, sus vistas y sus datos.

En este proyecto se identifican **cuatro dominios claramente separados**:

```
┌─────────────────────────────────────────────────────┐
│  DOMINIO PÚBLICO                                    │
│  Rutas: /, /nosotros, /cursos, /contacto            │
│  Vistas: inicio, nosotros, cursos, contacto         │
│  Sin autenticación requerida                        │
└─────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────┐
│  DOMINIO DE AUTENTICACIÓN                           │
│  Rutas: /login, /register                           │
│  Controller: AuthController                         │
│  Vistas: auth/login, auth/register                  │
│  Middleware: guest (solo para no autenticados)      │
└─────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────┐
│  DOMINIO DEL ESTUDIANTE                             │
│  Rutas: /mi-cuenta, /checkout, /pago, /pago/exito   │
│  Controllers: MiCuentaController, CartController,   │
│               PaymentController, EnrollmentController│
│  Vistas: mi-cuenta, checkout, pago-exito            │
│  Middleware: auth (solo autenticados)               │
└─────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────┐
│  DOMINIO ADMINISTRATIVO                             │
│  Rutas: /admin, /admin/users, /admin/contacts       │
│  Controllers: Admin\DashboardController,            │
│               Admin\UserController,                 │
│               Admin\ContactsController              │
│  Vistas: admin/dashboard, admin/users, admin/contacts│
│  Middleware: auth + admin                           │
└─────────────────────────────────────────────────────┘
```

La separación de dominios se refleja también en la estructura física del código:

| Carpeta | Dominio |
|---|---|
| `Controllers/Admin/` | Todo lo administrativo agrupado en su propio subdirectorio |
| `Controllers/Api/` | El chatbot de IA separado de la lógica web |
| `views/auth/` | Las pantallas de autenticación en su propia carpeta |
| `views/admin/` | Las vistas del admin separadas de las del usuario |

#### Separación adicional: Web vs. API

El proyecto mantiene dos archivos de rutas separados que representan dos contratos distintos:

```
routes/web.php  → Responde con HTML (para el navegador)
                  Usa sesiones y CSRF tokens
                  Ejemplo: GET /cursos → vista blade

routes/api.php  → Responde con JSON (para el chatbot)
                  Sin sesiones, sin CSRF
                  Ejemplo: POST /api/chat → { "reply": "..." }
```

Esta separación permite que en el futuro se pueda desarrollar una app móvil o una integración externa que consuma la API sin tocar las rutas web.

---

## 3. Cómo se Aplican los Paradigmas en el Proyecto

### 3.1 MVC en la práctica

**Caso: El estudiante paga un curso**

| Capa MVC | Archivo | Acción |
|---|---|---|
| **Router** | `routes/web.php` | `POST /pago` → `PaymentController@process` |
| **Controller** | `PaymentController.php` | Valida datos de tarjeta, itera el carrito de sesión |
| **Model** | `Enrollment.php` | `Enrollment::create([...])` — guarda en la BD |
| **Model** | `User.php` | `auth()->user()` — obtiene el usuario actual |
| **Controller** | `PaymentController.php` | Vacía el carrito, redirige a éxito |
| **View** | `pago-exito.blade.php` | Muestra el mensaje de confirmación |

**Caso: El admin ve los contactos**

| Capa MVC | Archivo | Acción |
|---|---|---|
| **Router** | `routes/web.php` | `GET /admin/contacts` → `ContactsController@index` |
| **Middleware** | `PermissionMiddleware`, `RoleMiddleware`, `AdminMiddleware`, `SecurityHeadersMiddleware` | Validan acceso por permiso/rol (RBAC) y aplican cabeceras de seguridad; bloquean con 403 si no |
| **Controller** | `Admin/ContactsController.php` | `Contact::orderBy('created_at', 'desc')->get()` |
| **Model** | `Contact.php` | Retorna la colección de mensajes |
| **View** | `admin/contacts.blade.php` | Renderiza la tabla con los mensajes |

---

### 3.2 CDD en la práctica

**Herencia del layout en todas las páginas**

Cada archivo de vista comienza con `@extends('layouts.app')`. Esto significa que cuando se actualiza la navbar (por ejemplo, agregar un nuevo link), el cambio se propaga automáticamente a las 12 páginas del sitio.

**Componente React del chatbot**

El chatbot es un componente React montado en el layout principal. Consume el endpoint `POST /api/chat`, que internamente llama a la API de Google Gemini con un *system prompt* específico sobre la empresa. El componente es completamente independiente: se puede desactivar, actualizar o reemplazar sin tocar ninguna otra parte del código.

---

### 3.3 SDD en la práctica

**Middleware como guardianes de dominio**

La separación entre dominios se enforcea a nivel de rutas con middleware:

```php
// routes/web.php

// Dominio público — sin restricciones
Route::get('/', fn() => view('inicio'));

// Dominio de autenticación — solo para visitantes no logueados
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin']);
    Route::get('/register', [AuthController::class, 'showRegister']);
});

// Dominio del estudiante — requiere estar logueado
Route::middleware('auth')->group(function () {
    Route::get('/mi-cuenta', [MiCuentaController::class, 'index']);
    Route::post('/pago', [PaymentController::class, 'process']);
});

// Dominio administrativo — requiere autenticación + permiso por acción (RBAC)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->middleware('permission:dashboard.view');
    Route::get('/courses', [AdminCourseController::class, 'index'])
        ->middleware('permission:courses.view');
    Route::post('/courses', [AdminCourseController::class, 'store'])
        ->middleware('permission:courses.create');
    // ... materiales, ventas, cupones, roles, settings, auditoría, etc.
});
```

Un usuario sin el permiso requerido es bloqueado por `PermissionMiddleware` (HTTP 403) antes de que su solicitud llegue a cualquier controlador. El antiguo `AdminMiddleware` se conserva por compatibilidad y deriva el acceso del rol mediante `isAdmin()`.

**Namespacing de controllers por dominio**

Los controladores del dominio administrativo viven en su propio namespace `App\Http\Controllers\Admin\`, lo que evita conflictos de nombres y hace evidente a qué dominio pertenece cada controlador con solo ver la ruta de importación.

---

## 4. Resumen de la Arquitectura

```
┌───────────────────────────────────────────────────────────┐
│                      NAVEGADOR / CLIENTE                  │
│   Blade HTML renderizado  ←→  React components (chatbot)  │
└──────────────────────────┬────────────────────────────────┘
                           │  HTTP Request
┌──────────────────────────▼────────────────────────────────┐
│                      CAPA DE ENRUTAMIENTO                 │
│   routes/web.php (HTML)   +   routes/api.php (JSON)       │
│   Middleware: guest │ auth │ role │ permission │ headers  │
└──────────────────────────┬────────────────────────────────┘
                           │  Dispatch al Controller
┌──────────────────────────▼────────────────────────────────┐
│                   CAPA DE CONTROLADORES (MVC-C)           │
│ Público │ Auth │ Estudiante │ Admin LMS │ API (chat) │
│ (catálogo, detalle) · (aula, progreso) · (cursos,        │
│ módulos, materiales, ventas, cupones, roles, settings,   │
│ auditoría) — con Form Requests y capa de Servicios       │
└──────────────────────────┬────────────────────────────────┘
                           │  Consultas Eloquent ORM
┌──────────────────────────▼────────────────────────────────┐
│                    CAPA DE MODELOS (MVC-M)                │
│  User · Role · Permission · Category · Course · Module ·  │
│  Material · Enrollment · Coupon · Sale · SaleItem ·       │
│  AuditLog · Setting · Contact                            │
└──────────────────────────┬────────────────────────────────┘
                           │
┌──────────────────────────▼────────────────────────────────┐
│                BASE DE DATOS MySQL (jm_js_alimentos)      │
│  users · roles · permissions · categories · courses ·     │
│  course_modules · course_materials · enrollments ·        │
│  coupons · sales · sale_items · audit_logs · settings ·   │
│  contacts · sessions · cache · jobs                       │
│  (SQLite en memoria en el entorno de pruebas)             │
└───────────────────────────────────────────────────────────┘

Servicios externos:
  Google Gemini API  ←→  Api\ChatController  (chatbot IA)
```

| Paradigma | Alcance en el proyecto | Archivos clave |
|---|---|---|
| **MVC** | Toda la arquitectura backend | `Controllers/`, `Models/`, `views/` |
| **CDD** | Frontend: layouts Blade + componentes React | `layouts/app.blade.php`, `resources/js/components/` |
| **SDD** | Organización por dominios funcionales + capa de servicios | `routes/web.php` (grupos con `permission:*`), `Controllers/Admin/`, `Controllers/Api/`, `app/Services/`, `app/Http/Requests/` |

---

## 5. Convención de Almacenamiento (Storage)

Para garantizar la seguridad de los materiales educativos del LMS, los archivos de cursos (videos, documentos, presentaciones y recursos descargables) no se almacenan en el disco público expuesto mediante enlaces simbólicos.

### 5.1 Estructura de Rutas
Los materiales se guardan en el disco local privado bajo el patrón:
`private/materials/{course_id}/{module_id}/`

### 5.2 Control de Acceso
El acceso a estos materiales se gestiona a través de `StudentCourseController@serveFile`, que valida la inscripción activa del usuario (o el rol de administrador/instructor) antes de servir el archivo, impidiendo el acceso directo y no autorizado.

---

*Documentación de arquitectura — JM y JS Alimentos — Actualizada a junio de 2026 (plataforma LMS, MySQL, RBAC)*
