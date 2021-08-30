<?php
include("../include/conFig.php");
$empstatus1 = $_GET['empstatus1'];
$empdeg = $_GET['empdeg'];
$empdep = $_GET['empdep'];
$empsal = $_GET['empsal'];
$emprole = $_GET['emprole'];
$empstatus2 = $_GET['empstatus2'];



$sql = "SELECT employee.id,employee.empid,employee.name,employee.workemail,employee.mobile,designation.name,employee.doj FROM employee,designation WHERE employee.delete = '0' AND employee.designation= designation.id";
if($empstatus1 != '0')
	$sql .= " AND employee.active LIKE '%$empstatus1%'";	
if($empdeg != '0')
	$sql .= " AND employee.designation LIKE '%$empdeg%'";	
if($empdep != '0')
	$sql .= " AND employee.department LIKE '%$empdep%'";	
if($empsal != '0')
	$sql .= " AND employee.salaryId LIKE '%$empsal%'";	
if($emprole != '0')
	$sql .= " AND employee.role LIKE '%$emprole%'";	
if($empstatus2 != '0')
	$sql .= " AND employee.empstatus LIKE '%$empstatus2%'";	
	
	//echo $sql;
$getData = mysql_query($sql,$con) or die(mysql_error());
$Num_Rows = mysql_num_rows($getData);
	$Per_Page = 50;   // Per Page
	include('../pagination/pagination.php');
	$folder= 'employee/view';
	$title = 'Employee';


?>
 
 
<div style="height:400px;overflow-x:hidden;overflow-y:scroll" >
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
if($Num_Rows>0)
{
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
}
else
{
?>
	<tr>
		<td colspan="6">No Record Found</td>
	</tr>
<?php
}
?>
<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
</table>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>
<?php
include('../pagination/pages.php');
?>
