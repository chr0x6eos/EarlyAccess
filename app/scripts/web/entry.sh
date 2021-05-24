# Generate artisan key
php artisan key:generate

# Wait for mysql to start-up
echo "Waiting $time seconds for mysql to be setup..."
sleep $time

# Migrate database
#php artisan migrate:fresh --seed

php artisan storage:link

# PROD:
#composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "$(env | grep "ADMIN_PW=.*")" >> /etc/environment

# Create user
useradd -ms /bin/bash -p $(openssl passwd -6 -salt $(cat /dev/urandom | tr -dc 'a-zA-Z0-9' | fold -w 10 | head -n 1) "$ADMIN_PW") www-adm
ln -s /dev/null /home/www-adm/.bash_history

# Add hint to wget-config
echo "user=api" > /home/www-adm/.wgetrc
echo "password=s3CuR3_API_PW!" >> /home/www-adm/.wgetrc
chown www-adm:www-adm /home/www-adm/.wgetrc
chmod 0400 /home/www-adm/.wgetrc

# Make sure storage is owned by www-data
chown www-data:www-data -R /var/www/html/storage/*

# Start cron service
service cron start

# Start apache2 server
apache2-foreground
