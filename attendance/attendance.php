<?php
//include("../include/connection.php");
$getAttendance = mysql_query("select `id` from `attendance` where `date` = '$date'  and `employee` = '$hrmloggedid'",$con) or die(mysql_error()) ;
if(mysql_num_rows($getAttendance) <= 0)
{
?>
<span class="blue button"  style="display:none;" onclick="getModule('attendance/userattendance','mydata','myAttendance','Human Resources Managment System');" id="myAttendance">Todays Attendance</span>
<div id="mydata"></div>
<?php
}
$chkSql =  "select `id` FROM `attendance` where `date` = '$date' and `employee` = '$hrmloggedid' and `attendance` != '0' and `checkout` = '0000-00-00 00:00:00'";
$getCheckout = mysql_query($chkSql,$con) or die(mysql_error());
if(mysql_num_rows($getCheckout) > 0)
{
$rowCheckout = mysql_fetch_array($getCheckout);
$checkid = $rowCheckout[0];
?>
<span class="red button" onclick="checkOut('<?php echo $checkid?>');" id="myAttendancechk" >Todays CheckOut</span>
<?php
}
else
{
?>
<?php
}
?>
