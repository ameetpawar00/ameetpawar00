<?php
include("../../include/conFig.php");
$id = $_GET['id'];
$i = $_GET['i'];

$getData = mysql_query("SELECT `profileName` FROM `salary_structure_new` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);

$getDataVarNames = mysql_query("SELECT `variableid`,`variablevalue`,`variable_name` FROM `salary_structure_relation_new`,`salary_structure_variables_new` WHERE `salary_structure_relation_new`.`variableid`=`salary_structure_variables_new`.`id` AND `profileid` = '$id' ORDER BY variableid ASC",$con) or die(mysql_error());

$varCounter=2;
$htmlContent="";
$uniqueContent="";
$basicValue=0;
$allArray=array();
while($rowDataVarNames = mysql_fetch_array($getDataVarNames))
{
    $variableid=$rowDataVarNames['variableid'];
    $variablevalue=$rowDataVarNames['variablevalue'];
    $variable_name=$rowDataVarNames['variable_name'];

    $allArray[]=$variableid;
    if($variableid==1)
    {
        $basicValue=$variablevalue;
    }




    $htmlContent.=<<<AAA
                    <tr id="rowId$variableid">
                        <th>$variable_name<span>*</span></th>
                        <td>
                            <input class="input medium" name="req" value="$variablevalue" type="text"  style="width:240px;" id="salP$varCounter"/>
                            <span onclick="removeSalaryVariables('$variableid','salP1')" class="smallCloseButton" >X</span>
                        </td>
                    </tr>
AAA;

    $uniqueContent.="-$variableid-,";


    $varCounter++;

}


?>
<div class="title">Salary Profile</div>
<div class="strip">
    <span>Dashboard</span>
    <span>Salary Profile</span>
    <span>Edir New</span>
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
                Edit Designation
            </div>
        </div>
        <table cellpadding="0" cellspacing="0" width="100%">
            <thead>
            <tr>
                <td colspan="2" style="text-align:center">
                    <div style="display:inline-block;" id="couResp"></div>
                </td>
            </tr>
            <tr>
                <th>Profile Name <span>*</span></th>
                <td>
                    <input name="req" class="input medium" data-original-title="first tooltip" type="text" value="<?php echo $row['profileName']?>" style="width:240px;" id="salP0" />
                    <br>
                    <input name="req" class="input medium" id="checkNumber" type="hidden" value="<?=$varCounter?>" />
                </td>
            </tr>
            <tr>
                <th>Select Variable<span>*</span></th>
                <td>
                    <?php
                    $sql = "SELECT `id`,`variable_name`,`updatedate` FROM `salary_structure_variables_new` WHERE `delete`='0' AND `id` ORDER BY `id` ASC";
                    $getData = mysql_query($sql,$con) or die(mysql_error());
                    $varBreakOption="";
                    while($rowValBreak=mysql_fetch_assoc($getData))
                    {
                        $variable_name=$rowValBreak["variable_name"];
                        $selid=$rowValBreak["id"];
                        $disbable="";
                        if(in_array($selid,$allArray))
                        {
                            $disbable="disabled=disabled";
                        }
                        $varBreakOption.=<<<AAA
                                    <option value="$selid" $disbable>$variable_name</option>
AAA;
                    }
                    ?>
                    <select onchange="addSalaryVariables(this,'salP1','addBeforeMe','errorId')" id="salaryVariableHolder" class="input">
                        <option value="0">Please Select Variable</option>
                        <?=$varBreakOption?>
                    </select>
                    <br>
                    <input id="salP1" name="req" type="hidden" value="<?=$uniqueContent?>">
                    <div id="errorId">
                    </div>
                </td>
            </tr>
            </thead>

 <!--           <tr>
                <th>Basic salary<span>*</span></th>
                <td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="salP0" value="<?php /*echo $row['basic']*/?>"  onchange="var bsal=$('#salP0').val();var pcal=(bsal*12)/100;$('#salP10').val(pcal)">
                </td>
            </tr>
            <tr>
                <th>HRA<span>*</span></th>
                <td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="salP9" value="<?php /*echo $row['add_earning']*/?>"></td>
            </tr>
            <tr><th>Conveyance Allowance<span>*</span></th>
                <td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="salP1" value="<?php /*echo $row['con_allow']*/?>">
                </td>
            </tr>
            <tr>
                <th>QPE<span>*</span></th>
                <td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="salP8" value="<?php /*echo $row['travel_allow']*/?>"></td>
            </tr>
            <tr>
                <th>Special Allowance<span>*</span>
                </th>
                <td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="salP2" value="<?php /*echo $row['spec_allow']*/?>">
                </td>
            </tr>
            <tr>
                <th>Other Allowance<span>*</span>
                </th>
                <td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="salP3" value="<?php /*echo $row['other_allow']*/?>">
                </td>
            </tr>
            <tr>
                <th>KPI<span>*</span></th>
                <td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="salP4" value="<?php /*echo $row['perf_allow']*/?>"></td>
            </tr>
            <tr>
                <th>Attendance Allowance<span>*</span></th>
                <td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="salP5" value="<?php /*echo $row['att_allow']*/?>"></td>
            </tr>
            <tr>
                <th>Performance Bonus<span>*</span></th>
                <td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="salP6" value="<?php /*echo $row['perf_Bonus']*/?>"></td>
            </tr>


            <tr>
                <th>Provident Fund (Employee)<span>*</span></th>
                <td>
                    <?php /*echo $row['PF']*/?>
                    <input class="input medium" name="req" class="" data-original-title="" type="hidden"  style="width:240px;" id="salP10" value="<?php /*echo $row['PF']*/?>">
                </td>
            </tr>

            <tr>
                <th>Provident Fund (Company)<span>*</span></th>
                <td>
                    <?php /*echo $row['pfcamount']*/?>
                </td>
            </tr>
            <tr>
                <th>ESIC (Employee)<span>*</span></th>
                <td>
                    <?php /*echo $row['esiceamount']*/?>
                </td>
            </tr>
            <tr>
                <th>ESIC (Company)<span>*</span></th>
                <td>
                    <?php /*echo $row['esiccamount']*/?>
                </td>
            </tr>
            <tr>
                <th>PT<span>*</span></th>
                <td>
                    <?php /*echo $row['pt']*/?>
                </td>
            </tr>
            <tr>
                <th>Extra<span>*</span></th>
                <td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="salP7" value="<?php /*echo $row['train_allow']*/?>"></td>
            </tr>-->

            <tbody id="addBeforeMe">
                <?=$htmlContent?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="text-align:center">
                        <button class="button green" onclick="var checkNumber=$('#checkNumber').val(); SaveData('masters/salaryProfile/update?id=<?php echo $id;?>&i=<?php echo $i;?>','salP',checkNumber+1,'<?php echo $i;?>','','couResp','2');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i>Update</button>
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


