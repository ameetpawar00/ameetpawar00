<?php
include("../include/conFig.php");
$year=date("Y");
$year1=$year-1;
$sql = "SELECT * FROM `leavecalendar` WHERE (`year`='$year' OR `year`='$year1') AND `delete` = '0' AND `holidayType`='0'";
$getData = mysql_query($sql,$con) or die(mysql_error());
$Num_Rows = mysql_num_rows($getData);
	$Per_Page = 100;   // Per Page
	include('../pagination/pagination.php');
	$folder= 'leavecalendar/view';
	$title = 'Leave Calendar';
?>
<div id="myTitle">
<div class="title">View Leave Calendar</div>
<div class="strip">
<span>Dashboard</span>
<span>Leave Calendar</span>
<span>View</span>
</div>
</div>

<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>
<td style="width:70%" align="right">
<?php if(in_array('up_hlcal',$thisper)) 
{
?>
<button class="button green" onclick="getModule('leavecalendar/upload','manipulateContent','viewContent','Leave Calendar')"> <i class="plus"></i>Upload</button>&nbsp;
<?php 
} 
?>


<?php if(in_array('a_hlcal',$thisper)) 
{
?>
<button class="button blue" onclick="getModule('leavecalendar/add','manipulateContent','viewContent','Leave Calendar')"> <i class="plus"></i>Add New</button>&nbsp;
<?php 
} 
?>
<?php if(in_array('d_hlcal',$thisper)) 
{
?>
<button class="button red" onclick="deleteData('leavecalendar','Leave Calendar')"> <i class="delete-icon"></i>Delete</button>&nbsp;
<?php 
} 
?>
<button id='calshjo' class="button yellow" onclick="$('#mainDivId').width('50%');$('#leav_cal_inp').trigger('click');$('#calshjoh').show('fast');$('#calshjo').hide('fast');$('#mainDivId1').show('fast');"> <i class="fa fa-calendar"></i> Open Calendar</button>&nbsp;
<button style="display: none"  class="button red" id="calshjoh" onclick="$('#mainDivId').width('100%');$('#calshjo').show('fast');$('#mainDivId1').hide('fast');$('#calshjoh').hide('fast');"> <i class="fa fa-calendar-times-o"></i> Close Calendar</button>&nbsp;
</td>
</tr>
</table>



<div style="height:350px;overflow:auto;width: 100%;float: left;" id="mainDivId">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
<tr><th style="width:5%"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>
<th style="height: 20px">Event</th>
<th style="height: 20px">Date</th>
<!--<th style="height: 20px">Modified On</th>-->
</tr>
<?php
$i = 1;
$sql .=" ORDER BY `date` DESC LIMIT $Page_Start , $Per_Page";
$values = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($values))
{
?>
<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" /></td>
<!--<td style="height: 20px;" ><?php //echo $row['year'] ?></td>-->
<?php if(in_array('u_hlcal',$thisper)) 
{
?>
<td style="height: 20px;" class="link-blue"  onclick="getModule('leavecalendar/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Leave Calendar')"><?php echo $eddt=$row['event'] ?></td>
<?php 
} 
else
{
?>
<td ><?php echo $eddt=$row['event']?></td>
<?php
}
?>

<td style="height: 20px;" ><?php echo  $ddt=date(('d-M-Y') ,strtotime($row['date'])) ?></td>
<!--<td style="height: 20px;" ><?php //echo date(('d M,Y H:i:s') ,strtotime($row['updatedate'])) ?></td>-->
</tr>
<?php


$mcarray[]=array($ddt,$eddt);

$i++;
$Maxid = $row[0];
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
<script>/*$("#leav_cal_inp").trigger("click");$('td[title=01-Dec-2016]').addClass("ing")*/</script>
<?php
include('../pagination/pages.php');
?>