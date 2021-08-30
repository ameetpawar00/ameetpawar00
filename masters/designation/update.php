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

    //echo "UPDATE `designation` SET `name`='$post[0]',`description`='$post[1]',`department`='$post[2]',`modifieddate` = '$datetime', `updatedby`  = '$hrmloggedid' WHERE `id` = '$id'";
    mysql_query("UPDATE `designation` SET `name`='$post[0]',`description`='$post[1]',`department`='$post[2]',`status`='$post[3]',`modifieddate` = '$datetime', `updatedby`  = '$hrmloggedid' WHERE `id` = '$id'",$con);
    $getData=mysql_query("SELECT `designation`.*,`department`.`name` as pname FROM `designation`,`department` WHERE `designation`.`department`=`department`.`id` AND `designation`.`id`='$id' AND `designation`.`delete`='0'",$con)or die(mysql_error());
    $row=mysql_fetch_array($getData);
    if($row['status']==0)
    {
        $status= "Active";
        $statusas= "Active";
    }else{
        $status= "Inactive";
        $statusas= "<span style='color: red'>Inactive</span>";
    }
?>

<div class="success warnings">
    Designation Updated Successfully</div>
BREAKSTRINGFORSAVEDATA
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $id;?>"></td>
<td class="link-blue" onclick="getModule('masters/designation/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Designation')"><?php echo $row['name'] ?></td>
<td ><?php echo $row['pname'] ?></td>
<td ><?php echo $row['description'] ?></td>
<td ><?php echo $statusas ?></td>
<td ><?php echo date('d-M-Y h:i:s',strtotime($row['modifieddate'])) ?></td>

