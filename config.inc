<?php
define ('DBFILE','/opt/cla/db/cla.db');
// for Marketo intg. not mandatory, leave empty if you do not need this functionality
// replace the attributr names with what your marketo instance has setup.
define ('MARKETO_ACCESS_KEY', '');
define ('MARKETO_SECRET_KEY', '');
define ('SOAP_ENDPOINT','https://na-g.marketo.com/soap/mktows/1_3');
define ('MARKETO_NAME_ATTRIB','Full_Name__c');
define ('MARKETO_COMPANY_ATTRIB','Company');
define ('MARKETO_NUMBER_ATTRIB','Phone');
define ('MARKETO_ADDR_ATTRIB','Street');
define ('MARKETO_COUNTRY_ATTRIB','Country');
define ('MARKETO_STATE_ATTRIB','State');
define ('MARKETO_ROLE_ATTRIB','Title');
define ('MARKETO_GITHUB_ATTRIB','github_user');
define ('MARKETO_LEAD_ORIGIN','lead_origin');


// for sending the CLA contract by mail
define ('MAIL_FROM','you@mail.com');
define ('REPLY_TO','you@mail.com');
define ('REPLY_TO_DISPLAY_NAME','Your org');
define ('SUBJECT','CLA');
define ('HTML2PDF_TEMPLATE','cla.html');
define ('HTML_BODY_TEMPLATE','mail_template.html');
define ('HTML_CONTRIBUTER_INFO','contributer_info.html');
define ('IMAGE_DIR','/opt/cla/sigs');
define ('OUT_DIR','/opt/cla_data/out');
// you can add as many mail address as you wish here..
$additional_recpts=array('Recipient'=>'rep@mail.com','Another Rep'=>'rep1@mail.com');
?>
