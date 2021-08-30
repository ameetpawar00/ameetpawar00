<?php
$getOwner = mysql_query("SELECT `id` FROM `travel` WHERE `eid` = '$hrmloggedid'",$con) or die(mysql_error());

//$getDept = mysql_query("SELECT `department` FROM `employee` WHERE `id` = '$hrmloggedid'",$con) OR die(mysql_error());
//$rowDept = mysql_fetch_array($getDept);
$newUser = "-".$hrmloggedid."-";
?>
<table width="100%" cellpadding="5" cellspacing="0" style="text-align:center;border-bottom:none" class="mytable" >
<tr><th style="width:5%"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>
<th style="width:20%; height: 30px;">Owner</th>
<th style="height: 30px">Department</th>
<th style="height: 30px">Place Of Visit</th>
<th style="height: 30px">Purpose Of Visit</th>
<th style="height: 30px;display:">Action</th>
</tr>
<?php
$i = 1;
//echo "SELECT travel.id,employee.name,department.name,travel.place,travel.purpose FROM employee,travel,department WHERE employee.id = travel.eid AND travel.deptid = '$rowDept[0]' AND (travel.users LIKE '%$newUser%' OR travel.eid = '$hrmloggedid') AND travel.deptid = department.id  AND travel.delete = '0' ORDER BY travel.id DESC LIMIT 100";
$getData = mysql_query("SELECT travel.id,employee.name,department.name,travel.place,travel.purpose,travel.eid FROM employee,travel,department WHERE employee.id = travel.eid  AND (travel.users LIKE '%$newUser%' OR travel.eid = '$hrmloggedid') AND travel.deptid = department.id  AND travel.delete = '0' ORDER BY travel.id DESC LIMIT 100",$con) or die(mysql_error());
while($row =mysql_fetch_array($getData))
{
?>
<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" /></td>
<td style="color:#007fc0;width:200px" <?php if($row[5] == $hrmloggedid) { ?> onclick="getModule('travel/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Travel')" <?php } else { ?> onclick="getModule('travel/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>&cust=1','manipulatemoodleContent','viewmoodleContent','Travel')" <?php } ?>><?php echo $row[1] ?></td>
<td style="color:#000;width:200px" ><?php echo $row[2] ?></td>
<td style="color:#000;width:200px" ><?php echo $row[3] ?></td>
<td style="color:#000;width:200px" ><?php echo $row[4] ?></td>
<?php
//echo "SELECT * FROM `travel` WHERE `departuredate` < '$date' AND `id` = $row[0]";
$getDate = mysql_query("SELECT * FROM `travel` WHERE `departuredate` < '$date' AND `id` = $row[0]",$con) or die(mysql_error);
$getEntry = mysql_query("SELECT `id` FROM `travelexpense` WHERE `travelid` = '$row[0]'",$con) or die(mysql_error());
$count = mysql_num_rows($getEntry);
$fetchTravelid = mysql_fetch_array($getEntry);
?>
<td>
<?php
if($row[5] == $hrmloggedid) 
{
?>
<img src="img/icons/icons15.png" title="Edit Travel" height="20" width="20" onclick="getModule('travel/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Travel')"/>&nbsp;&nbsp;&nbsp;&nbsp;
<?php
}
else
{ 
	if(mysql_num_rows($getDate) > 0)
	{
		if($count == 0)
		{
		?>
		<img src="img/icons/icons30.png" title="Add Expense" height="20" width="20" onclick="getModule('travelexpense/add?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Travel')"/>&nbsp;&nbsp;&nbsp;&nbsp;
		<?php
		}
		else
		{
		?>
		<img src="img/icons/icons15.png" title="Edit Expense" height="20" width="20" onclick="getModule('travelexpense/edit?id=<?php echo $fetchTravelid[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Travel')"/>&nbsp;&nbsp;&nbsp;&nbsp;
		<?php
		}
	}
}
}
?>
</td>
</tr>
<?php
$i++;
$Maxid = $row[0];
$MaxI = $i;
?>

<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
</table>
<?php
include('../pagination/pages.php');
?>
