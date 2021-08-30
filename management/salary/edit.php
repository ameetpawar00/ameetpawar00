<?php
include("../../include/conFig.php");
include("../../include/leave_calculation.php");
include("../../include/calculateAbsent_trifid.php");
$eid = $_GET['eid'];
//del code added on 07 - 02 - 2017 to delete salary slip due to fault in edit system
if (isset($_GET['del'])) {
	$getStarting = mysql_query("DELETE FROM `salaryslip` WHERE `id`='$eid'",$con) or die(mysql_error());
}
else
{


	$mnth     = $_GET['month'];
	$empsalid = $_GET['empsalid'];
	$attDetail= explode("**--**",$_GET['attDetail']);
	if (isset($_COOKIE['selectedYear'])) {
		$year = $_COOKIE['selectedYear'];
	}
	else
	{
		$year = date("Y");
	}
	/**find the first and last date of month**/
	$startTime   = date('Y-'.$mnth.'-1');
	//echo ' < br > ';
	$endTime     = '';
	$monthDays   = cal_days_in_month(CAL_GREGORIAN, $mnth,$year);
	$days        = getSundayCount($startTime, $endTime, $monthDays);
	$sundayCount = count($days);

	$monthName   = date("F", mktime(0, 0, 0, $mnth, 10));
	//$total_attend = checkin_cal($eid,$mnth,$year);


	//$attendCount = count($total_attend);
	//$absDays = $monthDays - $attendCount;
	//echo "SELECT * FROM `salary` WHERE `id` = '$empsalid' AND `delete` = '0'";
	//echo "SELECT * FROM `salaryslip` WHERE `employee` = '$eid' AND `month` = '$mnth' AND `year` = '$year'";
	$getStarting = mysql_query("SELECT * FROM `salaryslip` WHERE `employee` = '$eid' AND `month` = '$mnth' AND `year` = '$year'",$con) or die(mysql_error());
	$rowStarting = mysql_fetch_array($getStarting);
	$id          = $rowStarting['id'];
	$getStartings = mysql_query("SELECT * FROM `salaryslip_extra` WHERE `employee` = '$eid' AND `sid` = '$id'",$con) or die(mysql_error());
	$rowpost = mysql_fetch_array($getStartings);
	//print_r($rowStarting);
	/*$getKPIpoint = mysql_query("SELECT kpi.marks,kpiparameters.maximum FROM kpi,kpiparameters WHERE kpi.employee = '$eid' AND kpi.month = '$mnth' AND kpi.kpiparameter = kpiparameters.id",$con) or die(mysql_error());
	while($rowKPIpoint = mysql_fetch_array($getKPIpoint))4101 21
	1
	{
	$obtainkpi += $rowKPIpoint[0];
	$Maxkpi += $rowKPIpoint[1];
	}
	$average = ($obtainkpi/$Maxkpi)*100;*/
	$basic       = $rowStarting['basic'];
	$con_allow   = $rowStarting['con_allow'];
	$spec_allow  = $rowStarting['spec_allow'];
	$other_allow = $rowStarting['other_allow'];
	$perf_allow  = $rowStarting['perf_allow'];
	$att_allow   = $rowStarting['att_allow'];
	$perf_Bonus  = $rowStarting['perf_Bonus'];
	$train_allow = $rowStarting['train_allow'];
	$travel_allow= $rowStarting['travel_allow'];
	$add_earning = $rowStarting['add_earning'];
	$PF          = $rowStarting['PF'];
	$lMin        = $rowStarting['latecomesmins'];
	$latecomededuc  = $rowStarting['latecomes'];
	$saldeduc       = $rowStarting['deduction'] - $latecomededuc;
	$kpiamount      = $rowStarting['perf_allow'];
	$leaveBalance   = $rowStarting['leaveBalance'];
	
	$workingdays  = $rowStarting['workingdays'];
	$present        = $rowStarting['present'];
	$absent         = $rowStarting['absent'];
	$totaldays         = $rowStarting['totaldays'];
	$leave          = $rowStarting['leave'];//leaves approved other than lwp
	$absent_days_not_approved = $rowpost['absent_days_not_approved'];////////
	$lwp = $rowpost['lwp'];////////
	
	$getsalary   = mysql_query("SELECT * FROM `salary` WHERE `id` = '$empsalid' AND `delete` = '0'",$con) or die(mysql_error());
	$rowsalary      = mysql_fetch_array($getsalary);
	$getbasic       = $rowsalary ['basic'];
	$getcon_allow   = $rowsalary ['con_allow'];
	$getspec_allow  = $rowsalary ['spec_allow'];
	$getother_allow = $rowsalary ['other_allow'];
	$finalSal       = $getbasic + $getcon_allow + $getspec_allow + $getother_allow;
	$salperdayNA    = round($finalSal / $totaldays);
	$salperhalfNA   = round($salperdayNA / 2);
	$salperday      = round($basic / $totaldays);
	$salperhalf     = round($salperday / 2);
	?>
	<div class="title">
		Edit Salary Info For
		<span style="font-weight:bold">
			<?php echo $_GET['name']?>
		</span>Month
		<span class="maroon" style="font-weight:bold">
			<?php echo $monthName?>
		</span>
	</div>
	<table width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<td style="width:30%">
			</td>
			<td style="width:70%" align="right">
				<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')">
					<i class="back">
					</i>Back
				</button>&nbsp;&nbsp;
			</td>
		</tr>
	</table>
	<div style="overflow-x:scroll;overflow-y:scroll;height:500px">
	<div class="add-new blue-border">
		<div class="form-head blue">
			<div class="head-title">
				<div style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;font-size:12px;float:right;display:none" >
					Pervious Leave Record => 12; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Remaining Leave Record => 10;
				</div>
			</div>
		</div>
		<table cellpadding="0" cellspacing="0" width="100%" style="text-align:left">
			<tr>
			<td colspan="2" style="text-align:center">
				<div style="display:inline-block;" id="couResp">
				</div>
			</td>
			<tr>
				<td colspan="8" style="text-align:center;font-style:italic;font-weight:lighter">
					Deduction For One Day Absent(approved) =>  Rs <?php echo $salperday?>/-; Deduction For Half Day Absent(approved) =>  Rs <?php echo $salperhalf?>/-<br/>
					Deduction For One Day Absent(not approved) =>  Rs <?php echo $salperdayNA?>/-; Deduction For Half Day Absent(not approved) =>  Rs <?php echo $salperhalfNA ?>/-
				</td>
			</tr>
			<tr>
				<th>
					Total Days In Month
				</th>
				<td>
					<input name="req1"  type="text"  id="sals0" title="isNotNull"  class="inputDisabled" value="<?php echo $totaldays?>" readonly="readonly" size="20">
				</td>
				<th>
					Working Days
				</th>
				<td >
					<input name="req"  type="text"   id="sals1" title="isNotNull" class="inputDisabled" value="<?php echo $workingdays?>">
				</td>
				<th>
					Present Days
				</th>
				<td style="display:">
					<input name="req"  type="text"  id="sals2" title="isNotNull" class="inputDisabled" value="<?php echo $present?>">
				</td>
				
				<th>
					Total Absent Days 
				</th>
				<td>
					<input name="req"  type="text"  readonly="" id="sals8" title="isNotNull" class="inputDisabled" value="<?php echo $absent?>" >
					<input name="req"  type="hidden"   id="sals22" title="isNotNull" class="inputDisabled" value="<?php echo $leave?>"  >
				</td>
				
			</tr>
			<tr>
				<th>
					Absent Days(Approved)
				</th>
				<td>
					<input name="req"  type="text"  id="sals3" title="isNotNull"  class="input middle" value="<?php echo $lwp?>" onkeyup="calculatesalaryApp('sals8','sals3','sals4','sals9','sals7','sals0','sals10','sals11','sals12','sals23')">
				</td>
				<th>
					Absent Days(Not Approved)
				</th>
				<td >
					<input name="req"  type="text"   id="sals4" title="isNotNull" class="input middle" value="<?php echo $absent_days_not_approved?>" onkeyup="calculatesalaryApp('sals8','sals3','sals4','sals9','sals7','sals0','sals10','sals11','sals12','sals23')">
				</td>
				<th style="display:">
					Late come Deduction <input name="req"  type="text"   id="sals24" title="isNotNull" class="inputDisabled" value="<?php echo $lMin?>" readonly="readonly">
				</th>
				<td style="display:">
					<input name="req"  type="text"   id="sals5" title="isNotNull" class="inputDisabled" value="<?php echo $latecomededuc?>" readonly="readonly">
				</td>

				<th style="display:none">
					
				</th>
				<td style="display:none">
					
				</td>
			</tr>
			<tr>
				<th style="display:none">
					
				</th>
				<td style="display:none">
					
				</td>
				<th style="display:none">
					Leave Days(Not Approved)
				</th>
				<td style="display:none">
					<input name="req"  type="text"   id="sals6" title="isNotNull" class="inputDisabled" value="<?php echo "0"?>" >
				</td>

				<th>
					Deduction
				</th>
				<td>
					<input name="req"  type="text"  id="sals7" title="isNotNull" class="inputDisabled" value="<?php echo $saldeduc ?>" readonly="readonly">
				</td>
				<th>
					Basic
				</th>
				<td>
					<input name="req"  type="text"  id="sals9" title="isNotNull"  class="input" value="<?php echo $basic?>">
				</td>
				<th>
					Balance leave
				</th>
				<td>
					<input name="req"  type="text"  id="sals23" title="isNotNull" value="<?php echo $leaveBalance ?>" onkeyup="calculatesalaryApp('sals8','sals3','sals4','sals9','sals7','sals0','sals10','sals11','sals12','sals23')">
					<div style="z-index:20000000000000000000;float:right">
						<div class="button green" style="position:fixed;right:0px;cursor:pointer;padding:4px;" onclick="getModule('management/salary/story/view?eid=<?php echo $eid?>&name=<?php echo $_GET['name']?>','manipulatemoodleContent','viewmoodleContent','Story Line')">
							Story
						</div>
					</div>
				</td>

			</tr>
			<tr>
				<th>
					Conveyance Allowance
				</th>
				<td >
					<input name="req"  type="text"   id="sals10" title="isNotNull" class="input" value="<?php echo $con_allow?>">
				</td>
				<th>
					Special Allowance
				</th>
				<td>
					<input name="req"  type="text"  id="sals11" title="isNotNull" class="input" value="<?php echo $spec_allow?>">
				</td>

				<th>
					Other Allowance
				</th>
				<td>
					<input name="req"  type="text"  id="sals12" title="isNotNull"  class="input" value="<?php echo $other_allow?>">
				</td>
			</tr>
			<tr>
				<th>
					Performance Allowance
				</th>
				<td >
					<input name="req"  type="text"   id="sals13" title="isNotNull" class="input" value="<?php echo $kpiamount?>">
				</td>
				<th>
					Attendance Allowance
				</th>
				<td>
					<input name="req"  type="text"  id="sals14" title="isNotNull" class="input" value="<?php echo $att_allow?>" style="border-color:red">
				</td>
				<th>
					Performance Bonus
				</th>
				<td>
					<input name="req"  type="text"  id="sals15" title="isNotNull"  class="input" value="<?php echo $perf_Bonus?>"  style="border-color:red">
				</td>
			</tr>
			<tr>
				<th>
					Training Allowance
				</th>
				<td >
					<input name="req"  type="text"   id="sals16" title="isNotNull" class="inputDisabled" value="<?php echo $train_allow?>">
				</td>
				<th>
					Mobile Allowance
				</th>
				<td>
					<input name="req"  type="text"  id="sals17" title="isNotNull" class="" value="<?php echo $travel_allow?>">
				</td>

				<th>
					HRA
				</th>
				<td>
					<input name="req"  type="text"  id="sals18" title="isNotNull"  class="" value="<?php echo $add_earning?>">
				</td>
			</tr>

			<tr>
				<th>
					Provident Fund
				</th>
				<td >
					<input name="req"  type="text"   id="sals19" title="isNotNull" class="inputDisabled" value="<?php echo $PF?>">
				</td>

				<th style="height: 26px">
					Adjustment
				</th>
				<td style="height: 26px"><input name="req" id="sals20" type="text" style="width:100px;border-color:red"  title="isNotNull" class="input" value="<?php echo $rowStarting['adjustment']?>" onkeypress="return chkNumbers(event)"  >
				<th style="height: 26px">
					Mode
					<span>
						*
					</span>
				</th>
				<td style="height: 26px">
					<select name="Select1" id="sals21" style="border-color:red">
						<option value="select mode">
							Select
						</option>
						<option <?php
 if ($rowStarting['mode'] == 'Add') echo "selected = 'selected'";?> value="Add">
							Add
						</option>
						<option  <?php
 if ($rowStarting['mode'] == 'Deduct') echo "selected = 'selected'";?> value="Deduct">
							Deduct
						</option>
					</select>
				</td>

			</tr>
			<tr>
				<th>
				</th>
				<td >
				</td>

				<th style="height: 26px">
					TDS
				</th>
				<td style="height: 26px">
				<input name="req" id="sals25" type="text" style="width:100px;"  title="isNotNull" class="input" onkeypress="return chkNumbers(event)" value="<?php echo $rowStarting['TDS']?>">
				<th style="height: 26px">
					Mode
					<span>
						*
					</span>
				</th>
				<td style="height: 26px">
					<select name="Select1" id="sals26">
						<option value="Add">
							Add
						</option>
						<option <?php
 if ($rowStarting['TMODE'] == 'Add') echo "selected = 'selected'";?> value="Add">
							Add
						</option>
						<option  <?php
 if ($rowStarting['TMODE'] == 'Deduct') echo "selected = 'selected'";?> value="Deduct">
							Deduct
						</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>
					Total Salary
				</th>
				<td >
					<input name="req"  type="text"   id="" title="isNotNull" class="inputDisabled" readonly="readonly" value="<?php echo $rowStarting['total']?>">
				</td>


			</tr>
			<tr>
				<td colspan="6" style="text-align:center">
					<button class="button green" onclick="SaveData('management/salary/save?id=<?php echo $id?>&month=<?php echo $mnth?>','sals','28','salary--**--<?php echo $mnth?>','','couResp','1');">
						<i class="save-icon">
						</i>Save
					</button>
					<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')">
						<i class="close-icon">
						</i>Cancel
					</button>
				</td>
			</tr>
		</table>
	</div>
	<!--
	getModule('management/salary/view?month=<?php echo $mnth?>','viewContent','manipulateContent','Manage Salary')-->
	<?php
} ?>