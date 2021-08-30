<?php session_start();
session_destroy();
include('include/connection.php');
date_default_timezone_set('Asia/Calcutta');
$datetime = date("Y-m-d H:i:s");
$date = date("Y-m-d");
$expire= time() - 60 ;
$userlogid = $_COOKIE['huserlogid'];
$loggeduserid = $_COOKIE['hrmloggeduserid'];
	mysql_query("UPDATE `login` SET `logout`='1' WHERE `userid` = '$loggeduserid'",$con) or die(mysql_error());

mysql_query("UPDATE `userlog` SET `logout`='$datetime' WHERE  `id` = '$userlogid' ",$con) or die(mysql_error());
setcookie("hrmloggeduserid","",$expire,"/");
setcookie("hrmloggedname","",$expire,"/");
setcookie("hrmrole","",$expire,"/");
setcookie("userlogid","",$expire,"/");
header("location:index.php");
?>