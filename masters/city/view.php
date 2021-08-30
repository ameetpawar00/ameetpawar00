<?php
include("../../include/conFig.php");
?>
<h2 class="title">View All City
<span style="display:inline-block;"><?php echo $_GET['msg']?>
</span>
<span style="display:inline-block;margin-left:580px;display:none">
<input name="Text1" type="text" class="input" style="vertical-align:top" placeholder="Search Here" id="search"/>
<img src="images/search.png" style="height:24px;width:24px;cursor:pointer" onclick="getModule('masters/city/search?term='+document.getElementById('search').value,'manipulateContent','viewContent','City')"/>
</span>
<?php 
if(in_array('D_M2',$thisPer))
{
?>
<div class="red awesome small" style="float:right;margin-left:10px" onclick="deleteData('city','City')" >Delete Selected</div>&nbsp;&nbsp;&nbsp;
<?php } 
if(in_array('A_M2',$thisPer))
{
?>
<div class="orange awesome small" onclick="getModule('masters/city/index','manipulateContent','viewContent','City')" style="float:right">+ Add City</div>
<?php } ?>
</h2>
<div style="background:#fff;height:500px;overflow-x:hidden;overflow-y:auto">
<table width="100%" cellpadding="5" cellspacing="0" style="text-align:center" class="fetch">
<tr><th style="width:5%"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox" /></th><th style="width:20%">Name</th><th>State</th><th>Description</th><th>Modified</th><th>Action</th>
</tr>
<?php
$i = 1;
$getData = mysql_query("select city.id,city.name,city.description,state.name,state.id,city.modifieddate from city,state where city.delete= '0' and city.state=state.id    ORDER BY city.`name` asc limit 50",$con)or die(mysql_error());
while($row =mysql_fetch_array($getData))
{
?>
<tr <?php if($_GET['id']==$row['id']){?> class="d<?php echo $i%2?>" <?php } else { 'class="showmessage"';}?> id="fetchrow<?php echo $i?>">
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
<td><?php echo $row[1] ?></td>
<td><?php echo $row[3] ?></td>
<td><?php echo $row[2] ?></td>
<td><?php echo date('d-M-Y h:i:s',strtotime($row[5])) ?></td>
<td>
<?php 
if(in_array('U_M2',$thisPer))
{
?>
<img src="images/edit.png" title="Edit City <?php echo $row['name']?>" height="20" width="20" onclick="getModule('masters/city/edit?id=<?php echo $row[0]?>&i=<?php echo $i?>','manipulateContent','viewContent','States')"/>&nbsp;&nbsp;&nbsp;&nbsp;
<?php } 
if(in_array('D_M2',$thisPer))
{
?>
<img src="images/delete.png" title="Delete City <?php echo $row['name']?>" height="20" width="20" onclick="deleteSingle('<?php echo $row[0]?>','fetchrow<?php echo $i?>','city')"/>
<?php } ?>
</td>
</tr>
<?php
$i++;
$Maxid = $row[0];
$MaxI = $i;
}
?>
<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />

</table>

</div>
<?php
if($i > 50)
{
?>
<div id="morecontent"></div>
<div style="width:99%;padding:5px;background:#eee;text-align:left;border-top:2px #999 solid">
<div style="float:right;margin-right:10px;">
<select name="Select1" class="input" onchange="fetchMore('masters/city/more?count='+this.value,'fetchData','morecontent')">
				<option value="10">Get 10 Records</option>
				<option value="50">Get 50 Records</option>
				<option value="100">Get 100 Records</option>
				<option value="200">Get 200 Records</option>
				<option value="500">Get 500 Records</option>
				<option value="1000">Get 1000 Records</option>
				<option value="2000">Get 2000 Records</option>
				<option value="ALL">All</option>
			</select>
</div>
<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
<span style="color:#3399FF;;cursor:pointer;font-weight:bold;font-size:14px;" onclick="fetchMore('masters/city/more?count=10','fetchData','morecontent')" id="fetching">
More</span>
<br/><br/>
</div>
<?php
}
?>

