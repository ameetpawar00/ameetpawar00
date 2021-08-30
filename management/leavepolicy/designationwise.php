<?php
include("../../include/conFig.php");
$desig = $_GET['desig'];
?>

<?php
$i=1;
$getLeave = mysql_query("select `id`,`name` from `leavetype` where `delete` = '0' and `id` != '1' order by `name`  asc",$con) or die(mysql_error());
while($rowLeave = mysql_fetch_array($getLeave))
{
$chkLeave = mysql_query("SELECT `id`,`value` FROM `leavepolicy` WHERE `leaveid` = '$rowLeave[0]' and `designation` = '$desig' ",$con) or die(mysql_error());
if(mysql_num_rows($chkLeave) > 0 )
{
$chkRow = mysql_fetch_array($chkLeave);
$value = $chkRow[1];
}
else
{
$value = '0';
}
$leaveId = $rowLeave[0];
?>
<tr>
<th ><?php echo $rowLeave[1]?></th>
<td >
<input type="hidden" value="<?php echo $leaveId?>" id="levpo<?php echo  $i?>" title="isNotNull"> 
<input type="text" value="<?php echo $value?>" id="levpo<?php echo  $i=$i+1?>" class="input" style="color:#000" title="isNotNull"> </td>
</tr>
<?php
$i++;
}
?>
<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('management/leavepolicy/save','levpo','<?php echo $i?>','<?php echo $i?>','','couResp','1');getModule('management/leavepolicy/view','viewContent','manipulateContent','Leave Policy')"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>

<!--
<tr><td colspan="2"  style="text-align:center">
<div class="blue awesome small" onclick="SaveData('management/leavepolicy/save','levpo','<?php echo $i?>','','','couResp','1')">Save</div>
<div class="btn btn-warning" onclick="document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';ToggleBox('bigMoodle','none','')">Cancel</div>
</td></tr>
-->
