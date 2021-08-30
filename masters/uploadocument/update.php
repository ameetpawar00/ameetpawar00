<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$i = $_GET['i'];
$id = $_GET['id'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
echo "UPDATE `companydetail` SET `name`='$post[0]', `address`='$post[2]',`email`='$post[1]',`city`='$post[3]',`state`='$post[4]',`pincode`='$post[5]',`panname`='$post[6]',`footnote`='$post[7]',`logo`='$post[8]',`updatedate`='$datetime',`updatedby`='$hrmloggedid' WHERE `id` = '$id'";
mysql_query("UPDATE `companydetail` SET `name`='$post[0]', `address`='$post[2]',`email`='$post[1]',`city`='$post[3]',`state`='$post[4]',`pincode`='$post[5]',`panname`='$post[6]',`footnote`='$post[7]',`logo`='$post[8]',`updatedate`='$datetime',`updatedby`='$hrmloggedid' WHERE `id` = '$id'",$con) or die(mysql_error());

?>

BREAKSTRINGFORSAVEDATA
<div class="sucessResp">
Company Detail Updated Successfully</div>
