<?php
	function decimalHours($time)
	{
		$hms = explode(":", $time);
		return ($hms[1]/60);
	}
	function searchForId($id, $array) {
		foreach ($array as $key => $val) {
			if ($val['date'] === $id) {
				return $key;
			}
		}
		return null;
	}
	function getSundayCount($startTime, $endTime, $extra)
	{
		$day = 86400;
		$format = 'Y-m-d';
		$startTime = strtotime($startTime);
		$endTime = strtotime($endTime);
		$numDays = round(($endTime - $startTime) / $day) + 1;
		//echo $numDays;
		$days = array();
		for ($i = 0; $i < $extra; $i++) {
			$days = strftime("%A",strtotime(date($format, ($startTime + ($i * $day)))));
			if($days == 'Sunday')
			{
				$sunday[] = date($format, ($startTime + ($i * $day)));
			}
		}
		$result = $sunday;
		return $result;
	}


	$arrayfordeductions=array();



	function checkingAbs($smonth,$cYear,$eid,$shiftHere,$dept)
	{
		if(!isset($_SESSION)) {
			session_start();
		}
		if(isset($_SESSION["arrayfordeductions_".$eid]))
		{
			$arrayfordeductions=$_SESSION["arrayfordeductions_".$eid];

		}

		$all_type_l_dayes = array();
		include("../include/conFig.php");
		$sqlShift = mysql_query("SELECT * FROM  `shift` WHERE id ='$shiftHere' AND `delete` = '0'",$con);
		$sqlShiftCount = mysql_num_rows($sqlShift);
		$rowShi = mysql_fetch_array($sqlShift);
		$shiftTime=$rowShi["starttime"];//shift start time
		$shiftOutTime=$rowShi["endtime"];//shift end time
		$first_half_dayout_time=$rowShi["fhdot"];//First half Day Out Time
		$seconfd_half_dayin_time=$rowShi["shdit"];//Second half Day In Time
		$lcfhc=$rowShi["lcfhc"];//Late Coming First Half Count
		$lcshc=$rowShi["lcshc"];//Late Coming Second Half Count as Full Day
		$sqlCalCount = 0;
		$sqlCalleaveArr =array();
		$sqlCalendar1 = mysql_query("SELECT `date` FROM  `leavecalendar` WHERE MONTH(`date`) ='$smonth' AND  YEAR(`date`) ='$cYear' AND `delete` = '0' AND `holidayType` = '0'",$con);
		$sqlCalendar = mysql_query("SELECT `date` FROM  `leavecalendar` WHERE MONTH(`date`) ='$smonth' AND  YEAR(`date`) ='$cYear' AND `delete` = '0' AND `holidayType` = '0'",$con);
		$sqlCalendar2 = mysql_query("SELECT `date` FROM  `leavecalendar` WHERE MONTH(`date`) ='$smonth' AND  YEAR(`date`) ='$cYear' AND `delete` = '0' AND `holidayType` = '1'",$con);
		$sqlCalCount = mysql_num_rows($sqlCalendar1);
		while($getCalleave = mysql_fetch_array($sqlCalendar))
		{
			$sqlCalleaveArr[] = $getCalleave[0];
			$sqlCalleaveArrfull[] = $getCalleave[0];
//$all_type_l_dayes[$getCalleave[0]] = $getCalleave[0];
			$all_type_l_dayes[$getCalleave[0]] = "leavecalendar_holidayType_0";
		}
		while($getCalleavea = mysql_fetch_array($sqlCalendar2))
		{
			$sqlCalleaveArra[] = $getCalleavea[0];
//$all_type_l_dayes[$getCalleavea[0]] = "leavecalendar_holidayType_1";
		}
//print_r($sqlCalleaveArrfull);
		$leave[] = "";
		$ltype[] = "";

		$alldate[] = "";
		$alldatelwp[] = "";
		$alldateh[] = "";
		$absentDate = array();
		$notPunchDate = array();
		$earlyGoingDate = array();
		$earlyBHGoingDate = array();
		$leaveCountDate = array();
		$absentCountDate = array();
		$firstHalfLDate = array();
		$secondHalfLDate = array();
		$firstHalfADate = array();
		$secondHalfADate = array();
		$lcondet="";
		$alldate_spclcasera = 0;
		$lateComes = 0;
		$leaveCount = 0;
		$absentCount = 0;
		$absentlwp = 0;
		$absentNI = 0;
		$notPunch = 0;
		$earlyGoing = 0;
		$earlyBHGoing = 0;
		$absentWI = 0;
		$firstHalfL = 0;
		$secondHalfL = 0;
		$datesa="";
		$firstHalfA = 0;
		$secondHalfA = 0;
		$tempAbsent = 0;
		$tempHalf = 0;
		$abc = 0;
		$Saturday = 0;
		$data = array();
		$datalwp = array();
		$datah = array();
		$value = array();
		$getleave = mysql_query("SELECT `leave`,`ltype`,`date` FROM `allleavestat` WHERE MONTH(`date`) ='$smonth' AND  YEAR(`date`) ='$cYear' AND `empid` = '$eid' AND `leave` < '2' AND `ltype` != 'LWP'",$con) or die(mysql_error());
		while($rowLeave = mysql_fetch_array($getleave))
		{
			$data[$rowLeave[2]] = $rowLeave[0];
			$alldate[] = $rowLeave[2];
			$all_type_l_dayes[$rowLeave[2]] = "allleavestat_!lwp <2";

		}

		$getleavelwp = mysql_query("SELECT `leave`,`ltype`,`date` FROM `allleavestat` WHERE MONTH(`date`) ='$smonth' AND  YEAR(`date`) ='$cYear' AND `empid` = '$eid' AND `ltype` LIKE '%LWP%'",$con) or die(mysql_error());
		while($rowLeavelwp = mysql_fetch_array($getleavelwp))
		{
			$datalwp[$rowLeavelwp[2]] = $rowLeavelwp[0];
			$alldatelwp[] = $rowLeavelwp[2];
			$all_type_l_dayes[$rowLeavelwp[2]] = "allleavestat_=lwp <2";

		}

		$getleaveh = mysql_query("SELECT `leave`,`ltype`,`date` FROM `allleavestat` WHERE MONTH(`date`) ='$smonth' AND  YEAR(`date`) ='$cYear' AND `empid` = '$eid' AND `leave` >'1' AND `ltype` != 'LWP'",$con) or die(mysql_error());
		while($rowLeaveh = mysql_fetch_array($getleaveh))
		{
			$datah[$rowLeaveh[2]] = $rowLeaveh[0];
			$alldateh[] = $rowLeaveh[2];
		}

		$getleavelwph = mysql_query("SELECT `leave`,`ltype`,`date` FROM `allleavestat` WHERE MONTH(`date`) ='$smonth' AND  YEAR(`date`) ='$cYear' AND `empid` = '$eid' AND `ltype` LIKE '%LWP%'",$con) or die(mysql_error());
		while($rowLeavelwph = mysql_fetch_array($getleavelwph))
		{
			$datalwph[$rowLeavelwph[2]] = $rowLeavelwph[0];
			$alldatelwph[] = $rowLeavelwph[2];
		}
		$dataVal = array();
		$lateLimit = 90;

		$sql = mysql_query("SELECT `checkin`,`checkout`,`attendance`,`shifttime`,`date` FROM  `attendance` WHERE MONTH(`date`) ='$smonth' AND  YEAR(`date`) ='$cYear' AND `employee` = '$eid'",$con);
		$totalData = mysql_num_rows($sql);
		$lMin = 0;

		while($resultaa = mysql_fetch_array($sql))
		{

			$resulta[]=$resultaa;
		}
		//print_r($resulta);
		$ccoouunntt=0;
		foreach($resulta as $result)
		{


			$checkin=$result["checkin"];
			$checkout=$result["checkout"];
			$attendance=$result["attendance"];
			$datea=$result["date"];
			$day = strftime("%A",strtotime($datea));
			$dFlag = 0;
			$ltFlag = 0;
			$shiftTime=$rowShi["starttime"];//shift start time
			$shiftOutTime=$rowShi["endtime"];//shift end time
			$first_half_dayout_time=$rowShi["fhdot"];//First half Day Out Time
			$seconfd_half_dayin_time=$rowShi["shdit"];//Second half Day In Time
			$lcfhc=$rowShi["lcfhc"];//Late Coming First Half Count
			$lcshc=$rowShi["lcshc"];//Late Coming Second Half Count as Full Day
			$newa = strtotime ( '-1 hour' , strtotime ( $shiftOutTime ) ) ;
			$shiftOutTime_m1 = date ( 'H:i:s' , $newa );
			/*
            if($checkin > $seconfd_half_dayin_time && $checkin < $lcshc && $dFlag == 0)//######################### latecount2 and halfday deduction1
                {
                    //echo 11111;
                }*/
			if($day == 'Saturday' OR in_array($datea,$sqlCalleaveArra))
			{

//				print_r($sqlCalleaveArra);
				$Saturday++;
				//$new = strtotime ( '+1 hour' , strtotime ( $shiftTime ) ) ;
				//$shiftTime = date ( 'H:i:s' , $new );
				$dFlag = 1;
				$shiftTime = "10:00:00";
				$shiftOutTime = "18:30:00";
				$lcfhc="11:00:00";	//Late Coming First Half Count//add these lines in next update
				$lcshc="15:30:00";	//Late Coming First Half Count////add these lines in next update
				if($dept==5 OR $dept==13)
				{
					$shiftOutTime = "14:00:00";
					$first_half_dayout_time=$shiftOutTime;//First half Day Out Time
				}
			}
			if(($attendance == 1 && !in_array($datea,$sqlCalleaveArr)))
			{

				if($checkin > $shiftTime && $checkin < $lcfhc)//######################### latecount1
				{

					$time1 = strtotime($shiftTime);
					$time2 = strtotime($checkin);
					$mins = ($time2 - $time1) / 60;
					$lateMin = $mins;

					$lcondet.= "<tr><td>".$datea."</td><td>1</td><td>Late coming</td><td> $lateMin </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
					$lMin = $lMin + $lateMin;

					//###############################################
					if($lMin > $lateLimit)
					{
						$lateComes++;
						$lateLimit = $lateLimit+30;
					}
					//###################################
				}
				else if($checkin>=$lcfhc AND $checkin<$lcshc AND $checkin < $seconfd_half_dayin_time)//######################### first half off day deduction0
				{

					if($checkin>$shiftOutTime)
					{

					}elseif(in_array($datea,$alldatelwph))
					{
						$absentlwp=$absentlwp+0.5;
						$datesa.= "<tr><td>".$datea."</td><td>1</td><td>Approved LWP</td><td> 0.5 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
					}elseif(in_array($datea,$alldateh))
					{

					}else{
						$absentWI = $absentWI+0.5;
						$datesa.= "<tr><td>".$datea."</td><td>2</td><td>Absent</td><td> .5 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";

					}

				}
				else if($checkin > $lcfhc && $checkin < $seconfd_half_dayin_time &&  $checkin > $shiftTime && $dFlag == 0)//######################### first half off day deduction1
				{

					$absentWI = $absentWI+0.5;
					$datesa.= "<tr><td>".$datea."</td><td>3</td><td>Absent</td><td> .5 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
				}
				else if($checkin >= $seconfd_half_dayin_time && $checkin < $lcshc && $dFlag == 0)//######################### latecount2 and halfday deduction1
				{
					//echo $date;

					$time1 = strtotime($seconfd_half_dayin_time);
					$time2 = strtotime($checkin);
					$mins = ($time2 - $time1) / 60;
					$lateMin = $mins;
					$lcondet.= "<tr><td>".$datea."</td><td>2</td><td>Late coming</td><td> $lateMin </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
					$lMin = $lMin + $lateMin;
					if($lMin > $lateLimit)
					{
						$lateComes++;
						$lateLimit = $lateLimit+30;
					}

					//changed for ankit kanungo case
					if(in_array($datea,$alldatelwph))
					{
						$absentlwp = $absentlwp+0.5;
						//echo $datea."<br>";
						$time1 = strtotime($seconfd_half_dayin_time);
						$time2 = strtotime($checkin);
						$mins = ($time2 - $time1) / 60;
						$lateMin = $mins;
						$lcondet.= "<tr><td>".$datea."</td><td>2</td><td>Late coming</td><td> $lateMin </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
						$datesa.= "<tr><td>".$datea."</td><td>29</td><td>Approved LWP(Special case approved LWP+latecoimng Aleem Sheikh 09-2017)</td><td> 0.5 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";

					}elseif(in_array($datea,$alldateh)){

					}else{

						$absentWI = $absentWI+0.5;
						$datesa.= "<tr><td>".$datea."</td><td>5</td><td>Absent</td><td> .5 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
					}


				}else if($checkin >= $lcshc && $dFlag == 0)//######################### fullday deduction1
				{
					$absentWI++;
					$datesa.= "<tr><td>".$datea."</td><td>6</td><td>Absent</td><td> 1 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
					$ltFlag = 1;
				}else if($checkin > $shiftTime && $checkin >= $seconfd_half_dayin_time && $checkin < $lcshc && $dFlag == 1)
				{

					//condition added for ranjeet case saturday
					if(in_array($datea,$alldatelwph))
					{
						$absentlwp = $absentlwp+0.5;
						$datesa.= "<tr><td>".$datea."</td><td>24</td><td>Approved LWP</td><td> 0.5 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
					}elseif(in_array($datea,$alldateh)){

					}else{

						$time1 = strtotime($seconfd_half_dayin_time);
						$time2 = strtotime($checkin);
						$mins = ($time2 - $time1) / 60;
						$lateMin = $mins;
						$lcondet.= "<tr><td>".$datea."</td><td>2</td><td>Late coming</td><td> $lateMin </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
						$lMin = $lMin + $lateMin;
						if($lMin > $lateLimit)
						{
							$lateComes++;
							$lateLimit = $lateLimit+30;
						}

						$absentWI = $absentWI+0.5;
						$datesa.= "<tr><td>".$datea."</td><td>25</td><td>Absent</td><td> .5 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";





					}
				}else if($checkin >= $lcshc && $dFlag == 1)
				{

					$absentWI++;
					$datesa.= "<tr><td>".$datea."</td><td>656666</td><td>Absent</td><td> 1 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
					$ltFlag = 1;
				}/*else if($checkin >= $lcfhc && $dFlag == 1)
			{
				
						$absentWI = $absentWI+0.5;
						$datesa.= "<tr><td>".$datea."</td><td>55555</td><td>Absent</td><td> .5 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";		
			}*/



				if($checkin == "00:00:00" && $checkout == "00:00:00")//######################### fullday deduction2
				{
					if($day != 'Sunday')
					{
						if(in_array($datea,$alldate))
						{
							$dataVal[$datea] = $data[$attendance];
						}elseif(in_array($datea,$alldatelwp))
						{
							$absentlwp++;
							$datesa.= "<tr><td>".$datea."</td><td>7</td><td>Approved LWP</td><td> 1 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
							$datesa.=   $datea."7lwp apr 1<br>";
						}else{
							$absentWI++;
							$datesa.= "<tr><td>".$datea."</td><td>8</td><td>Absent</td><td> 1 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
						}
					}
				}else if($checkout < $shiftOutTime && $checkout < $first_half_dayout_time && $checkout != "00:00:00") //######################### fullday deduction3 FOR CONDITION LIKE CI 9:00 COUT 11:30
				{
					//if one goes before shift out half time secondhalf leave monika jat, Ashish andani case

					if(in_array($datea,$alldate))
					{
						//IF ALREADY LEAVE SKIPP OR ELSE INCREASE LEAVES ACCODINGLY 
					}elseif(in_array($datea,$alldatelwp))
					{
						$absentlwp++;
						$datesa.= "<tr><td>".$datea."</td><td>9</td><td>Approved LWP</td><td> 1 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
					}else{
						$absentWI++;
						$datesa.= "<tr><td>".$datea."</td><td>10</td><td>Absent</td><td> 1 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
					}

				}else if($checkout < $shiftOutTime && $checkout >= $first_half_dayout_time && $dFlag == 0)//######################### second half off day deduction1###### $checkout >= $first_half_dayout_time = added for surendra case 2 pm c-out time not comming 06-03-2017 by:amit pawar
				{
					if(in_array($datea,$alldateh))
					{
						$dataVal[$datea] = $datah[$attendance];
					}else{
						if($checkout>$shiftOutTime_m1)//############################### one hrs early going
						{

						}else{
							if(in_array($datea,$alldatelwph))
							{
								$absentlwp=$absentlwp+0.5;
								$datesa.= "<tr><td>".$datea."</td><td>11</td><td>Approved LWP</td><td> 0.5 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
							}else{
								$absentWI = $absentWI+0.5;
								$datesa.= "<tr><td>".$datea."</td><td>12</td><td>Absent</td><td> .5 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
							}

						}
					}
				}else if($checkout < $shiftOutTime && $checkout >= $first_half_dayout_time && $dFlag == 1)//######################### second half off day deduction1 saturday######### $checkout >= $first_half_dayout_time = added for surendra case 2 pm c-out time not comming 06-03-2017 by:amit pawar
				{

					/*****newly added for sat early going removed ($absentlwp=$absentlwp+0.5;)****/
					if(in_array($datea,$alldateh))
					{
						$dataVal[$datea] = $datah[$attendance];
					}else{
						if($checkout>$shiftOutTime_m1)//############################### one hrs early going
						{

						}else{
							if(in_array($datea,$alldatelwph))
							{
								$absentlwp=$absentlwp+0.5;
								$datesa.= "<tr><td>".$datea."</td><td>13</td><td>Approved LWP</td><td> 0.5 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
							}else{
								$absentWI = $absentWI+0.5;
								$datesa.= "<tr><td>".$datea."</td><td>14</td><td>Absent</td><td> .5 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
							}
							//echo $dept;
						}
					}
					/*****newly added for sat early going removed ($absentlwp=$absentlwp+0.5;)****/
				}

			}
			else if($attendance == 4  &&  !in_array($datea,$sqlCalleaveArr))
			{


				if(in_array($datea,$alldatelwph))
				{
					$absentlwp=$absentlwp+0.5;
					$datesa.= "<tr><td>".$datea."</td><td>15</td><td>Approved LWP</td><td> 0.5 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
				}elseif(in_array($datea,$alldateh))
				{
					// added for bipin case 0.5 removal//echo $datea;
				}else{
					$absentWI = $absentWI+0.5;
					$datesa.= "<tr><td>".$datea."</td><td>16</td><td>Absent</td><td> .5 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";

				}
			}
			else {


				$date_list_1="";
				$date_list_2="";
				$date_list_3="";

				for($xdv=$ccoouunntt;$xdv<sizeof($resulta);$xdv++)
				{

					$abs_date=$resulta[$xdv]["date"];
					$abs_date_attendence=$resulta[$xdv]["attendance"];
					$future_date=$resulta[$xdv+1]["date"];
					$future_date_attendance=$resulta[$xdv+1]["attendance"];
					$back_date=$resulta[$xdv-1]["date"];
					$back_date_attendance=$resulta[$xdv-1]["attendance"];

					if(array_key_exists($abs_date,$all_abs_date))
					{

					}else{
						$all_abs_date[$abs_date]=$abs_date;

						if($abs_date_attendence==4 or $abs_date_attendence==1)
						{
							break;
						}else{
							//echo $abs_date."********************<br>";+
							if(($resulta[$xdv-1]["attendance"]==1) OR ($resulta[$xdv-1]["attendance"]==4) OR $xdv==0)
							{
								for($ddt=$xdv;$ddt<sizeof($resulta);$ddt++)
								{
									if(in_array($resulta[$ddt]["date"],$sqlCalleaveArrfull))
									{

									}else if($resulta[$ddt]["attendance"]==3){

									}else if(($resulta[$ddt]["attendance"]!=1) AND ($resulta[$ddt]["attendance"]!=4)){
										//$resulta[$ddt]["date"]."********************<br>";
										$date_list_1.=$resulta[$ddt]["date"];
										break;
									}
								}

							}else if(($resulta[$xdv+1]["attendance"]==1) OR ($resulta[$xdv+1]["attendance"]==4) OR ($xdv+1==sizeof($resulta)))
							{
								//echo $resulta[$xdv]["date"]."********************<br>";
								for($ddb=$xdv;$ddb>0;$ddb--)
								{
									if(in_array($resulta[$ddb]["date"],$sqlCalleaveArrfull))
									{

									}else if($resulta[$ddb]["attendance"]==3){

									}else if(($resulta[$ddb]["attendance"]!=1) AND ($resulta[$ddb]["attendance"]!=4)){
										//$resulta[$ddb]["date"]."********************<br>";
										$date_list_2.=$resulta[$ddb]["date"];
										break;
									}
								}
							}else{

								$date_list_3.=$abs_date."---";

							}
						}
					}
				}


				//echo array_search($date_list_1,$resulta)."$$$$$$$$$$$$$$$$$$$<br>";
				//echo array_search($date_list_2,$resulta)."$$$$$$$$$$$$$$$$$$$<br>";

				$alltypes_of_leaves_taken=array_merge($alldate,$alldatelwp);
				if(($date_list_1!="" AND $date_list_2!="" AND $date_list_3!="") AND ($date_list_1!=$date_list_2))
				{

					$smallvalueforcheck = searchForId($date_list_1, $resulta);
					$bigvalueforcheck = searchForId($date_list_2, $resulta);
					$diffrencebetvalues=$bigvalueforcheck-$smallvalueforcheck;
					if($diffrencebetvalues>1)
					{

						//echo $date_list_1."---first<br>";
						//echo $date_list_3."---mid_<br>";
						//echo $date_list_2."---last_<br>";
						$date_list_3=rtrim($date_list_3,"---");
						$exp_dates1=explode($date_list_1."---",$date_list_3);
						if(sizeof($exp_dates1)>1)
						{
							$exp_dates2=$exp_dates1[1];

						}else{

							$exp_dates2=$exp_dates1[0];
						}
						$exp_dates3=explode("---".$date_list_2,$exp_dates2);
						$exp_dates4=$exp_dates3[0];
						$exp_dates5=explode("---",$exp_dates4);
						$fdate=$date_list_1;
						//echo $exp_dates4;
						if(in_array($fdate,$alltypes_of_leaves_taken))
						{
							if(in_array($fdate,$alldate))
							{
								//echo $fdate."---firstdate_normal<br>";
							}elseif(in_array($fdate,$alldatelwp)){
								//echo $fdate."---firstdate_appr_lwp<br>";


								if(!in_array($fdate,$arrayfordeductions))
								{
									$absentlwp++;
									$arrayfordeductions[]=$fdate;

									$datesa.= "<tr><td>$fdate</td><td>00001</td><td>absentlwp</td><td> 1 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
								}

							}

						}else{


							if(!in_array($fdate,$arrayfordeductions))
							{
								$absentWI++;
								$alldate_spclcasera++;
								$arrayfordeductions[]=$fdate;
								$datesa.= "<tr><td>$fdate</td><td>00002</td><td>absentWI</td><td> 1 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
							}

							//echo $fdate."---firstdate_nahi_Li_hai<br>";

						}
						$counterf1=0;
						$counterforcurval=0;




						$date_diffrencees=array_diff($exp_dates5,$alltypes_of_leaves_taken);
						if(sizeof($date_diffrencees)>0)
						{


							$date_diffrencee_lwp=array_intersect($exp_dates5,$alldatelwp);
							//print_r($date_diffrencee_lwp);//$alldate,$alldatelwp
							//print_r($exp_dates5);//$alldate,$alldatelwp
							if(sizeof($date_diffrencee_lwp)>0)
							{
								foreach($date_diffrencee_lwp as $valdate_diffrencee_lwp)
								{

									if(!in_array($valdate_diffrencee_lwp,$arrayfordeductions))
									{
										$absentlwp++;
										$arrayfordeductions[]=$valdate_diffrencee_lwp;
										$datesa.= "<tr><td>$valdate_diffrencee_lwp</td><td>00003</td><td>absentlwp</td><td> 1 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
									}
								}


							}else{
								//echo $date_list_1."---first$ccoouunntt<br>";
								//echo $date_list_3."---mid$ccoouunntt<br>";
								//echo $date_list_2."---last$ccoouunntt<br>";
							}

							$sowi=sizeof($date_diffrencees);



							foreach($date_diffrencees as $val1)
							{

								if(!in_array($val1,$arrayfordeductions))
								{
									$absentWI++;
									$alldate_spclcasera++;
									$arrayfordeductions[]=$val1;
									$datesa.= "<tr><td>$val1</td><td>00003</td><td>absentWI</td><td> 1 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
								}
							}

						}else{


							$leave_diffrences1=array_diff($exp_dates5,$alldate);


							if(sizeof($leave_diffrences1)>0)
							{
								$solw=sizeof($leave_diffrences1);
								foreach($leave_diffrences1 as $val2)
								{
									if(!in_array($val2,$arrayfordeductions))
									{
										$absentlwp++;
										$arrayfordeductions[]=$val2;

										$datesa.= "<tr><td>$val2</td><td>00004</td><td>absentlwp</td><td> 1 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
									}
								}



							}else{

							}






						}


						$last_date=$date_list_2;

						if(in_array($last_date,$alltypes_of_leaves_taken))
						{
							if(in_array($last_date,$alldate))
							{
								//echo $fdate."---lastdate_normal<br>";
							}elseif(in_array($last_date,$alldatelwp)){
								//echo $fdate."---lastdate_appr_lwp<br>";


								if(!in_array($last_date,$arrayfordeductions))
								{
									$absentlwp++;
									$arrayfordeductions[]=$last_date;
									$datesa.= "<tr><td>$last_date</td><td>00005</td><td>absentlwp</td><td> 1 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
								}
							}

						}else{

							if(!in_array($last_date,$arrayfordeductions))
							{
								$absentWI++;
								$alldate_spclcasera++;
								$arrayfordeductions[]=$last_date;
								$datesa.= "<tr><td>$last_date</td><td>00006</td><td>absentWI</td><td> 1</td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
							}

							//echo $last_date."---lastdate_nahi_Li_hai<br>";
						}
					}else{
						$fdate=$date_list_1;
						if(in_array($fdate,$alltypes_of_leaves_taken))
						{
							if(in_array($fdate,$alldate))
							{
								//echo $fdate."---firstdate_normal<br>";
							}elseif(in_array($fdate,$alldatelwp)){
								//echo $fdate."---firstdate_appr_lwp<br>";


								if(!in_array($fdate,$arrayfordeductions))
								{
									$absentlwp++;
									$arrayfordeductions[]=$fdate;
									$datesa.= "<tr><td>$fdate</td><td>00007</td><td>absentlwp</td><td> 1 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
								}
							}

						}else{

							if(!in_array($fdate,$arrayfordeductions))
							{
								$absentWI++;
								$alldate_spclcasera++;
								$arrayfordeductions[]=$fdate;
								$datesa.= "<tr><td>$fdate</td><td>00008</td><td>absentWI</td><td> 1 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
							}

							//echo $fdate."---firstdate_nahi_Li_hai<br>";

						}

						$last_date=$date_list_2;

						if(in_array($last_date,$alltypes_of_leaves_taken))
						{
							if(in_array($last_date,$alldate))
							{
								//echo $fdate."---lastdate_normal<br>";
							}elseif(in_array($last_date,$alldatelwp)){
								//echo $fdate."---lastdate_appr_lwp<br>";


								if(!in_array($last_date,$arrayfordeductions))
								{
									$absentlwp++;
									$arrayfordeductions[]=$last_date;
									$datesa.= "<tr><td>$last_date</td><td>00009</td><td>absentlwp</td><td> 1 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
								}
							}

						}else{


							if(!in_array($last_date,$arrayfordeductions))
							{
								$absentWI++;
								$alldate_spclcasera++;
								$arrayfordeductions[]=$last_date;
								$datesa.= "<tr><td>$last_date</td><td>00010</td><td>absentWI</td><td> 1</td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
							}

							//echo $last_date."---lastdate_nahi_Li_hai<br>";
						}


						//echo $date_list_1."---first<br>";

						//echo $date_list_2."---last_<br>";
					}
				}else if(($date_list_1!="" AND $date_list_2!="" AND $date_list_3!="") AND ($date_list_1==$date_list_2)){

					$fdate=$date_list_1;
					if(in_array($fdate,$alltypes_of_leaves_taken))
					{
						if(in_array($fdate,$alldate))
						{
							//echo $fdate."---firstdate_normal<br>";	
						}elseif(in_array($fdate,$alldatelwp)){
							//echo $fdate."---firstdate_appr_lwp<br>";	


							if(!in_array($fdate,$arrayfordeductions))
							{
								$absentlwp++;
								$arrayfordeductions[]=$fdate;
								$datesa.= "<tr><td>$fdate</td><td>00011</td><td>absentlwp</td><td> 1 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
							}
						}

					}else{

						if(!in_array($fdate,$arrayfordeductions))
						{
							$absentWI++;
							$alldate_spclcasera++;
							$arrayfordeductions[]=$fdate;
							$datesa.= "<tr><td>$fdate</td><td>00012</td><td>absentWI</td><td> 1 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
						}

						//echo $fdate."---firstdate_nahi_Li_hai<br>";

					}
				}else if(($date_list_1!="" AND $date_list_2!="" AND $date_list_3=="") AND ($date_list_1==$date_list_2)){

					$fdate=$date_list_1;
					if(in_array($fdate,$alltypes_of_leaves_taken))
					{
						if(in_array($fdate,$alldate))
						{
							//echo $fdate."---firstdate_normal<br>";	
						}elseif(in_array($fdate,$alldatelwp)){
							//echo $fdate."---firstdate_appr_lwp<br>";	


							if(!in_array($fdate,$arrayfordeductions))
							{
								$absentlwp++;
								$arrayfordeductions[]=$fdate;
								$datesa.= "<tr><td>$fdate</td><td>00015</td><td>absentlwp</td><td> 1 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
							}
						}

					}else{

						if(!in_array($fdate,$arrayfordeductions))
						{
							$absentWI++;
							$alldate_spclcasera++;
							$arrayfordeductions[]=$fdate;
							$datesa.= "<tr><td>$fdate</td><td>00012</td><td>absentWI</td><td> 1 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
						}

						//echo $fdate."---firstdate_nahi_Li_hai<br>";

					}
				}else if($date_list_1!="" AND $date_list_2=="" AND $date_list_3==""){

					$fdate=$date_list_1;
					if(in_array($fdate,$alltypes_of_leaves_taken))
					{
						if(in_array($fdate,$alldate))
						{
							//echo $fdate."---firstdate_normal<br>";	
						}elseif(in_array($fdate,$alldatelwp)){
							//echo $fdate."---firstdate_appr_lwp<br>";	


							if(!in_array($fdate,$arrayfordeductions))
							{
								$absentlwp++;
								$arrayfordeductions[]=$fdate;
								$datesa.= "<tr><td>$fdate</td><td>00013</td><td>absentlwp</td><td> 1 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
							}
						}

					}else{

						if(!in_array($fdate,$arrayfordeductions))
						{
							$absentWI++;
							$alldate_spclcasera++;
							$arrayfordeductions[]=$fdate;
							$datesa.= "<tr><td>$fdate</td><td>00014</td><td>absentWI</td><td> 1 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
						}

						//echo $fdate."---firstdate_nahi_Li_hai<br>";

					}
					//echo $date_list_1."---first<br>";
					//echo $date_list_3."---mid_<br>";
					//echo $date_list_2."---last_<br>";
				}else if($date_list_1!="" AND $date_list_2!="" AND $date_list_3==""){




					$fdate=$date_list_1;
					if(in_array($fdate,$alltypes_of_leaves_taken))
					{
						if(in_array($fdate,$alldate))
						{
							//echo $fdate."---firstdate_normal<br>";	
						}elseif(in_array($fdate,$alldatelwp)){
							//echo $fdate."---firstdate_appr_lwp<br>";	


							if(!in_array($fdate,$arrayfordeductions))
							{
								$absentlwp++;
								$arrayfordeductions[]=$fdate;
								$datesa.= "<tr><td>$fdate</td><td>00015</td><td>absentlwp</td><td> 1 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
							}
						}

					}else{

						if(!in_array($fdate,$arrayfordeductions))
						{
							$absentWI++;
							$alldate_spclcasera++;
							$arrayfordeductions[]=$fdate;
							$datesa.= "<tr><td>$fdate</td><td>00016</td><td>absentWI</td><td> 1 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
						}

						//echo $fdate."---firstdate_nahi_Li_hai<br>";

					}

					$last_date=$date_list_2;

					if(in_array($last_date,$alltypes_of_leaves_taken))
					{
						if(in_array($last_date,$alldate))
						{
							//echo $fdate."---lastdate_normal<br>";	
						}elseif(in_array($last_date,$alldatelwp)){
							//echo $fdate."---lastdate_appr_lwp<br>";	


							if(!in_array($last_date,$arrayfordeductions))
							{
								$absentlwp++;
								$arrayfordeductions[]=$last_date;
								$datesa.= "<tr><td>$last_date</td><td>00017</td><td>absentlwp</td><td> 1 </td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
							}
						}

					}else{


						if(!in_array($last_date,$arrayfordeductions))
						{
							$absentWI++;
							$alldate_spclcasera++;
							$arrayfordeductions[]=$last_date;
							$datesa.= "<tr><td>$last_date</td><td>00018</td><td>absentWI</td><td> 1</td><td>$checkin-$checkout</td><td>$shiftTime-$shiftOutTime-$first_half_dayout_time-$seconfd_half_dayin_time-$lcfhc-$lcshc</td><td> $dept;  $eid</td></tr>";
						}

						//echo $last_date."---lastdate_nahi_Li_hai<br>";
					}

					//echo $date_list_1."---first$ccoouunntt<br>";
					//echo $date_list_3."---mid$ccoouunntt<br>";
					//echo $date_list_2."---last$ccoouunntt<br>";





				}else{

					//echo $date_list_1."---first$ccoouunntt<br>";
					//echo $date_list_3."---mid$ccoouunntt<br>";
					//echo $date_list_2."---last$ccoouunntt<br>";
				}
			}
			$ccoouunntt++;
			//print_r($alltypes_of_leaves_taken);
		}

		//if(($hrmloggedid==193) AND (!isset($_SESSION["arrayfordeductions_".$eid])))

		/**
		 *
		 * special permission fro admin user
		 * @param int $hrmloggedid
		 */

		if($hrmloggedid==93)
		{
			echo "<div id='det_date' style='display:none'><h2>Date Wise Deduction Details</h2><div style='height:400px;overflow-x:hidden;overflow-y:scroll'' id='mainDivId'><table  class='fetch' id='' style='text-align:center' cellspacing='0' cellpadding='5' border='1' width='100%'><thead><tr><th>Date</th><th>Condition</th><th>Type</th><th> Deduction</th><th>checkin-checkout Time</th><th>ShiftTime-ShiftOutTime-First_half_dayout_time-Seconfd_half_dayin_time-lcfhc-lcshc</th><th>Dept AND Id </th></tr></thead><tfoot><tr><th></th><th></th><th></th><th> $totalAbsent + $absentlwp</th><th></th><th></th><th></th></tr></tfoot><tbody>".$datesa."</tbody></table></div></div>";

			echo "<div id='det_late' style='display:none'><h2>Date Wise Latecoming Details</h2><div style='height:400px;overflow-x:hidden;overflow-y:scroll'' id='mainDivId'><table  class='fetch' id='' style='text-align:center' cellspacing='0' cellpadding='5' border='1' width='100%'><thead><tr><th>Date</th><th>Condition </th><th>Type</th><th> Minuts </th><th>checkin-checkout Time</th><th>ShiftTime-ShiftOutTime-First_half_dayout_time-Seconfd_half_dayin_time-lcfhc-lcshc</th><th>Dept AND Id </th></tr></thead><tfoot><tr><th></th><th></th><th></th><th>$lMin</th><th></th><th></th><th></th></tr></tfoot><tbody>".$lcondet."</tbody></table></div></div>";
		}
		$xdet=$totalAbsent + $absentlwp;
		$totalAbsent = $absentWI+$earlyGoing+$earlyBHGoing;

		$returnVal = array("newAbsDays" => $totalAbsent, "approvedlwp" => $absentlwp, "sqlCalCount" => $sqlCalCount, "lateComes" => $lateComes,"lMin"=>$lMin,"xdate"=>$xdet,"alldate_spclcasera"=>$alldate_spclcasera);
		return $returnVal;
	}

?>
