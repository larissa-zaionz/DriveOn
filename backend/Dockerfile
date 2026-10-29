FROM php:8.4-cli-trixie

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

RUN apt-get update && apt-get install -y --no-install-recommends \
        curl git unzip libzip-dev libpq-dev \
    && docker-php-ext-install pdo_pgsql zip bcmath \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /app


COPY composer.json composer.lock ./
RUN composer install --no-interaction --prefer-dist --no-scripts --no-autoloader

COPY . .
RUN composer dump-autoload --optimize \
    && composer check-platform-reqs

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]