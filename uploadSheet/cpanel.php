<?php 

require_once('xmlapi-php-master/xmlapi.php');

$getF = mysql_query("SELECT * FROM `email` WHERE `id`='$id'",$con)or die(mysql_error());
$rowF = mysql_fetch_array($getF);

$ip = "115.124.125.162"; 
$root_pass = 'nifty@fifty'; 

$account = "sifmr";  

$email_domain = "research4u.in";
$email_account = str_ireplace("@research4u.in","",$rowF[1]); 

$xmlapi = new xmlapi($ip); 
$xmlapi->password_auth("sifmr",$root_pass); 
$xmlapi->set_port(2083);


?>