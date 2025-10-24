#!/bin/bash

echo "INSTALACIÓN - Laravel Piramide"
echo "========================================"

if ! command -v docker &> /dev/null; then
    echo "Docker no está instalado"
    exit 1
fi

if [ ! -d "app/vendor" ]; then
    echo "Creando proyecto Laravel..."
    docker run --rm -v $(pwd):/app composer create-project laravel/laravel app --prefer-dist
else
    echo "Proyecto Laravel ya existe"
fi

echo "Iniciando contenedores Docker..."
docker compose up -d --build

echo "Esperando que los servicios estén listos..."
sleep 15

echo "Instalando dependencias adicionales..."
docker compose exec app composer require guzzlehttp/guzzle laravel/sanctum laravel/tinker

echo "Aplicando permisos..."
docker compose exec app chmod -R 775 storage bootstrap/cache
docker compose exec app chown -R www-data:www-data storage bootstrap/cache

echo "¡Instalación completada!"
echo "Accede a: http://localhost:8000"
