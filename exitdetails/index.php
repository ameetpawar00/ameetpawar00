<?php
include("../include/conFig.php");
?>
<div class="title">Exit Details</div>
<div class="strip">
<span>Dashboard</span>
<span>Exit Details</span>
<span>Add New</span>
</div>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"> <i class="back"></i>Back</button>&nbsp;&nbsp;
</td>
</tr>
</table>
<!-- 
 
<ul class="breadcrumb">
	<li><a href="#">Home</a><span class="divider">&raquo;</span></li>
	<li class="active"  onclick="getModule('exitdetails/view','viewContent','manipulateContent','Exit Details')">Exit Details</li>
	<div class="red awesome small" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" style="float:right">Back To Exit Details</div>

</ul>
<div class="nonboxy-widget">
	<div class="widget-head">
		<h5>Add New Exit Details</h5>
	</div>
</div>
<div class="widget-content">
	<div class="widget-box">
-->
<div style="overflow-x:hidden;overflow-y:scroll;height:500px">
<div class="add-new green-border">
<div class="form-head green">
<div class="head-title"> 
<i class="add-form"></i> 
Seperation</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<!--
	<table width="100%" cellpadding="10" cellspacing="0" class="form-horizontal well formtable">

<tr><td colspan="4" style="color:#000;border-bottom:2px #bbbbbb solid;">Seperation</td>

</tr>-->
<tr>
	<td  width="175px" style="height: 26px">Employee Name <span>*</span>
	</td>
	<td style="height: 26px"><select class="input drop-down large" name="req" id="exit0">
				<option value="">Select Employee</option>
<?php
$getEmp = mysql_query("SELECT `id`,`name` FROM `employee` WHERE `delete`= '0'",$con) or die(mysql_error());
while($rowEmp = mysql_fetch_array($getEmp))
{
?>				
				<option value="<?php echo $rowEmp[0]?>"><?php echo $rowEmp[1]?></option>
<?php
}
?>				
			</select>
	</td>
	<td  width="175px" style="height: 26px">Seperation Date <span>*</span>
	</td>
	<td style="height: 26px"><input name="req" id="exit1" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalender('calenderid0','exit1')"/>
			<div class="calender" id="calenderid0"></div>
			</td>
</tr>
<tr>
	<td width="175px" style="height: 26px">Report To <span>*</span>
	</td>
	<td><select class="input drop-down large" name="req" id="exit2">
				<option value="">Select Employee</option>
<?php
$getEmp = mysql_query("SELECT `id`,`name` FROM `employee` WHERE `delete`= '0'",$con) or die(mysql_error());
while($rowEmp = mysql_fetch_array($getEmp))
{
?>				
				<option value="<?php echo $rowEmp[0]?>"><?php echo $rowEmp[1]?></option>
<?php
}
?>				
			</select>

	</td>
	<td width="175px" style="height: 26px">Reason For Leaving <span>*</span>
	</td>
	<td><select class="input drop-down large" name="req" id="exit3">
				<option value="">Select Reason</option>
<?php
$getEmp = mysql_query("SELECT `id`,`name` FROM `reasonforleaving` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowEmp = mysql_fetch_array($getEmp))
{

?>				
				<option value="<?php echo $rowEmp[0]?>"><?php echo $rowEmp[1]?></option>
<?php
}
?>				
			</select>

	</td>
</tr>
</table>
</div>
<br/>

<div class="add-new blue-border"  style="float:left;width:49%;">
<div class="form-head blue">
<div class="head-title"> 
<i class="add-form"></i> 
Questionairre</div>
</div>
<div style="overflow-x:hidden;overflow-y:scroll;height:250px">
<table cellpadding="0" cellspacing="0" width="100%">
<!--
<div style="width:100%"> 
<div style="float:left;width:49%">
<table width="100%" cellpadding="10" cellspacing="0" class="form-horizontal well formtable">
<tr><td colspan="4" style="color:#000;border-bottom:2px #bbbbbb solid">Questionairre</td></tr>-->
<?php
$i = 1;
$getQues = mysql_query("SELECT `id`,`name` FROM `exitquestions` WHERE `delete` = '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowQues = mysql_fetch_array($getQues))
{
$totlQids .= ",".$rowQues[0];

?>
<tr>
	<td><?php echo $rowQues[1]?></td>
	<td><textarea name="TextArea1" class="input" id="ques<?php echo $i?>" onblur="texttotext('ques','quesanswer','totali')"></textarea></td>
</tr>
<?php
$i++;
 } ?>
<input type="hidden" value="<?php echo $i?>" id="totali"/>
</table>
</div>
</div>
<div class="add-new blue-border" style="float:right;width:49%;">
<div class="form-head blue">
<div class="head-title"> 
<i class="add-form"></i> 
Checklist For Exit Interview</div>
</div>
<div style="overflow-x:hidden;overflow-y:scroll;height:250px">
<table cellpadding="0" cellspacing="0" width="100%">
<!--
<div style="float:right;width:49%;">
<table width="100%" cellpadding="10" cellspacing="0" class="form-horizontal well formtable">
<tr><td colspan="4" style="color:#000;border-bottom:2px #bbbbbb solid">Checklist For Exit Interview</td></tr>-->
<?php
$j=1;
$getChk = mysql_query("SELECT `id`,`name` FROM `checklist` WHERE `delete` = '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowChk = mysql_fetch_array($getChk))
{
$totlChkids .= ",".$rowChk[0];
?>
<tr>
	<td><?php echo $rowChk[1]?></td>
	<td><textarea name="TextArea1" class="input" id="chkq<?php echo $j?>" onblur="texttotext('chkq','chkanswer','totalj')"></textarea></td>
</tr>
<?php
$j++;
 } ?>

 </table>
 </div>
</div>

<input type="hidden" value="<?php echo $j?>" id="totalj"/>
<input type="hidden" value="<?php echo  $totlQids?>" id="qesId"/>
<input type="hidden" value="<?php echo  $totlChkids?>" id="chkId"/>
<textarea name="TextArea1" cols="20" rows="2" id="quesanswer" style="display:none"></textarea>
<textarea name="TextArea1" cols="20" rows="2" id="chkanswer" style="display:none"></textarea>
<br/>
<br/>
<br/>
<div align="center" > 
<table cellpadding="0" cellspacing="0" border="0">
 <tr>
<td style="text-align:center">
<button class="button green" onclick="SaveData('exitdetails/save?qesId='+document.getElementById('qesId').value+'&chkId='+document.getElementById('chkId').value+'&quesanswer='+document.getElementById('quesanswer').value+'&chkanswer='+document.getElementById('chkanswer').value,'exit','4','','','couResp','1')"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>
<td><br/><br/><br/></td>
</table>
</div>

<!--
	<table style="width:100%">
<tr><td colspan="4" style="text-align:center;">
<div style="display:inline-block;" id="couResp"></div></td></tr>
<tr><td colspan="4" align="center"><div class="blue awesome small" onclick="SaveData('exitdetails/save?qesId='+document.getElementById('qesId').value+'&chkId='+document.getElementById('chkId').value+'&quesanswer='+document.getElementById('quesanswer').value+'&chkanswer='+document.getElementById('chkanswer').value,'exit','4','','','couResp','1')">Save Details</div>
<div class="btn btn-warning" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block-->