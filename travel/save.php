<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("INSERT INTO `travel` (`eid`, `deptid`, `place`, `purpose`, `departuredate`, `arrivaldate`, `days`, `customer`, `billable`, `createdate`, `updatedby`,`users`) VALUES ('$post[0]', '$post[1]', '$post[2]', '$post[3]', '$post[4]', '$post[5]', '$post[6]', '$post[7]', '$post[8]', '$datetime', '$hrmloggedid', '$post[9]')",$con) or die(mysql_error());
$id = mysql_insert_id();
$getData = mysql_query("SELECT travel.id,employee.name,department.name,travel.place,travel.purpose FROM employee,travel,department WHERE employee.id = travel.eid AND department.id = travel.deptid AND travel.id = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);

?>

<div class="success warnings">
Travel Saved Successfully</div>
BREAKSTRINGFORSAVEDATA
<td><input id="chBxPUTGENERATEDIHEREINNS" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
<td class="link-blue" onclick="getModule('travel/edit?id=<?php echo $row[0]?>&i=PUTGENERATEDIHERE','manipulateContent','viewContent','taining')">
<?php echo $row[1] ?></td>
<td ><?php echo $row[2] ?></td>
<td ><?php echo $row[3] ?></td>
<td ><?php echo $row[4] ?></td>