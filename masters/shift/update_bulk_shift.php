<?php
include("../../include/conFig.php");
print_r($_POST);
$new_shift=$_POST["new_shift"];
$Checkbox=$_POST["Checkbox"];
foreach($Checkbox as $Checkbox_id)
{
	
	mysql_query("UPDATE `employee` SET `shift`='$new_shift' WHERE `id` = '$Checkbox_id'",$con);
	

}
echo " <script>alert('shift Updated Sucessfully');</script>";
echo " <script>window.parent.location='../../default.php#bWFzdGVycy9zaGlmdC92aWV3$$**$$"."dmlld0NvbnRlbnQ=$$**$$"."bWFuaXB1bGF0ZUNvbnRlbnQ=$$**$$"."U2hpZnQ=';</script>";

?>