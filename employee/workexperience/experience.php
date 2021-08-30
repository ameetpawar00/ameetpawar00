<?php
include("../../include/conFig.php");
$eid = $_GET['eid'];
$i = $_GET['i'];
$name = $_GET['name'];

$getData = mysql_query("SELECT workexperience.id,workexperience.precompany,workexperience.jobtitle,workexperience.fromdate,workexperience.todate,workexperience.jobdesc,employee.id FROM employee,workexperience WHERE employee.id = workexperience.eid AND workexperience.delete = '0' AND workexperience.eid = '$eid'",$con) or die(mysql_error());
?>
<br/>
<div id="myTitle" style="padding-bottom:5px">
<div class="title" style="display:inline-block">Work Experience For <?php echo $name?></div>
<button style="float:right;display:inline-block" class="button gray" onclick="ToggleBox('bigMoodle','none','');getModule('employee/edit?id=<?php echo $eid?>&i=<?php echo $i?>','manipulateContent','viewContent','Employee');"> <i class="back"></i>Back</button>

<?php if(in_array('a_empx',$thisper)) 
{
?>
<div style="float:right;display:inline-block" class="button blue" onclick="getModule('employee/workexperience/add?id=<?php echo $row[0]?>&name=<?php echo $name ?>&eid=<?php echo $eid ?>&i=<?php echo $i ?>','viewmoodleContent','manipulatemoodleContent','Dependent')"><i class="plus"></i>Experience</div>
<?php 
} 
?>




<br/>
<div style="height:400px;overflow-x:hidden;overflow-y:scroll" id="">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="">
<tr>
	<th>Company</th>
	<th>Job Title</th>
	<th>From Date</th>
	<th>To Date</th>
	<th>Experience</th>
	<th>Action</th>
</tr>
<?php
$i = 1;
while($row =mysql_fetch_array($getData))
{
?>
<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<?php if(in_array('u_empd',$thisper)) 
{
?>
<td style="width:200px" class="link-blue" onclick="getModule('employee/workexperience/edit?id=<?php echo $row[0]?>&name=<?php echo $name ?>&eid=<?php echo $eid ?>&i=<?php echo $i ?>','viewmoodleContent','manipulatemoodleContent','Dependent')"><?php echo $row[1]?></td>
<?php 
} 
else
{
?>
<td style="width:200px"><?php echo $row[1]?></td>
<?php
}
?>
<td style="color:#000;width:120px"><?php echo $row[2]?></td>
<td style="color:#000;width:120px"><?php echo $row[3]?></td>
<td style="color:#000;width:120px"><?php echo $row[4]?></td>
<td style="color:#000;width:180px"><?php echo substr($row[5],0,50);?></td>
<td style="color:#000;width:180px">
<?php if(in_array('d_empx',$thisper)) 
{
?>
<img style="cursor:pointer" src="img/icons/icons4.png" title="Delete Work Experience" height="20" width="13" onclick="deleteSingle('<?php echo $row[0]?>','fetchrow<?php echo $i?>','workexperience')"/>
<?php 
} 
?>


</td>
</tr>
<?php
$i++;
$Maxid = $row['id'];
$MaxI = $i;
}
?>
<input class="input medium" id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
</table>

</div>


