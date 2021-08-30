<?php
error_reporting(0);
/*
include("../include/connection.php");
require_once 'Excel/reader.php';

$name ='';
$pass= '';
    $data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('CP1251');


$data->read('test1.xls');/////Pass Excel File Name

$data->sheets[0]['numRows'];

$j = 0;
$idj = 0;
$d = 0;
$ddj = 0;
for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++)
{

$empNo = $data->sheets[0]['cells'][$i][1]; 
$name = $data->sheets[0]['cells'][$i][2];
$caddress = $data->sheets[0]['cells'][$i][3];
  $paddress = $data->sheets[0]['cells'][$i][4];
 $mno = $data->sheets[0]['cells'][$i][5];
  $rno = $data->sheets[0]['cells'][$i][6];
	   $doj = $data->sheets[0]['cells'][$i][7];
	   $phpexcepDate = $doj-25569; //to offset to Unix epoch
	  $doj = strtotime("+$phpexcepDate days", mktime(0,0,0,1,1,1970));
	  $doj = date('Y-m-d',$doj);
  
		$dob = $data->sheets[0]['cells'][$i][8];
	   $phpexcepDate = $dob-25569; //to offset to Unix epoch
	  $dob= strtotime("+$phpexcepDate days", mktime(0,0,0,1,1,1970));
	  $dob = date('Y-m-d',$dob);
  	//$dob = date(('d m Y'),strtotime($dob));
    $city = $data->sheets[0]['cells'][$i][9];
    $getcity = mysql_query("SELECT `name`,`id`  FROM `city` WHERE `name`='$city'",$con) or die(mysql_error());
    if(mysql_num_rows($getcity) <= 0)
    {
    	//echo "INSERT INTO `city`(`name`, `state`, `createdate`, `modifieddate`, `updatedby`, `description`) VALUES ('$city','','$datetime','$datetime','1','Insert by Excel sheet')";
   		mysql_query("INSERT INTO `city`(`name`, `state`, `createdate`, `modifieddate`, `updatedby`, `description`) VALUES ('$city','','$datetime','$datetime','1','Insert by Excel sheet')",$con) or die(mysql_error());
   		$cityid = mysql_insert_id();

   	 }
    else
    {
    	$rowc = mysql_fetch_array($getcity);
    	$cityid = $rowc[1];
    }
    $branch = $data->sheets[0]['cells'][$i][10];
    $getbranch = mysql_query("SELECT `name`,`id`  FROM `branch` WHERE `name`='$branch'",$con) or die(mysql_error());
    if(mysql_num_rows($getbranch) <= 0)
    {
    	//echo "INSERT INTO `branch`(`id`, `name`, `description`, `createdate`, `modifieddate`, `updatedby`, `delete`) VALUES ('','$branch','Insert by Excel sheet','$datetime','$datetime','1','')";
   		mysql_query("INSERT INTO `branch`(`id`, `name`, `description`, `createdate`, `modifieddate`, `updatedby`, `delete`) VALUES ('','$branch','Insert by Excel sheet','$datetime','$datetime','1','')",$con) or die(mysql_error());
   		$branchid = mysql_insert_id();
   	 }
    else
    {
    	$rowb = mysql_fetch_array($getbranch);
    	$branchid = $rowb[1];
    }
    $email = $data->sheets[0]['cells'][$i][11];
    $desig = $data->sheets[0]['cells'][$i][12];
    
    $getdesig = mysql_query("SELECT `name`,`id`  FROM `designation` WHERE `name`='$desig'",$con) or die(mysql_error());
    if(mysql_num_rows($getdesig) <= 0)
    {
    	//echo "INSERT INTO `designation`(`id`, `name`, `description`, `createdate`, `modifieddate`, `updatedby`, `delete`) VALUES ('','$desig','Insert by Excel sheet','$datetime','$datetime','1','')";
   		mysql_query("INSERT INTO `designation`(`id`, `name`, `description`, `createdate`, `modifieddate`, `updatedby`, `delete`) VALUES ('','$desig','Insert by Excel sheet','$datetime','$datetime','1','')",$con) or die(mysql_error());
   		$desigid = mysql_insert_id();
   	 }
    else
    {
    	$rowdes = mysql_fetch_array($getdesig);
    	$desigid = $rowdes[1];
    }

    
    $depart = $data->sheets[0]['cells'][$i][13];
    $getdep = mysql_query("SELECT `name`,`id`  FROM `department` WHERE `name`='$depart'",$con) or die(mysql_error());
    if(mysql_num_rows($getdep) <= 0)
    {
    	//echo "INSERT INTO `department`(`id`, `name`, `description`, `createdate`, `modifieddate`, `updatedby`, `delete`) VALUES ('','$depart','Insert by Excel sheet','$datetime','$datetime','1','')";
   		mysql_query("INSERT INTO `department`(`id`, `name`, `description`, `createdate`, `modifieddate`, `updatedby`, `delete`) VALUES ('','$depart','Insert by Excel sheet','$datetime','$datetime','1','')",$con) or die(mysql_error());
   		$depid = mysql_insert_id();
   	 }
    else
    {
    	$rowdes = mysql_fetch_array($getdep);
    	$depid= $rowdes[1];
    }


  $salary = $data->sheets[0]['cells'][$i][14];
  $pemail = $data->sheets[0]['cells'][$i][17];
  $panno = $data->sheets[0]['cells'][$i][22];
  $bgrp = $data->sheets[0]['cells'][$i][23];
 //echo "INSERT INTO `employee`(`empid`,`name`, `mobile`, `phone`, `email`, `workemail`, `department`, `designation`,  `branch`, `doj`, `dob`,`address`, `city`,`PAN_NO`,`blood_group`) VALUES ('$empNo','$name','$mno','$rno','$pemail','$email','$depid','$desigid','$branchid','$doj','$dob','$paddress','$cityid','$panno','$bgrp')";
 mysql_query("INSERT INTO `employee`(`empid`,`name`, `mobile`, `phone`, `email`, `workemail`, `department`, `designation`,  `branch`, `doj`, `dob`,`address`, `city`,`PAN_NO`,`blood_group`,`state`, `createdate`, `updatedate`, `updatedby`,`active`,`username`,`password`,`empstatus`) VALUES ('$empNo','$name','$mno','$rno','$pemail','$email','$depid','$desigid','$branchid','$doj','$dob','$paddress','$cityid','$panno','$bgrp','19','$datetime','$datetime','1','1','$email','$mno','1')",$con) or die(mysql_error());
 	$empid = mysql_insert_id();
echo $empid.'<br/>';
echo $i.'<br/>';
	mysql_query("INSERT INTO `salary`(`eid`, `gross`, `createdate`, `updatedate`, `updatedby`, `delete`) VALUES ('$empid','$salary','$datetime','$datetime','1','')",$con) or die(mysql_error());
//die();
}
*/

?>