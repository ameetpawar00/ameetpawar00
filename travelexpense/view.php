<?php
include("../include/conFig.php");

$sql = "SELECT travel.id,employee.name,department.name,travel.place,travel.purpose,travelexpense.id,travel.eid FROM employee,travel,department,travelexpense WHERE employee.id = travel.eid AND department.id = travel.deptid AND travel.delete = '0' AND travelexpense.travelid = travel.id AND travelexpense.approved = '0'";
$getData = mysql_query($sql,$con) or die(mysql_error());
$Num_Rows = mysql_num_rows($getData);
	$Per_Page = 25;   // Per Page
	include('../pagination/pagination.php');
	$folder= 'travelexpense/view';
	$title = 'Travel Expense';


//$getData = mysql_query("SELECT travel.id,employee.name,department.name,travel.place,travel.purpose,travelexpense.id,travel.eid FROM employee,travel,department,travelexpense WHERE employee.id = travel.eid AND department.id = travel.deptid AND travel.delete = '0' AND travelexpense.travelid = travel.id AND travelexpense.approved = '0' ORDER BY travel.id DESC LIMIT 100",$con) or die(mysql_error());

?>

<div id="myTitle">
<div class="title">View Travel Expenses<span style="display:inline-block"><?php echo $_GET['msg']?></span></div>
<div class="strip">
<span>Dashboard</span>
<span>Travel</span>
<span>Expenses</span>
<span>View</span>
</div>
</div>

<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>
<td style="width:70%" align="right">
<button class="button gray" onclick="ToggleBox('manipulateContent','block','');ToggleBox('viewContent','none','')"> <i class="back"></i>Back</button>&nbsp;&nbsp;
</td>
</tr>
</table>
<!--
<h2 class="title">View Travel Expenses<span style="display:inline-block"><?php echo $_GET['msg']?></span>

</h2>-->

<div style="height:400px;overflow-x:hidden;overflow-y:scroll" id="mainDivId">

<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
<tr><th style="width:5%; height: 30px;"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>
<th >Owner</th>
<th >Department</th>
<th >Place Of Visit</th>
<th >Total Expense Calculated</th>
</tr>
<?php
$i = 1;
$sql .=" order by travel.id ASC LIMIT $Page_Start , $Per_Page";
$values = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($values))
{
	if($row[6] == $hrmloggedid)
	{
?>
<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td ><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" /></td>
<td><?php echo $row[1] ?></td>
<td><?php echo $row[2] ?></td>
<td><?php echo $row[3] ?></td>
<td><?php echo $row[4] ?></td>
</tr>
<?php
$i++;
$Maxid = $row[0];
$MaxI = $i;
	}
}
?>

<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
</table>
</div>
<?php
include('../pagination/pages.php');
?>
