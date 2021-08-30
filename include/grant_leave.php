<?php

function getLeave($fromdate, $todate,$holiday,$expLeave,$leavetime)
{
	/*get holiday*/
	/*All dates between 2 dates*/
	$betweenDays = getDatesBetween2Dates($fromdate, $todate);
	$totalLeave = calculateLeave($betweenDays['days'],$holiday,$leavetime);
	$newResult = array("allDays"=>$betweenDays,"totalLeave"=>$totalLeave['totaleave'],"leavedate"=>$totalLeave['leavedates'],"quater"=>$totalLeave['quater']);
	return $newResult;
/*chk if saturday sun day in between*/
}

 
/*
@author Prakshi Chauhan<prakshi.chauhan@webricks.com>
@CreateDate:01-May-14
@Description:Get all dates between 2 dates
*/ 
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
	$result = array("days"=>$days);    
	return $result;
}

function calculateLeave($allLeaveday,$holidays,$leavetime)
{
	$totalLeave = count($allLeaveday);
	$h = array();
	$leaveDatee = array();
	$quater = array();
	$quaterAr = array("1"=>array("01","02","03"),"2"=>array("04","05","06"),"3"=>array("07","08","09"),"4"=>array("10","11","12"));
	foreach($allLeaveday as $val){
		$weekday = date("w", strtotime($val));
		if(in_array($val,$holidays) || $weekday == 0){
			$h[] = 0;
		}	
		else{
			$h[] = 1;
		}
		$expMonth = explode("-",$val);
		foreach($quaterAr as $key=>$value){
			if(in_array($expMonth[1],$value)){
				$quater[] = $key;
			}	
		}
	}
	$ct = count($h);
	$leaveDate = array();
	if($leavetime == 1){
		
		$ctr = 0;
		$j = 0;
		for($i=0;$i<$ct;$i++)
		{
			if($h[$i] == 1){
				$ctr ++;
				
				$leaveDate[] = $allLeaveday[$i];
			}
			else{
				$j = $i;
				break;
			}	
		}
		$m = 1;
	if($j > 0){
		$flagSet = 0;
		for($chk = $ct-1;$chk >=$j;$chk--){
			if($h[$chk] == 1)
				$flagSet = 1;
		}
		if($flagSet == 0)
			$val = $j+1;
		else
			$val = $j;	
		for($k=$ct-1;$k>=$val;$k--)
		{
			if($m == 1){
				if($h[$k] != 0){
					$leaveDate[$k] = $allLeaveday[$k];
					$ctr++;
				}
			}
			else{
				$leaveDate[$k] = $allLeaveday[$k];
				$ctr++;
			}
			$m++;
		}
	}
  }	
 else{
 	$ctr = 0;
	//print_r($h);
 	for($l=0;$l<$ct;$l++)
		{
			if($h[$l] == 1){
				$ctr++;
				//print_r($allLeaveday);
				$leaveDate[] = $allLeaveday[$l];
			}
		}
		$ctr=$ctr/2;
 } 	
$totalLeave = $ctr;
$result = array("totaleave"=>$totalLeave,"leavedates"=>$leaveDate,"quater"=>$quater);

return $result;
}
?>