<?php
$term = $_GET['term'];
include("../include/conFig.php");
$getData = mysql_query("SELECT city.id,city.name,city.modifieddate,exitdetails.name FROM city,exitdetails WHERE city.updatedby = exitdetails.id AND city.delete = '0' AND branch.name LIKE '$term%' ORDER BY branch.name ",$con) or die(mysql_error());
?>
<table id="viewtable" cellpadding="0" cellspacing="0" class="fetch" width="100%">
	<tr>
		<th>
		<input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th>
		<th>City Name</th>
		<th>Details</th>
	</tr>
	<?php
$i=0;
while($row = mysql_fetch_array($getData))
{
?>
	<tr id="fetchRow<?php echo $i;?>">
		<td style="width: 20px;">
		<input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[0];?>" /></td>
		<td onclick="getModule('masters/city/edit?id=<?php echo $row[0];?>&amp;i=<?php echo $i;?>','manipulateContent','viewContent','<?php echo $row[1]?>')" style="width: 300px;">
		<?php echo $row[1];?></td>
		<td id="details" style="width: 400px;"><?php echo "Last Updated By ".$row[3]." on ".date("d-m-Y H:i:s",strtotime($row[2]));?>
		</td>
	</tr>
	<?php
	
$i++;
$Maxid = $row[0];
$MaxI = $i;
}
?>
</table>
<div id="moreData">
</div>
<div class="moduleFoot">
		<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
		<span onclick="getModule('masters/branch/view','viewContent','manipulateContent','Branches')" style="cursor: pointer">
	<img alt="" src="images/back.png" style="vertical-align:middle; width: 6px;" /> 
	Back To List</span>

</div>


