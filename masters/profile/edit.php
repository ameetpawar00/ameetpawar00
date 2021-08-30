<?php
include("../../include/conFig.php");
$id = $_GET['id'];
echo "SELECT * FROM `branch` WHERE `id` = '$id'";
$getData = mysql_query("SELECT * FROM `branch` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
 
<ul class="breadcrumb">
	<li><a href="#">Home</a><span class="divider">&raquo;</span></li>
	<li class="active"  onclick="getModule('masters/branch/view','viewContent','manipulateContent','Branch')">Branch</li>
	<div class="red awesome small" onclick="getModule('masters/branch/view','viewContent','manipulateContent','Branch')" style="float:right">Back To Branch</div>

</ul>
<div class="nonboxy-widget">
	<div class="widget-head">
		<h5>Edit Branch</h5>
	</div>
</div>
<div class="widget-content">
	<div class="widget-box">
	<table width="100%" cellpadding="10" cellspacing="0" class="form-horizontal well formtable">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>

<tr>
<th>Name <span>*</span></th>
<td><input name="req" class="input-xlarge text-tip" data-original-title="first tooltip" type="text" value="<?php echo $row['name']?>" style="width:240px;" id="hrmp0"  />
</td>
</tr>
<tr><th>Description</th>
<td><textarea name="" cols="20" rows="2" class="input" style="width:48%;height:100px;" id="hrmp1"><?php echo $row['description']?></textarea>
</td>
</tr>
<tr><td></td><td  style="text-align:left"><div class="blue awesome small" onclick="SaveData('masters/branch/update?id=<?php echo $id;?>&i=<?php echo $i;?>','hrmp','2','','','','2')">Update Branch</div>
<div class="btn btn-warning" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')">Cancel</div>
</td></tr>
</table>
	</div>
</div>


