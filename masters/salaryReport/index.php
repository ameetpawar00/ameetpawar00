<?php
    include("../../include/conFig.php");
?>
<div class="title">Location</div>
<div class="strip">
    <span>Dashboard</span>
    <span>Salary Report</span>
    <span>Download Report</span>
</div>
<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td style="width:30%"></td>
        <td style="width:70%" align="right">
            <button class="button gray" onclick="ToggleBox('viewContent','none','');ToggleBox('manipulateContent','block','')"> <i class="back"></i>Back</button>&nbsp;&nbsp;
        </td>
    </tr>
</table>
<div style="overflow-x:hidden;overflow-y:scroll;height:500px">
    <div class="add-new blue-border">
        <div class="form-head blue">
            <div class="head-title">
                <i class="add-form"></i>
                Download Salary Report</div>
        </div>
        <form action="masters/salaryReport/excelDownload.php" method="post" target="_blank" >
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <th>Select Month<span>*</span></th>
                    <td>
                        <select class="input drop-down large" name="month" id="month">

                            <option value="01">Jan</option>

                            <option value="02">Feb</option>

                            <option value="03">March</option>

                            <option value="04">Apr</option>

                            <option value="05">May</option>

                            <option value="06">June</option>

                            <option value="07">July</option>

                            <option value="08">Aug</option>

                            <option value="09">Sept</option>

                            <option value="10">Oct</option>

                            <option value="11">Nov</option>

                            <option value="12">Dec</option>

                        </select>
                    </td>
                </tr>


                <tr>
                    <th>Select Year<span>*</span></th>
                    <td>
                        <select class="input drop-down large" name="year" id="year">
                            <?php
                                $currentY = date('Y');

                                for($i = 2014;$i <= $currentY ;$i++)
                                {
                                    ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>

                    <td colspan="4" style="text-align:center">
                        <button class="button green" name="excelDo" type="submit" ><i class="save-icon"></i>Download Report Excel (TR)</button>
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        <button class="button gray" onclick="ToggleBox('viewContent','none','');ToggleBox('manipulateContent','block','')"><i class="close-icon"></i>Cancel</button>
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>


