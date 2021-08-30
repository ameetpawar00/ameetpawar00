<?php
include("../../include/conFig.php");
?>
<h2 class="title">Salary Incentive
<input class="teal awesome small" style="float:right;padding:13px" value="Add" type="button" onclick="getModule('incentive/salary/index','manipulateContent','viewContent','Salary Incentive')">

</h2>

<div style="background:#fff;height:500px;overflow-x:hidden;overflow-y:auto">

<table width="100%" cellpadding="5" cellspacing="0" style="text-align:center;border-bottom:none;color:#000" class="fetch" >
<tr><th style="width:5%; height: 30px;"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>
<th>Employee Name</th>
<th >Gross Salay</th>
<th>Bonus </th>
<th>Total Salary</th>
<th>Operation</th>
</tr>
<?php
$i=1;
$getData = mysql_query("select incentivesalary.id,incentivesalary.gross,incentivesalary.bonus,incentivesalary.eid,employee.id,employee.name  from incentivesalary,employee where incentivesalary.delete = '0' and employee.delete = '0' and incentivesalary.eid = employee.id",$con)or die(mysql_error());
while($row= mysql_fetch_array($getData))
{
?>

<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td style="height: 30px"><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" ></td>
<td style="height: 30px"><?php echo $row[5];?></td>

<td style="height: 30px"><?php echo $row[1];?></td>
<td style="height: 30px"><?php echo $row[2];?></td>
<?php $ts =$row[1]+$row[2]; ?>
<td style="height: 30px"><?php echo $ts ?></td>


<td style="height: 30px">
<img src="img/icons/icons15.png" title="Edit" height="20" width="20" onclick="getModule('incentive/salary/index?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Salary Incentive')">&nbsp;&nbsp;&nbsp;&nbsp;
<img src="img/icons/icons4.png" title="Delete " height="20" width="20" onclick="deleteSingle('<?php echo $row[0]?>','fetchrow<?php echo $i?>','incentivereferral')">

</td>
</tr>
<?php
$i++;
}
?>

<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" >
</table>
<br/><br/><br/><br/><br/><br/>
</div>
