<?php
include("../include/conFig.php");
error_reporting(0);

$sql = "SELECT `id`,`name`,`username` FROM `employee` WHERE `delete`= '0' AND `id` = '$hrmloggedid'";
$getemp = mysql_query($sql,$con) or die(mysql_error());
$rowemp = mysql_fetch_array($getemp);

$sql = "SELECT * FROM `poll_attemp_details` WHERE `eid`='$hrmloggedid'";
$getpe = mysql_query($sql,$con) or die(mysql_error());
//if(0)
if(mysql_num_rows($getpe)>0)
{
	echo $aa=<<<AAA
					<div id="myTitle">
						<div class="title">
							User Poll For &nbsp;
							<span style="color:red">
								$rowemp[1]&nbsp;&nbsp;
							</span>
							Already Submitted ThankYou.
						</div>
						<br><br><br><a href='default.php'>Go Back</a></div>
						
AAA;
//<p> OR You will be redirected in <span id="counter">10</span> second(s).</p>
}else{
	
?>
<div id="myTitle">
<div class="title">User Poll For &nbsp;<span style="color:green"><?php echo $rowemp[1];?></span></div>
<div class="strip">
<span>Polling Station</span>
<span>User</span>
</div>
</div>
<style>
#directResult{
	font-size:15px;
}
.question_sec {
    padding: 15px;
    border: 2px solid #C5E1A5;
    margin: 15px;
    padding-bottom: 20px;
    border-radius: 15px;
    background: rgba(118, 146, 116, 0.07);
}
span.option_sec {
    background: #FFF3E0;
    padding: 15px 0 15px 0px;
    margin: 5px;
    border-radius: 15px;
    display: inline-block;
    width: 47%;
}
span.option_sec.checked,span.option_sec:hover {
    background: #E8F5E9;
}

.inp_sub{
	background: #4CAF50;
    padding: 5px 15px;
    border: 0;
    font-weight: 800;
    color: #fff;
    text-transform: uppercase;
    cursor: pointer;
}
input.inp_sub:hover {
    background: #037503;
}
.question_sec b{
	text-transform:uppercase;
}


 #oncgd {
 	display: none;
 	    
}
.option_sec input[type="radio"]:checked ~ label > #oncgd {
       display:inline;
}
</style>
<div id="directResult" style="height:500px;overflow:scroll">



<form action="test/save.php" target="ipoll" method="POST">
<input type="hidden" value="<?=$hrmloggedid;?>" name="eid">
<?php
	
		$sql = "SELECT `id`, `question`, `option1`, `option2`, `option3`, `option4`, `option5`, `option6` FROM `poll_details` WHERE `status`='0'";
		$getque = mysql_query($sql,$con) or die(mysql_error());
		while($main_arrray = mysql_fetch_array($getque))
		{
			$main_arrraya[]=$main_arrray;
		}
		
		$q_counter=1;			
		foreach($main_arrraya as $a=>$val)
		{
			
			$id=$val["id"];
			$question=$val["question"];
			$option1=$val["option1"];
			$option2=$val["option2"];
			$option3=$val["option3"];
			$option4=$val["option4"];
			$option5=$val["option5"];
			$option6=$val["option6"];
			/*$question=str_shuffle($val["question"]);
			$option1=str_shuffle($val["option1"]);
			$option2=str_shuffle($val["option2"]);
			$option3=str_shuffle($val["option3"]);
			$option4=str_shuffle($val["option4"]);
			$option5=str_shuffle($val["option5"]);
			$option6=str_shuffle($val["option6"]);*/
			$op_array=array($option1, $option2, $option3, $option4, $option5, $option6);
			
			echo $output=<<<AAA
						<div class="question_sec">
							<span style="
    width: 12%;
    display: inline-flex;
"><b>Question : $q_counter :--</b> </span>
							
							<span style="
    width: 87%;
    display: inline-table;
">$question ?</span>
							<input type="hidden" value="$id" name="questions[]">
								<br>
								
								
AAA;
			$opno=0;
			foreach($op_array as $op_arraya)
			{
			if(!empty($op_arraya))
			{
				
			if($opno%2==0)
			{
				echo "<br>";
			}
			
			$inp="";
			if($id==17 AND $opno==5)
			{
				
				$inp="<input id='oncgd' name='oncgd'>";
			}
				$opno++;
			echo $output=<<<AAA
						<span class="option_sec option_sec$id " id="ops_$id$opno">	
							
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
						<input  type="radio" name="option_$id" id="$id$opno" value="$opno" onclick="$('.option_sec$id').removeClass('checked');  $('#ops_$id$opno').addClass('checked');" required>
						<label for="$id$opno" style="
    padding: 5px;
    cursor: pointer;
    margin: 5px;
">&nbsp;$op_arraya $inp</label> 
			
	</span>					
AAA;
			}
			}
			echo $output=<<<AAA
							</div>
AAA;
		$q_counter++;	
		}
		
?>
  <br><br>
  <div style="
    text-align: center;
">
  <input type="submit" name="submit_test" value="Submit" class="inp_sub"> <br><br> <br><br>
  </div>
</form>
<iframe name="ipoll" style="display:none;"></iframe>
</div>

<?php
}
?>