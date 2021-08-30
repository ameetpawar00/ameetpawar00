<?php
include("../../include/conFig.php");
?>
<div class="title">Team</div>
<div class="strip">
<span>Dashboard</span>
<span>Team</span>
<span>Add New</span>
</div>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
<button class="button gray" onclick="getModule('masters/team/view','viewContent','manipulateContent','Team')"> <i class="back"></i>Back</button>&nbsp;&nbsp;
</td>
</tr>
</table>

<div style="overflow-x:hidden;overflow-y:scroll;height:500px">
<div class="add-new blue-border">
<div class="form-head blue">
<div class="head-title"> 
<i class="add-form"></i> 
Add Team</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>
<tr>
<th>Team Name<span>*</span></th>
<td><input name="req" class="input medium" data-original-title="" type="text"  id="team0">
</td>
</tr>
<tr>
<th>
Team Leader Designation<span>*</span>
</th>
<td >
<select class="input drop-down large" name="req" id="emp" onchange="if(this.value != ''){getModule('masters/team/getUser?profile='+this.value,'teamUsers','','Teams')}">
				<option value="">Select Designation</option>
<?php
$getDesig = mysql_query("SELECT `id`,`name` FROM `designation` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowDesig = mysql_fetch_array($getDesig))
{
?>				
				<option value="<?php echo $rowDesig[0]?>"><?php echo $rowDesig[1]?></option>
<?php
}
?>				
			</select>
</td>
</tr>
<tr>
<th>Team Leader<span style="color:maroon">*</span></th>
<td id="teamUsers">
<select class="input drop-down large" name="req" id="team1">
				<option value="">Select Team Leader</option>
			</select>

</td>
</tr>
<tr>
<th>
Team Mates<span>*</span>
</th>
<td >
<div id="addemp">
<select class="input drop-down large" name="req" id="emp" onchange="addToteam(this.value,'team2','empl','addemp','reemp')">
				<option value="">Select Designation</option>
<?php
$getDesig = mysql_query("SELECT `id`,`name` FROM `employee` WHERE `delete`= '0' AND `empstatus`=2",$con) or die(mysql_error());
while($rowDesig = mysql_fetch_array($getDesig))
{
?>				
				<option value="<?php echo $rowDesig[0].'**'.$rowDesig[1]?>"><?php echo $rowDesig[1]?></option>
<?php
}
?>				
			</select>
						<span id="reemp"></span>
			<div style="padding:5px;" id="empl">
						</div>
			<input class="input medium" name="req" type="text" value="" id="team2" title="isNotNull" style="display:none" />
</div>

</td>
</tr>
<tr><th>Description</th>
<td><textarea class="input huge" name="" cols="20" rows="2" style="width:48%;height:100px;" id="team3"></textarea>
</td>
</tr>

<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('masters/team/save','team','4','','','couResp','1')"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>

</table>
	</div>
</div>


