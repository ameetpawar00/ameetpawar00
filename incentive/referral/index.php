<?php
include("../../include/conFig.php");
if($_GET['id'] != "")
{
$id = $_GET['id'];
$i = $_GET['i'];
$getData = mysql_query("select * from `incentivereferral` where `id` = '$id'",$con)or die(mysql_error());
$rowData = mysql_fetch_array($getData);
$url = "incentive/referral/save?id=$id&i=$i";
	if($rowData['type'] == "1")
	{
		$value= "Flat Amount";
	}
	else
	{
		$value= "In Percent";
	}
$edit = 1;
$what = 2;

}
else
{
$url ="incentive/referral/save";
$value = "Value";
$what = 1;

}
?>

<div class="title">Referral Incentive
</div>

<div class="strip">
<span>Dashboard</span>
<span>Incentive</span>
<span>Referral </span>
<?php if($edit == 1)
{
?>
<span>Edit</span>
<?php
}
else
{
?>
<span>Add New</span>
<?php
}
?>
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
Add Referral </div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>

<!--
		<h2 align="left" class="title">Add New  	
		<input type="button" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" value="Back" style="padding:13px;float:right" class="red awesome small" >
		</h2>
<div class="widget-content">
	<div class="widget-box" id="addExpp" style="height:500px;overflow-x:hidden;overflow-y:auto;color:#000" >
	<table width="100%" cellpadding="10" cellspacing="0" class="form-horizontal well formtable">
	<thead>
<tr><td colspan="6" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>-->
<tr><th >Designation  *</th>
	<td >
	<select class="input drop-down large" id="incea0"  title="isNotNull" name="req" onchange="incentiveexist('incentive/referral/check.php?id=<?php echo $id?>','couResp','incea0','incea2','incea3','')">
	<option value=""> Select A Designation </option>
	<?php
	$getDesig = mysql_query("select `id`,`name` from `designation` where `delete` = '0' and `id` != '1' order by `name` asc",$con) or die(mysql_error());
	while($rowDesig = mysql_fetch_array($getDesig))
	{
	?>
	<option <?php if($rowData['designation'] == $rowDesig[0]) {echo "selected=selected" ;} ?>  value="<?php echo $rowDesig[0]?>"><?php echo $rowDesig[1]?></option>
	<?php
	}
	?>
	</select>
	
	</td>
		<th>Action *</th>
		<td>
		<select class="input drop-down large" id="incea1"  title="isNotNull" name="req" onchange="incentiveexist('incentive/referral/check.php?id=<?php echo $id?>','couResp','incea0','incea2','incea3','')">
	<option value=""> Select An Action</option>
	<option <?php if($rowData['action'] == '1') {echo "selected=selected" ;} ?> value="1">Add</option>
	<option <?php if($rowData['action'] == '2') {echo "selected=selected" ;} ?> value="2">Deduct</option>
	</select>

		</td>
</tr>
<tr title="Its For Attendence Average like From 50% to 80%">
<th>From *</th>
<td><input type="text" title="isNotNull" value="<?php echo $rowData['from']?>" id="incea2" class="input medium" onkeypress="return chkDecimal(event,'showError0')" name="req" onblur="incentiveexist('incentive/referral/check.php?id=<?php echo $id?>','couResp','incea0','incea2','incea3','')">
<span id="showError0" class="showError"></span>

</td>
<th>To *</th>
<td><input type="text" title="isNotNull" value="<?php echo $rowData['to']?>" id="incea3" class="input medium" onkeypress="return chkDecimal(event,'showError1')" name="req" onblur="incentiveexist('incentive/referral/check.php?id=<?php echo $id?>','couResp','incea0','incea2','incea3','')" >
<span id="showError1" class="showError"></span>

</td>
</tr>
<tr >
<th title="If You Select Flat Value Will Be in Amount Like 2000 If You Select Percent Value Will Be in Percent Like 10% , or 20% ">Type *</th>
<td title="If You Select Flat Value Will Be in Amount Like 2000 If You Select Percent Value Will Be in Percent Like 10% , or 20% ">
<select class="input drop-down large" id="incea4" name="req"  title="If You Select Flat Value Will Be in Amount Like 2000 If You Select Percent Value Will Be in Percent Like 10% , or 20% " onchange="changeIncentive('incea4','typeValue','incentive')">
	<option value=""> Select An Type</option>
	<option <?php if($rowData['type'] == '1') {echo "selected=selected" ;} ?> value="1">Flat</option>
	<option <?php if($rowData['type'] == '2') {echo "selected=selected" ;} ?> value="2">Percent</option>
	</select>

</td>
<th id="typeValue"><?php echo $value?> *</th> 
<td><input type="text" title="isNotNull" value="<?php echo $rowData['value']?>" id="incea5" class="input medium" name="req" >
<span id="showError2" class="showError"></span>
</td>
</tr>
<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('<?php echo $url?>','incea','6','<?php echo $i;?>','','couResp','<?php echo $what?>');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i><?php if($edit == 1){ ?> <span> Update </span> <?php } else { ?> <span> Save </span> <?php } ?> </button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>

<!--
<tr><td colspan="4"  style="text-align:center">
<div class="blue awesome small" onclick="SaveData('<?php echo $url?>','incea','6','','','couResp','1')">Save</div>
<div class="btn btn-warning" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')">Cancel</div>
</td></tr>

-->


</table>
</div>
</div>


