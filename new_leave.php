<?php
include('include/connection.php');
$eid = 93;
$smonth = 01;
$cYear = 2014;
$query = "SELECT * FROM  `attendance` WHERE `employee` = '$eid' AND MONTH(`date`) ='$smonth' AND  YEAR(`createdate`) ='$cYear'";
$sql = mysql_query($query,$con) or die(mysql_error());
$i = 0;
$total = 0;
while($data = mysql_fetch_array($sql))
{
$chkTime = date("h:i",strtotime($data['checkin']));
$ttlHrs = $data['hourworked'];
$total += fetchAbsent($chkTime,$ttlHrs,$i)."<br/>";
$i++;
}
echo $total;
function fetchAbsent($inTime,$totalHrs,$i){
/*
@author: Prakshi Chauhan <prkshi.chauhan@webricks.com>
@created date: 24-02-2014
@Description: Calculate total number of present
*/

######### Set global variables #########
## $cons:For checkin consecutive entry of late (set value 1 for late and 0 on time)
## $month:For checking if employee is late for more than 6 times in a month (set value 1 for late)
## $monthHr:For checking if employee is working for less than 8 hours in a month should be limited to 2 days only (set value 1 for less working hour)

if(!isset($cons))
{
	global $cons;	
}	
if(!isset($month))
{
	global $month;
}	
if(!isset($monthHr))
{
	global $monthHr;
}	
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
	if($inTime >= "09:06" && $inTime <= "09:16"){
	
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
		/*Start checking if consecutive late for more than 2 days deduct salary accordingly*/
		if($chk[1] >= 6 || $counter >= 2){
			$calculateHours = calculateHours($totalHrs,$monthHr,$chkHrs,$i);
				if($calculateHours == 1)
						$workDays = 0.25;
				else
						$workDays = $calculateHours;
			}
				
							
		/*Calculation based on total hours now*/	
		else
			$workDays = calculateHours($totalHrs,$monthHr,$chkHrs,$i);
			
		$cons[$i] = 1;	##insert value in array 1 for every late	
		$month[$i] = 1;	##insert value in array 1 for every late,monthly check	
		
	}
	else if($inTime > "09:16"){
	/*If employee is late tht is exceeded 15 minutes too*/
		$calculateHours = calculateHours($totalHrs,$monthHr,$chkHrs,$i);
		if($calculateHours == 1)
			$workDays = 0.50;
		else
			$workDays = $calculateHours;
	}
	else{
	### if not late at all calculate total hours
	$workDays = calculateHours($totalHrs,$monthHr,$chkHrs,$i);
	}
		return $workDays;
}
	
	
function calculateHours($totalHrs,$monthHr,$chkHrs,$i)
{
/*
@author: Prakshi Chauhan <prkshi.chauhan@webricks.com>
@created date: 24-02-2014
@Description: Calculate total number of hours worked
*/

/*check total number of hours worked and deduct accordingly*/
if($totalHrs >= 8 && $totalHrs < 9){
	if(count($monthHr)!= 0){		
		$chkHrs = array_count_values($monthHr);
	}
	if($chkHrs[1] > 2){
		$workDays = 0.25;	
	}
	else{	
		$workDays = 1;
		$monthHr[$i] = 1;	##insert value in array 1 
	}
}
else if($totalHrs >= 4.5 && $totalHrs < 8){
	$workDays = 0.50;
}
else if($totalHrs < 4.5){
	$workDays = 0;
}
else{
	$workDays = 1;
}
return $workDays;

}	
?>