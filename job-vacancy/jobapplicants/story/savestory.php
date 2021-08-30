<?php
include("../../../include/conFig.php");
$valto = $_POST['valto'];
$id =$_GET['id'];
$jobid =$_GET['jobid'];
$applicantid= $_GET['applicantid'];
$valto = explode("*$*$*",$valto);

foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("INSERT INTO `candidatestory`(`id`,`jobid`,`applicant`,`name`, `vacancy`, `round`, `interviewby`, `result`,`createdate`, `modifieddate`, `updatedby`,`status`,`delete`) VALUES ('','$jobid ','$applicantid','$post[0]','$post[1]','$post[2]','$post[3]','$post[4]','$datetime','$datetime','$hrmloggedid','1','0')",$con) or die(mysql_error());

$getId = mysql_query("SELECT * FROM `candidatestory` where `applicant` = '$applicantid' and `jobid` = '$jobid'");
while($row = mysql_fetch_array($getId)) {
$ide =  $row['id'];
}

if($post[4]=='1')
{
	$ups = mysql_query("update `jobapplicants` set `jobapplicants`.`status` = '1' WHERE `jobapplicants`.`jobid` = '$id'");
?>
<button class="button blue"  onclick="getModule('employee/index?jobappid=<?=$applicantid;?>','manipulateContent','viewContent','Job')"> <i class="plus"></i>Add To Employee</button>&nbsp;&nbsp;

 <?php
}
?>
<?php

if($post[4]=='3')
{
$delete = mysql_query("update `jobapplicants`,`candidatestory` set .`jobapplicants`.`delete` = '2',`candidatestory`.`status` = '2' WHERE `jobapplicants`.`jobid` = '$id' AND `candidatestory`.`applicant` = '$applicantid'");

}
?>
<div class="success warnings">
Story Saved Successfully</div>
BREAKSTRINGFORSAVEDATA
