<?php
include("../include/conFig.php");
$sql ="SELECT  employee.id,employee.empid,employee.name,employee.email,employee.phone,employee.jobdescription FROM employee WHERE employee.delete = '0' AND employee.active = '1'";
$getData = mysql_query($sql,$con) or die (mysql_error());
	$Num_Rows = mysql_num_rows($getData);
	$Per_Page = 25;   // Per Page
	$Page = $_GET["Page"];
	if(!$_GET["Page"])
	{
		$Page=1;
	}
	$Prev_Page = $Page-1;
	$Next_Page = $Page+1;
	$Page_Start = (($Per_Page*$Page)-$Per_Page);
	if($Num_Rows<=$Per_Page)
	{
		$Num_Pages =1;
	}
	else if(($Num_Rows % $Per_Page)==0)
	{
		$Num_Pages =($Num_Rows/$Per_Page) ;
	}
	else
	{
		$Num_Pages =($Num_Rows/$Per_Page)+1;
		$Num_Pages = (int)$Num_Pages;
	}


?>
<div class="title">My Employees</div>
<div class="strip">
<span>Dashboard</span>
<span>Masters</span>
<span>Employee</span>
</div>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td style="width:30%" ></td>
<td style="width:70%" align="right"><button class="button blue" onclick="getModule('crude/new','manipulatemoodleContent','viewmoodleContent','Dependent')"> <i class="editlarge"></i>  Edit</button>&nbsp;
<div class="dropdown-menu" style="display:none" id="drpmenu">
<div class="dropdown-menu-inner">
<div class="dropdown-menu-inner-title">
Select Tools</div>
<div style="background:#fff;">
<ul>
<li><i class="delete-icon-black"></i>Delete</li>
<li><i class="edit-icon-black"></i>Edit</li>
<li style="border-bottom:1px #d8d8d8 solid"><i class="user-icon-black"></i>Change Owner</li>
<li style="padding:10px 0 10px 13px"><i class="task-icon-black"></i>Add Task
<div style="float:right;padding-right:10px;">
<span class="roundspan red">2</span>
</div>
</li>
</ul>
</div>
</div>
</div>
	<button class="button red" data-toggle="dropdown" onclick="$('#drpmenu').slideToggle();">Tools&nbsp;&nbsp; <i class="down-arrow"></i>
											</button>
											<input name="Text1" type="text" id="titleForced" style="display:none"/>
</div>
											
											
</td>
</tr>
</table>


<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
<tr><th><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>
	<th>Empid</th>
	<th>Name</th>
	<th>Email</th>
	<th>Phone</th>
	<th>Job Description</th>
</tr>
<?php
$i = 1;

			$sql .=" order by employee.name asc ,employee.id ASC LIMIT $Page_Start , $Per_Page";
			$values = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($values))
{
?>
<tr  class="d<?php echo $i%2;?>" <?php if($i > 1){?> onmousemove="magicScroll()" <?php } else {?> onmousemove="magicScrollDown()"  <?php } ?>  id="fetchrow<?php echo $i?>">
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" /></td>
<td><?php echo $row[1]?></td>
<td class="link-blue" onclick="getModule('employee/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Employee')"><?php echo $row[2]?></td>
<td><?php echo $row[3]?></td>
<td><?php echo $row[4]?></td>
<td><?php echo $row[5]?></td>
</tr>
<?php
$i++;
$Maxid = $row['id'];
$MaxI = $i;
}
?>
<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
</table>
<div class="pagination">
<ul >
<li><span style="display:inline-block;color:#555">Total <?php echo $Num_Rows;?> Records : <strong> <?php $Num_Pages;?> </strong>Pages : </span>
</li>
	<?php
	if($Prev_Page)
	{
	?>
		<li class='prev' onclick="getModule('employee/view?Page=<?php echo $Prev_Page?>','viewContent','manipulateContent','Employee')"> <a href='#'>&#8592;<span>Prev</span></a></li>
	<?php
	}

	for($i=1; $i<=$Num_Pages; $i++)
	{
		if($i != $Page)
		{
		?>
			<li  onclick="getModule('employee/view?Page=<?php echo $i?>','viewContent','manipulateContent','Employee')"><a href="#"><?php echo $i ?></a></li>
			<?php
			//echo "[ <span href='$_SERVER[SCRIPT_NAME]?Page=$i'>$i</span> ]";
		}
		else
		{
		?>
			<li class='active'><a href='#'><?php echo $i?></a></li>
		<?php
		
		}
	}
	if($Page!=$Num_Pages)
	{
	?>
		<li class='next' onclick="getModule('employee/view?Page=<?php echo $Next_Page?>','viewContent','manipulateContent','Employee')"><a href="#"><span class='hidden-480'>Next</span> &#8594; </a></li>
	<?php
	}
	?>
</ul>
</div>
