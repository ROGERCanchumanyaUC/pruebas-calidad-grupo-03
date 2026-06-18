@echo off
chcp 65001 >nul
echo ============================================
echo  Instalacion - Plataforma de Capacitacion
echo  JM y JS Alimentos (LMS)
echo ============================================
echo.
echo [1/5] Instalando dependencias de Composer...
call composer install
if errorlevel 1 goto error

echo.
echo [2/5] Limpiando cache de configuracion...
call php artisan config:clear

echo.
echo [3/5] Creando base de datos y tablas (migraciones + datos demo)...
echo       Si pregunta "Would you like to create it?", responde: yes
call php artisan migrate --seed
if errorlevel 1 goto error

echo.
echo [4/5] Enlazando carpeta de almacenamiento...
call php artisan storage:link

echo.
echo [5/5] Listo!
echo.
echo ============================================
echo  Instalacion completa.
echo  Para iniciar el servidor ejecuta: INICIAR.bat
echo  Luego abre: http://127.0.0.1:8000
echo ============================================
pause
exit /b 0

:error
echo.
echo ============================================
echo  ERROR durante la instalacion.
echo  Verifica que:
echo   - MySQL este iniciado en XAMPP (puerto 3306)
echo   - Composer y PHP esten instalados
echo ============================================
pause
exit /b 1
