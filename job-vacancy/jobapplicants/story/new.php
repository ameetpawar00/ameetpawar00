
<?php 
include("../../../include/conFig.php");
$applicantid= $_GET['applicantid'];
$id= $_GET['id'];
$jobid= $_GET['jobid'];
$select=mysql_query("select `jobapplicants`.`id` , `jobapplicants`.`name` , `jobapplicants`.`jobid`, `jobvacancy`.`id` , `designation`.`name` from `jobapplicants`,`jobvacancy`,`designation` where `jobvacancy`.`designation` =`designation`.`id` AND `jobvacancy`.`id` =`jobapplicants`.`jobid` AND `jobapplicants`.`id` = '$applicantid'");
while($row=mysql_fetch_array($select)){
$name = $row[1];
$vacancy = $row[4];
}
?>

<div class="title">Add Story</div>
<div class="strip">
<span>Dashboard</span>
<span>Jobs</span>
<span>Job Applicants</span>
<span>Add Story</span>
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
Add Story </div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center; height: 19px;"><div style="display:inline-block;" id="couResp"></div></td></tr>
			
<tr>
<th style="height: 22px">Candidate Name</th>
<td style="height: 22px"><strong style="color: green;cursor:pointer;"><input type="text" id="story0" value="<?php echo $name;?>" style="display:none;"><?php echo $name;?></strong></td>
<th style="height: 22px">Vacancy </th>
<td style="height: 22px"><strong style="color: green; ;cursor:pointer;"><input type="text" id="story1" value="<?php echo $vacancy;?>" style="display:none;"><?php echo $vacancy;?></strong></td>
</tr>
<?php 
$round = mysql_query("SELECT * FROM `candidatestory` WHERE `applicant` = '$applicantid' AND `jobid` = '$jobid' AND `result` = '2'");
$num = mysql_num_rows($round);
if ($num=='0'){
$roundCount = '1';
}
else if ($num=='1') {
$roundCount = '2';
}
else if ($num==2) {
$roundCount = '3';
}
else if ($num<='3') {
$roundCount = 'All Round Completed';
}


?>
<tr>
<th style="height: 22px">Round</th>
<td style="height: 22px"><input class="input medium" value ="<?php echo $roundCount;?>" readonly="readonly" type="text" id="story2"  style="cursor: pointer;display:none"><?php echo $roundCount;?></td>
<th style="height: 22px">Interview By<span>*</span></th>
<td style="height: 22px">
<select class="input drop-down large" name="req" id="story3">
				<option value="">Select Interviewer</option>
<?php
$get = mysql_query("SELECT `id`,`name` FROM `employee` WHERE `delete`= '0'",$con) or die(mysql_error());
while($row = mysql_fetch_array($get))
{
?>
<option value="<?php echo $row[1]?>"><?php echo $row[1]?></option>
<?php
}
?>				
			</select>

</td>
</tr>

<tr>
<th>Result<span>*</span></th>
<form id="formid">
<td>
<input id="story4" name="status"  type="hidden" value="0"/>

<input id="chkTick0" name="status"  type="checkbox" value="1" onclick="valueTick('chkTick0','chkTick','0','2','story4')" />Cleared
</td>
<td>
<input id="chkTick1" name="status" value="2"  type="checkbox"  onclick="valueTick('chkTick1','chkTick','0','2','story4')" />Promated To Next Round
</td>
<td>
<input id="chkTick2" name="status" value="3"  type="checkbox" onclick="valueTick('chkTick2','chkTick','0','2','story4')" />Not Required/ Rejected
</td>
</form>
</tr>

<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('job-vacancy/jobapplicants/story/savestory?id=<?php echo $id;?>&jobid=<?php echo $jobid;?>&applicantid=<?php echo $applicantid; ?>','story','5','','','couResp','1');"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>

</table>
	</div>
</div>

