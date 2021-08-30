<?php
include("../include/conFig.php");
error_reporting(0);

if(isset($_GET['tot_val']))
{
	$tot_val=$_GET['tot_val'];
	$aptot_val=$_GET['aptot_val'];
	$id=$_GET['id'];
		if($aptot_val<=18 AND $aptot_val>=7)
		{
	mysql_query("UPDATE `carry_leavelog` SET `leaves_cashed`='$aptot_val',`leaves_cash_date`='$datetime', `modifieddate`='$datetime',`updatedby`='$hrmloggedid', `cash_status`='3' WHERE `id`='$id'");
			
	$note="Applied to Cash $aptot_val Yearly leaves out of  $tot_val leaves carried from last year";
		
	mysql_query("INSERT INTO `story`(`subject`, `note`, `employee`, `type`, `updatedby`) VALUES ('Applied to Cash Yearly leaves', '$note', '$hrmloggedid', 7, '$hrmloggedid')",$con) or die(mysql_error());
		}else{
			echo "<h2>Leave Encash Criteria Not Fulfilled (Min-7, Max-18)</h2>";
		}
}
$Y = date('Y', strtotime('-1 years'));
$sql_log = "SELECT `id`, `userid`, `of_year`, `leaves_carried`, `leaves_cashed`, `leaves_cash_date`, `leaves_cash_approvedby`, `createdate`, `modifieddate`, `updatedby`, `delete_val`, `cash_status`, `installments` FROM `carry_leavelog` WHERE `userid`='$hrmloggedid' AND `delete_val`!='1' ORDER BY `id` DESC";
// `of_year`='$Y' AND
$getsql_log = mysql_query($sql_log,$con) or die(mysql_error());


?>
<div id="myTitle">
<div class="title">Carry Leaves Bank</div>
<div class="strip">
<span>Dashboard</span>
<span>Profile</span>
<span>Carry Leaves Bank</span>
<span>View</span>
</div>
</div>
<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
</td>
</tr>
</table>
<div style="height:400px;overflow-x:hidden;overflow-y:scroll" id="mainDivId">
<div id="mainsmall_view_tab">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable" border="1" style="text-align:center">
	<tr style='text-align: center'>
		<th>Leaves Bank</th>
		<th>Leaves Incash</th>
		<th>Year</th>
		<th>Status</th>
		<th>Action</th>
	</tr>
	
<?php
	$tabSignles="";
$counter=0;
while($rowlogl =mysql_fetch_array($getsql_log)){
$leaves_carried=$rowlogl["leaves_carried"];
$leaves_cashed=$rowlogl["leaves_cashed"];
$id=$rowlogl["id"];
$of_year=$rowlogl["of_year"];
$leaves_cash_date=$rowlogl["leaves_cash_date"];
$leaves_cash_approvedby=$rowlogl["leaves_cash_approvedby"];
$cash_status=$rowlogl["cash_status"];
$modifieddate=$rowlogl["modifieddate"];
$cno=$rowlogl["installments"];
	$action="";
	$status="";
	$actionSing="";
if($cash_status==1)
	{
		$status="<span style='color:green'>Leaves Encashed </span>";
		$action="<span style='color:green'>Already Applied (Waiting For check No.)</span>";
		$actionSing="<span style='color:green'>Already Applied </span>";
	}else if($cash_status==2)
		{
			$status="<span style='color:Red'>Rejected </span>";
			$action="<span style='color:Red'>Already Applied</span>";
			$actionSing="<span style='color:green'>Already Applied </span>";
		}else if($cash_status==3)
			{
				$status="<span style='color:orange'>Applied</span>";
				$action="<span style='color:orange'>Already Applied</span>";
				$actionSing="<span style='color:green'>Already Applied </span>";
			}else if($cash_status==4)
				{
					$status="<span style='color:green'>Approved </span>";
					$action="<span style='color:green'>Check Number : $cno (On $modifieddate)</span>";
					$actionSing="<span style='color:green'>Already Applied </span>";
				}else if($rowlogl!="" AND $leaves_carried>=7)
					{
						if($counter==0) {
						
						
						$status="<span style='color:blue'>Carry Forwarded</span>";
						$action=<<<AAA
										<button class="button green" onclick="$('#mainsmall_view_form$id').show();$('#mainsmall_view_tab').hide();">Apply</button>
AAA;
						$actionSing=<<<AAA
									<button class="button green" onclick="var tot_val=document.getElementById('nolwant_leave_tot$id').value; var aptot_val=document.getElementById('nolwant_leave$id').value; if((parseInt(tot_val)<parseInt(aptot_val)) || (parseInt(aptot_val)==null) || (parseInt(aptot_val)==0)|| (parseInt(aptot_val)<7)){alert('Minimum 7 Leave Required for Encash');}else if(parseInt(aptot_val)>18){alert('Maximum 18 Leaves can be Encashed');}else{getModule('profile/moodelview-cleave-r?tot_val='+tot_val+'&aptot_val='+aptot_val+'&id='+$id,'manipulatemoodleContent','viewmoodleContent','');}">Apply</button>
AAA;
						}else{
							$status="<span style='color:orange'>Expired</span>";
							$action="<span style='color:orange'>Expired</span>";
							$actionSing="<span style='color:orange'>Expired</span>";
					}
					}
		echo $tab=<<<AAA
						<tr>
							
							<td>$leaves_carried</td>
							<td>$leaves_cashed</td>
							<td>$of_year</td>
							<td>$status</td>
							<td>$action</td>
						</tr>
AAA;

		
		$tabSignles.=<<<AAA
						<div id="mainsmall_view_form$id" style="display:none">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable" border="1" style="text-align:center">
	<tr>
		<th>Year</th>
		<th>Leaves Bank</th>
		<th>Leaves Incash</th>
		<th>Action</th>
	</tr>
						<tr>
							<td>$of_year </td>
									<td>
										$leaves_carried
										<input type="hidden" id="nolwant_leave_tot$id" value="$leaves_carried" onchange="">
									</td>
				<td>
										<input type="number" id="nolwant_leave$id" value='0' onchange="var tot_val=document.getElementById('nolwant_leave_tot$id').value; if(parseInt(tot_val)<this.value){alert('Please Enter Valid Value');}" max="18" min="7">
				</td>
									<td>$actionSing</td>
						</tr>
							</table>
						</div>
AAA;
	$counter++;
}


?>
</table>
</div>
<?=$tabSignles?>
</div>