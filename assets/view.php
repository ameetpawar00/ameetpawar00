<?php
include("../include/conFig.php");
$sql = "SELECT asset.id,employee.name,typeofasset.name,asset.givendate,asset.returndate FROM asset,typeofasset,employee WHERE employee.id = asset.eid AND typeofasset.id = asset.typeofasset AND asset.delete = '0'";
$getData = mysql_query($sql,$con) or die(mysql_error());
$Num_Rows = mysql_num_rows($getData);
	$Per_Page = 25;   // Per Page
	include('../pagination/pagination.php');
	$folder= 'training/view';
	$title = 'Training';

//$getData = mysql_query("SELECT asset.id,employee.name,typeofasset.name,asset.givendate,asset.returndate FROM asset,typeofasset,employee WHERE employee.id = asset.eid AND typeofasset.id = asset.typeofasset AND asset.delete = '0' ORDER BY asset.id DESC LIMIT 100",$con) or die(mysql_error());
?>
<div id="myTitle">
<div class="title">Assets Alloted</div>
<div class="strip">
<span>Dashboard</span>
<span>Assets</span>
<span>View</span>
</div>
</div>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
<button class="button blue" onclick="getModule('assets/index','manipulateContent','viewContent','Asset')"> <i class="plus"></i>New Asset</button>&nbsp;
<button class="button red" onclick="deleteData('asset','Asset')"> <i class="delete-icon"></i>Delete</button>&nbsp;
</td>
</tr>
</table>
<div style="height:500px;overflow-x:hidden;overflow-y:scroll" id="mainDivId">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
<tr><th style="height: 30px"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>
<th style="height: 30px">Name</th>
<th style="height: 30px">Type Of Asset</th>
<th style="height: 30px">Given Date</th>
<th style="height: 30px">Return Date</th>
</tr>

<?php
$i = 1;
$sql .=" order by asset.id ASC LIMIT $Page_Start , $Per_Page";
$values = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($values))
{
?>

<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" /></td>
<?php if(in_array('u_emp',$thisper)) 
{
?>
<td class="link-blue" onclick="getModule('assets/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Assets')"><?php echo $row[1] ?></td>
<?php 
} 
else
{
?>
<td class="link-blue" ><?php echo $row[1]?></td>
<?php
}
?>

<td ><?php echo $row[2] ?></td>
<td><?php echo date('d-M-Y h:i:s',strtotime($row[3])) ?></td>
<td><?php echo date('d-M-Y h:i:s',strtotime($row[4])) ?></td>
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