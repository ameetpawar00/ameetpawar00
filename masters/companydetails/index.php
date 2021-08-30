<?php
include("../../include/conFig.php");
?>
<div class="title">Company Details</div>
<div class="strip">
<span>Dashboard</span>
<span>Company Details</span>
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
Company Details</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td width="175px" style="height: 26px">Company Name<span>*</span>
	</td>
	<td style="height: 26px"><input class="input medium"  name="req" type="text" id="cmp0" >
	</td>
		<td>Email <span>*</span>
	</td>
	<td><input class="input medium" name="req" type="text" id="cmp1" >
	</td>

</tr>
<tr>
	<td valign="top">Address<span>*</span>
	</td>
	<td style="height: 26px"><textarea class="input huge" name="TextArea" type="" id="cmp2"> </textarea>
	</td>
	<td>Logo</td>
	<td><iframe src="masters/companydetails/doucuments/index.php?id=cmp8" frameborder="0" scrolling="no" height="80px" width="300px"></iframe>
	<input type="hidden" value="" id="cmp8"/>
	</td>
</tr>
<tr>
<td>State</td>
	<td>

<select class="input drop-down large" name="Select1" style="width: 200px" id="cmp3" onchange="getModule('masters/companydetails/getCity?id=cmp4&cmp3='+this.value,'getCity','',document.title)">
	<option value="">Select State</option>			
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `state` WHERE `delete` = '0'",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php
}
?>
			</select>&nbsp;&nbsp;&nbsp;&nbsp;
			
</td>
<td>
City
</td>
<td>
<span id="getCity" style="display:inline">
<select class="input drop-down large" name="Select1" id="cmp4">
				<option value="1">Select State First</option>
			</select>
</span>

</td>

</tr>
<tr>
<td>Pin code<span>*</span>
	</td>
		<td><input class="input medium" name="" id="cmp5" type="text"></td>
<td>Pan Name<span>*</span>
	</td>
		<td><input class="input medium" name="" id="cmp6" type="text"></td>
		<td></td>

</tr>
<tr>
	<td valign="top">Foot Note
	</td>
	<td><textarea class="input huge" id="cmp7" name="TextArea" cols="20" rows="2"></textarea>
	</td>
</tr>
<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('masters/companydetails/save','cmp','9','','','couResp','1');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr></table>
</div>
<br/>




</div>

