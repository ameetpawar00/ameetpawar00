<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
//echo "INSERT INTO `companydetail` (`name`, `address`, `email`, `city`, `state`, `pincode`, `panname`, `footnote`, `logo`, `createdate`, `updatedby`, `delete`) VALUES ('$post[0]', '$post[2]', '$post[1]', '$post[4]', '$post[3]', '$post[5]', '$post[6]', '$post[7]','$post[8]','$datetime', '$hrmloggedid', '0')";
mysql_query("INSERT INTO `companydetail` (`name`, `address`, `email`, `city`, `state`, `pincode`, `panname`, `footnote`, `logo`, `createdate`, `updatedby`, `delete`) VALUES ('$post[0]', '$post[2]', '$post[1]', '$post[4]', '$post[3]', '$post[5]', '$post[6]', '$post[7]','$post[8]','$datetime', '$hrmloggedid', '0')",$con) or die(mysql_error());
$id = mysql_insert_id();
$getData = mysql_query("SELECT * FROM `companydetail` WHERE `delete` = '0' AND `id` = '$id' ",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
<div class="success warnings">
Company Detail Successfully Uploadeds
</div>
BREAKSTRINGFORSAVEDATA
<td><input id="chBxPUTGENERATEDIHEREINNS" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
<?php if(in_array('u_emp',$thisper)) 
{
?>
<td class="link-blue" onclick="getModule('masters/companydetails/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Company Detail')"><?php echo $row[1]?></td>
<?php 
} 
else
{
?>
<td ><?php echo $row[1]?></td>
<?php
}
?>

<td><?php echo $row[3]?></td>
<td><?php echo $row[9]?></td>


