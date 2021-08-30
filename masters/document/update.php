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
mysql_query("UPDATE `document` SET `name`='$post[0]',`type`='$post[1]',`description`='$post[2]',`modifieddate` = '$datetime', `updatedby`  = '$hrmloggedid' WHERE `id` = '$id'",$con);

$getData=mysql_query("SELECT * FROM `document` WHERE `id`='$id' AND `delete`='0'",$con)or die(mysql_error());
$row=mysql_fetch_array($getData);
?>
<div class="success warnings">
DocumentUpdated Successfully</div>
BREAKSTRINGFORSAVEDATA
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $id;?>"></td>
<td class="link-blue" onclick="getModule('masters/document/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Document')"><?php echo $row['name'] ?></td>
<td ><?php echo $row['type'] ?></td>
<td ><?php echo $row['description'] ?></td>
<td ><?php echo date('d-M-Y h:i:s',strtotime($row['modifieddate'])) ?></td>


