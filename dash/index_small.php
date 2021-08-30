
<style>
    #usernoti .datablock {
        min-height: 20px;
        margin-bottom: 2px;
        border: 1px dotted #bcbcbc;
        cursor: pointer;
        position: relative;
    }
    #usernoti .small_block {
        width: 10%;
        float: left;
        min-height: 20px;
        text-align: center;
    }
    #usernoti .small_block i {
        font-size: 1.2em;
        padding-top: 2px;
        color: #ffffffb3;
    }
    #usernoti .medium_block {
        width: 90%;
        float: left;
    }
    #usernoti .medium_block span {
        padding: 5px;
        font-size: 10px;
        line-height: 20px;
        color: #565d66;
        text-transform: capitalize;
    }
    #usernoti .medium_block span {
        font-size: 10px;
        line-height: 20px;
        color: #565d66;
        text-transform: capitalize;
    }
    #usernoti .closese{
        display: none;
    }
    #usernoti .datablock:hover{
        background: #fff;
    }
    #usernoti .notinoti{
        margin: 0px;
    }
</style>
<div class="notinoti" style="background: ;height: 100%;">
    <?php
        function display_children($hrmloggedid,$level) {
            $result = mysql_query("SELECT employee.id,employee.name,employee.salaryId,employee.designation,teamamtes.mateid FROM employee,team,teamamtes WHERE team.leader = $hrmloggedid AND teamamtes.mateid = employee.id AND teamamtes.teamid = team.id AND team.delete = 0 AND employee.delete = 0 AND employee.empstatus = 2 ORDER BY employee.name ASC");
            $abcdd="";
            while ($row = mysql_fetch_array($result)) {
                $id=$row["id"];
//	$name=$row["name"];
                $designation=$row["designation"];
//$abcdd.="$name--$id,";
                $abcdd.="$id,";
                $abcdd.=display_children($id,$level+1);
            }
            return $abcdd;
        }
        if(in_array('d_incrnoti',$thisper))
        {
            $incrDetails=0;
            $rytyt=rtrim(display_children($hrmloggedid,0),",");
            $SQLVALS=" AND employee.empstatus = 2";
            if($rytyt!="")
            {
                $SQLVALS=" AND employee.empstatus = 2 AND `emp_doc`.`eid` IN($rytyt)";
            }
            $todasYdateYear=date("Y");
            $todasYdateMonth=date("n");

//$query = "SELECT `emp_doc`.`id`,`employee`.`name`,`emp_doc`.`eid`, `emp_doc`.`mtype`, `emp_doc`.`desc`, `emp_doc`.`stype`, `emp_doc`.`createdate`, `emp_doc`.`modifieddate`,`emp_doc`.`status`, `emp_doc`.`extra`, `emp_doc`.`modifiedby`, `emp_doc`.`todate`, `emp_doc`.`duration`, `emp_doc`.`slab`, `emp_doc`.`entry`, `emp_doc`.`department`, `emp_doc`.`designation` FROM `emp_doc`,`employee` WHERE `emp_doc`.`delete`='0' AND `employee`.`delete`='0' AND YEAR(`emp_doc`.`todate`)='$todasYdateYear' AND MONTH(`emp_doc`.`todate`)='$todasYdateMonth'  AND `employee`.`id`=`emp_doc`.`eid` $SQLVALS ORDER BY `employee`.`name`";


            $query = "SELECT    `emp_doc`.`id`,`employee`.`name`,`employee`.`salaryId`,`employee`.`designation` as `empdesignation`,`emp_doc`.`eid`, `emp_doc`.`mtype`, `emp_doc`.`desc`, `emp_doc`.`stype`, `emp_doc`.`createdate`, `emp_doc`.`modifieddate`,`emp_doc`.`status`, `emp_doc`.`extra`, `emp_doc`.`modifiedby`, `emp_doc`.`todate`, `emp_doc`.`duration`, `emp_doc`.`slab`, `emp_doc`.`entry`, `emp_doc`.`department`, `emp_doc`.`designation`
FROM      employee
JOIN      (
SELECT    MAX(id) max_id, eid
FROM      emp_doc
WHERE mtype=3 AND stype IN(3,4,5,6,7,8)
GROUP BY  eid
) c_max ON (c_max.eid = employee.id)
JOIN      emp_doc ON (emp_doc.id = c_max.max_id) WHERE `emp_doc`.`delete`='0' AND YEAR(`emp_doc`.`todate`)='$todasYdateYear' AND MONTH(`emp_doc`.`todate`)='$todasYdateMonth' AND `employee`.`delete`='0' AND `employee`.`id`=`emp_doc`.`eid` $SQLVALS ORDER BY `employee`.`name` ASC";

            $getData = mysql_query($query ,$con) or die(mysql_error());
            if(mysql_num_rows($getData)>0)
            {
                $incrDetails=mysql_num_rows($getData);
            }
//echo "SELECT `emp_doc`.`id`,`employee`.`name`,`emp_doc`.`eid`, `emp_doc`.`mtype`, `emp_doc`.`desc`, `emp_doc`.`stype`, `emp_doc`.`createdate`, `emp_doc`.`modifieddate`,`emp_doc`.`status`, `emp_doc`.`extra`, `emp_doc`.`modifiedby`, `emp_doc`.`todate`, `emp_doc`.`duration`, `emp_doc`.`slab`, `emp_doc`.`entry`, `emp_doc`.`department`, `emp_doc`.`designation` FROM `emp_doc`,`employee` WHERE `emp_doc`.`delete`='0' AND `employee`.`delete`='0' AND `employee`.`id`=`emp_doc`.`eid` $SQLVALS ORDER BY `employee`.`name` ASC";
            ?>
            <div class="datablock "  id="n6">
                <span class="close closese"  onclick="ToggleBox('n6','none','');"><!--<i class="fa fa-times blue"></i>--></span>
                <div class="small_block yellow"  onclick="getModule('dash/incrementData','viewContent','manipulateContent','Pending Increments');">
                    <i class="fa fa-line-chart"></i>
                </div>
                <div class="medium_block "  onclick="getModule('dash/incrementData','viewContent','manipulateContent','Pending Increments');">
                    <span>
                        <b>
                        <span id="noti5">
                        <?=$incrDetails?>
                        </span>
                        Reviews
                        </b>
                        pending
                    </span>
                </div>
            </div>
            <?php
        }
        if(in_array('v_MLreq',$thisper))
        {
            $rytyt=rtrim(display_children($hrmloggedid,0),",");
            $SQLVALS="";
            if($rytyt!="")
            {
                $SQLVALS="AND `leaverequest`.`updatedby` IN($rytyt)";
            }
            $sqlp = "SELECT `leaverequest`.`id` FROM `leaverequest` WHERE `leaverequest`.`delete` = '0' $SQLVALS AND `leaverequest`.`status`='0' AND `leaverequest`.`extra`!=1";
            if(in_array('full_leav_access',$thisper))
            {
                $sqlp = "SELECT * FROM `leaverequest` WHERE `delete` = 0 AND `status`=0 AND `extra`!=1";
            }
            $getDatap = mysql_query($sqlp,$con) or die(mysql_error());
            $grp_res=mysql_num_rows($getDatap);
//echo $grp_res;
//print_r($grp_res);+
            $color_dash="grey";
            if($grp_res!=0)
            {
                $color_dash="green";
            }
            ?>
            <div class="datablock " id="n1" >
                <span class="close closese" onclick="ToggleBox('n1','none','');"><!--<i class="fa fa-times blue"></i>--></span>
                <div class="small_block <?=$color_dash?>" onclick="getModule('management/leaverequest/view?cl_leav_p','viewContent','manipulateContent','Manage Leave Request');">
                    <i class="fa fa-calendar-plus-o"></i>
                </div>
                <div class="medium_block " onclick="getModule('management/leaverequest/view?cl_leav_p','viewContent','manipulateContent','Manage Leave Request');">
<span>
<b>
<span id="noti1">
<?=$grp_res?>
</span>
leave requests
</b>
pending
<small></small>
</span>
                </div>
            </div>
            <?php
        }
        if(in_array('v_MLreq',$thisper))
        {
            $sqlc = "SELECT `leaverequest`.`id`, `leaverequest`.`days`, `leaverequest`.`fromdate`, `leaverequest`.`todate`, `leaverequest`.`updatedate`, `leaverequest`.`leavetime`, `leaverequest`.`status`, `leaverequest`.`description`, `employee`.`name`, `employee`.`id`, `leaverequest`.`leavetype`, `department`.`name`, `leaverequest`.`extra` FROM `leaverequest` JOIN `employee` ON `employee`.`id` = `leaverequest`.`updatedby` JOIN `teamamtes` ON `teamamtes`.`mateid` = `employee`.`id` JOIN `team` ON `teamamtes`.`teamid` = `team`.`id` LEFT JOIN `department` ON `employee`.`department`=`department`.`id` WHERE `team`.`leader` = '$hrmloggedid' AND `leaverequest`.`delete` = '0' AND `leaverequest`.`status`=0 AND `extra`=1";
            if(in_array('full_leav_access',$thisper))
            {
                $sqlc = "SELECT * FROM `leaverequest` WHERE `delete` = 0 AND `status`=0 AND `extra`=1";
            }
            $getDatac = mysql_query($sqlc,$con) or die(mysql_error());
            $grp_rezxs=mysql_num_rows($getDatac);
            $color_dash="grey";
            if($grp_rezxs!=0)
            {
                $color_dash="red";
            }
//echo $grp_rezxs;
            ?>
            <div class="datablock"  id="n2" >
                <span class="close closese"  onclick="ToggleBox('n2','none','');"><!--<i class="fa fa-times blue"></i>--></span>
                <div class="small_block <?=$color_dash?>"  onclick="getModule('management/leaverequest/view?cl_leav_c','viewContent','manipulateContent','Manage Leave Request');">
                    <i class="fa fa-calendar-times-o"></i>
                </div>
                <div class="medium_block "  onclick="getModule('management/leaverequest/view?cl_leav_c','viewContent','manipulateContent','Manage Leave Request');">
<span>
<b><span id="noti2"><?=$grp_rezxs?></span> leave Cancellation requests</b> pending 
<small></small>
</span>
                </div>
            </div>
            <?php
        }
        if(in_array('ca_pf_req',$thisper))
        {
            $employeep = mysql_query("SELECT * FROM `emp_pf_with` WHERE `status`!=1 AND `status`!=3",$con);
            $grp_rezxa=mysql_num_rows($employeep);
            $color_dash="grey";
            if($grp_rezxa!=0)
            {
                $color_dash="voilet";
            }
            ?>
            <div class="datablock "  id="n3">
                <span class="close closese"  onclick="ToggleBox('n3','none','');"><!--<i class="fa fa-times blue"></i>--></span>
                <div class="small_block <?=$color_dash?>"  onclick="getModule('management/salary/moodelview-cpf-r','viewContent','manipulateContent','Cash PF Requests');">
                    <i class="fa fa-inr"></i>
                </div>
                <div class="medium_block "  onclick="getModule('management/salary/moodelview-cpf-r','viewContent','manipulateContent','Cash PF Requests');">
<span>
<b><span id="noti3"><?=$grp_rezxa?></span> PF encashment Request</b> pending
<small></small>
</span>
                </div>
            </div>
            <?php
        }
        if(in_array('ca_ltb_req',$thisper))
        {
            $employeeps = mysql_query("SELECT * FROM `emp_ltb_with` WHERE `status`!=1 AND `status`!=3",$con);
            $grp_resdzsxs=mysql_num_rows($employeeps);
            $color_dash="grey";
            if($grp_resdzsxs!=0)
            {
                $color_dash="yellow";
            }
            ?>
            <div class="datablock "  id="n4">
                <span class="close closese"  onclick="ToggleBox('n4','none','');"><!--<i class="fa fa-times blue"></i>--></span>
                <div class="small_block <?=$color_dash?>"   onclick="getModule('management/salary/moodelview-cltb-r','viewContent','manipulateContent','Cash LTB Requests');">
                    <i class="fa fa-money"></i>
                </div>
                <div class="medium_block "   onclick="getModule('management/salary/moodelview-cltb-r','viewContent','manipulateContent','Cash LTB Requests');">
<span>
<b><span id="noti4"><?=$grp_resdzsxs?></span> LTB encashment Request</b> pending
<small></small>
</span>
                </div>
            </div>
            <?php
        }
        if(in_array('ca_lea_req',$thisper))
        {
            $employeep = mysql_query("SELECT * FROM `carry_leavelog` WHERE `carry_leavelog`.`delete_val`!='1' AND `cash_status`!=2 AND `cash_status`!=4 AND `carry_leavelog`.`cash_status`!='0'",$con);
            $grp_rezsxs=mysql_num_rows($employeep);
            $color_dash="grey";
            if($grp_rezsxs!=0)
            {
                $color_dash="blue";
            }
            ?>
            <div class="datablock "  id="n5">
                <span class="close closese"  onclick="ToggleBox('n5','none','');"><!--<i class="fa fa-times blue"></i>--></span>
                <div class="small_block <?=$color_dash?>"  onclick="getModule('management/leaverequest/cash_leaves_req','viewContent','manipulateContent','Cash Leaves Requests');">
                    <i class="fa fa-history"></i>
                </div>
                <div class="medium_block "  onclick="getModule('management/leaverequest/cash_leaves_req','viewContent','manipulateContent','Cash Leaves Requests');">
<span>
<b><span id="noti5"><?=$grp_rezsxs?></span> Leave encashment Request</b> pending
<small></small>
</span>
                </div>
            </div>
            <?php
        }
    ?>
</div>