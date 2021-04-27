# Generate artisan key
php artisan key:generate

# Wait for mysql to start-up
echo "Waiting $time seconds for mysql to be setup..."
sleep $time

# Migrate database
php artisan migrate:fresh --seed

# PROD:
#composer install --optimize-autoloader --no-dev
#php artisan config:cache
#php artisan route:cache
#php artisan view:cache

echo "$(env | grep "ADMIN_PW=.*")" >> /etc/environment

# Create user
useradd -ms /bin/bash -p $(openssl passwd -crypt "$ADMIN_PW") www-adm
ln -s /dev/null /home/www-adm/.bash_history

# Start cron service
service cron start

# Start apache2 server
apache2-foreground
