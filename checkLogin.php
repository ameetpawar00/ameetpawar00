<?php

session_start();

ob_start();

error_reporting(0);

include("include/connection.php");

$loggeduserid = $_COOKIE['hrmloggeduserid'];

if($_GET['force'] == 1)
{

mysql_query("UPDATE `login` SET `logout` = '1' WHERE `userid` = '$loggeduserid'",$con) or die(mysql_error());

}

$getLog = mysql_query("SELECT COUNT(`id`) FROM `login` WHERE `logout` = '0' AND `userid` = '$loggeduserid'",$con) or die(mysql_error());

$rowLog = mysql_fetch_array($getLog);

if($rowLog[0] == 0)
{

				if(isset($_COOKIE['auth']))

				{

				$auth = $_COOKIE['auth'];

				}

				else

				{

				$auth = time().rand(2000,200000);

				setcookie("auth",$auth,$expire,"/");

				}
				mysql_query("INSERT INTO `login`(`cookie`, `login`, `userid`) VALUES ('$auth','1','$loggeduserid')",$con) or die(mysql_error());
				header("location:default.php");
}

else

{

$force = 1;

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link href="css/common.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body style="background: #eee;">

<?php

if($force == 1)

{

?><center>
<div style="padding-top: 200px; width: 500px; text-align: left">
	<div style="border: 2px #0072C6 solid; box-shadow: 0px 0px 8px 0px #444;">
		<div style="background: #f7f7f7; padding: 10px; color: #333;">
			Oops!! It appears that another session with the same username is already 
			running some where else.<br />
			Easy HRM only allows login through a username on one machine at a time.
			<br />
			<br />
			<div style="border-top: 2px #ddd solid">
			</div>
			<br />
			<div style="line-height: 280%">
				<span style="font-size: 20px; color: #222; font-weight: bold">What 
				do you want to do?</span> <br />
				<input class="buttonGreen" name="Button1" onclick="window.location='checkLogin.php?force=1';" type="button" value="Force Login" />&nbsp;&nbsp;
				<input class="buttonnegetive" name="Button1" onclick="window.location='alreadyLoggedin.php';" type="button" value="Back To Login" />
			</div>
		</div>
	</div>
</div>
</center><?php

}

else

{

echo "Redirecting You In A Moment..";

}

?>

</body>

</html>
