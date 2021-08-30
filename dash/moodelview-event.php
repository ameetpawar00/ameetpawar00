<?php
include("../include/conFig.php");
error_reporting(0);
$Todm = date('m');
$TodY = date('Y');

$sql = "SELECT * FROM `events` WHERE MONTH(`date`)='$Todm' AND  YEAR(`date`)='$TodY'";
$getData = mysql_query($sql,$con) or die(mysql_error());

$sqld = "SELECT `id`, `name` FROM `department` WHERE `delete`='0'";	
$getDatad = mysql_query($sqld,$con) or die(mysql_error());
$madr=array();
while($rowd =mysql_fetch_array($getDatad))
{
	$madr[$rowd["id"]]=$rowd["name"];
}
//print_r($madr);
?>
<div id="myTitle">
<div class="title">Upcoming Events Of &nbsp;<span style="color:green"><?php echo date('M');?></span></div>
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

	<th>Event</th>
	<th>Time</th>
	<th>Date</th>
	<th>Venue</th>
	<th>Departments</th>
<?php
$i = 1;
//$sql .=" order by employee.name  ASC LIMIT $Page_Start , $Per_Page";
//$values = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($getData))
{
	
?>
<tr  class="d<?php echo $i%2;?>" id="fetchrow<?php echo $i?>">

<td><?php echo $row["name"]?></td>
<td><?php echo $row["time"]?></td>
<td><?php echo $row["date"]?></td>
<td><?php echo $row["venue"]?></td>
<td><?php $ddt=explode(",",$row["department"]); foreach($ddt as $ddr){echo "- ".$madr[$ddr]."<BR>";}?></td>
</tr>
<?php
$i++;
$Maxid = $row['id'];
$MaxI = $i;
}
?>
</table>
</div>
