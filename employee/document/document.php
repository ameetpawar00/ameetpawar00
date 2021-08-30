<?php
	include("../../include/conFig.php");
	$eid = $_GET['eid'];
	$getimge = mysql_query("SELECT `imageaddress`,`type` FROM `emp_images` WHERE `eid` = '$eid' AND `status`=0 ORDER BY `type` ASC",$con) or die(mysql_error());
	//echo "SELECT `imageaddress`,`type` FROM `emp_images` WHERE `eid` = '$eid' AND `status`=0 ORDER BY `type` ASC";
	$ty=1;
	$sdjkf1=0;
	$sdjkf2=0;
	$sdjkf3=0;
	while ($rowimage=mysql_fetch_assoc($getimge))
	{
		$rtssy=$rowimage["type"];
		${"image$rtssy"}=$rowimage["imageaddress"];
		${"sdjkf$rtssy"}=1;
		//echo $rowimage["imageaddress"]."----".$rtssy."<br>";
		$ty++;
	}

?>


<div id="myTitle" style="padding-bottom:5px">
	<div class="title" style="display:inline-block">Document</div>

</div>

<div style="height:450px;overflow-x:hidden;overflow-y:scroll">
	<div class="add-new gray_dark-border" id="addDepen" stylse="display:none">
		<div class="form-head gray_dark">
			<div class="head-title">
				<i class="add-form"></i>
				Add Employee Image</div>
		</div>
		<table cellpadding="10" cellspacing="0" border="0" class="fetch" width="100%">
			<tr>
				<td>
					<a href="employee/document/<?=$image1?>" download="" title="Click Here To Download">
						<img src="employee/document/<?=$image1?>" style="width:150px" title="Click Here To Download">
					</a>
				</td>
				
				<td>
				<td>
					<iframe src="employee/document/attachments/indexApp.php?path=docemp0&type=1" height="100px" width="100%" frameborder="0" scrolling="no"></iframe>
					<input type="text" style="display:none" id="docemp0" value="<?=$image1?>">
				</td>
				<td>
					<button class="button green" onclick="SaveData('employee/document/savedoc?sdjkf=<?=$sdjkf1?>&type=1&eid=<?php echo $eid?>','docemp','1','','','couResp','2');closeMoodle()"><i class="save-icon"></i>Update</button>
				</td>
			</tr>
		</table>
	</div>
	<br>
	<br>
	<div class="add-new gray_dark-border" id="addDepen" stylse="display:none">
		<div class="form-head gray_dark">
			<div class="head-title">
				<i class="add-form"></i>
				Add Aadhar Card </div>
		</div>
		<table cellpadding="10" cellspacing="0" border="0" class="fetch" width="100%">
			<tr>
				<td>
					<a href="employee/document/<?=$image2?>" download="" title="Click Here To Download">
						<img src="employee/document/<?=$image2?>" style="width:150px" title="Click Here To Download" >
					</a>
				</td>
				
				<td>
				<td>
					<iframe src="employee/document/attachments/indexApp.php?path=docaadar0&type=2" height="100px" width="100%" frameborder="0" scrolling="no"></iframe>
					<input type="text" style="display:none" id="docaadar0" value="<?=$image2?>">
				</td>
				<td>
					<button class="button green" onclick="SaveData('employee/document/savedoc?sdjkf=<?=$sdjkf2?>&type=2&eid=<?php echo $eid?>','docaadar','1','','','couResp','2');closeMoodle()"><i class="save-icon"></i>Update</button>
				</td>
			</tr>
		</table>
	</div>
	<br>
	<br>
	<div class="add-new gray_dark-border" id="addDepen" stylse="display:none">
		<div class="form-head gray_dark">
			<div class="head-title">
				<i class="add-form"></i>
				Add Other Document</div>
		</div>
		<table cellpadding="10" cellspacing="0" border="0" class="fetch" width="100%">
			<tr>
				<td>
					<a href="employee/document/<?=$image3?>" download="" title="Click Here To Download">
						<img src="employee/document/<?=$image3?>" style="width:150px"  title="Click Here To Download">
					</a>
				</td>
				
				<td>
				<td>
					<iframe src="employee/document/attachments/indexApp.php?path=docect0&type=3" height="100px" width="100%" frameborder="0" scrolling="no"></iframe>
					<input type="text" style="display:none" id="docect0" value="<?=$image3?>">
				</td>
				<td>
					<button class="button green" onclick="SaveData('employee/document/savedoc?sdjkf=<?=$sdjkf3?>&type=3&eid=<?php echo $eid?>','docect','1','','','couResp','2');closeMoodle();"><i class="save-icon"></i>Update</button>
				</td>
			</tr>
		</table>
	</div>
</div>




