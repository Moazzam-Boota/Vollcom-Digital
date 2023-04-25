#!/bin/bash
cat >/etc/motd <<EOL
  _____
  /  _  \ __________ _________   ____
 /  /_\  \\___   /  |  \_  __ \_/ __ \
/    |    \/    /|  |  /|  | \/\  ___/
\____|__  /_____ \____/ |__|    \___  >
        \/      \/                  \/
A P P   S E R V I C E   O N   L I N U X

Documentation: http://aka.ms/webapp-linux
PHP quickstart: https://aka.ms/php-qs

EOL
cat /etc/motd

echo "+++ Starting SSH +++"
service ssh start
echo "+++ SSH started +++"

echo "+++ Invoke Wordpress variables +++"
sed -i "s/{DB_HOST}/$DB_HOST/g" /var/www/html/config/application.php
sed -i "s/{DB_PORT}/$DB_PORT/g" /var/www/html/config/application.php
sed -i "s/{DB_NAME}/$DB_NAME/g" /var/www/html/config/application.php
sed -i "s/{DB_USER}/$DB_USER/g" /var/www/html/config/application.php
sed -i "s/{DB_PASSWORD}/$DB_PASSWORD/g" /var/www/html/config/application.php
echo "+++ Variables invoked +++"

echo "+++ Starting Memcached +++"
/etc/init.d/memcached start
echo "+++ Memcached started +++"

echo "+++ Starting Redis Cache +++"
/etc/init.d/redis-server start
echo "+++ Redis Cache started +++"

echo "+++ Starting PHP-FPM & Nginx +++"
php-fpm -D; nginx
