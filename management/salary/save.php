<?php

include("../../include/conFig.php");
include('../../include/function.php');

/*$_REQUEST["valto"]="30*$*$*26*$*$*24*$*$*2*$*$*0*$*$*1*$*$*2*$*$*560*$*$*565*$*$*0*$*$*0*$*$*0*$*$*0*$*$*0*$*$*0*$*$*1867*$*$*1*$*$*999999*$*$*Add*$*$*28000*$*$*-1-,-9-,-16-,-18-,*$*$*16800*$*$*888888*$*$*555555*$*$*777777";
$_REQUEST["valto"]="30*$*$*26*$*$*25*$*$*1*$*$*0*$*$*1*$*$*1*$*$*0*$*$*0*$*$*0*$*$*0*$*$*0*$*$*0*$*$*0*$*$*0*$*$*933*$*$*1*$*$*1111*$*$*aAdd*$*$*28000*$*$*-1-,-9-,-16-,-18-,*$*$*16800*$*$*987*$*$*741*$*$*369";
$_REQUEST["valto"]="31*$*$*27*$*$*26*$*$*1*$*$*0*$*$*2*$*$*0*$*$*0*$*$*0*$*$*0*$*$*0*$*$*0*$*$*0*$*$*0*$*$*0*$*$*542*$*$*1*$*$*123*$*$*Deduct*$*$*28000*$*$*-1-,-9-,-16-,-18-,*$*$*16800*$*$*12345*$*$*123456*$*$*123456";
$_REQUEST["valto"]="31*$*$*27*$*$*24*$*$*3*$*$*0*$*$*1*$*$*2*$*$*0*$*$*0*$*$*0*$*$*0*$*$*0*$*$*0*$*$*0*$*$*0*$*$*630*$*$*0*$*$*1000*$*$*Add*$*$*8000*$*$*-1-,-9-,-16-,-18-,*$*$*3520*$*$*0*$*$*700*$*$*0";
$_REQUEST["special"]="salary--**--05";
*/

//$_REQUEST["special"]="salary--**--05";
//$_REQUEST["valto"]="31*$*$*27*$*$*25*$*$*2*$*$*0*$*$*2*$*$*1*$*$*0*$*$*0*$*$*0*$*$*0*$*$*0*$*$*0*$*$*0*$*$*0*$*$*1445*$*$*1*$*$*0*$*$*Add*$*$*28000*$*$*-1-,-18-,*$*$*16800*$*$*0";

$total = 0;
$valto = $_REQUEST['valto'];
$valto = explode("*$*$*",$valto);
$eid = $_REQUEST['eid'];
$id = $_REQUEST['id'];
$mnth = $_REQUEST['month'];
$year = $_REQUEST['year'];
$returnurl=$_REQUEST["returnurl"];

$compCounter=$_REQUEST["finalCounter"];

$leaverecords = $_REQUEST['leaverecords'];

if(isset($_COOKIE['selectedYear']))
{
    $cYear  = $_COOKIE['selectedYear'];
}
else
{
    $cYear = date("Y");
}

$counter=0;
foreach($valto as $val)
{
    $val = str_ireplace("'","\'",$val);

    if($counter<=20)
    {
        $post[] .= $val;
    }else{
        $posta[] .= $val;
    }
    $counter++;
}

$lastVal=explode(",",str_replace("-","",rtrim($post[sizeof($post)-1],",")));
$currentCounter=0;
foreach($lastVal as $lastValVal)
{
    $cheKAllData[$lastValVal]=$posta[$currentCounter];
    $currentCounter++;
}

$gettotaldays = $post[0];		//total days
$getworkingdays=$post[1];		//working days
$getpresent = $post[2];			//present days
$gettotalAbsent = $post[3];		//total abs
$getleaves_approved=$post[4];	//leaves approved other than lwp
$getlwp=$post[5];				//APR LWP
$getabsent_days_not_approved = $post[6];//UN apr LWP
$getlatecomesmins=$post[7];	    //late coming minuts
$getlatecomes=$post[8];			//late coming deduction
$getdeduction = $post[15];		//lwp and un ap lwp deductions
$getleaveBalance=$post[16];		//leavebalance
$getadjustmentAdd=$post[17];		//adjusment
$getadjustmentDeduct=$post[18];				//adjusment mode
$TotalAmoutPerDayDed=$post[19];	//ref amount for per day unLWP cal



$empdetailsSql = "select employee.id,employee.name,employee.empid,employee.doj,employee.accountno,employee.pfaccount,employee.bank,designation.name as desi_name,employee.salaryIdNew,department.name as dept_name,employee.PAN_NO,bank.name as bank_name,employee.depcheck,`workphone`, `PF`, `ESIC`, `PT`, `TDS`, `LTB`, `depcheck`, `PFFX` from employee,designation,department,bank where employee.id = '$eid' and employee.designation = designation.id and employee.bank = bank.id and employee.department = department.id";
$getEmpdetails = mysql_query($empdetailsSql,$con)or die(mysql_error());
$rowgetEmpdetails = mysql_fetch_assoc($getEmpdetails);
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
$Empdetails_salaryIdNew=$rowgetEmpdetails["salaryIdNew"];
$depcheck=$rowgetEmpdetails["depcheck"];






$ojtStatus=$rowgetEmpdetails["workphone"];
$PF=$rowgetEmpdetails["PF"];
$PFFX=$rowgetEmpdetails["PFFX"];
$ESIC=$rowgetEmpdetails["ESIC"];
$PT=$rowgetEmpdetails["PT"];
$TDS=$rowgetEmpdetails["TDS"];
$LTB=$rowgetEmpdetails["LTB"];


$amountTobeDeductedFromSalComp=0;
if($getdeduction)
{
    $amountTobeDeductedFromSalComp=$getdeduction/$compCounter;
    //$basicPallsalcompMleavededuction=$TotalAmoutPerDayDed-$getdeduction;
}
//echo "SELECT `variableid`, `variablevalue`, `variable_name`, `type` FROM `salary_structure_relation_new`,`salary_structure_variables_new` WHERE `profileid` = '$Empdetails_salaryIdNew' AND salary_structure_relation_new.variableid=salary_structure_variables_new.id ORDER BY variableid";
$getStartingNew = mysql_query("SELECT `variableid`, `variablevalue`, `variable_name`, `type` FROM `salary_structure_relation_new`,`salary_structure_variables_new` WHERE `profileid` = '$Empdetails_salaryIdNew' AND salary_structure_relation_new.variableid=salary_structure_variables_new.id ORDER BY variableid",$con) or die(mysql_error());
$htmlRowsType1="";

$htmlRowsType2="";
$htmlRowsType3="";
$htmlRowsType1Rows=0;
$htmlRowsType2Rows=0;
$htmlRowsType3Rows=0;
$totalmonthlyValue=0;
$totalmonthlyVariable=0;
$totalmonthlyVariableWithHRA=0;
$totalmonthlyVariableWithOutHRA=0;
$totalDeduction=$getlatecomes;
while($rowStartNew=mysql_fetch_assoc($getStartingNew))
{
    $variableid=$rowStartNew["variableid"];
    $variablevalue=$rowStartNew["variablevalue"];
    $variable_name=$rowStartNew["variable_name"];
    $type=$rowStartNew["type"];

    if(array_key_exists($variableid,$cheKAllData))
    {
        $currentValue=round($cheKAllData[$variableid]);
    }else{
        $currentValue=round($variablevalue);
    }

    if($type==1 AND $variableid!=17)
    {
        if($amountTobeDeductedFromSalComp)
        {
            $currentValue=round($variablevalue-$amountTobeDeductedFromSalComp);

        }




        $allValueArray[$type][$variableid]=array("name"=>$variable_name,"fixedValue"=>$variablevalue,"currentValue"=>$currentValue);

        $htmlRowsType1.=<<<AAA
                    <tr>
                        <td   style="width: 50%" class="txal">$variable_name</td>
                        <td  style="width: 25%">$variablevalue</td>
                        <td  style="width: 25%">$currentValue</td>
                    </tr>
AAA;

        $htmlRowsType1Rows++;

        $totalmonthlyValue+=$variablevalue;
        $totalmonthlyVariable+=$currentValue;

        if($variableid!=2 AND $variable_name!="HRA")
        {
            $totalmonthlyVariableWithOutHRA += $currentValue;
        }
        $totalmonthlyVariableWithHRA+=$currentValue;

    }

    if($type==2)
    {
        $checkMyStatus2=1;



        if($variableid==4 AND $variable_name=="QPE" AND $depcheck==1) {


            $getQPEpoint = mysql_query("SELECT marks FROM qpe WHERE employee = '$eid' AND month = '$mnth' AND qpe.year = '$year'",$con) or die(mysql_error());
            $rowQPEpoint = mysql_fetch_assoc($getQPEpoint);
            $myCurrentValue= $rowQPEpoint["marks"];
            if(!$myCurrentValue)
            {
                $currentValue=0;
            }else{
                $currentValue=$myCurrentValue;
            }

        }elseif($variableid==4 AND $variable_name=="QPE")
        {
            $checkMyStatus2=0;
        }

        if($variableid==8 AND $variable_name=="Attendance Allowance")
        {
            if($gettotalAbsent <= 2)
            {
                $currentValue = $variablevalue;
            }
            else if($gettotalAbsent > 2)
            {
                $currentValue = 0;
            }

            $totalmonthlyVariableWithHRA+=$currentValue;
        }

        if(($variableid==7 AND $variable_name=="KPI"))
        {
            $getKPIpoint = mysql_query("SELECT kpi.marks,kpiparameters.maximum FROM kpi,kpiparameters WHERE kpi.employee = '$eid' AND kpi.month = '$mnth' AND kpi.kpiparameter = kpiparameters.id AND kpi.year = '$year' AND kpiparameters.delete ='0' AND kpi.delete ='0'", $con) or die(mysql_error());
            $obtainkpi = 0;
            $Maxkpi = 0;
            while ($rowKPIpoint = mysql_fetch_array($getKPIpoint)) {
                //print_r($rowKPIpoint);
                $obtainkpi += $rowKPIpoint[0];
                $Maxkpi += $rowKPIpoint[1];
            }
            $average = round(($obtainkpi / $Maxkpi) * 100);
            $currentValue = round($variablevalue * ($average / 100));

            $allValueArray[$type][$variableid]=array("name"=>$variable_name,"fixedValue"=>$variablevalue,"currentValue"=>$currentValue);


            $getStartingNewA = mysql_query("SELECT  `variableid`, `variablevalue`, `variable_name` FROM `salary_structure_relation_new`,`salary_structure_variables_new` WHERE `variableid` = '17' AND `profileid` = '$Empdetails_salaryIdNew' AND salary_structure_relation_new.variableid=salary_structure_variables_new.id",$con) or die(mysql_error());

            if(mysql_num_rows($getStartingNewA)>0)
            {
                $rowNewVaal=mysql_fetch_assoc($getStartingNewA);
                $variableid.=" + ".$rowNewVaal["variableid"]."**";
                $variable_name=$rowNewVaal["variable_name"]." ".$variable_name."";
                $variablevalue+=$rowNewVaal["variablevalue"];
                $currentValue+=round($rowNewVaal["variablevalue"]);

                $allValueArray[$type][$rowNewVaal["variableid"]]=array("name"=>$rowNewVaal["variable_name"],"fixedValue"=>$rowNewVaal["variablevalue"],"currentValue"=>$rowNewVaal["variablevalue"]);
            }

           // $allValueArray[$type][$variableid]=array("name"=>$variable_name,"fixedValue"=>$variablevalue,"currentValue"=>$currentValue);
            $htmlRowsType2.=<<<AAA
                    <tr>
                        <td   style="width: 50%" class="txal">$variable_name</td>
                        <td  style="width: 25%">$variablevalue</td>
                        <td  style="width: 25%">$currentValue</td>
                    </tr>
AAA;
            $htmlRowsType2Rows++;
            $htmlRowsType1Rows++;
            $totalmonthlyValue+=$variablevalue;
            $totalmonthlyVariable+=$currentValue;
            $totalmonthlyVariableWithHRA+=$currentValue;
        }elseif($checkMyStatus2 AND ($variableid!=17 AND $variable_name!="SLI"))
        {
            $allValueArray[$type][$variableid]=array("name"=>$variable_name,"fixedValue"=>$variablevalue,"currentValue"=>$currentValue);
            $htmlRowsType2.=<<<AAA
                    <tr>
                        <td   style="width: 50%" class="txal">$variable_name</td>
                        <td  style="width: 25%">$variablevalue</td>
                        <td  style="width: 25%">$currentValue</td>
                    </tr>
AAA;
            $htmlRowsType2Rows++;
            $htmlRowsType1Rows++;

            $totalmonthlyValue+=$variablevalue;
            $totalmonthlyVariable+=$currentValue;
        }


    }

}


$getStartingNewa = mysql_query("SELECT `variableid`, `variablevalue`, `variable_name`, `type` FROM `salary_structure_relation_new`,`salary_structure_variables_new` WHERE `profileid` = '$Empdetails_salaryIdNew' AND salary_structure_relation_new.variableid=salary_structure_variables_new.id ORDER BY variableid",$con) or die(mysql_error());


while($rowStartNewa=mysql_fetch_assoc($getStartingNewa))
{
    $variableid=$rowStartNewa["variableid"];
    $variablevalue=$rowStartNewa["variablevalue"];
    $variable_name=$rowStartNewa["variable_name"];
    $type=$rowStartNewa["type"];

    if(array_key_exists($variableid,$cheKAllData))
    {
        $currentValue=round($cheKAllData[$variableid]);
    }else{
        $currentValue=round($variablevalue);
    }

    if($type==3)
    {
        if($variableid==12 AND $variable_name=="ESIC (Employee)")
        {
            //echo $totalmonthlyVariableWithHRA;
            $esiceamount=(($totalmonthlyVariableWithHRA*$variablevalue)/100);
            $variablevalue=0;
            $currentValue=round($esiceamount);
        }

        if($variableid==10 AND $variable_name=="Provident Fund (Employee)")
        {
            $getPF=(($totalmonthlyVariableWithOutHRA*$variablevalue)/100);
            $variablevalue=0;
            $currentValue=round($getPF);

            if($PFFX AND $currentValue>=1800)
            {
                $currentValue=1800;
            }
        }


        if($ojtStatus!=2)
        {
            $checkMyStatus=0;
            if(!$PF AND $variableid==10 AND $variable_name=="Provident Fund (Employee)")
            {
                $checkMyStatus=1;
            }
            if(!$ESIC AND $variableid==12 AND $variable_name=="ESIC (Employee)")
            {
                $checkMyStatus=2;
            }
            if(!$PT AND $variableid==14 AND $variable_name=="PT")
            {
                $checkMyStatus=3;
            }
            if(!$TDS AND $variableid==18 AND $variable_name=="TDS")
            {
                $checkMyStatus=4;
            }
            if(!$LTB AND $variableid==19 AND $variable_name=="DEDUCTION 1")
            {
                $checkMyStatus=5;
            }

            if($checkMyStatus==0)
            {
                $htmlRowsType3.=<<<AAA
                        <tr>
                            <td   style="width: 50%" class="txal">$variable_name</td>
                            <td  style="width: 50%">$currentValue</td>
                        </tr>
AAA;
                $htmlRowsType3Rows++;
                $totalDeduction+=$currentValue;

                $allValueArray[$type][$variableid]=array("name"=>$variable_name,"fixedValue"=>0,"currentValue"=>$currentValue);
            }
        }

    }
}

    if($getadjustmentAdd)
    {
        $htmlRowsType2.=<<<AAA
                            <tr>
                                <td   style="width: 50%" class="txal">Adjustment (Add)</td>
                                <td  style="width: 25%">-</td>
                                <td  style="width: 25%">$getadjustmentAdd</td>
                            </tr>
AAA;


        $totalmonthlyVariable+=$getadjustmentAdd;
        $htmlRowsType1Rows++;
    }

if($getadjustmentDeduct)
{
        $htmlRowsType3.=<<<AAA
                            <tr>
                                <td   style="width: 50%" class="txal">Adjustment (Deduct)</td>
                                <td  style="width: 50%">$getadjustmentDeduct</td>
                            </tr>
AAA;
        $totalDeduction+=$getadjustmentDeduct;
        $htmlRowsType3Rows++;
    }

$NetSalary=round($totalmonthlyVariable-$totalDeduction);
$salInWord = no_to_words($NetSalary);


$diff=$htmlRowsType1Rows-$htmlRowsType3Rows;
if($diff AND !$htmlRowsType2Rows)
{
    for($xxx=0;$xxx<=$diff;$xxx++)
    {
        $htmlRowsType1.=<<<AAA
                    <tr>
                        <td   style="width: 50%" class="txal">&nbsp&nbsp</td>
                        <td  style="width: 25%"></td>
                        <td  style="width: 25%"></td>
                    </tr>
AAA;
    }

}else{
    $diff=$htmlRowsType1Rows-$htmlRowsType3Rows;
    if($diff)
    {
        if($htmlRowsType2Rows)
        {
            //$diff=$diff+1;
        }
        for($xxx=0;$xxx<=$diff;$xxx++)
        {
            $htmlRowsType3.=<<<AAA
                    <tr>
                        <td   style="width: 50%" class="txal">&nbsp&nbsp</td>
                        <td  style="width: 50%"></td>
                    </tr>
AAA;
        }
    }
}

/*$slipHtml ='
<head>
<style>
body{
	font-family:Tahoma,Arial, Helvetica, sans-serif;font-size:11px;}
td{padding: 5px;}
th{text-align: left;padding: 5px;
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
					<img src="../../images/logo.png" alt="" style="margin: 0px;" width="150">
					<br>
  						TRIFID RESEARCH
  						<br>First Floor, Saket Tower Plot No 3-A, Ratlam Kothi, AB Road, Near Geeta Bhawan Square, Indore - 452001
  						<br>( Confidential For Internal use only )
  					</span>
 			</div>
 		</th>
	</tr>
	<tr class="bkcolor">
		<th colspan="8" class="txac">
			'.(date("F", mktime(0, 0, 0,  $mnth, 10))).'-'.$year.'
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
	<tr>
		<td colspan="4" class="txal" style="padding: 0;">
		    <table style="margin: 0;border: none;" cellpadding="0" cellspacing="0"  width="100%" align="center" border="1">
                <thead>
                    <tr class="bkcolor">
                        <th style="width: 50%;text-align: center" >Salary Component</th>
                        <th  style="width: 25%;text-align: center">Monthly Value</th>
                        <th style="width: 25%;text-align: center">Monthly Variable</th>
                    </tr>
                </thead>
                <tbody>
                    '.$htmlRowsType1.'
                </tbody>
            </table>
            
		    <table style="margin: 0;border: none;" cellpadding="0" cellspacing="0"  width="100%" align="center" border="1">
                <thead>
                    <tr class="bkcolor">
                        <th   style="width: 50%;text-align: center" class="txal">Earnings</th>
                        <th  style="width: 50%" colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    '.$htmlRowsType2.'
                </tbody>
                <tfoot>
                    <tr class="bkcolor">
                        <th style="width: 50%;" >Total Earnings</th>
                        <th  style="width: 25%;text-align: center">'.$totalmonthlyValue.'</th>
                        <th style="width: 25%;text-align: center">'.$totalmonthlyVariable.'</th>
                    </tr>
                </tfoot>
            </table>
        </td>
		<td colspan="4" class="txal" style="padding: 0;">
		    <table style="margin: 0;border: none;" cellpadding="0" cellspacing="0"  width="100%" align="center" border="1">
		        <thead>
                    <tr class="bkcolor">
                        <th style="width: 50%;text-align: center">Deductions</th>
                        <th  style="width: 50%;text-align: center">Value</th>
                    </tr>
                </thead>
                <tbody>
                       '.$htmlRowsType3.'
                </tbody>
                <tfoot>
                    <tr class="bkcolor">
                        <th   style="width: 50%" class="txal">Total Deductions</th>
                        <th  style="width: 50%;text-align: center">'.$totalDeduction.'</th>
                    </tr>
                </tfoot>
            </table>
        </td>
	</tr>
	<tr class="bkcolor"  style="background: rgba(255, 0, 0, 0.22);">
		<th colspan="2">Net Salary</th>
		<th colspan="6" class="txac">'.$NetSalary.' </th>
	</tr>
	<tr  style="background: rgba(255, 0, 0, 0.22);">
		<th colspan="2" >Net Pay in Words</th>
		<th colspan="6" class="txac" style="text-transform: capitalize;">'.$salInWord.' </th>
	</tr>

	<tr>
		<th colspan="8"  class="txac"><small style="padding-top: 50px;padding-bottom: 10px;float: left;text-align: center;width: 100%;">Seal & Authorized Signatory</small></th>
	</tr>
</table>

</body>
	</div>';*/

$monthYear=(date("F", mktime(0, 0, 0,  $mnth, 10))).'-'.$year;
$slipHtml =<<<AAA
    <html>
        <head>
            <style>
                        body{
                            font-family:Tahoma,Arial, Helvetica, sans-serif;font-size:11px;}
                        td{padding: 5px;}
                        th{text-align: left;padding: 5px;
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
                                    <img src="../../images/logo.png" alt="" style="margin: 0px;" width="150">
                                    <br>
                                        TRIFID RESEARCH
                                        <br>First Floor, Saket Tower Plot No 3-A, Ratlam Kothi, AB Road, Near Geeta Bhawan Square, Indore - 452001
                                        <br>( Confidential For Internal use only )
                                    </span>
                            </div>
                        </th>
                    </tr>
                    <tr class="bkcolor">
                        <th colspan="8" class="txac">
                            $monthYear
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2"> Employee Code</th>
                        <td colspan="2">$Empdetails_empid</td>
                        <th colspan="2">Working Days</th>
                        <td colspan="2">$getworkingdays</td>
                    </tr>
                    <tr>
                        <th colspan="2"> Employee Name</th>
                        <td colspan="2">$Empdetails_name</td>
                        <th colspan="2">Total number of Absent Days</th>
                        <td colspan="2">$gettotalAbsent</td>
                    </tr>
                    <tr>
                        <th colspan="2">Designation</th>
                        <td colspan="2">$Empdetails_desi_name</td>
                        <th colspan="2">Approved Absent days</th>
                        <td colspan="2">$getleaves_approved</td>
                    </tr>
                    <tr>
                        <th colspan="2">Department</th>
                        <td colspan="2">$Empdetails_dept_name</td>
                        <th colspan="2"> Approved Absent days (LWP)</th>
                        <td colspan="2">$getlwp</td>
                    </tr>
                    <tr>
                        <th colspan="2">PAN Card Number</th>
                        <td colspan="2">$Empdetails_PAN_NO</td>
                        <th colspan="2"> Not Approved Absent days (LWP)</th>
                        <td colspan="2">$getabsent_days_not_approved</td>
                    </tr>
                    <tr>
                        <th colspan="2">Bank Name</th>
                        <td colspan="2">$Empdetails_bank_name</td>
                        <th colspan="2">Late Coming Minutes</th>
                        <td colspan="2">$getlatecomesmins mins</td>
                    </tr>
                    <tr>
                        <th colspan="2">Bank Account Number</th>
                        <td colspan="2">$Empdetails_accountno</td>
                        <th colspan="2">Late Coming Deduction</th>
                        <td colspan="2">$getlatecomes</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="txal" style="padding: 0;">
                            <table style="margin: 0;border: none;" cellpadding="0" cellspacing="0"  width="100%" align="center" border="1">
                                <thead>
                                    <tr class="bkcolor">
                                        <th style="width: 50%;text-align: center" >Salary Component</th>
                                        <th  style="width: 25%;text-align: center">Monthly Value</th>
                                        <th style="width: 25%;text-align: center">Monthly Variable</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    $htmlRowsType1
                                </tbody>
                            </table>
                            <table style="margin: 0;border: none;" cellpadding="0" cellspacing="0"  width="100%" align="center" border="1">
                                <thead>
                                    <tr class="bkcolor">
                                        <th   style="width: 50%;text-align: center" class="txal">Earnings</th>
                                        <th  style="width: 50%" colspan="2"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    $htmlRowsType2
                                </tbody>
                                <tfoot>
                                    <tr class="bkcolor">
                                        <th style="width: 50%;" >Total Earnings</th>
                                        <th  style="width: 25%;text-align: center">$totalmonthlyValue</th>
                                        <th style="width: 25%;text-align: center">$totalmonthlyVariable</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </td>
                        <td colspan="4" class="txal" style="padding: 0;">
                            <table style="margin: 0;border: none;" cellpadding="0" cellspacing="0"  width="100%" align="center" border="1">
                                <thead>
                                    <tr class="bkcolor">
                                        <th style="width: 50%;text-align: center">Deductions</th>
                                        <th  style="width: 50%;text-align: center">Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                       $htmlRowsType3
                                </tbody>
                                <tfoot>
                                    <tr class="bkcolor">
                                        <th   style="width: 50%" class="txal">Total Deductions</th>
                                        <th  style="width: 50%;text-align: center">$totalDeduction</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </td>
                    </tr>
                    <tr class="bkcolor"  style="background: rgba(255, 0, 0, 0.22);">
                        <th colspan="2">Net Salary</th>
                        <th colspan="6" class="txac">$NetSalary</th>
                    </tr>
                    <tr  style="background: rgba(255, 0, 0, 0.22);">
                        <th colspan="2" >Net Pay in Words</th>
                        <th colspan="6" class="txac" style="text-transform: capitalize;">$salInWord</th>
                    </tr>
                    <tr>
                        <th colspan="8"  class="txac">
                            <small style="padding-top: 50px;padding-bottom: 10px;float: left;text-align: center;width: 100%;">
                                Seal & Authorized Signatory
                            </small>
                        </th>
                    </tr>
                </table>
            </body>
        </div>
    </html>
AAA;

echo $slipHtml;





if(isset($_REQUEST["edit"]))
{
    $usql="UPDATE `salaryslip_new` SET `delete`='1' WHERE `employee`='$eid' AND `month`='$mnth' AND `year`='$cYear'";
    mysql_query($usql,$con) or die(mysql_error());
}
mysql_query("INSERT INTO `salaryslip_new`( `employee`, `month`, `year`, `total_days`, `working_days`, `present_days`, `leave_days`, `absent_days`, `lwp`, `unlwp`, `leave_balance`, `latecomes_amount`, `latecomes_mins`, `deduction`, `total_deduction`, `adjustment_amount`, `adjustment_amount_deduct`, `gross`, `total_salary`, `slip`, `createdby`, `adjustment_mode`) VALUES ('$eid', '$mnth', '$cYear', '$gettotaldays', '$getworkingdays', '$getpresent', '$getleaves_approved', '$gettotalAbsent', '$getlwp', '$getabsent_days_not_approved', '$getleaveBalance', '$getlatecomes', '$getlatecomesmins', '$getdeduction', '$totalDeduction', '$getadjustmentAdd', '$getadjustmentDeduct', '$totalmonthlyVariable', '$NetSalary', '$slipHtml', '$hrmloggedid','0')",$con) or die(mysql_error());
$fid = mysql_insert_id();



if(isset($_REQUEST["edit"]))
{
    $edirID=$_REQUEST["edit_id"];

    $usqlup="UPDATE `salary_description` SET `sal_id`='$fid' WHERE `sal_id`='$edirID'";
    mysql_query($usqlup,$con) or die(mysql_error());
}

$output = "Salary Successfully Added";
$relationEntries="";
foreach($allValueArray as $allValueArrayKey=>$allValueArrayVal)
{
    foreach($allValueArrayVal as $allValueArrayValKey=>$allValueArrayValVal)
    {
        $fixedValue=$allValueArrayValVal["fixedValue"];
        $currentValue=$allValueArrayValVal["currentValue"];
        $relationEntries.="('$fid','$allValueArrayValKey','$fixedValue','$currentValue'),";
    }
}

$relationEntries=rtrim($relationEntries,",");
mysql_query("INSERT INTO `salaryslip_relation_New`(`salary_slip_id`, `variableid`, `variablevalue`, `currentvalue`) VALUES $relationEntries",$con) or die(mysql_error());

?>
