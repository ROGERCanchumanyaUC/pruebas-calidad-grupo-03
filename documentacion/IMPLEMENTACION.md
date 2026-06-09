# Implementación — JM y JS Alimentos
## Plataforma de Capacitación en Línea

---

## 1. Especificaciones Técnicas

### 1.1 Stack tecnológico

| Capa | Tecnología | Versión |
|---|---|---|
| **Lenguaje backend** | PHP | ^8.2 |
| **Framework backend** | Laravel | ^12.0 |
| **Base de datos (dev/prod local)** | MySQL (XAMPP) | 8.x / MariaDB 10.x |
| **Base de datos (pruebas)** | SQLite en memoria (`:memory:`) | 3.x |
| **Pasarela de pago (SDK)** | stripe/stripe-php (preparado, no activado) | ^20.2 |
| **Lenguaje frontend** | JavaScript (ESM) | ES2022+ |
| **Framework frontend** | React | ^19.2.5 |
| **Bundler** | Vite | ^7.0.7 |
| **CSS framework** | Tailwind CSS | ^4.0.0 |
| **Gráficos** | Chart.js | ^4.5.1 |
| **Editor de texto enriquecido** | Quill | ^2.0.2 |
| **Reordenamiento (drag & drop)** | SortableJS | ^1.15.7 |
| **Servidor local** | XAMPP (Apache + PHP + MySQL) | — |
| **Gestor de paquetes PHP** | Composer | ^2.x |
| **Gestor de paquetes JS** | npm | ^10.x |
| **Motor de plantillas** | Blade (Laravel) | built-in |
| **ORM** | Eloquent (Laravel) | built-in |
| **IA externa** | Google Gemini API | gemini-2.5-flash |

---

### 1.2 Arquitectura del servidor

```
Navegador del usuario
        │
        │  HTTP (puerto 80 en XAMPP / 8000 en artisan serve)
        ▼
   Apache / php artisan serve
        │
        ▼
   public/index.php          ← Único punto de entrada HTTP
        │
        ▼
   bootstrap/app.php         ← Configura rutas, middleware, excepciones
        │
        ├── routes/web.php   ← Rutas que devuelven HTML
        └── routes/api.php   ← Rutas que devuelven JSON
        │
        ▼
   Controladores → (Servicios) → Modelos → MySQL (jm_js_alimentos)
        │
        ▼
   Vistas Blade → HTML renderizado → Navegador
```

---

### 1.3 Configuración del entorno de producción local

El sistema opera en un entorno local sobre **XAMPP**. Las variables de entorno se definen en el archivo `.env` (nunca en el código fuente):

```env
APP_NAME="JM y JS Alimentos"
APP_ENV=local
APP_KEY=base64:...          # generado con php artisan key:generate
APP_DEBUG=true
APP_URL=http://localhost

APP_LOCALE=es
APP_FALLBACK_LOCALE=es

BCRYPT_ROUNDS=12            # hashing seguro de contraseñas

DB_CONNECTION=mysql         # MySQL servido por XAMPP
DB_HOST=127.0.0.1
DB_PORT=3307                # puerto del MySQL de XAMPP en este entorno
DB_DATABASE=jm_js_alimentos
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database     # sesiones guardadas en BD
SESSION_LIFETIME=120        # minutos antes de expirar
SESSION_ENCRYPT=false

QUEUE_CONNECTION=database   # colas en BD (sin workers externos)
CACHE_STORE=database        # caché en BD

LOG_CHANNEL=stack
LOG_LEVEL=debug

MAIL_MAILER=log             # correos escritos al log (no se envían)

# Integración con Google Gemini (chatbot IA)
GEMINI_API_KEY=             # clave obtenida en Google AI Studio
GEMINI_MODEL=gemini-2.5-flash

# Integración con Stripe (preparada; cobro real aún no activado)
STRIPE_KEY=
STRIPE_SECRET=
STRIPE_WEBHOOK_SECRET=
```

---

### 1.4 Configuración del entorno de pruebas

Definida en `phpunit.xml`, sobreescribe las variables de `.env` solo durante los tests:

| Variable | Valor en tests | Propósito |
|---|---|---|
| `APP_ENV` | `testing` | Activa guards del framework para tests |
| `DB_CONNECTION` | `sqlite` | BD ligera y aislada para tests (independiente del MySQL de desarrollo) |
| `DB_DATABASE` | `:memory:` | BD en RAM, se crea y destruye en cada ejecución |
| `BCRYPT_ROUNDS` | `4` | Hashing rápido (seguridad no importa en tests) |
| `CACHE_STORE` | `array` | Caché en memoria, sin persistencia |
| `SESSION_DRIVER` | `array` | Sesiones en memoria, sin persistencia |
| `QUEUE_CONNECTION` | `sync` | Trabajos ejecutados inmediatamente |
| `MAIL_MAILER` | `array` | Correos capturados, no enviados |

---

### 1.5 Estructura de la base de datos

**Motor:** MySQL (servido por XAMPP) — base de datos `jm_js_alimentos`. El esquema se gestiona íntegramente mediante migraciones de Laravel (`database/migrations`).

> En el entorno de **pruebas** el mismo esquema se materializa sobre SQLite en memoria; las migraciones son compatibles con ambos motores.

#### Tablas de autenticación y RBAC

```
users           id, name, email (único), email_verified_at, password (bcrypt),
                is_admin (bool, sincronizado con el rol), dni (nullable),
                phone (nullable), remember_token, timestamps
roles           id, name, display_name, description, timestamps
permissions     id, name, display_name, module (indexado), timestamps
role_user       role_id (FK), user_id (FK)            -- pivote usuario↔rol
role_permission role_id (FK), permission_id (FK)       -- pivote rol↔permiso
```

#### Tablas del catálogo y contenido (LMS)

```
categories       id, name, slug, description, icon, order, is_active, timestamps
courses          id, category_id (FK), instructor_id (FK), name, slug,
                 short_description, description (longText), cover_image,
                 level (enum), status (enum), price, sale_price,
                 sale_start, sale_end, duration_weeks, meta_description,
                 is_featured, published_at, timestamps  (índices: category, instructor, status, level)
course_modules   id, course_id (FK), name, description, order, status (enum), timestamps
course_materials id, module_id (FK), type (enum), title, description,
                 content (longText), file_path, file_type, video_url,
                 video_source (enum), duration_minutes, order,
                 is_downloadable, timestamps
course_material_user  user_id (FK), course_material_id (FK)  -- pivote: materiales completados
```

#### Tablas de inscripciones, ventas y cupones

```
enrollments  id, user_id (FK), course_id (FK), status (enum),
             progress (decimal), last_accessed_at, total_time_minutes,
             completed_at, enrolled_at, timestamps
coupons      id, code, type (enum), value, start_date, end_date,
             usage_limit, times_used, is_active, timestamps
sales        id, user_id (FK), coupon_id (FK nullable), subtotal, discount,
             total, payment_method (enum), payment_status (enum),
             stripe_payment_id, notes, paid_at, timestamps
sale_items   id, sale_id (FK), course_id (FK), price
```

> **Cambio respecto al prototipo:** `enrollments` ya no guarda `course_name`/`level` como texto, sino una FK `course_id` y campos de seguimiento de progreso. La venta queda trazada en `sales`/`sale_items`.

#### Tablas de operación y soporte

```
contacts     id, nombre, correo, tema, curso (nullable), mensaje,
             leido (bool), timestamps
audit_logs   id, user_id (FK), action, entity_type, entity_id,
             old_values (json), new_values (json), ip_address,
             user_agent, timestamps
settings     id, key, value (text), type, group
sessions     id, user_id, ip_address, user_agent, payload, last_activity
cache / cache_locks / jobs / job_batches / failed_jobs   -- tablas de framework
```

---

### 1.6 Configuración de Vite

```js
// vite.config.js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.jsx'],  // Punto de entrada React
            refresh: true,                     // Hot reload en desarrollo
        }),
    ],
    server: {
        host: 'localhost',
        port: 5173,                            // Puerto del servidor de desarrollo
    },
});
```

El bundle compilado se deposita en `public/build/` y es referenciado por `@vite(...)` en los layouts Blade.

---

### 1.7 Registro de middleware personalizado

En `bootstrap/app.php` se registran los alias de los middleware personalizados y se aplican los globales:

```php
->withMiddleware(function (Middleware $middleware): void {
    $middleware->alias([
        'admin'      => \App\Http\Middleware\AdminMiddleware::class,
        'role'       => \App\Http\Middleware\RoleMiddleware::class,
        'permission' => \App\Http\Middleware\PermissionMiddleware::class,
    ]);
    // SecurityHeadersMiddleware se aplica a las respuestas (cabeceras de seguridad)
})
```

Esto permite proteger rutas por permiso (`middleware('permission:courses.edit')`) o por rol (`middleware('role:instructor')`) sin importar la clase completa. El `AdminMiddleware` se conserva por compatibilidad y ahora evalúa `$user->isAdmin()`, derivado del rol.

---

## 2. Requisitos

### 2.1 Requisitos de software (entorno local / desarrollo)

| Software | Versión mínima | Propósito |
|---|---|---|
| **PHP** | 8.2 | Ejecución del backend Laravel |
| **Composer** | 2.x | Gestión de dependencias PHP |
| **Node.js** | 18.x LTS | Ejecución de Vite y npm |
| **npm** | 9.x | Gestión de dependencias JavaScript |
| **XAMPP** (o equivalente) | 8.2+ | Servidor Apache + PHP + MySQL integrado |
| **MySQL / MariaDB** | 8.x / 10.x | Motor de base de datos (incluido en XAMPP) |
| **Git** | 2.x | Control de versiones |

> **Nota:** Para desarrollo/producción local debe estar habilitada la extensión `pdo_mysql` (incluida en XAMPP). El entorno de pruebas usa SQLite en memoria, por lo que también conviene tener `pdo_sqlite` activa para correr la suite de tests.

---

### 2.2 Requisitos de hardware (mínimos para desarrollo)

| Componente | Mínimo | Recomendado |
|---|---|---|
| **CPU** | 2 núcleos, 1.6 GHz | 4 núcleos, 2.5 GHz |
| **RAM** | 4 GB | 8 GB |
| **Disco** | 500 MB libres | 2 GB libres |
| **Sistema operativo** | Windows 10, macOS 12, Ubuntu 20.04 | Windows 11, macOS 14, Ubuntu 22.04 |

---

### 2.3 Requisitos de red

| Recurso | Requerido | Para qué |
|---|---|---|
| **Conexión a Internet** | Solo en desarrollo | Descargar dependencias (Composer, npm) |
| **Google AI Studio API key** | Sí (para el chatbot) | Acceso a Google Gemini API |
| **Puerto 80** (Apache) o **8000** (artisan) | Libre | Servidor HTTP local |
| **Puerto 5173** | Libre | Servidor de desarrollo Vite |

---

### 2.4 Extensiones PHP requeridas

Estas extensiones son estándar en XAMPP/PHP 8.2+:

| Extensión | Uso en el proyecto |
|---|---|
| `pdo` | Capa de abstracción de base de datos |
| `pdo_mysql` | Conexión con MySQL (desarrollo/producción local) |
| `pdo_sqlite` | Conexión con SQLite en memoria (entorno de pruebas) |
| `mbstring` | Manipulación de cadenas multibyte |
| `openssl` | Cifrado de sesiones y cookies |
| `tokenizer` | Tokenización para Blade y Artisan |
| `xml` | Parseo de XML (phpunit, Composer) |
| `ctype` | Validación de tipos de caracteres |
| `fileinfo` | Detección de tipos MIME (validación de archivos de materiales) |
| `curl` | Llamadas HTTP a la API de Gemini |
| `gd` o `imagick` | Procesamiento de imágenes de portada de cursos |

---

## 3. Dependencias

### 3.1 Dependencias PHP (composer.json)

#### Producción

| Paquete | Versión | Función en el proyecto |
|---|---|---|
| `laravel/framework` | ^12.0 | Framework principal: routing, ORM, middleware, autenticación, sesiones, validación |
| `laravel/tinker` | ^2.10.1 | REPL interactivo para depuración desde la terminal (`php artisan tinker`) |
| `stripe/stripe-php` | ^20.2 | SDK de Stripe para la pasarela de pago (integración preparada; el cobro real aún no está activado) |

#### Desarrollo (no se usan en producción)

| Paquete | Versión | Función |
|---|---|---|
| `fakerphp/faker` | ^1.23 | Generación de datos falsos en factories y seeders |
| `laravel/pail` | ^1.2.2 | Visor de logs en tiempo real en la terminal |
| `laravel/pint` | ^1.24 | Formateador de código PHP (PSR-12) |
| `laravel/sail` | ^1.41 | Entorno Docker para Laravel (disponible pero no usado) |
| `mockery/mockery` | ^1.6 | Creación de mocks en pruebas unitarias |
| `nunomaduro/collision` | ^8.6 | Mejor visualización de errores en consola |
| `phpunit/phpunit` | ^11.5.50 | Framework de pruebas automatizadas |

**Autoloading PSR-4:**
```json
"autoload": {
    "psr-4": {
        "App\\": "app/",
        "Database\\Factories\\": "database/factories/",
        "Database\\Seeders\\": "database/seeders/"
    }
}
```

---

### 3.2 Dependencias JavaScript (package.json)

#### Producción (dependencies)

| Paquete | Versión | Función en el proyecto |
|---|---|---|
| `react` | ^19.2.5 | Librería de UI para el componente del chatbot |
| `react-dom` | ^19.2.5 | Renderizado de React en el DOM del navegador |
| `chart.js` | ^4.5.1 | Gráficos del dashboard administrativo (ventas e inscripciones mensuales, top cursos) |
| `quill` | ^2.0.2 | Editor de texto enriquecido para materiales de tipo texto |
| `sortablejs` | ^1.15.7 | Reordenamiento de módulos por arrastrar y soltar |

#### Desarrollo (devDependencies)

| Paquete | Versión | Función |
|---|---|---|
| `vite` | ^7.0.7 | Bundler y servidor de desarrollo con HMR |
| `laravel-vite-plugin` | ^2.0.0 | Integración entre Vite y Laravel (manifesto de assets) |
| `@vitejs/plugin-react` | ^5.2.0 | Soporte JSX y Fast Refresh para React en Vite |
| `tailwindcss` | ^4.0.0 | Framework CSS de utilidades (disponible, uso parcial) |
| `@tailwindcss/vite` | ^4.0.0 | Plugin de integración Tailwind con Vite |
| `concurrently` | ^9.0.1 | Ejecución paralela de múltiples procesos (artisan + vite + queue + pail) |

---

### 3.3 Dependencia externa — Google Gemini API

| Atributo | Valor |
|---|---|
| **Proveedor** | Google (Google AI Studio) |
| **Modelo** | `gemini-2.5-flash` (configurable via `.env`) |
| **Endpoint** | `https://generativelanguage.googleapis.com/v1beta/models/{model}:generateContent` |
| **Autenticación** | API Key en header `x-goog-api-key` |
| **Timeout** | 30 segundos |
| **Parámetros** | `temperature: 0.7`, `maxOutputTokens: 500` |
| **Costo** | Gratuito hasta cierta cuota (Google AI Studio free tier) |
| **Requisito** | `GEMINI_API_KEY` en `.env` |

La comunicación con Gemini se realiza via `curl` nativo de PHP (a través de Laravel's HTTP client o directamente), sin dependencia de un SDK de terceros.

---

## 4. Plan de Implementación

El plan está dividido en **6 fases** ordenadas por prioridad y dependencia técnica.

---

### Fase 1 — Preparación del entorno

**Objetivo:** Tener el proyecto corriendo localmente desde cero.

```
Paso 1: Verificar requisitos de software
    ├── php --version          → debe ser ≥ 8.2
    ├── composer --version     → debe ser ≥ 2.x
    ├── node --version         → debe ser ≥ 18.x
    └── npm --version          → debe ser ≥ 9.x

Paso 2: Clonar o copiar el proyecto
    └── Colocar en: C:\xampp\htdocs\boceto\

Paso 3: Instalar dependencias PHP
    └── composer install

Paso 4: Instalar dependencias JavaScript
    └── npm install

Paso 5: Crear el archivo de entorno
    ├── copy .env.example .env
    └── php artisan key:generate
        (genera APP_KEY única para cifrar sesiones y cookies)

Paso 6: Crear la base de datos MySQL
    └── En phpMyAdmin (XAMPP) o consola: CREATE DATABASE jm_js_alimentos;
        (verificar host/puerto/credenciales en .env: 127.0.0.1:3307, root)

Paso 7: Ejecutar las migraciones y poblar datos demo
    └── php artisan migrate --seed
        (crea todas las tablas en jm_js_alimentos y carga roles,
         permisos, categorías, cursos y datos demo del LMS)

Paso 8: Compilar los assets del frontend
    └── npm run build
        (genera public/build/ con los archivos compilados)
```

**Verificación:** Abrir `http://localhost/boceto/public` — debe mostrar la página de inicio.

---

### Fase 2 — Configuración de variables de entorno

**Objetivo:** Personalizar `.env` para el entorno específico.

```
Editar .env:

APP_NAME="JM y JS Alimentos"
APP_URL=http://localhost/boceto/public
APP_LOCALE=es

# Base de datos (MySQL servido por XAMPP)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=jm_js_alimentos
DB_USERNAME=root
DB_PASSWORD=

# Sesiones y caché en BD
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

# Chatbot IA — obtener en https://aistudio.google.com/app/apikey
GEMINI_API_KEY=tu_clave_aqui
GEMINI_MODEL=gemini-2.5-flash

# Stripe (opcional; el cobro real aún no está activado)
STRIPE_KEY=
STRIPE_SECRET=
STRIPE_WEBHOOK_SECRET=
```

**Verificación del chatbot:** Abrir la aplicación y enviar un mensaje al asistente. Debe responder con información sobre la empresa.

---

### Fase 3 — Creación del usuario administrador

**Objetivo:** Tener acceso al panel de administración mediante el modelo de roles.

```
Opción A — Sembrar roles, permisos y datos demo (recomendado):
    php artisan db:seed
    (ejecuta RoleAndPermissionSeeder, SettingSeeder, CourseSeeder y
     DemoLmsSeeder; crea el rol "admin" con todos sus permisos)

Opción B — Asignar el rol admin a un usuario via tinker:
    php artisan tinker
    >>> $u = App\Models\User::create([
    ...     'name' => 'Administrador',
    ...     'email' => 'admin@jmjs.com',
    ...     'password' => 'admin2024',
    ... ]);
    >>> $u->assignRole('admin');   // sincroniza también is_admin

Opción C — Registro normal + elevación:
    1. Registrarse en /register con cualquier cuenta
    2. Via tinker: App\Models\User::find(1)->assignRole('admin')
```

> El acceso administrativo se concede por **rol/permisos**, no por el flag `is_admin` directo. El método `assignRole()` mantiene `is_admin` sincronizado por compatibilidad.

**Verificación:** Iniciar sesión con el admin → debe redirigir a `/admin`.

---

### Fase 4 — Modo desarrollo (frontend + backend en paralelo)

**Objetivo:** Activar el entorno de desarrollo con hot reload.

```
Opción A — Comando todo-en-uno (composer.json script "dev"):
    composer run dev
    (lanza en paralelo: artisan serve + queue:listen + pail + vite dev)

Opción B — Terminales separadas:
    Terminal 1: php artisan serve        → http://localhost:8000
    Terminal 2: npm run dev              → http://localhost:5173 (Vite HMR)
    Terminal 3: php artisan queue:listen → procesa trabajos en cola
```

**Con XAMPP activo:** No es necesario `artisan serve`. Vite sigue siendo necesario en desarrollo para HMR:
```
    npm run dev
    Acceder via: http://localhost/boceto/public
```

---

### Fase 5 — Ejecución de pruebas automatizadas

**Objetivo:** Verificar que el sistema funciona correctamente.

```
Paso 1: Limpiar configuración previa
    php artisan config:clear

Paso 2: Ejecutar toda la suite de pruebas
    php artisan test
    (o alternativamente: composer run test)

Paso 3: Ejecutar solo pruebas de Feature
    php artisan test --testsuite=Feature

Paso 4: Ejecutar solo pruebas de Unit
    php artisan test --testsuite=Unit

Paso 5: Ver reporte con cobertura de código
    php artisan test --coverage
```

**Salida esperada (suite del LMS):**
```
   PASS  Tests\Unit\CoursePublishingServiceTest
   PASS  Tests\Unit\LmsRelationshipsTest
   PASS  Tests\Unit\VideoEmbedServiceTest
   PASS  Tests\Feature\PublicCourseCatalogTest
   PASS  Tests\Feature\AdminCourseCrudTest
   PASS  Tests\Feature\AdminCourseMaterialTest
   PASS  Tests\Feature\AdminSalesAndCouponsTest
   PASS  Tests\Feature\AdminDashboardAnalyticsTest
   PASS  Tests\Feature\AdminSecurityAndRolesTest
   PASS  Tests\Feature\PermissionMiddlewareTest
   PASS  Tests\Feature\StudentCourseAccessTest
   PASS  Tests\Feature\LmsReleaseReadinessTest
   ...

   Tests:    72 passed
   Duration: X.XXs
```

> El detalle de cada caso de prueba está documentado en `PRUEBAS_CALIDAD.md`.

---

### Fase 6 — Comandos útiles de mantenimiento

**Limpiar cachés:**
```bash
php artisan config:clear     # Limpia caché de configuración
php artisan route:clear      # Limpia caché de rutas
php artisan view:clear       # Limpia vistas Blade compiladas
php artisan cache:clear      # Limpia caché de aplicación
```

**Revertir y re-ejecutar migraciones (¡borra todos los datos!):**
```bash
php artisan migrate:fresh    # Elimina todas las tablas y las re-crea
```

**Explorar la BD interactivamente:**
```bash
php artisan tinker
>>> App\Models\User::all()
>>> App\Models\Enrollment::with('user')->get()
>>> App\Models\Contact::where('leido', false)->count()
```

**Formatear código PHP (Pint):**
```bash
./vendor/bin/pint             # Formatea todos los archivos PHP
./vendor/bin/pint app/        # Solo el directorio app/
```

**Ver todas las rutas registradas:**
```bash
php artisan route:list        # Lista completa
php artisan route:list --path=admin  # Filtrar por prefijo
```

---

## 5. Diagrama de dependencias

```
┌─────────────────────────────────────────────────────────────┐
│                    CAPA DE PRESENTACIÓN                     │
│  React 19.2.5 + Tailwind 4.0 + CSS personalizado           │
│  Compilado por Vite 7.0.7 → public/build/                  │
│  Plantillas Blade (motor built-in de Laravel)               │
└──────────────────────────┬──────────────────────────────────┘
                           │
┌──────────────────────────▼──────────────────────────────────┐
│                    CAPA DE APLICACIÓN                       │
│  Laravel 12.0 (PHP ^8.2)                                    │
│  ├── Routing (web + api)                                    │
│  ├── Middleware (auth, guest, admin, role, permission,      │
│  │              SecurityHeaders) + rate limiting            │
│  ├── Controladores (web + Admin/* + Api/*)                  │
│  ├── Form Requests (validación de cursos/módulos/materiales)│
│  ├── Servicios (Audit, CoursePublishing, Stripe, VideoEmbed)│
│  ├── Eloquent ORM (User, Role, Permission, Category, Course,│
│  │   CourseModule, CourseMaterial, Enrollment, Coupon,      │
│  │   Sale, SaleItem, AuditLog, Setting, Contact)            │
│  └── Gestión de sesiones, autenticación y RBAC              │
└──────────────────────────┬──────────────────────────────────┘
                           │
┌──────────────────────────▼──────────────────────────────────┐
│                    CAPA DE DATOS                            │
│  MySQL (XAMPP) — base de datos jm_js_alimentos              │
│  (SQLite en memoria para el entorno de pruebas)             │
│  Tablas: users, roles, permissions, categories, courses,    │
│   course_modules, course_materials, enrollments, coupons,   │
│   sales, sale_items, audit_logs, settings, contacts,        │
│   sessions, cache, jobs                                     │
└─────────────────────────────────────────────────────────────┘

                    SERVICIO EXTERNO
┌─────────────────────────────────────────────────────────────┐
│  Google Gemini API (gemini-2.5-flash)                       │
│  Accedido desde: Api\ChatController                         │
│  Vía: HTTP + API Key (curl, 30s timeout)                    │
└─────────────────────────────────────────────────────────────┘
```

---

## 6. Resumen de versiones

| Componente | Versión |
|---|---|
| PHP | ^8.2 |
| Laravel Framework | ^12.0 |
| Laravel Tinker | ^2.10.1 |
| stripe/stripe-php | ^20.2 |
| PHPUnit | ^11.5.50 |
| Faker | ^1.23 |
| Laravel Pint | ^1.24 |
| Mockery | ^1.6 |
| React | ^19.2.5 |
| React DOM | ^19.2.5 |
| Vite | ^7.0.7 |
| laravel-vite-plugin | ^2.0.0 |
| @vitejs/plugin-react | ^5.2.0 |
| Tailwind CSS | ^4.0.0 |
| Chart.js | ^4.5.1 |
| Quill | ^2.0.2 |
| SortableJS | ^1.15.7 |
| concurrently | ^9.0.1 |
| Google Gemini | gemini-2.5-flash |
| MySQL (XAMPP) / MariaDB | 8.x / 10.x |
| SQLite (solo pruebas) | 3.x |

---

*Documentación de implementación — JM y JS Alimentos — Actualizada a junio de 2026 (plataforma LMS, MySQL)*
