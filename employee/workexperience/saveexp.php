<?php
include("../../include/conFig.php");$eid = $_GET['eid'];
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("INSERT INTO `workexperience` (`id`, `precompany`, `jobtitle`, `fromdate`, `todate`, `jobdesc`, `eid`, `location`, `startsal`, `leavesal`, `reasonleave`, `responsibilities`, `createdate`,`updatedby`,  `delete`) VALUES ('', '$post[0]', '$post[1]', '$post[2]', '$post[3]', '$post[4]','$eid', '$post[5]', '$post[6]', '$post[7]', '$post[8]', '$post[9]','$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
?>
