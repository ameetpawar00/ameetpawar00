<?php
	include("../../include/conFig.php");
	include("dRay.php");
	echo $eid = $_GET['eid'];
	$valto = $_POST['valto'];
	
	//$valto = "ddx_3*$*$**$*$**$*$*sub_3*$*$*test1*$*$*2018-6-01*$*$*2018-9-01*$*$*3*$*$*83*$*$*13*$*$*11*$*$*1";
	//$valto = "ddx_3*$*$**$*$**$*$*sub_3*$*$*test1*$*$*2018-6-01*$*$*2018-9-01*$*$*3*$*$*83*$*$*13*$*$*11*$*$*2";
	//$valto = "ddx_3*$*$**$*$**$*$*sub_4*$*$*test2*$*$*2018-5-30*$*$*2019-3-30*$*$*3*$*$*80*$*$**$*$**$*$*2";
	//$valto = "ddx_3*$*$**$*$**$*$*sub_4*$*$*test2*$*$*2018-5-30*$*$*2019-3-30*$*$*3*$*$*80*$*$*15*$*$*54*$*$*1";
	
	$valto = explode("*$*$*",$valto);
	
	foreach($valto as $val)
	{
		$val = str_ireplace("'","\'",$val);
		if($val!="")
		{
			$post[] .= $val;
		}
	}
	$mtype=$post[0];
	$mtypee=explode("_",$mtype);
	$mtype=$mtypee[1];
	$stype=$post[1];
	$stypee=explode("_",$stype);
	$stype=$stypee[1];
	$desc=$post[2];
	$ddate=$post[3];
	$Department=$_REQUEST["extraDep"];
	$Designation=$_REQUEST["extraDes"];
	
	if($mtype==3 AND ($stype==3 OR $stype==4 OR $stype==5 OR $stype==6 OR $stype==7 OR $stype==8 OR $stype==9))
	{
		$todate=$post[4];
		$Duration=$post[5];
		$Slab=$post[6];
		$Entry=$post[7];
		//$sqls=", `todate`, `duration`, `slab`, `entry`";
		//$sqlsVals=", '$todate', '$Duration', '$Slab', '$Entry'";
		//$sqlsUpdates=", `todate`='$todate', `duration`='$Duration', `slab`='$Slab', `entry`='$Entry'";
		if($stype==3 OR $stype==4 OR $stype==5 OR $stype==6 OR $stype==7 OR $stype==8 OR $stype==9)
		{
			$Department=$post[7];
			$Designation=$post[8];
			$Entry=$post[9];
			//$sqls=", `todate`, `duration`, `slab`, `entry`, `department`, `designation`";
			//$sqlsVals=", '$todate', '$Duration', '$Slab', '$Entry', '$Department', '$Designation'";
			//$sqlsUpdates=", `todate`='$todate', `duration`='$Duration', `slab`='$Slab', `entry`='$Entry',`department`='$Department', `designation`='$Designation'";
		}
		$saveNotes="";
		$note="";
/*		$getDataSalary = mysql_query("SELECT `id`, `profileName` FROM `salary_structure_new` WHERE `delete`='0'" ,$con) or die(mysql_error());
		while ($rowSalary = mysql_fetch_assoc($getDataSalary))
		{
			$salprofArray[$rowSalary["id"]]=$rowSalary;
		}
		*/
		if((!$ddate) OR ($ddate AND strtotime($ddate) >= strtotime("2019-04-01")))
		{
			$getDataSalary = mysql_query("SELECT `id`, `profileName` FROM `salary_structure_new` WHERE `delete`='0'" ,$con) or die(mysql_error());
		}else{
			$getDataSalary = mysql_query("SELECT `id`, `salprofile` as `profileName` FROM `salary` WHERE `delete`='0'" ,$con) or die(mysql_error());
		}


		while ($rowSalary = mysql_fetch_array($getDataSalary))
		{
			$salprofArray[$rowSalary["id"]]=$rowSalary;
		}






		$getDatades = mysql_query("SELECT `id`, `name` FROM `department` WHERE `delete`='0'" ,$con) or die(mysql_error());
		while ($rowDes = mysql_fetch_assoc($getDatades))
		{
			$departArray[$rowDes["id"]]=$rowDes;
		}
		$getDataDept = mysql_query("SELECT `id`, `name` FROM `designation` WHERE `delete`='0'" ,$con) or die(mysql_error());
		while ($rowDept = mysql_fetch_assoc($getDataDept))
		{
			$desgArray[$rowDept["id"]]=$rowDept;
		}
		$newArray1 = array_keys($formali_array);
		$newArray2 = array_values($formali_array);
		$mtypen=$newArray1[$mtype-1];
		$stypen=$newArray2[$mtype-1][$stype];
		if(isset($_GET['editthk']))
		{
			$editthk = $_GET['editthk'];
			$getData = mysql_query("SELECT `mtype`, `stype`, `desc`, `modifiedby`, `extra`, `todate`, `duration`, `slab`, `entry`, `department`, `designation` FROM `emp_doc` WHERE `id`='$editthk'",$con) or die(mysql_error());
			$row = mysql_fetch_assoc($getData);
			if($row["mtype"] != $mtype)
			{
				$note.= "Previous type is <b>".$row["mtype"]."</b> and new type is <b>".$mtypen." </b>. <br> <br>";
			}
			if($row["stype"] != $stype)
			{
				$note.= "Previous Sub type is <b>".$row["stype"]."</b> and new Sub type is <b>".$stypen." </b>. <br> <br>";
			}
			if($row["desc"] != $desc)
			{
				$note.= "Previous Description is <b>".$row["desc"]."</b> and new Description is <b>".$desc." </b>. <br> <br>";
			}
			if($row["extra"] != $ddate)
			{
				$note.= "Previous From Date is <b>".$row["extra"]."</b> and new From Date is <b>".$ddate." </b>. <br> <br>";
			}
			if($row["todate"] != $todate)
			{
				$note.= "Previous To Date is <b>".$row["todate"]."</b> and new To Date is <b>".$todate." </b>. <br> <br>";
			}
			if($row["duration"] != $Duration)
			{
				$note.= "Previous Duration is <b>".$row["duration"]."</b> and new Duration is <b>".$Duration." </b>. <br> <br>";
			}
			if($row["slab"] != $Slab)
			{
				$salSlabs1=addslashes($salprofArray[$row["slab"]]["profileName"]);
				$salSlabs2=addslashes($salprofArray[$Slab]["profileName"]);
				$note.= "Previous Slab is <b>".$salSlabs1."</b> and new Slab is <b>".$salSlabs2." </b>. <br> <br>";
			}
			if(isset($Entry))
			{
				if($row["entry"] != $Entry)
				{
					$entry1=$extd[$row["entry"]];
					$entry2=$extd[$Entry];
					$note.= "Previous Entry Type is <b>".$entry1."</b> and new Entry Type is <b>".$entry2." </b>. <br> <br>";
				}
			}
			if($row["department"] != $Department)
			{
				$depart1=$departArray[$row["department"]]["name"];
				$depart2=$departArray[$Department]["name"];
				$note.= "Previous Department is <b>".$depart1."</b> and new Department is <b>".$depart2." </b>. <br> <br>";
			}
			if($row["designation"] != $Designation)
			{
				$desig1=$desgArray[$row["department"]]["name"];
				$desig2=$desgArray[$Designation]["name"];
				$note.= "Previous Designation is <b>".$desig1."</b> and new Designation is <b>".$desig2." </b>. <br> <br>";
			}
			$subject="Documentation Changes";
		}else{
			$Entrya=$extd[$Entry];
			$salSlabss=addslashes($salprofArray[$Slab]["profileName"]);
			$depart2=$departArray[$Department]["name"];
			$desig2=$desgArray[$Designation]["name"];
			$note.= "Type is <b>".$mtypen."</b>, <br> <br>";
			$note.= "Sub Type is <b>".$stypen."</b>, <br> <br>";
			$note.= "Description is <b>".$desc."</b>, <br> <br>";
			$note.= "From Date is <b>".$ddate."</b>, <br> <br>";
			$note.= "To Date is <b>".$todate."</b>, <br> <br>";
			$note.= "Duration is <b>".$Duration."</b>, <br> <br>";
			$note.= "Slab is <b>".$salSlabss."</b>, <br> <br>";
			$note.= "Entry Type is <b>".$Entrya."</b>, <br> <br>";
			$note.= "Department is <b>".$depart2."</b>, <br> <br>";
			$note.= "Designation is <b>".$desig2."</b>, <br> <br>";
			$subject="Documentation Inserted";
		}
		if($note)
		{
			$saveNotes="('$subject', '$note', '$eid', '', '$datetime', '$hrmloggedid', '0')";
			mysql_query("INSERT INTO `noteline` (`subject`, `note`, `employee`, `id`, `createdate`, `updatedby`, `delete`) VALUES $saveNotes",$con) or die(mysql_error());
		}
	}
	if(isset($_GET['editthk']))
	{
		$editthk = $_GET['editthk'];
		mysql_query("UPDATE `emp_doc` SET `mtype`='$mtype',`stype`='$stype',`desc`='$desc',`status`='1',`modifieddate`='$datetime',`modifiedby`='$hrmloggedid',`extra`='$ddate', `todate`='$todate', `duration`='$Duration', `slab`='$Slab', `entry`='$Entry',`department`='$Department', `designation`='$Designation' WHERE `id` ='$editthk'",$con) or die(mysql_error());
	}else{
		//echo "INSERT INTO `emp_doc`(`eid`, `mtype`, `stype`, `desc`, `status`, `createdate`, `modifieddate`, `modifiedby`, `extra`, `todate`, `duration`, `slab`, `entry`, `department`, `designation`) VALUES ('$eid', '$mtype', '$stype', '$desc', '1', '$datetime', '$datetime', '$hrmloggedid', '$ddate', '$todate', '$Duration', '$Slab', '$Entry', '$Department', '$Designation')";
		mysql_query("INSERT INTO `emp_doc`(`eid`, `mtype`, `stype`, `desc`, `status`, `createdate`, `modifieddate`, `modifiedby`, `extra`, `todate`, `duration`, `slab`, `entry`, `department`, `designation`) VALUES ('$eid', '$mtype', '$stype', '$desc', '1', '$datetime', '$datetime', '$hrmloggedid', '$ddate', '$todate', '$Duration', '$Slab', '$Entry', '$Department', '$Designation')",$con) or die(mysql_error());
	}
	//unset($post);
	//unset($_REQUEST);
?>
