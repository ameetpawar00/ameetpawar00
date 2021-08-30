<?php
include("../include/connection.php");
include('../include/function.php');
if(isset($_GET['id']))
{
$month = $_GET['month'];
$year = $_GET['year'];
$salId = $_GET['id'];

$getSalary = mysql_query("SELECT * FROM  `salaryslip` where `id` = '$salId' AND `month` = '$month' AND `year` = '$year'",$con) or die(mysql_error());
$rowSal = mysql_fetch_array($getSalary);
$employee = $rowSal['employee'] ;

$empSql = "select employee.id,employee.name,employee.empid,employee.doj,employee.accountno,employee.pfaccount,employee.bank,designation.name,employee.salaryId from employee,designation where employee.id = '$employee' and employee.designation = designation.id";
$getEmp = mysql_query($empSql,$con)or die(mysql_error());
$rowEmp = mysql_fetch_array($getEmp);
//Month Salary Details 
//echo "SELECT * FROM  `salaryslip` where `id` = '$salId' AND `month` = '$month' AND `year` = '$year'";

$getbasic= $rowSal['basic'] ;
$getcon_allow= $rowSal['con_allow'] ;
$getspec_allow= $rowSal['spec_allow'] ;
$getother_allow= $rowSal['other_allow'] ;
$getperf_allow= $rowSal['perf_allow'];
$getatt_allow= $rowSal['att_allow'];
$getperf_Bonus= $rowSal['perf_Bonus'];
$gettrain_allow= $rowSal['train_allow'] ;
$gettravel_allow= $rowSal['travel_allow'];
$getadd_earning= $rowSal['add_earning'] ;
$getPF= $rowSal['PF'] ;
$gettotal = $rowSal['total'] ;
$getmode = $rowSal['mode'] ;
$adjustment = $rowSal['adjustment'];
$workingdays= $rowSal['workingdays'] ;
$totaldays= $rowSal['totaldays'] ;
$present= $rowSal['present'] ;
$mDeduct = $rowSal['deduction'];

$totalAbsent = ($workingdays - $present);

$finalSalslip = $getbasic + $getcon_allow + $getspec_allow + $getother_allow + $getperf_allow + $getatt_allow;

$getStarting = mysql_query("SELECT * FROM `salary` WHERE `id` = '$rowEmp[8]' AND `delete` = '0' AND `increment` = '0'",$con) or die(mysql_error());
$rowStarting = mysql_fetch_array($getStarting);

$kpiname = array();
$kpipoint = array();

$getKPIpoint = mysql_query("SELECT kpi.marks,kpiparameters.maximum,kpiparameters.name FROM kpi,kpiparameters WHERE kpi.employee = '$employee' AND kpi.month = '$month' AND kpi.kpiparameter = kpiparameters.id AND kpiparameters.delete = '0'",$con) or die(mysql_error());
while($rowKPIpoint = mysql_fetch_array($getKPIpoint))
{
	$obtainkpi += $rowKPIpoint[0];
	$Maxkpi += $rowKPIpoint[1];
	$kpiname[] = $rowKPIpoint[2];
	$kpipoint[] = $rowKPIpoint[0];
}
foreach($kpiname as $key => $valname)
{
	$kpitr .= '<tr><td>'.$kpiname[$key].'</td><td>'.$kpipoint[$key].'</td></tr>';
}
$average = ($obtainkpi/$Maxkpi)*100;

$basic= $rowStarting['basic'];
$con_allow= $rowStarting['con_allow'];
$spec_allow= $rowStarting['spec_allow'] ;
$other_allow= $rowStarting['other_allow'] ;
$perf_allow= $rowStarting['perf_allow'];
$att_allow= $rowStarting['att_allow'];
$perf_Bonus= $rowStarting['perf_Bonus'];
$train_allow= $rowStarting['train_allow'] ;
$travel_allow= $rowStarting['travel_allow'] ;
$add_earning= $rowStarting['add_earning'] ;
$PF= $rowStarting['PF'] ;

$kpiamount =  $perf_allow-$getperf_allow;
$finalSal = $basic + $con_allow + $spec_allow + $other_allow + $perf_allow + $att_allow;
$basicdeduct = $mDeduct-$rowSal['latecomes'];
$basicdeduct = $basic-$basicdeduct;
//$finalSal = $rowSal['total'];
$finalDeduc = $finalSal-$finalSalslip;
$finalDeduc = str_ireplace('-','',$finalDeduc);

$finalDeduc = $finalDeduc+$mDeduct+$PF;

$compSal = $finalSal-$finalDeduc;
$salInWord = no_to_words($gettotal);

$pdfName = $rowEmp[1]."_Salaryslip_For_Month_".strtoupper(date("F", mktime(0, 0, 0,  $rowSal['month'], 10))).".pdf";
}

$slipHtml .='<div style="width:100%;background: #eee;">
<head>
<style>
body{
	font-family:Tahoma,Arial, Helvetica, sans-serif;font-size:11px;}

td{border: solid 1px #000;padding: 5px;}
th{border: solid 1px #000}
tr{}
</style>
</head>

<body>
<head>

</head>
<table cellpadding="0" cellspacing="0"  width="890" align="center" style="background:#fff">

<tr>
<th colspan="5"><div style="width:90%;background:#fff;text-align:center;height:100px;color:#000000;line-height: 1.4em">
	 <img src="http://www.trifidresearch.com/images/logo.png" alt="" width="150" style="margin: 0px;">	<br>
  Trifid Research Pvt. Ltd.</div></th>
</tr>


<tr>
<th colspan="5">Pay Slip '.(date("F", mktime(0, 0, 0,  $rowSal['month'], 10))).'-'.$year.'</th>
</tr>

<tr>
<td colspan="5">&nbsp;</td>
</tr>

<tr>
<td colspan="5">&nbsp;</td>
</tr>

<tr>
<th width="277"> Employee Code</th>
<td colspan="2">'.$rowEmp[2].'</td>
<th width="200">Working Days</th>
<td width="76">'.$workingdays.' </td>
</tr>

<tr>
<th> Employee Name</th>
<td colspan="2">'.$rowEmp[1].'</td>
<th>Present Days</th>
<td>'.$present.'</td>
</tr>


<tr>
<th>Designation</th>
<td colspan="2">'.$rowEmp[7].'</td>
<th>Pay Days</th>
<td>'.$present.'</td>
</tr>

<tr>
<th>Bank A/C No.</th>
<td colspan="2">'.$rowEmp[4].'</td>
<th> Approved Absent days</th>
<td>'.$rowSal['leave'].'</td>
</tr>

<tr>
<th>Late Coming Minutes</th>
<td colspan="2">'.$rowSal['latecomesmins'].'</td>
<th> Not Approved Absent days</th>
<td>'.$rowSal['absent'].'</td>
</tr>


<tr>
<th>Late Coming Deduction</th>
<td colspan="2">'.$rowSal['latecomes'].'</td>
<th>Total number of Absent Days</th>
<td>'.$totalAbsent.'</td>
</tr>

<tr>
<th></th>
<td colspan="2"></td>
<th> LWP</th>
<td>Nil</td>
</tr>

<tr>
<th>Earnings</th>
<th> Monthly Value</th>
<th>Amount</th>
<td colspan="2" rowspan="13" valign="top"  style="padding: 0;">
<table cellpadding="0" cellspacing="0" width="100%">
<tr><th>KPI</th><th>Monthly Variable</th></tr>'.$kpitr.'<tr>
<th> Total</th>
<td>'.$obtainkpi.'</td>
</tr>
</table>

</td>
</tr>

<tr>
<td>Basic</td>
<td>'.$basicdeduct.'</td>
<td>'.$getbasic.'</td>
</tr>



<tr>
<td>Conveyance Allowance</td>
<td>'.$con_allow.'</td>
<td>'.$getcon_allow.'</td>
</tr>

<tr>
<td>Special Allowance</td>
<td>'.$spec_allow.'</td>
<td>'.$getspec_allow.'</td>
</tr>

<tr>
<td>Other Allowance</td>
<td>'.$other_allow.'</td>
<td>'.$getother_allow.'</td>

</tr>

<tr>
<td>Performance Allowance</td>
<td>'.$perf_allow.'</td>
<td>'.$getperf_allow.'</td>
</tr>


<tr>
<td>Attendance Allowance</td>
<td>'.$att_allow.'</td>

<td>'.$getatt_allow.'</td>
</tr>

<tr>
<td>Performance Bonus</td>
<td>'.$perf_Bonus.'</td>
<td>'.$getperf_Bonus.'</td>

</tr>

<tr>
<td>Training Allowance</td>
<td>'.$train_allow.'</td>
<td>'.$gettrain_allow.'</td>

</tr>

<tr>
<td>Travelling Allowance</td>
<td>'.$travel_allow.'</td>
<td>'.$gettravel_allow.'</td>
</tr>


<tr>
<td>Additional Earnings</td>
<td>'.$add_earning.'</td>

<td>'.$getadd_earning.'</td>
</tr>


<tr>
<td>Leave Encashment</td>
<td>NA</td>
<td>NA</td>
</tr>

<tr>
<td colspan="3">&nbsp;</td>
</tr>

<tr>
<td colspan="5" style="padding: 0;">
<table width="100%"  cellpadding="0" cellspacing="0">

<tr>
<th width="22%">Deductions</th>
<th width="18%">Total Value</th>

<th width="12%"> MTD</th>
<th width="25%">Company Contribution</th>
<th width="15%">Total Value</th>
<th width="8%"> MTD</th>
</tr>


<tr>
<td>ESIC</td>
<td>NA</td>
<td>&nbsp; </td>
<td>Provident Fund</td>
<td>'.$PF.'</td>
<td>'.$getPF.'</td>
</tr>


<tr>
<td>Provident Fund</td>
<td>'.$PF.'</td>
<td>'.$getPF.'</td>
<td>LT Benefits</td>
<td>6000</td>
<td> 2000</td>
</tr>


<tr>
<td>TDS</td>
<td>NA</td>
<td>&nbsp; </td>
<td>Leave</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td>Adjustment ('.$getmode.')</td>
<td colspan="5">'.$adjustment.' </td>

</tr>

<tr>
<td> Gross Salary</td>

<td colspan="5">'.$finalSal.'</td>
</tr>


<tr>
<td>Total Deduction</td>

<td colspan="5">'.$finalDeduc.'</td>
</tr>


<tr>
<th>Net Salary</th>

<td colspan="5"><strong>'.$gettotal.'</strong></td>
</tr>

<tr>
<td> Net Pay in Words</td>

<td colspan="5">'.$salInWord.'</td>
</tr>

<tr>
<td colspan="2">Total Retained Earnings Till Date</td>

<td colspan="4">Nine Thousand</td>
</tr>








</table>

</td>
</tr>

</table>

</body>
	</div>';
	//echo "UPDATE `salaryslip` SET `slip`='$slipHtml' WHERE `id`  = '$salId'";
mysql_query("UPDATE `salaryslip` SET `slip`='$slipHtml' WHERE `id`  = '$salId'",$con) or die(mysql_error());
 //echo $slipHtml ;
