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
mysql_query("UPDATE `travelexpense` SET `date`='$post[0]',`ticket`='$post[1]',`lodging`='$post[2]',`boarding`='$post[3]',`phone`='$post[4]',`localconveyance`='$post[5]',`incidentals`='$post[6]',`others`='$post[7]',`description`='$post[8]', `updatedate` = '$datetime', `updatedby`  = '$hrmloggedid' WHERE `id` = '$id'",$con) or die(mysql_error());
?>
BREAKSTRINGFORSAVEDATA
<div class="sucessResp">
Travel Expense Updated Successfully</div>

