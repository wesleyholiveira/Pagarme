FROM php:7.1-fpm

RUN echo 'deb http://httpredir.debian.org/debian jessie contrib' >> /etc/apt/sources.list
RUN export DEBIAN_FRONTEND=noninteractive && apt-get update

#Git
RUN apt-get update
RUN apt-get install -y -f git

#LIBS
RUN apt-get install -y zip unzip
RUN docker-php-ext-install mbstring

#PDO
RUN docker-php-ext-install pdo_mysql

#Projeto
RUN git clone https://github.com/wesleyholiveira/Pagarme \
&& cd Pagarme \
&& mv .env.example .env
&& php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
&& php -r "if (hash_file('SHA384', 'composer-setup.php') === '669656bab3166a7aff8a7506b8cb2d1c292f042046c5a994c43155c0be6190fa0355160742ab2e1c88d40d5be660b410') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
&& php composer-setup.php \
&& php -r "unlink('composer-setup.php');" \
&& php composer.phar install \
&& php vendor/doctrine/orm/bin/doctrine orm:schema-tool:create --dump-sql --verbose

EXPOSE 9000
CMD ["php-fpm"]
