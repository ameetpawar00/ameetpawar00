<?php
include("../../include/conFig.php");
$sql = "SELECT * FROM `department` WHERE `delete`='0'";
$getData = mysql_query($sql,$con) or die(mysql_error());
$Num_Rows = mysql_num_rows($getData);
	$Per_Page = 25;   // Per Page
	include('../../pagination/pagination.php');
	$folder= 'masters/typeofasset/view';
	$title = 'Departments';

//$getData = mysql_query("SELECT * FROM `department` WHERE `delete` = '0' AND `id` != '1' ORDER BY `name` ASC",$con) or die(mysql_error());
?>
<div id="myTitle">
<div class="title">View All Departments</div>
<div class="strip">
<span>Dashboard</span>
<span>Department</span>
<span>View</span>
</div>
</div>
<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
<?php if(in_array('a_MDep',$thisper)) 
{
?>
<button class="button blue" onclick="getModule('masters/department/index','manipulateContent','viewContent','Department')"> <i class="plus"></i>New Department</button>&nbsp;
<?php 
} 
?>
<?php if(in_array('d_MDep',$thisper)) 
{
?>
<button class="button red" onclick="deleteData('department','department')"> <i class="delete-icon"></i>Delete</button>&nbsp;
<?php 
} 
?>&nbsp;<button class="button gray" onclick="getModule('masters/index','manipulateContent','viewContent','Setup');">
		<i class="back"></i>Back</button>
</td>
<td style="width:70%" align="right">
</td>
</tr>
</table>
<div style="height:350px;overflow:auto" id="mainDivId">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
<tr><th style="width:5%"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>

	<th>Name</th><th >Description</th>
	<th >Modified</th>
</tr>
<?php
$i = 1;
$sql .=" order by `name` ASC LIMIT $Page_Start , $Per_Page";
$values = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($values))
{
?>
<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td style="width:20px"><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
<?php if(in_array('u_MDep',$thisper)) 
{
?>
<td class="link-blue" onclick="getModule('masters/department/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Department')"><?php echo $row['name'] ?></td>
<?php 
} 
else
{
?>
<td ><?php echo $row['name']?></td>
<?php
}
?>
<td ><?php echo $row['description'] ?></td>
<td ><?php echo date('d-M-Y h:i:s',strtotime($row['modifieddate'])) ?></td>
</tr>
<?php
$i++;
$Maxid = $row['id'];
$MaxI = $i;
}
?>
<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
</table>
<br/><br/><br/><br/><br/><br/>
</div>
<?php
include('../../pagination/pages.php');
?>