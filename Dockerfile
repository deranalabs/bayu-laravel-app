FROM php:8.2-apache

# Install PHP extensions yang umum digunakan Laravel
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip curl libonig-dev libpng-dev libxml2-dev && \
    docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set direktori kerja
WORKDIR /var/www/html

# Copy seluruh kode proyek ke dalam image
COPY . /var/www/html

# Copy konfigurasi Apache custom
COPY ./docker/apache.conf /etc/apache2/sites-available/000-default.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set permission folder storage & cache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Install dependencies Laravel
RUN composer install --no-dev --optimize-autoloader

# Ekspose port 80
EXPOSE 80

# Jalankan Apache saat container dijalankan
CMD ["apache2-foreground"]
