<?php
	include("../../include/conFig.php");
	$id      = $_GET['id'];
	$getData = mysql_query("SELECT `id`,`permission` FROM `permission` WHERE `rollid` = '$id'",$con) or die(mysql_error());
	$row   = mysql_fetch_array($getData);
	$perid = $row['id'];
	if ($perid != "")
	{
		$url = "masters/accesscontrol/save?id=$id&perid=$perid";
		$x   = 2;
	}
	else
	{
		$url = "masters/accesscontrol/save?id=$id";
		$x   = 1;
	}
	$per     = $row['permission'];
	$per_new = explode(",",$per);
?>
<table cellpadding="5" cellspacing="0" width="100%" >
	<tr id="" width="">
		<th style="height: 29px; width: 557px; color:blue" onclick="menuToggle('cati1','maxi')">
			Organisation :
		</th>
	</tr>
	<div id="cati1" style="display:none;">
		<tr id="dash1">
			<td align="right" valign="top" width="28%">
				<input name="" onclick="CheckedAll('dash1','dash1ckhk')" id="dash1ckhk" type="checkbox" >Dashboard1
			</td>
			
			<td align="right" valign="top" width="28%">
				<input name="" type="checkbox" id="chid237" value="empbday"  <?php
					if (in_array('empbday',$per_new)) {
						echo "checked=checked" ;
					}?> >Birthday List
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid220" value="d_search" <?php
					if (in_array('d_search',$per_new)) {
						echo "checked=checked" ;
					}?> >Search
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid221" value="d_notifica" <?php
					if (in_array('d_notifica',$per_new)) {
						echo "checked=checked" ;
					}?> >Notificaions
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid222" value="d_changep" <?php
					if (in_array('d_changep',$per_new)) {
						echo "checked=checked" ;
					}?> >Change Password
			</td>
		</tr>
		<tr id="dash2">
			<td align="right" valign="top" width="28%">
				<input name="" onclick="CheckedAll('dash2','dash2ckhk')" id="dash2ckhk" type="checkbox" >Dashboard 2
			</td>
			
			
			
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid247" value="d_incrnoti" <?php
					if (in_array('d_incrnoti',$per_new)) {
						echo "checked=checked" ;
					}?> >Increment Notification
			</td>
			
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid223" value="d_profile_view" <?php
					if (in_array('d_profile_view',$per_new)) {
						echo "checked=checked" ;
					}?> >Profile View
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid224" value="d_changepic" <?php
					if (in_array('d_changepic',$per_new)) {
						echo "checked=checked" ;
					}?> >Change Profile Picture
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid248" value="empLtcmng" <?php
					if (in_array('empLtcmng',$per_new)) {
						echo "checked=checked" ;
					}?> >Team Late Coming
			</td>
		</tr>
		<tr id="employee">
			<td align="right" valign="top" width="28%">
				<input name="" onclick="CheckedAll('employee','empChk')" id="empChk" type="checkbox" >Employee
			</td>
			
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid0" value="v_emp" <?php
					if (in_array('v_emp',$per_new)) {
						echo "checked=checked" ;
					}?> >View
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid1" value="a_emp" <?php
					if (in_array('a_emp',$per_new)) {
						echo "checked=checked" ;
					}?> >Add
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid2" value="d_emp" <?php
					if (in_array('d_emp',$per_new)) {
						echo "checked=checked" ;
					}?> >Delete
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid3" value="u_emp" <?php
					if (in_array('u_emp',$per_new)) {
						echo "checked=checked" ;
					}?> >Update
			</td>
			<td width="12%">
			</td>
			<td width="12%">
			</td>
		</tr>
		<tr id="edependent">
			
			<td align="right" valign="top" width="28%">
				<input name="" onclick="CheckedAll('edependent','empdChk')" id="empdChk" type="checkbox" >Employee Dependent
			</td>
			
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid124" value="v_empd" <?php
					if (in_array('v_empd',$per_new)) {
						echo "checked=checked" ;
					}?> >View
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid125" value="a_empd" <?php
					if (in_array('a_empd',$per_new)) {
						echo "checked=checked" ;
					}?> >Add
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid126" value="d_empd" <?php
					if (in_array('d_empd',$per_new)) {
						echo "checked=checked" ;
					}?> >Delete
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid127" value="u_empd" <?php
					if (in_array('u_empd',$per_new)) {
						echo "checked=checked" ;
					}?> >Update
			</td>
			<td width="12%">
			</td>
			<td width="12%">
			</td>
		</tr>
		<tr id="eeducation">
			<td align="right" valign="top" width="28%">
				<input name="" onclick="CheckedAll('eeducation','empeChk')" id="empeChk" type="checkbox" >Employee Education
			</td>
			
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid128" value="v_empe" <?php
					if (in_array('v_empe',$per_new)) {
						echo "checked=checked" ;
					}?> >View
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid129" value="a_empe" <?php
					if (in_array('a_empe',$per_new)) {
						echo "checked=checked" ;
					}?> >Add
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid130" value="d_empe" <?php
					if (in_array('d_empe',$per_new)) {
						echo "checked=checked" ;
					}?> >Delete
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid131" value="u_empe" <?php
					if (in_array('u_empe',$per_new)) {
						echo "checked=checked" ;
					}?> >Update
			</td>
			<td width="12%">
			</td>
			<td width="12%">
			</td>
		</tr>
		<tr id="edocumentation">
			<td align="right" valign="top" width="28%">
				<input name="" onclick="CheckedAll('edocumentation','empddChk')" id="empddChk" type="checkbox" >Employee Documentation
			</td>
			
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid243" value="v_empdd" <?php
					if (in_array('v_empdd',$per_new)) {
						echo "checked=checked" ;
					}?> >View
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid244" value="a_empdd" <?php
					if (in_array('a_empdd',$per_new)) {
						echo "checked=checked" ;
					}?> >Add
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid245" value="d_empdd" <?php
					if (in_array('d_empdd',$per_new)) {
						echo "checked=checked" ;
					}?> >Increment Update
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid246" value="u_empdd" <?php
					if (in_array('u_empdd',$per_new)) {
						echo "checked=checked" ;
					}?> >Update
			</td>
			<td width="12%">
			</td>
			<td width="12%">
			</td>
		</tr>
		<tr id="eexperience">
			<td align="right" valign="top" width="28%">
				<input name="" onclick="CheckedAll('eexperience','empxChk')" id="empxChk" type="checkbox" >Employee Experience
			</td>
			
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid132" value="v_empx" <?php
					if (in_array('v_empx',$per_new)) {
						echo "checked=checked" ;
					}?> >View
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid133" value="a_empx" <?php
					if (in_array('a_empx',$per_new)) {
						echo "checked=checked" ;
					}?> >Add
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid134" value="d_empx" <?php
					if (in_array('d_empx',$per_new)) {
						echo "checked=checked" ;
					}?> >Delete
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid135" value="u_empx" <?php
					if (in_array('u_empx',$per_new)) {
						echo "checked=checked" ;
					}?> >Update
			</td>
			<td width="12%">
			</td>
			<td width="12%">
			</td>
		</tr>
		
		<tr id="etask">
			<td align="right" valign="top" width="28%">
				<input name="" onclick="CheckedAll('etask','emptChk')" id="emptChk" type="checkbox" >Employee Add Task
			</td>
			
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid140" value="v_empt" <?php
					if (in_array('v_empt',$per_new)) {
						echo "checked=checked" ;
					}?> >View
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid141" value="a_empt" <?php
					if (in_array('a_empt',$per_new)) {
						echo "checked=checked" ;
					}?> >Add
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid142" value="d_empt" <?php
					if (in_array('d_empt',$per_new)) {
						echo "checked=checked" ;
					}?> >Delete
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid143" value="u_empt" <?php
					if (in_array('u_empt',$per_new)) {
						echo "checked=checked" ;
					}?> >Update
			</td>
			<td width="12%">
			</td>
			<td width="12%">
			</td>
		</tr>
		<tr id="vattendance">
			<td align="right" valign="top" width="28%">
				<input name="" onclick="CheckedAll('vattendance','vAchk')" id="vAchk" type="checkbox" >Verify Attendance
			</td>
			
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid4" value="v_vatt" <?php
					if (in_array('v_vatt',$per_new)) {
						echo "checked=checked" ;
					}?> >View
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid5" value="a_vatt" <?php
					if (in_array('a_vatt',$per_new)) {
						echo "checked=checked" ;
					}?>>View All
			</td>
			<td align="right" width="12%" style="display:none">
				<input name="" type="checkbox" id="chid6" value="d_vatt" <?php
					if (in_array('d_vatt',$per_new)) {
						echo "checked=checked" ;
					}?>>Delete
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid7" value="u_vatt" <?php
					if (in_array('u_vatt',$per_new)) {
						echo "checked=checked" ;
					}?>>Update
			</td>
			<td align="right" width="12%" style="display:none">
				<input name="" type="checkbox" id="chid144" value="ap_vatt" <?php
					if (in_array('ap_vatt',$per_new)) {
						echo "checked=checked" ;
					}?>>Approve Attendance
			</td>
			<td width="12%">
			</td>
		</tr>
		<tr id="assets">
			<td align="right" valign="top" width="28%">
				<input name="" onclick="CheckedAll('assets','assetChk')" id="assetChk" type="checkbox" >Assets
			</td>
			
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid8" value="v_asst" <?php
					if (in_array('v_asst',$per_new)) {
						echo "checked=checked" ;
					}?> >View
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid9" value="a_asst" <?php
					if (in_array('a_asst',$per_new)) {
						echo "checked=checked" ;
					}?> >Add
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid10" value="d_asst" <?php
					if (in_array('d_asst',$per_new)) {
						echo "checked=checked" ;
					}?> >Delete
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid11" value="u_asst" <?php
					if (in_array('u_asst',$per_new)) {
						echo "checked=checked" ;
					}?> >Update
			</td>
			<td width="12%">
			</td>
			<td width="12%">
			</td>
		</tr>
		<tr id="aleaves">
			<td align="right" valign="top" width="28%">
				<input name="" onclick="CheckedAll('aleaves','aLChk')" id="aLChk" type="checkbox" >Allot Leaves
			</td>
			
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid12" value="v_alve" <?php
					if (in_array('v_alve',$per_new)) {
						echo "checked=checked" ;
					}?> >View
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid13" value="a_alve" <?php
					if (in_array('a_alve',$per_new)) {
						echo "checked=checked" ;
					}?> >Add
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid14" value="d_alve" <?php
					if (in_array('d_alve',$per_new)) {
						echo "checked=checked" ;
					}?> >Delete
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid15" value="u_alve" <?php
					if (in_array('u_alve',$per_new)) {
						echo "checked=checked" ;
					}?> >Update
			</td>
			<td width="12%">
			</td>
			<td width="12%">
			</td>
		
		</tr>
		<tr id="training">
			<td align="right" valign="top" width="28%">
				<input name="" onclick="CheckedAll('training','tainingChk')" id="tainingChk" type="checkbox" >Training
			</td>
			
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid16" value="v_train" <?php
					if (in_array('v_train',$per_new)) {
						echo "checked=checked" ;
					}?> >View
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid17" value="a_train" <?php
					if (in_array('a_train',$per_new)) {
						echo "checked=checked" ;
					}?> >Add
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid18" value="d_train" <?php
					if (in_array('d_train',$per_new)) {
						echo "checked=checked" ;
					}?> >Delete
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid19" value="u_train" <?php
					if (in_array('u_train',$per_new)) {
						echo "checked=checked" ;
					}?> >Update
			</td>
			<td width="12%">
			</td>
			<td width="12%">
			</td>
		
		</tr>
		<tr id="travel">
			<td align="right" valign="top" width="28%">
				<input name="" onclick="CheckedAll('travel','travelChk')" id="travelChk" type="checkbox" >Travel
			</td>
			
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid20" value="v_travel" <?php
					if (in_array('v_travel',$per_new)) {
						echo "checked=checked" ;
					}?> >View
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid21" value="a_travel" <?php
					if (in_array('a_travel',$per_new)) {
						echo "checked=checked" ;
					}?> >Add
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid22" value="d_travel" <?php
					if (in_array('d_travel',$per_new)) {
						echo "checked=checked" ;
					}?> >Delete
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid23" value="u_travel" <?php
					if (in_array('u_travel',$per_new)) {
						echo "checked=checked" ;
					}?> >Update
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid145" value="ap_extravel" <?php
					if (in_array('ap_extravel',$per_new)) {
						echo "checked=checked" ;
					}?> >Approve Expense
			</td>
			<td width="12%">
			</td>
		</tr>
		<tr id="exitdetail">
			<td align="right" valign="top" width="28%">
				<input name="" onclick="CheckedAll('exitdetail','exitDChk')" id="exitDChk" type="checkbox" >Exit Details
			</td>
			
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid24" value="v_exitD" <?php
					if (in_array('v_exitD',$per_new)) {
						echo "checked=checked" ;
					}?> >View
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid25" value="a_exitD" <?php
					if (in_array('a_exitD',$per_new)) {
						echo "checked=checked" ;
					}?> >Add
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid26" value="d_exitD" <?php
					if (in_array('d_exitD',$per_new)) {
						echo "checked=checked" ;
					}?> >Delete
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid27" value="u_exitD" <?php
					if (in_array('u_exitD',$per_new)) {
						echo "checked=checked" ;
					}?> >Update
			</td>
			<td width="12%">
			</td>
			<td width="12%">
			</td>
		
		</tr>
		<tr id="kpi">
			<td align="right" valign="top" width="28%">
				<input name="" onclick="CheckedAll('kpi','kpiChk')" id="kpiChk" type="checkbox" >Key Performance Indicator
			</td>
			
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid28" value="v_kpi" <?php
					if (in_array('v_kpi',$per_new)) {
						echo "checked=checked" ;
					}?> >View
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid29" value="a_kpi" <?php
					if (in_array('a_kpi',$per_new)) {
						echo "checked=checked" ;
					}?> >Add
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid30" value="d_kpi" <?php
					if (in_array('d_kpi',$per_new)) {
						echo "checked=checked" ;
					}?> >Delete
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid31" value="u_kpi" <?php
					if (in_array('u_kpi',$per_new)) {
						echo "checked=checked" ;
					}?> >Update
			</td>
			<td width="12%">
			</td>
			<td width="12%">
			</td>
		
		</tr>
		<tr id="kpiTeam">
			<td align="right" valign="top" width="28%">
				<input name="" onclick="CheckedAll('kpiTeam','kpiChkTem')" id="kpiChkTem" type="checkbox" >Key Performance Indicator For Team
			</td>
			
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid204" value="v_Tkpi" <?php
					if (in_array('v_Tkpi',$per_new)) {
						echo "checked=checked" ;
					}?> >View
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid205" value="a_Tkpi" <?php
					if (in_array('a_Tkpi',$per_new)) {
						echo "checked=checked" ;
					}?> >Add
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid206" value="d_Tkpi" <?php
					if (in_array('d_Tkpi',$per_new)) {
						echo "checked=checked" ;
					}?> >Delete
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid207" value="u_Tkpi" <?php
					if (in_array('u_Tkpi',$per_new)) {
						echo "checked=checked" ;
					}?> >Update
			</td>
			<td width="12%">
			</td>
			<td width="12%">
			</td>
		
		</tr>
		<tr id="lrequest">
			<td align="right" valign="top" width="28%">
				<input name="" onclick="CheckedAll('lrequest','lrequestChk')" id="lrequestChk" type="checkbox" >Leave request
			</td>
			
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid36" value="v_lreq" <?php
					if (in_array('v_lreq',$per_new)) {
						echo "checked=checked" ;
					}?> >View
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid37" value="a_lreq" <?php
					if (in_array('a_lreq',$per_new)) {
						echo "checked=checked" ;
					}?> >Add
			</td>
			<!--<td align="right" width="12%">
			<input name="" type="checkbox" id="chid38" value="d_lreq" <?php
				if (in_array('d_lreq',$per_new))
				{
					echo "checked=checked" ;
				}?>>Delete
			</td>
			<td align="right" width="12%">
			<input name="" type="checkbox" id="chid39" value="u_lreq" <?php
				if (in_array('u_lreq',$per_new))
				{
					echo "checked=checked" ;
				}?> >Update
			</td>-->
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid147" value="ap_lreq" <?php
					if (in_array('ap_lreq',$per_new)) {
						echo "checked=checked" ;
					}?> >Leave Status(App, Unap, Wait,Cancel)
			</td>
			<td width="12%">
				<input name="" type="checkbox" id="chid234" value="sp_lreqs" <?php
					if (in_array('sp_lreqs',$per_new)) {
						echo "checked=checked" ;
					}?> >Special Types of leaves(M, P, Special)
			</td>
		</tr>
		<tr id="lrecord">
			<td align="right" valign="top" width="28%">
				<input name="" onclick="CheckedAll('lrecord','lrecordChk')" id="lrecordChk" type="checkbox" >Leave record
			</td>
			
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid32" value="v_lcal" <?php
					if (in_array('v_lcal',$per_new)) {
						echo "checked=checked" ;
					}?> >View
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid33" value="a_lcal" <?php
					if (in_array('a_lcal',$per_new)) {
						echo "checked=checked" ;
					}?> >Add
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid34" value="d_lcal" <?php
					if (in_array('d_lcal',$per_new)) {
						echo "checked=checked" ;
					}?> >Delete
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid35" value="u_lcal" <?php
					if (in_array('u_lcal',$per_new)) {
						echo "checked=checked" ;
					}?> >Update
			</td>
		</tr>
		<tr id="salaryslip">
			<td align="right" valign="top" width="28%">
				<input name="" onclick="CheckedAll('salaryslip','salaryslipChk')" id="salaryslipChk" type="checkbox" >Salary Slip
			</td>
			
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid40" value="v_salary" <?php
					if (in_array('v_salary',$per_new)) {
						echo "checked=checked" ;
					}?> >View
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid41" value="a_salary"  <?php
					if (in_array('a_salary',$per_new)) {
						echo "checked=checked" ;
					}?> >Add
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid42" value="d_salary"  <?php
					if (in_array('d_salary',$per_new)) {
						echo "checked=checked" ;
					}?> >Delete
			</td>
			<td align="right" width="12%">
				<input name="" type="checkbox" id="chid43" value="u_salary"  <?php
					if (in_array('u_salary',$per_new)) {
						echo "checked=checked" ;
					}?> >Update
			</td>
			<td width="12%">
			</td>
			<td width="12%">
			</td>
		</tr>
	
	</div>
	
	<tr id="">
		<th style="width: 557px;color:blue">
			Withdrawal :
		</th>
	</tr>
	<tr id="carried_forward_leaves">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('carried_forward_leaves','carried_forward_leavesChk')" id="carried_forward_leavesChk" type="checkbox" >Carried Forward leaves
		</td>
		<td align="right" width="18%">
			<input name="" type="checkbox" id="chid213" value="bu_for_leav" <?php
				if (in_array('bu_for_leav',$per_new)) {
					echo "checked=checked" ;
				}?> > Bulk Forward Leaves (Yearly)
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid215" value="car_lea_ba"  <?php
				if (in_array('car_lea_ba',$per_new)) {
					echo "checked=checked" ;
				}?> >Carry Leaves Bank(User:View & Apply)
		</td>
	</tr>
	<tr id="carried_forward_leaves">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('carried_forward_leaves','carried_forward_leavesChk')" id="carried_forward_leavesChk" type="checkbox" >Carried Forward leaves
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid214" value="ca_lea_req"  <?php
				if (in_array('ca_lea_req',$per_new)) {
					echo "checked=checked" ;
				}?> >Cash Leaves Requests (Managment)
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid217" value="ca_pf_req"  <?php
				if (in_array('ca_pf_req',$per_new)) {
					echo "checked=checked" ;
				}?> >Cash PF Requests (Managment)
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid218" value="ca_ltb_req"  <?php
				if (in_array('ca_ltb_req',$per_new)) {
					echo "checked=checked" ;
				}?> >Cash LTB Requests (Managment)
		</td>
	</tr>
	<tr id="cust_profile_view">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('cust_profile_view','cust_profile_viewChk')" id="cust_profile_viewChk" type="checkbox" >Custom Profile View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid216" value="cust_profile_view" <?php
				if (in_array('cust_profile_view',$per_new)) {
					echo "checked=checked" ;
				}?> > Custom Profile View
		</td>
	</tr>
	<tr id="">
		<th style="width: 557px;color:blue">
			Job :
		</th>
	</tr>
	
	<tr id="job">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('job','jobChk')" id="jobChk" type="checkbox" >Job Vacancy
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid44" value="v_job"  <?php
				if (in_array('v_job',$per_new)) {
					echo "checked=checked" ;
				}?> >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid45" value="a_job" <?php
				if (in_array('a_job',$per_new)) {
					echo "checked=checked" ;
				}?> >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid46" value="d_job" <?php
				if (in_array('d_job',$per_new)) {
					echo "checked=checked" ;
				}?> >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid47" value="u_job" <?php
				if (in_array('u_job',$per_new)) {
					echo "checked=checked" ;
				}?> >Update
		</td><br/>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid149" value="ap_job" <?php
				if (in_array('ap_job',$per_new)) {
					echo "checked=checked" ;
				}?> >Applicants View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid150" value="vap_job" <?php
				if (in_array('dap_job',$per_new)) {
					echo "checked=checked" ;
				}?> >Applicants Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid197" value="line_job" <?php
				if (in_array('line_job',$per_new)) {
					echo "checked=checked" ;
				}?> >Lineup
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid198" value="story_job" <?php
				if (in_array('story_job',$per_new)) {
					echo "checked=checked" ;
				}?> >Add Story
		</td>
	
	</tr>
	
	<tr id="jobrefer">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('jobrefer','referChk')" id="referChk" type="checkbox" >Refer Job
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid199" value="refer_jobrefer"  <?php
				if (in_array('refer_jobrefer',$per_new)) {
					echo "checked=checked" ;
				}?> >View
		</td>
	
	
	
	<tr id="">
		<th style="width: 557px;color:blue">
			Management :
		</th>
	</tr>
	<tr id="inv">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('inv','invchk')" id="invchk" type="checkbox" >Inventory
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid175" value="v_inv" <?php
				if (in_array('v_inv',$per_new)) {
					echo "checked=checked" ;
				}?>  >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid176" value="a_inv" <?php
				if (in_array('a_inv',$per_new)) {
					echo "checked=checked" ;
				}?> >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid177" value="d_inv" <?php
				if (in_array('d_inv',$per_new)) {
					echo "checked=checked" ;
				}?> >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid178" value="u_inv" <?php
				if (in_array('u_inv',$per_new)) {
					echo "checked=checked" ;
				}?> >Update
		</td>
		<td width="12%">
		</td>
		<td width="12%">
		</td>
	
	</tr>
	<tr id="MLrequest">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('MLrequest','MLrequestChk')" id="MLrequestChk" type="checkbox" >Leave requests
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid48" value="v_MLreq" <?php
				if (in_array('v_MLreq',$per_new)) {
					echo "checked=checked" ;
				}?> >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid50" value="d_MLreq" <?php
				if (in_array('d_MLreq',$per_new)) {
					echo "checked=checked" ;
				}?> >
			<!--Delete-->
			Action Unapp
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid151" value="s_MLreq" <?php
				if (in_array('s_MLreq',$per_new)) {
					echo "checked=checked" ;
				}?> >Status
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid51" value="u_MLreq" <?php
				if (in_array('u_MLreq',$per_new)) {
					echo "checked=checked" ;
				}?> >Status Update
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid49" value="a_MLreq" <?php
				if (in_array('a_MLreq',$per_new)) {
					echo "checked=checked" ;
				}?> >Data Change
		</td>
		<td width="12%">
			<input name="" type="checkbox" id="chid219" value="full_leav_access" <?php
				if (in_array('full_leav_access',$per_new)) {
					echo "checked=checked" ;
				}?> >Full Data Access
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid235" value="adv_search_access" <?php
				if (in_array('adv_search_access',$per_new)) {
					echo "checked=checked" ;
				}?> >Advanced Search Access
		</td>
	</tr>
	<tr id="MSalary">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('MSalary','MSalaryChk')" id="MSalaryChk" type="checkbox" >Salary
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid52" value="v_MSalary" <?php
				if (in_array('v_MSalary',$per_new)) {
					echo "checked=checked" ;
				}?> >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid53" value="a_MSalary" <?php
				if (in_array('a_MSalary',$per_new)) {
					echo "checked=checked" ;
				}?> >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid54" value="d_MSalary" <?php
				if (in_array('d_MSalary',$per_new)) {
					echo "checked=checked" ;
				}?> >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid55" value="u_MSalary" <?php
				if (in_array('u_MSalary',$per_new)) {
					echo "checked=checked" ;
				}?> >Update
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid152" value="s_MSalary" <?php
				if (in_array('s_MSalary',$per_new)) {
					echo "checked=checked" ;
				}?> >Status
		</td>
		
		<td>
			<input name="" type="checkbox" id="chid148" value="p_salary"  <?php
				if (in_array('p_salary',$per_new)) {
					echo "checked=checked" ;
				}?> >Print
		</td>
		<td>
			<input name="" type="checkbox" id="chid236" value="e_salary"  <?php
				if (in_array('e_salary',$per_new)) {
					echo "checked=checked" ;
				}?> >Get Excel
		</td>
	</tr>
	<tr id="MLpolicy">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('MLpolicy','MLpolicyChk')" id="MLpolicyChk" type="checkbox" >Leave Policy
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid56" value="v_MLpolicy" <?php
				if (in_array('v_MLpolicy',$per_new)) {
					echo "checked=checked" ;
				}?> >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid57" value="a_MLpolicy" <?php
				if (in_array('a_MLpolicy',$per_new)) {
					echo "checked=checked" ;
				}?> >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid58" value="d_MLpolicy" <?php
				if (in_array('d_MLpolicy',$per_new)) {
					echo "checked=checked" ;
				}?> >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid59" value="u_MLpolicy" <?php
				if (in_array('u_MLpolicy',$per_new)) {
					echo "checked=checked" ;
				}?> >Update
		</td>
		<td width="12%">
		</td>
		<td width="12%">
		</td>
	
	</tr>
	<tr id="uploadatt">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('uploadatt','uploadattchk')" id="uploadattchk" type="checkbox" >Upload Attendance
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid195" value="v_uploadatt" <?php
				if (in_array('v_uploadatt',$per_new)) {
					echo "checked=checked" ;
				}?> >Upload
		</td>
		<td width="12%">
		</td>
		<td width="12%">
		</td>
	
	</tr>
	
	<tr id="refer">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('refer','referchk')" id="referchk" type="checkbox" >Manage Refral
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid196" value="v_refer" <?php
				if (in_array('v_refer',$per_new)) {
					echo "checked=checked" ;
				}?> >Access
		</td>
		
		<td width="12%">
		</td>
	</tr>
	
	<tr id="">
		<th style="width: 557px;color:blue">
			Incentive :
		</th>
	</tr>
	<tr id="IAttendace">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('IAttendace','IAttendaceChk')" id="IAttendaceChk" type="checkbox" >Attedance
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid60" value="v_IAtten" <?php
				if (in_array('v_IAtten',$per_new)) {
					echo "checked=checked" ;
				}?> >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid61" value="a_IAtten" <?php
				if (in_array('a_IAtten',$per_new)) {
					echo "checked=checked" ;
				}?> >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid62" value="d_IAtten" <?php
				if (in_array('d_IAtten',$per_new)) {
					echo "checked=checked" ;
				}?> >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid63" value="u_IAtten" <?php
				if (in_array('u_IAtten',$per_new)) {
					echo "checked=checked" ;
				}?> >Update
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid153" value="s_IAtten" <?php
				if (in_array('s_IAtten',$per_new)) {
					echo "checked=checked" ;
				}?> >Status
		</td>
		<td width="12%">
		</td>
	</tr>
	<tr id="IKPI">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('IKPI','IKPIChk')" id="IKPIChk" type="checkbox" >KPI
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid64" value="v_IKPI"  <?php
				if (in_array('v_IKPI',$per_new)) {
					echo "checked=checked" ;
				}?> >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid65" value="a_IKPI" <?php
				if (in_array('a_IKPI',$per_new)) {
					echo "checked=checked" ;
				}?> >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid66" value="d_IKPI" <?php
				if (in_array('d_IKPI',$per_new)) {
					echo "checked=checked" ;
				}?> >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid67" value="u_IKPI" <?php
				if (in_array('u_IKPI',$per_new)) {
					echo "checked=checked" ;
				}?> >Update
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid154" value="s_IKPI" <?php
				if (in_array('s_IKPI',$per_new)) {
					echo "checked=checked" ;
				}?> >Status
		</td>
		<td width="12%">
		</td>
	</tr>
	<tr id="IQPE">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('IQPE','IQPEChk')" id="IQPEChk" type="checkbox" >QPE
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid238" value="v_IQPEI"  <?php
				if (in_array('v_IQPEI',$per_new)) {
					echo "checked=checked" ;
				}?> >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid239" value="a_IQPE" <?php
				if (in_array('a_IQPE',$per_new)) {
					echo "checked=checked" ;
				}?> >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid240" value="d_IQPE" <?php
				if (in_array('d_IQPE',$per_new)) {
					echo "checked=checked" ;
				}?> >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid241" value="u_IQPE" <?php
				if (in_array('u_IQPE',$per_new)) {
					echo "checked=checked" ;
				}?> >Update
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid242" value="s_IQPE" <?php
				if (in_array('s_IQPE',$per_new)) {
					echo "checked=checked" ;
				}?> >Status
		</td>
		<td width="12%">
		</td>
	</tr>
	<tr id="IPerformance">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('IPerformance','IPerformanceChk')" id="IPerformanceChk" type="checkbox" >Performance
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid68" value="v_IPerf"  <?php
				if (in_array('v_IPerf',$per_new)) {
					echo "checked=checked" ;
				}?> >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid69" value="a_IPerf" <?php
				if (in_array('a_IPerf',$per_new)) {
					echo "checked=checked" ;
				}?>  >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid70" value="d_IPerf" <?php
				if (in_array('d_IPerf',$per_new)) {
					echo "checked=checked" ;
				}?>  >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid71" value="u_IPerf" <?php
				if (in_array('u_IPerf',$per_new)) {
					echo "checked=checked" ;
				}?> >Update
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid155" value="s_IPerf" <?php
				if (in_array('s_IPerf',$per_new)) {
					echo "checked=checked" ;
				}?> >Status
		</td>
		<td width="12%">
		</td>
	</tr>
	<tr id="IReferral">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('IReferral','IReferralChk')" id="IReferralChk" type="checkbox" >Referral
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid72" value="v_IRef" <?php
				if (in_array('v_IRef',$per_new)) {
					echo "checked=checked" ;
				}?>  >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid73" value="a_IRef" <?php
				if (in_array('a_IRef',$per_new)) {
					echo "checked=checked" ;
				}?>  >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid74" value="d_IRef" <?php
				if (in_array('d_IRef',$per_new)) {
					echo "checked=checked" ;
				}?>  >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid75" value="u_IRef" <?php
				if (in_array('u_IRef',$per_new)) {
					echo "checked=checked" ;
				}?>  >Update
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid156" value="s_IRef" <?php
				if (in_array('s_IRef',$per_new)) {
					echo "checked=checked" ;
				}?>  >Status
		</td>
		<td width="12%">
		</td>
	</tr>
	<tr id="">
		<th style="width: 557px;color:blue">
			Master :
		</th>
	</tr>
	<tr id="MAssets">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('MAssets','MAssetsChk')" id="MAssetsChk" type="checkbox" >Asset
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid76" value="v_MAssets" <?php
				if (in_array('v_MAssets',$per_new)) {
					echo "checked=checked" ;
				}?> >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid77" value="a_MAssets" <?php
				if (in_array('a_MAssets',$per_new)) {
					echo "checked=checked" ;
				}?>  >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid78" value="d_MAssets" <?php
				if (in_array('d_MAssets',$per_new)) {
					echo "checked=checked" ;
				}?>  >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid79" value="u_MAssets" <?php
				if (in_array('u_MAssets',$per_new)) {
					echo "checked=checked" ;
				}?> >Update
		</td>
		<td width="12%">
		</td>
		<td width="12%">
		</td>
	
	</tr>
	<tr id="MChecklist">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('MChecklist','MChecklistChk')" id="MChecklistChk" type="checkbox" value="" >Checklist
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid80" value="v_MCheckl" <?php
				if (in_array('v_MCheckl',$per_new)) {
					echo "checked=checked" ;
				}?> >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid81" value="a_MCheckl" <?php
				if (in_array('a_MCheckl',$per_new)) {
					echo "checked=checked" ;
				}?>  >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid82" value="d_MCheckl" <?php
				if (in_array('d_MCheckl',$per_new)) {
					echo "checked=checked" ;
				}?>  >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid83" value="u_MCheckl" <?php
				if (in_array('u_MCheckl',$per_new)) {
					echo "checked=checked" ;
				}?> >Update
		</td>
		<td width="12%">
		</td>
		<td width="12%">
		</td>
	
	</tr>
	<tr id="MDepartment">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('MDepartment','MDepartmentChk')" id="MDepartmentChk" type="checkbox" >Department
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid84" value="v_MDep" <?php
				if (in_array('v_MDep',$per_new)) {
					echo "checked=checked" ;
				}?> >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid85" value="a_MDep" <?php
				if (in_array('a_MDep',$per_new)) {
					echo "checked=checked" ;
				}?> >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid86" value="d_MDep" <?php
				if (in_array('d_MDep',$per_new)) {
					echo "checked=checked" ;
				}?> >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid87" value="u_MDep" <?php
				if (in_array('u_MDep',$per_new)) {
					echo "checked=checked" ;
				}?> >Update
		</td>
		<td width="12%">
		</td>
		<td width="12%">
		</td>
	
	</tr>
	<tr id="MDesignation">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('MDesignation','MDesignationChk')" id="MDesignationChk" type="checkbox" >Designation
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid88" value="v_MDesi" <?php
				if (in_array('v_MDesi',$per_new)) {
					echo "checked=checked" ;
				}?> >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid89" value="a_MDesi" <?php
				if (in_array('a_MDesi',$per_new)) {
					echo "checked=checked" ;
				}?> >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid90" value="d_MDesi" <?php
				if (in_array('d_MDesi',$per_new)) {
					echo "checked=checked" ;
				}?> >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid91" value="u_MDesi" <?php
				if (in_array('u_MDesi',$per_new)) {
					echo "checked=checked" ;
				}?> >Update
		</td>
		<td width="12%">
		</td>
		<td width="12%">
		</td>
	
	</tr>
	<tr id="compensation">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('compensation','compensationchk')" id="compensationchk" type="checkbox" >Compensation Type
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid191" value="v_compensation" <?php
				if (in_array('v_compensation',$per_new)) {
					echo "checked=checked" ;
				}?> >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid192" value="a_compensation" <?php
				if (in_array('a_compensation',$per_new)) {
					echo "checked=checked" ;
				}?> >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid193" value="d_compensation" <?php
				if (in_array('d_compensation',$per_new)) {
					echo "checked=checked" ;
				}?> >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid194" value="u_compensation" <?php
				if (in_array('u_compensation',$per_new)) {
					echo "checked=checked" ;
				}?> >Update
		</td>
		<td width="12%">
		</td>
		<td width="12%">
		</td>
	
	</tr>
	<tr id="MEQuestion">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('MEQuestion','MEQuestionChk')" id="MEQuestionChk" type="checkbox" >Exit Questions
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid92" value="v_MEQues" <?php
				if (in_array('v_MEQues',$per_new)) {
					echo "checked=checked" ;
				}?> >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid93" value="a_MEQues" <?php
				if (in_array('a_MEQues',$per_new)) {
					echo "checked=checked" ;
				}?> >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid94" value="d_MEQues" <?php
				if (in_array('d_MEQues',$per_new)) {
					echo "checked=checked" ;
				}?> >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid95" value="u_MEQues" <?php
				if (in_array('u_MEQues',$per_new)) {
					echo "checked=checked" ;
				}?> >Update
		</td>
		<td width="12%">
		</td>
		<td width="12%">
		</td>
	
	</tr>
	
	<tr id="MLtype">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('MLtype','MLtypeChk')" id="MLtypeChk" type="checkbox" >Leave Type
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid96" value="v_MLtype" <?php
				if (in_array('v_MLtype',$per_new)) {
					echo "checked=checked" ;
				}?>  >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid97" value="a_MLtype" <?php
				if (in_array('a_MLtype',$per_new)) {
					echo "checked=checked" ;
				}?> >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid98" value="d_MLtype" <?php
				if (in_array('d_MLtype',$per_new)) {
					echo "checked=checked" ;
				}?> >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid99" value="u_MLtype" <?php
				if (in_array('u_MLtype',$per_new)) {
					echo "checked=checked" ;
				}?>  >Update
		</td>
		<td width="12%">
		</td>
		<td width="12%">
		</td>
	
	</tr>
	<tr id="MLocation">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('MLocation','MLocationChk')" id="MLocationChk" type="checkbox" >Location
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid100" value="v_MLoc" <?php
				if (in_array('v_MLoc',$per_new)) {
					echo "checked=checked" ;
				}?>  >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid101" value="a_MLoc" <?php
				if (in_array('a_MLoc',$per_new)) {
					echo "checked=checked" ;
				}?> >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid102" value="d_MLoc" <?php
				if (in_array('d_MLoc',$per_new)) {
					echo "checked=checked" ;
				}?> >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid103" value="u_MLoc" <?php
				if (in_array('u_MLoc',$per_new)) {
					echo "checked=checked" ;
				}?> >Update
		</td>
		<td width="12%">
		</td>
		<td width="12%">
		</td>
	
	</tr>
	<tr id="MEStatus">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('MEStatus','MEStatusChk')" id="MEStatusChk" type="checkbox" >Employee Status
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid104" value="v_MEStatus" <?php
				if (in_array('v_MEStatus',$per_new)) {
					echo "checked=checked" ;
				}?>  >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid105" value="a_MEStatus" <?php
				if (in_array('a_MEStatus',$per_new)) {
					echo "checked=checked" ;
				}?>  >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid106" value="d_MEStatus" <?php
				if (in_array('d_MEStatus',$per_new)) {
					echo "checked=checked" ;
				}?>  >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid107" value="u_MEStatus" <?php
				if (in_array('u_MEStatus',$per_new)) {
					echo "checked=checked" ;
				}?>  >Update
		</td>
		<td width="12%">
		</td>
		<td width="12%">
		</td>
	
	</tr>
	<tr id="MPFKPI">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('MPFKPI','MPFKPIChk')" id="MPFKPIChk" type="checkbox" >Parameters for KPI
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid108" value="v_MPFKPI" <?php
				if (in_array('v_MPFKPI',$per_new)) {
					echo "checked=checked" ;
				}?>  >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid109" value="a_MPFKPI" <?php
				if (in_array('a_MPFKPI',$per_new)) {
					echo "checked=checked" ;
				}?> >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid110" value="d_MPFKPI" <?php
				if (in_array('d_MPFKPI',$per_new)) {
					echo "checked=checked" ;
				}?> >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid111" value="u_MPFKPI" <?php
				if (in_array('u_MPFKPI',$per_new)) {
					echo "checked=checked" ;
				}?> >Update
		</td>
		<td width="12%">
		</td>
		<td width="12%">
		</td>
	
	</tr>
	<tr id="MRFLeaving">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('MRFLeaving','MRFLeavingChk')" id="MRFLeavingChk" type="checkbox" >Reason For Leaving
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid112" value="v_MRFLeav" <?php
				if (in_array('v_MRFLeav',$per_new)) {
					echo "checked=checked" ;
				}?>  >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid113" value="a_MRFLeav" <?php
				if (in_array('a_MRFLeav',$per_new)) {
					echo "checked=checked" ;
				}?> >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid114" value="d_MRFLeav" <?php
				if (in_array('d_MRFLeav',$per_new)) {
					echo "checked=checked" ;
				}?> >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid115" value="u_MRFLeav" <?php
				if (in_array('u_MRFLeav',$per_new)) {
					echo "checked=checked" ;
				}?> >Update
		</td>
		<td width="12%">
		</td>
		<td width="12%">
		</td>
	
	</tr>
	<tr id="MRelationship">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('MRelationship','MRelationshipChk')" id="MRelationshipChk" type="checkbox" >Relationship
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid116" value="v_MRelation" <?php
				if (in_array('v_MRelation',$per_new)) {
					echo "checked=checked" ;
				}?> >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid117" value="a_MRelation" <?php
				if (in_array('a_MRelation',$per_new)) {
					echo "checked=checked" ;
				}?> >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid118" value="d_MRelation" <?php
				if (in_array('d_MRelation',$per_new)) {
					echo "checked=checked" ;
				}?> >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid119" value="u_MRelation" <?php
				if (in_array('u_MRelation',$per_new)) {
					echo "checked=checked" ;
				}?> >Update
		</td>
		<td width="12%">
		</td>
		<td width="12%">
		</td>
	
	</tr>
	<tr id="MSOHire">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('MSOHire','MSOHireChk')" id="MSOHireChk" type="checkbox" >Source Of Hire
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid120" value="v_MSOHire" <?php
				if (in_array('v_MSOHire',$per_new)) {
					echo "checked=checked" ;
				}?>  >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid121" value="a_MSOHire" <?php
				if (in_array('a_MSOHire',$per_new)) {
					echo "checked=checked" ;
				}?> >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid122" value="d_MSOHire" <?php
				if (in_array('d_MSOHire',$per_new)) {
					echo "checked=checked" ;
				}?> >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid123" value="u_MSOHire" <?php
				if (in_array('u_MSOHire',$per_new)) {
					echo "checked=checked" ;
				}?> >Update
		</td>
		<td width="12%">
		</td>
		<td width="12%">
		</td>
	
	</tr>
	
	<tr id="empshift">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('empshift','empshiftchk')" id="empshiftchk" type="checkbox" >Employee Shift
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid171" value="v_empshift" <?php
				if (in_array('v_empshift',$per_new)) {
					echo "checked=checked" ;
				}?>  >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid172" value="a_empshift" <?php
				if (in_array('a_empshift',$per_new)) {
					echo "checked=checked" ;
				}?>  >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid173" value="d_empshift" <?php
				if (in_array('d_empshift',$per_new)) {
					echo "checked=checked" ;
				}?>  >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid174" value="u_empshift" <?php
				if (in_array('u_empshift',$per_new)) {
					echo "checked=checked" ;
				}?>  >Update
		</td>
		<td width="12%">
		</td>
		<td width="12%">
		</td>
	
	</tr>
	
	<tr id="edu">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('edu','educhk')" id="educhk" type="checkbox" >Education
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid179" value="v_edu" <?php
				if (in_array('v_edu',$per_new)) {
					echo "checked=checked" ;
				}?>  >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid180" value="a_edu" <?php
				if (in_array('a_edu',$per_new)) {
					echo "checked=checked" ;
				}?> >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid181" value="d_edu" <?php
				if (in_array('d_edu',$per_new)) {
					echo "checked=checked" ;
				}?> >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid182" value="u_edu" <?php
				if (in_array('u_edu',$per_new)) {
					echo "checked=checked" ;
				}?> >Update
		</td>
		<td width="12%">
		</td>
		<td width="12%">
		</td>
	
	</tr>
	<tr id="bra">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('bra','brachk')" id="brachk" type="checkbox" >Branch
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid183" value="v_bra" <?php
				if (in_array('v_bra',$per_new)) {
					echo "checked=checked" ;
				}?> >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid184" value="a_bra" <?php
				if (in_array('a_bra',$per_new)) {
					echo "checked=checked" ;
				}?> >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid185" value="d_bra" <?php
				if (in_array('d_bra',$per_new)) {
					echo "checked=checked" ;
				}?> >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid186" value="u_bra" <?php
				if (in_array('u_bra',$per_new)) {
					echo "checked=checked" ;
				}?> >Update
		</td>
		<td width="12%">
		</td>
		<td width="12%">
		</td>
	
	</tr>
	<tr id="doc">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('doc','docchk')" id="docchk" type="checkbox" >Document
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid187" value="v_doc" <?php
				if (in_array('v_doc',$per_new)) {
					echo "checked=checked" ;
				}?>  >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid188" value="a_doc" <?php
				if (in_array('a_doc',$per_new)) {
					echo "checked=checked" ;
				}?> >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid189" value="d_doc" <?php
				if (in_array('d_doc',$per_new)) {
					echo "checked=checked" ;
				}?> >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid190" value="u_doc" <?php
				if (in_array('u_doc',$per_new)) {
					echo "checked=checked" ;
				}?> >Update
		</td>
		<td width="12%">
		</td>
		<td width="12%">
		</td>
	
	</tr>
	<tr id="esalary">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('esalary','empsChk')" id="empsChk" type="checkbox" >Salary Profile
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid136" value="v_emps" <?php
				if (in_array('v_emps',$per_new)) {
					echo "checked=checked" ;
				}?> >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid137" value="a_emps" <?php
				if (in_array('a_emps',$per_new)) {
					echo "checked=checked" ;
				}?> >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid138" value="d_emps" <?php
				if (in_array('d_emps',$per_new)) {
					echo "checked=checked" ;
				}?> >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid139" value="u_emps" <?php
				if (in_array('u_emps',$per_new)) {
					echo "checked=checked" ;
				}?> >Update
		</td>
		<td width="12%">
		</td>
		<td width="12%">
		</td>
	</tr>
	<tr id="team">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('team','teamChk')" id="teamChk" type="checkbox" >Team
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid209" value="v_team" <?php
				if (in_array('v_team',$per_new)) {
					echo "checked=checked" ;
				}?> >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid210" value="a_team" <?php
				if (in_array('a_team',$per_new)) {
					echo "checked=checked" ;
				}?> >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid211" value="d_team" <?php
				if (in_array('d_team',$per_new)) {
					echo "checked=checked" ;
				}?> >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid212" value="u_team" <?php
				if (in_array('u_team',$per_new)) {
					echo "checked=checked" ;
				}?> >Update
		</td>
		<td width="12%">
		</td>
		<td width="12%">
		</td>
	</tr>
	
	<tr id="">
		<th style="width: 557px;color:blue">
			Company Profile:
		</th>
	</tr>
	<tr id="companyd">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('companyd','cmpdChk')" id="cmpdChk" type="checkbox" >Company details
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid157" value="v_cmpd"  <?php
				if (in_array('v_cmpd',$per_new)) {
					echo "checked=checked" ;
				}?> >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid158" value="a_cmpd" <?php
				if (in_array('a_cmpd',$per_new)) {
					echo "checked=checked" ;
				}?> >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid159" value="d_cmpd" <?php
				if (in_array('d_cmpd',$per_new)) {
					echo "checked=checked" ;
				}?> >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid160" value="u_cmpd" <?php
				if (in_array('u_cmpd',$per_new)) {
					echo "checked=checked" ;
				}?> >Update
		</td><br/>
		<td width="12%">
		</td>
		<td width="12%">
		</td>
	</tr>
	<tr id="companyp">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('companyp','cmppChk')" id="cmppChk" type="checkbox" >Company Policy
		</td>
		
		<td align="right">
			<input name="" type="checkbox" id="chid161" value="v_cmpp"  <?php
				if (in_array('v_cmpp',$per_new)) {
					echo "checked=checked" ;
				}?> >View
		</td>
		<td align="right">
			<input name="" type="checkbox" id="chid162" value="a_cmpp" <?php
				if (in_array('a_cmpp',$per_new)) {
					echo "checked=checked" ;
				}?> >Add
		</td>
		<td width="12%">
		</td>
		<td width="12%">
		</td>
		<td width="12%">
		</td>
		<td width="12%">
		</td>
	</tr>
	
	<tr id="">
		<th style="width: 557px;color:blue">
			Calender:
		</th>
	</tr>
	
	<tr id="hlcalendar">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('hlcalendar','hlcalendarChk')" id="hlcalendarChk" type="checkbox" > Holiday  Schedule
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid229" value="v_hlcal" <?php
				if (in_array('v_hlcal',$per_new)) {
					echo "checked=checked" ;
				}?> >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid230" value="a_hlcal" <?php
				if (in_array('a_hlcal',$per_new)) {
					echo "checked=checked" ;
				}?> >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid231" value="d_hlcal" <?php
				if (in_array('d_hlcal',$per_new)) {
					echo "checked=checked" ;
				}?> >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid232" value="u_hlcal" <?php
				if (in_array('u_hlcal',$per_new)) {
					echo "checked=checked" ;
				}?> >Update
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid233" value="up_hlcal" <?php
				if (in_array('up_hlcal',$per_new)) {
					echo "checked=checked" ;
				}?> >Upload
		</td>
		<td width="12%">
		</td>
	</tr>
	<tr id="ecal">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('ecal','ecalChk')" id="ecalChk" type="checkbox" > Event Calendar
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid200" value="v_ecal"  <?php
				if (in_array('v_ecal',$per_new)) {
					echo "checked=checked" ;
				}?> >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid201" value="a_ecal" <?php
				if (in_array('a_ecal',$per_new)) {
					echo "checked=checked" ;
				}?> >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid202" value="d_ecal" <?php
				if (in_array('d_ecal',$per_new)) {
					echo "checked=checked" ;
				}?> >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid203" value="u_ecal" <?php
				if (in_array('u_ecal',$per_new)) {
					echo "checked=checked" ;
				}?> >Update
		</td><br/>
		<td width="12%">
		</td>
		<td width="12%">
		</td>
	</tr>
	
	<tr id="slcalendar">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('slcalendar','slcalendarChk')" id="slcalendarChk" type="checkbox" >   Special (Market OFF)
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid225" value="v_slcal" <?php
				if (in_array('v_slcal',$per_new)) {
					echo "checked=checked" ;
				}?> >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid226" value="a_slcal" <?php
				if (in_array('a_slcal',$per_new)) {
					echo "checked=checked" ;
				}?> >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid227" value="d_slcal" <?php
				if (in_array('d_slcal',$per_new)) {
					echo "checked=checked" ;
				}?> >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid228" value="u_slcal" <?php
				if (in_array('u_slcal',$per_new)) {
					echo "checked=checked" ;
				}?> >Update
		</td>
		<td align="right" width="12%">
		
		</td>
		<td width="12%">
		</td>
	</tr>
	<tr id="">
		<th style="width: 557px;color:blue">
			Manage Profile :
		</th>
	</tr>
	<tr id="managerole">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('managerole','roleChk')" id="roleChk" type="checkbox" >Roles
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chi163" value="vv_role"  <?php
				if (in_array('vv_role',$per_new)) {
					echo "checked=checked" ;
				}?> >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid164" value="a_role" <?php
				if (in_array('a_role',$per_new)) {
					echo "checked=checked" ;
				}?> >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid165" value="d_role" <?php
				if (in_array('d_role',$per_new)) {
					echo "checked=checked" ;
				}?> >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid166" value="u_role" <?php
				if (in_array('u_role',$per_new)) {
					echo "checked=checked" ;
				}?> >Update
		</td><br/>
	</tr>
	<tr id="accesscontrol">
		<td align="right" valign="top" width="28%">
			<input name="" onclick="CheckedAll('accesscontrol','accessChk')" id="accessChk" type="checkbox" >Access Control
		</td>
		
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid167" value="v_access"  <?php
				if (in_array('v_access',$per_new)) {
					echo "checked=checked" ;
				}?> >View
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid168" value="a_access" <?php
				if (in_array('a_access',$per_new)) {
					echo "checked=checked" ;
				}?> >Add
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid169" value="d_access" <?php
				if (in_array('d_access',$per_new)) {
					echo "checked=checked" ;
				}?> >Delete
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid170" value="u_access" <?php
				if (in_array('u_access',$per_new)) {
					echo "checked=checked" ;
				}?> >Update
		</td><br/>
	</tr>
	    <tr id="">
		<th style="width: 557px;color:blue">
			Daily Attendance :
		</th>
	</tr>
    <tr id="accessdailyattendance">
    	<td align="right" width="20%">
			<input name="" type="checkbox" id="chid249" value="atten_show"  <?php
			if (in_array('atten_show',$per_new)) {
				echo "checked=checked";
			}?> >Show Attendance Button
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid250" value="atten_excel"  <?php
			if (in_array('atten_excel',$per_new)) {
				echo "checked=checked";
			}?> >Attendance Excel Download
		</td>
		<td align="right" width="50%">
			<input name="" type="checkbox" id="chid251" value="atten_show_all"  <?php
			if (in_array('atten_show_all',$per_new)) {
				echo "checked=checked";
			}?> >Show All Attendance (For Admin User)
		</td>
		<td align="right" width="20%">
			<input name="" type="checkbox" id="chid258" value="admin_team_view"  <?php
			if (in_array('admin_team_view',$per_new)) {
				echo "checked=checked";
			}?> >Admin Team View
		</td>

		<td align="right" width="20%">
			<input name="" type="checkbox" id="chid257" value="admin_edit_old"  <?php
			if (in_array('admin_edit_old',$per_new)) {
				echo "checked=checked";
			}?> >Admin Edit Old
		</td>
	</tr>
	 <tr id="accessdailyattendance">
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid252" value="atten_maneger"  <?php
			if (in_array('atten_maneger',$per_new)) {
				echo "checked=checked";
			}?> >Manegers Attendance 
		</td>
		<td align="right" width="12%">
			<input name="" type="checkbox" id="chid253" value="atten_user"  <?php
			if (in_array('atten_user',$per_new)) {
				echo "checked=checked";
			}?> >User Attendance 
		</td>
		<td align="right" width="20%">
			<input name="" type="checkbox" id="chid254" value="atten_submit"  <?php
			if (in_array('atten_submit',$per_new)) {
				echo "checked=checked";
			}?> >Submit Attendance 
		</td>
		<td align="right" width="20%">
			<input name="" type="checkbox" id="chid255" value="user_team_list"  <?php
			if (in_array('user_team_list',$per_new)) {
				echo "checked=checked";
			}?> >User Team List 
		</td>
		<td align="right" width="20%">
			<input name="" type="checkbox" id="chid256" value="user_edit_old"  <?php
			if (in_array('user_edit_old',$per_new)) {
				echo "checked=checked";
			}?> >User Edit Old
		</td>
    </tr>
	<input type="hidden" value="1" id="maxi">
	<tr>
		<td colspan="4" style="text-align:center">
			<button class="button green" onclick="SaveData('<?php echo $url ?>','chid','259','','','','<?php echo $x ?>');">
				<i class="save-icon">
				</i>Save
			</button>
			<button class="button gray" onclick="ToggleBox('viewContent','none','');ToggleBox('manipulateContent','block','')">
				<i class="close-icon">
				</i>Cancel
			</button>
		</td>
	
	</tr>
	<tr>
		<td width="28%">
			<br/><br/><br/><br/>
		</td>
	</tr>
</table>