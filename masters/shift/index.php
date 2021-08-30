<?php
include("../../include/conFig.php");
?>
 
<div class="title">Shift</div>
<div class="strip">
<span>Dashboard</span>
<span>Shift</span>
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
<div class="form-head blue">
<div class="head-title"> 
<i class="add-form"></i> 
Add Shift</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>

<tr>
<th>Name <span>*</span></th>
<td><input name="req" class="input medium" data-original-title="" type="text"  style="width:240px;" id="shift0"  >
</td>
</tr>
<tr>
<th>Start Time<span>*</span></th>
<td><input name="req" class="input medium" data-original-title="" type="time"  style="width:240px;" id="shift1"  >
</td>
</tr>
<tr>
<th>End Time<span>*</span></th>
<td><input name="req" class="input medium" data-original-title="" type="time"  style="width:240px;" id="shift2"  >
</td>
</tr>
<tr>
<th>First half Day Out Time<span>*</span></th>
<td><input name="req" class="input medium" data-original-title="" type="time"  style="width:240px;" id="shift3"  >
</td>
</tr>
<tr>
<th>Second half Day In Time<span>*</span></th>
<td><input name="req" class="input medium" data-original-title="" type="time"  style="width:240px;" id="shift4"  >
</td>
</tr>
<tr>
<th>Late Coming First Half Count<span>*</span></th>
<td><input name="req" class="input medium" data-original-title="" type="time"  style="width:240px;" id="shift5"  >
</td>
</tr>
<tr>
<th>Late Coming Second Half Count as Full Day<span>*</span></th>
<td><input name="req" class="input medium" data-original-title="" type="time"  style="width:240px;" id="shift6"  >
</td>
</tr>
<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('masters/shift/save','shift','7','','masters/shift/view','couResp','1');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>
</table>
	</div>
</div>


