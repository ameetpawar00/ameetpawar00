 <?php
	include("../include/conFig.php");
	$mnth = date('m');
?>
<br/>
<br/>
<div class="title">Select Designation And Month To Fill The KPI <span style="display:inline-block"></span>
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
							/*$getDesig = mysql_query("SELECT teamamtes.mateid,employee.designation,employee.name FROM teamamtes,employee WHERE teamamtes.teamid = '$teamId' AND employee.id = teamamtes.mateid",$con) or die(mysql_error());
							while($rowDesig = mysql_fetch_array($getDesig))
							{
					echo $tyr=<<<AAA
								<option value="$rowDesig[1]***$rowDesig[0]">$rowDesig[2]</option>
					AAA;
							}*/
							//display_children($hrmloggedid,"");
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
						//$name=strtoupper($row["name"]);

						$designation=$row["designation"];
						$mateid=$row["mateid"];
						
						//echo $sdds;
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
			<option value="$designation***$id" style="background:" class="$lfkt">$name <b>$Poname</b></option>
AAA;
						/*
						 echo $tyr=<<<AAA
			<option value="$designation***$id" style="background: $colotuy" class="$lfkt">$name <b>$Poname</b></option>
AAA;
						*/
						
						if(display_children($id,$level+1,$allLeaders,$getDesigAll))
						{
							$namesad=strtoupper($row["name"]);
							
							$tyra.=<<<AAA
							<optgroup value="$designation***$id" label="$namesad $Poname" style="background: $colotuy" ></optgroup>
AAA;
							$tyra.=display_children($id,$level+1,$allLeaders,$getDesigAll);
						}
					}
					return $tyr.$tyra;
				}
				
		
			
			
			?>
			<td><div class="" style="display:inline-block"><select class="input drop-down" name="Select1" id="month" >
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
					</select></div></td>
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
			<?php
				if(!$allLeaders[$hrmloggedid])
				{
					?>
					<td>
						<input type="button" class="button green" value="GO" onclick="if((document.getElementById('desig').value) != '' && (document.getElementById('month').value) != '') { getModule('kpi/view?desig='+document.getElementById('desig').value+'&smonth='+document.getElementById('month').value+'&syear='+document.getElementById('year').value,'manipulateContent','viewContent','Key Performance Indicatior')} else {alert('Please Select The Designation And Month')}"/>
					</td>
					<?php
				}
				else
				{
					?>
					<td>
						<input type="button" class="button green" value="GO" onclick="if((document.getElementById('desig').value) != '' && (document.getElementById('month').value) != '') { var emdData=document.getElementById('desig').value; var emdDataary=emdData.split('***');  var desig=emdDataary[0]; var empId=emdDataary[1]; getModule('kpi/view?desig='+desig+'&empId='+empId+'&smonth='+document.getElementById('month').value+'&syear='+document.getElementById('year').value,'manipulateContent','viewContent','Key Performance Indicatior')} else {alert('Please Select The Designation And Month')}"/>
					</td>
					<?php
				}
			?>
		</tr>
	</table>