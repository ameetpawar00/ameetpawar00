<?php require_once("../include/conFig.php"); ?>
<style>
	::-webkit-scrollbar{
		height: 5px !important;
	}
</style>
<?php
	//ini_set('display_errors', 1);
	//ini_set('display_startup_errors', 1);
	//error_reporting(E_ALL);
	$g=1;
	$SalaryProfile = $_GET['SalaryProfile'];
	$SalaryProfile = explode('***',$SalaryProfile);
	$salid = $SalaryProfile[0];
	$empid = $SalaryProfile[1];
	$smonth = $_GET['smonth'];
	$syear = $_GET['syear'];
	$monthName = date("F", mktime(0, 0, 0, $smonth, 10));
	function display_children($hrmloggedid,$level) {
		$result = mysql_query("SELECT employee.id,employee.name,employee.salaryIdNew,employee.designation,teamamtes.mateid FROM employee,team,teamamtes WHERE team.leader = $hrmloggedid AND teamamtes.mateid = employee.id AND teamamtes.teamid = team.id AND team.delete = 0 AND employee.delete = 0 AND employee.empstatus = 2 ORDER BY employee.name ASC");
		$abcdd="";
		while ($row = mysql_fetch_array($result)) {
			$id=$row["id"];
			//	$name=$row["name"];
			//$designation=$row["designation"];
			//$abcdd.="$name--$id,";
			$abcdd.="$id,";
			$abcdd.=display_children($id,$level+1);
		}
		return $abcdd;
	}
	$rytyt=rtrim(display_children($hrmloggedid,0),",");
	//echo "SELECT `employee`.`id`, `employee`.`name`,`employee`.`salaryId`,`salary`.`travel_allow` FROM `employee`,`salary`,team,teamamtes WHERE `employee`.`delete` = '0' AND `employee`.`salaryId` = '$salid' AND `employee`.`empstatus` = '2' AND `salary`.`id`=`employee`.`salaryId` AND team.leader = '$hrmloggedid' AND teamamtes.mateid = employee.id AND employee.id = '$empid' AND teamamtes.teamid = team.id AND team.delete = '0' order by `employee`.`name`";
	//$getData = mysql_query("SELECT `employee`.`id`, `employee`.`name`,`employee`.`salaryId`,`salary`.`travel_allow` FROM `employee`,`salary`,team,teamamtes WHERE `employee`.`delete` = '0' AND `employee`.`salaryId` = '$salid' AND `employee`.`empstatus` = '2' AND `salary`.`id`=`employee`.`salaryId` AND team.leader = '$hrmloggedid' AND teamamtes.mateid = employee.id AND employee.id = '$empid' AND teamamtes.teamid = team.id AND team.delete = '0' order by `employee`.`name`",$con) or die(mysql_error());
	//$getData = mysql_query("SELECT employee.id,employee.name,employee.salaryId,employee.designation,teamamtes.mateid,salary.travel_allow FROM employee,team,teamamtes,salary WHERE team.leader = '$hrmloggedid' AND teamamtes.mateid = employee.id AND employee.salaryId = salary.id AND employee.salaryId = '$salid' AND teamamtes.teamid = team.id AND team.delete = '0' AND employee.delete = '0' AND employee.empstatus = '2' AND `employee`.`depcheck` = '1' ORDER BY employee.name ASC",$con) or die(mysql_error());
	//	$getData = mysql_query("SELECT employee.id,employee.name,employee.salaryId,employee.designation,teamamtes.mateid,salary.travel_allow FROM employee,team,teamamtes,salary WHERE team.leader = '$hrmloggedid' AND teamamtes.mateid = employee.id AND employee.salaryId = salary.id AND employee.salaryId = '$salid' AND teamamtes.teamid = team.id AND team.delete = '0' AND employee.delete = '0' AND employee.empstatus = '2' AND `employee`.`depcheck` = '1' ORDER BY employee.name ASC",$con) or die(mysql_error());
	$getData = mysql_query("SELECT employee.id,employee.name,employee.salaryIdNew,employee.designation,employee.id as mateid,salary_structure_relation_new.variablevalue FROM employee,salary_structure_relation_new WHERE employee.id IN($rytyt) AND employee.salaryIdNew = salary_structure_relation_new.profileid AND `salary_structure_relation_new`.`variableid`=4 AND employee.salaryIdNew = '$salid' AND employee.delete = '0' AND employee.empstatus = '2' AND `employee`.`depcheck` = '1' ORDER BY employee.name ASC",$con) or die(mysql_error());
?>
<div id="myTitle">
	<div class="title">
		QPE For Month <?php echo $monthName;?></div>
	<div class="strip">
		<span>Dashboard</span> <span>QPE</span> <span>View</span>
	</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td style="width: 30%"></td>
		<td align="right" style="width: 70%">
			<button class="button gray" onclick="ToggleBox('viewContent','block','');ToggleBox('manipulateContent','none','')">
				<i class="back"></i>Back</button>&nbsp;&nbsp; </td>
	</tr>
</table>
<div id="mainDivId" style="height:350px; overflow:auto;width:1130px;border:1px">
	<table id="" cellpadding="5" cellspacing="0" class="fetch" width="100%">
	</table>
	<table cellpadding="5" cellspacing="0" class="fetch" style="text-align: center" width="100%">
		<tr>
			<th style="width: 50px">User</th>
			<th style="width: 40px;text-align:center">Fixed QPE</th>
			<th style="width: 40px;text-align:center">QPE Alloted</th>
		</tr>
		<?php
			$i = 1;
			$j = 1;
			$userids="";
			while($row = mysql_fetch_array($getData))
			{
				$fixedVal=$row["travel_allow"];
				$userids .= $row[0].",";
				$salpid = $row[2];
				$getCounta = mysql_query("SELECT `marks` FROM `qpe` WHERE `month` = '$smonth' AND `year` = '$syear' AND `employee`=".$row[0],$con) or die(mysql_error());
				$preVals=0;
				$rowgetCounta=mysql_fetch_assoc($getCounta);
				if($rowgetCounta["marks"])
				{
					$preVals=$rowgetCounta["marks"];
				}
				?>
				<tr>
					<td style="color: #000; width: 50px"><?php echo $row[1]?></td>
					<td style="color: #000; width: 50px"><?=$fixedVal?></td>
					<td style="color: #000; width: 50px"><input type="text" name="qpe" id="qpe<?=$j?>" value="<?=$preVals;?>"></td>
				</tr>
				<?php
				$j++;
			}
		?>
		<tr>
			<td colspan="<?php echo $g?>" style="text-align: center">
				<button class="button green" onclick="SaveData('qpe/saveMass?userids=<?php echo $userids?>&amp;g=<?php echo $g;?>&amp;smonth=<?php echo $smonth;?>&amp;syear=<?php echo $syear;?>','qpe','<?php echo $j?>','','','myResp','1')">
					Save</button></td>
		</tr>
	</table>
</div>
