<?php
include("../../include/conFig.php");
$id = base64_decode($_POST['id']);
$action = $_POST['action'];
$getData = mysql_query("SELECT dependent.id,dependent.name,relationship.name,dependent.dob,dependent.relationshipid,dependent.eid FROM employee,relationship,dependent WHERE employee.id = dependent.eid AND dependent.relationshipid = relationship.id AND dependent.delete = '0' AND dependent.id = '$id'",$con) or die(mysql_error());
$fetchData = mysql_fetch_array($getData);
$eid = $fetchData['eid'];

if($action == "edit")
{
?>
<td style="color:#000;"><input class="input medium" name="req" title="isNotNull" id="edepen<?php echo $id?>0" style="width:150px" type="text" value="<?php echo $fetchData[1]?>" /></td>
<td style="color:#000">
<select class="input drop-down medium" name="req" title="isNotNull" id="edepen<?php echo $id?>1" style="width:150px">
				<option value="">Select Relationship</option>
<?php
$getRel = mysql_query("SELECT `id`,`name` FROM `relationship` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowRel = mysql_fetch_array($getRel))
{
?>				
				<option <?php if($rowRel[0] == $fetchData[4]) {echo "selected=selected";}?> value="<?php echo $rowRel[0]?>"><?php echo $rowRel[1]?></option>
<?php
}
?>				
			</select>
</td>
<td style="color:#000"><input name="" title="isNotNull" id="edepen<?php echo $id?>2" type="" readonly="readonly" class="inputCalendar" style="width:200px"  value="<?php echo $fetchData[3]?>"onclick="openCalender('decalenderid<?php echo $id?>2','edepen<?php echo $id?>2')"/>
			<div class="calender" id="decalenderid<?php echo $id?>2"></div> </td>

<td>
<img src="img/icons/icons11.png" title="Update" height="20" width="17" onclick="SaveData('employee/dependent/updatedepen?id=<?php echo $id;?>&i=<?php echo $i;?>','edepen<?php echo $id?>','3','','','','10')" />&nbsp;&nbsp;&nbsp;&nbsp;
<img src="img/icons/icons25.png" title="Cancel" height="20" width="13" onclick="editDynamic('employee/dependent/editdepen.php','<?php echo base64_encode($fetchData[0])?>','<?php echo $_POST['rowid']?>','')"/>
</td>
<?php
}
else
{
?>
<td style="color:#000;width:200px"><?php echo $fetchData[1]?></td>
<td style="color:#000;width:210px"><?php echo $fetchData[2]?></td>
<td style="color:#000;width:210px"><?php echo $fetchData['dob']?></td>
<td>
<img src="img/icons/icons15.png" title="Edit Dependent <?php echo $fetchData[1]?>" height="20" width="17" onclick="editDynamic('employee/dependent/editdepen.php','<?php echo base64_encode($fetchData[0])?>','<?php echo $_POST['rowid']?>','edit')" />&nbsp;&nbsp;&nbsp;&nbsp;
<img src="img/icons/icons4.png" title="Delete Dependent <?php echo $fetchData[1]?>" height="20" width="13" onclick="deleteSingle('<?php echo $fetchData[0]?>','<?php echo $_POST['rowid']?>','dependent')"/>

</td>

<?php
}

?>
