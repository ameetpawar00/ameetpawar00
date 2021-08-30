<?php
include("../../include/conFig.php");
include("../../include/leave_calculation.php");
include("../../include/calculateAbsent_trifid.php");
$hms        = "6:45:00";
$eid        = $_GET['eid'];
$mnth       = $_GET['month'];
$empsalid   = $_GET['empsalid'];
$shift      = $_GET['shift'];
$department = $_GET['department'];

$attDetail  = explode("**--**",$_GET['attDetail']);
if (isset($_COOKIE['selectedYear']))
{
    $year = $_COOKIE['selectedYear'];
}
else
{
    $year = date("Y");
}
/**find the first and last date of month**/
$startTime   = date('Y-'.$mnth.'-1');
$endTime     = '';
$monthDays   = cal_days_in_month(CAL_GREGORIAN, $mnth,$year);
$days        = getSundayCount($startTime, $endTime, $monthDays);
$sundayCount = count($days);
$monthName   = date("F", mktime(0, 0, 0, $mnth, 10));
$total_attend= checkin_cal($eid,$mnth,$year);
$attendCount = count($total_attend);
$absDays     = $monthDays - $attendCount;






$readonly="";
$edit_idexrt="";

if(isset($_GET["edit"]))
{
    //$readonly="readonly='readonly'";
    $month = $_GET['month'];
    $year = $_GET['year'];
    $salId = $_GET['editid'];
    $eid        = $_GET['eid'];
    $empsalid   = $_GET['empsalid'];
    $shift      = $_GET['shift'];
    $department = $_GET['department'];

    $getSalarys = mysql_query("SELECT `id`, `employee`, `month`, `year`, `total_days`, `working_days`, `present_days`, `leave_days`, `absent_days`, `lwp`, `unlwp`, `leave_balance`, `latecomes_amount`, `latecomes_mins`, `deduction`, `total_deduction`, `adjustment_amount`, `adjustment_amount_deduct`, `adjustment_mode`, `gross`, `total_salary`, `slip` FROM  `salaryslip_new` where `id` = '$salId' AND `month` = '$month' AND `year` = '$year' AND `delete` = '0'",$con) or die(mysql_error());

    $edit_rowSalaa = mysql_fetch_assoc($getSalarys);
    $edit_id=$edit_rowSalaa["id"];
    $edit_idexrt="&edit_id=$edit_id";
    $edit_employee=$edit_rowSalaa["employee"];
    $edit_month=$edit_rowSalaa["month"];
    $edit_year=$edit_rowSalaa["year"];
    $edit_total_days=$edit_rowSalaa["total_days"];
    $edit_working_days=$edit_rowSalaa["working_days"];
    $edit_present_days=$edit_rowSalaa["present_days"];
    $edit_leave_days=$edit_rowSalaa["leave_days"];
    $edit_absent_days=$edit_rowSalaa["absent_days"];
    $edit_lwp=$edit_rowSalaa["lwp"];
    $edit_unlwp=$edit_rowSalaa["unlwp"];
    $edit_leave_balance=$edit_rowSalaa["leave_balance"];
    $edit_latecomes_amount=$edit_rowSalaa["latecomes_amount"];
    $edit_latecomes_mins=$edit_rowSalaa["latecomes_mins"];
    $edit_deduction=$edit_rowSalaa["deduction"];
    $edit_total_deduction=$edit_rowSalaa["total_deduction"];
    $edit_adjustment_amountAdd=$edit_rowSalaa["adjustment_amount"];
    $edit_adjustment_amountDeduct=$edit_rowSalaa["adjustment_amount_deduct"];
    $edit_adjustment_mode=$edit_rowSalaa["adjustment_mode"];
    $edit_gross=$edit_rowSalaa["gross"];
    $edit_total_salary=$edit_rowSalaa["total_salary"];
    $edit_slip=$edit_rowSalaa["slip"];


    $getSalarysext = mysql_query("SELECT `variableid`, `variablevalue`, `currentvalue` FROM `salaryslip_relation_New` WHERE `salary_slip_id`='$edit_id'",$con) or die(mysql_error());
    while($edit_rowSalaaext = mysql_fetch_assoc($getSalarysext))
    {
        $variableid=$edit_rowSalaaext["variableid"];
        $variablevalue=$edit_rowSalaaext["variablevalue"];
        $currentvalue=$edit_rowSalaaext["currentvalue"];

        $retriveValues[$variableid]=$currentvalue;
    }

}




// condition for QPE sales check
$travel_allow=0;
$obtainqpe=0;
$getworkphone = mysql_query("SELECT `workphone`, `PF`, `ESIC`, `PT`, `TDS`, `LTB`, `depcheck`, `PFFX` FROM `employee` WHERE id = '$eid'",$con) or die(mysql_error());
$rowemp = mysql_fetch_array($getworkphone);
$depcheck=$rowemp["depcheck"];
$ojtStatus=$rowemp["workphone"];
$PF=$rowemp["PF"];
$PFFX=$rowemp["PFFX"];
$ESIC=$rowemp["ESIC"];
$PT=$rowemp["PT"];
$TDS=$rowemp["TDS"];
$LTB=$rowemp["LTB"];

$getStartingNew = mysql_query("SELECT `variableid`, `variablevalue`, `variable_name`, `type` FROM `salary_structure_relation_new`,`salary_structure_variables_new` WHERE `profileid` = '$empsalid' AND salary_structure_relation_new.variableid=salary_structure_variables_new.id ORDER BY variableid",$con) or die(mysql_error());
$htmlRows="";
$fieldCounter=21;
$finalSal=0;
$finalCounter=0;
$basic=0;
$rowCounter=21;
$inpRows="";

if($rowemp["workphone"]==1)
{
    $ojts='';
}
while($rowStartNew=mysql_fetch_assoc($getStartingNew))
{
    $variableid=$rowStartNew["variableid"];
    $variablevalue=$rowStartNew["variablevalue"];
    $variable_name=$rowStartNew["variable_name"];
    $type=$rowStartNew["type"];
   // echo $variableid."--".$variablevalue."--".$variable_name."--".$type."<br>";

   /* $readonly="";
    if(isset($_GET["edit"]))
    {
        $readonly="readonly='readonly'";
    }*/


    if($type==1)
    {
        if($variableid==1 AND $variable_name=="Basic")
        {
            $basic=$variablevalue;
        }
        $finalSal+=$variablevalue;
        if($variableid!=17)
        {
            $finalCounter++;
        }


        $readOnly1='readonly';
        $readOnlyCSS='readonly';
        if($variableid==1)
        {
            $htmlRows.=<<<AAA
                    <th>$variable_name</th>
                    <td>
                        <input name="req"  type="text" $readOnlyCSS  id="sals$fieldCounter" title="isNotNull" class="input inputDisabled varDef$type getMyVal" value="$variablevalue"  $readOnly1>
                    </td>
AAA;
            $inpRows.="-$variableid-,";
            $fieldCounter++;
        }else
        {
            $htmlRows.=<<<AAA
                    <th>
                        $variable_name
                    </th>
                    <td>
                        $variablevalue
                    </td>
AAA;
        }
    }
    elseif($type==2)
    {
        if($variableid==7 AND $variable_name=="KPI") {

            $getKPIpoint = mysql_query("SELECT kpi.marks,kpiparameters.maximum FROM kpi,kpiparameters WHERE kpi.employee = '$eid' AND kpi.month = '$mnth' AND kpi.kpiparameter = kpiparameters.id AND kpi.year = '$year' AND kpiparameters.delete ='0' AND kpi.delete ='0'", $con) or die(mysql_error());
            $obtainkpi = 0;
            $Maxkpi = 0;
            while ($rowKPIpoint = mysql_fetch_array($getKPIpoint)) {
                $obtainkpi += $rowKPIpoint[0];
                $Maxkpi += $rowKPIpoint[1];
            }
            $average = round(($obtainkpi / $Maxkpi) * 100);

            $obtainedvalue = round($variablevalue * ($average / 100));
            $variablevalue= <<<AAA
                Fixed : $variablevalue <br>
                Obtained : $obtainedvalue
AAA;
        }
        if($variableid==4 AND $variable_name=="QPE" AND $depcheck==1) {
            $getQPEpoint = mysql_query("SELECT marks FROM qpe WHERE employee = '$eid' AND month = '$mnth' AND qpe.year = '$year'",$con) or die(mysql_error());
            $rowQPEpoint = mysql_fetch_assoc($getQPEpoint);
            $obtainedvalue= $rowQPEpoint["marks"];
            if(!$obtainedvalue)
            {
                $obtainedvalue=0;
            }
            $variablevalue= <<<AAA
                Fixed : $variablevalue <br>
                Obtained : $obtainedvalue
AAA;
        }

        $readOnly2='readonly';
        $readOnlyCSS='readonly';
        if($variableid==9)
        {
            $readOnly2='';
            $readOnlyCSS='style="border:1px solid grey!important"';
            $getMyVal="";
            if(isset($_GET["edit"]))
            {
                $variablevalue=$retriveValues[$variableid];
            }
            $htmlRows.=<<<AAA
                    <th>$variable_name</th>
                    <td>
                        <input name="req"  type="text" $readOnlyCSS  id="sals$fieldCounter" title="isNotNull" class="input inputDisabled varDef$type $getMyVal" value="$variablevalue"  $readOnly2>
                    </td>
AAA;
            $inpRows.="-$variableid-,";

            $fieldCounter++;
        }else
        {
            $htmlRows.=<<<AAA
                    <th>
                        $variable_name
                    </th>
                    <td>
                        $variablevalue
                    </td>
AAA;
        }
    }elseif($type==3){


        if($ojtStatus!=2) {
            $checkMyStatus = 0;
            if (!$PF AND $variableid == 10 AND $variable_name == "Provident Fund (Employee)") {
                $checkMyStatus = 1;
            }
            if (!$ESIC AND $variableid == 12 AND $variable_name == "ESIC (Employee)") {
                $checkMyStatus = 2;
            }
            if (!$PT AND $variableid == 14 AND $variable_name == "PT") {
                $checkMyStatus = 3;
            }
            if (!$TDS AND $variableid == 18 AND $variable_name == "TDS") {
                $checkMyStatus = 4;
            }
            if (!$LTB AND $variableid == 19 AND $variable_name == "DEDUCTION 1") {
                $checkMyStatus = 5;
            }

            if($checkMyStatus==0)
            {
                $readOnly3 = 'readonly';
                $readOnlyCSS = 'readonly';
                if ($variableid == 16 OR $variableid == 18)
                {
                    $readOnly3 = '';
                    $readOnlyCSS = 'style="border:1px solid grey!important"';
                    $getMyVal = "";

                    if (isset($_GET["edit"])) {
                        $variablevalue = $retriveValues[$variableid];
                    }
                    $htmlRows .= <<<AAA
                        <th>$variable_name</th>
                        <td>
                            <input name="req"  type="text" $readOnlyCSS  id="sals$fieldCounter" title="isNotNull" class="input inputDisabled varDef$type $getMyVal" value="$variablevalue"  $readOnly3>
                        </td>
AAA;
                    $inpRows .= "-$variableid-,";
                    $fieldCounter++;
                } else {
                    $htmlRows .= <<<AAA
                        <th>
                            $variable_name
                        </th>
                        <td>
                            $variablevalue
                        </td>
AAA;
                }
            }
        }

    }


    if($rowCounter%4==0)
    {
        $htmlRows.=<<<AAA
        </tr><tr>
AAA;
    }






    $rowCounter++;
}

$ltb            = 500;
$salperdayNA   = round($finalSal / $monthDays);
$salperhalfNA  = round($salperdayNA / 2);
///Leave Calculations Starts
$checkingAbs   = checkingAbs($mnth,$year,$eid,$shift,$department);
$lateComes     = $checkingAbs['lateComes'];
$approvedlwp   = $checkingAbs['approvedlwp'];
$lMin          = $checkingAbs['lMin'];
$xdates        = $checkingAbs['xdates'];

$salperday     = round($basic / $monthDays);
$salperhalf    = round($salperday / 2);
$latecomededuc = $salperhalfNA * $lateComes;

$totalWorkdays = $monthDays - ($sundayCount + $checkingAbs['sqlCalCount']);

$saldeduc      = ($salperday * $approvedlwp) + ($salperdayNA * $checkingAbs['newAbsDays']);

$SL            = 0;
$CL            = 0;
$EL            = 0;
$M             = 0;
$P             = 0;
$Special       = 0;
$total         = 0;
$total_wl      = 0;
$LWP           = 0;
$getleaveBal   = mysql_query("SELECT `EL`, `M`, `special`, `CL`, `SL`, `P` FROM `leaverecord` WHERE `userid` = '$eid'",$con) or die(mysql_error());
$rowlb     = mysql_fetch_array($getleaveBal);
$getleaveh = mysql_query("SELECT `ltype`,`leave` FROM `allleavestat` WHERE MONTH(`date`) ='$mnth' AND  YEAR(`date`) ='$year' AND `empid` = '$eid'",$con) or die(mysql_error());
while ($rowLeaveh = mysql_fetch_array($getleaveh))
{
    $ltype = $rowLeaveh["ltype"];
    $leave = $rowLeaveh["leave"];

    switch ($ltype) {
        case "SL":
            if ($leave == 2 OR $leave == 3 OR $leave == 4 OR $leave == 5)
            {
                $SL    = $SL + 0.5;
                $total = $total + 0.5;
                $total_wl = $total_wl + 0.5;
            }
            else
            {
                $SL++;
                $total++;
                $total_wl++;
            }
            break;
        case "CL":
            if ($leave == 2 OR $leave == 3 OR $leave == 4 OR $leave == 5)
            {
                $CL    = $CL + 0.5;
                $total = $total + 0.5;
                $total_wl = $total_wl + 0.5;
            }
            else
            {
                $CL++;
                $total++;
                $total_wl++;
            }
            break;
        case "EL":

            if ($leave == 2 OR $leave == 3 OR $leave == 4 OR $leave == 5)
            {
                $EL    = $EL + 0.5;
                $total = $total + 0.5;
                $total_wl = $total_wl + 0.5;
            }
            else
            {
                $EL++;
                $total++;
                $total_wl++;
            }
            break;
        case "M":

            if ($leave == 2 OR $leave == 3 OR $leave == 4 OR $leave == 5)
            {
                $M     = $M + 0.5;
                $total = $total + 0.5;
                $total_wl = $total_wl + 0.5;
            }
            else
            {
                $M++;
                $total++;
                $total_wl++;
            }
            break;
        case "P":
            if ($leave == 2 OR $leave == 3 OR $leave == 4 OR $leave == 5)
            {
                $P     = $P + 0.5;
                $total = $total + 0.5;
                $total_wl = $total_wl + 0.5;
            }
            else
            {
                $P++;
                $total++;
                $total_wl++;
            }
            break;
        case "Special":
            if ($leave == 2 OR $leave == 3 OR $leave == 4 OR $leave == 5)
            {
                $Special = $Special + 0.5;
                $total   = $total + 0.5;
                $total_wl   = $total_wl + 0.5;
            }
            else
            {
                $Special++;
                $total++;
                $total_wl++;
            }
            break;
        case "LWP":
            if ($leave == 2 OR $leave == 3 OR $leave == 4 OR $leave == 5)
            {
                $LWP   = $LWP + 0.5;
                $total = $total + 0.5;
            }
            else
            {
                $LWP++;
                $total++;
            }
            break;
    }
}

$present = $totalWorkdays - ($checkingAbs['newAbsDays']+$total);

///Leave Calculations Ends
///
///
///Edit Data Fetch Starts
///

///Edit Data Fetch Ends
?>
<div class="title">
    <?php
    if(isset($_GET["edit"]))
    {
        echo "Edit Salary Info For";
    }else{
        echo "Add Salary Info For";
    }?>

    <span style="font-weight:bold">
<?php echo $_GET['name']?>
</span> Month
    <span class="maroon" style="font-weight:bold">
<?php echo $monthName?>
</span>
</div>
<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td style="width:30%">
        </td>
        <td style="width:70%" align="right">
            <button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')">
                <i class="back"></i>Back
            </button>&nbsp;&nbsp;
        </td>
    </tr>
</table>
<div style="overflow-x:scroll;overflow-y:scroll;height:500px">
    <div class="add-new blue-border">
        <div class="form-head blue">
            <div class="head-title">
                <div style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;font-size:12px;float:right;display:none" >
                    Previous Leave Record => 12; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Remaining Leave Record => 10;
                </div>
            </div>
        </div>
        <table cellpadding="0" cellspacing="0" width="100%" style="text-align:left">
            <tr>
                <td colspan="8" style="text-align:center">
                    <div style="display:inline-block;" id="couResp"></div>
                </td>
            </tr>
            <tr>
                <td colspan="7" style="text-align:center;font-style:italic;font-weight:lighter">
                    Deduction For One Day Absent(approved) =>  Rs <?php echo $salperday?>/-; Deduction For Half Day Absent(approved) =>  Rs <?php echo $salperhalf?>/-<br/>
                    Deduction For One Day Absent(not approved) =>  Rs <?php echo $salperdayNA?>/-; Deduction For Half Day Absent(not approved) =>  Rs <?php echo $salperhalfNA ?>/-

                </td>
                <td>
                    <?php
                    if ($hrmloggedid == 93)
                    {
                        ?>
                        <button class="button green" onclick="var adret=$('#det_date').html(); $('#viewmoodleContent').html(adret);ToggleBox('bigMoodle','block','');ToggleBox('viewmoodleContent','block','')" style="float: right;width: 100%;">
                            <?=$xdates?> Deduction Dates
                        </button>

                        <button class="button blue" onclick="var adret=$('#det_late').html(); $('#viewmoodleContent').html(adret);ToggleBox('bigMoodle','block','');ToggleBox('viewmoodleContent','block','')" style="float: right;width: 100%;">
                            <?=$lMin?> Late Coming
                        </button>
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th>
                    Total Days In Month
                </th>
                <td>
                    <input name="req1"  type="text"  id="sals0" title="isNotNull"  class="inputDisabled" value="<?php echo $monthDays?>" readonly="readonly" size="20">
                </td>
                <th>
                    Working Days
                </th>
                <td>
                    <input name="req"  type="text"   id="sals1" title="isNotNull" class="inputDisabled" value="<?php echo $totalWorkdays?>" <?=$readonly;?>>
                </td>
                <th>
                    Present Days
                </th>
                <td>
                    <input name="req"  type="text"  id="sals2" title="isNotNull" class="inputDisabled" value="<?php if(isset($_GET["edit"])){echo $edit_present_days;}else{echo $present;}?>"  <?=$readonly;?>>
                </td>
                <th>
                    Total Absent Days
                </th>
                <td>
                    <input name="req"  type="text"  readonly="" id="sals3" title="isNotNull" class="inputDisabled"    <?=$readonly;?>value="<?php if(isset($_GET["edit"])){echo $edit_absent_days;}else{echo ($total + $checkingAbs['newAbsDays']);}?>">

                    <input name="req"  type="hidden"   id="sals4" title="isNotNull" class="inputDisabled" value="<?php if(isset($_GET["edit"])){ echo $edit_leave_days;}else{ echo $total_wl; } ?>"    <?=$readonly;?> />
                </td>
            </tr>
            <tr>
                <th>
                    Absent Days(Approved)
                </th>
                <td>
                    <input name="req"  type="text" style="width: 30px;" id="sals5" title="isNotNull"  class="input middle" value="<?php if(isset($_GET["edit"])){echo $edit_lwp;}else{echo $approvedlwp;}?>" onkeyup="calculatesalaryApp('sals3','sals5','sals6','sals15','sals0','sals16')" <?=$readonly;?>>

                </td>
                <th>
                    Absent Days(Not Approved)
                </th>
                <td>
                    <input name="req"  type="text"  style="width: 30px;" id="sals6" title="isNotNull" class="input middle" value="<?php if(isset($_GET["edit"])){echo $edit_unlwp;}else{ echo $checkingAbs['newAbsDays'];}?>" onkeyup="calculatesalaryApp('sals3','sals5','sals6','sals15','sals0','sals16')" <?=$readonly;?>>
                </td>
                <th style="display:">
                    Late coming Minutes
                </th>
                <td style="display:">
                    <input name="req"  type="text" style="width: 30px;"  id="sals7" title="isNotNull" class="inputDisabled" value="<?php if(isset($_GET["edit"])){echo $edit_latecomes_mins;}else{ echo $lMin;}?>" readonly="readonly">
                </td>
                <th style="display:">
                    Late come Deduction
                </th>
                <td style="display:">
                    <input name="req"  type="text" style="width: 30px;"  id="sals8" title="isNotNull" class="inputDisabled" value="<?php if(isset($_GET["edit"])){echo $edit_latecomes_amount;}else{ echo $latecomededuc;}?>" readonly="readonly">
                </td>
            </tr>
            <tr>
                <td colspan="8">
                    <div class="add-new blue-border">
                        <div class="form-head blue">
                            <div class="head-title">
                                Leave Balance
                            </div>
                        </div>
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <th>
                                    Earned Leave
                                </th>
                                <td>
                                    <input name="req"   <?=$readonly;?> type="text"  id="sals9" style="width:50px" class="input middle" value="<?=$EL?>" onkeyup="calculateLeave(this.id,'sals3','sals25','sals26','sals27','sals28','sals29','sals30','el')">&nbsp;&nbsp;<input name="req"  type="text" readonly="readonly" id="el" style="width:50px" class="inputDisabled" value="<?php echo $rowlb['EL']?>" onkeyup="" title="Available"  <?=$readonly;?>>
                                </td>
                                <th>
                                    Casual Leave
                                </th>
                                <td>
                                    <input name="req" readonly=""  type="text"  id="sals10" style="width:50px" class="input middle" value="<?=$CL?>" onkeyup="calculateLeave(this.id,'sals3','sals25','sals26','sals27','sals28','sals29','sals30','cl')">&nbsp;&nbsp;<input name="req"  type="text" readonly="readonly" id="cl" style="width:50px" class="inputDisabled" value="<?php echo $rowlb['CL']?>" onkeyup="" title="Available" <?=$readonly;?>>
                                </td>
                                <th>
                                    Sick Leave
                                </th>
                                <td>
                                    <input name="req"   <?=$readonly;?>  type="text"  id="sals11" style="width:50px" class="input middle" value="<?=$SL?>" onkeyup="calculateLeave(this.id,'sals3','sals25','sals26','sals27','sals28','sals29','sals30','sl')">&nbsp;&nbsp;<input name="req"  type="text" readonly="readonly" id="sl" style="width:50px" class="inputDisabled" value="<?php echo $rowlb['SL']?>" onkeyup="" title="Available" <?=$readonly;?>>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Special
                                </th>
                                <td>
                                    <input name="req" readonly=""  type="text"  id="sals12" style="width:50px" class="input middle" value="<?=$Special?>" onkeyup="calculateLeave(this.id,'sals3','sals25','sals26','sals27','sals28','sals29','sals30','sp')"  <?=$readonly;?>>&nbsp;&nbsp;<input name="req"  type="text" readonly="readonly" id="sp" style="width:50px" class="inputDisabled" value="<?php echo $rowlb['special']?>" onkeyup="" title="Available" <?=$readonly;?>>
                                </td>
                                <th>
                                    Maternity
                                </th>
                                <td>
                                    <input name="req"   <?=$readonly;?>  type="text"  id="sals13" style="width:50px" class="input middle" value="<?=$M?>" onkeyup="calculateLeave(this.id,'sals3','sals25','sals26','sals27','sals28','sals29','sals30','ml')">&nbsp;&nbsp;<input name="req"  type="text" readonly="readonly" id="ml" style="width:50px" class="inputDisabled" value="<?php echo $rowlb['M']?>" onkeyup="" title="Available" <?=$readonly;?>>
                                </td>
                                <th>
                                    Paternity
                                </th>
                                <td>
                                    <input name="req"   <?=$readonly;?> type="text"  id="sals14" style="width:50px" class="input middle" value="<?=$P?>" onkeyup="calculateLeave(this.id,'sals3','sals25','sals26','sals27','sals28','sals29','sals30','pl')">&nbsp;&nbsp;<input name="req"  type="text" readonly="readonly" id="pl" style="width:50px" class="inputDisabled" value="<?php echo $rowlb['P']?>" onkeyup="" title="Available" <?=$readonly;?>>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    Deduction
                </th>
                <td>
                    <input name="req"  type="text"  id="sals15" title="isNotNull" class="inputDisabled" value="<?php if(isset($_GET["edit"])){echo $edit_deduction;}else{ echo $saldeduc;}?>" readonly="readonly">
                </td>
                <th>
                    Balance leave
                </th>
                <td>
                    <input name="req" class="input inputDisabled" style="border: 1px solid grey!important" type="text"  id="sals16" title="isNotNull" value="<?php if(isset($_GET["edit"])){echo $edit_leave_balance;}else{ echo 0;}?>" onkeyup="calculatesalaryApp('sals3','sals5','sals6','sals15','sals0','sals16')" <?=$readonly;?>>
                    <div style="z-index:20000000000000000000;float:right">
                        <div class="button green" style="position:fixed;right:0px;cursor:pointer;padding:4px;" onclick="getModule('management/salary/story/view?eid=<?php echo $eid?>&name=<?php echo $_GET['name']?>','manipulatemoodleContent','viewmoodleContent','Story Line')">
                            Story
                        </div>
                    </div>
                </td>
                <th style="height: 26px">
                    Adjustment (Add)
                </th>
                    <?php

                    if(isset($_GET["edit"]))
                    {
                        $sad="";
                        $sded="";
                        if($edit_adjustment_mode=="Deduct")
                        {
                            $edit_adjustment_amountDeduct=$edit_adjustment_amountAdd;
                            $edit_adjustment_amountAdd=0;
                        }
                    }
                    ?>

                <td style="height: 26px">
                    <input name="req" id="sals17" type="text" style="width:100px;border-color:green" title="isNotNull" class="input" value="<?php if(isset($_GET["edit"])){echo $edit_adjustment_amountAdd;}else{echo 0;}?>" onkeypress="return chkNumbers(event)" autocomplete="off">
                </td>
                <th style="height: 26px">
                    Adjustment (Deduct)
                </th>
                <td style="height: 26px">
                    <input name="req" id="sals18" type="text" style="width:100px;border-color:red" title="isNotNull" class="input" value="<?php if(isset($_GET["edit"])){echo $edit_adjustment_amountDeduct;}else{echo 0;}?>" onkeypress="return chkNumbers(event)" autocomplete="off">
                    <input name="req" id="sals19" type="hidden" style="width:100px;border-color:red"   title="isNotNull" class="input" value="<?php if(isset($_GET["edit"])){echo $finalSal;}else{echo $finalSal;}?>" readonly>


                </td>
            </tr>
            <tr>
                <?=$htmlRows?>
                <input value="<?=$inpRows?>" name="req"  id="sals20" type="hidden"/>
            </tr>
            <?php
           // echo $inpRows;

            $edt="";
            if(isset($_GET["edit"]))
            {
                $edt='edit=1';
            }

            $ojts='&ojts=1';
            if($rowemp["workphone"]==1)
            {
                $ojts='';
            }
            ?>
            <tr>
                <td colspan="6" style="text-align:center">
                    <button class="button green" onclick="var r=confirm('Are You Sure You Want To Save Salary ! Then You Will Not Able to Update Attendance and Salary Profile'); if(r==true){ SaveData('management/salary/save?finalCounter=<?=$finalCounter?>&eid=<?=$eid?><?=$edit_idexrt?>&month=<?=$mnth?>&year=<?=$year?>&<?=$edt?><?=$ojts?>','sals','<?=$fieldCounter?>','salary--**--<?php echo $mnth?>','','couResp','1'); }">
                        <i class="save-icon">
                        </i>Save
                    </button>
                    <button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')">
                        <i class="close-icon">
                        </i>Cancel
                    </button>
                </td>
            </tr>
        </table>
        <br>
        <br>
        <br>
        <br>
    </div>
</div>