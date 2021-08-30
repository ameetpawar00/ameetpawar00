<?php 
	include("../../include/conFig.php");

	if(isset($_POST["type"]) AND $_POST["type"]==2)
	{
			$crlid=$_POST['crlid'];
			$eid=$_POST['eid'];
			$ttype=$_POST['ttype'];
			$cno=$_POST['cno'];
			$ins=$_POST['ins'];
			 $doj=$_POST['doj'];
		if($_POST["ttype"]==1)
		{
			$checch=mysql_query("UPDATE `emp_ltb_with` SET `modifiedby`='$hrmloggedid',`status`='2' WHERE `id`='$crlid'",$con) or die(mysql_error());

			$note="Approved LTB Cash Request";
			mysql_query("INSERT INTO `story`(`subject`, `note`, `employee`, `type`, `updatedby`) VALUES ('Approved LTB Cash Request', '$note', '$eid', 8, '$hrmloggedid')",$con) or die(mysql_error());
			if($checch)
			{
				echo "Request Approved Sucessfully";
			}else{
				echo "Error !! Request Not Approved";
			}
		}else if($_POST["ttype"]==3)
		{
			
			$checch=mysql_query("UPDATE `emp_ltb_with` SET `modifiedby`='$hrmloggedid', `status`='1', `checkno`='$cno' WHERE `id`='$crlid'",$con) or die(mysql_error());
			
			
			
			
			if($ins==3)
				{
					$checch=mysql_query("UPDATE `emp_ltb_with` SET `extrastatus`='1' WHERE `eid`='$eid' AND `extrastatus`='0'",$con) or die(mysql_error());
					$fedt=mysql_query("SELECT * FROM `emp_ltb_with_extra` WHERE `eid`='$eid'",$con) or die(mysql_error());
					$checkno=mysql_num_rows($fedt);
					$fedtrow=mysql_fetch_array($fedt);
					if($checkno>0)
						{
							$dnj=$fedtrow["date"];
							$xid=$fedtrow["id"];
							$new = strtotime ( '+1644 days' , strtotime ( $dnj ) ) ;
							$ndate = date ( 'Y-m-d H:i:s' , $new );
							mysql_query("UPDATE `emp_ltb_with_extra` SET `updatedby`='$hrmloggedid', `date`='$ndate' WHERE `id`='$xid'",$con) or die(mysql_error());
				
						}else{
								$new = strtotime ( '+1644 days' , strtotime ( $doj ) ) ;
								$ndate = date ( 'Y-m-d H:i:s' , $new );
								mysql_query("INSERT INTO `emp_ltb_with_extra`(`eid`, `date`, `updatedby`) VALUES ('$eid', '$ndate', '$hrmloggedid')",$con) or die(mysql_error());
							}
			
				}
			
			$note="Approved LTB Cash Request (Check Number Updated: $cno)";
			mysql_query("INSERT INTO `story`(`subject`, `note`, `employee`, `type`, `updatedby`) VALUES ('Check Number Updated ($cno)', '$note', '$eid', 6, '$hrmloggedid')",$con) or die(mysql_error());
			if($checch)
			{
				echo "Request Approved Sucessfully";
			}else{
				echo "Error !! Request Not Approved";
			}
		}else{
			
			$checch=mysql_query("UPDATE `emp_ltb_with` SET `modifiedby`='$hrmloggedid', `status`='3' WHERE `id`='$crlid'",$con) or die(mysql_error());
			
			$note="Rejected LTB Cash Request";
			mysql_query("INSERT INTO `story`(`subject`, `note`, `employee`, `type`, `updatedby`) VALUES ('Rejected LTB Cash Request', '$note', '$eid', 9, '$hrmloggedid')",$con) or die(mysql_error());
			if($checch)
			{
				echo "Request Rejected Sucessfully";
			}else{
				echo "Error !! Request Not Rejected";
			}
		}
		
	}else{
			$crlid=$_POST['crlid'];
			$eid=$_POST['eid'];
			$ttype=$_POST['ttype'];
			$cno=$_POST['cno'];
		if($_POST["ttype"]==1)
		{
			$checch=mysql_query("UPDATE `emp_pf_with` SET `modifiedby`='$hrmloggedid',`status`='2' WHERE `id`='$crlid'",$con) or die(mysql_error());

			$note="Approved PF Cash Request";
			mysql_query("INSERT INTO `story`(`subject`, `note`, `employee`, `type`, `updatedby`) VALUES ('Approved PF Cash Request', '$note', '$eid', 8, '$hrmloggedid')",$con) or die(mysql_error());
			if($checch)
			{
				echo "Request Approved Sucessfully";
			}else{
				echo "Error !! Request Not Approved";
			}
		}else if($_POST["ttype"]==3)
		{
			$checch=mysql_query("UPDATE `emp_pf_with` SET `modifiedby`='$hrmloggedid', `status`='1', `checkno`='$cno' WHERE `id`='$crlid'",$con) or die(mysql_error());
			//echo "UPDATE `carry_leavelog` SET `modifieddate`='$datetime',`updatedby`='$hrmloggedid', `cash_status`='1' WHERE `id`='$crlid'";
			$note="Approved PF Cash Request (Check Number Updated: $cno)";
			mysql_query("INSERT INTO `story`(`subject`, `note`, `employee`, `type`, `updatedby`) VALUES ('Check Number Updated ($cno)', '$note', '$eid', 6, '$hrmloggedid')",$con) or die(mysql_error());
			if($checch)
			{
				echo "Request Approved Sucessfully";
			}else{
				echo "Error !! Request Not Approved";
			}
		}else{
			
			$checch=mysql_query("UPDATE `emp_pf_with` SET `modifiedby`='$hrmloggedid', `status`='3' WHERE `id`='$crlid'",$con) or die(mysql_error());
			
			$note="Rejected PF Cash Request";
			mysql_query("INSERT INTO `story`(`subject`, `note`, `employee`, `type`, `updatedby`) VALUES ('Rejected PF Cash Request', '$note', '$eid', 9, '$hrmloggedid')",$con) or die(mysql_error());
			if($checch)
			{
				echo "Request Rejected Sucessfully";
			}else{
				echo "Error !! Request Not Rejected";
			}
		}
			
			
	}
	 
?>




