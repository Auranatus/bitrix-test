FROM phpdockerio/php:8.2-fpm
WORKDIR "/var/www/bitrix-test"

RUN apt-get update \
    && apt-get -y --no-install-recommends install \
        php8.2-mysql \ 
        php8.2-redis \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
    
RUN chown -R 1000:1000 /var/lib/php/sessions/

RUN usermod -u 1000 www-data
