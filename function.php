<?php
function getHour($date1,$date2)
{
//define("SECONDS_PER_HOUR", 60*60);
$dateDiff = strtotime($date2) - strtotime($date1);
$fullDays    = floor($dateDiff/(60*60*24));   
$fullHours   = floor(($dateDiff-($fullDays*60*60*24))/(60*60));   
$fullMinutes = floor(($dateDiff-($fullDays*60*60*24)-($fullHours*60*60))/60);      
$returnData = $fullHours.":".$fullMinutes;
return $returnData;
}
?>