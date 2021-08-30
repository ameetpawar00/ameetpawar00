<?php
	include("../include/conFig.php");
	include("../include/calculateAbsent_trifid.php");
	/**
	 * Created by PhpStorm.
	 * User: ameet
	 * Date: 28-06-2018
	 * Time: 16:19C:\Users\ameet\AppData\Local\Temp\fz3temp-2\moodelview-latecoming.php
	 */
	error_reporting(1);
	
	
	
	$rytyt=rtrim(display_children($hrmloggedid,0),",");
	function display_children($hrmloggedid,$level) {
		$result = mysql_query("SELECT employee.id,employee.name,employee.department,employee.shift FROM employee,team,teamamtes WHERE team.leader = $hrmloggedid AND teamamtes.mateid = employee.id AND teamamtes.teamid = team.id AND team.delete = 0 AND employee.delete = 0 AND employee.empstatus = 2 ORDER BY employee.name ASC");
		$abcdd="";
		while ($row = mysql_fetch_assoc($result)) {
			$id=$row["id"];
			$name=$row["name"];
			$department=$row["department"];
			//	$name=$row["name"];
			$shift=$row["shift"];
			//$abcdd.="$name--$id,";
			$abcdd.="$id--$name--$department--$shift,";
			$abcdd.=display_children($id,$level+1);
		}
		return $abcdd;
	}
	
	$cmonnth=date("m");
	//$cmonnth=06;
	$cyear=date("Y");
	$department=$_COOKIE['department'];
	$rtyu="";
	if($rytyt!="")
	{
		$Ayrtt=explode(",",$rytyt);
		foreach ($Ayrtt as $AyrttVal)
		{
			$tuyiu=explode("--",$AyrttVal);
			$empid=$tuyiu[0];
			$empName=$tuyiu[1];
			$empdepartment=$tuyiu[2];
			$empshift=$tuyiu[3];
			$abcd=checkingAbs($cmonnth,$cyear,$empid,$empshift,$empdepartment);
			$late_mnts=$abcd["lMin"];
			
			$rtyu.=<<<AAA

					<tr>
						<td title="Late Coming">
							<strong>
								<span style="color:green">
									$empName
								</span>
							</strong>
						</td>
						<td>
							<strong>
								<span style="color:green">
									$late_mnts
								</span>
							</strong>
						</td>
					</tr>
AAA;
		
		
		}
	}else{
		
		$result = mysql_query("SELECT employee.id,employee.name,employee.department,employee.shift FROM employee WHERE employee.delete = 0 AND employee.empstatus = 2 ORDER BY employee.name ASC");
		$abcdd="";
		while ($row = mysql_fetch_assoc($result)) {
			//print_r($row);
			$empid=$row["id"]."<br>";
			$empName=$row["name"]."<br><br>";
			$empdepartment=$row["department"]."<br><br>";
			$empshift=$row["shift"]."<br><br>";
			
			$abcd=checkingAbs($cmonnth,$cyear,$empid,$empshift,$empdepartment);
			$late_mnts=$abcd["lMin"];
			
			
			$rtyu.=<<<AAA

					<tr>
						<td title="Late Coming">
							<strong>
								<span style="color:green">
									$empName
								</span>
							</strong>
						</td>
						<td>
							<strong>
								<span style="color:green">
									$late_mnts
								</span>
							</strong>
						</td>
					</tr>
AAA;
		
		}
	}





?>

<div id="myTitle">
	<div class="title">Late Coming Details</div>
	<div class="strip">
		<span>Dashboard</span>
		<span>Late Coming</span>
		<span>View</span>
	</div>
</div>
<div style="height:400px;overflow-x:hidden;overflow-y:scroll" id="mainDivId">
	<table width="100%" cellpadding="5" cellspacing="0"  border="1" class="fetch" id="">
		<thead>
		<th>Name</th>
		<th>Minutes</th>
		</thead>
		<tbody>
		<?=$rtyu?>
		</tbody>
	</table>