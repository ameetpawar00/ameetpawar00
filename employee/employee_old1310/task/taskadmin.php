<?php
include("../../include/conFig.php");
$tid = $_GET['tid'];
$getask = mysql_query("SELECT * FROM `task` WHERE `delete` = '0' AND `id` = '$tid' ",$con) or die(mysql_error());
while($rowtask = mysql_fetch_array($getask))
{
?>
<?php
		$member = explode(',',$rowtask['teamember']);
		$name = '';
		$member1 = str_ireplace('-','',$member);
		
		foreach($member1 as $val)
		{
			if($val)
			{		
			$getemp = mysql_query("SELECT `name` FROM `employee` WHERE `id` = '$val' ",$con) or die(mysql_error());
			$getemp = mysql_fetch_array($getemp);
			$name .= $getemp['name'].",";
			}
			}
			?>



<div id="myTitle" style="padding-bottom:5px">
<div class="title" style="display:inline-block">Task</div>
</div>

<div class="add-new gray_dark-border" id="addDepen" >
<div class="form-head gray_dark">
<div class="head-title"> 
<i class="add-form"></i> 
Task Assign to <?php echo $name?></div>
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
<td><input name="req" class="input medium" data-original-title="" type="text"  style="width:240px;" value="<?php echo $rowtask['name']?>" >
</td>
</tr>
<tr><td valign="top">Team Member <span>*</span></td><td>
<input name="req" class="input medium" data-original-title="" type="text"  style="width:240px;" value="<?php echo $name ?>" >
</td></tr>
<tr>	
	<td>Priority
	</td>
	<td>
	<input name="req" class="input medium" data-original-title="" type="text"  style="width:240px;" value="<?php echo $rowtask['priority']?>" >
	</td>
</tr>
<tr>
<td>Date of issue</td>
<td>	<input name="req" class="input medium" data-original-title="" type="text"  style="width:240px;" value="<?php echo $rowtask['createdate']?>" >
</td>
</tr>
<tr>
<td valign="top">Description<span>*</span></td>
<td><textarea name="req" class="huge medium" data-original-title="" type="text"  style="width:240px;" ><?php echo $rowtask['description']?></textarea>
</td>
</tr>
<tr>
<td>Project Reassign To</td>
	<td>
	<table>
	<tr>
	<td>From</td>
	<td>To</td>
	</tr>
	<?php 
		$getretask = mysql_query("SELECT * FROM `taskreassign` WHERE `delete` = '0' AND `taskid` = '$tid' ",$con) or die(mysql_error());
		while($rowretask = (mysql_fetch_array($getretask)))
		{
			$reassignby = $rowretask['from'];
			$regetassby = mysql_query("SELECT `name` FROM `employee` WHERE `id` = '$reassignby' ",$con) or die(mysql_error());
			$regetassby = mysql_fetch_array($regetassby);
			
			$reassignto = $rowretask['to'];
			$regetassto = mysql_query("SELECT `name` FROM `employee` WHERE `id` = '$reassignto' ",$con) or die(mysql_error());
			$regetassto = mysql_fetch_array($regetassto);

	?>
	<tr>
	<td><?php echo $regetassby['name']; ?></td>
	<td><?php echo $regetassto['name']; ?></td>
	</tr>
	<?php
	}
	?>
	</table>
	</td>
</tr>
	<?php
	if($rowtask['close'] == 1)
	{
	?>
	<tr>
	<td></td><td>
<button class="button green" onclick="SaveData('employee/task/varify?tid=<?php echo $tid?>','','','','','couResp','2');closeMoodle()"><i class="login-icon"></i>Varified</button>
	</td></tr>
	<?php
	}
	?>


</table>

</div>
<br/>

		
				<?php
				
		
	}

		
?>

	

