#!/bin/bash

echo "1. Deteniendo contenedores..."
docker compose down

echo "2. Reconstruyendo contenedores..."
docker compose build --no-cache

echo "3. Iniciando contenedores..."
docker compose up -d

echo "4. Esperando que los servicios inicien..."
sleep 10

echo "5. Verificando estructura de archivos..."
docker compose exec app ls -la /var/www/html/

echo "6. Instalando dependencias de Composer..."
docker compose exec app composer install --no-interaction --no-dev

echo "7. Generando clave de aplicación..."
docker compose exec app php artisan key:generate

echo "8. Verificando instalación..."
docker compose exec app php artisan --version

echo "¡Reparación completada!"
echo "Accede a: http://localhost:8000"
