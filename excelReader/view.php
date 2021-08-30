<?php error_reporting(0);

include("connection.php");
$getData = mysql_query("SELECT * FROM `swaemailit` WHERE  `delete` = '0' ORDER BY `id` ",$con) or die(mysql_error());

/*require_once 'Excel/reader.php';

$name ='';
$pass= '';
    $data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('CP1251');


$data->read('emailaccounts-swastika.xls');/////Pass Excel File Name


$data->sheets[0]['numRows'];

  for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++)
   {
*/  
	$i=0;
	while($row = mysql_fetch_array($getData))
	{

  echo $name = $row[1];
  		$fname = $row['fname'];
  		$lname = $row['lname'];
  		$ccode = row['ccode'];
  		$langp = $row['langp'];
  		$altemail = $row['altemail'];
 echo $pass = $row[2];
 echo "<br/>";
 
 
require_once('xmlapi-php-master/xmlapi.php');


$ip = "199.79.62.69"; 
$root_pass = 'nifty@fifty'; 

$account = "sifmr";  

$email_domain = "swastika.co.in";
$email_account = str_ireplace("@swastika.co.in","",$name); 

$xmlapi = new xmlapi($ip); 
$xmlapi->password_auth("sifmr",$root_pass); 
$xmlapi->set_port(2083);

 	$xmlapi->set_output('json');
 	
 	$params = array(domain=>$email_domain, email=>$email_account, password=>$pass, quota=>250); //quota is in MB
		
	$addEmail = json_decode($xmlapi->api2_query($account, "Email", "addpop", $params), true);
     echo $addEmail['cpanelresult']['data'][0]['result'];

// mysql_query(" INSERT INTO `swaemailit`(`id`, `emailid`, `password`, `createdate`, `modifieddate`, `delete`, `fname`, `lname`, `ccode`, `langp`, `altemail`) VALUES ('','$name','$pass','$datetime','$datetime','0','$fname','$lname','$ccode','$langp','$altemail')",$con)or die(mysql_error());


 
}



?>
