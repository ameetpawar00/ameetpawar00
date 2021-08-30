<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
$i = $_GET['i'];
$id = $_GET['id'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("UPDATE `leavecalendar` SET `year`='$post[0]',`date`='$post[2]',`event`='$post[1]',`description`='$post[3]',`updatedate`='$datetime',`updatedby`='$hrmloggedid' WHERE `id` = '$id'",$con) or die(mysql_error());
$getData = mysql_query("SELECT * from `leavecalendar` where `delete` = '0'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);

?>

<div class="success warnings">
Calendar Updated Successfully</div>
BREAKSTRINGFORSAVEDATA
<!--<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $id;?>"></td>
<td style="height: 20px;" ><?php echo $row['year'] ?></td>
<td style="height: 20px;" class="link-blue"  onclick="getModule('leavecalendar/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Leave Calendar')"><?php echo $row['event'] ?></td>
<td style="height: 20px;" ><?php echo  date(('d M,Y') ,strtotime($row['date'])) ?></td>
<td style="height: 20px;" ><?php echo date(('d M,Y H:i:s') ,strtotime($row['updatedate'])) ?></td>
-->