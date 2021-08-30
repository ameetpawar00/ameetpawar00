<?php
include("../../include/conFig.php");
$eid = $_GET['eid'];
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("INSERT INTO `emp_extra`(`type`, `name`, `description`, `employee`, `createdate`, `status`, `createdby`) VALUES ('$post[0]', '$post[1]', '$post[2]', '$eid', '$datetime', '1','$hrmloggedid')",$con) or die(mysql_error());
?>




