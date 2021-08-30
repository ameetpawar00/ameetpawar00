<?php
include("../include/conFig.php");

$getData = mysql_query("SELECT `password` FROM `employee` WHERE `id` = '$hrmloggedid'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>

<div class="title">Change Password</div>
<div class="strip">
<span>Dashboard</span>
<span>Change Password</span>
</div>
<div class="add-new blue-border">
<div class="form-head blue">
<div class="head-title"> 

<i class="add-form"></i> 
Change Password</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%" align="center">
<tr>


	<td width="175px" style="height: 26px">Enter Current Password <span>*</span>
	</td>
	<td style="display:; height: 26px;"><input class="input medium" type="password" id="pswd" value="" onblur="chkcurpswd(this.value,'oldp','msg')" ><input type="hidden" id="oldp" value="<?php echo $row[0]?>"><span id="msg" style="width:120px;color:red;"></span></td>
	<!--<td style="height: 26px"><input class="input medium"  name="req" type="text" id="emp2" value="" onblur="chkcurpswd('pswd','emp2','msg')" style="float:left">
	</td>-->

	
</tr><tr>


	<td width="175px" style="height: 26px">Enter New Password <span>*</span>
	</td>
	<td style="height: 26px"><input class="input medium"  name="req" type="password" id="emp0" value="" onblur="chkpswd('emp0','emp1','right','wrong')" style="float:left">
	</td>

	
</tr>
<tr>
	<td>Conform New Password <span>*</span>
	</td>
	<td><input class="input medium"  name="req" type="password" id="emp1" value="" onblur="chkpswd('emp0','emp1','right','wrong')" style="float:left"><div id="right" style="display:none;float:left"><img src="images/right.png" width="20px"></div><div id="wrong" style="display:none;float:left"><img src="images/wrong.png" width="20px" title="Password doesn't match"></div>
	</td>
</tr>
<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('settings/save?id=<?php echo $hrmloggedid ?>','emp','3','','','couResp','2');chkvalue('emp0','emp1')"><i class="save-icon"></i>Change</button>
<button class="button gray" onclick="document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';ToggleBox('bigMoodle','none','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>
</table>
</div>