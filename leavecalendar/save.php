<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
$travelid = $_GET['travelid'];
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("INSERT INTO `leavecalendar`( `year`, `date`, `event`, `description`, `createdate`, `updatedate`, `updatedby`) VALUES ('$post[0]', '$post[2]', '$post[1]', '$post[3]',  '$datetime', '$datetime', '$hrmloggedid')",$con) or die(mysql_error());
$id = mysql_insert_id();
$getData = mysql_query("SELECT * from `leavecalendar` where `delete` = '0'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);

?>

<div class="success warnings">
Leave Calendar Successfully</div>
BREAKSTRINGFORSAVEDATA
<!--<td><input id="chBxPUTGENERATEDIHEREINNS" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>"></td>
<td style="height: 20px;" ><?php echo $row['year'] ?></td>
<td style="height: 20px;" class="link-blue"  onclick="getModule('leavecalendar/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Leave Calendar')"><?php echo $row['event'] ?></td>
<td style="height: 20px;" ><?php echo  date(('d M,Y') ,strtotime($row['date'])) ?></td>
<td style="height: 20px;" ><?php echo date(('d M,Y H:i:s') ,strtotime($row['updatedate'])) ?></td>
-->