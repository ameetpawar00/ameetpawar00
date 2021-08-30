<?php
include("../include/conFig.php");
$id = $_GET['id'];
$i = $_GET['i'];
$employeeid = $_GET['employeeid'];
$getData = mysql_query("SELECT `id`, `userid`, `EL`, `1QEL`, `2QEL`, `3QEL`, `4QEL`, `M`, `special`, `CL`, `1QCL`, `2QCL`, `3QCL`, `4QCL`, `SL`, `1QSL`, `2QSL`, `3QSL`, `4QSL`, `P`, `createdate`, `modifiededate`, `updatedby`, `delete` FROM `leaverecord` WHERE `id` = '$id'",$con) or die(mysql_error());


$row = mysql_fetch_array($getData);
$sqlLeavey = mysql_query("SELECT `ALL`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`, `11`, `12` FROM `leaverecord_yearly` WHERE `userid` = '".$employeeid."' AND `delete` = '0'",$con)or die(mysql_error());
	$rowy =mysql_fetch_array($sqlLeavey);
?>
<div class="title">Leave Record</div>
<div class="strip">
<span>Dashboard</span>
<span>Leave Record</span>
<span>Edit</span>
</div>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"> <i class="back"></i>Back</button>&nbsp;&nbsp;
</td>
</tr>
</table>
<div style="overflow-x:hidden;overflow-y:scroll;height:500px">
<div class="add-new green-border">
<div class="form-head green">
<div class="head-title"> 
<i class="add-form"></i> 
Edit Leave Record</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>
<tr>
<th>Name *</th>
<td>
	<?php
			$getemp = mysql_query("SELECT `id`,`name`,`doj` FROM `employee` WHERE `delete`= '0' AND `id` = '$employeeid' AND active = '1'",$con) or die(mysql_error());
			$roww=mysql_fetch_array($getemp);
			$employeeid=$roww["id"];
			$name=$roww["name"];
			$doj=$roww["doj"];
			echo "<b>".$name."</b>";
			

?>	
</td>
<th>Date Of Joining</th>
<td>
<?=$doj?>
</td>
<th>Special *</th>
<td>
<input  class="input small" name="req" type="text" id="levc0" title="isNotNull" value="<?php echo $row["special"]?>"/>
</td>
<th>Maternal *</th>
<td>
<input  class="input small" name="req" type="text" id="levc1" title="isNotNull" value="<?php echo $row["M"]?>"/>
</td>
<th>Paternal *</th>
<td>
<input  class="input small" name="req" type="text" id="levc2" title="isNotNull" value="<?php echo $row["P"]?>"/>
</td>
</tr>
 <tr>
<th>EL *</th>
<td><input  class="input small eltot" name="req" type="text" id="levc3" title="isNotNull" value="<?php echo $row["EL"]?>"/></td>
<th>1QEL*</th>
<td><input  class="input small el" onblur="findTotal('el')" name="req" type="text" id="levc4" title="isNotNull" value="<?php echo $row["1QEL"]?>"/></td>
<th>2QEL *</th>
<td><input  class="input small el" onblur="findTotal('el')" name="req" type="text" id="levc5" title="isNotNull" value="<?php echo $row["2QEL"]?>"/></td>
<th>3QEL *</th>
<td><input  class="input small el" onblur="findTotal('el')" name="req" type="text" id="levc6" title="isNotNull" value="<?php echo $row["3QEL"]?>"/></td>
<th>4QEL *</th>
<td><input  class="input small el" onblur="findTotal('el')" name="req" type="text" id="levc7" title="isNotNull" value="<?php echo $row["4QEL"]?>"/></td>
</tr>

<tr>
<th>CL *</th>
<td><input  class="input small cltot" name="req" type="text" id="levc8" title="isNotNull" value="<?php echo $row["CL"]?>"/></td>
<th>1QCL *</th>
<td><input  class="input small cl" onblur="findTotal('cl')" name="req" type="text" id="levc9" title="isNotNull" value="<?php echo $row["1QCL"]?>"/></td>
<th>2QCL *</th>
<td><input  class="input small cl" onblur="findTotal('cl')" name="req" type="text" id="levc10" title="isNotNull" value="<?php echo $row["2QCL"]?>"/></td>
<th>3QCL *</th>
<td><input  class="input small cl" onblur="findTotal('cl')" name="req" type="text" id="levc11" title="isNotNull" value="<?php echo $row["3QCL"]?>"/></td>
<th>4QCL *</th>
<td><input  class="input small cl" onblur="findTotal('cl')" name="req" type="text" id="levc12" title="isNotNull" value="<?php echo $row["4QCL"]?>"/></td>
</tr>

<tr>
<th>SL *</th>
<td><input  class="input small sltot" name="req" type="text" id="levc13" title="isNotNull" value="<?php echo $row["SL"]?>"/></td>
<th>1QSL *</th>
<td><input  class="input small sl" onblur="findTotal('sl')" name="req" type="text" id="levc14" title="isNotNull" value="<?php echo $row["1QSL"]?>"/></td>
<th>2QSL *</th>
<td><input  class="input small sl" onblur="findTotal('sl')" name="req" type="text" id="levc15" title="isNotNull" value="<?php echo $row["2QSL"]?>"/></td>
<th>3QSL *</th>
<td><input  class="input small sl" onblur="findTotal('sl')" name="req" type="text" id="levc16" title="isNotNull" value="<?php echo $row["3QSL"]?>"/></td>
<th>4QSL *</th>
<td><input  class="input small sl" onblur="findTotal('sl')" name="req" type="text" id="levc17" title="isNotNull" value="<?php echo $row["4QSL"]?>"/></td>
</tr>
<tr>
<td colspan="10"><b>All:-</b> <input  class="input small yrltot" name="req" type="text" id="levc18" title="isNotNull" value="<?php echo $rowy["ALL"]?>" style="width: 20px!important;"/>----[<b>JAN:- </b><input  class="input small yrl" onblur="findTotal('yrl')" name="req" type="text" id="levc19" title="isNotNull" value="<?php echo $rowy["1"]?>" style="width: 20px!important;"/>]----[<b>FEB:- </b><input  class="input small yrl" onblur="findTotal('yrl')" name="req" type="text" id="levc20" title="isNotNull" value="<?php echo $rowy["2"]?>" style="width: 20px!important;"/>]----[<b>MAR:- </b><input  class="input small yrl" onblur="findTotal('yrl')" name="req" type="text" id="levc21" title="isNotNull" value="<?php echo $rowy["3"]?>" style="width: 20px!important;" />]----[<b>APR:- </b><input  class="input small yrl" onblur="findTotal('yrl')" name="req" type="text" id="levc22" title="isNotNull" value="<?php echo $rowy["4"]?>" style="width: 20px!important;"/>]----[<b>MAY:- </b><input  class="input small yrl" onblur="findTotal('yrl')" name="req" type="text" id="levc23" title="isNotNull" value="<?php echo $rowy["5"]?>" style="width: 20px!important;" />]----[<b>JUN:- </b><input  class="input small yrl" onblur="findTotal('yrl')" name="req" type="text" id="levc24" title="isNotNull" value="<?php echo $rowy["6"]?>" style="width: 20px!important;"/>]----[<b>JUL:- </b><input  class="input small yrl" onblur="findTotal('yrl')" name="req" type="text" id="levc25" title="isNotNull" value="<?php echo $rowy["7"]?>" style="width: 20px!important;"/>]----[<b>AGU:- </b><input  class="input small yrl" onblur="findTotal('yrl')" name="req" type="text" id="levc26" title="isNotNull" value="<?php echo $rowy["8"]?>" style="width: 20px!important;"/>]----[<b>SEP:- </b><input  class="input small yrl" onblur="findTotal('yrl')" name="req" type="text" id="levc27" title="isNotNull" value="<?php echo $rowy["9"]?>" style="width: 20px!important;"/>]----[<b>OCT:- </b><input  class="input small yrl" onblur="findTotal('yrl')" name="req" type="text" id="levc28" title="isNotNull" value="<?php echo $rowy["10"]?>" style="width: 20px!important;"/>]----[<b>NOV:- </b><input  class="input small yrl" onblur="findTotal('yrl')" name="req" type="text" id="levc29" title="isNotNull" value="<?php echo $rowy["11"]?>" style="width: 20px!important;"/>]----[<b>DEC:- </b><input  class="input small yrl" onblur="findTotal('yrl')" name="req" type="text" id="levc30" title="isNotNull" value="<?php echo $rowy["12"]?>" style="width: 20px!important;"/>]</td>
</tr>
<tr>
<td colspan="4" style="text-align:center">
<button class="button green" onclick="SaveData('leaverecord/update?id=<?php echo $row['id']?>&i=<?php echo $i?>&employeeid=<?php echo $employeeid?>','levc','31','','','','2');ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="save-icon"></i>Update</button>
<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')"><i class="close-icon"></i>Cancel</button>
</td>
</tr>

</table>
	</div>
</div>


