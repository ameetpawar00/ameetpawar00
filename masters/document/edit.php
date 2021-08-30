<?php
include("../../include/conFig.php");
$id = $_GET['id'];
$i = $_GET['i'];

//echo "SELECT * FROM `location` WHERE `id` = '$id'";
$getData = mysql_query("SELECT * FROM `document` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
<div class="title">Document</div>
<div class="strip">
<span>Dashboard</span>
<span>Document</span>
<span>Edit Document</span>
</div>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"> <i class="back"></i>Back</button>&nbsp;&nbsp;
</td>
</tr>
</table>

<div style="overflow-x:hidden;overflow-y:scroll;height:500px">
<div class="add-new blue-border">
<div class="form-head blue">
<div class="head-title"> 
<i class="add-form"></i> 
Edit Document</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>
<tr>
<th>Name <span>*</span></th>
<td><input name="req" class="input medium" data-original-title="first tooltip" type="text" value="<?php echo $row['name']?>" style="width:240px;" id="doc0">
</td>
</tr>
<tr>
<th>Type <span>*</span></th>
<td>

<select class="input drop-down large" name="req" id="doc1">
				<option value="">Select Type</option>
<?php
$getDoc = mysql_query("SELECT `id`,`type` FROM `document` WHERE `delete`= '0'",$con) or die(mysql_error());
while($rowDoc = mysql_fetch_array($getDoc))
{
?>				
				<option <?php if($rowDoc[1] == $row['type']) echo "selected='selected'"; ?> value="<?php echo $rowDoc[0]?>">
<?php if($rowDoc['type']==1) {echo 'Image';}?>
<?php if($rowDoc['type']==2) {echo 'Doc';}?>
<?php if($rowDoc['type']==3) {echo 'Excel';}?>
<?php if($rowDoc['type']==4) {echo 'Pdf';}?>
<?php if($rowDoc['type']==5) {echo 'Csv';}?>
<?php if($rowDoc['type']==6) {echo 'Text';}?>

				</option>
<?php
}
?>				
			</select>

 </td>
</tr>

<tr><th>Description</th>
<td><textarea class="input-huge" name="" cols="20" rows="2" class="input" style="width:48%;height:100px;" id="doc2"><?php echo $row['description']?></textarea>
</td>
</tr>
<tr>
<td colspan="4" style="text-align:center">

<button class="button green" onclick="SaveData('masters/document/update?id=<?php echo $id;?>&i=<?php echo $i;?>','doc','3','<?php echo $i;?>','','couResp','2');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i>Update</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>

</table>
	</div>
</div>


