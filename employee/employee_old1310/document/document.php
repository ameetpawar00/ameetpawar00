<?php
include("../../include/conFig.php");
$eid = $_GET['eid'];
$getData = mysql_query("SELECT * FROM `document` WHERE `updatedby` = '$hrmloggedid' AND `delete` = '0' ",$con) or die(mysql_error());
?>


<div id="myTitle" style="padding-bottom:5px">
<div class="title" style="display:inline-block">Document</div>

</div>

<div class="add-new gray_dark-border" id="addDepen" stylse="display:none">
<div class="form-head gray_dark">
<div class="head-title"> 
<i class="add-form"></i> 
Add Documents</div>
</div>
</div>
<br/>
<html>
<body>
<table cellpadding="10" cellspacing="0" border="0" class="fetch">
<?php 
$i = 0;
while($fetch = mysql_fetch_array($getData))
{
?>
<tr>
<td><strong><?php echo $fetch['name']?></strong></td>
<td><iframe src="employee/document/attachments/indexApp.php?path=doc<?php echo $i?>&type=<?php echo $fetch['type']?>" height="100px" width="200px" frameborder="0" scrolling="no"></iframe>
	<input type="text" style="display:none" id="doc<?php echo $i?>"/>
</td>
<td>
<button class="button green" onclick="SaveData('employee/document/savedoc','doc','<?php echo $i+1?>','','','couResp','2')"><i class="save-icon"></i>Update</button>
</td>
</tr>
<?php
$i++;

}
?>
</table>
</body>
</html>

	

