<?php
include("../include/conFig.php");
error_reporting(0);
$cyear=date("Y");
$employeelt = mysql_query("SELECT `id`, `date`, `leave`, `empid`, `ltype`, `delete`, `createdate`, `updatedate`, `lr_id` FROM `allleavestat` WHERE `empid`='$hrmloggedid' AND YEAR(`createdate`)='$cyear' ORDER BY `date` DESC",$con);
?>
<div id="myTitle">
<div class="title">Leaves Taken</div>
<div class="strip">
<span>Dashboard</span>
<span>Profile</span>
<span>Leaves Taken</span>
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
		<th>date</th>
		<th>Amount</th>
	</tr>
	
<?php
$count=0;
$countq=1;
while($rowemplt = mysql_fetch_array($employeelt))
	{
		$date=$rowemplt["date"];
		$ltype=$rowemplt["ltype"];
		
		echo $tab=<<<AAA
						<tr>
							<td>$countq</td>
							<td>$date</td>
							<td>$ltype</td>
						</tr>
AAA;


		$count++;
		$countq++;
	}


?>
</table>