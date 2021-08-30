<?php
include("../include/conFig.php");
$id = $_GET['id'];
$getData = mysql_query("SELECT * FROM `seperation` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
$eid = $row['eid'];
?>

<div class="title">Exit Details</div>
<div class="strip">
<span>Dashboard</span>
<span>Exit Details</span>
<span>Edit Exit Details</span>
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
Seperation</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>
<!--
<ul class="breadcrumb">
	<li><a href="#">Home</a><span class="divider">&raquo;</span></li>
	<li class="active"  onclick="getModule('exitdetails/view','viewContent','manipulateContent','Exit Details')">Exit Details</li>
	<div class="red awesome small" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" style="float:right">Back To Exit Details</div>

</ul>
<div class="nonboxy-widget">
	<div class="widget-head">
		<h5>Edit Exit Details</h5>
	</div>
</div>
<div class="widget-content">
	<div class="widget-box">

	<table width="100%" cellpadding="10" cellspacing="0" class="form-horizontal well formtable">

<tr><td colspan="4" style="color:#000;border-bottom:2px #bbbbbb solid;">Seperation</td>

</tr>-->
<tr>
	<th width="175px">Employee Name <span>*</span>
	</th>
	<td><select class="input drop-down large" name="req" id="exit0" onchange="getModule('exitdetails/getAsset?eid='+this.value,'assetList','','')">
				<option value="">Select Employee</option>
<?php
$getEmp = mysql_query("SELECT `id`,`name` FROM `employee` WHERE `delete`= '0'",$con) or die(mysql_error());
while($rowEmp = mysql_fetch_array($getEmp))
{
?>				
				<option <?php if($row['eid'] == $rowEmp[0]) echo 'selected=selected'?> value="<?php echo $rowEmp[0]?>"><?php echo $rowEmp[1]?></option>
<?php
}
?>				
			</select>
	</td>
	<th width="175px">Seperation Date <span>*</span>
	</th>
	<td><input value="<?php echo $row['seperationdate']?>" name="req" id="exit1" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalendar(this);"/>
	</td>
</tr>
<tr>
	<th>Report To <span>*</span>
	</th>
	<td><select class="input drop-down large" name="req" id="exit2">
				<option value="">Select Employee</option>
<?php
$getEmp = mysql_query("SELECT `id`,`name` FROM `employee` WHERE `delete`= '0'",$con) or die(mysql_error());
while($rowEmp = mysql_fetch_array($getEmp))
{
?>				
				<option <?php if($row['reportto'] == $rowEmp[0]) echo 'selected=selected'?> value="<?php echo $rowEmp[0]?>"><?php echo $rowEmp[1]?></option>
<?php
}
?>				
			</select>

	</td>
	<th>Reason For Leaving <span>*</span>
	</th>
	<td><select class="input drop-down large" name="req" id="exit3">
				<option value="">Select Reason</option>
<?php
$getEmp = mysql_query("SELECT `id`,`name` FROM `reasonforleaving` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowEmp = mysql_fetch_array($getEmp))
{

?>				
				<option <?php if($row['reason'] == $rowEmp[0]) echo 'selected=selected'?> value="<?php echo $rowEmp[0]?>"><?php echo $rowEmp[1]?></option>
<?php
}
?>				
			</select>

	</td>
</tr>
</table>
<br/>
<?php
$getCount = mysql_query("SELECT `id` FROM `asset` WHERE `eid` = '$eid'",$con) or die(mysql_error());
$getDatas = mysql_query("SELECT typeofasset.name,asset.givendate,asset.returndate,asset.returned,asset.id FROM asset,typeofasset WHERE asset.typeofasset = typeofasset.id AND asset.eid ='$eid'",$con) or die(mysql_error());
if(mysql_num_rows($getCount) > 0)
{
?>
</div>
<br/>
<div style="overflow-x:hidden;overflow-y:scroll;height:500px">
<div class="add-new blue-border">
<div class="form-head blue">
<div class="head-title"> 
<i class="add-form"></i> 
Assets Alloted</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>


<!--<table width="100%" cellpadding="10" cellspacing="0" class="form-horizontal well formtable">
<tr><td colspan="4" style="color:#000;border-bottom:2px #bbbbbb solid;">Assets Alloted</td>
</tr>-->
<?php
while($rows = mysql_fetch_array($getDatas))
{
?>
<tr>
	<th style="width:175px; height: 39px;">Type Of Asset</th>
	<td  style="width:300px; height: 39px;"><?php echo $rows[0]?></td>
	<th style="width:175px; height: 39px;">Given Date</th>
	<td style="height: 39px"><?php echo $rows[1]?></td>
</tr>
<tr>
	<th style="width:175px">Return Date</th>
	<td><?php echo $rows[2]?></td>
	<th style="width:175px">Status</th>
	<td>
	<div id="ase<?php echo $rows[4]?>" <?php if($rows[3] == '1') {echo 'class = "green"';} else {echo 'class ="maroon"';}?> onclick="changeStatus('returned','asset','<?php echo $rows[4]?>','ase')"  ><?php if($rows[3] == '1') {echo 'Returned';} else {echo 'Not Returned';}?></div>
	</td>
</tr>
<?php
}
?>
</table>
<?php
}
?>

<br/>
<table style="width:100%">
<tr><td colspan="4" style="text-align:center;">
<div style="display:inline-block;" id="couResp"></div></td></tr>

<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('exitdetails/update?id=<?php echo $row[0]?>&i=<?php echo $i?>','exit','4','','','couResp','2');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i>Update Details</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>
<!--

<tr><td colspan="4" align="center"><div class="blue awesome small" onclick="SaveData('exitdetails/update?id=<?php echo $row[0]?>&i=<?php echo $i?>','exit','4','','','couResp','2')">Update Details</div>
<div class="btn btn-warning" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')">Cancel</div>
</td></tr>
-->
</table>
<br/>
<br/><br/><br/><br/><br/><br/>
	</div>
</div>


