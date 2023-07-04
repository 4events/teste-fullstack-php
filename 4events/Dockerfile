FROM php:8.1-cli

RUN  pecl install swoole \ 
    && docker-php-ext-enable swoole \
    && docker-php-ext-install mysqli pdo_mysql

COPY . / /var/www

ENTRYPOINT [ "php", "/var/www/server.php", "start"]