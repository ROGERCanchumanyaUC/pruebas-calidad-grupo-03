# JM y JS Alimentos - Guia de arranque local

Proyecto Laravel 12 + Vite/React.

## Requisitos

- PHP 8.2 o superior
- Composer 2
- Node.js 20+ y npm

## Arranque rapido (recomendado: SQLite)

1. Instalar dependencias:
   - `composer install`
   - `npm ci`
2. Crear entorno:
   - `copy .env.example .env` (Windows)
3. Crear base local SQLite:
   - crear el archivo `database/database.sqlite`
4. Inicializar app:
   - `php artisan key:generate`
   - `php artisan migrate --force`
5. Frontend:
   - `npm run build` (produccion) o `npm run dev` (desarrollo)
6. Levantar:
   - `php artisan serve`

## Verificacion rapida

- Rutas: `php artisan route:list`
- Tests: `php artisan test`

## Usar MySQL de XAMPP (opcional)

Si prefieres MySQL en vez de SQLite, en `.env` usa por ejemplo:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=pruebas_calidad
DB_USERNAME=root
DB_PASSWORD=
```

Luego ejecuta:

- `php artisan migrate --force`

## Nota sobre warning de PHP en XAMPP

Si ves este warning en consola:

`Module "mysqli" is already loaded`

no bloquea el arranque de Laravel, pero conviene corregirlo en `php.ini` para evitar ruido al ejecutar comandos.

## IA (Gemini) opcional

El endpoint `/api/chat` usa Gemini. Si quieres habilitarlo, define en `.env`:

```env
GEMINI_API_KEY=tu_clave
GEMINI_MODEL=gemini-2.5-flash
```
