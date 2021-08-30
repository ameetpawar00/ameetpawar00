<?php session_start();
	//ob_start();



	
	/**
	 * @param $input
	 * @return bool|string
	 */
	function base64CustomDe($input)
	{
		$custom = 'ZYXWVUTSRQPONMLKJIHGFEDCBAzyxwvutsrqponmlkjihgfedcba9876543210+/';
		$default = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';
		return $decoded = base64_decode(strtr($input, $custom, $default));
	}
	
	
	/**
	 * @param $input
	 * @return string
	 */
	function base64Custom($input)
	{
		$default = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
		$custom = "ZYXWVUTSRQPONMLKJIHGFEDCBAzyxwvutsrqponmlkjihgfedcba9876543210+/";
		return $encoded = strtr(base64_encode($input), $default, $custom);
	}

	
	date_default_timezone_set('Asia/Calcutta');
	include("connection.php");
	if(isset($_COOKIE['hrmloggeduserid']))
	//if(isset($_COOKIE['hrmloggeduseridasd']))
	{
		$getCookie = $_COOKIE['auth'];
		$getLog = mysql_query("SELECT COUNT(`id`) FROM `login` WHERE `cookie` = '$getCookie' AND `logout` = '0'",$con) or die(mysql_error());
		$rowLog = mysql_fetch_array($getLog);
		if($rowLog[0] == 0)
		{
			header("location:../alreadyLoggedin.php");
		}
		else
		{
			$hrmloggeduser = $_COOKIE['hrmloggedname'];
			$hrmloggedid = $_COOKIE['hrmloggeduserid'];
			$permission = $_COOKIE['permission'];
			$hrmDOJ = $_COOKIE['hrmDOJ'];
			$hrmDOJl = $_COOKIE['hrmDOJl'];
			$hrmDOJp = $_COOKIE['hrmDOJp'];
			$thisper = explode(",",$permission);
			$loggedDesig = $_COOKIE['hrmdesig'];
			$salaryIdNew = $_COOKIE['salaryIdNew'];
			$designation = $_COOKIE['designation'];
			#$profilePer = mysql_query("SELECT `permission` FROM `employee` WHERE `id` = '$loggeduserid'",$con) or die(mysql_error());
			#$permis = mysql_fetch_array($profilePer);
			#$thisPer = explode(",",$permis[0]);
			#$datetime = date("Y-m-d H:i:s");
			#$date = date("Y-m-d");
			$datetime = date("Y-m-d H:i:s");
			$date = date("Y-m-d");
			$year = date('Y');
			$month = date('m');
		}
	}
	else
	{
		header("location:index.php");
		//header("location:down.html");
		//echo "123";
	}

?>
