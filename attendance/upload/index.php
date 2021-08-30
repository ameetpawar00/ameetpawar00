<noscript>
<div align="center"><a href="index.php">Go Back To Upload Form</a></div><!-- If javascript is disabled -->
</noscript>
<?php
error_reporting(0);
require_once ('../../Excel/reader.php');
//ini_set('display_errors', 1);  
$id = $_GET['response'];
if(isset($_POST))
{

$name = $_FILES['file']['name'];
$chkExt = end(explode('.',$name));
	if($chkExt == 'xls'  )
	{
		$rand = rand(1000,100000);
		$target = "uploads/".$rand.$name;
		move_uploaded_file($_FILES['file']['tmp_name'],$target);
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('CP1251');
		$data->read($target);/////Pass Excel File Name
		$data->sheets[0]['numRows'];
			for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++)
			{
	  	   	$date = $data->sheets[0]['cells'][$i]."<br/>";
			print_r($date);	  	
			$day = $data->sheets[0]['cells'][$i];
	  		print_r($day);
	  		}
	}
		else
		{
		$output = "1";
		}
	}
?>
<?php
if($output == "1")
{
?>
<script type="text/javascript">
document.getElementById('output').innerHTML='File Not Valid Only png,jpeg,jpg,gif,JPEG,GIF,PNG'; 
</script> 
<?php
}
else
{
?>
<script type="text/javascript">
document.getElementById('output').innerHTML='Attendance Successfully Uploaded';
//document.getElementById('viewLetter').style.display='block';
//document.getElementById('viewLetter').href='<?php echo $target ;?>';
window.parent.document.getElementById('<?php echo $id?>').value='<?php echo $target; ?>';
document.getElementById('progressbox').style.display='none';
</script> 
<?php
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Salestrack</title>
<script src="../../scripts/jquery-1.7.2.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
 <script> 
  	$('#foo').live('change',function(){   
	$('#UploadForm').submit(); }); 
        $(document).ready(function() {       
		//elements
		var progressbox 	= $('#progressbox');
		var progressbar 	= $('#progressbar');
		var statustxt 	  = $('#statustxt');
		var submitbutton   = $("#SubmitButton");
		var myform 		 = $("#UploadForm");
		var output 		 = $("#output");
		var completed 	  = '0%';		
		
				$(myform).ajaxForm({
					beforeSend: function() { //before sending form
						submitbutton.attr('disabled', ''); // disable upload button
						statustxt.empty();
						progressbox.show(); //show progressbar
						progressbar.width(completed); //initial value 0% of progressbar
						statustxt.html(completed); //set status text
						statustxt.css('color','#000'); 
						   
						//initial color of status text
					},
					uploadProgress: function(event, position, total, percentComplete) { //on progress
						progressbar.width(percentComplete + '%') //update progressbar percent complete
						statustxt.html(percentComplete + '%'); //update status text
						if(percentComplete>50)
							{
								statustxt.css('color','#fff'); //change status text to white after 50%
							}
						},
					complete: function(response) { // on complete
						output.html(response.responseText); //update element with received data
						myform.resetForm();  // reset form
						submitbutton.removeAttr('disabled'); //enable submit button
						progressbox.hide(); // hide progressbar
					}
			});
        }); 

    </script> 
<style>


</style>
<link href="../../css/common.css" rel="stylesheet"/>
</head>
<body style="background:transparent">

<form action="#" method="post" enctype="multipart/form-data" id="UploadForm">
<table width="200" border="0">
  <tr>
  
    <td align="left">
    <div class="file-input-wrapper">
  <button class="btn-file-input" title="Click to upload file">Upload Document</button>
  <input type="file" name="file" id="foo" />
</div>
    <!--<input type="file" />--></td>
  </tr>
  <tr>
  <td colspan="2" align="left">
  <div id="progressbox">
  <div style="width:200px;background:#eee;">
  <div id="progressbar" style=""></div ></div>
  <div id="statustxt">0%</div ></div>
<div id="output" style="font-size:10px;color:#069"></div>
<a style="display:none;font-size:10px;color:green" id="viewLetter" target="_blank"> View File</a>
  </td>
  </tr>
</table>
</form>



</body>
</html>

