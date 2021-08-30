
<div class="page-header navbar navbar-fixed-top">
                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner ">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">
                        <a href="#">
                            <img src="images/hrm-logo.png" alt="logo" class="logo-default">
						</a>
                    </div>
                    <!-- END LOGO -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                        	<?php if(in_array('d_notifica',$thisper))
											{
												?>
                            <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                                <a href="#" class="dropdown-toggle" onclick="if($('#usernoti').css('display')!='block'){$('.ddm_ha').hide();}$('#usernoti').slideToggle();">
                                    <i class="icon-bell"></i>
                                    <span class="badge badge-default" id="notify">  0</span>	
                                    <span class="badge badge-default" id="notifya" style="background: transparent;right: 0px;color: red;font-size: 10px;font-weight: 800;top: 5px;">  </span>	
                                    <div id="mynoti">
									<?php
										include('usernoti.php');
									?>
									</div>
									<!--<iframe src="usernoti.php"></iframe>-->
                                </a>
                            </li>
                            <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                                <a href="#" class="dropdown-toggle" >
                                    <i class="icon-envelope-open"></i>
                                    <span class="badge badge-default"> 0 </span>
                                </a>
                            </li>
                            <li class="dropdown dropdown-extended dropdown-tasks" id="header_task_bar">
                                <a href="#" class="dropdown-toggle" onclick="if($('#task').css('display')!='block'){$('.ddm_ha').hide();} $('#task').slideToggle();">
                                    <i class="icon-calendar"></i>
                                    <span class="badge badge-default" id="taska">  </span>
									<?php 
										if(in_array('a_empd',$thisper)) 
											{
												include('task.php');
											}
									?>
                                </a>
                            </li>
                            <?php } ?>
                            <li class="dropdown dropdown-user">
                                <a href="#" class="dropdown-toggle" onclick="if($('#usermenu').css('display') != 'block') { $('.ddm_ha').hide(); } $('#usermenu').slideToggle(); ">
                                    <?php
										
										$target_file="user/$hrmloggedid.jpg";
										if(file_exists($target_file))
										{
											echo "<img alt='' class='img-circle' src='user/$hrmloggedid.jpg'>";
										}else{
												echo "<img alt='' class='img-circle' src='user/admin.jpg'>";
											}
											
										
									?>
                                    <span class="username"> <?php echo $hrmloggeduser ?> </span>
                                    <i class="fa fa-angle-down"></i>
									<?php
										include('usermenu.php');
									?>
                                </a>
                            </li>
                           <?php if(in_array('d_search',$thisper)) 
                                    {
												?>
                            <li>
                            <div id="search_bar">
 							<input name="Text1" type="text" class="" placeholder="Search Here"  id="mainSearch" onkeypress="checkKey(event,'search')" >
						</div>
						<a class="quick-igger" onclick="$('#search_bar').toggle('slow')">
							<i class="fa fa-search" aria-hidden="true" style="font-size: 20px;color: #fff;position: relative;top: 3px;/*! left: 0px; */"></i>
						</a> 
                            </li>
                             <?php } ?>
                            <!-- END QUICK SIDEBAR TOGGLER -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END HEADER INNER -->
            </div>