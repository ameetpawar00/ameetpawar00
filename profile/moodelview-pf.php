<?php
include("../include/conFig.php");
							
function humanTiming ($time)
{

    $time = $time-time(); // to get the time since that moment
    $time = ($time<1)? 1 : $time;
    $tokens = array (
        86400 => 'day'
    );

    foreach ($tokens as $unit => $text) {
       // if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }

}
error_reporting(0);
$cdatee= DATE("Y-m-d");
$employeesal = mysql_query("SELECT `id`, `employee`, `month`, `year`, `basic`, `con_allow`, `spec_allow`, `other_allow`, `perf_allow`, `att_allow`, `perf_Bonus`, `train_allow`, `travel_allow`, `add_earning`, `PF`, `leave`, `workingdays`, `deduction`, `totaldays`, `present`, `absent`, `total`, `mode`, `createdate`, `updatedate`, `updatedby`, `status`, `delete`, `adjustment`, `latecomes`, `leaveBalance`, `latecomesmins` FROM `salaryslip` WHERE `employee`='$hrmloggedid' AND (createdate BETWEEN '$hrmDOJ' AND '$cdatee')",$con);
		

//print_r($rowempsal);


?>
<div id="myTitle">
<div class="title">PF Calulation</div>
<div class="strip">
<span>Dashboard</span>
<span>Profile</span>
<span>PF</span>
<span>View</span>
</div>
</div>
<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
</td>
</tr>
</table>
<div style="height:400px;overflow-x:hidden;overflow-y:scroll" id="mainDivId">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable" border="1" style="text-align:center">
	<tr>
		<th>No.</th>
		<th>Month</th>
		<th>Amount</th>
	</tr>
<?php
$count=0;
$countq=1;
while($rowempsal = mysql_fetch_array($employeesal))
	{
		$month=$rowempsal["month"];
		$dateObj   = DateTime::createFromFormat('!m', $month);
		$monthName = $dateObj->format('F'); // March
		$year=$rowempsal["year"];
		$PF=$rowempsal["PF"];
		$PF_tot+=$rowempsal["PF"];
		echo $tab=<<<AAA
						<tr>
							<td>$countq</td>
							<td>$monthName, $year</td>
							<td>Rs. $PF *2</td>
						</tr>
AAA;
		$count++;
		$countq++;
	}
?>
	<tr>
		<td><b>Count : <?=$countq-1?></b></td>
		<td><b>No. Of Month : <?=$count?></b></td>
		<td><b>Total Amount : <?=$PF_tot*2?></b></td>
	</tr>
</table>
<?PHP
	$new = strtotime ( '+365 days' , strtotime ( $hrmDOJ ) ) ;
	$new_doj = date ( 'Y:m:d' , $new );
	$timestampa=$new_doj." 00:00:00";
	$time = strtotime($timestampa);
	$timr=humanTiming($time);
	$timra=explode(" ",$timr);
	$key_with="";
//	echo $timra[0];
	if($timra[0]>0)
	{
		$key_with=<<<AAA
					You can withdraw Amount after $timr;							
AAA;
	}else{
		$key_with=<<<AAA
						You can withdraw Amount <button class="button green" onclick="getModule('profile/moodelview-pf-new','manipulatemoodleContent','viewmoodleContent','');">Proceed</button>					
AAA;
	}
	echo $key_with;
	//echo 	$hrmDOJ;
?>