<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
$i = $_GET['i'];
$id = $_GET['id'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("UPDATE `salary` SET `basic`= '$post[0]',`con_allow`='$post[1]',`spec_allow`='$post[2]',`other_allow`='$post[3]',`perf_allow`='$post[4]',`att_allow`='$post[5]',`perf_Bonus`='$post[6]',`train_allow`='$post[7]',`travel_allow`='$post[8]',`add_earning`='$post[9]',`PF`='$post[10]',`updatedate`='$datetime',`updatedby` = '$hrmloggedid' WHERE `id` = '$id'",$con) or die(mysql_error());
?>
