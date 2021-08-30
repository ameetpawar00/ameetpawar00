<?php include("../../include/conFig.php");
$sql = "SELECT employee.id, employee.empid, employee.name, employee.workemail, employee.mobile, designation.name, employee.doj, department.name as dname, employeestatus.name as estat , employee.role, employee.l_allotstatus, rolls.name as rname,leaverecord.EL as ELt, leaverecord.CL as CLt, leaverecord.SL as SLt FROM employee, designation, department, employeestatus,rolls,leaverecord WHERE employee.delete = 0 AND employee.active = 1 AND employee.designation= designation.id AND employee.department= department.id AND employee.empstatus= employeestatus.id AND employee.role= rolls.id AND employee.id= leaverecord.userid";
$getData = mysql_query($sql,$con) or die(mysql_error());


// FROM employee, designation, department, rolls, WHERE employee.delete = '0' AND employee.active = '1' AND employee.designation= designation.id AND employee.department= department.id AND employee.id= leaverecord.userid AND employee.empstatus
?>
<div id="myTitle">
<div class="title"> Bulk Forward Leaves</div>
<div class="strip">
<span>Dashboard</span>
<span> Bulk Forward Leaves</span>
<span>View</span>
</div>
</div>

<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
	<input id="mainChk" name="Checkbox1" type="checkbox" style="display: none;"/>
	<button class="button red" onclick="if(document.getElementById('mainChk').checked == true){document.getElementById('mainChk').checked = false;}else{document.getElementById('mainChk').checked = true;}chkAll('chBx','mainChk')">Select All</button>
	<button class="button green" onclick="var r=confirm('Are You Sure Want to Carry These leaves To Next Year. .??'); if(r==true){update_leave_bank('','','',1)}">Submit All</button>
	
	<br>
	<br>
	<input type="hidden" id="myInput" class="input" onkeyup="myFunction()" placeholder="Search for names..">
</td>
</tr>
</table>
<div id="directResult" style="height:350px;overflow:auto">
<style>
.ncolor tr.d1 td ,.ncolor tr.d0 td {
    background: none!important;}

</style>
<table  class="display dataTable abab table-bordered" width="100%" cellspacing="0"  id="myTable_new" style="width: 100%;padding-bottom: 70px;">
	<thead>
		<tr>
			<th style="height: 30px">Empid</th>
			<th style="height: 30px">Name </th>
			<th style="height: 30px">Date of Joining (DOJ)</th>
			<th style="height: 30px">To be carried</th>
		</tr>
	</thead>
	<tfoot style="display: table-header-group;position: relative;top: 0px;">
		<th style="height: 30px"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" />Empid</th>
		<th style="height: 30px">Name</th>
		<th style="height: 30px">Date of Joining (DOJ)</th>
		<th style="height: 30px">To be carried</th>
	</tfoot>
	<tbody>
<?php
$i = 1;
$sql .=" order by employee.name ASC";
$values = mysql_query($sql,$con)or die(mysql_error());
$Y = date('Y', strtotime('-1 years'));
$sql_log = "SELECT `userid` FROM `carry_leavelog` WHERE `of_year`='$Y' AND `delete_val`!='1'";
$getsql_log = mysql_query($sql_log,$con) or die(mysql_error());
$check_u_f_l=array();
while($rowlog =mysql_fetch_array($getsql_log))
{
	$check_u_f_l[]=$rowlog[0];
}

//print_r($row);

while($row =mysql_fetch_array($values))
{
	$ELt=$row["ELt"];
	$CLt=$row["CLt"];
	$SLt=$row["SLt"];
	
	$total_bal_rem=$ELt+$CLt+$SLt;
/*	if($total_bal_rem>18)
	{
		$total_bal_rem_tofor=18;
//		$total_bal_rem_tofor=0;
	}else{
		$total_bal_rem_tofor=$total_bal_rem;
//		$total_bal_rem_tofor=0;
	}*/
	$total_bal_rem_tofor=$total_bal_rem;
	if(($row["estat"]=="Currently Working") AND (!in_array($row[0],$check_u_f_l)))
	{
?>
<tr  class="d<?php echo $i%2;?>" id="fetchrow<?php echo $i?>">
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" onclick="if(document.getElementById('chBx'+<?php echo $i;?>).checked){var element = document.getElementById('fetchrow'+<?php echo $i?>);element.style.backgroundColor='#b2ffd999';}else{var element = document.getElementById('fetchrow'+<?php echo $i?>);element.style.backgroundColor='#fff';}" value="<?php echo $row[0];?>" /> <?php echo $row[1]?></td>
<td ><?php echo $row[2]?><br><small><b>Post : </b><?php echo $row[5]?> <b> Dept : </b><?php echo $row["dname"];?></small></td>
<td><?php echo $row[6]?></td>
<td><input id="c_leave_val<?php echo $i;?>" name="req" type="number" max="<?=$total_bal_rem_tofor;?>" value="<?php echo $total_bal_rem_tofor;?>" /></td>

</tr>
<?php
$i++;
$Maxid = $row['id'];
$MaxI = $i;
}
}
?>

<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo 'xxxx--'.$MaxI;?>" />
</tbody>
</table>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>