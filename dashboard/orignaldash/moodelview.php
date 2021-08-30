<?php
include("../../include/conFig.php");
error_reporting(0);
$id= $_GET['id'];
//$sql = "SELECT employee.id,employee.username,employee.name,employee.email,employee.phone,employee.jobdescription,employee.active FROM employee WHERE employee.delete = '0' AND employee.active = '0'";
$sql="SELECT employee.id,employee.name,seperation.id,seperation.eid,seperation.seperationdate,reasonforleaving.id,reasonforleaving.name FROM `seperation`,`employee`,`reasonforleaving` WHERE `employee`.`id` = '$id' AND employee.id=seperation.eid AND `reasonforleaving`.`id` = `seperation`.`reason` ";
$getData = mysql_query($sql,$con) or die(mysql_error());
$Num_Rows = mysql_num_rows($getData);
	$Per_Page = 25;   // Per Page
	include('../pagination/pagination.php');
	$folder= 'dashboard/orignaldash/moodel';
	$title = 'X-Employee';

?>
<div id="myTitle">
<div class="title">X-Employees</div>
<div class="strip">
<span>Dashboard</span>
<span>X-Employee</span>
<span>View</span>
</div>
</div>



<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
<button class="button red" onclick="deleteData('seperation','Seperation')"> <i class="delete-icon"></i>Delete</button>&nbsp;
</td>
</tr>
</table>

<div style="height:400px;overflow-x:hidden;overflow-y:scroll" id="mainDivId">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
<tr><th><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>
	<th>Name</th>
	<th>Date</th>
	<th>Reason</th>
	</tr>
<?php
$i = 1;
$sql .=" order by employee.name  ASC LIMIT $Page_Start , $Per_Page";
$values = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($values))

{
?>
<tr  class="d<?php echo $i%2;?>" id="fetchrow<?php echo $i?>">
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" /></td>
<td><?php echo $row[1]?></td>
<td><?php echo $row[4]?></td>

<td><?php echo $row[6]?></td>
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
