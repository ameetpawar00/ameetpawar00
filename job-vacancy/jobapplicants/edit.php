
<head>
</head>

<?php
include("../../include/conFig.php");
$id = $_GET['id'];
$i = $_GET['i'];

$getData = mysql_query("SELECT * FROM `jobapplicants` WHERE `id` = '$id'",$con) or die(mysql_error());
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
		<th >Job Titel <span>*</span></th>
	<td style="width: 226px">
	<strong><?php echo $row['jobtitel']; ?></strong>
	</td>

<th>Name <span>*</span>
	</th>
	<td>
	<input class="input medium" name="" type="text" id="app0" value="<?php echo $row['name']?>"/>
	</td>

</tr>

<tr>
	<th>Contact <span>*</span>
	</th>
	<td style="width: 226px"><input class="input medium" name="" type="text" id="app1" value="<?php echo $row['contact']?>"/>
	</td>
	<th>Email <span>*</span>
	</th>
	<td><input class="input medium" name="" type="text" id="app4" value="<?php echo $row['email']?>"/>
	</td>

	
</tr>
<tr>

<th >Qualification <span>*</span>
	</th>
	<td style="height: 26px; width: 226px;">
	<select class="input drop-down large" name="req" id="app3">
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
<th style="height: 26px">Experience <span>*</span>
	</th>
	<td >
	<select class="input drop-down large" id="app5" selected="selected">
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
	<tr>
	<th>Method Of Aplicant<span>*</span>
	</th>
	<td style="width: 226px">
	<select class="input drop-down large"  id="app5" onchange="showTextBox()">
				<option value="">Select Method</option>
<?php
$getSource = mysql_query("SELECT `id`,`name` FROM `sourceofhire` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowSource = mysql_fetch_array($getSource))
{
?>
<option value="<?php echo $rowSource[1]?>"><?php echo $rowSource[1]?></option>

<?php
}
?>
	
			</select>

	</td>
	<th>Date Of Apply<span>*</span>
	</th>
	<td><input class="input medium"  name="req" value="<?php echo $row['dateofapply']?>" id="app6" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalender('calenderid0','job4')"/>
			<div class="calender" id="calenderid0"></div>
</td></tr>

<tr>
	<th>Description<span>*</span>
	</th>
	<td><textarea name="req" class="input huge"  name="TextArea" style="width: 475px; height: 75px"id="app7"><?php echo $row['description']?></textarea>
	</td>
	<th>Upload Resume<span>*</span>
	</th>
	<td>						
	<iframe src="job-vacancy/resume/index.php?respid=app8" scrolling="no" height="100px" frameborder="0"></iframe>
	<a href="job-vacancy/resume/<?php echo $row['resumefile']?>" style="font-size:10px;color:green">View</a>
	
</td>
</tr>




<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('job-vacancy/jobapplicants/update?id=<?php echo $row[0]?>&i=<?php echo $i?>','app','9','<?php echo $i?>','','couResp','2');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i>Update Job</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>

</table>
<br/><br/><br/><br/><br/><br/>
	</div>
</div>
<iframe src="#" name="myUploadFrame" style="height:0;width:0;display:none" id="myUploadFrame" scrolling="0" frameborder="0"></iframe>


