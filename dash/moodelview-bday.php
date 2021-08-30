
<!--<h1>This section is currently under construction</h1>-->

<?php
include("../include/conFig.php");
error_reporting(0);
$TodayM = date('m');
$Todayd = date('d');

if(isset($_GET['nmnthbd']))
{
	
//	$sql="SELECT * FROM employee WHERE MONTH(dob) = MONTH(now()) AND `active` = '1' AND `empstatus` = '2' AND `delete` = '0'";
	$sql="SELECT * FROM employee WHERE MONTH(dob) = MONTH(now() + interval 1 month) AND `active` = '1' AND `empstatus` = '2' AND `delete` = '0'";
	$ntitl="Next Month";
}elseif(isset($_GET['nmntddssss2']))
{

//	$sql="SELECT * FROM employee WHERE MONTH(dob) = MONTH(now()) AND `active` = '1' AND `empstatus` = '2' AND `delete` = '0'";
	$sql="SELECT * FROM employee WHERE MONTH(dob) = MONTH(now()) AND `active` = '1' AND `empstatus` = '2' AND `delete` = '0'";
	$ntitl="Current Month";
}else{
	
$sql="SELECT * FROM employee WHERE MONTH(dob) = MONTH(NOW()) AND DAY(dob) = DAY(NOW()) AND `active` = '1' AND `empstatus` = '2' AND `delete` = '0'";
$ntitl="Todays";
}
$getData = mysql_query($sql,$con) or die(mysql_error());
$count= mysql_num_rows($getData);
	$folder= 'dash/moodelview-bday';
	$title = $ntitl.' BirthDay';
?>
<div id="myTitle">
<div class="title"><?=$ntitl?> BirthDay</div>
<div class="strip">
<span>Dashboard</span>
<span><?=$ntitl?> BirthDay</span>
<span>View</span>
</div>
</div>

<?php 
if($count>0){

?>

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
	<th>Date</th>
<?php

$sql .=" order by employee.name  ASC";
$getData = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($getData))
{

?>
<tr  class="d<?php echo $i%2;?>" id="fetchrow<?php echo $i?>">

<td title="Happy BirthDay"><strong><span style="color:green"><?php echo $row[1]?></span></strong></td>
<td><strong><span style="color:green">
	<?php
	
		if(isset($_GET['nmnthbd']) OR isset($_GET['nmntddssss2']))
			{ 
				echo $row['dob'];
			}else{ 
					echo date('d-M-y');
				}
	?>
						
					</span></strong></td>
</tr>

<?php
}
 }

else {
echo '<div align=center style=color:green;font-size:20px;>No BirthDay Today</div>';
}
?>
</table>
<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>
<?php 
if($count>0){
?>
<img src="images/hbd.png" style="height:350px;width:350px;position:absolute; top: 20%;left: 30%;opacity: 0.2;">
</tr>
</table>
<?php } ?>
<div style="">
</div>
