<?php
include("../include/conFig.php");
$travelid = $_GET['id'];
?>


<div class="title">Leave Calendar</div>
<div class="strip">
<span>Dashboard</span>
<span>Leave Calendar</span>
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
Add Leave In Calendar</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>
<tr>
<th>Year *</th>
<td><select class="input drop-down large" name="req" id="levc0">
				<option value="">Select Year</option>
				<?php 
				for($j=2013;$j<=2020;$j++)
				{
				echo '<option value="'.$j.'">'.$j.'</option>';
				}
				?>
				
			</select>

</td>
</tr>

<tr>
<th>Event *</th>
<td><input class="input medium"  name="req" type="text" id="levc1"></td>
</tr>
<tr>
<th style="height: 42px">Date <span>*</span></th>
<td style="height: 42px"><input name="s" id="levc2" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalender('calenderid0','levc2')"/>
<div class="calender" id="calenderid0"></div>
</td>
</tr>
<tr>
<th>Description
</th>
<td colspan="3">
<textarea id="levc3" class="input huge" name="TextArea" style="width: 475px; height: 75px"></textarea>
</td>
</tr>

<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('leavecalendar/save','levc','4','','','couResp','1');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>

</table>
	</div>
</div>


