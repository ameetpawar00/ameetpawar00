<?php
include("../../include/conFig.php");
$eid = $_GET['eid'];
$getData = mysql_query("SELECT workexperience.id,workexperience.precompany,workexperience.jobtitle,workexperience.fromdate,workexperience.todate,workexperience.jobdesc,employee.id FROM employee,workexperience WHERE employee.id = workexperience.eid AND workexperience.delete = '0' AND workexperience.eid = '$eid'",$con) or die(mysql_error());
?>
<div id="myTitle" style="padding-bottom:5px">
<div class="title" style="display:inline-block">Work Experience</div>
<?php if(in_array('a_empx',$thisper)) 
{
?>
<div style="float:right;display:inline-block" class="button blue" onclick="$('#addExp').slideToggle('fast')"><i class="plus"></i>Work Experience</div>
<?php 
} 
?>



<div class="add-new gray_dark-border" id="addExp" style="display:none">
<div class="form-head gray_dark">
<div class="head-title"> 
<i class="add-form"></i> 
Add Dependent</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>

<tr>
<th>Previous Company Name <span>*</span></th>
<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="exp0"/>
</td>
</tr>
<tr><th>Job Title <span>*</span></th>
	<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="exp1"/>
	</td>	
</tr>
<tr>	
	<th>From Date  <span>*</span>
	</th>
	<td><input class="input medium" name="req" id="exp2" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalendar(this);"/>
	</td>
</tr>
<tr>	
	<th>To Date  <span>*</span>
	</th>
	<td><input class="input medium" name="req" id="exp3" type="" readonly="readonly" class="inputCalendar" style="width:200px" onclick="openCalendar(this);"/>
	</td>
</tr>
<tr>
	<th>Experience</th>
	<td><textarea class="input huge" id="exp4" name="TextArea1" style="width: 240px; height: 60px"></textarea></td>
</tr>
<tr><td></td><td  style="text-align:left">
<button class="button red" onclick="SaveData('employee/workexperience/saveexp?eid=<?php echo $eid?>','exp','5','','','couResp','10')"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="$('#addExp').slideToggle('fast')"><i class="close-icon"></i>Cancel</button>
</td></tr>
</table>
</div>
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
<td style="color:#000;width:120px"><?php echo $row[1]?></td>
<td style="color:#000;width:120px"><?php echo $row[2]?></td>
<td style="color:#000;width:120px"><?php echo $row[3]?></td>
<td style="color:#000;width:120px"><?php echo $row[4]?></td>
<td style="color:#000;width:180px"><?php echo substr($row[5],0,50);?></td>
<td style="color:#000;width:180px">
<?php if(in_array('u_empx',$thisper)) 
{
?>
<img style="cursor:pointer" src="img/icons/icons15.png" title="Edit Work Experience" height="20" width="17" onclick="editDynamic('employee/workexperience/editexp.php','<?php echo base64_encode($row[0])?>','fetchrow<?php echo $i?>','edit')" />&nbsp;&nbsp;&nbsp;&nbsp;
<?php 
} 
?>
<?php if(in_array('d_empx',$thisper)) 
{
?>
<img style="cursor:pointer" src="img/icons/icons4.png" title="Delete Work Experience" height="20" width="13" onclick="deleteSingle('<?php echo $row[0]?>','fetchrow<?php echo $i?>','dependent')"/>
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


