<?php
include("../include/conFig.php");
$id = $_GET['id'];
$i = $_GET['i'];

//echo "SELECT * FROM `location` WHERE `id` = '$id'";
$getData = mysql_query("SELECT * FROM `leavecalendar` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
<div class="title">Special Day Calendar</div>
<div class="strip">
<span>Dashboard</span>
<span>Special Day Calendar</span>
<span>Edit Special Day Calenda</span>
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
Edit Special Day Calendar</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>
 
<tr>
<th>Special Day Type <span>*</span></th>
<td>
<select name="" id="cal0" class="input" readonly>
				<option value="1">Market Off</option>
			</select>
</td>
</tr>
<tr><th>Special Day</th>
<td><input name="req" class="input medium" data-original-title="first tooltip" type="text" value="<?php echo $row["event"]?>" style="width:240px;" id="cal1">
</td>
</tr>
<tr><th>In Time</th>
<td><input name="req" class="input medium" data-original-title="first tooltip" type="text" value="<?php echo $row["inTime"]?>" style="width:240px;" id="cal2">
</td>
</tr>
<tr><th>Date</th>
<td><input name="req" class="input medium" data-original-title="first tooltip" class="inputCalendar" onclick="openCalender('calenderid0','cal3')" value="<?php echo $row["date"]?>" style="width:240px;" id="cal3">
<div class="calender" id="calenderid0"></div>
</td>
</tr>
<tr>
<td colspan="4" style="text-align:center">

<button class="button green" onclick="SaveData('calender/update?id=<?php echo $id;?>&i=<?php echo $i;?>','cal','4','<?php echo $i;?>','','couResp','2');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i>Update</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>

</table>
	</div>
</div>


