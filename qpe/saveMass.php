<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
$smonth = $_GET['smonth'];
$syear = $_GET['syear'];
$year = date('Y');
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
$userids= explode(",",$_GET['userids']);
//print_r($_REQUEST);
$a=0;
foreach($userids as $valUser)
{
	if($valUser != "")
	{
		$userid = $valUser;
		$value =  $post[$a];
		$getCount = mysql_query("SELECT `id` FROM `qpe` WHERE `employee` = '$userid'  AND `qpeparameter` = '1' AND `month` = '$smonth' AND `year` = '$syear'",$con) or die(mysql_error());
	
		if(mysql_num_rows($getCount) > 0)
		{
			$rowCount = mysql_fetch_array($getCount);
			$sql = "UPDATE `qpe` SET `marks`= '$value', `modifieddate`= '$datetime',`updatedby`= '$hrmloggedid',`year`= '$syear' WHERE `id` = $rowCount[0]"; 
		}
		else  
		{
			$sql = "INSERT INTO `qpe`(`employee`, `qpeparameter`, `marks`, `date`, `month`, `createdate`, `modifieddate`, `updatedby`, `year`) VALUES('$userid','1','$value','$date','$smonth','$datetime','$datetime', '$hrmloggedid', '$syear')";
		}
		mysql_query($sql,$con) or die(mysql_error());
	}
	$a++;
}	   
?>
BREAKSTRINGFORSAVEDATA