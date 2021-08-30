<?php
include("../../include/conFig.php");
$id = base64_decode($_POST['id']);
$action = $_POST['action'];
$type = $_GET['type'];
if($type==0)
{
	
//$getData = mysql_query("SELECT `emp_education.employee`,`emp_education.name`,emp_education.subject,emp_education.grade,emp_education.year,emp_education.way,emp_education.description,employee.id FROM employee,emp_education WHERE employee.id = education.employee AND emp_education.delete = '0' AND education.id = '$id'",$con) or die(mysql_error());
$getData = mysql_query("SELECT `emp_education`.`id`, emp_education.name,emp_education.subject,emp_education.grade,emp_education.year,emp_education.way,emp_education.description from `emp_education` WHERE  emp_education.delete = '0' AND emp_education.id = '$id' AND `type`=0",$con) or die(mysql_error());
$fetchData = mysql_fetch_array($getData);
$eid = $fetchData['eid'];



if($action == "edit")
{
?>
<td style="color:#000;">
<input class="input" name="req" title="isNotNull" id="eedu<?php echo $id?>0" style="width:100px" type="text" value="<?php echo $fetchData[1]?>" />
</td>
<td style="color:#000">
<input class="input" name="req" title="isNotNull" id="eedu<?php echo $id?>1" style="width:100px" type="text" value="<?php echo $fetchData[2]?>" />
</td>
<td style="color:#000">
<input class="input" name="req" title="isNotNull" id="eedu<?php echo $id?>2" style="width:100px" type="text" value="<?php echo $fetchData[3]?>" />
</td>
<td style="color:#000">
<input class="input" name="req" title="isNotNull" id="eedu<?php echo $id?>3" style="width:100px" type="text" value="<?php echo $fetchData[4]?>" />
</td>
<td style="color:#000">
<input class="input" name="req" title="isNotNull" id="eedu<?php echo $id?>4" style="width:100px" type="text" value="<?php echo $fetchData[5]?>" />
</td>
<td style="color:#000;">
<textarea class="input" name="req" title="isNotNull" id="eedu<?php echo $id?>5" style="width:50px" type="text"><?php echo $fetchData[6]?></textarea>
</td>
<td><img src="img/icons/icons11.png" title="Update" height="20" width="20" onclick="SaveData('employee/education/updateedu?id=<?php echo $id;?>&i=<?php echo $i;?>&type=0','eedu<?php echo $id?>','6','','','couResp','2')" />&nbsp;&nbsp;&nbsp;&nbsp;
<img src="img/icons/icons25.png" title="Cancel" height="20" width="13" onclick="editDynamic('employee/education/editedu.php','<?php echo base64_encode($fetchData[0])?>','<?php echo $_POST['rowid']?>','')"/>
</td>
<?php
}
else
{
?>
<td style="color:#000;width:120px"><?php echo $fetchData[1]?></td>
<td style="color:#000;width:120px"><?php echo $fetchData[2]?></td>
<td style="color:#000;width:120px"><?php echo $fetchData[3]?></td>
<td style="color:#000;width:120px"><?php echo $fetchData[4]?></td>
<td style="color:#000;width:120px"><?php echo $fetchData[5]?></td>
<td style="color:#000;width:120px"><?php echo $fetchData[6]?></td>

<td>
<img src="img/icons/icons15.png" title="Edit Education" height="20" width="17" onclick="editDynamic('employee/education/editedu.php','<?php echo base64_encode($fetchData[0])?>','<?php echo $_POST['rowid']?>','edit')" />&nbsp;&nbsp;&nbsp;&nbsp;
<img src="img/icons/icons4.png" title="Delete Education" height="20" width="13" onclick="deleteSingle('<?php echo $fetchData[0]?>','fetchrow<?php echo $i?>','education')"/>

</td>

<?php
}
}else{
	

$getData = mysql_query("SELECT `emp_education`.`id`, emp_education.name,emp_education.degree,emp_education.subject,emp_education.year,emp_education.description from `emp_education` WHERE  emp_education.delete = '0' AND emp_education.id = '$id' AND `type`=1",$con) or die(mysql_error());
$fetchData = mysql_fetch_array($getData);
$eid = $fetchData['eid'];
if($action == "edit")
{
?>
<td style="color:#000;">
<input class="input" name="req" title="isNotNull" id="eedu<?php echo $id?>0" style="width:100px" type="text" value="<?php echo $fetchData[1]?>" />
</td>
<td style="color:#000">
<input class="input" name="req" title="isNotNull" id="eedu<?php echo $id?>1" style="width:100px" type="text" value="<?php echo $fetchData[2]?>" />
</td>
<td style="color:#000">
<input class="input" name="req" title="isNotNull" id="eedu<?php echo $id?>2" style="width:100px" type="text" value="<?php echo $fetchData[3]?>" />
</td>
<td style="color:#000">
<input class="input" name="req" title="isNotNull" id="eedu<?php echo $id?>3" style="width:100px" type="text" value="<?php echo $fetchData[4]?>" />
</td>
<td style="color:#000">
<input class="input" name="req" title="isNotNull" id="eedu<?php echo $id?>4" style="width:100px" type="text" value="<?php echo $fetchData[5]?>" />
</td>
<td><img src="img/icons/icons11.png" title="Update" height="20" width="20" onclick="SaveData('employee/education/updateedu?id=<?php echo $id;?>&i=<?php echo $i;?>&type=1','eedu<?php echo $id?>','5','','','couResp','2')" />&nbsp;&nbsp;&nbsp;&nbsp;
<img src="img/icons/icons25.png" title="Cancel" height="20" width="13" onclick="editDynamic('employee/education/editedu.php','<?php echo base64_encode($fetchData[0])?>','<?php echo $_POST['rowid']?>','')"/>
</td>
<?php
}
else
{
?>
<td style="color:#000;width:120px"><?php echo $fetchData[1]?></td>
<td style="color:#000;width:120px"><?php echo $fetchData[2]?></td>
<td style="color:#000;width:120px"><?php echo $fetchData[3]?></td>
<td style="color:#000;width:120px"><?php echo $fetchData[4]?></td>

<td>
<img src="img/icons/icons15.png" title="Edit Education" height="20" width="17" onclick="editDynamic('employee/education/editedu.php','<?php echo base64_encode($fetchData[0])?>','<?php echo $_POST['rowid']?>','edit')" />&nbsp;&nbsp;&nbsp;&nbsp;
<img src="img/icons/icons4.png" title="Delete Education" height="20" width="13" onclick="deleteSingle('<?php echo $fetchData[0]?>','fetchrowa<?php echo $i?>','education')"/>

</td>

<?php
}
?>












<?php }?>