<?php
include("../../include/conFig.php");
?>
<div class="title">Location</div>
<div class="strip">
<span>Dashboard</span>
<span>Location</span>
<span>Add New Location</span>
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
Add Location</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>
 

<tr>
<th>Name <span>*</span></th>
<td><input name="req" class="input medium" data-original-title="first tooltip" type="text"  style="width:240px;" id="dept0" >
</td>
</tr>
<tr><th>Description</th>
<td><textarea class="input huge" name="" cols="20" rows="2" class="input" style="width:48%;height:100px;" id="dept1"></textarea>
</td>
</tr>
<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('masters/location/save','dept','2','','','couResp','1');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i>Save Location</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>

</table>
	</div>
</div>


