<?php
	include("../../include/conFig.php");
	$eid = $_GET['eid'];
	$type = $_GET['type'];
	$sdjkf = $_GET['sdjkf'];
	$valto = $_POST['valto'];
	$valto = explode("*$*$*",$valto);
	foreach($valto as $val)
	{
		$val = str_ireplace("'","\'",$val);
		$post[] .= $val;
	}
	
	if($sdjkf)
	{
		mysql_query("UPDATE `emp_images` SET `status`='1' WHERE `eid` = '$eid' AND `type`='$type'",$con) or die(mysql_error());
	}
	
	mysql_query("INSERT INTO `emp_images` (`eid`, `imageaddress`, `type`, `status`) VALUES ('$eid','$post[0]','$type','0')",$con) or die(mysql_error());
	
	
	
	//mysql_query("UPDATE `emp_images` SET `imageaddress`='$post[0]' WHERE `id` = '$eid'",$con) or die(mysql_error());
	
	//	echo "UPDATE `emp_images` SET `imageaddress`='$post[0]' WHERE `id` = '$eid'";
	//mysql_query("INSERT INTO `uploadocument` (`id`,`type`,`eid`,`document`,`createdate`,`updatedby` ,`delete`) VALUES ('','$jobappid','$eid','$post[0]','$datetime', '$hrmloggedid','0')",$con) or die(mysql_error());

?>
