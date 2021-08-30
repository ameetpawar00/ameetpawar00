<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("INSERT INTO `city`(`name`, `state`, `createdate`, `modifieddate`, `updatedby`,`description`) VALUES ('$post[2]','$post[1]','$datetime','$datetime','$loggeduserid','$post[3]')",$con)or die(mysql_error());
?>
<div style="background:#CCFF99;color:#222;font-weight:bold;padding:2px;">
City Successfully Saved</div>

