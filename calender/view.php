<?php
include("../include/conFig.php");
?>
<div id="myTitle">
<div class="title">Special Day Calender</div>
<div class="strip">
<span>Dashboard</span>
<span>Special Day Calender</span>
<span>View</span>
</div>
</div>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
<?php if(in_array('a_slcal',$thisper)) 
{
?>
<button class="button blue" onclick="getModule('calender/index','manipulateContent','viewContent','cal')"> <i class="plus"></i>New</button>&nbsp;
<?php } ?>
<?php if(in_array('d_slcal',$thisper)) 
{
?>

<button class="button red" onclick="deleteData('leavecalendar','calender')"> <i class="delete-icon"></i>Delete</button>&nbsp;
<?php } ?>
<button id='calshjo' class="button yellow" onclick="$('#mainDivId').width('50%');$('#leav_cal_inp').trigger('click');$('#calshjoh').show('fast');$('#calshjo').hide('fast');$('#mainDivId1').show('fast');"> <i class="fa fa-calendar"></i> Open Calendar</button>&nbsp;
<button style="display: none"  class="button red" id="calshjoh" onclick="$('#mainDivId').width('100%');$('#calshjo').show('fast');$('#mainDivId1').hide('fast');$('#calshjoh').hide('fast');"> <i class="fa fa-calendar-times-o"></i> Close Calendar</button>&nbsp;
</td>
</tr>
</table>
<div style="height:350px;overflow:auto;width: 100%;float: left;" id="mainDivId">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
<tr><th style="height: 30px"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>
<th style="height: 30px">Special Day</th>
<th style="height: 30px">In Time</th>
<th style="height: 30px">Date</th>
</tr>

<?php
$i = 1;
$y = date("Y");
$y1=$y-1;
$sql="SELECT * FROM `leavecalendar` WHERE `delete`='0' AND `holidayType`=1 AND (`year`='$y' OR `year`='$y1') ORDER BY `date` DESC";
$values = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($values))
{
	$ddt=date(('d-M-Y') ,strtotime($row['date']));
?>

<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" /></td>
<?php if(in_array('u_slcal',$thisper)) 
{
?>
<td class="link-blue" onclick="getModule('calender/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','calender')">
<?php 
echo "Market Off : ".$row["event"];
$eddt=$row["event"];
?>

</td>
<?php 
} 
else
{
?>
<td >
<?php 
echo "Market Off : ".$row["event"];
$eddt=$row["event"];
?>
</td>
<?php
}
?>

<td ><?php echo $row["inTime"] ?></td>


<td ><?php echo $row["date"] ?></td>
</tr>
<?php
$mcarray[]=array($ddt,$eddt);
$i++;
$Maxid = $row['id'];
$MaxI = $i;
}
$mcarray=json_encode($mcarray);
?>
<span id="jardata" style="display: none"  ><?php echo $mcarray;?></span>
<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
</table>
</div>
<div style="height:400px;overflow-x:hidden;overflow-y:scroll;width: 50%;float: left;" id="mainDivId1" onclick="">
<style>
	#mainDivId1 .calinner{
		width:100%;
	}
	#mainDivId1 .calc-table{
		width:100%;
	}
	#mainDivId1 .calc-table td.ing
		{
			background:#99e9b0 !important;
			color:#b82121 !important;
			border:1px #FFFF97 solid !important;
			cursor:pointer !important;
			height:20px !important;
		}
</style>	
<input id="leav_cal_inp" class="inputCalendar" class="input medium" name="" onclick="openCalender('calenderidx0','leav_cal_inp');setTimeout('axs()',1000)" readonly="readonly" style="display:none;width: 200px" type="" />
				<div id="calenderidx0" class="calender">
				</div>
</div>
<?php
include('../pagination/pages.php');
?>