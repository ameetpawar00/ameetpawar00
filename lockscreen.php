<?php
include('include/conFig.php');
$getLogo = mysql_query("SELECT `logo`,`name` FROM  `companydetail` where `delete` = '0' order by `id` desc ",$con)or die(mysql_error());
$rowLogo = mysql_fetch_array($getLogo);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link href="css/lock.css" rel="stylesheet" />
<link href="css/color.css" rel="stylesheet" />
   <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
   <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<title>Lock Screen</title>
</head>

<body>
<div class="page-lock">
		<div class="page-logo">
			<a class="brand" href="index.php">
			<img src="<?php echo $rowLogo[0]?>" style="height:50px;" alt="" id="complogo"/>
			</a>
		</div>
		<div class="page-body">
			<img class="page-lock-img" src="employee/images/pranay dongre.jpg" alt="" height="200px" width="200px"/>
			<div class="page-lock-info">
				<h1>Pranay Dongre</h1>
				<span>pranay.dongre@webricks.com</span>
				<span><em>Locked</em></span>
				<form class="form-search" method="post">
					<div class="input-append">
						<input type="text" class="lock-input" placeholder="Password"/>
						 <button type="submit" class="lock-button"  id="lockBtn">Submit</button>

					</div><br/>
					<div class="relogin">
						<a href="index.php">Not Pranay Donge ?</a>
					</div>
				</form>
			</div>
		</div>
		<div class="page-footer">
			2013-2014 &copy; Webricks Innovations.
		</div>
	</div>
<script src="scripts/jquery.backstretch.min.js" type="text/javascript"></script>
<script src="scripts/lock.js"></script>      
	<script>
		jQuery(document).ready(function() {    
		   //App.init();
		   Lock.init();
		});
	</script>

</body>

</html>
