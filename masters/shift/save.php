<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("INSERT INTO `shift`(`id`, `name`, `starttime`, `endtime`, `fhdot`, `shdit`, `lcfhc`, `lcshc`, `createdate`, `modifieddate`, `updatedby`) VALUES ('','$post[0]','$post[1]','$post[2]','$post[3]','$post[4]','$post[5]','$post[6]','$datetime','$datetime','$hrmloggedid')",$con) or die(mysql_error());
$id = mysql_insert_id();
$getData = mysql_query("SELECT * FROM `shift` WHERE `id` = '$id' AND `delete`='0'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);


/*

fhdot
shdit
lcfhc
lcshc



First half Day Out Time
Second half Day In Time
Late Coming First Half Count
Late Coming Second Half Count as Full Day

*/








?>
<div class="success warnings">
Shift Saved Sucessfully
</div>
BREAKSTRINGFORSAVEDATA
<td><input id="chBxPUTGENERATEDIHEREINNS" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
<td class="link-blue" onclick="getModule('masters/shift/edit?id=<?php echo $row['id']?>&i=PUTGENERATEDIHERE','manipulateContent','viewContent','Rolls')"><?php echo $row['name'] ?></td>
<td><?php echo $row['starttime']; ?></td>
<td><?php echo $row['endtime']; ?></td>
<td><?php echo $row['fhdot']; ?></td>
<td><?php echo $row['shdit']; ?></td>
<td><?php echo $row['lcfhc']; ?></td>
<td><?php echo $row['lcshc']; ?></td>

