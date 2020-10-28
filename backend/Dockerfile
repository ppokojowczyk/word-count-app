FROM php:7.2.24-fpm

RUN apt-get update && apt-get install -y \
    git 

RUN apt-get install -y zip libzip-dev
RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo pdo_mysql

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

RUN mkdir -p /srv/app/backend/
WORKDIR /srv/app/backend/

COPY composer.json /srv/app/backend/
COPY composer.lock /srv/app/backend/

RUN composer install

COPY . /srv/app/backend/

CMD [ "php", "-S", "0.0.0.0:4500", "./public/index.php" ]
