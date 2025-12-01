#!/bin/bash

# 🔮 ZODIAC SIGN API - RAILWAY BUILD SCRIPT

echo "=== BUILDING FOR RAILWAY ==="

# Instalar dependencias
composer install --no-dev --optimize-autoloader

# Generar APP_KEY si no existe
if [ -z "$APP_KEY" ]; then
    echo "Generando APP_KEY..."
    php artisan key:generate --force
fi

# Cache de configuración
php artisan config:cache
php artisan route:cache

echo "=== BUILD COMPLETADO ==="
echo "Iniciando servidor en puerto ${PORT:-8080}..."

# Iniciar servidor
php -S 0.0.0.0:${PORT:-8080} -t public
