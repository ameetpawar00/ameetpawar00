<?php
	include("../../include/conFig.php");
	/*$yearTocheck=2018;
	$monthTocheck = 01;*/
	if(isset($_POST['year']))
	{
		$yearTocheck = $_POST['year'];
		
		$monthCond="";
		if(isset($_POST["month"]))
		{
			$monthTocheck = $_POST['month'];
			$monthCond=" AND MONTH(`allleavestat`.`date`)='$monthTocheck' ";
		}
		
		$queryForLeave = "SELECT lr_id,DAY(`allleavestat`.`date`) as `day`, MONTH(`allleavestat`.`date`) as `month`, YEAR(`allleavestat`.`date`) as `year`, `allleavestat`.`empid`, `allleavestat`.`ltype`, `allleavestat`.`lr_id`, `allleavestat`.`leave` FROM `leaverequest`, `allleavestat` WHERE `leaverequest`.`ID`=`allleavestat`.`lr_id` AND `leaverequest`.`status`='1' AND `leaverequest`.`extra`!='2' AND `leaverequest`.`delete`='0' AND YEAR(`allleavestat`.`date`)='$yearTocheck' $monthCond ORDER BY `leaverequest`.`updatedby`, MONTH(`leaverequest`.`fromdate`)";
	// `leaverequest`.`updatedby`='728' AND
	//
	$getLeav= mysql_query($queryForLeave,$con) or die(mysql_error());
	
	$empDataArray="";
	while($rowgetLeave = mysql_fetch_assoc($getLeav))
	{
		$lr_id = $rowgetLeave["lr_id"];
		$day = $rowgetLeave["day"];
		$month = $rowgetLeave["month"];
		$year = $rowgetLeave["year"];
		$empid = $rowgetLeave["empid"];
		$ltype = $rowgetLeave["ltype"];
		$lr_id = $rowgetLeave["lr_id"];
		$leave = $rowgetLeave["leave"];
		$empDataArray[$month][$day][$empid]=$ltype."--".$leave;
	}
	
	//[$year]
	
	
	//print_r($empDataArray);
	
	
	
	
	
	
	
	
	
	
	$getEmpl= mysql_query("SELECT `id`, `name`, `department`, `shift` FROM `employee` WHERE `employee`.`delete` = '0' AND `employee`.`active`='1' AND `empstatus`='2' ORDER BY `name`",$con) or die(mysql_error());
	$tab="";
	while($rowgetEmpl = mysql_fetch_assoc($getEmpl)) {
		$emp_id = $rowgetEmpl["id"];
		$emp_name = ucfirst(strtolower($rowgetEmpl["name"]));
		$allEmp[$emp_id]=$emp_name;
	}
	//date('t');
	foreach($empDataArray as $empDataArrayKey=>$empDataArrayVal)
	{
		$numberOfDays=cal_days_in_month(CAL_GREGORIAN, $empDataArrayKey, $yearTocheck);
		$dateObj   = DateTime::createFromFormat('!m', $empDataArrayKey);
		$monthName = $dateObj->format('F'); // March
		$th="";
		
		$tr="";
		$counter=1;
		foreach ($allEmp as $allEmpid=>$allEmpName)
		{
			$td="";
			$thisEmpTotal=0;
			for($vdr=1;$vdr<=$numberOfDays;$vdr++)
			{
				if($counter==1)
				{
				
				
				$th.=<<<AAA
								<th>
									$vdr
								</th>
AAA;
				}
				$leaveDetail=$empDataArrayVal[$vdr][$allEmpid];
				$leaveDetailArray=explode("--",$leaveDetail);
				$leaveDetail=$leaveDetailArray[0];
				$leavea=$leaveDetailArray[1];
				$style="";
				if($leaveDetail=="LWP")
				{
					$style="background-color: indianred;";
				}
				if($leaveDetail=="EL"){
					$style="background-color: mediumpurple;";
				}
				if($leaveDetail=="SL"){
				
					$style="background-color: palegreen;";
				}
				if($leaveDetail=="CL"){
				
					$style="background-color: powderblue;";
				}
				if($leaveDetail=="Special"){
				
					$style="background-color: orange;";
				}
				if($leaveDetail=="P"){
				
					$style="background-color: yellow;";
				}
				if($leaveDetail=="M"){
				
					$style="background-color: green;";
				}
				$leaveaDat="";
				if($leavea==2 OR $leavea==3 OR $leavea==4 OR $leavea==5)
				{
					$leaveaDat="0.5-";
				}
				
				$td.=<<<AAA
								<td style="$style">
									$leaveaDat $leaveDetail
								</td>
AAA;
			
			if($leavea==2 OR $leavea==3 OR $leavea==4 OR $leavea==5)
			{
				$thisEmpTotal+=.5;
			}else if($leaveDetail)
			{
				$thisEmpTotal++;
			}
			}
			$counter++;
			
			$tr.=<<<AAA
							<tr>
								<td style="text-align: left;">
									$allEmpName
								</td>
								$td
								<td style="text-align: right;">
									$thisEmpTotal
								</td>
							</tr>
AAA;
		}
		
		
			$tab.=<<<AAA
			
			<table border="1" cellspacing="0">
				<thead>
					<tr>
						<th colspan="28">
							Trifid Research Pvt. Ltd.
						</th>
					</tr>
					<tr>
						<th colspan="28">
							Leave Reports - $monthName
						</th>
						
					</tr>
					<tr>
						<th style="text-align: left">
								Employee
						</th>
						$th
						
						<th style="text-align: right">
								Total
						</th>
					</tr>
				</thead>
				<tbody>
					$tr
				</tbody>
			</table>

AAA;
	}
	
	$name = "Excel_Leave_report_Download-$monthTocheck-$yearTocheck.xls";
	header("Content-Disposition: attachment; filename=\"$name\"");
	header("Content-Type: application/vnd.ms-excel");
	
	}
?>
<style>
	table td,table th
	{
		table-layout:fixed;
		width:20px;
		overflow:hidden;
		word-wrap:break-word;
		text-align: center;
	}
	.innerTable td,.innerTable  th {
		text-align: center;
	}
	

</style>
<html>
<head>
	<title>Excel Salary Download For <?php echo $montha; ?> ></title>
</head>
<body>


	<?=$tab?>

</body>

</html>
