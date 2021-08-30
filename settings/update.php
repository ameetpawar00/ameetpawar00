<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
$id = $_GET['id'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
//"UPDATE `employee` SET `username`='$post[0]',`name`='$post[1]',`email`='$post[2]',`phone`='$post[3]',`mobile`='$post[4]',`dob`='$post[5]',`address`='$post[6]',`state`='$post[7]',`city`= '$post[8]',`marital`='$post[9]',`gender`='$post[10]',`doa`='$post[11]',`bank`='$post[12]',`accountno`='$post[13]',`pfaccount`='$post[14]',`jobdescription`='$post[15]',`about`='$post[16]',`specialization`='$post[17]',`updatedate`='$datetime',`updatedby`='$hrmloggedid' WHERE `id` = '$id'";
mysql_query("UPDATE `employee` SET `username`='$post[0]',`name`='$post[1]',`email`='$post[2]',`phone`='$post[3]',`mobile`='$post[4]',`dob`='$post[5]',`address`='$post[6]',`state`='$post[7]',`city`= '$post[8]',`marital`='$post[9]',`gender`='$post[10]',`doa`='$post[11]',`bank`='$post[12]',`accountno`='$post[13]',`pfaccount`='$post[14]',`jobdescription`='$post[15]',`about`='$post[16]',`specialization`='$post[17]',`updatedate`='$datetime',`updatedby`='$hrmloggedid' WHERE `id` = '$id'",$con) or die(mysql_error());

?>

BREAKSTRINGFORSAVEDATA
<div class="sucessResp">
Employee Updated Successfully</div>
