<?php
require_once('sigToSvg.php'); // to convert JSON to SVG
require_once('/opt/cla_data/etc/config.inc'); // conf params
if (file_exists('marketo/MktMktowsApiService.php')&& file_exists('marketo/MarketoApiService.php')){
    require_once('marketo/MktMktowsApiService.php'); // for Marketo
    require_once('marketo/MarketoApiService.php'); // for Marketo
}

// You can obtain a free account here: http://phptopdf.com in order to convert to PDF, otherwise, the email will be sent as HTML instead.
if (file_exists('phpToPDF.php')){
	require_once('phpToPDF.php') ; // convert HTML to PDF
}
require_once('class.phpmailer.php'); // mail file

function send_marketo_lead($key,$secret,$soap_endpoint,$email,$name,$company,$phone,$addr,$country,$state,$role,$github_user)
{
try {
    if(!file_get_contents($soap_endpoint.'?WSDL')) {
	print 'No file found at ' . $soap_endpoint.'?WSDL';
		die();
	}
    	$marketo = new MarketoApiService($soap_endpoint.'?WSDL', array('location' => $soap_endpoint));
	$marketo->setCredentials($key, $secret);
} catch(SoapFault $e) {
	print 'aaa - ' . $e->getMessage();
	die();
}

$leadRecord = new LeadRecord();

$leadRecord->Email = $email;
$leadRecord->leadAttributeList = new stdClass();

$attributes = array();

$attributes[] = $marketo->createAttribute(MARKETO_NAME_ATTRIB,$name );
$attributes[] = $marketo->createAttribute(MARKETO_COMPANY_ATTRIB,$company );
$attributes[] = $marketo->createAttribute(MARKETO_NUMBER_ATTRIB,$phone );
$attributes[] = $marketo->createAttribute(MARKETO_ADDR_ATTRIB,$addr );
$attributes[] = $marketo->createAttribute(MARKETO_COUNTRY_ATTRIB,$country );
$attributes[] = $marketo->createAttribute(MARKETO_STATE_ATTRIB,$state );
$attributes[] = $marketo->createAttribute(MARKETO_GITHUB_ATTRIB,$github_user );
$attributes[] = $marketo->createAttribute(MARKETO_ROLE_ATTRIB,$role );
$attributes[] = $marketo->createAttribute('Community_Lead_Type__c','CLA' );

$leadRecord->leadAttributeList->attribute = $attributes;

$params = new ParamsSyncLead();
$params->leadRecord = $leadRecord;
//$params->returnLead = true;

try
{
      $marketo->syncLead($params);
}
catch(SoapFault $ex)
{
// do something
      var_dump($ex->getMessage());
}


}

function generate_pdf_cla($html_code,$out_dir,$out_file_name)
{
    phptopdf_html($html_code,$out_dir, '/'.$out_file_name);
    return $out_file_name;
}

function replace_template_tokens($tokens=array())
{
	$html_string=file_get_contents(HTML2PDF_TEMPLATE);
	$html_string.=file_get_contents(HTML_CONTRIBUTER_INFO);
	foreach ($tokens as $key=>$val){
		$html_string=str_replace('@@'.strtoupper($key).'@@',$tokens[$key],$html_string);
	}
	return $html_string;

}

function mail_it($from_mail,$sender_name,$addrs=array(),$reply_to, $reply_to_display_name, $file2attach, $subject,$body)
{
    $mail = new PHPMailer;
    $mail->From = $from_mail;
    $mail->FromName = $sender_name;
    foreach ($addrs as $display_name=>$emailaddr){
	$mail->addAddress($emailaddr, $display_name);     // Add a recipient
    }
    $mail->addReplyTo($reply_to, $reply_to_display_name);

    $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
    $mail->addAttachment($file2attach);         // Add attachments
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = $subject;
    $mail->Body    = $body;

    if(!$mail->send()) {
	echo 'CLA mail could not be sent.<br>';
	echo 'Mailer Error: ' . $mail->ErrorInfo;
    }

}

$name=SQLite3::escapeString($_POST['name']);
$email=SQLite3::escapeString($_POST['email']);
$phone=SQLite3::escapeString($_POST['phone']);
$addr=SQLite3::escapeString($_POST['addr']);
$country=SQLite3::escapeString($_POST['country']);
$company=SQLite3::escapeString($_POST['company']);
$state=SQLite3::escapeString($_POST['state']);
$zip=SQLite3::escapeString($_POST['zip']);
$sigToSvg=new sigToSvg($_POST['output']);
$image=$sigToSvg->getImage();
$svg=SQLite3::escapeString($image);
$github_user=SQLite3::escapeString($_POST['github_user']);
$role=SQLite3::escapeString($_POST['role']);
$db=new SQLite3(DBFILE) or die('Unable to connect to database '. DBFILE);
$query="insert into contribers values(NULL,'$name','$email','$phone','$addr','$country','$state','$zip','$company','$svg','$github_user',DATE())";
$db->exec($query);
if ($db->lastErrorCode()){
    $msg=json_encode('ERROR: #' . $db->lastErrorCode() . ' '.$db->lastErrorMsg().' :(');
    $db->close();
    die ($msg);
    
}else{
    $msg="Thank you for signing our CLA, $name.<br>An email will be sent to $email with the signed contract.";
}

$db->close();
// if we have all our marketo needs
if (class_exists('MarketoApiService') && defined('MARKETO_ACCESS_KEY') && defined('MARKETO_SECRET_KEY') && defined('SOAP_ENDPOINT')){
    send_marketo_lead(MARKETO_ACCESS_KEY,MARKETO_SECRET_KEY,SOAP_ENDPOINT,$email,$name,$company,$phone,$addr,$country,$state,$role,$github_user);
}


$image_base=basename(IMAGE_DIR);
$url_of_sig_svg=BASE_URL."/$image_base/$email.svg";
file_put_contents(IMAGE_DIR.DIRECTORY_SEPARATOR."$email.svg",$svg);
$tokens=array('name'=>$name,'email'=>$email,'phone'=>$phone,'addr'=>$addr,'country'=>$country,'company'=>$company,'state'=>$state,'zip'=>$zip,'url_of_sig_svg'=>$url_of_sig_svg,'github_user'=>$github_user,'role'=>$role,'date'=>date('D'.", " .'M'." " .'d'. ", ".'Y'));
$new_html=replace_template_tokens($tokens);
file_put_contents(OUT_DIR.DIRECTORY_SEPARATOR."$email.html",$new_html);
$body=file_get_contents(HTML_BODY_TEMPLATE);

// do we have the ability to covert to PDF?

if (function_exists('phptopdf_html')){
	generate_pdf_cla($new_html,OUT_DIR,"$email.pdf");
	$attachment=OUT_DIR.DIRECTORY_SEPARATOR."$email.pdf";

// if not, lets send it in HTML
}else{
	$body=$body.'<br><br>'.file_get_contents("/tmp/$email.html").'<br><br>';
	$attachment='';
}
$additional_recpts["$name"]=$email;
mail_it(MAIL_FROM,REPLY_TO_DISPLAY_NAME,$additional_recpts,REPLY_TO, REPLY_TO_DISPLAY_NAME, $attachment, SUBJECT,$body);
echo $msg;
?>
