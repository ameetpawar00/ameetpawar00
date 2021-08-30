<?php
include("../include/conFig.php");
$sql = "SELECT  * from `jobvacancy` where `delete` = '0' AND `vacancy` > '0'";
$getData = mysql_query($sql,$con) or die(mysql_error());
$Num_Rows = mysql_num_rows($getData);
	$Per_Page = 25;   // Per Page
	include('../pagination/pagination.php');
	$folder= 'job-vacancy/view';
	$title = 'Job-vacancy';
//$getData = mysql_query("SELECT  * from `job` where `delete` = '0' order by `id` desc",$con) or die(mysql_error());
?>

<div id="myTitle">
<div class="title">View Job-vacancy</div>
<div class="strip">
<span>Dashboard</span>
<span>Job vacancy</span>
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
<button class="button blue" onclick="getModule('job-vacancy/index','manipulateContent','viewContent','Job-vacancy')"> <i class="plus"></i>Add New Job</button>&nbsp;
<?php 
} 
?>
<?php if(in_array('d_job',$thisper)) 
{
?>
<button class="button red" onclick="deleteData('jobvacancy','job-vacancy')"> <i class="delete-icon"></i>Delete</button>&nbsp;
<?php 
} 
?>
</td>

</tr>
</table>
<div style="height:350px;overflow:auto" id="mainDivId">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
<tr><th style="width:5%; height: 30px;"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>

	<th style="height: 30px" >Designatiom</th>
	<th style="height: 30px">Qualification</th>
	<th style="height: 30px">Vacancy</th>
	<th style="height: 30px">Salary Range</th>
	<th style="height: 30px">Experience</th>
	<th style="height: 30px">Eligibility</th>
	<th style="height: 30px">Last Date</th>
	<th style="height: 30px">Status</th>
	<th style="height: 30px">Action</th>

	
</tr>
<?php
$i = 1;
$sql .=" order by `id` ASC LIMIT $Page_Start , $Per_Page";
$values = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($values))
{
$desig = $row['designation'];
$getDesig = mysql_query("SELECT `name` FROM `designation` WHERE `id` = '$desig'",$con) or die(mysql_error());
$rowDesig = mysql_fetch_array($getDesig);
?>
<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
<?php if(in_array('u_job',$thisper)) 
{
?>
<td class="link-blue" onclick="getModule('job-vacancy/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Job-Applicant')"><?php echo $rowDesig['name'] ?></td>
<?php 
} 
else
{
?>
<td ><?php echo $rowDesig['name']?></td>
<?php
}
?>

<td style="height: 20px"><?php echo $row['qualification']?></td>
<td style="height: 20px"><?php echo $row['vacancy']?></td>
<td style="height: 20px"><?php echo $row['salary']?></td>
<td style="height: 20px"><?php echo $row['experience']?></td>
<td style="height: 20px"><?php echo $row['eligiblity']?></td>
<td style="height: 20px"><?php echo $row['lastdate']?></td>
<td> <?php if($row['status'] == '1') {?><div style=color:green>Active</div><?php } else {?> <div style=color:maroon>Deactive</div><?php } ?>
</td>
<?php if(in_array('ap_job',$thisper)) 
{
?>
<td>
<img style="cursor:pointer;margin-left:12px;" src="img/icons/1398708853_street_view.png" title="View Job-Applicant<?php echo $row[1]?>" height="20" width="17" onclick="getModule('job-vacancy/jobapplicants/view?id=<?php echo $row['id']?>&i=<?php echo $i?>','manipulateContent','viewContent','Job-Applicant')"/>
</td>
<?php 
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
</tr>
<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" >
</table>
</div>
<?php
include('../pagination/pages.php');
?>
