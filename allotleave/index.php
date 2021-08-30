<?php
include("../include/conFig.php");
?>


<div class="title">Leave Allot</div>
<div class="strip">
<span>Dashboard</span>
<span>Leave Allot </span>
<span>Add New</span>
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
<div class="add-new green-border">
<div class="form-head green">
<div class="head-title"> 
<i class="add-form"></i> 
Add Leave Allot</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>
<!--
<ul class="breadcrumb">
	<li><a href="#">Home</a><span class="divider">&raquo;</span></li>
	<li class="active"  onclick="getModule('allotleave/view','viewContent','manipulateContent','Allot Leave')">Leave Allot</li>
	<div class="red awesome small" onclick="getModule('allotleave/view','viewContent','manipulateContent','Allot Leave')" style="float:right">Back </div>

</ul>
<div class="nonboxy-widget">
	<div class="widget-head">
		<h5>Allot Leave</h5>
	</div>
</div>
<div class="widget-content">
	<div class="widget-box">
	<table width="100%" cellpadding="10" cellspacing="0" class="form-horizontal well formtable">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>-->

<tr>
<th>Designation *</th>
<td><select class="input drop-down large" name="req" id="allotleave0" class="input">
				<option value="">Select Designation</option>
				<?php
				$getData=mysql_query("select `name`,`id` from `designation` where `delete` = '0' and `id` != '1'",$con)or die(mysql_error());
				while($rowData=mysql_fetch_array($getData))
				{
				?>
				<option value="<?php echo $rowData[1]?>"><?php echo $rowData[0]?></option>
				<?php
				}
				?>
			</select>
</td>
</tr>
<?php
$i=1;
$getEx = mysql_query("select `name`,`id` from `leavetype` where `delete` = '0' and `id` != '1'  ",$con);
while($fetchEx = mysql_fetch_array($getEx))
{
$ids .= "***".$fetchEx['id'];
?>

<tr><th><?php echo $fetchEx['name']?></th> 
<td><input name="Text1" type="text" class="input medium"  id="altlev<?php echo $i?>" onkeypress="return chkNumbers(event);" onblur="texttotext('altlev','totalvalues','totali')" > 
</td>
</tr>
<?php
$i++;
}
?>
<input class="input medium" name="Text1" type="hidden" id="totalids" value="<?php echo $ids?>" >
<input class="input medium" name="Text1" type="hidden" id="totalvalues">
<input class="input medium" type="hidden" id="totali" value="<?php echo $i?>" >

<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('allotleave/save?totalids='+document.getElementById('totalids').value+'&totalvalues='+document.getElementById('totalvalues').value,'allotleave','2','','','couResp','1');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>

<!--
<tr><td></td><td  style="text-align:left"><div class="blue awesome small" onclick="SaveData('allotleave/save?totalids='+document.getElementById('totalids').value+'&totalvalues='+document.getElementById('totalvalues').value,'allotleave','2','','','couResp','1')">Save </div>
<div class="btn btn-warning" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')">Cancel</div>
</td></tr>-->
</table>
	</div>
</div>


