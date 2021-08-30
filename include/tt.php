<?php
function checkingAbs($smonth,$cYear,$shiftTime,$eid)
{
include("../../include/conFig.php");

	/*Calculate total leave applied 
	$sqlLeave = mysql_query("SELECT `days`  FROM  `leaverequest` WHERE `updatedby` = '$eid' AND MONTH(`fromdate`) ='$smonth' AND  YEAR(`fromdate`) ='$cYear'",$con);
	$leaveDays = 0;
	while($dataLeave = mysql_fetch_array($sqlLeave)){
		$leaveDays += $dataLeave[0];
	}
	*/
	/*Find total leave in a month and half day
	$sqlCalendar = mysql_query("SELECT `holidayType`, `inTime`, `exitTime`, `totalHours` FROM  `leavecalendar` WHERE MONTH(`date`) ='$smonth' AND  YEAR(`date`) ='$cYear'",$con);
	while($dataLeaveCalen = mysql_fetch_array($sqlCalendar)){
	if($dataLeaveCalen[1] == 0)
		//half day
	else
		//full leave	
	}
	 */
	
	/*Calculate total leave balance available */
	$smonth = '02';
	$leaveBal = 0;
	$sqlLeaveBalance = mysql_query("SELECT `leavebalance`  FROM  `leaverecord` WHERE `userid` = '$eid'",$con);
	$dataLeaveBal = mysql_fetch_array($sqlLeaveBalance);
	$leaveBal = $dataLeaveBal[0];
	/*Calculate checkin time and totalhour worked wrt employee */
	$sql = mysql_query("SELECT `checkin`,`hourworked`,`attendance`,`shifttime`,`date` FROM  `attendance` WHERE MONTH(`date`) ='$smonth' AND  YEAR(`date`) ='$cYear' AND `employee` = '$eid'",$con);
	$totalData = mysql_num_rows($sql);


	$i = 0;
	$total = 0;
	$leaveCtr = 0;
	$sunday = 0;
	while($data = mysql_fetch_array($sql)){
	/*find exact time*/
	$extTime = explode(" ",$data[0]);
	$day = strftime("%A",strtotime($extTime[0]));	
	$exp = explode(":",$extTime[1]);
	$inTime = $exp[0].":".$exp[1];
	
	/*Find Shift time*/
	$shift = $data[3];
	$expShift = explode("-",$shift);
	$shiftT = $expShift[1];
	$shiftT = str_replace("AM","",$shiftT);
	$shiftTime = trim($shiftT,"");
	/*Find Shift time*/


	/*Total hour to be completed*/
	if($day == 'Saturday'){
	$shiftTime = "10:00";
	$allowedHour = "4";
	}
	else
	$allowedHour = "9";	
	/*Total hour to be completed*/
	
	
	/*if day is sunday*/
	if($day != 'Sunday'){
	if(strlen($data[1]> 0))
		$totalHour = $data[1];
	else
		$totalHour = 0;
				
	$totalVal = fetchAbsent($inTime,$totalHour,$i,$shiftTime,$data[2],$leaveBal,$allowedHour,$day,$data[4]);
	$total += $totalVal['absentDay'];
	$leaveBal = $leaveBal - $totalVal['leave'];
	
	/*At the end simply update leave balance*/
	if($i == $totalData)
		$updateLeaveBal = mysql_query("UPDATE `leaverecord` SET `leaveBalance`= '$leaveBal' WHERE `userid`= '$eid'",$con) or die(mysql_error());
	/*At the end simply update leave balance*/

	if($data[2] == 2)
		$leaveCtr++;
	}
	else
		$sunday++;
	$i++;
	}
	return $value = array("absent" => $total,"leave" => $leaveCtr,"sunday" => $sunday);
}
function fetchAbsent($inTime,$totalHrs,$i,$shiftTime,$attType,$leaveBal,$allowedHour,$day,$datee){
/*
@author: Prakshi Chauhan <prakshi.chauhan@webricks.com>
@created date: 24-02-2014
@Description: Calculate total number of present
*/

######### Set global variables #########
## $cons:For checkin consecutive entry of late (set value 1 for late and 0 on time)
## $month:For checking if employee is late for more than 6 times in a month (set value 1 for late)
## $monthHr:For checking if employee is working for less than 8 hours in a month should be limited to 2 days only (set value 1 for less working hour)

if(!isset($cons))
	global $cons;	
if(!isset($month))
	global $month;
if(!isset($lastMonth))
	global $lastMonth;
if(!isset($monthHr))
	global $monthHr;
if(!isset($leave))
	global $leave;
	
######### Define variables #########
$chk = 0;
$chkHrs = 0;
$counter = 0;
$workDays = 0;
$calculateDays = 0;
/*If employee is late check conditions accordingly
	if consecutively late for 2 days salary deduct 0.25
	if late for more than 6 days in a month deduct 0.50	
*/

##### if on leave 
	if($attType == 2){
		$leave = $leave+1;
		##### if no leave balance 
		if($leave < 6 && $leaveBal > 0)
			$returnVal = array("totalLeave" => $leave,"absentDay" => 0);
			return $returnVal;
		}

###### add minutes in shifttime
	$acTimeStart = findDate($shiftTime,'6');
	$acTimeEnd = findDate($shiftTime,'16');
	$lastLate = findDate($shiftTime,'60');
###### if late i.e lie in 06 to 15 minutes
	if($inTime >= $acTimeStart && $inTime <= $acTimeEnd){
		$cons[$i] = 1;	##insert value in array 1 for every late	
		$month[$i] = 1;	##insert value in array 1 for every late,monthly check	

		/*Start checking if late for more than 6 days in a month*/
		if(count($month)!= 0){		
			$chk = array_count_values($month);
			}
		/*End of checking if late for more than 6 days in a month*/
		
		/*Start check consecutive entries*/
		$j = $i-2;
		if($j >= 0){
			for($k=$j;$k<=$i;$k++){
				if(isset($cons[$k]) && $cons[$k] == 1){
					$counter++;
				}
			}
		}
		/*End check consecutive entries*/


		/*Start checking if late for more than 6 times in a month deduct salary accordingly*/
		if($chk[1] > 6){
			$calculateHours = calculateHours($totalHrs,$monthHr,$chkHrs,$i);
				if($calculateHours == 0)
						$workDays = 0.25;
				else
						$workDays = $calculateHours;
			}
		/*End of checking if late for more than 6 times in a month deduct salary accordingly*/
	
	
		/*Start checking if consecutive late for more than 2 days deduct salary accordingly*/
		if($counter > 2){
			$calculateHours = calculateHours($totalHrs,$monthHr,$chkHrs,$i);
				if($calculateHours == 0)
						$workDays = 0.50;
				else
						$workDays = $calculateHours;
			}
		/*End of checking if consecutive late for more than 2 days deduct salary accordingly*/
							
		/*Calculation based on total hours now*/	
		else
			$workDays = calculateHours($totalHrs,$monthHr,$chkHrs,$i);
			
		
	}
	else if($inTime > $acTimeEnd && $inTime <= $lastLate){ 	####### If employee is late tht is exceeded 15 minutes too now he/she will be allowed 1 hr late parameter
			$lastMonth[] = 1;
				
	/* Start Checking If already late for more than 2 times then deduct salary accordingly*/	
		if(count($lastMonth)!= 0){		
			$chkLastMnth = array_count_values($lastMonth);
			}
		if($chkLastMnth[1] > 2){
			$calculateHours = calculateHours($totalHrs,$monthHr,$chkHrs,$i);
				if($calculateHours == 0)
						$workDays = 0.50;
				else
						$workDays = $calculateHours;
			}
	/* Start Checking If already late for more than 2 times then deduct salary accordingly*/			
	}	
	else if($inTime > $lastLate)  ####### late more than an hour
			$workDays = 0.50;		
	else{	####### Not late at all
	### if not late but already late for more than 2 times consecutively(15 min rule) and again not in time
	if($counter > 2 && $inTime > $shiftTime)
			$workdays = 0.50;
	### if not late at all calculate total hours
	else
		$workDays = calculateHours($totalHrs,$monthHr,$chkHrs,$i,$allowedHour,$day);
	}
	$returnVal = array("totalLeave" => $leave,"absentDay" => $workDays);
	return $returnVal;
}
	
	
function calculateHours($totalHrs,$monthHr,$chkHrs,$i,$allowedHour,$day)
{
/*
@author: Prakshi Chauhan <prakshi.chauhan@webricks.com>
@created date: 24-02-2014
@Description: Calculate total number of hours worked
*/
if(!isset($exemptTime))
	global $exemptTime;


if($totalHrs < 8:55 && $exemptTime != 0){###### if worked for more than 11 hrs calculate extra time and exempt time accordingly 
	$totalHrs = $exemptTime+$totalHrs;
}
if($totalHrs >= 8:55 && $totalHrs < 11){###### If worked 9 hrs
	$exemptTime = 0;
	$workDays = 0;
	
}
else if($totalHrs > 11){###### If worked more than 11 hrs
	$calculateHrs = floor($totalHrs-11);
	$exemptTime = $calculateHrs/2;
	$workDays = 0;
}
else{ 	##### not completed 9 hrs
	$workDays = 0.25;
}
return $workDays;

}
function findDate($time,$addMin)
{
$currentDate = strtotime($time);
$futureDate = $currentDate+(60*$addMin);
$formatDate = date("H:i:s", $futureDate);
return $formatDate;

}


?>
