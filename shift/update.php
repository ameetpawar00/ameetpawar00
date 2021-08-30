<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$i = $_GET['i'];
$id = $_GET['id'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("UPDATE `shift` SET `name`='$post[0]',`starttime`='$post[1]',`endtime`='$post[2]',`modifieddate`='$datetime',`updatedby`='$hrmloggedid' WHERE `id` = '$id'",$con);
$getData=mysql_query("SELECT * FROM `shift` WHERE `id`='$id' AND `delete`='0'",$con)or die(mysql_error());
$row=mysql_fetch_array($getData);
?>
<div class="success warnings">
Shift Updated Sucessfully
</div>
BREAKSTRINGFORSAVEDATA
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $id;?>"></td>
<td class="link-blue" onclick="getModule('masters/shift/edit?id=<?php echo $id?>&i=<?php echo $i?>','manipulateContent','viewContent','Shift')"><?php echo $row['name'] ?></td>
<td><?php echo date('g:i:s a', strtotime($row['starttime']));?></td>
<td><?php echo date('g:i:s a', strtotime($row['endtime'])); ?></td>

