<?php
include("../../include/conFig.php");
$desig = $_POST['designation'];
$from = $_POST['from'];
$to = $_POST['to'];
$id = $_GET['id'];
$kpi = $_POST['kpi'];
$sql = "select `id` from `incentivekpi` where `delete` = '0' and `designation` = '$desig' and `from` = '$from'  and `to` = '$to' and `kpiid` = '$kpi'";
$getChek = mysql_query($sql,$con) or(die(mysql_error()));
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