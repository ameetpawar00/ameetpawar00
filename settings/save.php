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
$npassword	= $post[0];
$rnpassword	= $post[1];
if($npassword != $rnpassword)
{
}
else
{
mysql_query("UPDATE `employee` SET `password`='$npassword' WHERE `id`='$id'",$con) or die(mysql_error());
}
			
	
?>
BREAKSTRINGFORSAVEDATA
<div class="sucessResp">
Password Updated Successfully</div>

