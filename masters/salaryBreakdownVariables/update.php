<?php
include("../../include/conFig.php");
$valto = $_POST['valto'];
$i = $_GET['i'];
$id = $_GET['id'];
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}
mysql_query("UPDATE `salary_structure_variables_new` SET `variable_name`='$post[0]',`type`='$post[1]',`updatedate` = '$datetime', `updateby`  = '$hrmloggedid' WHERE `id` = '$id'",$con);

$getData=mysql_query("SELECT * FROM `salary_structure_variables_new` WHERE `id`='$id' AND `delete`='0'",$con)or die(mysql_error());
$row=mysql_fetch_array($getData);
?>
<div class="success warnings">
Variable Updated Successfully</div>
BREAKSTRINGFORSAVEDATA
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $id;?>"></td>
<td class="link-blue" onclick="getModule('masters/salaryBreakdownVariables/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Location')"><?php echo $row['variable_name'] ?></td>
<td>
    <?php
    $arrayType=array(0=>"None",1=>"Salary Component",2=>"Earnings",3=>"Deductions");
    echo $arrayType[$row['type']];
    ?>
</td>
<td ><?php echo date('d-M-Y h:i:s',strtotime($row['updatedate'])) ?></td>


