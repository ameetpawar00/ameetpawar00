<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("INSERT INTO `asset` (`id`, `typeofasset`, `givendate`, `returndate`, `details`, `eid`, `createdate`, `updatedby`, `delete`) VALUES ('', '$post[1]', '$post[2]', '$post[3]', '$post[4]', '$post[0]', '$datetime','$hrmloggedid', '0')",$con) or die(mysql_error());
$id = mysql_insert_id();
$getData = mysql_query("SELECT asset.id,employee.name,typeofasset.name,asset.givendate,asset.returndate FROM asset,typeofasset,employee WHERE employee.id = asset.eid AND typeofasset.id = asset.typeofasset AND asset.id = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);

?>

<div class="success warnings">
Saved Successfully</div>
BREAKSTRINGFORSAVEDATA
<td><input id="chBxPUTGENERATEDIHEREINNS" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
<td onclick="getModule('assets/edit?id=<?php echo $row[0]?>&amp;i=PUTGENERATEDIHERE','manipulateContent','viewContent','Assets')" ><?php echo $row[1] ?></td>
<td><?php echo $row[2] ?></td>
<td><?php echo date('d-M-Y h:i:s',strtotime($row[3])) ?></td>
<td><?php echo date('d-M-Y h:i:s',strtotime($row[4])) ?></td>


