<?php
include("../include/conFig.php");
error_reporting(0);

$sql = "SELECT `id`,`name`,`username` FROM `employee` WHERE `delete`= '0' AND `id` = '$hrmloggedid'";
$getemp = mysql_query($sql,$con) or die(mysql_error());
$rowemp = mysql_fetch_array($getemp);

if($hrmloggedid!=93 AND $hrmloggedid!=613)
{
	echo $aa=<<<AAA
					<div id="myTitle">
						<div class="title">
							
							<span style="color:red">
								$rowemp[1]&nbsp;&nbsp;
							</span>
							You Dont Have access. ThankYou.
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
span.option_sec.max{
    background: #B2EBF2;
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
</style>
<div id="directResult" style="height:500px;overflow:scroll">



<form action="test/save.php" target="ipoll" method="POST">
<input type="hidden" value="<?=$hrmloggedid;?>" name="eid">
<?php
	
		$sql = "SELECT `id`, `question`, `option1`, `option1_counter`, `option2`, `option2_counter`, `option3`, `option3_counter`, `option4`, `option4_counter`, `option5`, `option5_counter`, `option6`, `option6_counter`, `status`, `timestamp` FROM `poll_details` WHERE `status`=0";
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
			$option1_counter=$val["option1_counter"];
			$option2_counter=$val["option2_counter"];
			$option3_counter=$val["option3_counter"];
			$option4_counter=$val["option4_counter"];
			$option5_counter=$val["option5_counter"];
			$option6_counter=$val["option6_counter"];
			$op_array=array($option1, $option2, $option3, $option4, $option5, $option6);
			$op_c_array=array($option1_counter, $option2_counter, $option3_counter, $option4_counter, $option5_counter, $option6_counter);
			
			echo $output=<<<AAA
						<div class="question_sec">
							<b>Question : $q_counter :--</b> &nbsp;&nbsp;$question ?
							<input type="hidden" value="$id" name="questions[]">
							
								<br>
								
								
AAA;
			$opno=0;
			$opnoa=0;
			foreach($op_array as $op_arraya)
			{
			if(!empty($op_arraya))
			{
				
			if($opno%2==0)
			{
				echo "<br>";
			}
				$opno++;
			$spclass="";
			if(max($op_c_array)==$op_c_array[$opnoa])
			{
				$spclass="max";
			}
			
			
			$ectrop="";
			if($opno==6)
			{
				
				$sqlas = "SELECT `data1` FROM `poll_extra` WHERE 1";
				$getqueadad = mysql_query($sqlas,$con) or die(mysql_error());
				$sdlfkj=1;
				$ectrop="";
				while($main_arrrayasdsad = mysql_fetch_array($getqueadad))
				{
					$data1=$main_arrrayasdsad["data1"];
					if($data1!="")
					{
						
					$ectrop.=<<<AAA
									<li>  $data1 </li>
									
AAA;
$sdlfkj++;
					}
				}
				
				
				
				
			}
			echo $output=<<<AAA
						<span class="option_sec checked $spclass">	
						<input type="radio"  checked>
							<label  style="padding: 5px;cursor: pointer;margin: 5px;">&nbsp;$op_arraya</label> 
							<br>
							<br>
							<label  style="padding: 5px;cursor: pointer;margin: 5px;color:red">&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Selected By $op_c_array[$opnoa] Users.
								<br>
								
							</label> 
						
	</span>					
AAA;
			}
			$opnoa++;
			}
			echo $output=<<<AAA
			<span class="option_sec checked $spclass">	
			<h3> &nbsp&nbspOthers Option List</h3>
			<ol>
				$ectrop
			</ol>
			</span>
							</div>
AAA;
		$q_counter++;	
		}
		
?>
  <br><br>
  <div style="
    text-align: center;
">
 
  </div>
</form>
<iframe name="ipoll" style="display:none;"></iframe>
</div>

<?php
}
?>