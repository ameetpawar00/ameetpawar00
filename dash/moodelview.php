<?php
include("../include/conFig.php");
error_reporting(0);

$Todaydate = date('Y-m-d');
$employee = mysql_query("SELECT * FROM `employee` WHERE `delete` = '0' AND `active` = '1'",$con);
$num1=mysql_num_rows($employee);
//$attendance = mysql_query("SELECT * FROM `attendance`, `employee` WHERE `attendance`.`delete` = '0' AND `attendance`.`date`='$Todaydate' AND `attendance`.`attendance` = '1' AND `employee`.`id` = `attendance`.`employee` ",$con);

	$folder= 'dash/moodelview';
	$title = 'Employees Attendance';

?>
<div id="myTitle">
<div class="title">Employees Attendance Of &nbsp;<span style="color:green"><?php echo date('d-M-y');?></span></div>
<div class="strip">
<span>Dashboard</span>
<span>Upcoming Events</span>
<span>View</span>
</div>
</div>



<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
</td>
</tr>
</table>

<div style="height:400px;overflow-x:hidden;overflow-y:scroll" id="mainDivId">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">

	<th>Name</th>
	
	<th>Attendance</th>
<?php
$iddd = array();
$att = array();
$i = 1;
//$sql .=" order by employee.name  ASC LIMIT $Page_Start , $Per_Page";
//$values = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($employee))
{
$fetch = 0;
$id = $row['id'];
$iddd[] = $id;
?>
<tr  class="d<?php echo $i%2;?>" id="fetchrow<?php echo $i?>">
<td><?php echo $row[2] ?> </td>
	<?php
	//echo "SELECT * FROM `attendance` WHERE `delete` = '0' AND `date`='$Todaydate' AND `employee` = '$id'";
$attendance = mysql_query("SELECT * FROM `attendance` WHERE `delete` = '0' AND `date`='$Todaydate' AND `employee` = '$id'",$con);
$fetch = mysql_num_rows($attendance);
while($rowid=mysql_fetch_array($attendance))
{
	$rowid['employee'].'<br/>';
}
if($fetch > 0) 
{ ?>

<td><span style="color:green"><?php echo 'Present'; ?></span></td>
<?php
 }
else
{ 
?>
<td><span style="color:red"><?php echo 'Absent'; ?></span></td>
<?php

 }
?>



</tr>
<?php
$i++;
$Maxid = $row['id'];
$MaxI = $i;
} 
?>
</table>
</div>
