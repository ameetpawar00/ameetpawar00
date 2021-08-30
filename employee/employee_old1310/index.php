<?php
include("../include/conFig.php");
?>
<head>
<style type="text/css">
.auto-style1 {
	text-align: right;
}
</style>
</head>

<?php
if($_GET['jobappid'])
{
$jobappid = $_GET['jobappid'];
$getData = mysql_query("SELECT jobapplicants.name, jobapplicants.contact, jobapplicants.email, designation.id, jobapplicants.qualification, jobapplicants.experience FROM job,jobapplicants,designation WHERE job.id = jobapplicants.jobid AND job.post = designation.id AND jobapplicants.id = '$jobappid'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
}
?>
<div class="title">My Employees</div>
<div class="strip">
<span>Dashboard</span>
<span>Employee</span>
<span>Add New</span>
</div>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"> <i class="back"></i>Back</button>&nbsp;&nbsp;
</td>
</tr>
</table>

<div style="overflow-x:hidden;overflow-y:scroll;height:500px">
<div class="add-new blue-border">
<div class="form-head blue">
<div class="head-title"> 
<i class="add-form"></i> 
Basic Information</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td width="175px" style="height: 26px">Username <span>*</span>
	</td>
	<td style="height: 26px"><input class="input medium"  name="req" type="text" id="emp0" />
	</td>
	<td width="175px" style="height: 26px">Password <span>*</span>
	</td>
	<td style="height: 26px"><input class="input medium" name="req" type="text" id="emp1" />
	</td>
</tr>
<tr>
	<td>Empid <span>*</span>
	</td>
	<td><input class="input medium" name="req" type="text" id="emp2"/>
	</td>
	<td>Name <span>*</span>
	</td>
	<td><input class="input medium" name="req" type="text" id="emp3" value="<?php echo $row[0];?>" />
	</td>
</tr>
<tr>
	<td>Email <span>*</span>
	</td>
	<td><input class="input medium" name="req" type="text" id="emp4" value="<?php echo $row[2];?>"/>
	</td>
	<td>Phone  <span>*</span>
	</td>
	<td><input class="input medium" name="req" type="text" id="emp5" value="<?php echo $row[1];?>"/>
	</td>
</tr>
<tr>
	<td>Status <span>*</span></td>
	<td><input class="input checkbox" name="req" id="emp24" type="checkbox" value="1" checked="checked"/>&nbsp;&nbsp;&nbsp;Active</td>
		<td>Attendance Id<span>*</span>
	</td>
	<td><input class="input medium" name="req" type="text" id="emp32"/>
	</td>

</tr>

</table>
</div>
<br/>

<div class="add-new blue-border">
<div class="form-head blue">
<div class="head-title"> 
<i class="add-form"></i> 
Work Information</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td>Designation <span>*</span>
	</td>
	<td>
	<select class="input drop-down large" name="req" id="emp6" >
				<option value="">Select Designation</option>
<?php
$getDesig = mysql_query("SELECT `id`,`name` FROM `designation` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowDesig = mysql_fetch_array($getDesig))
{
?>				
				<option <?php if($rowDesig[0] == $row[3]) echo 'selected=selected';?> value="<?php echo $rowDesig[0]?>"><?php echo $rowDesig[1]?></option>
<?php
}
?>				
			</select>
	</td>
	<td>Department <span>*</span>
	</td>
	<td><select class="input drop-down large" name="req" id="emp7">
				<option value="">Select Department</option>
<?php
$getDept = mysql_query("SELECT `id`,`name` FROM `department` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowDept = mysql_fetch_array($getDept))
{
?>				
				<option value="<?php echo $rowDept[0]?>"><?php echo $rowDept[1]?></option>
<?php
}
?>				
			</select>

	</td>
</tr>
<tr>
	<td>Work Phone 
	</td>
	<td><input class="input medium" name="" type="text" id="emp8"/>
	</td>
	<td>Work Email 	</td>
	<td><input class="input medium" name="" type="text" id="emp9"/>
	</td>
</tr>
<tr>	
	<td>Location
	</td>
	<td><select class="input drop-down large" name="" id="emp10">
				<option value="">Select Location</option>
<?php
$getLoc = mysql_query("SELECT `id`,`name` FROM `location` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowLoc = mysql_fetch_array($getLoc))
{
?>				
				<option value="<?php echo $rowLoc[0]?>"><?php echo $rowLoc[1]?></option>
<?php
}
?>				
			</select>

	</td>	<td>Salary Profile<span>*</span>
	</td>
	<td><select class="input drop-down large" name="req" id="emp11">
				<option value="">Select Profile</option>
<?php
$getDesig = mysql_query("SELECT `id`,`salprofile` FROM `salary` WHERE `delete`= '0' ",$con) or die(mysql_error());
while($rowDesig = mysql_fetch_array($getDesig))
{
?>				
				<option value="<?php echo $rowDesig[0]?>"><?php echo $rowDesig[1]?></option>
<?php
}
?>				
			</select>

	</td>
</tr>
<tr>	
	<td>Source Of Hire 
	</td>
	<td><select class="input drop-down large" name="" id="emp12">
				<option value="">Select Source</option>
<?php
$getLoc = mysql_query("SELECT `id`,`name` FROM `sourceofhire` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowLoc = mysql_fetch_array($getLoc))
{
?>				
				<option value="<?php echo $rowLoc[0]?>"><?php echo $rowLoc[1]?></option>
<?php
}
?>				
			</select>

	</td>	<td>Date Of joining 
	</td>
	<td><input class="input medium" name="" id="emp13" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalender('calenderid0','emp13')"/>
			<div class="calender" id="calenderid0"></div>

	</td>
</tr>
<tr>	
	<td>Employee Status <span>*</span>
	</td>
	<td><select class="input drop-down large" name="req" id="emp14">
				<option value="">Select Status</option>
<?php
$getLoc = mysql_query("SELECT `id`,`name` FROM `employeestatus` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowLoc = mysql_fetch_array($getLoc))
{
?>				
				<option value="<?php echo $rowLoc[0]?>"><?php echo $rowLoc[1]?></option>
<?php
}
?>				
			</select>

	</td>	<td>Branch<span>*</span>

	</td>
	<td><select class="input drop-down large" name="req" id="emp15">
				<option value="">Select Branch</option>
<?php
$getBranch= mysql_query("SELECT `id`,`name` FROM `branch` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowDesig = mysql_fetch_array($getBranch))
{
?>				
				<option value="<?php echo $rowDesig[0]?>"><?php echo $rowDesig[1]?></option>
<?php
}
?>				
			</select>

	</td>
</tr>
<tr>	
	<td>Referred By	</td>
	<td><select class="input drop-down large" name="" id="emp30">
				<option value="">Select Employee</option>
<?php
$getLoc = mysql_query("SELECT `id`,`name` FROM `employee` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowLoc = mysql_fetch_array($getLoc))
{
?>				
				<option value="<?php echo $rowLoc[0]?>"><?php echo $rowLoc[1]?></option>
<?php
}
?>				
			</select>
</td>
<td>Role
	</td>
	<td><select class="input drop-down large" name="" id="emp31">
				<option value="">Select Role</option>
<?php
$getRole = mysql_query("SELECT `id`,`name` FROM `rolls` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowRole = mysql_fetch_array($getRole))
{
?>				
				<option value="<?php echo $rowRole[0]?>"><?php echo $rowRole[1]?></option>
<?php
}
?>				
			</select>

	</td>
</table>
</div>
<br/>

<div class="add-new blue-border">
<div class="form-head blue">
<div class="head-title"> 
<i class="add-form"></i> 
Personal</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td style="width:175px">Mobile
	</td>
	<td style="width: 495px"><input class="input medium" name="" type="text" id="emp16"/>
	</td>
	<td style="width:175px">Date Of Birth
	</td>
	<td><input class="input medium" name="" id="emp17" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalender('calenderid1','emp17')"/>
				<div class="calender" id="calenderid1"></div>

	</td>
</tr>
<tr>
	<td valign="top">Address</td>
	<td colspan="3">
	<textarea class="input huge" id="emp18" name="TextArea" style="width: 475px; height: 75px"></textarea></td>
	
</tr>
<tr>
<td>State</td>
	<td>

<select class="input drop-down large" name="Select1" style="width: 200px" id="state" onchange="getModule('employee/getCity?id=emp23&state='+this.value,'getCity','',document.title)">
	<option value="">Select State</option>			
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `state` WHERE `delete` = '0'",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
			</select>&nbsp;&nbsp;&nbsp;&nbsp;
			
</td>
<td>
City
</td>
<td>
<span id="getCity" style="display:inline">
<select class="input drop-down large" name="Select1" id="emp23">
				<option value="1">Select State First</option>
			</select>
</span>

</td>

</tr>
<tr>
	<td>Marital Status</td>
	<td style="width: 495px"><input class="" name="Radio1" type="radio" value="0"  onclick="document.getElementById('doa').style.display='none';document.getElementById('emp19').value=this.value"/><span style="padding-left:5px;padding-right:25px;">Single</span>
	<input class="" name="Radio1" type="radio" value="1"  onclick="document.getElementById('doa').style.display='table-row';document.getElementById('emp19').value=this.value"/><span style="padding-left:3px;padding-right:10px;">Married</span>
	<input class="input medium" name="Text1" type="hidden" id="emp19" />
	</td>
	<td>Gender </td>
	<td><select class="input drop-down large" name="Select1" name="" id="emp25">
				<option value="">Select Gender</option>
				<option value="0">Male</option>
				<option value="1">Female</option>			
			</select>
	</td>
	

</tr>
<tr id="doa" style="display:none">
	<td>Date Of Anniversary</td>
	<td colspan="3"><input  name="" class="input medium" type="" id="emp20" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalender('calenderid2','emp20')"/>
				<div class="calender" id="calenderid2"></div></td>
</tr>
<tr>
	<td>Bank </td>
	<td><select class="input drop-down large" name="Select1" name="" id="emp27">
				<option value="">Select Bank</option>
<?php
$getDesig = mysql_query("SELECT `id`,`name` FROM `bank` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowDesig = mysql_fetch_array($getDesig))
{
?>				
				<option value="<?php echo $rowDesig[0]?>"><?php echo $rowDesig[1]?></option>
<?php
}
?>	
			</select>
	</td>
	<td style="width:175px">Account No
	</td>
	<td style="width: 495px"><input class="input medium" name="" type="text" id="emp28"/>
	</td>
</tr>
<tr>
	<td style="width:175px">PF Account No
	</td>
	<td><input class="input medium" name="" id="emp29" type="text"  />
	</td>
</tr>
</table>
</div>
<br/>
<?php
$h = 33;
$getData = mysql_query("SELECT * FROM `document` WHERE `updatedby` = '$hrmloggedid' AND `delete` = '0' ",$con) or die(mysql_error());
$numRows = mysql_num_rows($getData);
if($numRows>0) {
?>

<div class="add-new blue-border">
<div class="form-head blue">
<div class="head-title"> 
<i class="add-form"></i> 
Documents</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">

<br/>
<html>
<body>
<table cellpadding="10" cellspacing="0" border="0" class="fetch">
<?php 
$i=1;
while($fetch = mysql_fetch_array($getData))
{
$type=$fetch[2];
?>

<td><strong><?php echo $fetch['name']?></strong></td>
<td><iframe src="employee/document/attachments/indexApp.php?path=emp<?php echo $h?>&type=<?php echo $fetch['type']?>" height="100px" width="500px" frameborder="0" scrolling="no"></iframe>
<input type="text" style="display:none;" id="emp<?php echo $h?>"/>
</td>

<?php

$h++;
if($i%2 == 0)
{
echo "</tr><tr>";
}
$i++;
}
?>
</table>
</body>
</html>

	


<tr><td colspan="4" style="text-align:center;"><div style="display:inline-block;" id="couResp"></div></td></tr>
</table>
</div>
<?php } ?>
<br/>
<div class="add-new blue-border">
<div class="form-head blue">
<div class="head-title"> 
<i class="add-form"></i> 
Summary</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td style="width:175px" valign="top">Job Description</td>
	<td><textarea class="input huge" id="emp21" name="TextArea"></textarea>
	</td>
	<td style="width:175px" valign="top">About Me
	</td>
	<td><textarea class="input huge" id="emp26" name="TextArea" cols="20"></textarea>
	</td>
</tr>
<tr>
	<td valign="top">Specialization
	</td>
	<td><textarea class="input huge" id="emp22" name="TextArea" cols="20" rows="2"></textarea>
	</td>
</tr>
<tr><td colspan="4" style="text-align:center;"><div style="display:inline-block;" id="couResp"></div></td></tr>
<tr>
<td colspan="4" style="text-align:center" class="auto-style1">
<button class="button green" onclick="SaveData('employee/save?type=<?php echo $type;?>&h=<?php echo $h;?>','emp','<?php echo $h?>','','','couResp','1')">
<div class="auto-style1">
	<i class="save-icon"></i>Save</div>
</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>
</table>
</div>

<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>

