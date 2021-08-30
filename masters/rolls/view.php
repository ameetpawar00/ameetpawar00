<?php
include("../../include/conFig.php");
$sql = "SELECT * FROM `rolls` WHERE `delete`='0'";
$getData = mysql_query($sql,$con) or die(mysql_error());
$Num_Rows = mysql_num_rows($getData);
	$Per_Page = 25;   // Per Page
	include('../../pagination/pagination.php');
	$folder= 'masters/rolls/view';
	$title = 'Rolls';

?>
<div id="myTitle">
<div class="title">Rolls</div>
<div class="strip">
<span>Dashboard</span>
<span>Rolls</span>
<span>View</span>
</div>
</div>

<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>
<td style="width:70%" align="right">
<button class="button blue" onclick="getModule('masters/rolls/index','manipulateContent','viewContent','Rolls')"> <i class="plus"></i>New Rolls</button>&nbsp;
<button class="button red" onclick="deleteData('rolls','Rolls')"> <i class="delete-icon"></i>Delete</button>&nbsp;&nbsp;<button class="button gray" onclick="getModule('masters/index','manipulateContent','viewContent','Setup');">
		<i class="back"></i>Back</button>
</td>
</tr>
</table>
<div style="height:350px;overflow:auto" id="mainDivId">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
<tr><th style="width:5%"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox"></th>
<th style="width:30%">Name</th>
<th style="width:65%">Modified</th>
</tr>
<?php
$i = 1;
$sql .=" order by `name` ASC LIMIT $Page_Start , $Per_Page";
$values = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($values))
{
?>
<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" ></td>
<td class="link-blue" onclick="getModule('masters/rolls/edit?id=<?php echo $row['id']?>&i=<?php echo $i?>','manipulateContent','viewContent','Rolls')"><?php echo $row['name'] ?></td>
<td><?php echo date('d-M-Y',strtotime($row['modifieddate'])) ?></td>
</tr>
<?php
$i++;
$Maxid = $row['id'];
$MaxI = $i;
}
//echo $MaxI;
?>
<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" >
</table>
</div>
<?php
include('../../pagination/pages.php');
?>