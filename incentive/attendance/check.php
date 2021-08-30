<?php
include("../../include/conFig.php");
$desig = $_POST['designation'];
$from = $_POST['from'];
$to = $_POST['to'];
$id = $_GET['id'];
$getChek = mysql_query("select `id` from `incentiveattendance` where `delete` = '0' and `designation` = '$desig' and `from` = '$from'  and `to` = '$to'",$con) or(die(mysql_error()));
$rowCheck = mysql_fetch_array($getChek); 
if(mysql_num_rows($getChek)> 0 && $rowCheck[0] != $id)
{
//echo "<div class='sucessResp'>Sorry This Period All Ready Exist</div>";
$result = '1';
}
else
{
$result = '0';
}
echo $result;
?>
