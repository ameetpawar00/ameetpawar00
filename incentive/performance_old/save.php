<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
$id = $_GET['id'];
if($id == "")
{
$insertSql = "INSERT INTO `incentiveperformance`(`from`, `to`, `action`, `value`, `type`, `createdate`, `modifieddate`, `updatedby`, `status`,  `designation`, `performance`, `outof` ) VALUES ('$post[2]','$post[3]','$post[1]','$post[5]','$post[4]','$datetime','$datetime','$hrmloggedid','1','$post[0]','$post[6]','$post[7]')";
$output = "SuseccFully Inserted In Database";
} 
else
{
$insertSql = "UPDATE `incentiveperformance` SET `from`='$post[2]',`to`='$post[3]',`action`='$post[1]',`value`='$post[5]',`type`='$post[4]',`modifieddate`='$datetime',`updatedby`='$hrmloggedid',`designation`='$post[0]',`performance`='$post[6]',`outof`='$post[7]' WHERE `id` = '$id'";
$output = "SuseccFully Upadted In Database";
}	
mysql_query($insertSql,$con) or die(mysql_error());
?>
BREAKSTRINGFORSAVEDATA
<div class="sucessResp">
<?php echo $output; ?>
</div>

