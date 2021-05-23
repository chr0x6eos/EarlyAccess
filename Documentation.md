# Documentation

## Laravel disable logs:
Edit src/config/logging.php:
```php
'channels' => [
        'none' => [
            'driver' => 'monolog',
            'handler' => NullHandler::class,
        ],
        ...
```

Update .env:
```bash
cat .env
APP_NAME=EarlyAccess
APP_ENV=local
APP_KEY=base64:mv1t50WK/jGxM3KG46ufxWM/5SIiwN24JcFf3BS82MY=
APP_DEBUG=false
APP_URL=https://earlyaccess.htb

LOG_CHANNEL=none
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=db
DB_USERNAME=drew
DB_PASSWORD=drew
```