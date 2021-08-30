<?php
include_once("../../include/conFig.php");


if (isset($_COOKIE['selectedYear'])) //if($_GET['selectedYear'])
{
    $sYear = $_COOKIE['selectedYear'];
    //$sYear  = $_GET['selectedYear'];
} else {
    $sYear = date("Y");
    setcookie("selectedYear", $sYear, $expire, "/");
}
if ($_GET['month']) {
    $mnth = $_GET['month'];
} else {
    $mnth = date('m');
    //$mnth=$mnth;
}
//echo $mnth;
$sql = "SELECT `id`,`name`,`salaryIdNew`, `shift`, `department`, `branch` from `employee` where `delete` = '0' AND `active` = '1' AND `empstatus` = '2' AND YEAR(`doj`)<='$sYear' AND YEAR(`doj`)<='$sYear' order by `name` asc";


?>
<div class="title">Salary Management</div>
<div class="strip">
    <span>Dashboard</span>
    <span>Management</span>
    <span>Salary Management</span>
</div>

<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td style="width:30%"></td>
        <td style="width:70%" align="right">
            <select onchange="$('.branchall').hide();$('.branch'+this.value).show();" class="input" style="display:">
                <option value='all'>All</option>
                <?php
                $chkbr = mysql_query("SELECT `id`, `name`, `description`, `createdate`, `modifieddate`, `updatedby`, `delete` FROM `branch` WHERE `delete`='0'", $con) or die(mysql_error());
                while ($rowSlipchkbr = mysql_fetch_assoc($chkbr)) {
                    $ckbrid = $rowSlipchkbr["id"];
                    $ckbrname = $rowSlipchkbr["name"];
                    echo "<option value='$ckbrid'>$ckbrname</option>";
                }
                ?>
            </select>
            <input type="text" id="myInput" class="input" onkeyup="myFunction()" placeholder="Search for names..">
            <div class="" style="display:inline-block">Select Year
                <select class="input drop-down" name="Select1" id="syear">
                    <?php
                    $currentY = date('Y');
                    $lastY = $currentY - 5;

                    for ($j = $currentY; $j >= $lastY; $j--) {
                        ?>
                        <option <?php if ($sYear == $j) {
                            echo 'selected=selected';
                        } ?> value="<?php echo $j ?>"><?php echo $j ?></option>
                        <?php
                    }
                    ?>
                </select></div>
            <div class="" style="display:inline-block">Select Month <select class="input drop-down" name="Select1"
                                                                            id="month_sel_sal">
                    <option <?php if ($mnth == '01') {
                        echo 'selected=selected';
                    } ?> value="01">January
                    </option>
                    <option <?php if ($mnth == '02') {
                        echo 'selected=selected';
                    } ?> value="02">February
                    </option>
                    <option <?php if ($mnth == '03') {
                        echo 'selected=selected';
                    } ?> value="03">March
                    </option>
                    <option <?php if ($mnth == '04') {
                        echo 'selected=selected';
                    } ?> value="04">April
                    </option>
                    <option <?php if ($mnth == '05') {
                        echo 'selected=selected';
                    } ?> value="05">May
                    </option>
                    <option <?php if ($mnth == '06') {
                        echo 'selected=selected';
                    } ?> value="06">June
                    </option>
                    <option <?php if ($mnth == '07') {
                        echo 'selected=selected';
                    } ?> value="07">July
                    </option>
                    <option <?php if ($mnth == '08') {
                        echo 'selected=selected';
                    } ?> value="08">August
                    </option>
                    <option <?php if ($mnth == '09') {
                        echo 'selected=selected';
                    } ?> value="09">September
                    </option>
                    <option <?php if ($mnth == '10') {
                        echo 'selected=selected';
                    } ?> value="10">October
                    </option>
                    <option <?php if ($mnth == '11') {
                        echo 'selected=selected';
                    } ?> value="11">November
                    </option>
                    <option <?php if ($mnth == '12') {
                        echo 'selected=selected';
                    } ?> value="12">December
                    </option>
                </select></div>
            <div class="" style="display:inline-block">
                <input type="button" onclick="selectYear(document.getElementById('syear').value)" value="Go" style="
    padding: 7px 15px;
    background: green;
    color: #fff;
    font-size: 12px;
    font-weight: 600;
    border: 0;
">
            </div>
            <div style="display:inline-block">
                <button class="button gray" style="display:none"
                        onclick="ToggleBox('manipulateContent','block','');ToggleBox('viewContent','none','')"><i
                            class="back"></i>Back
                </button>&nbsp;&nbsp;
            </div>
        </td>
    </tr>
</table>

<div style="height:350px;overflow:auto" id="mainDivId">
    <table width="100%" cellpadding="5" cellspacing="0" class="fetch" id="mytable">
        <tr>
            <th style="width:5%; height: 30px;"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"
                                                       type="checkbox"/></th>
            <th style="width:130px; height: 30px;">Employee Name</th>
            <th style="height: 30px">Status</th>
            <th style="height: 30px">Remark</th>
            <th style="height: 30px">Attendance</th>
            <th style="height: 30px">Excel</th>
            <!--<th style="height: 30px">Report</th>-->
        </tr>
        <?php
        $chkSal = mysql_query("select `id`,`month`,`year`,`employee` from `salaryslip_new` where `month` = '$mnth' and `delete` = '0' and `year` = '$sYear'", $con) or die(mysql_error());
        if (mysql_num_rows($chkSal) > 0) {
            while ($rowSliapNew = mysql_fetch_array($chkSal)) {
                $employee = $rowSliapNew["employee"];
                $old_sal_slips[$employee] = $rowSliapNew;

            }

        }

        $chkSalOld = mysql_query("select `id`,`month`,`year`,`employee` from `salaryslip` where `month` = '$mnth' and `delete` = '0' and `year` = '$sYear'", $con) or die(mysql_error());
        if (mysql_num_rows($chkSalOld) > 0) {
            while ($rowSliapOld = mysql_fetch_array($chkSalOld)) {
                $employeeold = $rowSliapOld["employee"];
                $old_sal_slipsOld[$employeeold] = $rowSliapOld;
                //print_r($old_sal_slipsOld);
            }

        }

        $getkpiEntry = mysql_query("SELECT `id`,`employee`  FROM `kpi` WHERE `month` = '$mnth' AND `delete` = '0'", $con) or die(mysql_error());
        if (mysql_num_rows($getkpiEntry) > 0) {
            while ($rowgetkpiEntry = mysql_fetch_array($getkpiEntry)) {
                $employeea = $rowgetkpiEntry["employee"];
                $allkpis[$employeea] = $rowgetkpiEntry;
                //print_r($rowSlip);
            }
        }

        $i = 1;

        $values = mysql_query($sql, $con) or die(mysql_error());
        while ($row = mysql_fetch_array($values)) {
            $eid = $row[0];
            $empsalid = $row[2];
            $shift = $row[3];
            $department = $row[4];
            $branch = $row[5];
            ?>
            <tr class="d<?php echo $i % 2 ?> branchall branch<?= $branch ?>" id="fetchrow<?php echo $i ?>">
                <td style="height: 30px"><input id="chBx<?php echo $i; ?>" name="Checkbox1" type="checkbox"
                                                value="<?php echo $row[0]; ?>"/></td>
                <td style="color:#000;width:130px; height: 30px;"><?php echo $row[1] ?></td>
                <td style="color:#000;width:120px; height: 30px;">
                    <?php
                    //$chkSal = mysql_query("select `id`,`month`,`year` from `salaryslip` where `employee` = '$eid' and `month` = '$mnth' and `delete` = '0' and `year` = '$sYear'",$con) or die(mysql_error());

                    //if(mysql_num_rows($chkSal) > 0)

                    if ($old_sal_slips[$eid]) {
                        $rowSlip = $old_sal_slips[$eid];
                        //$rowSlip = mysql_fetch_array($chkSal);
                        if (in_array('s_MSalary', $thisper)) {
                            ?>
                            <a href="employee/salarySlipview.php?id=<?php echo base64Custom($rowSlip[0]); ?>&month=<?php echo base64Custom($rowSlip[1]) ?>&year=<?php echo base64Custom($rowSlip[2]) ?>&employee=<?php echo base64Custom($eid) ?>"
                               target="_blank">View Salary</a>

                            <div class="active" style="width:70px; height: 38px;color:green!important"
                                 onclick="getModule('management/salary/index?eid=<?php echo $row[0] ?>&empsalid=<?php echo $empsalid ?>&month=<?php echo $mnth ?>&name=<?php echo $row[1] ?>&attDetail=<?php echo $attDetail ?>&shift=<?php echo $shift ?>&department=<?php echo $department ?>&year=<?php echo $sYear ?>&editid=<?php echo $rowSlip[0]; ?>&edit=1','manipulateContent','viewContent','Manage Salary')">
                                Edit Salary
                            </div>
                            <?php
                        }

                    } elseif($old_sal_slipsOld[$eid]) {
                        $rowSlipa = $old_sal_slipsOld[$eid];
                        //print_r($old_sal_slipsOld[$eid]);
                        if (in_array('s_MSalary', $thisper)) {
                            ?>
                            <a href="employee/salarySlipview.php?old=<?=base64Custom(1); ?>&id=<?php echo base64Custom($rowSlipa[0]); ?>&month=<?php echo base64Custom($rowSlipa[1]) ?>&year=<?php echo base64Custom($rowSlipa[2]) ?>&employee=<?php echo base64Custom($eid) ?>"
                               target="_blank">
                                View Salary
                            </a>
                            <?php
                        }
                    }else{
                        ?>
                        <?php if (in_array('a_MSalary', $thisper)) {
                            /*
                        //echo "SELECT `id`  FROM `kpi` WHERE `employee` = '$eid' AND `month` = '$mnth' AND `delete` = '0'";
                        $getkpiEntry = mysql_query("SELECT `id`  FROM `kpi` WHERE `employee` = '$eid' AND `month` = '$mnth' AND `delete` = '0'",$con) or die(mysql_error());*/
                            if ($allkpis[$eid]) {

                                ?>
                                <div class="deactive" style="width:70px"
                                     onclick="getModule('management/salary/index?eid=<?php echo $row[0] ?>&empsalid=<?php echo $empsalid ?>&month=<?php echo $mnth ?>&name=<?php echo $row[1] ?>&attDetail=<?php echo $attDetail ?>&shift=<?php echo $shift ?>&department=<?php echo $department ?>','manipulateContent','viewContent','Manage Salary')">
                                    Add Salary
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="deactive" style="width:70px"
                                     onclick="getModule('management/salary/index?eid=<?php echo $row[0] ?>&empsalid=<?php echo $empsalid ?>&month=<?php echo $mnth ?>&name=<?php echo $row[1] ?>&attDetail=<?php echo $attDetail ?>&shift=<?php echo $shift ?>&department=<?php echo $department ?>','manipulateContent','viewContent','Manage Salary')">
                                    Add Salary
                                </div>

                                <?php
                            }
                        }
                        ?>

                        <?php
                    }
                    ?>
                    <!--
<td style="color:#000;width:119px; height: 30px;">
<span style="float:right;vertical-align:top"><a style="text-align:right" href="management/salary/getexcel.php?eid=<?php echo $row[0] ?>&month=<?php echo $mnth ?>&name=<?php echo $row[1] ?>&attDetail=<?php echo $attDetail ?>"><button class="green button"><i class="file"></i> Get Excel</button></a></span>
</td>-->
                </td>
                <td style="color:#000;width:120px; height: 30px;">
                    <?php
                        $chkSald = mysql_query("SELECT `id`, `description` FROM `salary_description` WHERE `month` = '$mnth' AND `year` = '$sYear' AND `employeeid` = '$row[0]' AND `status` = '0' ORDER BY `updatedate` DESC", $con) or die(mysql_error());
                        if (mysql_num_rows($chkSald) > 0)
                        {
                            $rowSlipd = mysql_fetch_array($chkSald);
                            $did = $rowSlipd['id'];
                            $ddescription = $rowSlipd['description'];
                            ?>
                            <h3><?= $ddescription ?></h3>
                            <br>
                            <textarea id="comment<?= $rowSlip[0] . $row[0] ?>0"
                                      style="display: none"><?= $ddescription ?></textarea>
                            <br>
                            <input class="button green" style="display: none"
                                   onclick="SaveData('management/salary/save_desc?eid=<?php echo $row[0] ?>&sal_id=<?php echo $rowSlip[0] ?>&did=<?= $did ?>&month=<?=$mnth?>&year=<?=$sYear?>','comment<?= $rowSlip[0] . $row[0] ?>','1','salary--**--<?php echo $mnth ?>','','','1')"
                                   type="button" id="comment<?= $rowSlip[0] . $row[0] ?>0b" value="Submit"/>

                            <input class="button red"
                                   onclick="$('#comment<?= $rowSlip[0] . $row[0] ?>0').hide();$('#comment<?= $rowSlip[0] . $row[0] ?>0b').hide();$('#comment<?= $rowSlip[0] . $row[0] ?>0bvdel').show();$('#comment<?= $rowSlip[0] . $row[0] ?>0bvedit').show();$(this).hide();"
                                   type="button" value="Cancel" style="display: none"
                                   id="comment<?= $rowSlip[0] . $row[0] ?>0bv"/>
                            <input class="button blue"
                                   onclick="$('#comment<?= $rowSlip[0] . $row[0] ?>0').show();$('#comment<?= $rowSlip[0] . $row[0] ?>0b').show();$('#comment<?= $rowSlip[0] . $row[0] ?>0bv').show();$(this).hide();$('#comment<?= $rowSlip[0] . $row[0] ?>0bvdel').hide()"
                                   type="button" value="Edit" id="comment<?= $rowSlip[0] . $row[0] ?>0bvedit"/>
                            <input class="button red" onclick="SaveData('management/salary/save_desc?eid=<?php echo $row[0] ?>&sal_id=<?php echo $rowSlip[0] ?>&did=<?= $did ?>&del=1&month=<?=$mnth?>&year=<?=$sYear?>','comment<?= $rowSlip[0] . $row[0] ?>','1','salary--**--<?php echo $mnth ?>','','','1')"
                                   id="comment<?= $rowSlip[0] . $row[0] ?>0bvdel" type="button" value="Delete"/>
                            <?php
                        } else {
                            ?>
                            <textarea id="comment<?= $rowSlip[0] . $row[0] ?>0"></textarea>
                            <br>
                            <input class="button green"
                                   onclick="SaveData('management/salary/save_desc?eid=<?php echo $row[0] ?>&sal_id=<?php echo $rowSlip[0] ?>&month=<?=$mnth?>&year=<?=$sYear?>','comment<?= $rowSlip[0] . $row[0] ?>','1','salary--**--<?php echo $mnth ?>','','','1')"
                                   type="button" value="Submit"/>
                            <?php
                        }

                    ?>
                </td>

                <td style="color:#000;width:120px; height: 30px;">
                    <div class="active" style="width:70px; height: 38px;"
                         onclick="getModule('management/salary/getexcel?eid=<?php echo $eid ?>&smonth=<?php echo $mnth ?>&year=<?php echo $sYear ?>','manipulatemoodleContent','viewmoodleContent','View Salary')">
                        View Attendance
                    </div>
                </td>
                <td style="color:#000;width:120px; height: 30px;">
                    <?php
                    if (in_array('e_salary', $thisper)) {
                        ?>
                        <a href="employee/salarySlipview.php?id=<?php echo base64Custom($rowSlip[0]); ?>&month=<?php echo base64_encode($rowSlip[1]) ?>&year=<?php echo base64_encode($rowSlip[2]) ?>&employee=<?php echo base64_encode($eid) ?>&exceldown=1"
                           target="_blank">Get Excel</a>
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <?php
            $finalSal = 0;
            $gross = 0;
            $hra = 0;
            $conv = 0;
            $bonus = 0;
            $pf = 0;
            $claim = 0;
            $ins = 0;

            $i++;
            $Maxid = $row[0];
            $MaxI = $i;
        }
        ?>

        <input id="fetchData" name="Text1" style="display: none" type="text"
               value="<?php echo $Maxid . '--' . $MaxI; ?>"/>
    </table>
</div>

