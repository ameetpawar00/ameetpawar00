<?php
	include("../include/conFig.php");
	

    $heads_id = "8,10";

    $orderby="ORDER BY employee.name ASC";

     if((in_array('atten_show_all',$thisper)) or $hrmloggedid==93){

        $department_list=mysql_query("SELECT `id`, `name` FROM `department` WHERE `delete`=0 AND `id` NOT IN (1,2)"); 
        $master="SELECT employee.id,employee.name,employee.salaryId,employee.designation,employee.department FROM employee WHERE employee.role NOT IN ($heads_id) AND employee.delete = 0 AND employee.empstatus = 2";

     }else{

    $emp_depat = mysql_query("SELECT `department` FROM `employee` WHERE `id`='$hrmloggedid' AND `delete` = 0 AND `empstatus` = 2");
    while($final_emp_depat = mysql_fetch_assoc($emp_depat))
    {    
    	$department=$final_emp_depat['department']; 
    }
  
    $department_list=mysql_query("SELECT `id`, `name` FROM `department` WHERE `delete`=0 AND `id`='$department'"); 

    $master="SELECT employee.id,employee.name,employee.salaryId,employee.designation,teamamtes.mateid FROM employee,team,teamamtes WHERE team.leader = $hrmloggedid AND teamamtes.mateid = employee.id AND teamamtes.teamid = team.id AND team.delete = 0 AND employee.delete = 0 AND employee.empstatus = 2";

 $self_show=mysql_query("SELECT employee.id,employee.name,employee.salaryId,employee.designation FROM employee,team WHERE team.leader = $hrmloggedid AND employee.id = $hrmloggedid AND team.self_attendance = 1 AND team.delete = 0 AND employee.delete = 0 AND employee.empstatus = 2");
    
    $self_count=mysql_num_rows($self_show);

     }	

    
    // print_r($thisper);

?>
<div class="title">Daily Attendance</div>
<div class="strip" style="position: relative;">
	<span>Dashboard</span>
	<span>Daily Attendance</span>

<!----------------- Start Select Team List Part  ------------------------>
<?php if((in_array('admin_team_view',$thisper)) or $hrmloggedid==93){ ?>

<select name="team" class="input drop-down large" required="required" onchange="getModule('daily_attendance/select_teamdisplay?tvalue='+this.value,'displayteam','','Displayteam')" style="position: absolute;left: 265px;top: 3px;">
 <option value="">Select Team</option>	
<?php 
$mates=mysql_query ("SELECT `name`, `id` FROM `team` WHERE `delete`=0 ORDER BY `name` ASC");
while ($row_mates = mysql_fetch_array($mates))
     {
        $mates_id=$row_mates['id'];
        $name=$row_mates['name'];
?>
<option value="<?php echo $mates_id."***".$name; ?>"><?php echo $name; ?></option>	
<?php } ?>
</select>

<?php } ?> <!-- Close control Access -->



<?php /* ?>

<!-- Start User Dropdown List -->
<select name="team" class="input drop-down large" required="required" onchange="getModule('daily_attendance/select_teamdisplay?tvalue='+this.value,'dropdownteam','','Displayteam')" style="position: absolute;left: 265px;top: 3px;">
<option value="">Select Team</option>	
<?php
     $user_dropdown = mysql_query("$master AND employee.id!=613");
     while($row_user_dropdown=mysql_fetch_array($user_dropdown))
     { 
     	$emp_id.=$row_user_dropdown['id'].",";
     }
          $emp_id=rtrim($emp_id,',');

     	$user_team=mysql_query("SELECT `name`, `id`,`leader` FROM `team` WHERE `leader` IN ($emp_id) AND `delete`=0");
       while ($row_user_team=mysql_fetch_array($user_team)) {
       	       $emp_id1=$row_user_team['leader'];
          	?>
     <option value="<?php echo $row_user_team['id']."***".$row_user_team['name']; ?>"><?php echo $row_user_team['name']; ?></option>	
     <?php 
           $user_dropdown=mysql_query("SELECT employee.id,employee.name,employee.salaryId,employee.designation,teamamtes.mateid FROM employee,team,teamamtes WHERE team.leader = $emp_id1 AND teamamtes.mateid = employee.id AND teamamtes.teamid = team.id AND team.delete = 0 AND employee.delete = 0 AND employee.empstatus = 2");
       while($row_user_dropdown=mysql_fetch_array($user_dropdown))
     { 
     	   $emp_id=$row_user_dropdown['id']; 

           $user_team1=mysql_query("SELECT `name`, `id` FROM `team` WHERE `leader`='$emp_id' AND `delete`=0");
           while ($row_user_team=mysql_fetch_array($user_team1)) {  ?>
<option value="<?php echo $row_user_team['id']."***".$row_user_team['name']; ?>"><?php echo "-----".$row_user_team['name']; ?></option>
     <?php  }   ?>
     <?php  }  ?>
<?php } ?>

</select>
<!-- End User Dropdown List -->

<?php */ ?>



<!-- Start User Dropdown List -->
<?php if((in_array('user_team_list',$thisper)) AND !in_array('atten_show_all',$thisper)){ ?> <!-- Start control Access -->
<?php 
       function teamlist($hrmloggedid,$lavel)
       { 
           $user_dropdown=mysql_query("SELECT employee.id,employee.name,employee.salaryId,employee.designation,teamamtes.mateid FROM employee,team,teamamtes WHERE team.leader = $hrmloggedid AND teamamtes.mateid = employee.id AND teamamtes.teamid = team.id AND team.delete = 0 AND employee.delete = 0 AND employee.empstatus = 2");
           while($row_team=mysql_fetch_array($user_dropdown))
           {
                $emp_id=$row_team['id'];
                $user_team1=mysql_query("SELECT `name`, `id` FROM `team` WHERE `leader`='$emp_id' AND `delete`=0");
                while($row_team=mysql_fetch_array($user_team1))
                {
                  echo '<option value="'.$row_team['id']."***".$row_team['name'].'">'.$lavel.$row_team['name'].'</option>';
                }
                teamlist($emp_id,$lavel."---");
           }

       }
?>

<select name="team" class="input drop-down large" required="required" onchange="getModule('daily_attendance/select_teamdisplay?tvalue='+this.value,'dropdownteam','','Displayteam')" style="position: absolute;left: 265px;top: 3px;">
<option value="">Select Team</option>
<?php teamlist($hrmloggedid,$lavel); ?>
</select>
<?php } ?> <!-- Close control Access -->
<!-- End User Dropdown List -->






 <?php if(in_array('atten_excel',$thisper)) { ?>
	<div style="float: right;width: 640px;position: relative;top: -10px;">
	 <form action="daily_attendance/getattendance_excel.php" method="post" target="_blank">
	Start Date : <input type="date" name="startdate" value="" style="border: 1px solid #ccc;" required="required">
	End Date : <input type="date" name="enddate" value="" style="border: 1px solid #ccc;" required="required">
	<?php /* ?>
	<input name="year" type="hidden" value="<?php echo date("Y"); ?>"/>
	<?php */ ?>
	<select name="year">
		<option value="2019">2019</option>
		<option value="2020" selected="selected">2020</option>
	</select>

	<input type="submit" name="submit" value="Excel" class="greenyellow-gradient" style="border: none;padding:10px 10px;color: white;cursor: pointer;font-size: 14px;">
	<input type="submit" name="submit_view" value="View" class="greenyellow-gradient" style="border: none;padding:10px 10px;color: white;cursor: pointer;font-size: 14px;">
   </form>
  </div>
  <div class="head-title" style="width: 100%;">
<button class="button red-gradient" onclick="getModule('daily_attendance/index','viewContent','manipulateContent','Daily Attendance')" style="position: absolute;top: 5px;right: 0;"><i class="fa fa-repeat" aria-hidden="true"></i> Reload</button>
 </div>
<?php } ?>

<?php if(in_array('atten_user',$thisper) && !in_array('atten_show_all',$thisper)) { ?>
  <div class="span3 responsive purple-gradient" data-tablet="span6" data-desktop="span3"  onclick="getModule('daily_attendance/viewattendance','manipulatemoodleContent','viewmoodleContent','')" style="border: none;padding: 7px 10px;color: white;cursor: pointer;font-size: 14px;float: right;
width: 125px;margin-right: 20px;position: relative;top: -7px;text-align: center;"> View Attendance </div>	
<?php } ?>

</div>

<div style="float: left;width: 100%; overflow-x:hidden;overflow-y:scroll;height:380px">
	<div class="add-new green-border">
		<div class="form-head green-gradient" style="position: relative;">
 <div class="head-title" style="width: 100%;"><i class="add-form"></i> Submit Daily Attendance </div>
 <?php if(in_array('admin_edit_old',$thisper) or $hrmloggedid==93) { ?>
    <div style="width:500px;position: absolute;right: 0;top: 1px;">
		<select class="input drop-down large" name="req" id="oldaten0" required="required">
		<option value="">Select Employe Name</option>	
		<?php 
		     $emp_list=mysql_query ("SELECT `id`,`name` FROM employee WHERE `empstatus`=2 AND `delete`=0 ORDER BY `name` ASC");
		     while ($row_emp_list = mysql_fetch_array($emp_list))
			 { ?>
		<option value="<?php echo $row_emp_list['id']; ?>"><?php echo $row_emp_list['name']; ?></option>

		<?php } ?>	
		</select>

		<input class="input drop-down large" type="date" name="req" id="oldaten1" style="border: 1px solid #ccc;" required="required">

		<input type="submit" name="edit_submit" value="Edit Old" class="purple-gradient" onclick="SaveData('daily_attendance/editattendance','oldaten','2','','','editattendance','1');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" style="border: none;padding:10px 10px;color: white;cursor: pointer;font-size: 14px;">
    </div>
<?php } ?>



<!-- Start User Dropdown List -->
<?php if((in_array('user_edit_old',$thisper)) AND !in_array('atten_show_all',$thisper)){ ?> <!-- Start control Access -->

<?php 
       function userlist($hrmloggedid,$lavel)
       { 
           $user_dropdown=mysql_query("SELECT employee.id,employee.name,employee.salaryId,employee.designation,teamamtes.mateid FROM employee,team,teamamtes WHERE team.leader = $hrmloggedid AND teamamtes.mateid = employee.id AND teamamtes.teamid = team.id AND team.delete = 0 AND employee.delete = 0 AND employee.empstatus = 2");
           while($row_team=mysql_fetch_array($user_dropdown))
           {
                $emp_id=$row_team['id'];          
                echo '<option value="'.$row_team['id']."***".$row_team['name'].'">'.$lavel.$row_team['name'].'</option>';
                userlist($emp_id,$lavel."---");
           }

       }
?>
<div style="width:500px;position: absolute;right: 0;top: 1px;">
<select class="input drop-down large" name="req" id="oldaten0" required="required">
<option value="">Select Team Member</option>
<?php userlist($hrmloggedid,$lavel); ?>
</select>
<input class="input drop-down large" type="date" name="req" id="oldaten1" style="border: 1px solid #ccc;" required="required">
<input type="submit" name="edit_submit" value="Edit Old" class="purple-gradient" onclick="SaveData('daily_attendance/editattendance','oldaten','2','','','edituserattendance','1');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" style="border: none;padding:10px 10px;color: white;cursor: pointer;font-size: 14px;">
</div>
<?php } ?> <!-- Close control Access -->
<!-- End User Dropdown List -->


</div>


<!----------------- Start Select Team List Part  ------------------------>
<?php if((in_array('atten_show_all',$thisper)) or $hrmloggedid==93){ ?>
     
<!-- Start Team List -->
<div id="displayteam">
<div id="displayallteam"></div>
</div>
<!-- End Team List -->

<?php } ?> <!-- Close control Access -->

<!----------------- End Select Team List Part  ------------------------> 



<!----------------------------------Start Maneger List (verticle heads and FM)------------------------------------->

<?php if(in_array('atten_maneger',$thisper) or $hrmloggedid==93) { ?>

<div style="display:inline-block;" id="editattendance"> </div>

<form action="daily_attendance/save.php" method="post" target="attendanceformmaneger">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr><td colspan="12" style="text-align:center"><div style="display:inline-block;" id="couResp">Manager Attendance</div></td></tr>

     <?php 

     $i=0;
    // $heads_id = "1,73,74,83,85,310,391,581";     
     $v_head=mysql_query ("SELECT `id`,`name` FROM employee WHERE `role` IN ($heads_id) AND `empstatus`=2 AND `delete`=0 ORDER BY `name` ASC");
     while ($row_head = mysql_fetch_array($v_head))
	 { 
         $id=$row_head["id"];
		 $empname=$row_head["name"];
         $cdate = date("Y-m-d",strtotime($datetime));
		 $attendance = mysql_query("SELECT `id`, `current_date`, `attendance`, `remark`, `comment`, `emp_id`, `update_by` FROM `daily_attendance` WHERE  `current_date`='$cdate' AND `emp_id`='$id' AND `delete`=0 AND `status`=1");
		 $atten = mysql_num_rows($attendance);

?>


     <?php if($atten<=0) { ?>
		<tr>
	    <td style="width:100px"> <?php echo $empname; ?></td>		
		<td style="width:100px">
		 <input name="id<?php echo $i; ?>" type="hidden" value="<?php echo $id; ?>"/>
		 <input name="year<?php echo $i; ?>" type="hidden" value="<?php echo date("Y"); ?>"/>
		 <input name="currentdate<?php echo $i; ?>" type="text" readonly="readonly" value="<?php echo date("Y-n-j"); ?>"/>
		</td>          
		<td  style="width:100px">
		<select name="attendance<?php echo $i; ?>" class="input drop-down large" required="required" onchange="getModule('daily_attendance/remark_dropdown?cvalue=<?php echo $id; ?>&ival=<?php echo $i; ?>&mainval='+this.value,'attendances<?php echo $id; ?>','','Attendance')">
						<option value="">Select Attendance</option>
						<option value="1">P</option>
						<option value="2">A</option>
						<option value="3">WO-I</option>
						<option value="4">FHL</option>
						<option value="5">SHL</option>
						<option value="6">TP</option>
						<option value="7">ABSCOND</option>
						<option value="8">RESIGNATION</option>
						<option value="9">TERMINATION</option>
					</select>
		</td>
		<td style="width:100px" id="attendances<?php echo $id; ?>">
		<select name="remark<?php echo $i; ?>" class="input drop-down large" id="finalremark<?php echo $id; ?>"> 
						<option value="">Select Remark</option>
					</select>
		</td>

		<td style="width:100px">
		  <textarea name="comment<?php echo $i; ?>" type="text" rows="1" id="comment" placeholder="Comment here..."></textarea>
	    </td>
	    <td style="width:30px">
		 <b style="color: red;">NotSubmit</b>
	    </td>
	     <td style="width:30px">
		 <b style="color: blue;"><div onclick="getModule('daily_attendance/view?uid=<?php echo base64_encode($id); ?>','manipulateContent','viewContent','Attendance View')" style="cursor: pointer;">View</div></b>
	    </td>
		</tr>
	<?php } else{  ?>	

    <?php while ($rowattendance = mysql_fetch_array($attendance))
	   { ?>

		<tr>
	    <td style="width:100px"> <?php echo $empname; ?></td>		
		<td style="width:100px">
		 <input name="id<?php echo $i; ?>" type="hidden" value="<?php echo $rowattendance['emp_id']; ?>"/>
		 <input name="year<?php echo $i; ?>" type="hidden" value="<?php echo date("Y"); ?>"/> 
		 <input name="currentdate<?php echo $i; ?>" type="text" readonly="readonly" value="<?php echo $rowattendance['current_date']; ?>"/>
		</td>          
		<td  style="width:100px">
		<select name="attendance<?php echo $i; ?>" class="input drop-down large" required="required" onchange="getModule('daily_attendance/remark_dropdown?cvalue=<?php echo $id; ?>&ival=<?php echo $i; ?>&mainval='+this.value,'attendances<?php echo $id; ?>','','Attendance')">
						<option value="">Select Attendance</option>
						<option value="1" <?php if($rowattendance['attendance']=="1") echo 'selected="selected"'; ?>>P</option>
						<option value="2" <?php if($rowattendance['attendance']=="2") echo 'selected="selected"'; ?>>A</option>
						<option value="3" <?php if($rowattendance['attendance']=="3") echo 'selected="selected"'; ?>>WO-I</option>
						<option value="4" <?php if($rowattendance['attendance']=="4") echo 'selected="selected"'; ?>>FHL</option>
						<option value="5" <?php if($rowattendance['attendance']=="5") echo 'selected="selected"'; ?>>SHL</option>
						<option value="6" <?php if($rowattendance['attendance']=="6") echo 'selected="selected"'; ?>>TP</option>
						<option value="7" <?php if($rowattendance['attendance']=="7") echo 'selected="selected"'; ?>>ABSCOND</option>
						<option value="8" <?php if($rowattendance['attendance']=="8") echo 'selected="selected"'; ?>>RESIGNATION</option>
						<option value="9" <?php if($rowattendance['attendance']=="9") echo 'selected="selected"'; ?>>TERMINATION</option>
					</select>
		</td>
		<td style="width:100px" id="attendances<?php echo $id; ?>">
	    <?php if($rowattendance['remark']>0) { ?> 	
		<select name="remark<?php echo $i; ?>" class="input drop-down large" id="finalremark<?php echo $id; ?>">
						<option value="">Select Remark</option>						
					    <option value="1" <?php if($rowattendance['remark']=="1") echo 'selected="selected"'; ?>>INT-YES-APP</option>
						<option value="2" <?php if($rowattendance['remark']=="2") echo 'selected="selected"'; ?>>INT-YES-UNAPP</option>
						<option value="3" <?php if($rowattendance['remark']=="3") echo 'selected="selected"'; ?>>INT-NO-UNAPP</option>
					   
		</select>
	   <?php }else{ ?> 
           <select name="remark<?php echo $i; ?>" class="input drop-down large" id="finalremark<?php echo $id; ?>">
						<option value="">Select Remark</option>	
		</select>
	   <?php } ?>	
		</td> 

		<td style="width:100px">
		  <textarea name="comment<?php echo $i; ?>" type="text" rows="1" id="comment" placeholder="Comment here..."><?php echo $rowattendance['comment']; ?></textarea>
	    </td>
	    <td style="width:30px">
	     <?php if($rowattendance['attendance']!="0") { ?>	
		 <b style="color: green;">Submitted</b>
		<?php }else{ ?>
		 <b style="color: red;">NotSubmit</b>
		 <?php } ?>
	    </td>
	    <td style="width:30px">
		 <b style="color: blue;"><div onclick="getModule('daily_attendance/view?uid=<?php echo base64_encode($id); ?>','manipulateContent','viewContent','Attendance View')" style="cursor: pointer;">View</div></b>
	    </td>
		</tr>
       <?php } ?>	
	<?php } ?>	

    <?php $i++; } ?>
 
 	<input name="total" type="hidden" value="<?php echo $i; ?>"/>		
 	<?php if(in_array('atten_submit',$thisper)) 	{ ?>
		<tr>
			<td colspan="6" style="text-align:center">
<input type="Submit" name="submitmaneger" value="Submit Attendance" class="purple-gradient" style="border: none;padding:10px 20px;color: white;cursor: pointer;font-size: 14px;">
			</td>
		</tr>
	<?php } ?>
		</table>
		</form>

<?php } ?>

<!---------------------------------------Close Maneger List (verticle heads and FM)------------------------------------------>




<!-- Start Team List -->
<div id="dropdownteam">
<div id="displayallteam"></div>
</div>
<!-- End Team List -->


<!-- Start User List -->

<?php if(in_array('atten_user',$thisper) AND !in_array('atten_show_all',$thisper) AND $hrmloggedid!=93) { ?>
<div style="display:inline-block;" id="edituserattendance"> </div>
<?php while ($final_department_list = mysql_fetch_array($department_list))
	 { $department_id= $final_department_list['id']; $department_name= $final_department_list['name']; 

    if((in_array('atten_show_all',$thisper)) or $hrmloggedid==93){
     $result1 = mysql_query("$master AND employee.department='$department_id' AND employee.id!=613");
     }else{  $result1 = mysql_query("$master AND employee.id!=613"); }

     $total_count = mysql_num_rows($result1);

	 ?>


<?php if($total_count>0) { ?> <!-- Start Count Rows Loop -->	

<div style="text-align: center;font-weight: bold;margin-top: 30px;"> <?php  echo $department_name; ?> </div>

<!-- Start Self code -->
<?php if($self_count>0) { ?>
<form action="daily_attendance/save.php" method="post" target="attendanceform">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>

     <?php 
     
       $i=0;
       while ($row_self = mysql_fetch_array($self_show))
	   {
		 $id=$row_self['id'];
		 $empname=$row_self['name'];

         $cdate = date("Y-m-d",strtotime($datetime));
		 $attendance = mysql_query("SELECT `id`, `current_date`, `attendance`, `remark`, `comment`, `emp_id`, `update_by` FROM `daily_attendance` WHERE  `current_date`='$cdate' AND `emp_id`='$id' AND `delete`=0 AND `status`=1");
		 $atten = mysql_num_rows($attendance);
 
     ?>

     <?php if($atten<=0) { ?>
		<tr>
	    <td style="width:100px"> <?php echo $empname; ?></td>		
		<td style="width:100px">
		 <input name="id<?php echo $i; ?>" type="hidden" value="<?php echo $id; ?>"/>
		 <input name="year<?php echo $i; ?>" type="hidden" value="<?php echo date("Y"); ?>"/>
		 <input name="currentdate<?php echo $i; ?>" type="text" readonly="readonly" value="<?php echo date("Y-n-j"); ?>"/>
		</td>          
		<td  style="width:100px">
		<select name="attendance<?php echo $i; ?>" class="input drop-down large" required="required" onchange="getModule('daily_attendance/remark_dropdown?cvalue=<?php echo $id; ?>&ival=<?php echo $i; ?>&mainval='+this.value,'attendances<?php echo $id; ?>','','Attendance')">
						<option value="">Select Attendance</option>
						<option value="1">P</option>
						<option value="2">A</option>
						<option value="3">WO-I</option>
						<option value="4">FHL</option>
						<option value="5">SHL</option>
						<option value="6">TP</option>
						<option value="7">ABSCOND</option>
						<option value="8">RESIGNATION</option>
						<option value="9">TERMINATION</option>
					</select>
		</td>
		<td style="width:100px" id="attendances<?php echo $id; ?>">
		<select name="remark<?php echo $i; ?>" class="input drop-down large" id="finalremark<?php echo $id; ?>"> 
						<option value="">Select Remark</option>
					</select>
		</td>

		<td style="width:100px">
		  <textarea name="comment<?php echo $i; ?>" type="text" rows="1" id="comment" placeholder="Comment here..."></textarea>
	    </td>
	    <td style="width:30px">
		 <b style="color: red;">NotSubmit</b>
	    </td>
	    <td style="width:30px">
		 <b style="color: blue;"><div onclick="getModule('daily_attendance/view?uid=<?php echo base64_encode($id); ?>','manipulateContent','viewContent','Attendance View')" style="cursor: pointer;">View</div></b>
	    </td>
		</tr>
	<?php } else{  ?>	

    <?php while ($rowattendance = mysql_fetch_array($attendance))
	   { ?>

		<tr>
	    <td style="width:100px"> <?php echo $empname; ?> </td>		
		<td style="width:100px">
		 <input name="id<?php echo $i; ?>" type="hidden" value="<?php echo $rowattendance['emp_id']; ?>"/>
		 <input name="year<?php echo $i; ?>" type="hidden" value="<?php echo date("Y"); ?>"/> 
		 <input name="currentdate<?php echo $i; ?>" type="text" readonly="readonly" value="<?php echo $rowattendance['current_date']; ?>"/>
		</td>          
		<td  style="width:100px">
		<select name="attendance<?php echo $i; ?>" class="input drop-down large" required="required" onchange="getModule('daily_attendance/remark_dropdown?cvalue=<?php echo $id; ?>&ival=<?php echo $i; ?>&mainval='+this.value,'attendances<?php echo $id; ?>','','Attendance')">
						<option value="">Select Attendance</option>
						<option value="1" <?php if($rowattendance['attendance']=="1") echo 'selected="selected"'; ?>>P</option>
						<option value="2" <?php if($rowattendance['attendance']=="2") echo 'selected="selected"'; ?>>A</option>
						<option value="3" <?php if($rowattendance['attendance']=="3") echo 'selected="selected"'; ?>>WO-I</option>
						<option value="4" <?php if($rowattendance['attendance']=="4") echo 'selected="selected"'; ?>>FHL</option>
						<option value="5" <?php if($rowattendance['attendance']=="5") echo 'selected="selected"'; ?>>SHL</option>
						<option value="6" <?php if($rowattendance['attendance']=="6") echo 'selected="selected"'; ?>>TP</option>
						<option value="7" <?php if($rowattendance['attendance']=="7") echo 'selected="selected"'; ?>>ABSCOND</option>
						<option value="8" <?php if($rowattendance['attendance']=="8") echo 'selected="selected"'; ?>>RESIGNATION</option>
						<option value="9" <?php if($rowattendance['attendance']=="9") echo 'selected="selected"'; ?>>TERMINATION</option>
					</select>
		</td>
		<td style="width:100px" id="attendances<?php echo $id; ?>">
	    <?php if($rowattendance['remark']>0) { ?> 	
		<select name="remark<?php echo $i; ?>" class="input drop-down large" id="finalremark<?php echo $id; ?>">
						<option value="">Select Remark</option>						
					    <option value="1" <?php if($rowattendance['remark']=="1") echo 'selected="selected"'; ?>>INT-YES-APP</option>
						<option value="2" <?php if($rowattendance['remark']=="2") echo 'selected="selected"'; ?>>INT-YES-UNAPP</option>
						<option value="3" <?php if($rowattendance['remark']=="3") echo 'selected="selected"'; ?>>INT-NO-UNAPP</option>
					   
		</select>
	   <?php }else{ ?> 
           <select name="remark<?php echo $i; ?>" class="input drop-down large" id="finalremark<?php echo $id; ?>">
						<option value="">Select Remark</option>	
		</select>
	   <?php } ?>	
		</td> 

		<td style="width:100px">
		  <textarea name="comment<?php echo $i; ?>" type="text" rows="1" id="comment" placeholder="Comment here..."><?php echo $rowattendance['comment']; ?></textarea>
	    </td>
	    <td style="width:30px">
	     <?php if($rowattendance['attendance']!="0") { ?>	
		 <b style="color: green;">Submitted</b>
		<?php }else{ ?>
		 <b style="color: red;">NotSubmit</b>
		 <?php } ?>
	    </td>
	    <td style="width:30px">
		 <b style="color: blue;"><div onclick="getModule('daily_attendance/view?uid=<?php echo base64_encode($id); ?>','manipulateContent','viewContent','Attendance View')" style="cursor: pointer;">View</div></b>
	    </td>
		</tr>
       <?php } ?>	
	<?php } ?>	

    <?php $i++; } ?>
	<input name="total" type="hidden" value="<?php echo $i; ?>"/>		
	<?php if(in_array('atten_submit',$thisper)) { ?>
			<tr>
				<td colspan="6" style="text-align:center">
<input type="Submit" name="submit" value="Submit Attendance" class="dark-green-gradient" style="background-color: green;border: none;padding:10px 20px;color: white;cursor: pointer;font-size: 14px;"> 
				</td>
			</tr>
	<?php } ?> 	
		</table>
		</form>
		<?php } ?>
<!-- END Self code -->


<!-- Start user teams -->
<form action="daily_attendance/save.php" method="post" target="attendanceform">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>

     <?php 
       $i=0;
       while ($rowemp = mysql_fetch_array($result1))
	   {
		 $id=$rowemp["id"];
		 $empname=$rowemp["name"];

         $cdate = date("Y-m-d",strtotime($datetime));
		 $attendance = mysql_query("SELECT `id`, `current_date`, `attendance`, `remark`, `comment`, `emp_id`, `update_by` FROM `daily_attendance` WHERE  `current_date`='$cdate' AND `emp_id`='$id' AND `delete`=0 AND `status`=1");
		 $atten = mysql_num_rows($attendance);
 
     ?>

     <?php if($atten<=0) { ?>
		<tr>
	    <td style="width:100px"> <?php echo $empname; ?></td>		
		<td style="width:100px">
		 <input name="id<?php echo $i; ?>" type="hidden" value="<?php echo $id; ?>"/>
		 <input name="year<?php echo $i; ?>" type="hidden" value="<?php echo date("Y"); ?>"/>
		 <input name="currentdate<?php echo $i; ?>" type="text" readonly="readonly" value="<?php echo date("Y-n-j"); ?>"/>
		</td>          
		<td  style="width:100px">
		<select name="attendance<?php echo $i; ?>" class="input drop-down large" required="required" onchange="getModule('daily_attendance/remark_dropdown?cvalue=<?php echo $id; ?>&ival=<?php echo $i; ?>&mainval='+this.value,'attendances<?php echo $id; ?>','','Attendance')">
						<option value="">Select Attendance</option>
						<option value="1">P</option>
						<option value="2">A</option>
						<option value="3">WO-I</option>
						<option value="4">FHL</option>
						<option value="5">SHL</option>
						<option value="6">TP</option>
						<option value="7">ABSCOND</option>
						<option value="8">RESIGNATION</option>
						<option value="9">TERMINATION</option>
					</select>
		</td>
		<td style="width:100px" id="attendances<?php echo $id; ?>">
		<select name="remark<?php echo $i; ?>" class="input drop-down large" id="finalremark<?php echo $id; ?>"> 
						<option value="">Select Remark</option>
					</select>
		</td>

		<td style="width:100px">
		  <textarea name="comment<?php echo $i; ?>" type="text" rows="1" id="comment" placeholder="Comment here..."></textarea>
	    </td>
	    <td style="width:30px">
		 <b style="color: red;">NotSubmit</b>
	    </td>
	    <td style="width:30px">
		 <b style="color: blue;"><div onclick="getModule('daily_attendance/view?uid=<?php echo base64_encode($id); ?>','manipulateContent','viewContent','Attendance View')" style="cursor: pointer;">View</div></b>
	    </td>
		</tr>
	<?php } else{  ?>	

    <?php while ($rowattendance = mysql_fetch_array($attendance))
	   { ?>

		<tr>
	    <td style="width:100px"> <?php echo $empname; ?></td>		
		<td style="width:100px">
		 <input name="id<?php echo $i; ?>" type="hidden" value="<?php echo $rowattendance['emp_id']; ?>"/>
		 <input name="year<?php echo $i; ?>" type="hidden" value="<?php echo date("Y"); ?>"/> 
		 <input name="currentdate<?php echo $i; ?>" type="text" readonly="readonly" value="<?php echo $rowattendance['current_date']; ?>"/>
		</td>          
		<td  style="width:100px">
		<select name="attendance<?php echo $i; ?>" class="input drop-down large" required="required" onchange="getModule('daily_attendance/remark_dropdown?cvalue=<?php echo $id; ?>&ival=<?php echo $i; ?>&mainval='+this.value,'attendances<?php echo $id; ?>','','Attendance')">
						<option value="">Select Attendance</option>
						<option value="1" <?php if($rowattendance['attendance']=="1") echo 'selected="selected"'; ?>>P</option>
						<option value="2" <?php if($rowattendance['attendance']=="2") echo 'selected="selected"'; ?>>A</option>
						<option value="3" <?php if($rowattendance['attendance']=="3") echo 'selected="selected"'; ?>>WO-I</option>
						<option value="4" <?php if($rowattendance['attendance']=="4") echo 'selected="selected"'; ?>>FHL</option>
						<option value="5" <?php if($rowattendance['attendance']=="5") echo 'selected="selected"'; ?>>SHL</option>
						<option value="6" <?php if($rowattendance['attendance']=="6") echo 'selected="selected"'; ?>>TP</option>
						<option value="7" <?php if($rowattendance['attendance']=="7") echo 'selected="selected"'; ?>>ABSCOND</option>
						<option value="8" <?php if($rowattendance['attendance']=="8") echo 'selected="selected"'; ?>>RESIGNATION</option>
						<option value="9" <?php if($rowattendance['attendance']=="9") echo 'selected="selected"'; ?>>TERMINATION</option>
					</select>
		</td>
		<td style="width:100px" id="attendances<?php echo $id; ?>">
	    <?php if($rowattendance['remark']>0) { ?> 	
		<select name="remark<?php echo $i; ?>" class="input drop-down large" id="finalremark<?php echo $id; ?>">
						<option value="">Select Remark</option>						
					    <option value="1" <?php if($rowattendance['remark']=="1") echo 'selected="selected"'; ?>>INT-YES-APP</option>
						<option value="2" <?php if($rowattendance['remark']=="2") echo 'selected="selected"'; ?>>INT-YES-UNAPP</option>
						<option value="3" <?php if($rowattendance['remark']=="3") echo 'selected="selected"'; ?>>INT-NO-UNAPP</option>
					   
		</select>
	   <?php }else{ ?> 
           <select name="remark<?php echo $i; ?>" class="input drop-down large" id="finalremark<?php echo $id; ?>">
						<option value="">Select Remark</option>	
		</select>
	   <?php } ?>	
		</td> 

		<td style="width:100px">
		  <textarea name="comment<?php echo $i; ?>" type="text" rows="1" id="comment" placeholder="Comment here..."><?php echo $rowattendance['comment']; ?></textarea>
	    </td>
	    <td style="width:30px">
	     <?php if($rowattendance['attendance']!="0") { ?>	
		 <b style="color: green;">Submitted</b>
		<?php }else{ ?>
		 <b style="color: red;">NotSubmit</b>
		 <?php } ?>
	    </td>
	    <td style="width:30px">
		 <b style="color: blue;"><div onclick="getModule('daily_attendance/view?uid=<?php echo base64_encode($id); ?>','manipulateContent','viewContent','Attendance View')" style="cursor: pointer;">View</div></b>
	    </td>
		</tr>
       <?php } ?>	
	<?php } ?>	

    <?php $i++; } ?>
	<input name="total" type="hidden" value="<?php echo $i; ?>"/>		
	<?php if(in_array('atten_submit',$thisper)) { ?>
			<tr>
				<td colspan="6" style="text-align:center">
<input type="Submit" name="submit" value="Submit Attendance" class="dark-green-gradient" style="background-color: green;border: none;padding:10px 20px;color: white;cursor: pointer;font-size: 14px;"> 
				</td>
			</tr>
	<?php } ?> 	
		</table>
		</form> <!-- End user teams -->
	<?php } ?> <!-- Close Count Rows Loop -->	
		<?php }	?> <!-- Close Department Loop -->
	<?php } ?> <!-- Close Control Access Loop -->


	 <!-- Close User List -->




</div>

</div>

<iframe name="attendanceform" style="display:none"></iframe>
<iframe name="attendanceformmaneger" style="display:none"></iframe>


