# EarlyAccess_Web
Web-Code of Early Access 

##  Installation:
1. Install [docker](https://docs.docker.com/engine/install/debian/)+[docker-compose](https://docs.docker.com/compose/install/)
2. Run `docker-compose up --build` in the project root
3. Wait for containers to be started up
4. Follow Initial web-install part
5. Add earlyaccess.htb to /etc/hosts
6. Access https://earlyaccess.htb

## Initial web-install
In order to setup the web-server, dependencies and permissions have to be setup.
```bash
root@darkness:~/EarlyAccess_Web# docker-compose exec earlyaccess.htb bash
root@webserver:/var/www/html# composer install
root@webserver:/var/www/html# php artisan key:generate
root@webserver:/var/www/html# chown www-data:www-data -R storage/
```

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

## NPM:
`npm i @fortawesome/fontawesome-free --save`