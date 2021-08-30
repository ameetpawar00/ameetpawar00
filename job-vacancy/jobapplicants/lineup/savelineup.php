<?php
include("../../../include/conFig.php");
$applicantid= $_GET['applicantid'];
$jobid = $_GET['jobid'];
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);

foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("INSERT INTO `lineup`(`id`,`applicant`, `dateofcontact`, `typeofcontact`, `callbackdate`, `status`,`createdate`, `modifieddate`, `updatedby`) VALUES ('','$applicantid','$post[0]','$post[1]','$post[2]','$post[3]','$datetime','$datetime','$hrmloggedid')",$con) or die(mysql_error());


/*if($post[3]=='2') 
{
$getData = mysql_query("SELECT  * from `jobapplicants` where `delete` = '0' AND `id` = '$applicantid'",$con) or die(mysql_error());
while($row=mysql_fetch_array($getData)) {
$jobapplicant= $row[0];
$jobid= $row[1];
$name= $row[2];
$contact= $row[3];
$email= $row[4];
$qualification= $row[5];
$experience= $row[6];
$dateofapply= $row[9];
$titel= $row[15];
$method= $row[16];
$resume= $row[8];
 }

//$insert = mysql_query("INSERT INTO `saveforfuture`(`jobid`, `name`, `contact`, `email`, `qualification`, `experience`,`dateofapply`,`creatdate`, `updatedate`, `updatedby`) VALUES ('$jobid','$name','$contact','$email','$qualification','$experience','$dateofapply','$datetime','$datetime',$hrmloggedid')",$con) or die(mysql_error());
$insert = mysql_query("INSERT INTO `saveforfuture`(`jobid`,`name`, `contact`, `email`,`qualification`,`experience`,`dateofapply`,`jobtitel`,`method`,`resumefile`,`updatedby`,`applicant`,`delete`) VALUES ('$jobid','$name','$contact','$email','$qualification','$experience','$dateofapply','$titel','$method','$resume','$hrmloggedid','$applicantid','0')");

}?*/
$getData = mysql_query("SELECT  * from `jobapplicants` where `delete` = '0' AND `id` = '$applicantid'",$con) or die(mysql_error());
while($row=mysql_fetch_array($getData)) {
$id = $row['id'];
}
if($post[3]=='2') {

$update = mysql_query("update `jobapplicants` SET `saveforfuture`='1' WHERE `id` = '$id'");
}
else if($post[3]=='3') {

$update = mysql_query("update `jobapplicants` SET `delete`='1' WHERE `id` = '$id'");
}

?>
<div class="success warnings">
Line-Up Saved Successfully</div>
BREAKSTRINGFORSAVEDATA
