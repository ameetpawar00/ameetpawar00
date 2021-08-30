<?php include("../../include/conFig.php");

$Y = date('Y', strtotime('-1 years'));
$currentYear = date('Y');
if(isset($_REQUEST["Y"]))
{
    $Y=$_REQUEST["Y"];
}

$sql_log = "SELECT `employee`.`id`, `designation`.`name` as `des_name`, `employee`.`doj`, `department`.`name` as `dname`, `employeestatus`.`name` as `estat`, `employee`.`l_allotstatus`, `employee`.`empid`, `employee`.`name`, `carry_leavelog`.`id` as `creqid`, `carry_leavelog`.`leaves_carried`, `carry_leavelog`.`leaves_cashed`, `carry_leavelog`.`leaves_cash_date`, `carry_leavelog`.`cash_status`, `carry_leavelog`.`installments`, `carry_leavelog`.`modifieddate` FROM `carry_leavelog`, `employee`, `designation`, `department`, `employeestatus` WHERE `carry_leavelog`.`of_year`='$Y' AND `carry_leavelog`.`delete_val`!='1' AND `employee`.`delete`= '0' AND `employee`.`active` = '1' AND `employee`.`designation`= `designation`.`id` AND `employee`.`department`= `department`.`id` AND `employee`.`id`= `carry_leavelog`.`userid` AND `employee`.`empstatus`= `employeestatus`.`id` AND `carry_leavelog`.`cash_status`!='0'";

?>
<div id="myTitle">
<div class="title">Cash Leaves Requests Year <?=$Y?></div>
    <div class="strip">
        <span>Dashboard</span>
        <span>Cash Leaves Requests</span>
        <span>View</span>
    </div>
</div>

<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
    <tr>
        <td style="width:30%"></td>
<td style="width:70%" align="right">
    <select name="yearFilter" id="yearFilter" class="input" onchange="getModule('management/leaverequest/cash_leaves_req?Y='+this.value,'viewContent','manipulateContent','Cash Leaves Requests');">
        <option value="">Select year</option>
        <?php
            for($ret=2016;$ret<$currentYear;$ret++)
            {
                echo "<option value='$ret'>$ret</option>";
            }
        ?>
    </select>
    <input type="text" id="myInput" class="input" onkeyup="myFunction()" placeholder="Search for names..">
        </td>
    </tr>
</table>
<div id="directResult" style="height:400px;overflow:scroll">
    <style>
        .ncolor tr.d1 td ,.ncolor tr.d0 td {
            background: none!important;}

    </style>
    <table width="100%" cellpadding="5" cellspacing="0"  class="fetch ncolor" id="mytable">
        <tr>
            <th style="height: 30px"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" />Empid</th>
            <th style="height: 30px">Name<br><small>Designation</small></th>
            <th style="height: 30px">Date of Joining (DOJ)</th>
            <th style="height: 30px">Carried</th>
            <th style="height: 30px">Want To cash</th>
            <th style="height: 30px">Applied On</th>
            <th style="height: 30px">Status</th>
            <th style="height: 30px">Action</th>
            <th style="height: 30px">Story</th>

        </tr>
        <?php
        $i = 1;
        $sql_log .=" order by employee.name ASC";
        $values = mysql_query($sql_log,$con)or die(mysql_error());

        while($row =mysql_fetch_array($values))
        {
            $id=$row['empid'];
            $eid=$row['id'];
            $des_name=$row['des_name'];
            $doj=$row['doj'];
            $dname=$row['dname'];
            $estat=$row['estat'];
            $name=$row['name'];
            $creqid=$row['creqid'];
            $leaves_carried=$row['leaves_carried'];
            $leaves_cashed=$row['leaves_cashed'];
            $leaves_cash_date=$row['leaves_cash_date'];
            $tesmp_date=explode(" ",$leaves_cash_date);
            $leaves_cash_date=$tesmp_date[0];
            $cash_status=$row['cash_status'];
            $cno=$row['installments'];
            $modifieddate=$row['modifieddate'];
            $of_year=$row['of_year'];
//	print_r($row);

            if($cash_status==1)
            {
                $status="<span style='color:green'>Approved </span>";
                $action=<<<AAA
				<span style='color:green'>
					<div class="input-group">
                        <input class="form-control" type="text" id="checknumber_$creqid" placeholder="Enter Check No.">
                       
                        <span class="input-group-btn">
                            <button class="btn blue" type="button"  onclick="update_leave_bank($creqid,$eid,3,2)">Update!</button>
                        </span>
                    </div>
                </span>
AAA;
            }else if($cash_status==4)
            {
                $status="<span style='color:green'>Approved </span>";
                $action="<span style='color:green'>Check Number : $cno (On $modifieddate)</span>";
            }else if($cash_status==2)
            {
                $status="<span style='color:Red'>Rejected </span>";
                $action="<span style='color:Red'>Already Rejected</span>";
            }else if($cash_status==3)
            {
                //$status="<span style='color:orange'>Applied</span>";
                //$action="<span style='color:orange'>Already Applied</span>";

                $status="<span style='color:blue'>Waiting</span>";
                $action=<<<AAA
									<button class="button green" onclick="update_leave_bank($creqid,$eid,1,2)">Approve</button>
									<button class="button red" onclick="update_leave_bank($creqid,$eid,2,2)">Reject</button>
AAA;
            }

            ?>
            <tr  class="d<?php echo $i%2;?>" id="fetchrow<?php echo $i?>">
                <td><?php echo $id?></td>
                <td ><?php echo $name?><br><small><b>Post : </b><?php echo $des_name?> <br><b> Dept : </b><?php echo $row["dname"];?></small></td>
                <td><?php echo $doj?></td>
                <td><?php echo $leaves_carried?></td>
                <td>
                    <?php

                    if($cash_status==3)
                    {
                        echo $actiona=<<<AAA
							<input class="form-control" type="number" min="7" max="18" id="leaves_cashed_$creqid" value="$leaves_cashed" >
AAA;
                    }else{

                        echo $actiona=<<<AAA
							<input class="form-control" type="hidden" min="7" max="18" id="leaves_cashed_$creqid" value="$leaves_cashed" >
AAA;
                        echo $leaves_cashed;
                    }
                    ?>


                </td>
                <td><?php echo $leaves_cash_date?></td>
                <td><?php echo $status;?></td>
                <td><?php echo $action;?></td>
                <td><div class="button green" style="cursor:pointer;padding:4px;" onclick="getModule('management/salary/story/view?eid=<?php echo $eid?>&amp;name=<?php echo $name?>','manipulatemoodleContent','viewmoodleContent','Story Line')">Story</div></td>


            </tr>
            <?php
            $i++;

        }
        ?>
    </table>
    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>