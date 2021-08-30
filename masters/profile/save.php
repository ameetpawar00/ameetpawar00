<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
if(mysql_query("INSERT INTO `branch`(`name`,`description`, `createdate`, `modifieddate`, `updatedby`, `delete`) VALUES ('$post[0]','$post[1]','$datetime','$datetime','$hrmloggedid','0')",$con) or die(mysql_error()))
{
$error = "SUccessfully Saved";
}
$id = mysql_insert_id();
$getData = mysql_query("SELECT * FROM `branch` WHERE `id` = '$id' AND `delete`='0'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);

?>

<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
<td style="color:#000"><?php echo $row['name'] ?></td>
<td style="color:#000"><?php echo $row['description'] ?></td>
<td style="color:#000"><?php echo date('d-M-Y h:i:s',strtotime($row['modifieddate'])) ?></td>
<td>
<img src="img/icons/icons15.png" title="Edit Branch <?php echo $row['name']?>" height="20" width="20" onclick="getModule('masters/branch/edit?id=<?php echo $row[0]?>&amp;i=PUTGENERATEDIHERE','manipulateContent','viewContent','Branch')"/>&nbsp;&nbsp;&nbsp;&nbsp;
<img src="img/icons/icons4.png" title="Delete Branch <?php echo $row['name']?>" height="20" width="20" onclick="deleteSingle('<?php echo $row[0]?>','fetchrow<?php echo $i?>','branch')"/>

</td>
