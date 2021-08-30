<?php
include("../../include/conFig.php");
$id = $_GET['id'];
$i = $_GET['i'];
$travelid = $_GET['id'];
$getData = mysql_query("SELECT `id`, `name`, `time`, `date`, `venue`, `department`, `descripion`, `createdate`, `updatedate`, `updatedby`, `delete` FROM `events` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
//print_r($row);
$id=$row["id"];
$name=$row["name"];
$time=$row["time"];
$date=$row["date"];
$venue=$row["venue"];
$department=$row["department"];
$descripion=$row["descripion"];

?>
<div class="title">Event Schedule</div>
<div class="strip">
<span>Dashboard</span>
<span>Event Schedule</span>
<span>Edit</span>
</div>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"> <i class="back"></i>Back</button>&nbsp;&nbsp;
</td>
</tr>
</table>
<div style="overflow-x:hidden;overflow-y:scroll;height:500px">
<div class="add-new green-border">
<div class="form-head green">
<div class="head-title"> 
<i class="add-form"></i> 
Edit Event Schedule</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<th>Occation *</th>
<td><input class="input medium"  name="req" type="text" id="eve_sc0" value="<?=$name?>"></td>
<th style="height: 42px">Venue <span>*</span></th>
<td style="height: 42px">
<input name="s" id="eve_sc1" type="text" class="input medium" style="width:200px"  value="<?=$venue?>" />
</td>
</tr>
<tr>
<th style="height: 42px">Date <span>*</span></th>
<td style="height: 42px"><input name="s" id="eve_sc2" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalender('calenderid0','eve_sc2')" value="<?=$date?>"/>
<div class="calender" id="calenderid0"></div>
</td>
<th style="height: 42px">Time <span>*</span>(Formate: 00:00:00)</th>
<td style="height: 42px">
<input name="s" id="eve_sc3" type="time" class="input medium" style="width:200px" value="<?=$time?>"/>
</td>
</tr>
<tr>
<th style="height: 42px">Department <span>*</span><br>(For Multi Select Please Keep Pressing "Ctrl" Key)</th>
<td style="height: 42px">
	 <select multiple class="input huge" name="s" id="eve_sc4">
	 <?php
	// $department
		
	
		$getDept = mysql_query("SELECT `id`,`name` FROM `department` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
			while($rowDept = mysql_fetch_array($getDept))
				{
					$ida=$rowDept['id'];
					$name=$rowDept['name'];
					$sel="";
					
					$department_ar=explode(",",$department);
					foreach($department_ar as $department_a)
					{
						if($department_a==$ida)
							{
								$sel="selected";
							} 
					}
						echo "<option value='$ida' $sel>$name</option>";
					
				}
				
		?>
	
	</select> 
	
				
</td>

<th>Description
</th>
<td colspan="3">
<textarea id="eve_sc5" class="input huge" name="TextArea" style="width: 475px; height: 75px"><?=$descripion?></textarea>
</td>
</tr>

<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('management/events/update?id=<?php echo $id?>&i=<?php echo $i?>&sel='+$('#eve_sc4').val(),'eve_sc','6','<?php echo $i?>','','couResp','2');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i>Update</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>

</table>
	</div>
</div>


