# EarlyAccess_Web
Web-Code of Early Access 

##  Install:
1. Create web/src/.env, as seen in examples below
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

## Laravel .env example:
```bash
APP_NAME=EarlyAccess
APP_ENV=local
APP_KEY=base64:FcGx/VEZhmtTBZ07V4huEzUd2qPKO94q9nWwivXl4G4=
APP_DEBUG=true #false || true
APP_URL=https://earlyaccess.htb

LOG_CHANNEL=none
LOG_LEVEL=debug #none || debug

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=db
DB_USERNAME=drew
DB_PASSWORD=drew
```

## NPM:
`npm i @fortawesome/fontawesome-free --save`

## Manual setup:
1.) Create mysql-storage directory
2.) DC UP
3.) MySQL: `/root/mysql.sh`