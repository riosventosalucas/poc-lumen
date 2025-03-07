# Utilizar la imagen oficial de PHP con Apache como base
FROM php:8.2-apache

# Habilitar mod_rewrite de Apache (necesario para Lumen)
RUN a2enmod rewrite

# Instalar las dependencias necesarias
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zip git

# Instalar las extensiones de PHP necesarias
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Definir el directorio de trabajo
WORKDIR /var/www/html

# Copiar los archivos de la aplicación Lumen al contenedor
COPY . /var/www/html/

# Copiar el archivo de configuración de Apache
COPY ./apache/vhost.conf /etc/apache2/sites-available/000-default.conf

# Instalar Composer (gestor de dependencias de PHP)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar las dependencias de la aplicación
RUN composer install --no-dev --optimize-autoloader

# Cambiar permisos en la carpeta storage y bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap

# Exponer el puerto en el que Apache escucha
EXPOSE 80

# Iniciar Apache en el contenedor
CMD ["apache2-foreground"]
