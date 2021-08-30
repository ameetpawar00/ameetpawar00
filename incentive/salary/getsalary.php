<?php
include("../../include/conFig.php");
$id=$_GET["id"];
/*
echo "SELECT salary.gross,employee.referredby FROM salary,employee WHERE salary.eid = '$id' AND salary.delete = '0' AND employee.delete = '0' LIMIT 1";
$result = mysql_query("SELECT salary.gross,employee.referredby FROM salary,employee WHERE salary.eid = '$id'  AND salary.delete = '0' AND employee.delete = '0'",$con) or die(mysql_error());
$row = mysql_fetch_array($result);
*/


$getR = mysql_query("SELECT `id` FROM `employee` WHERE `referredby` = '$id'",$con)or die(mysql_error());
$count= mysql_num_rows($getR);
$getG = mysql_query("SELECT `gross` FROM `salary` WHERE `eid`='$id'",$con)or die(mysql_error());
$fetchG = mysql_fetch_array($getG);

 $gross = $fetchG[0];

$inc = ($count*$gross)*0.2;

?>
<?php echo $gross."****".$inc;
?>
