<div class="dashmidMain">			
			<div class="dashRight">
				<div class="dashMid">
					<div class="clr">&nbsp;</div>
	<h3>User Profile Details</h3>

	 <?= $this->Html->link('Back', 'javascript://', array('onclick'=>' window.history.back();','class' => 'addevent fr')); ?>
	  <div style="clear:both;"></div>

	<div class="dashfrmBx">
	<fieldset>
		
		<div class="fielddiv">
			<span class="titleStart">Full Name :</span>
			<strong><?php echo ($UserDetails['User']['fullname']!= "") ? $UserDetails['User']['fullname'] : 'N/A'; ?></strong>
		</div><br />
		<div class="fielddiv">
			<span class="titleStart">User Name :</span>
			<strong><?php echo ($UserDetails['User']['email']!= "") ? $UserDetails['User']['username'] : 'N/A'; ?></strong>
						
		</div><br />
		<div class="clear"></div>
       <div class="fielddiv">
			<span class="titleStart">Email :</span>
			<strong><?php echo ($UserDetails['User']['email']!= '') ? $UserDetails['User']['email'] : 'N/A'; ?></strong>
		</div><br />
		<div class="fielddiv">
			<span class="titleStart">Gender :</span>
			<strong><?php echo ($UserDetails['User']['gender']== 1) ? 'Male' : 'Female'; ?></strong>
		</div></br>
		  <div class="fielddiv">
			<span class="titleStart">Country :</span>
			<strong><?php echo ($this->My->fetchCountry($UserDetails['User']['iso'])!= '') ? $this->My->fetchCountry($UserDetails['User']['iso']) : 'N/A'; ?></strong>
		</div><br />
		<div class="fielddiv">
			<span class="titleStart">Mobile :</span>
			<strong><?php echo ($UserDetails['User']['mobile']!= '') ? $UserDetails['User']['mobile'] : 'N/A'; ?></strong>
		</div><br />
		<div class="fielddiv">
			<span class="titleStart">Status :</span>
			<strong><?php echo ($UserDetails['User']['status']!= '') ? 'Activate' : 'Deactivate'; ?></strong>
		</div><br />
		<div class="fielddiv">
			<span class="titleStart">Image :</span>
			<?php
			if(!empty($UserDetails['Upload']['url'])!='' || $UserDetails['Upload']['url'] !=null)  {
		   echo $this->Html->image(SITE_PATH.'img/userImg/'.$UserDetails['Upload']['url'], array('alt' => 'UserProfile', 'border' => '0', 'width' => '100', 'height' => '100')); 
		   }
		   else {
		   echo $this->Html->image(SITE_PATH.'img/noimage.ico', array('alt' => 'post', 'border' => '0', 'width' => '100', 'height' => '100'));
		   }
			  ?>
		</div><br />
		<div class="clear"></div>
		<div class="clear"></div>
		<div class="clear"></div>
	</fieldset>
	</div>
  </div>
 </div>