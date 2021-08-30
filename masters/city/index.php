<?php
include("../../include/conFig.php");
?>
<h2 class="title">Add New City
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
				$getCountry=mysql_query("select `name` from country where `delete` = '0'",$con)or die(mysql_error());
				while($rowCountry=mysql_fetch_array($getCountry))
				{
				?>
				<option value="<?php echo $rowCountry[0]?>"><?php echo $rowCountry[0]?></option>
				<?php
				}
				?>
			</select>
</td>
</tr>
<tr>
<th>State Name *</th>
<td><select name="req" class="input" id="swsc1" >
				<option value="">Select A State</option>
				<?php
				$getCountry=mysql_query("select `name` from `state` where `delete` = '0'  order by `name` asc",$con)or die(mysql_error());
				while($rowCountry=mysql_fetch_array($getCountry))
				{
				?>
				<option value="<?php echo $rowCountry[0]?>"><?php echo $rowCountry[0]?></option>
				<?php
				}
				?>

			</select>
</td>
</tr>
<tr><th>City Name*</th><td><input name="req" type="text" class="input" id="swsc2" /></td></tr>
<tr><th>Description</th>
<td><textarea name="" cols="20" rows="2" class="input" style="width:48%;height:100px;" id="swsc3"></textarea>
</td>
</tr>
<tr><td colspan="2" style="text-align:center"><div class="teal awesome small" onclick="SaveData('masters/city/save','swsc','4','','','couResp','1')">Save City</div>
<div class="red awesome small" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')">Cancle</div>
</td></tr>
</table>

</div>
