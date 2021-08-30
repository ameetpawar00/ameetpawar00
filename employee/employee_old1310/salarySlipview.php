<?php
include("../include/connection.php");
$salId = $_GET['id'];
//echo "SELECT * FROM  `salaryslip` where `id` = '$salId'";
$getSalary = mysql_query("SELECT * FROM  `salaryslip` where `id` = '$salId'",$con) or die(mysql_error());
$rowSal = mysql_fetch_array($getSalary);
?>
<div style="background:#fff;height:100%;overflow-x:auto;overflow-y:auto;color:#000 !important;" id="mySalslip">

<?php echo $rowSal['slip'];
?>
</div>