<?php
	include("../include/conFig.php");
	$mnth = date('m');
?>
<br/>
<br/>
<div class="title">Select Salary Profile And Month To Fill The QPE <span style="display:inline-block"></span>
</div>
<br/>
<br/>
<div style="background:#fff;height:500px;overflow-x:auto;overflow-y:auto;" id="mainDivId">
	<table width="30%" cellpadding="5" cellspacing="0" style="text-align:center" class="fetch">
		<tr>
			<?php
				$getLead = mysql_query("SELECT `id` FROM `team` WHERE `leader` = '$hrmloggedid' AND `delete` = '0'",$con) or die(mysql_error());
				$rowLead = mysql_fetch_array($getLead);
				$count = mysql_num_rows($getLead);
				if($count <= 0)
				{
					?>
					<td align="left">
						<select class="input drop-down large" name="req" id="SalaryProfile">
							<option value=""  style="width:240px;">Select Salary Profile</option>
							<?php
								$getDesig = mysql_query("SELECT `id`, `profileName` FROM `salary_structure_new` WHERE `delete`= '0'",$con) or die(mysql_error());
								while($rowDesig = mysql_fetch_array($getDesig))
								{
									?>
									<option value="<?php echo $rowDesig[0]?>"><?php echo $rowDesig[1]?></option>
									<?php
								}
							?>
						</select>
					</td>
					<?php
				}
				else
				{
					?>
					<td align="left">
						<select class="input drop-down large" name="req" id="SalaryProfile">
							<option value=""  style="width:240px;">Select Salary Profile</option>
							<?php
								$teamId = $rowLead[0];
								function display_children($hrmloggedid,$level) {
									$result = mysql_query("SELECT employee.id,employee.name,employee.salaryIdNew,employee.designation,teamamtes.mateid FROM employee,team,teamamtes WHERE team.leader = $hrmloggedid AND teamamtes.mateid = employee.id AND teamamtes.teamid = team.id AND team.delete = 0 AND employee.delete = 0 AND employee.empstatus = 2 ORDER BY employee.name ASC");
									$abcdd="";
									while ($row = mysql_fetch_array($result)) {
										$id=$row["id"];
										//	$name=$row["name"];
										//$designation=$row["designation"];
										//$abcdd.="$name--$id,";
										$abcdd.="$id,";
										$abcdd.=display_children($id,$level+1);
									}
									return $abcdd;
								}
								$rytyt=rtrim(display_children($hrmloggedid,0),",");
								if($rytyt=="")
								{
									$getDesig = mysql_query("SELECT teamamtes.mateid,employee.designation,employee.name,salary_structure_new.profileName,salary_structure_new.id as salid FROM teamamtes,employee,salary_structure_new WHERE teamamtes.teamid = '$teamId' AND employee.id = teamamtes.mateid AND employee.salaryIdNew=salary_structure_new.id AND salary_structure_new.`delete`= '0' AND employee.delete = '0' AND employee.empstatus = '2' AND employee.depcheck = '1' order by salprofile DESC",$con) or die(mysql_error());
								}else{
									$getDesig = mysql_query("SELECT employee.id,employee.designation,employee.name,salary_structure_new.profileName,salary_structure_new.id as salid FROM employee,salary_structure_new WHERE employee.id IN($rytyt) AND employee.salaryIdNew=salary_structure_new.id AND salary_structure_new.`delete`= '0' AND employee.delete = '0' AND employee.empstatus = '2' AND employee.depcheck = '1' order by salprofile DESC",$con) or die(mysql_error());
								}
								$salarycheck=array();
								while($rowDesig = mysql_fetch_array($getDesig))
								{
									$salprofile=$rowDesig["salprofile"];
									$salid=$rowDesig["salid"];
									if(!in_array($salprofile, $salarycheck))
									{
										$salarycheck[$salprofile]=$salprofile;
										?>
										<option value="<?php echo $rowDesig["salid"]?>***<?php echo $rowDesig[0]?>"><?php echo $salprofile?></option>
										<?php
										// echo $rowDesig[2].$rowDesig["salid"]***$rowDesig[0]
									}
								}
							?>
						</select>
					</td>
					<?php
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
				if($rowLead[0] <= 0)
				{
					?>
					<td>
						<input type="button" class="button green" value="GO" onclick="if((document.getElementById('SalaryProfile').value) != '' && (document.getElementById('month').value) != '') { getModule('qpe/view?SalaryProfile='+document.getElementById('SalaryProfile').value+'&smonth='+document.getElementById('month').value+'&syear='+document.getElementById('year').value,'manipulateContent','viewContent','Key Performance Indicatior')} else {alert('Please Select The Designation And Month')}" />
					</td>
					<?php
				}
				else
				{
					?>
					<td>
						<input type="button" class="button green" value="GO" onclick="if((document.getElementById('SalaryProfile').value) != '' && (document.getElementById('month').value) != '') { getModule('qpe/viewTeam?SalaryProfile='+document.getElementById('SalaryProfile').value+'&smonth='+document.getElementById('month').value+'&syear='+document.getElementById('year').value,'manipulateContent','viewContent','Key Performance Indicatior')} else {alert('Please Select The Designation And Month')}" />
					</td>
					<?php
				}
			?>
		</tr>
	</table>
