<?php require_once("../include/conFig.php"); ?>
<style>
	::-webkit-scrollbar{
		height: 5px !important;
	}
</style>
<?php

$yearSel=$year;
$monthSel=date("m")-1;

$monthSel = sprintf("%02d", $monthSel);

if(isset($_REQUEST["desig"]))
{
    $yearSel=$_REQUEST["syear"];
    $monthSel=$_REQUEST["smonth"];
    $desig=$_REQUEST["desig"];
}
$empId="";
$empIdSQlCheck="";
if(isset($_REQUEST["empId"]))
	{
    $empId=$_REQUEST["empId"];
    $empIdSQlCheck="AND id=$empId";
}
//echo $empIdSQlCheck;

$queryEmpData = "SELECT employee.id,employee.name,employee.salaryIdNew,employee.designation FROM employee WHERE employee.delete = 0 AND employee.empstatus = 2 $empIdSQlCheck ORDER BY employee.name ASC";
$getDesig = mysql_query($queryEmpData,$con) or die(mysql_error());
while($rowDesig = mysql_fetch_array($getDesig))
{
    $name=$rowDesig["name"];
    $salaryIdNaew=$rowDesig["salaryIdNew"];
    $id=$rowDesig["id"];
    $designation=$rowDesig["designation"];
    $employeeData[$id]=array("empName"=>$name,"salaryIdNew"=>$salaryIdNaew);
    if($designation==$desig)
	{
/*        echo "<br><br>---";
        echo $designation;
        echo "<br><br>***";*/
        $allEmpId.=$id.",";
    }
}

$kpiSqlSel="";
if($empId)
{
    $kpiSqlSel="kpi.employee=$empId";
}
if($allEmpId)
{
    $allEmpId=rtrim($allEmpId,",");
    $kpiSqlSel="kpi.employee IN($allEmpId)";
}

if($desig)
{
    $DesKpiKeyCheckPara=array();
    $queryDataPara = "SELECT `kpiparameters`.`id`,`kpiparameters`.`default`,`kpiparameters`.`maximum`,`kpiparameters`.`name` FROM `kpiparameters` WHERE `kpiparameters`.`id` AND `kpiparameters`.`delete` = '0' AND `kpiparameters`.`id` != '1' AND `designation` LIKE '%-$desig-%' ORDER BY  `kpiparameters`.`name` ASC";
    $getParams = mysql_query($queryDataPara,$con) or die(mysql_error());
    while($rowParams = mysql_fetch_assoc($getParams))
    {
        $kpiid = $rowParams["id"];
        $default = $rowParams["default"];
        $max = $rowParams["maximum"];
        $name = $rowParams["name"];
        $marks = $rowParams["marks"];
        $DesKpiPara[]=array("kpiid"=>$kpiid,"default"=>$default,"max"=>$max,"name"=>$name,"marks"=>$marks);

        if(!in_array($kpiid,$DesKpiKeyCheckPara))
        {
            $DesKpiKeyCheckPara[]=$kpiid;
        }
        $g++;
    }
}

$g=0;
$thrrt="";

$maxToShow=0;
$marksToShow=0;
$paracheck=array();

if($kpiSqlSel)
{
    $queryXYZ = "SELECT kpiparameters.id,kpiparameters.default,kpiparameters.maximum,kpiparameters.name,`marks`,`month`,`year`,`employee` FROM kpiparameters,kpi WHERE kpiparameters.id=kpi.kpiparameter AND kpiparameters.delete = '0' AND kpiparameters.id != '1'  AND  `year`='$yearSel'  AND  `month`='$monthSel' AND $kpiSqlSel ORDER BY  `name` ASC";
    $getParams = mysql_query($queryXYZ,$con) or die(mysql_error());
    $employeeChwekcerDB=array();
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
        if(in_array($kpiid,$DesKpiKeyCheckPara))
        {
            $allDataPerEmp[$employeeDB][]=array("kpiid"=>$kpiid,"default"=>$default,"max"=>$max,"name"=>$name,"marks"=>$marks);
        }

        if(!in_array($employeeDB,$employeeChwekcerDB))
        {
            $employeeChwekcerDB[]=$employeeDB;
        }
        if(!in_array($kpiid,$paracheck))
        {
            $paracheck[]=$kpiid;
        }
    }
}

if($allEmpId)
{
    $allEmpIdAr=explode(",",$allEmpId);
}

    if($allEmpIdAr)
    {
        foreach($allEmpIdAr as $allEmpIdArKey)
        {
            if(!in_array($allEmpIdArKey,$employeeChwekcerDB))
            {
           // echo $allEmpIdArKey."<br><br>";
                $allDataPerEmp[$allEmpIdArKey]=$DesKpiPara;
            }
        }
    }

$dataDisp="";

$i = 1;
$j = 1;
$kpiIdcheck=array();
foreach($allDataPerEmp as $allDataPerEmpKey=>$alldata)
{
    $userids .= $allDataPerEmpKey.",";
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
        $kpiida=$alldataValue["kpiid"];
        $marksToShow+=$marks;
        $maxToShow+=$max;
        $dataDispTH.=<<<AAA
            <th style="text-align: center">
                <b>$max</b>
                <br> 
                <b>$name</b>
            </th>
AAA;
        $jp1=$j+1;

        if(!$marks){ $marks=$default; }

        if(!in_array($kpiida,$kpiIdcheck))
        {
            $g++;
            $kpiIdcheck[]=$kpiida;
        }

        $dataDisptD.=<<<AAA
            <td style="text-align: center">
                
                <input id="kpi$j" title="isNotNull" type="hidden" value="$kpiida" />
			    <input id="kpi$jp1" name="reqisnum" style="width: 30px;" title="isNotNull" type="text" value="$marks" onblur="checkValue('$max',this.value,this.id);">
					</td>
AAA;
        $j=$jp1;
							$j++;
    }
    $average = round(($marksToShow/$maxToShow)*100);
    $kpiamount =  round($perf_allow*($average/100));
					
    $monthName = date("F", mktime(0, 0, 0, $monthSel, 10));
    $dataDisp.=<<<AAA
            <tr>
                <td>
                    $empName    
                </td>
                $dataDisptD
                <td>
                    <input id="" name="reqisnum" style="width: 30px;" class="inputDisabled" title="isNotNull" type="text" value="$marksToShow" readonly="readonly">
                </td>
                <td>
                    <input id="" name="reqisnum" style="width: 30px;" class="inputDisabled" title="isNotNull" type="text" value="$average" readonly="readonly">
                </td>
                <td>
                    <input id="" name="reqisnum" style="width: 30px;" class="inputDisabled" title="isNotNull" type="text" value="$kpiamount" readonly="readonly">
                </td>
            </tr>
AAA;

    $i++;
    $Maxid = $allDataPerEmpKey;
        $MaxI = $i;
        $marksToShow = 0;
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

    <input id="kpi0" name="nouse" type="hidden" />
		<tr>
			<td colspan="<?php echo $g?>" style="text-align: center">

            <button class="button green" onclick="SaveData('kpi/saveMass?userids=<?php echo $userids?>&amp;g=<?php echo $g;?>&amp;smonth=<?php echo $monthSel;?>&amp;syear=<?php echo $yearSel;?>','kpi','<?php echo $j?>','','','myResp','1')">
					Save</button></td>
		</tr>
		<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
	</table>
<div id="mainDivId" style="height:400px; overflow:auto;width:1130px;border:1px">

    <table class="display dataTable kpiCheck" width="100%" cellspacing="0"  id="myTable_newa">
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