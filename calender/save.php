<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
$y = date("Y");
mysql_query("INSERT INTO `leavecalendar` (`holidayType`, `event`, `inTime`, `date`, `createdate`, `updatedby`, `delete`,`year`) VALUES ('$post[0]', '$post[1]', '$post[2]', '$post[3]', '$datetime', '$hrmloggedid', '0','$y')",$con) or die(mysql_error());
$id = mysql_insert_id();
$getData = mysql_query("SELECT * FROM `leavecalendar` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);

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

