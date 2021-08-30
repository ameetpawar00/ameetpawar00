<?php
include("../../include/conFig.php");$valto = $_POST['valto'];
$i = $_GET['i'];
$id = $_GET['id'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("UPDATE `workexperience` SET `precompany`= '$post[0]',`jobtitle`= '$post[1]',`fromdate`= '$post[2]',`todate`= '$post[3]',`jobdesc`= '$post[4]', `updatedate`='$datetime',`updatedby` = '$hrmloggedid' WHERE `id` = '$id'",$con) or die(mysql_error());
?>
