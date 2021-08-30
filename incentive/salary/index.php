<?php
include("../../include/conFig.php");
if($_GET['id'] != "")
{
$id = $_GET['id'];
$i = $_GET['i'];
$getData = mysql_query("select * from `incentivesalary` where `id` = '$id'",$con)or die(mysql_error());
$rowData = mysql_fetch_array($getData);
$url = "incentive/salary/save?id=$id&i=$i";
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
$url ="incentive/salary/save";
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
<tr>
<th>Employee Name</th>
<td>
<select class="input" id="incea2"  title="isNotNull" name="req" onchange="getsalary(this.value)">
	<option value=""> Select A Employee </option>
	<?php
	$getEmp = mysql_query("select `id`,`name`,`referredby` from `employee` where `delete` = '0' and `id` != '1' order by `name` asc",$con) or die(mysql_error());
	while($rowEmp= mysql_fetch_array($getEmp))
	{
	?>
	<option <?php if($rowData['designation'] == $rowEmp[0]) {echo "selected=selected" ;} ?>  value="<?php echo $rowEmp[0]?>"><?php echo $rowEmp[1]?></option>
	<?php
	}
	?>
	</select>
</td>
<th>Incentive</th><td><div id="incen" style="font-size:15px"></div></td>
</tr>
<tr><th >Gross salary *</th>
	<td >
		<input type="text" title="isNotNull" value="<?php echo $rowData['gross']?>" id="incea0" class="input" name="req0" readonly="readonly" >	</td>
		<th>Bonus *</th>
		<td>
	<input type="text" title="isNotNull" value="<?php echo $rowData['bonus']?>" id="incea1" class="input" name="req0" >

		</td>
</tr>


<tr><td colspan="4"  style="text-align:center">
<div class="blue awesome small" onclick="SaveData('<?php echo $url?>','incea','3','','','couResp','1')">Save</div>
<div class="btn btn-warning" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')">Cancel</div>
</td></tr>


</thead>


</table>
</div>
</div>


