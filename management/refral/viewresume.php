<?php
include("../../include/conFig.php");
$id=$_GET['id'];
$sql = "SELECT `resume` from `refer` where `delete` = '0' and `id`='$id'";
$getresume = mysql_query($sql,$con) or die(mysql_error());
$row = mysql_fetch_array($getresume);

$filename = "http://webricks.in/hrm-trifid/job-vacancy/resume/".$row[0];
if($row[0] != '')
{
?>
<iframe src="http://docs.google.com/viewer?url=<?php echo urlencode($filename)?>&embedded=true" width="800" height="780" style="border: none;"></iframe>
<?php 
}
else
{
echo '<br/>';
echo '<br/>';
echo '<br/>';
echo '<div align="center" style="font-weight:bold;font-size:20px">Resume Not Available</div>';
}
?>
<div align="center" style="font-weight:bold;font-size:20px"></div>