<?php
    include("../../include/conFig.php");
    $valto = $_POST['valto'];
    $valto = explode("*$*$*",$valto);
    foreach($valto as $val)
    {
        $val = str_ireplace("'","\'",$val);
        $post[] .= $val;
    }
    mysql_query("INSERT INTO `designation`(`name`,`description`,`department`, `createdate`, `modifieddate`, `updatedby`, `delete`) VALUES ('$post[0]','$post[1]','$post[2]','$datetime','$datetime','$hrmloggedid','0')",$con) or die(mysql_error());
    $id = mysql_insert_id();
    $getData = mysql_query("SELECT `designation`.*,`department`.`name` as pname FROM `designation`,`department` WHERE `designation`.`department`=`department`.`id` AND `id` = '$id' AND `delete`='0'",$con) or die(mysql_error());
    $row = mysql_fetch_array($getData);

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
    Designation Saved Successfully</div>
BREAKSTRINGFORSAVEDATA
<td><input id="chBxPUTGENERATEDIHEREINNS" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" ></td>
<td class="link-blue" onclick="getModule('masters/designation/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','Designation')"><?php echo $row['name'] ?></td>
<td ><?php echo $row['description'] ?></td>
<td ><?php echo $row['pname'] ?></td>
<td ><?php echo $statusas ?></td>
<td ><?php echo date('d-M-Y h:i:s',strtotime($row['modifieddate'])) ?></td>

