<?php
include("../include/conFig.php");
?>

<div class="title">Training</div>
<div class="strip">
<span>Dashboard</span>
<span>Training</span>
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
Add training</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>
<tr>
<th>Training Title <span>*</span></th>
<td><input name="req" type="text" class="input medium" id="tra0"></td>
<th>Owner <span>*</span></th>
<td><select class="input drop-down large" name="req" id="tra1">
				<option value="">Select Employee</option>
<?php
$getEmp = mysql_query("SELECT `id`,`name` FROM `employee` WHERE `delete`= '0'",$con) or die(mysql_error());
while($rowEmp = mysql_fetch_array($getEmp))
{
?>				
				<option value="<?php echo $rowEmp[0]?>"><?php echo $rowEmp[1]?></option>
<?php
}
?>				
			</select>
</td>
</tr>
<tr>
<th>Number Of Days <span>*</span></th>
<td><input name="req" type="text" class="input medium" id="tra2"></td>
<th>Venue</th>
<td><input name="" type="text" class="input medium" id="tra3"></td>

</tr>
<tr>
<th>Start Date
</th>
<td><input name="req" id="tra4" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalender('calenderid0','tra4')"/>
			<div class="calender" id="calenderid0"></div>
			</td>
<th>End Date
</th>
<td><input name="req" id="tra5" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalender('calenderid1','tra5')"/>
			<div class="calender" id="calenderid1"></div>
			</td>
</tr>
<tr>
<th>Status
</th>
<td>
<select class="input drop-down large" name="Select1" id="tra6">
				<option value="NA">-Select-</option>
				<option value="completed">Completed</option>
				<option value="notcompleted">Not Completed</option>
				<option value="hold">Hold</option>
</select>
</td>
<th>reimbursible
</th>
<td>
<select class="input drop-down large" name="Select1" id="tra7">
				<option value="0">-Select-</option>
				<option value="1">Yes</option>
				<option value="2">No</option>
</select>
</td>
</tr>
<tr>
<th>Description</th>
<td><textarea  class="input huge" name="TextArea" style="width: 475px; height: 75px" id="tra8"></textarea>
</td>
<th>remarks</th>
<td><textarea class="input huge" name="TextArea" style="width: 475px; height: 75px" id="tra9"></textarea>
</td>
</tr>
<tr>
<th>Cost</th>
<td colspan="3"><input name="Text1" type="text" class="input medium" id="tra10"></td>
</tr>

<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('training/save','tra','11','','','couResp','1');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>
</table>
	</div>
</div>


