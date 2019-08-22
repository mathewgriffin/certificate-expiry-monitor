FROM eu.gcr.io/venditan-images/php72-nginx114:latest

# Copy nginx config
COPY ./docker/nginx/ /etc/nginx/

# Set up cron job
COPY ./docker/cron/certificate-expiry-monitor /etc/cron.d/certificate-expiry-monitor
RUN chmod +x /etc/cron.d/certificate-expiry-monitor
RUN crontab /etc/cron.d/certificate-expiry-monitor
RUN touch /var/log/certificate-expiry-monitor.log

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Run entrypoint script
COPY ./docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
ENTRYPOINT ["/bin/sh", "-c", "/entrypoint.sh"]