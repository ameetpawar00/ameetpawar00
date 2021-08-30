<?php
include("../include/conFig.php");

/*$_GET['userids']="1518,616,188,";
$_GET['smonth']="04";
$_GET['syear']="2019";
$_GET['g']="10";*/

//$valto = $_POST['valto']="$*$*116*$*$*4*$*$*7*$*$*44*$*$*117*$*$*4*$*$*13*$*$*4*$*$*5*$*$*4*$*$*115*$*$*4*$*$*107*$*$*44*$*$*10*$*$*4*$*$*113*$*$*44*$*$*20*$*$*44*$*$*116*$*$*5*$*$*7*$*$*40*$*$*117*$*$*5*$*$*13*$*$*5*$*$*5*$*$*5*$*$*32*$*$*0*$*$*115*$*$*5*$*$*107*$*$*30*$*$*10*$*$*5*$*$*113*$*$*68*$*$*20*$*$*58*$*$*116*$*$*5*$*$*7*$*$*26*$*$*117*$*$*5*$*$*13*$*$*5*$*$*115*$*$*5*$*$*107*$*$*32*$*$*10*$*$*5*$*$*113*$*$*32*$*$*20*$*$*42";
$valto = $_REQUEST['valto'];
$smonth = $_REQUEST['smonth'];
$syear = $_REQUEST['syear'];

$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
$count = count($post);
$userids= explode(",",$_REQUEST['userids']);
$myValue= 1;
$totalKpi=$_REQUEST['g'];
$loopTotal =$totalKpi*2;
$loopMax = $loopTotal+1;



foreach($userids as $valUser)
{


	if($valUser != "")
	{
		$userid = $valUser;

		for($a=$myValue;$a<$loopMax;$a++)
		{
			$kpiid =  $post[$a];
			$a=$a+1;
			$value =  $post[$a];
            // echo $kpiid."--".$value."<br>";
            $query = "SELECT `id` FROM `kpi` WHERE `employee` = '$userid'  AND `kpiparameter` = '$kpiid' AND `month` = '$smonth' AND `year` = '$syear' AND `delete`='0'";
            $getCount = mysql_query($query,$con) or die(mysql_error());
			if(mysql_num_rows($getCount) > 0)
			{
			$rowCount = mysql_fetch_array($getCount);
			$sql = "UPDATE `kpi` SET `marks`= '$value', `modifieddate`= '$datetime',`updatedby`= '$hrmloggedid',`year`= '$syear' WHERE `id` = $rowCount[0]"; 
			}
			else  
			{
			$sql = "INSERT INTO `kpi`(`employee`, `kpiparameter`, `marks`, `date`, `month`, `createdate`, `modifieddate`, `updatedby`, `year`) VALUES ('$userid','$kpiid','$value','$date','$smonth','$datetime','$datetime', '$hrmloggedid', '$syear')";
			}
			//echo $sql."<br><br>";
			mysql_query($sql,$con) or die(mysql_error($con));
		}
		  $myValue=$loopMax;
		  $loopMax=$loopMax+$loopTotal;
	  }
}
?>
BREAKSTRINGFORSAVEDATA