<?php
include("../../include/conFig.php");
$id = $_GET['id'];
$i = $_GET['i'];
$getData = mysql_query("SELECT * FROM `kpiparameters` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
 
<div class="title">Parameters</div>
<div class="strip">
<span>Dashboard</span>
<span>Parameters</span>
<span>Edit Parameters</span>
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
Edit Parameters</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>

<tr>
<th>Designation <span>*</span>
</th>
<td>
<div id="addemp">

	<select class="input drop-down large" name="req" id="kpi4" onchange="addToteam(this.value,'kpip4','empl','addemp','reemp')">
				<option value="">Select Designation</option>
<?php
$getDesig = mysql_query("SELECT `id`,`name` FROM `designation` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowDesig = mysql_fetch_array($getDesig))
{
			$desigName[$rowDesig[0]] = $rowDesig[1];

?>				
				<option value="<?php echo $rowDesig[0].'**'.$rowDesig[1]?>"><?php echo $rowDesig[1]?></option>
<?php
}
?>				
			</select>
			<span id="reemp"></span>
			<div style="padding:5px;" id="empl">
			<?php
			$designation =  $row['designation'];
			$desig = str_ireplace('-','',$designation);
			$desig = explode(',',$desig);
			foreach($desig as $val)
			{
			if($val != '')
			{
			?>
						<div class="teamMate" id="empl<?php echo $val?>"><?php echo $desigName[$val] ?>&nbsp;&nbsp;&nbsp;<span onclick="removeTeam('<?php echo $val?>','kpip4','empl','empl')">x</span></div>
			<?php
			}}
			?>
			</div>
			<input class="input medium" name="req" type="text" value="<?php echo $designation ?>" id="kpip4" title="isNotNull" style="display:none" />
</div>
	</td>

</tr>
<tr>
<th>Name <span>*</span></th>
<td><input name="req" class="input medium" data-original-title="" title="isNotNull" type="text" value="<?php echo $row['name']?>" id="kpip0">
</td>
</tr>
<tr>
<th>Maximum Points <span>*</span></th>
<td><input name="req" class="input medium" data-original-title="" title="isNotNull" type="text" value="<?php echo $row['maximum']?>" id="kpip2">
</td>
</tr>
<tr>
<th>By Default <span>*</span></th>
<td><input name="req" class="input medium" data-original-title="" title="isNotNull" type="text" value="<?php echo $row['default']?>" id="kpip3">
</td>
</tr>
<tr><th>Description</th>
<td><textarea class="input-huge" name="" cols="20" rows="2"  style="width:48%;height:100px;" id="kpip1"><?php echo $row['description']?></textarea>
</td>
</tr>
<tr>
<td colspan="4" style="text-align:center">

<button class="button green" onclick="SaveData('masters/kpiparameters/update?id=<?php echo $id;?>&i=<?php echo $i;?>','kpip','5','<?php echo $i;?>','','couResp','2');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i>Update</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>
</table>
	</div>
</div>


