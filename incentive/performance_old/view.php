


<div id="myTitle">
<div class="title">Performance Incentive
</div>
<div class="strip">
<span>Dashboard</span>
<span>Incentive</span>
<span>Performance </span>
<span>View</span>
</div>
</div>

<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>
<td style="width:70%" align="right">
<button class="button blue" onclick="getModule('incentive/performance/index','manipulateContent','viewContent','Performances Incentive')"> <i class="plus"></i>Add</button>&nbsp;
<button class="button red" onclick="deleteData('training','training')"> <i class="delete-icon"></i>Delete</button>&nbsp;
</td>
</tr>
</table>
<div style="height:400px;overflow-x:hidden;overflow-y:scroll" id="mainDivId">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
<tr><th style="width:5%"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>

<!--
<h2 class="title">Performance Incentive
<input class="teal awesome small" style="float:right;padding:13px" value="Add" type="button" onclick="getModule('incentive/performance/index','manipulateContent','viewContent','Performances Incentive')">

</h2>

<div style="background:#fff;height:500px;overflow-x:hidden;overflow-y:auto">

<table width="100%" cellpadding="5" cellspacing="0" style="text-align:center;border-bottom:none;color:#000" class="fetch" >
<tr><th style="width:5%; height: 30px;"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>-->
<th >Designation</th>
<th>From </th>
<th>To</th>
<th>Performance</th>
<th>OutOf</th>
<th>Action</th>
<th>Type</th>
<th>Value</th>
<th>Status</th>
<th>Operation</th>
</tr>


<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td style="height: 30px"><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" /></td>
<td onclick="getModule('incentive/attendance/index?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Attendace Incentive')><?php echo $row[9];?></td>
<td><?php echo $row[1];?></td>
<td><?php echo $row[2];?></td>
<td><?php echo $row[7];?></td>
<td><?php echo $row[8];?></td>
<td>
<?php 
if($row[3] == "1")
{
echo "Add";
}
elseif($row[3] == "2")
{
echo "Deduct";
}
?></td>
<td>
<?php 
if($row[4] == "1")
{
echo "Flat";
$valueSymbl = "RS";
}
elseif($row[4] == "2")
{
echo "Percent";
$valueSymbl = "%";
}
?>
</td>
<td><?php echo $row[5]." ".$valueSymbl;?></td>
<td>
<center>
<div style="width:60px" id="invAt<?php echo $row[0]?>" onclick="changeStatus('status','incentiveattendance','<?php echo $row[0]?>','invAt')" <?php if($row[6] == '1') {echo 'class = "button green"';} else {echo 'class ="button red"';}?>   ></div>
</center></td>
<td>
<img src="img/icons/icons15.png" title="Edit" height="20" width="20" onclick="getModule('incentive/attendance/index?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Attendace Incentive')"/>&nbsp;&nbsp;&nbsp;&nbsp;
<img src="img/icons/icons4.png" title="Delete " height="20" width="20" onclick="deleteSingle('<?php echo $row[0]?>','fetchrow<?php echo $i?>','incentiveattendance')"/>

</td>
</tr>


<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
</table>
<br/><br/><br/><br/><br/><br/>
</div>
