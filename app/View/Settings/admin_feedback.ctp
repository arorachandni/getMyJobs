<div class="dashmidMain">			
	<div class="dashRight">
		<div class="dashMid">
			<div class="clr">&nbsp;</div>
		<!-- DISPLAY MESSAGE START -->
		<?php echo $this->Session->flash();?>
		<!-- DISPLAY MESSAGE END -->

		<h3>Manage Feedbacks</h3>
		</br>
		<div class="transFilt">
		<?= $this->Form->create('User'); ?>
			<div class="transFilt-L">
				<?= $this->Form->text('name', array('class' => 'testInp', 'placeholder'=>'Search By Name', 'label' => false, 'required' => false)); ?>
			</div>
			<div class="transFilt-R">
				<?= $this->Form->text('email', array('class' => 'testInp', 'placeholder'=>'Search By Email', 'label' => false, 'required' => false)); ?>
			</div>
			<div class="transFilt-R">
				<?= $this->Form->submit('Search', array('div'=>false, 'label'=>false, 'class'=>'submitBtn'));?>
			</div>
			<div class="clr"></div>
		 
	        <?php echo $this->Form->end(); ?>
		</div>
	
		<div class="dashfrmBx">
		 <?php if (! empty($feedbacks)){?>
			<div class="appoiTable2">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<th width="10%" class="pl"><!--<input type = "checkbox" name= "mul_chk">-->Sr.no.</th>
						<th width="15%"><?= $this->Paginator->sort("User.first_name",__("Name")); ?></th>
						<th width="20%"><?= $this->Paginator->sort("User.email",__("Email")); ?></th>
						<th width="20%"><?= $this->Paginator->sort("subject",__("Subject")); ?></th>
						<th width="20%"><?= $this->Paginator->sort("created",__("Date")); ?></th>
						<th width="15%">Action</th>
								
					</tr>
							 
					<?php
						$counter = 0;
						foreach($feedbacks as $feedback){ 
							if($counter%2 == 0)
								$tableClass = 'p1';
							else
								$tableClass = 'odd';
					?>
							
					<tr class="<?php echo $tableClass;?>">
							
						<td align="center"><!--<input type = "checkbox" name= "chk">--> <?php echo $counter+1; ?></td>
						<td><?= $feedback['User']['first_name']; ?></td>
						<td><?= $feedback['User']['email'];?></td> 
						<td><?= $feedback['UserFeedback']['subject'];?></td>
						<td><span><?= date('M d, Y h:i' , strtotime($feedback['UserFeedback']['created'])); ?></span></td>
						<td>
							<?=  $this->Html->image("admin/view-icon.png", array("alt" => "",'url' => array('controller' => 'settings', 'action' => 'view_feedback', $feedback['UserFeedback']['id'])));?>
							
							<?= $this->Form->postLink(
										$this->Html->tag( 'img', '', array( 'src' => SITE_PATH.'img/admin/delete-icon.png')),
											array("controller"=>"users","action"=>"delete/","admin"=>true,$feedback['UserFeedback']['id'],'UserFeedback'),
											array("confirm"=>"Do You Really Want to Delete this Feedback?","escape" => false,'title'=>'Delete')
									);
								?>
							
							</td>
					</tr>
					<?php $counter++; } ?>
				</table>
			</div>
			<?php echo $this->Element('admin/pagination'); }  else{ ?>
				<div style="text-align:center; color:#FF0000;">!! No User Feedback found !!</div>
		<?php } ?>
		</div>	
	<div class="clr"></div>
