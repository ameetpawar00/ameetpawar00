<?php
include("../../include/conFig.php");
$sql = "select incentiveattendance.id,incentiveattendance.from,incentiveattendance.to,incentiveattendance.action,incentiveattendance.type,incentiveattendance.value,incentiveattendance.status,designation.name from designation,incentiveattendance where  incentiveattendance.delete = '0' and designation.delete = '0' and incentiveattendance.designation = designation.id";
$getData = mysql_query($sql,$con) or die(mysql_error());
$Num_Rows = mysql_num_rows($getData);
	$Per_Page = 25;   // Per Page
	include('../../pagination/pagination.php');
	$folder= 'incentive/attendance/view';
	$title = 'Attendance';

?>

<div id="myTitle">
<div class="title">Attendance Incentive</div>
<div class="strip">
<span>Dashboard</span>
<span>Incentive</span>
<span>Attendance</span>
<span>View</span>
</div>
</div>

<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>
<td style="width:70%" align="right">
			<?php if(in_array('a_IAtten',$thisper)) 
			{
			?>
			<button class="button blue" onclick="getModule('incentive/attendance/index','manipulateContent','viewContent','Attendace Incentive')"> <i class="plus"></i>Add</button>&nbsp;
			<?php 
			}
			?>
			<?php if(in_array('d_IAtten',$thisper)) 
			{
			?>
			<button class="button red" onclick="deleteData('incentiveattendance','Incentive Attendance')"> <i class="delete-icon"></i>Delete</button>&nbsp;
			<?php 
			}
			?>
</td>
</tr>
</table>
<div style="height:400px;overflow-x:hidden;overflow-y:scroll" id="mainDivId">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
<tr><th style="width:5%"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>

<!--<h2 class="title">Attendance Incentive
<input class="teal awesome small" style="float:right;padding:13px" value="Add" type="button" onclick="getModule('incentive/attendance/index','manipulateContent','viewContent','Attendace Incentive')">

</h2>

<div style="background:#fff;height:500px;overflow-x:hidden;overflow-y:auto">

<table width="100%" cellpadding="5" cellspacing="0" style="text-align:center;border-bottom:none;color:#000" class="fetch" >
<tr><th style="width:5%; height: 30px;"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>-->
<th >Designation</th>
<th>From </th>
<th>To</th>
<th>Action</th>
<th>Type</th>
<th>Value</th>
<th>Status</th>
</tr>
<?php
$i=1;
//$getData = mysql_query("select incentiveattendance.id,incentiveattendance.from,incentiveattendance.to,incentiveattendance.action,incentiveattendance.type,incentiveattendance.value,incentiveattendance.status,designation.name from designation,incentiveattendance where  incentiveattendance.delete = '0' and designation.delete = '0' and incentiveattendance.designation = designation.id order by incentiveattendance.from asc,incentiveattendance.to asc",$con)or die(mysql_error());
$sql .=" order by incentiveattendance.to ASC LIMIT $Page_Start , $Per_Page";
$values = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($values))
{
?>

<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
<?php if(in_array('u_IAtten',$thisper)) 
{
?>
<td class="link-blue"  onclick="getModule('incentive/attendance/index?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Attendace Incentive')"><?php echo $row[7]; ?></td>
<?php 
} 
else
{
?>
<td ><?php echo $row[7]?></td>
<?php
}
?>

<td><?php echo $row[1];?></td>
<td><?php echo $row[2];?></td>
<td>
<?php 
if($row[3] == "1")
{
echo "Add";
}
elseif($row[3] == "2")
{
echo "Deduct";
}
?></td>
<td>
<?php 
if($row[4] == "1")
{
echo "Flat";
$valueSymbl = "RS";
}
elseif($row[4] == "2")
{
echo "Percent";
$valueSymbl = "%";
}
?>
</td>
<td><?php echo $row[5]." ".$valueSymbl;?></td>
<td>
<?php if(in_array('s_IAtten',$thisper)) 
{
?>
<center>
<div style="width:60px; " id="invAt<?php echo $row[0]?>" onclick="changeStatus('status','incentiveattendance','<?php echo $row[0]?>','invAt')" <?php if($row[6] == '1') {echo 'class = "active"';} else {echo 'class ="deactive"';}?>   ><?php if($row[6] == '1') {echo 'Applicable';} else {echo 'Not Now';}?></div></center><?php 
} 
?>

</td>
<!--
<td>
<img src="img/icons/icons15.png" title="Edit" height="20" width="20" onclick="getModule('incentive/attendance/index?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Attendace Incentive')"/>&nbsp;&nbsp;&nbsp;&nbsp;
<img src="img/icons/icons4.png" title="Delete " height="20" width="20" onclick="deleteSingle('<?php echo $row[0]?>','fetchrow<?php echo $i?>','incentiveattendance')"/>

</td>-->
</tr>
<?php
$i++;
}
?>

<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
</table>
</div>
<?php
include('../../pagination/pages.php');
?>