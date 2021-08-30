<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
$i = $_GET['i'];
$id = $_GET['id'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
mysql_query("UPDATE `seperation` SET `eid`='$post[0]',`seperationdate`='$post[1]',`reportto`='$post[2]',`reason`='$post[3]',`updatedate`='$datetime',`updatedby`='$hrmloggedid' WHERE  `id` = '$id'",$con) or die(mysql_error());
$getData = mysql_query("SELECT seperation.id,e1.name,seperation.seperationdate,e2.name,reasonforleaving.name FROM seperation,employee AS e1,employee AS e2,reasonforleaving WHERE e1.id = seperation.eid AND e2.id = seperation.reportto AND seperation.reason = reasonforleaving.id AND seperation.delete = '0'",$con) or die(mysql_error());
$row=mysql_fetch_array($getData);

}
?>

<div class="success warnings">
Exit Details Updated Successfully</div>
BREAKSTRINGFORSAVEDATA
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $id;?>"></td>
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" /></td>
<td ><?php echo $row[1]?></td>
<td ><?php echo $row[2]?></td>
<td ><?php echo $row[3]?></td>
<td><?php echo $row[4]?></td>
<td>
<img src="img/icons/icons15.png" title="Edit Exit Details For <?php echo $row[1]?>" height="20" width="20" onclick="getModule('exitdetails/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Exit Details')"/>&nbsp;&nbsp;
<img src="img/icons/icons10.png" title="Edit Questions For <?php echo $row[1]?>" height="20" width="20" onclick="getModule('exitdetails/viewques?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulatemoodleContent','viewmoodleContent','Exit Details')"/>&nbsp;&nbsp;
<img src="img/icons/icons10.png" title="Edit Checklist For <?php echo $row[1]?>" height="20" width="20" onclick="getModule('exitdetails/viewchklist?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulatemoodleContent','viewmoodleContent','Exit Details')"/>&nbsp;&nbsp;
<img src="img/icons/icons4.png" title="Delete Exit Details For <?php echo $row[1]?>" height="20" width="20" onclick="deleteSingle('<?php echo $row[0]?>','fetchrow<?php echo $i?>','seperation')"/>

</td>


