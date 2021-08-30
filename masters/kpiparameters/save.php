<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
//-5-,-9-,-15-,
mysql_query("INSERT INTO `kpiparameters`(`name`, `maximum`, `default`, `description`, `createdate`, `modifieddate`, `updatedby`, `delete`, `designation`) VALUES ('$post[0]','$post[2]','$post[3]','$post[1]','$datetime','$datetime','$hrmloggedid','0','$post[4]')",$con) or die(mysql_error());

?>

<div class="success warnings">
Parameters Saved Successfully</div>
