# Menggunakan base image PHP
FROM php:8.2-fpm

# Install dependencies yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Set working directory
WORKDIR /var/www

# Copy semua file dari laptop ke dalam container
COPY . .

# Install composer (untuk manage package Laravel)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Memberi akses folder storage agar bisa ditulis (untuk upload/cache)
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Menjalankan aplikasi
EXPOSE 8080
CMD php artisan serve --host=0.0.0.0 --port=8080