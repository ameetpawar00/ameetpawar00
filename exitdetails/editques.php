<?php
include("../include/conFig.php");
$id = base64_decode($_POST['id']);
$action = $_POST['action'];
$getData = mysql_query("SELECT seperationquestion.id,exitquestions.name,seperationquestion.answer FROM seperationquestion,exitquestions WHERE seperationquestion.quesid = exitquestions.id AND seperationquestion.delete = '0' AND seperationquestion.id = '$id'",$con) or die(mysql_error());
$fetchData = mysql_fetch_array($getData);
$eid = $fetchData['eid'];

if($action == "edit")
{
?>
<td style="color:#000;">
<textarea name="req" title="isNotNull" readonly="readonly" style="width:300px" type="text"><?php echo $fetchData[1]?></textarea>
</td>
<td style="color:#000;">
<textarea name="req" title="isNotNull" id="eques<?php echo $id?>0" style="width:300px" type="text"><?php echo $fetchData[2]?></textarea>
</td>
<td>
<img src="img/icons/icons11.png" title="Update" height="20" width="17" onclick="SaveData('exitdetails/updateques?id=<?php echo $id;?>&i=<?php echo $i;?>','eques<?php echo $id?>','1','','','couResp','2')" />&nbsp;&nbsp;&nbsp;&nbsp;
<img src="img/icons/icons25.png" title="Cancel" height="20" width="13" onclick="editDynamic('exitdetails/editques.php','<?php echo base64_encode($fetchData[0])?>','<?php echo $_POST['rowid']?>','')"/>
</td>
<?php
}
else
{
?>
<td style="color:#000;width:350px"><?php echo substr($fetchData[1],0,75);?></td>
<td style="color:#000;width:350px"><?php echo substr($fetchData[2],0,75);?></td>
<td>
<img src="img/icons/icons15.png" title="Edit Questionairre" height="20" width="17" onclick="editDynamic('exitdetails/editques.php','<?php echo base64_encode($fetchData[0])?>','<?php echo $_POST['rowid']?>','edit')" />&nbsp;&nbsp;&nbsp;&nbsp;
<img src="img/icons/icons4.png" title="Delete Questionairre" height="20" width="13" onclick="deleteSingle('<?php echo $fetchData[0]?>','fetchrow<?php echo $i?>','seperationquestion')"/>
</td>
<?php
}

?>
