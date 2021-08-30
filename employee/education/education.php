<?php
include("../../include/conFig.php");
$eid = $_GET['eid'];
$getData = mysql_query("SELECT * FROM `emp_education` WHERE `employee`='$eid' AND `delete`='0' AND `type`!=1" ,$con) or die(mysql_error());
$getDatac = mysql_query("SELECT * FROM `emp_education` WHERE `employee`='$eid' AND `delete`='0' AND `type`=1" ,$con) or die(mysql_error());

?>

<div id="myTitle" style="padding-bottom:5px">
<div class="title" style="display:inline-block">Education / Courses</div>
<?php if(in_array('a_empe',$thisper)) 
{
?>
<div style="float:right;display:inline-block;" class="button blue" onclick="$('#addEdu').slideToggle('fast')"><i class="plus"></i>Education</div> 
<div style="float:right;display:inline-block;margin-right: 5px;" class="button blue" onclick="$('#addCour').slideToggle('fast')"><i class="plus"></i>Courses</div>
<?php 
} 
?>


</div>

<div class="add-new gray_dark-border" id="addEdu" style="display:none">
<div class="form-head gray_dark">
<div class="head-title"> 
<i class="add-form"></i> 
Add Education </div>
</div>
<table width="100%" cellpadding="10" cellspacing="0">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>

<tr>
<th>Institute Name <span>*</span></th>
<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="edu0"/>
</td>
</tr>
<tr>
<th>Education/Degree<span>*</span></th>
<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="edu6"/>
</td>
</tr>

<tr><th>Subject/Stream<span>*</span></th>
	<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="edu1"/>
	</td>	
</tr>
<tr><th>Grade<span>*</span></th>
	<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="edu2"/>
	</td>	
</tr>

<tr>	
	<th>Year OF Completion <span>*</span>
	</th>
	<td>
<select class="input drop-down large" name="educationyear" id="edu3">
				<option value="Select Year" name="years">Select Year</option>
    <?php 
    for($i=1950; $i<=2030; $i++)
    {
    ?>
    <option value="<?php echo $i;?>"><?php echo $i;?></option>
    <?php
    }
    ?> 
</select>
	</td>
</tr>
<tr><th>Way Of Education<span>*</span></th>
	<td>
<select class="input drop-down large" name="educationway" id="edu4">
    <option value="way" name="way">Select Education-Way</option>
	<option value="1" name="way">Open School</option>
	<option value="2" name="way">Part Time</option>
	<option value="3" name="way">Correspondance</option>
	<option value="4" name="way">Regular</option>

   </select>
	
	</td>	
</tr>


<tr>
	<th>Description</th>
	<td><textarea class="input huge" id="edu5" name="TextArea1" style="width: 240px; height: 60px"></textarea></td>
</tr>

<tr><td></td><td  style="text-align:left">

<button class="button red" onclick="SaveData('employee/education/saveedu?eid=<?php echo $eid?>&type=0','edu','7','','','couResp','10')"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="$('#addEdu').slideToggle('fast')"><i class="close-icon"></i>Cancel</button>
</td></tr>
</table>
</div>



<div class="add-new gray_dark-border" id="addCour" style="display:none">
<div class="form-head gray_dark">
<div class="head-title"> 
<i class="add-form"></i> 
Add Course </div>
</div>
<table width="100%" cellpadding="10" cellspacing="0">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>
<tr>
<th>Institute Name <span>*</span></th>
<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="cou0"/>
</td>
</tr>
<tr>
<th>Course Name<span>*</span></th>
<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="cou1"/>
</td>
</tr>

<tr><th>Subject<span>*</span></th>
	<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="cou2"/>
	</td>	
</tr>
<tr>	
	<th>Year OF Completion <span>*</span>
	</th>
	<td>
<select class="input drop-down large" name="educationyear" id="cou3">
				<option value="Select Year" name="years">Select Year</option>
    <?php 
    for($i=1970; $i<=2030; $i++)
    {
    ?>
    <option value="<?php echo $i;?>"><?php echo $i;?></option>
    <?php
    }
    ?> 
</select>
	</td>
</tr>
<tr>
	<th>Description</th>
	<td><textarea class="input huge" id="cou4" name="TextArea1" style="width: 240px; height: 60px"></textarea></td>
</tr>
<tr><td></td><td  style="text-align:left">
<button class="button red" onclick="SaveData('employee/education/saveedu?eid=<?php echo $eid?>&type=1','cou','5','','','couResp','10')"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="$('#addCour').slideToggle('fast')"><i class="close-icon"></i>Cancel</button>
</td></tr>
</table>
</div>
<br/>
<div style="height:400px;overflow-x:hidden;overflow-y:scroll" id="">
<div class="title" style="display:inline-block">Education</div>
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="">
<tr>
	<th>Institute Name</th>
	<th>Education Degree</th>
	<th>Subject/Stream</th>
	<th>Grade</th>
	<th>Year OF Completion</th>
	<th>Way Of Education</th>
	<th>Description</th>
	<th>Action</th>
</tr>
<?php
$i = 1;
while($row =mysql_fetch_array($getData))
{
?>
<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td style="color:#000;width:120px"><?php echo $row[2]?></td>
<td style="color:#000;width:120px"><?php echo $row[8]?></td>
<td style="color:#000;width:120px"><?php echo $row[3]?></td>
<td style="color:#000;width:120px"><?php echo $row[4]?></td>
<td style="color:#000;width:120px"><?php echo $row[5]?></td>
<td style="color:#000;width:120px">
<?php 
if ($row[6]==1){echo 'Open School';} 
if ($row[6]==2){echo 'Part Time';} 
if ($row[6]==3){echo 'Correspondance';} 
if ($row[6]==4){echo 'Regular';} 
?></td>
<td style="color:#000;width:120px"><?php echo $row[7]?></td>
<td style="color:#000;width:180px">
<?php if(in_array('u_empe',$thisper)) 
{
?>
<img style="cursor:pointer" src="img/icons/icons15.png" title="Edit Education <?php echo $row[1]?>" height="20" width="17" onclick="editDynamic('employee/education/editedu.php?type=0','<?php echo base64_encode($row[0])?>','fetchrow<?php echo $i?>','edit')" />&nbsp;&nbsp;&nbsp;&nbsp;
<?php 
} 
?>

<?php if(in_array('d_empe',$thisper)) 
{
?>
<img style="cursor:pointer" src="img/icons/icons4.png" title="Delete Education <?php echo $row[1]?>" height="20" width="13" onclick="deleteSingle('<?php echo $row[0]?>','fetchrow<?php echo $i?>','emp_education')"/>
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
<br>
<br>
<br>
<br>
<div class="title" style="display:inline-block">Courses</div>
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="">
<tr>
	<th>Institute Name</th>
	<th>Course Name</th>
	<th>Subject</th>
	<th>Year OF Completion</th>
	<th>Description</th>
	<th>Action</th>
</tr>
<?php
$i = 1;
while($rowc =mysql_fetch_array($getDatac))
{
	//print_r($rowc);
	
?>
<tr  class="d<?php echo $i%2?>"  id="fetchrowa<?php echo $i?>">
<td style="color:#000;width:120px"><?php echo $rowc[2]?></td>
<td style="color:#000;width:120px"><?php echo $rowc[8]?></td>
<td style="color:#000;width:120px"><?php echo $rowc[3]?></td>
<td style="color:#000;width:120px"><?php echo $rowc[5]?></td>
<td style="color:#000;width:120px"><?php echo $rowc[7]?></td>
<td style="color:#000;width:180px">
<?php if(in_array('u_empe',$thisper)) 
{
?>
<img style="cursor:pointer" src="img/icons/icons15.png" title="Edit Education <?php echo $rowc[1]?>" height="20" width="17" onclick="editDynamic('employee/education/editedu.php?type=1','<?php echo base64_encode($rowc[0])?>','fetchrowa<?php echo $i?>','edit')" />&nbsp;&nbsp;&nbsp;&nbsp;
<?php 
} 
?>

<?php if(in_array('d_empe',$thisper)) 
{
?>
<img style="cursor:pointer" src="img/icons/icons4.png" title="Delete Education <?php echo $rowc[1]?>" height="20" width="13" onclick="deleteSingle('<?php echo $rowc[0]?>','fetchrowa<?php echo $i?>','emp_education')"/>
<?php 
} 
?>



</td>
</tr>
<?php
$i++;
$Maxid = $rowc['id'];
$MaxI = $i;
}
?>
<input class="input medium" id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
</table>
<br>
<br>
<br>
<br>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

