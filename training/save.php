<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("INSERT INTO `training` (`id`, `title`, `description`, `noofdays`, `owner`, `venue`, `status`, `startdate`, `enddate`, `reimbursible`, `cost`, `remarks`, `createdate`,`updatedate`, `updatedby`) VALUES ('', '$post[0]', '$post[8]', '$post[2]', '$post[1]', '$post[3]', '$post[6]', '$post[4]', '$post[5]', '$post[7]', '$post[10]', '$post[9]', '$datetime','$datetime', '$hrmloggedid')",$con) or die(mysql_error());
$id = mysql_insert_id();
$getData = mysql_query("SELECT training.id,training.title,employee.name,training.noofdays,training.status FROM employee,training WHERE employee.id = training.owner AND training.id = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);

?>

<div class="success warnings">
Training Details Saved Successfully</div>
BREAKSTRINGFORSAVEDATA
<td><input id="chBxPUTGENERATEDIHEREINNS" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
<td class="link-blue" onclick="getModule('training/edit?id=<?php echo $row[0]?>&i=PUTGENERATEDIHERE','manipulateContent','viewContent','training')">
<?php echo $row[1] ?></td>
<td ><?php echo $row[2] ?></td>
<td ><?php echo $row[3] ?></td>
<td ><?php echo $row[4] ?></td>



