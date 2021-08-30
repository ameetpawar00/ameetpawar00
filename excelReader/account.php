                                <?php
error_reporting(0);

include("../include/connection.php");
require_once 'Excel/reader.php';

$name ='';
$pass= '';
    $data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('CP1251');


$data->read('TriFid Sept Salary (1).xls');/////Pass Excel File Name

$data->sheets[0]['numRows'];

$j = 0;
$idj = 0;
$d = 0;
$ddj = 0;
for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++)
{
if($data->sheets[0]['cells'][$i][1] != '')
{

$name = $data->sheets[0]['cells'][$i][2];
echo '<br/>';

$accountNO = $data->sheets[0]['cells'][$i][4];
$getemp = mysql_query("SELECT `id` `name` FROM `employee` WHERE `empid` = '$name'",$con) or die(mysql_error());
$row = mysql_fetch_array($getemp);
$id = $row[0];
echo "UPDATE `accountno`='$accountNO' WHERE `id` = '$id'";
mysql_query("UPDATE `employee` SET `accountno`='$accountNO' WHERE `id` = '$id'") or die(mysql_error());
}
    }
?>
                            