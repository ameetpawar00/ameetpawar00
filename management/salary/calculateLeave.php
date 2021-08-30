<?php
function checkingAbs($smonth,$cYear,$shiftTime,$eid,$absDays)
{
include("../../include/conFig.php");

	/*Find total leave in a month and half day(market off)*/
	//echo "SELECT `holidayType`, `inTime`, `exitTime`, `totalHours`,`date` FROM  `leavecalendar` WHERE MONTH(`date`) ='$smonth' AND  YEAR(`date`) ='$cYear'";
	$sqlCalendar = mysql_query("SELECT `holidayType`, `inTime`, `exitTime`, `totalHours`,`date` FROM  `leavecalendar` WHERE MONTH(`date`) ='$smonth' AND  YEAR(`date`) ='$cYear'",$con);
	while($dataLeaveCalen = mysql_fetch_array($sqlCalendar)){
		$hDate[] = $dataLeaveCalen[4];
		$hInTime[] = $dataLeaveCalen[1];
		$hType[] = $dataLeaveCalen[0];	
		$hHours[] = $dataLeaveCalen[3];
	}
	/*Calculate total leave balance available */
	//$smonth = '03';
	//$leaveBal = 0;
	echo "SELECT `leavebalance`  FROM  `leaverecord` WHERE `userid` = '$eid'";
	$sqlLeaveBalance = mysql_query("SELECT `leavebalance`  FROM  `leaverecord` WHERE `userid` = '$eid'",$con) or die(mysql_error());
	if(mysql_num_rows($sqlLeaveBalance) > 0)
	{
	$dataLeaveBal = mysql_fetch_array($sqlLeaveBalance);
	echo $leaveBal = $dataLeaveBal[0];
	}
	if($absDays >= $leaveBal && $leaveBal != 0)
	{
		$newAbsDays = $leaveBal-1.5;
		$newLeaveBal = $leaveBal-1.5;
	}
	$returnVal = array("newAbsDays" => $newAbsDays, "newLeaveBal" => $newLeaveBal);
	return $returnVal;
}
?>