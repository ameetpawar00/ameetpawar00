<?php
include("../../include/conFig.php");
$id = $_GET['id'];
$i = $_GET['i'];
$getData = mysql_query("SELECT * FROM `companydetail` WHERE `delete` = '0' AND `id`='$id' ",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
<div class="title">Company Details</div>
<div class="strip">
<span>Dashboard</span>
<span>Company Details</span>
<span>Edit Company Details</span>

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
	<td style="height: 26px"><input class="input medium"  name="req" type="text" id="cmp0" value="<?php echo $row['name'];?>">
	</td>
		<td>Email <span>*</span>
	</td>
	<td><input class="input medium" name="req" type="text" id="cmp1" value="<?php echo $row['email'];?>" >
	</td>

</tr>
<tr>
	<td valign="top">Address<span>*</span>
	</td>
	<td style="height: 26px"><textarea class="input huge" name="TextArea" type="" id="cmp2"> <?php echo $row['address'];?> </textarea>
	</td>
	<td>Logo</td>
	<td><iframe src="masters/companydetails/doucuments/index.php?id=cmp8" frameborder="0" scrolling="no" height="80px" width="300px"></iframe>
	<input type="text" value="" id="cmp8"/>
	</td>
</tr>
<tr>
<td>State</td>
	<td>
<?php
	$cityId = $row['city'];
	$getState = mysql_query("SELECT * FROM `city` WHERE `id` =  '$cityId'",$con) or die(mysql_error());
	$rowState = mysql_fetch_array($getState);
	$state = $rowState['state'];
?>

<select class="input drop-down large" name="Select1" style="width: 200px" id="cmp3" onchange="getModule('masters/companydetails/getCity?id=cmp4&cmp3='+this.value,'getCity','',document.title)">
	<option value="">Select State</option>			
<?php
$getCity = mysql_query("SELECT `name`,`id` FROM `state` WHERE `delete` = '0'",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option <?php if($rowCity[1] == $state) echo "selected='selected';" ?> value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
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
<?php

$getCity = mysql_query("SELECT `name`,`id` FROM `city` WHERE `delete` = '0' and `state` = '$state'",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option <?php if($rowCity[1] == $row['city']) echo "selected='selected'"; ?> value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>

<?php
}
?>
			</select>
</span>

</td>

</tr>
<tr>
<td>Pin code<span>*</span>
	</td>
		<td><input class="input medium" name="" id="cmp5" type="text" value="<?php echo $row['pincode'];?>"></td>
<td>Pan Name<span>*</span>
	</td>
		<td><input class="input medium" name="" id="cmp6" type="text" value="<?php echo $row['panname'];?>"></td>
		<td></td>

</tr>
<tr>
	<td valign="top">Foot Note
	</td>
	<td><textarea class="input huge" id="cmp7" name="TextArea" cols="20" rows="2"> <?php echo $row['footnote'];?> </textarea>
	</td>
</tr>
<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('masters/companydetails/update?id=<?php echo $row[0]?>&i=<?php echo $i?>','cmp','9','','','couResp','2');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr></table>
</div>





</div>


