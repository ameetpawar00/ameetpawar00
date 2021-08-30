<?php
include("../../include/conFig.php");
?>


<div class="title">Leave Management</div>
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
</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>
<!--

		<h2 align="left" class="title">Leavepolicy 	</h2>
<div class="widget-content">
	<div class="widget-box" id="addExpp" style="height:500px;overflow-x:hidden;overflow-y:auto" >
	<table width="100%" cellpadding="10" cellspacing="0" class="form-horizontal well formtable">
	<thead>
<tr><td colspan="6" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>-->
<tr><th style="text-align:center;width:20% !important">Designation  </th>
	<td style="text-align:left;width:200px !important">
	<select  class="input drop-down large" id="levpo0" onchange="getModule('management/leavepolicy/designationwise?desig='+this.value,'desigResp','','')" title="isNotNull">
	<option value=""> Select A Designation</option>
	<?php
	$getDesig = mysql_query("select `id`,`name` from `designation` where `delete` = '0' and `id` != '1' order by `name` asc",$con) or die(mysql_error());
	while($rowDesig = mysql_fetch_array($getDesig))
	{
	?>
	<option  value="<?php echo $rowDesig[0]?>"><?php echo $rowDesig[1]?></option>
	<?php
	}
	?>
	</select>
	
	</td>
		
</tr>
<thead id="desigResp" >

</thead>


</table>
</div>
</div>


