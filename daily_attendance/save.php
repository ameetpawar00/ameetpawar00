<?php
include("../include/conFig.php");

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
//print_r($_POST);
if(isset($_POST['submit']) or isset($_POST['submitmaneger']))
{
	 $total=$_POST['total'];

	 for($i=0; $i<$total; $i++) {

	 $attendance=$_POST['attendance'.$i];
	 $currentdate=$_POST['currentdate'.$i];
     $enpid=$_POST['id'.$i]."</br>";
     $remark=$_POST['remark'.$i];
     $comment=$_POST['comment'.$i];
     $year=$_POST['year'.$i];

     $attendance_table = mysql_query("SELECT `id` FROM `daily_attendance` WHERE  `current_date`='$currentdate' AND `emp_id`='$enpid' AND `delete`=0 AND `status`=1");
	$atten = mysql_num_rows($attendance_table);

    if($atten==0)
     {       	
     mysql_query("INSERT INTO `daily_attendance`(`current_date`, `attendance`, `remark`, `comment`, `emp_id`, `update_by`, `delete`, `status`, `createdate`, `updatedate`, `year`) VALUES ('$currentdate','$attendance','$remark','$comment','$enpid','$hrmloggedid','0','1','$datetime','$datetime','$year')",$con) or die(mysql_error());	
     }else{

     	mysql_query("UPDATE `daily_attendance` SET `current_date`='$currentdate',`attendance`='$attendance',`remark`='$remark',`comment`='$comment',`emp_id`='$enpid',`update_by`='$hrmloggedid',`delete`='0',`status`='1',`updatedate`='$datetime',`year`='$year' WHERE `current_date`='$currentdate' AND `emp_id`='$enpid' AND `year`='$year' AND `delete`='0' AND `status`='1'",$con) or die(mysql_error());	
     }
 } 

	 /*
	 $attendance=$_POST['attendance'];
	 $currentdate=$_POST['currentdate'];
     $id=$_POST['id'];
     $remark=$_POST['remark'];
     $comment=$_POST['comment'];

	 print_r($attendance);
	 print_r($currentdate);
	 print_r($id);
	 print_r($remark);
	 print_r($comment);
	 */

	 //echo "yessssss";

}

echo "<script>alert('Attendance Submitted Successfully'); parent.document.getElementById('head11').click();</script>"; 
?>

