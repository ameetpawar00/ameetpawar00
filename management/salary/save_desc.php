<?php
include("../../include/conFig.php");

$valto = $_POST['valto'];
$eid = $_GET['eid'];
$sal_id= $_GET['sal_id'];
$month= $_GET['month'];
$year= $_GET['year'];
$valto = explode("*$*$*",$valto);


foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}

//print_r($post);

$value=$post[0];
if(!isset($_GET['did']))
{
mysql_query("INSERT INTO `salary_description`(`description`, `type`, `status`, `updatedate`, `updatedby`, `employeeid`, `year`,`month`) VALUES ('$value','1','0','$datetime', '$hrmloggedid', '$eid','$year','$month')",$con) or die(mysql_error());
}else{
	$did=$_GET['did'];
	if(isset($_GET['del']))
	{
		mysql_query("UPDATE `salary_description` SET `status`='1',`updatedate`='$datetime',`updatedby`='$hrmloggedid' WHERE `employeeid`= '$eid' AND `id`='$did' AND `month`='$month' AND `year`='$year'",$con) or die(mysql_error());
	}else{
		mysql_query("UPDATE `salary_description` SET `description`='$value',`updatedate`='$datetime',`updatedby`='$hrmloggedid' WHERE `employeeid`= '$eid' AND `id`='$did' AND `month`='$month' AND `year`='$year'",$con) or die(mysql_error());
	}
}




?>
