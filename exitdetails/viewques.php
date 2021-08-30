<?php
include("../include/conFig.php");
$sepid = $_GET['id'];
$getData = mysql_query("SELECT seperationquestion.id,exitquestions.name,seperationquestion.answer FROM seperationquestion,exitquestions WHERE seperationquestion.quesid = exitquestions.id AND seperationquestion.delete = '0' AND seperationquestion.sepid = '$sepid'",$con) or die(mysql_error());

?>
<div id="myTitle" style="padding-bottom:5px">
<div class="title" style="display:inline-block">Questionairre</div>
</div>
<!--
<div class="nonboxy-widget">
	<div class="widget-head">
		<h5 align="left">Questionairre
</h5>
	</div>
</div>-->
<div style="height:400px;overflow-x:hidden;overflow-y:scroll" id="">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable1">
<tr>
	<th>Question</th>
	<th>Answer</th>
	<th>Action</th>
</tr>
<?php
$i = 1;
while($row =mysql_fetch_array($getData))
{
?>
<tr  class="d<?php echo $i%2?>"  id="fetchrow<?php echo $i?>">
<td style="color:#000;width:300px"><?php echo substr($row[1],0,75);?></td>
<td style="color:#000;width:350px"><?php echo substr($row[2],0,75);?></td>
<td>
<img style="cursor:pointer" src="img/icons/icons15.png" title="Edit Questionairre" height="20" width="17" onclick="editDynamic('exitdetails/editques.php','<?php echo base64_encode($row[0])?>','fetchrow<?php echo $i?>','edit')" >&nbsp;&nbsp;&nbsp;&nbsp;
<img style="cursor:pointer" src="img/icons/icons4.png" title="Delete Questionairre" height="20" width="13" onclick="deleteSingle('<?php echo $row[0]?>','fetchrow<?php echo $i?>','seperationquestion')">
</td>
</tr>
<?php
$i++;
$Maxid = $row['id'];
$MaxI = $i;
}
?>
<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>" />
</table>

</div>
	



