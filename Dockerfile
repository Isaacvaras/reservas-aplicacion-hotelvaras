FROM php:8.2-cli

# Instalar extensiones necesarias y Composer
RUN apt-get update \
    && apt-get install -y unzip git zip libpq-dev curl \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

COPY . .

# Instalar dependencias y configurar Laravel
RUN composer install --no-dev --optimize-autoloader \
    && cp .env.example .env \
    && php artisan key:generate

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000
