# Web Dir

The website's source code lies here.

## VHosts:
- earlyaccess.htb:443 	  -> src/
- game.earlyaccess.htb:80 -> game/
- dev.earlyaccess.htb:80  -> dev/

## Game:
Set mysql option to allow query to work:
```sql
SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));
```