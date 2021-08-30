<?php
include("../../include/conFig.php");
$id = $_GET['id'];
$i = $_GET['i'];
$getData = mysql_query("SELECT * FROM `team` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
 
<div class="title">Team </div>
<div class="strip">
<span>Dashboard</span>
<span>Team</span>
<span>Edit Team</span>
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
Edit Team</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>
<tr>
<th>Team Name<span>*</span></th>
<td><input name="req" class="input medium" data-original-title="" type="text"  id="team0" value="<?php echo $row['name'];?>">
</td>
</tr>
<tr>
<th>
Team Leader Designation<span>*</span>
</th>
<td >
<?php
	$leader = $row['leader'];
	$getProfile = mysql_query("SELECT `designation` FROM `employee` WHERE `id` = '$leader'",$con) or die(mysql_error());
	$rowP = mysql_fetch_array($getProfile);
	
	?>
	<select class="input drop-down large" name="req" id="emp" onchange="if(this.value != ''){getModule('masters/team/getUser?profile='+this.value,'teamUsers','','Teams')}">
				<option value="">Select Designation</option>
<?php
$getDesig = mysql_query("SELECT `id`,`name` FROM `designation` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowDesig = mysql_fetch_array($getDesig))
{
?>				
				<option <?php if($rowP[0] == $rowDesig[0]){ echo "selected='selected'";} ?> value="<?php echo $rowDesig[0] ;?>"><?php echo $rowDesig[1] ;?></option><?php
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
				<?php
			$getProfile = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' AND `designation` = '$rowP[0]'",$con) or die(mysql_error());
			while($rowProfile= mysql_fetch_array($getProfile))
			{
			?>
			<option <?php if($row['leader'] == $rowProfile[1]){ echo "selected='selected'";} ?>   value="<?php echo $rowProfile[1] ;?>"><?php echo $rowProfile[0] ;?></option>
			<?php
			}
			?>
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
				<option value="">Select Employee</option>
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
				<style>
					.teamMate{
						padding: 2px 10px;
						display: inline-block;
						margin: 5px;
					}
				</style>
			<?php
			$getMates = mysql_query("SELECT employee.name,teamamtes.mateid ,employee.empstatus ,employee.designation FROM employee,teamamtes WHERE teamamtes.teamid = '$id' AND teamamtes.mateid = employee.id",$con) or die(mysql_error());
			while($rowMates = mysql_fetch_array($getMates))			
			{
				$color="red";
				if($rowMates[2]==2)
				{
					$color="#80808070";
				}
				
				$colora="";
				if($rowMates[3]==6 OR $rowMates[3]==7 OR $rowMates[3]==8 OR $rowMates[3]==23 OR $rowMates[3]==27)
				{
					$colora="yellow";
				}
				
				
			?>
						<div class="teamMate" style="background: <?=$color?>;color:<?=$colora?>" id="empl<?php echo $rowMates[1]?>"><?php echo $rowMates[0]; ?>&nbsp;&nbsp;&nbsp;<span onclick="removeTeam('<?php echo $rowMates[1]?>','team2','empl','empl')">x</span></div>
			<?php
			$valPut .= "-".$rowMates[1]."-,";
			}
			?>
			</div>
			<input class="input medium" name="req" type="text" value="<?php echo $valPut?>" id="team2" title="isNotNull" style="display:none" />
</div>

</td>
</tr>
<tr><th>Description</th>
<td><textarea class="input huge" name="" cols="20" rows="2" style="width:48%;height:100px;" id="team3"><?php echo $row['desc'];?></textarea>
</td>
</tr>

<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('masters/team/update?id=<?php echo $id; ?>&i=<?php echo $_GET['i'];?>','team','4','','','couResp','1')"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>

</table>
	</div>
</div>


