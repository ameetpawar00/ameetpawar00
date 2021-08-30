<?php
include("../include/conFig.php");
$eid = $_GET['eid'];
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("INSERT INTO `education` (`id`, `school`, `degree`, `fieldsofstudy`, `doc`,  `interest`, `eid`, `createdate`,`updatedby`, `delete`) VALUES ('', '$post[0]', '$post[1]', '$post[2]', '$post[3]', '$post[4]', '$eid','$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
?>
