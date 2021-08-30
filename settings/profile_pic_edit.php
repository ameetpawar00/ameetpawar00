<?php
include("../include/conFig.php");

if(isset($_POST["Submit"])) {//echo 1;
$target_dir = "../user/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$target_file1 = $target_dir . $hrmloggedid.".jpg";
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      //  echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
       // echo "File is not an image.";
        $uploadOk = 0;
    }


// Check if file already exists
///if (file_exists($target_file)) {
   // echo "Sorry, file already exists.";
    //$uploadOk = 0;
//}
// Check file size
///if ($_FILES["fileToUpload"]["size"] > 500000) {
   // echo "Sorry, your file is too large.";
   // $uploadOk = 0;
//}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	 echo "<script>alert('Sorry, only JPG, JPEG, PNG files are allowed.')</script>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
   // echo "";
	 echo "<script>alert('Sorry, your file was not uploaded.')</script>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file1)) {
       // echo "";
	    echo "<script>alert('The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.'); parent.location.reload(); </script>";
    } else {
        echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
    }
}
}
?>

<div class="title">Change Profile Picture </div>
<div class="strip">
<span>Dashboard</span>
<span>Change Profile Picture </span>
</div>
<div class="add-new blue-border">
<div class="form-head blue">
<div class="head-title"> 

<i class="add-form"></i> 
Change Profile Picture </div>
</div>
<form action="settings/profile_pic_edit.php" target="iffri" method="POST"  enctype="multipart/form-data">

<table cellpadding="0" cellspacing="0" width="100%" align="center">
<tr>
<tr>
	<td>
		Please Select Profile Picture<span>*</span>
	</td>
	<td>
		<input class="input medium"  name="fileToUpload" type="file" id="pic1" value="" style="float:left">
	</td>
</tr>
<tr>
<td colspan="4" style="text-align:center">
<input class="button green" type="submit" value="Submit" name="Submit">

</td>
</tr>
</table>
</form>
<iframe name="iffri" style="display:none"/>
</div>