<?php
include("../../include/conFig.php");
$travelid = $_GET['id'];
?>


<div class="title">Event Schedule</div>
<div class="strip">
<span>Dashboard</span>
<span>Event Schedule</span>
<span>Add New</span>
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
Add Event Schedule </div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td colspan="2" style="text-align:center">
		<div style="display:inline-block;" id="couResp"></div>
	</td>
</tr>
<tr>
<th>Occasion *</th>
<td><input class="input medium"  name="req" type="text" id="eve_sc0"></td>
<th style="height: 42px">Venue <span>*</span></th>
<td style="height: 42px">
<input name="s" id="eve_sc1" type="text" class="input medium" style="width:200px" />
</td>
</tr>
<tr>
<th style="height: 42px">Date <span>*</span></th>
<td style="height: 42px"><input name="s" id="eve_sc2" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalender('calenderid0','eve_sc2')"/>
<div class="calender" id="calenderid0"></div>
</td>
<th style="height: 42px">Time <span>*</span>(Formate: 00:00:00)</th>
<td style="height: 42px">
<input name="s" id="eve_sc3" type="time" class="input medium" style="width:200px" />
</td>
</tr>
<tr>
<th style="height: 42px">Department <span>*</span><br>(For Multi Select Please Keep Pressing "Ctrl" Key)</th>
<td style="height: 42px">
	 <select multiple class="input huge" name="s" id="eve_sc4">
	 <?php
		$getDept = mysql_query("SELECT `id`,`name` FROM `department` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
			while($rowDept = mysql_fetch_array($getDept))
				{
					$id=$rowDept['id'];
					$name=$rowDept['name'];
					echo "<option value='$id'>$name</option>";
				}
				
		?>
	
	</select> 
	
				
</td>

<th>Description
</th>
<td colspan="3">
<textarea id="eve_sc5" class="input huge" name="TextArea" style="width: 475px; height: 75px"></textarea>
</td>
</tr>

<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('management/events/save?sel='+$('#eve_sc4').val(),'eve_sc','6','','','couResp','1');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>

</table>
	</div>
</div>


