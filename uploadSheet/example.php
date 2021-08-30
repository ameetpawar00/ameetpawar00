<?php

error_reporting(0);
//include('../include/connection.php');
require_once 'Excel/excel_reader2.php';
$data = new Spreadsheet_Excel_Reader("EmployeeSheet.xls");
?>
<html>
<head>
</head>

<body>
<?php 

$eids = array();
$name = array();
$uids = array();
$depart = array();
$desig = array();
$grade = array();
$salaryProfile = array();
for($p = 0 ;$p <= 2; $p++)
{
	for ($i = 2; $i <= $data->sheets[$p]['numRows']; $i++)
	{
		if($data->sheets[0]['cells'][$i][1] != '' || $data->sheets[0]['cells'][$i][1] == "E-ID")
		{
			$eids[] = $data->sheets[0]['cells'][$i][1];
			$name[] = $data->sheets[0]['cells'][$i][2];
			$uids[] = $data->sheets[0]['cells'][$i][3];
			$depart[] = trim($data->sheets[0]['cells'][$i][4]);
			$desig[] = trim($data->sheets[0]['cells'][$i][5]).trim($data->sheets[0]['cells'][$i][6]);
			//$grade[] = ;
			$salaryProfile[] = trim($data->sheets[0]['cells'][$i][7]);
		}
	}
	
}
foreach($eids as $key => $val)
{
	 echo '<table border="1px"><tr><td>'.$eids[$key].'</td><td>'.$name[$key].'</td><td>'.$uids[$key].'</td><td>'.$depart[$key].'</td><td>'.$desig[$key].'</td><td>'.$salaryProfile[$key].'</td></tr></table>';
	/**GETING DEPARTMENT ID**/
	$getdepart = mysql_query("SELECT `id` FROM `department` WHERE `name` LIKE '%$depart[$key]%'",$con) or die(mysql_error()); 
	if(mysql_num_rows($getdepart) > 0)
	{
	$rowdepart = mysql_fetch_array($getdepart);
	$departid = $rowdepart[0];
	}
	else
	{
	mysql_query("INSERT INTO `department`(`name`, `description`, `createdate`, `modifieddate`, `updatedby`) VALUES ('$depart[$key]','Upload By Excel','$datetime','$datetime','1')",$con) or die(mysql_error()); 
	$departid = mysql_insert_id();
	}
	/**--end--**/
	
	/**GETING DESIGNATION ID**/
	$getdesig = mysql_query("SELECT `id` FROM `designation` WHERE `name` LIKE '%$desig[$key]%'",$con) or die(mysql_error()); 
	if(mysql_num_rows($getdesig) > 0)
	{
	$rowdesig = mysql_fetch_array($getdesig);
	$desigid = $rowdesig[0];
	}
	else
	{
	mysql_query("INSERT INTO `designation`(`name`, `description`, `createdate`, `modifieddate`, `updatedby`) VALUES ('$desig[$key]','Upload By Excel','$datetime','$datetime','1')",$con) or die(mysql_error()); 
	$desigid = mysql_insert_id();
	}
	/**--end--**/
	
	/**GETING Salary Profile ID**/
	$getsalary = mysql_query("SELECT `id` FROM `salary` WHERE `salprofile` LIKE '%$salaryProfile[$key]%'",$con) or die(mysql_error()); 
	if(mysql_num_rows($getsalary) > 0)
	{
	$rowsalary = mysql_fetch_array($getsalary);
	$salryid = $rowsalary[0];
	}
	else
	{
	echo 'Salary Profile Does Not Match'.$salaryProfile[$key];
	}
	/**--end--**/
	
		/**INSERTING EMPLOYEE **/
		if($salryid != '')
		{
		mysql_query("INSERT INTO `employee`(`name`,`username`, `password`,`empid`, `empstatus`, `department`, `designation`, `salaryId`, `createdate`, `updatedate`, `updatedby`, `active`, `attenid`) VALUES ('$name[$key]','$name[$key]','trifid','$eids[$key]','1','$departid','$desigid','$salryid ','$datetime','$datetime','1','1','$uids[$key]')",$con) or die(mysql_error()); 
		}
		/**--end--**/

}

?>
</body>
</html>
