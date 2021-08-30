<?php
include("../../include/conFig.php");
include('../../include/function.php');
$total = 0;
$valto = $_POST['valto'];
//$valto = "30*$*$*25*$*$*25*$*$*0*$*$*0*$*$*0*$*$*0*$*$*0*$*$*0*$*$*10500*$*$*800*$*$*3700*$*$*3000*$*$*1800*$*$*1000*$*$*0*$*$*0*$*$*0*$*$*0*$*$*1260*$*$*321*$*$*Add*$*$*0*$*$*0*$*$*0*$*$*0*$*$*0*$*$*0*$*$*0*$*$*0*$*$*0*$*$*123*$*$*Deduct*$*$*1402.8*$*$*208*$*$*1.75*$*$*4.75";
$valto = explode("*$*$*",$valto);
$eid = $_GET['eid'];
$id = $_GET['id'];
$mnth = $_GET['month'];
$year = $_GET['year'];
$leaverecords = $_GET['leaverecords'];
if(isset($_COOKIE['selectedYear']))
{
$cYear  = $_COOKIE['selectedYear'];
}
else
{
$cYear = date("Y");
}

foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}



$getbasic=$post[9];			//basic
$getcon_allow=$post[10];		//conv_allow
$getspec_allow=$post[11];		//special allow
$getother_allow=$post[12];		//other allow
$getperf_allow=$post[13];		//KPI
$getperf_Bonus=$post[15];		//perfor_bonus
$gettrain_allow=$post[16];		//training allow
$gettravel_allow=$post[17];		//mobile allow
$getadd_earning=$post[18];		//HRA
$getPF=$post[19];				//PF(employee)
$getdeduction = $post[7];		//lwp and un ap lwp deductions
$getadjustment=$post[20];		//adjusment
$getmode=$post[21];				//adjusment mode
$getlatecomes=$post[5];			//late coming deduction
$getlatecomesmins=$post[24];	//late coming minuts
$getpfcamount=$post[33];		////PF(compny)	
$esice=$post[35];				//ESIC(employee)	
$esicc=$post[36];				//ESIC(compny)	
$getpt=$post[34];				//professional tex
$gettotaldays = $post[0];		//total days
$getworkingdays=$post[1];		//working days
$getpresent = $post[2];			//present days
$getlwp=$post[3];				//APR LWP 
$getabsent_days_not_approved = $post[4];		//UN apr LWP
$gettotalAbsent = $post[8];		//total abs
$getleaves_approved=$post[22];		//leaves approved other than lwp
$getleaveBalance=$post[23];			//leavebalance




// attendence allow deduction
if($gettotalAbsent <= 2)
{
$getatt_allow = $post[14];		//attendence allow
}
else if($gettotalAbsent > 2)
{
$getatt_allow = 0;
}
// attendence allow deduction



//BASIC PAY var ============BASIC after deduction

$basic_pay=$getbasic-$getdeduction;

//BASIC PAY var ============BASIC after deduction





//basic total variable =======A

$basic_total=$basic_pay+$getadd_earning+$getcon_allow+$getspec_allow+$getother_allow+$getperf_Bonus+$gettrain_allow+$gettravel_allow;

//basic total variable =======A

//KPI+AA variabble =========B

$sum_ATT_KPI=$getperf_allow+$getatt_allow;

//KPI+AA variabble =========B

//KPI+AA variabble =========C
//kpi
	
$kpiname = array();
$kpimax = array();
$kpipoint = array();
//echo "SELECT kpi.marks,kpiparameters.maximum,kpiparameters.name FROM kpi,kpiparameters WHERE kpi.employee = '$eid' AND kpi.month = '$mnth' AND kpi.kpiparameter = kpiparameters.id AND kpi.year = '$year' AND kpiparameters.delete = '0'";
$getKPIpoint = mysql_query("SELECT kpi.marks,kpiparameters.maximum,kpiparameters.name FROM kpi,kpiparameters WHERE kpi.employee = '$eid' AND kpi.month = '$mnth' AND kpi.kpiparameter = kpiparameters.id AND kpi.year = '$year' AND kpiparameters.delete = '0'",$con) or die(mysql_error());
while($rowKPIpoint = mysql_fetch_array($getKPIpoint))
{
	//print_r($rowKPIpoint);
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
$average = round(($obtainkpi/$Maxkpi)*100);//not used
	
$kpiamount =  $fix_perf_allow-$getperf_allow;//kpi amount 
$getperf_Bonus=$getperf_Bonus;

//KPI+AA variabble =========C


//addition of all ==========A+B+C

$A_B_C=$basic_total+$sum_ATT_KPI+$getperf_Bonus;

//addition of all ==========A+B+C

//A_B_C_Late_Coming_Deduction

$A_B_C=$A_B_C-$getlatecomes;
$Total_Value=$A_B_C;			//////============total value 1  for display only

//A_B_C_Late_Coming_Deduction

//Adjustment(Add/ Deduct) ========================Gross Salary

	if($getmode == 'Deduct')
	{
		$Gross_Salary = $A_B_C-$getadjustment;
	}
	else if($getmode == 'Add')
	{
		$Gross_Salary = $A_B_C+$getadjustment;
	}
	
//Adjustment(Add/ Deduct) ========================Gross Salary

//PF &&& ESIC &&& PT (EMPLOYEE CONTRIBUTION)  ============ FROM GROSS SALARY
	
	$Gross_Salary=$Gross_Salary-$getPF;		//PF amount deduction
	$esiceamount=(($Gross_Salary*$esice)/100);		//ESIC (employee) amount calculation ======== FROM GROSS SALARY
	$Gross_Salary=$Gross_Salary-$esiceamount;		//ESIC amount deduction ======== FROM GROSS SALARY
	$Gross_Salary=$Gross_Salary-$getpt;				//PT amount deduction ======== FROM GROSS SALARY
	$Net_Take_Home_before_TDS=$Gross_Salary;		//Net_Take_Home_before_TDS after all deduction (TDS remaining)

	
	
	$esiccamount=(($Gross_Salary*$esicc)/100);		//ESIC (company) amount calculation only for display======== FROM GROSS SALARY
	$pfcamount = $getpfcamount;		//PF (company) amount only for displays
	
	
//PF &&& ESIC &&& PT (EMPLOYEE CONTRIBUTION)  ============ FROM GROSS SALARY 


//TDS deduction ==Net_Take_Home_before_TDS===== FROM GROSS SALARY
	
		$TDS=$post[31];
		$TMODE=$post[32];
	
		
	if($TMODE == 'Deduct')
	{
		$Net_Take_Home_after_TDS = $Net_Take_Home_before_TDS-$TDS;
	}
	else if($TMODE == 'Add')
	{
		$Net_Take_Home_after_TDS = $Net_Take_Home_before_TDS+$TDS;
	}
$salInWord = no_to_words($Net_Take_Home_after_TDS);

	
//TDS deduction ==Net_Take_Home_before_TDS===== FROM GROSS SALARY
//final deduction 
$bfval=$rowSal['latecomes']+$PF+$TDS;
//final deduction 

$empdetailsSql = "select employee.id,employee.name,employee.empid,employee.doj,employee.accountno,employee.pfaccount,employee.bank,designation.name as desi_name,employee.salaryId,department.name as dept_name,employee.PAN_NO,bank.name as bank_name from employee,designation,department,bank where employee.id = '$eid' and employee.designation = designation.id and employee.bank = bank.id and employee.department = department.id";
$getEmpdetails = mysql_query($empdetailsSql,$con)or die(mysql_error());
$rowgetEmpdetails = mysql_fetch_array($getEmpdetails);	
$Empdetails_empid=$rowgetEmpdetails["empid"];
$Empdetails_name=$rowgetEmpdetails["name"];
$Empdetails_desi_name=$rowgetEmpdetails["desi_name"];
$Empdetails_dept_name=$rowgetEmpdetails["dept_name"];
$Empdetails_PAN_NO=$rowgetEmpdetails["PAN_NO"];
$Empdetails_bank_name=$rowgetEmpdetails["bank_name"];
$Empdetails_accountno=$rowgetEmpdetails["accountno"];
$Empdetails_id=$rowgetEmpdetails["id"];
$Empdetails_doj=$rowgetEmpdetails["doj"];
$Empdetails_pfaccount=$rowgetEmpdetails["pfaccount"];
$Empdetails_bank=$rowgetEmpdetails["bank"];
$Empdetails_salaryId=$rowgetEmpdetails["salaryId"];



//fix vartiables from datasbase
$getSalarydetails = mysql_query("SELECT * FROM `salary` WHERE `id` = '$Empdetails_salaryId' AND `delete` = '0' AND `increment` = '0'",$con) or die(mysql_error());
$rowSSalarydetails = mysql_fetch_array($getSalarydetails);
$fix_basic= $rowSSalarydetails['basic'];
$fix_con_allow= $rowSSalarydetails['con_allow'];
$fix_spec_allow= $rowSSalarydetails['spec_allow'];
$fix_other_allow= $rowSSalarydetails['other_allow']; 
$fix_perf_allow= $rowSSalarydetails['perf_allow'];
$fix_att_allow= $rowSSalarydetails['att_allow'];
$fix_perf_Bonus= $rowSSalarydetails['perf_Bonus'];
$fix_train_allow= $rowSSalarydetails['train_allow'];
$fix_travel_allow= $rowSSalarydetails['travel_allow'];
$fix_add_earning= $rowSSalarydetails['add_earning'];
$fix_PF= $rowSSalarydetails['PF'];
$fix_esice= $rowSSalarydetails['esice'];
$fix_esicc= $rowSSalarydetails['esicc'];



$Fix_Total_Value=$fix_basic+$fix_con_allow+$fix_spec_allow+$fix_other_allow+$fix_perf_allow+$fix_att_allow+$fix_perf_Bonus+$fix_train_allow+$fix_travel_allow+$fix_add_earning;	
	
	
	
	
	

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
		<td colspan="2">'.$Empdetails_empid.'</td>
		<th colspan="2">Working Days</th>
		<td colspan="2">'.$getworkingdays.' </td>
	</tr>
	<tr>
		<th colspan="2"> Employee Name</th>
		<td colspan="2">'.$Empdetails_name.'</td>
		<th colspan="2">Total number of Absent Days</th>
		<td colspan="2">'.$gettotalAbsent.'</td>
	</tr>
	<tr>
		<th colspan="2">Designation</th>
		<td colspan="2">'.$Empdetails_desi_name.'</td>
		<th colspan="2">Approved Absent days</th>
		<td colspan="2">'.$getleaves_approved.'</td>
	</tr>
	<tr>
		<th colspan="2">Department</th>
		<td colspan="2">'.$Empdetails_dept_name.'</td>
		<th colspan="2"> Approved Absent days (LWP)</th>
		<td colspan="2">'.$getlwp.'</td>
	</tr>
	<tr>
		<th colspan="2">PAN Card Number</th>
		<td colspan="2">'.$Empdetails_PAN_NO.'</td>
		<th colspan="2"> Not Approved Absent days (LWP)</th>
		<td colspan="2">'.$getabsent_days_not_approved.'</td> 
	</tr>
	<tr>
		<th colspan="2">Bank Name</th>
		<td colspan="2">'.$Empdetails_bank_name.'</td>
		<th colspan="2">Late Coming Minutes</th>
		<td colspan="2">'.$getlatecomesmins.' mins</td>
	</tr>
	<tr>
		<th colspan="2">Bank Account Number</th>
		<td colspan="2">'.$Empdetails_accountno.'</td>
		<th colspan="2">Late Coming Deduction</th>
		<td colspan="2">'.$getlatecomes.'</td>
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
		<td>'.$fix_basic.'</td>
		<td>'.$basic_pay.'***</td>
		<td colspan="2" class="txal">'.$kpiname[0].'</td>
		<td>'.$kpimax[0].'</td>
		<td>'.$kpipoint[0].'</td>	
	</tr>
	<tr>
		<td colspan="2" class="txal">HRA</td>
		<td>'.$fix_add_earning.'</td>
		<td>'.$getadd_earning.'</td>
		<td colspan="2" class="txal">'.$kpiname[1].'</td>
		<td>'.$kpimax[1].'</td>
		<td>'.$kpipoint[1].'</td>	
	</tr>
	<tr>
		<td colspan="2" class="txal">Conveyance Allowance</td>
		<td>'.$fix_con_allow.'</td>
		<td>'.$getcon_allow.'</td>
		<td colspan="2" class="txal">'.$kpiname[2].'</td>
		<td>'.$kpimax[2].'</td>
		<td>'.$kpipoint[2].'</td>	
	</tr>
	<tr>
		<td colspan="2" class="txal">Special Allowance</td>
		<td>'.$fix_spec_allow.'</td>
		<td>'.$getspec_allow.'</td>
		<td colspan="2" class="txal">'.$kpiname[3].'</td>
		<td>'.$kpimax[3].'</td>
		<td>'.$kpipoint[3].'</td>	
	</tr>
	<tr>
		<td colspan="2" class="txal">Mobile Allowance</td>
		<td>'.$fix_travel_allow.'</td>
		<td>'.$gettravel_allow.'</td>
		<td colspan="2" class="txal">'.$kpiname[4].'</td>
		<td>'.$kpimax[4].'</td>
		<td>'.$kpipoint[4].'</td>	
	</tr>
	<tr>
		<td colspan="2" class="txal">Other Allowance</td>
		<td>'.$fix_other_allow.'</td>
		<td>'.$getother_allow.'</td>
		<td colspan="2" class="txal">'.$kpiname[5].'</td>
		<td>'.$kpimax[5].'</td>
		<td>'.$kpipoint[5].'</td>	
	</tr>
	<tr>
		<td colspan="2" class="txal">KPI**</td>
		<td>'.$fix_perf_allow.'</td>
		<td>'.$getperf_allow.'</td>
		<td colspan="2" class="txal">'.$kpiname[6].'</td>
		<td>'.$kpimax[6].'</td>
		<td>'.$kpipoint[6].'</td>	
	</tr>
	<tr>
		<td colspan="2" class="txal">Attendance Allowance</td>
		<td>'.$fix_att_allow.'</td>
		<td>'.$getatt_allow.'</td>
		<td colspan="2" class="txal">'.$kpiname[7].'</td>
		<td>'.$kpimax[7].'</td>
		<td>'.$kpipoint[7].'</td>	
	</tr>
	<tr>
		<td colspan="2" class="txal">Performance Bonus</td>
		<td>'.$fix_perf_Bonus.'</td>
		<td>'.$getperf_Bonus.'</td>
		<td colspan="2" class="txal">'.$kpiname[8].'</td>
		<td>'.$kpimax[8].'</td>
		<td>'.$kpipoint[8].'</td>	
	</tr>
	<tr>
		<td colspan="2" class="txal">Training Allowance</td>
		<td>'.$fix_train_allow.'</td>
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
		<th class="txac">'.$Fix_Total_Value.'</th>
		<th class="txac">'.$Total_Value.'</th>
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
		<td colspan="2" class="txal">TDS (As per Govt. norms)	</td>
		<td>0</td>
		<td>'.$TDS.'</td>
		<td colspan="2" class="txal">PT </td>
		<td>'.$getpt.'</td>
		<td>'.$getpt.'</td>	
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
		<th colspan="6" class="txac">'.$Gross_Salary.' </th>
	</tr>
	<tr>
		<td colspan="2" class="txal">Adjustment ('.$getmode.')</td>
		<td colspan="6" class="txac">'.$getadjustment.' </td>
	</tr>

	<tr>
		<td colspan="2" class="txal">Total Deduction</td>
		<td colspan="6" class="txac">'.$bfval.' </td>
	</tr>
	<tr class="bkcolor">
		<th colspan="2">Net Salary</th>
		<th colspan="6" class="txac">'.$Net_Take_Home_after_TDS.' </th>
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
echo $slipHtml;

		if(isset($_GET["edit"]))
			{
				$usql="UPDATE `salaryslip` SET `delete`='1' WHERE `employee`='$eid' AND `month`='$mnth' AND `year`='$cYear'";
				mysql_query($usql,$con) or die(mysql_error());
			}
		mysql_query("INSERT INTO `salaryslip`(`employee`, `month`, `year`, `basic`, `con_allow`, `spec_allow`, `other_allow`, `perf_allow`, `att_allow`, `perf_Bonus`, `train_allow`, `travel_allow`, `add_earning`, `PF`, `leave`, `workingdays`, `deduction`, `totaldays`, `present`, `absent`, `total`, `mode`, `createdate`, `updatedate`, `updatedby`, `adjustment`,`latecomes`,`leaveBalance`,`latecomesmins`,`TDS`,`TMODE`, `slip`) VALUES ('$eid','$mnth','$cYear','$basic_pay','$getcon_allow','$getspec_allow','$getother_allow','$getperf_allow','$getatt_allow','$getperf_Bonus','$gettrain_allow','$gettravel_allow','$getadd_earning','$getPF','$getleaves_approved','$getworkingdays','$getdeduction','$gettotaldays','$getpresent','$gettotalAbsent','$Net_Take_Home_after_TDS','$getmode','$datetime','$datetime','$hrmloggedid','$getadjustment','$getlatecomes','$getleaveBalance','$getlatecomesmins','$TDS','$TMODE','$slipHtml')",$con) or die(mysql_error());
		$fid = mysql_insert_id();
		
		mysql_query("INSERT INTO `salaryslip_extra`(`sid`, `employee`, `lwp`, `absent_days_not_approved`, `createdate`, `updatedate`, `updatedby`, `pfcamount`,`pt`, `esice`,`esicc`) VALUES ('$fid', '$eid', '$getlwp', '$getabsent_days_not_approved', '$datetime', '$datetime', '$hrmloggedid', '$getpfcamount', '$getpt', '$esice', '$esicc')",$con) or die(mysql_error());
		$output = "Salary Successfully Added";
		




/*
if($eid != "")
{
mysql_query("INSERT INTO `salaryslip`(`employee`, `month`, `year`, `basic`, `con_allow`, `spec_allow`, `other_allow`, `perf_allow`, `att_allow`, `perf_Bonus`, `train_allow`, `travel_allow`, `add_earning`, `PF`, `leave`, `workingdays`, `deduction`, `totaldays`, `present`, `absent`, `total`, `mode`, `createdate`, `updatedate`, `updatedby`, `adjustment`,`latecomes`,`leaveBalance`,`latecomesmins`,`TDS`,`TMODE`) VALUES ('$eid','$mnth','$cYear','$basic','$con_allow','$spec_allow','$other_allow','$perf_allow','$att_allow','$perf_Bonus','$train_allow','$travel_allow','$add_earning','$PF','$leaves_approved','$workingdays','$deduction','$totaldays','$present','$totalAbsent','$total','$mode','$datetime','$datetime','$hrmloggedid','$adjustment','$latecomes','$leaveBalance','$latecomesmins','$TDS','$TMODE')",$con) or die(mysql_error());
$id = mysql_insert_id();

$pfcamount=$post[33];
$pt=$post[34];
$esice=$post[35];
$esicc=$post[36];

mysql_query("INSERT INTO `salaryslip_extra`(`sid`, `employee`, `lwp`, `absent_days_not_approved`, `createdate`, `updatedate`, `updatedby`, `pfcamount`,`pt`, `esice`,`esicc`) VALUES ('$id', '$eid', '$lwp', '$absent_days_not_approved','$datetime','$datetime','$hrmloggedid','$pfcamount','$pt','$esice','$esicc')",$con) or die(mysql_error());
$output = "Salary Successfully Added";
}
else
{
	$TDS=$post[25];
$TMODE=$post[26];
	if($post[26] == 'Deduct')
		{
		$total = $total-$post[25];
		}
		else if($post[26] == 'Add')
		{
		$total = $total+$post[25];
		}
$sql = "UPDATE `salaryslip` SET `basic`='$basic',`con_allow`='$con_allow',`spec_allow`='$spec_allow',`other_allow`='$other_allow',`perf_allow`='$perf_allow',`att_allow`='$att_allow',`perf_Bonus`='$perf_Bonus',`train_allow`='$train_allow',`travel_allow`='$travel_allow',`add_earning`='$add_earning',`PF`='$PF',`leave`='$leaves_approved',`workingdays`='$workingdays',`deduction`='$deduction',`totaldays`='$totaldays',`present`='$present',`absent`='$totalAbsent',`total`='$total',`mode`='$mode',`createdate`='$datetime',`updatedate`='$datetime',`updatedby`='$hrmloggedid',`adjustment`='$adjustment',`latecomes`='$latecomes',`leaveBalance`='$leaveBalance',`latecomesmins`='$latecomesmins',`TDS`='$TDS',`TMODE`='$TMODE' WHERE `id` = '$id'";

mysql_query("UPDATE `salaryslip_extra` SET `lwp`='$lwp', `absent_days_not_approved`='$absent_days_not_approved', `createdate`='$datetime', `updatedate`='$datetime', `updatedby`='$hrmloggedid' WHERE `sid`='$id'",$con) or die(mysql_error());

mysql_query($sql,$con) or die(mysql_error());
$output = "Salary Successfully Updated";
}
header("Location: ../../employee/savesalaryslip.php?id=$id&month=$mnth&year=$cYear");*/
?>