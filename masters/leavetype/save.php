<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("INSERT INTO `leavetype`(`name`,`description`, `createdate`, `modifieddate`, `updatedby`, `delete`) VALUES ('$post[0]','$post[1]','$datetime','$datetime','$hrmloggedid','0')",$con) or die(mysql_error());
$id = mysql_insert_id();
$getData = mysql_query("SELECT * FROM `leavetype` WHERE `id` = '$id' AND `delete`='0'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);

?>
<div class="success warnings">
Leave Type Saved Successfully</div>
BREAKSTRINGFORSAVEDATA
<td><input id="chBxPUTGENERATEDIHEREINNS" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" ></td>
<td class="link-blue" onclick="getModule('masters/leavetype/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Leave Type')" style="height: 34px" ><?php echo $row['name'] ?></td>
<td style="height: 34px" ><?php echo substr($row['description'],0,50)?></td>
<td style="height: 34px" ><?php echo date('d-M-Y h:i:s',strtotime($row['modifieddate'])) ?></td>



