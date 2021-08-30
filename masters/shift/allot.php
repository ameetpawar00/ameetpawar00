<?php
include("../../include/conFig.php");
$id = $_GET['id'];
 $val = $_GET['val'];
$i = $_GET['i'];
//echo "SELECT `employee`.`id`, `employee`.`name`, `employee`.`department`, `employee`.`designation`, `employee`.`shift` FROM `employee` WHERE `department`='$val' AND `delete`=0 AND `active`='1'";
$getData = mysql_query("SELECT `employee`.`id`, `employee`.`name`, `department`.`name`, `shift`.`name`, `shift`.`starttime`, `shift`.`endtime` FROM `employee` JOIN `department` ON `department`.`id`=`employee`.`department` JOIN `shift` ON `employee`.`shift`=`shift`.`id` WHERE `employee`.`department`='$val' AND `employee`.`delete`=0 AND `employee`.`active`='1'",$con) or die(mysql_error());
//$row = mysql_fetch_array($getData);


?>
<table cellpadding="0" cellspacing="0" width="100%" border="1">
	<tr>
		<th>Select <input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox"></th>
		<th>Name </th>
		<th>Department </th>
		<th>Shift </th>
		
	</tr>
	
	<?php
						
			
		$counter=1;	
	while($row = mysql_fetch_array($getData))
		{
			

			echo $out=<<<AAA
				<tr>
					<td>
						<input id="chBx$counter" name="Checkbox[]" type="checkbox" value="$row[0]" >
					</td>
					<td>$row[1] </td>
					<td>$row[2] </td>
					<td>$row[3] : $row[4] TO $row[5]  </td>
					
					
				</tr>
			
AAA;

$counter++;
		}
		
	?>
	
	
</table>

<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $counter.'--'.$counter;?>" />
