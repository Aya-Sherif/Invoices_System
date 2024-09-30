# Use PHP with Apache as the base image
FROM php:8.2-apache as web

ARG CACHEBUST=1
RUN echo "Cache bust: ${CACHEBUST}"
 
# Install Additional System Dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    npm \
    openssl

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
 
# Enable Apache mod_rewrite and SSL for URL rewriting and HTTPS support
RUN a2enmod rewrite ssl

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql zip
 
# Configure Apache DocumentRoot to point to Laravel's public directory
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Create self-signed certificates (for development purposes)
RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
    -keyout /etc/ssl/private/apache-selfsigned.key \
    -out /etc/ssl/certs/apache-selfsigned.crt \
    -subj "/C=US/ST=State/L=City/O=Organization/OU=Department/CN=localhost"

# Copy a default SSL-enabled virtual host configuration
COPY ./000-default-ssl.conf /etc/apache2/sites-available/000-default-ssl.conf

# Enable the SSL virtual host
RUN a2ensite 000-default-ssl.conf

# Copy the application code
COPY . /var/www/html

# Set the working directory
WORKDIR /var/www/html
 
# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
 
# Install project dependencies via Composer
RUN composer install --no-dev --optimize-autoloader

# Install NPM dependencies and build assets using Vite
RUN rm -rf node_modules 
RUN npm install
RUN npm run build

# Set correct permissions for storage and cache directories
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public
RUN chmod -R 755 /var/www/html/storage
RUN mkdir /var/www/html/public/front/img && chmod -R 777 /var/www/html/public/front/img

# Expose ports 80 (HTTP) and 443 (HTTPS)
EXPOSE 80 443

# Start Apache server in foreground
CMD ["apache2-foreground"]
