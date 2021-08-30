<?php
include("../include/conFig.php");
$travelid = $_GET['id'];
$i = $_GET['i'];
if($_GET['cancel'])
{
echo "UPDATE `travelrequest` SET `cancel` = '1' WHERE `travelid` = '$travelid'";
mysql_query("UPDATE `travelrequest` SET `cancel` = '1' WHERE `travelid` = '$travelid'",$con) or die(mysql_error());
?>
BREAKSTRINGFORSAVEDATA
<div class="sucessResp">
Cancelled Successfully</div>
<?php
}
else
{
mysql_query("INSERT INTO `travelrequest` (`travelid`, `createdate`, `updatedby`) VALUES ('$travelid', '$datetime', '$hrmloggedid')",$con) or die(mysql_error());
?>
BREAKSTRINGFORSAVEDATA
<div class="sucessResp">
Requested Successfully</div>

<?php
}
?>
