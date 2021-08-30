<?php

session_start();

 ob_start();

error_reporting(0);

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">



<head>

<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />

<title>Untitled 2</title>

</head>



<body>

<center>

<div style="padding-top:200px;width:500px;text-align:left">

<div style="border:2px #0072C6 solid;box-shadow:0px 0px 8px 0px #444;">

<div style="background:#f7f7f7;padding:10px;color:#333;">

	You have been logged in from another device !!! <br/>

	Easy HRM only allows single login from a username at a time.

<br/><br/>

<div style="border-top:2px #ddd solid"></div>

<br/>

<div style="line-height:280%">

<span style="font-size:20px;color:#222;font-weight:bold">

	Please logout your account.</span>

<br/>

<input name="Button1" type="button" value="Logout" class="buttonnegetive" onclick="window.location.href='logout.php';"  />



</div>

</div>

</div>

</div></center>

</body>



</html>

