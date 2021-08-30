<?php
include("../../include/conFig.php");
$id = $_GET['id'];
$i = $_GET['i'];
$desig = $_GET['desig'];
$getData = mysql_query("SELECT * from `jobapplicants` where `delete` = '0' AND `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
<br/>

<div class="title">Details</div>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
<button class="button gray" onclick="ToggleBox('viewmoodleContent','block','');ToggleBox('manipulatemoodleContent','none','')"> <i class="back"></i>Back</button>&nbsp;&nbsp;
</td>
</tr>
</table>
<div style="overflow-x:hidden;overflow-y:scroll;height:500px">
<div class="add-new green-border">
<div class="form-head green">
<div class="head-title"> 
<i class="add-form"></i> 
Add Job</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>

<!--
<div class="nonboxy-widget">
<div class="widget-head">
<h5 align="left">Details
		<span style="float:right">
		<div class="red awesome small" onclick="ToggleBox('manipulatemoodleContent','none','');ToggleBox('viewmoodleContent','block','')" style="float:right">Back To Employee</div>
		<div class="blue awesome small" style="float:right;margin-right:10px" onclick="getModule('employee/index?jobappid=<?php echo $id?>','manipulateContent','viewContent','Employee');document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';ToggleBox('bigMoodle','none','')">Convert To Employee</div>
	</span>
</h5>
</div>
</div>
<div class="widget-content">
	<div class="widget-box">

	<table width="100%" cellpadding="10" cellspacing="0" class="form-horizontal well formtable">-->
	<tr>
		<th>For Post</th>
		<td align="left"><?php echo $desig;?></td>
		<th>Name</th>
		<td align="left"><?php echo $row['name'];?></td>
	</tr>
	<tr>
		<th>Contact</th>
		<td align="left"><?php echo $row['contact'];?></td>
		<th>Email</th>
		<td align="left"><?php echo $row['email'];?></td>
	</tr>
	<tr>
		<th>Qualification</th>
		<td align="left"><?php echo $row['qualification'];?></td>
		<th>Experience</th>
		<td align="left"><?php echo $row['experience'];?></td>
	</tr>
	<tr>
		<th>Source</th>
		<td align="left"><?php echo $row['source'];?></td>
		<th>Download resume</th>
		<td align="left"><a href="<?php echo $row['resumefile'];?>" target="_blank">Click to download</a></td>
	</tr>
	<tr>
		<th>Description</th>
		<td><?php echo $row['description']?></td>
	</tr>
	</table>
</div>
</div>