<?php
include("../include/conFig.php");
$cyear = date("Y");
$cdatee= DATE("Y-m-d");
$sql   = "SELECT SUM(`PF`) as `total_pf`, COUNT(`PF`) as `total_No`, COUNT(`PF`) as `total_LTB` FROM `salaryslip` WHERE `employee`='$hrmloggedid' AND (createdate BETWEEN '$hrmDOJ' AND '$cdatee')";
$query = mysql_query($sql,$con) or die(mysql_error());
$rowemp   = mysql_fetch_array($query);
$total_pf = $rowemp["total_pf"];
$total_No = $rowemp["total_No"];
$total_LTB= $rowemp["total_LTB"];
$temp_ltb = $total_No * 2000;
$no_leave=0;
$sqla     = "SELECT `leave` FROM `allleavestat` WHERE `empid`='$hrmloggedid'  AND YEAR(`updatedate`)='$cyear'";
$querya   = mysql_query($sqla,$con) or die(mysql_error());
while($rowempa = mysql_fetch_array($querya))
{
	 $ltype=$rowempa["leave"];
	if($ltype>1)
	{
		$no_leave=$no_leave+0.5;
	}else{
		$no_leave++;
	}
}

$sqlaa   = "SELECT `EL`, `CL`, `SL` FROM `leaverecord` WHERE `userid`='$hrmloggedid'  AND YEAR(`modifiededate`)='$cyear'";
$querysa = mysql_query($sqlaa,$con) or die(mysql_error());
$rowempaa   = mysql_fetch_array($querysa);
$EL         = $rowempaa["EL"];
$CL         = $rowempaa["CL"];
$SL         = $rowempaa["SL"];
$sum_leave  = $EL + $CL + $SL;




$Y          = date('Y', strtotime('-1 years'));
$sql_log    = "SELECT `leaves_carried`, `leaves_cashed` FROM `carry_leavelog` WHERE `of_year`='$Y' AND `userid`='$hrmloggedid' AND `delete_val`!='1'";
$getsql_log = mysql_query($sql_log,$con) or die(mysql_error());

$rowlogl        = mysql_fetch_array($getsql_log);
$leaves_carried = $rowlogl["leaves_carried"];
$leaves_cashed  = $rowlogl["leaves_cashed"];

?>
<style>
	.profile_view .dashboard-stat .visual
	{
/*		width: 50px;*/
		display: block;
		float: left;
		margin-top: 50px;
/*		margin-left: 10px;*/
	}
</style>
<div id="myTitle">
	<div class="title">
		Welome <?=$hrmloggeduser?>
		<span style="margin-left:100px; float:right;color:;">
			Today :&nbsp;&nbsp;&nbsp;<?php echo date('d-M-Y')?>
		</span>
	</div>
	<div class="strip">
		<span>
			Home
		</span>
		<span>
			Profile
		</span>
		<span>
			View
		</span>
	</div>
</div>
<div id="dashboard" class="profile_view">
	<div class="row-fluid">
		<div class="dashboard-stat blue" style="width:24%;  display: inline-block;margin: 0 2px 5px 0;"  onclick="getModule('profile/moodelview-pf','manipulatemoodleContent','viewmoodleContent','')">
			<div class="visual">
				<i class="fa fa-inr">
				</i>
			</div>
			<div class="details">
				<div class="number">
					<?=$total_pf*2?>
				</div>
				<div class="desc">
					Total PF Amount
				</div>
			</div>
		</div>
		<div class="dashboard-stat yellow " style="width:24%;  display: inline-block;margin: 0 2px 5px 0;"  onclick="getModule('profile/moodelview-ltb','manipulatemoodleContent','viewmoodleContent','')">
			<div class="visual">
				<i class="fa fa-money">
				</i>

			</div>
			<div class="details">
				<div class="number">
					<?=$temp_ltb?>
				</div>
				<div class="desc">
					Total LTB Amount
				</div>
			</div>
		</div>
		<div class="dashboard-stat red	" style="width:24%; display: inline-block;margin: 0 2px 5px 0;"  onclick="getModule('profile/moodelview-leave-t','manipulatemoodleContent','viewmoodleContent','')">
			<div class="visual">
				<i class="fa fa-calendar-minus-o ">
				</i>
			</div>
			<div class="details">
				<div class="number">
					<?=$no_leave?>
				</div>
				<div class="desc">
					Leaves Taken<br>
					<small>
						(Including LWP)
					</small>
				</div>
			</div>
		</div>
		<div class="dashboard-stat green" style="width:24%;  display: inline-block;margin: 0 2px 5px 0;"  onclick="getModule('profile/moodelview-leave-r','manipulatemoodleContent','viewmoodleContent','')">
			<div class="visual">
				<i class="fa fa-calendar-plus-o">
				</i>
			</div>
			<div class="details">
				<div class="number">
					<?=$sum_leave?> / 24
					<small>
						(Total)
					</small>
				</div>
				<div class="desc">
					Remaining Leaves<br>
					<small>
						(Excluding LWP)
					</small>
				</div>
			</div>
		</div>
		<?php
		if (in_array('car_lea_ba',$thisper)) {
			?>
			<div class="dashboard-stat voilet" style="width:24%;  display: inline-block;margin: 0 2px 5px 0;" onclick="getModule('profile/moodelview-cleave-r','manipulatemoodleContent','viewmoodleContent','')">
				<div class="visual">
					<i class="fa fa-history">
					</i>
				</div>
				<div class="details">
					<div class="number">
						<?=$leaves_cashed;?> / <?=$leaves_carried;?>
						<small>
							(<?=$Y?>)
						</small>
					</div>
					<div class="desc">
						Carry Leaves Bank<br>
						<small>
							(Leaves cashed/Leaves Carried)
						</small>
					</div>
				</div>
			</div>
			<?php
		}
		?>
	</div>
</div>



<script>
	/*
	var tot_val=document.getElementById('nolwant_leave_tot').value;var aptot_val=document.getElementById('nolwant_leave').value;if((parseInt(tot_val)<parseInt(aptot_val)) && (parseInt(aptot_val)=='')){alert('Please Enter Valid Value');}else{getModule('profile/moodelview-pf-new','manipulatemoodleContent','viewmoodleContent','');}
	*/
</script>