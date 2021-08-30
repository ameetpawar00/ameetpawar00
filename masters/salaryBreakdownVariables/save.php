<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("INSERT INTO `salary_structure_variables_new`(`variable_name`,`type`, `createdate`, `updatedate`, `updateby`, `delete`) VALUES ('$post[0]','$post[1]','$datetime','$datetime','$hrmloggedid','0')",$con) or die(mysql_error());
$id = mysql_insert_id();
$getData = mysql_query("SELECT * FROM `salary_structure_variables_new` WHERE `id` = '$id' AND `delete`='0'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>

<div class="success warnings">
    Variable Saved Successfully
</div>
BREAKSTRINGFORSAVEDATA
<td><input id="chBxPUTGENERATEDIHEREINNS" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
<td class="link-blue" onclick="getModule('masters/salaryBreakdownVariables/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Variables')"><?php echo $row['variable_name'] ?></td>
<td>
    <?php
    $arrayType=array(0=>"None",1=>"Salary Component",2=>"Earnings",3=>"Deductions");
    echo $arrayType[$row['type']];
    ?>

</td>
<td ><?php echo date('d-M-Y h:i:s',strtotime($row['updatedate'])) ?></td>







