<?php
include("../include/conFig.php");
error_reporting(0);
$cmonnth=date("m");
$cyear=date("Y");
$sql = "SELECT * FROM `leavecalendar` WHERE YEAR(`date`)='$cyear' AND MONTH(`date`)='$cmonnth' AND `delete` = '0' ORDER BY `date` DESC";
//$getData = mysql_query($sql,$con) or die(mysql_error());





?>
<div id="myTitle">
<div class="title">Holidays + Market Off's <small>(This Month)</small></div>
<div class="strip">
<span>Dashboard</span>
<span>Holidays + Market Off's</span>
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
	<th>Date</th>
	<th>Type</th>
<?php
$i = 1;

$values = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($values))
{
	//print_r($row);
?>
<tr  class="d<?php echo $i%2;?>" id="fetchrow<?php echo $i?>">

<td><?php echo $row["event"]?></td>
<td><?php echo $row["date"]?></td>
<td><?php if($row["holidayType"]==1){ echo "Market Off";}else{echo "<b>Holiday</b>";}?></td>
</tr>
<?php
$i++;

}
?>
</table>
</div>
