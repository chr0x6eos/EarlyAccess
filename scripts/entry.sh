# Composer install vendor dir
composer install

# Generate artisan key
php artisan key:generate

# Wait for mysql to start-up
sleep $time

# Migrate database
php artisan migrate:fresh --seed

# Start cron service
service cron start

# Start apache2 server
apache2-foreground