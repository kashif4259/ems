# Use the official PHP 8 image with Apache
FROM php:8-apache

# Copy the source code into the container
COPY src/ /var/www/html/

# Configure Apache to avoid "ServerName" issues
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Expose port 7000
EXPOSE 7001

# Install the PHP extension installer script
ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Install necessary PHP extensions
RUN install-php-extensions \
        gd \
        xdebug \
        pdo \
        pdo_mysql \
        imagick \
        zip \
        xml \
        zlib \
        iconv \
        simplexml \
        xmlreader

# Enable Apache's mod_rewrite
RUN a2enmod rewrite

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the correct permissions for the web root
RUN chown -R www-data:www-data /var/www/html

# Ensure the Apache .htaccess works as expected by allowing overrides
RUN sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf
