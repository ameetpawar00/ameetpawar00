<?php
include("../../include/conFig.php");
include("../../include/leave_calculation.php");
include("../../include/calculateAbsent_trifid.php");
//SELECT SUM(`days`), YEAR(`fromdate`) as y, MONTH(`fromdate`) as m, `leaverequest`.*, `employee`.* FROM `leaverequest`,`employee` WHERE `leaverequest`.`status`=2 AND `leaverequest`.`updatedby`=728 AND `employee`.`id`=`leaverequest`.`updatedby` AND `leaverequest`.`extra`!=2 GROUP BY y, m
$checkbefortions=1;

function findKey($array, $keySearch)
{
    foreach ($array as $key => $item) {
        if ($key == $keySearch) {
            //echo 'yes, it exists';
            return true;
        }
        else {
            if (is_array($item) && findKey($item, $keySearch)) {
               return true;
            }
        }
    }

    return false;
}

	if(isset($_POST['excelDo']))
	{
		$month = $_POST['month'];
		$year = $_POST['year'];
	}

	$arrayfordeductionsa=array();
	$getEmpl= mysql_query("SELECT `id`, `name`, `department`, `shift` FROM `employee` WHERE `employee`.`delete` = '0' AND `employee`.`active`='1' AND `empstatus`='2'",$con) or die(mysql_error());
	$abcd=array();
	$empd=array();
	while($rowgetEmpl = mysql_fetch_assoc($getEmpl))
	{
		//print_r($rowgetEmpl);
		$emp_id = $rowgetEmpl["id"];
		$emp_name = $rowgetEmpl["name"];
		$emp_department = $rowgetEmpl["department"];
		$emp_department = $rowgetEmpl["department"];
		$emp_shift = $rowgetEmpl["shift"];
		$empd[$emp_id]=$emp_name;
			$getLeav= mysql_query("SELECT `id`, `leavetype`, `days`, YEAR(`fromdate`) as `fromdate_year`, MONTH(`fromdate`) as `fromdate_month`, `fromdate`, `todate` FROM `leaverequest` WHERE `updatedby`='$emp_id' AND `status`=2 AND `leaverequest`.`extra`!=2 AND `leavetime`=1 AND `delete`=0",$con) or die(mysql_error());
			
			while($rowgetLeav = mysql_fetch_assoc($getLeav))
			{
				
				$lr_id = $rowgetLeav["id"];
				$leavetype = $rowgetLeav["leavetype"];
				$days = $rowgetLeav["days"];
				$fromdate = $rowgetLeav["fromdate"];
				$fromdate_year = $rowgetLeav["fromdate_year"];
				$fromdate_month = $rowgetLeav["fromdate_month"];
				$todate = $rowgetLeav["todate"];
				$date1 = date_create($fromdate);
				$date2 = date_create($todate);
				$diff = date_diff($date1,$date2);
				$leave_days_counts = $diff->format("%R%a days");
				$leave_days_counts = $leave_days_counts+1;
				//$abcd[$emp_id][$fromdate]=$leave_days_counts;
				if($leave_days_counts<=1)
				{
					if(!in_array($fromdate,$arrayfordeductionsa))
					{
						$arrayfordeductionsa[]=$fromdate;
					}
				}else{
					
									$first=$fromdate;
									$last=$todate;
									//2017-04-28
									//$first = '10/30/2017'; //starting date
									//$last= '10/11/2017';   //ending date
									$first_time_arr=explode('-',$first); 
									$last_time_arr=explode('-',$last);
									//create timestamp of starting date
									$start_timestamp=mktime(0,0,0, $first_time_arr[1], $first_time_arr[2],$first_time_arr[0]);
									//create timestamp of ending date
									$end_timestamp=mktime(0,0,0, $last_time_arr[1], $last_time_arr[2],$last_time_arr[0]);
									$date_arr=array();
									for($i=$start_timestamp;$i<=$end_timestamp;$i=$i+86400){
										$date_arrs=date("Y-m-d",$i); //this will save all dates in array
										$date_arr[]=$date_arrs; //this will save all dates in array
										
										if(!in_array($date_arrs,$arrayfordeductionsa))
										{
											$arrayfordeductionsa[]=$date_arrs;
										}
									}
						
				}
				
				$abcd[$emp_id][$fromdate_year]["arrayfordeductions"]=$arrayfordeductionsa;
				if(findKey($abcd, $fromdate_month."---"))
				{
					$abcd[$emp_id][$fromdate_year][$fromdate_month."---"]= $abcd[$emp_id][$fromdate_year][$fromdate_month."---"]+$leave_days_counts;
				}else{
					$abcd[$emp_id][$fromdate_year][$fromdate_month."---"]=$leave_days_counts;
				}
				
			}
	}
				//print_r($abcd);
	//print_r($arrayfordeductions);
echo $xasd= <<<AAA
<html>
	<head>
		<title>Excel Salary Download For <?php echo $montha; ?> ></title>
	</head>
	<body>
		
		<table border="1">
			<tr>
				<th colspan='4'>
					Trifid Research Pvt. Ltd.
				</th>
			</tr>
			<tr>
				<th colspan='4'>
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

AAA;
		$name = "Excel_Leave_unapproved_report_Download.xls";
		header("Content-Disposition: attachment; filename=\"$name\"");
		header("Content-Type: application/vnd.ms-excel");
		$tab="";
		foreach($empd as $empdkey=>$empdval)
		{
		$tab.=<<<AAA
				<tr>
					<th>$empdval</th>
AAA;
$year=2017;
		$valts=$abcd[$empdkey][$year];
		for($vdr=1;$vdr<=12;$vdr++)
		{
			//echo $vdr.'---'.$year.'---'.$empdkey.'---'.$emp_shift.'---'.$emp_department."<br>";
			$arrayfordeductions=$valts["arrayfordeductions"];
			if(!isset($_SESSION)) {
				 session_start();
			}
			$_SESSION["arrayfordeductions_".$empdkey]=$arrayfordeductions;
			$checkingAbs   = checkingAbs($vdr,$year,$empdkey,$emp_shift,$emp_department);
			
			$extraabs=$checkingAbs["alldate_spclcasera"];
			$monthval=$valts[$vdr."---"];
			$totalleaves_month=$extraabs+$monthval;

			$tab.=<<<AAA
				<th>$totalleaves_month</th>

AAA;
		}
		//print_r($valts);
		
			$tab.=<<<AAA
				</tr>
AAA;
	
					
		}
/*		
	foreach($abcd as $key=>$val)
	{
		//print_r($val);
		$emp_name_report=$empd[$key];
		$tab.=<<<AAA
				<tr>
					<th>$emp_name_report</th>
					
					
					
				
AAA;
		
		foreach($val as $k2=>$v2)
		{
			if($k2==2017)
			{	
		
				for($vdr=1;$vdr<=12;$vdr++)
				{
					$monthval=$v2[$vdr."---"];
					
					$tab.=<<<AAA
					<th>$monthval</th>
					
AAA;
		
				}
			}
		}
		$tab.=<<<AAA
				</tr>
AAA;
	
		
	}
*/

	echo $tab;		

			
?>
		</table>
	</body>

</html>

