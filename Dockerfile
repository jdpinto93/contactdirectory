# Usa la imagen base de Laravel Octane
FROM elrincondeisma/octane:latest

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

# Copia Composer desde otra imagen (si es necesario)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia RoadRunner desde otra imagen (si es necesario)
COPY --from=spiralscout/roadrunner:2.4.2 /usr/bin/rr /usr/bin/rr

# Establece el directorio de trabajo
WORKDIR /app

# Copia los archivos de la aplicación
COPY . .

# Instala las dependencias de Composer
RUN composer install --prefer-dist --no-dev --no-scripts --no-autoloader

# Instala Laravel Octane y RoadRunner
RUN composer require laravel/octane spiral/roadrunner

# Copia el archivo .env
COPY .env.example .env

# Crea el directorio de logs
RUN mkdir -p /app/storage/logs

# Limpia las cachés
RUN php artisan cache:clear
RUN php artisan view:clear
RUN php artisan config:clear

# Instala Octane y configura el servidor
RUN php artisan octane:install --server="swoole"

# Define el comando de inicio
CMD php artisan octane:start --server="swoole" --host="0.0.0.0"

# Expone el puerto 8000
EXPOSE 8000
