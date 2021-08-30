<?php
include("../../include/conFig.php");

 /*   $month = '8';2019-05-04
    $year = '2019';*/
    $currentRow="";


    $empAll="";
    $allDep=array();
    $getDepart = mysql_query("SELECT `id`,`name` FROM `department`",$con) or die(mysql_error());
    while($rowDepart=mysql_fetch_assoc($getDepart))
    {
        $allDep[$rowDepart["id"]]=$rowDepart["name"];
    }

    $allDesg=array();
    $getDesg = mysql_query("SELECT `id`,`name` FROM `designation`",$con) or die(mysql_error());
    while($rowDesg=mysql_fetch_assoc($getDesg))
    {
        $allDesg[$rowDesg["id"]]=$rowDesg["name"];
    }
    $allEmpStat=array();
    $getEmpStaT = mysql_query("SELECT `id`,`name` FROM `employeestatus`",$con) or die(mysql_error());
    while($rowEmpStaT=mysql_fetch_assoc($getEmpStaT))
    {
        $allEmpStat[$rowEmpStaT["id"]]=$rowEmpStaT["name"];
    }

    $empAll="";
    $empAllArray=array();
    //echo "SELECT `employee` FROM `salaryslip_new` WHERE `month`=$month AND `year`=$year AND `delete`=0";
    $getSalary = mysql_query("SELECT `employee` FROM `salaryslip` WHERE `month`>='04' AND `year`>='2018'",$con) or die(mysql_error());
    while($rowSal=mysql_fetch_assoc($getSalary))
    {
        $empAll.=$rowSal["employee"].",";

        $empAllArray[]=$rowSal["employee"];
    }



    $getEducation = mysql_query("SELECT `employee`, `year`, `degree` FROM `emp_education` ORDER BY `year` ASC",$con) or die(mysql_error());
    while($rowEdu=mysql_fetch_assoc($getEducation))
    {


        $empEduArray[$rowEdu["employee"]]["degree"]=$rowEdu["degree"];
        $empEduArray[$rowEdu["employee"]]["year"]=$rowEdu["year"];
    }


    $getSalarya = mysql_query("SELECT `employee` FROM `salaryslip_new` WHERE `delete`=0",$con) or die(mysql_error());
    while($rowSala=mysql_fetch_assoc($getSalarya))
    {

        if(!in_array($rowSala["employee"], $empAllArray))
        {
            $empAll.=$rowSala["employee"].",";
        }
    }


    $empAll=rtrim($empAll,",");
    $counter=1;


    $getEmp = mysql_query("SELECT `name`, `empid`, `department`, `designation`, `doj`, `dob`, `accountno`,`PAN_NO`, `empstatus`, `dol`, `id` FROM `employee` WHERE `id` IN($empAll)",$con) or die(mysql_error());
    while($rowEMP=mysql_fetch_assoc($getEmp))
    {
        $name=$rowEMP["name"];
        $empid=$rowEMP["empid"];
        $department=$allDep[$rowEMP["department"]];
        $designation=$allDesg[$rowEMP["designation"]];
        $doj=$rowEMP["doj"];
        $dob=$rowEMP["dob"];
        $accountno=$rowEMP["accountno"];
        $PAN_NO=$rowEMP["PAN_NO"];
        $empstatus=$allEmpStat[$rowEMP["empstatus"]];
        $dol=$rowEMP["dol"];


        $degree=$empEduArray[$rowEMP["id"]]["degree"];
        $year=$empEduArray[$rowEMP["id"]]["year"];
        $currentRow.=<<<AAA
			<tr>
                <td>$counter</td>
                <td>$name</td>
                <td>$empid</td>
                <td>$PAN_NO</td>
                <td>$accountno</td>
                <td>$designation</td>
                <td>$department</td>
                <td>$dob</td>
                <td>$doj</td>
                <td>$dol</td>
                <td>$empstatus</td>
                <td>$degree</td>
			</tr>
AAA;
        $counter++;

    }

echo $xasd= <<<AAA
<html>
	<body>
		<table border="1">
			<tr>
                <th>S No.</th>
                <th>Name</th>
                <th>Emp Id</th>
                <th>PAN</th>
                <th>Bank a/c</th>
                <th>Designation</th>
                <th>Department</th>
                <th>DOB</th>
                <th>DOJ</th>
                <th>DOL</th>
                <th>Status</th>
                <th>Degree</th>
			</tr>

AAA;
$name = "Excel_Employee Details_Download_For_".$month.'-'.$year.".xls";
header("Content-Disposition: attachment; filename=\"$name\"");
header("Content-Type: application/vnd.ms-excel");


echo $currentRow;
?>
</table>
</body>
</html>
