<?php
include('include/conFig.php');
$value=$_GET['value'];
$table=$_GET['table'];
$column=$_GET['column'];

$sql = "select * from `$table` where `$column`='$value' and  `delete` = '0'";

//echo $sql;
?>
<?php
$getData=mysql_query($sql,$con)or die(mysql_error());
echo '<option value="">-Select-</option>';
while($row =mysql_fetch_array($getData))
{
?>
<option value="<?php echo $row ['id'];?>**<?php echo $row['name'];?>"><?php echo $row['name']?></option>
<?php
}
?>


