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
if($id == "")
{
$insertSql = "INSERT INTO `incentiveattendance`(`from`, `to`, `action`, `value`, `type`, `createdate`, `modifieddate`, `updatedby`, `status`,  `designation`) VALUES ('$post[2]','$post[3]','$post[1]','$post[5]','$post[4]','$datetime','$datetime','$hrmloggedid','1','$post[0]')";
mysql_query($insertSql,$con) or die(mysql_error());
$id = mysql_insert_id();
$getData = mysql_query("select incentiveattendance.id,incentiveattendance.from,incentiveattendance.to,incentiveattendance.action,incentiveattendance.type,incentiveattendance.value,incentiveattendance.status,designation.name from designation,incentiveattendance WHERE incentiveattendance.designation = designation.id AND incentiveattendance.id = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
<div class="success warnings">
Attendance Incentive Saved Successfully</div>
BREAKSTRINGFORSAVEDATA
<td><input id="chBxPUTGENERATEDIHEREINNS" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
<td class="link-blue"  onclick="getModule('incentive/attendance/index?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Attendace Incentive')"><?php echo $row[7]; ?></td>
<td><?php echo $row[1];?></td>
<td><?php echo $row[2];?></td>
<td>
<?php 
if($row[3] == "1")
{
echo "Add";
}
elseif($row[3] == "2")
{
echo "Deduct";
}
?></td>
<td>
<?php 
if($row[4] == "1")
{
echo "Flat";
$valueSymbl = "RS";
}
elseif($row[4] == "2")
{
echo "Percent";
$valueSymbl = "%";
}
?>
</td>
<td><?php echo $row[5]." ".$valueSymbl;?></td>
<td>
<center>
<div style="width:60px" id="invAt<?php echo $row[0]?>" onclick="changeStatus('status','incentiveattendance','<?php echo $row[0]?>','invAt')" <?php if($row[6] == '1') {echo 'class = "button green"';} else {echo 'class ="button red"';}?>   ><?php if($row[6] == '1') {echo 'Applicable';} else {echo 'Not Now';}?></div>
</center></td>
<?php
}
else
{
$insertSql = "UPDATE `incentiveattendance` SET `from`='$post[2]',`to`='$post[3]',`action`='$post[1]',`value`='$post[5]',`type`='$post[4]',`modifieddate`='$datetime',`updatedby`='$hrmloggedid',`designation`='$post[0]' WHERE `id` = '$id'";
mysql_query($insertSql,$con) or die(mysql_error());
$getData = mysql_query("select incentiveattendance.id,incentiveattendance.from,incentiveattendance.to,incentiveattendance.action,incentiveattendance.type,incentiveattendance.value,incentiveattendance.status,designation.name from designation,incentiveattendance WHERE incentiveattendance.designation = designation.id AND incentiveattendance.id = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
<div class="success warnings">
Attendance Incentive Saved Successfully</div>
BREAKSTRINGFORSAVEDATA
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $id;?>"></td>
<td class="link-blue"  onclick="getModule('incentive/attendance/index?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Attendace Incentive')"><?php echo $row[7]; ?></td>
<td><?php echo $row[1];?></td>
<td><?php echo $row[2];?></td>
<td>
<?php 
if($row[3] == "1")
{
echo "Add";
}
elseif($row[3] == "2")
{
echo "Deduct";
}
?></td>
<td>
<?php 
if($row[4] == "1")
{
echo "Flat";
$valueSymbl = "RS";
}
elseif($row[4] == "2")
{
echo "Percent";
$valueSymbl = "%";
}
?>
</td>
<td><?php echo $row[5]." ".$valueSymbl;?></td>
<td>
<center>
<div style="width:60px" id="invAt<?php echo $row[0]?>" onclick="changeStatus('status','incentiveattendance','<?php echo $row[0]?>','invAt')" <?php if($row[6] == '1') {echo 

'class = "button green"';} else {echo 'class ="button red"';}?>   ><?php if($row[6] == '1') {echo 'Applicable';} else {echo 'Not Now';}?></div>
</center></td>

<?php
}
?>
