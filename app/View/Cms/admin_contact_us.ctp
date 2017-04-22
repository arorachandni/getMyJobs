<div class="dashmidMain">			
			<div class="dashRight">
				<div class="dashMid">
					<div class="clr">&nbsp;</div>
	<!-- DISPLAY MESSAGE START -->
	<?php echo $this->Session->flash();?>
	<!-- DISPLAY MESSAGE END -->
	<h3>Manage Contacts</h3>
	</br>
	<div class="transFilt">
	<?= $this->Form->create('Contact'); ?>
		<div class="transFilt-L">
			<?= $this->Form->text('Contact.name', array('class' => 'testInp', 'placeholder'=>'Search By Name', 'label' => false, 'required' => false)); ?>
		</div>
		<div class="transFilt-R">
			<?= $this->Form->text('Contact.email', array('class' => 'testInp', 'placeholder'=>'Search By Email', 'label' => false, 'required' => false)); ?>
		</div>
		<div class="transFilt-R">
			<?= $this->Form->submit('Search', array('div'=>false, 'label'=>false, 'class'=>'submitBtn'));?>
		</div>
		<div class="clr"></div>
	 
        <?php echo $this->Form->end(); ?>
	</div>
	
		<div class="dashfrmBx">
		 <?php if (! empty($viewListing)){?>
			<div class="appoiTable2">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<th width="10%" class="pl"><!--<input type = "checkbox" name= "mul_chk">-->Sr.no.</th>
						<th width="15%"><?= $this->Paginator->sort("name",__("Name")); ?></th>
						<th width="20%"><?= $this->Paginator->sort("email",__("Email")); ?></th>
						<th width="20%"><?= $this->Paginator->sort("subject",__("Subject")); ?></th>
						<th width="20%"><?= $this->Paginator->sort("first_name",__("Contact On")); ?></th>
						<th width="15%">Action</th>
								
					</tr>
							 
					<?php
						$counter = 0;
						foreach($viewListing as $listing)
						{ 
							if($counter%2 == 0)
								$tableClass = 'p1';
							else
								$tableClass = 'odd';
					?>
							
					<tr class="<?php echo $tableClass;?>">
							
						<td align="center"><!--<input type = "checkbox" name= "chk">--> <?php echo $counter+1; ?></td>
						<td><?= $listing['Contact']['name']; ?></td>
						<td><?= $listing['Contact']['email'];?></td> 
						<td><?= $listing['Contact']['subject'];?></td>
						<td><span><?= date('M d, Y h:i' , strtotime($listing['Contact']['created'])); ?></span></td>
						<td>
							<?=  $this->Html->image("admin/view-icon.png", array("alt" => "",'url' => array('controller' => 'cms', 'action' => 'view_message', $listing['Contact']['id'])));?>
							
							<?= $this->Form->postLink(
										$this->Html->tag( 'img', '', array( 'src' => SITE_PATH.'img/admin/delete-icon.png')),
											array("controller"=>"users","action"=>"delete/","admin"=>true,$listing['Contact']['id'],'Contact'),
											array("confirm"=>"Do You Really Want to Delete this Contact?","escape" => false,'title'=>'Delete')
									);
								?>
							
							</td>
					</tr>
					<?php $counter++; } ?>
				</table>
			</div>
			<?php echo $this->Element('admin/pagination'); }  else{ ?>
				<div style="text-align:center; color:#FF0000;">!! No Contact User found !!</div>
		<?php } ?>
		</div>	
	<div class="clr"></div>
