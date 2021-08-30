<?php
include("../include/conFig.php");
$travelid = $_GET['id'];
?>

<div class="title">Leave Calendar</div>
<div class="strip">
<span>Dashboard</span>
<span>Leave Calendar</span>
<span>Upload Leave Calendar File</span>
</div>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
<a href="leavecalendar/sampleleavecalendar.xls" target="_blank"><div class="button green" style="float:right;margin-right:10px">Download Sample</div></a>&nbsp;&nbsp;

<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"> <i class="back"></i>Back</button>&nbsp;&nbsp;
</td>
</tr>
</table>
<div style="overflow-x:hidden;overflow-y:scroll;height:500px">
<div class="add-new yellow-border">
<div class="form-head yellow">
<div class="head-title"> 
<i class="add-form"></i> 
Upload Leave Calendar File</div>
</div>
<form action="leavecalendar/filesave.php" method="post" target="uploadFrame" enctype="multipart/form-data">

<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>

<!--
<ul class="breadcrumb">
	<li><a href="#">Home</a><span class="divider">&raquo;</span></li>
	<li class="active"  onclick="getModule('leavecaledar/view','viewContent','manipulateContent','Leave Calendar')">Leave Calendar</li>
	<div class="red awesome small" onclick="getModule('leavecalendar/view','viewContent','manipulateContent','Leave Calendar')" style="float:right">Back</div>
	<a href="leavecalendar/sampleleavecalendar.xls" target="_blank"><div class="blue awesome small" style="float:right;margin-right:10px">Download Sample</div></a>

</ul>
<div class="nonboxy-widget">
	<div class="widget-head">
		<h5>Upload Leave Calendar File</h5>
	</div>
</div>
<div class="widget-content">
	<div class="widget-box">
	<form action="leavecalendar/filesave.php" method="post" target="uploadFrame" enctype="multipart/form-data">
	<table width="100%" cellpadding="10" cellspacing="0" class="form-horizontal well formtable">
<tr><td colspan="4" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>-->
<tr>
<th style="height: 46px">Year *</th>
<td style="height: 46px"><select class="input drop-down large" name="req" id="levc0">
				<option  value="">Select Year</option>
				<?php 
				for($j=2013;$j<=2020;$j++)
				{
				echo '<option value="'.$j.'">'.$j.'</option>';
				}
				?>
				
			</select>

</td>
<tr><th>File *</th><td><input name="uploadfile" type="file" ></td></tr>

<tr>
<td colspan="4" style="text-align:center"><input type="submit" name="submit" value="Upload File"  class="button green" >
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>



<tr><td colspan="2" >
<iframe style="height:0px;width:0px;display:none" src="#"  id="uploadFrame" name="uploadFrame" scrolling="no" frameborder="0"></iframe>
</td></tr>
</table>
</form>
	</div>
</div>


