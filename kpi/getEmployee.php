<?php

	include("../include/conFig.php");
	$mnth = date('m');

function display_children($hrmloggedid,$level,$allLeaders,$getDesigAll) {
    $cxolorArray=array("#fbc1c1","#c1fbf5","#c1cefb","#c1fbc2","#f8fbc1");
    $result = mysql_query("SELECT employee.id,employee.name,employee.salaryIdNew,employee.designation,teamamtes.mateid FROM employee,team,teamamtes WHERE team.leader = $hrmloggedid AND teamamtes.mateid = employee.id AND teamamtes.teamid = team.id AND team.delete = 0 AND employee.delete = 0 AND employee.empstatus = 2 ORDER BY employee.name ASC");
    // display each child
    $tyr="";
    $tyra="";

    while ($row = mysql_fetch_array($result)) {
        // indent and display the title of this child
        $id=$row["id"];

        $name=str_repeat("|&nbsp&nbsp&nbsp&nbsp&nbsp",$level).strtoupper($row["name"]);

        $designation=$row["designation"];
        $mateid=$row["mateid"];
        $salaryIdNew=$row["salaryIdNew"];

        $colotuy="#fff";
        $Poname="";
        $LID="0";
        if($allLeaders[$id])
        {
            $colotuy=$cxolorArray[$level];
            $Poname=$getDesigAll[$designation];
            $sdn=explode(" ",$Poname);
            $resultz="";

            foreach ($sdn as $sdnds)
            {
                $resultz.= substr($sdnds, 0, 1);
            }
            $Poname="($resultz)";
            $LID=$id;
        }
        $lfkt="$hrmloggedid---$LID";

        $tyr.=<<<AAA
			<option value="$id" style="background:" class="$lfkt">$name <b>$Poname</b></option>
AAA;

        if(display_children($id,$level+1,$allLeaders,$getDesigAll))
        {
            $namesad=strtoupper($row["name"]);
            $tyra.=<<<AAA
                    <optgroup value="$id" label="$namesad $Poname" style="background: $colotuy" ></optgroup>
AAA;
            $tyra.=display_children($id,$level+1,$allLeaders,$getDesigAll);
        }
    }
    return $tyr.$tyra;
}

?>
<br/>
<br/>
<div class="title">Select Employee And Month To Fill The KPI <span style="display:inline-block"></span>
</div>
<br/>
<br/>
<div style="background:#fff;height:500px;overflow-x:auto;overflow-y:auto;" id="mainDivId">
	<table width="30%" cellpadding="5" cellspacing="0" style="text-align:center" class="fetch">
		<tr>
			<?php
				$getLead = mysql_query("SELECT `id`,`leader` FROM `team` WHERE `delete` = '0'",$con) or die(mysql_error());
				while ($rowLead = mysql_fetch_array($getLead))
				{
					$id=$rowLead["id"];
					$leader=$rowLead["leader"];
					$allLeaders[$leader]=$leader;
				}

				$option="";
/*				$getDesig = mysql_query("SELECT employee.id,employee.name,employee.salaryIdNew FROM employee WHERE employee.delete = 0 AND employee.empstatus = 2 AND employee.id != 1 ORDER BY employee.name ASC",$con) or die(mysql_error());
				while($rowDesig = mysql_fetch_array($getDesig))
				{
					$getDesigAll[$rowDesig["id"]]=$rowDesig["name"];
					$option.=<<<AAA
					<option value="$rowDesig[2]***$rowDesig[0]" style="background:" >$rowDesig[1] </option>
                                
AAA;
				}*/

                $getDesig = mysql_query("SELECT `id`,`name` FROM `designation` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
                while($rowDesig = mysql_fetch_array($getDesig))
                {
                    $getDesigAll[$rowDesig["id"]]=$rowDesig["name"];
                    $option.=<<<AAA
                            <option value="$rowDesig[0]">$rowDesig[1]</option>
AAA;

                }


				if(!$allLeaders[$hrmloggedid])
				{
					?>
					<td align="left">
						<select class="input drop-down large" name="req" id="desig">
							<option value=""  style="width:240px;">Select Designation</option>
							<?php
								echo $option;
							?>
						</select>
					</td>
					<?php
				}
				else
				{
					?>
					<td align="left">
						<?php
							$teamId = $rowLead[0];

						?>
						<select class="input drop-down large" name="req" id="desig">
							<option value=""  style="width:240px;">Select Employee</option>
							<?php
								echo $fdlkjf=display_children($hrmloggedid,0,$allLeaders,$getDesigAll);
							?>
						</select>
					</td>
					<?php
				}
			?>
			<td>
                <div class="" style="display:inline-block">
                    <select class="input drop-down" name="Select1" id="month" >
						<option <?php if($mnth == '01' ) {echo 'selected=selected';}?>  value="01">January</option>
						<option <?php if($mnth == '02' ) {echo 'selected=selected';}?> value="02">February</option>
						<option <?php if($mnth == '03' ) {echo 'selected=selected';}?> value="03">March</option>
						<option <?php if($mnth == '04' ) {echo 'selected=selected';}?> value="04">April</option>
						<option <?php if($mnth == '05' ) {echo 'selected=selected';}?> value="05">May</option>
						<option <?php if($mnth == '06' ) {echo 'selected=selected';}?> value="06">June</option>
						<option <?php if($mnth == '07' ) {echo 'selected=selected';}?> value="07">July</option>
						<option <?php if($mnth == '08' ) {echo 'selected=selected';}?> value="08">August</option>
						<option <?php if($mnth == '09' ) {echo 'selected=selected';}?> value="09">September</option>
						<option <?php if($mnth == '10' ) {echo 'selected=selected';}?> value="10">October</option>
						<option <?php if($mnth == '11' ) {echo 'selected=selected';}?> value="11">November</option>
						<option <?php if($mnth == '12' ) {echo 'selected=selected';}?> value="12">December</option>
					</select>
                </div>
            </td>
			<td>
				<div class="" style="display:inline-block">
					<select class="input drop-down" name="Select2" id="year" >
						<?php
							$yeeay=date("Y");
							for($i=2012;$i<=$yeeay;$i++)
							{
								$sel="";
								if($i==date("Y"))
								{
									$sel="selected";
								}
								echo "<option value='$i' $sel>$i</option>";
							}
						?>
					</select>
				</div>
			</td>
            <td>
                <input type="button" class="button green" value="GO" onclick="if((document.getElementById('desig').value) != '' && (document.getElementById('month').value) != '') { getModule('kpi/viewMyKPI?desig='+document.getElementById('desig').value+'&smonth='+document.getElementById('month').value+'&syear='+document.getElementById('year').value,'manipulateContent','viewContent','Key Performance Indicatior')} else {alert('Please Select The Designation And Month')}"/>
            </td>
		</tr>
	</table>