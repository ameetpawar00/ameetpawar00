<?php
    include("../../include/conFig.php");
?>

<div class="title">Designation</div>
<div class="strip">
    <span>Dashboard</span>
    <span>Designation</span>
    <span>Add New</span>
</div>
<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td style="width:30%"></td>
        <td style="width:70%" align="right">
            <button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')">
                <i class="back"></i>Back
            </button>&nbsp;&nbsp;
        </td>
    </tr>
</table>
<div style="overflow-x:hidden;overflow-y:scroll;height:500px">
    <div class="add-new blue-border">
        <div class="form-head blue">
            <div class="head-title">
                <i class="add-form"></i>
                Add Designation
            </div>
        </div>
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td colspan="2" style="text-align:center">
                    <div style="display:inline-block;" id="couResp"></div>
                </td>
            </tr>
            <tr>
                <th>Name <span>*</span></th>
                <td>
                    <input name="req" class="input medium" data-original-title="first tooltip" type="text"  style="width:240px;" id="dept0" />
                </td>
            </tr>
            <tr>
                <th>Department <span>*</span></th>
                <td>
                    <select name="req" id="dept2" class="input">
                        <option value=''>None</option>
                        <?php
                            $sql = "SELECT * FROM `department` WHERE `delete`='0' AND `id`!=1";
                            $getData = mysql_query($sql,$con) or die(mysql_error());
                            while ($rowData=mysql_fetch_assoc($getData))
                            {
                                $id=$rowData["id"];
                                $name=$rowData["name"];
                                echo "<option value='".$id."'>$name</option>";
                            }


                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Description</th>
                <td>
                    <textarea class="input huge" name="" cols="20" rows="2" class="input" style="width:48%;height:100px;" id="dept1"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="text-align:center">
                    <button class="button green" onclick="SaveData('masters/designation/save','dept','3','','','couResp','1');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i>Save</button>
                    <button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
                </td>
            </tr>
        </table>
    </div>
</div>


