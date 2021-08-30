<?php
include("../include/conFig.php");
$valto = $_POST['valto'];
$totalids= $_GET['totalids'];
$totalvalues = $_GET['totalvalues'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
$totalids = explode("***",$totalids);
$totalvalues =  explode("*TEXTTOTEXT*",$totalvalues);
print_r($totalids);
print_r($totalvalues);
foreach($totalids as $key => $newval)
{
	if($newval != "")
	{
	mysql_query("INSERT INTO `allotleave`(`designation`, `leavetype`, `leave`, `createdate`, `modifieddate`, `updatedby`) VALUES ('$post[0]','$newval','$totalvalues[$key]','$datetime','$datetime','$hrmloggedid')",$con)or die(mysql_error());
	}
}
$id = mysql_insert_id();
$getData = mysql_query("SELECT allotleave.id,allotleave.leave,allotleave.modifieddate,designation.name,leavetype.name FROM allotleave,designation,leavetype WHERE allotleave.delete = '0' AND  allotleave.leavetype = leavetype.id and allotleave.designation= designation.id"",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);

?>


<div class="success warnings">
Leave Successfully Alloted</div>
BREAKSTRINGFORSAVEDATA
<td><input id="chBxPUTGENERATEDIHEREINNS" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" ></td>
<td style="height:20px;"><?php echo $row[3] ?></td>
<td style="height:20px;" ><?php echo $row[4] ?></td>
<td style="height:20px;"><?php echo $row[1]?></td>
<td style="height:20px;"><?php echo date('d-M-Y h:i:s',strtotime($row[2])) ?></td>
<td>
<img src="img/icons/icons15.png" title="Edit " height="20" width="20" onclick="editDynamic('allotleave/edit.php','<?php echo base64_encode($row[0])?>','fetchrow<?php echo $i?>','edit')">&nbsp;&nbsp;&nbsp;&nbsp;
<img src="img/icons/icons4.png" title="Delete" height="20" width="20" onclick="deleteSingle('<?php echo $row[0]?>','fetchrow<?php echo $i?>','allotleave')">
</td>


