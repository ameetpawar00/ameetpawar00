<?php
	include("../../include/conFig.php");
	include("../../include/grant_leave.php");
	$empId      = $_GET['empId'];
	$fromdate   = $_GET['fromdate'];
	$todate     = $_GET['todate'];
	$lrid       = $_GET['lrid'];
	$leaveType  = $_GET['leaveType'];
	$leavetime  = $_GET['ltypeval'];
	$rtype      = $_GET['rtype'];
	$fMonth     = explode("-", $fromdate);
	$tMonth     = explode("-", $todate);
	$ffmonth    = $fMonth[1];
	$ttmonth    = intval($tMonth[1]);
	$last_month = $ttmonth;
	$expLeave = explode("**", $leaveType);
	$year = date("Y");
	$sqlLeave = mysql_query("SELECT `date` FROM `leavecalendar` WHERE `holidayType` = '0' AND `delete` = '0' AND `year` = '$year'", $con) or die(mysql_error());
	$holiday = array();
	while ($fetchLeave = mysql_fetch_array($sqlLeave)) {
		$holiday[] = $fetchLeave[0];
	} //$fetchLeave = mysql_fetch_array($sqlLeave)
	$allowed         = getLeave($fromdate, $todate, $holiday, $expLeave, $leavetime);
	if ($rtype == 1 OR $rtype == 3) {
		if ($rtype == 3) {
			$quaterAr = array(
				"1" => array(
					"01",
					"02",
					"03"
				),
				"2" => array(
					"04",
					"05",
					"06"
				),
				"3" => array(
					"07",
					"08",
					"09"
				),
				"4" => array(
					"10",
					"11",
					"12"
				)
			);
			$expMonth = explode("-", $todate);
			foreach ($quaterAr as $key => $value) {
				if (in_array($expMonth[1], $value)) {
					$quater_old = $key;
				} //in_array($expMonth[1], $value)
			} //$quaterAr as $key => $value
			$days_taken    = $_GET["days"];
			$leaveType_old = $_GET["leaveType_old"];
			$expLeave_old  = explode("**", $leaveType_old);
		} //$rtype == 3
		$expLeave = explode("**", $leaveType);
		if ($rtype == 3 AND $expLeave_old[0] != $expLeave[0]) {
			$sqlprecheck = mysql_query("SELECT count(`lr_id`) as `no_of_lw_inc` FROM `allleavestat` WHERE `lr_id`='$lrid' AND `ltype`='LWP'", $con) or die(mysql_error());
			$fetchno_of_lw_inc = mysql_fetch_array($sqlprecheck);
			$no_of_lw_inc      = $fetchno_of_lw_inc["no_of_lw_inc"];
		} //$rtype == 3 AND $expLeave_old[0] != $expLeave[0]
		$year = date("Y");
		$sqlLeave = mysql_query("SELECT `date` FROM `leavecalendar` WHERE `holidayType` = '0' AND `delete` = '0' AND `year` = '$year'", $con) or die(mysql_error());
		$holiday = array();
		while ($fetchLeave = mysql_fetch_array($sqlLeave)) {
			$holiday[] = $fetchLeave[0];
		} //$fetchLeave = mysql_fetch_array($sqlLeave)
		$allowed         = getLeave($fromdate, $todate, $holiday, $expLeave, $leavetime);
		$leaveBal        = 0;
		$leaveBal_yearly = 0;
		if ($rtype == 3 AND $expLeave_old[0] == $expLeave[0]) {
			$leaveBal        = $leaveBal + $days_taken;
			$leaveBal_yearly = $leaveBal_yearly + $days_taken;
		} //$rtype == 3 AND $expLeave_old[0] == $expLeave[0]
		if ($expLeave[0] != 'LWP') {
			$quater     = $allowed['quater'];
			$lastQuater = end($quater);
			if ($expLeave[0] != 'Special' AND $expLeave[0] != 'LWP' AND $expLeave[0] != 'P' AND $expLeave[0] != 'M') {
				$sqlLeave = mysql_query("SELECT `" . $expLeave[0] . "`,`1Q" . $expLeave[0] . "`,`2Q" . $expLeave[0] . "`,`3Q" . $expLeave[0] . "`,`4Q" . $expLeave[0] . "` FROM `leaverecord` WHERE `userid` = '" . $empId . "' AND `delete` = '0'", $con) or die(mysql_error());
				$sqlLeave_yearly = mysql_query("SELECT `ALL`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`, `11`, `12` FROM `leaverecord_yearly` WHERE `userid` = '" . $empId . "' AND `delete` = '0'", $con) or die(mysql_error());
				$qLeave               = array();
				$qLeave_yearly        = array();
				$fetchQLeave          = mysql_fetch_array($sqlLeave);
				$fetchQLeave_yearly   = mysql_fetch_array($sqlLeave_yearly);
				$qLeave               = array(
					"Q1" => $fetchQLeave[1],
					"Q2" => $fetchQLeave[2],
					"Q3" => $fetchQLeave[3],
					"Q4" => $fetchQLeave[4]
				);
				$qLeave_yearly        = array(
					"1" => $fetchQLeave_yearly[1],
					"2" => $fetchQLeave_yearly[2],
					"3" => $fetchQLeave_yearly[3],
					"4" => $fetchQLeave_yearly[4],
					"5" => $fetchQLeave_yearly[5],
					"6" => $fetchQLeave_yearly[6],
					"7" => $fetchQLeave_yearly[7],
					"8" => $fetchQLeave_yearly[8],
					"9" => $fetchQLeave_yearly[9],
					"10" => $fetchQLeave_yearly[10],
					"11" => $fetchQLeave_yearly[11],
					"12" => $fetchQLeave_yearly[12]
				);
				$totalLeaveBal        = $fetchQLeave[0];
				$totalLeaveBal_yearly = $fetchQLeave_yearly[0];
				if ($rtype == 3 AND $expLeave_old[0] == $expLeave[0]) {
					$totalLeaveBal        = $totalLeaveBal + $days_taken;
					$totalLeaveBal_yearly = $totalLeaveBal_yearly + $days_taken;
				} //$rtype == 3 AND $expLeave_old[0] == $expLeave[0]
				for ($k = 1; $k <= $lastQuater; $k++) {
					$leaveBal += $qLeave['Q' . $k];
				} //$k = 1; $k <= $lastQuater; $k++
				for ($k = 1; $k <= $last_month; $k++) {
					$leaveBal_yearly += $qLeave_yearly[$k];
				} //$k = 1; $k <= $last_month; $k++
				if ($lastQuater == 4)
					$updateLeavesql = ",`1Q" . $expLeave[0] . "` =  '0',`2Q" . $expLeave[0] . "` = '0',`3Q" . $expLeave[0] . "` = '0'";
				else if ($lastQuater == 3)
					$updateLeavesql = ",`2Q" . $expLeave[0] . "` = '0',`1Q" . $expLeave[0] . "` = '0'";
				else if ($lastQuater == 2)
					$updateLeavesql = ",`1Q" . $expLeave[0] . "` = '0'";
				else
					$updateLeavesql = '';
				$updateLeavesql_yearly = "";
				for ($xk = 1; $xk < $last_month; $xk++) {
					$updateLeavesql_yearly .= ",`$xk` = '0'";
				} //$xk = 1; $xk < $last_month; $xk++
			} //$expLeave[0] != 'Special' AND $expLeave[0] != 'LWP' AND $expLeave[0] != 'P' AND $expLeave[0] != 'M'
			else {
				if ($expLeave[0] != 'LWP') {
					$sqlLeave = mysql_query("SELECT `" . $expLeave[0] . "` FROM `leaverecord` WHERE `userid` = '" . $empId . "' AND `delete` = '0'", $con) or die(mysql_error());
					$qLeave               = array();
					$fetchQLeave          = mysql_fetch_array($sqlLeave);
					$totalLeaveBal        = $fetchQLeave[0];
					$totalLeaveBal_yearly = $fetchQLeave[0];
					if ($rtype == 3 AND $expLeave_old[0] == $expLeave[0]) {
						$totalLeaveBal        = $totalLeaveBal + $days_taken;
						$totalLeaveBal_yearly = $totalLeaveBal_yearly + $days_taken;
					} //$rtype == 3 AND $expLeave_old[0] == $expLeave[0]
					$leaveBal        = $fetchQLeave[0];
					$leaveBal_yearly = $fetchQLeave[0];
					if ($rtype == 3 AND $expLeave_old[0] == $expLeave[0]) {
						$leaveBal        = $fetchQLeave[0] + $days_taken;
						$leaveBal_yearly = $fetchQLeave[0] + $days_taken;
					} //$rtype == 3 AND $expLeave_old[0] == $expLeave[0]
					$updateLeavesql = "";
				} //$expLeave[0] != 'LWP'
			}
		} //$expLeave[0] != 'LWP'
		$totalLeave      = $allowed['totalLeave'];
		$chkLeave        = $leaveBal - $totalLeave;
		$chkLeave_yearly = $leaveBal_yearly - $totalLeave;
		$flag            = 0;
		if (($leaveBal == 0 OR $leaveBal_yearly == 0) && $expLeave[0] != 'LWP')
			$flag = '2' . '**' . $leaveBal;
		else if (($chkLeave_yearly < 0 OR $chkLeave < 0) && !isset($expLeave[1]) && $expLeave[0] != 'LWP')
			$flag = '2' . '**' . $leaveBal;
		else if (count($allowed['leavedate']) < 1)
			$flag = 3;
		else
			$flag = 0;
		$sqlprecheck = mysql_query("SELECT * FROM `leaverequest` WHERE `updatedby` = '" . $empId . "' AND `delete` = '0' AND `status`='0' AND `fromdate` < '$fromdate'", $con) or die(mysql_error());
		$fetchQsqlprecheck = mysql_fetch_array($sqlprecheck);
		$precheck          = mysql_num_rows($sqlprecheck);
		if ($precheck > 0) {
			$flag = 4;
		} //$precheck > 0
		if ($flag == 0) {
			$sqlInsert       = "INSERT INTO `allleavestat` (`date`, `leave`, `empid`,`ltype`,`createdate`, `updatedate`, `lr_id`) VALUES";
			$alldays         = $allowed['allDays'];
			$leavedate       = $allowed['leavedate'];
			$cLeave          = count($leavedate);
			$leaveCtr        = $leaveBal;
			$leaveCtr_yearly = $leaveBal_yearly;
			$newArray        = array();
			$k               = 0;
			$leaveCt         = 0;
			$leaveCt_yearly  = 0;
			if ($leaveBal > 0) {
				if ($leavetime == 1)
					$ltypdevalue = 0;
				else if ($leavetime == 2)
					$ltypdevalue = 2;
				else if ($leavetime == 3)
					$ltypdevalue = 3;
				for ($i = 0; $i < $cLeave; $i++) {
					$sqlInsert .= "('" . $leavedate[$i] . "','" . $ltypdevalue . "','" . $empId . "','" . $expLeave[0] . "','" . date("Y-m-d H:i:s") . "','" . date("Y-m-d H:i:s") . "','" . $lrid . "'),";
					$newArray[] = $alldays[$i];
					if ($leavetime == 2 || $leavetime == 3) {
						$leaveCt         = $leaveCt + .5;
						$leaveCt_yearly  = $leaveCt_yearly + .5;
						$leaveCtr        = $leaveCtr - .5;
						$leaveCtr_yearly = $leaveCtr_yearly - .5;
					} //$leavetime == 2 || $leavetime == 3
					else {
						if ($leaveCtr >= 1 AND $leaveCtr_yearly >= 1) {
							$leaveCt++;
							$leaveCt_yearly++;
							$leaveCtr--;
							$leaveCtr_yearly--;
						} //$leaveCtr >= 1 AND $leaveCtr_yearly >= 1
					}
					if ($leaveCtr <= 0.5 OR $leaveCtr_yearly <= 0.5) {
						$k = $i + 1;
						break;
					} //$leaveCtr <= 0.5 OR $leaveCtr_yearly <= 0.5
				} //$i = 0; $i < $cLeave; $i++
			} //$leaveBal > 0
			if ($leaveCtr < 1 OR $leaveCtr_yearly < 1) {
				if ($leavetime == 1)
					$ltypdevalue = 1;
				else if ($leavetime == 2)
					$ltypdevalue = 4;
				else if ($leavetime == 3)
					$ltypdevalue = 5;
				for ($i = $k; $i < $cLeave; $i++) {
					$saveLeave = 'LWP';
					if ($expLeave[0] != 'LWP')
						$saveLeave = "LWP";
					$sqlInsert .= "('" . $leavedate[$i] . "','" . $ltypdevalue . "','" . $empId . "','" . $saveLeave . "','" . date("Y-m-d H:i:s") . "','" . date("Y-m-d H:i:s") . "','" . $lrid . "'),";
				} //$i = $k; $i < $cLeave; $i++
				$sqlInsert = rtrim($sqlInsert, ",");
			} //$leaveCtr < 1 OR $leaveCtr_yearly < 1
			else {
				$sqlInsert = rtrim($sqlInsert, ",");
			}
			$sqlInsert = rtrim($sqlInsert, ",");
			$updateReqfuest = mysql_query("DELETE FROM `allleavestat` WHERE `lr_id`='$lrid'", $con) or die(mysql_error());
			$queryInsert = mysql_query($sqlInsert, $con) or die(mysql_error());
			if (!isset($expLeave[1]))
				$ltype = $expLeave[0];
			else if ($expLeave[0] == 'LWP')
				$ltype = "LWP";
			else
				$ltype = $expLeave[0] . "**LWP";
			$updateRequest = mysql_query("UPDATE  `leaverequest` SET  `fromdate` =  '" . $fromdate . "', `todate` =  '" . $todate . "', `days` =  '" . $totalLeave . "',`status` = 1,`leavetype` = '" . $ltype . "',`leavetime` = '" . $leavetime . "' WHERE  `updatedby` = '" . $empId . "' AND `id` = '" . $lrid . "'", $con) or die(mysql_error());
			if ($expLeave[0] != 'LWP') {
				$totalLeaveBal        = $totalLeaveBal - $leaveCt;
				$totalLeaveBal_yearly = $totalLeaveBal_yearly - $leaveCt_yearly;
				if ($leavetime == 2 || $leavetime == 3) {
				} //$leavetime == 2 || $leavetime == 3
				if ($expLeave[0] != 'Special' AND $expLeave[0] != 'P' AND $expLeave[0] != 'M') {
					$updateLeavePool = mysql_query("UPDATE  `leaverecord` SET  `" . $expLeave[0] . "` =  '" . $totalLeaveBal . "',`" . $lastQuater . "Q" . $expLeave[0] . "` =  '" . $leaveCtr . "'" . $updateLeavesql . " WHERE `userid` = '" . $empId . "'", $con) or die(mysql_error());
					mysql_query("UPDATE `leaverecord_yearly` SET `ALL`='$totalLeaveBal_yearly',`$last_month`='$leaveCtr_yearly', `modifiededate`='$datetime',`updatedby`='$hrmloggedid' " . $updateLeavesql_yearly . " WHERE `userid`='$empId'", $con);
				} //$expLeave[0] != 'Special' AND $expLeave[0] != 'P' AND $expLeave[0] != 'M'
				else {
					$updateLeavePool = mysql_query("UPDATE  `leaverecord` SET  `" . $expLeave[0] . "` =  '" . $totalLeaveBal . "',`" . $expLeave[0] . "` =  '" . $leaveCtr . "'" . $updateLeavesql . " WHERE `userid` = '" . $empId . "'", $con) or die(mysql_error());
				}
			} //$expLeave[0] != 'LWP'
			echo $acno = "0";
			$sar     = array(
				"Full Day Leave",
				"First Half Leave",
				"Second Half Leave"
			);
			$counter = 1;
			foreach ($sar as $sarray) {
				$sel = "";
				if ($counter == $leavetime) {
					$ltime_w = $sarray;
				} //$counter == $leavetime
				$counter++;
			} //$sar as $sarray
			if ($rtype == 3 AND $expLeave_old[0] != $expLeave[0]) {
				$days_taken = $days_taken - $no_of_lw_inc;
				if ($expLeave[0] != 'Special' AND $expLeave[0] != 'P' AND $expLeave[0] != 'M') {
					$updateLeavePool = mysql_query("UPDATE `leaverecord` SET  `" . $expLeave_old[0] . "` =  `" . $expLeave_old[0] . "`+'" . $days_taken . "',`" . $quater_old . "Q" . $expLeave_old[0] . "` =  `" . $quater_old . "Q" . $expLeave_old[0] . "`+'" . $days_taken . "' WHERE `userid` = '" . $empId . "'", $con) or die(mysql_error());
					mysql_query("UPDATE `leaverecord_yearly` SET `ALL`=`ALL`+'$days_taken',`$last_month`=`$last_month`+'$days_taken', `modifiededate`='$datetime',`updatedby`='$hrmloggedid' WHERE `userid`='$empId'", $con);
				} //$expLeave[0] != 'Special' AND $expLeave[0] != 'P' AND $expLeave[0] != 'M'
				else {
					$updateLeavePool = mysql_query("UPDATE `leaverecord` SET  `" . $expLeave_old[0] . "` =  `" . $expLeave_old[0] . "`+'" . $days_taken . "' WHERE `userid` = '" . $empId . "'", $con) or die(mysql_error());
					if($expLeave_old[0]=="EL" OR $expLeave_old[0]=="CL" OR $expLeave_old[0]=="SL")
					{
						$updateLeavePool = mysql_query("UPDATE `leaverecord` SET  `" . $quater_old . "Q" . $expLeave_old[0] . "` =  `" . $quater_old . "Q" . $expLeave_old[0] . "`+'" . $days_taken . "' WHERE `userid` = '" . $empId . "'", $con) or die(mysql_error());
					}
				}
			} //$rtype == 3 AND $expLeave_old[0] != $expLeave[0]
			if ($acno == 0) {
				$updateRequest = mysql_query("UPDATE  `story` SET `type` = 1 WHERE `lrid` = '" . $lrid . "' AND `type` = 3", $con) or die(mysql_error());
				if ($rtype == 3) {
					$note = "Updated $expLeave[0] for $totalLeave days ($ltime_w) From $fromdate To $todate";
					mysql_query("INSERT INTO `story`(`subject`, `note`, `employee`, `type`, `updatedby`, `lrid`) VALUES ('Updated $expLeave[0]', '$note', '$empId', 5, '$hrmloggedid', '$lrid')", $con) or die(mysql_error());
				} //$rtype == 3
				$note = "Approved $expLeave[0] for $totalLeave days ($ltime_w) From $fromdate To $todate";
				mysql_query("INSERT INTO `story`(`subject`, `note`, `employee`, `type`, `updatedby`, `lrid`) VALUES ('Approved $expLeave[0]', '$note', '$empId', 2, '$hrmloggedid', '$lrid')", $con) or die(mysql_error());
				$updateRequest = mysql_query("UPDATE  `story` SET `type` = 1 WHERE `lrid` = '" . $lrid . "' AND `type` = 3", $con) or die(mysql_error());
			} //$acno == 0
		} //$flag == 0
		else {
			echo $flag;
		}
	} //$rtype == 1 OR $rtype == 3
	else {
		if ($rtype == 4 OR $rtype == 5) {
			$quaterAr = array(
				"1" => array(
					"01",
					"02",
					"03"
				),
				"2" => array(
					"04",
					"05",
					"06"
				),
				"3" => array(
					"07",
					"08",
					"09"
				),
				"4" => array(
					"10",
					"11",
					"12"
				)
			);
			$expMonth = explode("-", $todate);
			$mval     = intval($expMonth[1]);
			foreach ($quaterAr as $key => $value) {
				if (in_array($expMonth[1], $value)) {
					$quater = $key;
				} //in_array($expMonth[1], $value)
			} //$quaterAr as $key => $value
			$days_taken    = $_GET["days"];
			$leaveType_old = $_GET["leaveType_old"];
			$expLeave_old  = explode("**", $leaveType_old);
			$eexxtrra      = "";
			if ($rtype == 5) {
				$eexxtrra = ",`extra`=2";
			} //$rtype == 5
			$updateRequest = mysql_query("UPDATE `leaverequest` SET `status` = 2$eexxtrra WHERE `updatedby` = '" . $empId . "' AND `id` = '" . $lrid . "'", $con) or die(mysql_error());
			$updateRequest = mysql_query("DELETE FROM `allleavestat` WHERE `lr_id`='$lrid'", $con) or die(mysql_error());
			if ($expLeave_old[0] != 'Special' AND $expLeave_old[0] != 'LWP' AND $expLeave_old[0] != 'P' AND $expLeave_old[0] != 'M') {
				$updateLeavePool = mysql_query("UPDATE  `leaverecord` SET  `" . $expLeave_old[0] . "` =  `" . $expLeave_old[0] . "`+'" . $days_taken . "',`" . $quater . "Q" . $expLeave_old[0] . "` =  `" . $quater . "Q" . $expLeave_old[0] . "`+'" . $days_taken . "' WHERE `userid` = '" . $empId . "'", $con) or die(mysql_error());
				mysql_query("UPDATE `leaverecord_yearly` SET `ALL`=`ALL`+'$days_taken',`$mval`=`$mval`+'$days_taken', `modifiededate`='$datetime',`updatedby`='$hrmloggedid' WHERE `userid`='$empId'", $con);
			} //$expLeave_old[0] != 'Special' AND $expLeave_old[0] != 'LWP' AND $expLeave_old[0] != 'P' AND $expLeave_old[0] != 'M'
			else {
				if ($expLeave_old[0] != 'LWP') {
					$updateLeavePool = mysql_query("UPDATE  `leaverecord` SET  `" . $expLeave_old[0] . "` =  `" . $expLeave_old[0] . "`+'" . $days_taken . "' WHERE `userid` = '" . $empId . "'", $con) or die(mysql_error());
				} //$expLeave_old[0] != 'LWP'
			}
			echo $flag = 666;
			$note = "Rejected (Updated) Leave From  $fromdate To $todate";
			mysql_query("INSERT INTO `story`(`subject`, `note`, `employee`, `type`, `updatedby`, `lrid`) VALUES ('Rejected (Updated) $post[4]', '$note', '$empId', 4, '$hrmloggedid', '$lrid')", $con) or die(mysql_error());
		}elseif ($rtype == 786) {
			$totalLeave=$allowed["totalLeave"];
			//$leavetime
			$sqlLeave_yearly = mysql_query("SELECT 	`1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`, `11`, `12`, `ALL` FROM `leaverecord_yearly` WHERE `userid` = '" . $empId . "' AND `delete` = '0'", $con) or die(mysql_error());
			$fetchQLeave_yearly   = mysql_fetch_assoc($sqlLeave_yearly);
			if($fetchQLeave_yearly["ALL"]>=$totalLeave)
			{
				$sqlLeave = mysql_query("SELECT `1QEL`, `2QEL`, `3QEL`, `4QEL`, `1QCL`, `2QCL`, `3QCL`, `4QCL`, `1QSL`, `2QSL`, `3QSL`, `4QSL` FROM `leaverecord` WHERE `userid` = '" . $empId . "' AND `delete` = '0'", $con) or die(mysql_error());
				$fetchQLeave = mysql_fetch_assoc($sqlLeave);
				//echo sizeof($fetchQLeave)."<br>";
				$tobd=$totalLeave;
				$whatandhowmc=array();
				$flag="";
				$flagArray="";
				if($leavetime==1)
				{
					$sqlTestCountr=1;
				}else{
					$sqlTestCountr=0.5;
				}
				$sqltob="";
				foreach($fetchQLeave as $abcd=>$fetchQLeavevalue)
				{
					//echo $fetchQLeave_yearly["ALL"]."--------".$totalLeave;
					//echo $fetchQLeavevalue."<br>";
					if($leavetime==1)
					{
						$fetchQLeavevalue=round($fetchQLeavevalue,0,PHP_ROUND_HALF_DOWN);
					}
					for($xlri=$fetchQLeavevalue;$xlri>0;$xlri--)
					{
						if($sqlTestCountr>$totalLeave)
						{
							break;
						}
						//$flag.= $abcd."----1<br>";
						//echo '---2323239898<br>';
						if($leavetime==1)
						{
							$flagArray[$abcd]=$flagArray[$abcd]+1;
							$sqlTestCountr++;
						}else{
							$flagArray[$abcd]=$flagArray[$abcd]+0.5;
							$sqlTestCountr+=0.5;
						}
					}
					//$flag.= "----<br>";
				}
				//print_r($flagArray);
				$typeofmain=array();
				foreach($flagArray as $flagArraykey=>$flagArrayvals)
				{
					//echo $flagArraykey."***".$flagArrayvals."----<br>";
					$sqltob.="`$flagArraykey`=`$flagArraykey`-$flagArrayvals,";
					$expltb=explode("Q",$flagArraykey);
					$typeofmain[$expltb[1]]=$typeofmain[$expltb[1]]+$flagArrayvals;
				}
				if($leavetime==1)
				{
					$sqlTestCountra=1;
				}else{
					$sqlTestCountra=0.5;
				}
				$flagArray1="";
				for($sbt=1; $sbt<=12; $sbt++)
				{
					if($leavetime==1)
					{
						$fetchQLeavevaalue=round($fetchQLeave_yearly[$sbt],0,PHP_ROUND_HALF_DOWN);
					}else{
						$fetchQLeavevaalue=$fetchQLeave_yearly[$sbt];
					}
					for($bio=$fetchQLeavevaalue;$bio>0;$bio--)
					{
						if($sqlTestCountra>$totalLeave)
						{
							break;
						}
						//$flag.= $sbt."----1<br>";
						if($leavetime==1)
						{
							$flagArray1[$sbt]=$flagArray1[$sbt]+1;
							$sqlTestCountra++;
						}else{
							$flagArray1[$sbt]=$flagArray1[$sbt]+0.5;
							$sqlTestCountra+=0.5;
						}
					}
				}
				$sqltob2="";
				$typeofyear=0;
				foreach($flagArray1 as $flagArraykey1=>$flagArrayvals1)
				{
					//echo $flagArraykey."***".$flagArrayvals."----<br>";
					$sqltob2.="`$flagArraykey1`=`$flagArraykey1`-$flagArrayvals1,";
					$typeofyear+=$flagArrayvals1;
				}
				//print_r($typeofmain);
				//echo $typeofyear;
				$sqltob3="";
				foreach($typeofmain as $typeofmainkey=>$typeofmainvalue)
				{
					$sqltob3.="`$typeofmainkey`=`$typeofmainkey`-$typeofmainvalue,";
				}
				$sqltob4.="`ALL`=`ALL`-$typeofyear,";
				$sqltob=rtrim($sqltob,",");
				$sqltob2=rtrim($sqltob2,",");
				if($sqltob)
				{
					$finalSql1="UPDATE `leaverecord` SET $sqltob3 $sqltob WHERE `userid` = '$empId' AND `delete` = '0'";
					$finalSql2="UPDATE `leaverecord_yearly` SET $sqltob4 $sqltob2 WHERE `userid` = '$empId' AND `delete` = '0'";
					mysql_query($finalSql1, $con) or die(mysql_error());
					mysql_query($finalSql2, $con) or die(mysql_error());
					$flag = 786;
					$ENC=base64_encode($finalSql1."---".$finalSql2);
					$note = "$typeofyear Unapproved Leave Deduction From Leave Bank ($fromdate To $todate) <p style=\'word-wrap: break-word;display:none\'>(ENC:$ENC)</p>";
					mysql_query("INSERT INTO `story`(`subject`, `note`, `employee`, `type`, `updatedby`, `lrid`) VALUES ('Unapproved Leave Deduction From Leave Bank ', '$note', '$empId', 4, '$hrmloggedid', '$lrid')", $con) or die(mysql_error());
					mysql_query("UPDATE `leaverequest` SET `extra1`='1' WHERE `id`='$lrid'", $con) or die(mysql_error());
					//echo $finalSql1;
					//echo "<br>";
					//echo $finalSql2;
				}
			}else{
				$flag=789;
			}
			echo $flag;
		} //$rtype == 4 OR $rtype == 5
		elseif ($rtype == 7) {
			$updateRequest = mysql_query("UPDATE  `leaverequest` SET `extra` = 1 WHERE `id` = '" . $lrid . "'", $con) or die(mysql_error());
			echo $flag = 95840;
			$note = "Requested Leave Cancellation From  $fromdate To $todate";
			mysql_query("INSERT INTO `story`(`subject`, `note`, `employee`, `type`, `updatedby`, `lrid`) VALUES ('Leave Cancellation Requested By user $post[4]', '$note', '$empId', 1, '$hrmloggedid', '$lrid')", $con) or die(mysql_error());
		} //$rtype == 7
		elseif ($rtype == 6) {
			$updateRequest = mysql_query("UPDATE  `leaverequest` SET `status` = '2',`delete` = '1' WHERE `id` = '" . $lrid . "'", $con) or die(mysql_error());
			echo $flag = 95890;
			$updateRequest = mysql_query("UPDATE  `story` SET `type` = 1 WHERE `lrid` = '" . $lrid . "' AND `type` = 3", $con) or die(mysql_error());
			$note = "Canceled Leave From  $fromdate To $todate";
			mysql_query("INSERT INTO `story`(`subject`, `note`, `employee`, `type`, `updatedby`, `lrid`) VALUES ('Canceled By user $post[4]', '$note', '$empId', 4, '$hrmloggedid', '$lrid')", $con) or die(mysql_error());
		} //$rtype == 6
		else {
			//print_r($allowed);
			$updateRequest = mysql_query("UPDATE  `leaverequest` SET `status` = 2 WHERE `id` = '" . $lrid . "'", $con) or die(mysql_error());
			echo $flag = 555;
			$updateRequest = mysql_query("UPDATE  `story` SET `type` = 1 WHERE `lrid` = '" . $lrid . "' AND `type` = 3", $con) or die(mysql_error());
			$note = "Rejected Leave From  $fromdate To $todate";
			mysql_query("INSERT INTO `story`(`subject`, `note`, `employee`, `type`, `updatedby`, `lrid`) VALUES ('Rejected $post[4]', '$note', '$empId', 4, '$hrmloggedid', '$lrid')", $con) or die(mysql_error());
		}
	}
?>