<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
$i = $_GET['i'];
$id = $_GET['id'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
echo "UPDATE `jobvacancy` SET `designation`='$post[0]',`qualification`='$post[1]',`vacancy`='$post[2]',`salary`='$post[3]',`lastdate`='$post[4]',`experience`='$post[5]',`eligiblity`='$post[6]',`remark`='$post[7]',`status`='$post[8]',`updatedby`='$hrmloggedid' WHERE `id` = '$id'";
mysql_query("UPDATE `jobvacancy` SET `designation`='$post[0]',`qualification`='$post[1]',`vacancy`='$post[2]',`salary`='$post[3]',`lastdate`='$post[4]',`experience`='$post[5]',`eligiblity`='$post[6]',`remark`='$post[7]',`status`='$post[8]',`updatedby`='$hrmloggedid' WHERE `id` = '$id'",$con) or die(mysql_error());
//echo "SELECT  * from `jobvacancy` where `delete` = '0' AND `id` = '$id'";
$getData = mysql_query("SELECT  * from `jobvacancy` where `delete` = '0' AND `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);

?>


<div class="success warnings">
Job updated Successfully</div>
BREAKSTRINGFORSAVEDATA
<td><input id="chBxPUTGENERATEDIHEREINNS" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
<td class="link-blue" onclick="getModule('job-vacancy/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Job-Aplicant')"><?php echo $row['designation'] ?></td>
<td style="height: 20px"><?php echo $row['qualification']?></td>
<td style="height: 20px"><?php echo $row['vacancy']?></td>
<td style="height: 20px"><?php echo $row['salary']?></td>
<td style="height: 20px"><?php echo $row['experience']?></td>
<td style="height: 20px"><?php echo $row['eligiblity']?></td>
<td style="height: 20px"><?php echo $row['lastdate']?></td>
<td> <?php if($row['status'] == '1') {echo "<div style=color:green>Active</div>";} else {echo '<div style=color:maroon>Deactive</div>';}?>
</td>
<td>
<img style="cursor:pointer;margin-left:12px;" src="img/icons/1398708853_street_view.png" title="View Job-Applicant<?php echo $row[1]?>" height="20" width="17" onclick="getModule('job-vacancy/jobapplicants/view?id=<?php echo $row['id']?>&i=<?php echo $i?>','manipulateContent','viewContent','Job-Applicant')"/>
</td>
