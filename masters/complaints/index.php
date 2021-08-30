<?php
include("../../include/conFig.php");
?>
<h2 class="title">Add New Complaint
<div class="red awesome small" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')" style="float:right">Back To Cmplaints</div>
</h2>
<div style="background:#fff;height:500px;">
<table width="100%" cellpadding="10" cellspacing="0" class="addNew">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>

<tr>
<th>Name *</th>
<td><input name="req" type="text" class="input" style="width:240px;" id="swsf0"  />
</td>
</tr>
<tr><th>Description</th>
<td><textarea name="" cols="20" rows="2" class="input" style="width:48%;height:100px;" id="swsf1"></textarea>
</td>
</tr>
<tr><td colspan="2" style="text-align:center"><div class="teal awesome small" onclick="SaveData('masters/complaints/save','swsf','2','','','couResp','1')">Save Cmplaint</div>
<div class="red awesome small" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')">Cancle</div>
</td></tr>
</table>

</div>
