<?php
include("../include/conFig.php");

$uid = base64_decode($_GET['uid']);
$startdate= date('Y-m-01');
$lastdate= date('Y-m-d');
$year = date('Y');

?>

<div class="title">Daily Attendance</div>
<div class="strip">
	<span>Dashboard</span>
	<span>Daily Attendance</span>
	<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" style="float: right;position: relative;top: -5px;"> <i class="back"></i>Back</button>
</div>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td style="width:30%"></td>
</tr>
</table>

<div style="overflow-x:hidden;overflow-y:scroll;height:380px;">
	<div class="add-new">
		<div class="form-head green-gradient">
			<div class="head-title"><i class="add-form"></i> Current Month Attendance View </div>
		</div>

<table cellpadding="0" cellspacing="0" width="100%" border="1">
 <tr style="height:50px;">
 	<td style="width:100px"><b>Name</b></td>
 	<td style="width:100px"><b>Date</b></td>
 	<td style="width:100px"><b>Attendance</b></td>
 	<td style="width:100px"><b>Leave Status</b></td>
 	<td style="width:100px"><b>Comment</b></td>
 </tr>

<?php 
/*$attendance_table = mysql_query("SELECT `current_date`, `attendance`, `remark`, `comment`, `emp_id` FROM `daily_attendance` WHERE  `current_date` BETWEEN '$startdate' AND '$lastdate' AND `emp_id`='$uid' AND `attendance`>0 AND `remark`>0 AND  AND `delete`=0 AND `status`=1");*/

 $attendance_table = mysql_query("SELECT daily_attendance.id, daily_attendance.current_date, daily_attendance.attendance,daily_attendance.remark,daily_attendance.comment,daily_attendance.emp_id,employee.name FROM daily_attendance,employee WHERE daily_attendance.current_date BETWEEN '$startdate' AND '$lastdate' AND employee.id='$uid' AND daily_attendance.emp_id='$uid' AND daily_attendance.delete=0 AND daily_attendance.status=1 AND daily_attendance.year='$year' AND daily_attendance.attendance>0 ORDER BY daily_attendance.id ASC");

 if(mysql_num_rows($attendance_table) > 0) {  ?> <!-- Start of numrows -->
 <?php while($rowatten = mysql_fetch_array($attendance_table))  { ?> <!-- Start of While loop -->

<tr>
	    <td style="width:100px"> <b><?php echo $rowatten['name']; ?></b></td>		
		<td style="width:100px"> <?php echo $rowatten['current_date']; ?> </td>           
		<td  style="width:100px">
		    <?php if($rowatten['attendance']=="1")
		          {
		          	echo "P";
		          } 
		          elseif($rowatten['attendance']=="2") 
		          {
		          	echo "A";
		          }
		          elseif($rowatten['attendance']=="3") 
		          {
		          	echo "WO-I";
		          }
		          elseif($rowatten['attendance']=="4") 
		          {
		          	echo "FHL";
		          }
		          elseif($rowatten['attendance']=="5")
		          {
		          	echo "SHL";
		          } 
		          elseif($rowatten['attendance']=="6")
		          {
		          	echo "TP";
		          }
		          elseif($rowatten['attendance']=="7") 
		          {
		          	echo "ABSCOND";
		          } 
		          elseif($rowatten['attendance']=="8")
		          {
		           	echo "RESIGNATION";
		          }
		          elseif($rowatten['attendance']=="9") 
		          {
		          	echo "TERMINATION";
		          }
		    ?>

		</td>
		<td style="width:100px">
			<?php if($rowatten['remark']=="1")
		          {
		          	echo '<b style="color:green;">INT-YES-APP</b>';
		          } 
		          elseif($rowatten['remark']=="2") 
		          {
		          	echo '<b style="color:blue;">INT-YES-UNAPP</b>';
		          }
		          elseif($rowatten['remark']=="3") 
		          {
		          	echo '<b style="color:red;">INT-NO-UNAPP</b>';
		          }
		    ?>      
		</td>

		<td style="width:100px">
		  <?php echo $rowatten['comment']; ?>
	    </td>
		</tr>

<?php } ?> <!-- End of While loop -->

<?php } ?>  <!-- Close of numrows -->

</table>

</div>
</div>

