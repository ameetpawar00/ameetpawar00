<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}

//echo "INSERT INTO `team` (`name`, `leader`, `createdate`, `modifieddate`, `updatedby`, `delete`, `id`, `desc`) VALUES ('$post[0]', '$post[1]', '$datetime', '$datetime', '$loggeduserid', '0', '','$post[3]')";
mysql_query("INSERT INTO `team` (`name`, `leader`, `createdate`, `modifieddate`, `updatedby`, `delete`, `id`, `desc`,`department_id`) VALUES ('$post[0]', '$post[1]', '$datetime', '$datetime', '$loggeduserid', '0', '','$post[4]','$post[3]')",$con) or die(mysql_error());
$id = mysql_insert_id();


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

foreach($newMates as $tal)
{
//echo "INSERT INTO `teamamtes` (`teamid`, `mateid`, `id`) VALUES ('$id', '$tal', '')";
mysql_query("INSERT INTO `teamamtes` (`teamid`, `mateid`, `id`) VALUES ('$id', '$tal', '')",$con) or  die(mysql_error());
}
?>
<div class="success warnings">
Team Saved Successfully</div>
