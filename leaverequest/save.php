<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
$travelid = $_GET['travelid'];


$year=date("Y");

	$dataHoliday = mysql_query("SELECT `date`  FROM `leavecalendar` where `year` = '$year' AND `holidayType`='0'",$con) or die(mysql_error());
	$holidayArr = array();
	while($rowChkHolid = mysql_fetch_array($dataHoliday)){
		$holidayArr[] = $rowChkHolid[0];
		}



function getDatesBetween2Dates($startTime, $endTime) {
	$day = 86400;
	$format = 'Y-m-d';
	$startTime = strtotime($startTime);
	$endTime = strtotime($endTime);
	$numDays = round(($endTime - $startTime) / $day) + 1;
	$days = array();    
	for ($i = 0; $i < $numDays; $i++) {
	    $days[] = date($format, ($startTime + ($i * $day)));
	}
	    
	return $days;
}

foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}

$flag = 0;
$convertFdate = strtotime($post[1]);
$convertTdate = strtotime($post[2]);
$todayDate = strtotime(date("Y-m-d"));

$dateArr = array();
$dateArr = getDatesBetween2Dates($post[1],$post[2]) ;
$flag = 0;
$h = array();
foreach($dateArr as $val){
	$weekday = date("w", strtotime($val));
	if($weekday == 0 || in_array($val,$holidayArr)){
		$h[] = 0;
	}
	else{
		$h[] = 1;
	}
}

$totalArr = array_count_values($h);
if($totalArr[1] < 1){
	$flag = 1;
	$msg = "No working days selected";
}else if($convertTdate < $convertFdate){
	$flag = 1;
	$msg = "To date can not be smaller then from date";
}
else{
	$dataChk = mysql_query("SELECT `fromdate`,`todate` FROM `leaverequest` where `updatedby` = '$hrmloggedid' AND `status` != '2' AND `delete` != '1'",$con) or die(mysql_error());
	$arrayDate = array();
	while($rowChk = mysql_fetch_array($dataChk))
		$arrayDate[] = getDatesBetween2Dates($rowChk[0],$rowChk[1]);

	$arrayDate1 = array();
	foreach($arrayDate as $value)
	{
		foreach($value as $val)
		{
			$arrayDate1[] = $val;
		}

	}
		$newArray = getDatesBetween2Dates($post[1],$post[2]);
		$exist = 0;	
		foreach($newArray as $val)
		{
			if(in_array($val,$arrayDate1))
			{
				$exist = 1;
				$value = $val;
				break;
			}
		}
	if($exist != 1){
		mysql_query("INSERT INTO `leaverequest`(`leavetype`, `leavetime`, `days`, `fromdate`, `todate`, `description`, `createdate`, `updatedate`, `updatedby`) VALUES ('$post[4]','$post[0]', '$post[5]', '$post[1]', '$post[2]', '$post[3]', '$datetime', '$datetime', '$hrmloggedid')",$con) or die(mysql_error());
		$lid = mysql_insert_id();
		
	
		if($post[0] == 1)
			$ee= "Full Day Leave";
		else if($post[0] == 2)
			$ee= "First Half Leave";
		else
			$ee= "Second Half Leave";		
		
		
		$note="Applied For $post[4] ($ee) for $post[5] days From  $post[1] To $post[2] for $post[3] Reason";
		
		mysql_query("INSERT INTO `story`(`subject`, `note`, `employee`, `type`, `updatedby`, `lrid`) VALUES ('Applied For $post[4]', '$note', '$hrmloggedid', 3, '$hrmloggedid', '$lid')",$con) or die(mysql_error());
		
		
		
		
		
		//$getData = mysql_query("SELECT leaverequest.id, leaverequest.days, leaverequest.fromdate, leaverequest.todate, leaverequest.updatedate, leaverequest.updatedby, leavetype.name, leaverequest.status, leaverequest.leavetime from leaverequest, leavetype where leaverequest.delete = '0' and leaverequest.leavetype=leavetype.id and leaverequest.updatedby = '$hrmloggedid' AND leaverequest.id ='$lid' ",$con) or die(mysql_error());
		//$row = mysql_fetch_array($getData);
		$msg = "Leave Request Successfully Sent";
	}
	else{
			$msg = "Already Applied for this leave ".$value;
			$flag = 1;
		}
}
	
	
if(	$flag == 1){?>
<?php echo $msg;?>
<?php
}
else
{?>
<?php echo $msg;?>
<?php
}?>
BRzEAKSTRINGFORSAVEDATALEAVE