<?php
include("../../include/conFig.php");
$eid = $_GET['eid'];
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
//echo "INSERT INTO `task` (`name`, `teamember`, `priority`, `description`, `createdate`,`updatedby` ,`delete`) VALUES ('$post[0]', '$post[1]', '$post[2]', '$post[3]','$datetime', '$hrmloggedid','0')";
mysql_query("INSERT INTO `task` (`name`, `teamember`,`assignby`, `priority`,`duedate`, `description`, `createdate`,`updatedby` ,`delete`) VALUES ('$post[0]', '$post[1]','$hrmloggedid', '$post[2]','$datetime','$post[3]','$datetime', '$hrmloggedid','0')",$con) or die(mysql_error());
$id = mysql_insert_id();


$getask = mysql_query("SELECT * FROM `task` WHERE `delete` = '0' AND `id` = '$id' ",$con) or die(mysql_error());
while($rowtask = mysql_fetch_array($getask))
{
		$member = explode(',',$rowtask['teamember']);
		$name = '';
		$member1 = str_ireplace('-','',$member);
		foreach($member1 as $val)
		{
		if($val)
		{
			$getemp = mysql_query("SELECT `name` FROM `employee` WHERE `id` = '$val' ",$con) or die(mysql_error());
			$getemp = mysql_fetch_array($getemp);
			$name .= $getemp['name'].",";
		
		}
	}		
?>

<div style="color:black;width:200px;padding:0 5 0 5;background:#fcf6d7" >
"<?php echo $rowtask['name']?>" is due on: <?php echo $rowtask['duedate']?> Assign to <?php echo $name ?>
		<hr>
</div>

<?php 
}
?>
