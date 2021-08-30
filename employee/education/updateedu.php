<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$type = $_GET['type'];
$i = $_GET['i'];
$id = $_GET['id'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
if($type==0){
	
mysql_query("UPDATE `emp_education` SET `name`='$post[0]',`subject`='$post[1]',`grade`='$post[2]',`year`='$post[3]',`way`='$post[4]',`description`='$post[5]',`createdate`='$datetime',`updatedby` = '$hrmloggedid' WHERE `id` = '$id'",$con) or die(mysql_error());
}else{
mysql_query("UPDATE `emp_education` SET `name`='$post[0]',`degree`='$post[1]',`subject`='$post[2]',`year`='$post[3]',`description`='$post[4]',`createdate`='$datetime',`updatedby` = '$hrmloggedid' WHERE `id` = '$id'",$con) or die(mysql_error());
	
}
?>