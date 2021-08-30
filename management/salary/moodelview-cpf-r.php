<?php
include("../../include/conFig.php");
error_reporting(0);
//crlid:crlid,eid:eid,ttype:ttype,type:val,cno:cno

$Y = date('Y', strtotime('-1 years'));

$employeepre = mysql_query("SELECT `employee`.`name`, `emp_pf_with`.`id`, `emp_pf_with`.`eid`, `emp_pf_with`.`instalment`, `emp_pf_with`.`amount`, `emp_pf_with`.`checkno`, `emp_pf_with`.`createdate`, `emp_pf_with`.`modifieddate`, `emp_pf_with`.`modifiedby`, `emp_pf_with`.`status`, `emp_pf_with`.`extra` FROM `emp_pf_with`,`employee` WHERE `emp_pf_with`.`eid`=`employee`.`id`",$con);
$instalment=0;
$count=1;
$table="";
while($rowemployeepre = mysql_fetch_array($employeepre))
	{
		$instalments=$rowemployeepre["instalment"];
		$amount=$rowemployeepre["amount"];
		$checkno=$rowemployeepre["checkno"];
		$id=$rowemployeepre["id"];
		$createdate=$rowemployeepre["createdate"];
		$modifieddate=$rowemployeepre["modifieddate"];
		$status=$rowemployeepre["status"];
		$name=$rowemployeepre["name"];
		$eid=$rowemployeepre["eid"];
		
		if($status==0)
		{
			$instalment+=$rowemployeepre["instalment"];
			$stat_msg="<span style='color:blue'>Waiting</span>";
			$action=<<<AAA
						<button class="button green" onclick="update_withstat($id,$eid,1,1)">Approve</button>
						<button class="button red" onclick="update_withstat($id,$eid,2,1)">Reject</button>
AAA;
		}else if($status==1)
		{
			$instalment+=$rowemployeepre["instalment"];
			$stat_msg="<span style='color:green'>Approved</span>";
			$action="<span style='color:green'>Check Number : $checkno (On $modifieddate)</span>";
		}else if($status==3)
		{
			$stat_msg="<span style='color:red'>Rejected</span>";
			$action="<span style='color:red'>Already Rejected</span>";
		}else{
			$action=<<<AAA
				<span style='color:green'>
					<div class="input-group">
                        <input class="form-control" type="text" id="checknumber_$id" placeholder="Enter Check No.">
                       
                        <span class="input-group-btn">
                            <button class="btn blue" type="button"  onclick="update_withstat($id,$eid,3,1)">Update!</button>
                        </span>
                    </div>
                </span>
AAA;
$stat_msg="<span style='color:green'>Approved</span>";
		}

		$table.=<<<AAA
				<tr>
					<td>$count</td>
					<td>$name</td>
					<td>Rs. $amount</td>
					<td>$instalments</td>
					<td>$createdate</td>
					<td>$stat_msg</td>
					<td>$action</td>
					<td><div class="button green" style="cursor:pointer;padding:4px;" onclick="getModule('management/salary/story/view?eid=$eid&amp;name=$name','manipulatemoodleContent','viewmoodleContent','Story Line')">Story</div></td>
				</tr>
AAA;
		$count++;
	}
?>
<div id="myTitle">
<div class="title">PF Cash</div>
<div class="strip">
<span>Dashboard</span>
<span>Profile</span>
<span>PF Cash</span>
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
			<tr>
				<th>No.</th>
				<th>Name</th>
				<th>Amount</th>
				<th>Instalments</th>
				<th>Applied On</th>
				<th>Status</th>
				<th>Action</th>
				<th>Story</th>
			</tr>
			<tr>
				<?=$table?>
			</tr>
		</table>
</div>


</div>