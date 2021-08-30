<?php
include("../../include/conFig.php");
echo $id=$_GET['id'];
$sql = "SELECT  * from `jobapplicants` where `delete` = '0'";
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
</td>
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
	
</tr>
<?php
$i = 1;
//$sql .=" order by `id` ASC LIMIT $Page_Start , $Per_Page";
//$values = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($getData))
{
?>
<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
<td class="link-blue" onclick="getModule('job-vacancy/jobapplicants/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','job Applicants')"><?php echo $row['jobtitel'] ?></td>
<td style="height: 20px"><?php echo $row['name']?></td>
<td style="height: 20px"><?php echo $row['contact']?></td>
<td style="height: 20px"><?php echo $row['email']?></td>
<td style="height: 20px"><?php echo $row['qualification']?></td>
<td style="height: 20px"><?php echo $row['experience']?></td>
<td style="height: 20px"><?php echo $row['method']?></td>
<td style="height: 20px"><?php echo $row['dateofapply']?></td>

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
