<?php
include("../../include/conFig.php");
$jobid = $_GET['jobid'];
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("INSERT INTO `jobapplicants`(`jobid`, `name`, `contact`, `email`, `qualification`, `experience`, `source`, `resumefile`, `description`,`dateofapply`,`creatdate`, `updatedate`, `updatedby`,`jobtitel`,`method`,`referby`) VALUES ('$jobid','$post[1]','$post[2]','$post[3]','$post[4]','$post[5]','HRM','$post[9]','$post[8]','$post[7]','$datetime','$datetime','$hrmloggedid','$post[0]','$post[6]','$post[10]')",$con) or die(mysql_error());
$id = mysql_insert_id();
$getData = mysql_query("SELECT  * from `jobapplicants` where `delete` = '0' AND `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);


?>
<div class="success warnings">
Job Saved Successfully</div>
BREAKSTRINGFORSAVEDATA
<td><input id="chBxPUTGENERATEDIHEREINNS" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
<td style="display:none;height: 20px"><?php echo $row['name']?></td>
<?php 
$desig = $row['post'];
$getDesig = mysql_query("SELECT `name` FROM `designation` WHERE `id` = '$desig'",$con) or die(mysql_error());
$rowDesig = mysql_fetch_array($getDesig);
?>
<td style="height: 20px"><?php echo $rowDesig[0]?></td>
<td style="height: 20px"><?php echo $row['vacancy']?></td>
<td style="height: 20px"><?php echo $row['eligibility']?></td>
<td style="height: 20px"><?php echo $row['lastdate']?></td>
<td>
	<div id="jobs<?php echo $row['id']?>" <?php if($row['status'] == '1') {echo 'class = "button green"';} else {echo 'class ="button maroon"';}?> onclick="changeStatus('status','job','<?php echo $row['id']?>','jobs')"  ><?php if($row['status'] == '1') {echo 'Active';} else {echo 'Deactive';}?></div>

</td>
<td align="center">
<img src="img/icons/icons15.png" title="Edit Job<?php echo $row[1]?>" height="20" width="20" onclick="getModule('job/edit?id=<?php echo $row['id']?>&i=<?php echo $i?>','manipulateContent','viewContent','Job-Applicants')"/>&nbsp;&nbsp;
<img src="img/icons/icons4.png" title="Delete Job<?php echo $row[1]?>" height="20" width="20" onclick="deleteSingle('<?php echo $id?>','fetchrow<?php echo $i?>','job')"/>&nbsp;&nbsp;

<?php
$id = $row['id'];
$chkJob = mysql_query("SELECT COUNT(jobapplicants.id) FROM job,jobapplicants WHERE jobapplicants.jobid = '$id' AND job.lastdate <= '$date' AND job.status = '1' AND job.id = jobapplicants.jobid",$con) or die(mysql_error());
$rowJob = mysql_fetch_array($chkJob);

if($rowJob[0] > 0)
{
?>
<img src="img/icons/icons22.png" title="<?php echo $rowJob[0];?> Job Applicants" height="23" width="23" onclick="getModule('job/jobapplicants/view?jobid=<?php echo $id?>&i=<?php echo $i?>&desig=<?php echo $rowDesig[0];?>','viewmoodleContent','manipulatemoodleContent','Job')"/>&nbsp;&nbsp;
<?php
}
?>

</td>

