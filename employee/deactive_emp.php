<?php
include("../include/conFig.php");
error_reporting(0);
$sql = "SELECT employee.id,employee.username,employee.name,employee.email,employee.phone,employee.jobdescription,employee.active FROM employee WHERE employee.delete = '0' AND employee.active = '0'";
$getData = mysql_query($sql,$con) or die(mysql_error());
$Num_Rows = mysql_num_rows($getData);
	$Per_Page = 25;   // Per Page
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
</td>
</tr>
</table>

<div style="height:400px;overflow-x:hidden;overflow-y:scroll" id="mainDivId">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
<tr><th><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>
	<th>Username</th>
	<th>Name</th>
	<th>Email</th>
	<th>Phone</th>
	<th>Job Description</th>
	<th>Status</th>
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

<td><?php echo $row[3]?></td>
<td><?php echo $row[4]?></td>
<td><?php echo $row[5]?></td>
<td>
<div id="emp<?php echo $row[0]?>" onclick="changeStatus('active','employee','<?php echo $row[0]?>','emp')" <?php if($row[6] == '1') {echo 'class = "active"';} else {echo 'class ="deactive"';}?>   ><?php if($row[6] == '1') {echo 'Active';} else {echo 'Deactive';}?></div>


</td>
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
