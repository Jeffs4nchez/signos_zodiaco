@echo off
REM Script para iniciar el Zodiac Sign API en Windows

echo.
echo ========================================
echo    Zodiac Sign API - Laravel Server
echo ========================================
echo.

REM Verificar que el comando artisan existe
if not exist "artisan" (
    echo Error: No se encontro el archivo artisan
    echo Asegure que esta en la carpeta correcta (zodiac-api)
    pause
    exit /b 1
)

REM Mostrar mensaje de inicio
echo Iniciando el servidor Laravel...
echo URL: http://localhost:8000
echo.
echo Presione Ctrl+C para detener el servidor
echo.

REM Iniciar el servidor
php artisan serve

pause
