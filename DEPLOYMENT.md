1. Create DB:

```bash
# cd $BASE_DIR && cat schema.sql | sqlite3 db/cla.db 
# chown $APACHE_USER.$APACHE db
# chmod 775 db/cla.db
```
2. Create a config dir and copy config.inc to it.
Note: it should be OUTSIDE your document root for security reasons.

3. Edit config.inc to comply with your configuration.

4. Edit add_contributer.php and sigToSvg.php changing to path to config.inc.

5. Create a directory to contain the outputted PDF and HTML docs
Note: it should be OUTSIDE your document root for security reasons but need to have write permissions for $APACHE_USER.

6. Edit cla.html and mail_template.html.

