<?php
include("../../include/conFig.php");
?>

<div class="title">Salary Profile</div>
<div class="strip">
    <span>Dashboard</span>
    <span>Salary Profile</span>
    <span>Add New</span>
</div>
<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td style="width:30%"></td>
        <td style="width:70%" align="right">
            <button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"> <i class="back"></i>Back</button>&nbsp;&nbsp;
        </td>
    </tr>
</table>
<div style="overflow-x:hidden;overflow-y:scroll;height:500px">
    <div class="add-new blue-border">
        <div class="form-head blue">
            <div class="head-title">
                <i class="add-form"></i>
                Add Salary Profile</div>
        </div>
        <table cellpadding="0" cellspacing="0" width="100%">
            <thead>
            <tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>
            <tr>
                <th>Profile Name<span>*</span></th>
                <td>
                    <input name="req" class="input medium" data-original-title="first tooltip" type="text"  style="width:240px;" id="salP0">
                    <br>
                </td>
            </tr>
            <tr>
                <th>Select Variable<span>*</span></th>
                <td>
                    <?php

                    $sql = "SELECT `id`,`variable_name`,`updatedate` FROM `salary_structure_variables_new` WHERE `delete`='0' AND `id`";
                    $getData = mysql_query($sql,$con) or die(mysql_error());
                    $varBreakOption="";
                    while($rowValBreak=mysql_fetch_assoc($getData))
                    {
                        $variable_name=$rowValBreak["variable_name"];
                        $id=$rowValBreak["id"];
                        $varBreakOption.=<<<AAA
                                    <option value="$id">$variable_name</option>
AAA;
                    }
                    ?>
                    <select onchange="addSalaryVariables(this,'salP1','addBeforeMe','errorId')" id="salaryVariableHolder" class="input">
                        <option value="0">Please Select Variable</option>
                        <?=$varBreakOption?>
                    </select>
                    <br>

                    <div id="errorId">
                    </div>
                </td>
            </tr>
            <?php


            $varBreakTr="";
            $salP1="";
/*
            $sql = "SELECT `id`,`variable_name`,`updatedate` FROM `salary_structure_variables_new` WHERE `delete`='0' AND `id`";
            $getData = mysql_query($sql,$con) or die(mysql_error());
            $newValue=2;
            while($rowValBreak=mysql_fetch_assoc($getData))
            {
                $variable_name=$rowValBreak["variable_name"];
                $id=$rowValBreak["id"];

                $salP1.="-$id-,";

                $varBreakTr.=<<<AAA
                                <tr id="rowId$id">
                                    <th>$variable_name<span>*</span></th>
                                    <td>
                                        <input class="input medium" name="req" value="0" class="" data-original-title="" type="text"  style="width:240px;" id="salP$newValue"/>
                                            
                                    </td>
                                </tr>
AAA;
                $newValue++;
            }*/

            ?>
            </thead>
            <tbody id="addBeforeMe">
            <input id="salP1" name="req" type="hidden" value="<?=$salP1?>">

            <input name="req" class="input medium" id="checkNumber" type="hidden" value="2">
                <?=$varBreakTr?>
            </tbody>

            <!--
            <tr>
            <th>Basic salary<span>*</span></th>
            <td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="salP0" onchange="var bsal=$('#salP0').val();var pcal=(bsal*12)/100;$('#salP10').val(pcal)"/>
            </td>
            </tr>
            <tr>
            <th>HRA<span>*</span></th>
            <td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="salP9"/></td>
            </tr>
            <tr><th>Conveyance Allowance<span>*</span></th>
            <td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="salP1"/>
            </td>
            </tr>
            <tr>
            <th>QPE<span>*</span></th>
            <td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="salP8"/></td>
            </tr>
            <tr>
            <th>Special Allowance<span>*</span>
            </th>
            <td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="salP2"/>
            </td>
            </tr>
            <tr>
            <th>Other Allowance<span>*</span>
            </th>
            <td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="salP3"/>
            </td>
            </tr>
            <tr>
            <th>KPI<span>*</span></th>
            <td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="salP4"/></td>
            </tr>
            <tr>
            <th>Attendance Allowance<span>*</span></th>
            <td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="salP5"/></td>
            </tr>
            <tr>
            <th>Performance Bonus<span>*</span></th>
            <td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="salP6"/></td>
            </tr>
            <tr>
            <th>Provident Fund<span>*</span></th>
            <td><input class="input medium" name="req" class="" data-original-title="" type="text" readonly  style="width:240px;" id="salP10"/></td>
            </tr>
            <tr>
            <th>Extra<span>*</span></th>
            <td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="salP7"/></td>
            </tr>-->

            <tfoot>
            <tr>
                <td colspan="4" style="text-align:center">
                    <button class="button green" onclick="var myCount=parseInt($('#checkNumber').val()); SaveData('masters/salaryProfile/save','salP',myCount+1,'','','couResp','1');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i>Save</button>
                    <button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>


