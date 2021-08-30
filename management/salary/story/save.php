<?php
include("../../../include/conFig.php");

$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
$eid = $_GET['eid'];

foreach($valto as $val)
	{
		$val = str_ireplace("'","\'",$val);
		$post[] .= $val;
	}
	
	$SQL="INSERT INTO `story`(`subject`, `note`, `employee`, `type`, `updatedby`) VALUES ('$post[0]', '$post[1]', '$eid', 0, $hrmloggedid)";
	mysql_query($SQL,$con) or die(mysql_error());
$output = "Success Full submitted";
?>
<div class="success warnings">
 <?php echo $output; ?></div>
BREAKSTRINGFORSAVEDATA