<?php
include("../include/conFig.php");
?>
<div class="title">Assets</div>
<div class="strip">
<span>Dashboard</span>
<span>Assets</span>
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
Add Asset</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>

<tr>
<td>Name <span>*</span></td><td><select class="input drop-down large" name="" id="asset0">
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
<td>Asset <span>*</span></td><td><select class="input drop-down large" name="" id="asset1">
				<option value="">Select Asset</option>
<?php
$getEmp = mysql_query("SELECT `id`,`name` FROM `typeofasset` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
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
<td>Given Date
</td><td>
	<input name="" id="asset2" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalender('calenderid1','asset2')"/>
				<div id="calenderid1" class="calender">
				</div>
			
</td>
</tr>
<tr>
<td>Return Date
</td><td><input name="" id="asset3" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalender('calenderid2','asset3')"/>
				<div id="calenderid2" class="calender">
				</div>
</td>
</tr>
<tr><td valign="top">Description</td><td><textarea class="input huge" name="" cols="20" rows="2" class="input" style="width:48%;height:100px;" id="asset4"></textarea>
</td>
</tr>
<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('assets/save','asset','6','','','couResp','1');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>

</table>
</div></div>


