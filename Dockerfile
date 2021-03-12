FROM php:7.4.15-apache

COPY ./app /var/www/html/app
COPY ./framework /var/www/html/framework
COPY ./composer.json /var/www/html/
COPY ./index.php /var/www/html/
COPY ./xdebug.ini /usr/local/etc/php/conf.d/
COPY ./promo.conf /etc/apache2/sites-available/

RUN apt-get update

#install xdebuger
RUN pecl install -f xdebug-2.9.6
#enable xdebuger
RUN docker-php-ext-enable xdebug

#install vim
RUN apt-get -y install vim

#install git
RUN apt-get install -y git

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#enable rewrite
RUN a2enmod rewrite
#disable default config
RUN a2dissite 000-default.conf
#enable custom config
RUN a2ensite promo.conf


EXPOSE 80

