<?php
include("../include/conFig.php");

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

if(isset($_POST['submitedit']))
{
	  $currentdate=$_POST['currentdate0'];
	  $attendance=$_POST['attendance0'];
	  $remark=$_POST['remark0'];
	  $comment=$_POST['comment0'];
	  $emp_id=$_POST['emp_id'];
	  $check_status=$_POST['check_status'];
	  $year=date('Y');
    if($check_status>0)
    {
	 mysql_query("UPDATE `daily_attendance` SET `current_date`='$currentdate',`attendance`='$attendance',`remark`='$remark',`comment`='$comment',`update_by`='$hrmloggedid' WHERE `delete`=0 AND `status`=1 AND `id`='$emp_id' AND `current_date`='$currentdate'",$con) or die(mysql_error());
    }
    else
    {
       mysql_query("INSERT INTO `daily_attendance`(`current_date`, `attendance`, `remark`, `comment`, `emp_id`, `update_by`, `delete`, `status`, `createdate`, `updatedate`, `year`) VALUES ('$currentdate','$attendance','$remark','$comment','$emp_id','$hrmloggedid','0','1','$datetime','$datetime','$year')",$con) or die(mysql_error());
    }

}

echo "<script>alert('Attendance Submitted Successfully'); parent.document.getElementById('head11').click();</script>";

?>