<?php
include("../include/conFig.php");
$name=$_COOKIE['hrmname'];
$desi = $_GET['desi'];
explode("###",$desi);
$desi=$desi[0];
$jid=$desi[1];
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}


$name=$post[2];
$qualification=$post[6];
$experience=$post[7];
$designation=$post[0];
$referby=$post[1];
$c_name=$post[2];
$method=$post[5];
$email=$post[4];
$contact=$post[3];
mysql_query("INSERT INTO `refer`(`name`, `qualification`, `experience`, `designation`, `createdate`, `modifiedby`, `updatedby`, `approval`, `delete`, `referby`, `resume`, `c_name`, `email`, `contact`, `jid`) VALUES ('$name','$qualification','$experience','$designation','$datetime','$datetime','$hrmloggedid','0','0','$referby','','$c_name','$email','$contact','$jid')") or die(mysql_error());
//mysql_query("INSERT INTO `jobapplicants`(`id`, `name`, `qualification`, `experience`, `resume`,`creatdate`,`modifiedby`,`updatedby`,`referby`,`designation`,`delete`) VALUES ('$jobid','$post[1]','$post[2]','$post[3]','$post[4]','$post[5]','HRM','$post[9]','$post[8]','$post[7]','$datetime','$datetime','$hrmloggedid','$post[0]','$post[6]')",$con) or die(mysql_error());
$id = mysql_insert_id();
$getData = mysql_query("SELECT  * from `refer` where `delete` = '0' AND `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);


?>
<div class="success warnings">
Reference Successfully Saved </div>
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

