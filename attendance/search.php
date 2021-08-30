<?php
include("../include/conFig.php");
echo $monthname= $_GET['monthname'];
echo '<br>';
$month = $_GET['month'];
$month='Jan'=='1';
$getData = mysql_query("SELECT attendance.id,employee.name,attendance.attendance,attendance.date,attendance.month FROM employee,attendance WHERE employee.id = attendance.employee AND employee.delete='0' AND `approved` = '1' AND month='$month' ORDER BY employee.name ASC",$con) or die(mysql_error());
?>
<div id="myTitle">
<div class="title">Verify Attendance</div>
<div class="strip">
<span>Dashboard</span>
<span>Verify Attendance</span>
<span>View</span>
</div>
</div>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
<div class="" style="display:inline-block">Select Month <select class="input drop-down" name="Select1" id="month" onchange="getModule('attendance/search?monthname=<?php echo $monthname;?>&month='+document.getElementById('month').value,'viewContent','manipulateContent','Manage Attendance')" >
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
<button class="button gray" style="display:none" onclick="ToggleBox('manipulateContent','block','');ToggleBox('viewContent','none','')"> <i class="back"></i>Back</button>&nbsp;&nbsp;
</div>
</td>
</tr>
</table>

<div style="height:400px;overflow-x:hidden;overflow-y:scroll" id="mainDivId">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
<tr><th style="width:5%"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>


<th style="width: 347px">Name</th>
<th>Attendance</th>
<th>Date</th>

</tr>
<?php
$i = 1;
while($row = mysql_fetch_array($getData))
{
//echo $month=date('M',strtotime($row[4]));
$monthname= $row[4];

?>
<tr class="d<?php echo $i%2?>"  id="fetchRow<?php echo $i?>">
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" /></td>
<td><?php echo $row[1] ?></td>
<td>
<?php if($row[2] == 1){echo 'Present'; }?> 
<?php if($row[2] == 0){echo 'Absent'; }?> 
<?php if($row[2] == 2){echo 'Leave'; }?> 
<?php if($row[2] == 5){echo 'Half Day'; }?> 
</td>
<td><?php echo $row[3] ?></td>
</tr>
<?php
$i++;
$Maxid = $row[0];
$MaxI = $i;
}
?>
<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
</table>
<br/><br/><br/><br/><br/><br/>
</div>
