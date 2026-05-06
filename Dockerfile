FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    curl unzip git libpng-dev libonig-dev \
    libxml2-dev zip nodejs npm \
    && docker-php-ext-install pdo pdo_mysql mbstring

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build
RUN cp .env.example .env && php artisan key:generate

EXPOSE 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
