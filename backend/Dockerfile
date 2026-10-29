FROM php:8.4-cli-trixie

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Pacotes do sistema e extensões do PHP
RUN apt-get update && apt-get install -y --no-install-recommends \
        curl git unzip libzip-dev libpq-dev \
    && docker-php-ext-install pdo_pgsql zip bcmath \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /app

# 1) Só os arquivos do Composer: se eles não mudarem, o Docker reaproveita o cache
COPY composer.json composer.lock ./
RUN composer install --no-interaction --prefer-dist --no-scripts --no-autoloader

# 2) O restante do projeto
COPY . .
RUN composer dump-autoload --optimize \
    && composer check-platform-reqs

EXPOSE 8000

# O .env vem do bind mount (./backend:/app), disponível só quando o contêiner inicia
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]