<div style="display:inline-block;position:relative;z-index:99999999 !important">
<div class="dropdown-menu ddm_ha" style="top: -10px; z-index: 99999999 !important; width: 315px ! important; display: none;right: -30px;" id="task">
<div class="dropdown-menu-inner">
<div class="dropdown-menu-inner-title">
Task Management
<?php if(in_array('a_empd',$thisper)) 
{
?>
<div title="Add New Task" style="margin:0px 0px 0px 148px;display:inline-block" class="button blue" onclick="$('#addtask').slideToggle('fast')"><i class="plus"></i></div>
<?php 
} 
?>

</div>

</div>
<div style="background:#fff;height:300px;width:312px;overflow-x:hidden;overflow-y:scroll;border:1px #CCCCCC solid">
<table id="addtask" style="display:none;color:black;">
<tr>
<td>Task Name<span>*</span></td></tr>
<tr></tr>
<tr>
<td><input name="req" class="input medium" data-original-title="" type="text"  style="width:250px!important" id="task0">
</td>
</tr>
<tr><td valign="top">Assignees <span>*</span></td>
<tr></tr><tr><td>
<div id="adddepart">
<select style="width:250px" name="req"  onchange="addToteam(this.value,'task1','depart','adddepart','redepartment')" class="input drop-down">
	<option value="">Select Member</option>

<?php
$getemp = mysql_query("SELECT `id`,`name` FROM `employee` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowemp = mysql_fetch_array($getemp))
{
?>				
				<option value="<?php echo $rowemp[0]."**".$rowemp[1]?>"><?php echo $rowemp[1]?></option>
<?php
}
?>				
			
			
			</select>
			
			<span id="redepartment"></span>
			<div style="padding:5px;margin-top:2px" id="depart" >
						</div>
			<input name="req" type="text" value="" id="task1" style="display:none">

						</div></td></tr>
				<tr>
				<td>
				Due date <span>*</span>
				</td>
				</tr><tr>
				<td><input name="req" id="task4" type="" value="" class="inputCalendar" style="width:250px" onclick="openCalendar(this);"></td>
				</tr>
<tr>	
	<td>Priority
	</td><tr>
	<td><select name="req" id="task2" style="width:250px" class="input drop-down">
	<option value="">Select Task Priority </option>
	<option value="Very High">Very High</option>
	<option value="High">High</option>
	<option value="Medium">Medium</option>
	<option value="Low">Low</option>
	<option value="Very Low">Very Low</option>
			</select>

	</td>
</tr>
<tr>
<td valign="top">Description<span>*</span></td></tr><tr>
<td><textarea name="req" data-original-title="" type="text" id="task3" style="width:250px"></textarea>
</td>
</tr>

<tr><td>
<button class="button red" onclick="SaveData('employee/task/save','task','5','','','couResp','1');$('#addtask').slideToggle('fast');closeMoodle()"><i class="save-icon"></i>create</button>
<button class="button gray" onclick="$('#addtask').slideToggle('fast')"><i class="close-icon"></i>Cancel</button>
</td></tr>
</table>
<?php
$geretask = mysql_query("SELECT * FROM `taskreassign` WHERE `delete` = '0' ",$con) or die(mysql_error());
while($rowretask = mysql_fetch_array($geretask))
{
$taskid = $rowretask[1];
$taskto = $rowretask[2];
$getaskto = mysql_query("SELECT * FROM `employee` WHERE `delete` = '0' AND `id` = '$taskto' ",$con) or die(mysql_error());
$rowtaskto = mysql_fetch_array($getaskto);
$getaskname = mysql_query("SELECT * FROM `task` WHERE `delete` = '0' AND `id` = '$taskid' ",$con) or die(mysql_error());
$rowtaskname = mysql_fetch_array($getaskname);
	if($taskto == $hrmloggedid)
	{
	?>
		<table cellpadding="0" cellspacing="0" border="0" style="font-size:14px;color:black;width:315px;" class="fetch">
			<tr style="background-color: #aaaaaa;color: white">
				<td width="3px"></td>
				<td width="104px">Task Name</td>
				<td width="104px">Due Date</td>
				<td width="104px">Proirity</td>
			</tr>
			<tr onclick="getModule('employee/task/task?tid=<?php echo $taskid?>','manipulatemoodleContent','viewmoodleContent','Task')" title="Click for detail view">
				<td>
					<img src="icons/working1.png">
				</td>
				<td width="104px">
					<?php echo $rowtaskname['name']?>
				</td>
				<td width="104px">
					<?php echo  date('d-m-y',strtotime($rowtaskname['duedate']));?>
				</td>
				<td width="104px"> 
					<?php echo  $rowtaskname['priority'] ?>
				 </td>
			</tr>
		</table>				
	<!--
		<div style="color:black;width:180px;padding:0 5px 0 5px;background:" onclick="getModule('employee/task/task?tid=<?php echo $taskid?>','manipulatemoodleContent','viewmoodleContent','Task')">"<?php echo $rowtaskname['name']?>" is due on: <?php echo $rowtaskname['duedate']?> Assign to <?php echo $rowtaskto['name']?>
		<hr>
		</div>-->
	<?php
	}
}

?>
<?php 
$getask = mysql_query("SELECT * FROM `task` WHERE `delete` = '0' ",$con) or die(mysql_error());
while($rowtask = mysql_fetch_array($getask))
{
		$tid = $rowtask[0];
		$member = explode(',',$rowtask['teamember']);
		$name = '';
		$member1 = str_ireplace('-','',$member);
		
		foreach($member1 as $val)
		{
			if($val)
			{		
			$getemp = mysql_query("SELECT `name` FROM `employee` WHERE `id` = '$val' ",$con) or die(mysql_error());
			$getemp = mysql_fetch_array($getemp);
			$name .= $getemp['name'].",";
				if($val == $hrmloggedid)
				{
				?>
		<table cellpadding="0" cellspacing="0" border="0" style="font-size:14px;color:black;width:315px;" class="fetch">
			<tr style="background-color: #aaaaaa;color: white">
				<td width="3px"></td>
				<td width="104px">Task Name</td>
				<td width="104px">Due Date</td>
				<td width="104px">Proirity</td>
			</tr>
			<tr onclick="getModule('employee/task/task?tid=<?php echo $tid ?>','manipulatemoodleContent','viewmoodleContent','Task')" title="Click for detail view">
				<td>
					<img src="icons/working1.png">
				</td>
				<td width="104px">
					<?php echo $rowtask['name']?>
				</td>
				<td width="104px">
					<?php echo date('d-m-y',strtotime($rowtask['duedate']));?>
				</td>
				<td width="104px"> 
					<?php echo  $rowtask['priority'] ?>
				 </td>
			</tr>
		</table>				
				<?php
				}
		}
	}
				if($hrmloggedid == 1)
				{
					if($rowtask['status'] == 0 && $rowtask['close'] == 0)
					{
				?>
						<table cellpadding="0" cellspacing="0" border="0" style="font-size:14px;color:black;width:315px;" class="fetch" >
								<tr style="background-color: #aaaaaa;color: white">
								<td width="3px"></td>
								<td width="104px">Task Name</td>
								<td width="104px">Due Date</td>
								<td width="104px">Proirity</td>
								</tr>
								<tr onclick="getModule('employee/task/taskadmin?tid=<?php echo $tid ?>','manipulatemoodleContent','viewmoodleContent','Task')" title="Click for detail view">
								<td>
								<img src="icons/pending.png">
								</td>
								<td width="104px">
								<?php echo $rowtask['name']?>
								</td>
								<td width="104px">
								<?php echo date('d-m-y',strtotime($rowtask['duedate']));?>
								</td>
								<td width="104px"> 
								<?php echo  $rowtask['priority'] ?> </td>
								</tr>
							</table>				
				</div>
				<?php
					}
					else if($rowtask['close'] == 1)
					{
					?>
						<table cellpadding="0" cellspacing="0" border="0" style="font-size:14px;color:black;width:315px;" class="fetch">
								<tr style="background-color: #aaaaaa;color: white">
								<td width="3px"></td>
								<td width="104px">Task Name</td>
								<td width="104px">Due Date</td>
								<td width="104px">Proirity</td>
								</tr>
								<tr onclick="getModule('employee/task/taskadmin?tid=<?php echo $tid ?>','manipulatemoodleContent','viewmoodleContent','Task')" title="Click for detail view">
								<td>
								<img src="icons/done.png">
								</td>
								<td width="104px">
								<?php echo $rowtask['name']?>
								</td>
								<td width="104px">
								<?php echo date('d-m-y',strtotime($rowtask['duedate']));?>
								</td>
								<td width="104px"> 
								<?php echo  $rowtask['priority'] ?> </td>
								</tr>
							</table>				

					<?php
					}
					else
					{
					?>
						<table cellpadding="0" cellspacing="0" border="0" style="font-size:14px;color:black;width:315px;" class="fetch">
								<tr style="background-color: #aaaaaa;color: white">
								<td width="3px"></td>
								<td width="104px">Task Name</td>
								<td width="104px">Due Date</td>
								<td width="104px">Proirity</td>
								</tr>
								<tr onclick="getModule('employee/task/taskadmin?tid=<?php echo $tid ?>','manipulatemoodleContent','viewmoodleContent','Task')" title="Click for detail view">
								<td>
								<img src="icons/working.png">
								</td>
								<td width="104px">
								<?php echo $rowtask['name']?>
								</td>
								<td width="104px">
								<?php echo date('d-m-y',strtotime($rowtask['duedate']));?>
								</td>
								<td width="104px"> 
								<?php echo  $rowtask['priority'] ?> </td>
								</tr>
							</table>				

					<?php
					}
					
				}
		
?>


<?php 
}
?>
</div>
</div>
	


