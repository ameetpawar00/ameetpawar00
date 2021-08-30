<?php
include("../../include/conFig.php");
?>
<h2 class="title">Add New State
<div class="red awesome small" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" style="float:right">Back To State</div>
</h2>
<div style="background:#fff;height:500px;">
<table width="100%" cellpadding="10" cellspacing="0" class="addNew">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>
<tr>
<th style="height: 46px">Country *</th>
<td style="height: 46px"><select name="req" id="swss0" class="input">
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
<td><input name="req" type="text" class="input" style="width:240px;" id="swss1"  />
</td>
</tr>
<tr><th>Description</th>
<td><textarea name="" cols="20" rows="2" class="input" style="width:48%;height:100px;" id="swss2"></textarea>
</td>
</tr>
<tr><td colspan="2" style="text-align:center"><div class="teal awesome small" onclick="SaveData('masters/state/save','swss','3','','','couResp','1')">Save State</div>
<div class="red awesome small" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')">Cancle</div>
</td></tr>
</table>

</div>
