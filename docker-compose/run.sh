#!/usr/bin/env bash

cd /var/www

/usr/bin/php artisan migrate -n --force
/usr/bin/php artisan cache:clear -n
/usr/bin/php artisan route:cache -n
/usr/bin/php artisan db:seed -n

/usr/bin/supervisord -c /etc/supervisord.conf
