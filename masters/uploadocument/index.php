<?php 
include("../../include/conFig.php");
error_reporting(0);
$sql = "SELECT * FROM `uploadocument` WHERE `delete` = '0' ";
$getData = mysql_query($sql,$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
$row['description'];
$row['document'];
?>
<div class="title">Upload Policy</div>
<div class="strip">
<span>Dashboard</span>
<span>Upload Policy</span>
</div>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
<?php if(in_array('a_cmpp',$thisper)) 
{
?>
<button class="button blue" onclick="getModule('masters/uploadocument/view','manipulateContent','viewContent','Upload Document')"> <i class="plus"></i>Change Policy</button>&nbsp;&nbsp;
<?php 
} 
?>
&nbsp;<button class="button gray" onclick="getModule('masters/index','manipulateContent','viewContent','Setup');">
		<i class="back"></i>Back</button>

</td>
</tr>
</table>

<div style="overflow-x:hidden;overflow-y:scroll;height:500px">
<div class="add-new blue-border">
<div class="form-head blue">
<div class="head-title"> 
<i class="add-form"></i> 
Upload Policy</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>
<tr></tr>
<?php 
if($row['description'] == "")
{
?>
<tr>
<th>Click on link to download policy<span>*</span></th>
<td><a href="masters/uploadocument/doucuments/<?php echo $row['document']; ?>">Click here</a></td>
</tr>
<?php 
}
?>
<?php 
if($row['document'] == "")
{
?>
<tr>
<th>Company Policy<span>*</span></th>
<td><textarea class="input huge" name="TextArea" type="" id="" readonly="readonly"><?php echo $row['description']?> </textarea>
</td>
</tr>
<?php 
}
?>
<tr>
<td colspan="2">
<div id="permission" >
		</div>
</td>
</tr>
</table>
	</div>
</div>
