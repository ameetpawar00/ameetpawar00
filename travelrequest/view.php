<?php
include("../../include/conFig.php");
$id = $_GET['id'];
$i = $_GET['i'];

$getData = mysql_query("SELECT  ",$con) or die(mysql_error());
?>
<h2 class="title">View All Requests<span style="display:inline-block"><?php echo $_GET['msg']?></span>
</h2>

<div style="background:#fff;height:500px;overflow-x:hidden;overflow-y:auto">
<table width="100%" cellpadding="5" cellspacing="0" style="text-align:center" class="fetch">
<tr><th style="width:5%;"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>
	<th style="width:10%;">Employee</th>
	<th>Requested Date</th>
	<th>Status</th>
	<th>Action</th>
</tr>
<?php
$i = 1;
while($row =mysql_fetch_array($getData))
{
?>
<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" /></td>
<td style="color:#000"><?php echo $row[1]?></td>
<td style="color:#000"><?php echo $row[2]?></td>
<td style="color:#000"><?php echo $row[3]?></td>
<td>
<img src="img/icons/icons15.png" title="Edit Employee <?php echo $row[1]?>" height="20" width="20" onclick="getModule('employee/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Employee')"/>&nbsp;&nbsp;&nbsp;&nbsp;
<img src="img/icons/icons4.png" title="Delete Employee <?php echo $row[1]?>" height="20" width="20" onclick="deleteSingle('<?php echo $row[0]?>','fetchrow<?php echo $i?>','employee')"/>

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

</div>
