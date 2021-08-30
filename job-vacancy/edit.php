<?php
include("../include/conFig.php");
$id = $_GET['id'];
$i = $_GET['i'];

$getData = mysql_query("SELECT * FROM `jobvacancy` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
 
<div class="title">Edit Jobs-vacancy</div>
<div class="strip">
<span>Dashboard</span>
<span>Edit Jobs-vacancy</span>
<span>Edit</span>
</div>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
<button class="button blue" style="display:none" onclick="getModule('job-vacancy/jobapplicants/new?jobid=<?php echo $id;?>','manipulateContent','viewContent','Job-Vacancy')"> <i class="plus"></i>Applicant</button>&nbsp;&nbsp;

<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" > <i class="back"></i>Back</button>&nbsp;&nbsp;
</td>
</tr>
</table>
<div style="overflow-x:hidden;overflow-y:scroll;height:500px">
<div class="add-new blue-border">
<div class="form-head green">
<div class="head-title"> 
<i class="add-form"></i> 
Edit Jobs-vacancy</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>

 

<tr>
		<th >Designation <span>*</span>
	</th>
	<td><select class="input drop-down large" name="" id="job0">
				<option value="">Select Designation</option>
<?php
$getDesig = mysql_query("SELECT `id`,`name` FROM `designation` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowDesig = mysql_fetch_array($getDesig))
{
?>				
				<option <?php if($rowDesig[1] == $row['designation']) echo "selected='selected'"; ?> value="<?php echo $rowDesig[1]?>"><?php echo $rowDesig[1]?></option>
<?php
}
?>				
			</select>

	</td>

<th>Qualification <span>*</span>
	</th>
	<td>
	<select class="input drop-down large" name="req" id="job1">
				<option value="">Select Qualification</option>
<?php
$getQua = mysql_query("SELECT `id`,`name` FROM `education` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowQua = mysql_fetch_array($getQua))
{
?>
<option <?php if($rowQua[1] == $row['qualification']) echo "selected='selected'"; ?> value="<?php echo $rowQua[1]?>"><?php echo $rowQua[1]?></option>
<?php
}
?>				
			</select>

	
	</td>

</tr>

<tr>
	<th>Vacancy <span>*</span>
	</th>
	<td><input class="input medium" name="" type="text" id="job2" value="<?php echo $row['vacancy']?>"/>
	</td>
	<th>Salary <span>*</span>
	</th>
	<td><input class="input medium" name="" type="text" id="job3" value="<?php echo $row['salary']?>"/>
	</td>

	
</tr>
<tr>

<th>Last Date <span>*</span>
	</th>
	<td><input class="input medium"  name="req" value="<?php echo $row['lastdate']?>" id="job4" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalender('calenderid0','job4')"/>
			<div class="calender" id="calenderid0"></div>
</td>
<?php 
$selectexp = mysql_query("select `experience` from `jobvacancy` where id='$id'");
while($exp=mysql_fetch_array($selectexp)) {
?>
<th>Experience <span>*</span>
	</th>
	<td>
	<select class="input drop-down large" id="job5" name="req" >
	<option <?php if($exp[0] == $row['experience']) echo "selected='selected'"; ?> value="<?php echo $exp[0]?>"><?php echo $exp[0]?></option>
    <option value="Fresher">Fresher</option>
    <option value="less then a year">less then a year</option>
    <option value="1 to 2 year">1 to 2 year</option>
    <option value="2 to 3 year">2 to 3 year</option>
    <option value="3 to 4 year">3 to 4 year</option>
    <option value="4 to 5 year">4 to 5 year</option>
    <option value="above 5 year">above 5 year</option>
<?php } ?>
    </select>

	</td>
	<tr>
	<th>Eligibility<span>*</span>
	</th>
	<td><textarea name="req" class="input huge"  name="TextArea" style="width: 475px; height: 75px"id="job6"><?php echo $row['eligiblity']?></textarea>
	</td>
	<th>Remarks  <span>*</span>
	</th>
	<td><textarea name="req" class="input huge" name="TextArea" style="width: 475px; height: 75px" id="job7"><?php echo $row['remark']?></textarea>	</td>
</tr>

	
	<tr>
	<th>Status <span>*</span></th>
	<td colspan="3"><input class="input checkbox"   id="job8" type="checkbox" value="1" <?php if($row['status'] == '1') {echo 'checked=checked';}?>/>Active</td>
</tr>

<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('job-vacancy/update?id=<?php echo $row[0]?>&i=<?php echo $i?>','job','9','<?php echo $i?>','','couResp','2');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i>Update Job</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>

</table>
<br/><br/><br/><br/><br/><br/>
	</div>
</div>
<iframe src="#" name="myUploadFrame" style="height:0;width:0;display:none" id="myUploadFrame" scrolling="0" frameborder="0"></iframe>


