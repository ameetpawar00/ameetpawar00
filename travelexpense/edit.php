<?php
include("../include/conFig.php");
$id = $_GET['id'];
$i = $_GET['i'];
$travelid = $_GET['id'];
$getData = mysql_query("SELECT * FROM `travelexpense` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>

<ul class="breadcrumb">
	<li><a href="#">Home</a><span class="divider">&raquo;</span></li>
	<li class="active"  onclick="getModule('travel/view','viewContent','manipulateContent','Travel')">Travel</li>
	<div class="red awesome small" onclick="getModule('travel/view','viewContent','manipulateContent','Travel')" style="float:right">Back To View</div>

</ul>
<div class="nonboxy-widget">
	<div class="widget-head">
		<h5>Edit Expense</h5>
	</div>
</div>
<div class="widget-content">
	<div class="widget-box">
	<table width="100%" cellpadding="10" cellspacing="0" class="form-horizontal well formtable">
<tr><td colspan="4" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>

<tr>
<th>Date <span>*</span></th>
<td><input name="req" value="<?php echo $row['date']?>" id="exp0" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalendar(this);"/></td>
<th>Ticket</th>
<td><input name="" value="<?php echo $row['ticket']?>" type="text" id="exp1"/></td>
</tr>
<tr>
<th>Lodging</th>
<td><input name="" value="<?php echo $row['lodging']?>" type="text" id="exp2"/></td>
<th>Boarding</th>
<td><input name="" value="<?php echo $row['boarding']?>" type="text" id="exp3"/></td>

</tr>
<tr>
<th>Phone
</th>
<td><input name="" value="<?php echo $row['phone']?>" type="text" id="exp4"/></td>
<th>Local Conveyance
</th>
<td><input name="" value="<?php echo $row['localconveyance']?>" type="text" id="exp5"/></td>
</tr>
<tr>
<th>Incidentals</th>
<td><input name="Text1" value="<?php echo $row['incidentals']?>" type="text" id="exp6"/></td>
<th>Others</th>
<td><input name="Text1" value="<?php echo $row['others']?>" type="text" id="exp7"/></td>
</tr>

<tr>
<th>Description
</th>
<td colspan="3">
<textarea name="TextArea1" id="exp8" cols="20" style="width:300px;height:75px" rows="2"><?php echo $row['description']?></textarea>
</td>
</tr>
<tr><td></td><td  style="text-align:left"><div class="blue awesome small" onclick="SaveData('travelexpense/update?id=<?php echo $row['id']?>&i=<?php echo $i?>','exp','9','','','couResp','2')">Update</div>
<div class="btn btn-warning" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')">Cancel</div>
</td></tr>
</table>
	</div>
</div>


