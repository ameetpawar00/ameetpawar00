<?php
include("../../include/conFig.php");
?>
<h2 class="title">View All States
<span style="display:inline-block"><?php echo $_GET['msg']?></span>
<?php
if(in_array('D_M20',$thisPer))
{
?>
<div class="red awesome small" style="float:right;margin-left:10px" onclick="deleteData('state','States')" >Delete Selected</div>&nbsp;&nbsp;&nbsp;
<?php } 
if(in_array('A_M20',$thisPer))
{
?>
<div class="orange awesome small" onclick="getModule('masters/state/index','manipulateContent','viewContent','State')" style="float:right">+ Add State</div>
<?php } ?>
</h2>

<div style="background:#fff;height:500px;overflow-x:hidden;overflow-y:auto">
<table width="100%" cellpadding="5" cellspacing="0" style="text-align:center" class="fetch">
<tr><th style="width:5%"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th><th style="width:20%">Name</th><th>Description</th><th>Modified</th><th>Action</th>
</tr>
<?php
$i = 1;
$getData = mysql_query("select * from `state` where `delete`= '0'  ORDER BY `name` asc limit 50",$con)or die(mysql_error());
while($row =mysql_fetch_array($getData))
{
?>
<tr <?php if($_GET['id']==$row['id']){?> class="d<?php echo $i%2?>" <?php } else { 'class="showmessage"';}?> id="fetchrow<?php echo $i?>">
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
<td><?php echo $row['name'] ?></td>
<td><?php echo $row['description'] ?></td>
<td><?php echo date('d-M-Y h:i:s',strtotime($row['modifieddate'])) ?></td>
<td>
<?php 
if(in_array('U_M20',$thisPer))
{
?>
<img src="images/edit.png" title="Edit Country <?php echo $row['name']?>" height="20" width="20" onclick="getModule('masters/state/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','States')"/>&nbsp;&nbsp;&nbsp;&nbsp;
<?php } 
if(in_array('D_M20',$thisPer))
{
?>
<img src="images/delete.png" title="Delete State <?php echo $row['name']?>" height="20" width="20" onclick="deleteSingle('<?php echo $row[0]?>','fetchrow<?php echo $i?>','state')"/>
<?php } ?>
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
