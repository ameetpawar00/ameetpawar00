<?php
include("../../include/conFig.php");
$id=$_GET['id'];
$i=$_GET['i'];
$getData= mysql_query("select * from `city` where `id` = '$id'",$con)or die(mysql_error());
$row=mysql_fetch_array($getData);
?>
<h2 class="title">Edit City <?php echo $row['name']?>
<div class="red awesome small" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" style="float:right">Back To City</div>
</h2>
<div style="background:#fff;height:500px;">
<table width="100%" cellpadding="10" cellspacing="0" class="addNew">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>
<tr style="display:none">
<th style="height: 46px">Country *</th>
<td style="height: 46px"><select name="" id="swsc0" class="input" onchange="changeDrp('swsc0','swsc1','state','country')">
				<option value="">Select Country</option>
				<?php
				$getCountry=mysql_query("select `name` from `country` where `delete` = '0'",$con)or die(mysql_error());
				while($rowCountry=mysql_fetch_array($getCountry))
				{
				?>
				<option <?php if($row['country']== $rowCountry[0]){echo 'selected=selected';}?> value="<?php echo $rowCountry[0]?>"><?php echo $rowCountry[0]?></option>
				<?php
				}
				?>
			</select>
</td>
</tr>
<tr>
<th>State Name *</th>
<td><select name="req" class="input" id="swsc1" >
			<?php
				$getState=mysql_query("select `id`,`name` from `state` where `delete` = '0'",$con)or die(mysql_error());
				while($rowState=mysql_fetch_array($getState))
				{
				?>
				<option <?php if($row['state']== $rowState[0]){echo 'selected=selected';}?> value="<?php echo $rowState[0]?>"><?php echo $rowState[1]?></option>
				<?php
				}
				?>
			</select>
</td>
</tr>
<tr><th>City Name*</th><td><input name="req" type="text" class="input" id="swsc2" value="<?php echo $row['name']?>"/></td></tr>
<tr><th>Description</th>
<td><textarea name="" cols="20" rows="2" class="input" style="width:48%;height:100px;" id="swsc3"><?php echo $row['description']?></textarea>
</td>
</tr>
<tr><td colspan="2" style="text-align:center"><div class="teal awesome small" onclick="SaveData('masters/city/update?id=<?php echo $id;?>&i=<?php echo $_GET['i'];?>','swsc','4','','','couResp','2')">Update City</div>
<div class="red awesome small" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')">Cancle</div>
</td></tr>
</table>

</div>
