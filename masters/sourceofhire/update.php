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
mysql_query("UPDATE `sourceofhire` SET `name`='$post[0]',`description`='$post[1]',`modifieddate` = '$datetime', `updatedby`  = '$hrmloggedid' WHERE `id` = '$id'",$con);
$getData=mysql_query("SELECT * FROM `sourceofhire` WHERE `id`=$id AND `delete`='0'",$con)or die(mysql_error());
$row=mysql_fetch_array($getData);
?>

<div class="success warnings">
Source Of Hire Updated Successfully</div>

BREAKSTRINGFORSAVEDATA
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $id;?>"></td>
<td class="link-blue" onclick="getModule('masters/sourceofhire/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Source')" ><?php echo $row['name'] ?></td>
<td ><?php echo substr($row['description'],0,50)?></td>
<td ><?php echo date('d-M-Y h:i:s',strtotime($row['modifieddate'])) ?></td>


