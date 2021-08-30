<?php
include("../../include/conFig.php");
$eid = $_GET['eid'];
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("INSERT INTO `dependent`(`id`, `name`, `relationshipid`, `dob`, `eid`, `occupation`, `office`, `mobile`, `createdate`, `updatedby`, `delete`) VALUES ('','$post[0]','$post[1]','$post[2]','$eid','$post[3]','$post[4]','$post[5]','$datetime','$hrmloggedid','0')",$con) or die(mysql_error());
$id = mysql_insert_id();
$getData = mysql_query("SELECT dependent.name,relationship.name,dependent.dob FROM employee,relationship,dependent WHERE employee.id = dependent.eid AND dependent.relationshipid = relationship.id AND dependent.id = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
