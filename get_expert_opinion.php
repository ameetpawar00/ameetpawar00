<?php error_reporting(0);
include("include/conFig.php");
$role=$_COOKIE['hrmrole'];
//if($role=='0') {
$getNoti= mysql_query("SELECT * FROM `jobvacancy` WHERE  vacancy!='0' AND `delete` = '0'");
 echo mysql_num_rows($getNoti);
//}
 ?>
