#!/bin/bash

# Create game-user with READ-ONLY permission on the users table and write permissions on
# Set sql_mode to allow group by query 
mysql --protocol=socket -uroot -p$MYSQL_ROOT_PASSWORD <<EOSQL
DROP USER IF EXISTS game;
DROP USER IF EXISTS dev;
CREATE USER "game"@"%" IDENTIFIED BY "$GAME_PW";
CREATE USER "dev"@"%" IDENTIFIED BY "$DEV_PW";
GRANT SELECT ON $MYSQL_DATABASE.users TO "game"@"%","dev"@"%";
GRANT SELECT, INSERT ON $MYSQL_DATABASE.failed_logins TO "game"@"%","dev"@"%";
GRANT SELECT, INSERT ON $MYSQL_DATABASE.scoreboard TO "game"@"%";
FLUSH PRIVILEGES;
EOSQL