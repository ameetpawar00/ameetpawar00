<?php
include("../include/conFig.php");
$selectedDate = $_GET['selectedDate'];
$getData = mysql_query("SELECT attendance.id,employee.name,attendance.attendance FROM employee,attendance WHERE employee.delete = '0' AND employee.id = attendance.employee AND attendance.date = '$selectedDate' AND `approved` = '0' ORDER BY employee.name ASC",$con) or die(mysql_error());
?>
<table width="100%" cellpadding="5" cellspacing="0" style="text-align:center;border-bottom:none" class="fetch" >
<tr><th width="20px"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>
<th style="width:300px">Name</th><th>Attendance</th>

</tr>
<?php
$i = 1;
while($row = mysql_fetch_array($getData))
{
?>
<tr  class="d<?php echo $i%2?>"  id="fetchRow<?php echo $i?>">
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" /></td>
<td style="color:black"><?php echo $row[1] ?></td>
<td style="color:black"><select name="Select1" style="width:200px" id="attendance<?php echo $i?>" onchange="getModulee('attendance/save?id=<?php echo $row[0]?>&selectedDate=<?php echo $selectedDate?>&value='+this.value,'','','')">
				<option <?php if($row[2] == 1){echo 'selected=selected'; }?> value="1" >Present</option>
				<option <?php if($row[2] == 0){echo 'selected=selected'; }?> value="0" >Absent</option>
				<option <?php if($row[2] == 2){echo 'selected=selected'; }?> value="2">Leave</option>
			</select></td>
</tr>
<?php
$i++;
$Maxid = $row[0];
$MaxI = $i;
}
?>
<tr>
<td></td>
<td></td>
<td align="left"><div class="red awesome small"  onclick="approveData('attendance','For Attendance','1','<?php echo $selectedDate?>')">Approve All</div>
</td>
</tr>
<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
</table>
