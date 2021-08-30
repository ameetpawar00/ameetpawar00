<?php
include("../../include/conFig.php");
$eid = $_GET['eid'];
$type= $_GET['type'];
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
if($type==1)
{	
		mysql_query("INSERT INTO emp_education(`name`, `degree`, `subject`, `year`, `description`,`employee`, `createdate`,`updatedby`, `delete`, `type`) VALUES ('$post[0]', '$post[1]', '$post[2]', '$post[3]', '$post[4]', '$eid','$datetime', '$hrmloggedid', '0','$type')",$con) or die(mysql_error());
}else{
		mysql_query("INSERT INTO emp_education(`id`, `name`, `subject`, `grade`, `year`, `way`, `description`,`degree`,`employee`, `createdate`,`updatedby`, `delete`, `type`) VALUES ('', '$post[0]', '$post[1]', '$post[2]', '$post[3]', '$post[4]', '$post[5]','$post[6]','$eid','$datetime', '$hrmloggedid', '0','$type')",$con) or die(mysql_error());
}
?>





