* Create DB:

```bash
# cd $BASE_DIR && cat schema.sql | sqlite3 db/cla.db 

# chown $APACHE_USER.$APACHE db

# chmod 775 db/cla.db
```
* Create a config dir and copy config.inc to it.
Note: it should be OUTSIDE your document root for security reasons.

* Edit config.inc to comply with your configuration.

* Edit add_contributer.php and sigToSvg.php changing to path to config.inc

* Edit cla_template.html and mail_template.html  

