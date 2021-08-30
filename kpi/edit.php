<?php
include("../include/conFig.php");
$id = base64_decode($_POST['id']);
$action = $_POST['action'];
$ifetch = $_POST['rowid']; 
$i = str_ireplace('fetchrow','',$ifetch); 
$i = trim($i);

$getData = mysql_query("SELECT `name` FROM `employee` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
$eid = $row['eid'];
if($action == "edit")
{
?>
<td>
<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" />
</td>
<td style="color:#000;width:120px"><?php echo $row[0]?></td>
<?php
$getParams = mysql_query("SELECT * FROM `kpiparameters` WHERE `delete` = '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowParams = mysql_fetch_array($getParams))
{
$kpiid = $rowParams['id'];
$default = $rowParams['default'];
$max = $rowParams['maximum']
?>
<td><input type='hidden' id='kpiid' value='<?php echo $kpiid;?>'/><input type='text' id="kpi<?php echo $i;?>" value='<?php echo $default;?>'/></td>
<?php } ?>
<td><img src="img/icons/icons11.png" title="Update" height="20" width="20" onclick="SaveData('kpi/update?id=<?php echo $id;?>&i=<?php echo $i;?>','eedu<?php echo $id?>','5','','','couResp','2')" />&nbsp;&nbsp;&nbsp;&nbsp;
<img src="img/icons/icons25.png" title="Cancel" height="20" width="20" onclick="editDynamic('kpi/edit.php','<?php echo base64_encode($id)?>','<?php echo $_POST['rowid']?>','')"/>
</td>
<?php
}
else
{
?>
<td>
<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" />
</td>
<td style="color:#000;width:120px"><?php echo $row[0]?></td>
<?php
$getParams = mysql_query("SELECT * FROM `kpiparameters` WHERE `delete` = '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowParams = mysql_fetch_array($getParams))
{
$kpiid = $rowParams['id'];
$default = $rowParams['default'];
$max = $rowParams['maximum']
?>
<td><input type='hidden' id='kpiid' value='<?php echo $kpiid;?>'/><input type='text' readonly="readonly" value='<?php echo $default;?>'/></td>
<?php } ?>
<td>
<img src="img/icons/icons15.png" title="Update marks for <?php echo $row[0]?>" height="20" width="20" onclick="editDynamic('kpi/edit.php','<?php echo base64_encode($id)?>','fetchrow<?php echo $i?>','edit')" />&nbsp;&nbsp;&nbsp;&nbsp;

</td>

<?php
}

?>
