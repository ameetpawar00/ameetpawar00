<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("INSERT INTO `shift`(`id`, `name`, `starttime`, `endtime`, `createdate`, `modifieddate`, `updatedby`) VALUES ('','$post[0]','$post[1]','$post[2]','$datetime','$datetime','$hrmloggedid')",$con) or die(mysql_error());
$id = mysql_insert_id();
$getData = mysql_query("SELECT * FROM `shift` WHERE `id` = '$id' AND `delete`='0'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);

?>
<div class="success warnings">
Shift Saved Sucessfully
</div>
BREAKSTRINGFORSAVEDATA
<td><input id="chBxPUTGENERATEDIHEREINNS" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
<td class="link-blue" onclick="getModule('masters/shift/edit?id=<?php echo $row['id']?>&i=PUTGENERATEDIHERE','manipulateContent','viewContent','Rolls')"><?php echo $row['name'] ?></td>
<td><?php echo $row['starttime']; ?></td>
<td><?php echo $row['endtime']; ?></td>

