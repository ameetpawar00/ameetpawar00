<?php
include("../../include/conFig.php");
$sql = "SELECT `id`,`name` from `employee` where `delete` = '0'";
$getData = mysql_query($sql,$con) or die(mysql_error());
$Num_Rows = mysql_num_rows($getData);
	$Per_Page = 25;   // Per Page
	include('../../pagination/pagination.php');
	$folder= 'management/salary/view';
	$title = 'Salary';
//$getData = mysql_query("SELECT `id`,`name` from `employee` where `delete` = '0' order by `name` asc",$con) or die(mysql_error());
if($_GET['month'])
{
$mnth = $_GET['month'];
}
else
{
$mnth = date('m');
}
?>
<div class="title">Salary Management</div>
<div class="strip">
<span>Dashboard</span>
<span>Management</span>
<span>Salary Management</span>
</div>

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
<div class="" style="display:inline-block">Select Month <select class="input drop-down" name="Select1" id="month" onchange="getModule('management/salary/view?month='+document.getElementById('month').value,'viewContent','manipulateContent','Manage Salary')" >
				<option <?php if($mnth == '1' ) {echo 'selected=selected';}?>  value="1">January</option>
				<option <?php if($mnth == '2' ) {echo 'selected=selected';}?> value="2">February</option>
				<option <?php if($mnth == '3' ) {echo 'selected=selected';}?> value="3">March</option>
				<option <?php if($mnth == '4' ) {echo 'selected=selected';}?> value="4">April</option>
				<option <?php if($mnth == '5' ) {echo 'selected=selected';}?> value="5">May</option>
				<option <?php if($mnth == '6' ) {echo 'selected=selected';}?> value="6">June</option>
				<option <?php if($mnth == '7' ) {echo 'selected=selected';}?> value="7">July</option>
				<option <?php if($mnth == '8' ) {echo 'selected=selected';}?> value="8">August</option>
				<option <?php if($mnth == '9' ) {echo 'selected=selected';}?> value="9">September</option>
				<option <?php if($mnth == '10' ) {echo 'selected=selected';}?> value="10">October</option>
				<option <?php if($mnth == '11' ) {echo 'selected=selected';}?> value="11">November</option>
				<option <?php if($mnth == '12' ) {echo 'selected=selected';}?> value="12">December</option>
			</select></div>
<div style="display:inline-block">
<button class="button gray" onclick="ToggleBox('manipulateContent','block','');ToggleBox('viewContent','none','')"> <i class="back"></i>Back</button>&nbsp;&nbsp;
</div>
</td>
</tr>
</table>

<div style="height:400px;overflow-x:hidden;overflow-y:scroll" id="mainDivId">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
<tr><th style="width:5%; height: 30px;"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>
<th style="width:130px;">Employee Name</th>
<th style="width:100px;">Present</th>
<th>Absent</th>
<th>Leave</th>
<th>Salary</th>
<th>Status</th>
</tr>
<?php
$i = 1;

$sql .=" order by `name` ASC LIMIT $Page_Start , $Per_Page";
$values = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($values))
{
$eid = $row[0];
/////////////////calc of current salary
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
//echo "select count(id) from `attendance` where `delete` = '1' and `attendance` = '1' and `status` = '1' and `employee` = '$eid' and MONTH(date) = '$mnth'";
$getP = mysql_query("select count(id) from `attendance` where `delete` = '0' and `attendance` = '1' and `status` = '1' and `employee` = '$eid' and MONTH(date) = '$mnth'",$con)or die(mysql_error());
$rowP = mysql_fetch_array($getP);
$getA = mysql_query("select count(id) from `attendance` where `delete` = '0' and `attendance` = '0' and `status` = '1' and `employee` = '$eid' and MONTH(date) = '$mnth'",$con)or die(mysql_error());
$rowA = mysql_fetch_array($getA);
$getL = mysql_query("select count(id) from `attendance` where `delete` = '0' and `attendance` = '2' and `status` = '1' and `employee` = '$eid' and MONTH(date) = '$mnth'",$con)or die(mysql_error());
$rowL = mysql_fetch_array($getL);
$attDetail = $rowP[0]."**--**".$rowA[0]."**--**".$rowL[0];
?>
<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td style="height: 30px"><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" /></td>
<td style="color:#000;width:130px; height: 30px;" ><?php echo $row[1] ?></td>
<td style="color:#000;width:130px; height: 30px;" ><?php echo $rowP[0] ?></td>
<td style="color:#000;width:60px; height: 30px;" ><?php echo $rowA[0] ?></td>
<td style="color:#000;width:120px; height: 30px;" ><?php echo  $rowL[0] ?></td>
<td style="color:#000;width:200px; height: 30px;" ><?php echo $finalSal ?></td>
<td style="color:#000;width:120px; height: 30px;">
<?php
$chkSal = mysql_query("select `id` from `salaryslip` where `employee` = '$eid' and `month` = '$mnth' and `delete` = '0'",$con) or die(mysql_error());
if(mysql_num_rows($chkSal) > 0)
{
$rowSlip = mysql_fetch_array($chkSal);
?>
<?php if(in_array('s_MSalary',$thisper)) 
{
?>
<div class="active" style="width:70px" onclick="getModule('management/salary/viewslip?id=<?php echo $rowSlip[0]?>&month=<?php echo $mnth?>&name=<?php echo $row[1]?>&i=<?php echo $i?>','manipulatemoodleContent','viewmoodleContent','Manage Salary')"> View Salary</div>
<?php 
} 
?>

<?php 
}
else
{
?>
<?php if(in_array('a_MSalary',$thisper)) 
{
?>
<div class="deactive" style="width:70px" onclick="getModule('management/salary/index?eid=<?php echo $row[0]?>&month=<?php echo $mnth?>&name=<?php echo $row[1]?>&attDetail=<?php echo $attDetail?>','manipulatemoodleContent','viewmoodleContent','Manage Salary')"> Add Salary</div>
<?php 
} 
?>

<?php
}
?>
</td>
</tr>
<?php
$finalSal = 0;
$gross = 0;
$hra = 0;
$conv = 0;
$bonus = 0;
$pf =0;
$claim =0;
$ins = 0;

$i++;
$Maxid = $row[0];
$MaxI = $i;
}
?>

<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
</table>
</div>
<?php
include('../../pagination/pages.php');
?>