<?php
	require_once '../include/conFig.php';
	function like_match($pattern, $subject)
	{
		$pattern = str_replace('%', '.*', preg_quote($pattern, '/'));
		return (bool) preg_match("/^{$pattern}$/i", $subject);
	}

	if (isset($_POST['uploadSheet']))
	{
		$year = $_POST['syear'];
		$month = $_POST['month'];
		$name = $_FILES['datasheet']['name'];
		$chkExt = end(explode('.', $name));
		$h = 0;
		if ($chkExt == 'csv')
		{
			$rand = rand(1000, 100000);
			$target = "files/" . $rand . $name;
			move_uploaded_file($_FILES['datasheet']['tmp_name'], $target);
			$file = fopen($target, "r");
			$emp = '';
			$j = 0;
			while (!feof($file))
			{
				$row = fgetcsv($file);
				foreach($row as $rowa)
				{
					$rowRead[$j].=$rowa."***";
				}

				$j++;
			}
			if(like_match('%Emp Code***Emp Name******%',$rowRead[9]))
			{
				$temp_ary=explode("***", $rowRead[10]);
			}else{
				$temp_ary=explode("***", $rowRead[9]);
			}

			$temp_ary = array_filter($temp_ary);
			$temp_ary = array_values($temp_ary);
			$a_count=0;
			foreach ($rowRead as $rowReada => $values) {
				$temp_values=explode("***",$values);
				if (($temp_values[0] != "" AND $temp_values[1] == "" AND $temp_values[2] != "") OR ($temp_values[0] == "" AND $temp_values[1] != "" AND $temp_values    [2] == "")) {
					print_r($temp_values);
					if($temp_values[0]=="")
					{
						$a_uid=$temp_values[1];
						$a_name=$temp_values[3];
						for($i=5;$i<36;$i++)
						{
							$temp_array1[$a_uid].=$temp_values[$i].",";
						}

					}else{
						$a_uid=$temp_values[0];
						$a_name=$temp_values[2];
						for($i=5;$i<36;$i++)
						{
							$temp_array1[$a_uid].=$temp_values[$i-1].",";
						}
					}

				}

				$a_count++;
			}
			$u_count=0;
			foreach($temp_array1 as $temp_array12=>$temp_array12_val)
			{
				$attendence_id=trim($temp_array12," ");

				$empSql = "SELECT `id` FROM `employee` where `delete` = '0' and `attenid` = '$attendence_id'";
				$getEmp = mysql_query($empSql, $con) or die(mysql_error());
				$rowEmp = mysql_fetch_array($getEmp);
				$emp = $rowEmp[0];

				$temp_array12_vala=explode(",",$temp_array12_val);

				foreach($temp_ary as $temp_arya)
				{
					$punch_date = $year."-".$month."-".$temp_arya;
					$time=explode("\n",$temp_array12_vala[$temp_arya-1]);
					$punchin_time=$time[0];
					$punchout_time=$time[1];
					$attend="";
					switch ($punchin_time)
					{
						case "A":
							$attend = '2';
							break;
						case "WO-I":
							$attend = '3';
							break;
						case "HLF":
							$attend = '4';
							break;
						default:
							$attend = '1';
					}
					if($emp!="")
					{
						$u_count++;
						mysql_query("DELETE FROM `attendance` where `employee` = '$emp' and `date` = '$punch_date'",$con) or die(mysql_error());

						mysql_query("INSERT INTO `attendance`(`employee`, `date`, `createdate`,`checkin`, `checkout`,`month`,`attendance`) VALUES ('$emp','$punch_date','$datetime','$punchin_time','$punchout_time','','$attend')",$con) or die(mysql_error());
					}
				}
			}
			echo "<script>window.parent.document.getElementById('loading').style.display = 'none';alert('Attendence Uploaded Sucessfully. . !');</script>";
		}
		else
		{
			echo "<script>window.parent.document.getElementById('loading').style.display = 'none';alert('Check File Format it has to be in .CSV!!!');</script>";
		}


	}

?>
