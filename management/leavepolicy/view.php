<?php
include("../../include/conFig.php");
$sql = "select `name`,`id` from `designation` where `id` != '1' and `delete` = '0'";
$getData = mysql_query($sql,$con) or die(mysql_error());
$Num_Rows = mysql_num_rows($getData);
	$Per_Page = 25;   // Per Page
	include('../../pagination/pagination.php');
	$folder= 'management/leavepolicy/view';
	$title = 'Leave Policy';

?>


<div id="myTitle">
<div class="title">Leave Management</div>
<div class="strip">
<span>Dashboard</span>
<span>Management</span>
<span>Leave Management</span>
<span>View</span>
</div>
</div>

<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>
<td style="width:70%" align="right">
<?php if(in_array('a_MLpolicy',$thisper)) 
{
?>
<button class="button blue" onclick="getModule('management/leavepolicy/index','manipulateContent','viewContent','Add Leave Policy')"> <i class="plus"></i>Manage Policy</button>&nbsp;
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
<h2 class="title">Leave Policy Managment
<input class="teal awesome small" style="float:right;" value="Manage Policy" type="button" onclick="getModule('management/leavepolicy/index','manipulateContent','viewContent','Add Leave Policy')">

</h2>

<div style="background:#fff;height:500px;overflow-x:hidden;overflow-y:auto">

<table width="100%" cellpadding="5" cellspacing="0" style="text-align:center;border-bottom:none;color:#000" class="fetch" >
<tr><th style="width:5%; height: 30px;"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>-->
<th>Designation</th>
<?php
$getLeave = mysql_query("select `name`,`id` from `leavetype` where `id` != '1' and `delete` = '0' order by `name` asc",$con) or die(mysql_error());
while($rowLeave = mysql_fetch_array($getLeave))
{
$levId[] .= $rowLeave[1];
echo "<th>$rowLeave[0]</th>";
}
?>
</tr>
<?php
$i=1;
//$getDesig = mysql_query("select `name`,`id` from `designation` where `id` != '1' and `delete` = '0' order by `name` asc",$con)or die(mysql_error());
$sql .=" order by `name` ASC LIMIT $Page_Start , $Per_Page";
$values = mysql_query($sql,$con)or die(mysql_error());
while($rowDesig=mysql_fetch_array($values))
{
$desigId = $rowDesig[1];
?>

<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td style="height: 30px"><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" /></td>
<td>
<?php
echo $rowDesig[0];
?>
</td>
<?php
foreach($levId as $leave)
{
	if($leave != "")
	{
		$getValue = mysql_query("SELECT `value` from `leavepolicy` where `delete` = '0' and `designation` = '$desigId' and 	`leaveid` = '$leave'",$con) or die(mysql_error());
		$rowValue = mysql_fetch_array($getValue);
		echo "<td>$rowValue[0]</td>";
	}
}

?>
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