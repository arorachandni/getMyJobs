<div class="dashmidMain">			
	<div class="dashRight">
		<div class="dashMid">
					<div class="clr">&nbsp;</div>
			<?php echo $this->Session->flash();?>
	<h3>Report User Details</h3>
	<br />
	<div class="transFilt">
	<?php echo $this->Form->create('User'); ?>
       	<div class="transFilt-L" >
          
            <?php echo $this->Form->text('sender', array('class' => 'testInp', 'label' => false, 'placeholder'=>'Search By Sender','required' => false)); ?>
        </div>
		<div class="transFilt-L" >
          
            <?php echo $this->Form->text('receiver', array('class' => 'testInp', 'label' => false, 'placeholder'=>'Search By Receiver','required' => false)); ?>
        </div>
		<div class="transFilt-R">
			<?php echo $this->Form->submit('Search', array('div'=>false, 'label'=>false, 'class'=>'submitBtn'));?>
		</div>
      
        <?php echo $this->Form->end(); ?>
		
		</div>
    <div class="clr">&nbsp;</div>

	  <?php if (! empty($user_list)){?>
		<div class="appoiTable2">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<th width="10%" class="pl">Sr.no.</th>
					<th width="15%"><?php echo $this->Paginator->sort("Sender.name",__("Sender")); ?></th>
					
					<th width="15%"><?php echo $this->Paginator->sort("Receiver.name",__("Receiver")); ?></th>
					
					<th width="25%"><?php echo $this->Paginator->sort("reason",__("reason")); ?></th>

					<th width="15%"><?php echo $this->Paginator->sort("created",__("Date")); ?></th>
					<th width="20%">Action</th>
				  </tr>
				
				  <?php $counter = 0;
				  foreach($user_list as $userData) { 
				  	if($counter%2 == 0)
						$tableClass = 'p1';
					else
						$tableClass = 'odd';
				  ?>
				  <tr class="<?php echo $tableClass;?>">
				  	
					<td align="center"> <?php echo $counter+1; ?></td>

					<td><?php echo $userData['Sender']['name']; ?></td>

					<td><?php echo $userData['Receiver']['name']; ?></td>

					<td><?php echo $userData['ReportUser']['reason']; ?></td>

					<td><span><?php echo date('M d, Y' , strtotime($userData['ReportUser']['created'])); ?></span></td>
					<td>
				
					<?php echo $this->Form->postLink(
							$this->Html->tag( 'img', '', array( 'src' => SITE_PATH.'img/admin/delete-icon.png')),
								array("controller"=>"users","action"=>"delete","admin"=>true,$userData['ReportUser']['id']),
								array("confirm"=>"Do You Really Want to Delete this Report?","escape" => false,'title'=>'Delete')
						);
					?>
				  </tr>
				  
				  <?php $counter++; } ?>
			</table>
		</div>
						
		<?php echo $this->Element('admin/pagination'); }  else{ ?>
		<div style="text-align:center; color:#FF0000;">!! No User found !!</div>
	<?php } ?>
		
		
		<div class="clear"></div>

</div>
