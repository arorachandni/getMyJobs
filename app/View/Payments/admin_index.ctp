<div class="dashmidMain">			
	<div class="dashRight">
		<div class="dashMid">
					<div class="clr">&nbsp;</div>
			<?php echo $this->Session->flash();?>
	<h3>Payment Details</h3>
	<br />
	<div class="transFilt">
	<?php echo $this->Form->create('Payment',array('action'=>'admin_index')); ?>
       	<div class="transFilt-L" >
          
            <?php echo $this->Form->text('Payment.start_date', array('class' => 'testInp', 'label' => false, 'placeholder'=>'Start Date','required' => false)); ?>
        </div>
		<div class="transFilt-L" >
            <?php echo $this->Form->text('Payment.end_date', array('class' => 'testInp', 'label' => false, 'placeholder'=>'End Date','required' => false)); ?>
        </div> 
		
		<div class="transFilt-R">
			<?php echo $this->Form->submit('Search', array('div'=>false, 'label'=>false, 'class'=>'submitBtn'));?>
		</div>
      
        <?php echo $this->Form->end(); ?>
		
		</div>
    <div class="clr">&nbsp;</div>

	  <?php if (! empty($payment_list)){?>
		<div class="appoiTable2">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<th width="10%" class="pl">Sr.no.</th>
					<th width="20%"><?php echo $this->Paginator->sort("plan_name",__("Plan Name")); ?></th>
					<th width="15%"><?php echo $this->Paginator->sort("first_name",__("User name")); ?></th>
					<th width="15%"><?php echo $this->Paginator->sort("theTotal",__("Amount")); ?></th>
					<th width="15%"><?php echo $this->Paginator->sort("payment_date_time",__("Date")); ?></th>	
					<th width="15%"><?php echo $this->Paginator->sort("payment_status",__("Status")); ?></th>
					<th width="10%"><?php echo $this->Paginator->sort("payment_status",__("Action")); ?></th>
				  </tr>
				
				  <?php $counter = 0;
				  foreach($payment_list as $payment) { 
				  	if($counter%2 == 0)
						$tableClass = 'p1';
					else
						$tableClass = 'odd';
				  ?>
				  <tr class="<?php echo $tableClass;?>">
				  	
					<td align="center"> <?php echo $counter+1; ?></td>

					<td><?php echo $payment['Payment']['plan_name']; ?></td>
					<td><?php echo $payment['Payment']['first_name'].' '.$payment['Payment']['last_name']; ?></td>
					<td><?php echo '$'.$payment['Payment']['amount']; ?></td>
					<td><span><?php echo date('M d, Y' , strtotime($payment['Payment']['created'])); ?></span></td>
					<td><?php echo $payment['Payment']['payment_status']; ?></td>
					<td><?php $id = $payment['Payment']['id']; ?>
					<?php echo  $this->Html->image("admin/view-icon.png", array("alt" => "",'url' => array('controller' => 'payments', 'action' => 'view_payment', 'admin' => true, $id)));?></td>
				  </tr>
				  
				  <?php $counter++; } ?>
			</table>
		</div>
						
		<?php echo $this->Element('admin/pagination'); }  else{ ?>
		<div style="text-align:center; color:#FF0000;">!! No Payment found !!</div>
	<?php } ?>		
		<div class="clear"></div>

</div>
