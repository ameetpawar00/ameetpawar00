<?php
include("../../include/conFig.php");
$getData = mysql_query("SELECT * FROM `branch` WHERE `delete` = '0' AND `id` != '1' ORDER BY `name` ASC",$con) or die(mysql_error());
?>
<h2 class="title">View All Branch<span style="display:inline-block"><?php echo $_GET['msg']?></span>
<div class="red awesome small"  onclick="deleteData('branch','branch')"  style="float:right;margin-left:10px">Delete Selected</div>&nbsp;&nbsp;&nbsp;
<div class="blue awesome small" onclick="getModule('masters/branch/index','manipulateContent','viewContent','Branch')" style="float:right">Add Branch</div>

</h2>

<div style="background:#fff;height:500px;overflow-x:hidden;overflow-y:auto">
<table width="100%" cellpadding="5" cellspacing="0" style="text-align:center" class="fetch">
<tr><th style="width:5%; height: 30px;"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>
<th style="width:20%; height: 30px;">Name</th><th style="height: 30px">Description</th>
<th style="height: 30px">Modified</th><th style="height: 30px">Action</th>
</tr>
<?php
$i = 1;
while($row =mysql_fetch_array($getData))
{
?>
<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
<td style="color:#000"><?php echo $row['name'] ?></td>
<td style="color:#000"><?php echo $row['description'] ?></td>
<td style="color:#000"><?php echo date('d-M-Y h:i:s',strtotime($row['modifieddate'])) ?></td>
<td>
<img src="img/icons/icons15.png" title="Edit Branch <?php echo $row['name']?>" height="20" width="20" onclick="getModule('masters/branch/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Branch')"/>&nbsp;&nbsp;&nbsp;&nbsp;
<img src="img/icons/icons4.png" title="Delete Branch <?php echo $row['name']?>" height="20" width="20" onclick="deleteSingle('<?php echo $row[0]?>','fetchrow<?php echo $i?>','branch')"/>

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
