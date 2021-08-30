<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$i = $_GET['i'];
$id = $_GET['id'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("UPDATE `state` SET `name`='$post[1]', `country`= '$post[0]',`description`='$post[2]',`modifieddate` = '$datetime', `updatedby`  = '$loggeduserid' WHERE `id` = '$id'",$con);
?>
<div style="background:#CCFF99;color:#222;font-weight:bold;padding:2px;">
State Successfully Updated</div>
