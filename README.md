# EarlyAccess_Web
Web-Code of Early Access 

##  Install:
1. Create .env and src/.env, as seen in examples below
2. Install docker-compose
3. Create mysql-storage folder (for peristent storage)
4. Run `docker-compose up --build` in the project root
5. Wait for containers to be started up
6. Add earlyaccess.htb to /etc/hosts
7. Access https://earlyaccess.htb

## Interaction with containers:
Command:
```bash
docker-compose exec <service-name> <command>
```
### Running containers:
- Webserver (earlyaccess.htb)
    - Laravel application running
- mysql
    - Database
- admin-simulation
    - Reads the admins messages each minute
- npm (DEFAULT NOT RUNNING) 
    - Run npm commands (`docker-compose run --rm npm <cmd>`)

## .env Example:
```bash
# MySQL-config
db=db
user=mysql
pw=P@ssw0rd
GAME_PW=game
DEV_PW=dev

# Admin user-password
ADMIN_PW=gameover
```

## Laravel .env example:
```bash
APP_NAME=EarlyAccess
APP_ENV=local
APP_KEY=base64:ck+WGtMZJ2iHg2m49315GLXpYEv1UIo2Os84UN6fnKo=
APP_DEBUG=true
APP_URL=https://earlyaccess.htb

LOG_CHANNEL=none
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=db
DB_USERNAME=mysql
DB_PASSWORD=P@ssw0rd
```

## NPM:
`npm i @fortawesome/fontawesome-free --save`

## Manual setup:
1.) Create mysql-storage directory
2.) DC UP
3.) earlyaccess.htb: `php artisan migrate:fresh --seed`
4.) MySQL: `/root/mysql.sh`