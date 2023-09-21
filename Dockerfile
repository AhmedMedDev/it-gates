FROM php:8.1-fpm

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    libexif-dev && docker-php-ext-install zip pdo pdo_mysql exif

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .

RUN composer install
RUN composer dump-autoload

EXPOSE 8000

CMD ["php", "artisan", "serve", "--port=8000", "--host=0.0.0.0"]