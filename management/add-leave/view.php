<?php
include("../../include/conFig.php");
$todaydate = date('y-m-d');
$sql = "SELECT * FROM `inventory` WHERE `delete`='0' AND `date` = '$todaydate'";
$getData = mysql_query($sql,$con) or die(mysql_error());
$Num_Rows = mysql_num_rows($getData);
	$Per_Page = 25;   // Per Page
	include('../../pagination/pagination.php');
	$folder= 'masters/inventory/view';
	$title = 'inventory';


//$getData = mysql_query("SELECT * FROM `location` WHERE `delete` = '0' AND `id` != '1' ORDER BY `name` ASC",$con) or die(mysql_error());
?>
<div id="myTitle">
<div class="title">View All Daily Inventory </div>
<div class="strip">
<span>Dashboard</span>
<span>Managment</span>
<span>Inventory</span>
<span>View</span>
</div>
</div>
<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>
<td style="width:30%">
<?php
$total= mysql_query("SELECT SUM(amount) from `inventory` WHERE date = '$todaydate' AND `delete`='0'");
$sumtotal = mysql_fetch_array($total);
echo " <div style=font-size:20px; font-family:'Segoe UI', Tahoma, Geneva, Verdana; color:green>Total Bill = $sumtotal[0]</div>";
?>
</td>
<td style="width:70%" align="right">
<button class="button red">Select Date <input name="datepicker" id="selectedDate" type="" readonly="readonly" value="<?php echo $todaydate;?>" class="inputCalendar" style="width:200px" onclick="openCalender('calenderid','selectedDate')">
<div class="calender" id="calenderid"></div></button>
<button class="button blue" onclick="getModule('management/inventory/search?datevalue='+document.getElementById('selectedDate').value,'manipulateContent','viewContent','Inventory')"> Go</button>&nbsp;
<button class="button blue" onclick="getModule('management/add-leave/index','manipulateContent','viewContent','Inventory')"> <i class="plus"></i>New Inventory</button>&nbsp;
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
