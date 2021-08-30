<?php
	include("../include/conFig.php");

	 $valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);

foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
 $post[] .= $val;
}
   $emp_id=$post[0];
   $atten_date=$post[1];
   $i=0;
   $emp_data=mysql_query("SELECT daily_attendance.id, daily_attendance.current_date, daily_attendance.attendance, daily_attendance.remark, daily_attendance.comment,employee.name FROM daily_attendance,employee WHERE daily_attendance.delete=0 AND daily_attendance.status=1 AND daily_attendance.current_date='$atten_date' AND daily_attendance.emp_id='$emp_id' AND employee.id='$emp_id'");
   $emp_row_count=mysql_num_rows($emp_data);
  ?> 
  <?php if($emp_row_count>0) { ?>
  <form action="daily_attendance/edit-save.php" method="post" target="editattendanceform">
      <table cellpadding="0" cellspacing="0" width="100%">
   <?php while ($row_emp=mysql_fetch_array($emp_data)) {
          $id= $row_emp['id']; 
   	?>
   <tr>
   <td style="width: 210px;"><strong><?php echo $row_emp['name']; ?></strong></td>
   <td style="width: 210px;"><input type="text" name="currentdate<?php echo $i; ?>" value="<?php echo $row_emp['current_date']; ?>" readonly="readonly"></td>
      <td style="width: 210px;">
         <select name="attendance<?php echo $i; ?>" class="input drop-down large" required="required" onchange="getModule('daily_attendance/remark_dropdown?cvalue=<?php echo $id; ?>&ival=<?php echo $i; ?>&mainval='+this.value,'editattendances<?php echo $id; ?>','','Attendance')">
            <option value="">Select Attendance</option>
            <option value="1" <?php if($row_emp['attendance']=="1") echo 'selected="selected"'; ?>>P</option>
            <option value="2" <?php if($row_emp['attendance']=="2") echo 'selected="selected"'; ?>>A</option>
            <option value="3" <?php if($row_emp['attendance']=="3") echo 'selected="selected"'; ?>>WO-I</option>
            <option value="4" <?php if($row_emp['attendance']=="4") echo 'selected="selected"'; ?>>FHL</option>
            <option value="5" <?php if($row_emp['attendance']=="5") echo 'selected="selected"'; ?>>SHL</option>
            <option value="6" <?php if($row_emp['attendance']=="6") echo 'selected="selected"'; ?>>TP</option>
            <option value="7" <?php if($row_emp['attendance']=="7") echo 'selected="selected"'; ?>>ABSCOND</option>
            <option value="8" <?php if($row_emp['attendance']=="8") echo 'selected="selected"'; ?>>RESIGNATION</option>
            <option value="9" <?php if($row_emp['attendance']=="9") echo 'selected="selected"'; ?>>TERMINATION</option>
         </select>
      </td>

      <td style="width:210px" id="editattendances<?php echo $id; ?>">
       <?php if($row_emp['remark']>0) { ?>   
      <select name="remark<?php echo $i; ?>" class="input drop-down large" id="finalremark<?php echo $id; ?>">
                  <option value="">Select Remark</option>                  
                   <option value="1" <?php if($row_emp['remark']=="1") echo 'selected="selected"'; ?>>INT-YES-APP</option>
                  <option value="2" <?php if($row_emp['remark']=="2") echo 'selected="selected"'; ?>>INT-YES-UNAPP</option>
                  <option value="3" <?php if($row_emp['remark']=="3") echo 'selected="selected"'; ?>>INT-NO-UNAPP</option>
                  
      </select>
      <?php }else{ ?> 
           <select name="remark<?php echo $i; ?>" class="input drop-down large" id="finalremark<?php echo $id; ?>">
                  <option value="">Select Remark</option>   
      </select>
      <?php } ?>  
      </td> 

      <td style="width:210px">
        <textarea name="comment<?php echo $i; ?>" type="text" rows="1" id="comment" placeholder="Comment here..."><?php echo $row_emp['comment']; ?></textarea>
      </td>

      </tr>         

<?php  $i++; } ?>

<input name="emp_id" type="hidden" value="<?php echo $id; ?>"/>    
<input name="check_status" type="hidden" value="<?php echo $id; ?>"/>  
   <?php if(in_array('atten_submit',$thisper))  { ?>
      <tr>
         <td colspan="6" style="text-align:center">
<input type="Submit" name="submitedit" value="Update Attendance" class="purple-gradient" style="border: none;padding:10px 20px;color: white;cursor: pointer;font-size: 14px;">
         </td>
      </tr>
   <?php } ?>

</table>
</form>
<?php } else{ ?>

<?php $emp_data=mysql_query("SELECT id,name FROM employee WHERE `delete`=0 AND `empstatus`=2 AND `id`='$emp_id'");
 ?>
 <form action="daily_attendance/edit-save.php" method="post" target="editattendanceform">
      <table cellpadding="0" cellspacing="0" width="100%">
   <?php while ($row_emp=mysql_fetch_array($emp_data)) {
          $id= $row_emp['id']; 
   	?>
   <tr>
   <td style="width: 210px;"><strong><?php echo $row_emp['name']; ?></strong></td>
   <td style="width: 210px;"><input type="text" name="currentdate<?php echo $i; ?>" value="<?php echo $atten_date; ?>" readonly="readonly"></td>
      <td style="width: 210px;">
         <select name="attendance<?php echo $i; ?>" class="input drop-down large" required="required" onchange="getModule('daily_attendance/remark_dropdown?cvalue=<?php echo $id; ?>&ival=<?php echo $i; ?>&mainval='+this.value,'editattendances<?php echo $id; ?>','','Attendance')">
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

      <td style="width:210px" id="editattendances<?php echo $id; ?>">
       <?php if($row_emp['remark']>0) { ?>   
      <select name="remark<?php echo $i; ?>" class="input drop-down large" id="finalremark<?php echo $id; ?>">
                  <option value="">Select Remark</option>                  
                   <option value="1">INT-YES-APP</option>
                  <option value="2">INT-YES-UNAPP</option>
                  <option value="3">INT-NO-UNAPP</option>
                  
      </select>
      <?php }else{ ?> 
           <select name="remark<?php echo $i; ?>" class="input drop-down large" id="finalremark<?php echo $id; ?>">
                  <option value="">Select Remark</option>   
      </select>
      <?php } ?>  
      </td> 

      <td style="width:210px">
        <textarea name="comment<?php echo $i; ?>" type="text" rows="1" id="comment" placeholder="Comment here..."></textarea>
      </td>

      </tr>         

<?php  $i++; } ?>

<input name="emp_id" type="hidden" value="<?php echo $id; ?>"/> 
<input name="check_status" type="hidden" value="0"/> 

   <?php if(in_array('atten_submit',$thisper))  { ?>
      <tr>
         <td colspan="6" style="text-align:center">
<input type="Submit" name="submitedit" value="Update Attendance" class="purple-gradient" style="border: none;padding:10px 20px;color: white;cursor: pointer;font-size: 14px;">
         </td>
      </tr>
   <?php } ?>

</table>
</form>

<?php } ?>	

<iframe name="editattendanceform" style="display:none"></iframe>


