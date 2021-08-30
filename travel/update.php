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
mysql_query("UPDATE `travel` SET `eid`='$post[0]',`deptid`='$post[1]',`place`='$post[2]',`purpose`='$post[3]',`departuredate`='$post[4]',`arrivaldate`='$post[5]',`days`='$post[6]',`customer`='$post[7]',`billable`='$post[8]', `updatedate` = '$datetime', `updatedby`  = '$hrmloggedid', `users` = '$post[9]' WHERE `id` = '$id'",$con) or die(mysql_error());
$getData = mysql_query("SELECT travel.id,employee.name,department.name,travel.place,travel.purpose FROM employee,travel,department WHERE employee.id = travel.eid AND department.id = travel.deptid AND travel.id = '$id'",$con) or die(mysql_error());
$row=mysql_fetch_array($getData);
?>

<div class="success warnings">
Travel Updated Successfully</div>
BREAKSTRINGFORSAVEDATA
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $id;?>"></td>
<td class="link-blue" onclick="getModule('travel/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Travel')">
<?php echo $row[1] ?></td>
<td ><?php echo $row[2] ?></td>
<td ><?php echo $row[3] ?></td>
<td ><?php echo $row[4] ?></td>



<!--<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" /></td>
<td style="color:#000;width:200px" ><?php echo $row[1] ?></td>
<td style="color:#000;width:200px" ><?php echo $row[2] ?></td>
<td style="color:#000;width:200px" ><?php echo $row[3] ?></td>
<td style="color:#000;width:200px" ><?php echo $row[4] ?></td>
<td>
<img src="img/icons/icons15.png" title="Edit Source <?php echo $row['name']?>" height="20" width="20" onclick="getModule('travel/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Assets')"/>&nbsp;&nbsp;&nbsp;&nbsp;
<img src="img/icons/icons4.png" title="Delete Source <?php echo $row['name']?>" height="20" width="20" onclick="deleteSingle('<?php echo $row[0]?>','fetchrow<?php echo $i?>','travel')"/>

</td>
BREAKSTRINGFORSAVEDATA
<div class="sucessResp">
Travel Updated Successfully</div>-->

