<?php
include("../../include/conFig.php");
$tid = $_GET['tid'];
$emid = $_GET['emid'];
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("INSERT INTO `taskreassign` (`taskid`, `to`,`from`,`createdate`,`updatedate`,`updatedby` ,`delete`) VALUES ('$tid', '$post[0]','$hrmloggedid', '$datetime','$datetime','$hrmloggedid','0')",$con) or die(mysql_error());
		

?>