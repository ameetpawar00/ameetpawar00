<?php
include("../../include/conFig.php");
$sql = "SELECT * FROM `shift` WHERE `delete`='0'";
$getData = mysql_query($sql,$con) or die(mysql_error());
$Num_Rows = mysql_num_rows($getData);
	$Per_Page = 25;   // Per Page
	include('../../pagination/pagination.php');
	$folder= 'masters/shift/view';
	$title = 'Shift';

?>
<div id="myTitle">
<div class="title">Shift</div>
<div class="strip">
<span>Dashboard</span>
<span>Shift</span>
<span>View</span>
</div>
</div>

<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>
<td style="width:70%" align="right">
<button class="button blue" onclick="getModule('masters/shift/index','manipulateContent','viewContent','Shift')"> <i class="plus"></i>New Shift</button>&nbsp;
<button class="button red" onclick="deleteData('shift','shift')"> <i class="delete-icon"></i>Delete</button>&nbsp;
</td>
</tr>
</table>
<div style="height:400px;overflow-x:hidden;overflow-y:scroll" id="mainDivId">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
<tr><th style="width:5%"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox"></th>
<th style="width:35%">Name</th>
<th style="width:30%">Start Time</th>
<th style="width:30%">End Time</th>
</tr>
<?php
$i = 1;
$sql .=" order by `name` ASC LIMIT $Page_Start , $Per_Page";
$values = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($values))
{
?>
<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" ></td>
<td class="link-blue" onclick="getModule('masters/shift/edit?id=<?php echo $row['id']?>&i=<?php echo $i?>','manipulateContent','viewContent','Shift')"><?php echo $row['name'] ?></td>
<td><?php echo date('g:i:s a', strtotime($row['starttime']));?></td>
<td><?php echo date('g:i:s a', strtotime($row['endtime'])); ?></td>
</tr>
<?php
$i++;
$Maxid = $row['id'];
$MaxI = $i;
}
//echo $MaxI;
?>
<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" >
</table>
</div>
<?php
include('../../pagination/pages.php');
?>