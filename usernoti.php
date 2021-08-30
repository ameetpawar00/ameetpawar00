<div style="display:inline-block;position:relative;z-index:99999999 !important">
	<div class="dropdown-menu ddm_ha" style="top:10px;z-index:99999999 !important;display:none" id="usernoti">
		<div class="dropdown-menu-inner">
			<div style="background:#fff;">
				<ul>
				<li><?php include("include/conFig.php");	
				include ("dash/index_small.php");?></li>
				<?php 
					
					$role=$_COOKIE['hrmrole'];
					if($role=='0' OR $role=='1') 
						{
							$getNoti= mysql_query("SELECT * FROM `jobvacancy` WHERE `delete` = '0' AND `vacancy` != '0'");
							$num_rows= mysql_num_rows($getNoti);
						}
						else if($role=='2') 
								{
									$getNoti= mysql_query("SELECT * FROM `refer` WHERE approval='0' AND `delete` = '0'");
									$num_rows = mysql_num_rows($getNoti);
								}

						while($row = mysql_fetch_array($getNoti)) 
							{
								$desi = $row['designation'];
								$id =  $row['id'];
							}
					
						if ($role=='0' OR $role=='1') 
							{
								$liss_s=<<<AAA
								
								
										<li id="update" onclick=" getModule('notification/view?desi=$desi&id=$id', 'viewContent', 'manipulateContent', 'Notification' ) ;">
											<div class="notinoti" style="background: ;height: 100%;">
												<div class="datablock ">
													<div class="small_block gray_dark" onclick="getModule('management/leaverequest/view?cl_leav_p','viewContent','manipulateContent','Manage Leave Request');">
														<i class="fa fa-bell"></i>
													</div>
														<div class="medium_block " onclick="getModule('management/leaverequest/view?cl_leav_p','viewContent','manipulateContent','Manage Leave Request');">
															<span>
																<b><span id="">$num_rows New Job </span> Do Refer Candidates</b> 
																<small></small>
															</span>
														</div>
													</div>
												</div>
										</li>
AAA;
							}elseif($role=='2') 
									{
										$liss_s=<<<AAA
										
											<li style="width:auto;"  onclick="getModule('management/refral/view','viewContent','manipulateContent','View Refral') ">
												<img  src="img/noti.jpg" style=" width:15px;  height:15px; "> &nbsp;&nbsp; 
												<span style="color:black">
													$num_rows referal Pending
													<i onclick=" getModule('management/refral/view','viewContent','manipulateContent','View Refral')">
													</i>
												</span>
											</li>
AAA;
									}
				echo $liss_s;
						
						?>
				</ul>
			</div>
		</div>
	</div>
</div>
