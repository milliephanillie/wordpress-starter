FROM visiblevc/wordpress:latest-php7.4

COPY ./usr/local/etc/php/php.ini /usr/local/etc/php/php.ini

# Install PHPUnit
RUN curl -LO https://phar.phpunit.de/phpunit-9.phar \
    && chmod +x phpunit-9.phar \
    && sudo mv phpunit-9.phar /usr/local/bin/phpunit

# Update repositories and install svn
RUN sudo apt-get update && sudo apt-get install -y subversion

