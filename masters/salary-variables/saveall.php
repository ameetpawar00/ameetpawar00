<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
//$valto = "2@*@*@5200@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$4@*@*@4900@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$5@*@*@12500@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$6@*@*@4200@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$15@*@*@10500@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$18@*@*@4500@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$3@*@*@6800@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$7@*@*@5800@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$8@*@*@5800@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$10@*@*@9300@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$11@*@*@9500@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$12@*@*@6200@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$13@*@*@4600@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$14@*@*@3200@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$16@*@*@5200@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$17@*@*@5200@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$19@*@*@4000@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$20@*@*@6800@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$21@*@*@4200@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$22@*@*@9200@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$23@*@*@6800@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$24@*@*@12500@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$25@*@*@13500@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$26@*@*@8500@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$27@*@*@10500@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$28@*@*@6200@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$29@*@*@7200@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$30@*@*@6200@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$31@*@*@14200@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$32@*@*@16500@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$33@*@*@11300@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$34@*@*@15000@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$35@*@*@8500@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$36@*@*@11400@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$37@*@*@14200@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$38@*@*@7000@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$39@*@*@15600@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$40@*@*@9200@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$41@*@*@13500@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$42@*@*@11400@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$43@*@*@16200@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$44@*@*@9500@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$45@*@*@17800@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$46@*@*@19800@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$47@*@*@10800@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$48@*@*@16200@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$49@*@*@58000@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$50@*@*@9300@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$51@*@*@15200@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$52@*@*@18600@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$53@*@*@15200@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$54@*@*@7000@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$55@*@*@11300@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$56@*@*@11800@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$57@*@*@18600@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$58@*@*@5000@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$59@*@*@35500@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$60@*@*@18800@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$61@*@*@21750@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$62@*@*@18750@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$63@*@*@12750@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$64@*@*@5000@*@*@12@*@*@13.36@*@*@1.75@*@*@4.75@*@*@208$@$@$*$*$*pf*$*$*1*$*$*2";
$valtoext = explode("*$*$*",$valto);
$prev_whole_data=$valtoext[0];
$type=$valtoext[1];
$val1=$valtoext[2];



if($type!="pt")
{
	$val2=$valtoext[3];
	
	$prev_data = explode("$@$@$",$prev_whole_data);
	foreach($prev_data as $prev_data_val)
	{
		//echo $prev_data_val."<br>";
		$prev_data_c = explode("@*@*@",$prev_data_val);
		$spid=$prev_data_c[0];
		$basic=$prev_data_c[1];
		$pfe=$prev_data_c[2];
		$pfc=$prev_data_c[3];
		if($type=="pf")
		{
			$pfe=$val1;
			$pfc=$val2;
		}
		$esice=$prev_data_c[4];
		$esicc=$prev_data_c[5];
		if($type=="esic")
		{
			$esice=$val1;
			$esicc=$val2;
		}
		
		$pt=$prev_data_c[6];
		
		$pfeamount=($basic*$pfe)/100;
		$pfcamount=($basic*$pfc)/100;
		
		mysql_query("UPDATE `salary_variables` SET `status`='1' WHERE `spid`='$spid'",$con) or die(mysql_error());
		mysql_query("INSERT INTO `salary_variables`(`spid`, `pfe`, `pfc`, `esice`, `esicc`, `pt`, `updatedate`, `updatedby`,`status`,`pfeamount`,`pfcamount`) VALUES ('$spid','$pfe','$pfc','$esice','$esicc','$pt','$datetime','$hrmloggedid','0','$pfeamount','$pfcamount')",$con) or die(mysql_error());
		mysql_query("UPDATE `salary` SET `PF`='$pfeamount', `pfcamount`='$pfcamount', `esice`='$esice', `esicc`='$esicc', `pt`='$pt' WHERE `id`='$spid'",$con) or die(mysql_error());
	}
	
	
	
	
}else{
	
	
		$prev_data = explode("$@$@$",$prev_whole_data);
	foreach($prev_data as $prev_data_val)
	{
		//echo $prev_data_val."<br>";
		$prev_data_c = explode("@*@*@",$prev_data_val);
		$spid=$prev_data_c[0];
		$basic=$prev_data_c[1];
		$pfe=$prev_data_c[2];
		$pfc=$prev_data_c[3];
		$esice=$prev_data_c[4];
		$esicc=$prev_data_c[5];
		$pt=$val1;
		
		$pfeamount=($basic*$pfe)/100;
		$pfcamount=($basic*$pfc)/100;
		
		mysql_query("UPDATE `salary_variables` SET `status`='1' WHERE `spid`='$spid'",$con) or die(mysql_error());
		mysql_query("INSERT INTO `salary_variables`(`spid`, `pfe`, `pfc`, `esice`, `esicc`, `pt`, `updatedate`, `updatedby`,`status`,`pfeamount`,`pfcamount`) VALUES ('$spid','$pfe','$pfc','$esice','$esicc','$pt','$datetime','$hrmloggedid','0','$pfeamount','$pfcamount')",$con) or die(mysql_error());
		mysql_query("UPDATE `salary` SET `PF`='$pfeamount', `pfcamount`='$pfcamount', `esice`='$esice', `esicc`='$esicc', `pt`='$pt' WHERE `id`='$spid' AND `delete`='0'",$con) or die(mysql_error());
	}

}

?>




