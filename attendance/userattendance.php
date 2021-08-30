<?php
include('../include/conFig.php');
require_once('../include/function.php');
if($_GET['id'] == "")
{
mysql_query("INSERT INTO `attendance`(`employee`, `date`,`createdate`, `attendance`,`checkin`) VALUES ('$hrmloggedid','$date','$datetime','1','$datetime')",$con) or die(mysql_error());
$checkid = mysql_insert_id();
?>
<span class="red button"  onclick="checkOut('<?php echo $checkid?>');" id="myAttendancechk" >Todays CheckOut</span>
<?php
}
else
{
$id = $_GET['id'];
$getCheckTime = mysql_query("select `checkin` from `attendance` where `id` = '$id' and `delete` = '0' ",$con) or die(mysql_error());
$rowCheckTime = mysql_fetch_array($getCheckTime);
$chkIntime = ($rowCheckTime[0]);
$chkOuttime = ($datetime);
$getHour = getHour($chkIntime,$chkOuttime);
$onlyhour  = explode(":",$getHour);
$hoursDiff = $onlyhour[0];
$minutesDiff = $onlyhour[1];
	if($hoursDiff > 9)
	{
	$overtime = 9-$hoursDiff;
	$overtime = $overtime.":".$minutesDiff;
	}
	else
	{
	$overtime = "0:0";
	}
$updateChk = "UPDATE `attendance` SET `checkout`='$datetime',`hourworked`= '$getHour',`overtime` = '$overtime' WHERE `id` = '$id'";	
mysql_query($updateChk,$con) or die(mysql_error());
}
?>