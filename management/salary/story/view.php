<h1 style="text-align: center;background: #fff;z-index: 99999;position: relative;top: 0;margin: 0px 20px;border: 1px solid #d2d2d2;border-radius: 10px;padding: 5px;">Timeline For <?=$_GET["name"];?></h1>
<h3><span>User</span><span style="float: right;">Admin</span></h3>
<img src="img/direction.png" style="width: 5%;-webkit-transform: rotate(175deg); -moz-transform: rotate(175deg); -o-transform: rotate(175deg); -ms-transform: rotate(175deg); transform: rotate(175deg); -webkit-transform: rotateX(175deg); -moz-transform: rotateX(175deg); -o-transform: rotateX(175deg); -ms-transform: rotateX(175deg); transform: rotateX(175deg);">

<img src="img/direction.png" style="width: 5%; -webkit-transform: rotate(175deg); -moz-transform: rotate(175deg); -o-transform: rotate(175deg); -ms-transform: rotate(175deg); transform: rotate(175deg);    float: right;">
<section id="cd-timeline" class="cd-container" style="height: 440px;overflow-x: scroll;">
<div id="asassasa" >
<div class="as" id="asstl" style="
    position: absolute;
    top: 0;
    
    width: 4px;
    background: #d7e4ed;
    left: 50%;
    margin-left: -2px;
">
</div>
<?php
include("../../../include/conFig.php");
$eid = $_GET['eid'];
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
				
$getData = "SELECT `story`.`subject`, `story`.`note`, `story`.`employee`, `story`.`id`, `story`.`createdate`, `story`.`updatedby`, `story`.`delete`, `story`.`type`,`employee`.`name`, `story`.`lrid` FROM `story`, `employee` WHERE `story`.`updatedby`= `employee`.`id` AND `story`.`employee`= '$eid' AND `story`.`delete` = '0' ORDER BY `story`.`id` DESC";
$resultgetData = mysql_query($getData,$con);
while($row = mysql_fetch_array($resultgetData))
	{
		$subject=$row["subject"];
		$note=$row["note"];
		$lrid=$row["lrid"];
		$employee=$row["employee"];
		$sqlLeavey = mysql_query("SELECT `ALL`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`, `11`, `12` FROM `leaverecord_yearly` WHERE `userid` = '".$employee."' AND `delete` = '0'",$con)or die(mysql_error());
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
		$id=$row["id"];
		$createdate=$row["createdate"];
		$updatedby=$row["updatedby"];
		$name=$row["name"];
		$type=$row["type"];
		if($type==1)
		{
			$pic="req";
			$img="icon6";
			$side="cleft";
			$Suff="Requested";
		}elseif($type==2 OR $type==8)
		{
			$pic="approved";
			$img="save";
			$side="cright";
			$Suff="Approved";
		}elseif($type==3 OR $type==7)
		{
			$pic="waiting";
			$img="icon3";
			$side="cleft";
			$Suff="Applied";
		}elseif($type==4 OR $type==9)
		{
			$pic="rejected";
			$img="close";
			$side="cright";
			$Suff="Rejected";
		}elseif($type==5 OR $type==6)
		{
			$pic="updated";
			$img="edit";
			$side="cright";
			$Suff="Updated";
		}else{
			$pic="new";
			$img="editlarge";
			$side="cright";
			$Suff="Commented";
		}
		
		
		
	$Contadd=<<<AAA
							<div class="cd-timeline-block cright" style="text-align: center;">
								<div class="cd-timeline-img cd-add">
									<img src="icons/plus.png" alt="add">
								</div> <!-- cd-timeline-img -->

								<div class="cd-timeline-content cdoc-add" >
								<h2 style="text-align:center">Add Comment</h2>
								<b  style="text-align: left!important;width: 100%;display: block;">Subject :  </b> <input type="text" placeholder="Subject" name="savesubject0" id="savesubject0" class="input " style="width: 100%!important;">
								<b  style="text-align: left!important;width: 100%;display: block;">Note :  </b> 
								<textarea class="input" style="width: 100%!important;"  name="savesubject1" id="savesubject1"  placeholder="Please Enter Details"></textarea>
								<br>
								<br>
								<button class="button green" onclick="SaveData('management/salary/story/save?eid=$eid','savesubject','2','','','couResp',''); getModule('management/salary/story/view?eid=$eid&name=$name','manipulatemoodleContent','viewmoodleContent','Story Line')"><i class="save-icon"></i>Add New Comment</button>
								<!-- <button class="button gray" onclick="reset"><i class="close-icon"></i>Reset</button>  cd-timeline-content-->
								</div>
							</div> <!-- cd-timeline-block -->
							
							
							<div class="cd-timeline-block cleft" style="text-align: center;">
								<div class="cd-timeline-img cd-stat">
									<img src="icons/stat.png" alt="stat">
								</div> <!-- cd-timeline-img -->

								<div class="cd-timeline-content cdoc-$picadd" >
								<h2 style="text-align:center">Report</h2>
<table cellpadding="0" cellspacing="0" width="100%" style="text-align:"  border=1>
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
			T R/T A
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
	</tr>
	<tr>
	<td colspan="7"><small><b>All:-</b> $rall----[<b>JAN:- </b>$rjan]----[<b>FEB:- </b>$rfeb]----[<b>MAR:- </b>$rmar]----[<b>APR:- </b>$rapr]----[<b>MAY:- </b>$rmay]----[<b>JUN:- </b>$rjun]----[<b>JUL:- </b>$rjul]----[<b>AGU:- </b>$ragu]----[<b>SEP:- </b>$rsep]----[<b>OCT:- </b>$roct]----[<b>NOV:- </b>$rnov]----[<b>DEC:- </b>$rdec]</small></td>
</tr>
</table>
<br>
<table cellpadding="0" cellspacing="0" width="100%" style="text-align:left">
	<tr>
		<td>
			ELR/ELA
		</td>
		<td>
			<small>Earned leave Remaining</small>/<small>Earned leave Alloted</small>
		</td>
	</tr>
	<tr>
		<td>
			SLR/SLA
		</td>
		<td>
			<small>Sick leave Remaining</small>/<small>Sick leave Alloted</small>
		</td>
	</tr>
	<tr>
		<td>
			CLR/CLA
		</td>
		<td>
			<small>Casual leave Remaining</small>/<small>Casual leave Alloted</small>
		</td>
	</tr>
	<tr>
		<td>
			P R/P A
		</td>
		<td>
			<small>Paternal leave Remaining</small>/<small>Paternal leave Alloted</small>
		</td>
	</tr>
	<tr>
		<td>
			M R/M A
		</td>
		<td>
			<small>Maternal leave Remaining</small>/<small>Maternal leave Alloted</small>
		</td>
	</tr>
	<tr>
		<td>
			S R/S A
		</td>
		<td>
			<small>Special leave Remaining</small>/<small>Special leave Alloted</small>
		</td>
	</tr>
	<tr>
		<td>
			T R/T A
		</td>
		<td>
			<small>Total leave Remaining</small>/<small>Total leave Alloted</small>
		</td>
	</tr>
</table>
								</div>
							</div> <!-- cd-timeline-block -->
AAA;

	$Cont.=<<<AAA
							<div class="cd-timeline-block $side">
							<input type="hidden" value="$lrid" name="lrid" class="lrid">
								<div class="cd-timeline-img cd-$pic">
									<img src="icons/$img.png" alt="$pic">
								</div> <!-- cd-timeline-img -->

								<div class="cd-timeline-content cdoc-$pic " >
									<h2>$subject.</h2>
									<h3 style="margin: 5px 0px;">$name $Suff</h3>
									<p>$note.</p>
									<span class="cd-date">$createdate</span>
								</div> <!-- cd-timeline-content -->
							</div> <!-- cd-timeline-block -->
AAA;
		
	}
	
	echo $Contadd;
	echo $Cont;
?>
</div>
	</section> <!-- cd-timeline -->
