<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$sel = $_GET['sel'];
$valto = explode("*$*$*",$valto);
$travelid = $_GET['travelid'];
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("INSERT INTO `events`(`name`, `venue`, `date`, `time`,  `department`, `descripion`, `createdate`, `updatedby`, `delete`) VALUES ('$post[0]', '$post[1]', '$post[2]', '$post[3]', '$sel', '$post[5]', '$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
$id = mysql_insert_id();
$getData = mysql_query("SELECT * from `events` where `delete` = '0' AND `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
//print_r($row);
	$department_b="";
	
	$department_ar=explode(",",$row['department']);
	foreach($department_ar as $department_a)
	{
		$department_b.="'".$department_a."',";
	}
	
	$department_b=rtrim($department_b,",");
	//echo "<br>";
$sqlla="SELECT `name` FROM `department` WHERE `id` IN ($department_b)";
$valuesla = mysql_query($sqlla,$con)or die(mysql_error());
$name="";
while($rowa =mysql_fetch_array($valuesla))
{
	$name.="<li style='list-style-type: disc;list-style: inside;'>".$rowa['name']."</li>";
}

?>
<div class="success warnings">
Event Updated Successfully</div>
BREAKSTRINGFORSAVEDATA
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $id;?>" /></td>
<?php if(in_array('u_lcal',$thisper)) 
{
?>
<td style="height: 20px;" class="link-blue"  onclick="getModule('management/events/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Event Schedule')"><?php echo $row['name'] ?></td>
<?php 
} 
else
{
?>
<td ><?php echo $row['name']?></td>
<?php
}
?>

<td style="height: 20px;" ><?php echo  $row['descripion'] ?></td>
<td style="height: 20px;" ><?php echo  "On ".$row['time']." At ". $row['date'] ?></td>
<td style="height: 20px;" ><?php echo  $row['venue'] ?></td>
<td style="height: 20px;" ><ul><?php echo $name ?></ul></td>