# Usar la imagen oficial de PHP como base
FROM php:8.3-fpm-alpine

# Instalar dependencias necesarias
RUN apk update && apk add --no-cache \
    libpng libjpeg-turbo libwebp \
    libxml2 zlib \
    curl bash git \
    && apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && docker-php-ext-install gd xml \
    && apk del .build-deps

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

# Copiar archivos del proyecto
WORKDIR /app
COPY . .

# Instalar dependencias de Composer
RUN composer install

# Copiar el archivo .env y crear directorios necesarios
COPY .env.example .env
RUN mkdir -p /app/storage/logs

# Ejecutar comandos de Artisan para configurar la aplicación
RUN php artisan cache:clear
RUN php artisan view:clear
RUN php artisan config:clear
RUN php artisan octane:install --server="swoole"

# Comando para iniciar el servidor Octane
CMD ["php", "artisan", "octane:start", "--server=swoole", "--host=0.0.0.0"]

EXPOSE 8000
