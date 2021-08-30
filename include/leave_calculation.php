<?php
function checkin_cal($empid,$smonth,$cYear)
{
include("../../include/conFig.php");
$sql= "SELECT `checkin` FROM  `attendance` WHERE MONTH(`createdate`) ='$smonth' AND  YEAR(`createdate`) ='$cYear' AND `employee` = '$empid' AND `attendance` != '2'";
$query = mysql_query($sql,$con) or die(mysql_error());
while($result = mysql_fetch_array($query))
{
$checkIn[] .= $result[0];
}
return $checkIn;
}

function total_absent($val)
	{
	$lateComing = 0;
	$fulLeave = 0;
	$hlfLeave = 0;
	$halfDeduct = 0;
	$fullDeduct = 0;
	$lateDeduct = 0;
	$ttlAbs = 0;
	$time1 = '09:25';
	$time2 ='10:30';
	$time3 ='14:00';
	foreach($total_attend as $valChekin)
	{
		if($valChekin != "")
		{
		$chkTime = date("h:i",strtotime($valChekin));
		 if($chkTime > $time1 )
		 {
			$lateComing++;
		 	if($lateComing > 10)
			{
			$lateDeduct = $lateDeduct+1;
			$lateComing = 0;
			}
		 }
		 if($chkTime > $time2)
		 {
		 $halfDeduct = $halfDay+(0.5);
		 $hlfLeave++;
		 }
		 
		 if($chkTime > $time3)
		 {
		 $fullDeduct = $fullDeduct+1;
		 $fulLeave++;
		 }
	 }
	}
	
	$ttlAbs = $lateDeduct+$halfDeduct+$fullDeduct;
return $ttlAbs;
}
?>