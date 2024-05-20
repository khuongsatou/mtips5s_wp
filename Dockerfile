FROM --platform=linux/amd64 wordpress:php8.1-apache

WORKDIR /var/www/html

VOLUME /var/www/html

RUN rm -rf /var/www/html/wp-content
COPY src/wp-content /var/www/html/wp-content
