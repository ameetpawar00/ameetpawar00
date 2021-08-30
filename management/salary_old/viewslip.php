<?php
include("../../include/conFig.php");
$eid = $_GET['eid'];
$id = $_GET['id'];
$i = $_GET['i'];
$mnth = $_GET['month'];
#$attDetail = explode("**--**",$_GET['attDetail']);
$year = date('Y');
#$monthDays= cal_days_in_month(CAL_GREGORIAN, $mnth,$year); 
$monthName = date("F", mktime(0, 0, 0, $mnth, 10));
$getDetails = mysql_query("SELECT * FROM `salaryslip` WHERE `id` = '$id' AND `delete` = '0' ",$con) or die(mysql_error());
$row = mysql_fetch_array($getDetails);

?>

<div class="title">View Salary Details For <span style="font-weight:bold"><?php echo $_GET['name']?></span> Month <span class="maroon"><?php echo $monthName?> </span>
</div>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
</td>
</tr>
</table>
<div style="overflow-x:hidden;overflow-y:scroll;height:500px">
<div class="add-new blue-border">
<div class="form-head blue">
<div class="head-title"> 
</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>
<!--
<div class="nonboxy-widget">
	<div class="widget-head">
		<h5 align="left">View Salary Details For <span class="green"><?php echo $_GET['name']?></span> Month <span class="maroon"><?php echo $monthName?> </span>
		</h5>
	</div>
</div>
<div class="widget-content">
	<div class="widget-box" id="editSal" style="height:500px;overflow-x:hidden;overflow-y:auto" >
	<table width="100%" cellpadding="10" cellspacing="0" class="form-horizontal well formtable">
<tr><td colspan="6" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>-->
<tr><th>Total Days  </th>
	<td><input name="req"  type="text"  id="sals0" title="isNotNull" class="inputDisabled" value="<?php echo $row['totaldays']?>">
	</td>
	<th>Present Days  </th>
	<td><input name="req"  type="text"   id="sals1" title="isNotNull" class="inputDisabled" value="<?php echo $row['present']?>">
	</td>	
	<th>Absent Days </th>
	<td><input name="req"  type="text"  id="sals2" title="isNotNull" class="inputDisabled" value="<?php echo $row['absent']?>">
	</td>	
</tr>
<tr>
	<th style="height: 26px">Working Days</th>
	<td style="height: 26px"><input name="req"  type="text"  style="width:100px;"  id="sals14" title="isNotNull" class="inputDisabled" value="<?php echo $row['workingdays']?>" onblur="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)" >
	</td>

	<th style="height: 26px">Leave </th>
	<td style="height: 26px"><input name="req"  type="text" style="width:100px;"   id="sals3" title="isNotNull" class="inputDisabled" value="<?php echo $row['leave']?>" onblur="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)">
	</td>
	<th style="height: 26px">Deduction</th>
	<td colspan="" style="height: 26px"><input name="Text1" style="width:100px;" type="text" id="sals13" title="isNotNull" class="inputDisabled" value="<?php echo $row['deduction']?>" readonly="readonly" onblur="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)" onkeyup="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)" /></td>
</tr>
<tr><th>Gross <span>*</span></th>
	<td><input name="req" type="text"  style="width:100px;"  id="sals4" title="isNotNull"  value="<?php echo $row['gross'] ?>" onkeypress="return chkNumbers(event)" class="inputDisabled" onblur="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)" onkeyup="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)">
	</td>
	<th>HRA  <span>*</span>
	</th> 
	<td><input name="req" id="sals5" type="text" style="width:100px;" title="isNotNull"  value="<?php echo $row['hra'] ?>" onkeypress="return chkNumbers(event)" class="inputDisabled" onblur="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)" onkeyup="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)" >
	</td>	
	<th>Conveyance  <span>*</span>
	</th>
	<td><input name="req" id="sals6" type="text"  style="width:100px;" title="isNotNull"  value="<?php echo $row['conveyance'] ?>" onkeypress="return chkNumbers(event)" class="inputDisabled" onblur="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)" onkeyup="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)">
	</td>
</tr>
<tr>	
	
	<th>Bonus <span>*</span></th>
	<td><input name="req" id="sals7" type="text" style="width:100px;" title="isNotNull"  value="<?php echo $row['bonus'] ?>" onkeypress="return chkNumbers(event)" class="inputDisabled" onblur="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)" onkeyup="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)">
	<th>PF <span>*</span></th>
	<td><input name="req" id="sals8" type="text" style="width:100px;" title="isNotNull"  value="<?php echo $row['pf'] ?>" onkeypress="return chkNumbers(event)"  class="inputDisabled" onblur="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)" onkeyup="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)">
	<th>Claim <span>*</span></th>
	<td><input name="req" id="sals9" type="text" style="width:100px;" title="isNotNull"  value="<?php echo $row['claim'] ?>" onkeypress="return chkNumbers(event)" class="inputDisabled" onblur="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)" onkeyup="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)">
</tr>
<tr>
	
	<th>Insurance <span>*</span></th>
	<td><input name="req" id="sals10" type="text" style="width:100px;"  title="isNotNull"  value="<?php echo $row['insurance']?>" onkeypress="return chkNumbers(event)" class="inputDisabled" onblur="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)" onkeyup="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)">
<th>Total Amount <span>*</span></th>
	<td><input name="req" id="sals11" type="text" style="width:100px;"  title="isNotNull"  value="<?php echo $row['total']?>" onkeypress="return chkNumbers(event)" class="inputDisabled" readonly="readonly">
		<input name="req" id="totalAmount" type="hidden"  title="isNotNull" class="input" value="<?php echo $row['total']?>" onkeypress="return chkNumbers(event)"/>

<th>Mode <span>*</span></th>
	<td><select name="Select1" id="sals12" class="inputDisabled" style="width:100px;" disabled="disabled">
				<option value="Transfer">Transfer</option>
				<option value="Cheque">Cheque</option>
				<option value="Cash">Cash</option>
			</select></td>

</tr>

<tr><td colspan="2"></td><td colspan="2" style="text-align:center">

<div id="editdata">
<button class="button green"onclick="inlineEditData('updateData','editdata')">Edit</button>
<button class="button gray" onclick="document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';ToggleBox('bigMoodle','none','')"><i class="close-icon"></i>Cancel</button>

</div>
<div style="display:none" id="updateData">
<button class="button green" onclick="SaveData('management/salary/save?id=<?php echo $id?>&i=<?php echo $i?>','sals','15','salary--**--<?php echo $mnth?>','','couResp','2')"><i class="save-icon"></i>Update</button>
<button class="button gray" onclick="closeEditData('editdata','updateData')"><i class="close-icon"></i>Cancel</button>
</div>
</td></tr>
<!--
<tr><td colspan="2"></td><td colspan="2"  style="text-align:left">
<div id="editdata">
<div class="button blue" onclick="inlineEditData('updateData','editdata')">Edit</div>
<div class="button gray" onclick="document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';ToggleBox('bigMoodle','none','')">Cancel</div>
</div>
<div style="display:none" id="updateData">
<div class="button blue" onclick="SaveData('management/salary/save?id=<?php echo $id?>&i=<?php echo $i?>','sals','13','salary--**--<?php echo $mnth?>','','couResp','2')">Update</div>
<div class="button gray" onclick="closeEditData('editdata','updateData')" >Close</div>
</div>
</td></tr>
-->
</table>
</div>
</div>


