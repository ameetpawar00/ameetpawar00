<?php
include("../../include/conFig.php");
$jobid = $_GET['jobid'];
$getPost = mysql_query("SELECT designation.name FROM designation,job WHERE job.post = designation.id AND job.id = '$jobid'",$con) or die(mysql_error());
$rowPost = mysql_fetch_array($getPost);
?>

<div class="title">Job Applicants</div>
<div class="strip">
<span>Dashboard</span>
<span>Jobs</span>
<span>Job Applicants</span>
<span>Add New</span>
</div>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
<button class="button gray" onclick="ToggleBox('manipulatemoodleContent','none','');ToggleBox('viewmoodleContent','block','')"> <i class="back"></i>Back</button>&nbsp;&nbsp;
</td>
</tr>
</table>
<div style="overflow-x:hidden;overflow-y:scroll;height:500px">
<div class="add-new blue-border">
<div class="form-head green">
<div class="head-title"> 
<i class="add-form"></i> 
Add Applicants</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>

<!--
<ul class="breadcrumb">
	<li><a href="#">Home</a><span class="divider">&raquo;</span></li>
	<li class="active"  onclick="getModule('job/view','viewContent','manipulateContent','Job Applicant')">Job Applicant</li>
	<div class="red awesome small" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" style="float:right">Back To View</div>

</ul>
<div class="nonboxy-widget">
	<div class="widget-head">
		<h5>Job Applicant For Post <?php echo $rowPost[0]?></h5>
	</div>
</div>
<div class="widget-content">
	<div class="widget-box">
	<table width="100%" cellpadding="10" cellspacing="0" class="form-horizontal well formtable">
<tr><td colspan="4" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>
-->
<tr>
<th>For Post</th>
<td><b><?php echo $rowPost[0]?></b>
</td>
<th>Name <span>*</span></th>
<td><input class="input medium" name="req" type="text" id="app0"></td>
</tr>
<tr>
<th>Contact <span>*</span></th>
<td><input class="input medium" name="reqisnum" type="text" id="app1"/></td>
<th>Email <span>*</span></th>
<td><input class="input medium" name="req" type="text" id="app2"/></td>
</tr>
<tr>
<th>Qualification <span>*</span></th>
<td><input class="input medium" name="req" type="text" id="app3"/></td>
<th>Experience <span>*</span></th>
<td><select class="input drop-down large" id="app4">
    <option value="">select experience</option>
    <option value="Fresher">Fresher</option>
    <option value="less then a year">less then a year</option>
    <option value="1 to 2 year">1 to 2 year</option>
    <option value="2 to 3 year">2 to 3 year</option>
    <option value="3 to 4 year">3 to 4 year</option>
    <option value="4 to 5 year">4 to 5 year</option>
    <option value="above 5 year">above 5 year</option>
    </select>
</tr>
<tr>
<th valign="top">Description </th>
<td><textarea class="input huge" name="TextArea1" style="width: 300px; height: 75px;" id="app5"></textarea></td>
<th valign="top">Upload Resume <span>*</span></th>
<td>						
	<iframe src="job/resume/index.php?respid=app6" scrolling="no" height="100px" frameborder="0"></iframe>
	<input id="app6" type="hidden"/>
</td>
</tr>
<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('job/jobapplicants/save?jobid=<?php echo $jobid;?>','app','7','','','couResp','1');"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>
<!--<tr><td></td><td  style="text-align:left"><div class="blue awesome small" onclick="SaveData('job/jobapplicants/save?jobid=<?php echo $jobid;?>','app','7','','','couResp','1')">Save</div>
<div class="btn btn-warning" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')">Cancel</div>
</td></tr>-->
</table>
	</div>
</div>


