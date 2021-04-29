# Create game and dev user
DROP USER IF EXISTS game;
DROP USER IF EXISTS dev;

CREATE USER "game"@"%" IDENTIFIED BY "game";
CREATE USER "dev"@"%" IDENTIFIED BY "dev";

# Allow read-access to users for both users
GRANT SELECT ON db.users TO "game"@"%","dev"@"%";

# Allow both users to read&write to failed_logins
GRANT SELECT, INSERT ON db.failed_logins TO "game"@"%","dev"@"%";

# Allow game to read&write scoreboard
GRANT SELECT, INSERT ON db.scoreboard TO "game"@"%";

# Apply changes
FLUSH PRIVILEGES;