<?php
include("../include/conFig.php");
$id = base64_decode($_POST['id']);
$action = $_POST['action'];
$getData = mysql_query("SELECT allotleave.id,allotleave.leave,allotleave.modifieddate,designation.name,leavetype.name,allotleave.designation FROM allotleave,designation,leavetype WHERE allotleave.delete = '0' AND  allotleave.leavetype = leavetype.id and allotleave.designation= designation.id AND allotleave.id = '$id'",$con) or die(mysql_error());
$fetchData = mysql_fetch_array($getData);
$eid = $fetchData['eid'];

if($action == "edit")
{
?>
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $id;?>"></td>
<td style="color:#000">
<select class="input drop-down large" name="req" title="isNotNull" id="eallot<?php echo $id?>0" style="width:200px">
				<option value="">Select Designation</option>
<?php
$getRel = mysql_query("SELECT `id`,`name` FROM `designation` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowRel = mysql_fetch_array($getRel))
{
?>				
				<option <?php if($rowRel[0] == $fetchData[5]) {echo "selected=selected";}?> value="<?php echo $rowRel[0]?>"><?php echo $rowRel[1]?></option>
<?php
}
?>				
			</select>
</td>
<td style="color:#000">
<?php echo $fetchData[4]?></td>
<td style="color:#000;"><input class="input medium" name="req" title="isNotNull" id="eallot<?php echo $id?>1" style="width:200px" type="text" value="<?php echo $fetchData[1]?>" ></td>
<td style="color:#000;"><?php echo date('d-M-Y h:i:s',strtotime($fetchData[2])) ?></td>
<td>
<img src="img/icons/icons11.png" title="Update" height="20" width="20" onclick="SaveData('allotleave/update?id=<?php echo $id;?>&i=<?php echo $i;?>','eallot<?php echo $id?>','2','','','couResp','2')">&nbsp;&nbsp;&nbsp;&nbsp;
<img src="img/icons/icons25.png" title="Cancel" height="20" width="20" onclick="editDynamic('allotleave/edit.php','<?php echo base64_encode($fetchData[0])?>','<?php echo $_POST['rowid']?>','')">
</td>
<?php
}
else
{
?>
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $id;?>" /></td>
<td style="color:#000;" ><?php echo $fetchData[3] ?></td>
<td style="color:#000;" ><?php echo $fetchData[4] ?></td>
<td style="color:#000;"><?php echo $fetchData[1]?></td>
<td style="color:#000;"><?php echo date('d-M-Y h:i:s',strtotime($fetchData[2])) ?></td>
<td>
<img src="img/icons/icons15.png" title="Edit " height="20" width="17" onclick="editDynamic('allotleave/edit.php','<?php echo base64_encode($fetchData[0])?>','<?php echo $_POST['rowid']?>','edit')"/>&nbsp;&nbsp;&nbsp;&nbsp;
<img src="img/icons/icons4.png" title="Delete" height="20" width="13" onclick="deleteSingle('<?php echo $fetchData[0]?>','fetchrow<?php echo $i?>','allotleave')"/>
</td>
<?php
}

?>
