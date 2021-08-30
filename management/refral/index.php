<?php
include("../include/conFig.php");
?>

<div class="title">All Jobs</div>
<div class="strip">
<span>Dashboard</span>
<span>All Jobs</span>
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
<div class="add-new blue-border">
<div class="form-head green">
<div class="head-title"> 
<i class="add-form"></i> 
Add Job</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>
<!--
 
<ul class="breadcrumb">
	<li><a href="#">Home</a><span class="divider">&raquo;</span></li>
	<li class="active"  onclick="getModule('job/view','viewContent','manipulateContent','Job')">All Jobs</li>
	<div class="red awesome small" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" style="float:right">Back To Jobs</div>

</ul>
<div class="nonboxy-widget">
	<div class="widget-head">
		<h5>Add New Job</h5>
	</div>
</div>
<div class="widget-content">
	<div class="widget-box">

	<table width="100%" cellpadding="10" cellspacing="0" class="form-horizontal well formtable">
-->
<tr>
	
	<th width="175px">Designation<span>*</span>
	</th>
	<td><select class="input drop-down large" name="req" id="job0">
				<option value="">Select Designation</option>
<?php
$getDesig = mysql_query("SELECT `id`,`name` FROM `designation` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowDesig = mysql_fetch_array($getDesig))
{
?>
<option value="<?php echo $rowDesig[1]?>"><?php echo $rowDesig[1]?></option>
<?php
}
?>				
			</select>
	</td>
	
	<th width="175px">Qualification <span>*</span>
	</th>
	<td >
	<select class="input drop-down large" name="req" id="job1">
				<option value="">Select Qualification</option>
<?php
$getDesig = mysql_query("SELECT `id`,`name` FROM `education` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowDesig = mysql_fetch_array($getDesig))
{
?>
<option value="<?php echo $rowDesig[1]?>"><?php echo $rowDesig[1]?></option>
<?php
}
?>				
			</select>

	</td>
</tr>
<tr>	
	<th>Vacancy <span>*</span>
	</th>
	<td><input class="input medium" name="req" type="text" id="job2"/>
	</td>
	<th>Salary Range<span>*</span>
	</th>
	<td><input class="input medium" name="req" type="text" id="job3"/>
	</td>
	
</tr>
<tr>	
	<th>Last Date <span>*</span>
	</th>
	<td>
	<input class="input medium" name="" id="job4" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalender('calenderid1','job4')"/>
				<div class="calender" id="calenderid1"></div>


	</td>
	<th>Experience<span>*</span>
	</th>
	<td>
	<select class="input drop-down large" name="req" id="job5">
				<option value="">select experience</option>
    <option value="Fresher">Fresher</option>
    <option value="less then a year">less then a year</option>
    <option value="1 to 2 year">1 to 2 year</option>
    <option value="2 to 3 year">2 to 3 year</option>
    <option value="3 to 4 year">3 to 4 year</option>
    <option value="4 to 5 year">4 to 5 year</option>
    <option value="above 5 year">above 5 year</option>

     </select>

	</td>
	
</tr>

<tr>
	<th>Eligibility<span>*</span>
	</th>
	<td><textarea name="req" class="input huge" name="TextArea" style="width: 475px; height: 75px"id="job6"></textarea>
	</td>
	<th>Remarks  <span>*</span>
	</th>
	<td><textarea name="req" class="input huge" name="TextArea" style="width: 475px; height: 75px" id="job7"></textarea>	</td>
</tr>
<tr>
	<th>Status <span>*</span></th>
	<td colspan="3"><input name="req" id="job8" type="checkbox" value="1" checked="checked"/>&nbsp;&nbsp;&nbsp;Active</td>
</tr>

<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('job-vacancy/save','job','9','','','couResp','1');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" style="height: 26px"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>

<!--
<tr><td colspan="4" style="text-align:center;"><div style="display:inline-block;" id="couResp"></div></td></tr>
<tr><td></td><td  style="text-align:left"><div class="blue awesome small" onclick="SaveData('job/save','job','7','','','couResp','1')">Save Job</div>
<div class="btn btn-warning" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')">Cancel</div>
</td></tr>
-->
</table>
<br/><br/><br/><br/>
	</div>
</div>


