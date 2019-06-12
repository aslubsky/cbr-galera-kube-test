FROM richarvey/nginx-php-fpm:1.2.6

COPY log.sql /var/www/html/log.sql
COPY test.php /var/www/html/test.php