<?php
include("../include/connection.php");
if(isset($_POST["submit_question"]))
{
	$name = $_FILES['file']['name'];
	$target = "files/".$name;
	move_uploaded_file($_FILES['file']['tmp_name'],$target);
	$file = fopen($target, "r");
	$j=0;
	while(! feof($file))
		{
			$row = fgetcsv($file);  
			
			foreach($row as $eachColumn)
				{
				$rowRead[$j].= $eachColumn."***";
				}
				$j++;
		}
		
		$question_no=0;
		$option_no=0;
		   foreach($rowRead as $key => $userIdval)
			{
				$temp = explode("***",$userIdval);
				//print_r($temp);
				
				foreach($temp as $tempa)
				{
					if(substr_count($tempa,"##"))
					{
						$quesion=str_ireplace("##","",$tempa);
						//echo $quesion."<br>";
						
						$question_no++;
					}else{
						if(!empty($tempa))
						{
							$option=$tempa;
							$a[$quesion][]=$option;
							//echo "option for $question_no :". $option."<br>";
							$option_no++;
						}
					}
				}
				
				
				
			}
//print_r($a);
$op0="";
$op1="";
$op2="";
$op3="";
$op4="";
$op5="";
	
foreach($a as $question=>$val)
	{
		
		$lengh_op=count($val);
		for($i=0; $i<$lengh_op; $i++)
		{
			${"op$i"}=$val[$i];
		}
		$sql_rem.=" ('$question', '$op0', '$op1', '$op2', '$op3', '$op4', '$op5'),";	
		
		
	}
	$sql_rem=rtrim($sql_rem,",");
	echo $sql="INSERT INTO `poll_details` (`question`, `option1`, `option2`, `option3`, `option4`, `option5`, `option6`) VALUES $sql_rem";
	$getEmp = mysql_query($sql,$con) or die(mysql_error());
echo "<script>alert('Question Submitted Sucessfully. . !@!'); window.location='insert.php';</script>";
	}

?>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="file-input-wrapper">
		<input type="file" name="file" id="foo" />
		<input type="submit" name="submit_question">
	</div>
</form>
