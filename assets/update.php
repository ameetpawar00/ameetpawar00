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
}
mysql_query("UPDATE `asset` SET `typeofasset`='$post[1]',`givendate`='$post[2]',`returndate`='$post[3]',`details`='$post[4]',`eid`='$post[0]',`modifieddate` = '$datetime', `updatedby`  = '$hrmloggedid' WHERE `id` = '$id'",$con);
$getData=mysql_query("SELECT asset.id,employee.name,typeofasset.name,asset.givendate,asset.returndate FROM asset,typeofasset,employee WHERE employee.id = asset.eid AND typeofasset.id = asset.typeofasset AND asset.id = '$id'",$con)or die(mysql_error());
$row=mysql_fetch_array($getData);
?>

<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" /></td>
<td style="color:#000;width:200px" ><?php echo $row[1] ?></td>
<td style="color:#000;width:200px" ><?php echo $row[2] ?></td>
<td style="color:#000" width="250px"><?php echo date('d-M-Y h:i:s',strtotime($row[3])) ?></td>
<td style="color:#000" width="250px"><?php echo date('d-M-Y h:i:s',strtotime($row[4])) ?></td>
<td>
<img src="img/icons/icons15.png" title="Edit Source <?php echo $row['name']?>" height="20" width="20" onclick="getModule('assets/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Assets')"/>&nbsp;&nbsp;&nbsp;&nbsp;
<img src="img/icons/icons4.png" title="Delete Source <?php echo $row['name']?>" height="20" width="20" onclick="deleteSingle('<?php echo $row[0]?>','fetchrow<?php echo $i?>','asset')"/>
</td>
BREAKSTRINGFORSAVEDATA
<div class="sucessResp">
Source Of Hire Updated Successfully</div>

