<?php
include("../../include/conFig.php");
$total = 0;
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
$eid = $_GET['eid'];
$id = $_GET['id'];
$mnth = $_GET['month'];
$leaverecords = $_GET['leaverecords'];
if(isset($_COOKIE['selectedYear']))
{
$cYear  = $_COOKIE['selectedYear'];
}
else
{
$cYear = date("Y");
}

foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}



$basic=$post[9];
$con_allow=$post[10];
$spec_allow=$post[11];
$other_allow=$post[12];
$perf_allow=$post[13];
$perf_Bonus=$post[15];
$train_allow=$post[16];
$travel_allow=$post[17];
$add_earning=$post[18];
$PF=$post[19];
$deduction = $post[7]+$post[5];
$adjustment=$post[20];
$mode=$post[21];
$latecomes=$post[5];
$latecomesmins=$post[24];


$pfcamount=$post[33];
$pt=$post[34];
/*$esiceamount=$post[34];
$esiccamount=$post[35];*/



$totaldays = $post[0];
$workingdays=$post[1];
$present = $post[2];
$lwp=$post[3];////////////
$absent_days_not_approved = $post[4];////////
$totalAbsent = $post[8];
$leaves_approved=$post[22];	//leaves approved other than lwp
$leaveBalance=$post[23];



if($totalAbsent <= 2)
{
$att_allow = $post[14];
}
else if($totalAbsent > 2)
{
$att_allow = 0;
}


$gross = ($post[9]+$post[10]+$post[11]+$post[12]+$post[13]+$att_allow+$post[15]+$post[16]+$post[17]+$post[18]) - $post[19];
$total = $deduction-$gross;
$total = str_ireplace('-','',$total);

	if($post[21] == 'Deduct')
	{
		$total = $total-$post[20];
	}
	else if($post[21] == 'Add')
	{
		$total = $total+$post[20];
	}


if($eid != "")
{$TDS=$post[31];
$TMODE=$post[32];
		
	if($post[32] == 'Deduct')
	{
		$total = $total-$post[31];
	}
	else if($post[32] == 'Add')
	{
		$total = $total+$post[31];
	}

	$total = str_ireplace('-','',$total);





mysql_query("INSERT INTO `salaryslip`(`employee`, `month`, `year`, `basic`, `con_allow`, `spec_allow`, `other_allow`, `perf_allow`, `att_allow`, `perf_Bonus`, `train_allow`, `travel_allow`, `add_earning`, `PF`, `leave`, `workingdays`, `deduction`, `totaldays`, `present`, `absent`, `total`, `mode`, `createdate`, `updatedate`, `updatedby`, `adjustment`,`latecomes`,`leaveBalance`,`latecomesmins`,`TDS`,`TMODE`) VALUES ('$eid','$mnth','$cYear','$basic','$con_allow','$spec_allow','$other_allow','$perf_allow','$att_allow','$perf_Bonus','$train_allow','$travel_allow','$add_earning','$PF','$leaves_approved','$workingdays','$deduction','$totaldays','$present','$totalAbsent','$total','$mode','$datetime','$datetime','$hrmloggedid','$adjustment','$latecomes','$leaveBalance','$latecomesmins','$TDS','$TMODE')",$con) or die(mysql_error());
$id = mysql_insert_id();


$pfcamount=$post[33];
$pt=$post[34];
$esice=$post[35];
$esicc=$post[36];

mysql_query("INSERT INTO `salaryslip_extra`(`sid`, `employee`, `lwp`, `absent_days_not_approved`, `createdate`, `updatedate`, `updatedby`, `pfcamount`,`pt`, `esice`,`esicc`) VALUES ('$id', '$eid', '$lwp', '$absent_days_not_approved','$datetime','$datetime','$hrmloggedid','$pfcamount','$pt','$esice','$esicc')",$con) or die(mysql_error());
$output = "Salary Successfully Added";
}
else
{$TDS=$post[25];
$TMODE=$post[26];
	if($post[26] == 'Deduct')
		{
		$total = $total-$post[25];
		}
		else if($post[26] == 'Add')
		{
		$total = $total+$post[25];
		}

$sql = "UPDATE `salaryslip` SET `basic`='$basic',`con_allow`='$con_allow',`spec_allow`='$spec_allow',`other_allow`='$other_allow',`perf_allow`='$perf_allow',`att_allow`='$att_allow',`perf_Bonus`='$perf_Bonus',`train_allow`='$train_allow',`travel_allow`='$travel_allow',`add_earning`='$add_earning',`PF`='$PF',`leave`='$leaves_approved',`workingdays`='$workingdays',`deduction`='$deduction',`totaldays`='$totaldays',`present`='$present',`absent`='$totalAbsent',`total`='$total',`mode`='$mode',`createdate`='$datetime',`updatedate`='$datetime',`updatedby`='$hrmloggedid',`adjustment`='$adjustment',`latecomes`='$latecomes',`leaveBalance`='$leaveBalance',`latecomesmins`='$latecomesmins',`TDS`='$TDS',`TMODE`='$TMODE' WHERE `id` = '$id'";




mysql_query("UPDATE `salaryslip_extra` SET `lwp`='$lwp', `absent_days_not_approved`='$absent_days_not_approved', `createdate`='$datetime', `updatedate`='$datetime', `updatedby`='$hrmloggedid' WHERE `sid`='$id'",$con) or die(mysql_error());

mysql_query($sql,$con) or die(mysql_error());

$output = "Salary Successfully Updated";
}
header("Location: ../../employee/savesalaryslip.php?id=$id&month=$mnth&year=$cYear");
?>
