<?php
include("../include/conFig.php");
$travelid = $_GET['id'];
$sqlLeave = mysql_query("SELECT `prefix`,`id` FROM `leavetype` WHERE `delete` = '0'",$con) or die(mysql_error());

$selectLeaveAll = '<option value="0">Select Leave Type</option>';
while($getLeave = mysql_fetch_array($sqlLeave))
{
	$id = $getLeave['id'];
	$prefix = $getLeave['prefix'];
	$selectLeaveAll .='<option value="'.$prefix.'">'.$prefix.'</option>';
	$selectLeaveAll .='<option value="'.$prefix.'**LWP">'.$prefix.' + LWP</option>';
	//$selectLeaveAll .='<option value="'.$prefix.'**00">'.$prefix.' + Special</option>';
}
$selectLeaveAll .= '<option value="LWP">LWP</option>';
?>
<div class="title">Leave Request</div>
<div class="strip">
<span>Dashboard</span>
<span>Leave Request</span>
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
Add Leave Request</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>


<tr>
<th>From Date <span>*</span></th>
<td>
<input name="" id="levras" type="hidden" value="<?=date("Y-n-j")?>"/>
<input name="" id="levr1" type="test" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalender('calenderidl0','levr1');$('#levr2').val('')"/>
			<div class="calender" id="calenderidl0"></div></td>
</tr>
<tr>
<th>To Date <span>*</span></th>
<td><input name="" id="levr2" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalender('calenderidl1','levr2')" onblur="if($('#levr1').val()==''){alert('Please Select From Date');$('#calenderidl1').hide();$('#levr2').val('');}else{}"/>
			<div class="calender" id="calenderidl1"></div></td>
</tr>
<!--if($('#levras').val()==$('#levr1').val()){alert('alslas')}

if($('#levras').val()>$('#levr1').val()){alert('Please Select Date greater than today');$('#levr1').val(''); $('#calenderidl0').hide(); $('#calenderidl1').hide();}

-->
<tr>
<th>Leave Time<span>*</span></th>
<td>
<select name="Select1" id="levr0" class="input drop-down large" onchange="if($('#levr2').val()==''){alert('Please Select To Date');$('#levr0').val('');}">
				<option value="0">Select leave</option>
				<option value="1">Full Leave</option>
				<option value="2">First Half</option>
				<option value="3">Second Half</option>

			</select>
</td>
</tr>
<tr>
<th>Leave Type<span>*</span></th>
<td>
	<select id="levr4" class="input drop-down large" name="Select2" onchange="checkLeavestatus(this.value,'<?php echo $hrmloggedid;?>')" >
	<?php 
	if($row[6] == 1)
		echo $selectLeave;
	else
		echo $selectLeaveAll;
	?>
	</select>
	<input name="" id="levr5" type="hidden" value=""/>
</td>

</tr>



<tr>
<th>Description
</th>
<td colspan="3">
<select name="TextArea1" class="input drop-down large" name="TextArea"  id="levr3">
	<option>Please Select Description</option>
	<option>Sick</option>
	<option>Marriage</option>
	<option>Personal</option>
	<option>Festival</option>
	<option>Other</option>
</select>
</td>
</tr>

<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('leaverequest/save','levr','6','','','couRespView','1');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>

</table>
	</div>
</div>


