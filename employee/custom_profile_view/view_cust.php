<?php
include("../../include/conFig.php");
$id = $_GET['id'];
$getData = mysql_query("SELECT `employee`.`id`, `employee`.`name`, `employee`.`mobile`, `employee`.`phone`, `employee`.`workphone`, `employee`.`username`, `employee`.`password`, `employee`.`email`, `employee`.`workemail`, `employee`.`empid`, `employee`.`department`, `employee`.`designation`, `employee`.`location`, `employee`.`hiresource`, `employee`.`branch`, `employee`.`doj`, `employee`.`dob`, `employee`.`doa`, `employee`.`marital`, `employee`.`gender`, `employee`.`address`, `employee`.`city`, `employee`.`state`, `employee`.`specialization`, `employee`.`jobdescription`, `employee`.`about`, `employee`.`image`,`employee`.`referredby`, `employee`.`createdate`, `employee`.`role`, `employee`.`empstatus`, `employee`.`lastname`, `employee`.`tempAddress`, `employee`.`l_allotstatus`, `designation`.`name` as `desiname`, `department`.`name` as `depname`, `employeestatus`.`name` as `empstname`, `rolls`.`name` as `rolename`, `sourceofhire`.`name` as `sourceofhire`, `employee`.`r_leave`, `employee`.`dol`, `employee`.`dop`, `employee`.`dor` FROM `employee`,`designation`,`department`, `employeestatus`, `rolls`, `sourceofhire` WHERE `employee`.`id` = '$id' AND `employee`.`designation`=`designation`.`id` AND `employee`.`department`=`department`.`id` AND `employee`.`empstatus`=`employeestatus`.`id` AND `employee`.`role`=`rolls`.`id` AND `employee`.`hiresource`=`sourceofhire`.`id`",$con) or die(mysql_error());
//echo "SELECT `employee`.`id`, `employee`.`name`, `employee`.`mobile`, `employee`.`phone`, `employee`.`workphone`, `employee`.`username`, `employee`.`password`, `employee`.`email`, `employee`.`workemail`, `employee`.`empid`, `employee`.`department`, `employee`.`designation`, `employee`.`location`, `employee`.`hiresource`, `employee`.`branch`, `employee`.`doj`, `employee`.`dob`, `employee`.`doa`, `employee`.`marital`, `employee`.`gender`, `employee`.`address`, `employee`.`city`, `employee`.`state`, `employee`.`specialization`, `employee`.`jobdescription`, `employee`.`about`, `employee`.`image`,`employee`.`referredby`, `employee`.`createdate`, `employee`.`role`, `employee`.`empstatus`, `employee`.`lastname`, `employee`.`tempAddress`, `employee`.`l_allotstatus`, `designation`.`name` as `desiname`, `department`.`name` as `depname`, `employeestatus`.`name` as `empstname`, `rolls`.`name` as `rolename`, `sourceofhire`.`name` as `sourceofhire`, `employee`.`r_leave` FROM `employee`,`designation`,`department`, `employeestatus`, `rolls`, `sourceofhire` WHERE `employee`.`id` = '$id' AND `employee`.`designation`=`designation`.`id` AND `employee`.`department`=`department`.`id` AND `employee`.`empstatus`=`employeestatus`.`id` AND `employee`.`role`=`rolls`.`id` AND `employee`.`hiresource`=`sourceofhire`.`id`";
$row = mysql_fetch_array($getData);
$id=$row['id'];
$gender=$row['gender'];

if($gender == '0')
	{
		$gen="Male";
	}else if($gender == '1')
	{
		$gen="Female";
	}else{
		$gen="";
	}
	
$marital=$row['marital'];	
	if($marital == '0')
	{
		$mm='Single';
	}else if($marital == '1')
		{ 
			$mm='Married';
		}else{
			$mm='';
		}
$dob=$row['dob'];
$desig= $row["desiname"];
$depar= $row["depname"];
$phone=$row['phone'];
$workphone=$row['workphone'];
$mobile=$row['mobile'];
$email=$row['email'];
$workemail=$row['workemail'];
$address=$row['address'];
$tempAddressa=$row['tempAddress'];
$ttempa=str_split($tempAddressa,40); 
//print_r($ttempa);
$tempAddress="";
foreach($ttempa as $ttempaa)
{
	
	$tempAddress.=$ttempaa."<br>";
}
$empstname=$row['empstname'];
$doj=$row['doj'];
$rolename=$row['rolename'];
$sourceofhire=$row['sourceofhire'];
$referredby=$row['referredby'];
$jobdescription=$row['jobdescription'];
$fathersname=$row['lastname'];
$empstatus=$row['empstatus'];
$r_leavea=$row['r_leave'];
$l_date=$row['dol'];
$r_date=$row['dor'];
$p_date=$row['dop'];
$r_leavet=str_split($r_leavea,40); 
//print_r($ttempa);
$r_leave="";
foreach($r_leavet as $r_leavetas)
{
	
	$r_leave.=$r_leavetas."<br>";
}
?>
	<?php
				//\document\attachments\apppics
				$target_file="../../user/".$row['id'].".jpg";
				$target_file1="../../user/".$row['id'].".jpg";
				//echo "<img alt='' class='img-' src='$target_file' style='width: 25%;position: absolute;right: 10%;'>";
				if(file_exists($target_file) AND $row['id']!="")
				{
					$img= "<img class='img-' src='$target_file1'>";
				}else{
						$img=  "<img alt='' class='img-' src='../../user/admin.jpg'>";
					}
					


	$getLoc = mysql_query("SELECT `id`,`name` FROM `employee` WHERE `delete`= '0' AND `id` != '1' AND `empstatus`=2 AND `id`='$referredby'",$con) or die(mysql_error());
$rowLoc = mysql_fetch_array($getLoc);

	if($rowLoc[0] != "")
		{
			$ref_by=$rowLoc[1];
		}else if("COLLEAGUE" == $referredby)
				{
					$ref_by="COLLEAGUE";
				}else if("FRIENDS" == $referredby)
				{
					$ref_by="FRIENDS";	
				}else if("OTHERS" == $referredby)
				{
					$ref_by="OTHERS";	
				}
				$ref_byt="";
				if($sourceofhire=="Employee Referral")
				{
					$ref_byt='
					<div class="row">
						<i class="fa fa-coffee" aria-hidden="true"></i>
						Referred By:  
							<span>
								'.$ref_by.'
							</span>
					</div>';
				}
				
$ldatea='';


if($l_date!="0000-00-00" OR $empstatus!=2)
	{
			$ldatea='
					<div class="row">
						<i class="fa fa-calendar-times-o" aria-hidden="true"></i>
						Date of Leaving:  
							<span>
								'.$l_date.'
							</span>
					</div>
					<div class="row">
						<i class="fa fa-commenting-o" aria-hidden="true"></i>
						Reason of Leaving:  
							<span>
								'.$r_leave.'
							</span>
					</div>';
	}


if($p_date!="0000-00-00")
	{
			$ldateaa='
					<div class="row">
						<i class="fa fa-calendar-check-o" aria-hidden="true"></i>

						Pramotion Date:  
							<span>
								'.$p_date.'
							</span>
					</div>';
	}
	//$r_date
if($r_date!="0000-00-00")
	{
			$rdateaa='
					<div class="row">
						<i class="fa fa-calendar-minus-o" aria-hidden="true"></i>

						Rejoining Date:  
							<span>
								'.$r_date.'
							</span>
					</div>';
	}
	
	$rand=rand (0 , 3 );
	$ex=".svg";
	if($rand==0)
	{
		$ex=".jpg";
	}

?>

<link href="../../css/font-awesome.min.css" rel="stylesheet"/>
<style>
body{
    background: #00c091;
    background-attachment: fixed;
    background-repeat: repeat;
    scroll-behavior: smooth;
    font-family: "Lato", Arial, Helvetica, sans-serif !important;
    font-size: 12px;
}
	.wrapper {
		display: table;
    width: 70%;
    margin: 40px auto;
    box-shadow: 10px 5px 30px rgba(0,0,0,.3);
    padding: 3%;
    background: url(../../images/<?php echo "pro_back".$rand.$ex;?>);
    background-color: #fafafa;
    background-size: 100%;
}
.pro-header {
    padding: 15px 15px 0px 15px;
    border-radius: 5px;
    border: 1px solid transparent;
    min-height: 130px;
    margin: 0px 1%;
}
.pro-header .main_head{
	font-size: 20px;
	font-weight: 600 !important;
	width: 100%;
	display: block;
	text-transform: uppercase;
	  /*  margin-bottom: 5px;*/
}
.pro-header .main_head b{
	font-size: 15px;
}
.pro-header .sub_head{
	/*font-size: 12px;*/
	font-weight: 600 !important;
	width: 100%;
}
.pro-body{
	display: inline-block;
}
.smain{
	/*font-size: 18px!important;*/
}
.blcolor{
	color:#008CFF !important;
}
.pro-header-col-right{
	width: 10%;
	float: right;
}
.pro-header-col-left{
	width: 90%;
	float: left;
}
.pro-header-col-right img {
    vertical-align: top;
    display: inline-block;
    height: 130px;
    width: 130px;
    float: right;
    border-radius: 50%;
    background-size: cover;
    background-repeat: no-repeat;
}
.fa {
    margin-right: 5px;
   /* font-size: 15px;*/
}
.sub_head_body{
	display: block;
	margin: 0;
	padding-bottom: 5px;
	border-bottom: 1px solid #000;
	text-transform: uppercase;
   font-size: 15px;
    line-height: 20px;
	font-weight: 600;
	margin: 20px 5%;
}
.pro-body-col-left{
    width: 50%;
    float: left;
    display: block;
}
.pro-body-col-right{
    width: 50%;
    float: left;   
    display: block;
}
.sub_body_body{
    margin: 0 5% 0 5%;
    font-weight: 600;
}
.sub_body_body div span{
    color:black !important;
    float: right;
    /*font-size: 12px;*/
    text-align: right;
}
.sub_body_body div{
	border-bottom: 1px dotted #008cff;
	/*font-size: 15px;*/
	
}
.sub_body_bodya .inner {
    border-bottom: 1px dashed #008cff;
    padding-bottom: 15px;
    margin: 10px 5%;
    display: flex;
    text-transform: capitalize;
}
.education-item-det{
	width: 80%;
	float: left;
}
.education-item-per{
	width: 20%;
	float: right;
}
.education-item-det-head{
	   /* font-size: 18px;**/
	color: #000000 !important;
	margin-bottom: 5px;
}
.education-item-det-header{
	
	/*font-size: 15px;*/
	font-weight: 700;
	margin-bottom: 5px;
}
.exp-item-det{
	width: 70%;
	float: left;
}
.exp-item-per{
	width: 30%;
	float: right;
}
.exp-item-det-head{
	   /* font-size: 18px;*/
	color: #000000 !important;
	    margin-bottom: 5px;
}
.exp-item-det-header{
	
	/*font-size: 15px;*/
	font-weight: 700;
	margin-bottom: 5px;
	
}
.inner .fa {
    margin-right: 5px;
    /*font-size: 12px;*/
}
.big_ico {
    /*font-size: 25px!important;*/
    width:10%;
    float: left;
    margin-right: 0!important;
}
.big_ico_sec {
    width:90%;
    float: right;
}
.inner .in_dates,.inner .education-item-result-title {
   
    /*font-size: 12px;*/
    margin-top: 5px;
    color:#000!important;
}
.inner .in_dates,.inner .exp-item-result-title {
   
   /* font-size: 12px;*/
    margin-top: 5px;
    color:#000!important;
}
.row{
	margin-bottom: 5px;
	display: inline-block;
	width: 100%;
}
.in_dates{
	line-height: 2;
}
.inner ul {
    margin-left: 10%;
    /*font-size: 15px;*/
    padding-top: 10px;
    color: #008cff;
}
.inner ul li{
    margin-bottom: 3%!important;
}
.sub_body_bodya table {
	    font-size: 12px !important;
}
.sub_body_bodya table th{
	padding: 2px!important;
	color:#008CFF !important;
}
.sub_body_bodya table td{
	    text-align: center;
}

</style>
<div class="wrapper">
	<div class="pro-header">
		<div class="pro-header-col-left">
			<div class="row">
				<span class="main_head"><?=$row['name']?>
					<b class="sub_head blcolor">
						(<?php echo $row['empid']?>)
					</b>
				</span>
			</div>
			<div class="row">
				<span class="sub_head smain blcolor"><?=$desig?>, <?=$depar?></span>
			</div>
			<div class="row">
				<span class="sub_head" style="width: 50%;"><i class="fa fa-phone blcolor"></i> <?=$phone?></span>
			<span class="sub_head" style="float: right;width: 50%;"><i class="fa fa-at blcolor"></i> <?=$email?></span>
			</div>
			<div class="row">
				<span class="sub_head"><i class="fa fa-map-marker blcolor"></i> <?=$address?></span>
			</div>
		</div>
		<div class="pro-header-col-right">
			<div style="" class="photo">
				<?=$img;?>
			</div>
		</div>
	</div>
	<div class="pro-body">
		<div class="pro-body-col-left">
		
				<section>
			<div class="pro-body-content">
				<div class="sub_head_body">
					Work Information
				</div>
				<div class="sub_body_body blcolor">
					<div class="row">
						<i class="fa fa-hashtag" aria-hidden="true"></i>Status:  
							<span>
								<?=$empstname?>
							</span>
					</div>
					<div class="row">
						<i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
						Date Of Joining: 
							<span>
								<?=$doj?>
							</span>
					</div>
					<?=$rdateaa?>
					<?=$ldatea?>
					<?=$ldateaa?>
					<div class="row">
						<i class="fa fa-id-card-o" aria-hidden="true"></i>
						Role:  
							<span>
								<?=$rolename?>
							</span>
					</div>
					<div class="row">
						<i class="fa fa-compass" aria-hidden="true"></i>
						Source of Hire:  
							<span>
								<?=$sourceofhire?>
							</span>
					</div>
					<?=$ref_byt?>
					<!--<div>
						<i class="fa fa-id-card-o" aria-hidden="true"></i>
						Job Description:  
							<span>
								<?=$jobdescription?>
							</span>
					</div><br>
					<div>
						<i class="fa fa-id-card-o" aria-hidden="true"></i>
						
							<span>
								<?=$p_date?>
							</span>
					</div><br>-->
				</div>
				
			</div>
			
				</section>
				<section>
				
				<div class="sub_head_body">
					Experience	
				</div>
				<div class="sub_body_bodya ">

				<?php
				
					$getEdu = mysql_query("SELECT `id`, `precompany`, `jobtitle`, `fromdate`, `todate`, `jobdesc`, `eid`, `location`, `startsal`, `leavesal`, `reasonleave`, `responsibilities`, `createdate`, `updatedate`, `updatedby`, `delete` FROM `workexperience` WHERE `eid`='$id'",$con) or die(mysql_error());

						while($rowedu = mysql_fetch_array($getEdu))
						{
							//print_r($rowedu);
							$cname=$rowedu["precompany"];
							$cjt=$rowedu["jobtitle"];
							$cfromdate=$rowedu["fromdate"];
							$ctodate=$rowedu["todate"];
							$cjobdesc=$rowedu["jobdesc"];
							$clocation=$rowedu["location"];
							$cstartsal=$rowedu["startsal"];
							$cleavesal=$rowedu["leavesal"];
							$creasonleave=$rowedu["reasonleave"];
							$responsibilities=$rowedu["responsibilities"];
							$ddegree=$rowedu["degree"];
							echo $res=<<<AAA
							
												<div class="inner">
													<div class="exp-item-det">
														<div class="exp-item-det-head">
															 $cjt 
														</div>
														<div class="exp-item-det-header blcolor">
															$cname
														</div>
														<div class="exp-item-det-header">
															$responsibilities
														</div>
													</div>
													<div class="exp-item-per">
															<div style="">
																<i class="fa fa-map-marker blcolor"></i>	
																$clocation <br>
																
														<div class="in_dates">
															<i class="fa fa-calendar-plus-o blcolor"></i>
															<span>From: <span style="float: right;">$cfromdate</span></span><br>
															<i class="fa fa-calendar-times-o blcolor"></i>
															<span>To: <span style="float: right;">$ctodate</span></span>
															
														</div>
															</div>
													</div>
												</div>
AAA;
						}
				
				
				
				
				
				
				?>
				</div>
			</section>
			<section>
				<div class="sub_head_body">
					Strengths	
				</div>
				<div class="sub_body_bodya " >

				<?php

						$Strengths=array();
			        	$Achievements=array();
			        	$Disciplinary_Actions=array();
			        	$others=array();
			        	$Area_of_Improvement=array();
			        	
					$getEx = mysql_query("SELECT `id`, `name`, `description`, `type`, `employee`, `createdate`, `modifieddate`, `delete`, `status`, `extra`, `createdby` FROM `emp_extra` WHERE `employee`='$id' AND `delete`='0'",$con) or die(mysql_error());

						while($rowex = mysql_fetch_array($getEx))
						{
							
							$type=$rowex["type"];
								switch($type)
									{
									    case 1:
											$Strengths[]=$rowex;
								        	break;
									    case 2:
											$Achievements[]=$rowex;
								        	break;
									    case 3:
											$Disciplinary_Actions[]=$rowex;
								        	break;
									    case 4:
											$others[]=$rowex;
								        	break;
									    case 5:
											$others[]=$rowex;
								        	break;
									    case 6:
											$others[]=$rowex;
								        	break;
									    case 7:
											$others[]=$rowex;
								        	break;
									    case 8:
											$Area_of_Improvement[]=$rowex;
								        	break;
									    case 9:
											$others[]=$rowex;
								        	break;
									}
							//print_r($rowex);
							/*$cname=$rowex["precompany"];
							$cjt=$rowex["jobtitle"];
							$cfromdate=$rowex["fromdate"];
							$ctodate=$rowex["todate"];
							$cjobdesc=$rowex["jobdesc"];
							$clocation=$rowex["location"];
							$cstartsal=$rowex["startsal"];
							$cleavesal=$rowex["leavesal"];
							$creasonleave=$rowex["reasonleave"];
							$responsibilities=$rowex["responsibilities"];
							$ddegree=$rowex["degree"];
							*/
						}
				
				//print_r($Strengths);
				foreach($Strengths as $Strength)
				{
					$Strengthname=$Strength["name"];
					$descriptionas=$Strength["description"];
					echo $res=<<<AAA
							
												<div class="inner">
														<div class="exp-item-det-head " style="width: 100%;">
															<i class="fa fa-star blcolor big_ico"></i> <span class="big_ico_sec">$Strengthname</span> 
														</div>
												</div>
AAA;
				
				}				
				
				?>
				</div>
			</section>
			<section>
				<div class="sub_head_body">
					Achievements	
				</div>
				<div class="sub_body_bodya " >

				<?php
				
					foreach($Achievements as $Achievement)
						{
							$Achievementname=$Achievement["name"];
							$Achievementdesc=$Achievement["description"];
							echo $res=<<<AAA
									
														<div class="inner">
																<div class="exp-item-det-head " style="width: 100%;">
																	<i class="fa fa-diamond blcolor big_ico"></i> <span class="big_ico_sec">$Achievementname</span> 
																</div>
														</div>
AAA;
						
						}	
				
				
				?>
				</div>
			</section><section>
				<div class="sub_head_body">
					Area of Improvement	
				</div>
				<div class="sub_body_bodya " >

				<?php
				 
				
					foreach($Area_of_Improvement as $Area_of_Improvementa)
						{
							$Area_of_Improvementaname=$Area_of_Improvementa["name"];
							$Area_of_Improvementadesc=$Area_of_Improvementa["description"];
							echo $res=<<<AAA
									
														<div class="inner">
																<div class="exp-item-det-head " style="width: 100%;">
																	<i class="fa fa-magic  blcolor big_ico"></i> <span class="big_ico_sec">$Area_of_Improvementaname</span> 
																</div>
														</div>
AAA;
						
						}	
				
				
				?>
				</div>
			</section>
			
			<section>
				<div class="sub_head_body">
					Disciplinary Actions	
				</div>
				<div class="sub_body_bodya " >

				<?php
				
					
					foreach($Disciplinary_Actions as $Disciplinary_Action)
						{
							$Disciplinary_Actionname=$Disciplinary_Action["name"];
							$Disciplinary_Actiondesc=$Disciplinary_Action["description"];
							echo $res=<<<AAA
									
														<div class="inner">
																<div class="exp-item-det-head " style="width: 100%;">
																	<i class="fa fa-exclamation-triangle blcolor big_ico"></i> <span class="big_ico_sec">$Disciplinary_Actionname</span> 
																</div>
														</div>
AAA;
						
						}
				
				
				?>
				</div>
			</section>
			<section>
				<div class="sub_head_body">
					Leave Bank		
				</div>
				<div class="sub_body_bodya " >
				<div class="inner " >

				<?php
				
					
				$sqlLeave = mysql_query("SELECT `EL`, `M`, `special`, `CL`, `SL`, `P` FROM `leaverecord` WHERE  `userid` = '".$id."' AND `delete` = '0'",$con)or die(mysql_error());
				$fetchQLeave = mysql_fetch_array($sqlLeave);
				$EL_R=$fetchQLeave["EL"];
				$M_R=$fetchQLeave["M"];
				$special_R=$fetchQLeave["special"];
				$CL_R=$fetchQLeave["CL"];
				$SL_R=$fetchQLeave["SL"];
				$P=$fetchQLeave["P"];
				$total_bal=$EL_R+$SL_R+$CL_R;	
		
		
		
	echo $Contadd=<<<AAA
						
					<table cellpadding="0" cellspacing="0" width="100%" border=1>
						<tr>
							<th>
								ELR/ELA
							</th>
							<th>
								SLR/SLA
							</th>
							<th>
								CLR/CLA
							</th>
							<th>
								PR/PA
							<th>
								MR/MA
							</th>
							<th>
								SR/SA
							</th>
							<th>
								TR/TA
							</th>
							
						</tr>
						<tr>
							<td>$EL_R/12</td>
							<td>$SL_R/6</td>
							<td>$CL_R/6</td>
							<td>$P/5</td>
							<td>$M_R/90</td>
							<td>$special_R/--</td>
							<td>$total_bal/24</td>
						</tr>
						<tr>
							<td colspan=7 style="text-align: left;">
								<ul style="margin-left: 0%;color: #000;">
									<li><span>ELR/ELA</span><small>Earned leave Remaining</small>/<small>Earned leave Alloted</small></li>
									<li><span>SLR/SLA</span><small>Sick leave Remaining</small>/<small>Sick leave Alloted</small></li>
									<li><span>CLR/CLA</span><small>Casual leave Remaining</small>/<small>Casual leave Alloted</small></li>
									<li><span>P R/P A</span><small>Paternal leave Remaining</small>/<small>Paternal leave Alloted</small></li>
									<li><span>M R/M A</span><small>Maternal leave Remaining</small>/<small>Maternal leave Alloted</small></li>
									<li><span>S R/S A</span><small>Special leave Remaining</small>/<small>Special leave Alloted</small></li>
									<li><span>T R/T A</span><small>Total leave Remaining</small>/<small>Total leave Alloted</small></li>
								</ul>
							</td>
						</tr>
					</table>
<br>
		
AAA;

	
		
	
			?>
				</div>
				</div>
			</section>
		</div>
		<div class="pro-body-col-right">
			<section>
				<div class="sub_head_body">
					Personal Information
				</div>
				<div class="sub_body_body blcolor">
					<div class="row">
						<i class="fa fa-user-circle-o" aria-hidden="true"></i>Fathers Name:  
							<span>
								<?=$fathersname?>
							</span>
					</div>
					<div class="row">
						<i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
						Date Of Birth: 
							<span>
								<?=$dob?>
							</span>
					</div>
					<div class="row">
						<i class="fa fa-venus-mars" aria-hidden="true"></i>

						Gender:  
							<span>
								<?=$gen?>
							</span>
					</div>
					<div class="row">
						<i class="fa fa-heart" aria-hidden="true"></i>
						Marital Status:  
							<span>
								<?=$mm?>
							</span>
					</div>
					<div class="row">
						<i class="fa fa-phone" aria-hidden="true"></i>
						Phone-1:  
							<span>
								<?=$workphone?>
							</span>
					</div>
					<div class="row">
						<i class="fa fa-phone" aria-hidden="true"></i>
						Phone-2:  
							<span>
								<?=$mobile?>
							</span>
					</div>
					<div class="row">
						<i class="fa fa-at" aria-hidden="true"></i>
						Work Mail:  
							<span>
								<?=$workemail?>
							</span>
					</div>
					<div class="row" style="display: inline-block;width: 100%;">
						<i class="fa fa-map-marker" aria-hidden="true"></i>
						Address-2:  
							<span style="text-align: right;">
								<?=$tempAddress?>
							</span>
					</div>
					
					<!--<div>
						<i class="fa fa-id-card-o" aria-hidden="true"></i>
						Job Description:  
							<span>
								<?=$jobdescription?>
							</span>
					</div><br>
					<div>
						<i class="fa fa-id-card-o" aria-hidden="true"></i>
						
							<span>
								<?=$p_date?>
							</span>
					</div><br>-->
				</div>
			</section>
			<section>
				<div class="sub_head_body">
					Education	
				</div>
				<div class="sub_body_bodya blcolor">

				<?php
				
					$getEdu = mysql_query("SELECT `id`, `employee`, `name`, `subject`, `grade`, `year`, `way`, `description`, `degree`, `createdate`, `updatedby`, `delete` FROM `emp_education` WHERE `employee`='$id' AND `type`!=1 AND `delete`=0",$con) or die(mysql_error());

						while($rowedu = mysql_fetch_array($getEdu))
						{
							//print_r($rowedu);
							$dname=$rowedu["name"];
							$dsubject=$rowedu["subject"];
							$dgrade=$rowedu["grade"];
							$dyeargrade=$rowedu["year"];
							$dway=$rowedu["way"];
							$description=$rowedu["description"];
							switch ($dway)
							{
								case 1:
							        $waayt= "Open School";
							        break;
								case 2:
							         $waayt= "Part Time";
							        break;
								case 3:
							         $waayt= "Correspondance";
							        break;
								case 4:
							         $waayt= "Regular";
							        break;
							    
							}
	
							$ddescription=$rowedu["description"];
							$ddegree=$rowedu["degree"];
							echo $res=<<<AAA
							
												<div class="inner">
													<div class="education-item-det">
														<div class="education-item-det-head">
															$ddegree (<small>$dsubject</small>)
														</div>
														<div class="education-item-det-header">
															 $dname (<small>$waayt</small>)
														</div>
														<div class="in_dates">
															<i class="fa fa-calendar"></i>
															<span>$dyeargrade</span><br>
															<b>Description:</b> $description
														</div>
													</div>
													<div class="education-item-per">
														<h4 class="education-item-result-title"  style="text-align:center">Results</h4>
															<div style="text-align:center;font-weight: 600;">
																$dgrade
															</div>
													</div>
												</div>
AAA;
						}
				
				
				
				
				
				
				?>
				</div>
			</section>
			<section>
				<div class="sub_head_body">
					Courses	
				</div>
				<div class="sub_body_bodya blcolor">

				<?php
				
					$getEdu = mysql_query("SELECT `id`, `employee`, `name`, `subject`, `grade`, `year`, `way`, `description`, `degree`, `createdate`, `updatedby`, `delete` FROM `emp_education` WHERE `employee`='$id' AND `type`=1 AND `delete`=0",$con) or die(mysql_error());

						while($rowedu = mysql_fetch_array($getEdu))
						{
							//print_r($rowedu);
							$dname=$rowedu["name"];
							$dsubject=$rowedu["subject"];
							$dyeargrade=$rowedu["year"];	
							$ddescription=$rowedu["description"];
							$ddegree=$rowedu["degree"];
							echo $res=<<<AAA
							
												<div class="inner">
													<div class="education-item-det">
														<div class="education-item-det-head">
															$ddegree (<small>$dsubject</small>)
														</div>
														<div class="education-item-det-header">
															 $dname
														</div>
														<div class="in_dates">
															
															<b>Description:</b> $ddescription
														</div>
													</div>
													<div class="education-item-per">
														<h4 class="education-item-result-title"  style="text-align:center">Year</h4>
															<div style="text-align:center;font-weight: 600;">
																<i class="fa fa-calendar"></i>
															<span>$dyeargrade</span>
															</div>
													</div>
												</div>
AAA;
						}
				
				
				
				
				
				
				?>
				</div>
			</section>
			
			
			<section>
				<div class="sub_head_body">
					Others <small>Innovation / Roles / Responsibilities / Contributions</small>				</div>
				<div class="sub_body_bodya " >
					<div class="inner">
						<div class="exp-item-det-head " style="width: 100%;">
							<i class="fa fa-snowflake-o  blcolor big_ico"></i> 
								<span class="big_ico_sec">Innovation</span> 
								<ul>
				<?php
								foreach($others as $other)
									{
										$othername=$other["name"];
										$otherdesc=$other["description"];
										$othertype=$other["type"];
										if($othertype==4)
										{
											echo $res="<li>".$othername."</li>";
										}
						
									}
				?>
								</ul>
						</div>
					</div>
					<!--<div class="inner">
						<div class="exp-item-det-head " style="width: 100%;">
							<i class="fa fa-snowflake-o  blcolor big_ico"></i> 
								<span class="big_ico_sec">Roles</span> 
								<ul>
				<?php
								foreach($others as $other)
									{
										$othername=$other["name"];
										$otherdesc=$other["description"];
										$othertype=$other["type"];
										if($othertype==5)
										{
											echo $res="<li>".$othername."</li>";
										}
						
									}
				?>
								</ul>
						</div>
					</div>-->
					<div class="inner">
						<div class="exp-item-det-head " style="width: 100%;">
							<i class="fa fa-snowflake-o  blcolor big_ico"></i> 
								<span class="big_ico_sec">Additional Responsibilities</span> 
								<ul>
				<?php
								foreach($others as $other)
									{
										$othername=$other["name"];
										$otherdesc=$other["description"];
										$othertype=$other["type"];
										if($othertype==6)
										{
											echo $res="<li>".$othername."</li>";
										}
						
									}
				?>
								</ul>
						</div>
					</div>
					<div class="inner">
						<div class="exp-item-det-head " style="width: 100%;">
							<i class="fa fa-snowflake-o  blcolor big_ico"></i> 
								<span class="big_ico_sec">Contributions</span> 
								<ul>
				<?php
								foreach($others as $other)
									{
										$othername=$other["name"];
										$otherdesc=$other["description"];
										$othertype=$other["type"];
										if($othertype==7)
										{
											echo $res="<li>".$othername."</li>";
										}
						
									}
				?>
								</ul>
						</div>
					</div>
					<div class="inner">
						<div class="exp-item-det-head " style="width: 100%;">
							<i class="fa fa-snowflake-o  blcolor big_ico"></i> 
								<span class="big_ico_sec">Miscellaneous</span> 
								<ul>
				<?php
								foreach($others as $other)
									{
										$othername=$other["name"];
										$otherdesc=$other["description"];
										$othertype=$other["type"];
										if($othertype==9)
										{
											echo $res="<li>".$othername."</li>";
										}
						
									}
				?>
								</ul>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>