<?php
	include("../../include/conFig.php");
	
	if(isset($_POST['excelDo']))
	{
		$month = $_POST['month'];
		$year = $_POST['year'];
	}
	
	
	
	$queryForLeave = "SELECT `leaverequest`.`id`, `leaverequest`.`leavetype`, `leaverequest`.`days`, YEAR(`leaverequest`.`fromdate`) as `fromdate_year`, MONTH(`leaverequest`.`fromdate`) as `fromdate_month`, `leaverequest`.`fromdate`, `leaverequest`.`todate`, `leaverequest`.`updatedby` FROM `leaverequest` WHERE `leaverequest`.`status`='1' AND `leaverequest`.`extra`!='2' AND `leaverequest`.`delete`='0' AND YEAR(`leaverequest`.`fromdate`)='2018' AND MONTH(`leaverequest`.`fromdate`)='01'  ORDER BY `leaverequest`.`updatedby`, MONTH(`leaverequest`.`fromdate`)";//  `leaverequest`.`updatedby`='391' AND
	$getLeav= mysql_query($queryForLeave,$con) or die(mysql_error());
	
	$slTaken=0;
	$elTaken=0;
	$clTaken=0;
	$lwpTaken=0;
	$ellwpTaken=0;
	$cllwpTaken=0;
	$sllwpTaken=0;
	$plwpTaken=0;
	$mlwpTaken=0;
	$specialTaken=0;
	$pTaken=0;
	$mTaken=0;
	$days=0;
	while($rowgetLeav = mysql_fetch_assoc($getLeav))
	{
		//print_r($rowgetLeav);
		$slTaken=0;
		$elTaken=0;
		$clTaken=0;
		$lwpTaken=0;
		$ellwpTaken=0;
		$cllwpTaken=0;
		$sllwpTaken=0;
		$plwpTaken=0;
		$mlwpTaken=0;
		$specialTaken=0;
		$pTaken=0;
		$mTaken=0;
		$days=0;
		
		$lr_id = $rowgetLeav["id"];
		$leavetype = $rowgetLeav["leavetype"];
		$days = $rowgetLeav["days"];
		$fromdate = $rowgetLeav["fromdate"];
		$fromdate_year = $rowgetLeav["fromdate_year"];
		$fromdate_month = $rowgetLeav["fromdate_month"];
		$todate = $rowgetLeav["todate"];
		$updatedby = $rowgetLeav["updatedby"];
		/*$date1 = date_create($fromdate);
		$date2 = date_create($todate);
		$diff = date_diff($date1,$date2);
		$leave_days_counts = $diff->format("%R%a days")+1;*/
		//echo $leavetype."<br>";
		/*if($days==$leave_days_counts)
		{
		
		}else{
		
		}*/
		
		switch ($leavetype)
		{
			case "LWP":
				$empDataArray[$updatedby][$fromdate_month]["lwp"]+=$days;
				break;
			case "EL**LWP":
				$empDataArray[$updatedby][$fromdate_month]["el-lwp"]+=$days;
				break;
			case "CL**LWP":
				$empDataArray[$updatedby][$fromdate_month]["cl-lwp"]+=$days;
				break;
			case "SL**LWP":
				$empDataArray[$updatedby][$fromdate_month]["sl-lwp"]+=$days;
				break;
			case "P**LWP":
				$empDataArray[$updatedby][$fromdate_month]["p-lwp"]+=$days;
				break;
			case "M**LWP":
				$empDataArray[$updatedby][$fromdate_month]["m-lwp"]+=$days;
				break;
			case "EL":
				//echo $fromdate."<br>";
				$empDataArray[$updatedby][$fromdate_month]["el"]+=$days;
				break;
			case "SL":
				$empDataArray[$updatedby][$fromdate_month]["sl"]+=$days;
				break;
			case "CL":
				$empDataArray[$updatedby][$fromdate_month]["cl"]+=$days;
				break;
			case "Special":
				$empDataArray[$updatedby][$fromdate_month]["special"]+=$days;
				break;
			case "P":
				$empDataArray[$updatedby][$fromdate_month]["p"]+=$days;
				break;
			case "M":
				$empDataArray[$updatedby][$fromdate_month]["m"]+=$days;
				break;
		}
		
		
		
		
	}
	
	$getEmpl= mysql_query("SELECT `id`, `name`, `department`, `shift` FROM `employee` WHERE `employee`.`delete` = '0' AND `employee`.`active`='1' AND `empstatus`='2' ORDER BY `name`",$con) or die(mysql_error());
	$tab="";
	while($rowgetEmpl = mysql_fetch_assoc($getEmpl)) {
		$emp_id = $rowgetEmpl["id"];
		$emp_name = ucfirst(strtolower($rowgetEmpl["name"]));
		$perUserData=$empDataArray[$emp_id];
		if($perUserData!=null)
		{
			
			$tab.=<<<AAA
				<tr>
					<td>$emp_name</td>

AAA;
			$tabble="";
			for($vdr=1;$vdr<=12;$vdr++)
			{
				$perUserDataVal=$perUserData[$vdr];
				$th="";
				$td="";
				
				$totalThis=0;
				foreach ($perUserDataVal as $perUserDataValKey=>$perUserDataValVal)
				{
					$th.=<<<AAA
							<th>
								$perUserDataValKey
							</th>
AAA;
					$td.=<<<AAA
							<td>
								$perUserDataValVal
							</td>
AAA;
					$totalThis+=$perUserDataValVal;
					
					
				}
				$tabble=<<<AAA
						<table class="innerTable">
							<tr>
							$th
							<th>
								T
							</th>
							</tr>
							<tr>
							$td
								<td>$totalThis</td>
							</tr>
						</table>
						

AAA;
				if($th=="")
				{
					$tabble="";
				}
				$tab.=<<<AAA

					<td>
						$tabble
					</td>

AAA;
			}
			
			$tab.=<<<AAA
				</tr>

AAA;
		
		
		
		}
	}
	
	//	print_r($empDataArray);
	
	
	$xasd= <<<AAA


AAA;


?>
<style>
	table td,table th
	{
		table-layout:fixed;
		width:20px;
		overflow:hidden;
		word-wrap:break-word;
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

<table border="1" cellspacing="0" width="100%">
	<tr>
		<th colspan='13'>
			Trifid Research Pvt. Ltd.
		</th>
	</tr>
	<tr>
		<th colspan='13'>
			Leave Reports
		</th>
	</tr>
	<tr>
		<th style="background:rgb(194, 214, 154)">Employee Name</th>
		<th style="background:rgb(194, 214, 154)">1</th>
		<th style="background:rgb(194, 214, 154)">2</th>
		<th style="background:rgb(194, 214, 154)">3</th>
		<th style="background:rgb(194, 214, 154)">4</th>
		<th style="background:rgb(194, 214, 154)">5</th>
		<th style="background:rgb(194, 214, 154)">6</th>
		<th style="background:rgb(194, 214, 154)">7</th>
		<th style="background:rgb(194, 214, 154)">8</th>
		<th style="background:rgb(194, 214, 154)">9</th>
		<th style="background:rgb(194, 214, 154)">10</th>
		<th style="background:rgb(194, 214, 154)">11</th>
		<th style="background:rgb(194, 214, 154)">12</th>
	</tr>
	<?=$tab?>
</table>
</body>

</html>

