<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
$type  = $post[2];
$getupload = mysql_query("SELECT * FROM `uploadocument` WHERE `delete` ='0'",$con) or die(mysql_error());
$row1 = mysql_fetch_array($getupload);
$row = mysql_num_rows($getupload);
if($row > 0)
{
$id = $row1['id'];
mysql_query("UPDATE `uploadocument` SET `delete` = '1' WHERE `id` = '$id'",$con) or die(mysql_error());
	if($type == 'upload')
	{
		mysql_query("INSERT INTO `uploadocument` (`document`, `createdate`, `updatedby`, `delete`) VALUES ('$post[0]','$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
	}
	else if($type == 'description')
	{
		$des = str_ireplace("<br/>","\n","$post[0]");
		mysql_query("INSERT INTO `uploadocument` (`description`, `createdate`, `updatedby`, `delete`) VALUES ('$des','$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
	}
	$id = mysql_insert_id();
	$getData = mysql_query("SELECT * FROM `uploadocument` WHERE `id` = '$id' AND `delete`='0'",$con) or die(mysql_error());
	$row = mysql_fetch_array($getData);

}
else
{
	if($type == 'upload')
	{
		mysql_query("INSERT INTO `uploadocument` (`document`, `createdate`, `updatedby`, `delete`) VALUES ('$post[0]','$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
	}
		else if($type == 'description')
	{
		mysql_query("INSERT INTO `uploadocument` (`description`,`createdate`, `updatedby`, `delete`) VALUES ('$post[0]','$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
	}
}
?>
<div class="success warnings">
Upload Sccessfully </div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>

<?php 
if($row['description'] == "")
{
?>
<tr>
<th>Click on link to download policy<span>*</span></th>
<td><a href="masters/uploadocument/doucuments/<?php echo $row['document']; ?>">Click here</a></td>
</tr>
<?php 
}
?>
<?php 
if($row['document'] == "")
{
?>
<tr>
<th>Company Policy<span>*</span></th>
<td><textarea class="input huge" name="TextArea" type="" id="" readonly="readonly"><?php echo $row['description']?> </textarea>
</td>
</tr>
<?php 
}
?>
<tr>
<td colspan="2">
<div id="permission" >
		</div>
</td>
</tr>
</table>
BREAKSTRINGFORSAVEDATA

