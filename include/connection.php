<?php
error_reporting(0);
//$con = mysql_connect('localhost','root','random@123');

//$abcd=$_SERVER['REMOTE_ADDR'];
//if($abcd=="172.16.0.52")
//{

//$con = mysql_connect('localhost','test','test');
$con = mysql_connect('localhost','root','141985*.*');
	if(!$con)
		{
			die(mysql_error());
		}
		else
			{
				//mysql_select_db('TEST_TRPL_2019_03_26',$con);
				mysql_select_db('LIVE_TRPL_2019_05_08',$con);
			}
		
//}
//else
//{
//echo "Down Time Please Wait. . .  ";
//}			
		
			
			
date_default_timezone_set('Asia/Calcutta');
$datetime = date("Y-m-d H:i:s");
$revar=mt_rand();
?>

