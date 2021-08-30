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

$getData = mysql_query("SELECT `mobile`, `phone`, `workphone`, `department`, `designation`, `salaryId`, `branch`, `empstatus` FROM `employee` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
echo $row[0].' != '.$post[16];
if($row[0] != $post[16])
{
$subject = 'Mobile no. is changed';
$note = "Previous no.".$row[0]."and new no. is".$post[16].".";
mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());

}
if($row[1] != $post[5])
{
$subject = 'Phone no. is changed';
$note = "Previous no.".$row[1]."and new no. is".$post[5].".";
mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());

}
if($row[2] != $post[8])
{
$subject = 'WorkPhone no. is changed';
$note = "Previous no.".$row[2]."and new no. is".$post[8].".";
mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());

}

if($row[3] != $post[7])
{
	$depA = array();
	$getdep = mysql_query("SELECT `name`,`id` FROM `department` WHERE `id` IN ($row[3],$post[7])",$con) or die(mysql_error());
	while($rowdep = mysql_fetch_array($getdep))
	{
	$depA[$rowdep[1]] = $rowdep[0];
	}
	$subject = 'Department is changed';
	$note = "Previous department is ".$depA[$row[3]]." and new department is ".$depA[$post[7]].".";
	mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
}

if($row[4] != $post[6])
{
	$desiA = array();
	$getdesi = mysql_query("SELECT `name`,`id` FROM `designation` WHERE `id` IN ($row[4],$post[6])",$con) or die(mysql_error());
	while($rowdesi = mysql_fetch_array($getdesi))
	{
	$desiA[$rowdesi[1]] = $rowdesi[0];
	}

	$subject = 'Designation is changed';
	$note = "Previous designation is ".$desiA[$row[4]]." and new designation is ".$desiA[$post[6]].".";
	mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());

}

if($row[5] != $post[11])
{
	$salpA = array();
	$getsalp = mysql_query("SELECT `salprofile`,`id` FROM `salary` WHERE `id` IN ($row[5],$post[11])",$con) or die(mysql_error());
	while($rowsalp = mysql_fetch_array($getsalp))
	{
	$salpA[$rowsalp[1]] = $rowsalp[0];
	}

$subject = 'Salary Profile is changed';
$note = "Previous Salary Profile is ".$salpA[$row[5]]." and new Salary Profile is ".$salpA[$post[11]].".";
	mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());

}

if($row[6] != $post[15])
{
	$branA = array();
	$getbranch = mysql_query("SELECT `name`,`id` FROM `branch` WHERE `id` IN ($row[6],$post[15])",$con) or die(mysql_error());
	while($rowbranch = mysql_fetch_array($getbranch))
	{
	$branA[$rowbranch[1]] = $rowbranch[0];
	}

$subject = 'Branch is changed';
$note = "Previous branch is ".$branA[$row[6]]." and new branch is ".$branA[$post[15]].".";
	mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());

}
if($row[7] != $post[14])
{
	$empA = array();
	$getempS = mysql_query("SELECT `name`,`id` FROM `employeestatus` WHERE `id` IN ($row[7],$post[14])",$con) or die(mysql_error());
	while($rowempS = mysql_fetch_array($getempS))
	{
	$empA[$rowempS[1]] = $rowempS[0];
	}
$subject = 'Employee Status is changed';
$note = "Previous Employee Status is ".$empA[$row[7]]." and new Employee Status is ".$empA[$post[14]].".";
	mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES ('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());


}


mysql_query("UPDATE `employee` SET `name`='$post[3]', `mobile`='$post[16]',`phone`='$post[5]',`workphone`='$post[8]',`username`='$post[0]',`password`='$post[1]',`email`='$post[4]',`workemail`='$post[9]',`empid`='$post[2]',`department`='$post[7]',`designation`='$post[6]', `location`='$post[10]',`salaryId`='$post[11]',`hiresource`='$post[12]',`branch`='$post[15]',`doj`='$post[13]',`dob`='$post[17]',`doa`='$post[20]',`marital`='$post[19]',`gender`='$post[25]',`address`='$post[18]',`city`= '$post[23]',`specialization`='$post[22]',`jobdescription`='$post[21]',`about`='$post[26]',`image`='',`updatedate`='$datetime',`updatedby`='$hrmloggedid',`active`= '$post[24]',`bank`='$post[27]',`accountno`='$post[28]',`pfaccount`='$post[29]', `referredby` = '$post[30]',`role`='$post[31]',`attenid`='$post[32]',`empstatus` = '$post[14]' WHERE `id` = '$id'",$con) or die(mysql_error());
$dateOne = date("Y-m-d");
mysql_query("INSERT INTO `salaryProfileStory`(`empId`, `salaryProfile`, `date`, `datetime`)  VALUES ('$id','$post[11]','$dateOne','$datetime')",$con) or die(mysql_error());

?>

BREAKSTRINGFORSAVEDATA
<div class="sucessResp">
Employee Updated Successfully</div>
