<div class="dashmidMain">			
			<div class="dashRight">
				<div class="dashMid">
					<div class="clr">&nbsp;</div>
	<h3>User Profile Details</h3>

	 <?= $this->Html->link('Back', 'javascript://', array('onclick'=>' window.history.back();','class' => 'addevent fr')); ?>
	  <div style="clear:both;"></div>
		
		 <div class="row">
			<div class="col-sm-2">Name</div>
			<div class="col-sm-1"><b>:</b></div>
				<div class="col-sm-8">
				<?php echo ($UserDetails['User']['firstname']!= "") ? $UserDetails['User']['firstname'] : ''; ?>
				<?php echo ($UserDetails['User']['lastname']!= "") ? $UserDetails['User']['lastname'] : ''; ?>
				</div>	
		</div>
		<div class="row">
			<div class="col-sm-2">Username</div>
			<div class="col-sm-1"><b>:</b></div>
			<div class="col-sm-8">
				<?php echo ($UserDetails['User']['username']!= "") ? $UserDetails['User']['username'] : ''; ?>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2">Status</div>
			<div class="col-sm-1"><b>:</b></div>
			<div class="col-sm-8">
				<?php if($UserDetails['User']['username']==1) { echo "Active";} else if($UserDetails['User']['username']==2){ echo "Pending";} else { echo "Suspended";} ?>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2">How user know about website</div>
			<div class="col-sm-1"><b>:</b></div>
			<div class="col-sm-8">
				<?php echo $this->My->getKnows($UserDetails['User']['how_you_know']); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2">User Type</div>
			<div class="col-sm-1"><b>:</b></div>
			<div class="col-sm-8">
				<?php  if($UserDetails['User']['usertype']==1){ echo "Freelancer";} else if($UserDetails['User']['usertype']==2){ echo "Work";}else {echo "Company";} ?>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2">Email</div>
			<div class="col-sm-1"><b>:</b></div>
			<div class="col-sm-8">
				<?php echo ($UserDetails['User']['email']!= "") ? $UserDetails['User']['email'] : ''; ?>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-2">Image</div>
			<div class="col-sm-1"><b>:</b></div>
			<div class="col-sm-8">
				<?php
			if(!empty($UserDetails['User']['profileImage'])!='' || $UserDetails['User']['profileImage'] !=null)  {
		   echo $this->Html->image(SITE_PATH.'img/userImg/'.$UserDetails['User']['profileImage'], array('alt' => 'UserProfile', 'border' => '0', 'width' => '100', 'height' => '100')); 
		   }
		   else {
		   echo $this->Html->image(SITE_PATH.'img/noimage.ico', array('alt' => 'post', 'border' => '0', 'width' => '100', 'height' => '100'));
		   }
			  ?>
			</div>
		</div>
		
		
		
		
		

		
	</div>
  </div>
 </div>