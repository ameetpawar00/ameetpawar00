<?php
include("../include/conFig.php");
$sql = "SELECT training.id,training.title,employee.name,training.noofdays,training.status FROM employee,training WHERE employee.id = training.owner AND training.delete = '0'";
$getData = mysql_query($sql,$con) or die(mysql_error());
$Num_Rows = mysql_num_rows($getData);
	$Per_Page = 25;   // Per Page
	include('../pagination/pagination.php');
	$folder= 'training/view';
	$title = 'Training';

//$getData = mysql_query("SELECT training.id,training.title,employee.name,training.noofdays,training.status FROM employee,training WHERE employee.id = training.owner AND training.delete = '0' ORDER BY training.id DESC LIMIT 100",$con) or die(mysql_error());
?>

<div id="myTitle">
<div class="title">View Training</div>
<div class="strip">
<span>Dashboard</span>
<span>Training</span>
<span>View</span>
</div>
</div>

<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<td style="width:70%" align="right">
<?php if(in_array('a_train',$thisper)) 
{
?>
<button class="button blue" onclick="getModule('training/index','manipulateContent','viewContent','training')"> <i class="plus"></i>New Training Details</button>&nbsp;
<?php 
} 
?>
<?php if(in_array('d_train',$thisper)) 
{
?>
<button class="button red" onclick="deleteData('training','training')"> <i class="delete-icon"></i>Delete</button>&nbsp;
<?php 
} 
?>
</td>
</table>
<div style="height:400px;overflow-x:hidden;overflow-y:scroll" id="mainDivId">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
<tr><th style="width:5%"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>
<th style="height: 20px">Name</th>
<th style="height: 20px">Owner</th>
<th style="height: 20px">Number Of Days</th>
<th style="height: 20px">Status</th>
</tr>
<?php
$i = 1;
$sql .=" order by `name` ASC LIMIT $Page_Start , $Per_Page";
$values = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($values))
{
?>
<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" ></td>
<?php if(in_array('u_asst',$thisper)) 
{
?>
<td style="height: 20px" class="link-blue" onclick="getModule('training/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','training')"><?php echo $row[1] ?></td>
<?php 
} 
else
{
?>
<td><?php echo $row[1]?></td>
<?php
}
?>

<td style="height: 20px" ><?php echo $row[2] ?></td>
<td style="height: 20px" ><?php echo $row[3] ?></td>
<td style="height: 20px" ><?php echo $row[4] ?></td>
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
include('../pagination/pages.php');
?>