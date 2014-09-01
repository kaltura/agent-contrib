0. Create DB:

```bash
# cd $BASE_DIR && cat schema.sql | sqlite3 db/cla.db 
# chown $APACHE_USER.$APACHE db
# chmod 775 db/cla.db
```
1. Create a config dir and copy config.inc to it.
Note: it should be OUTSIDE your document root for security reasons.

2. Edit config.inc to comply with your configuration.

3. Edit add_contributer.php and sigToSvg.php changing to path to config.inc

4. Edit cla_template.html and mail_template.html  

