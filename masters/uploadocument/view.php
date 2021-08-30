
<?php
include("../../include/conFig.php");
error_reporting(0);
$sql = "SELECT * FROM `uploadocument` WHERE `delete` = '0' ";
$getData = mysql_query($sql,$con) or die(mysql_error());
$row = mysql_fetch_array($getData);

$Num_Rows = mysql_num_rows($getData);
	$Per_Page = 25;   // Per Page
	include('../../pagination/pagination.php');
	$folder= 'masters/uploadocument/view';
	$title = 'Upload Document';

?>
<div id="myTitle">
<div class="title">Upload Policy</div>
<div class="strip">
<span>Dashboard</span>
<span>Upload Policy</span>
<span>View</span>
</div>
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
Upload Policy</div>
</div>

<div style="height:350px;overflow:auto" id="mainDivId">
<table cellpadding="0" cellspacing="0" width="100%" align="center">
<tr>
<th width="50%" style="float:; height: 43px;">Select Type<span>*</span></th>
<td width="50%" style="height: " ><select class="input drop-down large" name="" id="per0" style="width: 300px" onchange="changediv('per0','des','upl','cmp2')">
		<option value="">Please Select </option>
		<option value="1">Upload Company Policy</option>
		<option value="2">Add Company Policy</option>
			</select></td>
			<td width="20%" style="height: 43px"> &nbsp;&nbsp;&nbsp;</td>
</tr>
<tr id="des" style="display:none"  >
<th width="50%" style="float:" >Type Description </th>
<td width="30%" style="float:" ><textarea class="input huge" name="req" type="" id="cmp0"><?php echo $row['description']?> </textarea>
</td>
</tr>
<tr id="upl" style="display:none"  >
<th width="50%" style="float:" >Upload File</th>
<td width="30%" style="float:" ><iframe src="masters/uploadocument/doucuments/index.php?id=cmp0" frameborder="0" scrolling="no" height="80px" width="300px"></iframe>
	<input type="hidden" value="" name="" id="cmp1"/>
</td>
</tr>
<tr>
<td><input type="hidden" value="" id="cmp2"></td><td></td></tr>
<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('masters/uploadocument/save','cmp','3','','','couResp','1');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>
<tr style="display:none">
<td colspan="2">
<div id="policy" >
		</div>
</td>
</tr>
</table></div>
</div>
</div>
