<?php
include("../../include/conFig.php");
$id = $_GET['id'];
$perid = $_GET['perid'];

$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
if($val != '')
{
$val = str_ireplace("'","\'",$val);
$post .= $val.',';
}
}
if($perid != "")
{
$updatepermi = "UPDATE `permission` SET `permission`='$post',`modifieddate`='$datetime',`updatedby`='$datetime',`delete`='0' WHERE `rollid` = '$id' AND `id` = '$perid' ";
mysql_query($updatepermi,$con) or die(mysql_error());
}
else
{

//echo "INSERT INTO `permission` (`rollid`,`permission`,`createdate`,`modifieddate`,`updatedby`,`delete`) VALUES ('$id','$post','$datetime','$datetime','$hrmloggedid','0')" ;
mysql_query("INSERT INTO `permission` (`rollid`,`permission`,`createdate`,`modifieddate`,`updatedby`,`delete`) VALUES ('$id','$post','$datetime','$datetime','$hrmloggedid','0')",$con) or die(mysql_error());
}
?>
