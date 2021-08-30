<?php
error_reporting(0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>.::Human Resource Management System::.</title>
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="css/color.css" />
<link rel="stylesheet" href="css/icon.css" />
<link rel="stylesheet" href="css/common.css" />

</head>
<body >
<?php
require_once "allhidden.php";

?>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td colspan="2">
<div style="height:15px;background:#212121;padding:10px;width:100%;position:fixed">
<img src="images/logo.png" style="height:15px;" alt=""/>
</div>
<div style="float:right;margin-right:10px;color:#fff">
<img src="icons/notification.png" />

</div>
</td>
</tr>
<tr>
<td style="width:15%;background:#3D3D3D;height:1000px;" valign="top">
<?php
require_once "menu.php";

?>

</td>
<td style="width:85%" valign="top">
<div id="manipulateContent"></div>
<div id="viewContent" style="padding:10px;">
<br/><br/>
<?php
include('crude/view.php');
?>
</div>
</td>

</tr>
</table>
</body>
<?php
require_once "common.php";
require_once "resources.php";

?>

</html>