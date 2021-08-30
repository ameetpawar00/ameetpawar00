<?php
include("../../include/conFig.php");
$sel_type=$_GET["sel_type"];




if($sel_type=="f_emp"){
$var_type=$_GET["var_type"];
		
			$sqlselk=" AND `$var_type`='1'";
		if($var_type=="ALL")
		{
			$sqlselk="";
		}
	$getDs = mysql_query("SELECT `id`,`name` FROM employee WHERE `delete`='0' AND `active`='1' AND `empstatus`='2'$sqlselk ORDER BY `name` ASC",$con)or die(mysql_error());
	if(mysql_num_rows($getDs) > 0){
		$i = 1;
		$res = "	<option value='0'>Select Employee</option>	<option value='ALL'>ALL</option>";
		while($rowDa = mysql_fetch_assoc($getDs)){
			$empid=$rowDa["id"];
			$empname=$rowDa["name"];
			
			$res.=<<<AAA
							<option value="$empid">$empname</option>
AAA;
		}
		echo $res;
	}
	
}else if($sel_type=="t_emp"){
	
//	print_r($_GET);
	$emp_type=$_GET["emp_type"];
	$year=$_GET["year"];
	$month=$_GET["month"];
	$var_type=$_GET["var_type"];
 
 $selvall=" AND `salaryslip`.`employee`='$emp_type'";
 	if($emp_type=="ALL")
 	{
 		
 		$sqlselk=" AND `$var_type`='1'";
		if($var_type=="ALL")
		{
			$sqlselk="";
		}
		$getDas = mysql_query("SELECT `id`,`name` FROM employee WHERE `delete`='0' AND `active`='1' AND `empstatus`='2'$sqlselk ORDER BY `name` ASC",$con)or die(mysql_error());
		
		$empid="";
		$empname=array();
		while($rowDasa = mysql_fetch_assoc($getDas)){
		//print_r($rowDasa);
		
			$empida=$rowDasa['id'];
			$empid.=$empida.",";
			$empname[$empida]=$rowDasa['name'];
		}
		 $empid=rtrim($empid,",");
		 $selvall=" AND `salaryslip`.`employee` IN ($empid)";
	}
 
// print_r($empname);
	$sqldel="SELECT `salaryslip`.`id`,`salaryslip`.`employee`, `salaryslip`.`basic`, `salaryslip`.`PF`, `salaryslip`.`slip`, `salaryslip`.`TDS`, `salaryslip`.`TMODE`, `salaryslip_extra`.`pfcamount`, `salaryslip_extra`.`pt`, `salaryslip_extra`.`esice`, `salaryslip_extra`.`esicc`, `salaryslip_extra`.`esice_amount`, `salaryslip_extra`.`esicc_amount` FROM `salaryslip`,`salaryslip_extra` WHERE `salaryslip`.`id`=`salaryslip_extra`.`sid` AND `salaryslip`.`month`='$month' AND `salaryslip`.`year`='$year' AND `salaryslip`.`delete`='0'$selvall";	
	$getD = mysql_query($sqldel,$con)or die(mysql_error());
	if(mysql_num_rows($getD) > 0){
		$i = 0;
		
		if(isset($_GET["excl"]))
			{	

		$ressda=<<<AAA
							<html>					
							<head>
							<title>Excel Salary Download </title>					
							</head>					
							<body>					
							<table>	
AAA;

		$name = "Excel_Salary_deduction_Download_For_m_$month"."_y_$year.xls";
		header("Content-Disposition: attachment; filename=\"$name\"");
		header("Content-Type: application/vnd.ms-excel");
		
			}else{
				$ressda="";
			}
				$ressd="";
		$empnameshead="";
		if($emp_type=="ALL")
			{
				$empnameshead="<th>Name</th>";
			}
			
		if($var_type=="ALL")
			{
				$ressd= "$ressda<tr>$empnameshead<th>PF User</th><th>PF Company</th><th>TDS</th><th>PT</th><th>ESIC User</th><th>ESIC User %</th><th>ESIC Company</th><th>ESIC Company %</th></tr>";
				
			}elseif($var_type=="PF")
			{
				$ressd= "$ressda$empnameshead<th>PF User</th><th>PF Company</th>";
				
			}elseif($var_type=="TDS")
			{
				$ressd= "$ressda$empnameshead<th>TDS</th>";	
								
			}elseif($var_type=="PT")
			{

				$ressd= "$ressda$empnameshead<th>PT</th>";
				
			}elseif($var_type=="ESIC")
			{
				$ressd= "$ressda$empnameshead<th>ESIC User</th><th>ESIC User %</th><th>ESIC Company</th><th>ESIC Company %</th>";				
				
			}
		while($rowD = mysql_fetch_assoc($getD)){
//			print_r($rowD);
			$id=$rowD["id"];
			$employee=$rowD["employee"];
			$basic=$rowD["basic"];
			$PF=$rowD["PF"];
			$slip=$rowD["slip"];
			$TDS=$rowD["TDS"];
			$TMODE=$rowD["TMODE"];
			$pfcamount=$rowD["pfcamount"];
			$pt=$rowD["pt"];
			$esice=$rowD["esice"];
			$esicc=$rowD["esicc"];
			$esice_amount=$rowD["esice_amount"];
			$esicc_amount=$rowD["esicc_amount"];
			$empnames="";
			if($emp_type=="ALL")
			{
				$empnames="<td>".$empname[$employee]."</td>";
			}
			if($var_type=="ALL")
			{
				 $res= "<td>$PF</td><td> $pfcamount</td><td>$TDS</td><td>$pt</td><td>$esice_amount</td><td>$esice%</td><td>$esicc_amount</td><td> $esicc%</td>";
				
			}elseif($var_type=="PF")
			{
				$res= "<td>$PF</td><td>$pfcamount</td>";
				
			}elseif($var_type=="TDS")
			{
				$res= "<td>$TDS</td>";	
								
			}elseif($var_type=="PT")
			{

				$res= "<td>$pt</td>";
				
			}elseif($var_type=="ESIC")
			{
				$res= "<td>$esice_amount</td><td>$esice%</td><td>$esicc_amount</td><td> $esicc%</td>";				
				
			}
			
			$ressd.=<<<AAA
					<tr>
						$empnames											
						$res				
					</tr>										
AAA;
			/*
			$empid=$rowD["id"];
			$empname=$rowD["name"];
			
			$res.=<<<AAA
							<option value="$empid">$empname</option>
AAA;
*/
$i++;
		}
				$ressd.=<<<AAA
						</table>	
						</body>					
					</html>					
AAA;
	
		echo $ressd;
	}
	
	
}

?> 
<!--<textarea>
	<?=$ressd?>
</textarea>
-->