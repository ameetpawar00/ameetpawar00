<?php error_reporting(0);
include("include/conFig.php");
$role=$_COOKIE['hrmrole'];
if($role=='0' OR $role=='1' OR $role=='2') {
$getNoti= mysql_query("SELECT * FROM `jobvacancy` WHERE  vacancy!='0' AND `delete` = '0'");
 echo mysql_num_rows($getNoti);
}else{
	echo 0;
}
 ?>
