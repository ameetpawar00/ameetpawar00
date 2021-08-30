<?php
include("../../include/conFig.php");
$eid = $_GET['eid'];
$i = $_GET['i'];
$name = $_GET['name'];
$getData = mysql_query("SELECT dependent.id,dependent.name,relationship.name,dependent.dob,dependent.occupation,dependent.office,dependent.mobile FROM employee,relationship,dependent WHERE employee.id = dependent.eid AND dependent.relationshipid = relationship.id AND dependent.delete = '0' AND dependent.eid = '$eid'",$con) or die(mysql_error());

?>
<br/>
<div id="myTitle" style="padding-bottom:5px">
<div class="title" style="display:inline-block">Dependent of <?php echo $name?></div>
<button style="float:right;display:inline-block" class="button gray" onclick="getModule('employee/edit?id=<?php echo $eid?>&i=<?php echo $i?>','manipulateContent','viewContent','Employee')"> <i class="back"></i>Back</button>

<?php if(in_array('a_empd',$thisper)) 
{
?>
<div style="float:right;display:inline-block" class="button blue" onclick="getModule('employee/dependent/add?id=<?php echo $row[0]?>&name=<?php echo $row['name'] ?>&eid=<?php echo $eid ?>&i=<?php echo $i ?>','manipulateContent','viewContent','Dependent')"><i class="plus"></i>Dependent</div>
<?php 
} 
?>
</div>


<br/>
<div style="height:400px;overflow-x:hidden;overflow-y:scroll" id="">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable1">
<tr>
	<th>Name</th>
	<th>Relation</th>
	<th>Date Of Birth</th>
	<th>Occupation</th>
	<th>Office Name & Address </th>
	<th>Mobile Number</th>
	<th>Delete</th>
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
<td style="width:200px" class="link-blue" onclick="getModule('employee/dependent/edit?id=<?php echo $row[0]?>&name=<?php echo $row['name'] ?>&eid=<?php echo $eid ?>&i=<?php echo $i ?>','manipulateContent','viewContent','Dependent')"><?php echo $row[1]?></td>
<?php 
} 
else
{
?>
<td style="width:200px"><?php echo $row[1]?></td>
<?php
}
?>

<td style="width:210px"><?php echo $row[2]?></td>
<td style="width:210px"><?php echo $row[3]?></td>
<td style="width:210px"><?php echo $row[4]?></td>
<td style="width:210px"><?php echo $row[5]?></td>
<td style="width:210px"><?php echo $row[6]?></td>
<td>
<?php if(in_array('d_empd',$thisper)) 
{
?>
<img style="cursor:pointer" src="img/icons/icons4.png" title="Delete Dependent <?php echo $row[1]?>" height="20" width="13" onclick="deleteSingle('<?php echo $row[0]?>','fetchrow<?php echo $i?>','dependent')"/>
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
<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
</table>

</div>
	

