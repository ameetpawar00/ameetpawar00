<?php
include("../../include/conFig.php");
echo $eid = $_GET['eid'];
echo $jobappid = $_GET['jobappid'];
echo $type = $_GET['type'];
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
echo $val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("INSERT INTO `uploadocument` (`id`,`type`,`eid`,`document`,`createdate`,`updatedby` ,`delete`) VALUES ('','$jobappid','$eid','$post[0]','$datetime', '$hrmloggedid','0')",$con) or die(mysql_error());

?>
