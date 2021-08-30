<?php
include("../../include/conFig.php");
$id=$_GET['id'];
$i=$_GET['i'];
$getData= mysql_query("select * from `complaints` where `id` = '$id'",$con)or die(mysql_error());
$row=mysql_fetch_array($getData);
?>
<h2 class="title">Edit Complaint
<div class="red awesome small" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" style="float:right">Back To Complaints</div>
</h2>
<div style="background:#fff;height:500px;">
<table width="100%" cellpadding="10" cellspacing="0" class="addNew">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>

<tr>
<th>Name *</th>
<td><input name="req" type="text" class="input" style="width:240px;" id="swsc0" value="<?php echo $row['name']?>"  />
</td>
</tr>
<tr><th>Description</th>
<td><textarea name="" cols="20" rows="2" class="input" style="width:48%;height:100px;" id="swsc1"><?php echo $row['description']?></textarea>
</td>
</tr>
<tr><td colspan="2" style="text-align:center"><div class="teal awesome small" onclick="SaveData('masters/complaints/update?id=<?php echo $id;?>&i=<?php echo $_GET['i'];?>','swsc','2','<?php echo $_GET['i'];?>','','','2')" >
	Update Complaint</div>
<div class="red awesome small" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')">Cancle</div>
</td></tr>
</table>

</div>
