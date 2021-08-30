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
//$hrmDOJl="2010-01-25";
//$timestampa=$hrmDOJ." 00:00:00";
$fedt=mysql_query("SELECT * FROM `emp_ltb_with_extra` WHERE `eid`='$hrmloggedid'",$con) or die(mysql_error());
$checknos=mysql_num_rows($fedt);
$fedtrow=mysql_fetch_array($fedt);
	if($checknos>0)
		{
			$hrmDOJl=$fedtrow["date"];
			$timestampa=$hrmDOJl;
		}else{
				$hrmDOJl=$hrmDOJl;
				
				$timestampa=$hrmDOJl." 00:00:00";
			}
//$timestampa="2010-01-25"." 00:00:00";
//echo $hrmDOJl;
$time = strtotime($timestampa);
$timr=humanTiming($time);
$timra=explode(" ",$timr);
$time_for_cal=$timra[0];
$years_completed=$time_for_cal/548;


$years_completed=intval($years_completed);
//$years_completed=intval($time_for_cal/365);
$no_of_slip_with=$years_completed*18;
$cdatee= DATE("Y-m-d");
$employeesal = mysql_query("SELECT * FROM `salaryslip` WHERE `employee`='$hrmloggedid' AND (createdate BETWEEN '$hrmDOJ' AND '$cdatee') ORDER BY `year` ASC, `month` ASC LIMIT $no_of_slip_with",$con);
$employeepre = mysql_query("SELECT `id`, `eid`, `instalment`, `amount`, `checkno`, `createdate`, `modifieddate`, `modifiedby`, `status`, `extra` FROM `emp_ltb_with` WHERE `eid`='$hrmloggedid' AND `extrastatus`='0'",$con);
$instalment=0;
$count=1;
$table="";
while($rowemployeepre = mysql_fetch_array($employeepre))
	{
		$status=$rowemployeepre["status"];
		
		if($status==0)
		{
			$instalment=$rowemployeepre["instalment"];
			$stat_msg="<span style='color:blue'>Waiting</span>";
		}else if($status==1)
		{
			$instalment=$rowemployeepre["instalment"];
			$stat_msg="<span style='color:green'>Approved</span>";
		}else if($status==3)
		{
			$stat_msg="<span style='color:red'>Rejected</span>";
		}else{
			$instalment=$rowemployeepre["instalment"];
			$stat_msg="<span style='color:blue'>Waiting for check</span>";
		}
		$instalments=$rowemployeepre["instalment"];
		$amount=$rowemployeepre["amount"];
		$checkno=$rowemployeepre["checkno"];
		$createdate=$rowemployeepre["createdate"];
		$modifieddate=$rowemployeepre["modifieddate"];
		$desc=$rowemployeepre["extra"];
		$table.=<<<AAA
				<tr>
					<td>$count</td>
					<td>Rs. $amount</td>
					<td>$instalments</td>
					<td>$checkno</td>
					<td>$createdate</td>
					<td>$modifieddate</td>
					<td>$stat_msg</td>
					<td>$desc</td>
				</tr>
AAA;
		$count++;
	}
//$years_completed=$years_completed- $instalment;

$count=0;
$countq=1;
while($rowempsal = mysql_fetch_array($employeesal))
	{
		$LTB=2000;
		$LTB_tot+=2000;
		
		if($countq%12==0)
		{
			//echo 1;
			$count++;
			
			${"no_val$count"}=$LTB_tot;
		}
		//print_r($rowempsal);
		/*
		$month=$rowempsal["month"];
		$LTB_tot+=$rowempsal["PF"];
		echo $tab=<<<AAA
						<tr>
							<td>$countq</td>
							<td>$month</td>
							<td>Rs. $LTB</td>
						</tr>
AAA;
*/

		
		$countq++;


	}
//$LTB_tot*2;
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
	My LTB
</div>
<div class="strip">
	<span>Dashboard</span> <span>Profile</span> <span>LTB withdraw </span> </div>
<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td style="width: 30%"></td>
		<td align="right" style="width: 70%">
		<button class="button gray" onclick="getModule('profile/moodelview-ltb','manipulatemoodleContent','viewmoodleContent','')">
		<i class="back"></i>Back</button>&nbsp;&nbsp; </td>
	</tr>
</table>
<div style="overflow-x: hidden; overflow-y: scroll; height: 350px">
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
				<td style="height: 26px" width="175px">Date From  <span>*</span>
				</td>
				<td style="height: 26px">
				<input id="pfw2" class="input medium" name="req" type="text" value="<?=$hrmDOJl?>" readonly  />
				</td>
			</tr>
			<tr>
				<td>Tenure Period (In days)<span>*</span></td>
				<td>
				<input id="pfw3" checked="checked" class="input checkbox" name="req" type="text" value="<?=$timr?>" readonly />
				</td>
				
				<td>Details <span>*</span></td>
				<td>
					You are eligible to withdraw Balance of <?=$years_completed?> CYCLE (1.5 Years in one cycle)
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
						if($i<4)
						{
						//echo $i;
						$vaal=${"no_val$i"}*2;
						/*if($years_completed==1)
						{
							$vaal=$vaal/2;
						}else if($years_completed==2)
								{
									$vaal=$vaal/2;
								}else if($years_completed==3)
										{
											$vaal=$vaal/2;
										}*/
						$ck="";					
						$ckv=0;					
						if($instalment>=$i)
						{
							$ck="disabled";
							$ckv=1;
						}
						$whi.= <<<AAA
						<label style="margin-right: 0px;color:black;" class="button">
									 <input type="radio" style="margin: 0;padding: 0;" name="ac" value="$vaal" onchange="ltb_check($years_completed,$i)" id="ass$i" $ck> $i
									 <input type="hidden" style="margin: 0;padding: 0;" name="" value="$ckv"  id="valckp$i" > 
						</label>
AAA;
						$counter++;
						}
					}
					echo $whi;
					
//				$years_completed;
//				$('#total_amount_cal').html(
				?> 
							

				</td>
				<td>Total Amount <span>*</span></td>
				<td>
					Rs. <span id="total_amount_cal">0</span>
					<span id="total_ins_cal" style="display:none"></span>
				</td>
				<td></td>
				<td>
				</td>
			</tr>
			<tr>
			<td colspan="6" style="text-align: center">
			<span id="total_amount_insv"  style="display:none"></span>
				<button class="button green" onclick="SaveData('profile/moodelview-ltb-save','pfw','4','','','5','4')" style="display: none" id="pf_with_key">Apply</button>
				
				
			</td>
			</tr>
		</table>
	</div>
	<br />
	<h1 style="text-align: center">Current Session</h1>
		<table cellpadding="1" cellspacing="0" width="100%" border="1" style="text-align: center">
			<tr>
				<th>No.</th>
				<th>Amount</th>
				<th>Instalments</th>
				<th>Check No</th>
				<th>Applied On</th>
				<th>Approved on</th>
				<th>Status</th>
				<th>Desc</th>
			</tr>
			<tr>
				<?=$table?>
			</tr>
		</table>
	<br />
	<h1 style="text-align: center">Completed Sessions</h1>
		<table cellpadding="1" cellspacing="0" width="100%" border="1" style="text-align: center">
			<tr>
				<th>No.</th>
				<th>Amount</th>
				<th>Instalments</th>
				<th>Check No</th>
				<th>Applied On</th>
				<th>Approved on</th>
				<th>Status</th>
				<th>Desc</th>
			</tr>
			<tr>
				<?php
				$employeeprea = mysql_query("SELECT `id`, `eid`, `instalment`, `amount`, `checkno`, `createdate`, `modifieddate`, `modifiedby`, `status`, `extra` FROM `emp_ltb_with` WHERE `eid`='$hrmloggedid' AND `extrastatus`='1'",$con);
				$instalment=0;
$count=1;
$tablea="";
while($rowemployeeprea = mysql_fetch_array($employeeprea))
	{
		$status=$rowemployeeprea["status"];
		$stat_msg="<span style='color:red'>Rejected</span>";
		if($status==0)
		{
			$instalment=$rowemployeeprea["instalment"];
			$stat_msg="<span style='color:blue'>Waiting</span>";
		}else if($status==1)
		{
			$instalment=$rowemployeeprea["instalment"];
			$stat_msg="<span style='color:green'>Approved</span>";
		}
		$instalments=$rowemployeeprea["instalment"];
		$amount=$rowemployeeprea["amount"];
		$checkno=$rowemployeeprea["checkno"];
		$createdate=$rowemployeeprea["createdate"];
		$modifieddate=$rowemployeeprea["modifieddate"];
		$desc=$rowemployeeprea["extra"];
		$tablea.=<<<AAA
				<tr>
					<td>$count</td>
					<td>Rs. $amount</td>
					<td>$instalments</td>
					<td>$checkno</td>
					<td>$createdate</td>
					<td>$modifieddate</td>
					<td>$stat_msg</td>
					<td>$desc</td>
				</tr>
AAA;
		$count++;
	}
				
				
				echo $tablea;
				
				?>
			</tr>
		</table>
</div>
