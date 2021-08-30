<div style="display:inline-block;position:relative;z-index:99999999 !important">
	<div class="dropdown-menu ddm_ha" style="top:10px;z-index:99999999 !important;display:none" id="usermenu">
		<div class="dropdown-menu-inner">
			<!--<div class="dropdown-menu-inner-title">
			Manage Profile</div>-->
			<div style="background:#fff;">
				<ul>
 <?php if(in_array('d_changepic',$thisper)) 
											{
												?>
					<li onclick="getModule('settings/profile_pic_edit?eid=<?php echo $hrmloggedid?>','manipulatemoodleContent','viewmoodleContent','Employee')">
						<i class="fa fa-user"></i>
							Change Profile Pic
					</li> <?php } ?>
					<?php /*?> <?php if(in_array('d_profile_view',$thisper)) 
											{
												?>
					<li onclick="getModule('profile/view?eid=<?php echo $hrmloggedid?>','manipulateContent','viewContent','Profile')">
						<i class="fa fa-user-plus"></i>
							View Profile
					</li>
 <?php } ?><?php */?>
  <?php if(in_array('d_changep',$thisper)) 
											{
												?>
					<li onclick="getModule('settings/chngpaswd?eid=<?php echo $hrmloggedid?>','manipulatemoodleContent','viewmoodleContent','Employee')">
						<i class="fa fa-key"></i>
							Change password
					</li> <?php } ?>
					<hr/>
					<li onclick="logout()">
						<i class="fa fa-sign-out"></i>
						<span style="color:black">
							<b>Log Out</b>
						</span>
					<div style="float:right;padding-right:10px;">
					</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
	
</div>