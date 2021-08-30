<?php 
include('../include/config.php');
require_once ('../Excel/reader.php');
if(isset($_POST['submit']))
{
	$data = new Spreadsheet_Excel_Reader();
	$data->setOutputEncoding('CP1251');
	$name = $_FILES['uploadfile']['name'] ;
	$chkExt = explode(".",$name);
	if($chkExt[1] == "xls")
	{
		$target = "files/".$name;
		move_uploaded_file($_FILES['uploadfile']['tmp_name'],$target);
		
		$data->read($target);
		  for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++)
		   {
		 $year =$data->sheets[0]['cells'][$i][1];
		 $event =$data->sheets[0]['cells'][$i][2];
		 $dates=$data->sheets[0]['cells'][$i][3];
		 $description=$data->sheets[0]['cells'][$i][4];
		
		if($year != "Year")
		{
		$sql = "INSERT INTO `leavecalendar`( `year`, `date`, `event`, `description`, `createdate`, `updatedate`, `updatedby`) VALUES ('$year', STR_TO_DATE('$dates', '%d/%m/%Y'), '$event', '$description',  '$datetime', '$datetime', '$hrmloggedid')";
		 mysql_query($sql,$con) or die(mysql_error());

		}
		  
		   $err=0;
		   $errord=”;
		}
			$output = '<div class="sucessResp">SuccessFully Uploaded</div>';
	}
	else
	{
	$output = '<div class="sucessResp">Please Download and Upload Sample File</div>';
	}  
}  
//echo $output;
?>
 <script type="text/javascript">
      window.parent.document.getElementById('couResp').innerHTML='<?php echo $output;?>';
</script>


