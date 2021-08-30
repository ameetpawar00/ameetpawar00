<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("INSERT INTO `state`( `name`, `country`, `description`, `createdate`, `modifieddate`, `updatedby` ) VALUES ('$post[1]','$post[0]','$post[2]','$datetime','$datetime','$loggeduserid')",$con)or die(mysql_error())
?>
<div style="background:#CCFF99;color:#222;font-weight:bold;padding:2px;">
State Successfully Saved</div>

