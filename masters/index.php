<?php
    include("../include/conFig.php");
?>
<div class="title">Setup</div>
<div class="strip">
    <span>Dashboard</span>
    <span>Setup</span>
    <span>List</span>
</div>

<div style="overflow-x:hidden;overflow-y:scroll;height:500px;">
    <!--<div class="head-title">
    <i class="add-form"></i>
    Masters</div>-->
    <table cellpadding="5" cellspacing="5" style="padding-left:50px;font-size:14px !important" align="left" width="50%">
        <tr><th colspan="2" style="float:left;color: rgb(112, 112, 201);" > Masters</th></tr>
        <tr>
            <?php
                if(in_array('v_MAssets',$thisper))
                {
                    ?>
                    <td style="cursor:pointer; text-align:left" class="link-blue" onclick="getModule('masters/typeofasset/view','viewContent','manipulateContent','Asset')"><i class="master"></i>Asset</td>
                    <?php
                }

                if(in_array('v_bra',$thisper))
                {
                    ?>
                    <td style="cursor:pointer; text-align:left; width: 156px;" class="link-blue" onclick="getModule('masters/branch/view','viewContent','manipulateContent','Branch')"><i class="master"></i>Branch</td>
                    <?php
                }
            ?>
        </tr>
        <tr>
            <?php if(in_array('v_MCheckl',$thisper))
            {
                ?>
                <td style="cursor:pointer; text-align:left" class="link-blue" onclick="getModule('masters/checklist/view','viewContent','manipulateContent','Checklist')"><i class="master"></i>Checklist</td>
                <?php
            }

                if(in_array('v_MDep',$thisper))
                {
                    ?>
                    <td style="cursor:pointer; text-align:left" class="link-blue" onclick="getModule('masters/department/view','viewContent','manipulateContent','Department')"><i class="master"></i>Department</td>
                    <?php
                }
            ?>
        </tr>
        <tr>
            <?php
                if(in_array('v_MDesi',$thisper))
                {
            ?>
            <td style="cursor:pointer; text-align:left; width: 156px;" class="link-blue" onclick="getModule('masters/designation/view','viewContent','manipulateContent','Designation')"><i class="master"></i>Designation</td>
            <?php
                }

                /*         if($hrmloggedid==93 AND in_array('v_MDesi',$thisper))
                         {
                             */?><!--
                    <td style="cursor:pointer; text-align:left; width: 156px;" class="link-blue" onclick="getModule('masters/post/view','viewContent','manipulateContent','Post')"><i class="master"></i>Post</td>
                    --><?php
                /*
                                }*/

            ?>
        </tr>
        <tr>
            <?php if(in_array('v_MLtype',$thisper))
            {
                ?>
                <td style="cursor:pointer; text-align:left; width: 156px;" class="link-blue" onclick="getModule('masters/leavetype/view','viewContent','manipulateContent','Leave Type')"><i class="master"></i>Leave Type</td>
                <?php
            }

                if(in_array('v_MLoc',$thisper))
                {
                    ?>
                    <td style="cursor:pointer; text-align:left" class="link-blue" onclick="getModule('masters/location/view','viewContent','manipulateContent','Location')"><i class="master"></i>Location</td>
                    <?php
                }
            ?>
        </tr>
        <tr>
            <?php if(in_array('v_MEStatus',$thisper))
            {
                ?>
                <td style="cursor:pointer; text-align:left; width: 156px;" class="link-blue" onclick="getModule('masters/employeestatus/view','viewContent','manipulateContent','Employee Status')"><i class="master"></i>Employee Status</td>
                <?php
            }

                if(in_array('v_MPFKPI',$thisper))
                {
                    ?>
                    <td style="cursor:pointer; text-align:left" class="link-blue" onclick="getModule('masters/kpiparameters/view','viewContent','manipulateContent','Parameters for KPI')"><i class="master"></i>Parameters for KPI</td>
                    <?php
                }
            ?>
        </tr>
        <tr>
            <?php if(in_array('v_MRFLeav',$thisper))
            {
                ?>
                <td style="cursor:pointer; text-align:left; width: 156px;" class="link-blue" onclick="getModule('masters/reasonforleaving/view','viewContent','manipulateContent','Reason For Leaving')"><i class="master"></i>Reason For Leaving</td>
                <?php
            }
                if(in_array('v_MRelation',$thisper))
                {
                    ?>
                    <td style="cursor:pointer; text-align:left" class="link-blue" onclick="getModule('masters/relationship/view','viewContent','manipulateContent','Relationship')"><i class="master"></i>Relationship</td>
                    <?php
                }
            ?>
        </tr>
        <tr>
            <?php if(in_array('v_MSOHire',$thisper))
            {
                ?>
                <td style="cursor:pointer; text-align:left; width: 156px;" class="link-blue" onclick="getModule('masters/sourceofhire/view','viewContent','manipulateContent','Source Of Hire')"><i class="master"></i>Source Of Hire</td>
                <?php
            }

                if(in_array('v_empshift',$thisper))
                {
                    ?>
                    <td style="cursor:pointer; text-align:left" class="link-blue" onclick="getModule('masters/shift/view','viewContent','manipulateContent','Shift')"><i class="master"></i>Employee Shift</td>
                    <?php
                }

                if(in_array('v_edu',$thisper))
                {
            ?>
        </tr>
        <tr>
            <td style="cursor:pointer; text-align:left" class="link-blue" onclick="getModule('masters/education/view','viewContent','manipulateContent','Education')"><i class="master"></i>Education</td>
            <?php
                }

                if(in_array('v_MEQues',$thisper))
                {
                    ?>
                    <td style="cursor:pointer; text-align:left" class="link-blue" onclick="getModule('masters/exitquestions/view','viewContent','manipulateContent','Exit Questions')"><i class="master"></i>Exit Questions</td>
                    <?php
                }

            ?>

        </tr>
        <tr>

            <?php if(in_array('v_doc',$thisper))
            {
                ?>

                <td style="cursor:pointer; text-align:left; width: 156px;" class="link-blue" onclick="getModule('masters/document/view','viewContent','manipulateContent','Document')"><i class="master"></i>Document</td>
                <?php
            }

                if(in_array('v_emps',$thisper))
                {
                    ?>
                    <td style="cursor:pointer; text-align:left" class="link-blue" onclick="getModule('masters/salaryProfile/view','viewContent','manipulateContent','Document')"><i class="master"></i>Salary Profile</td>
                    <?php
                }
            ?>
        </tr>

        <tr>
            <td style="cursor:pointer; text-align:left" class="link-blue" onclick="getModule('masters/salaryBreakdownVariables/view','viewContent','manipulateContent','Document')">
                <i class="master"></i>
                Salary  Breakdown Variables
            </td>
        </tr>
        <tr>
            <?php if(in_array('v_team',$thisper))
            {
                ?>
                <td style="cursor:pointer; text-align:left" class="link-blue" onclick="getModule('masters/team/view','viewContent','manipulateContent','Team')"><i class="master"></i>Team</td>
                <?php
            }
            ?>
        </tr>

    </table>
    <table cellpadding="5" cellspacing="5" width="25%" style="padding-left:50px;font-size:14px !important">
        <tr>
            <th colspan="2" style="float:left;color: rgb(112, 112, 201);">Manage Profile</th>

        </tr>
        <tr>
            <?php if(in_array('v_access',$thisper))
            {
                ?>
                <td style="cursor:pointer; text-align:left; width: 211px;" class="link-blue" onclick="getModule('masters/rolls/view','viewContent','manipulateContent','Rolls')"><i class="master"></i>Roles</td>
                <?php
            }

                if(in_array('v_access',$thisper))
                {
            ?>
        </tr><tr>
            <td style="cursor:pointer; text-align:left; width: 211px;" class="link-blue" onclick="getModule('masters/accesscontrol/index','viewContent','manipulateContent','Access Control')"><i class="master"></i>Access Control</td>
            <?php
                }

            ?>
        </tr>

        <!--<tr>
            <?php if(in_array('v_access',$thisper))
        {
            ?>
            	<td style="cursor:pointer; text-align:left; width: 211px;" class="link-blue" onclick="getModule('masters/salaryExcel/index','viewContent','manipulateContent','Salary Excel Form')"><i class="master"></i>Salary Excel</td>
			<?php
        }
        ?>
	</tr>
            	<tr>
            <?php if(in_array('v_access',$thisper))
        {
            ?>
            	<td style="cursor:pointer; text-align:left; width: 211px;" class="link-blue" onclick="getModule('masters/salaryReport/index','viewContent','manipulateContent','Salary Report Form')"><i class="master"></i>Salary Report</td>
			<?php
        }
        ?>
	</tr>-->
    </table>
    <table cellpadding="5" cellspacing="5" width="25%" style="padding-left:50px;font-size:14px !important">
        <tr>
            <th colspan="2" style="float:left;color: rgb(112, 112, 201);">Company Profile</th>

        </tr>
        <tr>
            <?php if(in_array('v_cmpd',$thisper))
            {
                ?>
                <td style="cursor:pointer; text-align:left" class="link-blue" onclick="getModule('masters/companydetails/view','viewContent','manipulateContent','Company Details')"><i class="master"></i>Company Details</td>
                <?php
            }

                if(in_array('v_cmpp',$thisper))
                {
            ?>
        </tr><tr>
            <td style="cursor:pointer; text-align:left" class="link-blue" onclick="getModule('masters/uploadocument/index','viewContent','manipulateContent','Upload Document')"><i class="master"></i>Company Policy</td>
            <?php
                }

            ?>
        </tr></table>
    <table cellpadding="5" cellspacing="5" width="25%" style="padding-left:50px;font-size:14px !important">
        <tr>
            <th colspan="2" style="float:left;color: rgb(112, 112, 201);">Salary Report</th>

        </tr>


        <tr>
            <?php if(in_array('v_access',$thisper))
            {
                ?>
                <td style="cursor:pointer; text-align:left; width: 211px;" class="link-blue" onclick="getModule('masters/salaryExcel/index','viewContent','manipulateContent','Salary Excel Form')"><i class="master"></i>Salary Excel</td>
                <?php
            }
            ?>
        </tr>
        <tr>
            <?php if(in_array('v_access',$thisper))
            {
                ?>
                <td style="cursor:pointer; text-align:left; width: 211px;" class="link-blue" onclick="getModule('masters/salaryReport/index','viewContent','manipulateContent','Salary Report Form')"><i class="master"></i>Salary Report</td>
                <?php
            }
            ?>
        </tr><tr>
            <?php if(in_array('v_access',$thisper))
            {
                ?>
                <td style="cursor:pointer; text-align:left; width: 211px;" class="link-blue" onclick="getModule('masters/leaveReport/index','viewContent','manipulateContent','Salary Report Form')"><i class="master"></i>Leave Report</td>
                <?php
            }
            ?>
        </tr><tr>
            <?php if(in_array('v_access',$thisper))
            {
                ?>
                <td style="cursor:pointer; text-align:left; width: 211px;" class="link-blue" onclick="getModule('masters/leaveReportNew/index','viewContent','manipulateContent','Salary Report Form')"><i class="master"></i>Leave Report Daily<small style="color: red;position: relative;top: -10px;">new</small></td>
                <?php
            }

            ?>
        </tr>
        <tr>
            <?php if(in_array('v_access',$thisper))
            {
                ?>
                <td style="cursor:pointer; text-align:left; width: 211px;" class="link-blue" onclick="getModule('masters/salarydeductionReport/index','viewContent','manipulateContent','Salary Deduction Report')"><i class="master"></i>Deduction Report</td>
                <?php
            }
            ?>
        </tr>
        </tr>
        <tr>
            <?php
                if($hrmloggedid==93)
                {
                    ?>
                    <td style="cursor:pointer; text-align:left; width: 211px;" class="link-blue" onclick="getModule('masters/salaryprofilereport/index','viewContent','manipulateContent','Salary Profile Report')"><i class="master"></i> Salary Profile Report</td>
                    <?php
                }
            ?>
        </tr>
    </table>
</div> 
