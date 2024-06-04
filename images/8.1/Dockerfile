FROM php:8.1-apache
ARG VERSION=latest
LABEL maintainer="Derek P Sifford <dereksifford@gmail.com>" \
      version="${VERSION}-php8.1"

SHELL ["/bin/bash", "-o", "pipefail", "-c"]

# Install base requirements & sensible defaults + required PHP extensions
# hadolint ignore=DL3008
RUN echo "deb http://ftp.debian.org/debian $(sed -n 's/^VERSION=.*(\(.*\)).*/\1/p' /etc/os-release)-backports main" >> /etc/apt/sources.list \
    && apt-get update \
    && apt-get install -y --no-install-recommends \
        bash-completion \
        bindfs \
        ghostscript \
        less \
        libjpeg-dev \
        libmagickwand-dev \
        libpng-dev \
        libxml2-dev \
        libzip-dev \
        mariadb-client \
        sudo \
        unzip \
        vim \
        zip \
        certbot \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    # Install and enable extensions
    && pecl install redis \
    && pecl install imagick \
    && docker-php-ext-install \
        bcmath \
        exif \
        gd \
        mysqli \
        opcache \
        soap \
        zip \
    && docker-php-ext-enable redis imagick \
    && { \
        echo 'memory_limit = 512M'; \
        echo 'upload_max_filesize = 64M'; \
        echo 'post_max_size = 64M';  \
        echo 'max_input_time = 60'; \
        echo 'max_input_vars = 2000'; \
    } > /usr/local/etc/php/php.ini \
    && { \
        echo 'opcache.memory_consumption = 128'; \
        echo 'opcache.interned_strings_buffer = 8'; \
        echo 'opcache.max_accelerated_files = 4000'; \
        echo 'opcache.revalidate_freq = 2'; \
        echo 'opcache.fast_shutdown = 1'; \
        echo 'opcache.enable_cli = 1'; \
    } > /usr/local/etc/php/conf.d/opcache-recommended.ini \
    && sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf \
    && echo 'ServerName localhost' > /etc/apache2/conf-available/fqdn.conf \
    && curl --create-dirs \
        -o /usr/local/bin/wp https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
        -o /etc/bash_completion.d/wp-cli https://raw.githubusercontent.com/wp-cli/wp-cli/master/utils/wp-completion.bash \
    && a2enconf fqdn \
    && a2enmod rewrite expires

# Add admin superuser, create install directory, adjust perms, & add symlink
COPY run.sh /run.sh
RUN useradd -ms /bin/bash -G sudo admin \
    && echo "admin ALL=(root) NOPASSWD:ALL" > /etc/sudoers.d/admin \
    && chmod 0440 /etc/sudoers.d/admin \
    && chmod +x /usr/local/bin/wp /run.sh \
    && mkdir -m 0700 /app \
    && chown admin:admin /app \
    && printf '%s\t%s\t%s\t%s%s%s%s%s%s%s%s\t%d\t%d\n' \
        '/app' \
        '/var/www/html' \
        'fuse.bindfs' \
            'force-user=www-data,' \
            'force-group=www-data,' \
            'create-for-user=admin,' \
            'create-for-group=admin,' \
            'create-with-perms=0644:a+X,' \
            'chgrp-ignore,' \
            'chown-ignore,' \
            'chmod-ignore' \
        0 \
        0 > /etc/fstab

USER admin
WORKDIR /app
EXPOSE 80 443
CMD ["/run.sh"]

COPY ./usr/local/etc/php/php.ini /usr/local/etc/php/php.ini


# Install PHPUnit
RUN curl -LO https://phar.phpunit.de/phpunit-10.phar \
    && chmod +x phpunit-10.phar \
    && sudo mv phpunit-10.phar /usr/local/bin/phpunit

# Update repositories and install svn
RUN sudo apt-get update && sudo apt-get install -y subversion
