<?php
include("include/conFig.php");
$table = $_GET['table'];
$field = $_GET['field'];
$value = $_GET['value'];


$tab = explode("::",$table);
$expid=0;
if(sizeof($tab)>0)
{
    $table=$tab[0];
    $expid=$tab[1];
}

$chkData = mysql_query("SELECT `$field` FROM `$table` WHERE `$field` = '$value' AND `delete` = '0' AND id!=$expid",$con) or die(mysql_error());
if(mysql_num_rows($chkData) > 0)
{
if($field == 'password' && $table == 'employee')
{
echo "<span style='color:#069;font-weight:bold'></span>";
}
else
{
echo "<span style='color:#b82121;font-weight:bold'>Duplicate Entry!!</span>";
}

}

?>
