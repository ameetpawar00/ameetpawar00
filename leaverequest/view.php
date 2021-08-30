<?php
include("../include/conFig.php");

$sql = "SELECT leaverequest.leavetype,leaverequest.days,leaverequest.fromdate,leaverequest.todate,leaverequest.updatedate,leaverequest.updatedby,leaverequest.status,leaverequest.id ,leaverequest.leavetime,leaverequest.extra from leaverequest where leaverequest.delete = '0' and leaverequest.updatedby = '$hrmloggedid'";
//$getData = mysql_query($sql,$con) or die(mysql_error());
//$Num_Rows = mysql_num_rows($getData);
//$Per_Page = 25;   // Per Page
//include('../pagination / pagination.php');
//$folder = 'leaverequest / view';
//$title = 'Leave Request';


//$getData = mysql_query("SELECT leaverequest.id,leaverequest.days,leaverequest.fromdate,leaverequest.todate,leaverequest.updatedate,leaverequest.updatedby,leavetype.name,leaverequest.status from leaverequest,leavetype where leaverequest.delete = '0' and leaverequest.leavetype = leavetype.id and leaverequest.updatedby = '$hrmloggedid' ORDER BY leaverequest.id desc LIMIT 100",$con) or die(mysql_error());

?>

<div id="myTitle">
	<div class="title">
		View Leave Request
	</div>
	<div class="strip">
		<span>
			Dashboard
		</span>
		<span>
			Leave Request
		</span>
		<span>
			View
		</span>
	</div>
</div>

<table width="100%" cellpadding="0" cellspacing="0" id="headerTable">
	<tr>
		<td colspan="2" style="text-align:center"  id="couRespView">
		</td>
	</tr>
	<tr>
		<td style="width:80%">
		


<?php
		$i = 1;
		$sql .= " order by leaverequest.id ASC";
		$mtta="";
		$LWP_A_C=0;
		$values = mysql_query($sql,$con)or die(mysql_error());
		while ($row = mysql_fetch_array($values)) 
		{

			$vds=$i % 2;
			$mtta.="<tr  class=\"d$vds\"  id=\"fetchrow$i\">
						<td>
							<input id=\"chBx$i\" name=\"Checkbox1\" type=\"checkbox\" value=\"$row[7]\" >
						</td>
						<td style=\"height: 20px\" class=\"\" >
							$row[0]
						</td>
						<td style=\"height: 20px\">";
					if ($row["leavetime"] == 1)
					$mtta.= "Full Day Leave";
					else
					if ($row["leavetime"] == 2)
					$mtta.= "First Half Leave";
					else
					$mtta.= "Second Half Leave";
				
				$mtta.="
				</td>
				<td style=\"height: 20px\" >
					$row[1]
				</td>
				<td style=\"height: 20px\" >
					".date(('d M,Y') ,strtotime($row[2]))."
				</td>
				<td style=\"height: 20px\" >
					".date(('d M,Y') ,strtotime($row[3]))."
				</td>
				<td style=\"height: 20px\" >
					".date(('d M,Y') ,strtotime($row[4]))."
				</td>
				<td style=\"height: 20px\" >";
					
					if (in_array('ap_lreq',$thisper)) {
				$mtta.= "<center>
							<div style=\"width:60px\" >
								";

								if ($row[6] == 1)
								{
									if($row[0]=="LWP")
									{$LWP_A_C=$LWP_A_C+$row[1];}
									$sstt="<span style='color:green'>Approved</span>";
									if($row[3]>=date('Y-m-d'))
									{}
										
									
										$xxa=<<<AAA
										<input type="button" class="button red" onclick="var r=confirm('Are You Sure Want to Cancel this leave'); if(r==true){checkLeave('$row[0]','$hrmloggedid','$row[2]','$row[3]','$row[7]','$row[6]','$i','$row[8]',7)}" value="Cancel" style="padding: 5px 0px;font-size: 12px;">
AAA;
									
								}elseif ($row[6] == 0)
									{
										$sstt="<span style='color:blue'>Waiting</span>";
										if($row[3]>=date('Y-m-d'))
									{
										
									}
										$xxa=<<<AAA
										<input type="button" class="button red" onclick="var r=confirm('Are You Sure Want to Cancel this leave'); if(r==true){checkLeave('$row[0]','$hrmloggedid','$row[2]','$row[3]','$row[7]','$row[6]','$i','$row[8]',6)}" value="Cancel" style="padding: 5px 0px;font-size: 12px;">
AAA;

									}else
										{
											$xxa="";
											if($row[9]==2)
											{
												$sstt="<span style='color:red'>Cancelled</span>";																	
											}else{
												$sstt="<span style='color:red'>Unapproved</span>";																	
											}	
										}
										//echo $row[9];
										if($row[9]==1 AND ($row[6] == 1 OR $row[6] == 0))
										{
											if($row[0]=="LWP")
												{
													//$LWP_A_C=$LWP_A_C+$row[1];
												}
											$xxa="";
											$sstt="<span style='color:red'>Waiting for Cancellation </span>";
										}
										
										$mtta.= $sstt;
								
							$mtta.= "</div>
						</center>";
						
					}
					$mtta.="</td><td>$xxa
				</td>
			</tr>";
			
			$i++;
			//$Maxid = $row[0];
			//$MaxI = $i;
		}
		?>
		<?php

$eid = $hrmloggedid;
$Cont="";
$Contadd="";
$sqlLeave = mysql_query("SELECT `EL`, `M`, `special`, `CL`, `SL`, `P` FROM `leaverecord` WHERE  `userid` = '".$eid."' AND `delete` = '0'",$con)or die(mysql_error());
$fetchQLeave = mysql_fetch_array($sqlLeave);
$EL_R=$fetchQLeave["EL"];
$M_R=$fetchQLeave["M"];
$special_R=$fetchQLeave["special"];
$CL_R=$fetchQLeave["CL"];
$SL_R=$fetchQLeave["SL"];
$P=$fetchQLeave["P"];
	$total_bal=$EL_R+$SL_R+$CL_R;		
	$sqlLeavey = mysql_query("SELECT `ALL`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`, `11`, `12` FROM `leaverecord_yearly` WHERE `userid` = '".$eid."' AND `delete` = '0'",$con)or die(mysql_error());
	$rowy =mysql_fetch_array($sqlLeavey);
	$rall=$rowy["ALL"];
	$rjan=$rowy[1];
	$rfeb=$rowy[2];
	$rmar=$rowy[3];
	$rapr=$rowy[4];
	$rmay=$rowy[5];
	$rjun=$rowy[6];
	$rjul=$rowy[7];
	$ragu=$rowy[8];
	$rsep=$rowy[9];
	$roct=$rowy[10];
	$rnov=$rowy[11];
	$rdec=$rowy[12];				
$Contadd=<<<AAA
<br>
<table cellpadding="0" cellspacing="0" width="100%" style="text-align:center"  border=1>
	<tr>
		<th>
			ELR/ELA
		</th>
		<th>
			SLR/SLA
		</th>
		<th>
			CLR/CLA
		</th>
		<th>
			P R/P A
		<th>
			M R/M A
		</th>
		<th>
			S R/S A
		</th>
		<th>
			T	 R/T A
		</th>
		<th style="background: #ffff0080;">
			LWP<br><small>(Excluded clumped leaves)</small>
		</th>
		
	</tr>

	<tr>
		<td>$EL_R/12</td>
		<td>$SL_R/6</td>
		<td>$CL_R/6</td>
		<td>$P/5</td>
		<td>$M_R/90</td>
		<td>$special_R/--</td>
		<td>$total_bal/24</td>
		<td style="background: #ffff0080;">$LWP_A_C</td>
	</tr>
	<tr>
	<td colspan="8"><small><b>All:-</b> $rall----[<b>JAN:- </b>$rjan]----[<b>FEB:- </b>$rfeb]----[<b>MAR:- </b>$rmar]----[<b>APR:- </b>$rapr]----[<b>MAY:- </b>$rmay]----[<b>JUN:- </b>$rjun]----[<b>JUL:- </b>$rjul]----[<b>AGU:- </b>$ragu]----[<b>SEP:- </b>$rsep]----[<b>OCT:- </b>$roct]----[<b>NOV:- </b>$rnov]----[<b>DEC:- </b>$rdec]</small></td>
</tr>
</table>
<span style="color:red;float: right;">**For Details Click on STORY BUTTON</span>
<br>
<br>

AAA;


echo $Contadd;

?>		
		</td>
		<td style="width:20%" align="right">
			<?php
			if (in_array('a_lreq',$thisper)) {
				?>
				<button class="button blue" onclick="getModule('leaverequest/index','manipulateContent','viewContent','Leave Request')">
					<i class="plus">
					</i>Request New
				</button>&nbsp;
				<?php
			}
			?>
			<?php
			if (in_array('d_lreq',$thisper)) {/*
				?>
				<button class="button red" onclick="deleteData('leaverequest','leaverequest')">
					<i class="delete-icon">
					</i>Delete
				</button>&nbsp;
				<?php
			*/}
			?>

			<div style="z-index:20000000000000000000;float:right">
				<div class="button green" style="position:fixed;top:50%;right:0px;cursor:pointer;padding:4px;" onclick="getModule('management/salary/story/view?eid=<?php echo $hrmloggedid?>&name=<?php echo $hrmloggeduser?>','manipulatemoodleContent','viewmoodleContent','Story Line')">
					Story
				</div>
			</div>
		</td>
	</tr>

</table>
<div style="height:350px;overflow:auto" id="mainDivId">
	<table width="100%" cellpadding="5" cellspacing="0"  class="fetch" id="mytable">
		<tr>
			<th style="width:5%; height: 20px;">
				<input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')"type="checkbox" >
			</th>
			<th style="height: 20px" >
				Leave Type
			</th>
			<th style="height: 20px" >
				Leave Time
			</th>
			<th style="height: 20px">
				Days
			</th>
			<th style="height: 20px" >
				From date
			</th>
			<th style="height: 20px">
				To Date
			</th>
			<th style="height: 20px">
				Modified On
			</th>
			<th style="height: 20px">
				Status
			</th>
			<th style="height: 20px">
				Action
			</th>
		</tr>
		<?php echo $mtta;?>

		<!--<input id="fetchData" name="Text1" style="display: none" type="text" value="<?php echo $Maxid.'--'.$MaxI;?>">
		-->
	</table>
</div>
<?php
//include('../pagination / pages.php');
?>