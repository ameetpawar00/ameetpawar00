<?php 
include("../include/conFig.php");
 $desi = $_GET['desig'];
$id=$_GET['id'];
$select=mysql_query("select * from jobvacancy where `id`='$id' AND `delete` = '0'");
while($row=mysql_fetch_array($select)){
$desi = $row['designation'];
}
?>
<div class="title">Refer Here</div>
<div class="strip">
<span>Dashboard</span>
<span>Refer Here</span>
</div>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
<button class="button gray" onclick="ToggleBox('manipulatemoodleContent','none','');ToggleBox('viewmoodleContent','block','')"> <i class="back"></i>Back</button>&nbsp;&nbsp;
</td>
</tr>
</table>
<div style="overflow:auto;height:350px">
<div class="add-new blue-border">
<div class="form-head green">
<div class="head-title"> 
<i class="add-form"></i> 
Add Reference</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center; height: 19px;"><div style="display:inline-block;" id="couResp"></div></td></tr>


<tr>
<th style="height: 22px">Job Title
</th>
<td style="height: 22px">
<select class="input drop-down large" name="req1" id="noti0">
				<option value="">Select Post</option>
<?php

$getDesig = mysql_query("SELECT `designation`.`name`, `jobvacancy`.`designation` FROM `jobvacancy`, `designation` WHERE `jobvacancy`.`delete`= '0' AND `jobvacancy`.`vacancy`!= '0' AND `jobvacancy`.`designation` = `designation`.`id`",$con) or die(mysql_error());
while($rowDesig = mysql_fetch_array($getDesig))
{
?>
<option value="<?php echo $rowDesig[1]?>"><?php echo $rowDesig[0]?></option>
<?php
}
?>				
</select>

</td>
<th style="height: 22px">Refer By<span>*</span></th>
<td style="height: 22px">
	<input type="text"  class="input medium" name="req" id="noti1">
</td>
</tr>
<tr>
<th style="height: 22px">Candidate Name</th>
<td style="height: 22px"><input class="input medium" name="req" type="text" id="noti5"></td>

<th style="height: 22px">Contact<span>*</span></th>
<td style="height: 22px"><input class="input medium" name="req" type="text" id="noti6"></td>
</tr>
<tr>
<th style="height: 22px">Email</th>
<td style="height: 22px"><input class="input medium" name="req" type="text" id="noti7"></td>

<th style="height: 22px">Method<span>*</span></th>
<td style="height: 22px"><input class="input medium"  readonly="readonly" value="<?php echo 'Refer'?>" type="text" id="noti8"></td>
</tr>

<th style="height: 26px">Qualification <span>*</span></th>
<td style="height: 26px">
<select class="input drop-down large" name="req" id="noti2">
				<option value="">Select Qualification</option>
<?php

$getDesig = mysql_query("SELECT `id`,`name` FROM `education` WHERE `delete`= '0'",$con) or die(mysql_error());
while($rowDesig = mysql_fetch_array($getDesig))
{
?>
<option value="<?php echo $rowDesig[1]?>"><?php echo $rowDesig[1]?></option>
<?php
}
?>				
</select>

</td>

<th style="height: 26px">Experience <span>*</span></th>
<td style="height: 26px"><select class="input drop-down large" id="noti3">
    <option value="">select experience</option>
    <option value="Fresher">Fresher</option>
    <option value="less then a year">less then a year</option>
    <option value="1 to 2 year">1 to 2 year</option>
    <option value="2 to 3 year">2 to 3 year</option>
    <option value="3 to 4 year">3 to 4 year</option>
    <option value="4 to 5 year">4 to 5 year</option>
    <option value="above 5 year">above 5 year</option></select>
</tr>

<tr>
<th valign="top">Upload Resume <span>*</span></th>
<td>						
	<iframe src="job-vacancy/resume/index.php?respid=noti4" scrolling="no" height="100px" frameborder="0"></iframe>
	<input id="noti4" type="hidden"/>
</td>
</tr>
<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('notification/save?desi=<?php echo $desi?>','noti','9','','','couResp','1');"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>
</table>
	</div>
</div>
<script type="text/javascript">
$( ".txtreq" ).change(function() {
  alert( "Handler for .change() called." );
});
  </script>


