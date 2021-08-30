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
mysql_query("UPDATE `leavecalendar` SET `date`='$post[3]',`holidayType`='$post[0]',`inTime`='$post[2]',`event` = '$post[1]',`updatedate` = '$datetime', `updatedby`  = '$hrmloggedid' WHERE `id` = '$id'",$con);
$getData=mysql_query("SELECT * FROM `leavecalendar` WHERE `id` = '$id'",$con)or die(mysql_error());
$row=mysql_fetch_array($getData);
?>

<div class="success warnings">
Saved Successfully</div>
BREAKSTRINGFORSAVEDATA
<td><input id="chBxPUTGENERATEDIHEREINNS" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
<td class="link-blue" onclick="getModule('calender/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','calender')">
<?php 
echo "Market Off : ".$row["event"];
?>

</td>
<td ><?php echo $row["inTime"] ?></td>
<td ><?php echo $row["date"] ?></td>

