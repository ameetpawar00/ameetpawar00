<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
	foreach($valto as $val)
		{
			$val = str_ireplace("'","\'",$val);
			$post[] .= $val;
		}
$name=$post[0];
$id=$post[1];
$doj=$post[2];
$td=$post[3];
$installments=$post[4];
$total_amount=$post[5];
$desc=$post[6];



$dataHoliday = mysql_query("INSERT INTO `emp_ltb_with`(`eid`, `instalment`, `amount`, `createdate`, `modifiedby`, `status`, `extra`, `doj`) VALUES ('$id','$installments','$total_amount','$datetime','$id','0','$desc','$doj')",$con) or die(mysql_error());

$note="Applied to Cash LTB as of $installments installment of amount Rs. $total_amount DECS:$desc";
		
	mysql_query("INSERT INTO `story`(`subject`, `note`, `employee`, `type`, `updatedby`) VALUES ('Applied to Cash LTB', '$note', '$hrmloggedid', 7, '$hrmloggedid')",$con) or die(mysql_error());
		
?>



