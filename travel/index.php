<?php
include("../include/conFig.php");
?>
<div class="title">Travel</div>
<div class="strip">
<span>Dashboard</span>
<span>Travel</span>
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
Travel Initiate</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>

<tr>
<th>Owner <span>*</span></th>
<td><select class="input drop-down large" name="req" id="trav0">
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
<th>Department <span>*</span></th>
<td><select class="input drop-down large" name="req" id="trav1" onchange="changeDrp('trav1','emp','employee','department')">
				<option value="">Select Department</option>
<?php
$getDept = mysql_query("SELECT `id`,`name` FROM `department` WHERE `delete`= '0' AND `id` !='1'",$con) or die(mysql_error());
while($rowDept = mysql_fetch_array($getDept))
{
?>				
				<option value="<?php echo $rowDept[0]?>"><?php echo $rowDept[1]?></option>
<?php
}
?>				
			</select>
</td>
</tr>
<tr>
<th>Employees</th>
<td id="teamUsers">
<select class="input drop-down large" name="Select1" class="input" id="emp" onchange="addToteam(this.value,'trav9','empl','addemp','reemp')">
	<option value="1">Select Department First </option>			
			</select>
			<span id="reemp"></span>
			<div style="padding:5px;" id="empl">
						</div>
			<input class="input medium" name="req" type="text" value="" id="trav9" title="isNotNull" style="display:none" />


</td>
</tr>
<tr>
<th>Place Of Visit <span>*</span></th>
<td><input class="input medium" name="req" type="text" id="trav2"/></td>
<th>Purpose Of Visit</th>
<td><input class="input medium" name="" type="text" id="trav3"/></td>

</tr>
<tr>
<th>Departure Date <span>*</span>
</th>
<td>
<input name="req" id="trav4" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalender('calenderid0','trav4')"/>

				<div id="calenderid0" class="calender">
				</div>
</td>
<th>Arrival Date
</th>
<td><input name="req" id="trav5" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalender('calenderid1','trav5')"/>

				<div id="calenderid1" class="calender">
				</div>
</td>
</tr>
<tr>
<th>Number of days</th>
<td><input class="input medium" name="Text1" type="text" id="trav6"/></td>
<th>Customer's Name</th>
<td><input class="input medium" name="Text1" type="text" id="trav7"/></td>
</tr>

<tr>
<th>Is Billable to Customer?
</th>
<td>
<select class="input drop-down large" name="Select1" id="trav8">
				<option value="0">-Select-</option>
				<option value="1">Yes</option>
				<option value="2">No</option>
</select>
</td>
</tr>

<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('travel/save','trav','10','','','couResp','1');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>
</table>
	</div>
</div>


