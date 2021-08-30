<?php
include("../include/conFig.php");
$id = $_GET['id'];
$i = $_GET['i'];
$getData = mysql_query("SELECT * FROM `travel` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
$getCustData = mysql_query("SELECT travel.id,employee.name,department.name,travel.place,travel.purpose,travel.departuredate,travel.arrivaldate,travel.days,travel.customer,travel.billable FROM employee,travel,department WHERE travel.id = '$id' AND employee.id = travel.eid AND department.id = travel.deptid AND travel.delete = '0' ORDER BY travel.id DESC LIMIT 100",$con) or die(mysql_error());
$custRow = mysql_fetch_array($getCustData);
?>
<div class="title">Travel Details</div>
<div class="strip">
<span>Dashboard</span>
<span>Travel</span>
<span>Travel Details</span>
</div>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"> <i class="back"></i>Back</button>&nbsp;&nbsp;
</td>
</tr>
</table>

<!--<div class="widget-content">
	<div class="widget-box">

<div class="nonboxy-widget">
<div class="widget-head">
		<h5 align="left">Travel Details</h5>
	</div>
</div>
<table width="100%" cellpadding="10" cellspacing="5" height="450px" class="form-horizontal well formtable">-->


<div style="overflow-x:hidden;overflow-y:scroll;height:500px">
<div class="add-new blue-border">
<div class="form-head green">
<div class="head-title"> 
<i class="add-form"></i> 
Edit Travel Details</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>
<!--

<ul class="breadcrumb">
	<li><a href="#">Home</a><span class="divider">&raquo;</span></li>
	<li class="active"  onclick="getModule('travel/view','viewContent','manipulateContent','Travel')">Travel</li>
	<div class="red awesome small" onclick="getModule('travel/view','viewContent','manipulateContent','Travel')" style="float:right">Back To View</div>

</ul>
<div class="nonboxy-widget">
	<div class="widget-head">
		<h5>Edit Travel Details</h5>
	</div>
</div>
	<table width="100%" cellpadding="10" cellspacing="0" class="form-horizontal well formtable">
<tr><td colspan="4" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>
-->
<tr>
<th>Owner <span>*</span></th>
<td><select class="input drop-down large" name="req" id="trav0">
				<option value="">Select Employee</option>
<?php
$getEmp = mysql_query("SELECT `id`,`name` FROM `employee` WHERE `delete`= '0'",$con) or die(mysql_error());
while($rowEmp = mysql_fetch_array($getEmp))
{
?>				
				<option <?php if($row['eid'] == $rowEmp[0]){echo 'selected=selected';}?> value="<?php echo $rowEmp[0]?>"><?php echo $rowEmp[1]?></option>
<?php
}
?>				
			</select>
</td>
<th>Department <span>*</span></th>
<td><select class="input drop-down large" name="req" id="trav1" onchange="changeDrp('trav1','emp','employee','department')">
				<option value="">Select Department</option>
<?php
$getDept = mysql_query("SELECT `id`,`name` FROM `department` WHERE `delete`= '0'",$con) or die(mysql_error());
while($rowDept = mysql_fetch_array($getDept))
{
?>				
				<option <?php if($row['deptid'] == $rowDept[0]){echo 'selected=selected';}?> value="<?php echo $rowDept[0]?>"><?php echo $rowDept[1]?></option>
<?php
}
?>				
			</select>
</td>
</tr>
<tr>
<th>Employees</th>
<td id="teamUsers">
<select class="input drop-down large" name="Select1" class="input" id="emp" onchange="addToteam(this.value,'trav9','empl','addemp','reemp')">
	<option value="1">Select Department First </option>			
			</select>
			<span id="reemp"></span>
			<div style="padding:5px;" id="empl">
			
		<?php
		$lst = $row['users'];
		$lst = explode(",",$lst);
		foreach($lst as $val)
		{
		$valPut .= $val.",";
		$val = str_ireplace("-","",$val);
		$val = trim($val);
		if($val != '')
		{
$getEmp = mysql_query("SELECT `name` FROM `employee` WHERE `id` = '$val'",$con) or die(mysql_error());
$rowEmp = mysql_fetch_array($getEmp);
$lstArray[$val] = $rowEmp[0];
	
?>
<div class="teamMate" id="reemp<?php echo $val;?>"><?php echo $lstArray[$val];?>&nbsp;&nbsp;&nbsp;<span style="cursor:pointer" onclick="removeTeam('<?php echo $val;?>','trav9','reemp','empl')">x</span></div>
<?php
}
}		
?>				

		</div>
			<input class="input medium" name="req" type="text" value="<?php echo $valPut;?>" id="trav9" name="req" title="isNotNull" style="display:none" />


</td>
</tr>

<tr>
<th>Place Of Visit <span>*</span></th>
<td><input class="input medium" name="req" type="text" id="trav2" value="<?php echo $row['place']?>"/></td>
<th>Purpose Of Visit</th>
<td><input class="input medium" name="" type="text" id="trav3" value="<?php echo $row['purpose']?>"/></td>

</tr>
<tr>
<th>Departure Date
</th>
<td><input class="input medium" name="req" value="<?php echo $row['departuredate']?>" id="trav4" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalendar(this);"/>
</td>
<th>Arrival Date
</th>
<td><input class="input medium" name="req" value="<?php echo $row['arrivaldate']?>" id="trav5" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalendar(this);"/>
</td>
</tr>
<tr>
<th style="height: 42px">Number of days</th>
<td style="height: 42px"><input class="input medium" value="<?php echo $row['days']?>" name="Text1" type="text" id="trav6"/></td>
<th style="height: 42px">Customer's Name</th>
<td style="height: 42px"><input class="input medium" value="<?php echo $row['customer']?>" name="Text1" type="text" id="trav7"/></td>
</tr>

<tr>
<th>Is Billable to Customer?
</th>
<td>
<select class="input drop-down large" name="Select1" id="trav8">
				<option value="0">-Select-</option>
				<option <?php if($row['billable'] == '1'){echo 'selected=selected';}?> value="1">Yes</option>
				<option <?php if($row['billable'] == '2'){echo 'selected=selected';}?> value="2">No</option>
</select>
</td>
</tr>
<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('travel/update?id=<?php echo $row[0]?>&i=<?php echo $i?>','trav','10','<?php echo $i;?>','','couResp','2');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i>Update</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>
</table>
	</div>
</div>


