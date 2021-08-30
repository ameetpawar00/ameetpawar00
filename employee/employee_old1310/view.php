<?php include("../include/conFig.php");
$sql = "SELECT employee.id,employee.empid,employee.name,employee.workemail,employee.mobile,designation.name,employee.doj FROM employee,designation WHERE employee.delete = '0' AND employee.active = '1' AND employee.designation= designation.id";
//$sql = "select * from `employee`";
$getData = mysql_query($sql,$con) or die(mysql_error());
$Num_Rows = mysql_num_rows($getData);
	$Per_Page = 50;   // Per Page
	include('../pagination/pagination.php');
	$folder= 'employee/view';
	$title = 'Employee';

?>
<div id="myTitle">
<div class="title">My Employees</div>
<div class="strip">
<span>Dashboard</span>
<span>Employee</span>
<span>View</span>
</div>
</div>

<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
<?php if(in_array('a_emp',$thisper)) 
{
?>
<button class="button blue" onclick="getModule('employee/index','manipulateContent','viewContent','Employee')"> <i class="plus"></i>New</button>&nbsp;
<?php 
} 
?>
<?php if(in_array('d_emp',$thisper)) 
{
?>
<button class="button red" onclick="deleteData('employee','Employee')"> <i class="delete-icon"></i>Delete</button>&nbsp;
<?php 
} 
?>
<?php if(in_array('d_emp',$thisper)) 
{
?>
<button class="button green"  onclick="$('#custViewBox').slideToggle('slow')"> Custom View <i class="customview"></i></button>&nbsp;
<?php 
} 
?>

</td>
</tr>
</table>

<div style="padding: 5px; background:#EEEEEE;display:none" id="custViewBox">
<div style="margin:2px;background:white;border-radius:2px">
<table width="100%" cellpadding="5" cellspacing="0">
	<tbody><tr>
	<td style="height:10px;" colspan="3">
		<div style="float:right">
	<img src="icons/close-red-sq.png" width="15px" alt="" style="cursor:pointer" onclick="$('#custViewBox').slideToggle('slow')">
	</div>

 
			<div style="float:right;margin-right:20px">
			<div class="buttonnegetive" style="display:inline-block" onclick="getModule('deleteView?id='+document.getElementById('savedView').value,'viewDeleted','','Leads');$('#custViewBox').slideToggle('fast')"></div>
			<div id="viewDeleted"></div>
			</div>
			
	</td>
	</tr>
	<tr>
	<td><span style="font-family:Arial, Helvetica, sans-serif;font-size:medium;margin-left:50px">Create New View</span>
	</td>
	</tr>
<tr>
	<td>
	<select class="input drop-down large" name="empstatus1" style="margin-left:50px" id="empview1">		
		<option value="0">Select Status</option>
		<option value="1">Active</option>
		<option value="2">Deactive</option>
	</select>
	</td>
 
	<td>
	<select class="input drop-down large" name="empdeg" id="empview2">
		<option value="0">Select Designation</option>
		<?php 
		$designation = mysql_query("SELECT * FROM `designation` WHERE `delete`='0'");
		while($desRow = mysql_fetch_array($designation))
		{
		?>
			<option value="<?php echo $desRow['id']?>"><?php echo $desRow['name']?></option>
		<?php
		}
		?>	
	</select>
	</td>
	<td>
	<select name="empdep" class="input drop-down large" id="empview3">
		<option value="0">Select Department</option>
		<?php 
		$department = mysql_query("SELECT * FROM `department` WHERE `delete`='0'");
		while($depRow = mysql_fetch_array($department))
		{
		?>
			<option value="<?php echo $depRow['id']?>"><?php echo $depRow['name']?></option>
		<?php
		}
		?>	

	</select>
 
	</td>
</tr>
 <tr>
	<td>
	<select name="empsal" class="input drop-down large" style="margin-left:50px" id="empview4">
		<option value="0">Select Salary</option>
		<?php 
		$salary = mysql_query("SELECT * FROM `salary` WHERE `delete`='0'");
		while($salRow = mysql_fetch_array($salary))
		{
		?>
			<option value="<?php echo $salRow['id']?>"><?php echo $salRow['salprofile']?></option>
		<?php
		}
		?>	

	</select>
	</td>
 
	<td>
	<select name="emprole" class="input drop-down large" id="empview5">
		<option value="0">Select Role</option>
		<?php 
		$roll = mysql_query("SELECT * FROM `rolls` WHERE `delete`='0'");
		while($rolRow = mysql_fetch_array($roll))
		{
		?>
			<option value="<?php echo $rolRow['id']?>"><?php echo $rolRow['name']?></option>
		<?php
		}
		?>	

	</select>
	</td>
 
	<td> 
	<select name="empstatus2" class="input drop-down large" id="empview6">
		<option value="0">Select Employee Status</option>
		<?php 
		$empStatus = mysql_query("SELECT * FROM `employeestatus` WHERE `delete`='0' AND `id` != '1'");
		while($stsRow = mysql_fetch_array($empStatus))
		{
		?>
			<option value="<?php echo $stsRow['id']?>"><?php echo $stsRow['name']?></option>
		<?php
		}
		?>	

	</select>
 
	</td>
</tr>
<tr>
	<td colspan="3">
	<input name="Button1" style="margin-left:50px" class="button blue" type="button" value="Create View For Now" onclick="getModule('employee/customview?empstatus1='+document.getElementById('empview1').value+'&empdeg='+document.getElementById('empview2').value+'&empdep='+document.getElementById('empview3').value+'&empsal='+document.getElementById('empview4').value+'&emprole='+document.getElementById('empview5').value+'&empstatus2='+document.getElementById('empview6').value,'directResult','','Employee');$('#custViewBox').slideToggle('fast')"></td>
</tr>

</tbody></table>
</div>
</div>

<br>

<div id="directResult" style="height:600px;overflow:scroll">

<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
<tr><th style="height: 30px"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>
	<th style="height: 30px">Empid</th>
	<th style="height: 30px">Name</th>
	<th style="height: 30px">Designation</th>
	<th style="height: 30px">Date of Joining (DOJ)</th>
	<th style="height: 30px">Mobile</th>
</tr>
<?php
$i = 1;
$sql .=" order by employee.name ASC LIMIT $Page_Start , $Per_Page";
$values = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($values))

{
?>
<tr  class="d<?php echo $i%2;?>" id="fetchrow<?php echo $i?>">
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" /></td>
<td><?php echo $row[1]?></td>
<?php if(in_array('u_emp',$thisper)) 
{
?>
<td class="link-blue" onclick="getModule('employee/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Employee')"><?php echo $row[2]?></td>
<?php 
} 
else
{
?>
<td ><?php echo $row[2]?></td>
<?php
}
?>

<td><?php echo $row[5]?></td>
<td><?php echo $row[6]?></td>
<td><?php echo $row[4]?></td>

</tr>
<?php
$i++;
$Maxid = $row['id'];
$MaxI = $i;
}
?>
<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
</table>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>
 
<?php
include('../pagination/pages.php');
?>
