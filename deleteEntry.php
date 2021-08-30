<?php
include("include/conFig.php");
$dx = $_GET['dx'];
$table = $_GET['table'];
if($table == 'leaverequest'){
	$sql = mysql_query("SELECT `id` FROM `leaverequest` where `id` IN ($dx) AND `status` = '0'",$con);
	while($allVal = mysql_fetch_array($sql)){
		$dx = $allVal[0].",";
	}
	$dx;
	$dx = rtrim($dx,",");
}
$dx = explode(",",$dx);
foreach($dx as $val)
{
mysql_query("UPDATE `$table` SET `delete` = '1' WHERE `id` = '$val'",$con) or die(mysql_error());

    if($table == 'salary_structure_new')
    {
        mysql_query("DELETE FROM `salary_structure_relation_new` WHERE `profileid`='$val'",$con) or die(mysql_error());

    }


}
?>