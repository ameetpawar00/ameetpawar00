<?php
$getData = mysql_query("SELECT travel.id,employee.name,department.name,travel.place,travel.purpose FROM employee,travel,department WHERE employee.id = travel.eid AND department.id = travel.deptid AND travel.delete = '0' AND travel.eid = '$hrmloggedid' ORDER BY travel.id DESC LIMIT 100",$con) or die(mysql_error());
?>
<table width="100%" cellpadding="5" cellspacing="0" style="text-align:center;border-bottom:none" class="mytable" >
<tr><th style="width:5%"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>
<th style="height: 20px;">Owner</th>
<th style="height: 20px;">Department</th>
<th style="height: 20px;">Place Of Visit</th>
<th style="height: 20px;">Purpose Of Visit</th>
<th style="height: 20px;">Action</th>
</tr>
<?php
$i = 1;
while($row =mysql_fetch_array($getData))
{
?>
<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" /></td>
<td style="height: 20px;" ><?php echo $row[1] ?></td>
<td style="height: 20px;" ><?php echo $row[2] ?></td>
<td style="height: 20px;" ><?php echo $row[3] ?></td>
<td style="height: 20px;" ><?php echo $row[4] ?></td>
<td>
<img src="img/icons/icons15.png" title="Edit Source <?php echo $row['name']?>" height="20" width="20" onclick="getModule('travel/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Travel')"/>&nbsp;&nbsp;&nbsp;&nbsp;
<img src="img/icons/icons10.png" style="display:none" title="View Requests" height="20" width="20" onclick="getModule('travelrequests/view?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Travel')"/>
<img src="img/icons/icons4.png" title="Delete Source <?php echo $row['name']?>" height="20" width="20" onclick="deleteSingle('<?php echo $row[0]?>','fetchrow<?php echo $i?>','travel')"/>

</td>
</tr>
<?php
$i++;
$Maxid = $row['id'];
$MaxI = $i;
}
?>

<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
</table>

<?php
include('../pagination/pages.php');
?>
