<div class="dashmidMain">			
			<div class="dashRight">
				<div class="dashMid">
					<div class="clr">&nbsp;</div>
	<h3>Admin Profile Details</h3>

	 <?= $this->Html->link('Back', 'javascript://', array('onclick'=>' window.history.back();','class' => 'addevent fr')); ?>
	  <div style="clear:both;"></div>

	<div class="dashfrmBx">
	<fieldset>
	  
		<div class="fielddiv">
			<span class="titleStart">First Name :</span>
			<strong><?= $adminDetails['Admin']['first_name'];?></strong>
		</div></br>

		<div class="fielddiv">
			<span class="titleStart">Last Name :</span>
			<strong><?= $adminDetails['Admin']['last_name'];?></strong>
		</div></br>
		
		<div class="clear"></div>
       <div class="fielddiv">
			<span class="titleStart">Email :</span>
			<strong><?= $adminDetails['Admin']['email'];?></strong>
		</div></br>

		<div class="fielddiv">
			<span class="titleStart">Username :</span>
			<strong><?= $adminDetails['Admin']['username'];?></strong>
		</div></br>

		<div class="fielddiv">
			<span class="titleStart">Mobile Number :</span>
			<strong><?php if(!empty($adminDetails['Admin']['mobile_number'])) echo $adminDetails['Admin']['mobile_number']; else echo 'N/A' ;?></strong>
		</div></br>

		<div class="clear"></div>
		
		<div class="clear"></div>
	
		</div>
		<div class="clear"></div>
	</fieldset>
	</div>
  </div>
 </div>