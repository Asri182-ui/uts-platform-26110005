FROM php:8.2-apache
WORKDIR /app
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN sed -ri 's#/var/www/html#/app#g' /etc/apache2/sites-available/000-default.conf
RUN sed -ri 's#/var/www/#/app/#g' /etc/apache2/apache2.conf
RUN sed -ri 's/Listen 80/Listen 8000/' /etc/apache2/ports.conf
RUN sed -ri 's/:80>/:8000>/' /etc/apache2/sites-available/000-default.conf
COPY app/ /app/
EXPOSE 8000
CMD ["apache2-foreground"]
