<?php
include("../include/conFig.php");
$id = base64_decode($_POST['id']);
$action = $_POST['action'];
$getData = mysql_query("SELECT * FROM `salary` WHERE `delete` = '0' AND `id` = '$id'",$con) or die(mysql_error());
$fetchData = mysql_fetch_array($getData);
$eid = $fetchData['eid'];
//print_r($fetchData);
if($action == "edit")
{
?>
<td>
<input class="input" name="req" title="isNotNull" id="esal<?php echo $id?>0" style="width:75px" type="text" value="<?php echo $fetchData[2]?>" />
</td>
<td>
<input class="input" name="req" title="isNotNull" id="esal<?php echo $id?>1" style="width:75px" type="text" value="<?php echo $fetchData[3]?>" />
</td>
<td>
<input class="input" name="req" title="isNotNull" id="esal<?php echo $id?>2" style="width:70px" type="text" value="<?php echo $fetchData[4]?>" />
</td>
<td>
<input class="input" name="req" title="isNotNull" id="esal<?php echo $id?>3" style="width:70px" type="text" value="<?php echo $fetchData[5]?>" />
</td>
<td>
<input class="input" name="req" title="isNotNull" id="esal<?php echo $id?>4" style="width:70px" type="text" value="<?php echo $fetchData[6]?>" />
</td>
<td>
<input class="input" name="req" title="isNotNull" id="esal<?php echo $id?>5" style="width:70px" type="text" value="<?php echo $fetchData[7]?>" />
</td>
<td>
<input class="input" name="req" title="isNotNull" id="esal<?php echo $id?>6" style="width:70px" type="text" value="<?php echo $fetchData[8]?>" />
</td>
<td>
<input class="input" name="req" title="isNotNull" id="esal<?php echo $id?>7" style="width:70px" type="text" value="<?php echo $fetchData[9]?>" />
</td>
<td>
<input class="input" name="req" title="isNotNull" id="esal<?php echo $id?>8" style="width:70px" type="text" value="<?php echo $fetchData[10]?>" />
</td>
<td>
<input class="input" name="req" title="isNotNull" id="esal<?php echo $id?>9" style="width:70px" type="text" value="<?php echo $fetchData[11]?>" />
</td>
<td>
<input class="input" name="req" title="isNotNull" id="esal<?php echo $id?>10" style="width:70px" type="text" value="<?php echo $fetchData[12]?>" />
</td>

<td><img src="img/icons/icons11.png" title="Update" height="20" width="20" onclick="SaveData('salary/update?id=<?php echo $id;?>&i=<?php echo $i;?>','esal<?php echo $id?>','11','','','couResp','2')" />&nbsp;&nbsp;
<img src="img/icons/icons25.png" title="Cancel" height="20" width="20" onclick="editDynamic('salary/edit.php','<?php echo base64_encode($fetchData[0])?>','<?php echo $_POST['rowid']?>','')"/>
</td>                                                                          
<?php
}
else
{
if($row['increment'] == '1') 
{
$title  = 'title="Increment"';
$myStyle = 'color:green;font-weight:bold;"';
}
else if($row['increment'] == '2')
{
$title ='title="Decrement"';
$myStyle = 'color:maroon;font-weight:bold;"';
}
else 
{
$title = 'title="Starting Salary"';
$myStyle = 'color:#000;font-weight:bold;"';
}
?>
<td style="<?php echo $myStyle?>;width:90px;"><?php echo $fetchData[2]?></td>
<td style="<?php echo $myStyle?>;width:90px"><?php echo $fetchData[3]?></td>
<td style="<?php echo $myStyle?>;width:80px"><?php echo $fetchData[4]?></td>
<td style="<?php echo $myStyle?>;width:80px"><?php echo $fetchData[5]?></td>
<td style="<?php echo $myStyle?>;width:80px"><?php echo $fetchData[6]?></td>
<td style="<?php echo $myStyle?>;width:80px"><?php echo $fetchData[7]?></td>
<td style="<?php echo $myStyle?>;width:130px"><?php echo $fetchData[8]?></td>
<td style="<?php echo $myStyle?>;width:130px"><?php echo $fetchData[9]?></td>
<td style="<?php echo $myStyle?>;width:130px"><?php echo $fetchData[10]?></td>
<td style="<?php echo $myStyle?>;width:130px"><?php echo $fetchData[11]?></td>
<td style="<?php echo $myStyle?>;width:130px"><?php echo $fetchData[12]?></td>
<td>
<img src="img/icons/icons15.png" title="Edit Salary" height="20" width="20" onclick="editDynamic('salary/edit.php','<?php echo base64_encode($fetchData[0])?>','<?php echo $_POST['rowid']?>','edit')" />&nbsp;&nbsp;
<img src="img/icons/icons4.png" title="Delete Salary" height="20" width="20" onclick="deleteSingle('<?php echo $fetchData[0]?>','fetchrow<?php echo $i?>','salary')"/>

</td>

<?php
}

?>
