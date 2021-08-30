<?php
include("../include/conFig.php");
$id = $_GET['id'];
$getData = mysql_query("SELECT * FROM `job` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
 
<div class="title">Edit Job-Vacancy</div>
<div class="strip">
<span>Dashboard</span>
<span>Edit Job-Vacancy</span>
<span>Edit </span>
</div>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
<button class="button blue" onclick="getModule('job/jobapplicants/new?jobid=<?php echo $id;?>?','manipulateContent','viewContent','Job')"> <i class="plus"></i>Applicant</button>&nbsp;&nbsp;

<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" > <i class="back"></i>Back</button>&nbsp;&nbsp;
</td>
</tr>
</table>
<div style="overflow-x:hidden;overflow-y:scroll;height:500px">
<div class="add-new blue-border">
<div class="form-head green">
<div class="head-title"> 
<i class="add-form"></i> 
Add Job</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>

 
<!--<ul class="breadcrumb">
	<li><a href="#">Home</a><span class="divider">&raquo;</span></li>
	<li class="active"  onclick="getModule('job/view','viewContent','manipulateContent','Job')">Jobs</li>
	<div class="red awesome small" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" style="float:right">Back To Jobs</div>
	<div class="blue awesome small" onclick="getModule('job/jobapplicants/new?jobid=<?php echo $id;?>?','manipulateContent','viewContent','Job')" style="float:right">+1 Applicant</div>&nbsp;&nbsp;

</ul>
<div class="nonboxy-widget">
	<div class="widget-head">
		<h5>Edit Job
		
		</h5>	
	
	</div>
</div>
<div class="widget-content">
	<div class="widget-box">
<table width="100%" cellpadding="10" cellspacing="0" class="form-horizontal well formtable">-->

<tr>
	<th style="display:none">Name <span>*</span>
	</th>
	<td style="display:none"><input class="input medium" name="" type="text" id="job0" value="<?php echo $row['name']?>" />
	</td>
	<th >Post <span>*</span>
	</th>
	<td><select class="input drop-down large" name="req" id="job1">
				<option value="">Select Designation</option>
<?php
$getDesig = mysql_query("SELECT `id`,`name` FROM `designation` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowDesig = mysql_fetch_array($getDesig))
{
?>				
				<option <?php if($rowDesig[0] == $row['post']) echo "selected='selected'"; ?> value="<?php echo $rowDesig[0]?>"><?php echo $rowDesig[1]?></option>
<?php
}
?>				
			</select>

	</td>
</tr>
<tr>
	<th>Vacancy <span>*</span>
	</th>
	<td><input class="input medium" name="reqisnum" type="text" id="job2" value="<?php echo $row['vacancy']?>"/>
	</td>
	<th>Last Date <span>*</span>
	</th>
	<td><input name="req" type="text" id="job3" value="<?php echo $row['lastdate']?>" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalendar(this);"/>
	</td>
	
</tr>
<tr>
	<th>Eligibility<span>*</span>
	</th>
	<td><textarea name="req"class="input huge" name="TextArea" style="width: 475px; height: 75px" id="job4" ><?php echo $row['eligibility']?></textarea>
	</td>
	<th>Description  <span>*</span>
	</th>
	<td><textarea name="req"class="input huge" name="TextArea" style="width: 475px; height: 75px" id="job5"><?php echo $row['description']?></textarea>	</td>
</tr>
<tr>
	<th>Status <span>*</span></th>
	<td colspan="3"><input name="req" id="job6" type="checkbox" value="1" <?php if($row['status'] == 1) {echo 'checked="checked"' ;}?> />&nbsp;&nbsp;&nbsp;Active</td>
</tr>

<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('job/update?id=<?php echo $row[0]?>&i=<?php echo $i?>','job','7','','','couResp','2');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i>Update Job</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>

<!--
<tr><td colspan="4" style="text-align:center;"><div style="display:inline-block;" id="couResp"></div></td></tr>
<tr><td></td><td  style="text-align:left"><div class="blue awesome small" onclick="SaveData('job/update?id=<?php echo $row[0]?>&i=<?php echo $i?>','job','7','','','couResp','2')">Update Job</div>
<div class="btn btn-warning" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')">Cancel</div>
</td></tr>-->
</table>
<br/><br/><br/><br/><br/><br/>
	</div>
</div>
<iframe src="#" name="myUploadFrame" style="height:0;width:0;display:none" id="myUploadFrame" scrolling="0" frameborder="0"></iframe>


