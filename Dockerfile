FROM php:7.2-apache

RUN apt-get update && apt-get install -qq -y \
  build-essential libpq-dev --fix-missing --no-install-recommends \
  && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
  && docker-php-ext-install pdo pdo_pgsql pgsql

COPY . /var/www/html

EXPOSE 80

CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
