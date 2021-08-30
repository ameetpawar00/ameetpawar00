<?php
include("../../include/conFig.php");
$eid = $_GET['eid'];
$name = $_GET['name'];
$getData = mysql_query("SELECT noteline.subject,noteline.createdate,noteline.updatedby,noteline.note,employee.name FROM noteline,employee WHERE noteline.employee = '$eid' AND employee.id = noteline.updatedby AND noteline.`delete`=0 ORDER BY `noteline`.`id` DESC" ,$con) or die(mysql_error());

?>

<div id="myTitle" style="padding-bottom:5px">
<div class="title" style="display:inline-block">Story Line For <?php echo $name?></div>


</div>


<br/>
<div style="height:550px;overflow-x:hidden;overflow-y:scroll" id="">

<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="">
<tr>
<td>
<?php 
$t= 0;
while($row = mysql_fetch_array($getData))
{
?>
<div id="noteL<?php echo $t;?>" style="background: #fff;width: 100%;height: auto;margin-top: 20px;-webkit-box-shadow: 0 0 8px #222;border-radius: 3px;">
				<div style="float: left; margin-top: 20px; margin-left: -8px;">
					</div>
				<div style="padding: 10px;">
				<img alt="" src="images/call.png" style="width: 15px; vertical-align: middle" />&nbsp;&nbsp;
				<strong><span style="color: #3B5998"><?php echo $row[0];?>
					</span>.
					</strong>
					<div style="float: right; font-size: 11px;; color: #888; font-style: italic">
						<?php echo $row[1];?>
						<br/>
						By <?php echo $row[4];
						?>
						
						</div>
					<br />
					<div style="border-top: 1px #eee solid; padding-top: 10px; margin-top: 5px;">
						<?php echo $row[3];?>
						</div>
					</div>
</div>
<?php
}
?>
	</td>
	</tr>
	</table>
	<br>
	<br>
	<br>
	<br>
	</div>

