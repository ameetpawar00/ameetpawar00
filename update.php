<?php error_reporting(0);
include("include/conFig.php");
 $id=$_GET['id'];
  $getNoti= mysql_query("UPDATE  `jobvacancy` SET `seen` = '1' WHERE id  = '$id' ") or die(mysql_error());
 echo $num_rows= mysql_num_rows($getNoti);
 
 ?>
