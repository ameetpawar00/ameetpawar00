<?php
include("../../include/conFig.php");$id = base64_decode($_POST['id']);
$action = $_POST['action'];
$getData = mysql_query("SELECT workexperience.id,workexperience.precompany,workexperience.jobtitle,workexperience.fromdate,workexperience.todate,workexperience.jobdesc,employee.id FROM employee,workexperience WHERE employee.id = workexperience.eid AND workexperience.delete = '0' AND workexperience.id = '$id'",$con) or die(mysql_error());
$fetchData = mysql_fetch_array($getData);
$eid = $fetchData['eid'];

if($action == "edit")
{
?>
<td>
<input class="input" name="req" title="isNotNull" id="eexp<?php echo $id?>0" style="width:100px" type="text" value="<?php echo $fetchData[1]?>" />
</td>
<td style="color:#000">
<input class="input" name="req" title="isNotNull" id="eexp<?php echo $id?>1" style="width:100px" type="text" value="<?php echo $fetchData[2]?>" />
</td>
<td style="color:#000">
<input class="input" name="" title="isNotNull" id="eexp<?php echo $id?>2" type="" readonly="readonly" class="inputCalendar" style="width:100px" onclick="openCalendar(this);" value="<?php echo $fetchData[3]?>"/>
</td>
<td style="color:#000">
<input class="input" name="" title="isNotNull" id="eexp<?php echo $id?>3" type="" readonly="readonly" class="inputCalendar" style="width:100px" onclick="openCalendar(this);" value="<?php echo $fetchData[4]?>"/>
</td>
<td>
<textarea class="input" name="req" title="isNotNull" id="eexp<?php echo $id?>4" style="width:150px" type="text"><?php echo $fetchData[5]?></textarea>
</td>
<td>
<img src="img/icons/icons11.png" title="Update" height="20" width="17" onclick="SaveData('employee/workexperience/updateexp?id=<?php echo $id;?>&i=<?php echo $i;?>','eexp<?php echo $id?>','5','','','couResp','2')" />&nbsp;&nbsp;&nbsp;&nbsp;
<img src="img/icons/icons25.png" title="Cancel" height="20" width="13" onclick="editDynamic('employee/workexperience/editexp.php','<?php echo base64_encode($fetchData[0])?>','<?php echo $_POST['rowid']?>','')"/>
</td>
<?php
}
else
{
?>
<td style="color:#000;width:120px"><?php echo $fetchData[1]?></td>
<td style="color:#000;width:120px"><?php echo $fetchData[2]?></td>
<td style="color:#000;width:120px"><?php echo $fetchData[3]?></td>
<td style="color:#000;width:120px"><?php echo $fetchData[4]?></td>
<td style="color:#000;width:180px"><?php echo substr($fetchData[5],0,50)?></td>
<td>
<img src="img/icons/icons15.png" title="Edit Work Experience" height="20" width="17" onclick="editDynamic('employee/workexperience/editexp.php','<?php echo base64_encode($fetchData[0])?>','<?php echo $_POST['rowid']?>','edit')" />&nbsp;&nbsp;&nbsp;&nbsp;
<img src="img/icons/icons4.png" title="Delete Work Experience" height="20" width="13" onclick="deleteSingle('<?php echo $fetchData[0]?>','fetchrow<?php echo $i?>','workexperience')"/>

</td>

<?php
}

?>
