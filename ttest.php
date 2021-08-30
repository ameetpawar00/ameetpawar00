<?php
	include("include/conFig.php");

	//SELECT , `mobile`, `phone`, `workphone`, `username`, `password`, `email`, `workemail`, `empid`, `department`, `designation`, `location`, `salaryId`, `hiresource`, `branch`, `doj`, `dob`, `doa`, `marital`, `gender`, `address`, `city`, `state`, `specialization`, `jobdescription`, `about`, `image`, `accountno`, `pfaccount`, `bank`, `referredby`, `PAN_NO`, `blood_group`, `createdate`, `updatedate`, `updatedby`, `delete`, `active`, `role`, `attenid`, `empstatus`, `shift`, `lastname`, `tempAddress`, `l_allotstatus`, `r_leave`, `aadhar_no`, `dol`, `dop`, `dor`, `PF`, `ESIC`, `PT`, `TDS`, `saldistyp`, `LTB`, `uan_no`, `ESICNO`, `emp_acc_name`, `depcheck` FROM  WHERE 1
	/*$mainArray=array();
	$getOne=mysql_query("SELECT `id`, `name` FROM `employee` WHERE `delete`=0");
	while ($rowOne=mysql_fetch_assoc($getOne)) {
		$mainArray[$rowOne["id"]]=$rowOne["name"];
		
	}*/
	//print_r($teamarray);
	display_children(9, 0,$mainArray);
	//display_children(16, 0,$mainArray);
	/*$get=mysql_query("SELECT `mateid`, `teamid`, `team`.`leader` FROM `team`,`teamamtes` WHERE `team`.`id`=`teamamtes`.`teamid` AND `team`.`leader`=97");
	
	$teamarray=array();
	
	while ($row=mysql_fetch_array($get)) {
		if(key_exists($row["mateid"],$mainArray))
		{
			$teamarray[$row["leader"]][]=array($row["teamid"],$mainArray[$row["leader"]],$mainArray[$row["mateid"]]);
		}
	}*/
	
	
	
	function display_children($parent, $level,$mainArray) {
		$teamarray=array();
		// retrieve all children of $parent
		$result = mysql_query("SELECT employee.id,employee.name,employee.salaryId,employee.designation,teamamtes.mateid FROM employee,team,teamamtes WHERE team.leader = $parent AND teamamtes.mateid = employee.id AND teamamtes.teamid = team.id AND team.delete = 0 AND employee.delete = 0 AND employee.empstatus = 2 ORDER BY employee.name ASC");
		// display each child
		while ($row = mysql_fetch_array($result)) {
			// indent and display the title of this child
			$id=$row["id"];
			$name=$row["name"];
			$salaryId=$row["salaryId"];
			$designation=$row["designation"];
			$mateid=$row["mateid"];
			
			echo str_repeat("-----&nbsp&nbsp&nbsp&nbsp&nbsp",$level).$id."---$name---$salaryId---$designation---$mateid<br>";
			
			display_children($row['mateid'], $level+1,$mainArray);
			// call this function again to display this
			// child's children
		}
	}
	
	$getData = mysql_query("SELECT employee.id,employee.name,employee.salaryId,employee.designation,teamamtes.mateid FROM employee,team,teamamtes WHERE team.leader = '9' AND teamamtes.mateid = employee.id AND teamamtes.teamid = team.id AND team.delete = '0' AND employee.delete = '0' AND employee.empstatus = '2' ORDER BY employee.name ASC",$con) or die(mysql_error());
	
	while($row = mysql_fetch_array($getData)) {
		print_r($row);
	}
	//print_r($teamarray);
?>
