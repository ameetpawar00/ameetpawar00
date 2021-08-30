<?php
include("../include/conFig.php");
$id = $_GET['id'];
$i = $_GET['i'];
$getData = mysql_query("select  * FROM training WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>

<div class="title">Training</div>
<div class="strip">
<span>Dashboard</span>
<span>Training</span>
<span>Edit Training</span>
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
Edit Training</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>

<tr>
<th>Training Title <span>*</span></th>
<td><input name="req" type="text" class="input medium" id="tra0" value="<?php echo $row['title']?>"/></td>
<th>Owner <span>*</span></th>
<td><select class="input drop-down large"  name="req" id="tra1">
				<option value="">select  Employee</option>
<?php
$getEmp = mysql_query("select  `id`,`name` FROM `employee` WHERE `delete`= '0'",$con) or die(mysql_error());
while($rowEmp = mysql_fetch_array($getEmp))
{
?>				
<option <?php if($row['owner'] == $rowEmp[0]){ echo 'selected=selected';}?> value="<?php echo $rowEmp[0]?>"><?php echo $rowEmp[1]?></option>
				<!--<option <?php if($row['owner'] == $rowEmp[0]){ echo 'select ed=select ed';}?> value="<?php echo $rowEmp[0]?>"><?php echo $rowEmp[1]?></option>-->
<?php
}
?>				
			</select >
</td>
</tr>
<tr>
<th>Number Of Days <span>*</span></th>
<td><input name="req" type="text" class="input medium" id="tra2" value="<?php echo $row['noofdays']?>"></td>
<th>Venue</th>
<td><input name="" type="text" class="input medium" id="tra3" value="<?php echo $row['venue']?>"></td>

</tr>
<tr>
<th>Start Date
</th>
<td><input name="req" value="<?php echo $row['startdate']?>" id="tra4" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalendar(this);"/>
</td>
<th>End Date
</th>
<td><input name="req" value="<?php echo $row['enddate']?>" id="tra5" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalendar(this);"/>
</td>
</tr>
<tr>
<th>Status
</th>
<td>
<select class="input drop-down large"  name="select 1" id="tra6">
				<option value="NA">-select -</option>
				<option <?php if($row['status'] == 'completed'){ echo 'select ed=select ed';}?> value="completed">Completed</option>
				<option <?php if($row['status'] == 'notcompleted'){ echo 'select ed=select ed';}?> value="notcompleted">Not Completed</option>
				<option <?php if($row['status'] == 'hold'){ echo 'select ed=select ed';}?> value="hold">Hold</option>
</select >
</td>
<th>reimbursible
</th>
<td>
<select class="input drop-down large"  name="select 1" id="tra7">
				<option value="0">-select -</option>
				<option <?php if($row['reimbursible'] == '1'){ echo 'select ed=select ed';}?> value="1">Yes</option>
				<option <?php if($row['reimbursible'] == '2'){ echo 'select ed=select ed';}?> value="2">No</option>
</select >
</td>
</tr>
<tr>
<th>Description</th>
<td><textarea class="input huge" name="TextArea" style="width: 475px; height: 75px" id="tra8"><?php echo $row['description']?></textarea>
</td>
<th>remarks</th>
<td><textarea class="input huge" name="TextArea" style="width: 475px; height: 75px" id="tra9"><?php echo $row['remarks']?></textarea>
</td>
</tr>
<tr>
<th>Cost</th>
<td colspan="3"><input name="Text1" type="text" class="input medium" id="tra10" value="<?php echo $row['cost']?>"/></td>
</tr>

<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('training/update?id=<?php echo $row[0]?>&i=<?php echo $i?>','tra','11','<?php echo $i;?>','','couResp','2');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i>Update</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>
</table>
	</div>
</div>


