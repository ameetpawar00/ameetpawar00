<?php
include("../../include/conFig.php");
$sql = "SELECT team.name,team.modifieddate,employee.name,team.id,team.desc FROM team,employee WHERE team.leader= employee.id AND team.delete = '0' ORDER BY team.id DESC";
$getData = mysql_query($sql,$con) or die(mysql_error());
?>
<div id="myTitle">
<div class="title">View All Team</div>
<div class="strip">
<span>Dashboard</span>
<span>Team</span>
<span>View</span>
</div>
</div>
<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>



<td style="width:30%"></td>
<td style="width:70%" align="right">
<?php if(in_array('a_team',$thisper)) 
{
?>
<button class="button blue" onclick="getModule('masters/team/index','manipulateContent','viewContent','team')"> <i class="plus"></i>New Team</button>&nbsp;
<?php 
} 
?>
<?php if(in_array('d_MPFKPI',$thisper)) 
{
?>
<button class="button red" onclick="deleteData('team','Team')"> <i class="delete-icon"></i>Delete</button>&nbsp;
<?php 
} 
?>&nbsp;<button class="button gray" onclick="getModule('masters/index','manipulateContent','viewContent','Setup');">
		<i class="back"></i>Back</button>
</td>
</tr>
</table>
<div style="height:350px;overflow:auto" id="mainDivId">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
<tr><th style="width:5%"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>

<th style="width: 200px">Team Name</th>
		<th style="width: 200px">Team Leader</th>
		<th style="min-width: 400px">Description</th></tr>
<?php
$i = 1;
while($row =mysql_fetch_array($getData))
{
?>
<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" ></td>
<td class="link-blue" onclick="getModule('masters/team/edit?id=<?php echo $row[3];?>&i=<?php echo $i;?>','manipulateContent','viewContent','Team')">
		<?php echo $row[0];?></td>
<td>
<?php echo $row[2];?>	
</td>	
	<td id="details">
	<?php echo $row[4];?>		
		</td></tr>
<?php
$i++;
$Maxid = $row['id'];
$MaxI = $i;
}
?>
<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" >
</table>
</div>
<?php
include('../../pagination/pages.php');
?>