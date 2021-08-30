<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
//$i = $_GET['i'];
$id = $_GET['id'];
$employeeid = $_GET['employeeid'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("UPDATE `leaverecord` SET `EL`='$post[3]', `1QEL`='$post[4]', `2QEL`='$post[5]', `3QEL`='$post[6]', `4QEL`='$post[7]', `M`='$post[1]', `special`='$post[0]', `CL`='$post[8]', `1QCL`='$post[9]', `2QCL`='$post[10]', `3QCL`='$post[11]', `4QCL`='$post[12]', `SL`='$post[13]', `1QSL`='$post[14]', `2QSL`='$post[15]', `3QSL`='$post[16]', `4QSL`='$post[17]', `P`='$post[2]', `modifiededate`='$datetime', `updatedby`='$hrmloggedid' WHERE `id`='$id' AND `userid`='$employeeid'",$con) or die(mysql_error());
mysql_query("UPDATE `employee` SET `l_allotstatus`='1' WHERE `id` = '$employeeid'",$con) or die(mysql_error());
mysql_query("UPDATE `leaverecord_yearly` SET `ALL`='$post[18]', `1`='$post[19]', `2`='$post[20]', `3`='$post[21]', `4`='$post[22]', `5`='$post[23]', `6`='$post[24]', `7`='$post[25]', `8`='$post[26]', `9`='$post[27]', `10`='$post[28]', `11`='$post[29]', `12`='$post[30]', `modifiededate`='$datetime', `updatedby`='$hrmloggedid' WHERE `userid`='$employeeid'",$con) or die(mysql_error());

?>