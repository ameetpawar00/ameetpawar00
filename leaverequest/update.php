<?php
include("../include/conFig.php");
echo $valto = $_POST['valto'];
$i = $_GET['i'];
$id = $_GET['id'];
$status = $_GET['status'];
function getDatesBetween2Dates($startTime, $endTime) {
	$day = 86400;
	$format = 'Y-m-d';
	$startTime = strtotime($startTime);
	$endTime = strtotime($endTime);
	$numDays = round(($endTime - $startTime) / $day) + 1;
	$days = array();
	    
	for ($i = 0; $i < $numDays; $i++) {
	    $days[] = date($format, ($startTime + ($i * $day)));
	}
	    
	return $days;
}
$valto = explode("*$*$*",$valto);
foreach($valto as $val)
{
$val = str_ireplace("'","\'",$val);
$post[] .= $val;
}

$flag = 0;
$convertFdate = strtotime($post[1]);
$convertTdate = strtotime($post[2]);
$todayDate = strtotime(date("Y-m-d"));

$dateArr = array();
$dateArr = getDatesBetween2Dates($post[1],$post[2]) ;
$flag = 0;
$h = array();
			$quaterAr = array("1"=>array("01","02","03"),"2"=>array("04","05","06"),"3"=>array("07","08","09"),"4"=>array("10","11","12"));

foreach($dateArr as $val)
{
	$weekday = date("w", strtotime($val));
	if($weekday == 0){
		$h[] = 0;
	}
	else{
		$h[] = 1;
	}
	$expMonth = explode("-",$val);
		foreach($quaterAr as $key=>$value){
			if(in_array($expMonth[1],$value)){
				$quater[] = $key;
			}	
		}

}
$lastQuater =  end($quater);

$totalArr = array_count_values($h);
if($totalArr[1] < 1){
	$flag = 1;
	$msg = "No working days selected";
}
else if($convertFdate < $todayDate){
	$flag = 1;
	$msg = "From date can not be smaller then current date";
}
else if($convertTdate < $convertFdate){
	$flag = 1;
	$msg = "To date can not be smaller then from date";
}
else{
	$dataChk = mysql_query("SELECT `status` FROM `leaverequest` where `id` = '$id'",$con) or die(mysql_error());
	$rowChk = mysql_fetch_array($dataChk);
	if($rowChk[0] == 1){
		$flag = 1;
		$msg = "Leave Already approved,Kindly contact your HR";
	}
	else{
		mysql_query("UPDATE `leaverequest` SET `leavetime`='$post[0]',`leavetype`='$post[4]',`fromdate`='$post[1]',`todate`='$post[2]',`description`='$post[3]',`updatedate`='$datetime',`updatedby`='$hrmloggedid' WHERE `id` = '$id'",$con) or die(mysql_error());	
		$msg = "Leave Updated";
	}
}
	
	
if(	$flag == 1){?>
<div class="error warnings"><?php echo $msg;?></div>
<?php
}
else
{?>
<div class="success warnings"><?php echo $msg;?></div>
<?php
}
?>
BREAKSTRINGFORSAVEDATA
<?php
if($flag == 0){
$getData = mysql_query("SELECT * FROM `leaverequest` WHERE `id` = '$id'",$con) or die(mysql_error());
$row = mysql_fetch_array($getData);
?>
<td><input id="chBx<?php echo $i;?>" name="Checkbox1" type="checkbox" value="<?php echo $row[7];?>" ></td>
<td style="height: 20px" class="link-blue" onclick="getModule('leaverequest/edit?id=<?php echo $row['id']?>&i=<?php echo $i?>','manipulateContent','viewContent','Assets')">
<?php
echo $row['leavetype'];		
?>
</td>
<td style="height: 20px" >
<?php
if($row['leavetime'] == 1)
	echo "Full Day Leave";
else if($row['leavetime'] == 2)
	echo "First Half Leave";
else
	echo "Second Half Leave";		
?>
</td>
<td style="height: 20px" ><?php echo $row['days'] ?></td>
<td style="height: 20px" ><?php echo  date(('d M,Y') ,strtotime($row['fromdate'])) ?></td>
<td style="height: 20px" ><?php echo  date(('d M,Y') ,strtotime($row['todate'])) ?></td>
<td style="height: 20px" ><?php echo  date(('d M,Y') ,strtotime($row['updatedate'])) ?></td>
<td style="height: 20px" >

<?php if(in_array('ap_lreq',$thisper)) 
{
?>
<center>
<div style="width:60px" >
<?php 
		if($row['status'] == 1)
					echo "<span style='color:green'>Approved</span>";
				elseif($row[6] == 0)
					echo "<span style='color:blue'>Waiting</span>";
				else
					echo "<span style='color:red'>Rejected</span>";
?>
</div>
</center>
<?php 
} 
?>
</td><?php
}?>
