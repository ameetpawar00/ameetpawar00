<?php
include("../../include/conFig.php");
if(isset($_POST['excelDo'])){
    $month = $_POST['month'];
    $year = $_POST['year'];



    $getDepart = mysql_query("SELECT name,id FROM department WHERE 1",$con)or die(mysql_error());
    while($rowDepart=mysql_fetch_array($getDepart))
    {
        $allDepart[$rowDepart["id"]]=$rowDepart["name"];
    }
    $getBranch = mysql_query("SELECT name,id FROM branch WHERE 1",$con)or die(mysql_error());
    while($rowBranch=mysql_fetch_array($getBranch))
    {
        $allBranch[$rowBranch["id"]]=$rowBranch["name"];
    }



    $getSalary = mysql_query("
                                            SELECT 
                                                `salaryslip_new`.`id`, 
                                                `salaryslip_new`.`total_days`, 
                                                `salaryslip_new`.`working_days`, 
                                                `salaryslip_new`.`present_days`, 
                                                `salaryslip_new`.`leave_days`, 
                                                `salaryslip_new`.`absent_days`, 
                                                `salaryslip_new`.`lwp`, 
                                                `salaryslip_new`.`unlwp`, 
                                                `salaryslip_new`.`leave_balance`, 
                                                `salaryslip_new`.`latecomes_amount`, 
                                                `salaryslip_new`.`latecomes_mins`, 
                                                `salaryslip_new`.`deduction`, 
                                                `salaryslip_new`.`total_deduction`, 
                                                `salaryslip_new`.`adjustment_amount`, 
                                                `salaryslip_new`.`adjustment_amount_deduct`, 
                                                `salaryslip_new`.`adjustment_mode`, 
                                                `salaryslip_new`.`gross`, 
                                                `salaryslip_new`.`total_salary`,
                                                `salaryslip_new`.`employee`,
                                                `employee`.`emp_acc_name`,
                                                `employee`.`empid`,
                                                `employee`.`pfaccount`,
                                                `employee`.`ESICNO`,
                                                `employee`.`uan_no`,
                                                `employee`.`branch`,
                                                `employee`.`department`
                                            FROM  
                                                `salaryslip_new`,
                                                `employee`
                                            where 
                                                salaryslip_new.delete = '0' 
                                            AND  
                                                employee.delete = '0' 
                                            AND  
                                                `month` = '$month' 
                                            AND 
                                                `year` = '$year'
                                            AND
                                                `employee`.`id`=`salaryslip_new`.`employee`
                                            ORDER BY 
                                                `employee`.`emp_acc_name` ASC
                                            
                                            ",$con) or die(mysql_error());
    $type="_tr";

    while($rowSal = mysql_fetch_assoc($getSalary)){
        $id=$rowSal["id"];
        $present_days=$rowSal["present_days"];
        $latecomes_amount=$rowSal["latecomes_amount"];
        $adjustment_amountAdd=$rowSal["adjustment_amount"];
        $adjustment_amountDeduct=$rowSal["adjustment_amount_deduct"];
        $adjustment_mode=$rowSal["adjustment_mode"];
        $gross=$rowSal["gross"];
        $total_salary=$rowSal["total_salary"];
        $employee=$rowSal["employee"];
        $emp_acc_name=$rowSal["emp_acc_name"];
        $empid=$rowSal["empid"];
        $pfaccount=$rowSal["pfaccount"];
        $ESICNO=$rowSal["ESICNO"];
        $uan_no=$rowSal["uan_no"];
        $branch=$allBranch[$rowSal["branch"]];
        $department=$allDepart[$rowSal["department"]];


        $getSalaryRelation = mysql_query("
                                            SELECT 
                                                `salaryslip_relation_New`.`variableid`, 
                                                `salaryslip_relation_New`.`variablevalue`, 
                                                `salaryslip_relation_New`.`currentvalue`
                                            FROM  
                                                `salaryslip_relation_New`
                                            where
                                                salary_slip_id='$id'
                                            ",$con) or die(mysql_error());
        $thisSlip=array();
        while($rowSalRelation = mysql_fetch_assoc($getSalaryRelation)) {
            $variableid=$rowSalRelation["variableid"];
            $variablevalue=$rowSalRelation["variablevalue"];
            $currentvalue=$rowSalRelation["currentvalue"];
            $thisSlip[$variableid]=array($variablevalue,$currentvalue);
        }

        $empWiseSalData[]=array(
            "uan_no"=>$uan_no,
            "pfaccount"=>$pfaccount,
            "empid"=>$empid,
            "emp_acc_name"=>$emp_acc_name,
            "branch"=>$branch,
            "department"=>$department,
            "present_days"=>$present_days,
            "latecomes_amount"=>$latecomes_amount,
            "adjustment_amountAdd"=>$adjustment_amountAdd,
            "adjustment_amountDeduct"=>$adjustment_amountDeduct,
            "adjustment_mode"=>$adjustment_mode,
            "gross"=>$gross,
            "total_salary"=>$total_salary,
            "ESICNO"=>$ESICNO,
            "saralyDetails"=>$thisSlip
        );
    }
}


$counterForHeader=0;


$getSalaryRelation = mysql_query("
                                            SELECT 
                                                `salary_structure_variables_new`.`id`, 
                                                `salary_structure_variables_new`.`variable_name`
                                            FROM  
                                                `salary_structure_variables_new`
                                            where
                                                `salary_structure_variables_new`.`delete`='0'
                                            ",$con) or die(mysql_error());

$headerRow=<<<AAA
                    <th style="background:rgb(194, 214, 154)">Employee Id</th>
                    <th style="background:rgb(194, 214, 154)">UAN Number</th>
                    <th style="background:rgb(194, 214, 154)">Employee Name</th>
                    <th style="background:rgb(194, 214, 154)">Present Days</th>
                    <th style="background:rgb(194, 214, 154)">Basic Fixed</th>
AAA;

while($rowSalRelation = mysql_fetch_assoc($getSalaryRelation)) {
    $defVariableId=$rowSalRelation["id"];
    $defVariableName=$rowSalRelation["variable_name"];
    $headerRow.=<<<AAA
				<th style="background:rgb(194, 214, 154)">$defVariableName</th>
AAA;
    $allVarSalStr[$defVariableId]=$defVariableName;

}


$headerRow.=<<<AAA
				<th style="background:rgb(194, 214, 154)">Adjustment (Add)</th>
				<th style="background:rgb(194, 214, 154)">Adjustment (Deduct)</th>
				<th style="background:rgb(194, 214, 154)">Late Coming</th>
				<th style="background:rgb(194, 214, 154)">Gross Salary</th>
				<th style="background:rgb(194, 214, 154)">Net Salary</th>
				<th style="background:rgb(194, 214, 154)">ESIC No</th>
				<th style="background:rgb(194, 214, 154)">Department</th>
				<th style="background:rgb(194, 214, 154)">Branch</th>
AAA;

$montha=date('F-y' ,strtotime('01-'.$month.'-'.$year));

echo $xasd= <<<AAA
<html>
	<head>
		<title>Excel Salary Download For <?php echo $montha; ?> ></title>
	</head>
	<body>
		<table border="1">
			<tr>
				<th colspan='4'>
					Trifid Research Pvt. Ltd.
				</th>
			</tr>
			<tr>
				<th colspan='4'>
					Pay Slip $montha
				</th>
			</tr>
			<tr>
			    $headerRow
			</tr>

AAA;
$name = "Excel_Salary_Download_For_".date('M-y' ,strtotime('01-'.$month.'-'.$year)).$type.".xls";
header("Content-Disposition: attachment; filename=\"$name\"");
header("Content-Type: application/vnd.ms-excel");

$currentRow="";
foreach($empWiseSalData as $empWiseSalDataKey=>$empWiseSalDataVal)
{

    $uan_no=$empWiseSalDataVal["uan_no"];
    $pfaccount=$empWiseSalDataVal["pfaccount"];
    $empid=$empWiseSalDataVal["empid"];
    $emp_acc_name=$empWiseSalDataVal["emp_acc_name"];
    $department=$empWiseSalDataVal["department"];
    $branch=$empWiseSalDataVal["branch"];
    $present_days=$empWiseSalDataVal["present_days"];
    $latecomes_amount=$empWiseSalDataVal["latecomes_amount"];
    $adjustment_amountAdd=$empWiseSalDataVal["adjustment_amountAdd"];
    $adjustment_amountDeduct=$empWiseSalDataVal["adjustment_amountDeduct"];
    $adjustment_mode=$empWiseSalDataVal["adjustment_mode"];
    $gross=$empWiseSalDataVal["gross"];
    $total_salary=$empWiseSalDataVal["total_salary"];
    $saralyDetails=$empWiseSalDataVal["saralyDetails"];
    $ESICNO=$empWiseSalDataVal["ESICNO"];

    if ($adjustment_mode=='Deduct')
    {
        $adjustment_amountDeduct=$adjustment_amountAdd;
        $adjustment_amountAdd=0;
    }

    $currentRow.=<<<AAA
                                    <tr>
                                        <th>$empid</th>
                                        <th>$uan_no</th>
                                        <th>$emp_acc_name</th>
                                        <th>$present_days</th>
AAA;
    foreach($allVarSalStr as $allVarSalStrKey=>$allVarSalStrVal)
    {
        $myCurrentValDisp=$saralyDetails[$allVarSalStrKey][1];
        $myCurrentValDispDef=$saralyDetails[$allVarSalStrKey][0];
        if($myCurrentValDisp)
        {
            if($allVarSalStrKey==1)
            {
                $currentRow.=<<<AAA
                                            <th>$myCurrentValDispDef</th>
AAA;
            }
            $currentRow.=<<<AAA
                                            <th>$myCurrentValDisp</th>
AAA;
        }else{
            $currentRow.=<<<AAA
                                        <th>0</th>
AAA;
        }
    }

    $currentRow.=<<<AAA
                                        <th>$adjustment_amountAdd</th>
                                        <th>$adjustment_amountDeduct</th>
                                        <th>$latecomes_amount</th>
                                        <th>$gross</th>
                                        <th>$total_salary</th>
                                        <th>$ESICNO</th>
                                        <th>$department</th>
                                        <th>$branch</th>
                                    </tr>
AAA;
}
echo $currentRow;
?>
</table>
</body>
</html>
