<?php
include("../include/conFig.php");
								
function humanTiming ($time)
{
	$time = time()-$time; // to get the time since that moment
    $time = ($time<1)? 1 : $time;
    $tokens = array (
        86400 => 'day'
    );
    foreach ($tokens as $unit => $text) {
       // if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }
}
//echo $hrmDOJp;


$strlnn= strlen($hrmDOJp);
if($strlnn>=19)
{
	$timestampa=$hrmDOJp;
}else{
	$timestampa=$hrmDOJp." 00:00:00";
}
//echo $timestampa;
//$timestampa="2014-01-25"." 00:00:00";
$time = strtotime($timestampa);
 $timr=humanTiming($time);
$timra=explode(" ",$timr);
$time_for_cal=$timra[0];
$years_completed=$time_for_cal/365;
$years_completed=intval($years_completed);
//$years_completed=intval($time_for_cal/365);
$no_of_slip_with=$years_completed*12;
$cdatee= DATE("Y-m-d");
	//echo $hrmDOJp;
	$date3=date_create("2014-09-01");
	$date4=date_create($hrmDOJp);
	$difff=date_diff($date4,$date3);
	$sdf=$difff->format("%R%a");
	//$aa=round($sdf/30);
	$addi_count=number_format($sdf/30);
	//val($addi_count);						
							

$employeesal = mysql_query("SELECT `PF`, `createdate` FROM `salaryslip` WHERE `employee`='$hrmloggedid' AND (`createdate` BETWEEN '$hrmDOJ' AND '$cdatee') ORDER BY `year` ASC, `month` ASC",$con);
//echo $hrmloggedid;
$employeepre = mysql_query("SELECT `id`, `eid`, `instalment`, `amount`, `checkno`, `createdate`, `modifieddate`, `modifiedby`, `status`, `extra` FROM `emp_pf_with` WHERE `eid`='$hrmloggedid'",$con);
$instalment=0;
$count=1;
$table="";
while($rowemployeepre = mysql_fetch_array($employeepre))
	{
		$status=$rowemployeepre["status"];
		if($status==0)
		{
			$instalment+=$rowemployeepre["instalment"];
			$stat_msg="<span style='color:blue'>Waiting</span>";
		}else if($status==1)
		{
			$instalment+=$rowemployeepre["instalment"];
			$stat_msg="<span style='color:green'>Approved</span>";
		}else if($status==2)
		{
			$instalment+=$rowemployeepre["instalment"];
			$stat_msg="<span style='color:green'>Waiting For check</span>";
		}else if($status==3)
		{
			
			$stat_msg="<span style='color:red'>Rejected</span>";
		}
		$instalments=$rowemployeepre["instalment"];
		$amount=$rowemployeepre["amount"];
		$checkno=$rowemployeepre["checkno"];
		$createdate=$rowemployeepre["createdate"];
		$modifieddate=$rowemployeepre["modifieddate"];
		$table.=<<<AAA
				<tr>
					<td>$count</td>
					<td>Rs. $amount</td>
					<td>$instalments</td>
					<td>$checkno</td>
					<td>$createdate</td>
					<td>$modifieddate</td>
					<td>$stat_msg</td>
				</tr>
AAA;
		$count++;
	}
$years_completed=$years_completed- $instalment;

$count=0;
$countq=1;

while($rowempsal = mysql_fetch_assoc($employeesal))
	{
		$abcd[]=$rowempsal;
	}
	//print_r($abcd);
	for($xi=1; $xi<=$addi_count; $xi++)
	{
		$abcd[]=Array ( "PF" => 500, "createdate" => "1111-11-11 11:11:11");
	}
	
	//array_push(,$xa);
	//print_r($abcd);
	foreach($abcd as $key=>$val)
	{
		$PF=$val["PF"];
		$PF_tot+=$val["PF"];
		if($countq%12==0)
		{
			//echo 1;
			$count++;
			
			${"no_val$count"}=$PF_tot;
		}
		$countq++;
	}
	//echo $count;
	/*
while($rowempsal = mysql_fetch_array($employeesal))
	{
		$PF=$rowempsal["PF"];
		$PF_tot+=$rowempsal["PF"];
		
		if($countq%12==0)
		{
			//echo 1;
			$count++;
			
			${"no_val$count"}=$PF_tot;
		}
		//print_r($rowempsal);
		/*
		$month=$rowempsal["month"];
		$PF_tot+=$rowempsal["PF"];
		echo $tab=<<<AAA
						<tr>
							<td>$countq</td>
							<td>$month</td>
							<td>Rs. $PF</td>
						</tr>
AAA;

//echo $countq;
		
		$countq++;


	}*/
	//echo $count; 
//$PF_tot*2;
//echo $no_val1*2;
?>

<head>
<style type="text/css">
.auto-style1 {
	text-align: right;
}
</style>
</head>

<div class="title">
	My PF
</div>
<div class="strip">
	<span>Dashboard</span> <span>Profile</span> <span>PF withdraw </span> </div>
<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td style="width: 30%"></td>
		<td align="right" style="width: 70%">
		<button class="button gray" onclick="getModule('profile/moodelview-pf','manipulatemoodleContent','viewmoodleContent','')">
		<i class="back"></i>Back</button>&nbsp;&nbsp; </td>
	</tr>
</table>
<div style="overflow-x: hidden; overflow-y: scroll; height: 500px">
	<div class="add-new blue-border">
		<div class="form-head blue">
			<div class="head-title">
				<i class="add-form"></i>Please Fill Details</div>
		</div>
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td style="height: 26px" width="175px">Name <span>*</span>
				</td>
				<td style="height: 26px">
				<input id="pfw0" class="input medium" name="req" type="text" value="<?=$hrmloggeduser?>" readonly />
				<input id="pfw1" class="input medium" name="req" type="hidden" value="<?=$hrmloggedid?>" readonly />
				</td>
				<td style="height: 26px" width="175px">Date Of Joining <span>*</span>
				</td>
				<td style="height: 26px">
				<input id="pfw2" class="input medium" name="req" type="text" value="<?=$hrmDOJp?>" readonly  />
				</td>
			</tr>
			<tr>
				<td>Tenure Period (In days)<span>*</span></td>
				<td>
				<input id="pfw3" checked="checked" class="input checkbox" name="req" type="text" value="<?=$timr?>" readonly />
				</td>
				
				<td>Details <span>*</span></td>
				<td>
					You are eligible to withdraw Balance of <?=$years_completed?> years
				</td>
				<td></td>
				<td>
				</td>
			</tr>
			<tr>
				<td>Installments You want to withdraw  <small>Please Select One <span>*</span></small></td>
				<td>
				
				<?php
						$whi="";				
				if($years_completed==0)
				{
						$whi="<span style='color:red'>Not Eligible</span>";				
				}
					for($i=$years_completed;$i>0;$i--)
					{
						//echo $i;
						$vaal=${"no_val$i"}*2;
						$whi.= <<<AAA
						<label style="margin-right: 30px;color:black;display: block;" class="button">
									<input type="radio"  name="ac" value="$vaal" onchange="var ax=document.getElementById('ass$i').value; document.getElementById('total_amount_cal').innerHTML=ax;$('#pf_with_key').show();$('#total_ins_cal').html($i);" id="ass$i" > $i
						</label>
AAA;
						$counter++;
					}
					echo $whi;
//				$years_completed;
//				$('#total_amount_cal').html(
				?> 
				
											
										

				</td>
				<td>Total Amount <span>*</span></td>
				<td>
					Rs. <span id="total_amount_cal">0</span>
					<span id="total_ins_cal" style="display:none">0</span>
				</td>
				<td></td>
				<td>
				</td>
			</tr>
			<tr>
			<td colspan="6" style="text-align: center">
				<button class="button green" onclick="SaveData('profile/moodelview-pf-save','pfw','4','','','5','3')" style="display: none" id="pf_with_key">Apply</button>
				
				
			</td>
			</tr>
		</table>
	</div>
	<br />
	<h1 style="text-align: center">Previous Requests</h1>
		<table cellpadding="1" cellspacing="0" width="100%" border="1" style="text-align: center">
			<tr>
				<th>No.</th>
				<th>Amount</th>
				<th>Instalments</th>
				<th>Check No</th>
				<th>Applied On</th>
				<th>Approved on</th>
				<th>Status</th>
			</tr>
			<tr>
				<?=$table?>
			</tr>
		</table>
</div>
