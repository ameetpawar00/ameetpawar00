<?php 
include("../include/conFig.php");
$desia = $_GET['desig'];
$id=$_GET['id'];
$select=mysql_query("select * from jobvacancy where `id`='$id' AND `delete` = '0'");
while($row=mysql_fetch_array($select)){
$desia = $row['designation'];
$getDesig = mysql_query("SELECT `name` FROM `designation` WHERE `id` = '$desia'",$con) or die(mysql_error());
$rowDesig = mysql_fetch_array($getDesig);
$desi=$rowDesig['name'];
}
?>
<div class="title">Refer Here</div>
<div class="strip">
<span>Dashboard</span>
<span>Refer Here</span>
</div>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
<button class="button gray" onclick="ToggleBox('manipulatemoodleContent','none','');ToggleBox('viewmoodleContent','block','')"> <i class="back"></i>Back</button>&nbsp;&nbsp;
</td>
</tr>
</table>
<div style="overflow-x:hidden;overflow-y:scroll;height:500px">
<div class="add-new blue-border">
<div class="form-head green">
<div class="head-title"> 
<i class="add-form"></i> 
Add Reference</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td colspan="2" style="text-align:center; height: 19px;"><div style="display:inline-block;" id="couResp"></div></td>
	<td colspan="2" style="text-align:center; height: 19px;"><div style="display:inline-block;" id="couResp"></div></td>
	<td colspan="2" style="text-align:center; height: 19px;"><div style="display:inline-block;" id="couResp"></div></td>
</tr>
<tr>
	<th style="height: 22px">Job Title</th>
	<td style="height: 22px">
		<strong>
			<input type="text" id="noti0" value="<?php echo $desia."###".$id;?>" style="display:none;">
				<?php echo $desi;?>
		</strong>
	</td>
	<th style="height: 22px">Refer By<span>*</span></th>
	<td style="height: 22px">
		<strong>
			<input type="text" id="noti1" value="<?php echo $hrmloggeduser;?>" style="display:none;">
			<?php echo $hrmloggeduser;?>
		</strong>
	</td>
	<th style="height: 22px">Name <span>*</span></th>
	<td style="height: 22px">
		<input class="input medium" name="req" type="text" id="noti2">
	</td>
</tr>
<tr>
	<th style="height: 22px">Contact<span>*</span></th>
	<td style="height: 22px">
		<input class="input medium" name="req" type="text" id="noti3">
	</td>
	<th style="height: 22px">Email</th>
	<td style="height: 22px">
		<input class="input medium" name="req" type="text" id="noti4">
	</td>
	<th style="height: 22px">Method<span>*</span></th>
	<td style="height: 22px">
		<input class="input medium"  readonly="readonly" value="<?php echo 'Refer'?>" type="text" id="noti5">
	</td>
</tr>
<tr>
	<th style="height: 26px">Qualification <span>*</span></th>
	<td style="height: 26px">
		<select class="input drop-down medium" name="req3" id="noti6">
			<option value="">Select Qualification</option>
			<?php
				$getDesig = mysql_query("SELECT `id`,`name` FROM `education` WHERE `delete`= '0'",$con) or die(mysql_error());
					while($rowDesig = mysql_fetch_array($getDesig))
						{
			?>
							<option value="<?php echo $rowDesig[1]?>"><?php echo $rowDesig[1]?></option>
			<?php
						}
			?>				
		</select>
	</td>
	<th style="height: 26px">Experience <span>*</span></th>
	<td style="height: 26px">
		<select class="input drop-down medium" id="noti7">
			<option value="">select experience</option>
			<option value="Fresher">Fresher</option>
			<option value="less then a year">less then a year</option>
			<option value="1 to 2 year">1 to 2 year</option>
			<option value="2 to 3 year">2 to 3 year</option>
			<option value="3 to 4 year">3 to 4 year</option>
			<option value="4 to 5 year">4 to 5 year</option>
			<option value="above 5 year">above 5 year</option>
		</select>
	</td>
	<th valign="top">Upload Resume <span>*</span></th>
	<td>						
		<iframe src="job-vacancy/resume/index.php?respid=noti8" scrolling="no" height="60" frameborder="0"></iframe>
		<input id="noti8" type="hidden" />
	</td>
</tr>


<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('notification/save?desi=<?php echo $desia?>','noti','9','','','couResp','1');"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>
</table>
	</div>
</div>


