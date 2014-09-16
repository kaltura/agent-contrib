<?php
define ('DBFILE','/opt/cla/db/cla.db');

// for Marketo intg. not mandatory
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


// for sending the CLA contract by mail

define ('MAIL_FROM','community@kaltura.com');
define ('REPLY_TO','community@kaltura.com');
define ('REPLY_TO_DISPLAY_NAME','Kaltura Community');
define ('SUBJECT','Kaltura CLA');
define ('HTML2PDF_TEMPLATE','pdf_template.html');
define ('HTML_BODY_TEMPLATE','mail_template.html');
define ('IMAGE_DIR','/opt/cla/sigs');
define ('OUT_DIR','/opt/cla_data/out');
$additional_recpts=array('Legal'=>'legal@yours.com','Community'=>'Community@yours.com');
?>
