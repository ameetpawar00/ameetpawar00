<?php require_once("../include/conFig.php"); ?>
<style>
::-webkit-scrollbar{
height: 5px !important;	
}
</style>
<?php
$designation = $_GET['desig'];
$designation = explode('***',$designation);
$desig = $designation[0];
$empid = $designation[1];
$smonth = $_GET['smonth'];
$monthName = date("F", mktime(0, 0, 0, $smonth, 10));
$getLead = mysql_query("SELECT COUNT(`id`) FROM `team` WHERE `leader` = '$hrmloggedid'",$con) or die(mysql_error());
	$rowLead = mysql_fetch_array($getLead);
		if($rowLead[0] <= 0)
		{
		$getData = mysql_query("SELECT `id`, `name`,`salaryId` FROM `employee` WHERE `delete` = '0' AND `designation` = '$desig' order by `name`",$con) or die(mysql_error());
		
		}
		else
		{
		$getData = mysql_query("SELECT employee.id,employee.name,employee.salaryId,employee.designation,teamamtes.mateid FROM employee,team,teamamtes WHERE team.leader = '$hrmloggedid' AND teamamtes.mateid = employee.id AND employee.id = '$empid' AND teamamtes.teamid = team.id AND team.delete = '0' AND employee.delete = '0' ORDER BY employee.name ASC",$con) or die(mysql_error());

		}
$getCount = mysql_query("SELECT `id` FROM `kpi` WHERE `month` = '$smonth'",$con) or die(mysql_error());
$marksCount = mysql_num_rows($getCount);
?>
<div id="myTitle">
	<div class="title">
		Key Performance Indicator For Month <?php echo $monthName;?></div>
	<div class="strip">
		<span>Dashboard</span> <span>Key Performance Indicator</span> <span>View</span>
	</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td style="width: 30%"></td>
		<td align="right" style="width: 70%">
		<button class="button gray" onclick="ToggleBox('manipulateContent','block','');ToggleBox('viewContent','none','')">
		<i class="back"></i>Back</button>&nbsp;&nbsp; </td>
	</tr>
</table>
<div id="mainDivId" style="min-height:100px; overflow-x:auto; overflow-y:auto;width:1130px;border:1px">
	<table id="" cellpadding="5" cellspacing="0" class="fetch" width="100%">
	</table>
	<table cellpadding="5" cellspacing="0" class="fetch" style="text-align: center" width="100%">
		<tr>
			<th style="display: none">
			<input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
			<th style="width: 50px">User</th>
			<?php
$g=1;
//echo "SELECT kpiparameters.id,kpiparameters.default,kpiparameters.maximum,kpiparameters.name FROM kpiparameters,employee WHERE kpiparameters.delete = '0' AND kpiparameters.id != '1'  AND kpiparameters.designation LIKE '%-$desig-%' AND employee.id = '$empid'";
$getParams = mysql_query("SELECT kpiparameters.id,kpiparameters.default,kpiparameters.maximum,kpiparameters.name FROM kpiparameters,employee WHERE kpiparameters.delete = '0' AND kpiparameters.id != '1'  AND kpiparameters.designation LIKE '%-$desig-%' AND employee.id = '$empid'",$con) or die(mysql_error());
while($rowParams = mysql_fetch_array($getParams))
{
$kpiid = $rowParams[0];
$default = $rowParams[1];
$max = $rowParams[2];
$maxToShow += $rowParams[2];
?>
			<th style="width: 40px;text-align:center"><?php echo $rowParams[2]; ?><br/><?php echo $rowParams[3]?></th>
			<?php
$g++;
}
?>
<th style="width: 40px;text-align:center"><?php echo $maxToShow; ?><br/>Total</th>
<th style="width: 40px;text-align:center">%</th>
<th style="width: 40px;text-align:center">PA Amount</th>
		</tr>
		<?php
$i = 1;
$j = 1;
while($row = mysql_fetch_array($getData))
{
$userids .= $row[0].",";
$salpid = $row[2];
$getsalary = mysql_query("SELECT `perf_allow` FROM `salary` WHERE `id` = '$salpid'",$con) or die(mysql_error());
$rowsalary = mysql_fetch_array($getsalary);
$perf_allow = $rowsalary[0];
?>
		<tr id="fetchrow<?php echo $i?>" class="d<?php echo $i%2?>">
			<td style="display: none">
			<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" />
			</td>
			<td style="color: #000; width: 50px"><?php echo $row[1]?></td>
			<?php
			//echo "SELECT * FROM `kpiparameters` WHERE `delete` = '0' AND `id` != '1'  AND `designation` LIKE '%-$desig-%'";
$getParams = mysql_query("SELECT kpiparameters.id,kpiparameters.default,kpiparameters.maximum FROM kpiparameters,employee WHERE kpiparameters.delete = '0' AND kpiparameters.id != '1'  AND kpiparameters.designation LIKE '%-$desig-%' AND employee.id = '$empid'",$con) or die(mysql_error());
while($rowParams = mysql_fetch_array($getParams))
{
$kpiid = $rowParams[0];
$default = $rowParams[1];
$max = $rowParams[2];
	if($marksCount > 0)
	{
	//echo "SELECT `marks` FROM `kpi` WHERE `employee` = '$row[0]'  AND `kpiparameter` = '$kpiid' AND `month` = '$smonth'";
	$getMarks = mysql_query("SELECT `marks` FROM `kpi` WHERE `employee` = '$row[0]'  AND `kpiparameter` = '$kpiid' AND `month` = '$smonth'",$con) or die(mysql_error());
	$rowMarks = mysql_fetch_array($getMarks);
	$marks = $rowMarks[0]; 
	$marksToShow += $rowMarks[0]; 
	}

?>
			<td>
			<input id="kpi<?php echo $j?>" title="isNotNull" type="hidden" value="<?php echo $kpiid;?>" />
			<input id="kpi<?php echo $j=$j+1;?>" name="reqisnum" style="width: 30px;" title="isNotNull" type="text" value="<?php if($marksCount > 0){ echo $marks; } else { echo $default; }?>" onblur="checkValue('<?php echo $max?>',this.value,this.id);"></td>
			<?php
$j++;
}
$average = round(($marksToShow/$maxToShow)*100);
$kpiamount =  round($perf_allow*($average/100));

?>
		<td><input id="" name="reqisnum" style="width: 30px;" class="inputDisabled" title="isNotNull" type="text" value="<?php echo $marksToShow?>" readonly="readonly"></td>
	<td><input id="" name="reqisnum" style="width: 30px;" class="inputDisabled" title="isNotNull" type="text" value="<?php echo $average?>" readonly="readonly"></td>


		<td><input id="" name="reqisnum" style="width: 30px;" class="inputDisabled" title="isNotNull" type="text" value="<?php echo $kpiamount?>" readonly="readonly"></td>

	
		</tr>
		<?php
$i++;
$Maxid = $row[0];
$MaxI = $i;
$marksToShow = 0;
}
?><input id="kpi0" name="nouse" type="hidden" />
		<tr>
			<td colspan="<?php echo $g?>" style="text-align: center">
			<button class="button green" onclick="SaveData('kpi/saveMass?userids=<?php echo $userids?>&amp;g=<?php echo $g;?>&amp;smonth=<?php echo $smonth;?>','kpi','<?php echo $j?>','','','myResp','1')">
			Save</button></td>
		</tr>
<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
	</table>
</div>
