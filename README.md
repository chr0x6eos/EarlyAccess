# EarlyAccess
Source-code for EarlyAccess box

##  Installation:
1. Install [docker](https://docs.docker.com/engine/install/debian/)+[docker-compose](https://docs.docker.com/compose/install/)
2. Run `docker-compose up --build` in the project root
3. Wait for containers to be started up
4. Add earlyaccess.htb to /etc/hosts
5. Access https://earlyaccess.htb

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
- api
    - Used for game-verification and later privesc
- admin-simulation
    - Reads the admins messages each minute
- game-server
    - Runs game used to privesc to game-adm
- autoheal
    - Automatically restarts unhealthy containers
