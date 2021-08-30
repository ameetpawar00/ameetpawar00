<?php
include("../include/conFig.php");
if($_GET['desig'] !="")
{
$chkDesig = $_GET['desig'];
$desigSql = " AND designation.id = '$chkDesig'";
}
else
{
$desigSql = " AND designation.id = '$loggedDesig'";
}
if($_GET['syear'] !="")
{
$syear = $_GET['syear'];
$yearSql = " AND leavepolicy.year = '$syear'";
}
else
{
$yearSql = " AND leavepolicy.year = '$year'";
}
//$sql = "SELECT allotleave.id,allotleave.leave,allotleave.modifieddate,designation.name,leavetype.name FROM allotleave,designation,leavetype WHERE allotleave.delete = '0' AND  allotleave.leavetype = leavetype.id and allotleave.designation= designation.id";
$sql = "SELECT leavepolicy.id,leavepolicy.value,leavepolicy.remaining,leavetype.name,designation.name FROM leavepolicy,leavetype,designation WHERE leavetype.id = leavepolicy.leaveid AND leavepolicy.designation = designation.id AND leavepolicy.delete = '0' $desigSql $yearSql";
$getData = mysql_query($sql,$con) or die(mysql_error());
$Num_Rows = mysql_num_rows($getData);
	$Per_Page = 25;   // Per Page
	include('../pagination/pagination.php');
	$folder= 'allotleave/view';
	$title = 'Allot Leave';
	$style = "display:none";

//$getData = mysql_query("SELECT allotleave.id,allotleave.leave,allotleave.modifieddate,designation.name,leavetype.name FROM allotleave,designation,leavetype WHERE allotleave.delete = '0' AND  allotleave.leavetype = leavetype.id and allotleave.designation= designation.id ORDER BY allotleave.designation ASC limit 100",$con) or die(mysql_error());
?>

<div id="myTitle">
<div class="title">View Alloted Leaves </div>
<div class="strip">
<span>Dashboard</span>
<span>Alloted Leaves</span>
<span>View</span>
</div>
</div>

<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>
<td style="width:70%;display:none" align="right" >
<?php if(in_array('a_alve',$thisper)) 
{
?>
<button class="button blue" onclick="getModule('allotleave/index','manipulateContent','viewContent','Allot Leave ')"> <i class="plus"></i> Add </button>&nbsp;
<?php 
} 
?>
<?php if(in_array('d_alve',$thisper)) 
{
?>
<button class="button red" onclick="deleteData('allotleave','allotleave')"> <i class="delete-icon"></i>Delete</button>&nbsp;
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
<h2 class="title">View Alloted Leaves <span style="display:inline-block"><?php echo $_GET['msg']?></span>
<div class="red awesome small"  onclick="deleteData('allotleave','allotleave')"  style="float:right;margin-left:10px">Delete Selected</div>&nbsp;&nbsp;&nbsp;
<div class="blue awesome small" onclick="getModule('allotleave/index','manipulateContent','viewContent','Allot Leave ')" style="float:right">+ Add </div>

</h2>

<div style="background:#fff;height:500px;overflow-x:hidden;overflow-y:auto">
<table width="100%" cellpadding="5" cellspacing="0" style="text-align:center;border-bottom:none" class="fetch" >
<tr><th style="width:5%;"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>-->
<th style="<?php echo $style ?>" >Designation</th>
<th >Leave Type</th>
<th >Total Leave</th>
<th>Remains</th>
<th style="<?php echo $style ?>">Action</th>

</tr>
<?php
$i = 1;
$sql .=" order by leavepolicy.designation ASC LIMIT $Page_Start , $Per_Page";
$values = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($values))
{
?>
<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
<td style="<?php echo $style ?>"><?php echo $row[4] ?></td>
<td  ><?php echo $row[3] ?></td>
<td ><?php echo $row[1]?></td>
<td ><?php echo $row[2]?></td>
<td style="<?php echo $style ?>">
<?php if(in_array('d_alve',$thisper)) 
{
?>
<img style="cursor:pointer" src="img/icons/icons15.png" title="Edit " height="20" width="17" onclickk="editDynamic('allotleave/edit.php','<?php echo base64_encode($row[0])?>','fetchrow<?php echo $i?>','edit')"/>&nbsp;&nbsp;&nbsp;&nbsp;
<?php 
} 
?>
<?php if(in_array('u_alve',$thisper)) 
{
?>
<img style="cursor:pointer" src="img/icons/icons4.png" title="Delete" height="20" width="13" onclick="deleteSingle('<?php echo $row[0]?>','fetchrow<?php echo $i?>','allotleave')"/>
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