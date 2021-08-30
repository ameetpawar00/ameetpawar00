<?php
include("../include/conFig.php");
error_reporting(0);
include("../include/conFig.php");
include("../include/leave_calculation.php");
include("../include/calculateLeave.php");

$sql = "SELECT `id`,`name`,`username` FROM `employee` WHERE `delete`= '0' AND `id` = '$hrmloggedid'";
$getemp = mysql_query($sql,$con) or die(mysql_error());
$rowemp = mysql_fetch_array($getemp);
?>
<div id="myTitle">
<div class="title">Attendance Of &nbsp;<span style="color:green"><?php echo $rowemp[1];?></span></div>
<div class="strip">
<span>Dashboard</span>
<span>This month attendance</span>
</div>
</div>



<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
<tr>
<td style="width:30%"></td>
<td style="width:70%" align="right">
</td>
</tr>
</table>

<div style="height:400px;overflow-x:hidden;overflow-y:scroll" id="mainDivId">
<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
				<tr>
		<th>Date</th>
			<th>Day</th>
			<th>CheckIn</th>
			<th>CheckOut</th>
			<th>Total Hours</th>
			<th>Status</th>
			</tr>
			<?php
			$year = date("Y");
$mnth = date('m');

$getAtt = mysql_query("SELECT `date`,`checkin`,`checkout`,`attendance` FROM `attendance` WHERE `delete`= '0' AND MONTH(`createdate`) ='$mnth' AND  YEAR(`createdate`) ='$year' AND `employee` = '$hrmloggedid'",$con) or die(mysql_error());
while($rowAtt = mysql_fetch_array($getAtt))
{
?>
<tr  class="d<?php echo $i%2;?>" id="fetchrow<?php echo $i?>">
		<td><?php echo $rowAtt[0]; ?></td>
			<td><?php echo $day = strftime("%A",strtotime($rowAtt[0]));; ?></td>
			<td><?php echo $rowAtt[1]; ?></td>
			<td><?php echo $rowAtt[2]; ?></td>
			
			<td><?php 
			if($rowAtt[1] == '0000-00-00 00:00:00' || $rowAtt[2] == '0000-00-00 00:00:00')
			{
			echo '0';
			}
			else
			{
			echo $totalH = getTimeDifference($rowAtt[1],$rowAtt[2]);
			}
			
			?></td>
			<td>
			<?php 
			if($rowAtt[3] == '1')
			{
				echo 'Full Day Verified By HR';
				$fd++;
			}
			else if($rowAtt[3] == '2')
			{
				echo 'Half Day Verified By HR';
				$hd++;
			}
			else if($rowAtt[3] == '3')
			{
				echo 'Absent Verified By HR';
				$ab++;
			}
			else if ($rowAtt[3] == '0')
			{
					if($rowAtt[2] != "00:00:00")	
					{
						$totalHour = getTimeDifference($rowAtt[1],$rowAtt[2]);
						if($day == 'Saturday')
						{
							if($totalHour < 0)
							{
								echo "Absent";
								$ab++;
							}
							else if($totalHour >= 0 && $totalHour > 5)
							{
								echo "Halfday";
								$hd++;
							}
							else 
							{
								echo "Present";
								 $fd++;
							}
						}
						else
						{
							if($totalHour < 5)
							{
								echo "Absent";
								$ab++;
							}
							else if($totalHour >= 5 && $totalHour < 9)
							{
								echo "Halfday";
								$hd++;
							}
							else
							{
								echo "Present";
								$fd++;
							}
						}
						
						
					}
					else
					{
						echo "Absent";
						$ab++;
					}
					
			}
			?>
			</td>
		</tr>
<?php
$i++;
$Maxid = $row['id'];
$MaxI = $i;
} 
?>


</table>
</div>
