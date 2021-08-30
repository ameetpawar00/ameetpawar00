<?php
include("../include/connection.php");
include('../include/function.php');
if(isset($_GET['id']))
{
$month = $_GET['month'];
$year = $_GET['year'];
$salId = $_GET['id'];

$getSalary = mysql_query("SELECT * FROM  `salaryslip` where `id` = '$salId' AND `month` = '$month' AND `year` = '$year'",$con) or die(mysql_error());
$rowSal = mysql_fetch_assoc($getSalary);
$employee = $rowSal['employee'] ;
//print_r($rowSal);
$empSql = "select employee.id,employee.name,employee.empid,employee.doj,employee.accountno,employee.pfaccount,employee.bank,designation.name,employee.salaryId,department.name,employee.PAN_NO,bank.name from employee,designation,department,bank where employee.id = '$employee' and employee.designation = designation.id and employee.bank = bank.id and employee.department = department.id";
$getEmp = mysql_query($empSql,$con)or die(mysql_error());
$rowEmp = mysql_fetch_array($getEmp);
//Month Salary Details 
//echo "SELECT * FROM  `salaryslip` where `id` = '$salId' AND `month` = '$month' AND `year` = '$year'";

$getbasic= $rowSal['basic'];
$getcon_allow= $rowSal['con_allow'];
$getspec_allow= $rowSal['spec_allow'];
$getother_allow= $rowSal['other_allow'];
$getperf_allow= $rowSal['perf_allow'];
$getatt_allow= $rowSal['att_allow'];
$getperf_Bonus= $rowSal['perf_Bonus'];
$gettrain_allow= $rowSal['train_allow'];
$gettravel_allow= $rowSal['travel_allow'];
$getadd_earning= $rowSal['add_earning'];
$getPF= $rowSal['PF'];
$gettotal = $rowSal['total'];
$gettotala=$gettotal+$getPF;
$getmode = $rowSal['mode'];
$adjustment = $rowSal['adjustment'];
$workingdays= $rowSal['workingdays'];
$totaldays= $rowSal['totaldays'];
$present= $rowSal['present'];
$absent= $rowSal['absent'];
$leave= $rowSal['leave'];
$mDeduct = $rowSal['deduction'];
$TDS = $rowSal['TDS'];
if($TDS=='')
{
	$TDS=0;
}
$TMODE = $rowSal['TMODE'];

$totalAbsent = ($workingdays - $present);

$finalSalslip = $getbasic + $getcon_allow + $getspec_allow + $getother_allow + $getperf_allow + $getatt_allow;

$getStarting = mysql_query("SELECT * FROM `salary` WHERE `id` = '$rowEmp[8]' AND `delete` = '0' AND `increment` = '0'",$con) or die(mysql_error());
$rowStarting = mysql_fetch_array($getStarting);

$kpiname = array();
$kpimax = array();
$kpipoint = array();

$getKPIpoint = mysql_query("SELECT kpi.marks,kpiparameters.maximum,kpiparameters.name FROM kpi,kpiparameters WHERE kpi.employee = '$employee' AND kpi.month = '$month' AND kpi.kpiparameter = kpiparameters.id AND kpi.year = '$year' AND kpiparameters.delete = '0'",$con) or die(mysql_error());
while($rowKPIpoint = mysql_fetch_array($getKPIpoint))
{
	$obtainkpi += $rowKPIpoint[0];
	$Maxkpi += $rowKPIpoint[1];
	$kpiname[] = $rowKPIpoint[2];
	$kpimax[] = $rowKPIpoint[1];
	$kpipoint[] = $rowKPIpoint[0];
}
$ccountter=0;

foreach($kpiname as $key => $valname)
{
	$kpitr .= '<tr><td>'.$kpiname[$key].'</td><td>'.$kpipoint[$key].'</td><td>'.$kpimax[$key].'</td></tr>';
$ccountter++;
}
$average = round(($obtainkpi/$Maxkpi)*100);

$basic= $rowStarting['basic'];
$con_allow= $rowStarting['con_allow'];
$spec_allow= $rowStarting['spec_allow'];
$other_allow= $rowStarting['other_allow']; 
$perf_allow= $rowStarting['perf_allow'];
$att_allow= $rowStarting['att_allow'];
$perf_Bonus= $rowStarting['perf_Bonus'];
$train_allow= $rowStarting['train_allow'];
$travel_allow= $rowStarting['travel_allow'];
$add_earning= $rowStarting['add_earning'];
$PF= $rowStarting['PF'];
$esice= $rowStarting['esice'];
$esicc= $rowStarting['esicc'];

$kpiamount =  $perf_allow-$getperf_allow;
$finalSal = $basic + $con_allow + $spec_allow + $other_allow + $perf_allow + $att_allow;
$basicdeduct = $mDeduct-$rowSal['latecomes'];
$basicdeduct = $basic-$basicdeduct;
//$finalSal = $rowSal['total'];
 $finalDeduc = $finalSal-$finalSalslip;
$finalDeduc = str_ireplace('-','',$finalDeduc);
if($getmode=="Add")
{
	$finalDeduc = $finalDeduc+$mDeduct+$PF+$TDS-$adjustment;
}else{
	$finalDeduc = $finalDeduc+$mDeduct+$PF+$TDS+$adjustment;
	
}
$bfval=$rowSal['latecomes']+$PF+$TDS;
$finalDeducion=$finalDeduc-$kpiamount;
$finalDeduciona=$finalDeduc-$kpiamount-$mDeduct-$PF;
$gettotala=$gettotala+$finalDeduciona;
$gettotala=$basicdeduct+$getadd_earning+$getcon_allow+$getspec_allow+$gettravel_allow+$getother_allow+$getperf_allow+$getatt_allow+$getperf_Bonus+$gettrain_allow;
$gettotalad=$getbasic+$add_earning+$con_allow+$spec_allow+$travel_allow+$other_allow+$perf_allow+$att_allow+$perf_Bonus+$train_allow;
$compSal = $finalSal-$finalDeduc;
$salInWord = no_to_words($gettotal);

$pdfName = $rowEmp[1]."_Salaryslip_For_Month_".strtoupper(date("F", mktime(0, 0, 0,  $rowSal['month'], 10))).".pdf";
}

				
	$getStartings = mysql_query("SELECT * FROM `salaryslip_extra` WHERE `employee` = '$employee' AND `sid` = '$salId'",$con) or die(mysql_error());
	$rowpost = mysql_fetch_array($getStartings);		
	$absent_days_not_approved = $rowpost['absent_days_not_approved'];
	$lwp = $rowpost['lwp'];
	
	$esice= $rowpost['esice'] ;
	$esiceamount=(($gettotala*$esice)/100);
	$esicc= $rowpost['esicc'] ;
	$esiccamount=(($gettotala*$esicc)/100);
	$pfcamount = $rowpost['pfcamount'];
	$pt = $rowpost['pt'];
	
$slipHtml .='
<head>
<style>
body{
	font-family:Tahoma,Arial, Helvetica, sans-serif;font-size:11px;}

td{padding: 5px;}
th{text-align: left;
padding-left: 5px;}
.txac,td{text-align: center;}
.txal{text-align: left;
padding-left: 5px;}


table{
     table-layout: fixed;
    background:#fff;
    margin: 20px auto;
    font-size: 12px;
}

th, td {
   
    width: 100%;
}
tr.bkcolor{
				background: #DDD;
			}
</style>
</head>

<body oncontextmenu="return false" onselectstart="return false" ondragstart="return false">

<div style="width:100%;">
<table cellpadding="0" cellspacing="0"  width="100%" align="center" border="1">

	<tr>
		<th colspan="8">
			<div style="width:100%;background:#fff;text-align:center;height:100%;color:#000000;line-height: 1.4em">
	 				<span style="font-size: 12px;">
  						TRIFID RESEARCH- Investment Advisor 
  						<br>First Floor, Saket Tower Plot No 3-A, Ratlam Kothi, AB Road, Near Geeta Bhawan Square, Indore - 452001
  						<br>( Confidential For Internal use only )
  					</span>
 			</div>
 		</th>
	</tr>
	<tr class="bkcolor">
		<th colspan="8" class="txac">
			'.(date("F", mktime(0, 0, 0,  $rowSal['month'], 10))).'-'.$year.'
		</th>
	</tr>
	<tr>
		<th colspan="2"> Employee Code</th>
		<td colspan="2">'.$rowEmp[2].'</td>
		<th colspan="2">Working Days</th>
		<td colspan="2">'.$workingdays.' </td>
	</tr>
	<tr>
		<th colspan="2"> Employee Name</th>
		<td colspan="2">'.$rowEmp[1].'</td>
		<th colspan="2">Total number of Absent Days</th>
		<td colspan="2">'.$rowSal['absent'].'</td>
	</tr>
	<tr>
		<th colspan="2">Designation</th>
		<td colspan="2">'.$rowEmp[7].'</td>
		<th colspan="2">Approved Absent days</th>
		<td colspan="2">'.$leave.'</td>
	</tr>
	<tr>
		<th colspan="2">Department</th>
		<td colspan="2">'.$rowEmp[9].'</td>
		<th colspan="2"> Approved Absent days (LWP)</th>
		<td colspan="2">'.$lwp.'</td>
	</tr>
	<tr>
		<th colspan="2">PAN Card Number</th>
		<td colspan="2">'.$rowEmp[10].'</td>
		<th colspan="2"> Not Approved Absent days (LWP)</th>
		<td colspan="2">'.$absent_days_not_approved.'</td> 
	</tr>
	<tr>
		<th colspan="2">Bank Name</th>
		<td colspan="2">'.$rowEmp[11].'</td>
		<th colspan="2">Late Coming Minutes</th>
		<td colspan="2">'.$rowSal['latecomesmins'].' mins</td>
	</tr>
	<tr>
		<th colspan="2">Bank Account Number</th>
		<td colspan="2">'.$rowEmp[4].'</td>
		<th colspan="2">Late Coming Deduction</th>
		<td colspan="2">'.$rowSal['latecomes'].'</td>
	</tr>
	<tr class="bkcolor">
		<th colspan="2" class="txac ">Salary Component</th>
		<th class="txac"> Monthly Value</th>
		<th class="txac">Monthly Variable</th>
		<th colspan="2" class="txac">KPI**</th>
		<th class="txac">Monthly Value</th>
		<th class="txac">Monthly Variable</th>
	</tr>
	<tr>
		<td colspan="2" class="txal">Basic</td>
		<td>'.$getbasic.'</td>
		<td>'.$basicdeduct.'***</td>
		<td colspan="2" class="txal">'.$kpiname[0].'</td>
		<td>'.$kpimax[0].'</td>
		<td>'.$kpipoint[0].'</td>	
	</tr>
	<tr>
		<td colspan="2" class="txal">HRA</td>
		<td>'.$add_earning.'</td>
		<td>'.$getadd_earning.'</td>
		<td colspan="2" class="txal">'.$kpiname[1].'</td>
		<td>'.$kpimax[1].'</td>
		<td>'.$kpipoint[1].'</td>	
	</tr>
	<tr>
		<td colspan="2" class="txal">Conveyance Allowance</td>
		<td>'.$con_allow.'</td>
		<td>'.$getcon_allow.'</td>
		<td colspan="2" class="txal">'.$kpiname[2].'</td>
		<td>'.$kpimax[2].'</td>
		<td>'.$kpipoint[2].'</td>	
	</tr>
	<tr>
		<td colspan="2" class="txal">Special Allowance</td>
		<td>'.$spec_allow.'</td>
		<td>'.$getspec_allow.'</td>
		<td colspan="2" class="txal">'.$kpiname[3].'</td>
		<td>'.$kpimax[3].'</td>
		<td>'.$kpipoint[3].'</td>	
	</tr>
	<tr>
		<td colspan="2" class="txal">Mobile Allowance</td>
		<td>'.$travel_allow.'</td>
		<td>'.$gettravel_allow.'</td>
		<td colspan="2" class="txal">'.$kpiname[4].'</td>
		<td>'.$kpimax[4].'</td>
		<td>'.$kpipoint[4].'</td>	
	</tr>
	<tr>
		<td colspan="2" class="txal">Other Allowance</td>
		<td>'.$other_allow.'</td>
		<td>'.$getother_allow.'</td>
		<td colspan="2" class="txal">'.$kpiname[5].'</td>
		<td>'.$kpimax[5].'</td>
		<td>'.$kpipoint[5].'</td>	
	</tr>
	<tr>
		<td colspan="2" class="txal">KPI**</td>
		<td>'.$perf_allow.'</td>
		<td>'.$getperf_allow.'</td>
		<td colspan="2" class="txal">'.$kpiname[6].'</td>
		<td>'.$kpimax[6].'</td>
		<td>'.$kpipoint[6].'</td>	
	</tr>
	<tr>
		<td colspan="2" class="txal">Attendance Allowance</td>
		<td>'.$att_allow.'</td>
		<td>'.$getatt_allow.'</td>
		<td colspan="2" class="txal">'.$kpiname[7].'</td>
		<td>'.$kpimax[7].'</td>
		<td>'.$kpipoint[7].'</td>	
	</tr>
	<tr>
		<td colspan="2" class="txal">Performance Bonus</td>
		<td>'.$perf_Bonus.'</td>
		<td>'.$getperf_Bonus.'</td>
		<td colspan="2" class="txal">'.$kpiname[8].'</td>
		<td>'.$kpimax[8].'</td>
		<td>'.$kpipoint[8].'</td>	
	</tr>
	<tr>
		<td colspan="2" class="txal">Training Allowance</td>
		<td>'.$train_allow.'</td>
		<td>'.$gettrain_allow.'</td>
		<td colspan="2" class="txal">'.$kpiname[9].'</td>
		<td>'.$kpimax[9].'</td>
		<td>'.$kpipoint[9].'</td>	
	</tr>';
	$sofaray= sizeof($kpimax);
	//print_r($kpiname);
	if($sofaray>10)
	{
		for($x=10;$x<$sofaray;$x++)
		{
			
		
		$slipHtml.='
					<tr>
						<td colspan="2" class="txal"></td>
						<td></td>
						<td></td>
						<td colspan="2" class="txal">'.$kpiname[$x].'</td>
						<td>'.$kpimax[$x].'</td>
						<td>'.$kpipoint[$x].'</td>	
					</tr>
					';
		}
	}
	
	$slipHtml.='
	<tr class="bkcolor">
		<th colspan="2" class="txal">Total Value</th>
		<th class="txac">'.$gettotalad.'</th>
		<th class="txac">'.$gettotala.'</th>
		<th colspan="2" class="txal">Total Value</th>
		<th class="txac">'.$Maxkpi.'</th>
		<th class="txac">'.$obtainkpi.'</th>	
	</tr>
	<tr class="bkcolor">
		<th colspan="2" class="txac">Deductions</th>
		<th class="txac">Monthly Value</th>
		<th class="txac">MTD</th>
		<th colspan="2" class="txac">Company Contribution</th>
		<th class="txac">Monthly Value</th>
		<th class="txac">Monthly Add on</th>	
	</tr>
	<tr>
		<td colspan="2" class="txal">TDS(As per Govt. norms)	</td>
		<td>0</td>
		<td>'.$TDS.'</td>
		<td colspan="2" class="txal">PT </td>
		<td>'.$pt.'</td>
		<td>'.$pt.'</td>	
	</tr>
	<tr>
		<td colspan="2" class="txal">Provident Fund (Employee Contribution)	</td>
		<td>'.$getPF.'</td>
		<td>'.$getPF.'</td>
		<td colspan="2" class="txal">Provident Fund (Company Contribution) </td>
		<td>'.$pfcamount.'</td>
		<td>'.$pfcamount.'</td>	
	</tr>
	<tr>
		<td colspan="2" class="txal">ESIC (Employee Contribution)	</td>
		<td>'.$esiceamount.'</td>
		<td>'.$esiceamount.'</td>
		<td colspan="2" class="txal">ESIC (Company Contribution) </td>
		<td>'.$esiccamount.'</td>
		<td>'.$esiccamount.'</td>	
	</tr>
		<tr class="bkcolor">
		<th colspan="2">Gross Salary</th>
		<th colspan="6" class="txac">'.$gettotala.' </th>
	</tr>
	<tr>
		<td colspan="2" class="txal">Adjustment ('.$getmode.')</td>
		<td colspan="6" class="txac">'.$adjustment.' </td>
	</tr>
	<tr>
		<td colspan="2" class="txal">Total Deduction</td>
		<td colspan="6" class="txac">'.$bfval.' </td>
	</tr>
	<tr class="bkcolor">
		<th colspan="2">Net Salary</th>
		<th colspan="6" class="txac">'.$gettotal.' </th>
	</tr>
	<tr>
		<th colspan="2">Net Pay in Words</th>
		<th colspan="6" class="txac" style="text-transform: capitalize;">'.$salInWord.' </th>
	</tr>
	<tr>
		<td colspan="8" style="text-align: right;"><small>**PF and LTB are paid as per TRPL Policy; TDS Deductions will be as per current Govt IncomeTax Norms</small></td>
	</tr>
	<tr>
		<th colspan="8"  class="txac"><small style="padding-top: 50px;padding-bottom: 10px;float: left;text-align: center;width: 100%;">Seal & Authorized Signatory</small></th>
	</tr>
</table>
</body>
	</div>';
	//echo "UPDATE `salaryslip` SET `slip`='$slipHtml' WHERE `id`  = '$salId'";
	$latecomes=$rowSal['latecomes'];
	$latecomesmins=$rowSal['latecomesmins'];
mysql_query("UPDATE `salaryslip` SET `basic`='$basicdeduct', `con_allow`='$getcon_allow', `spec_allow`='$getspec_allow', `other_allow`=	'$getother_allow', `perf_allow`='$getperf_allow', `att_allow`='$getatt_allow', `perf_Bonus`='$getperf_Bonus', `train_allow`='$gettrain_allow', `travel_allow`='$gettravel_allow', `add_earning`='$getadd_earning', `PF`='$getPF', `leave`='$leave', `workingdays`='$workingdays', `deduction`='$mDeduct', `totaldays`='$totaldays', `present`='$present', `absent`='$absent', `total`='$gettotal', `mode`='$getmode', `adjustment`='$adjustment', `latecomes`='$latecomes', `latecomesmins`='$latecomesmins', `TDS`='$TDS',`TMODE`='$TMODE', `slip`='$slipHtml' WHERE `id`  = '$salId'",$con) or die(mysql_error());
//echo $slipHtml ;
 ?>
 
