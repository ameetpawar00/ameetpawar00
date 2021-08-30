<?php
include("../include/conFig.php");
$id = base64_decode($_POST['id']);
$day = $_REQUEST['day'];
$status = $_REQUEST['status'];
$action = $_POST['action'];
$getData = mysql_query("SELECT attendance.id,employee.name,attendance.checkin,attendance.checkout,attendance.date,attendance.attendance FROM employee,attendance WHERE employee.id = attendance.employee AND attendance.id = '$id'",$con) or die(mysql_error());
$fetchData = mysql_fetch_array($getData);
$eid = $fetchData['eid'];
//print_r($fetchData);
if($action == "edit")
{
?>
<td>
<?php echo $fetchData[1]?>
</td>
<td>
<?php echo $fetchData[4]?>
</td>
<td>
<?php echo $day ?>
</td>
<td>
<input class="input" name="" title="isNotNull" id="attE0" style="width:70px" type="text" value="<?php echo $fetchData[2]?>" />
</td>
<td>
<input class="input" name="" title="isNotNull" id="attE1" style="width:70px" type="text" value="<?php echo $fetchData[3]?>" />
</td>
<td>
<?php echo $status ?>
</td>
<td>
<?php
$attStatus = $fetchData[5];
if($day != 'Sunday'){
?>
<select name="Select1" id="attE2">
<option value="0" <?php if($attStatus == 0) echo "selected ='selected'";?>>Default</option>
<option value="1" <?php if($attStatus == 1) echo "selected ='selected'";?>>Present</option>
<option value="2" <?php if($attStatus == 2) echo "selected ='selected'";?>>Absent</option>
<option value="3" <?php if($attStatus == 3) echo "selected ='selected'";?>>WO-I</option>
<option value="4" <?php if($attStatus == 4) echo "selected ='selected'";?>>Half Day</option>
</select>
<?php
}
else{
echo "None";
}
?>
</td>

<td style="text-align: center;">
<span style="cursor:pointer;font-size: 20px;color: green;"  title="Update" class="fa fa-check" onclick="SaveData('attendance/update?id=<?php echo $id;?>&i=<?php echo $i;?>','attE','3','','','couResp','2')" >&nbsp;&nbsp;</span>
<span style="cursor:pointer;font-size: 20px;color: red;"  title="Cancel" class="fa fa-remove"  onclick="editDynamic('attendance/edit.php?day=<?php echo $day?>&status=<?php echo $status?>','<?php echo base64_encode($fetchData[0])?>','<?php echo $_POST['rowid']?>','')"></span>
</td>                                                                          
<?php
}
else
{
?>
<td>
<?php echo $fetchData[1]?>
</td>
<td>
<?php echo $fetchData[4]?>
</td>
<td>
<?php echo $day ?>
</td>
<td>
<?php echo $fetchData[2]?>
</td>
<td>
<?php echo $fetchData[3]?>
</td>

<td>
<?php echo $status ?>
</td>
<td>
<?php
$attStatus = $fetchData[5];
if($day != 'Sunday'){
?>
<select name="Select1" id="attE2">
<option value="0" <?php if($attStatus == 0) echo "selected ='selected'";?>>Default</option>
<option value="1" <?php if($attStatus == 1) echo "selected ='selected'";?>>Full Day</option>
<option value="2" <?php if($attStatus == 2) echo "selected ='selected'";?>>Absent</option>
<option value="3" <?php if($attStatus == 3) echo "selected ='selected'";?>>WO-I</option>
<option value="4" <?php if($attStatus == 4) echo "selected ='selected'";?>>Half Day</option>
</select>
<?php
}
else{
echo "None";
}
?>
</td>

<td style="text-align: center;">
<span style="cursor:pointer;font-size: 20px;"  title="Edit Attendance" class="fa fa-edit"  onclick="editDynamic('attendance/edit.php?day=<?php echo $day?>&status=<?php echo $status?>','<?php echo base64_encode($fetchData[0])?>','<?php echo $_POST['rowid']?>','edit')" ></span>&nbsp;&nbsp;

</td>

<?php

}

?>
