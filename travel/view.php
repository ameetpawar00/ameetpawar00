<?php
include("../include/conFig.php");
?>

<div id="myTitle">
<div class="title">View Travel<span style="display:inline-block"><?php echo $_GET['msg']?></span>
</div>
<div class="strip">
<span>Dashboard</span>
<span>Travel</span>
<span>View</span>
</div>
</div>
<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>
<td style="width:70%" align="right">
<?php
mysql_query("",$con);
?>
<?php if(in_array('ap_extravel',$thisper)) 
{
?>
<button class="button green" onclick="getModule('travelexpense/view','viewContent','manipulateContent','Travel Expenses')"> <i class="plus"></i>Approve Expense</button>&nbsp;
<?php 
} 
?>
<?php if(in_array('a_travel',$thisper)) 
{
?>
<button class="button blue" onclick="getModule('travel/index','manipulateContent','viewContent','Travel')"> <i class="plus"></i>Travel</button>&nbsp;
<?php 
} 
?>
<?php if(in_array('d_travel',$thisper)) 
{
?>
<button class="button red" onclick="deleteData('travel','Travel')"> <i class="delete-icon"></i>Delete</button>&nbsp;
<?php 
} 
?>



</td>
</tr>
</table>

<!--
<h2 class="title">View Travel Details<span style="display:inline-block"><?php echo $_GET['msg']?></span>
<div class="red awesome small"  onclick="deleteData('','Travel')"  style="float:right;margin-left:10px">Delete Selected</div>
<div class="blue awesome small" onclick="getModule('travel/index','manipulateContent','viewContent','Travel')" style="float:right">+1 Travel</div>
<?php
mysql_query("",$con);
?>
<div class="blue awesome small" onclick="getModule('travelexpense/view','viewContent','manipulateContent','Travel Expenses')" style="float:right;margin-right:10px">Approve Expense</div>


</h2>
-->
<?php
//$getOwner = mysql_query("SELECT `id` FROM `travel` WHERE `eid` = '$hrmloggedid'",$con) or die(mysql_error());
//for specifi user
if($hrmloggedid == '86')
{

$sql = "SELECT travel.id,employee.name,department.name,travel.place,travel.purpose FROM employee,travel,department WHERE employee.id = travel.eid AND department.id = travel.deptid AND travel.delete = '0'";
$getData = mysql_query($sql,$con) or die(mysql_error());
$Num_Rows = mysql_num_rows($getData);
	$Per_Page = 25;   // Per Page
	include('../pagination/pagination.php');
	$folder= 'travel/view';
	$title = 'Travel';


//$getData = mysql_query("SELECT travel.id,employee.name,department.name,travel.place,travel.purpose FROM employee,travel,department WHERE employee.id = travel.eid AND department.id = travel.deptid AND travel.delete = '0' ORDER BY travel.id DESC LIMIT 100",$con) or die(mysql_error());

?>
<div style="height:400px;overflow-x:hidden;overflow-y:scroll" id="mainDivId">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
<tr><th style="width:5%"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>

<th style="height: 20px;">Owner</th>
<th style="height: 20px">Department</th>
<th style="height: 20px">Place Of Visit</th>
<th style="height: 20px">Purpose Of Visit</th>
</tr>
<?php
$i = 1;
$sql .=" order by travel.id ASC LIMIT $Page_Start , $Per_Page";
$values = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($values))
{
?>
<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" /></td>
<?php if(in_array('u_travel',$thisper)) 
{
?>
<td style="color:#000;width:200px" class="link-blue" onclick="getModule('travel/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Travel')" ><?php echo $row[1] ?></td>
<?php 
} 
?>

<td style="color:#000;width:200px" ><?php echo $row[2] ?></td>
<td style="color:#000;width:200px" ><?php echo $row[3] ?></td>
<td style="color:#000;width:200px" ><?php echo $row[4] ?></td>
<!--<td>
<img src="img/icons/icons15.png" title="Edit Travel" height="20" width="20" onclick="getModule('travel/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Travel')"/>&nbsp;&nbsp;&nbsp;&nbsp;
<img src="img/icons/icons4.png" title="Delete Travel" height="20" width="20" onclick="deleteSingle('<?php echo $row[0]?>','fetchrow<?php echo $i?>','travel')"/>

</td>-->
</tr>
<?php
$i++;
$Maxid = $row[0];
$MaxI = $i;
}
?>

<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
</table>
</div>
<?php
include('../pagination/pages.php');
?>
<?php
}
/*else if(mysql_num_rows($getOwner) > 0)
{
include("travelowner.php");
}*/
else
{
include("traveluser.php");
}
?>