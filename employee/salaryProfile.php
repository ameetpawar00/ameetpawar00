<?php
include("../include/conFig.php");
$empId = $_REQUEST['eid'];
$sql = mysql_query("SELECT `employee`, `month`, `year`, `basic`, `con_allow`, `spec_allow`, `other_allow`, `perf_allow`, `att_allow`, `perf_Bonus`, `train_allow`, `travel_allow` FROM `salaryslip` WHERE `employee` = '$empId' ORDER BY `month` DESC",$con)or die(mysql_error());
?>
<div id="myTitle">
<div class="title">View Salary Profile</div>
<div class="strip">
<span>Dashboard</span>
<span>View Salary Profile</span>
<span>View</span>
</div>
</div>

<div style="height:400px;overflow-x:hidden;overflow-y:scroll" id="mainDivId">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
<tr>
<th>Year</th>
<th>Month</th>
<th>Basic</th>
<th>Conveyance All.</th>
<th>Special All.</th>
<th>Other All.</th>
<th>Perfo All.</th>
<th>Attendance All.</th>
<th>Training All.</th>
<th>Mobile All.</th>

<th>Perfo Bonus</th>
</tr>
<?php
while($getResult = mysql_fetch_array($sql)){
?>
<tr>
<td><?php echo $getResult[2];?></td>
<td><?php echo $getResult[1];?></td>
<td><?php echo $getResult[3];?></td>
<td><?php echo $getResult[4];?></td>
<td><?php echo $getResult[5];?></td>
<td><?php echo $getResult[6];?></td>
<td><?php echo $getResult[7];?></td>
<td><?php echo $getResult[8];?></td>
<td><?php echo $getResult[10];?></td>
<td><?php echo $getResult[11];?></td>
<td><?php echo $getResult[9];?></td>

</tr>
<?php
}?>
<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
</table>
<br/><br/><br/><br/><br/><br/>
</div>

