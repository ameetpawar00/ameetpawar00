<?php 
include("include/conFig.php");

?>
<style>
 #menuu ul ul li{   padding-left: 10px !important;
    margin-left: 0px;
}
/*.quick-igger {
    position: absolute;
    z-index: 10103;
    top: 20%;
    right: 5px;
    height: 40px;
    width: 40px;
    border-radius: 50% !important;
    overflow: hidden;
    white-space: nowrap;
    color: transparent;
    background: #8E44AD ;
    cursor: pointer;
}*/
#search_bar {
    padding: 5px;
    margin-top: 0;
    position: absolute;
    background: #32C5D2;
    border-radius: 25px;
    display: none;
    top: 4.5em;
    right: 4em;
}
#mainSearch {
    border-radius: 25px;
    padding: 5px;
}
.quick-igger {
    position: absolute !important;
    z-index: 10103;
    top: 4em;
    right: .5em;
    height: 20px;
    width: 20px;
    border-radius: 50% !important;
    overflow: hidden;
    white-space: nowrap;
    color: transparent;
    background: #32C5D2;
    box-shadow: 1px 2px 0px #848484;
    cursor: pointer;
    margin-top: 5px;
    padding: 10px !important;
}
</style>
<div id="menuu">

<ul class="menu">
<li>
	<a href="#" onclick="side_menu_slide()" class="dropdown-toggle side_mm" style="text-align: right;width: 100%;display: block;padding: 10px;">
  	 <i id="icon_side_to" class="fa fa-angle-double-left side_mm" style="font-size: 3.5em;color: #fff;"></i>
</a>
</li>
<li  onclick="ToggleMenu('','1');getModule('dash/index','viewContent','manipulateContent','Dashboard')"  id="head1"><i class="icon-home"></i> Dashboard <i class="fa fa-angle-left" style="float: right;"></i></li>

<li onclick="ToggleMenu('1','2')" id="head2"><i class="icon-list"></i> Organization
<i class="fa fa-angle-left" style="float: right;"></i>
</li>
<ul style="display:none;padding:0px;" id="menu1"  class="sub-menu">
			<?php if(in_array('v_emp',$thisper)) 
			{
			?>
        <li style="padding-left:15px;" onclick="getModule('employee/view','viewContent','manipulateContent','Employee');$('ul .sub-menu li').css({ 'color': '#fff'});$(this).css({ 'color': '#36c6d3' , 'background': '#2B3643'});"><i class="fa fa-angle-right" style="float: left;"></i>Employee</li>
			<?php 
			} 
			?>
			
			<?php if(in_array('v_asst',$thisper)) 
			{
			?>
        <li style="padding-left:15px; display:none;" onclick="getModule('assets/view','viewContent','manipulateContent','Assets');$('ul .sub-menu li').css({ 'color': '#fff'});$(this).css({ 'color': '#36c6d3' , 'background': '#2B3643'});"><i class="fa fa-angle-right" style="float: left;"></i>Assets</li>
			<?php 
			} 
			?>
			<?php if(in_array('v_alve',$thisper)) 
			{
			?>
        <li style="padding-left:15px; display:none;" onclick="getModule('allotleave/view','viewContent','manipulateContent','Allot');$('ul .sub-menu li').css({ 'color': '#fff'});$(this).css({ 'color': '#36c6d3' , 'background': '#2B3643'});"><i class="fa fa-angle-right" style="float: left;"></i>Allot Leave</li>
			<?php 
			} 
			?>
			<?php if(in_array('v_train',$thisper)) 
			{
			?>
        <li style="padding-left:15px; display:none;" onclick="getModule('training/view','viewContent','manipulateContent','Training');$('ul .sub-menu li').css({ 'color': '#fff'});$(this).css({ 'color': '#36c6d3' , 'background': '#2B3643'});"><i class="fa fa-angle-right" style="float: left;"></i>Training</li>
			<?php 
			} 
			?>
			<?php if(in_array('v_travel',$thisper)) 
			{
			?>
        <li style="padding-left:15px; display:none;" onclick="getModule('travel/view','viewContent','manipulateContent','Travel');$('ul .sub-menu li').css({ 'color': '#fff'});$(this).css({ 'color': '#36c6d3' , 'background': '#2B3643'});"><i class="fa fa-angle-right" style="float: left;"></i>Travel</li>
			<?php 
			} 
			?>
			<?php if(in_array('v_exitD',$thisper)) 
			{
			?>
        <li style="padding-left:15px; display:none;" onclick="getModule('exitdetails/view','viewContent','manipulateContent','Exit Details');$('ul .sub-menu li').css({ 'color': '#fff'});$(this).css({ 'color': '#36c6d3' , 'background': '#2B3643'});"><i class="fa fa-angle-right" style="float: left;"></i>Exit Details</li>
			<?php 
			} 
			?>
			<?php if(in_array('v_kpi',$thisper))
			{
			?>
                <li style="padding-left:15px;" onclick="getModule('kpi/viewMyKPI','viewContent','manipulateContent','Key Performance Indicatior');$('ul .sub-menu li').css({ 'color': '#fff'});$(this).css({ 'color': '#36c6d3' , 'background': '#2B3643'});"><i class="fa fa-angle-right" style="float: left;"></i>View KPI</li>
			<?php 
            }

            if(in_array('v_Tkpi',$thisper))
			{
			?>
                <li style="padding-left:15px;" onclick="getModule('kpi/getEmployee','viewContent','manipulateContent','Key Performance Indicatior');$('ul .sub-menu li').css({ 'color': '#fff'});$(this).css({ 'color': '#36c6d3' , 'background': '#2B3643'});"><i class="fa fa-angle-right" style="float: left;"></i>View Team KPI</li>
			<?php
			}
			?>
			<?php if(in_array('v_IQPEI',$thisper)) 
			{
			?>
        <li style="padding-left:15px;" onclick="getModule('qpe/getProfile','viewContent','manipulateContent','QPE');$('ul .sub-menu li').css({ 'color': '#fff'});$(this).css({ 'color': '#36c6d3' , 'background': '#2B3643'});"><i class="fa fa-angle-right" style="float: left;"></i>QPE</li>
			<?php 
			} 
			?>
			<?php if(in_array('v_lreq',$thisper)) 
			{
			?>
        <li style="padding-left:15px;" onclick="getModule('leaverequest/view','viewContent','manipulateContent','Leave Requests');$('ul .sub-menu li').css({ 'color': '#fff'});$(this).css({ 'color': '#36c6d3' , 'background': '#2B3643'});"><i class="fa fa-angle-right" style="float: left;"></i>Leave Request</li>
			<?php 
			} 
			?>
			<?php if(in_array('v_salary',$thisper)) 
			{
			?>
        <li style="padding-left:15px;" onclick="getModule('employee/salaryslip','viewContent','manipulateContent','Salary Slip');$('ul .sub-menu li').css({ 'color': '#fff'});$(this).css({ 'color': '#36c6d3' , 'background': '#2B3643'});"><i class="fa fa-angle-right" style="float: left;"></i>Salary Slip</li>
			<?php 
			} 
			?>
			<?php if(in_array('car_lea_ba',$thisper)) 
			{
			?>
        <li style="padding-left:15px;" onclick="getModule('profile/moodelview-cleave-r','manipulatemoodleContent','viewmoodleContent','Leaves Bank');$('ul .sub-menu li').css({ 'color': '#fff'});$(this).css({ 'color': '#36c6d3' , 'background': '#2B3643'});"><i class="fa fa-angle-right" style="float: left;"></i>Leaves Bank</li>
			<?php 
			} 
			?>
        
</ul>
<li onclick="ToggleMenu('3','4')" id="head4"><i class="icon-eye"></i> Management<i class="fa fa-angle-left" style="float: right;"></i></li>
<ul style="display:none;padding:0px;" id="menu3"  class="sub-menu">
			<?php if(in_array('v_inv',$thisper)) 
			{
			?>
		<li style="padding-left:25px ; display:none;" onclick="getModule('management/inventory/view','viewContent','manipulateContent','Manage Inventory');$('ul .sub-menu li').css({ 'color': '#fff'});$(this).css({ 'color': '#36c6d3' , 'background': '#2B3643'});"><i class="fa fa-angle-right" style="float: left;"></i>Manage Inventory</li>
			<?php
			}

			if(in_array('u_Tkpi',$thisper))
            {
                ?>
                <li style="padding-left:15px;" onclick="getModule('kpi/getDesig','viewContent','manipulateContent','Key Performance Indicatior');$('ul .sub-menu li').css({ 'color': '#fff'});$(this).css({ 'color': '#36c6d3' , 'background': '#2B3643'});"><i class="fa fa-angle-right" style="float: left;"></i>Allot/Edit KPI</li>
                <?php
            }

			?>
			<?php if(in_array('v_MLreq',$thisper)) 
			{
			?>
 		<li style="padding-left:25px" onclick="getModule('management/leaverequest/view','viewContent','manipulateContent','Leave Approval');$('ul .sub-menu li').css({ 'color': '#fff'});$(this).css({ 'color': '#36c6d3' , 'background': '#2B3643'});"><i class="fa fa-angle-right" style="float: left;"></i>Leave Approval</li>
			<?php 
			} 
			?>
			<?php if(in_array('v_lcal',$thisper)) 
			{
			?>
		        <li style="padding-left:15px;" onclick="getModule('leaverecord/view','viewContent','manipulateContent','Leave Record');$('ul .sub-menu li').css({ 'color': '#fff'});$(this).css({ 'color': '#36c6d3' , 'background': '#2B3643'});"><i class="fa fa-angle-right" style="float: left;"></i>Leave Record</li>
			<?php
			}
			?>
			<?php if(in_array('v_MSalary',$thisper)) 
			{
			?>
       <li style="padding-left:25px" onclick="getModule('management/salary/view','viewContent','manipulateContent','Manage Salary');$('ul .sub-menu li').css({ 'color': '#fff'});$(this).css({ 'color': '#36c6d3' , 'background': '#2B3643'});"><i class="fa fa-angle-right" style="float: left;"></i>Salary</li>
			<?php 
			} 
			?>
			<?php if(in_array('v_MLpolicy',$thisper)) 
			{
			?>
	   <li style="padding-left:25px; display:none;x" onclick="getModule('management/leavepolicy/view','viewContent','manipulateContent','Leave Policy');$('ul .sub-menu li').css({ 'color': '#fff'});$(this).css({ 'color': '#36c6d3' , 'background': '#2B3643'});"><i class="fa fa-angle-right" style="float: left;"></i>Leave Policy</li>
			<?php 
			} 
			?>
			<?php if(in_array('v_uploadatt',$thisper)) 
			{
			?>
			<li style="padding-left:15px;" onclick="getModule('attendance/uploadattendance','viewContent','manipulateContent','Upload Attandance');$('ul .sub-menu li').css({ 'color': '#fff'});$(this).css({ 'color': '#36c6d3' , 'background': '#2B3643'});"><i class="fa fa-angle-right" style="float: left;"></i>Upload Attandance</li>
			<?php 
			} 
			?>

			<?php 
			if(in_array('v_vatt',$thisper) || in_array('a_vatt',$thisper)) 
			{
			?>
        <li style="padding-left:15px;" onclick="getModule('attendance/getDesig','viewContent','manipulateContent','View Attendance');$('ul .sub-menu li').css({ 'color': '#fff'});$(this).css({ 'color': '#36c6d3' , 'background': '#2B3643'});"><i class="fa fa-angle-right" style="float: left;"></i>View Attendance</li>
			<?php 
			} 
			?>
			

</ul> 

			<li  onclick="ToggleMenu('6','7');" id="head7"><i class="icon-ghost"></i> Withdrawal<i class="fa fa-angle-left" style="float: right;"></i></li>
			<ul style="display:none;padding:0px;" id="menu6"  class="sub-menu">

			<?php if(in_array('ca_lea_req',$thisper))
			{
			?>
		<li style="padding-left:25px ; display:;" onclick="getModule('management/leaverequest/cash_leaves_req','viewContent','manipulateContent','Cash Leaves Requests');$('ul .sub-menu li').css({ 'color': '#fff'});$(this).css({ 'color': '#36c6d3' , 'background': '#2B3643'});"><i class="fa fa-angle-right" style="float: left;"></i>Cash Leaves Requests</li>
			<?php
			}
			?>
			<?php if(in_array('ca_pf_req',$thisper)) 
			{
			?>
        <li style="padding-left:15px;" onclick="getModule('management/salary/moodelview-cpf-r','viewContent','manipulateContent','Cash PF Requests');$('ul .sub-menu li').css({ 'color': '#fff'});$(this).css({ 'color': '#36c6d3' , 'background': '#2B3643'});"><i class="fa fa-angle-right" style="float: left;"></i>PF Withdrawal </li>
			<?php 
			} 
			?>		
			<?php if(in_array('ca_ltb_req',$thisper)) 
			{
			?>
        <li style="padding-left:15px;" onclick="getModule('management/salary/moodelview-cltb-r','viewContent','manipulateContent','Cash LTB Requests');$('ul .sub-menu li').css({ 'color': '#fff'});$(this).css({ 'color': '#36c6d3' , 'background': '#2B3643'});"><i class="fa fa-angle-right" style="float: left;"></i>LTB Withdrawal </li>
			<?php 
			} 
			?>
			</ul>   

<li onclick="ToggleMenu('2','3')" id="head3" onclick="$('#job').slideToggle('fast');"><i class="icon-bag"></i> Job<i class="fa fa-angle-left" style="float: right;"></i></li>
<ul style="display:none;padding:0px;" id="menu2" class="sub-menu">
			<?php if(in_array('v_job',$thisper)) 
			{
			?>
        <li style="padding-left:15px;display:none;" onclick="getModule('job/view','viewContent','manipulateContent','Jobs');$('ul .sub-menu li').css({ 'color': '#fff'});$(this).css({ 'color': '#36c6d3' , 'background': '#2B3643'});">
		<i class="fa fa-angle-right" style="float: left;"></i>View Jobs</li>
        <li style="padding-left:15px;" onclick="getModule('job-vacancy/view','viewContent','manipulateContent','Jobs');$('ul .sub-menu li').css({ 'color': '#fff'});$(this).css({ 'color': '#36c6d3' , 'background': '#2B3643'});"><i class="fa fa-angle-right" style="float: left;"></i>Jobs Vacancy</li>
         <li style="padding-left:15px;" onclick="getModule('notification/refer-friend','viewContent','manipulateContent','Jobs');$('ul .sub-menu li').css({ 'color': '#fff'});$(this).css({ 'color': '#36c6d3' , 'background': '#2B3643'});"><i class="fa fa-angle-right" style="float: left;"></i>Refer For Job</li>
          <li style="padding-left:15px;display:none;" onclick="getModule('job-vacancy/jobapplicants/view-all','viewContent','manipulateContent','Jobs');$('ul .sub-menu li').css({ 'color': '#fff'});$(this).css({ 'color': '#36c6d3' , 'background': '#2B3643'});"><i class="fa fa-angle-right" style="float: left;"></i>Job Applicants</li>


			<?php 
			} 
			?>
			<?php if(in_array('v_refer',$thisper)) 
			{
			?>
        <li style="padding-left:15px;" onclick="getModule('management/refral/view','viewContent','manipulateContent','View Refral');$('ul .sub-menu li').css({ 'color': '#fff'});$(this).css({ 'color': '#36c6d3' , 'background': '#2B3643'});"><i class="fa fa-angle-right" style="float: left;"></i>Manage Refral</li>
			<?php 
			} 
			?>
</ul>
     
<!--
<li onclick="ToggleMenu('4','5')" id="head5"><i class="gift" ></i> Incentive</li>
<ul style="display:none;padding:0px;" id="menu4"  class="sub-menu">
			<?php if(in_array('v_IAtten',$thisper)) 
			{
			?>
		<li style="padding-left:25px" onclick="getModule('incentive/attendance/view','viewContent','manipulateContent','Manage Attendance Incentive ')">Attedance</li>
			<?php 
			} 
			?>
			<?php if(in_array('v_IKPI',$thisper)) 
			{
			?>
        <li style="padding-left:25px" onclick="getModule('incentive/kpi/view','viewContent','manipulateContent','Manage KPI Incentive')">KPI</li>
			<?php 
			} 
			?>
			<?php if(in_array('v_IPerf',$thisper)) 
			{
			?>
        <li style="padding-left:25px" onclick="getModule('incentive/performance/view','viewContent','manipulateContent','Manage Performance Incentive')">Performance</li>
			<?php 
			} 
			?>
			<?php if(in_array('v_IRef',$thisper)) 
			{
			?>
        <li style="padding-left:25px" onclick="getModule('incentive/referral/view','viewContent','manipulateContent','Manage Referral Incentive')">Referral</li>
			<?php 
			} 
			?>

</ul>   -->

			<li  onclick="ToggleMenu('5','6');" id="head6"><i class="icon-calendar"></i> Calendar<i class="fa fa-angle-left" style="float: right;"></i></li>
			<ul style="display:none;padding:0px;" id="menu5"  class="sub-menu">
				<?php if(in_array('v_hlcal',$thisper)) 
				{
				?>
					<li style="padding-left:25px" onclick="getModule('leavecalendar/view','viewContent','manipulateContent','Holiday Calendar'); $('ul .sub-menu li').css({ 'color': '#fff'}); $(this).css({ 'color': '#36c6d3' , 'background': '#2B3643'});"><i class="fa fa-angle-right" style="float: left;"></i> Holiday Calendar </li>
				<?php
				}
				?>
				<?php if(in_array('v_ecal',$thisper)) 
				{
				?>
					<li style="padding-left:25px" onclick="getModule('management/events/view','viewContent','manipulateContent','Event Schedule'); $('ul .sub-menu li').css({ 'color': '#fff'});$(this).css({ 'color': '#36c6d3' , 'background': '#2B3643'});"> <i class="fa fa-angle-right" style="float: left;"></i> Event Schedule </li>
				<?php 
				}
				?>				
				<?php if(in_array('v_slcal',$thisper)) 
				{
				?>
					<li style="padding-left:15px;" onclick="getModule('calender/view','viewContent','manipulateContent','Special (Market OFF)'); $('ul .sub-menu li').css({ 'color': '#fff'});$(this).css({ 'color': '#36c6d3' , 'background': '#2B3643'});"><i class="fa fa-angle-right" style="float: left;"></i> Special (Market OFF) </li>
				<?php 
				} 
			?>
			</ul>   




<li  onclick="getModule('masters/index','manipulateContent','viewContent','Setup');$(this).css({'background': '#36c6d3','color':'#fff'});" id="head7"><i class="icon-wrench"></i> Setup<i class="fa fa-angle-left" style="float: right;"></i></li>

<?php if(in_array('atten_show',$thisper)) 	{ ?>
<li  onclick="getModule('daily_attendance/index','viewContent','manipulateContent','Daily Attendance')" id="head11" class="red-gradient" style="color: #fff;"><i class="fa fa-clock-o" aria-hidden="true"></i> 
 Daily Attendance<i class="fa fa-angle-left" style="float: right;"></i></li>
 <?php } ?>
   

<?php if(in_array('bu_for_leav',$thisper)) 
		{
?>

<li  onclick="ToggleMenu('','8');getModule('management/leaverequest/bulk_forward_leaves','viewContent','manipulateContent','Bulk Forward Leaves')" id="head8" style="background: #e7505a url('../images/left-arrow.png') no-repeat scroll right center;color: #fff;"><i class="icon-reload"></i> Bulk Forward Leaves<i class="fa fa-angle-left" style="float: right;"></i></li>
<?php
		} 
?>
<?php if(in_array('bu_for_leav',$thisper)) 
		{
?>
<li  onclick="ToggleMenu('','9');getModule('masters/salary-variables/view','viewContent','manipulateContent','Manual Salary Setup')" id="head9" style="background: #c49f47  url('../images/left-arrow.png') no-repeat scroll right center;color: #fff;"><i class="icon-reload"></i> Salary variable Setup<i class="fa fa-angle-left" style="float: right;"></i></li>
<?php
		} 
?>
<?php if(in_array('cust_profile_view',$thisper)) 
		{
?>

<li  onclick="getModule('employee/custom_profile_view/view','viewContent','manipulateContent','Custom Profile View');ToggleMenu('','10');" id="head10" style="background: #3598dc url('../images/left-arrow.png') no-repeat scroll right center;color: #fff;"><i class="icon-user"></i>Custom Profile View<i class="fa fa-angle-left" style="float: right;"></i></li>
<?php
		} 
?>

<?php
//if($hrmloggedid==86 OR $hrmloggedid==81 OR $hrmloggedid==93)
if($hrmloggedid==613 OR $hrmloggedid==93)
{
?>
<!--<li  onclick="getModule('test/index','viewContent','manipulateContent','Setup')" id="head7" style="
    background: #00BCD4 url(images/left-arrow.png) no-repeat scroll right center;
"><i class="add-form"></i> Polling station</li>-->
<li  onclick="getModule('test/result','viewContent','manipulateContent','Setup')" id="head7" style="
    background: #FF5722 url(images/left-arrow.png) no-repeat scroll right center;
"><i class="salary"></i> Polling Results</li>

<?php 
}
?>
</ul>
<input type="hidden" value="7**10" id="maxMenu" />
</div>