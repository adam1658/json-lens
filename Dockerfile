FROM php:7.3.8-cli

# Install composer *************************************************************
ENV COMPOSER_ALLOW_SUPERUSER 1
COPY dev-setup/scripts /scripts
RUN /scripts/install-composer.sh


# PHP Extensions ***************************************************************
# Dependencies
RUN apt-get update \
 && apt-get install -y \
        libzip-dev \
        zip

# The extensions themselves
RUN docker-php-ext-install -j$(nproc) zip
RUN pecl install xdebug;

# PHP Configuration ************************************************************
COPY dev-setup/config/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Workdir setup ****************************************************************
WORKDIR /json-lens

# Expose vendor binaries on the path
ENV PATH /app/vendor/bin:$PATH
