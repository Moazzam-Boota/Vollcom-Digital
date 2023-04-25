#!/bin/bash
echo -e "\n#### COMPOSER INSTALL ####\n"
cd /var/www/vhosts/vollcom-digital.com/httpdocs/dev.vollcom-digital.com/src
/opt/plesk/php/7.4/bin/php /usr/lib/plesk-9.0/composer.phar update --no-dev --no-interaction --verbose
echo -e "\n#### DONE ####\n"

echo -e "\n#### SET USER PERMISSIONS ####\n"
cd /var/www/vhosts/vollcom-digital.com/httpdocs/dev.vollcom-digital.com/src/web
chown j4vnbnh3m86k . -R
chgrp psacln . -R
chmod g+w app/ -R
