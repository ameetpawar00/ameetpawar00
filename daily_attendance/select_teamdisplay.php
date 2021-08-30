<?php
include("../include/conFig.php");

$mates = $_GET['tvalue'];

$str_arr = explode ("***", $mates);  
$mates_id=$str_arr['0'];
$mates_name=$str_arr['1'];

?>



  <?php if($mates_id!=''){ ?> 

<?php

    $all_teamamtes=mysql_query ("SELECT `mateid` FROM `teamamtes` WHERE `teamid` = $mates_id");  
    $all_teamamtes_count = mysql_num_rows($all_teamamtes);
    //  echo $all_teamamtes_count."</br>";
    if($all_teamamtes_count>0)
    {  ?>



<form action="daily_attendance/save.php" method="post" target="attendanceform" id="displayallteam">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr><td colspan="12" style="text-align:center"><div style="display:inline-block;" id="couResp"> <?php echo $mates_name; ?></div></td></tr>

        <?php $i=0; while ($row_all_teamamtes = mysql_fetch_array($all_teamamtes))
          { $matelist= $row_all_teamamtes['mateid'];
            $emp_get=mysql_query ("SELECT DISTINCT `id`,`name` FROM `employee` WHERE `id` = $matelist");   
           while ($row_emp_get = mysql_fetch_array($emp_get))
            {
            	$id=$row_emp_get['id'];
                $empname= $row_emp_get['name']; 

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

 <?php } ?>	