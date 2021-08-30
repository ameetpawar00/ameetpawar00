<?php
include("../../include/conFig.php");
$data = $_GET['data'];
$data = explode("--",$data);
$count = $_GET['count'];
if($count == 'ALL')
{
$strcount = '';
}
else
{
$strcount = "LIMIT ".$count;
}

?>
<table width="100%" cellpadding="5" cellspacing="0" style="text-align:center" class="fetch">
<?php
$i=$data[1];
echo $sql = "SELECT * FROM `checklist` WHERE `delete` = '0' AND `id` != '1' AND `id` < '$data[0]' ORDER BY `id` DESC ".$strcount;
$getData = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($getData))
{
?>
<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
<td style="color:#000"><?php echo $row['name'] ?></td>
<td style="color:#000"><?php echo $row['description'] ?></td>
<td style="color:#000"><?php echo date('d-M-Y h:i:s',strtotime($row['modifieddate'])) ?></td>
<td>
<img src="img/icons/icons15.png" title="Edit Checklist <?php echo $row['name']?>" height="20" width="20" onclick="getModule('masters/checklist/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Checklist')"/>&nbsp;&nbsp;&nbsp;&nbsp;
<img src="img/icons/icons4.png" title="Delete Checklist <?php echo $row['name']?>" height="20" width="20" onclick="deleteSingle('<?php echo $row[0]?>','fetchrow<?php echo $i?>','checklist')"/>

</td>
</tr>
<?php
$i++;
$Maxid = $row[0];
$MaxI = $i;
}
?>
</table>
THISISUSEDTOBREAKSTRING
<?php echo $Maxid."--".$MaxI;?>
