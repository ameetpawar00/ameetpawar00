<?php
include("../../include/conFig.php");
$jobid = $_GET['jobid'];
$i = $_GET['i'];
$desig = $_GET['desig'];
$getData = mysql_query("SELECT * from `jobapplicants` where `delete` = '0' AND `jobid` = '$jobid' ORDER BY `id` desc",$con) or die(mysql_error());
?>

<div id="myTitle">
<div class="title">Jobs Applicants For Post <?php echo strtoupper($desig)?>
</div>

</div>

 
<div style="height:200px;overflow-x:hidden;overflow-y:scroll" id="mainDivId">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="">
<tr>

<!--
<h2 class="title">Jobs Applicants For Post <?php echo strtoupper($desig)?>
<div class="red awesome small"  onclick="deleteData('jobapplicants','Job Applicants')"  style="float:right;margin-left:10px">Delete Selected</div>
</h2>

<div style="background:#fff;height:500px;overflow-x:hidden;overflow-y:auto">
<table width="100%" cellpadding="5" cellspacing="0" style="text-align:center" class="fetch">
<tr><th><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>-->
	<th>For Post</th>
	<th>Name</th>
	<th>Contact</th>
	<th>Qualification</th>
	<th>Action</th>
</tr>
<?php
$i = 1;
while($row =mysql_fetch_array($getData))
{
?>
<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">

<td><?php echo $desig;?></td>
<td><?php echo $row['name']?></td>
<td><?php echo $row['contact']?></td>
<td><?php echo $row['qualification']?></td>

<td>
<img style="cursor:pointer" src="img/icons/icons32.png" title="View Applicant <?php echo $row['name']?>" height="20" width="17" onclick="getModule('job/jobapplicants/details?id=<?php echo $row['id']?>&i=<?php echo $i?>&desig=<?php echo $desig;?>','manipulatemoodleContent','viewmoodleContent','Job')">&nbsp;&nbsp;
<?php if(in_array('dap_job',$thisper)) 
{
?>
<img style="cursor:pointer" src="img/icons/icons4.png" title="Delete Applicant <?php echo $row['name']?>" height="20" width="13" onclick="deleteSingle('<?php echo $id?>','fetchrow<?php echo $i?>','job')">
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
<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
</table>

</div>
