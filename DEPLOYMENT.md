* Create DB:

```bash
# cd $BASE_DIR && cat schema.sql | sqlite3 db/cla.db 
# chown $APACHE_USER.$APACHE db
# chmod 775 db/cla.db
```
* Create a config dir and copy config.inc to it.

Note: it should be OUTSIDE your document root for security reasons.

* Edit config.inc to comply with your configuration.

* Edit add_contributer.php and sigToSvg.php changing to path to config.inc.

* Create a directory to contain the outputted PDF and HTML docs.

Note: it should be OUTSIDE your document root for security reasons but need to have write permissions for $APACHE_USER.

* Edit cla.html and mail_template.html.

* Edit tcpdf/config/tcpdf_config_alt.php to your liking. 

If interested in SSL signing of PDF, make sure to set:

```
define ('SSL_CRT','');
define ('SSL_PRIVATE_KEY','');
define ('REASON','');
define ('CONTACT_INFO','');
```

