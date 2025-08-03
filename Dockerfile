FROM php:8.2-cli

WORKDIR /app

# Instalar extensiones y Composer
RUN apt-get update \
    && apt-get install -y unzip git zip libpq-dev \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .

RUN composer install --no-dev --optimize-autoloader \
    && cp .env.example .env \
    && php artisan key:generate

CMD php artisan serve --host=0.0.0.0 --port=8000
