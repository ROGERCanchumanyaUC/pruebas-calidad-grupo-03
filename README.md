# Plataforma LMS - JM y JS Alimentos (v2.0)

Este repositorio contiene la evolución completa del prototipo a una plataforma **LMS (Learning Management System)** funcional y profesional para cursos de calidad e inocuidad alimentaria, desarrollada sobre **Laravel 12**, **React** y **Vite**.

---

## 🚀 Arquitectura y Stack Tecnológico

La arquitectura de la aplicación sigue patrones MVC estrictos y estándares corporativos de seguridad:

*   **Core Backend:** Laravel `12.x` y PHP `8.5+` (Compatible con PHP `8.2+`).
*   **Base de Datos:** MySQL / MariaDB (Puerto local `3307`, base de datos `jm_js_alimentos`) con migraciones normalizadas y carga ansiosa (*eager loading*) para prevenir consultas N+1.
*   **Frontend Compilación:** Vite `7.x` y React con dependencias de terceros (como *Quill* y *SortableJS*) empaquetadas localmente a través de NPM para evitar dependencias inestables de CDNs externas.
*   **Diseño Visual:** Tema oscuro de alta fidelidad, glassmorphism con desenfoque (`backdrop-filter`) y efectos dinámicos de micro-animación en vistas públicas y administrativas.
*   **Almacenamiento Seguro (Private Storage):** Los materiales de estudio cargados en la plataforma se almacenan estrictamente en el disco local privado (`storage/app/private/materials/{course_id}/{module_id}/`) protegiendo el acceso no autorizado mediante controladores seguros.

---

## 📦 Características Implementadas (Sprints 1 - 6)

### 🔑 Fundamentos y Seguridad (Sprint 1)
*   **Roles y Permisos:** Middlewares de protección basados en roles (`admin`, `instructor`, `estudiante`) con bypass de permisos automático para el administrador principal.
*   **Validaciones FormRequests:** Procesamiento y limpieza de datos en la creación de cursos, módulos y materiales.
*   **Servicio de Publicación:** El sistema evalúa campos obligatorios, módulos y contenidos mínimos antes de permitir publicar un curso al catálogo.

### 🏷️ Catálogo Público y Carrito (Sprint 2)
*   **Catálogo Dinámico:** Reemplazo de las tarjetas Blade estáticas por un catálogo en tiempo real con filtros avanzados (nivel, categoría, búsqueda por texto) y exclusión automática de borradores.
*   **Seguridad en Precios:** El carrito de compra recibe únicamente el `course_id`. Los precios y metadatos se resuelven en el servidor, evitando ataques de manipulación de precios desde el cliente.

### 🛠️ CRUD Administrativo y Duplicación (Sprint 3)
*   **Panel Administrativo:** Pantallas interactivas de gestión de cursos organizadas en pestañas (General, Comercial, SEO) con previsualizadores de portadas.
*   **Duplicador Profundo:** Clona cursos completos recreando la estructura de módulos, lecciones y duplicando físicamente sus archivos correspondientes en el almacenamiento privado.
*   **Registro de Auditoría:** Toda acción administrativa (creación, edición, duplicación, publicación y eliminación) se registra en la tabla `audit_logs`.

### 📚 Constructor de Temario y Lecciones (Sprint 4)
*   **Constructor Drag & Drop:** Reordenamiento interactivo del temario mediante SortableJS arrastrando módulos con persistencia asíncrona.
*   **Soporte de Archivos Multiformato:** Carga y validación automática de videos (Youtube, Vimeo, o MP4/WebM subidos), documentos PDF/Word, presentaciones y recursos descargables.
*   **Sanitizador HTML:** Las lecciones de texto enriquecido (Quill) se sanitizan en el servidor bloqueando inyecciones XSS (`<script>`, `<iframe>` maliciosos y eventos JS).

### 📖 Aula de Aprendizaje e Hitos (Sprint 5)
*   **Aula Virtual Premium:** Interfaz oscura, sidebar colapsable del temario e interactividad por AJAX para marcar lecciones completadas.
*   **Progreso Dinámico:** El progreso total del curso se recalcula de forma interactiva. Al llegar al 100%, la matrícula se marca automáticamente como `completada` registrando el timestamp.
*   **Streaming Seguro:** Los videos y PDFs alojados de forma privada se sirven dinámicamente mediante streams del servidor, verificando la propiedad de la matrícula antes de la entrega.

### 💳 Checkout, Cupones y Gestión Escolar (Sprint 6)
*   **Cupones en Checkout:** Integración visual e interactividad AJAX para aplicar cupones de descuento (porcentaje o monto fijo) con validaciones de vigencia, estado activo y límites de uso global.
*   **Registro de Ventas:** El checkout ahora genera una traza comercial transparente guardando la factura (`sales`), ítems comprados (`sale_items`) y activando las matrículas correspondientes.
*   **Consola Administrativa Escolar:** Panel para listar estudiantes, consultar su avance, suspender o reactivar su acceso a los cursos, o reiniciar su progreso en cascada.

---

## 🛠️ Instalación y Configuración Local

### 1. Clonar e Instalar Dependencias
```bash
git clone https://github.com/ROGERCanchumanyaUC/pruebas-calidad-grupo-03.git
cd pruebas-calidad-grupo-03
git checkout feat_LMS_v2.0
composer install
npm ci
```

### 2. Configuración del Entorno
Duplica el archivo de configuración:
```bash
cp .env.example .env
```

Genera la llave de la aplicación:
```bash
php artisan key:generate
```

### 3. Configurar Base de Datos MySQL (XAMPP o Docker)
En tu archivo `.env`, asegúrate de apuntar a tu motor local. Ejemplo para MySQL en puerto `3307`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=jm_js_alimentos
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Migrar y Cargar Semillas
```bash
php artisan migrate:fresh --seed
```
*Credenciales de prueba administrador:* `72682019@continental.edu.pe` / `password`

### 5. Configurar Enlaces de Almacenamiento
Enlaza el almacenamiento público (para portadas y recursos públicos):
```bash
php artisan storage:link
```

### 6. Levantar Servidores locales
Para compilar los recursos frontend de Vite en desarrollo:
```bash
npm run dev
```

En otra terminal, levanta el servidor de desarrollo de Laravel:
```bash
php artisan serve
```

---

## 🧪 Pruebas y Aseguramiento de Calidad

La plataforma cuenta con cobertura completa de pruebas automatizadas unitarias y de integración para garantizar que las actualizaciones de código no rompan flujos de negocio clave:

*   **Ejecución de Tests:**
    ```bash
    php artisan test
    ```
*   **Compilación Frontend de Producción:**
    ```bash
    npm run build
    ```
*   **Auditorías de Seguridad (Limpio):**
    ```bash
    composer audit
    npm audit --audit-level=moderate
    ```
