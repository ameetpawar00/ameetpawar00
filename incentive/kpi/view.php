<?php
include("../../include/conFig.php");
$sql = "select incentivekpi.id,incentivekpi.from,incentivekpi.to,incentivekpi.action,incentivekpi.type,incentivekpi.value,incentivekpi.status,designation.name,kpiparameters.name from designation,incentivekpi,kpiparameters where  incentivekpi.delete = '0' and designation.delete = '0' and kpiparameters.delete = '0' and incentivekpi.designation = designation.id and incentivekpi.kpiid= kpiparameters.id";
$getData = mysql_query($sql,$con) or die(mysql_error());
$Num_Rows = mysql_num_rows($getData);
	$Per_Page = 25;   // Per Page
	include('../../pagination/pagination.php');
	$folder= 'incentive/kpi/view';
	$title = 'KPI';


?>


<div id="myTitle">
<div class="title">KPI Incentive
</div>
<div class="strip">
<span>Dashboard</span>
<span>Incentive</span>
<span>KPI </span>
<span>View</span>
</div>
</div>

<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
<?php if(in_array('a_IKPI',$thisper)) 
{
?>
<button class="button blue" onclick="getModule('incentive/kpi/index','manipulateContent','viewContent','kpi Incentive')"> <i class="plus"></i>Add</button>&nbsp;
<?php 
} 
?>
<?php if(in_array('d_IKPI',$thisper)) 
{
?>
<button class="button red" onclick="deleteData('incentivekpi','incentivekpi')"> <i class="delete-icon"></i>Delete</button>&nbsp;
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
<h2 class="title">KPI Incentive
<input class="teal awesome small" style="float:right;padding:13px" value="Add" type="button" onclick="getModule('incentive/kpi/index','manipulateContent','viewContent','kpi Incentive')">

</h2>

<div style="background:#fff;height:500px;overflow-x:hidden;overflow-y:auto">

<table width="100%" cellpadding="5" cellspacing="0" style="text-align:center;border-bottom:none;color:#000" class="fetch" >
<tr><th style="width:5%; height: 30px;"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>-->
<th >Designation</th>
<th>KPI</th>
<th>From </th>
<th>To</th>
<th>Action</th>
<th>Type</th>
<th>Value</th>
<th>Status</th>
</tr>
<?php
$i=1;
//$getData = mysql_query("select incentivekpi.id,incentivekpi.from,incentivekpi.to,incentivekpi.action,incentivekpi.type,incentivekpi.value,incentivekpi.status,designation.name,kpiparameters.name from designation,incentivekpi,kpiparameters where  incentivekpi.delete = '0' and designation.delete = '0' and kpiparameters.delete = '0' and incentivekpi.designation = designation.id and incentivekpi.kpiid= kpiparameters.id order by incentivekpi.from asc,incentivekpi.to asc",$con)or die(mysql_error());
$sql .=" order by incentivekpi.from ASC LIMIT $Page_Start , $Per_Page";
$values = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($values))
{
?>

<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td style="height: 30px"><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" ></td>
<?php if(in_array('u_IKPI',$thisper)) 
{
?>
<td class="link-blue" onclick="getModule('incentive/kpi/index?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','kpi Incentive')"><?php echo $row[7]; ?></td>
<?php 
} 
else
{
?>
<td ><?php echo $row[7]?></td>
<?php
}
?>
<td><?php echo $row[8];?></td>
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
<?php if(in_array('s_IKPI',$thisper)) 
{
?>
<center>
<div style="width:60px" id="invAt<?php echo $row[0]?>" onclick="changeStatus('status','incentivekpi','<?php echo $row[0]?>','invAt')" <?php if($row[6] == '1') {echo 'class = "active"';} else {echo 'class ="deactive"';}?>   ><?php if($row[6] == '1') {echo 'Applicable';} else {echo 'Not Now';}?></div>
</center><?php 
} 
?>

</td>
<!--<td>
<img src="img/icons/icons15.png" title="Edit" height="20" width="20" onclick="getModule('incentive/kpi/index?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','kpi Incentive')">&nbsp;&nbsp;&nbsp;&nbsp;
<img src="img/icons/icons4.png" title="Delete " height="20" width="20" onclick="deleteSingle('<?php echo $row[0]?>','fetchrow<?php echo $i?>','incentivekpi')">

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