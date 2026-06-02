FROM php:8.2-apache

# Install ekstensi yang dibutuhkan
RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite \
    && rm -rf /var/lib/apt/lists/*

# Aktifkan mod_rewrite (untuk jaga-jaga)
RUN a2enmod rewrite

# Copy source code
COPY . /var/www/html/

# Set permission
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Pastikan /tmp writable untuk SQLite
RUN chmod 1777 /tmp

EXPOSE 80
