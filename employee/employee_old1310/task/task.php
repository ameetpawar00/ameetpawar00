<?php
include("../../include/conFig.php");
$tid = $_GET['tid'];
$getask = mysql_query("SELECT * FROM `task` WHERE `delete` = '0' AND `id` = '$tid' ",$con) or die(mysql_error());
$rowtask = mysql_fetch_array($getask);
?>
<?php
		$member = explode(',',$rowtask['teamember']);
		$name = '';
		$member1 = str_ireplace('-','',$member);
		
		foreach($member1 as $val)
		{
		
			if($val)
			{		
				$people[] = $val;
				$getemp = mysql_query("SELECT `name` FROM `employee` WHERE `id` = '$val' ",$con) or die(mysql_error());
				$getemp = mysql_fetch_array($getemp);
				$name .= $getemp['name'].",";
			}
		}			?>
			



<div id="myTitle" style="padding-bottom:5px">
<div class="title" style="display:inline-block">Task</div>
</div>

<div class="add-new gray_dark-border" id="addDepen" >
<div class="form-head gray_dark">
<div class="head-title"> 
<i class="add-form"></i> 
Task Assign to <?php echo $hrmloggeduser?></div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp">
<?php
if($rowtask['status'] == 1)
{
 ?>
 <?php echo $rowtask['name']?> is in process
 <?php
 }
 ?>
</div></td></tr>

<tr>
<td>Task Name<span>*</span></td>
<td><input name="req" class="input medium" data-original-title="" type="text"  style="width:240px;" value="<?php echo $rowtask['name']?>" readonly="readonly">
</td><td></td>
</tr>
<tr><td valign="top">Team Member <span>*</span></td><td>
<input name="req" class="input medium" data-original-title="" type="text"  style="width:240px;" value="<?php echo $name ?>" readonly="readonly">
</td><td></td></tr>
<?php 
$getretask = mysql_query("SELECT * FROM `taskreassign` WHERE `delete` = '0' AND `taskid` = '$tid' AND `from` = '$hrmloggedid' ",$con) or die(mysql_error());
$rowretask = (mysql_fetch_array($getretask));
	$assignby = $rowtask['assignby'];
	$getassby = mysql_query("SELECT `name` FROM `employee` WHERE `id` = '$assignby' ",$con) or die(mysql_error());
	$getassby = mysql_fetch_array($getassby);

?>
<tr>
<td>Assign By</td>
<td><input name="req" class="input medium" data-original-title="" type="text"  style="width:240px;" value="<?php echo $getassby['name'] ?>" readonly="readonly">
</td>
<td></td>
</tr>
<tr>	
	<td>Priority
	</td>
	<td>
	<input name="req" class="input medium" data-original-title="" type="text"  style="width:240px;" value="<?php echo $rowtask['priority']?>" readonly="readonly">
	</td><td></td>
</tr>
<tr>
<td valign="top">Description<span>*</span></td>
<td><textarea name="req" class="huge medium" data-original-title="" type="text"  style="width:240px;" readonly="readonly"><?php echo $rowtask['description']?></textarea>
</td><td></td>
</tr>
<?php 
if($rowretask['from'] != $hrmloggedid)
{
?>
<tr><td>Assign to any other</td>
<td><select style="width:180px" name="req" id="retask0" class="input drop-down">
	<option value="">Select Member</option>

<?php
$getemp = mysql_query("SELECT `id`,`name` FROM `employee` WHERE `delete`= '0' AND `id` != '1' AND `id` != '$hrmloggedid' ",$con) or die(mysql_error());
while($rowemp = mysql_fetch_array($getemp))
{
if(in_array("$rowemp[0]", $people))
{
}
else
{
?>				
				<option value="<?php echo $rowemp[0]?>"><?php echo $rowemp[1]?></option>
<?php
}
}
?>				
			
			
			</select>

			</td><td>
			<button class="button gray" onclick="SaveData('employee/task/reassignsave?tid=<?php echo $tid?>&emid=<?php echo $hrmloggedid; ?>','retask','1','','','couResp','2');closeMoodle()">Assign</button>

			</td>
</tr>
<tr><td></td><td  style="text-align:left">
<?php
if($rowtask['status'] == 0)
{
?>
<button class="button green" onclick="SaveData('employee/task/status?tid=<?php echo $tid?>','','','','','couResp','2');closeMoodle()">Start<i class="login-icon"></i></button>
<?php
}
?>
<?php
if($rowtask['status'] == 1 && $rowtask['close'] == 0)
{
?>
<button class="button red" onclick="SaveData('employee/task/done?tid=<?php echo $tid?>','','','','','couResp','2');closeMoodle()"><i class="save-icon"></i>Done</button>
<?php
}
?>
</td><td></td></tr>
<?php
}
else
{
$reassito = $rowretask['to'];
	$getreto = mysql_query("SELECT `name` FROM `employee` WHERE `id` = '$reassito' ",$con) or die(mysql_error());
	$getreto = mysql_fetch_array($getreto);

?>
<tr>
<td>Reassign To</td>
<td><input name="req" class="input medium" data-original-title="" type="text"  style="width:240px;" value="<?php echo $getreto['name']?>" readonly="readonly">
</td>
<td></td>
</tr>
<?php
}
?>
</table>
</div>
<br/>

		
			
	

