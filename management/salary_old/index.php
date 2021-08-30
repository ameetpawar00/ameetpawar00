<?php
include("../../include/conFig.php");
$eid = $_GET['eid'];
$mnth = $_GET['month'];
$attDetail = explode("**--**",$_GET['attDetail']);
$year = date('Y');
$monthDays= cal_days_in_month(CAL_GREGORIAN, $mnth,$year); 
$monthName = date("F", mktime(0, 0, 0, $mnth, 10));
$getStarting = mysql_query("SELECT * FROM `salary` WHERE `eid` = '$eid' AND `delete` = '0' AND `increment` = '0'",$con) or die(mysql_error());
$rowStarting = mysql_fetch_array($getStarting);
$getInc = mysql_query("SELECT SUM(gross),SUM(hra),SUM(conveyance),SUM(bonus),SUM(pf),SUM(claim),SUM(insurance) FROM `salary` WHERE `eid` = '$eid' AND `delete` = '0' AND `increment` = '1'",$con) or die(mysql_error());
$rowInc = mysql_fetch_array($getInc);
$getDec = mysql_query("SELECT SUM(gross),SUM(hra),SUM(conveyance),SUM(bonus),SUM(pf),SUM(claim),SUM(insurance) FROM `salary` WHERE `eid` = '$eid' AND `delete` = '0' AND `increment` = '2'",$con) or die(mysql_error());
$rowDec = mysql_fetch_array($getDec);
//Calculation
$gross = ($rowStarting['gross'] + $rowInc[0]) - $rowDec[0];
$hra = ($rowStarting['hra'] + $rowInc[1]) - $rowDec[1];
$conv = ($rowStarting['conveyance'] + $rowInc[2]) - $rowDec[2];
$bonus = ($rowStarting['bonus'] + $rowInc[3]) - $rowDec[3];
$pf = ($rowStarting['pf'] + $rowInc[4]) - $rowDec[4];
$claim = ($rowStarting['claim'] + $rowInc[5]) - $rowDec[5];
$ins = ($rowStarting['insurance'] + $rowInc[6]) - $rowDec[6];
$finalSal = $gross + $hra + $conv + $bonus + $pf + $claim + $ins;

//$getData = mysql_query("SELECT workexperience.id,workexperience.precompany,workexperience.jobtitle,workexperience.fromdate,workexperience.todate,workexperience.jobdesc,employee.id FROM employee,workexperience WHERE employee.id = workexperience.eid AND workexperience.delete = '0' AND workexperience.eid = '$eid'",$con) or die(mysql_error());

?>


<div class="title">Add Salary Info For <span style="font-weight:bold"><?php echo $_GET['name']?></span> Month <span class="maroon"><?php echo $monthName?> </span></div>
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
</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>

<!--
<div id="myTitle" style="padding-bottom:5px">
<div class="title" style="display:inline-block">Add Salary Info For <span style="font-weight:bold"><?php echo $_GET['name']?></span> Month <span class="maroon"><?php echo $monthName?> </span></div>
</div>
<div class="add-new gray_dark-border" >
<div class="form-head gray_dark">
<div class="head-title"> 
<i class="add-form"></i> 
Add Dependent</div>
<tr><td colspan="6" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>-->
<tr><th>Total Days  </th>
	<td><input name="req"  type="text"  id="sals0" title="isNotNull"  class="inputDisabled" value="<?php echo $monthDays?>">
	</td>
	<th>Present Days  </th>
	<td style="width: 254px"><input name="req"  type="text"   id="sals1" title="isNotNull" class="inputDisabled" value="<?php echo $attDetail[0]?>">
	</td>	
	<th>Absent Days </th>
	<td><input name="req"  type="text"  id="sals2" title="isNotNull" class="inputDisabled" value="<?php echo $attDetail[1]?>">
	</td>	
</tr>
<tr>

	<th style="height: 26px">Working Days</th>
	<td style="height: 26px"><input name="req"  type="text" style="width:100px;"  id="sals14" title="isNotNull" class="input" value="<?php echo $monthDays?>" onblur="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)" >
	</td>

	<th style="height: 26px">Leave </th>
	<td style="height: 26px"><input name="req"  type="text"  style="width:100px;"  id="sals3" title="isNotNull" class="input" value="<?php echo $attDetail[2]?>" onblur="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)">
	</td>
	<th style="height: 26px">Deduction</th>
	<td colspan="" style="height: 26px"><input name="Text1" type="text" id="sals13" title="isNotNull" style="width:100px;" class="inputDisabled" value="0" readonly="readonly" /></td>
</tr>

<tr>	
</tr>
<tr><th>Gross <span>*</span></th>
	<td><input name="req" type="text"  style="width:100px;"  id="sals4" title="isNotNull" class="input" value="<?php echo $gross ?>" onkeypress="return chkNumbers(event)" onblur="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)" onkeyup="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)">
	</td>
	<th>HRA  <span>*</span>
	</th> 
	<td style="width: 254px"><input name="req" id="sals5" type="text" style="width:100px;" title="isNotNull" class="input" value="<?php echo $hra ?>" onkeypress="return chkNumbers(event)" onblur="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)" onkeyup="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)"/>
	</td>	
	<th>Conveyance  <span>*</span>
	</th>
	<td><input name="req" id="sals6" type="text"  style="width:100px;" title="isNotNull" class="input" value="<?php echo $conv ?>" onkeypress="return chkNumbers(event)" onblur="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)" onkeyup="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)"/>
	</td>
</tr>
<tr>	
	
	<th>Bonus <span>*</span></th>
	<td><input name="req" id="sals7" type="text" style="width:100px;" title="isNotNull" class="input" value="<?php echo $bonus ?>" onkeypress="return chkNumbers(event)" onblur="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)" onkeyup="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)"/>
	<th>PF <span>*</span></th>
	<td style="width: 254px"><input name="req" id="sals8" type="text" style="width:100px;" title="isNotNull" class="input" value="<?php echo $pf ?>" onkeypress="return chkNumbers(event)" onblur="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)" onkeyup="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)"/>
	<th>Claim <span>*</span></th>
	<td><input name="req" id="sals9" type="text" style="width:100px;" title="isNotNull" class="input" value="<?php echo $claim ?>" onkeypress="return chkNumbers(event)" onblur="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)" onkeyup="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)"/>
</tr>
<tr>
	
	<th style="height: 26px">Insurance <span>*</span></th>
	<td style="height: 26px"><input name="req" id="sals10" type="text" style="width:100px;"  title="isNotNull" class="input" value="<?php echo $ins?>" onkeypress="return chkNumbers(event)" onblur="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)" onkeyup="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)"//>
<th style="height: 26px">Total Amount <span>*</span></th>
	<td style="height: 26px; width: 254px"><input name="req" id="sals11" type="text" style="width:100px;"  title="isNotNull"  value="<?php echo $finalSal?>" onkeypress="return chkNumbers(event)" class="inputDisabled"  readonly="readonly"/>
	<input name="req" id="totalAmount" type="hidden"  title="isNotNull" class="input" value="<?php echo $finalSal?>" onkeypress="return chkNumbers(event)"/>
<th style="height: 26px">Mode <span>*</span></th>
	<td style="height: 26px"><select name="Select1" id="sals12">
				<option value="Transfer">Transfer</option>
				<option value="Cheque">Cheque</option>
				<option value="Cash">Cash</option>
			</select></td>

</tr>

<tr>
<td colspan="6" style="text-align:center">
<button class="button green" onclick="SaveData('management/salary/save?eid=<?php echo $eid?>&month=<?php echo $mnth?>','sals','15','salary--**--<?php echo $mnth?>','','couResp','1')"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';ToggleBox('bigMoodle','none','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>
<!--
<tr><td colspan="2"></td><td colspan="2"  style="text-align:left">
<div class="blue awesome small" onclick="SaveData('management/salary/save?eid=<?php echo $eid?>&month=<?php echo $mnth?>','sals','13','salary--**--<?php echo $mnth?>','','couResp','1')">Save</div>
<div class="btn btn-warning" onclick="document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';ToggleBox('bigMoodle','none','')">Cancel</div>
</td></tr>-->
</table>
</div>



