<?php  session_start();
ob_start();
include('includes/connection.php');

$name=trim(str_ireplace("'","\'",$_REQUEST['name']));
$email=trim(str_ireplace("'","\'",$_REQUEST['email']));
$mobile=trim(str_ireplace("'","\'",$_REQUEST['mobile']));
$baddress=trim(str_ireplace("'","\'",$_REQUEST['baddress']));
$bcity=trim(str_ireplace("'","\'",$_REQUEST['bcity']));
$bstate=trim(str_ireplace("'","\'",$_REQUEST['bstate']));
$bcountry=trim(str_ireplace("'","\'",$_REQUEST['bcountry']));
$bpostal=trim(str_ireplace("'","\'",$_REQUEST['bpostal']));
$saddress=trim(str_ireplace("'","\'",$_REQUEST['saddress']));
$scity=trim(str_ireplace("'","\'",$_REQUEST['scity']));
$sstate=trim(str_ireplace("'","\'",$_REQUEST['sstate']));
$scountry=trim(str_ireplace("'","\'",$_REQUEST['scountry']));
$spostal=trim(str_ireplace("'","\'",$_REQUEST['spostal']));
$shipername=trim(str_ireplace("'","\'",$_REQUEST['shipername']));
$shipermobile=trim(str_ireplace("'","\'",$_REQUEST['smobile']));

if($_POST['usecoupan'])
{
$coupancode = $_POST['couponcode'];
}
else
{
$coupancode = "";
}
if($_POST['gift'])
{
$gift = '1';
}
else
{
$gift  = '0';
}
if($_POST['cod'])
{
$paymode=$_POST['cod'];
}
if($_POST['online'])
{
$paymode=$_POST['online'];
}
if($name == "" || $email == "" || $mobile ==  "" || $baddress == "" || $bcity == "" || $bstate ==  "" || $bpostal == "" || $saddress == "" || $scity == "" || $sstate ==  "" || $spostal == "" || $shipername == "" || $shipermobile == "" )
	{
	$output='<span style="color:maroon;font-size:12px;font-weight:bold">Please fill all value mark with *</span>';
	}
	else
	{
		if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email))
		{
		 $output='<span style="color:maroon;font-size:12px;font-weight:bold">Email address not valid</span>';
		}
		else
		{
			if (!preg_match('/^[0-9]{10}$/',$mobile) )
			{
			$output='<span style="color:maroon;font-size:12px;font-weight:bold">Mobile number not valid</span>';
			} 
			else
			{
			$rand=rand(1,100);
			$time= time();
			$time=substr($time,4,4);
			$transId= "ratlami".$rand.$time;
			/*$coup=mysql_query("select * from `coupon` where `delete`='0' order by `id` desc ",$con) or die(mysql_error());
			$numRow=mysql_num_rows($coup);
			if($numRow !='0')
			{
				while($fetchcoup=mysql_fetch_array($coup))
				{
				$discountAmt=$fetchcoup["amount"];
				$discountPer=$fetchcoup["discount"];
					if($totalAmt >= $discountAmt)
					{ 
						$finalAmt=floor(($totalAmt*$discountPer)/100);
						$amountFinal=$totalAmt-$finalAmt;
						 //$Amt=$fAmount-$finalAmt;
						 mysql_query("INSERT INTO `order`(`transactionid`,`type`, `name`, `email`, `mobile`, `baddress`, `bcity`, `bpostal`, `bstate`, `bcountry`, `scity`, `spostal`, `sstate`, `scountry`, `createdate`, `amount`,`discountamount`,`finalamount`, `ip`, `saddress`, `paymentmode`,`gift`,`coupan`,`shipername`,`shipermobile`) VALUES ('$transId','$type','$name','$email','$mobile','$baddress','$bcity','$bpostal','$bstate','$bcountry','$scity','$spostal','$sstate','$scountry','$datetime','$totalAmt','$finalAmt','$amountFinal','$ip','$saddress','$paymode','$gift','$coupancode','$shipername','$shipermobile')",$con)or die(mysql_error());
						break;
					}
					else 
					{
					 $discountAmt=$discountAmt;
					//mysql_query("INSERT INTO `order`(`transactionid`,`type`, `name`, `email`, `mobile`, `baddress`, `bcity`, `bpostal`, `bstate`, `bcountry`, `scity`, `spostal`, `sstate`, `scountry`, `createdate`, `amount`, `ip`, `saddress`, `paymentmode`,`gift`,`coupan`) VALUES ('$transId','$type','$name','$email','$mobile','$baddress','$bcity','$bpostal','$bstate','$bcountry','$scity','$spostal','$sstate','$scountry','$datetime','$totalAmt','$ip','$saddress','$paymode','$gift','$coupancode')",$con)or die(mysql_error());
					}
				}
			}
			else 
			{
			$amountFinal = $totalAmt;
			mysql_query("INSERT INTO `order`(`transactionid`,`type`, `name`, `email`, `mobile`, `baddress`, `bcity`, `bpostal`, `bstate`, `bcountry`, `scity`, `spostal`, `sstate`, `scountry`, `createdate`, `amount`,`finalamount`, `ip`, `saddress`, `paymentmode`,`gift`,`coupan`,`shipername`,`shipermobile`) VALUES ('$transId','$type','$name','$email','$mobile','$baddress','$bcity','$bpostal','$bstate','$bcountry','$scity','$spostal','$sstate','$scountry','$datetime','$totalAmt','$amountFinal','$ip','$saddress','$paymode','$gift','$coupancode','$shipername','$shipermobile')",$con)or die(mysql_error());
			}		
			$orderId = mysql_insert_id();
			if($orderId == 0)
			{
			$amountFinal = $totalAmt;
			mysql_query("INSERT INTO `order`(`transactionid`,`type`, `name`, `email`, `mobile`, `baddress`, `bcity`, `bpostal`, `bstate`, `bcountry`, `scity`, `spostal`, `sstate`, `scountry`, `createdate`, `amount`,`finalamount`, `ip`, `saddress`, `paymentmode`,`gift`,`coupan` ,`shipername`,`shipermobile`) VALUES ('$transId','$type','$name','$email','$mobile','$baddress','$bcity','$bpostal','$bstate','$bcountry','$scity','$spostal','$sstate','$scountry','$datetime','$totalAmt','$amountFinal','$ip','$saddress','$paymode','$gift','$coupancode','$shipername','$shipermobile')",$con)or die(mysql_error());
			$orderId = mysql_insert_id();
			}*/
			mysql_query("INSERT INTO `order`(`transactionid`,`type`, `name`, `email`, `mobile`, `baddress`, `bcity`, `bpostal`, `bstate`, `bcountry`, `scity`, `spostal`, `sstate`, `scountry`, `createdate`, `amount`,`finalamount`, `ip`, `saddress`, `paymentmode`,`gift`,`coupan` ,`shipername`,`shipermobile`) VALUES ('$transId','$type','$name','$email','$mobile','$baddress','$bcity','$bpostal','$bstate','$bcountry','$scity','$spostal','$sstate','$scountry','$datetime','$totalAmt','$amountFinal','$ip','$saddress','$paymode','$gift','$coupancode','$shipername','$shipermobile')",$con)or die(mysql_error());
			$orderId = mysql_insert_id();
			
			/*foreach($totalvalues as $key => $newTotal)
					{
						if($newTotal != "")
						{
						$newQuan = explode("-quanIds-",$newTotal);
						foreach($newQuan as $newKey => $newVal)
						{
							if($newVal != "")
							{
							$product = str_ireplace("-","",$pid[$key]);
							//echo "INSERT INTO `orderdetail`(`orderid`,`productid`, `quantityid`, `quantity`) VALUES ('$orderId','$product','$newVal','$quantity[$newKey]')<br/>";
							mysql_query("INSERT INTO `orderdetail`(`orderid`,`productid`, `quantityid`, `quantity`) VALUES ('$orderId','$product','$newVal','$quantity[$newKey]')",$con)or die(mysql_error());	
							}
						}
						}
					}*/
					$j= 0;
					//print_r($lastQuan);
				foreach($lastQuan as $keyQuan => $valQuan)
				{
					if($valQuan != "")
					{
						$insertQuan = explode("---",$valQuan);
						
						 if($insertQuan[1] != "")
						 {
						 $againQuan = explode("***",$insertQuan[1]);
						
						 	foreach($againQuan as $againVal)
						 	{
						 		if($againVal != "")
						 		{
						 		
						 	 $finalProduct =$insertQuan[0] ;
						 	// echo "INSERT INTO `orderdetail`(`orderid`,`productid`, `quantityid`, `quantity`) VALUES ('$orderId','$finalProduct','$againVal','$quantity[$j]')<br/>";
						 	mysql_query("INSERT INTO `orderdetail`(`orderid`,`productid`, `quantityid`, `quantity`) VALUES ('$orderId','$finalProduct','$againVal','$quantity[$j]')",$con)or die(mysql_error());	
						 		$j++;
						 		}
						 	}
						 
						 }
					}
				}
				$sqlQuery = "select prductquantity.price,orderdetail.quantity from product,category,`order`,orderdetail,prductquantity,quantity where prductquantity.id = orderdetail.quantityid and product.category = category.id and orderdetail.productid=product.id and orderdetail.orderid = '$orderId' and `order`.id = orderdetail.orderid and prductquantity.quantity = quantity.id ";	
				$selectDetail=mysql_query($sqlQuery,$con)or die(mysql_error());
				while($fetchDetails = mysql_fetch_array($selectDetail))
				{
				$fAmount += $fetchDetails[0]*$fetchDetails[1];
				}
			$coup=mysql_query("select * from `coupon` where `delete`='0' order by `id` desc ",$con) or die(mysql_error());
			$numRow=mysql_num_rows($coup);
			if($numRow !='0')
			{
				while($fetchcoup=mysql_fetch_array($coup))
				{
				$discountAmt=$fetchcoup["amount"];
				$discountPer=$fetchcoup["discount"];
					if($fAmount >= $discountAmt)
					{ 
						$finalAmt=floor(($fAmount*$discountPer)/100);
						$amountFinal=$fAmount-$finalAmt;
						 //$Amt=$fAmount-$finalAmt;
						break;
					}
				}
			}
			else
			{
			$amountFinal = $fAmount;
			}
		mysql_query("UPDATE `order` SET `finalamount` = '$amountFinal' WHERE `id` = '$orderId'",$con) or die(mysql_error());
					
				//die();
				//
			$html='Mr./Mrs.<br/><p>'.$name.'<br/><strong>Email:</strong>'.$email.'<br/> has purchased namkeen from website on '.date(("d-M-y"),strtotime($date)).' for more detail please check Admin Panel<br/> From:<br/><strong>RatlamiChatora</strong><br/></p>';		
			$to ="namkeeratlami@gmail.com"; 
			$from=$email;
			$com="RatlamiChatora";
			$headers = "From: RatlamiChatora <".$from.">\r\n" . 
			'Reply-to: '.$com."<".$from.">"."\r\n" . 
			'X-Mailer: PHP/' . phpversion() . "\r\n" . 
			"MIME-Version: 1.0\r\n" . 
			"Content-Type: text/html; charset=utf-8\r\n" . 
			"Content-Transfer-Encoding: 8bit\r\n\r\n";  
			$subject="RatlamiChatora Order Information";
			mail($to,$subject,$html,$headers);
				
			$_POST=''; 
			include('productremove.php');
			$_SESSION['pay'] = '1234';
			
				if($paymode == "Online")
				{
				$_SESSION['pay'] = '1234';
				//header('location:paymentdetails/index.php?success='.base64_encode($orderId));
				header('location:paymentdetails/index.php?success='.base64_encode($orderId));
				}
				else
				{
				header('location:invoice.php?success='.base64_encode($orderId));
				}
			}
		}
	}		
		

?>