<?php include ("../include/conFig.php"); ?>
<div class="title">Special Day</div>
	<div class="strip">
		<span>Dashboard</span>
		<span>Special Day</span>
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

<!--
<ul class="breadcrumb">
	<li><a href="#">Home</a><span class="divider">&raquo;</span></li>
	<li class="active"  onclick="getModule('assets/view','viewContent','manipulateContent','Assets')">Source</li>
	<div class="red awesome small" onclick="getModule('assets/view','viewContent','manipulateContent','Assets')" style="float:right">Back To Assets</div>

</ul>
-->
<div style="overflow-x:hidden;overflow-y:scroll;height:500px">
	<div class="add-new blue-border">
			<div class="form-head blue">
				<div class="head-title"> 
					<i class="add-form"></i> 
					Add Special Day
				</div>
			</div>
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td colspan="2" style="text-align:center">
					<div style="display:inline-block;" id="couResp"></div>
				</td>
			</tr>
			<tr>
				<td>Special Day Type<span>*</span></td>
				<td>
					<select class="input drop-down large"  name="req" id="cal0" style="width: 114px" onchange="" >
						<option value="1" selected>Market Off</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Special Day </td>
				<td>
					<input name="req" id="cal1" class="input medium" type="text" value=""   style="width:200px" />
				</td>
			</tr>
			<tr>
				<td>In Time (Formate: 00:00:00)</td>
				<td>
					<input name="req" id="cal2" class="input medium" type="time" value=""   style="width:200px" />
				</td>
			</tr>
			<tr>
				<td>Date</td>
				<td>
					<input class="input medium" name="req" id="cal3" type="" class="input medium" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalender('calenderid0','cal3')"/>
					<div class="calender" id="calenderid0"></div>
				</td>
			</tr>
			<tr>
				<td colspan="4" style="text-align:center">
					<button class="button green" onclick="SaveData('calender/save','cal','4','','','couResp','1');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i>Save</button>
					<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
				</td>
			</tr>
		</table>
	</div>
</div>
