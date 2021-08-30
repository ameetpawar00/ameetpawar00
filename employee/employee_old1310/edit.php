<?php
include("../include/conFig.php");
$id = $_GET['id'];
$getData = mysql_query("SELECT * FROM `employee` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
<div class="title">My Employees</div>
<div class="strip">
<span>Dashboard</span>
<span>Employee</span>
<span>Edit Employee</span>

</div>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
<div style="display:inline-block;position:relative">
<div class="dropdown-menu" id="innerDiv" style="display:none">
<div class="dropdown-menu-inner">

<div class="dropdown-menu-inner-title" align="center">
<span style="color:white">Select Tools</span></div>
<div style="background:#fff;">
<ul>
<?php if(in_array('v_empd',$thisper)) 
{
?>
<li onclick="getModule('employee/dependent/dependent?eid=<?php echo $id?>','manipulatemoodleContent','viewmoodleContent','Dependent')"><i class="dependent"></i>Dependent</li>
<?php 
}
?>
<?php if(in_array('v_empe',$thisper)) 
{
?>
<li onclick="getModule('employee/education/education?eid=<?php echo $id?>','manipulatemoodleContent','viewmoodleContent','Education')"><i class="education"></i>Education</li>
<?php 
} 
?>
<?php if(in_array('v_empx',$thisper)) 
{
?>
<li onclick="getModule('employee/workexperience/experience?eid=<?php echo $id?>','manipulatemoodleContent','viewmoodleContent','Experience')"><i class="experience"></i>Experience</li>
<?php 
} 
?>
<?php if(in_array('v_emps',$thisper)) 
{
?>
<li onclick="getModule('salary/add?eid=<?php echo $id?>&name=<?php echo $row['name']?>&salpid=<?php echo $row['salaryId']?>','viewContent','manipulateContent','Salary')"><i class="salary"></i>Salary</li>
<?php 
} 
?>
<li onclick="getModule('employee/document/document?eid=<?php echo $id?>','manipulatemoodleContent','viewmoodleContent','Dependent')"><i class="dependent"></i>Documents</li>
<li onclick="getModule('employee/story/view?eid=<?php echo $id?>&name=<?php echo $row['name']?>','manipulatemoodleContent','viewmoodleContent','Story Line')"><i class="dependent"></i>Story</li>

<?php if(in_array('v_empt',$thisper)) 
{
?>
<li style="padding:10px 0 10px 13px;display:none"><i class="task-icon-black"></i>Add Task

<div style="float:right;padding-right:10px;">
<span class="roundspan red">2</span>
</div>
</li><?php 
} 
?>

</ul>
</div>
</div>
</div>
	<button class="button red" data-toggle="dropdown" onclick="$('#innerDiv').slideToggle('fast')">Tools&nbsp;&nbsp; <i class="down-arrow"></i>
											</button>
</div>

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


	<td width="175px">Username <span>*</span>
	</td>
	<td><input class="input medium"  name="req" type="text" id="emp0" value="<?php echo $row['username']?>"/>
	</td>
	<td width="175px">Password <span>*</span>
	</td>
	<td><input class="input medium"  name="req" type="text" id="emp1" value="<?php echo $row['password']?>"/>
	</td>	

	
</tr>
<tr>
	<td>Empid <span>*</span>
	</td>
	<td><input class="input medium"  name="req" type="text" id="emp2" value="<?php echo $row['empid']?>"/>
	</td>
	<td>Name <span>*</span>
	</td>
	<td><input class="input medium"  name="req" type="text" id="emp3" value="<?php echo $row['name']?>"/>
	</td>
</tr>
<tr>
	<td>Email <span>*</span>
	</td>
	<td><input class="input medium"  name="req" type="text" id="emp4" value="<?php echo $row['email']?>"/>
	</td>
	<td>Phone  <span>*</span>
	</td>
	<td><input class="input medium"  name="req" type="text" id="emp5" value="<?php echo $row['phone']?>"/>
	</td>
</tr>
<tr>
	<td>Status <span>*</span></td>
	<td><input class="input checkbox"  name="req" id="emp24" type="checkbox" value="1" <?php if($row['active'] == '1') {echo 'checked=checked';}?>/>&nbsp;&nbsp;&nbsp;Active</td>
		<td>Attendance Id<span>*</span>
	</td>
	<td><input class="input medium" name="" type="text" id="emp32" value="<?php echo $row['attenid' ]?>"/>
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
	<select class="input drop-down large" name="req" id="emp6">
				<option value="">Select Designation</option>
<?php
$getDesig = mysql_query("SELECT `id`,`name` FROM `designation` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowDesig = mysql_fetch_array($getDesig))
{
?>				
				<option <?php if($rowDesig[0] == $row['designation']) echo "selected='selected'"; ?> value="<?php echo $rowDesig[0]?>"><?php echo $rowDesig[1]?></option>
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
				<option <?php if($rowDept[0] == $row['department']) echo "selected='selected'"; ?> value="<?php echo $rowDept[0]?>"><?php echo $rowDept[1]?></option>
<?php
}
?>				
			</select>

	</td>
</tr>
<tr>
	<td>Work Phone 
	</td>
	<td><input class="input medium"  name="req" type="text" id="emp8" value="<?php echo $row['workphone']?>"/>
	</td>
	<td>Work Email 	</td>
	<td><input class="input medium"  name="" type="text" id="emp9" value="<?php echo $row['workemail']?>"/>
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
				<option <?php if($rowLoc[0] == $row['location']) echo "selected='selected'"; ?> value="<?php echo $rowLoc[0]?>"><?php echo $rowLoc[1]?></option>
<?php
}
?>				
			</select>

	</td>	<td>Salary Profile<span>*</span>
	</td>
	<td><select class="input drop-down large" name="req" id="emp11">
				<option value="">Select Designation</option>
<?php
$getDesig = mysql_query("SELECT `id`,`salprofile` FROM `salary` WHERE `delete`= '0' ",$con) or die(mysql_error());
while($rowDesig = mysql_fetch_array($getDesig))
{
?>				
				<option <?php if($rowDesig[0] == $row['salaryId']) echo "selected='selected'"; ?> value="<?php echo $rowDesig[0]?>"><?php echo $rowDesig[1]?></option>
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
				<option <?php if($rowLoc[0] == $row['hiresource']) echo "selected='selected'"; ?> value="<?php echo $rowLoc[0]?>"><?php echo $rowLoc[1]?></option>
<?php
}
?>				
			</select>

	</td>	<td>Date Of joining 
	</td>
	<td><input class="input medium"  name="" value="<?php echo $row['doj']?>" id="emp13" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalender('calenderid0','emp13')"/>
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
				<option <?php if($rowLoc[0] == $row['empstatus']) echo "selected='selected'"; ?> value="<?php echo $rowLoc[0]?>"><?php echo $rowLoc[1]?></option>
<?php
}
?>				
			</select>

	</td>	<td>Branch
	</td>
	<td><select class="input drop-down large" name="req" id="emp15">
				<option value="">Select Branch</option>
<?php
$getDesig = mysql_query("SELECT `id`,`name` FROM `branch` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowDesig = mysql_fetch_array($getDesig))
{
?>				
				<option <?php if($rowDesig[0] == $row['branch']) echo "selected='selected'"; ?> value="<?php echo $rowDesig[0]?>"><?php echo $rowDesig[1]?></option>
<?php
}
?>				
			</select>

	</td>
</tr>
<tr>	
	<td>Referred By
	</td>
	<td><select class="input drop-down large" name="" id="emp30">
				<option value="">Select Employee</option>
<?php
$getLoc = mysql_query("SELECT `id`,`name` FROM `employee` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowLoc = mysql_fetch_array($getLoc))
{
?>				
				<option <?php if($rowLoc[0] == $row['referredby']) echo "selected='selected'"; ?> value="<?php echo $rowLoc[0]?>"><?php echo $rowLoc[1]?></option>
<?php
}
?>	
				<option <?php if("COLLEAGUE" == $row['referredby']) echo "selected='selected'"; ?> value="COLLEAGUE">COLLEAGUE</option>
				<option <?php if("FRIENDS" == $row['referredby']) echo "selected='selected'"; ?> value="FRIENDS">FRIENDS</option>
				<option <?php if("OTHERS" == $row['referredby']) echo "selected='selected'"; ?> value="OTHERS">OTHERS</option>		
			
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
				<option <?php if($rowRole[0] == $row['role']) echo "selected='selected'"; ?> value="<?php echo $rowRole[0]?>"><?php echo $rowRole[1]?></option>
<?php
}
?>				
			</select>

	</td>
</tr>	
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
	<td >Mobile <span>*</span>
	</td>
	<td><input class="input medium"  name="req" type="text" id="emp16" value="<?php echo $row['mobile']?>"/>
	</td>
	<td >Date Of Birth
	</td>
	<td><input class="input medium"  name="" id="emp17" value="<?php echo $row['dob']?>" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalender('calenderid1','emp17')"/>
				<div class="calender" id="calenderid1"></div>
	</td>
</tr>
<tr>
	<td valign="top">Address</td>
	<td colspan="3">
	<textarea class="input huge" id="emp18" name="TextArea" style="width: 543px; height: 75px"><?php echo $row['address']?></textarea></td>
	
</tr>
<tr>
<td>State</td>
	<td>
<?php
	$cityId = $row['city'];
	$getState = mysql_query("SELECT * FROM `city` WHERE `id` =  '$cityId'",$con) or die(mysql_error());
	$rowState = mysql_fetch_array($getState);
	$state = $rowState['state'];
?>
<select class="input drop-down large" name="Select1"  id="state" onchange="getModule('employee/getCity?id=emp23&state='+this.value,'getCity','',document.title)">
	<option value="">Select State</option>			
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `state` WHERE `delete` = '0'",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option <?php if($rowCity[1] == $state) echo "selected='selected';" ?> value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
</select>			
</td>
<td>
City
</td>
<td>
<span id="getCity" style="display:inline">
<select class="input drop-down large" name="Select1" id="emp23">
				
<?php

$getCity = mysql_query("SELECT `name`,`id` FROM `city` WHERE `delete` = '0' and `state` = '$state'",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option <?php if($rowCity[1] == $row['city']) echo "selected='selected'"; ?> value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>

<?php
}
?>
</select>
</span>

</td>

</tr>
<tr>
	<td>Marital Status</td>
	<td><input class=""  <?php if($row['marital'] == '0'){ echo 'checked=checked';}?>  name="Radio1" type="radio" value="0"  onclick="document.getElementById('doa').style.display='none';document.getElementById('emp19').value=this.value"/><span style="padding-left:5px;padding-right:25px;">Single</span>
	<input class=""  <?php if($row['marital'] == '1'){ echo 'checked=checked';}?> name="Radio1" type="radio" value="1"  onclick="document.getElementById('doa').style.display='table-row';document.getElementById('emp19').value=this.value"/><span style="padding-left:3px;padding-right:10px;">Married</span>
	<input class="input medium"  name="Text1" type="hidden" id="emp19" />
	</td>
	<td>Gender <span>*</span></td>
	<td><select class="input drop-down large" name="Select1" name="req" id="emp25">
				<option value="">Select Gender</option>
				<option <?php if($row['gender'] == '0'){ echo 'selected=selected';}?> value="0">Male</option>
				<option <?php if($row['gender'] == '1'){ echo 'selected=selected';}?> value="1">Female</option>			
			</select>
	</td>
	

</tr>
<tr id="doa" style="display:none">
	<td>Date Of Anniversary</td>
	<td colspan="3"><input class="input medium"  name="" value="<?php echo $row['doa']?>" type="" id="emp20" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalender('calenderid2','emp20')"/>
				<div class="calender" id="calenderid2"></div></td>
</tr>
<tr>
	<td>Bank</td>
	<td><select class="input drop-down large" name="Select1" name="req" id="emp27">
				<option value="">Select Bank</option>
<?php
$getBank = mysql_query("SELECT `id`,`name` FROM `bank` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowBank = mysql_fetch_array($getBank))
{
?>				
				<option <?php if($rowBank[0] == $row['bank']) echo "selected='selected'"; ?> value="<?php echo $rowBank[0]?>"><?php echo $rowBank[1]?></option>
<?php
}
?>	
			</select>
	</td>
	<td >Account No
	</td>
	<td style="width: 495px"><input class="input medium"  name="" type="text" id="emp28" value="<?php echo $row['accountno']?>"/>
	</td>
</tr>
<tr>
	<td >PF Account No
	</td>
	<td><input class="input medium"  name="" id="emp29" type="text" value="<?php echo $row['pfaccount']?>"  />
	</td>
</tr>
</table>
</div>
<br/>

<div class="add-new blue-border">
<div class="form-head blue">
<div class="head-title"> 
<i class="add-form"></i> 
Summary</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td valign="top">Job Description</td>
	<td><textarea class="input huge" id="emp21" name="TextArea" style=" height: 75px"><?php echo $row['jobdescription']?></textarea>
	</td>
	<td valign="top">About Me
	</td>
	<td><textarea class="input huge" id="emp26" name="TextArea" cols="20" style="height: 75px"><?php echo $row['about']?></textarea>
	</td>
</tr>
<tr>
	<td valign="top">Specialization
	</td>
	<td><textarea class="input huge" id="emp22" name="TextArea" cols="20" rows="2" style="height: 75px"><?php echo $row['specialization']?></textarea>
	</td>
</tr>
<tr>
<td colspan="4" style="text-align:center">
<?php if(in_array('u_emp',$thisper)) 
			{
			?>
<button class="button green" onclick="SaveData('employee/update?id=<?php echo $row[0]?>&i=<?php echo $i?>','emp','33','','','couResp','2')"><i class="save-icon"></i>Update</button>
<?php 
}
?>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>
</table>
</div>
<br/><br/><br/><br/><br/><br/>
</div>


