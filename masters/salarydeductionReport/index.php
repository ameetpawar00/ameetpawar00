<?php
    include("../../include/conFig.php");
?>
<div class="title">Deduction Reports</div>
<div class="strip">
    <span>Dashboard</span>
    <span>Salary Deduction</span>
    <span>Show Report</span>
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
                Salary Deduction Report</div>
        </div>
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <th>Select Year<span>*</span></th>
                <td>
                    <select class="input drop-down large" name="year" id="year">
                        <?php
                            $frm_yearc=date("Y");
                            $frm_year=$frm_yearc+3;
                            for($i = 2014;$i < $frm_year ;$i++)
                            {
                                $sell="";
                                if($frm_yearc==$i)
                                {
                                    $sell="selected";
                                }
                                ?>
                                <option value="<?php echo $i; ?>" <?=$sell?>><?php echo $i; ?></option>
                                <?php
                            }
                        ?>
                    </select>
                    <input type="button" class="button yellow pull-right" onclick="$('select').val('0');" value="Reset" >
                </td>
            </tr>
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
                <th>Select Variable<span>*</span></th>
                <td>
                    <select class="input drop-down large" name="var_type" id="var_type"  onchange="getModule('masters/salarydeductionReport/getdata?sel_type=f_emp&var_type='+this.value,'empname','','Salary Deduction Report')">

                        <option value="0">Select One </option>

                        <option value="ALL">ALL</option>

                        <option value="ESIC">ESIC</option>

                        <option value="PT">PT</option>

                        <option value="TDS">TDS</option>

                        <option value="PF">PF</option>
                    </select>
                </td>
            </tr> <tr>
                <th>Select Employee<span>*</span></th>
                <td>
                    <select class="input drop-down large" name="empname" id="empname"   onchange="var val3=$('#var_type').val();var val2=$('#month').val();var val1=$('#year').val(); getModule('masters/salarydeductionReport/getdata?sel_type=t_emp&emp_type='+this.value+'&year='+val1+'&month='+val2+'&var_type='+val3,'ded_det','','Salary Deduction Report')">

                    </select>
                    <form action="" method="post" target="_blank" id="myform" >

                    </form>
                    <input type="button" class="button green pull-right" value="Download Excel"   onclick="var emp_type=$('#empname').val();var val3=$('#var_type').val();var val2=$('#month').val();var val1=$('#year').val(); var link='masters/salarydeductionReport/getdata.php?sel_type=t_emp&emp_type='+emp_type+'&year='+val1+'&month='+val2+'&var_type='+val3+'&excl=1'; var frm = document.getElementById('myform');if(frm){frm.action = link;}frm.submit(); ">
                </td>
            </tr>
            <tr>
                <th>Deduction<span>*</span></th>
                <td>
                    <table id="ded_det">

                    </table>
                </td>
            </tr>
            <tr>

                <td colspan="4" style="text-align:center">
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
                    <br>
                    <br>
                </td>
            </tr>

        </table>
    </div>
</div>



