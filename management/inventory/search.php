<?php
$datepicker= $_GET['datevalue'];
$to = $_GET['datevalueto'];
//$filter = mysql_query ("select * from `inventory` where date = `$datepicker`");
include("../../include/conFig.php");
$sql = "SELECT * FROM `inventory` WHERE `date` BETWEEN '$datepicker' AND '$to' AND  `delete`='0'";
$getData = mysql_query($sql,$con) or die(mysql_error());
$Num_Rows = mysql_num_rows($getData);
	$Per_Page = 25;   // Per Page
	include('../../pagination/pagination.php');
	$folder= 'masters/inventory/view';
	$title = 'inventory';
?>
<div id="myTitle">
<div class="title">View By Date </div>
<div class="strip">
<span>Dashboard</span>
<span>Managment</span>
<span>Inventory</span>
<span>By Dates</span>
</div>
</div>
<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>
<td style="width:30%">
<?php
$total= mysql_query("SELECT SUM(amount) from `inventory` WHERE date = '$datepicker' AND `delete`='0'");
$sumtotal = mysql_fetch_array($total);
//echo " <div style=font-size:20px; font-family:'Segoe UI', Tahoma, Geneva, Verdana; color:green>Total Bill = $sumtotal[0]</div>";
?>
</td>
<td style="width:70%" align="right">
<div class="calender" id="calenderid"></div>
<button class="button blue" onclick="getModule('management/inventory/view?datevalue='+document.getElementById('selectedDate').value,'manipulateContent','viewContent','Inventory')"> Go Back</button>&nbsp;
<button class="button blue" onclick="getModule('management/inventory/index','manipulateContent','viewContent','Inventory')"> <i class="plus"></i>New Inventory</button>&nbsp;
<button class="button red" onclick="deleteData('inventory','Inventory')"> <i class="delete-icon"></i>Delete</button>&nbsp;
</td>
</tr>
</table>
<div style="height:400px;overflow-x:hidden;overflow-y:scroll" id="mainDivId">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
<tr><th style="width:5%"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>
	<th >Name</th><th >Amount</th><th >Given To</th><th>Description</th>
	<th>Date</th><th>Createdate</th>
</tr>
<?php
$i = 1;
$sql .=" order by `name` ASC LIMIT $Page_Start , $Per_Page";
$values = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($values))
{
?>
<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
<td class="link-blue" onclick="getModule('management/inventory/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Inventory')"><?php echo $row['name'] ?></td>
<td ><?php echo $row['amount']?></td>
<td ><?php echo $row['givento']?></td>
<td ><?php echo $row['description'] ?></td>
<td ><?php echo $row['date'] ?></td>
<td ><?php echo date('d-M-Y h:i:s',strtotime($row['createdate'])) ?></td>
</tr>
<?php
$i++;
$Maxid = $row['id'];
$MaxI = $i;
}
?>
<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
</table>

</div>
<?php
include('../../pagination/pages.php');
?>
