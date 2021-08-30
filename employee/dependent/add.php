<?php
include("../../include/conFig.php");
$id =$_GET['id'];
$i =$_GET['i'];
$eid =$_GET['eid'];
$name =$_GET['name'];
$action = $_POST['action'];
?>
<div class="title">My Dependent</div>
<div class="strip">
<span>Dependent</span>
<span>Add Dependent</span>
<button style="float:right;display:inline-block" class="button gray" onclick="getModule('employee/dependent/dependent?eid=<?php echo $eid?>&name=<?php echo $name ?>&i<?php echo $i ?>','manipulateContent','viewContent','Employee')"> <i class="back"></i>Back</button>

</div>


<div class="add-new gray_dark-border" id="addDepen" style="display:">
<div class="form-head gray_dark">
<div class="head-title"> 
<i class="add-form"></i> 
Add Dependent</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>

<tr>
<td>Name <span>*</span></td>
<td><input name="req" class="input medium" data-original-title="" type="text"  style="width:240px;" id="depen0"  >
</td>
</tr>
<tr><td>Relationship <span>*</span></td>
<td><select name="req" id="depen1" style="width:250px" class="input drop-down large">
				<option value="">Select Relationship</option>
<?php
$getLoc = mysql_query("SELECT `id`,`name` FROM `relationship` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowLoc = mysql_fetch_array($getLoc))
{
?>				
				<option value="<?php echo $rowLoc[0]?>"><?php echo $rowLoc[1]?></option>
<?php
}
?>				
			</select>

	</td>	
</tr><tr>	
	<td>Date Of Birth 
	</td>
	<td><input name="" id="depen2" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalender('decalenderid','depen2')"/>
			<div class="calender" id="decalenderid"></div>
	</td>
</tr>
<tr>	
	<td>Occupation 
	</td>
	<td><input name="" id="depen3" type="text" class="input medium" style="width:200px" >
	</td>
</tr>
<tr>	
	<td>Office Name & Address  
	</td>
	<td>
	<textarea class="input huge" style="width: 543px; height: 75px" id="depen4"></textarea>
	</td>
</tr>
<tr>	
	<td>Mobile Number
	</td>
	<td><input name="" id="depen5" type="text" class="input medium" style="width:200px" >
	</td>
</tr>
<tr><td></td><td  style="text-align:left">
<button class="button red" onclick="SaveData('employee/dependent/savedepen?eid=<?php echo $eid?>','depen','6','','','couResp','10')"><i class="save-icon"></i>Save</button>
</td></tr>
</table>
</div>