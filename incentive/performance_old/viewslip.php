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
<div class="nonboxy-widget">
	<div class="widget-head">
		<h5 align="left">View Salary Details For <span class="green"><?php echo $_GET['name']?></span> Month <span class="maroon"><?php echo $monthName?> </span>
		</h5>
	</div>
</div>
<div class="widget-content">
	<div class="widget-box" id="editSal" style="height:500px;overflow-x:hidden;overflow-y:auto" >
	<table width="100%" cellpadding="10" cellspacing="0" class="form-horizontal well formtable">
<tr><td colspan="6" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>
<tr><th>Total Days  </th>
	<td><input name="req"  type="text"  id="sals0" title="isNotNull" class="inputDisabled" value="<?php echo $row['totaldays']?>"/>
	</td>
	<th>Present Days  </th>
	<td><input name="req"  type="text"   id="sals1" title="isNotNull" class="inputDisabled" value="<?php echo $row['present']?>"/>
	</td>	
	<th>Absent Days </th>
	<td><input name="req"  type="text"  id="sals2" title="isNotNull" class="inputDisabled" value="<?php echo $row['absent']?>"/>
	</td>	
</tr>
<tr>
	<th>Leave </th>
	<td><input name="req"  type="text"   id="sals3" title="isNotNull" class="inputDisabled" value="<?php echo $row['leave']?>"/>
	</td>
	<td colspan="4"></td>
</tr>

<tr>	
</tr>
<tr><th>Gross <span>*</span></th>
	<td><input name="req" type="text"  style="width:100px;"  id="sals4" title="isNotNull"  value="<?php echo $row['gross'] ?>" onkeypress="return chkNumbers(event)" class="inputDisabled"/>
	</td>
	<th>HRA  <span>*</span>
	</th> 
	<td><input name="req" id="sals5" type="text" style="width:100px;" title="isNotNull"  value="<?php echo $row['hra'] ?>" onkeypress="return chkNumbers(event)" class="inputDisabled" />
	</td>	
	<th>Conveyance  <span>*</span>
	</th>
	<td><input name="req" id="sals6" type="text"  style="width:100px;" title="isNotNull"  value="<?php echo $row['conveyance'] ?>" onkeypress="return chkNumbers(event)" class="inputDisabled"/>
	</td>
</tr>
<tr>	
	
	<th>Bonus <span>*</span></th>
	<td><input name="req" id="sals7" type="text" style="width:100px;" title="isNotNull"  value="<?php echo $row['bonus'] ?>" onkeypress="return chkNumbers(event)" class="inputDisabled" />
	<th>PF <span>*</span></th>
	<td><input name="req" id="sals8" type="text" style="width:100px;" title="isNotNull"  value="<?php echo $row['pf'] ?>" onkeypress="return chkNumbers(event)"  class="inputDisabled"/>
	<th>Claim <span>*</span></th>
	<td><input name="req" id="sals9" type="text" style="width:100px;" title="isNotNull"  value="<?php echo $row['claim'] ?>" onkeypress="return chkNumbers(event)" class="inputDisabled" />
</tr>
<tr>
	
	<th>Insurance <span>*</span></th>
	<td><input name="req" id="sals10" type="text" style="width:100px;"  title="isNotNull"  value="<?php echo $row['insurance']?>" onkeypress="return chkNumbers(event)" class="inputDisabled"/>
<th>Total Amount <span>*</span></th>
	<td><input name="req" id="sals11" type="text" style="width:100px;"  title="isNotNull"  value="<?php echo $row['total']?>" onkeypress="return chkNumbers(event)" class="inputDisabled"/>
<th>Mode <span>*</span></th>
	<td><select name="Select1" id="sals12" class="inputDisabled" style="width:100px;" disabled="disabled">
				<option value="Transfer">Transfer</option>
				<option value="Cheque">Cheque</option>
				<option value="Cash">Cash</option>
			</select></td>

</tr>
<tr><td colspan="2"></td><td colspan="2"  style="text-align:left">
<div id="editdata">
<div class="blue awesome small" onclick="inlineEditData('updateData','editdata')">Edit</div>
<div class="btn btn-warning" onclick="document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';ToggleBox('bigMoodle','none','')">Cancel</div>
</div>
<div style="display:none" id="updateData">
<div class="blue awesome small" onclick="SaveData('management/salary/save?id=<?php echo $id?>&i=<?php echo $i?>','sals','13','salary--**--<?php echo $mnth?>','','couResp','2')">Update</div>
<div class="btn btn-warning" onclick="closeEditData('editdata','updateData')" >Close</div>
</div>
</td></tr>
</table>
</div>
</div>


