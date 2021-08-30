<?php
include("../include/conFig.php");
$sql = "SELECT seperation.id,e1.name,seperation.seperationdate,e2.name,reasonforleaving.name FROM seperation,employee AS e1,employee AS e2,reasonforleaving WHERE e1.id = seperation.eid AND e2.id = seperation.reportto AND seperation.reason = reasonforleaving.id AND seperation.delete = '0'";
$getData = mysql_query($sql,$con) or die(mysql_error());
$Num_Rows = mysql_num_rows($getData);
	$Per_Page = 25;   // Per Page
	include('../pagination/pagination.php');
	$folder= 'exitdetails/view';
	$title = 'Exitdetails';


//$getData = mysql_query("SELECT seperation.id,e1.name,seperation.seperationdate,e2.name,reasonforleaving.name FROM seperation,employee AS e1,employee AS e2,reasonforleaving WHERE e1.id = seperation.eid AND e2.id = seperation.reportto AND seperation.reason = reasonforleaving.id AND seperation.delete = '0'",$con) or die(mysql_error());
?>


<div id="myTitle">
<div class="title">View All Exit Details <span style="display:inline-block"><?php echo $_GET['msg']?></span> </div>
<div class="strip">
<span>Dashboard</span>
<span>Exit Details</span>
<span>View</span>
</div>
</div>

<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
<?php if(in_array('a_exitD',$thisper)) 
{
?>
<button class="button blue" onclick="getModule('exitdetails/index','manipulateContent','viewContent','Exit Details')"> <i class="plus"></i>New Exit Details</button>&nbsp;
<?php 
} 
?>
<?php if(in_array('d_exitD',$thisper)) 
{
?>
<button class="button red" onclick="deleteData('exitdetails','exitdetails')"> <i class="delete-icon"></i>Delete</button>&nbsp;
<?php 
} 
?>
</td>
</tr>
</table>
<div style="height:400px;overflow-x:hidden;overflow-y:scroll" id="mainDivId">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
<tr><th style="width:5%"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>

<!--

<h2 class="title">View All Exit Details<span style="display:inline-block"><?php echo $_GET['msg']?></span>
<div class="red awesome small"  onclick="deleteData('exitdetails','Exit Details')"  style="float:right;margin-left:10px">Delete Selected</div>&nbsp;&nbsp;&nbsp;
<div class="blue awesome small" onclick="getModule('exitdetails/index','manipulateContent','viewContent','Exit Details')" style="float:right">Add Exit Details</div>

</h2>

<div style="background:#fff;height:500px;overflow-x:hidden;overflow-y:auto">
<table width="100%" cellpadding="5" cellspacing="0" style="text-align:center" class="fetch">
<tr><th style="width:5%;"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>-->
	<th>Name</th>
	<th>Sepertion Date</th>
	<th>report To</th>
	<th>Reason Of Leaving</th>
	<th>Action</th>
</tr>
<?php
$i = 1;
$sql .=" order by seperation.id ASC LIMIT $Page_Start , $Per_Page";
$values = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($values))
{
?>
<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" /></td>
<?php if(in_array('u_exitD',$thisper)) 
{
?>
<td class="link-blue" onclick="getModule('exitdetails/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Exit Details')" ><?php echo $row[1]?></td>
<?php 
} 
else
{
?>
<td ><?php echo $row[1]?></td>
<?php
}
?>
<td ><?php echo $row[2]?></td>
<td ><?php echo $row[3]?></td>
<td><?php echo $row[4]?></td>
<td>
<!--<img src="img/icons/icons15.png" title="Edit Exit Details For <?php echo $row[1]?>" height="20" width="20" onclick="getModule('exitdetails/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Exit Details')"/>&nbsp;&nbsp;-->
<?php if(in_array('u_exitD',$thisper)) 
{
?>
<img style="cursor:pointer" src="img/icons/icons10.png" title="Edit Questions For <?php echo $row[1]?>" height="20" width="17" onclick="getModule('exitdetails/viewques?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulatemoodleContent','viewmoodleContent','Exit Details')"/>&nbsp;&nbsp;
<img style="cursor:pointer" src="img/icons/icons10.png" title="Edit Checklist For <?php echo $row[1]?>" height="20" width="13" onclick="getModule('exitdetails/viewchklist?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulatemoodleContent','viewmoodleContent','Exit Details')"/>&nbsp;&nbsp;
<?php 
} 
?>
<?php if(in_array('d_exitD',$thisper)) 
{
?>

<img style="cursor:pointer" src="img/icons/icons4.png" title="Delete Exit Details For <?php echo $row[1]?>" height="20" width="13" onclick="deleteSingle('<?php echo $row[0]?>','fetchrow<?php echo $i?>','seperation')"/>
<?php 
} 
?>

</td>
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
