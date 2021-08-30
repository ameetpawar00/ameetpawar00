<?php
include("../include/conFig.php");
error_reporting(0);
$TodayM = date('m');
$Todayd = date('d');
$counter=$_GET["counter"];
$sql="SELECT * FROM employee WHERE `active` = '1' AND `empstatus` = '2' AND `delete` = '0'";
$getData = mysql_query($sql,$con) or die(mysql_error());
$count= mysql_num_rows($getData);
	$folder= 'dash/moodelview-bday';
	$title = 'Year Compilation';
?>
<div id="myTitle">
<div class="title">Year Completion</div>
<div class="strip">
<span>Dashboard</span>
<span>Year Completion</span>
<span>View</span>
</div>
</div>

<?php 


	
if($count>0)
{
?>
<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
</td>
</tr>
</table>
<div style="height:400px;overflow-x:hidden;overflow-y:scroll" id="mainDivId">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
	<th>Name</th>
	<th>Date</th>
<?php

$sql .=" order by employee.name  ASC";
$getData = mysql_query($sql,$con)or die(mysql_error());
while($rowemp = mysql_fetch_array($getData))
	{
		$doj=$rowemp["doj"];
				$dor = $rowemp["dor"];
				if($dor!="" && $dor!="0000-00-00")
				{
					$doj=$dor;
					
				}else{
				
				}
		$doj_split=explode("-",$doj);
		$doy=$doj_split[0];
		$dom=$doj_split[1];
		$dod=$doj_split[2];

		$cdate=date("Y-m-d");
		if(isset($_GET['nmnthyc']))
			{
			$cdate = date('Y-m-d', strtotime('+1 month'));
			}elseif(isset($_GET['nmntddssss2']))
			{
			$cdate = date('Y-m-d');
			}
		
		$cdate_split=explode("-",$cdate);	
		$cdatey=$cdate_split[0];
		$cdatem=$cdate_split[1];
		$cdated=$cdate_split[2];
		if(isset($_GET['nmnthyc']) OR isset($_GET['nmntddssss2']))
			{
				
			
//		if($dom==$cdatem)
		if($dom==$cdatem)
		{
			//print_r($rowemp);
			$n_of_year=$cdatey-$doy;
			$name=$rowemp["name"];
			$today=date('d-M-y');
			echo $aaa=<<<AAA
						
						<tr  class="" >
							<td title="Congrats"><strong><span style="color:black;background: white;">$name</span></strong></td>
							<td><strong><span style="color:black;background: white;">$n_of_year Years Completed On $doj</span></strong></td>
						</tr>
			
AAA;
		}}else{
		
		if($cdated==$dod AND $dom==$cdatem AND $cdatey!=$doy)
		{
			//print_r($rowemp);
			$n_of_year=$cdatey-$doy;
			$name=$rowemp["name"];
			$today=date('d-M-y');
			echo $aaa=<<<AAA
						
						<tr  class="" >
							<td title="Congrats"><strong><span style="color:black;background: white;">$name</span></strong></td>
							<td><strong><span style="color:black;background: white;">$n_of_year Years Completed On $today</span></strong></td>
						</tr>
			
AAA;
		}
		
		
		}	
	}
 }
 else {
		echo '<div align=center style=color:green;font-size:20px;>No Year Complitions Today</div>';
}
?>
</table>
<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>
<?php 
if($count>0){
?>
<img src="images/yearcom.jpg" style=" position: absolute;top: 25%;width: 600px;left: 10%;opacity: 0.4; z-index: -1;">
</tr>
</table>
<?php } ?>
<div style="">
</div>
