<?php
include("../include/conFig.php");
$eid = $_GET['eid'];
$getCount = mysql_query("SELECT `id` FROM `asset` WHERE `eid` = '$eid'",$con) or die(mysql_error());
$getData = mysql_query("SELECT typeofasset.name,asset.givendate,asset.returndate,asset.returned,asset.id FROM asset,typeofasset WHERE asset.typeofasset = typeofasset.id AND asset.eid ='$eid'",$con) or die(mysql_error());
if(mysql_num_rows($getCount) > 0)
{
?>
<table width="100%" cellpadding="10" cellspacing="0" class="form-horizontal well formtable">
<tr><td colspan="4" style="color:#000;border-bottom:2px #bbbbbb solid;">Assets Alloted</td>
</tr>
<?php
while($row = mysql_fetch_array($getData))
{
?>
<tr>
	<th style="width:175px; height: 39px;">Type Of Asset</th>
	<td  style="width:300px; height: 39px;"><?php echo $row[0]?></td>
	<th style="width:175px; height: 39px;">Given Date</th>
	<td style="height: 39px"><?php echo $row[1]?></td>
</tr>
<tr>
	<th style="width:175px">Return Date</th>
	<td><?php echo $row[2]?></td>
	<th style="width:175px">Status</th>
	<td>
	<div id="ase<?php echo $row[4]?>" <?php if($row[3] == '1') {echo 'class = "green"';} else {echo 'class ="maroon"';}?> onclick="changeStatus('returned','asset','<?php echo $row[4]?>','ase')"  ><?php if($row[3] == '1') {echo 'Returned';} else {echo 'Not Returned';}?></div>
	</td>
</tr>
<?php
}
?>
</table>
<?php
}
?>
