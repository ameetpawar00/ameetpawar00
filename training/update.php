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
mysql_query("UPDATE `training` SET `title`='$post[0]',`description`='$post[8]',`noofdays`='$post[2]',`owner`='$post[1]',`venue`='$post[3]',`status`='$post[6]',`startdate`='$post[4]',`enddate`='$post[5]',`reimbursible`='$post[7]',`cost`='$post[10]',`remarks`='$post[9]', `updatedate` = '$datetime', `updatedby`  = '$hrmloggedid' WHERE `id` = '$id'",$con) or die(mysql_error());
$getData = mysql_query("SELECT training.id,training.title,employee.name,training.noofdays,training.status FROM employee,training WHERE employee.id = training.owner AND training.id = '$id'",$con) or die(mysql_error());
$row=mysql_fetch_array($getData);
?>


<div class="success warnings">
Training Details Updated Successfully</div>
BREAKSTRINGFORSAVEDATA
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $id;?>"></td>
<td class="link-blue" onclick="getModule('training/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Assets')">
<?php echo $row[1] ?></td>
<td ><?php echo $row[2] ?></td>
<td ><?php echo $row[3] ?></td>
<td ><?php echo $row[4] ?></td>
