<?php
include("../../include/conFig.php");
if($_GET['id'] != "")
{
$id = $_GET['id'];
$i = $_GET['i'];
$getData = mysql_query("select * from `incentiveperformance` where `id` = '$id'",$con)or die(mysql_error());
$rowData = mysql_fetch_array($getData);
$url = "incentive/performance/save?id=$id&i=$i";
	if($rowData['type'] == "1")
	{
		$value= "Flat Amount";
	}
	else
	{
		$value= "In Percent";
	}
}
else
{
$url ="incentive/performance/save";
$value = "Value";
}
?>
		<h2 align="left" class="title">Add New  	
		<input type="button" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" value="Back" style="padding:13px;float:right" class="red awesome small" >
		</h2>
<div class="widget-content">
	<div class="widget-box" id="addExpp" style="height:500px;overflow-x:hidden;overflow-y:auto;color:#000" >
	<table width="100%" cellpadding="10" cellspacing="0" class="form-horizontal well formtable">
	<thead>
<tr><td colspan="6" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>
<tr><th >Designation*</th>
	<td >
	<select class="input" id="incea0"  title="isNotNull" name="req" onchange="incentiveexist('incentive/performance/check.php?id=<?php echo $id?>','couResp','incea0','incea2','incea3','')">
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
		<select class="input" id="incea1"  title="isNotNull" name="req" onchange="incentiveexist('incentive/performance/check.php?id=<?php echo $id?>','couResp','incea0','incea2','incea3','')">
	<option value=""> Select An Action</option>
	<option <?php if($rowData['action'] == '1') {echo "selected=selected" ;} ?> value="1">Add</option>
	<option <?php if($rowData['action'] == '2') {echo "selected=selected" ;} ?> value="2">Deduct</option>
	</select>

		</td>
</tr>
<tr title="Its For Attendence Average like From 50% to 80%">
<th>From *</th>
<td><input type="text" title="isNotNull" value="<?php echo $rowData['from']?>" id="incea2" class="input" onkeypress="return chkDecimal(event,'showError0')" name="req" onblur="incentiveexist('incentive/performance/check.php?id=<?php echo $id?>','couResp','incea0','incea2','incea3','')">
<span id="showError0" class="showError"></span>

</td>
<th>To *</th>
<td><input type="text" title="isNotNull" value="<?php echo $rowData['to']?>" id="incea3" class="input" onkeypress="return chkDecimal(event,'showError1')" name="req" onblur="incentiveexist('incentive/performance/check.php?id=<?php echo $id?>','couResp','incea0','incea2','incea3','')" >
<span id="showError1" class="showError"></span>

</td>
</tr>
<tr >
<th title="If You Select Flat Value Will Be in Amount Like 2000 If You Select Percent Value Will Be in Percent Like 10% , or 20% ">Type *</th>
<td title="If You Select Flat Value Will Be in Amount Like 2000 If You Select Percent Value Will Be in Percent Like 10% , or 20% ">
<select class="input" id="incea4" name="req"  title="If You Select Flat Value Will Be in Amount Like 2000 If You Select Percent Value Will Be in Percent Like 10% , or 20% " onchange="changeIncentive('incea4','typeValue','incentive')">
	<option value=""> Select An Type</option>
	<option <?php if($rowData['type'] == '1') {echo "selected=selected" ;} ?> value="1">Flat</option>
	<option <?php if($rowData['type'] == '2') {echo "selected=selected" ;} ?> value="2">Percent</option>
	</select>

</td>
<th id="typeValue"><?php echo $value?> *</th> 
<td><input type="text" title="isNotNull" value="<?php echo $rowData['value']?>" id="incea5" class="input" onkeypress="return chkDecimal(event,'showError2')" name="req" >
<span id="showError2" class="showError"></span>
</td>
</tr>
<tr >
<th>Performance*</th>
<td><input type="text" title="isNotNull" value="<?php echo $rowData['performance']?>" id="incea6" class="input" name="req" >

</td>
<th>OutOf *</th> 
<td><input type="text" title="isNotNull" value="<?php echo $rowData['outof']?>" id="incea7" class="input" name="req" >
<span id="showError2" class="showError"></span>
</td>
</tr>
<tr><td colspan="4"  style="text-align:center">
<div class="blue awesome small" onclick="SaveData('<?php echo $url?>','incea','8','','','couResp','1')">Save</div>
<div class="btn btn-warning" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')">Cancel</div>
</td></tr>


</thead>


</table>
</div>
</div>


