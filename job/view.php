<?php
include("../include/conFig.php");

$sql = "SELECT  * from `job` where `delete` = '0'";
$getData = mysql_query($sql,$con) or die(mysql_error());
$Num_Rows = mysql_num_rows($getData);
	$Per_Page = 25;   // Per Page
	include('../pagination/pagination.php');
	$folder= 'job/view';
	$title = 'Job';
//$getData = mysql_query("SELECT  * from `job` where `delete` = '0' order by `id` desc",$con) or die(mysql_error());
?>

<div id="myTitle">
<div class="title">View Job</div>
<div class="strip">
<span>Dashboard</span>
<span>Job</span>
<span>View</span>
</div>
</div>

<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
<?php if(in_array('a_job',$thisper)) 
{
?>
<button class="button blue" onclick="getModule('job/index','manipulateContent','viewContent','Job')"> <i class="plus"></i>Add New Job</button>&nbsp;
<?php 
} 
?>
<?php if(in_array('d_job',$thisper)) 
{
?>
<button class="button red" onclick="deleteData('job','job')"> <i class="delete-icon"></i>Delete</button>&nbsp;
<?php 
} 
?>
</td>

</tr>
</table>
<div style="height:400px;overflow-x:hidden;overflow-y:scroll" id="mainDivId">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
<tr><th style="width:5%"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>

<!--
<h2 class="title">View All Jobs<span style="display:inline-block"><?php echo $_GET['msg']?></span>
<div class="red awesome small"  onclick="deleteData('job','Job')"  style="float:right;margin-left:10px">Delete Selected</div>&nbsp;&nbsp;&nbsp;
<div class="blue awesome small" onclick="getModule('job/index','manipulateContent','viewContent','Job')" style="float:right">Add New Job</div>

</h2>

<div style="background:#fff;height:500px;overflow-x:hidden;overflow-y:auto">
<table width="100%" cellpadding="5" cellspacing="0" style="text-align:center" class="fetch">
<tr><th style="width:5%;"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>-->
	<th style="width:10%;display:none">Job Name</th>
	<th>Post</th>
	<th>Vacancy</th>
	<th>Eligibility</th>
	<th>Last Date</th>
	<th>Status</th>
	<th>Action</th>
</tr>
<?php
$i = 1;
$sql .=" order by `id` ASC LIMIT $Page_Start , $Per_Page";
$values = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($values))
{
$desig = $row['post'];
$getDesig = mysql_query("SELECT `name` FROM `designation` WHERE `id` = '$desig'",$con) or die(mysql_error());
$rowDesig = mysql_fetch_array($getDesig);
?>
<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
<td style="display:none;height: 20px"><?php echo $row['name']?></td>
<td style="height: 20px"><?php echo $rowDesig[0]?></td>
<td style="height: 20px"><?php echo $row['vacancy']?></td>
<td style="height: 20px"><?php echo $row['eligibility']?></td>
<td style="height: 20px"><?php echo $row['lastdate']?></td>
<td>
	<div id="jobs<?php echo $row['id']?>" <?php if($row['status'] == '1') {echo 'class = "active"';} else {echo 'class ="button maroon"';}?> onclick="changeStatus('status','job','<?php echo $row['id']?>','jobs')"  ><?php if($row['status'] == '1') {echo 'Active';} else {echo 'Deactive';}?></div>

</td>
<td align="center">
<?php if(in_array('u_job',$thisper)) 
{
?>
<img style="cursor:pointer" src="img/icons/icons15.png" title="Edit Job<?php echo $row[1]?>" height="20" width="17" onclick="getModule('job/edit?id=<?php echo $row['id']?>&i=<?php echo $i?>','manipulateContent','viewContent','Job')"/>&nbsp;&nbsp;
<?php
$id = $row['id'];
$chkJob = mysql_query("SELECT COUNT(jobapplicants.id) FROM job,jobapplicants WHERE jobapplicants.delete = '0' AND jobapplicants.jobid = '$id' AND job.lastdate <= '$date' AND job.status = '1' AND job.id = jobapplicants.jobid",$con) or die(mysql_error());
$rowJob = mysql_fetch_array($chkJob);

if($rowJob[0] > 0)
{
?>
<?php if(in_array('ap_job',$thisper)) 
{
?>
<img style="cursor:pointer" src="img/icons/icons22.png" title="<?php echo $rowJob[0];?> Job Applicants" height="23" width="20" onclick="getModule('job/jobapplicants/view?jobid=<?php echo $id?>&i=<?php echo $i?>&desig=<?php echo $rowDesig[0];?>','viewmoodleContent','','Job')"/>&nbsp;&nbsp;
<?php 
} 
?>

<?php
}
?>

<?php 
} 
?>
<?php if(in_array('d_job',$thisper)) 
{
?>
<img style="cursor:pointer" src="img/icons/icons4.png" title="Delete Job<?php echo $row[1]?>" height="20" width="13" onclick="deleteSingle('<?php echo $id?>','fetchrow<?php echo $i?>','job')"/>&nbsp;&nbsp;
<?php 
} 
?>



</td>
</tr>
<?php
$i++;
$Maxid = $row['id'];
$MaxI = $i;
}
?>
<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" >
</table>

</div>
<?php
include('../pagination/pages.php');
?>
