#!/usr/bin/env bash

echo "Composer install"
cd /certificate-expiry-monitor && /usr/local/bin/composer install

echo "Starting crond"
crond

echo "Creating DB files"
echo '{}' > /certificate-expiry-monitor/storage/pre_checks.json
echo '{}' > /certificate-expiry-monitor/storage/checks.json
echo '{}' > /certificate-expiry-monitor/storage/deleted_checks.json
chown -R $wwwuser /var/www/certificate-expiry-monitor-db/*.json

echo "Starting supervisor"
/usr/bin/supervisord -n -c /etc/supervisord.conf