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
<button style="float:right;display:inline-block" class="button gray" onclick="getModule('employee/workexperience/experience?eid=<?php echo $eid?>&name=<?php echo $name ?>&i<?php echo $i ?>','viewmoodleContent','manipulatemoodleContent','Employee')"> <i class="back"></i>Back</button>

</div>
<div class="add-new gray_dark-border" id="addExp" style="display:">
<div class="form-head gray_dark">
<div class="head-title"> 
<i class="add-form"></i> 
Add Dependent</div>
</div>
<div style="overflow-x:hidden;overflow-y:scroll;height:500px">
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>

<tr>
<th>Previous Company Name <span>*</span></th>
<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="exp0"/>
</td>
</tr>
<tr><th>Job Title <span>*</span></th>
	<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="exp1"/>
	</td>	
</tr>
<tr>	
	<th>From Date  <span>*</span>
	</th>
	<td><input class="input medium" name="req" id="exp2" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalender('decalenderid','exp2')"/>
				<div class="calender" id="decalenderid"></div>

	</td>
</tr>
<tr>	
	<th>To Date  <span>*</span>
	</th>
	<td><input class="input medium" name="req" id="exp3" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalender('decalenderid','exp3')"/>
				<div class="calender" id="decalenderid"></div>

	</td>
</tr>
<tr><th>Location <span>*</span></th>
	<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="exp5" value="<?php echo $fetchData[2] ?>">
	</td>	
</tr>
<tr><th>Starting Gross Salary <span>*</span></th>
	<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="exp6" value="<?php echo $fetchData[2] ?>">
	</td>	
</tr>
<tr><th>Leaving Gross Salary <span>*</span></th>
	<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="exp7" value="<?php echo $fetchData[2] ?>">
	</td>	
</tr>
<tr><th>Reasons for leaving<span>*</span></th>
	<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="exp8" value="<?php echo $fetchData[2] ?>">
	</td>	
</tr>

<tr>
	<th>Job Responsibilities </th>
	<td><textarea class="input huge" id="exp9" name="TextArea1" style="width: 240px; height: 60px"></textarea></td>
</tr>
<tr style="display:none">
	<th>Experience</th>
	<td><textarea class="input huge" id="exp4" name="TextArea1" style="width: 240px; height: 60px"><?php echo $fetchData[5] ?></textarea></td>
</tr>

<tr><td></td><td  style="text-align:left">
<button class="button red" onclick="SaveData('employee/workexperience/saveexp?eid=<?php echo $eid?>','exp','10','','','couResp','10')"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="$('#addExp').slideToggle('fast')"><i class="close-icon"></i>Cancel</button>
</td></tr>
</table>
<br/>
<br/>
<br/>
<br/>
</div>
</div>