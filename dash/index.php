<?php
	include("../include/conFig.php");
	include("../include/calculateAbsent_trifid.php");
?>
<style>
	.datablock
	{
		min-height: 45px;
		margin-bottom: 10px;
		border: 1px dotted #bcbcbc;
		cursor: pointer;
		position: relative;
	}
	.datablock:hover
	{
		border: 1px solid #bcbcbc;
	}
	.datablock:hover .small_block
	{
		opacity: .8;
	}
	.small_block
	{
		width: 10%;
		float: left;
		min-height: 45px;
		text-align: center;
	}
	.small_block i
	{
		font-size: 2.2em;
		padding-top: 15px;
		color: #ffffffb3;
	}
	.medium_block
	{
		width: 90%;
		float: left;
		/* 	min-height: 50px;*/
	}
	.medium_block span
	{
		padding: 10px;
		font-size: 15px;
		line-height: 3;
		color: #565d66;
		text-transform: capitalize;
	}
	.closese
	{
		display: none;
		position: absolute;
		top: 0;
		right: 0;
		opacity: .5;
	}
	.datablock:hover .closese
	{
		display: none;
	}
</style>
<div id="myTitle">
	<div class="title">
		Dashboard
		<small style="font-size:16px;">
			statistics and more
		</small>
		<span style="margin-left:100px; float:right;color:;">
Today :&nbsp;&nbsp;&nbsp;<?php echo date('d-M-Y')?>
</span>
	</div>
	<div class="strip">
<span>
Home
</span>
		<span>
Dashboard
</span>
	</div>
</div>
<div id="dashboard">
	<!-- BEGIN DASHBOARD STATS -->
	<div class="row-fluid" style="width: 50%; float:left;">
		<?php
			include ("index_small.php");
		?>
	</div>
	<div class="row-fluid " id="leftbar_tabs" style="width: 50%; float:left;overflow: auto;">
		<div class="span3 responsive" data-tablet="span6" data-desktop="span3" >
			<div class="dashboard-stat voilet">
				<div class="visual">
					<i class="fa fa-calendar" id="i1">
					</i>
				</div>
				<div class="details">
					<div class="number">
						<?php
							$cmonnth=date("m");
							//$cmonnth=04;
							$cyear=date("Y");
							$shift=$_COOKIE['shift'];
							$department=$_COOKIE['department'];
							$eid=$_COOKIE['hrmloggeduserid'];
							$abcd=checkingAbs($cmonnth,$cyear,$eid,$shift,$department);
							$late_mnts=$abcd["lMin"];
							//						$cmonnth=date("m");
							$sqll = "SELECT MAX(`date`) FROM `attendance` WHERE `employee`='$eid' AND MONTH(`date`)='$cmonnth' AND YEAR(`date`)='$cyear' AND `delete` = '0'";
							$getDatal = mysql_query($sqll,$con) or die(mysql_error());
							$rowl =mysql_fetch_array($getDatal);
							$hdayysl=$rowl[0];
							echo $late_mnts ."<small style='font-size:12px'> Late Minutes</small>";
						?>
					</div>
					<div class="desc">
						Till <?=$hdayysl?>
						
						<?php
							if(in_array('empLtcmng',$thisper)){
								?>
								
								<br>
								
								<a style='font-size:12px; text-decoration: underline; color:#fff' onclick="getModule('dash/moodelview-latecoming','manipulatemoodleContent','viewmoodleContent','')" href="#">
									View All
								</a>
								<?php
							}
						?>
					
					
					</div>
				</div>
			</div>
		</div>
		<div class="span3 responsive" data-tablet="span6" data-desktop="span3"  onclick="getModule('dash/moodelview-holi','manipulatemoodleContent','viewmoodleContent','')" >
			<div class="dashboard-stat blue">
				<div class="visual">
					<i class="fa fa-bullhorn" id="i1">
					</i>
				</div>
				<div class="details">
					<div class="number">
						<?php
							$cmonnth=date("m");
							$cyear=date("Y");
							$sql = "SELECT COUNT(*) FROM `leavecalendar` WHERE MONTH(`date`)='$cmonnth' AND YEAR(`date`)='$cyear' AND `delete` = '0'";
							$getData = mysql_query($sql,$con) or die(mysql_error());
							$row =mysql_fetch_array($getData);
							echo $hdayys=$row[0];
						?>
					</div>
					<div class="desc">
						Holidays + Market Off's <small>(This Month)</small>
					</div>
				</div>
			</div>
		</div>
		<div class="span3 responsive" data-tablet="span6" data-desktop="span3"  onclick="getModule('dash/moodelview-bday','manipulatemoodleContent','viewmoodleContent','')">
			<div class="dashboard-stat green">
				<div class="visual">
					<i class="fa fa-birthday-cake"  id="i3">
					</i>
				</div>
				<?php $TodayM   = date('m');
					$Todayd   = date('d');
					//echo "SELECT `id`,`name` FROM `employee` WHERE `delete` = '0' AND `active` = '1' AND DATE(`dob`) = '$Todayd' AND MONTH(`dob`) = '$TodayM' ";
					//echo "SELECT * FROM employee WHERE MONTH(dob) = MONTH(NOW()) AND DAY(dob) = DAY(NOW()) AND active = '1' AND delete = '0'";
					//$birthday = mysql_query("SELECT * FROM `employee` WHERE `delete` = '0' AND `active` = '1'  AND MONTH(dob) = '$TodayM' AND DATE(dob) = '$Todayd'",$con) or die(mysql_error());
					$birthday = mysql_query("SELECT COUNT(*) FROM employee WHERE MONTH(dob) = MONTH(NOW()) AND DAY(dob) = DAY(NOW()) AND `active` = '1' AND `empstatus` = '2' AND `delete` = '0'",$con) or die(mysql_error());
					$rowBirth = mysql_fetch_array($birthday);
					$count    = mysql_num_rows($birthday);
					$nameBirth= $rowBirth[0];
				?>
				<div class="details">
					<div class="number">
						<?php
							if ($count > 0) {
								echo $nameBirth;
							}
							else
							{
								echo "No BirthDay";
							}
						?>
					</div>
					<div class="desc">
						BirthDay's Today
					</div>
				</div>
			</div>
		</div>
		<div class="span3 responsive" data-tablet="span6" data-desktop="span3"  onclick="getModule('dash/moodelview-yearcomp?counter=<?=$counter;?>','manipulatemoodleContent','viewmoodleContent','')">
			<div class="dashboard-stat yellow">
				<div class="visual" style="height:90px;font-size: 4em;color: #795548;">
					<i class="fa fa-calendar-check-o"  id="i5">
					</i>
				</div>
				<div class="details">
					<div class="number">
						<?php
							$counter = 0;
							$employee= mysql_query("SELECT `doj`,`dor` FROM `employee` WHERE `delete` = '0' AND `active` = '1' AND `empstatus` = '2'",$con);
							while ($rowemp = mysql_fetch_array($employee)) {
								//print_r($rowemp);
								$doj         = $rowemp["doj"];
								$dor         = $rowemp["dor"];
								if($dor!="" && $dor!="0000-00-00")
								{
									$doj=$dor;
								}
								$doj_split   = explode("-",$doj);
								$doy         = $doj_split[0];
								$dom         = $doj_split[1];
								$dod         = $doj_split[2];
								$cdate       = date("Y-m-d");
								$cdate_split = explode("-",$cdate);
								$cdatey      = $cdate_split[0];
								$cdatem      = $cdate_split[1];
								$cdated      = $cdate_split[2];
								if ($cdated == $dod AND $dom == $cdatem AND $cdatey!=$doy) {
									$n_of_year = $cdatey - $doy;
									$counter++;
								}
							}
							echo $counter;
						?>
					</div>
					<div class="desc">
						Year Completion
					</div>
				</div>
			</div>
		</div>
		<div class="span3 responsive" data-tablet="span6" data-desktop="span3" onclick="getModule('dash/moodelview-bday?nmnthbd=1','manipulatemoodleContent','viewmoodleContent','')">
			<?php
				if(in_array('empbday',$thisper))
				{
					?>
					<div class="dashboard-stat green">
						<div class="visual">
							<i class="fa fa-birthday-cake"  id="i3">
							</i>
						</div>
						<?php $TodayM   = date('m');
							$Todayd   = date('d');
							$birthday = mysql_query("SELECT COUNT(*) FROM employee WHERE MONTH(dob) = MONTH(now() + interval 1 month) AND `active` = '1' AND `empstatus` = '2' AND `delete` = '0'",$con) or die(mysql_error());
							$rowBirth = mysql_fetch_array($birthday);
							$count    = mysql_num_rows($birthday);
							$nameBirth= $rowBirth[0];
						?>
						<div class="details">
							<div class="number">
								<?php
									if ($count > 0) {
										echo $nameBirth;
									}
									else
									{
										echo "No BirthDay";
									}
								?>
							</div>
							<div class="desc">
								Next Months Birthdays
							</div>
						</div>
					</div>
					<?php
				}?>
		</div>
		
		<div class="span3 responsive" data-tablet="span6" data-desktop="span3" onclick="getModule('dash/moodelview-yearcomp?nmnthyc=1','manipulatemoodleContent','viewmoodleContent','')">
			<div class="dashboard-stat yellow">
				<div class="visual" style="height:90px;font-size: 4em;color: #795548;">
					<i class="fa fa-calendar-check-o"  id="i5">
					</i>
				</div>
				<div class="details">
					<div class="number">
						<?php
							$counter = 0;
							$employee= mysql_query("SELECT * FROM `employee` WHERE `delete` = '0' AND `active` = '1' AND `empstatus` = '2'",$con);
							while ($rowemp = mysql_fetch_array($employee)) {
								//print_r($rowemp);
								$doj         = $rowemp["doj"];
								$dor         = $rowemp["dor"];
								if($dor!="" && $dor!="0000-00-00")
								{
									$doj=$dor;
								}
								$doj_split   = explode("-",$doj);
								$doy         = $doj_split[0];
								$dom         = $doj_split[1];
								$dod         = $doj_split[2];
								//$cdate       = date("Y-m-d");
								$cdate = date('Y-m-d', strtotime('+1 month'));
								$cdate_split = explode("-",$cdate);
								$cdatey      = $cdate_split[0];
								$cdatem      = $cdate_split[1];
								$cdated      = $cdate_split[2];
								if ($dom == $cdatem) {
									$n_of_year = $cdatey - $doy;
									$counter++;
								}
							}
							echo $counter;
						?>
					</div>
					<div class="desc">
						Next Months Year Completion
					</div>
				</div>
			</div>
		</div>
		
		
		<?php
		
	if($hrmloggedid==93)
	{
		?>

		<div class="span3 responsive" data-tablet="span6" data-desktop="span3" onclick="getModule('dash/moodelview-bday?nmntddssss2=1','manipulatemoodleContent','viewmoodleContent','')">
			<?php
				if(in_array('empbday',$thisper))
				{
					?>
					<div class="dashboard-stat green">
						<div class="visual">
							<i class="fa fa-birthday-cake"  id="i3">
							</i>
						</div>
						<?php $TodayM   = date('m');
							$Todayd   = date('d');
							$birthday = mysql_query("SELECT COUNT(*) FROM employee WHERE MONTH(dob) = MONTH(now()) AND `active` = '1' AND `empstatus` = '2' AND `delete` = '0'",$con) or die(mysql_error());
							$rowBirth = mysql_fetch_array($birthday);
							$count    = mysql_num_rows($birthday);
							$nameBirth= $rowBirth[0];
						?>
						<div class="details">
							<div class="number">
								<?php
									if ($count > 0) {
										echo $nameBirth;
									}
									else
									{
										echo "No BirthDay";
									}
								?>
							</div>
							<div class="desc">
								Current Months Birthdays
							</div>
						</div>
					</div>
					<?php
				}?>
		</div>
		
		<div class="span3 responsive" data-tablet="span6" data-desktop="span3" onclick="getModule('dash/moodelview-yearcomp?nmntddssss2=1','manipulatemoodleContent','viewmoodleContent','')">
			<div class="dashboard-stat yellow">
				<div class="visual" style="height:90px;font-size: 4em;color: #795548;">
					<i class="fa fa-calendar-check-o"  id="i5">
					</i>
				</div>
				<div class="details">
					<div class="number">
						<?php
							$counter = 0;
							$employee= mysql_query("SELECT * FROM `employee` WHERE `delete` = '0' AND `active` = '1' AND `empstatus` = '2'",$con);
							while ($rowemp = mysql_fetch_array($employee)) {
								//print_r($rowemp);
								$doj         = $rowemp["doj"];
								$doj_split   = explode("-",$doj);
								$doy         = $doj_split[0];
								$dom         = $doj_split[1];
								$dod         = $doj_split[2];
								//$cdate       = date("Y-m-d");
								$cdate = date('Y-m-d');
								$cdate_split = explode("-",$cdate);
								$cdatey      = $cdate_split[0];
								$cdatem      = $cdate_split[1];
								$cdated      = $cdate_split[2];
								if ($dom == $cdatem) {
									$n_of_year = $cdatey - $doy;
									$counter++;
								}
							}
							echo $counter;
						?>
					</div>
					<div class="desc">
						Current Months Year Completion
					</div>
				</div>
			</div>
		</div>
		<?php
	}
	
	?>
		
		<div class="span3 responsive" data-tablet="span6" data-desktop="span3"  onclick="getModule('dash/moodelview-event','manipulatemoodleContent','viewmoodleContent','')">
			<!--<div class="span3 responsive" data-tablet="span6" data-desktop="span3"  >
			--><div class="dashboard-stat red">
				<div class="visual">
					<i class="fa fa-calendar"  id="i4">
					</i>
				</div>
				<?php
					$Todaydate1 = date('m');
					$Todaydate22 = date('Y');
					$eve        = mysql_query("SELECT COUNT(*) FROM `events` WHERE MONTH(`date`)= '$Todaydate1' AND  YEAR(`date`)= '$Todaydate22'",$con);
					$get        = mysql_fetch_array($eve);
					$getjob     = $get[0];
				?>
				<div class="details">
					<div class="number">
						<?php echo $getjob;  ?>
					</div>
					<div class="desc">
						Upcoming Events
					</div>
				</div>
			</div>
		</div>
		<br>
	</div>
	<!-- END DASHBOARD STATS -->
</div>