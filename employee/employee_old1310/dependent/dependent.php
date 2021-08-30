<?php
include("../../include/conFig.php");
$eid = $_GET['eid'];
$getData = mysql_query("SELECT dependent.id,dependent.name,relationship.name,dependent.dob FROM employee,relationship,dependent WHERE employee.id = dependent.eid AND dependent.relationshipid = relationship.id AND dependent.delete = '0' AND dependent.eid = '$eid'",$con) or die(mysql_error());

?>

<div id="myTitle" style="padding-bottom:5px">
<div class="title" style="display:inline-block">Dependent</div>
<?php if(in_array('a_empd',$thisper)) 
{
?>
<div style="float:right;display:inline-block" class="button blue" onclick="$('#addDepen').slideToggle('fast')"><i class="plus"></i>Dependent</div>
<?php 
} 
?>

</div>

<div class="add-new gray_dark-border" id="addDepen" style="display:none">
<div class="form-head gray_dark">
<div class="head-title"> 
<i class="add-form"></i> 
Add Dependent</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>

<tr>
<td>Name <span>*</span></td>
<td><input name="req" class="input medium" data-original-title="" type="text"  style="width:240px;" id="depen0"  />
</td>
</tr>
<tr><td>Relationship <span>*</span></td>
<td><select name="req" id="depen1" style="width:250px" class="input drop-down large">
				<option value="">Select Relationship</option>
<?php
$getLoc = mysql_query("SELECT `id`,`name` FROM `relationship` WHERE `delete`= '0' AND `id` != '1'",$con) or die(mysql_error());
while($rowLoc = mysql_fetch_array($getLoc))
{
?>				
				<option value="<?php echo $rowLoc[0]?>"><?php echo $rowLoc[1]?></option>
<?php
}
?>				
			</select>

	</td>	
</tr><tr>	
	<td>Date Of Birth 
	</td>
	<td><input name="" id="depen2" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalender('decalenderid','depen2')"/>
			<div class="calender" id="decalenderid"></div>
	</td>
</tr>
<tr><td></td><td  style="text-align:left">
<button class="button red" onclick="SaveData('employee/dependent/savedepen?eid=<?php echo $eid?>','depen','3','','','couResp','10')"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="$('#addDepen').slideToggle('fast')"><i class="close-icon"></i>Cancel</button>
</td></tr>
</table>
</div>
<br/>
<div style="height:400px;overflow-x:hidden;overflow-y:scroll" id="">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable1">
<tr>
	<th>Name</th>
	<th>Relation</th>
	<th>Date Of Birth</th>
	<th>Action</th>
</tr>
<?php
$i = 1;
while($row =mysql_fetch_array($getData))
{
?>

<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td style="width:200px"><?php echo $row[1]?></td>
<td style="width:210px"><?php echo $row[2]?></td>
<td style="width:210px"><?php echo $row[3]?></td>
<td>
<?php if(in_array('u_empd',$thisper)) 
{
?>
<img style="cursor:pointer" src="img/icons/icons15.png" title="Edit Dependent <?php echo $row[1]?>" height="20" width="17" onclick="editDynamic('employee/dependent/editdepen.php','<?php echo base64_encode($row[0])?>','fetchrow<?php echo $i?>','edit')" />&nbsp;&nbsp;&nbsp;&nbsp;
<?php 
} 
?>
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
	

