<?php $adminData = $this->My->fetchAdminDetail(); ?>
<div class="dashMain">
			<div class="dashHead">
				<div class="dash-logo"><a href="<?= SITE_PATH ; ?>/admin"><?php echo $this->Html->image('admin/logo.png', array('alt' => '', 'style'=> 'height:48px;'));?></a></div>
				<div class="areyou">
				<!--<span>You Are on The: </span> 
			<?php 
				$uAre = Configure::read('ControllerName.'.strtolower($this->name));
				echo (!empty( $uAre ) ) ? $uAre : "Admin";
			?>   -->
			</div>
				<div class="dashwelNav">
					<ul>
						<li><?php echo date("d M Y") ; ?> <span><?php date_default_timezone_set('Asia/Kolkata'); echo date("h:i A"); //date('g:i A', strtotime(time()));   ?></span></li>

						<li><?= $this->Html->image('admin/user-icon.png', array('alt' => '','style'=>'margin-top:-3px; margin-right:2px'));?> 
							Welcome: <?php  echo $adminData['Admin']['username']; ?></li>

						<li><a href="javascript:void(0)" class="settingIcon"><?= $this->Html->image('admin/mobmenu-icon.png', array('alt' => '','class'=>'over'));?></a>
							<div class="settingBx">
								<ul>

									<li><a href="<?= SITE_PATH . 'admin/admins/viewProfile/'; ?>"><?= $this->Html->image('admin/user-icon.png', array('alt' => '','class'=>'img'));?><?= $this->Html->image('admin/user_icon_over.png', array('alt' => '','class'=>'over'));?>My Profile</a></li>

									<li><a href="<?= SITE_PATH . 'admin/admins/change_profile/'; ?>"><?php echo $this->Html->image('admin/setting-icon.png', array('alt' => '','class'=>'img'));?><?php echo $this->Html->image('admin/setting-icon-over.png', array('alt' => '','class'=>'over'));?>Setting</a></li>

									<li><a href="<?= SITE_PATH . 'admin/admins/sign_out'; ?>"><?php echo $this->Html->image('admin/logout-icon.png', array('alt' => '','class'=>'img'));?><?php echo $this->Html->image('admin/logout-icon-over.png', array('alt' => '','class'=>'over'));?>Logout</a></li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>