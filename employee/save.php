<?php
	include("../include/conFig.php");
	$valto = $_POST['valto'];
	
	$valto = explode("*$*$*",$valto);
	
	
	$jobappid = $_GET['jobappid'];
	$type = $_GET['type'];
	$h=$_GET['h'];
	foreach($valto as $val)
	{
		$val = str_ireplace("'","\'",$val);
		/*if($val=="")
		{
			
			$post[] .= $val."0";
		}else{
			$post[] .= $val;
			
		}*/
		$post[] .= $val;
	}
	
	$attendId=trim($post[32]," ");
	//$insert = mysql_query("INSERT INTO `uploadocument` (`id`,`document`,`eid`,`type`,`createdate`,`updatedby` ,`delete`) VALUES ('','$a','$hrmloggedid','$type','$datetime', '$hrmloggedid','0')",$con) or die(mysql_error());
	//echo "INSERT INTO `employee` (`id`, `name`, `mobile`, `phone`, `workphone`, `username`, `password`, `email`, `workemail`, `empid`, `empstatus`, `department`, `designation`, `location`, `reportto`, `hiresource`, `branch`, `doj`, `dob`, `doa`, `marital`, `gender`,  `address`, `city`, `specialization`, `jobdescription`, `about`, `image`, `createdate`, `updatedby`, `delete`, `active`,`bank`,`accountno`,`pfaccount`,`referredby`,`role`) VALUES ('', '$post[3]', '$post[16]', '$post[5]', '$post[8]', '$post[0]', '$post[1]', '$post[4]', '$post[9]', '$post[2]', '$post[14]', '$post[7]', '$post[6]', '$post[10]', '$post[11]', '$post[12]', '$post[15]', '$post[13]', '$post[17]', '$post[20]', '$post[19]', '$post[25]',  '$post[18]',  '$post[23]', '$post[22]', '$post[21]', '$post[26]', '$datetime',  '$datetime', '$hrmloggedid', '0', '$post[24]','$post[27]','$post[28]','$post[29]', '$post[30]','$post[31]')";
	if($h > 31) {
		mysql_query("INSERT INTO `employee` (`id`, `name`, `mobile`, `phone`, `workphone`, `username`, `password`, `email`, `workemail`, `empid`, `department`, `designation`, `location`, `salaryId`, `hiresource`, `branch`, `doj`, `dob`, `doa`, `marital`, `gender`,  `address`, `city`, `specialization`, `jobdescription`, `about`, `image`, `createdate`, `updatedby`, `delete`, `active`,`bank`,`accountno`,`pfaccount`,`referredby`,`role`,`attenid`,`empstatus`,`lastname`,`tempAddress`,`shift`,`PAN_NO`,`aadhar_no`, `PF`, `ESIC`, `PT`, `TDS`, `ESICNO`, `emp_acc_name`, `PFFX`, `salaryIdNew`) VALUES ('', '$post[3]', '$post[16]', '$post[5]', '$post[8]', '$post[0]', '$post[1]', '$post[4]', '$post[9]', '$post[2]', '$post[7]', '$post[6]', '$post[10]', '$post[11]', '$post[12]', '$post[15]', '$post[13]', '$post[17]', '$post[20]', '$post[19]', '$post[25]',  '$post[18]',  '$post[23]', '$post[22]', '$post[21]', '$post[26]', '$datetime',  '$datetime', '$hrmloggedid', '0', '$post[24]','$post[27]','$post[28]','$post[29]', '$post[30]','$post[31]','$attendId', '$post[14]','$post[33]','$post[34]','$post[35]','$post[36]','$post[37]','$post[38]','$post[39]','$post[40]','$post[41]','$post[42]','$post[43]','$post[45]','$post[46]')",$con) or die(mysql_error());
		$id = mysql_insert_id();
		for($i= 32 ;$i < $h ;$i++)
		{
			//echo "INSERT INTO `uploadocument` (`id`,`document`,`eid`,`createdate`,`updatedby` ,`delete`) VALUES ('','$post[$i]','$id','$datetime', '$hrmloggedid','0')";
			mysql_query("INSERT INTO `uploadocument` (`id`,`document`,`eid`,`createdate`,`updatedby` ,`delete`) VALUES ('','$post[$i]','$id','$datetime', '$hrmloggedid','0')",$con) or die(mysql_error());
		}
	}
	else
	{
		mysql_query("INSERT INTO `employee` (`id`, `name`, `mobile`, `phone`, `workphone`, `username`, `password`, `email`, `workemail`, `empid`, `department`, `designation`, `location`, `salaryId`, `hiresource`, `branch`, `doj`, `dob`, `doa`, `marital`, `gender`,  `address`, `city`, `specialization`, `jobdescription`, `about`, `image`, `createdate`, `updatedby`, `delete`, `active`,`bank`,`accountno`,`pfaccount`,`referredby`,`role`,`attenid`,`empstatus`,`lastname`,`tempAddress`,`shift`,`PAN_NO`,`aadhar_no`, `PF`, `ESIC`, `PT`, `TDS`, `ESICNO`, `emp_acc_name`, `PFFX`, `salaryIdNew`) VALUES ('', '$post[3]', '$post[16]', '$post[5]', '$post[8]', '$post[0]', '$post[1]', '$post[4]', '$post[9]', '$post[2]', '$post[7]', '$post[6]', '$post[10]', '$post[11]', '$post[12]', '$post[15]', '$post[13]', '$post[17]', '$post[20]', '$post[19]', '$post[25]',  '$post[18]',  '$post[23]', '$post[22]', '$post[21]', '$post[26]', '$datetime',  '$datetime', '$hrmloggedid', '0', '$post[24]','$post[27]','$post[28]','$post[29]', '$post[30]','$post[31]','$attendId','$post[14]','$post[33]','$post[34]','$post[35]','$post[36]','$post[37]','$post[38]','$post[39]','$post[40]','$post[41]','$post[42]','$post[43]','$post[45]','$post[46]')",$con) or die(mysql_error());
		$id = mysql_insert_id();
	}
	
	//$Entrya="First Salary Review";
	
	date_default_timezone_set("Asia/Calcutta");
	$date=$post[13];
	$duration=$post[44];
	
	$todateFind = date('Y-n-d', strtotime("+$duration months", strtotime($date)));
	
	
	mysql_query("INSERT INTO `emp_doc`(`eid`, `mtype`, `stype`, `desc`, `status`, `createdate`, `modifieddate`, `modifiedby`, `extra`, `todate`, `duration`, `slab`, `entry`, `department`, `designation`) VALUES ('$id', '3', '7', '---', '1', '$datetime', '$datetime', '$hrmloggedid', '$post[13]', '$todateFind', '$duration', '$post[11]', '', '$post[7]', '$post[6]')",$con) or die(mysql_error());
	
	
	$query = "SELECT `id`, `salprofile` FROM `salary` WHERE `id`='$post[11]'";
	$getDataSalary = mysql_query($query,$con) or die(mysql_error());
	$rowSalary = mysql_fetch_assoc($getDataSalary);
	$salSlabss=$rowSalary["salprofile"];
	
	$query1 = "SELECT `id`, `name` FROM `department` WHERE `id`='$post[7]'";
	$getDatades = mysql_query($query1,$con) or die(mysql_error());
	$rowDes = mysql_fetch_assoc($getDatades);
	$depart2=$rowDes["name"];
	
	$query2 = "SELECT `id`, `name` FROM `designation` WHERE `id`='$post[6]'";
	$getDataDept = mysql_query($query2,$con) or die(mysql_error());
	$rowDept = mysql_fetch_assoc($getDataDept);
	$desig2=$rowDept["name"];
	
	$note.= "Type is <b>First Salary Review</b>, <br> <br>";
	$note.= "Sub Type is <b>First Salary Review</b>, <br> <br>";
	$note.= "Description is <b>---</b>, <br> <br>";
	$note.= "From Date is <b>".$post[13]."</b>, <br> <br>";
	$note.= "To Date is <b>".$todateFind."</b>, <br> <br>";
	$note.= "Duration is <b>".$duration."</b>, <br> <br>";
	$note.= "Slab is <b>".$salSlabss."</b>, <br> <br>";
	//$note.= "Entry Type is <b>Normal</b>, <br> <br>";
	$note.= "Department is <b>".$depart2."</b>, <br> <br>";
	$note.= "Designation is <b>".$desig2."</b>, <br> <br>";
	$subject="Documentation Inserted";
	
	$saveNotes="('$subject', '$note', '$id', '', '$datetime', '$hrmloggedid', '0')";
	mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES $saveNotes",$con) or die(mysql_error());
	
	
	$dateOne = date("Y-m-d");
	mysql_query("INSERT INTO `salaryprofilestory`(`empId`, `salaryProfile`, `date`, `datetime`)  VALUES ('$id','$post[11]','$dateOne','$datetime')",$con) or die(mysql_error());
	
	// to initialize default leave entry
	mysql_query("INSERT INTO `leaverecord`(`userid`,`createdate`, `modifiededate`) VALUES ('$id', '$datetime', '$datetime')",$con) or die(mysql_error());
	$lrid = mysql_insert_id();
	mysql_query("INSERT INTO `leaverecord_yearly`(`userid`,`createdate`, `modifiededate`) VALUES ('$id', '$datetime', '$datetime')",$con) or die(mysql_error());
	$lrid_yearly = mysql_insert_id();
	
	
	if($_GET['jobappid'])
	{
		$jobappid = $_GET['jobappid'];
		$getData = mysql_query("SELECT jobapplicants.qualification, jobapplicants.experience, jobvacancy.vacancy,jobvacancy.id FROM jobapplicants,jobvacancy WHERE jobapplicants.jobid = jobvacancy.id AND jobapplicants.id = '$jobappid'",$con) or die(mysql_error());
		$row = mysql_fetch_array($getData);
		$vacancy = trim($row[2]);
		$newVacancy = $vacancy - 1;
		mysql_query("INSERT INTO `emp_education`(`name`, `degree`, `eid`, `createdate`, `updatedby`) VALUES ('$row[0]','$row[0]','$id','$datetime','$hrmloggedid')",$con) or die(mysql_error());
		//mysql_query("INSERT INTO `workexperience`(`job desc`, `eid`, `createdate`, `updatedate`, `updatedby`) VALUES ('$row[1]','$id','$datetime','$datetime','$hrmloggedid')",$con) or die(mysql_error());
		mysql_query("UPDATE `jobvacancy` SET `vacancy` = '$newVacancy' WHERE `id` = '$row[3]'",$con) or die(mysql_error());
		mysql_query("UPDATE `jobapplicants` SET `delete` = '1' WHERE `id` = '$jobappid'",$con) or die(mysql_error());
	}
	echo "leaverecord/edit?id=$lrid&id_yearly=$lrid_yearly&employeeid=$id";
?>


