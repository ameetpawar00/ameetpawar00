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
mysql_query("INSERT INTO emp_education(`id`, `name`, `subject`, `grade`, `year`, `way`, `description`,`degree`,`employee`, `createdate`,`updatedby`, `delete`) VALUES ('', '$post[0]', '$post[1]', '$post[2]', '$post[3]', '$post[4]', '$post[5]','$post[6]','$eid','$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
?>






