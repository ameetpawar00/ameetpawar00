<?php
include("../include/conFig.php");
$sql = "SELECT leaverecord.id, leaverecord.userid, `leaverecord`.`EL`, `leaverecord`.`1QEL`, `leaverecord`.`2QEL`, `leaverecord`.`3QEL`, `leaverecord`.`4QEL`, `leaverecord`.`M`, `leaverecord`.`special`, `leaverecord`.`CL`, `leaverecord`.`1QCL`, `leaverecord`.`2QCL`, `leaverecord`.`3QCL`, `leaverecord`.`4QCL`, `leaverecord`.`SL`, `leaverecord`.`1QSL`, `leaverecord`.`2QSL`, `leaverecord`.`3QSL`, `leaverecord`.`4QSL`, `leaverecord`.`P`, employee.id as employeeid, employee.name, employee.empid from `leaverecord` , `employee` where `leaverecord`.`delete` = '0' and employee.delete = '0' and employee.id = leaverecord.userid and employee.empstatus = 2";
$getData = mysql_query($sql,$con) or die(mysql_error());
$Num_Rows = mysql_num_rows($getData);
	//$Per_Page = 25;   // Per Page
	//include('../pagination/pagination.php');
	//$folder= 'leaverecord/view';
	//$title = 'Leave Record';
?>
<div id="myTitle">
<div class="title">View Leave Record</div>
<div class="strip">
<span>Dashboard</span>
<span>Leave Record</span>
<span>View</span>
</div>
</div>


<div style="height:350px;overflow:auto" id="mainDivId">
<table class="display dataTable abab table-bordered" width="100%" cellspacing="0"  id="myTable_new" style="width: 100%;padding-bottom: 70px;">
<input type="text" id="myInput" class="input" onkeyup="myFunction()" placeholder="Search for names..">
<thead>
<tr>
	<th><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>
	<th>Employee</th>
	<th>EL</th>
	<th>CL</th>
	<th>SL</th>
	<th>M</th>
	<th>special</th>
	<th>P</th>
</tr>
</thead>
<!--<tfoot style="display: table-header-group;position: relative;top: 0px;">
<tr>
	<th><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>
	<th>Employee</th>
	<th>EL</th>
	<th>CL</th>
	<th>SL</th>
	<th>M</th>
	<th>special</th>
	<th>P</th>
</tr>
</tfoot>-->
<tbody>

<?php
$i = 1;
$sql .=" order by employee.name ASC";
$values = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($values))
{
$empid = $row['empid']; 
$eid = $row['id']; 
$employeeid = $row['employeeid']; 
$sqlLeavey = mysql_query("SELECT `ALL`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`, `11`, `12` FROM `leaverecord_yearly` WHERE `userid` = '".$employeeid."' AND `delete` = '0'",$con)or die(mysql_error());
	$rowy =mysql_fetch_array($sqlLeavey);

?>
<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>" rowspan="2">
<td rowspan="2"><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" /><?php echo $empid?></td>
<?php if(in_array('u_lcal',$thisper)) 
{
?>
<td style="height: 20px;" class="link-blue"  onclick="getModule('leaverecord/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>&employeeid=<?php echo $employeeid?>','manipulateContent','viewContent','Leave Calendar')" rowspan="2"><?php echo $row["name"] ?></td>
<?php 
} 
else
{
?>
<td rowspan="2"><?php echo $row["name"]?></td>
<?php
}
?>

<td >
	EL: <?php echo $row["EL"]?><br>
	&nbsp &nbsp 1QEL: <?php echo $row["1QEL"]?><br>
	&nbsp &nbsp 2QEL: <?php echo $row["2QEL"]?><br>
	&nbsp &nbsp 3QEL: <?php echo $row["3QEL"]?><br>
	&nbsp &nbsp 4QEL: <?php echo $row["4QEL"]?><br>

</td>
<td >
	CL: <?php echo $row["CL"]?><br>
	&nbsp &nbsp 1QCL: <?php echo $row["1QCL"]?><br>
	&nbsp &nbsp 2QCL: <?php echo $row["2QCL"]?><br>
	&nbsp &nbsp 3QCL: <?php echo $row["3QCL"]?><br>
	&nbsp &nbsp 4QCL: <?php echo $row["4QCL"]?><br>
</td>
<td >
	SL: <?php echo $row["SL"]?><br>
	&nbsp &nbsp 1QSL: <?php echo $row["1QSL"]?><br>
	&nbsp &nbsp 2QSL: <?php echo $row["2QSL"]?><br>
	&nbsp &nbsp 3QSL: <?php echo $row["3QSL"]?><br>
	&nbsp &nbsp 4QSL: <?php echo $row["4QSL"]?><br>
</td>
<td ><?php echo $row["M"]?></td>
<td ><?php echo $row["special"]?></td>
<td ><?php echo $row["P"]?></td>
</tr>
<?php $i++;?>
<tr id="fetchrow<?php echo $i?>">
<td colspan="6"><?php echo "<b>All:-</b> ".$rowy["ALL"]."----[<b>JAN:- </b>".$rowy["1"]."]----[<b>FEB:- </b>".$rowy["2"]."]----[<b>MAR:- </b>".$rowy["3"]."]----[<b>APR:- </b>".$rowy["4"]."]----[<b>MAY:- </b>".$rowy["5"]."]----[<b>JUN:- </b>".$rowy["6"]."]----[<b>JUL:- </b>".$rowy["7"]."]----[<b>AGU:- </b>".$rowy["8"]."]----[<b>SEP:- </b>".$rowy["9"]."]----[<b>OCT:- </b>".$rowy["10"]."]----[<b>NOV:- </b>".$rowy["11"]."]----[<b>DEC:- </b>".$rowy["12"]."]";?></td>
</tr>
<?php
$i++;
//$Maxid = $row[0];
//$MaxI = $i;
}
?>
</tbody>
</table>
</div>
<?php
//include('../pagination/pages.php');<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;" />

?>