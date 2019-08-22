#!/usr/bin/env bash

echo "Composer install"
cd /certificate-expiry-monitor && /usr/local/bin/composer install

echo "Starting crond"
crond

echo "Starting supervisor"
/usr/bin/supervisord -n -c /etc/supervisord.conf