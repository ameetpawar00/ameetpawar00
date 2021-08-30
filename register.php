<?php 
if(isset($_POST['register']))
{
$company = trim($_POST['company']);
$company = mysql_real_escape_string($company);
$email= trim($_POST['email']);
$email = mysql_real_escape_string($email);
$name= trim($_POST['name']);
$name = mysql_real_escape_string($name);
$password= trim($_POST['password']);
$password= mysql_real_escape_string($password);
$logo = $_FILES['logo']['name'];
$logo = mysql_real_escape_string($logo);
if($company == "" || $email == "" || $password == "")
{
$output ='<p style="color:maroon;font-size:12px;font-weight:bold">Please Fill All Values </p>';
}
else
{
	if($logo != "")
	{
	$rand = rand(1000,100000);
	$chkExt = explode(".",$logo);
	$ext = end($chkExt);
	$ext = strtolower($ext); 
		if($ext == "jpeg" || $ext == "png" || $ext == "gif" || $ext == "jpg" )
		{
		$target = "masters/companydetails/doucuments/uploads/".$rand.$logo;
		move_uploaded_file($_FILES['logo']['tmp_name'],$target);
		$action = '1';
		}
		else
		{
		$output ='<p style="color:maroon;font-size:12px;font-weight:bold">Logo only in jpg,jpeg,png or gif format</p>';
		$action = '0';
		}
	}	
		if($action != '0')
		{
		mysql_query("INSERT INTO `employee`(`name`, `username`, `password`, `email`, `workemail`, `empstatus`, `department`, `designation`, `location`, `reportto`, `branch`, `city`, `state`,  `createdate`, `updatedate`, `active`, `role`) VALUES ('$name','$email','$password','$email','$email','1','1','1','1','1','1','1','1','$datetime','$datetime','1','1')",$con) or die(mysql_error());
		$lastId = mysql_insert_id();
		mysql_query("INSERT INTO `companydetail` (`name`, `email`, `city`, `state`, `logo`, `createdate`, `updatedby`, `updatedate`,`url`) VALUES ('$company', '$email', '1','1','$target','$datetime', '$lastId','$datetime','$curenttUrl')",$con) or die(mysql_error());
		mysql_query("UPDATE `employee` SET `updatedby` = '$lastId' where `id` = '$lastId'",$con) or die(mysql_error());
			$expire = time()+(60*60*24);
						setcookie("hrmloggeduserid",$lastId,$expire,"/");
						setcookie("hrmloggedname",$name,$expire,"/");
						$role = '1';
						$getRole = mysql_query("SELECT `permission` FROM `permission` WHERE `rollid` = '$role'",$con) or die(mysql_error());
						$rolePermis = mysql_fetch_array($getRole);
						setcookie("permission",$rolePermis[0],$expire,"/");
		header("location:default.php");	
		}
	
	

}

}
?>

<form method="post" action="" enctype="multipart/form-data">
<table cellpadding="10" cellspacing="0" style="" width="360px">
<tr>
<td colspan="2" align="center">
<?php if($output)
{
?>
<div style="background-color: #FFC6CA; border: 1px solid red; " >
<?php echo $output ;?>
</div>
<?php 
}
?>
</td>
</tr>
	<tr>
		<td colspan="2" style="text-align: left;">
		<span style="color: #555; font-size: 25px">Register Yourself</span></td>
	</tr>
	<tr>
		<td colspan="2">
		<input id="company" class="index-input i-company" name="company" placeholder="Comapny Name *" style="height: 25px; width: 280px !important; border-left: 3px #35aa47 solid" type="text" /></td>
	</tr>
<tr>
		<td colspan="2">
		<input id="company" class="index-input i-name" name="name" placeholder="Name *" style="height: 25px; width: 280px !important; border-left: 3px #35aa47 solid" type="text" /></td>
	</tr>
<tr>

		<td colspan="2">
<span class="button green fileinput-button">
									<i class="chosse-logo"></i>
									<span> Choose Logo</span>
									<input type="file" name="logo" >
									</span>
</td>
	</tr>


	<tr>
		<td colspan="2">
		<input id="username" class="index-input i-username" name="email" placeholder="Email Address *" style="height: 25px; width: 280px !important; border-left: 3px #35aa47 solid" type="text" /></td>
	</tr>
	<tr>
		<td colspan="2">
		<input class="index-input i-password" name="password" placeholder="Password" style="height: 25px; width: 280px !important; border-left: 3px #35aa47 solid" type="password" /></td>
	</tr>
	<tr>
	
		<td style="border-bottom: 1px #ddd solid; width: 149px; " align="left">
		<input name="register" type="submit" value="Register" class="login-button green" /></td>
			<td style="border-bottom: 1px #ddd solid; width: 105px;padding-top:15px; height: 74px;display:none" valign="baseline">
		<input name="hrmremeberme" type="checkbox" style="" />
		<div style="display:inline-block;padding-bottom:8px;vertical-align:middle">
		Remember Me
		</div>
		</td>
	</tr>
	
	
</table>
</form>