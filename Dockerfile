FROM php:7.4-apache

RUN apt-get update && \
    apt-get -y install apt-utils gnupg2 && \
    apt-get -y upgrade && \
    apt-get update --fix-missing && \
    apt-get --purge autoremove -y

RUN apt-get install -y zip speedtest-cli iputils-ping

RUN a2enmod rewrite
RUN docker-php-ext-install pdo_mysql

# copy files
WORKDIR /var/www
COPY ./compose_for_production/apache.conf /etc/apache2/sites-available/000-default.conf
COPY ./start.sh /usr/local/bin/start
RUN chmod u+x /usr/local/bin/start
#COPY ./horizon.conf /etc/supervisor/conf.d/horizon.conf
COPY ./src /var/www

# install composer packages
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    composer global require hirak/prestissimo
RUN composer install --no-dev --no-scripts

# cleanup
RUN rmdir /var/www/html && \
    chown -R www-data: /var/www && \
    rm -rf /root/.composer && \
    rm -rf /var/lib/apt/lists/*

CMD ["/usr/local/bin/start"]
