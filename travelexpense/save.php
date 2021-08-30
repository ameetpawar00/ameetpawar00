<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
$travelid = $_GET['travelid'];
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("INSERT INTO `travelexpense` (`travelid`, `date`, `ticket`, `lodging`, `boarding`, `phone`, `localconveyance`, `incidentals`, `others`, `description`, `createdate`, `updatedby`) VALUES ('$travelid', '$post[0]', '$post[1]', '$post[2]', '$post[3]', '$post[4]', '$post[5]', '$post[6]', '$post[7]', '$post[8]', '$datetime', '$hrmloggedid')",$con) or die(mysql_error());
?>
BREAKSTRINGFORSAVEDATA
<div class="sucessResp">
Travel Expense Requested Successfully</div>

