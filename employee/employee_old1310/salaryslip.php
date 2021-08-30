<?php
include("../include/conFig.php");

$sql = "SELECT `id`,`month`,`total`,`employee`,`year` from `salaryslip` where `delete` = '0' and `employee` = '$hrmloggedid'";
$getData = mysql_query($sql,$con) or die(mysql_error());
$Num_Rows = mysql_num_rows($getData);
	$Per_Page = 25;   // Per Page
	include('../pagination/pagination.php');
	$folder= 'employee/salaryslip';
	$title = 'salaryslip';


//$getData = mysql_query("SELECT `id`,`month`,`total`,`employee` from `salaryslip` where `delete` = '0' and `employee` = '$hrmloggedid' order by `month` ",$con) or die(mysql_error());
?>
<div class="title">Salary For Employee <span style="display:inline-block"><?php echo $hrmloggeduser?></span></div>

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">

<!--<h2 class="title">Salary For Employee <span style="display:inline-block"><?php echo $hrmloggeduser?></span>-->
<div class="" style="display:inline-block;display:none">Select Month <select class="input drop-down" name="Select1" id="month" onchange="getModule('management/salary/view?month='+document.getElementById('month').value,'viewContent','manipulateContent','Manage Salary')" >
				<option <?php if($mnth == '01' ) {echo 'selected=selected';}?>  value="1">January</option>
				<option <?php if($mnth == '02' ) {echo 'selected=selected';}?> value="2">February</option>
				<option <?php if($mnth == '03' ) {echo 'selected=selected';}?> value="3">March</option>
				<option <?php if($mnth == '04' ) {echo 'selected=selected';}?> value="4">April</option>
				<option <?php if($mnth == '05' ) {echo 'selected=selected';}?> value="5">May</option>
				<option <?php if($mnth == '06' ) {echo 'selected=selected';}?> value="6">June</option>
				<option <?php if($mnth == '07' ) {echo 'selected=selected';}?> value="7">July</option>
				<option <?php if($mnth == '08' ) {echo 'selected=selected';}?> value="8">August</option>
				<option <?php if($mnth == '09' ) {echo 'selected=selected';}?> value="9">September</option>
				<option <?php if($mnth == '10' ) {echo 'selected=selected';}?> value="10">October</option>
				<option <?php if($mnth == '11' ) {echo 'selected=selected';}?> value="11">November</option>
				<option <?php if($mnth == '12' ) {echo 'selected=selected';}?> value="12">December</option>
			</select></div>

</td>
</tr>
</table>

<div style="height:400px;overflow-x:hidden;overflow-y:scroll" id="mainDivId">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
<tr><th style="width:5%;"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>
<th >Year</th>
<th >Month</th>
<th >Salary</th>
<th >Print</th>
</tr>
<?php
$i = 1;

$sql .=" order by `month` ASC LIMIT $Page_Start , $Per_Page";
$values = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($values))
{
$eid = $row[0];
?>
<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td ><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" /></td>
<td ><?php echo $row[4] ?></td>
<td ><?php echo date("F", mktime(0, 0, 0,  $row[1], 10)); ?></td>
<td ><?php echo $row[2] ?></td>
<?php if(in_array('p_salary',$thisper)) 
{
?>
<td >
<span class="active" onclick="getModule('employee/salarySlipview?id=<?php echo $row[0]?>&employee=<?php echo $row[3]?>&month=<?php echo $row[1];?>&year=<?php echo $row[4];?>','manipulateContent','viewContent','Employee Salry Slip')" >View</span>
</td>
<?php 
} 
?>

</tr>
<?php

$i++;
$Maxid = $row[0];
$MaxI = $i;
}
?>

<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
</table>
</div>
<?php
include('../pagination/pages.php');
?>