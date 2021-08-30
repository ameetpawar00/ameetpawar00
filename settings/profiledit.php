<?php
include("../include/conFig.php");

$getData = mysql_query("SELECT * FROM `employee` WHERE `id` = '$hrmloggedid'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
<div class="title">My Profile</div>
<div class="strip">
<span>Dashboard</span>
<span>Edit Profile</span>

</div>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
<div style="display:inline-block;position:relative">
<div class="dropdown-menu" id="innerDiv" style="display:none">
<div class="dropdown-menu-inner">

<div class="dropdown-menu-inner-title">
Select Tools</div>
<div style="background:#fff;">
<ul>
<?php if(in_array('v_empd',$thisper)) 
{
?>
<li onclick="getModule('employee/dependent/dependent?eid=<?php echo $id?>','manipulatemoodleContent','viewmoodleContent','Dependent')"><i class="plus"></i>Dependent</li>
<?php 
}
?>
<?php if(in_array('v_empe',$thisper)) 
{
?>
<li onclick="getModule('employee/education/education?eid=<?php echo $id?>','manipulatemoodleContent','viewmoodleContent','Education')"><i class="plus"></i>Education</li>
<?php 
} 
?>
<?php if(in_array('v_empx',$thisper)) 
{
?>
<li onclick="getModule('employee/workexperience/experience?eid=<?php echo $id?>','manipulatemoodleContent','viewmoodleContent','Experience')"><i class="plus"></i>Experience</li>
<?php 
} 
?>
<?php if(in_array('v_emps',$thisper)) 
{
?>
<li onclick="getModule('salary/add?eid=<?php echo $id?>&name=<?php echo $row['name']?>','manipulatemoodleContent','viewmoodleContent','Salary')"><i class="plus"></i>Salary</li>
<?php 
} 
?>
<?php if(in_array('v_empt',$thisper)) 
{
?>
<li style="padding:10px 0 10px 13px"><i class="task-icon-black"></i>Add Task

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
<!--
<div class="nonboxy-widget">
	<div class="widget-head">
		<h5>Edit Employee
		<span style="float:right">
		<div class="yellow awesome small" style="float:right;margin-right:10px" onclick="getModule('employee/dependent/dependent?eid=<?php echo $id?>','manipulatemoodleContent','viewmoodleContent','Dependent')">+ Dependent</div>
	<div class="blue awesome small" style="float:right;margin-right:10px" onclick="getModule('employee/education/education?eid=<?php echo $id?>','manipulatemoodleContent','viewmoodleContent','Education')">+ Education&nbsp;&nbsp;</div>
	<div class="red awesome small" style="float:right;margin-right:10px" onclick="getModule('employee/workexperience/experience?eid=<?php echo $id?>','manipulatemoodleContent','viewmoodleContent','Experience')">+ Experience&nbsp;&nbsp;</div>
		<div class="red awesome small" style="float:right;margin-right:10px" onclick="getModule('salary/add?eid=<?php echo $id?>&name=<?php echo $row['name']?>','manipulatemoodleContent','viewmoodleContent','Salary')">+ Salary&nbsp;&nbsp;</div>
	
		</span>
		</h5>	
	
	</div>
</div>
-->

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
	<td>Name <span>*</span>
	</td>
	<td><input class="input medium"  name="req" type="text" id="emp1" value="<?php echo $row['name']?>"/>
	</td>

	
</tr>
<tr>
	<td>Email <span>*</span>
	</td>
	<td><input class="input medium"  name="req" type="text" id="emp2" value="<?php echo $row['email']?>"/>
	</td>
	<td>Phone  <span>*</span>
	</td>
	<td><input class="input medium"  name="req" type="text" id="emp3" value="<?php echo $row['phone']?>"/>
	</td>
</tr>
</table>
</div>
<br/>

<br/>

<div class="add-new blue-border">
<div class="form-head blue">
<div class="head-title"> 
<i class="add-form"></i> 
Personal</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td >Mobile
	</td>
	<td><input class="input medium"  name="" type="text" id="emp4" value="<?php echo $row['mobile']?>"/>
	</td>
	<td >Date Of Birth
	</td>
	<td><input class="input medium"  name="" id="emp5" value="<?php echo $row['dob']?>" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalendar(this);"/>
	</td>
</tr>
<tr>
	<td valign="top">Address</td>
	<td colspan="3">
	<textarea class="input huge" id="emp6" name="TextArea" style="width: 543px; height: 75px"><?php echo $row['address']?></textarea></td>
	
</tr>
<tr>
<td style="height: 26px">State</td>
	<td style="height: 26px">
<?php
	$cityId = $row['city'];
	$getState = mysql_query("SELECT * FROM `city` WHERE `id` =  '$cityId'",$con) or die(mysql_error());
	$rowState = mysql_fetch_array($getState);
	$state = $rowState['state'];
?>
<select class="input drop-down large" name="Select1"  id="emp7" onchange="getModule('employee/getCity?id=emp23&state='+this.value,'getCity','',document.title)">
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
<td style="height: 26px">
City
</td>
<td style="height: 26px">
<span id="getCity" style="display:inline">
<select class="input drop-down large" name="Select1" id="emp8">
				
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
	<td><input class=""  <?php if($row['marital'] == '0'){ echo 'checked=checked';}?>  name="Radio1" type="radio" value="0"  onclick="document.getElementById('doa').style.display='none';document.getElementById('emp9').value=this.value"><span style="padding-left:5px;padding-right:25px;">Single</span>
	<input class=""  <?php if($row['marital'] == '1'){ echo 'checked=checked';}?> name="Radio1" type="radio" value="1"  onclick="document.getElementById('doa').style.display='table-row';document.getElementById('emp9').value=this.value"><span style="padding-left:3px;padding-right:10px;">Married</span>
	<input class="input medium"  name="Text1" type="hidden" id="emp9" >
	</td>
	<td>Gender <span>*</span></td>
	<td><select class="input drop-down large" name="Select1" name="req" id="emp10">
				<option value="">Select Gender</option>
				<option <?php if($row['gender'] == '0'){ echo 'selected=selected';}?> value="0">Male</option>
				<option <?php if($row['gender'] == '1'){ echo 'selected=selected';}?> value="1">Female</option>			
			</select>
	</td>
	

</tr>
<tr id="doa" style="display:none">
	<td>Date Of Anniversary</td>
	<td colspan="3"><input class="input medium"  name="" value="<?php echo $row['doa']?>" type="" id="emp11" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalendar(this);"/></td>
</tr>
<tr>
	<td>Bank <span>*</span></td>
	<td><select class="input drop-down large" name="Select1" name="req" id="emp12">
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
	<td style="width: 495px"><input class="input medium"  name="" type="text" id="emp13" value="<?php echo $row['accountno']?>">
	</td>
</tr>
<tr>
	<td >PF Account No
	</td>
	<td><input class="input medium"  name="" id="emp14" type="text" value="<?php echo $row['pfaccount']?>">
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
	<td><textarea class="input huge" id="emp15" name="TextArea" style=" height: 75px"><?php echo $row['jobdescription']?></textarea>
	</td>
	<td valign="top">About Me
	</td>
	<td><textarea class="input huge" id="emp16" name="TextArea" cols="20" style="height: 75px"><?php echo $row['about']?></textarea>
	</td>
</tr>
<tr>
	<td valign="top">Specialization
	</td>
	<td><textarea class="input huge" id="emp17" name="TextArea" cols="20" rows="2" style="height: 75px"><?php echo $row['specialization']?></textarea>
	</td>
</tr>
<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('settings/update?id=<?php echo $row[0]?>','emp','18','','','couResp','2');ToggleBox('manipulateContent','block','');ToggleBox('viewContent','none','');"><i class="save-icon"></i>Update</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','block','');ToggleBox('viewContent','none','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>
</table>
</div>
<br/><br/><br/><br/><br/><br/>
</div>


