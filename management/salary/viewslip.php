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
<tr><th>Basic Salary <span>*</span></th>
<td><input name="req" type="text"  style="width:100px;"  id="sals4" title="isNotNull"  value="<?php echo $row['gross'] ?>" onkeypress="return chkNumbers(event)" class="inputDisabled" onblur="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)" onkeyup="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)">
</td>
<th>Attendance Allowance  <span>*</span>
</th> 
<td><input name="req" id="sals5" type="text" style="width:100px;" title="isNotNull"  value="<?php echo $row['atten_allow'] ?>" onkeypress="return chkNumbers(event)" class="inputDisabled" onblur="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)" onkeyup="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)" >
</td>	
<th>Conveyance  <span>*</span>
</th>
<td><input name="req" id="sals6" type="text"  style="width:100px;" title="isNotNull"  value="<?php echo $row['conveyance'] ?>" onkeypress="return chkNumbers(event)" class="inputDisabled" onblur="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)" onkeyup="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)">
</td>
</tr>
<tr>	

<th>Medical  Allowance <span>*</span></th>
<td><input name="req" id="sals7" type="text" style="width:100px;" title="isNotNull"  value="<?php echo $row['Med_allow'] ?>" onkeypress="return chkNumbers(event)" class="inputDisabled" onblur="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)" onkeyup="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)">
<th>Performance <span>*</span></th>
<td><input name="req" id="sals8" type="text" style="width:100px;" title="isNotNull"  value="<?php echo $row['kpi'] ?>" onkeypress="return chkNumbers(event)"  class="inputDisabled" onblur="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)" onkeyup="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)">
<th>Over Acheivment<span>*</span></th>
<td><input name="req" id="sals9" type="text" style="width:100px;" title="isNotNull"  value="<?php echo $row['overachieve'] ?>" onkeypress="return chkNumbers(event)" class="inputDisabled" onblur="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)" onkeyup="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)">
</tr><tr>	

<th>Extra Bonus <span>*</span></th>
<td><input name="req" id="sals7" type="text" style="width:100px;" title="isNotNull"  value="<?php echo $row['bonus'] ?>" onkeypress="return chkNumbers(event)" class="inputDisabled" onblur="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)" onkeyup="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)">
<th>Late Comes<span>*</span></th>
<td><input name="req" id="sals8" type="text" style="width:100px;" title="isNotNull"  value="<?php echo $row['lateComes'] ?>" onkeypress="return chkNumbers(event)"  class="inputDisabled" onblur="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)" onkeyup="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)">
<th>Total Salary<span>*</span></th>
<td><input name="req" id="sals8" type="text" style="width:100px;" title="isNotNull"  value="<?php echo ($row['total']-$row['lateComes']) ?>" onkeypress="return chkNumbers(event)"  class="inputDisabled" onblur="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)" onkeyup="salaryCalcu('sals4','sals14','sals3','sals13','sals11','totalAmount','sals',4,11)">
</tr>
<tr>

<th>