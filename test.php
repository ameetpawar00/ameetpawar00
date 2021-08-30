<?php
include("include/conFig.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <script>
//setInterval(function(){getCount()}, 1000);
function getCount()
{

var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById('notify').innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","getNotification.php",true);
xmlhttp.send();
}

function UpdateData(id)
{

var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById('update').innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","update.php?id="+id,true);
xmlhttp.send();
}
</script>


<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>.::Human Resource Management System::.</title>
<?php include('css.php')?>
</head>
<body>
<?php
require_once "allhidden.php";
?>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td colspan="2">
<div style="height:15px;background:#212121;padding:10px;width:100%;position:fixed">
<img src="<?php echo $rowLogo[0]?>" style="height:25px;" alt="" id="complogo"/>
<div style="float:right;margin-right:10px;color:#fff">
<table cellpadding="0" cellspacing="0" style="margin-right:20px;padding:0px;cursor:pointer">
<tr>
<td valign="top" style="vertical-align:top"> <?php include('attendance/attendance.php')?></td>
<td style="vertical-align:top; padding-right:50px" >

<?php 
			$getemptask = mysql_query("SELECT `read` FROM `task` WHERE `delete` = '0' AND `id` = '$hrmloggedid' ",$con) or die(mysql_error());
			$rowemptask = mysql_fetch_array($getemptask);
			$taskno = $rowemptask['task'];
	if($taskno > 0)
	{
?>
<span class="roundspan red" id="red" style="float:left; margin: 0px 156px 0px 0px; position:absolute"></span>

<?php 
}
?>

<?php
include('task.php');
?>

</td>
<td style="vertical-align:top;" ><img src="user/admin.jpg" onclick="$('#usermenu').slideToggle();"  onclick="$('#usermenu').slideToggle();" style="height:20px;padding:2px"/><em style="vertical-align:top" onclick="$('#usermenu').slideToggle();"><?php echo $hrmloggeduser ?></em> 
<i class="down-arrow" style="vertical-align:top"></i>

<?php
include('usermenu.php');
?>
</td>

<td style="vertical-align:top; width: auto;display:none" >
<!--<img src="img/notification.jpg" onclick="$('#usernoti').slideToggle();"  onmouseout="$('#usernoti').slideToggle();" style="height:20px;padding:2px"/><em style="vertical-align:top" onmouseover="$('#usernoti').slideToggle();"><span id="notify"></span></em> -->
<i class="down-arrow" style="vertical-align:top"></i>

<?php
include('usernoti.php');
?>
</td>
</tr>
</table>


</div>
</div></td>
</tr>
<tr>
<td style="width:15%;background:#3D3D3D;height:1000px;" valign="top">
<?php
require_once "menu.php";
?>
</td>
<td style="width:85%" valign="top">
<div id="manipulateContent" style="padding:10px;margin-top:18px !important">
<?php //include("dash/index.php")?>
</div>
<div id="viewContent" style="padding:10px;margin-top:18px !important">
<br/><br/>
</div>
</td>

</tr>
</table>
<div id="tempSortdata" style="display:none"></div>
</body>
<?php
require_once "resources.php";
?>

</html>