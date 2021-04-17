# Composer install vendor dir
composer install

# Generate artisan key
php artisan key:generate

# Wait for mysql to start-up
echo "Waiting $time seconds for mysql to be setup..."
sleep $time

# Migrate database
php artisan migrate:fresh --seed

echo "$(env | grep "ADMIN_PW=.*")" >> /etc/environment

# Start cron service
service cron start

# Start apache2 server
apache2-foreground