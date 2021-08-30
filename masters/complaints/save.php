<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("INSERT INTO `complaints`(`name`,`description`, `createdate`, `modifieddate`, `updatedby`, `delete`) VALUES ('$post[0]','$post[1]','$datetime','$datetime','$loggeduserid','0')",$con) or die(mysql_error());
?>
<div style="background:#CCFF99;color:#222;font-weight:bold;padding:2px;">
Complaints Successfully Saved</div>

