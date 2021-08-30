<?php 
include("../../include/conFig.php");
?>
<script src="../../scripts/txtfield.js"></script>
<?php 
$jobid = $_GET['jobid'];

//$getPost = mysql_query("SELECT designation.name FROM designation,job WHERE job.post = designation.id AND job.id = '$jobid'",$con) or die(mysql_error());

$select=mysql_query("SELECT `jobvacancy`.`id`, `jobvacancy`.`designation`, `jobvacancy`.`vacancy`, `jobvacancy`.`salary`, `jobvacancy`.`qualification`, `jobvacancy`.`experience`, `jobvacancy`.`eligiblity`, `jobvacancy`.`lastdate`, `jobvacancy`.`remark`, `jobvacancy`.`createdate`, `jobvacancy`.`updatedby`, `jobvacancy`.`delete`, `jobvacancy`.`status`, `designation`.`name` FROM `jobvacancy`,`designation` WHERE `jobvacancy`.`id` = '$jobid' AND `jobvacancy`.`designation`=`designation`.`id`");
while($row=mysql_fetch_array($select)){
	//print_r($row);
$desi = $row['name'];
}
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
<button class="button gray" onclick="getModule('job-vacancy/jobapplicants/view?id=<?php echo $jobid?>&i=<?php echo $i?>','manipulateContent','viewContent','Job-Applicant')"> <i class="back"></i>Back</button>&nbsp;&nbsp;
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
<tr><td colspan="2" style="text-align:center; height: 19px;"><div style="display:inline-block;" id="couResp"></div></td></tr>


<tr>
<th style="height: 22px">Job Title</th>
<td style="height: 22px"><strong><input type="text" id="app0" value="<?php echo $desi;?>" style="display:none;"><?php echo $desi;?></strong></td>
<th style="height: 22px">Name <span>*</span></th>
<td style="height: 22px"><input class="input medium" name="req" type="text" id="app1"></td>
</tr>
<tr>
<th>Contact <span>*</span></th>
<td><input class="input medium" name="reqisnum" type="text" id="app2"/></td>
<th>Email <span>*</span></th>
<td><input class="input medium" name="req" type="text" id="app3"/></td>
</tr>
<tr>
<th style="height: 26px">Qualification <span>*</span></th>
<td style="height: 26px">
<select class="input drop-down large" name="req" id="app4">
				<option value="">Select Qualification</option>
<?php
$getDesig = mysql_query("SELECT `id`,`name` FROM `education` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowDesig = mysql_fetch_array($getDesig))
{
?>
<option value="<?php echo $rowDesig[1]?>"><?php echo $rowDesig[1]?></option>
<?php
}
?>				
</select>

</td>
<th style="height: 26px">Experience <span>*</span></th>
<td style="height: 26px"><select class="input drop-down large" id="app5">
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
<th>Method Of Applicants<span>*</span></th>
<td>
<select class="input drop-down large"  id="app6" onchange="show(this.value,'mydiv');">
				<option value="">Select Method</option>
<?php
$getSource = mysql_query("SELECT `id`,`name` FROM `sourceofhire` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowSource = mysql_fetch_array($getSource))
{
?>
<option value="<?php echo $rowSource[1]?>"><?php echo $rowSource[1]?></option>

<?php
}
?>	
<option value="1">Refrence</option>
	
			</select>
			
<tr id="textboxDiv"></tr>
<th>Date Of Apply <span>*</span></th>
<td>
<input class="input medium" name="" id="app7" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalender('calenderid1','app7')"/>
				<div class="calender" id="calenderid1"></div>
</td>
<th>Refrence By <span>*</span></th>
<td><input class="input medium" name="app10" type="text" id="app10" /></td>
</tr>

<tr>
<th valign="top">Description </th>
<td><textarea class="input huge" name="TextArea1" style="width: 300px; height: 75px;" id="app8"></textarea></td>
<th valign="top">Upload Resume <span>*</span></th>
<td>						
	<iframe src="job-vacancy/resume/index.php?respid=app9" scrolling="no" height="100px" frameborder="0"></iframe>
	<input id="app9" type="hidden"/>
</td>
</tr>
<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('job-vacancy/jobapplicants/save?jobid=<?php echo $jobid;?>','app','11','','','couResp','1');"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>
</table>
	</div>
</div>
<script type="text/javascript">
$( ".txtreq" ).change(function() {
  alert( "Handler for .change() called." );
});
  </script>


