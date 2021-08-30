<noscript>
<div align="center"><a href="index.php">Go Back To Upload Form</a></div><!-- If javascript is disabled -->
</noscript>
<?php
//ini_set('display_errors', 1);
error_reporting(0);

if(isset($_POST))
{
$name = $_FILES['file']['name'];
$chkExt = end(explode('.',$name));
	if($chkExt == 'csv')
		{
		$rand = rand(1000,9999);
		
		$target = "apppics/".$rand.$name;
		$finaltarget = "attachments/".$target;
		//$target1 = "mobileapppics/".$rand.$name;
		//$finaltarget1 = "attachments/".$target1; 
		move_uploaded_file($_FILES['file']['tmp_name'],$target);
		//move_uploaded_file($_FILES['file']['tmp_name'],$target1);

		
		//////Resize image
		
		if($chkExt=="jpg" || $chkExt=="jpeg" )
				{
				$src = imagecreatefromjpeg($target);
				//$src1 = imagecreatefromjpeg($target1);
				}
				else if($chkExt=="png")
					{
					$src = imagecreatefrompng($target);
					//$src1 = imagecreatefrompng($target1);
					}
					else 
					{
					$src = imagecreatefromgif($target);
					//$src1 = imagecreatefromgif($target1);
					}
					list($width,$height)=getimagesize($target);
					//list($width1,$height1)=getimagesize($target1);
							
							$newwidth = 640;
							$newheight = 640 * 0.4;
							//$newheight=($height/$width)*$newwidth;
							$tmp=imagecreatetruecolor($newwidth,$newheight);
							//$newwidth1=640;
							//$newheight1= 180;
							//$newheight1=($height/$width)*$newwidth1;
							//$tmp1=imagecreatetruecolor($newwidth1,$newheight1);
							imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
							//imagecopyresampled($tmp1,$src1,0,0,0,0,$newwidth1,$newheight1,$width1,$height1);
							$filename = $target;
							//$filename1 = $target1;
							imagejpeg($tmp,$filename,100);
							//imagejpeg($tmp1,$filename1,100);
							imagedestroy($src);
							//imagedestroy($src1);
							imagedestroy($tmp);
							//imagedestroy($tmp1);
		

		}
		else
		{
		$output = "1";
		}
		$_FILES = "";
	}
?>
<?php
if($output == "1")
{
?>
<script type="text/javascript">
document.getElementById('output').innerHTML='File Not Valid' ;
 
</script> 

<?php
}
else
{
?>
<script type="text/javascript">
document.getElementById('output').innerHTML='App Pic Uploaded Sucessfully';
document.getElementById('viewLetter').style.display='block';
document.getElementById('viewLetter').href='<?php echo $target ;?>';
window.parent.document.getElementById("<?php echo $_GET['path'] ?>").value = '<?php echo $finaltarget;?>';
document.getElementById('progressbox').style.display='none';
document.getElementById('UploadForm').innerHTML='';
</script> 
<?php
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Salestrack</title>
<script src="../scripts/jquery-1.7.2.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
 <script> 
 
 
 		$('#foo').live('change',function(){
   
	$('#UploadForm').submit();
			

});

 
        $(document).ready(function() { 
        
     
		//elements
		var progressbox 	= $('#progressbox');
		var progressbar 	= $('#progressbar');
		var statustxt 		= $('#statustxt');
		var submitbutton 	= $("#SubmitButton");
		var myform 			= $("#UploadForm");
		var output 			= $("#output");
		var completed 		= '0%';
		
		
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
#progressbar {
	height:10px;
	border-radius: 3px;
	background-color: green;
	width:0%;
}
#statustxt {
	display:inline-block;
	color: #000000;
	font-size:11px;
}
.file-input-wrapper {
    width: 100px;
    height: 20px;
    overflow: hidden;
    position: relative;
    cursor:pointer;
    background:#ddd;

}
.file-input-wrapper > input[type="file"] {
    font-size: 50px;
    position: absolute;
    top: 0;
    right: 0;
    opacity: 0;
	border:0px;
	cursor:pointer;
	background:#ccc;

}
.file-input-wrapper > .btn-file-input {
    display: inline-block;
    width: 100px;
    height: 20px;
	background:#ccc;
    border:0px;
	cursor:pointer;
	font-size:11px;

}
.file-input-wrapper:hover > .btn-file-input {
}

</style>
</head>
<body style="background:transparent">

<table width="200" border="0">
  <tr>
  
    <td align="left" id="myFile">
    <form action="#" method="post" enctype="multipart/form-data" id="UploadForm">

    <div class="file-input-wrapper">
  <button class="btn-file-input" title="Click to upload file">Upload App Pic</button>
  <input type="file" name="file" id="foo" />
</div></form>

    <!--<input type="file" />--></td>
  </tr>
  <tr>
  <td colspan="2" align="left">
  <div id="progressbox">
  <div style="width:200px;background:#eee;">
  <div id="progressbar" style=""></div ></div>
  <div id="statustxt">0%</div ></div>
<div id="output" style="font-size:10px;color:#069"></div>
<a style="display:none;font-size:10px;color:green" id="viewLetter" target="_blank"> View Pic</a>
  </td>
  </tr>
</table>



</body>
</html>

