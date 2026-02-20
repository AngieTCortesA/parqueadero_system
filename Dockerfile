FROM php:8.2-apache

# Instala extensiones necesarias
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# Copia tu proyecto
COPY . /var/www/

# Cambia el DocumentRoot a /var/www/public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/public|g' /etc/apache2/sites-available/000-default.conf

# Habilita mod_rewrite
RUN a2enmod rewrite

# Establece el directorio de trabajo para Composer
WORKDIR /var/www
RUN composer install --no-dev --optimize-autoloader

# Establece permisos seguros
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

EXPOSE 80
