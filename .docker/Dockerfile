FROM php:7.4.1-apache

USER root

WORKDIR /var/www/html

# Install PHP extensions
RUN apt-get update && apt-get install -y \
        libpng-dev \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        zip \
        curl \
        unzip \
        #nodejs \
        #npm \
        w3m \
        cron \
        vim \
    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install zip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

#RUN npm i domcurl

# Setup SSL-Cert
COPY scripts/gen_ssl.sh /opt/gen_ssl.sh
RUN bash /opt/gen_ssl.sh

# Setup composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN chown -R www-data:www-data /var/www/html/ \
    && a2enmod rewrite

# Setup Laravel
COPY scripts/laravel_setup.sh /opt/laravel_setup.sh

RUN echo '* * * * * cd /var/www/html && php artisan schedule:run >> /dev/null 2>&1' >> /etc/crontab