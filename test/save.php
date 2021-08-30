<?php
include("../include/connection.php");
if(isset($_POST["submit_test"]))
{
	//print_r($_POST);
	$question_array=$_POST["questions"];
	
	$eid=$_POST["eid"];
	$sqli="INSERT INTO `poll_attemp_details`(`eid`) VALUES ('$eid')";
	$getup = mysql_query($sqli,$con) or die(mysql_error());
	//Array ( [questions] => Array ( [0] => Question3 [1] => Question4 [2] => Question5 [3] => Question6 ) [option_1] => 1 [option_2] => 2 [option_3] => 3 [option_4] => 4 [submit_test] => Submit )
		
	foreach($question_array as $question_sing)
	{
		
		$op_no=$_POST["option_".$question_sing];
		if($op_no==6)
		{
			$oncgd=$_POST["oncgd"];
			
				$sqlia="INSERT INTO `poll_extra`(`qid`, `eid`, `data1`) VALUES ('$question_sing','$eid','$oncgd')";
		$getupas = mysql_query($sqlia,$con) or die(mysql_error());
		}
		$sql="UPDATE `poll_details` SET `option".$op_no."_counter`=`option".$op_no."_counter`+1 WHERE `id`='$question_sing'";
	
		$getup = mysql_query($sql,$con) or die(mysql_error());
		
	}
	echo "<script>alert('Your Poll Submitted Sucessfully. . !@!'); window.parent.location='../default.php';</script>";
}

?>