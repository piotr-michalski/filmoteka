FROM php:8.4.6-fpm AS php_base
RUN groupadd -g 1000 app && useradd -u 1000 -g app -m app
RUN apt-get update && apt-get install -y \
    curl \
    unzip \
    && apt-get autoremove -y \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.8.5
RUN mkdir -p /var/www/html/app

COPY ./php/zz-docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf
COPY ./src /var/www/html/app
RUN chown -R app:app /var/www/html/app
RUN mkdir -p -m 700 /var/run/php && chown -R app:app /var/run/php
WORKDIR /var/www/html/app
RUN composer install --no-interaction --no-progress

FROM php_base AS php_prod
USER app
CMD ["php-fpm"]