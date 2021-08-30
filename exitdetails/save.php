<?php
include("../include/conFig.php");
$chkId = $_GET['chkId'];
$qesId = $_GET['qesId'];
$quesanswer = $_GET['quesanswer'];
$chkanswer = $_GET['chkanswer'];
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("INSERT INTO `seperation` ( `eid`, `seperationdate`,`reportto`, `reason`, `createdate`, `updatedby`) VALUES ('$post[0]', '$post[1]', '$post[2]', '$post[3]', '$datetime', '$hrmloggedid')",$con) or die(mysql_error());
$lastid =  mysql_insert_id();

$qesId = explode(",",$qesId);
$quesanswer= explode("*TEXTTOTEXT*",$quesanswer);
foreach($qesId as $qKey => $qVal)
{
	if($qVal != "")
	{
	mysql_query("INSERT INTO `seperationquestion`( `sepid`, `quesid`, `answer`, `createdate`, `updatedate`, `updatedby`) VALUES ('$lastid','$qVal','$quesanswer[$qKey]','$datetime','$datetime','$hrmloggedid')",$con) or die(mysql_error());
	}
}

$chkId  = explode(",",$chkId);
$chkanswer = explode("*TEXTTOTEXT*",$chkanswer);
foreach($chkId as $chkKey => $chkVal)
{
	if($chkVal != "")
	{
	mysql_query("INSERT INTO `seperationchecklist`( `sepid`, `checklistid`, `answer`, `createdate`, `updatedate`, `updatedby`) VALUES ('$lastid','$chkVal','$chkanswer[$chkKey]','$datetime','$datetime','$hrmloggedid')",$con) or die(mysql_error());
	}
}
?>
BREAKSTRINGFORSAVEDATA
<div class="sucessResp">
Exit Details Saved Successfully</div>

