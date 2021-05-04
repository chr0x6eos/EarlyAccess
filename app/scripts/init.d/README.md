# Scripts to initialze database

## tables.sql
Creates:
- users
- sessions
- messages
- scoreboard
- failed_logins

Inserts:
- Admin-user into users

## users.sql
Creates MySQL-user:
- game
- dev

Grants privileges:
- both
  - users (read)
  - failed_logins (read+write)
- game
  - scoreboard (read+write)
