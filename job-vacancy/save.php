<?php
include("../include/conFig.php");
$eid = $_GET['eid'];
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
//mysql_query("INSERT INTO `jobvacancy`(`designation`, `qualification`, `vacancy`, `salary`, `lastdate`, `experience`,`eligiblity`,`remark`,`status``creatdate`, `delete`, `updatedby`) VALUES ('$post[0]','$post[1]','$post[2]','$post[3]','$post[4]','$post[5]','$post[6]','$post[7]','$post[8]','$datetime','0','$hrmloggedid')",$con) or die(mysql_error());
//echo "INSERT INTO `jobvacancy`(`designation`, `qualification`,`vacancy`, `salary`,`lastdate`, `experience`,`eligiblity`,`remark`,`status`,`createdate`, `delete`, `updatedby`) VALUES ('$post[0]','$post[1]','$post[2]','$post[3]','$post[4]','$post[5]','$post[6]','$post[7]','$post[8]','$datetime','0','$hrmloggedid')";
$select= mysql_query("INSERT INTO `jobvacancy`(`designation`, `qualification`,`vacancy`, `salary`,`lastdate`, `experience`,`eligiblity`,`remark`,`status`,`createdate`, `delete`, `updatedby`) VALUES ('$post[0]','$post[1]','$post[2]','$post[3]','$post[4]','$post[5]','$post[6]','$post[7]','$post[8]','$datetime','0','$hrmloggedid')",$con) or die(mysql_error());

$id = mysql_insert_id();
$getData = mysql_query("SELECT * FROM `jobvacancy` WHERE `id` = '$id' AND `delete`='0'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
<div class="success warnings">
inventory Saved Successfully</div>
BREAKSTRINGFORSAVEDATA
<td><input id="chBxPUTGENERATEDIHEREINNS" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
<td class="link-blue" onclick="getModule('job-vacancy/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Inventory')"><?php echo $row['designation'] ?></td>
<td style="height: 20px"><?php echo $row['qualification']?></td>
<td style="height: 20px"><?php echo $row['vacancy']?></td>
<td style="height: 20px"><?php echo $row['salary']?></td>
<td style="height: 20px"><?php echo $row['experience']?></td>
<td style="height: 20px"><?php echo $row['eligiblity']?></td>
<td style="height: 20px"><?php echo $row['lastdate']?></td>
<td> <?php if($row['status'] == '1') {?><div style=color:green>Active</div><?php } else {?> <div style=color:maroon>Deactive</div><?php } ?>
</td>
<td>
<img style="cursor:pointer;margin-left:12px;" src="img/icons/1398708853_street_view.png" title="View Job-Applicant<?php echo $row[1]?>" height="20" width="17" onclick="getModule('job-vacancy/jobapplicants/view?id=<?php echo $row['id']?>&i=<?php echo $i?>','manipulateContent','viewContent','Job-Applicant')"/>
</td>

