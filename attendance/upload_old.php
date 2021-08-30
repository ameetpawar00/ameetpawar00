<?php
require_once('../include/conFig.php');
require_once ('../Excel/reader.php');
//ini_set('display_errors', 1);

if(isset($_POST['uploadSheet']))
{
$branchdata = $_POST['branchdata'];
$name = $_FILES['datasheet']['name'];
$chkExt = end(explode('.',$name));
	if($chkExt == 'xls'  )
		{
		$rand = rand(1000,100000);
		$target = "files/".$rand.$name;
		move_uploaded_file($_FILES['datasheet']['tmp_name'],$target);
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('CP1251');
		$data->read($target);/////Pass Excel File Name
		$data->sheets[0]['numRows'];
			for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++)
			{
	  	    $empcode = stripcslashes(trim($data->sheets[0]['cells'][$i][1]));
			$sdate = stripcslashes(trim($data->sheets[0]['cells'][$i][2]));
			$sdate=explode('/',$sdate);
			$adate = $sdate[2]."-".$sdate[1]."-".$sdate[0];
			$adate = date('Y-m-d',strtotime($adate));
	  		$in= stripcslashes(trim($data->sheets[0]['cells'][$i][5]));
	  		if($in == "")
	  		{
	  		$in = "00:00:00";
	  		}
	  		else
	  		{
	  		$in = $in;
	  		}
	  		$out = stripcslashes(trim($data->sheets[0]['cells'][$i][6]));
  			if($out == "")
	  		{
	  		$out = "00:00:00";
	  		}
	  		else
	  		{
	  		$out = $out;
	  		}
	  		$checkIn = $adate." ".$in.":00";
	  		$checkOut = $adate." ".$out.":00";
	  		$hourWork = stripcslashes(trim($data->sheets[0]['cells'][$i][9]));
	  		$overTime = stripcslashes(trim($data->sheets[0]['cells'][$i][10]));
	  		$status = stripcslashes(trim($data->sheets[0]['cells'][$i][11])); 
	  	
		  		if($status == "P")
		  		{
		  			$attend = '1';
		  		}
		  		else if($status == "A")
		  		{
		  			$attend = '0';
		  		}
		  		else if($status == "WO")
		  		{
		  			$attend = '3';
		  		}
		  		else if($status == "HLF")
		  		{
		  			$attend = '5';
		  		}
		  		else if($status == "MIS")
		  		{
		  			$attend = '1';
		  		}
			$empSql = "SELECT `id` FROM `employee` where `delete` = '0' and `empid` = '$empcode'";
			$getEmp = mysql_query($empSql,$con) or die(mysql_error());
			$rowEmp= mysql_fetch_array($getEmp);
			$emp = $rowEmp[0];
			mysql_query("DELETE FROM `attendance` where `employee` = '$emp' and `date` = '$adate'",$con) or die(mysql_error());
			echo $insertSql = "INSERT INTO `attendance` (`employee`, `date`, `createdate`, `attendance`, `checkin`, `checkout`, `hourworked`, `overtime`, `status`) VALUES('$emp', '$adate', '$datetime', '$attend', '$checkIn','$checkOut', '$hourWork', '$overTime', '$status')";
			echo "<br/>";
			mysql_query($insertSql,$con)or die(mysql_error());
			$output = "Attendance Success Fully Uploaded";
	  		}
		}
		else
		{
		$output = "Please Select A Valid File";
		}
	}
?>
 <script type="text/javascript">
      window.parent.document.getElementById('couResp').innerHTML='<?php echo $output;?>';
</script>
