<?php 
include("../../include/conFig.php");
echo "ss";
?>
<!--------updated by bhupendra------------>


<!-------------------->





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>

	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="assets/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
	<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/style-metro.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL PLUGIN STYLES --> 
	<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
	<link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
	<link href="assets/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" media="screen"/>
	<link href="assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
	<!-- END PAGE LEVEL PLUGIN STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES --> 
	<link href="assets/css/pages/tasks.css" rel="stylesheet" type="text/css" media="screen"/>

</head>

<body style="background:#fff !important">
<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN STYLE CUSTOMIZER -->
						<!-- END BEGIN STYLE CUSTOMIZER -->    
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">
							Dashboard <small>statistics and more</small>
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="#">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
							<li><a href="#">Dasboard</a></li>
							<li style="margin-left:900px;"><a href="#">Today's Date &nbsp;&nbsp;<?php echo date('d-m-Y');?></a></li>
													</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<div id="dashboard">
					<!-- BEGIN DASHBOARD STATS -->
					<div class="row-fluid">
						<div class="span3 responsive" data-tablet="span6" data-desktop="span3">
							<div class="dashboard-stat blue">
								<div class="visual">
									<img src="../../img/1400351770_user-delete.png" />

								</div>
								<?php
								$Todaydate = date('Y-m-d');
								$employee = mysql_query("SELECT * FROM `employee` WHERE `delete` = '0' AND `active` = '1'",$con);
								$num1=mysql_num_rows($employee);
								$attendance = mysql_query("SELECT * FROM `attendance` WHERE `delete` = '0' AND `date`='$Todaydate'",$con);
								$num2=mysql_num_rows($attendance);
								$result = $num1 - $num2;
								$num=mysql_num_rows($result);
								 ?>
								<div class="details">
									<div class="number">
								<?php echo $result; ?>
									</div>
									<div class="desc">                           
										Today's Absent
									</div>
								</div>
								<a class="more" onclick="getModule('dashboard/orignaldash/moodelview','manipulatemoodleContent','viewmoodleContent','')">

								View more <i class="m-icon-swapright m-icon-white"></i>
								</a>                 
							</div>
						</div>
						<div class="span3 responsive" data-tablet="span6" data-desktop="span3">
							<div class="dashboard-stat green">
								<div class="visual">
									<img src="../../img/1400257864_cake_12.png"/>
								</div>
								<?php
								$TodayM = date('m');
								$Todayd = date('d');
								//echo "SELECT `id`,`name` FROM `employee` WHERE `delete` = '0' AND `active` = '1' AND DATE(`dob`) = '$Todayd' AND MONTH(`dob`) = '$TodayM' ";
								//echo "SELECT * FROM employee WHERE MONTH(dob) = MONTH(NOW()) AND DAY(dob) = DAY(NOW()) AND active = '1' AND delete = '0'";
								//$birthday = mysql_query("SELECT * FROM `employee` WHERE `delete` = '0' AND `active` = '1'  AND MONTH(dob) = '$TodayM' AND DATE(dob) = '$Todayd'",$con) or die(mysql_error());
								$birthday = mysql_query("SELECT * FROM employee WHERE MONTH(dob) = MONTH(NOW()) AND DAY(dob) = DAY(NOW())",$con) or die(mysql_error());
								$rowBirth = mysql_fetch_array($birthday);
								$count = mysql_num_rows($birthday);
								$nameBirth =  $rowBirth['name'];
								
								
								?>
								<div class="details">
									<div class="number">
									<?php
									if($count>0){
									 echo $nameBirth;
									 } 
									 else {
									 ?>
									

							               </div>
										
										<div class="number">
										<?php echo "No BirthDay"; } ?>
										</div>
								   
									<div class="desc">Todays BirthDay</div>
								</div>
								<a class="more" href="#">
								View more <i class="m-icon-swapright m-icon-white"></i>
								</a>                 
							</div>
						</div>
						<div class="span3 responsive" data-tablet="span6  fix-offset" data-desktop="span3">
							<div class="dashboard-stat purple">
								<div class="visual">
								<img src="../../img/1400266016_Scheduled Tasks.png" style="height:70px; width:70px; margin-top:10px;" />
								</div>
								<?php
								$Todaydate1 = date('Y-m-d');
								$date = strtotime("+15 day");
                                $Todaydate = date('Y-m-d', $date);
								$job = mysql_query("SELECT * FROM `leavecalendar` WHERE `date` BETWEEN '$Todaydate1' AND '$Todaydate' ORDER BY `event`",$con);
								$get = mysql_fetch_array($job);
								$getjob =  $get[3];	
								if(mysql_num_rows($job)=='0'){				
								?>
								<div class="details">
									<div class="number">
									<?php echo "No Events"; } else { ?>
									
									<?php echo 	$getjob; } ?>
									</div>
									
									<div class="desc">Upcoming Event</div>
								</div>
								<a class="more" href="#">
								Enjoy Holidays<i class="m-icon-swapright m-icon-white"></i>
								</a>                 
							</div>
						</div>
						<div class="span3 responsive" data-tablet="span6" data-desktop="span3">
							<div class="dashboard-stat yellow">
								<div class="visual">
									<i class="icon-bar-chart"></i>
								</div>
								<div class="details">
									<div class="number"><?php echo $yet;?>/<?php echo $target;?></div>
									<div class="desc">Given Target/Acheived Target</div>
								</div>
								<a class="more" href="#">
								View more <i class="m-icon-swapright m-icon-white"></i>
								</a>                 
							</div>
						</div>
					</div>
					<!-- END DASHBOARD STATS -->
				</div>
			</div>
 <script src="assets/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
	<script src="assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
	<!--[if lt IE 9]>
	<script src="assets/plugins/excanvas.min.js"></script>
	<script src="assets/plugins/respond.min.js"></script>  
	<![endif]-->   
	<script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
	<script src="assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
	<script src="assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script src="assets/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>   
	<script src="assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
	<script src="assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
	<script src="assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
	<script src="assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
	<script src="assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
	<script src="assets/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>  
	<script src="assets/plugins/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="assets/plugins/flot/jquery.flot.resize.js" type="text/javascript"></script>
	<script src="assets/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
	<script src="assets/plugins/bootstrap-daterangepicker/date.js" type="text/javascript"></script>
	<script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>     
	<script src="assets/plugins/gritter/js/jquery.gritter.js" type="text/javascript"></script>
	<script src="assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
	<script src="assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js" type="text/javascript"></script>
	<script src="assets/plugins/jquery.sparkline.min.js" type="text/javascript"></script>  
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="assets/scripts/app.js" type="text/javascript"></script>
	<script src="assets/scripts/index.js" type="text/javascript"></script>
	<script src="assets/scripts/tasks.js" type="text/javascript"></script>        
	<!-- END PAGE LEVEL SCRIPTS -->  
	<script>
		jQuery(document).ready(function() {    
		   App.init(); // initlayout and core plugins
		   Index.init();
		   Index.initJQVMAP(); // init index page's custom scripts
		   Index.initCalendar(); // init index page's custom scripts
		   Index.initCharts(); // init index page's custom scripts
		   Index.initChat();
		   Index.initMiniCharts();
		   Index.initDashboardDaterange();
		   Index.initIntro();
		   Tasks.initDashboardWidget();
		});
	</script>

</body>

</html>
