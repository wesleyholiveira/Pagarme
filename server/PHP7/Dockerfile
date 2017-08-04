FROM php:7-fpm-alpine

RUN apk update \
&& apk add libmcrypt-dev libxml2-dev \
&& docker-php-ext-install xml mcrypt mysqli pdo_mysql mbstring dom zip tokenizer pdo \ 
&& rm /var/cache/apk/*

