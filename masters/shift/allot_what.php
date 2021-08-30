<?php
include("../../include/conFig.php");
$id = $_GET['id'];
$i = $_GET['i'];
$getData = mysql_query("SELECT * FROM `shift` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
 
<div class="title">Shift</div>
<div class="strip">
<span>Dashboard</span>
<span>Shift</span>
<span>Allot Shift</span>
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
Allot Shift</div>
</div>
<form action="masters/shift/update_bulk_shift.php" method="POST" target="shiftframe">
<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<th colspan="2" style="text-align:center">
			<div style="display:inline-block;" id="couResp"></div>
		</th>
	</tr>
	<tr>
	<th>Select Department  <span>*</span></th>
	<td>

		<select id="emp6" class="input drop-down large" name="req" onchange="getModule('masters/shift/allot?val='+this.value,'View_depart_cont','viewContent','Shift')">
		
			<option value="">Select Department</option>
			<?php
				$getShift = mysql_query("SELECT `id`, `name`, `description` FROM `department` WHERE `delete`=0",$con) or die(mysql_error());
				while($rowhift = mysql_fetch_array($getShift))
					{
						
			?>
			<option  value="<?php echo $rowhift[0]?>"><?php echo $rowhift[1]?></option>
		<?php
					}
			?>
		</select> 
	</td>
	</tr>
	<tr>
	<th>Select Shift  <span>*</span></th>
	<td>

	<?php
	
				$getShift = mysql_query("SELECT `id`, `name`, `starttime`, `endtime` FROM `shift` WHERE `delete`=0",$con) or die(mysql_error());
			
			$shift=<<<AAA
				<select id="sh1" class="input drop-down large" name="new_shift" required >
					<option value="">Select Shift</option>
AAA;
		
		
						while($rowhift = mysql_fetch_array($getShift))
							{
								$sel='';
								if($row[3]==$rowhift[1])
								{
									$sel='selected="selected" ';
								}
								$shift.=<<<AAA
									<option value="$rowhift[0]" $sel> $rowhift[1] : $rowhift[2] To $rowhift[3] </option>
AAA;
									
							}
	$shift.=<<<AAA
	
			</select> 
AAA;

	
	echo $shift;
	?>
	<input type="submit" name="shift_bulk_allot" value="Submit" >
	</td>
	</tr>
	<tr>
	<th>Select Users  <span>*</span></th>
		<td  id="View_depart_cont">
		
		</td>
	</tr>
</table>
</form>
<iframe name="shiftframe" style="display:none"></iframe>
	</div>
</div>


