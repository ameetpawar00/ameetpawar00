<?php
include("../include/conFig.php");
$id = $_GET['id'];
$i = $_GET['i'];
$travelid = $_GET['id'];
$getData = mysql_query("SELECT * FROM `leavecalendar` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
<div class="title">Leave Calendar</div>
<div class="strip">
<span>Dashboard</span>
<span>Leave Calendar</span>
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
Edit Leave In Calendar</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>
<tr>
<th>Year *</th>
<td><select class="input drop-down large" name="req" id="levc0" title="isNotNull">
				<option value="">Select Year</option>
				<?php 
				for($j=2013;$j<=2020;$j++)
				{
				?>
				<option value="<?php echo $j?>" <?php if($j == $row['year']){ echo "selected=selected" ;}?>><?php echo $j?></option>';
				<?php
				}
				?>
				
			</select>

</td>
</tr>

<tr>
<th>Event *</th>
<td><input  class="input medium" name="req" type="text" id="levc1" title="isNotNull" value="<?php echo $row['event']?>"/></td>
</tr>
<tr>
<th style="height: 42px">Date <span>*</span></th>
<td style="height: 42px"><input title="isNotNull" name="" id="levc2"  value="<?php echo $row['date']?>" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalendar(this);"/></td>
</tr>
<tr>
<th>Description
</th>
<td colspan="3">
<textarea id="levc3" class="input huge" name="TextArea" style="width: 475px; height: 75px">
<?php echo $row['description']?>
</textarea>
</td>
</tr>

<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('leavecalendar/update?id=<?php echo $row['id']?>&i=<?php echo $i?>','levc','4','<?php echo $i?>','','couResp','2');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i>Update</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>

</table>
	</div>
</div>


