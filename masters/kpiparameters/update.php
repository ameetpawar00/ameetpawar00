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
mysql_query("UPDATE `kpiparameters` SET `name`='$post[0]', `maximum`='$post[2]', `default`='$post[3]', `description`='$post[1]',`modifieddate` = '$datetime', `updatedby`  = '$hrmloggedid', `designation` = '$post[4]' WHERE `id` = '$id'",$con);
$getData=mysql_query("SELECT * FROM `kpiparameters` WHERE `id`=$id AND `delete`='0'",$con)or die(mysql_error());
$row=mysql_fetch_array($getData);
?>

<div class="success warnings">
Parameters Updated Successfully</div>
BREAKSTRINGFORSAVEDATA
<td>
<?php $designation =  $row['designation'];
$getDesig = mysql_query("SELECT `id`,`name` FROM `designation` WHERE `delete`= '0' AND `id` = '$designation'",$con) or die(mysql_error());
$rowDesig = mysql_fetch_array($getDesig);
echo $rowDesig[1];
?>
</td>
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $id;?>"></td>
<td class="link-blue" onclick="getModule('masters/kpiparameters/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Parameters')" ><?php echo $row['name'] ?></td>
<td><?php echo substr($row['description'],0,50)?></td>
<td><?php echo date('d-M-Y h:i:s',strtotime($row['modifieddate'])) ?></td>


