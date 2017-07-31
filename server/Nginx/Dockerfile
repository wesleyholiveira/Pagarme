FROM debian:jessie

RUN apt-get update && apt-get install -y nginx

RUN usermod -u 1000 www-data
RUN chown -R $USER:$USER /var/www/html
RUN chmod -R 755 /var/www/html
CMD ["nginx"]

EXPOSE 80
EXPOSE 443
