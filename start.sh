#!/usr/bin/env bash
# https://laravel-news.com/laravel-scheduler-queue-docker
# https://laravel.com/docs/7.x/horizon#deploying-horizon

set -e

role=${CONTAINER_ROLE:-app}
env=${APP_ENV:-production}

#if [ "$env" != "local" ]; then
    # (cd /var/www && /usr/local/bin/php artisan config:cache && /usr/local/bin/php artisan route:cache && /usr/local/bin/php artisan view:cache)
#fi

if [ "$role" = "app" ]; then
    exec apache2-foreground

elif [ "$role" = "horizon" ]; then
    service supervisor start && apache2-foreground

elif [ "$role" = "queue" ]; then
    /usr/local/bin/php /var/www/artisan queue:work --tries=3 --queue=high,default,video --verbose --timeout=90

elif [ "$role" = "scheduler" ]; then
    while [ true ]
        do
            /usr/local/bin/php /var/www/artisan schedule:run --verbose --no-interaction &
            sleep 60
        done

else
    exit 1
fi
