FROM php:8.3-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    bash \
    git \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    linux-headers

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql bcmath gd

# Install and enable Xdebug
RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

# Configure Xdebug
COPY docker/php/xdebug.ini* /usr/local/etc/php/conf.d/
COPY docker/php/www.conf /usr/local/etc/php-fpm.d/zzz-clear-env.conf

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN touch /tmp/xdebug.log && chmod 666 /tmp/xdebug.log

COPY docker/php/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

WORKDIR /var/www

ENTRYPOINT ["entrypoint.sh"]
CMD ["php-fpm"]
