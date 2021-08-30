<?php 
	include("../../include/conFig.php");
	
	if(isset($_POST["type"]) AND $_POST["type"]==1)
	{
		$dx=$_POST["dx"];
		$dxl=$_POST["dxl"];
		$id_array=explode(',',$dx);
		$leave_arraya=explode(',',$dxl);
		//print_r($leave_arraya);
		$counter=0;
		$Y = date('Y', strtotime('-1 years'));
		$year=date("Y");
		foreach($id_array as $id_arrays)
		{
			$eid=$id_arrays;
			
			$eid."----".$leave_val."###";
			$leave_vals=$leave_arraya[$counter];
			$leave_val=$leave_vals+12;
			$qleave_val=$leave_vals+3;
			$leave_val_y=$leave_vals+24;
			$qleave_val_y=$leave_vals+2;
			
			if($eid!=0)
			{
				mysql_query("UPDATE `leaverecord` SET `EL`='$leave_val', `1QEL`='$qleave_val', `2QEL`='3', `3QEL`='3', `4QEL`='3', `M`='90', `special`='10', `CL`='6', `1QCL`='1', `2QCL`='2', `3QCL`='1', `4QCL`='2', `SL`='6',`1QSL`='2', `2QSL`='1', `3QSL`='2', `4QSL`='1',`P`='5', `modifiededate`='$datetime',`updatedby`='$hrmloggedid' WHERE `userid`='$eid'");
				mysql_query("UPDATE `leaverecord_yearly` SET `ALL`='$leave_val_y', `1`='$qleave_val_y', `2`='2', `3`='2', `4`='2', `5`='2', `6`='2', `7`='2', `8`='2', `9`='2', `10`='2', `11`='2', `12`='2', `modifiededate`='$datetime',`updatedby`='$hrmloggedid' WHERE `userid`='$eid'");
				
				if($leave_vals>0)
				{
					
					$note="Leaves Updated For $year and $leave_vals dayes are carried forward in this year";
					
				}else{
					
					$note="Leaves Updated For $year and no leaves are carried forward in this year";
					
				}
				
				mysql_query("INSERT INTO `story`(`subject`, `note`, `employee`, `type`, `updatedby`) VALUES ('Updated Yearly leaves', '$note', '$eid', 6, '$hrmloggedid')",$con) or die(mysql_error());
				
				mysql_query("INSERT INTO `carry_leavelog`(`userid`, `of_year`, `leaves_carried`, `modifieddate`, `updatedby`, `createdate`) VALUES ('$eid', '$Y', '$leave_vals', '$datetime','$hrmloggedid','$datetime')",$con) or die(mysql_error());
			}
				$counter++;
		}
	
	}else{
		
			$eid=$_POST["eid"];
			$crlid=$_POST["crlid"];
			$cno=$_POST["cno"];
			$leaves_cashed=$_POST["leaves_cashed"];
			if($_POST["ttype"]==1)
			{
				$sql_loga = "SELECT `carry_leavelog`.`leaves_carried`, `carry_leavelog`.`leaves_cashed` FROM `carry_leavelog` WHERE `carry_leavelog`.`id`='$crlid'";
				$getDataCArryLeave=mysql_query($sql_loga,$con) or die(mysql_error());
				$getRowCarryLeave=mysql_fetch_assoc($getDataCArryLeave);
				$leaves_cashedDB=$getRowCarryLeave["leaves_cashed"];
				
				$OUTOF="";
				if($leaves_cashedDB!=$leaves_cashed)
				{
					
					mysql_query("UPDATE `carry_leavelog` SET `leaves_cashed`='$leaves_cashed', `modifieddate`='$datetime',`updatedby`='$hrmloggedid' WHERE `id`='$crlid'");
					$OUTOF="Approved, ".$leaves_cashedDB." Leaves Applied";
				}
				
				
				mysql_query("UPDATE `leaverecord` SET `EL`=`EL`-'$leaves_cashed', `modifiededate`='$datetime',`updatedby`='$hrmloggedid' WHERE `userid`='$eid'");
			mysql_query("UPDATE `leaverecord_yearly` SET `ALL`=`ALL`-'$leaves_cashed', `modifiededate`='$datetime',`updatedby`='$hrmloggedid' WHERE `userid`='$eid'");
				
			$sqlsa = "SELECT `1QEL`, `2QEL`, `3QEL`, `4QEL` FROM `leaverecord` WHERE `userid`='$eid'";
			$getDatasa = mysql_query($sqlsa,$con) or die(mysql_error());
			$rowas =mysql_fetch_assoc($getDatasa);
			//print_r($rowas);
			$saas=0;
			foreach($rowas as $rowasaas)
			{
				if($rowasaas>=$leaves_cashed)
				{
					$KAR=array_keys($rowas);
					$noa=$KAR[$saas];
				}
				$saas++;
			}
			$sqlsay = "SELECT `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`, `11`, `12` FROM `leaverecord_yearly` WHERE `userid`='$eid'";
			$getDatasay = mysql_query($sqlsay,$con) or die(mysql_error());
			$rowasy =mysql_fetch_assoc($getDatasay);
			//print_r($rowas);
			$saasy=0;
			foreach($rowasy as $rowasaasy)
			{
				if($rowasaasy>=$leaves_cashed)
				{
					$KARy=array_keys($rowasy);
					$noay=$KARy[$saasy];
				}
				$saasy++;
			}
				
			mysql_query("UPDATE `leaverecord` SET `".$noa."`=`".$noa."`-'$leaves_cashed' WHERE `userid`='$eid'");
			mysql_query("UPDATE `leaverecord_yearly` SET `$noay`=`$noay`-'$leaves_cashed', `modifiededate`='$datetime',`updatedby`='$hrmloggedid' WHERE `userid`='$eid'");
			//echo "UPDATE `leaverecord_yearly` SET `$noay`=`$noay`-'$leaves_cashed', `modifiededate`='$datetime',`updatedby`='$hrmloggedid' WHERE `userid`='$eid'";
			mysql_query("UPDATE `carry_leavelog` SET `modifieddate`='$datetime',`updatedby`='$hrmloggedid', `cash_status`='1' WHERE `id`='$crlid'",$con) or die(mysql_error());
			//echo "UPDATE `carry_leavelog` SET `modifieddate`='$datetime',`updatedby`='$hrmloggedid', `cash_status`='1' WHERE `id`='$crlid'";
			$note="Approved Leave Cash Request ($leaves_cashed Leaves $OUTOF)";
			mysql_query("INSERT INTO `story`(`subject`, `note`, `employee`, `type`, `updatedby`) VALUES ('Approved Leave Cash Request', '$note', '$eid', 8, '$hrmloggedid')",$con) or die(mysql_error());
				
			}else if($_POST["ttype"]==3)
			{
				mysql_query("UPDATE `carry_leavelog` SET `installments`='$cno', `modifieddate`='$datetime',`updatedby`='$hrmloggedid', `cash_status`='4' WHERE `id`='$crlid'",$con) or die(mysql_error());
				//echo "UPDATE `carry_leavelog` SET `modifieddate`='$datetime',`updatedby`='$hrmloggedid', `cash_status`='1' WHERE `id`='$crlid'";
				$note="Approved Leave Cash Request (Check Number Updated: $cno)";
				mysql_query("INSERT INTO `story`(`subject`, `note`, `employee`, `type`, `updatedby`) VALUES ('Check Number Updated ($cno)', '$note', '$eid', 6, '$hrmloggedid')",$con) or die(mysql_error());
				
			}else{				
				mysql_query("UPDATE `carry_leavelog` SET `modifieddate`='$datetime',`updatedby`='$hrmloggedid', `cash_status`='2' WHERE `id`='$crlid'",$con) or die(mysql_error());
				
				$note="Rejected Leave Cash Request";
				mysql_query("INSERT INTO `story`(`subject`, `note`, `employee`, `type`, `updatedby`) VALUES ('Rejected Leave Cash Request', '$note', '$eid', 9, '$hrmloggedid')",$con) or die(mysql_error());
				
			}
			
	}
	 
?>




