<?php
include("../include/conFig.php");
$getData = mysql_query("SELECT attendance.id,employee.name,attendance.attendance FROM employee,attendance WHERE employee.delete = '0' AND employee.id = attendance.employee AND attendance.date = '$date' AND `approved` = '0' ORDER BY employee.name ASC",$con) or die(mysql_error());
?>

<div id="myTitle">
<div class="title">Verify Attendance</div>
<div class="strip">
<span>Dashboard</span>
<span>Verify Attendance</span>
<span>View</span>
</div>
</div>

<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>
<td style="width:70%" align="right">
<!--<div class="button blue" style="float:right;padding:12px" onclick="getModule('attendance/getRec?selectedDate='+document.getElementById('selectedDate').value,'todaysAtten','','')">GO</div>
<div class="button red" style="float:right;margin-left:10px">Select Date &nbsp;&nbsp;<input name="req" id="selectedDate" type="" readonly="readonly" value="<?php echo $date?>" class="inputCalendar" style="width:200px" onclick="openCalendar(this);"/></div>
-->
<button class="button blue" onclick="getModule('attendance/getRec?selectedDate='+document.getElementById('selectedDate').value,'todaysAtten','','').value,'todaysAtten','','')"> <i class="login-icon"></i>GO</button>&nbsp;
<button class="button red">Select Date <input name="req" id="selectedDate" type="" readonly="readonly" value="<?php echo $date?>" class="inputCalendar" style="width:200px" onclick="openCalender('calenderid','selectedDate')"/>
			<div class="calender" id="calenderid"></div></button>&nbsp;
</td>
</tr>
</table>
<div style="height:400px;overflow-x:hidden;overflow-y:scroll" id="mainDivId">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
<tr><th style="width:5%"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>


<th>Name</th>
<th>Attendance</th>

</tr>
<?php
$i = 1;
while($row = mysql_fetch_array($getData))
{
?>
<tr class="d<?php echo $i%2?>"  id="fetchRow<?php echo $i?>">
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" /></td>
<td><?php echo $row[1] ?></td>
<td><select class="input drop-down large" name="Select1" style="width:200px" id="attendance<?php echo $i?>" onchange="getModulee('attendance/save?id=<?php echo $row[0]?>&selectedDate=<?php echo $date?>&value='+this.value,'','','')">
				<option <?php if($row[2] == 1){echo 'selected=selected'; }?> value="1" >Present</option>
				<option <?php if($row[2] == 0){echo 'selected=selected'; }?> value="0" >Absent</option>
				<option <?php if($row[2] == 2){echo 'selected=selected'; }?> value="2" >Leave</option>
			</select></td>
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
