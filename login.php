<?php
	if(isset($_COOKIE['hrmremeberme']))
	{
		$chkRemmber= explode("-*remeberme*-",$_COOKIE['hrmremeberme']);
		$remUsername= $chkRemmber[0];
		$remPassword = $chkRemmber[1];
	}
	if(isset($_COOKIE['hrmloggeduserid']))
	{
		header("location:checkLogin.php");
	}
	
	
	if(isset($_POST['login']))
	{
		
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$username=stripslashes($username);
		$password =stripslashes($password);
		$username= mysql_real_escape_string($username);
		$password = mysql_real_escape_string($password);
		$selectUser = mysql_query("SELECT * FROM `employee` WHERE `username` = '$username' AND `password` = '$password' and `delete` = '0' and `active` = '1' and (`empstatus` = '2' OR `role`=1)",$con) or die(mysql_error());
		$fetchUser = mysql_fetch_array($selectUser);
		//echo $username;
		$expire =time()+60*60*24;
		if( $username == "" && $password == "")
		{
			$output= '<p style="color:maroon;font-size:12px;font-weight:bold">Username and Password can`t be blank </p>';
		}
		else
		{
			if($fetchUser['username'] == $username && $fetchUser['password'] == $password)
			{
				$expire = time()+(60*60*24);
						setcookie("hrmloggeduserid",$fetchUser['id'],$expire,"/");
						setcookie("hrmloggedname",$fetchUser['name'],$expire,"/");
						setcookie("hrmdesig",$fetchUser['designation'],$expire,"/");
						setcookie("hrmrole",$fetchUser['role'],$expire,"/");
						setcookie("hrmname",$fetchUser['name'],$expire,"/");
						setcookie("shift",$fetchUser['shift'],$expire,"/");
						setcookie("salaryIdNew",$fetchUser['salaryIdNew'],$expire,"/");
						setcookie("designation",$fetchUser['designation'],$expire,"/");
						setcookie("department",$fetchUser['department'],$expire,"/");
				
				$eid=$fetchUser['id'];
				$selectes = mysql_query("SELECT `date` FROM `emp_ltb_with_extra` WHERE `type` ='1' AND `eid` ='$eid'",$con) or die(mysql_error());
				$selectes = mysql_fetch_array($selectes);
				if(!empty($selectes))
				{
					$doj=$selectes['date'];
				}else{
					$doj=$fetchUser['doj'];
				}
				
							setcookie("hrmDOJ",$doj,$expire,"/");
				$date2=date_create("2014-01-01");
				$date1=date_create($doj);
				$diff=date_diff($date1,$date2);
				$sd=$diff->format("%R%a");
				if($sd>=0)
				{
					$hrmDOJlk="2014-01-01";
					//$hrmDOJlk=$doj;
				}else{
					$hrmDOJlk=$doj;
				}
						setcookie("hrmDOJl",$hrmDOJlk,$expire,"/");
				$date3=date_create("2012-06-01");
				$date4=date_create($doj);
				$difff=date_diff($date4,$date3);
				$sdf=$difff->format("%R%a");
				if($sdf>=0)
				{
					$hrmDOJlkp="2012-06-01";
				}else{
					$hrmDOJlkp=$doj;
				}
						setcookie("hrmDOJp",$hrmDOJlkp,$expire,"/");
				$role = $fetchUser['role'];
				$empId = $fetchUser['id'];
				mysql_query("INSERT INTO `userlog`(`employee`, `date`, `login`) VALUES ('$empId','$date','$datetime')",$con) or die(mysql_error());
				$userlogid = mysql_insert_id();
				mysql_query("UPDATE `userlog` SET `logout`='$datetime' WHERE  `employee` = '$empId' and `logout` = '0000-00-00 00:00:00' and `id` != '$userlogid' ",$con) or die(mysql_error());
				$getRole = mysql_query("SELECT `permission` FROM `permission` WHERE `rollid` = '$role'",$con) or die(mysql_error());
				$rolePermis = mysql_fetch_array($getRole);
						setcookie("permission",$rolePermis[0],$expire,"/");
				setcookie("huserlogid",$userlogid,$expire,"/");
				
				
				
				if(isset($_POST['hrmremeberme']))
				{
					$remeberme = $fetchUser['username']."-*remeberme*-".$fetchUser['password'];
					setcookie("hrmremeberme",$remeberme,time()+(60*60*60),"/");
				}
				
				header("location:checkLogin.php");
				//echo "123";
			}
			else
			{
				$output = '<p style="color:maroon;font-size:12px;font-weight:bold">Invalid Anuthentication </p>';
			}
		}
		
	}
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
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
            <h1 style="text-align: center; ">HRM</h1>
            <span style="color: #555; font-size: 20px">Login To Your
		Account</span></td>
		</tr>
		<tr>
			<td colspan="2">
				<input id="username" class="index-input i-username" name="username" placeholder="Username/Email" style="height: 25px; width: 280px !important; border-left: 3px #35aa47 solid" type="text" /></td>
		</tr>
		<tr>
			<td colspan="2">
				<input class="index-input i-password" name="password" placeholder="Password" style="height: 25px; width: 280px !important; border-left: 3px #35aa47 solid" type="password" /></td>
		</tr>
		<tr>
			
			<td style="border-bottom: 1px #ddd solid; width: 149px;" align="left">
				<input name="login" type="submit" value="Log In" class="login-button green" /></td>
			<td style="border-bottom: 1px #ddd solid; width: 105px;padding-top:15px;" valign="baseline">
				<input name="hrmremeberme" type="checkbox" style="" />
				<div style="display:inline-block;padding-bottom:8px;vertical-align:middle">
					Remember Me
				</div>
			</td>
		</tr>
	
	
	</table>
</form>