# Metodología de Desarrollo — JM y JS Alimentos
## Plataforma de Capacitación en Línea

---

## 1. Metodología Seleccionada: Desarrollo Iterativo e Incremental

### 1.1 Descripción

El proyecto adoptó la **metodología de Desarrollo Iterativo e Incremental**, con prácticas ágiles inspiradas en **Scrum**. Este enfoque divide el desarrollo en ciclos cortos, donde cada ciclo produce una versión funcional del sistema que se enriquece progresivamente.

El desarrollo se dio en **dos etapas**: una **primera etapa** de prototipo (4 iteraciones, mayo 2026) que construyó el sitio de e-learning base, y una **segunda etapa** de evolución a **plataforma LMS** (junio 2026) organizada formalmente en **sprints** mediante un tablero Kanban (`documentacion/KANBAN.md`). Este documento describe ambas etapas.

A diferencia del modelo en cascada (Waterfall), donde todas las fases se completan de forma estrictamente secuencial, el modelo iterativo permite:

- Detectar y corregir errores en etapas tempranas.
- Priorizar las funcionalidades de mayor valor para el usuario.
- Adaptar el alcance según los avances reales del equipo.
- Entregar versiones funcionales en cada iteración.

### 1.2 Justificación de la elección

| Criterio | Razón |
|---|---|
| **Tamaño del equipo** | Equipo pequeño; la coordinación ágil es más eficiente que procesos formales pesados |
| **Requisitos cambiantes** | Durante el desarrollo surgieron nuevas funcionalidades (chatbot IA, sistema de logros) que el modelo iterativo absorbió sin necesidad de replantear todo |
| **Entrega temprana de valor** | Desde la primera versión el sistema era navegable y funcional |
| **Control de calidad continuo** | Cada iteración incluyó pruebas antes de pasar a la siguiente |
| **Contexto académico** | El modelo iterativo facilita la trazabilidad del avance para presentaciones y revisiones |

---

## 2. Fases de la Metodología

La **primera etapa** (prototipo) se organizó en **4 iteraciones principales** (versiones), precedidas por una fase de planificación y cerradas con documentación. La **segunda etapa** (LMS) se organizó en 10 sprints (ver sección 3.1).

```
┌─────────────────────────────────────────────────────────────┐
│  FASE 0 — Planificación y diseño inicial                    │
│  Definición de requisitos, arquitectura y diseño visual     │
└──────────────────────────┬──────────────────────────────────┘
                           │
┌──────────────────────────▼──────────────────────────────────┐
│  ITERACIÓN 1 — Versión base (feat: index)                   │
│  Estructura del proyecto, páginas públicas, navegación      │
└──────────────────────────┬──────────────────────────────────┘
                           │
┌──────────────────────────▼──────────────────────────────────┐
│  ITERACIÓN 2 — Última versión                               │
│  Autenticación, carrito, checkout, panel del estudiante     │
└──────────────────────────┬──────────────────────────────────┘
                           │
┌──────────────────────────▼──────────────────────────────────┐
│  ITERACIÓN 3 — 3era versión                                 │
│  Panel admin, contactos, inscripciones, chatbot IA          │
└──────────────────────────┬──────────────────────────────────┘
                           │
┌──────────────────────────▼──────────────────────────────────┐
│  ITERACIÓN 4 — 4ta versión                                  │
│  Refinamiento de UI, correcciones, ajustes de experiencia   │
└──────────────────────────┬──────────────────────────────────┘
                           │
┌──────────────────────────▼──────────────────────────────────┐
│  FASE FINAL (prototipo) — Documentación y entrega           │
│  Documentos técnicos del prototipo                          │
└──────────────────────────┬──────────────────────────────────┘
                           │
┌──────────────────────────▼──────────────────────────────────┐
│  ETAPA 2 — Plataforma LMS (Sprints 0 a 9)                   │
│  Arquitectura LMS, catálogo dinámico, CRUD, aula, ventas,   │
│  RBAC, dashboard, auditoría, QA y release (ver sección 3.1) │
└─────────────────────────────────────────────────────────────┘
```

---

## 3. Detalle de Cada Iteración

### Fase 0 — Planificación y Diseño Inicial

**Objetivo:** Definir qué se va a construir y cómo.

| Actividad | Resultado |
|---|---|
| Levantamiento de requisitos | Lista de funcionalidades priorizadas |
| Definición de actores | Visitante, Estudiante, Administrador |
| Diseño de la base de datos | Schema de `users`, `enrollments`, `contacts` |
| Definición del stack tecnológico | Laravel 12, React 19, Vite 7, SQLite (migrado a MySQL en la etapa LMS) |
| Diseño visual (wireframes) | Paleta de colores, tipografía Poppins, estructura de páginas |
| Configuración del repositorio | Repositorio Git en GitHub (`pruebas-calidad-grupo-03`) |

---

### Iteración 1 — Versión Base (`feat: index`)

**Objetivo:** Tener el proyecto corriendo con las páginas públicas funcionales.

**Funcionalidades desarrolladas:**

- Estructura del proyecto Laravel (rutas, layouts, vistas)
- Layout principal (`layouts/app.blade.php`) con navbar y footer
- Página de **Inicio** con hero, sección de cursos destacados y testimonios
- Página **Nosotros** con historia, metodología y valores (bento grid)
- Página **Cursos** con catálogo y filtros por nivel
- Página **Contacto** con información y formulario básico
- Hoja de estilos principal (`public/css/site.css`) — diseño base
- Modelo de color y tipografía definidos

**Criterios de aceptación verificados:**
- ✓ Las 4 páginas públicas cargan sin errores
- ✓ La navegación entre páginas funciona correctamente
- ✓ El diseño es consistente en desktop y móvil
- ✓ El catálogo muestra los 9 cursos con sus datos correctos

---

### Iteración 2 — Última Versión

**Objetivo:** Agregar el sistema de usuarios y el flujo de compra completo.

**Funcionalidades desarrolladas:**

- **Autenticación:** Registro, login, logout con validaciones y mensajes de error
- **Migraciones:** Tablas `users` (con `is_admin`, `dni`, `phone`), `enrollments`, `contacts`
- **Modelos Eloquent:** `User`, `Enrollment`, `Contact` con relaciones
- **Carrito de compras:** Agregar/eliminar cursos via AJAX, badge en navbar
- **Checkout:** Resumen del carrito, selección de método de pago, validación de tarjeta
- **Pago:** Proceso de pago con creación automática de inscripciones, vaciado del carrito
- **Página de éxito:** Confirmación post-pago
- **Mi Cuenta:** Panel del estudiante con tabs (Mis Cursos, Mi Perfil, Logros)
- **Formulario de contacto:** Envío AJAX, campos condicionales, guardado en BD
- **Middleware:** `AdminMiddleware` registrado como alias `admin`

**Criterios de aceptación verificados:**
- ✓ Un usuario puede registrarse e iniciar sesión
- ✓ El carrito acepta múltiples cursos y previene duplicados
- ✓ El pago crea inscripciones (en la etapa LMS, además, registros de venta)
- ✓ Mi Cuenta muestra correctamente los cursos inscritos
- ✓ Los logros se desbloquean automáticamente según condiciones

---

### Iteración 3 — 3era Versión

**Objetivo:** Completar el sistema con el panel de administración y el chatbot de IA.

**Funcionalidades desarrolladas:**

- **Panel Admin — Dashboard:** Estadísticas de usuarios, contactos e inscripciones
- **Panel Admin — Usuarios:** Lista paginada, toggle de rol `is_admin`
- **Panel Admin — Contactos:** Lista de mensajes, marcar como leído, eliminar
- **Layout admin:** Sidebar de navegación exclusivo para administradores
- **Redirección por rol:** Login redirige a `/admin` para admins y a `/mi-cuenta` para estudiantes
- **Chatbot IA:** Integración con Google Gemini API, system prompt de la empresa, manejo de errores
- **API route:** `POST /api/chat` en `routes/api.php`
- **Componente React:** Chatbot montado en el layout principal
- **Config Gemini:** `config/services.php` con key y modelo configurables via `.env`

**Criterios de aceptación verificados:**
- ✓ El admin puede acceder a todas las secciones del panel
- ✓ Usuarios sin rol admin reciben error 403
- ✓ El chatbot responde preguntas sobre la empresa y cursos
- ✓ Los errores de la API de Gemini no detienen la plataforma

---

### Iteración 4 — 4ta Versión

**Objetivo:** Pulir la experiencia de usuario y corregir inconsistencias visuales.

**Archivos modificados:**

| Archivo | Cambios realizados |
|---|---|
| `public/css/site.css` | Refinamiento de estilos: animaciones, responsive, cards de cursos |
| `resources/views/cursos.blade.php` | Mejoras en la presentación del catálogo y filtros |
| `resources/views/layouts/app.blade.php` | Ajustes en la navbar, badge del carrito, integración del chatbot |
| `resources/views/mi-cuenta.blade.php` | Mejoras en las tabs, barras de progreso y sección de logros |

**Criterios de aceptación verificados:**
- ✓ La interfaz es visualmente consistente en todas las páginas
- ✓ El diseño responsive funciona en pantallas desde 320px
- ✓ Los elementos interactivos (filtros, tabs, carrito) responden correctamente
- ✓ No se introdujeron regresiones en funcionalidades anteriores

---

### Fase Final — Documentación y Entrega

**Objetivo:** Generar toda la documentación técnica y académica del proyecto.

**Documentos generados en la carpeta `documentacion/`** (la etapa LMS sumó documentos operativos hasta un total de 13):

| Documento | Contenido |
|---|---|
| `DOCUMENTACION_GENERAL.md` | Objetivos, requerimientos, actores y alcance |
| `DOCUMENTACION_FUNCIONAL.md` | Flujo de pantallas, diseño de páginas y procesos automatizados |
| `ARQUITECTURA.md` | Estructura de carpetas, paradigmas MVC, CDD y SDD |
| `PRUEBAS_CALIDAD.md` | Diseño de casos de caja negra/blanca + suite automatizada del LMS |
| `IMPLEMENTACION.md` | Especificaciones técnicas, requisitos y plan de implementación |
| `ESTADO_DEL_ARTE.md` | Análisis del contexto tecnológico y educativo del proyecto |
| `METODOLOGIA.md` | Este documento |
| `PROCESOS.md` | SDD: procesos de negocio del sistema |
| `KANBAN.md` | Tablero de sprints de la etapa LMS |
| `AUDITORIA_LMS_2026_06_07.md` | Auditoría del estado del proyecto |
| `MANUAL_ADMIN_LMS.md` | Manual del administrador del LMS |
| `CHECKLIST_DEPLOY_LMS.md` | Checklist de despliegue |
| `documentacion_proyecto_jm_js_alimentos.md` | Documento consolidado del proyecto |

---

## 3.1 Etapa 2 — Evolución a Plataforma LMS (sprints)

Tras el prototipo, el proyecto evolucionó hacia una **plataforma LMS** completa. Esta etapa se organizó formalmente en **10 sprints (Sprint 0 a Sprint 9)** gestionados mediante un tablero Kanban (`documentacion/KANBAN.md`), con su propia *Definition of Done*, backlog y matriz de dependencias entre sprints.

| Sprint | Foco | Resultado principal |
|---|---|---|
| **Sprint 0** | Estabilización, auditoría y preparación | Auditoría del estado, migración a MySQL, base para el LMS |
| **Sprint 1** | Fundamentos de arquitectura LMS | Modelos y migraciones de cursos, categorías, roles, permisos, ventas, etc. |
| **Sprint 2** | Catálogo público dinámico y detalle | `/cursos` desde BD con filtros y página `/cursos/{slug}` |
| **Sprint 3** | CRUD administrativo de cursos | Gestión completa de cursos con publicación/despublicación y duplicación |
| **Sprint 4** | Constructor de módulos y materiales | Módulos reordenables y materiales (video, documento, presentación, texto, recurso) con validación de archivos |
| **Sprint 5** | Experiencia del estudiante y progreso | Aula virtual, consumo de materiales y seguimiento de progreso |
| **Sprint 6** | Estudiantes, ventas, cupones y checkout | Gestión de estudiantes, registro de ventas (`sales`/`sale_items`), cupones y checkout |
| **Sprint 7** | Dashboard ejecutivo y analítica | KPIs reales y gráficos (Chart.js) con caché de métricas |
| **Sprint 8** | Roles, settings, auditoría y seguridad | RBAC por permisos, settings, `audit_logs`, rate limiting y cabeceras de seguridad |
| **Sprint 9** | QA, rendimiento, documentación y release | Factories, seeder demo, suite automatizada, manual y checklist de despliegue |

**Prácticas de esta etapa:** definición de estados y *Definition of Done* por tarea, paquetes de trabajo por sprint, criterios de aceptación verificables y pruebas automatizadas como parte del cierre de cada sprint.



### 4.1 Control de versiones con Git

Cada iteración quedó registrada como un **commit en el repositorio Git**, lo que permite:
- Trazabilidad completa del desarrollo
- Capacidad de revertir cambios si una iteración introduce errores
- Historial claro del progreso del proyecto

```
Historial de commits:
03c753a  feat: index          ← Iteración 1
df56fe4  Ultima version       ← Iteración 2
3bca91f  3era version         ← Iteración 3
accff0b  docs: documentacion  ← Fase documentación (parcial)
c7946e6  4ta version          ← Iteración 4
918c095  docs: estado del arte ← Fase documentación
```

### 4.2 Pruebas por iteración

Cada iteración incluyó verificación manual de los criterios de aceptación. En la etapa LMS, esto se reforzó con una **suite automatizada de PHPUnit** (72 métodos en 14 archivos, Feature + Unit) apoyada en factories y un seeder de datos demo, detallada en `PRUEBAS_CALIDAD.md`.

### 4.3 Separación de entornos

Se mantuvo una separación clara entre:
- **Entorno de desarrollo:** Variables en `.env`, base de datos local MySQL (XAMPP)
- **Entorno de pruebas:** Variables en `phpunit.xml`, SQLite en memoria (`:memory:`)

### 4.4 Integración continua de funcionalidades

Cada funcionalidad nueva se integró de forma que no rompiera las anteriores. El enfoque de **no regresiones** fue prioritario: antes de agregar el chatbot (iteración 3), se verificó que el carrito y el pago (iteración 2) seguían funcionando correctamente.

---

## 5. Roles del Equipo

| Rol | Responsabilidades en el proyecto |
|---|---|
| **Desarrollador Full Stack** | Implementación de backend (Laravel) y frontend (Blade, CSS, React) |
| **Diseñador UX/UI** | Definición de la paleta, tipografía, layouts y experiencia de usuario |
| **Arquitecto de software** | Decisiones de stack, estructura de carpetas y paradigmas (MVC, CDD, SDD) |
| **Tester** | Diseño y ejecución de pruebas de caja negra y caja blanca |
| **Documentador técnico** | Redacción de los documentos técnicos y operativos del proyecto (13 en total) |

> En un equipo pequeño, un mismo integrante puede asumir múltiples roles según la iteración en curso.

---

## 6. Herramientas de Soporte al Desarrollo

| Herramienta | Uso en el proyecto |
|---|---|
| **Git + GitHub** | Control de versiones y repositorio remoto |
| **XAMPP** | Servidor local Apache + PHP para desarrollo |
| **Visual Studio Code** | Editor de código principal |
| **php artisan** | CLI de Laravel: migraciones, tinker, rutas, servidor |
| **Composer** | Gestión de dependencias PHP |
| **npm + Vite** | Gestión de dependencias JS y bundling del frontend |
| **Google AI Studio** | Obtención de la API key para Google Gemini |
| **PHPUnit** | Ejecución de pruebas automatizadas |
| **Laravel Pint** | Formateo de código PHP según PSR-12 |

---

## 7. Comparación con Otras Metodologías

| Aspecto | Cascada (Waterfall) | Scrum puro | Iterativo (elegido) |
|---|---|---|---|
| **Flexibilidad** | Baja | Alta | Alta |
| **Documentación** | Extensa al inicio | Mínima | Moderada, al final |
| **Entrega** | Al final | Cada sprint (1-4 semanas) | Por versión funcional |
| **Adaptación a cambios** | Costosa | Natural | Natural |
| **Adecuado para equipo pequeño** | No | Sí | Sí |
| **Trazabilidad** | Alta | Media (depende del tablero) | Alta (commits Git) |
| **Aplicado en este proyecto** | No | Sí, en la etapa LMS (sprints + tablero Kanban) | Sí, en la etapa de prototipo |

> La primera etapa siguió el modelo iterativo; la segunda etapa adoptó explícitamente sprints (Scrum) para construir el LMS, manteniendo Git como mecanismo de trazabilidad.

---

## 8. Resumen del Ciclo de Vida

```
Mayo 2026
│
├── Semana 1 — Planificación
│   └── Requisitos, arquitectura, diseño visual, setup del proyecto
│
├── Semana 2 — Iteración 1
│   └── Páginas públicas: inicio, nosotros, cursos, contacto
│
├── Semana 3 — Iteración 2
│   └── Autenticación, carrito, checkout, pago, mi cuenta
│
├── Semana 4 — Iteración 3
│   └── Panel admin, chatbot IA, contactos, inscripciones
│
├── Semana 4 — Iteración 4
│   └── Refinamiento visual, correcciones, ajustes UX
│
├── Semana 4 — Documentación
│   └── Documentos técnicos del prototipo
│
└── Junio 2026 — Etapa LMS (Sprints 0 a 9)
    └── Arquitectura LMS, catálogo dinámico, CRUD de cursos, módulos y
        materiales, aula del estudiante, ventas y cupones, dashboard
        analítico, RBAC, settings, auditoría, QA y release
```

---

*Metodología de Desarrollo — JM y JS Alimentos — Actualizada a junio de 2026 (incluye la etapa LMS por sprints)*
