<?php
include("../../include/conFig.php");
$id = $_GET['id'];
$getData = mysql_query("SELECT * FROM `uploadocument` WHERE `delete` = '0' ",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
<table cellpadding="0" cellspacing="0" width="100%">
<?php 
if($id == 1)
{
?>	
<th width="50%" style="float:right">
Click on link to download file
</th>
<td width="30%">
<a href="masters/uploadocument/doucuments/<?php echo $row['document'] ?>">Click here</a>
</td>
	<td><button class="button green" onclick="getModule('masters/uploadocument/policy?id=4','policy','','Upload Document')"><i class="save-icon"></i> Change</button></td>
	<td width="20%"></td>
<?php
}
else if($id == 2)
{
?>
	<th valign="top" width="50%" style="float:right">ADD Policies<span>*</span>
	</th>
	<td style="height: 26px" width="30%"><textarea class="input huge" name="TextArea" type="" id="cmp0" readonly="readonly"><?php echo $row['document'] ?> </textarea>
	</td>
	<td><button class="button green" onclick="getModule('masters/uploadocument/policy?id=3','policy','','Upload Document')"><i class="save-icon"></i> Change</button></td>
	<td width="20%"></td>
<?php
}
else if($id == 3)
{
?>

<th valign="top" width="50%" style="float:right">ADD Policies<span>*</span>
	</th>
	<td style="height: 26px" width="30%"><textarea class="input huge" name="TextArea" type="" id="cmp0"> </textarea>
	</td>
	<td width="20%"></td>
<?php 
}
else if($id == 4)
{
?>
	<th width="50%" style="float:right">Upload File</th>
	<td width="50%"><iframe src="masters/uploadocument/doucuments/index.php?id=cmp0" frameborder="0" scrolling="no" height="80px" width="300px"></iframe>
	<input type="hidden" value="" id="cmp0"/>
	</td>
	<td colspan="4" style="text-align:center">
	<button class="button green" onclick="SaveData('masters/uploadocument/save','cmp','1','','','couResp','1');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i>Save</button>
	</td>
<?php 
}
?>
</table>