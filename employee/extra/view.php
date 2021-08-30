<?php
include("../../include/conFig.php");
$eid = $_GET['eid'];
$getData = mysql_query("SELECT `id`, `name`, `description`, `type`, `employee`, `createdate`, `modifieddate`, `delete`, `status`, `extra`, `createdby` FROM `emp_extra` WHERE `employee`='$eid' AND `delete`='0'" ,$con) or die(mysql_error());

?>

<div id="myTitle" style="padding-bottom:5px">
<div class="title" style="display:inline-block">Extra</div>
<?php if(in_array('a_empe',$thisper)) 
{
?>
<div style="float:right;display:inline-block" class="button blue" onclick="$('#addEx').slideToggle('fast')"><i class="plus"></i>Extra</div>
<?php 
} 
?>


</div>

<div class="add-new gray_dark-border" id="addEx" style="display:none">
<div class="form-head gray_dark">
<div class="head-title"> 
<i class="add-form"></i> 
Add Extra Information</div>
</div>
<table width="100%" cellpadding="10" cellspacing="0">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>

<tr><th>Type<span>*</span></th>
	<td>
<select class="input drop-down large" name="educationway" id="ex0">
    <option value="">Select Type</option>
	<option value="1">Strengths</option>
	<option value="2">Achievements</option>
	<option value="3">Disciplinary Actions</option>
	<option value="4">Innovation</option>
	<!--<option value="5">Roles</option>-->
	<option value="6">Additional Responsibilities</option>
	<option value="7">Contributions</option>
	<option value="8">Area of Improvement</option>
	<option value="9">Extra</option>

   </select>
	
	</td>	
</tr>
<tr>
<th> Name <span>*</span></th>
<td><input class="input medium" name="req"  type="text"  style="width:240px;" id="ex1"/>
</td>
</tr>
<tr>
	<th>Description</th>
	<td><textarea class="input huge" id="ex2" name="TextArea1" style="width: 240px; height: 60px"></textarea></td>
</tr>
<tr><td></td><td  style="text-align:left">
<button class="button red" onclick="SaveData('employee/extra/save?eid=<?php echo $eid?>','ex','3','','','couResp','10')"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="$('#addEx').slideToggle('fast')"><i class="close-icon"></i>Cancel</button>
</td></tr>
</table>
</div>
<br/>
<div style="height:400px;overflow-x:hidden;overflow-y:scroll" id="">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="">
<tr>
	<th>Name</th>
	<th>Description</th>
	<th>Type </th>
	<th>Action</th>
</tr>
<?php
$i = 1;
while($row =mysql_fetch_array($getData))
{
	$type=$row["type"];
	switch($type)
	{
	    case 1:
			$type="Strengths";
        	break;
	    case 2:
			$type="Achievements";
        	break;
	    case 3:
			$type="Disciplinary Actions";
        	break;
	    case 4:
			$type="Innovation";
        	break;
	    /*case 5:
			$type="Roles";
        	break;*/
	    case 6:
			$type="Additional Responsibilities";
        	break;
	    case 7:
			$type="Contributions";
        	break;
	    case 8:
			$type="Area of Improvement";
        	break;
	    case 9:
			$type="Extra";
        	break;
	}
?>


<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td style="color:#000;width:120px"><?php echo $row["name"]?></td>
<td style="color:#000;wisdth:120px"><?php echo $row["description"]?></td>
<td style="color:#000;width:120px"><?php echo $type?></td>
<td style="color:#000;width:180px">


<?php if(in_array('d_empe',$thisper)) 
{
?>
<img style="cursor:pointer" src="img/icons/icons4.png" title="Delete Extra <?php echo $row[1]?>" height="20" width="13" onclick="deleteSingle('<?php echo $row[0]?>','fetchrow<?php echo $i?>','emp_extra')"/>
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
	

