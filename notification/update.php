<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$i = $_GET['i'];
$id = $_GET['id'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
//echo "UPDATE `jobapplicants` SET `name`='$post[0]',`contact`='$post[1]',`email`='$post[2]',`qualification`='$post[3]',`experience`='$post[4]',`method`='$post[5]',`dateofapply`='$post[6]',`description`='$post[7]',`updatedby`='$hrmloggedid' WHERE `id` = '$id'";
mysql_query("UPDATE `jobapplicants` SET `name`='$post[0]',`contact`='$post[1]',`email`='$post[2]',`qualification`='$post[3]',`experience`='$post[4]',`method`='$post[5]',`dateofapply`='$post[6]',`description`='$post[7]',`updatedby`='$hrmloggedid' WHERE `id` = '$id'",$con) or die(mysql_error());
//echo "SELECT  * from `jobvacancy` where `delete` = '0' AND `id` = '$id'";
$getData = mysql_query("SELECT  * from `jobapplicants` where `delete` = '0' AND `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
<div class="success warnings">
Job updated Successfully</div>
BREAKSTRINGFORSAVEDATA
<td><input id="chBxPUTGENERATEDIHEREINNS" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
<td class="link-blue" onclick="getModule('job-vacancy/jobapplicants/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Job-Aplicant')"><?php echo $row['name'] ?></td>
<td style="height: 20px"><?php echo $row['contact']?></td>
<td style="height: 20px"><?php echo $row['email']?></td>
<td style="height: 20px"><?php echo $row['qualification']?></td>
<td style="height: 20px"><?php echo $row['experience']?></td>
<td style="height: 20px"><?php echo $row['method']?></td>
<td style="height: 20px"><?php echo $row['dateofapply']?></td>
<td style="height: 20px"><?php echo $row['description']?></td>

<td>
<img style="cursor:pointer;margin-left:12px;" src="img/icons/1398708853_street_view.png" title="View Job-Applicant<?php echo $row[1]?>" height="20" width="17" onclick="getModule('job-vacancy/jobapplicants/view?id=<?php echo $row['id']?>&i=<?php echo $i?>','manipulateContent','viewContent','Job-Applicant')"/>
</td>
