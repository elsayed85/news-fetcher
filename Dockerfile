FROM  alpine:3.18
WORKDIR /var/www/html

# Install system dependencies
RUN apk add --no-cache \
  curl \
  git \
  nginx \
  npm \
  php82 \
  php82-ctype \
  php82-curl \
  php82-dom \
  php82-fpm \
  php82-gd \
  php82-intl \
  php82-mbstring \
  php82-mysqli \
  php82-opcache \
  php82-openssl \
  php82-phar \
  php82-session \
  php82-xml \
  php82-xmlreader \
  php82-simplexml \
  php82-zlib \
  php82-fileinfo \
  php82-sodium \
  php82-tokenizer \
  php82-exif \
  php82-xmlwriter \
  php82-pdo \
  php82-pdo_mysql \
  php82-redis \
  php82-pear \
  php82-dev \
  php82-zip \
  php82-sockets \
  php82-iconv \
  php82-pdo_sqlite\
  supervisor \
  busybox-extras

RUN ln -s /usr/bin/php82 /usr/bin/php

# Clear cache
RUN rm -rf /var/lib/apt/lists/* && \
    rm -rf /tmp/*

RUN adduser -u 1001 -D -h /home/inno inno

RUN mkdir -p /home/inno/.composer && \
    chown -R inno:inno /home/inno

RUN chown -R inno:inno /var/lib/nginx && \
    chmod -R 777 /var/lib/nginx

RUN chown -R inno:inno /run && \
    chmod -R 777 /run /var/www/html

RUN touch /var/run/nginx.pid && \
    touch /run/nginx/nginx.pid && \
    chown -R nginx:nginx /var/run/nginx.pid /run/nginx.pid /run/nginx/nginx.pid

RUN mkdir /var/log/supervisor && \
    touch /var/log/supervisor/worker.log && \
    chmod 644 /var/log/supervisor/worker.log


RUN chown -R inno:inno /run && \
    chmod -R 777 /run /var/www/html /var/log

COPY docker-config/nginx/nginx.conf /etc/nginx/nginx.conf
COPY docker-config/php.ini /etc/php82/php.ini
COPY docker-config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker-config/php/clear-env.conf /etc/php82/php-fpm.d/clear-env.conf
COPY --from=composer /usr/bin/composer /usr/bin/composer

USER nobody

COPY --chown=nobody . /var/www/html/

COPY .env.example /var/www/html/.env

USER root

RUN composer install --ignore-platform-reqs

RUN chmod -R 777 /var/www/html/storage

CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

USER inno

EXPOSE 2001
