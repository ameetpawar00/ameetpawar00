<?php 
include("../../include/conFig.php");
$applicantid= $_GET['applicantid'];

$select=mysql_query("select * from jobapplicants where id = '$jobid'");
while($row=mysql_fetch_array($select)){
echo $jobid = $row['jobid'];
}
?>

<div class="title">Line-Up</div>
<div class="strip">
<span>Dashboard</span>
<span>Jobs</span>
<span>Job Applicants</span>
<span>Add Line-Up</span>
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
<tr><td colspan="2" style="text-align:center; height: 19px;"><div style="display:inline-block;" id="couResp"></div></td></tr>



			
<tr>
<th>Date Of Contact <span>*</span></th>
<td>
<input class="input medium" name="" id="lin0" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalender('calenderid1','lin0')"/>
<div class="calender" id="calenderid1"></div>
<th style="height: 22px">Type Of Contact <span>*</span></th>
<td style="height: 22px"><input class="input medium" name="req" type="text" id="lin1"></td>
</tr>
<tr>
<th>Call Back Date<span>*</span></th>
<td>
<input class="input medium" name="" id="lin2" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalender('calenderid1','lin2')"/>
<div class="calender" id="calenderid1"></div>
</tr>

<tr>
<th>Status<span>*</span></th>
<form id="formid">
<td>
<input id="lin3" name="status"  type="hidden" value="0"  />

<input id="chkTick0" name="status"  type="checkbox" value="1" onclick="valueTick('chkTick0','chkTick','0','2','lin3')" />Interview
</td>
<td>
<input id="chkTick1" name="status" value="2"  type="checkbox"  onclick="valueTick('chkTick1','chkTick','0','2','lin3')" />Save For Future
</td>
<td>
<input id="chkTick2" name="status" value="3"  type="checkbox" onclick="valueTick('chkTick2','chkTick','0','2','lin3')" />Not Required/Intrested
</td>
</form>
</tr>

<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('job-vacancy/jobapplicants/savelineup?applicantid=<?php echo $applicantid;?>&jobid=<?php echo $jobid;?>','lin','6','','','couResp','1');"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>

</table>
	</div>
</div>

