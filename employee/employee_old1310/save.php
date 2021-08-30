<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
$jobappid = $_GET['jobappid'];
$type = $_GET['type'];
$h=$_GET['h'];
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
//$insert = mysql_query("INSERT INTO `uploadocument` (`id`,`document`,`eid`,`type`,`createdate`,`updatedby` ,`delete`) VALUES ('','$a','$hrmloggedid','$type','$datetime', '$hrmloggedid','0')",$con) or die(mysql_error());
//echo "INSERT INTO `employee` (`id`, `name`, `mobile`, `phone`, `workphone`, `username`, `password`, `email`, `workemail`, `empid`, `empstatus`, `department`, `designation`, `location`, `reportto`, `hiresource`, `branch`, `doj`, `dob`, `doa`, `marital`, `gender`,  `address`, `city`, `specialization`, `jobdescription`, `about`, `image`, `createdate`, `updatedby`, `delete`, `active`,`bank`,`accountno`,`pfaccount`,`referredby`,`role`) VALUES ('', '$post[3]', '$post[16]', '$post[5]', '$post[8]', '$post[0]', '$post[1]', '$post[4]', '$post[9]', '$post[2]', '$post[14]', '$post[7]', '$post[6]', '$post[10]', '$post[11]', '$post[12]', '$post[15]', '$post[13]', '$post[17]', '$post[20]', '$post[19]', '$post[25]',  '$post[18]',  '$post[23]', '$post[22]', '$post[21]', '$post[26]', '$datetime',  '$datetime', '$hrmloggedid', '0', '$post[24]','$post[27]','$post[28]','$post[29]', '$post[30]','$post[31]')";
if($h > 31) {
mysql_query("INSERT INTO `employee` (`id`, `name`, `mobile`, `phone`, `workphone`, `username`, `password`, `email`, `workemail`, `empid`, `department`, `designation`, `location`, `salaryId`, `hiresource`, `branch`, `doj`, `dob`, `doa`, `marital`, `gender`,  `address`, `city`, `specialization`, `jobdescription`, `about`, `image`, `createdate`, `updatedby`, `delete`, `active`,`bank`,`accountno`,`pfaccount`,`referredby`,`role`,`attenid`) VALUES ('', '$post[3]', '$post[16]', '$post[5]', '$post[8]', '$post[0]', '$post[1]', '$post[4]', '$post[9]', '$post[2]', '$post[7]', '$post[6]', '$post[10]', '$post[11]', '$post[12]', '$post[15]', '$post[13]', '$post[17]', '$post[20]', '$post[19]', '$post[25]',  '$post[18]',  '$post[23]', '$post[22]', '$post[21]', '$post[26]', '$datetime',  '$datetime', '$hrmloggedid', '0', '$post[24]','$post[27]','$post[28]','$post[29]', '$post[30]','$post[31]','$post[32]')",$con) or die(mysql_error());
$id = mysql_insert_id();
for($i= 32 ;$i < $h ;$i++)
{
//echo "INSERT INTO `uploadocument` (`id`,`document`,`eid`,`createdate`,`updatedby` ,`delete`) VALUES ('','$post[$i]','$id','$datetime', '$hrmloggedid','0')";
mysql_query("INSERT INTO `uploadocument` (`id`,`document`,`eid`,`createdate`,`updatedby` ,`delete`) VALUES ('','$post[$i]','$id','$datetime', '$hrmloggedid','0')",$con) or die(mysql_error());
}
}
else 
{
mysql_query("INSERT INTO `employee` (`id`, `name`, `mobile`, `phone`, `workphone`, `username`, `password`, `email`, `workemail`, `empid`, `department`, `designation`, `location`, `salaryId`, `hiresource`, `branch`, `doj`, `dob`, `doa`, `marital`, `gender`,  `address`, `city`, `specialization`, `jobdescription`, `about`, `image`, `createdate`, `updatedby`, `delete`, `active`,`bank`,`accountno`,`pfaccount`,`referredby`,`role`,`attenid`) VALUES ('', '$post[3]', '$post[16]', '$post[5]', '$post[8]', '$post[0]', '$post[1]', '$post[4]', '$post[9]', '$post[2]', '$post[7]', '$post[6]', '$post[10]', '$post[11]', '$post[12]', '$post[15]', '$post[13]', '$post[17]', '$post[20]', '$post[19]', '$post[25]',  '$post[18]',  '$post[23]', '$post[22]', '$post[21]', '$post[26]', '$datetime',  '$datetime', '$hrmloggedid', '0', '$post[24]','$post[27]','$post[28]','$post[29]', '$post[30]','$post[31]','$post[32]')",$con) or die(mysql_error());

}
$dateOne = date("Y-m-d");
mysql_query("INSERT INTO `salaryProfileStory`(`empId`, `salaryProfile`, `date`, `datetime`)  VALUES ('$id','$post[11]','$dateOne','$datetime')",$con) or die(mysql_error());

if($_GET['jobappid'])
{
$jobappid = $_GET['jobappid'];
$getData = mysql_query("SELECT jobapplicants.qualification, jobapplicants.experience, job.vacancy,job.id FROM jobapplicants,job WHERE jobapplicants.jobid = job.id AND jobapplicants.id = '$jobappid'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
$vacancy = trim($row[2]);
$newVacancy = $vacancy - 1;
mysql_query("INSERT INTO `education`(`degree`, `eid`, `createdate`, `updatedate`, `updatedby`) VALUES ('$row[0]','$id','$datetime','$datetime','$hrmloggedid')",$con) or die(mysql_error());
mysql_query("INSERT INTO `workexperience`(`jobdesc`, `eid`, `createdate`, `updatedate`, `updatedby`) VALUES ('$row[1]','$id','$datetime','$datetime','$hrmloggedid')",$con) or die(mysql_error());
mysql_query("UPDATE `job` SET `vacancy` = '$newVacancy' WHERE `id` = '$row[3]'",$con) or die(mysql_error());
mysql_query("UPDATE `jobapplicants` SET `delete` = '1' WHERE `id` = '$jobappid'",$con) or die(mysql_error());
}
?>

BREAKSTRINGFORSAVEDATA
<div class="sucessResp">
Employee Saved Successfully</div>

