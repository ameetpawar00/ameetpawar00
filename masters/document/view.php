<?php
include("../../include/conFig.php");
$sql = "SELECT * FROM `document` WHERE `delete`='0'";
$getData = mysql_query($sql,$con) or die(mysql_error());
$Num_Rows = mysql_num_rows($getData);
	$Per_Page = 25;   // Per Page
	include('../../pagination/pagination.php');
	$folder= 'masters/document/view';
	$title = 'document';


//$getData = mysql_query("SELECT * FROM `location` WHERE `delete` = '0' AND `id` != '1' ORDER BY `name` ASC",$con) or die(mysql_error());
?>
<div id="myTitle">
<div class="title">View All Document</div>
<div class="strip">
<span>Dashboard</span>
<span>Document</span>
<span>View</span>
</div>
</div>
<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
<button class="button blue" onclick="getModule('masters/document/index','manipulateContent','viewContent','Document')"> <i class="plus"></i>New Document</button>&nbsp;
<button class="button red" onclick="deleteData('document','Document')"> <i class="delete-icon"></i>Delete</button>&nbsp;&nbsp;<button class="button gray" onclick="getModule('masters/index','manipulateContent','viewContent','Setup');">
		<i class="back"></i>Back</button>
</td>
</tr>
</table>
<div style="height:350px;overflow:auto" id="mainDivId">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
<tr><th style="width:5%; height: 30px;"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>
	<th style="height: 30px" >Name</th><th style="height: 30px" >Type</th>
	<th style="height: 30px">Description</th>
	<th style="height: 30px">Modified</th>
</tr>
<?php
$i = 1;
$sql .=" order by `name` ASC LIMIT $Page_Start , $Per_Page";
$values = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($values))
{
?>
<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
<td class="link-blue" onclick="getModule('masters/document/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Document')"><?php echo $row['name'] ?></td>

<td >
<?php if($row['type']=='1') {echo 'Image';}?>
<?php if($row['type']=='2') {echo 'Doc';}?>
<?php if($row['type']=='3') {echo 'Excel';}?>
<?php if($row['type']=='4') {echo 'Pdf';}?>
<?php if($row['type']=='5') {echo 'Csv';}?>
<?php if($row['type']=='6') {echo 'Text';}?>

</td>
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

</div>
<?php
include('../../pagination/pages.php');
?>
