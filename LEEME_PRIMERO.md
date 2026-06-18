# Plataforma de Capacitación en Línea — JM y JS Alimentos

Proyecto listo para correr en VS Code + XAMPP (Windows).

## Requisitos
- XAMPP con **MySQL iniciado** (puerto 3306, el de por defecto)
- PHP 8.2+ (el de XAMPP sirve) y **Composer** instalados

## Instalación (solo la primera vez)
1. Extrae esta carpeta donde quieras (ej. `C:\xampp\htdocs\FINAL`).
2. Abre el Panel de XAMPP e inicia **MySQL**.
3. Haz doble clic en **`INSTALAR.bat`**
   (o en la terminal de VS Code: `composer install`, `php artisan migrate --seed`, `php artisan storage:link`).
   - Si pregunta si crear la base de datos `jm_js_alimentos`, responde **yes**.

## Para correr el proyecto
- Doble clic en **`INICIAR.bat`** (o `php artisan serve` en la terminal).
- Abre: **http://127.0.0.1:8000**

## Notas
- El archivo `.env` ya viene configurado: MySQL en `127.0.0.1:3306`, base `jm_js_alimentos`, usuario `root` sin contraseña (configuración por defecto de XAMPP).
- La clave de Gemini (chatbot) ya está en el `.env`. **No subir el `.env` a GitHub.**
- Datos demo: el seeder crea roles, categorías, cursos y el cupón `DEMO20`.
