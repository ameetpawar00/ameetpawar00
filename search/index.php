<?php include("../include/conFig.php");
$term = $_GET['term'];
$sql = "SELECT employee.id, employee.empid, employee.name, employee.workemail, employee.mobile, designation.name, employee.doj, department.name as dname, employeestatus.name as estat , employee.role, employee.l_allotstatus, rolls.name as rname FROM employee, designation, department, employeestatus,rolls WHERE employee.delete = '0' AND employee.active = '1' AND employee.designation= designation.id AND employee.department= department.id AND employee.empstatus= employeestatus.id AND employee.role= rolls.id AND (employee.name LIKE '%$term%' OR employee.mobile LIKE '%$term%' OR employee.empid LIKE '%$term%')";
//$sql = "SELECT employee.id,employee.empid,employee.name,employee.workemail,employee.mobile,employee.branch,branch.name,employee.city,city.name FROM employee,branch,city WHERE employee.city = city .id AND city.delete = '0' AND employee.branch = branch.id AND branch.delete = '0' AND employee.delete = '0' AND employee.active = '1' AND (employee.name LIKE '%$term%' OR employee.mobile LIKE '%$term%')";
$getData = mysql_query($sql,$con) or die(mysql_error());
$Num_Rows = mysql_num_rows($getData);
	$Per_Page = 50;   // Per Page
	include('../pagination/pagination.php');
	$folder= 'employee/view';
	$title = 'Employee';

?>
<div id="myTitle">
<div class="title">Search Results
</div>
<div class="strip">
<span><?php echo $num;?>
records found for <em><?php echo $term;?></em>
</span>
</div>
</div>

 

<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
<?php if(in_array('a_emp',$thisper)) 
{
?>
<button class="button blue" onclick="getModule('employee/index','manipulateContent','viewContent','Employee')"> <i class="plus"></i>New</button>&nbsp;
<?php 
} 
?>
<?php if(in_array('d_emp',$thisper)) 
{
?>
<button class="button red" onclick="deleteData('employee','Employee')"> <i class="delete-icon"></i>Delete</button>&nbsp;
<?php 
} 
?>
</td>
</tr>
</table>

<div style="height:400px;overflow-x:hidden;overflow-y:scroll" >
<table  class="display dataTable abab table-bordered" width="100%" cellspacing="0"  id="myTable_new" style="width: 100%;padding-bottom: 70px;">
<thead>
	<tr>
		<th style="height: 30px"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" />Empid</th>
	
	<th style="height: 30px">Name<br><small>Designation</small></th>
	<th style="height: 30px">Status</th>
	<th style="height: 30px">Date of Joining (DOJ)</th>
	<th style="height: 30px">Mobile</th>
</tr>
</thead>
<tfoot style="display: table-header-group;position: relative;top: 0px;">
	<tr>
	<th style="height: 30px">Empid</th>
	<th style="height: 30px">Name & Designation </th>
	<th style="height: 30px">Status</th>
	<th style="height: 30px">Date of Joining (DOJ)</th>
	<th style="height: 30px">Mobile</th>
</tr>
</tfoot>

<tbody>
<?php
$i = 1;
$sql .=" order by employee.name ASC";
$values = mysql_query($sql,$con)or die(mysql_error());
if($Num_Rows>0)
{
	while($row =mysql_fetch_array($values))
	{
?>
<tr  class="d<?php echo $i%2;?>" id="fetchrow<?php echo $i?>">
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" /> <?php if($row["estat"]=="Currently Working"){echo "<span style='color:green'>".$row[1]."</span>";}else{echo "<span style='color:red'>".$row[1]."</span>";} ?></td>

<?php if(in_array('u_emp',$thisper)) 
{
?>
<td  onclick="getModule('employee/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Employee')"><span class="link-blue"><?php echo $row[2]?></span><br><small><b>Post : </b><?php echo $row[5]?><b> Dept : </b><?php echo $row["dname"]?></small></td>
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
	//$Maxid = $row['id'];
	//$MaxI = $i;
	}
}
else
{
?>
	<tr>
		<td colspan="6">No Record Found</td>
	</tr>
<?php
}
?>
<!--<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
-->
	
</tbody>	
</table>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>
<?php
include('../pagination/pages.php');
?>
