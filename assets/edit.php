<?php
include("../include/conFig.php");
$id = $_GET['id'];
$i = $_GET['i'];
$getData = mysql_query("SELECT * FROM asset WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
<div class="title">Assets</div>
<div class="strip">
<span>Dashboard</span>
<span>Assets</span>
<span>Edit Asset</span>
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
Edit Asset</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>

<tr>
<th>Name <span>*</span></th>
<td><select class="input drop-down large" name="req" id="asset0">
				<option value="">Select Employee</option>
<?php
$getEmp = mysql_query("SELECT `id`,`name` FROM `employee` WHERE `delete`= '0'",$con) or die(mysql_error());
while($rowEmp = mysql_fetch_array($getEmp))
{
?>				
				<option <?php if($rowEmp[0] == $row['eid']){ echo 'selected=selected'; }?> value="<?php echo $rowEmp[0]?>"><?php echo $rowEmp[1]?></option>
<?php
}
?>				
			</select>
</td>
</tr>
<tr>
<th>Asset <span>*</span></th>
<td><select class="input drop-down large" name="req" id="asset1">
				<option value="">Select Asset</option>
<?php
$getEmp = mysql_query("SELECT `id`,`name` FROM `typeofasset` WHERE `delete`= '0'",$con) or die(mysql_error());
while($rowEmp = mysql_fetch_array($getEmp))
{
?>				
				<option <?php if($rowEmp[0] == $row['typeofasset']){ echo 'selected=selected'; }?> value="<?php echo $rowEmp[0]?>"><?php echo $rowEmp[1]?></option>
<?php
}
?>				
			</select>

</td>
</tr>
<tr>
<th>Given Date
</th>
<td><input name="req" id="asset2" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalendar(this);" value="<?php echo $row['givendate'];?>"/>
</td>
</tr>
<tr>
<th>Return Date
</th>
<td><input name="req" id="asset3" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalendar(this);" value="<?php echo $row['returndate'];?>"/>
</td>
</tr>
<tr><th>Description</th>
<td><textarea class="input-huge" name="" cols="20" rows="2" class="input" style="width:48%;height:100px;" id="asset4"><?php echo $row['description'];?></textarea>
</td>
</tr>
<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('assets/edit?id=<?php echo $id?>&i=<?php echo $i?>','asset','6','','','couResp','2')"><i class="save-icon"></i>Update</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>

</table>
	</div>
</div>


