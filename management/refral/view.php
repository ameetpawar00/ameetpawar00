<?php
include("../../include/conFig.php");
$sql = "SELECT  * FROM `refer` WHERE  `delete` = '0' ";
$sql = "SELECT  `refer`.`approval`,`refer`.`id` as `rid`, `refer`.`c_name`, `refer`.`qualification`, `refer`.`experience`, `refer`.`designation`, `refer`.`contact`, `refer`.`referby`, `refer`.`email`, `jobvacancy`.`id`, `jobvacancy`.`designation` FROM `refer`,`jobvacancy` WHERE `jobvacancy`.`id` = `refer`.`jid`";

$getData = mysql_query($sql,$con) or die(mysql_error());
$Num_Rows = mysql_num_rows($getData);
	$Per_Page = 25;   // Per Page
	include('../pagination/pagination.php');
	$folder= 'refral/view';
	$title = 'Refral';
?>

<div id="myTitle">
	<div class="title">View Refral Candidates</div>
	<div class="strip">
	<span>Dashboard</span>
	<span>Job Refral</span>
	<span>View</span>
	</div>
</div>

<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
<button class="button red" onclick="deleteData('refer','refral')"> <i class="delete-icon"></i>Delete</button>&nbsp;
</td>

</tr>
</table>
<div style="height:350px;overflow:auto" id="mainDivId">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
<tr><th style="width:5%; height: 30px;"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" /></th>

	<th style="height: 30px" >Job For</th>
	<th style="height: 30px" >Name</th>
    <th style="height: 30px" >Email</th>
	<th style="height: 30px">Qualification</th>
	<th style="height: 30px">Experience</th>
	<th style="height: 30px">Refer By</th>
	<th style="height: 30px">Resume</th>
	<th style="height: 30px">Contact</th>
	<th style="height: 30px">Status</th>	
</tr>
<?php
$i = 1;
//$sql .=" order by `id` ASC LIMIT $Page_Start , $Per_Page";
$values = mysql_query($sql,$con)or die(mysql_error());
while($row =mysql_fetch_array($values))
{
	
$id=$row['rid'];
$desig = $row['designation'];
$jvid = $row['id'];
$getDesig = mysql_query("SELECT `name` FROM `designation` WHERE `id` = '$desig'",$con) or die(mysql_error());
$rowDesig = mysql_fetch_array($getDesig);
?>
<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td style="height: 20px"><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row['id'];?>" /></td>
<td style="height: 20px" ><?php echo $rowDesig[0] ?></td>
<td style="height: 20px"><?php echo $row['c_name']?></td>
<td style="height: 20px" ><?php echo $row['email'] ?></td>
<td style="height: 20px"><?php echo $row['qualification']?></td>
<td style="height: 20px"><?php echo $row['experience']?></td>
<td style="height: 20px"><?php echo $row['referby']?></td>
<td style="cursor:pointer; height: 20px;" onclick="getModule('management/refral/viewresume?id=<?php echo $id ?>','manipulatemoodleContent','viewmoodleContent','RESUME')">
<img  src="img/1399030409_27-Edit Text.png" style="height:20px;width:20px;"/></td>
<td style="height: 20px"><?php echo $row['contact']?></td>

<td style="height: 20px">




		<?php 
		
		if($row['approval'] == '1') { $class='class = "active"';} else {$class= 'class ="deactive"';}
		
				if($row['approval'] == '1' OR $row['approval'] == 1) 
					{
						echo $aa=<<<AAA
									<div id="lev$row[0]"  $class   >	Approved
								</div>
AAA;

					} else {
						$c_name=$row["c_name"];
						$qualification=$row["qualification"];
						$experience=$row["experience"];
						$referby=$row["referby"];
						$email=$row["email"];
						$contact=$row["contact"];
						echo $aa=<<<AAA
									<div id="lev$row[0]"  $class   onclick="changeStatusnew('approval', 'refer', '$row[0]', 'lev', '$jvid', '$c_name', '$qualification', '$experience', '$referby', '$email', '$contact'">	Approve
								</div>
AAA;
							}
		?>

		
		
		
		
		
		
		
			
		
		
		
		

</td>
<?php
$i++;
$Maxid = $row['id'];
$MaxI = $i;
}
?>
</tr>
<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" >
</table>
</div>
<?php
include('../pagination/pages.php');
?>
