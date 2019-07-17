FROM richarvey/nginx-php-fpm:1.7.1

COPY ./nginx/default.conf /etc/nginx/sites-available/default.conf

WORKDIR /var/www/site
COPY ./ /var/www/site
RUN composer install

RUN chmod 777 -R /var/www/site/web/sites
RUN chmod 777 -R /var/www/site/logs
