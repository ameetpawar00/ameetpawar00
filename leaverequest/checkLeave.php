<?php
include("../include/conFig.php");
include("../include/grant_leave.php");

$leaveType = $_GET['leaveType'];
$empId = $_GET['empId'];
$fromdate = $_GET['fromdate'];
$todate = $_GET['todate'];
$leavetime = $_GET['leavetime'];
$rtype = $_GET['rtype'];
$fMonth    = explode("-",$fromdate);
$tMonth    = explode("-",$todate);
$ffmonth   = $fMonth[1];
$ttmonth   = intval($tMonth[1]);
$last_month= $ttmonth;
/*
$leaveType = $_POST['leaveType'];
$empId = $_POST['empId'];
$fromdate = $_POST['fromdate'];
$todate = $_POST['todate'];
$leavetime = $_POST['leavetime'];

$leaveType = "SL";
$empId = 86;
$fromdate = "2016-10-27";
$todate = "2016-10-28";
$lrid  = 17;
$leavetime = 2;
*/


/*Get Leaves,on exploding 0index contain leave name and 1 contain 0 i.e LWP*/
$expLeave = explode("**",$leaveType);


/*Get holiday list*/
$year=date("Y");
$sqlLeave = mysql_query("SELECT `date` FROM `leavecalendar` WHERE `holidayType` = '0' AND `delete` = '0' AND `year` = '$year'",$con)or die(mysql_error());
$holiday = array();
while($fetchLeave = mysql_fetch_array($sqlLeave)){
$holiday[] = $fetchLeave[0];
}

//print_r($holiday);
$allowed = getLeave($fromdate,$todate,$holiday,$expLeave,$leavetime);
//echo "$fromdate,$todate,$holiday,$expLeave,$leavetime";
//print_r($allowed);

$leaveBal = 0;
$leaveBal_yearly = 0;

if($expLeave[0] != 'LWP'){
	$quater = $allowed['quater'];
	$lastQuater =  end($quater);
	if($expLeave[0] != 'Special' AND $expLeave[0] != 'LWP' AND $expLeave[0] != 'P' AND $expLeave[0] != 'M')
		{
			$sqlLeave = mysql_query("SELECT `".$expLeave[0]."`,`1Q".$expLeave[0]."`,`2Q".$expLeave[0]."`,`3Q".$expLeave[0]."`,`4Q".$expLeave[0]."` FROM `leaverecord` WHERE `userid` = '".$empId."' AND `delete` = '0'",$con)or die(mysql_error());
			$sqlLeave_yearly = mysql_query("SELECT `ALL`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`, `11`, `12` FROM `leaverecord_yearly` WHERE `userid` = '".$empId."' AND `delete` = '0'",$con)or die(mysql_error());
		
		
			$qLeave = array();
			$qLeave_yearly = array();
			$fetchQLeave = mysql_fetch_array($sqlLeave);
			$fetchQLeave_yearly = mysql_fetch_array($sqlLeave_yearly);
			$qLeave = array("Q1"=>$fetchQLeave[1],"Q2"=>$fetchQLeave[2],"Q3"=>$fetchQLeave[3],"Q4"=>$fetchQLeave[4]);
			$qLeave_yearly = array("1"=>$fetchQLeave_yearly[1],"2"=>$fetchQLeave_yearly[2],"3"=>$fetchQLeave_yearly[3],"4"=>$fetchQLeave_yearly[4],"5"=>$fetchQLeave_yearly[5],"6"=>$fetchQLeave_yearly[6],"7"=>$fetchQLeave_yearly[7],"8"=>$fetchQLeave_yearly[8],"9"=>$fetchQLeave_yearly[9],"10"=>$fetchQLeave_yearly[10],"11"=>$fetchQLeave_yearly[11],"12"=>$fetchQLeave_yearly[12]);
			 $totalLeaveBal = $fetchQLeave[0];
			 $totalLeaveBal_yearly = $fetchQLeave_yearly[0];
			
			for($k=1;$k<=$lastQuater;$k++){ 
				$leaveBal +=  $qLeave['Q'.$k];
			}
			for($k=1;$k<=$last_month;$k++){ 
				$leaveBal_yearly +=  $qLeave_yearly[$k];
			}

		}else{
			if($expLeave[0] != 'LWP')
				{
					$sqlLeave = mysql_query("SELECT `".$expLeave[0]."` FROM `leaverecord` WHERE `userid` = '".$empId."' AND `delete` = '0'",$con)or die(mysql_error());
					$qLeave = array();		
					$fetchQLeave = mysql_fetch_array($sqlLeave);
					$totalLeaveBal = $fetchQLeave[0];
					$leaveBal = $fetchQLeave[0];
					$leaveBal_yearly = $fetchQLeave[0];
				}
			}

}
	$totalLeave = $allowed['totalLeave'];
	$chkLeave = $leaveBal-$totalLeave;
	$chkLeave_yearly = $leaveBal_yearly-$totalLeave;
	$flag = 0;
	
	########## IF no sufficient Leave and it should not be in LWP
	if(($leaveBal == 0 OR $leaveBal_yearly==0) && $expLeave[0] != 'LWP')
		$flag = '2'.'**'.$leaveBal;
	else if(($chkLeave_yearly<0 OR $chkLeave < 0) && !isset($expLeave[1]) && $expLeave[0] != 'LWP')######## if only ltype is selected,and employee doesn't have sufficient balance,so select ltype+LWP
		$flag = '1'.'**'.$leaveBal;
	else if(count($allowed['leavedate']) < 1)
		$flag = 3;	
	else
		$flag = 0;	
//need allowed in leave date
if($flag == 0)
{
	//echo "le le bhai";	
}
else {
	echo $flag;
}
?>