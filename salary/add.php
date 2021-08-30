<?php
include("../include/conFig.php");
$eid = $_GET['eid'];
$name = $_GET['name'];
$salpid = $_GET['salpid'];

$getDatanote = mysql_query("SELECT noteline.note FROM noteline WHERE employee = '$eid' AND subject='Salary Profile is changed'" ,$con) or die(mysql_error());

while($rowgetDatanote =mysql_fetch_assoc($getDatanote))
{
	$temp1=$rowgetDatanote['note'];
	$temp2=explode("Previous Salary Profile is ",$temp1);
	$temp3=explode(" and new Salary Profile is ",$temp2[1]);
	$temp4=$temp3[0];
	$temp33=explode(".",$temp3[1]);
	if($temp33[1])
	{
	//$temp5=str_replace(".","",);

		$temp5=$temp3[1];
		$temp5=rtrim($temp5,'.');
	}else{
		$temp5=$temp33[0];
	}
	$finalstr[]=$temp4;
	$finalstr[]=$temp5;
}
$finalarry=array_unique($finalstr);
//print_r($finalarry);
$finalsear="";
foreach($finalarry as $finalarryas)
{
	$finalsear.="'".$finalarryas."',";
}
$finalsear=rtrim($finalsear,',');
if($finalarry)
{
	$condstr="`salprofile` IN(".$finalsear.")";
	
}else{
	$condstr="`id` = '$salpid'";
}




//echo "SELECT * FROM `salary` WHERE `delete` = '0' AND $condstr ORDER BY `basic`+0 DESC";
$getData = mysql_query("SELECT * FROM `salary` WHERE `delete` = '1' AND $condstr ORDER BY `basic`+0 DESC",$con) or die(mysql_error());
$count = mysql_num_rows($getData);



/////////////////calc of current salary
/*
$getStarting = mysql_query("SELECT * FROM `salary` WHERE `eid` = '$eid' AND `delete` = '0' AND `increment` = '0'",$con) or die(mysql_error());
$rowStarting = mysql_fetch_array($getStarting);
$getInc = mysql_query("SELECT SUM(basic),SUM(con_allow),SUM(spec_allow),SUM(other_allow) FROM `salary` WHERE `eid` = '$eid' AND `delete` = '0' AND `increment` = '1'",$con) or die(mysql_error());
$rowInc = mysql_fetch_array($getInc);
$getDec = mysql_query("SELECT SUM(basic),SUM(con_allow),SUM(spec_allow),SUM(other_allow) FROM `salary` WHERE `eid` = '$eid' AND `delete` = '0' AND `increment` = '2'",$con) or die(mysql_error());
$rowDec = mysql_fetch_array($getDec);
$basic = ($rowStarting['basic'] + $rowInc[0]) - $rowDec[0];
$con_allow = ($rowStarting['con_allow'] + $rowInc[1]) - $rowDec[1];
$spec_allow = ($rowStarting['spec_allow'] + $rowInc[2]) - $rowDec[2];
$other_allow = ($rowStarting['other_allow'] + $rowInc[3]) - $rowDec[3];
$finalSal = $basic + $con_allow + $spec_allow + $other_allow;
*/
?>
<div id="myTitle" style="padding-bottom:5px;margin-top:20px">
<div class="title" style="display:inline-block;">Salary Break Ups For <?php echo $name;?>
</div>
<button class="button gray" style="float:right;margin-right:10px" onclick="ToggleBox('viewContent','none','');ToggleBox('manipulateContent','block','')"> <i class="back"></i>Back</button>

<?php
if($count == 0)
{
?>		
<span><div style="float:right;margin-right:10px;display:none" class="button blue" onclick="$('#addSal').slideToggle('fast')">+1 Salary</div>
</span>
<?php
}
else
{
?>
<div style="float:right;margin-right:10px;display:none" class="button blue" onclick="$('#dec').slideToggle('fast')">Decrement</div>
<div style="float:right;margin-right:10px;display:none" class="button blue" onclick="$('#addSal').slideToggle('fast')">Add Increment</div>
<?php
}
?>
</div>

<div class="add-new gray_dark-border" id="addSal" style="display:none">
<div class="form-head gray_dark">
<div class="head-title"> 
<i class="add-form"></i> 
Add Salary</div>
</div>
<?php
if($count > 0)
{
?>	
<div class="head-title"> 
<i class="add-form"></i> 
Add Increment</div>

<?php  } ?>
	<table width="100%" cellpadding="10" cellspacing="0">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>

<tr>
<th>Basic salary<span>*</span></th>
<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="sal0"/>
</td>
</tr>
<tr><th>Conveyance Allowance<span>*</span></th>
	<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="sal1"/>
	</td>	
</tr>
<tr>	
	<th>Special Allowance<span>*</span>
	</th>
	<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="sal2"/>
	</td>
</tr>
<tr>	
	<th>Other Allowance<span>*</span>
	</th>
	<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="sal3"/>
	</td>
</tr>
<tr>
	<th>Performance Allowance<span>*</span></th>
	<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="sal4"/>
</tr>
<tr>
	<th>Attendacne Allowance<span>*</span></th>
	<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="sal5"/>
</tr>
<tr>
	<th>Performance Bonus<span>*</span></th>
	<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="sal6"/>
</tr>
<tr>
	<th>Training Allowance<span>*</span></th>
	<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="sal7"/>
</tr>
<tr>
	<th>Mobile Allowance<span>*</span></th>
	<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="sal8"/>
</tr>
<tr>
	<th>HRA<span>*</span></th>
	<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="sal9"/>
</tr>
<tr>
	<th>Provident Fund<span>*</span></th>
	<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="sal10"/>
</tr>


<tr><td></td><td  style="text-align:left">
<button class="button red" onclick="SaveData('salary/save?eid=<?php echo $eid?>&count=<?php echo $count?>','sal','11','','','couResp','10')"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="$('#addSal').slideToggle('fast')"><i class="close-icon"></i>Cancel</button>
</td></tr>
</table>
</div>

<div class="add-new red-border" id="dec" style="display:none">
<div class="form-head red">
<div class="head-title"> 
<i class="add-form"></i> 
Add Decrement</div>
</div>	
<table width="100%" cellpadding="10" cellspacing="0">
<tr><td colspan="2" style="text-align:center"><div style="display:inline-block;" id="couResp"></div></td></tr>

<tr>
<th>Basic salary <span>*</span></th>
<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="dsal0"/>
</td>
</tr>
<tr><th>Conveyance Allowance<span>*</span></th>
	<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="dsal1"/>
	</td>	
</tr>
<tr>	
	<th>Special Allowance<span>*</span>
	</th>
	<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="dsal2"/>
	</td>
</tr>
<tr>	
	<th>Other Allowance<span>*</span>
	</th>
	<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="dsal3"/>
	</td>
</tr>
<tr>
	<th>Performance Allowance<span>*</span></th>
	<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="dsal4"/></td>	
</tr>
<tr>
	<th>Attendacne Allowance<span>*</span></th>
	<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="dsal5"/></td>	
</tr>
<tr>
	<th>Performance Bonus<span>*</span></th>
	<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="dsal6"/></td>	
</tr>
<tr>
	<th>Training Allowance<span>*</span></th>
	<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="dsal7"/></td>	
</tr>
<tr>
	<th>Mobile Allowance<span>*</span></th>
	<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="dsal8"/></td>	
</tr>
<tr>
	<th>HRA<span>*</span></th>
	<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="dsal9"/></td>	
</tr>
<tr>
	<th>Provident Fund<span>*</span></th>
	<td><input class="input medium" name="req" class="" data-original-title="" type="text"  style="width:240px;" id="dsal10"/></td>	
</tr>



<tr><td></td><td  style="text-align:left">
<button class="button red" onclick="SaveData('salary/save?eid=<?php echo $eid?>&increment=2','dsal','11','','','couResp','10')"><i class="save-icon"></i>Save</button>
<button class="button gray" onclick="$('#dec').slideToggle('fast')"><i class="close-icon"></i>Cancel</button>
</td></tr>
</table>
</div>
<br/>

<div style="height:400px;overflow:auto" id="">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="">
<tr>
	<th>Basic</th>
	<th>Conveyance Allowance</th>
	<th>Special Allowance</th>
	<th>Other Allowance</th>
	<th>Performance Allowance</th>
	<th>Attendacne Allowance</th>
	<th>Performance Bonus</th>
	<th>Training Allowance</th>
	<th>Mobile Allowance</th>
	<th>HRA</th>
	<th>Provident Fund</th>
	<th style="display:none">Action</th>
</tr>
<?php


$i = 1;
while($row =mysql_fetch_array($getData))
{
if($row['increment'] == '1') 
{
$title  = 'title="Increment"';
$myStyle = 'color:green;font-weight:bold;"';
}
else if($row['increment'] == '2')
{
$title ='title="Decrement"';
$myStyle = 'color:maroon;font-weight:bold;"';
}
else 
{
$title = 'title="Starting Salary"';
$myStyle = 'color:#000;font-weight:bold;"';
}
?>
<tr <?php echo $title;?> class="d<?php echo $i%2?>" id="fetchrow<?php echo $i?>">
<td style="<?php echo $myStyle?>;"><?php echo $row[3]?></td>
<td style="<?php echo $myStyle?>;"><?php echo $row[4]?></td>
<td style="<?php echo $myStyle?>;"><?php echo $row[5]?></td>
<td style="<?php echo $myStyle?>;"><?php echo $row[6]?></td>
<td style="<?php echo $myStyle?>;"><?php echo $row[7]?></td>
<td style="<?php echo $myStyle?>;"><?php echo $row[8]?></td>
<td style="<?php echo $myStyle?>;"><?php echo $row[9]?></td>
<td style="<?php echo $myStyle?>;"><?php echo $row[10]?></td>
<td style="<?php echo $myStyle?>;"><?php echo $row[11]?></td>
<td style="<?php echo $myStyle?>;"><?php echo $row[12]?></td>
<td style="<?php echo $myStyle?>;"><?php echo $row[13]?></td>
<td style="display:none">
<img style="cursor:pointer" src="img/icons/icons15.png" title="Edit Salary" height="20" width="17" onclick="editDynamic('salary/edit.php','<?php echo base64_encode($row[0])?>','fetchrow<?php echo $i?>','edit')" />&nbsp;&nbsp;
<img style="cursor:pointer" src="img/icons/icons4.png" title="Delete Salary" height="20" width="13" onclick="deleteSingle('<?php echo $row[0]?>','fetchrow<?php echo $i?>','salary')"/>

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