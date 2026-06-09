# Checklist Deploy LMS - JM y JS Alimentos

## Pre-Deploy

- Ejecutar `composer install --no-dev --optimize-autoloader`.
- Ejecutar `npm ci` y `npm run build`.
- Confirmar `composer audit`.
- Confirmar `npm audit --audit-level=moderate`.
- Confirmar `php artisan test`.

## Variables De Entorno

Configurar `.env`:

- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL=https://dominio-final`
- `APP_KEY` generado con `php artisan key:generate`
- `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
- `FILESYSTEM_DISK=public`
- `SESSION_ENCRYPT=true`
- `SESSION_SECURE_COOKIE=true`
- `SESSION_SAME_SITE=lax`
- `GEMINI_API_KEY`
- `GEMINI_MODEL=gemini-2.5-flash`
- variables de Stripe si se activa pago real
- variables SMTP si se activan correos reales

No versionar `.env`.

## Base De Datos

- Crear base de datos y usuario con permisos minimos.
- Ejecutar `php artisan migrate --force`.
- Ejecutar `php artisan db:seed --force` solo si se necesita data base o demo.
- No ejecutar `migrate:fresh` en produccion.

## Storage Y Archivos

- Ejecutar `php artisan storage:link`.
- Verificar permisos de escritura en `storage/app`, `storage/framework`, `storage/logs` y `bootstrap/cache`.
- Verificar subida de portadas y materiales.
- Verificar descarga privada de materiales desde aula.

## Cache Y Rendimiento

- Ejecutar `php artisan config:cache`.
- Ejecutar `php artisan route:cache`.
- Ejecutar `php artisan view:cache`.
- Confirmar paginacion en listados admin.
- Confirmar dashboard con cache de metricas.

## Seguridad

- Forzar HTTPS en servidor web.
- Activar HSTS si todo el dominio opera con HTTPS.
- Mantener headers de seguridad activos.
- Confirmar rate limit en login y `/api/chat`.
- Confirmar que roles no admin reciben 403 en areas no permitidas.
- Confirmar que el chatbot funciona sin exponer la clave.
- Configurar backups de BD y archivos privados.
- Configurar rotacion de logs.

## Smoke Test Final

1. Abrir home, catalogo, detalle de curso y contacto.
2. Registrar usuario.
3. Iniciar sesion.
4. Agregar curso publicado al carrito.
5. Aplicar cupon valido.
6. Procesar checkout.
7. Confirmar venta, item de venta y matricula.
8. Entrar a `Mi cuenta`.
9. Abrir aula del curso comprado.
10. Marcar material como completado.
11. Entrar como admin.
12. Crear curso borrador.
13. Crear modulo y material.
14. Publicar curso.
15. Revisar dashboard, ventas, estudiantes, settings y auditoria.

## Rollback

- Mantener backup previo de BD.
- Mantener artefacto previo de `public/build`.
- Si falla una migracion, restaurar backup o aplicar una migracion correctiva revisada.
