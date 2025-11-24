FROM php:8.2-apache
RUN a2enmod rewrite
ENV APACHE_DOCUMENT_ROOT=/var/www/transporteprivadomvc
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/conf-available/*.conf && sed -ri -e 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf
WORKDIR /var/www/transporteprivadomvc
ENV TZ=America/Bogota
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
RUN echo "date.timezone=$TZ" > /usr/local/etc/php/conf.d/99-timezone.ini
RUN printf "display_errors=On\ndisplay_startup_errors=On\nerror_reporting=E_ALL\nlog_errors=On\nerror_log=/var/log/apache2/php_errors.log\n" > /usr/local/etc/php/conf.d/99-errors.ini
EXPOSE 80