<?php 
include("../../include/conFig.php");

$sql = "SELECT employee.id, employee.empid, employee.name, employee.workemail, employee.mobile, designation.name, employee.doj, department.name as dname, employeestatus.name as estat , employee.role, employee.l_allotstatus, rolls.name as rname FROM employee, designation, department, employeestatus,rolls WHERE employee.delete = '0' AND employee.active = '1' AND employee.designation= designation.id AND employee.department= department.id AND employee.empstatus= employeestatus.id AND employee.role= rolls.id";
$getData = mysql_query($sql,$con) or die(mysql_error());
$Num_Rows = mysql_num_rows($getData);
?>
<div id="myTitle">
<div class="title">My Employees</div>
<div class="strip">
<span>Dashboard</span>
<span>Employee</span>
<span>View</span>
</div>
</div>

<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right"><input type="text" id="myInput" class="input" onkeyup="myFunction()" placeholder="Search for names..">
</td>
</tr>
</table>
<br>
<div id="directResult" style="height:350px;overflow:auto">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
<tr><th style="height: 30px">Empid</th>
		<th style="height: 30px">Name<br><small>Designation</small></th>
	<th style="height: 30px">Status</th>
	<th style="height: 30px">Date of Joining (DOJ)</th>
	<th style="height: 30px">Mobile</th>
</tr>
<?php
$i = 1;
$sql .=" order by employee.name ASC";
$values = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($values))

{
?>
<tr  class="d<?php echo $i%2;?>" id="fetchrow<?php echo $i?>">
<td><?php if($row["estat"]=="Currently Working"){echo "<span style='color:green'>".$row[1]."</span>";}else{echo "<span style='color:red'>".$row[1]."</span>";} ?></td>

<?php if(in_array('u_emp',$thisper)) 
{
?>
<td><a href="employee/custom_profile_view/view_cust.php?id=<?php echo $row[0]?>" target="_blank"><span class="link-blue"><?php echo $row[2]?></span></a><br><small><b>Post : </b><?php echo $row[5]?><b> Dept : </b><?php echo $row["dname"]?></small></td>
<?php 
} 
else
{
?>
<td ><?php echo $row[2]?><br><small><b>Post : </b><?php echo $row[5]?> <b> Dept : </b><?php echo $row["dname"]?></small></td>
<?php
}
?>
<td> 
	 <?php  
		if($row["estat"]=="Currently Working")
			{
				echo "<span style='color:green'><b>Status:</b> ".$row["estat"]."</span>";
			}else
				{
					echo "<span style='color:red'><b>Status:</b> ".$row["estat"]."</span>";
				}
	?>
	<br>
	<?php  
		if($row["estat"]=="Currently Working")
			{
				if($row["role"]!=111)
					{
						echo "<span style='color:green'><b>Role:</b>".$row["rname"]."</span>";
					}else
						{
							echo "<span style='color:red'><b>Role:</b>".$row["rname"]."</span>";
						}
			}else
				{
					echo "<span style='color:red'><b>Role:</b>".$row["rname"]."</span>";
				}
	?>
	
	<br>
	<?php 
	if($row["estat"]=="Currently Working")
			{
				if($row["l_allotstatus"]!=0)
					{
						echo "<span style='color:green'><b>Leave Allotment:</b> Alloted</span>";
					}else
						{
							echo "<span style='color:red'><b>Leave Allotment:</b> Not Alloted</span>";
						}
			}else
						{
							echo "<span style='color:red'><b>Leave Allotment:</b> Not Alloted</span>";
						}
	 ?><br>
</td>
<td><?php echo $row[6]?></td>
<td><?php echo $row[4]?></td>

</tr>
<?php
$i++;
}
?>
</table>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>
 

