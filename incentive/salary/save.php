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
$insertSql = "INSERT INTO `incentivesalary`(`gross`,`bonus`,`eid`,`createdate`, `updatedate`, `updatedby`) VALUES ('$post[0]','$post[1]','$post[2]','$datetime','$datetime','$hrmloggedid')";
$output = "SuseccFully Inserted In Database";
} 
else
{
$insertSql = "UPDATE `incentivesalary` SET `gross`='$post[0]',`bonus`='$post[1]',`eid`='$post[2]',`modifieddate`='$datetime',`updatedby`='$hrmloggedid'WHERE `id` = '$id'";
$output = "SuseccFully Upadted In Database";
}	
mysql_query($insertSql,$con) or die(mysql_error());
?>
BREAKSTRINGFORSAVEDATA
<div class="sucessResp">
<?php echo $output; ?>
</div>

