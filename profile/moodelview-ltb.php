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
//echo $hrmDOJ;
$cdatee= DATE("Y-m-d");
$employeesal = mysql_query("SELECT `id`, `employee`, `month`, `year`, `basic`, `con_allow`, `spec_allow`, `other_allow`, `perf_allow`, `att_allow`, `perf_Bonus`, `train_allow`, `travel_allow`, `add_earning`, `PF`, `leave`, `workingdays`, `deduction`, `totaldays`, `present`, `absent`, `total`, `mode`, `createdate`, `updatedate`, `updatedby`, `status`, `delete`, `adjustment`, `latecomes`, `leaveBalance`, `latecomesmins` FROM `salaryslip` WHERE `employee`='$hrmloggedid' AND (createdate BETWEEN '$hrmDOJ' AND '$cdatee')",$con);
		

	//print_r($rowempsal);
	
//Array ( [0] => 11 [id] => 11 [1] => 86 [employee] => 86 [2] => 09 [month] => 09 [3] => 2016 [year] => 2016 [4] => 15200 [basic] => 15200 [5] => 800 [con_allow] => 800 [6] => 4000 [spec_allow] => 4000 [7] => 4000 [other_allow] => 4000 [8] => 2610 [perf_allow] => 2610 [9] => 0 [att_allow] => 0 [10] => 0 [perf_Bonus] => 0 [11] => 0 [train_allow] => 0 [12] => 0 [travel_allow] => 0 [13] => 0 [add_earning] => 0 [14] => 500 [PF] => 500 [15] => 3 [leave] => 3 [16] => 25 [workingdays] => 25 [17] => 907 [deduction] => 907 [18] => 30 [totaldays] => 30 [19] => 22 [present] => 22 [20] => 0 [absent] => 0 [21] => 23203 [total] => 23203 [22] => Deduct [mode] => Deduct [23] => 2016-10-27 15:00:28 [createdate] => 2016-10-27 15:00:28 [24] => 2016-10-27 15:00:28 [updatedate] => 2016-10-27 15:00:28 [25] => 728 [updatedby] => 728 [26] => 0 [status] => 0 [27] => 0 [delete] => 0 [28] => 2000 [adjustment] => 2000 [29] => 400 [latecomes] => 400 [30] => 2 [leaveBalance] => 2 [31] => (0mins) [latecomesmins] => (0mins) ) Array ( [0] => 12 [id] => 12 [1] => 86 [employee] => 86 [2] => 09 [month] => 09 [3] => 2016 [year] => 2016 [4] => 6800 [basic] => 6800 [5] => 800 [con_allow] => 800 [6] => 3400 [spec_allow] => 3400 [7] => 3000 [other_allow] => 3000 [8] => 1720 [perf_allow] => 1720 [9] => 0 [att_allow] => 0 [10] => 0 [perf_Bonus] => 0 [11] => 0 [train_allow] => 0 [12] => 0 [travel_allow] => 0 [13] => 0 [add_earning] => 0 [14] => 500 [PF] => 500 [15] => 6 [leave] => 6 [16] => 24 [workingdays] => 24 [17] => 0 [deduction] => 0 [18] => 30 [totaldays] => 30 [19] => 18 [present] => 18 [20] => 0 [absent] => 0 [21] => 15220 [total] => 15220 [22] => Add [mode] => Add [23] => 2016-10-27 16:11:07 [createdate] => 2016-10-27 16:11:07 [24] => 2016-10-27 16:11:07 [updatedate] => 2016-10-27 16:11:07 [25] => 728 [updatedby] => 728 [26] => 0 [status] => 0 [27] => 0 [delete] => 0 [28] => 0 [adjustment] => 0 [29] => 0 [latecomes] => 0 [30] => 6 [leaveBalance] => 6 [31] => 78 [latecomesmins] => 78 ) Array ( [0] => 13 [id] => 13 [1] => 86 [employee] => 86 [2] => 09 [month] => 09 [3] => 2016 [year] => 2016 [4] => 16500 [basic] => 16500 [5] => 800 [con_allow] => 800 [6] => 4000 [spec_allow] => 4000 [7] => 3700 [other_allow] => 3700 [8] => 2760 [perf_allow] => 2760 [9] => 1000 [att_allow] => 1000 [10] => 0 [perf_Bonus] => 0 [11] => 0 [train_allow] => 0 [12] => 0 [travel_allow] => 0 [13] => 0 [add_earning] => 0 [14] => 500 [PF] => 500 [15] => 0 [leave] => 0 [16] => 24 [workingdays] => 24 [17] => 0 [deduction] => 0 [18] => 30 [totaldays] => 30 [19] => 24 [present] => 24 [20] => 0 [absent] => 0 [21] => 28260 [total] => 28260 [22] => Add [mode] => Add [23] => 2016-10-27 16:19:36 [createdate] => 2016-10-27 16:19:36 [24] => 2016-10-27 16:19:36 [updatedate] => 2016-10-27 16:19:36 [25] => 728 [updatedby] => 728 [26] => 0 [status] => 0 [27] => 0 [delete] => 0 [28] => 0 [adjustment] => 0 [29] => 0 [latecomes] => 0 [30] => 0 [leaveBalance] => 0 [31] => 0 [latecomesmins] => 0 ) 

?>
<div id="myTitle">
<div class="title">LTB Calulation</div>
<div class="strip">
<span>Dashboard</span>
<span>Profile</span>
<span>LTB</span>
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
		$year=$rowempsal["year"];
		$dateObj   = DateTime::createFromFormat('!m', $month);
		$monthName = $dateObj->format('F'); // March
		//$PF=$rowempsal["PF"];
		//$PF_tot+=$rowempsal["PF"];
		//$PF_tot+=$rowempsal["PF"];
		$LTB+=2000;
		$LTB1=2000;
		echo $tab=<<<AAA
						<tr>
							<td>$countq</td>
							<td>$monthName, $year</td>
							<td>Rs. $LTB1</td>
						</tr>
AAA;


		$count++;
		$countq++;
	}


?>
	<tr>
		<td><b>Count : <?=$countq-1?></b></td>
		<td><b>No. Of Month : <?=$count?></b></td>
		<td><b>Total Amount : <?=$LTB?></b></td>
	</tr>
</table>

<?PHP
	$new = strtotime ( '+548 days' , strtotime ( $hrmDOJ ) ) ;
	$new_doj = date ( 'Y:m:d' , $new );
	$timestampa=$new_doj." 00:00:00";
	$time = strtotime($timestampa);
	$timr=humanTiming($time);
	$timra=explode(" ",$timr);
	$key_with="";
	if($timra[0]>0)
	{
		$key_with=<<<AAA
						You can withdraw Amount after $timr;					
AAA;
	}else{
		$key_with=<<<AAA
						You can withdraw Amount <button class="button green" onclick="getModule('profile/moodelview-ltb-new','manipulatemoodleContent','viewmoodleContent','');">Proceed</button>						
AAA;
		
	}
	echo $key_with;
	//echo 	$hrmDOJ;
?>