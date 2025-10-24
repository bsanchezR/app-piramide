FROM php:8.2-fpm

# Instalando dependencias
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Limpiamos cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalando dependencias PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd dom


# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definimos directorio
WORKDIR /var/www/html

# Copiamos el contenido de la aplicacion
COPY ./app /var/www/html

# Instalando dependencias Composer
RUN composer install --no-interaction --no-dev --optimize-autoloader

# Otorgamos permisos
RUN chown -R www-data:www-data /var/www/html/storage
RUN chown -R www-data:www-data /var/www/html/bootstrap/cache

# Abrimos port 9000 e iniciamos php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
