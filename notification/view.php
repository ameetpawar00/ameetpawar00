<?php
include("../include/conFig.php");
$desi = $_GET['desi'];
$sql = "SELECT  * from `jobvacancy` where `delete` = '0' and `vacancy` != '0'";
$getData = mysql_query($sql,$con) or die(mysql_error());
$Num_Rows = mysql_num_rows($getData);
	$Per_Page = 25;   // Per Page
	include('../pagination/pagination.php');
	$folder= 'Notification/view';
	$title = 'Refer Candidates';
?>

<div id="myTitle">
<div class="title">Refer Candidates</div>
<div class="strip">
<span>Dashboard</span>
<span>Notification</span>
<span>Refer Candidates</span>
</div>
</div>

<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
</td>

</tr>
</table>
<div style="height:400px;overflow-x:hidden;overflow-y:scroll" id="mainDivId">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
<tr><th style="width:5%; height: 30px;"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>

	<th style="height: 30px" >Post</th>
	<th style="height: 30px">Qualification</th>
	<th style="height: 30px">Vacancy</th>
	<th style="height: 30px">Salary Range</th>
	<th style="height: 30px">Experience</th>
	<th style="height: 30px">Last Date</th>
	<th style="height: 30px">Refer</th>

	
</tr>
<?php
$i = 1;
$sql .=" order by `id` ASC LIMIT $Page_Start , $Per_Page";
$values = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($values))
{
	
$desig = $row['designation'];
$getDesig = mysql_query("SELECT `name` FROM `designation` WHERE `id` = '$desig'",$con) or die(mysql_error());
$rowDesig = mysql_fetch_array($getDesig);
?>
<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
<td style="height: 20px"><?php echo $rowDesig['name']?></td>
<td style="height: 20px"><?php echo $row['qualification']?></td>
<td style="height: 20px"><?php echo $row['vacancy']?></td>
<td style="height: 20px"><?php echo $row['salary']?></td>
<td style="height: 20px"><?php echo $row['experience']?></td>
<td style="height: 20px"><?php echo $row['lastdate']?></td>
<td>
<img style="cursor:pointer;margin-left:12px;" src="img/icons/1399375812_group.png" title="Refer CandidatesFor&nbsp;<?php echo $row[1]?>" height="20" width="17" onclick="getModule('notification/new?id=<?php echo $row['id']?>&desi=<?php echo $desig; ?>','manipulateContent','viewContent','Notification')"/>
</td>
<?php
$i++;
$Maxid = $row['id'];
$MaxI = $i;
}
?>
</tr>
<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" >
</table>
</div>
<?php
include('../pagination/pages.php');
?>
