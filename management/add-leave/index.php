<?php
include("../../include/conFig.php");
?>


<head>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.autocomplete.js"></script>
<script>
$(document).ready(function(){
 $("#tag").autocomplete("management/add-leave/autocomplete.php", {
		selectFirst: true
	});
});
</script>
<div class="title">Inventory</div>
<div class="strip">
<span>Dashboard</span>
<span>Managment</span>
<span>Inventory</span>
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
<div class="add-new blue-border">
<div class="form-head blue">
<div class="head-title"> 
<i class="add-form"></i> 
Add inventory</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>
 

<tr>
<label>Tag:</label>
    <input name="tag" type="text" id="tag" size="20"/>
</tr>
<tr>
<th>Amount <span>*</span></th>
<td>
<select  class="input drop-down large" id="levpo0" >
	<option value=""> Select LeatveType</option>
	<?php
	$getDesig = mysql_query("select `id`,`name` from `leavetype` where `delete` = '0'  order by `name` asc",$con) or die(mysql_error());
	while($rowDesig = mysql_fetch_array($getDesig))
	{
	?>
	<option  value="<?php echo $rowDesig[0]?>"><?php echo $rowDesig[1]?></option>
	<?php
	}
	?>
	</select>

</td>
</tr>
<tr>
<th>1QSL <span>*</span></th>
<td><input name="req" class="input medium" data-original-title="first tooltip" type="text"  style="width:240px;" id="inv0" >
</tr>
<tr>
<th>2QSL <span>*</span></th>
<td><input name="req" class="input medium" data-original-title="first tooltip" type="text"  style="width:240px;" id="inv0" >
</tr>

<tr>
<th>3QSL <span>*</span></th>
<td><input name="req" class="input medium" data-original-title="first tooltip" type="text"  style="width:240px;" id="inv0" >
</tr>
<tr>
<th>4QSL <span>*</span></th>
<td><input name="req" class="input medium" data-original-title="first tooltip" type="text"  style="width:240px;" id="inv0" >
</tr>

<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('management/inventory/save','inv','5','','','couResp','1');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i>Save Leave</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>

</table>
	</div>
</div>


