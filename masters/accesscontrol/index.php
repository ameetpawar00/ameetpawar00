<?php
include("../../include/conFig.php");
?>
 
<div class="title">Access Control</div>
<div class="strip">
<span>Dashboard</span>
<span>Access Control</span>
</div>

<table width="100%" cellspacing="0" cellpadding="0">
<tbody><tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
<button class="button gray" onclick="getModule('masters/index','viewContent','manipulateContent','Setup')"> <i class="back"></i>Back</button>&nbsp;&nbsp;
</td>
</tr>
</tbody></table>

<div style="overflow-x:hidden;overflow-y:scroll;height:500px">
<div class="add-new blue-border">
<div class="form-head blue">
<div class="head-title"> 
<i class="add-form"></i> 
Access Control</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>
<tr></tr>
<tr>
<th>Please Select Profile<span>*</span></th>
<td><select class="input drop-down large" name="req" id="per0" style="width: 300px" onchange="getModule('masters/accesscontrol/permission?id='+this.value,'permission','','Access Control')">
		<option value="">Please Select Profile</option>
		<?php
		$getroll  = mysql_query("SELECT `name`,`id` FROM `rolls` WHERE `delete` = '0' ORDER BY `name` ASC",$con) or die(mysql_error());
		while($row = mysql_fetch_array($getroll))
		{
		?>
		<option value="<?php echo $row[1];?>"><?php echo $row[0];?></option>
		<?php
		}
		?>

			</select></td>
</tr>
<tr>
<td colspan="2">
<div id="permission" >
		</div>
</td>
</tr>
</table>
	</div>
</div>
