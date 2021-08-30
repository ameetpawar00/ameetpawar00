<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$id = $_GET['id'];
$i=$_GET['i'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("UPDATE `team` SET `name` = '$post[0]', `leader` = '$post[1]', `modifieddate` = '$datetime', `updatedby` = '$loggeduserid', `delete` = '0', `desc` = '$post[3]' WHERE `id` = '$id'",$con) or die(mysql_error());

$mates = $post[2];
$mates = explode(",",$mates);
foreach($mates as $val)
{
if($val != '')
{
$temp = str_ireplace("-","",$val);
$newMates[] .= $temp;
}
}

mysql_query("DELETE FROM `teamamtes` WHERE `teamid` = '$id'",$con) or die(mysql_error());

foreach($newMates as $tal)
{
mysql_query("INSERT INTO `teamamtes` (`teamid`, `mateid`, `id`) VALUES ('$id', '$tal', '')",$con) or  die(mysql_error());
}

?>
<div class="success warnings">
Team Updated Successfully</div>

