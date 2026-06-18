@echo off
chcp 65001 >nul
echo Iniciando servidor en http://127.0.0.1:8000 ...
echo (Presiona Ctrl+C para detenerlo)
start http://127.0.0.1:8000
php artisan serve
