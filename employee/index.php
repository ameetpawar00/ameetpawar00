<?php
	include("../include/conFig.php");
?>

<head>
	<style type="text/css">
		.auto-style1 {
			text-align: right;
		}
		tr span{
			color: red;
		}
	</style>
</head>

<?php
	$jbvar="";
	
	if($_GET['jobappid'])
	{
		$jobappid = $_GET['jobappid'];
		
		$getData = mysql_query("SELECT jobapplicants.name, jobapplicants.contact, jobapplicants.email, designation.id, jobapplicants.qualification, jobapplicants.experience FROM jobvacancy,jobapplicants,designation WHERE jobvacancy.id = jobapplicants.jobid AND jobvacancy.designation = designation.id AND jobapplicants.id = '$jobappid'",$con) or die(mysql_error());
		$row = mysql_fetch_array($getData);
		$jbvar="&amp;jobappid=$jobappid";
	}
?>
<div class="title">
	My Employees</div>
<div class="strip">
	<span>Dashboard</span> <span>Employee</span> <span>Add New</span> </div>
<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td style="width: 30%"></td>
		<td align="right" style="width: 70%">
			<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')">
				<i class="back"></i>Back</button>&nbsp;&nbsp; </td>
	</tr>
</table>
<div style="overflow-x: hidden; overflow-y: scroll; height: 500px">
	<div class="add-new blue-border">
		<div class="form-head blue">
			<div class="head-title">
				<i class="add-form"></i>Basic Information</div>
		</div>
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td style="height: 26px" width="175px">Username <span>*</span>
				</td>
				<td style="height: 26px">
					<input id="emp0" class="input medium" name="req" type="text" />
				</td>
				<td style="height: 26px" width="175px">Password <span>*</span>
				</td>
				<td style="height: 26px">
					<input id="emp1" class="input medium" name="req" type="text" />
				</td>
			</tr>
			<tr>
				<td>Full Name <span>*</span> </td>
				<td>
					<input id="emp3" class="input medium" name="req" type="text" value="<?php echo $row[0];?>" />
				
				</td>
				<td>Father's Name</td>
				<td>
					<input id="emp33" class="input medium" name="" type="text" value="" />
				</td>
			</tr>
			<tr>
				<td>Email </td>
				<td>
					<input id="emp4" class="input medium" name="" type="text" value="<?php echo $row[2];?>" />
				</td>
				<td>Phone </td>
				<td>
					<input id="emp5" class="input medium" name="" type="text" value="<?php echo $row[1];?>" />
				</td>
			</tr>
			<tr>
				<td>Empid </td>
				<td>
					<input id="emp2" class="input medium" name="" type="text" />
				</td>
				<td>Attendance Id </td>
				<td>
					<input id="emp32" class="input medium" name="" type="text" />
				</td>
			</tr>
			<tr>
				<td>Status <span>*</span></td>
				<td>
					<input id="emp24" checked="checked" class="input checkbox" name="req" type="checkbox" value="1" />&nbsp;&nbsp;
					Active</td>
				
				<td>Shift <span>*</span></td>
				<td>
					<select id="emp35" class="input drop-down large" name="req">
						<option value="">Select Shift</option>
						<?php
							$getShift = mysql_query("SELECT `id`, `name`, `starttime`, `endtime` FROM `shift` WHERE `delete`=0",$con) or die(mysql_error());
							while($rowhift = mysql_fetch_array($getShift))
							{
								//print_r($rowhift);
								$sel='';
								if($rowhift[0]==1)
								{
									$sel='selected="selected" ';
								}
								?>
								<option  value="<?php echo $rowhift[0]?>" <?=$sel;?>>
									<?php echo $rowhift[1]." : ".$rowhift[2]." To ".$rowhift[3]; ?></option>
								<?php
							}
						?>
					</select>
				</td>
				<td></td>
				<td>
				</td>
			</tr>
			<tr>
				<td>On Job Status </td>
				<td>
					<select id="emp8" class="input drop-down large" name="">
						<option value="0">Select On Job Status</option>
						<option value="1">Regular</option>
						<option value="2">On Job Trainee (OJT)</option>
					</select>
				
				</td>
				<td  style="background: rgba(244, 67, 54, 0.3);">Salary Variables
				</td>
				<td  style="background: rgba(244, 67, 54, 0.3);">
                    <style>
                        #abcd {
                            display: none;
                        }
                        .dcc:checked ~ #abcd {
                            display: inline;
                        }
                    </style>
					<label>
						<input id="emp38" class="input checkbox dcc" type="checkbox" value="1"/>
						PF &nbsp;&nbsp;
                        <label  id="abcd">
                            <input id="emp45" class="input checkbox " type="checkbox" value="1"/>
                            PF (Fixed)&nbsp;&nbsp;
                        </label>
					</label>

					<label>
						<input id="emp39" class="input checkbox" type="checkbox"  value="1" />
						ESIC &nbsp;&nbsp;
					</label>
					<label>
						<input id="emp40" class="input checkbox" type="checkbox"  value="1" />
						PT &nbsp;&nbsp;
					</label>
					<label>
						<input id="emp41" class="input checkbox" type="checkbox"  value="1" />
						TDS &nbsp;&nbsp;
					</label>
				</td>
			</tr>
			<tr>
				<td>Emp. Account Name
				</td>
				<td>
					<input class="input medium"  name="" type="text" id="emp43" />
				</td>
				<td>First Salary Review<span>*</span>
				</td>
				<td>
					<select id="emp44" class="input drop-down large" name="req">
						<option value="">Select Month</option>
						<?php
							for($trt=0;$trt<13;$trt++)
							{
								$sel='';
								if($trt==3)
								{
									$sel='selected="selected" ';
								}
								
								echo '<option value="'.$trt.'" '.$sel.'>'.$trt.'</option>';
							}
						?>
				</td>
			</tr>
		
		</table>
	</div>
	<br />
	<div class="add-new blue-border">
		<div class="form-head blue">
			<div class="head-title">
				<i class="add-form"></i>Work Information</div>
		</div>
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td>Designation <span>*</span> </td>
				<td><select id="emp6" class="input drop-down large" name="req">
						<option value="">Select Designation</option>
						<?php
							$getDesig = mysql_query("SELECT `id`,`name` FROM `designation` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
							while($rowDesig = mysql_fetch_array($getDesig))
							{
								?>
								<option <?php if($rowDesig[0] == $row[3]) echo 'selected=selected';?>="" value="<?php echo $rowDesig[0]?>">
								<?php echo $rowDesig[1]?></option>
								<?php
							}
						?></select> </td>
				<td>Department  <span>*</span></td>
				<td><select id="emp7" class="input drop-down large" name="req">
						<option value="">Select Department</option>
						<?php
							$getDept = mysql_query("SELECT `id`,`name` FROM `department` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
							while($rowDept = mysql_fetch_array($getDept))
							{
								?>
								<option value="<?php echo $rowDept[0]?>"><?php echo $rowDept[1]?>
								</option>
								<?php
							}
						?></select> </td>
			</tr>
			<tr>
				
				<td>Work Email </td>
				<td><input id="emp9" class="input medium" name="" type="text" />
				</td>
			</tr>
			<tr>
				<td>Location </td>
				<td><select id="emp10" class="input drop-down large" name="">
						<option value="">Select Location</option>
						<?php
							$getLoc = mysql_query("SELECT `id`,`name` FROM `location` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
							while($rowLoc = mysql_fetch_array($getLoc))
							{
								?>
								<option value="<?php echo $rowLoc[0]?>"><?php echo $rowLoc[1]?>
								</option>
								<?php
							}
						?></select> </td>
				<td>Salary Profile </td>
				<td>
                    <select id="emp11" class="input drop-down large" name="" disabled>
                        <option value="0">Select Salary Profile</option>
						<?php
							$getDesiga = mysql_query("SELECT `id`,`salprofile` FROM `salary` WHERE `delete`= '0' ",$con) or die(mysql_error());
							while($rowDesiga = mysql_fetch_array($getDesiga))
							{
								?>
								<option value="<?php echo $rowDesiga[0]?>"><?php echo $rowDesiga[1]?></option>
								<?php
							}
						?></select>
                    <br>
                    <select id="emp46" class="input drop-down large" name="">
						<option value="">Select Salary Profile New</option>
						<?php
							$getDesig = mysql_query("SELECT `id`,`profileName` FROM `salary_structure_new` WHERE `delete`= '0' ",$con) or die(mysql_error());
							while($rowDesig = mysql_fetch_array($getDesig))
							{
								?>
								<option value="<?php echo $rowDesig[0]?>"><?php echo $rowDesig[1]?></option>
								<?php
							}
						?></select>
                </td>
			</tr>
			<tr>
				<td>Source Of Hire </td>
				<td><select id="emp12" class="input drop-down large" name="">
						<option value="">Select Source</option>
						<?php
							$getLoc = mysql_query("SELECT `id`,`name` FROM `sourceofhire` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
							while($rowLoc = mysql_fetch_array($getLoc))
							{
								?>
								<option value="<?php echo $rowLoc[0]?>"><?php echo $rowLoc[1]?>
								</option>
								<?php
							}
						?></select> </td>
				<td>Date Of joining <span>*</span> </td>
				<td>
					<input id="emp13" class="inputCalendar" class="input medium" name="" onclick="openCalender('calenderid0','emp13')" readonly="readonly" style="width: 200px" type=""  name="req"/>
					<div id="calenderid0" class="calender">
					</div>
				</td>
			</tr>
			<tr>
				<td>Employee Status <span>*</span> </td>
				<td><select id="emp14" class="input drop-down large" name="req">
						<option value="">Select Status</option>
						<?php
							$getLoc = mysql_query("SELECT `id`,`name` FROM `employeestatus` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
							while($rowLoc = mysql_fetch_array($getLoc))
							{
								$sel='';
								if($rowLoc[0]==2)
								{
									$sel='selected="selected" ';
								}
								?>
								<option value="<?php echo $rowLoc[0]?>" <?=$sel?>><?php echo $rowLoc[1]?>
								</option>
								<?php
							}
						?></select> </td>
				<td>Branch<span>*</span> </td>
				<td><select id="emp15" class="input drop-down large" name="req">
						<option value="">Select Branch</option>
						<?php
							// AND `id` != '1'
							$getBranch= mysql_query("SELECT `id`,`name` FROM `branch` WHERE `delete`= '0'",$con) or die(mysql_error());
							while($rowDesig = mysql_fetch_array($getBranch))
							{
								$sel="";
								if($rowDesig[0]==2)
								{
									$sel='selected="selected" ';
								}
								
								?>
								<option value="<?php echo $rowDesig[0]?>" <?=$sel?>><?php echo $rowDesig[1]?>
								</option>
								<?php
							}
						?></select> </td>
			</tr>
			<tr>
				<td>Referred By </td>
				<td><select id="emp30" class="input drop-down large" name="">
						<option value="">Select Employee</option>
						<?php
							$getLoc = mysql_query("SELECT `id`,`name` FROM `employee` WHERE `delete`= '0' AND `id` != '1' AND `empstatus`=2",$con) or die(mysql_error());
							while($rowLoc = mysql_fetch_array($getLoc))
							{
								?>
								<option value="<?php echo $rowLoc[0]?>"><?php echo $rowLoc[1]?>
								</option>
								<?php
							}
						?></select> </td>
				<td>Role</td>
				<td><select id="emp31" class="input drop-down large" name="req">
						<option value="111">Select Role</option>
						<?php
							$getRole = mysql_query("SELECT `id`,`name` FROM `rolls` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
							while($rowRole = mysql_fetch_array($getRole))
							{
								$sel="";
								if($rowRole[0]==3)
								{
									$sel='selected="selected" ';
								}
								
								?>
								<option value="<?php echo $rowRole[0]?>" <?=$sel?>><?php echo $rowRole[1]?>
								</option>
								<?php
							}
						?></select> </td>
			</tr>
		</table>
	</div>
	<br />
	<div class="add-new blue-border">
		<div class="form-head blue">
			<div class="head-title">
				<i class="add-form"></i>Personal</div>
		</div>
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td style="width: 175px">Mobile  </td>
				<td style="width: 495px">
					<input id="emp16" class="input medium" name="" type="text" />
				</td>
				<td style="width: 175px">Date Of Birth </td>
				<td>
					<input id="emp17" class="inputCalendar" class="input medium" name="" onclick="openCalender('calenderid1','emp17')" readonly="readonly" style="width: 200px" type="" />
					<div id="calenderid1" class="calender">
					</div>
				</td>
			</tr>
			<tr>
				<td valign="top">Current Address  </td>
				<td >
					<textarea id="emp18" class="input huge" name="TextArea" style="width: 475px; height: 75px"></textarea></td>
				<td valign="top">Permanent Address </td>
				<td >
					<textarea id="emp34" class="input huge" name="" style="width: 475px; height: 75px"></textarea></td>
			</tr>
			<tr>
				<td>State</td>
				<td>
					<select id="state" class="input drop-down large" name="Select1" onchange="getModule('employee/getCity?id=emp23&amp;state='+this.value,'getCity','',document.title)" style="width: 200px">
						<option value="">Select State</option>
						<?php
							$getCity = mysql_query("SELECT `name`,`id` FROM `state` WHERE `delete` = '0'",$con) or die(mysql_error());
							while($rowCity = mysql_fetch_array($getCity))
							{
								?>
								<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?>
								</option>
								<?php
							}
						?></select>&nbsp;&nbsp;&nbsp;&nbsp; </td>
				<td>City </td>
				<td><span id="getCity" style="display: inline">
				<select id="emp23" class="input drop-down large" name="Select1">
				<option value="1">Select State First</option>
				</select> </span></td>
			</tr>
			<tr>
				<td>Marital Status</td>
				<td style="width: 495px">
					<input id="single" name="Radio1" onclick="document.getElementById('doa').style.display='none';document.getElementById('emp19').value=this.value" type="radio" value="0"  checked=""/><span style="padding-left: 5px; padding-right: 25px;">Single</span>
					<input id="married" name="Radio1" onclick="document.getElementById('doa').style.display='table-row';document.getElementById('emp19').value=this.value" type="radio" value="1" /><span style="padding-left: 3px; padding-right: 10px;">Married</span>
					<input id="emp19" class="input medium" name="Text1" type="hidden" value="0"/>
				</td>
				<td>Gender </td>
				<td>
					<select id="emp25" class="input drop-down large" name="Select1">
						<option value="">Select Gender</option>
						<option value="0">Male</option>
						<option value="1">Female</option>
					</select> </td>
			</tr>
			<tr id="doa" style="display: none">
				<td>Date Of Anniversary</td>
				<td colspan="3">
					<input id="emp20" class="input medium" class="inputCalendar" name="" onclick="openCalender('calenderid2','emp20')" readonly="readonly" style="width: 200px" type="" />
					<div id="calenderid2" class="calender">
					</div>
				</td>
			</tr>
			<tr>
				<td>Bank </td>
				<td>
					<select id="emp27" class="input drop-down large" name="" name="Select1">
						<option value="">Select Bank</option>
						<?php
							$getDesig = mysql_query("SELECT `id`,`name` FROM `bank` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
							while($rowDesig = mysql_fetch_array($getDesig))
							{
								?>
								<option value="<?php echo $rowDesig[0]?>"><?php echo $rowDesig[1]?>
								</option>
								<?php
							}
						?></select> </td>
				<td style="width: 175px">Account No </td>
				<td style="width: 495px">
					<input id="emp28" class="input medium" name="" type="text" />
				</td>
			</tr>
			<tr>
				<td style="width: 175px">PF Account No </td>
				<td>
					<input id="emp29" class="input medium" name="" type="text" />
				</td>
				<td style="width: 175px">PAN Card No </td>
				<td>
					<input id="emp36" class="input medium" name="" type="text" />
				</td>
			</tr>
			<tr>
				<td style="width: 175px">Aadhar Card No </td>
				<td>
					<input id="emp37" class="input medium" name="" type="text" />
				</td>
				<td style="width: 175px"> ESIC No.</td>
				<td>
					<input class="input medium"  name="" id="emp42" type="text"  />
				</td>
			</tr>
		</table>
	</div>
	<br />
	<?php
		$h = 47;
		$getData = mysql_query("SELECT * FROM `document` WHERE `updatedby` = '$hrmloggedid1' AND `delete` = '0' ",$con) or die(mysql_error());
		$numRows = mysql_num_rows($getData);
		if($numRows>0) {
			?>
		
		<?php } ?><br />
	<div class="add-new blue-border">
		<div class="form-head blue">
			<div class="head-title">
				<i class="add-form"></i>Summary</div>
		</div>
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
				
				<td style="width: 175px" valign="top">Hobbies & <br>Area of Interest</td>
				<td><textarea id="emp21" class="input huge" name="TextArea"></textarea>
				</td>
				<td style="width: 175px" valign="top">About Me </td>
				<td>
					<textarea id="emp26" class="input huge" cols="20" name="TextArea"></textarea>
				</td>
			</tr>
			<tr>
				<td valign="top">Specialization </td>
				<td>
					<textarea id="emp22" class="input huge" cols="20" name="TextArea" rows="2"></textarea>
				</td>
			</tr>
			<tr>
				<td colspan="4" style="text-align: center;">
					<div id="couResp" style="display: inline-block;">
					</div>
				</td>
			</tr>
			<tr>
				<td class="auto-style1" colspan="4" style="text-align: center">
					<button class="button green" onclick="SaveData('employee/save?type=<?php echo $type;?>&amp;h=<?php echo $h; echo $jbvar;?>','emp','<?php echo $h?>','','','manipulateContent','1')">
						<div class="auto-style1">
							<i class="save-icon"></i>Save</div>
					</button>
					<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')">
						<i class="close-icon"></i>Cancel</button></td>
			</tr>
		</table>
	</div>
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
</div>
