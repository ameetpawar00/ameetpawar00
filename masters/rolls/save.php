<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("INSERT INTO `rolls` (`name`, `createdate`, `modifieddate`,  `updatedby`, `delete`) VALUES ('$post[0]','$datetime','$datetime','$hrmloggedid','0')",$con) or die(mysql_error());
$id = mysql_insert_id();
$getData = mysql_query("SELECT * FROM `rolls` WHERE `id` = '$id' AND `delete`='0'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);

?>
<div class="success warnings">
Type of Asset Saved Sucessfully
</div>
BREAKSTRINGFORSAVEDATA
<td><input id="chBxPUTGENERATEDIHEREINNS" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
<td class="link-blue" onclick="getModule('masters/rolls/edit?id=<?php echo $row['id']?>&i=PUTGENERATEDIHERE','manipulateContent','viewContent','Rolls')"><?php echo $row['name'] ?></td>
<td><?php echo date('d-M-Y',strtotime($row['modifieddate'])) ?></td>

