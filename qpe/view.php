<?php require_once("../include/conFig.php"); ?>
<style>
	::-webkit-scrollbar{
		height: 5px !important;
	}
</style>
<?php
	//echo $year= date('Y');
	$fixedVal=2000;
	$SalaryProfile = $_GET['SalaryProfile'];
	$smonth = $_GET['smonth'];
	$syear = $_GET['syear'];
	$monthName = date("F", mktime(0, 0, 0, $smonth, 10));
    //echo "SELECT `employee`.`id`, `employee`.`name`,`employee`.`salaryIdNew`, `salary_structure_relation_new`.`variablevalue` FROM `employee`,`salary_structure_relation_new` WHERE `employee`.`delete` = '0' AND `employee`.`salaryIdNew` = '$SalaryProfile' AND `employee`.`salaryIdNew` = `salary_structure_relation_new`.`profileid` AND `employee`.`empstatus` = '2' AND `employee`.`depcheck` = '1' order by `name`";
	$getData = mysql_query("SELECT `employee`.`id`, `employee`.`name`,`employee`.`salaryIdNew`, `salary_structure_relation_new`.`variablevalue` FROM `employee`,`salary_structure_relation_new` WHERE `employee`.`delete` = '0' AND `employee`.`salaryIdNew` = '$SalaryProfile' AND `employee`.`salaryIdNew` = `salary_structure_relation_new`.`profileid` AND `salary_structure_relation_new`.`variableid`=4 AND `employee`.`empstatus` = '2' AND `employee`.`depcheck` = '1' order by `name`",$con) or die(mysql_error());
?>
<div id="myTitle">
	<div class="title">
		QPE For Month <?php echo $monthName;?>
	</div>
	<div class="strip">
		<span>Dashboard</span>
		<span>QPE</span>
		<span>View</span>
	</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td style="width: 30%"></td>
		<td align="right" style="width: 70%">
			<button class="button gray" onclick="ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','')">
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
			$getCounta = mysql_query("SELECT `id` FROM `qpe` WHERE `month` = '$smonth' AND `year` = '$syear'",$con) or die(mysql_error());
			$userids="";
			while($row = mysql_fetch_array($getData))
			{
				$fixedVal=$row["variablevalue"];
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
					<td style="color: #000; width: 50px">
						<input type="number" name="qpe" id="qpe<?=$j?>" min="0" max="<?=$fixedVal?>" value="<?=$preVals;?>"></td>
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
		<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
	</table>
</div>