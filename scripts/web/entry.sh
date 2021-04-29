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

# Add hint to wget-config
echo "user=api" > /home/www-adm/.wgetrc
echo "password=s3CuR3_API_PW!" >> /home/www-adm/.wgetrc
chown www-adm:www-adm /home/www-adm/.wgetrc
chmod 600 /home/www-adm/.wgetrc

# Start cron service
service cron start

# Start apache2 server
apache2-foreground
