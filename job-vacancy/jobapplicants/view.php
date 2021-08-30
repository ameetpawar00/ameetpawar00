<?php
include("../../include/conFig.php");
$id=$_GET['id'];
//$sql = "SELECT  * from `jobapplicants` where `delete` = '0' and `jobid`='$id'";
$sql = "SELECT  jobapplicants.id as applicantid, jobapplicants.name,jobapplicants.contact,`jobapplicants`.`jobid`,jobapplicants.email,jobapplicants.qualification,jobapplicants.experience,jobapplicants.source,jobapplicants.method,jobapplicants.dateofapply,jobvacancy.id,`jobapplicants`.`status`, designation.name as dname from `jobapplicants`,`jobvacancy`,`designation` where designation.id=jobvacancy.designation and jobvacancy.delete = '0' and `jobapplicants`.`delete` = '0' and `jobapplicants`.`jobid`='$id' and jobvacancy.id = jobapplicants.jobid";

$getData = mysql_query($sql,$con) or die(mysql_error());
	$Per_Page = 25;   // Per Page
	include('../pagination/pagination.php');
	$folder= 'job-vacancy/jobapplicants/view';
	$title = 'Job Applicants';
?>

<div id="myTitle">
<div class="title">View Job-Applicants</div>
<div class="strip">
<span>Dashboard</span>
<span>Job Applicants</span>
<span>View</span>
</div>
</div>

<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
<?php if(in_array('vap_job',$thisper)) 
{
?>
<button class="button blue" onclick="getModule('job-vacancy/jobapplicants/new?jobid=<?php echo $id;?>','manipulateContent','viewContent','Job')"><i class="plus"></i>Applicant</button>
<?php 
} ?>
</tr>
</table>
<div style="height:400px;overflow-x:hidden;overflow-y:scroll" id="mainDivId">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
<tr><th style="width:5%"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>

	<th>Job Titel</th>
	<th>Name</th>
	<th>Contact</th>
	<th>Email</th>
	<th>Qualification</th>
	<th>Experience</th>
	<th>Method</th>
	<th>Date fo Apply</th>
	<th style="width: 51px">Lineup</th>
	<th style="width: 67px">Add Story</th>

	
</tr>
<?php
$i = 1;
//$sql .=" order by `id` ASC LIMIT $Page_Start , $Per_Page";
//$values = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($getData))
{
	//print_r($row);
$appid=$row['id'];
$jobid=$row['jobid'];
$applicantid=$row['applicantid'];
?>
<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td ><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
<td class="link-blue" onclick="getModule('job-vacancy/jobapplicants/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Job-Applicant')"><?php echo $row['dname'] ?></td>
<td style="height: 20px"><?php echo $row['name']?></td>
<td style="height: 20px"><?php echo $row['contact']?></td>
<td style="height: 20px"><?php echo $row['email']?></td>
<td style="height: 20px"><?php echo $row['qualification']?></td>
<td style="height: 20px"><?php echo $row['experience']?></td>
<td style="height: 20px"><?php echo $row['method']?></td>
<td style="height: 20px"><?php echo $row['dateofapply']?></td>


<?php if(in_array('line_job',$thisper)) 
{
	if($row['status']==1) 
	{
		
		echo "<td><div style=color:green>Selected</div></td>";
		
	}else{
		
	
?>
<td style="height: 20px; width: 51px;" title="Add Line-Up" onclick="getModule('job-vacancy/jobapplicants/lineup/new?applicantid=<?php echo $applicantid;?>&jobid=<?php echo $id;?>','manipulateContent','viewContent','Job-Applicant')"><img src="img/icons/1399053194_flick_up.png" style="height:25px; width:15px; margin-left:10px; cursor:pointer"/></td>
<?php 
} }
else
{
?>

<td><img  src="img/not.png" style="width:15px; height:15px; cursor:crosshair" title="Not Permission To access"></td>
<?php
}
?>
<?php if(in_array('story_job',$thisper)) 
{
	if($row['status']==1) 
	{
?>
<td>
<button class="button blue"  onclick="getModule('employee/index?jobappid=<?=$applicantid;?>','manipulateContent','viewContent','Job')"> <i class="plus"></i>Add To Employee</button>&nbsp;&nbsp;</td>


<?php
		
		
	}else{
		
?>
<td style="height: 20px; width: 67px;" title="Add Story" onclick="getModule('job-vacancy/jobapplicants/story/new?applicantid=<?php echo $applicantid;?>&id=<?php echo $id;?>&jobid=<?php echo $jobid;?>','manipulateContent','viewContent','Job-Applicant')"><img  src="img/icons/1399133579_user-add.png"style="height:25px; width:20px; margin-left:10px; cursor:pointer"/></td>
<?php 
} 
} 
else
{
?>

<td ><img  src="img/not.png" style="width:15px; height:15px; cursor:crosshair" title="Not Permission To access"></td>
<?php
}
?>

<?php
$i++;
$Maxid = $row['id'];
$MaxI = $i;
}
?>
<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>">
</table>

</div>
<?php
include('../pagination/pages.php');
?>
