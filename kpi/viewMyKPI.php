<?php require_once("../include/conFig.php"); ?>
<style>
    ::-webkit-scrollbar{
        height: 5px !important;
    }
</style>
<?php

$empId=$hrmloggedid;
$yearSel=$year;
$monthSel=date("m")-1;

$monthSel = sprintf("%02d", $monthSel);

if(isset($_REQUEST["desig"]))
{
    $yearSel=$_REQUEST["syear"];
    $monthSel=$_REQUEST["smonth"];
    $desig=$_REQUEST["desig"];
    $empId=$_REQUEST["desig"];

}



$getDesig = mysql_query("SELECT employee.id,employee.name,employee.salaryIdNew,employee.designation FROM employee WHERE employee.delete = 0 AND employee.empstatus = 2 ORDER BY employee.name ASC",$con) or die(mysql_error());
while($rowDesig = mysql_fetch_array($getDesig))
{
    $name=$rowDesig["name"];
    $salaryIdNaew=$rowDesig["salaryIdNew"];
    $id=$rowDesig["id"];
    $designation=$rowDesig["designation"];
    $employeeData[$id]=array("empName"=>$name,"salaryIdNew"=>$salaryIdNaew);

    if($designation==$desig)
    {
        $allEmpId.=$id.",";
    }

}



$kpiSqlSel="kpi.employee=$empId";
if($allEmpId)
{
    $allEmpId=rtrim($allEmpId,",");
    $kpiSqlSel="kpi.employee IN($allEmpId)";
}

//echo $kpiSqlSel;

$g=1;
$thrrt="";
//echo $month;


$maxToShow=0;
$marksToShow=0;
//echo "SELECT kpiparameters.id,kpiparameters.default,kpiparameters.maximum,kpiparameters.name,`marks`,`month`,`year`,`employee` FROM kpiparameters,kpi WHERE kpiparameters.id=kpi.kpiparameter AND kpiparameters.delete = '0' AND kpiparameters.id != '1'  AND  `year`='$yearSel'  AND  `month`='$monthSel' AND $kpiSqlSel ORDER BY  `name` ASC";
$getParams = mysql_query("SELECT kpiparameters.id,kpiparameters.default,kpiparameters.maximum,kpiparameters.name,`marks`,`month`,`year`,`employee` FROM kpiparameters,kpi WHERE kpiparameters.id=kpi.kpiparameter AND kpiparameters.delete = '0' AND kpiparameters.id != '1'  AND  `year`='$yearSel'  AND  `month`='$monthSel' AND $kpiSqlSel ORDER BY  `name` ASC",$con) or die(mysql_error());
while($rowParams = mysql_fetch_assoc($getParams))
{
    $kpiid = $rowParams["id"];
    $default = $rowParams["default"];
    $max = $rowParams["maximum"];
    $name = $rowParams["name"];
    $marks = $rowParams["marks"];
    $monthDB = $rowParams["month"];
    $yearDB = $rowParams["year"];
    $employeeDB = $rowParams["employee"];

    $allDataPerEmp[$employeeDB][]=array("default"=>$default,"max"=>$max,"name"=>$name,"marks"=>$marks);

    $g++;
}

$dataDisp="";

//print_r($allDataPerEmp);

foreach($allDataPerEmp as $allDataPerEmpKey=>$alldata)
{
    $dataDisptD="";
    $dataDispTH="";
    $maxToShow=0;
    $marksToShow=0;
    foreach($alldata as $alldataKey=>$alldataValue)
    {
            $salaryIdNew=$employeeData[$allDataPerEmpKey]["salaryIdNew"];
            $empName=$employeeData[$allDataPerEmpKey]["empName"];
            $getsalary = mysql_query("SELECT `variablevalue` FROM `salary_structure_relation_new` WHERE `profileid` = '$salaryIdNew' AND `variableid`='7'",$con) or die(mysql_error());
    $rowsalary = mysql_fetch_array($getsalary);
    $perf_allow = $rowsalary[0];
            $default=$alldataValue["default"];
            $max=$alldataValue["max"];
            $name=$alldataValue["name"];
            $marks=$alldataValue["marks"];
            $marksToShow+=$marks;
            $maxToShow+=$max;
            $dataDispTH.=<<<AAA
            <th style="text-align: center">
                <b>$max</b>
                <br> 
                <b>$name</b>
            </th>
AAA;
            $dataDisptD.=<<<AAA
            <td style="text-align: center">
                                $marks
                <br>
                            </td>
AAA;
    }
    $average = round(($marksToShow/$maxToShow)*100);

    $kpiamount =  round($perf_allow*($average/100));

        $monthName = date("F", mktime(0, 0, 0, $monthSel, 10));
        $dataDisp.=<<<AAA

            <tr>
                <td>$empName</td>
                $dataDisptD
                <td>$marksToShow</td>
                <td>$average</td>
                <td>$kpiamount</td>


            </tr>
AAA;


}
?>
<div id="myTitle">
    <div class="title">
        Key Performance Indicator For Month <?=$monthName = date("F", mktime(0, 0, 0, $monthSel, 10))." - ".$yearSel?>
    </div>
    <div class="strip">
        <span>Dashboard</span> <span>Key Performance Indicator</span> <span>View</span>
    </div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td style="width: 30%"></td>
        <td align="right" style="width: 70%">
            <?php
            if(isset($_REQUEST["desig"]))
            {
                ?>
            <button class="button gray" onclick="ToggleBox('viewContent','block','');ToggleBox('manipulateContent','none','')">
                    <i class="back"></i>Back
                </button>
            <?php
            }
            ?>
        </td>
    </tr>
</table>
<div id="mainDivId" style="height:400px; overflow:auto;width:1130px;border:1px">
    <table border="1" cellspacing="0" cellpadding="5" class="fetch" width="100%">
        <thead>
        <tr>
                <th>Name</th>
                <?=$dataDispTH?>
                <th><?=$maxToShow?><br> Total</th>
                <th>%</th>
                <th>PA Amount</th>
        </tr>
        </thead>
        <tbody>
            <?=$dataDisp?>
        </tbody>
    </table>
    <br><br><br><br><br><br><br><br><br>
</div>
