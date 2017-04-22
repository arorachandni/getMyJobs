<?php
    $controller = $this->params['controller'];
    $action = $this->params['action'];
?>
<script>
/*------------------Dash Left Nav----------------------*/
$(document).ready( function(){
$('.active').next(".dashsubnav").slideDown(500);


	$(".dashsubnav").slideUp(0);
	if($(".dashNav > ul > li > .dashsubnav a").hasClass("current")){
	//$(".dashNav > ul > li > a").removeClass("active");
	$(".dashNav > ul > li > .dashsubnav  a.current").closest(".dashsubnav").slideDown(0);
	}
	else{
	$(".dashNav > ul > li > a").removeClass("active");
	}

	$(".dashNav > ul > li > a").click(function(){
	
		$(".dashsubnav").slideUp(500);
		if($(this).hasClass("active"))
		{
		$(".dashsubnav").slideUp(500);
		$(this).removeClass("active");
		}
		else
		{
		$(".dashNav > ul > li > a").removeClass("active");
		$(this).next(".dashsubnav").slideDown(500);  
		$(this).addClass("active");
		}
});
	
});
</script>

<div class="dashLeft">
	<div class="leftmenuHd">
		<div class="menuHd">Menu </div>
	</div>
	<div class="dashNav" style=" overflow: auto;">
		<ul>
						
		 <li><a href="javascript://void(0);"  class="<?php echo ($controller == 'admins' && ($action == 'admin_dashboard' || $action == 'admin_change_email_admin' || $action == 'admin_change_profile' || $action == 'admin_change_password')) ? 'active' : ""; ?>" >Admin Settings <span></span></a>				
			<div class="dashsubnav">
				<ul><li><a href="<?php echo SITE_PATH . 'admin/admins/dashboard/'; ?>" <?php echo ($controller == 'admins' && $action == 'admin_dashboard') ? 'class="current"' : ""; ?>>Dashboard</a></li>
					<li><a href="<?php echo SITE_PATH . 'admin/admins/change_email_admin/'; ?>" <?php echo ($controller == 'admins' && $action == 'admin_change_email_admin') ? ' class="current"' : ""; ?>>Change Email</a></li>
					<li><a  href="<?php echo SITE_PATH . 'admin/admins/change_profile/'; ?>" <?php echo ($controller == 'admins' && $action == 'admin_change_profile') ? 'class="current"' : ""; ?>>Change Profile</a></li>
					<li><a href="<?php echo SITE_PATH . 'admin/admins/change_password/'; ?>" <?php echo ($controller == 'admins' && $action == 'admin_change_password') ? 'class="current"' : ""; ?>>Change Password</a></li>
																	
				</ul>
			</div>
		</li>
		<li><a href="javascript://void(0);" class="nav-top-item <?php echo ($controller == 'users' && ($action=='admin_user_list' || $action=='admin_add_user')) ? 'active' : ""; ?>">Manage Users<span></span></a>
                    
			<div class="dashsubnav">
				<ul>
					<li><a href="<?php echo SITE_PATH . 'admin/users/user_list/'; ?>" <?php echo ($controller == 'users' && $action == 'admin_user_list') ? 'class="current"' : ""; ?>>Browse Users</a></li>
					<li><a href="<?php echo SITE_PATH . 'admin/users/add_user/'; ?>" <?php echo ($controller == 'users' && $action == 'admin_add_user') ? 'class="current"' : ""; ?>>Add Users</a></li>
				</ul>
			</div>
		</li>
		
		<li><a href="javascript://void(0);" class="nav-top-item <?php echo ($controller == 'manages' && ($action == 'admin_event_list')) ? 'active' : ""; ?>">Manage Jobs<span></span></a>
                    
			<div class="dashsubnav">
				<ul>
					<li><a href="<?php echo SITE_PATH . 'admin/jobs/job_list'; ?>" <?php echo ($controller == 'jobs' && $action == 'admin_job_list') ? 'class="current"' : ""; ?>>Jobs List</a>
					</li>
					
					<!--<li><a href="<?php echo SITE_PATH . 'admin/manages/add_event/'; ?>" <?php echo ($controller == 'manages' && $action == 'admin_add_event') ? 'class="current"' : ""; ?>>Add Event</a>
					</li> --->
				</ul>
			</div>
		</li>
		
		<li><a href="javascript://void(0);" class="nav-top-item <?php echo ($controller == 'manages' && ($action == 'admin_event_list')) ? 'active' : ""; ?>">Manage Events<span></span></a>
                    
			<div class="dashsubnav">
				<ul>
					<li><a href="<?php echo SITE_PATH . 'admin/manages/event_list/?type=upcoming'; ?>" <?php echo ($controller == 'manages' && $action == 'admin_event_list') ? 'class="current"' : ""; ?>>Upcoming Events</a>
					</li>
					<li><a href="<?php echo SITE_PATH . 'admin/manages/event_list/?type=previous'; ?>" <?php echo ($controller == 'manages' && $action == 'admin_event_list') ? 'class="current"' : ""; ?>>Previous Events</a>
					</li>
					<!--<li><a href="<?php echo SITE_PATH . 'admin/manages/add_event/'; ?>" <?php echo ($controller == 'manages' && $action == 'admin_add_event') ? 'class="current"' : ""; ?>>Add Event</a>
					</li> --->
				</ul>
			</div>
		</li>
		
		<li><a href="javascript://void(0);" class="nav-top-item <?php echo ($controller == 'manages' && ($action == 'admin_event_list')) ? 'active' : ""; ?>">CMS<span></span></a>
            <div class="dashsubnav">
				<ul>
					<li><a href="<?php echo SITE_PATH . 'admin/cms/pages/'; ?>" <?php echo ($controller == 'manages' && $action == 'admin_event_list') ? 'class="current"' : ""; ?>>Pages</a>
					</li>
					
				</ul>
			</div>
		</li>
		
	<!--	<li><a href="javascript://void(0);" class="nav-top-item <?php echo ($controller == 'reports' && ($action == 'admin_userList' || $action == 'admin_girlList' || $action == 'admin_paymentList')) ? 'active' : ""; ?>">Manage Reports<span></span></a>
			<div class="dashsubnav">
				<ul>
					<li><a href="<?php echo SITE_PATH . 'admin/reports/userList/'; ?>" <?php echo ($controller == 'reports' && $action == 'admin_userList') ? 'class="current"' : ""; ?>>Report Users</a>
					</li>
					<li><a href="<?php echo SITE_PATH . 'admin/reports/paymentList/'; ?>" <?php echo ($controller == 'reports' && $action == 'admin_paymentList') ? 'class="current"' : ""; ?>>Report View Payment</a> -->
					<!--</li>
				</ul>
			</div>
		</li> -->
		
		<li><a href="javascript://void(0);" class="nav-top-item <?php echo ($controller == 'reports' && ($action == 'admin_userList' || $action == 'admin_girlList' || $action == 'admin_paymentList')) ? 'active' : ""; ?>">Manage Reports Abuse<span></span></a>
			<div class="dashsubnav">
				<ul>
					<li><a href="<?php echo SITE_PATH . 'admin/posts/abusepost_list/'; ?>" <?php echo ($controller == 'reports' && $action == 'admin_userList') ? 'class="current"' : ""; ?>>Abuse Posts</a>
					</li>
					<li><a href="<?php echo SITE_PATH . 'admin/manages/abuseevent_list/'; ?>" <?php echo ($controller == 'reports' && $action == 'admin_paymentList') ? 'class="current"' : ""; ?>>Abuse Events</a> 
					</li>
				</ul>
			</div>
		</li>
		<li><a href="<?php echo SITE_PATH . 'admin/users/email_list'; ?>" >Email List</a></li>
		<li><a href="<?php echo SITE_PATH . 'admin/admins/sign_out'; ?>" >Logout</a></li>	
					
	</div>
</div>
	

	
<script>
$(document).ready(function(){
	var hdr = $(".dashHead").height();
	var wi = $(".dashLeft").height();
	var mnu =$(".leftmenuHd").height();
	var tothgt =wi-mnu-hdr;
	$(".dashNav").css("height", tothgt );
});
</script>