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
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:9Tk/5seC8tX5tJivERuxjXyTE45kSJ+FrhjCsUSzdxE=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=none
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=db
DB_USERNAME=mysql
DB_PASSWORD=P@ssw0rd
```