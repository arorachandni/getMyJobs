<div class="dashmidMain">			
			<div class="dashRight">
				<div class="dashMid">
					<div class="clr">&nbsp;</div>
	<h3>Payment Details</h3>

	 <?php echo $this->Html->link('Back', 'javascript://', array('onclick'=>' window.history.back();','class' => 'addevent fr')); ?>
	  <div style="clear:both;"></div>

	<div class="dashfrmBx">
	<fieldset>
		<div class="fielddiv">
			<span class="titleStart">Plan Name:</span>
			<strong><?php echo ($paymentDetails['Payment']['plan_name']!= "") ? $paymentDetails['Payment']['plan_name'] : 'N/A'; ?></strong>
						
		</div><br />
		
		<div class="clear"></div>
       <div class="fielddiv">
			<span class="titleStart">Username :</span>
			<strong><?php echo $paymentDetails['Payment']['first_name'].' '.$paymentDetails['Payment']['last_name']; ?></strong>
		</div><br />

		<div class="fielddiv">
			<span class="titleStart">Total Amount :</span>
			<strong><?php echo @$paymentDetails['Payment']['theTotal']; ?>
			</strong>
		</div><br />

		<?php if(!empty($paymentDetails['Payment']['profile_id'])){ ?>
		<div class="fielddiv">
			<span class="titleStart">Payment Id :</span>
			<strong><?php echo ($paymentDetails['Payment']['profile_id']!= "") ? $paymentDetails['Payment']['profile_id'] : 'N/A'; ?></strong>
		</div></br>
		<?php } ?>

		<div class="fielddiv">
			<span class="titleStart">Status :</span>
			<strong><?php echo ($paymentDetails['Payment']['payment_status']!= '') ? $paymentDetails['Payment']['payment_status'] : 'N/A' ;?></strong>
		</div></br>
		<?php if(!empty($paymentDetails['Payment']['failure_reason'])){ ?>
		<div class="fielddiv">
			<span class="titleStart">Failure Reason :</span>
			<strong><?php echo ($paymentDetails['Payment']['failure_reason']!= '') ? $paymentDetails['Payment']['failure_reason'] : 'N/A' ;?></strong>
		</div></br>
		<?php } ?>
		<div class="clear"></div>
		
		<div class="clear"></div>
	
		<div class="clear"></div>
	</fieldset>
	</div>
  </div>
 </div>