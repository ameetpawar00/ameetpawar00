<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
$count  = count($post);
$desig = $post[0];
for($i=1;$i<$count;$i++)
{
$leaveId = $post[$i];
$i=$i+1;
$value = $post[$i];
 	$getChk =mysql_query("SELECT `id` FROM `leavepolicy` WHERE `leaveid` = '$leaveId' and `designation` = '$desig'  ",$con) or die(mysql_error());
 	if(mysql_num_rows($getChk) > 0 )
 	{
 	
 	$rowChk = mysql_fetch_array($getChk);
 	$lId = $rowChk[0];
 	$insertSql = "UPDATE `leavepolicy` SET `value`='$value',`modifieddate`='$datetime',`updatedby`='$hrmloggedid'  WHERE  `id` = '$lId'";
 	}
 	else
 	{
 	$insertSql ="INSERT INTO `leavepolicy`(`designation`, `leaveid`, `value`, `createdate`, `modifieddate`, `updatedby`,`remaining`,`year`) VALUES ('$desig','$leaveId','$value','$datetime','$datetime','$hrmloggedid','$value','$year')";
 	}
 	mysql_query($insertSql,$con) or die(mysql_error());
 	
}
$output = "Success Full submitted";
?>
<div class="success warnings">
 <?php echo $output; ?></div>
BREAKSTRINGFORSAVEDATA


