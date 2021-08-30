<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
$eid = $_GET['eid'];
$id = $_GET['id'];
$mnth = $_GET['month'];
$cYear = date("Y");
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
if($eid != "")
{
mysql_query("INSERT INTO `salaryslip`(`year`,`employee`, `month`,  `totaldays`, `present`, `absent`,`leave`, `gross`, `hra`, `conveyance`, `bonus`, `pf`, `claim`, `insurance`, `total`, `createdate`, `updatedate`, `updatedby`, `status`,`mode`,`deduction`,`workingdays`) VALUES ('$cYear','$eid','$mnth','$post[0]','$post[1]','$post[2]','$post[3]','$post[4]','$post[5]','$post[6]','$post[7]','$post[8]','$post[9]','$post[10]','$post[11]','$datetime','$datetime','$hrmloggedid','1','$post[12]','$post[13]','$post[14]')",$con) or die(mysql_error());
$output = "Salary Successfully Added";
}
else
{
mysql_query("UPDATE `salaryslip` SET `gross`='$post[4]',`hra`='$post[5]',`conveyance`='$post[6]',`bonus`='$post[7]',`pf`='$post[8]',`claim`='$post[9]',`insurance`='$post[10]',`leave`='$post[3]',`totaldays`='$post[0]',`present`='$post[1]',`absent`='$post[2]',`total`='$post[11]',`updatedate`='$datetime',`updatedby`='$hrmloggedid',`mode`='$post[12]',`deduction`='$post[13]',`workingdays`='$post[14]' WHERE `id` = '$id'",$con) or die(mysql_error());
$output = "Salary Successfully Updated";
}
?>
