<?php
include("../include/conFig.php");
$id = $_GET['id'];
$i = $_GET['i'];
//echo "SELECT * FROM `leaverequest` WHERE `id` = '$id'";
$getData = mysql_query("SELECT * FROM `leaverequest` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
$status = $row['status'];

$sqlLeave = mysql_query("SELECT `prefix`,`id` FROM `leavetype` WHERE `delete` = '0'",$con) or die(mysql_error());


?>

<div class="title">Leave Request</div>
<div class="strip">
<span>Dashboard</span>
<span>Leave Request</span>
<span>Edit</span>
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
Edit Leave Request</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>

<!--
<ul class="breadcrumb">
	<li><a href="#">Home</a><span class="divider">&raquo;</span></li>
	<li class="active"  onclick="getModule('leaverequest/view','viewContent','manipulateContent','Leave Request')">Leave Request</li>
	<div class="red awesome small" onclick="getModule('leaverequest/view','viewContent','manipulateContent','Leave Request')" style="float:right">Back </div>
</ul>
<div class="nonboxy-widget">
	<div class="widget-head">
		<h5>New Leave Request</h5>
	</div>
</div>
<div class="widget-content">
	<div class="widget-box">
	<table width="100%" cellpadding="10" cellspacing="0" class="form-horizontal well formtable">
<tr><td colspan="4" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>-->
<tr>
<th>Leave Type<span>*</span></th>
<td>
<select name="Selectas" id="levr4" class="input">
				
<?php

$selectLeaveAll = '<option value="0">Select Leave Type</option>';
while($getLeave = mysql_fetch_array($sqlLeave))
{
	$id = $getLeave['id'];
	$prefix = $getLeave['prefix'];
	$prefix2 = $getLeave['prefix']."**0";
	$sel1="";
	$sel2="";
	
	if($row['leavetype'] == $prefix)
	{
		$sel1="selected='selected'";
	}
	if($row['leavetype'] == $prefix2)
	{
		$sel2="selected='selected'";
	}
	if($row['leavetype'] == "LWP")
	{
		$sel3="selected='selected'";
	}

	$selectLeaveAll .='<option value="'.$prefix.'" '.$sel1.' >'.$prefix.'</option>';
	$selectLeaveAll .='<option value="'.$prefix2.'"  '.$sel2.'>'.$prefix.' + LWP</option>';
	
}

$selectLeaveAll .= '<option value="LWP" '.$sel3.'>LWP</option>';
echo $selectLeaveAll;
?>
			</select>
</td>
</tr>
<tr>
<th>Leave Time<span>*</span></th>
<td>
<select name="Select1" id="levr0" class="input">
	<option <?php if($row['leavetime'] == '0'){ echo "selected='selected'"; }?> value="0">Select leave</option>
	<option <?php if($row['leavetime'] == '1'){ echo "selected='selected'"; }?> value="1">Full Leave</option>
	<option <?php if($row['leavetime'] == '2'){ echo "selected='selected'"; }?> value="2">First Half</option>
	<option <?php if($row['leavetime'] == '3'){ echo "selected='selected'"; }?> value="3">Second Half</option>

			</select>
</td>
</tr>

<tr>
<th>From Date <span>*</span></th>
<td><input name="" id="levr1" type="" readonly="readonly" class="inputCalendar" value="<?php echo $row['fromdate']?>" style="width:200px" onclick="openCalender('calenderidl0','levr1')"/>
			<div class="calender" id="calenderidl0"></div></td>
</tr>
<tr>
<th>To Date <span>*</span></th>
<td><input name="" id="levr2" type="" readonly="readonly" class="inputCalendar" value="<?php echo $row['todate']?>" style="width:200px" onclick="openCalender('calenderidl1','levr2')"/>
			<div class="calender" id="calenderidl1"></div></td>
</tr>

<tr>
<th>Description
</th>
<td colspan="3">
<textarea name="TextArea1" class="input huge" name="TextArea" style="width: 475px; height: 75px" id="levr3"><?php echo $row['description']?></textarea>
</td>
</tr>
<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('leaverequest/update?id=<?php echo $row[0]?>&i=<?php echo $i?>&status=<?php echo $status?>','levr','5','<?php echo $i?>','','couResp','2');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>

</table>
	</div>
</div>


