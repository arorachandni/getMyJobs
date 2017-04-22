<div class="dashmidMain">			
			<div class="dashRight">
				<div class="dashMid">
					<div class="clr">&nbsp;</div>
	<h3>Event Details</h3>

	 <?= $this->Html->link('Back', 'javascript://', array('onclick'=>' window.history.back();','class' => 'addevent fr')); ?>
	  <div style="clear:both;"></div>

	<div class="dashfrmBx">
	<fieldset>
		
		<div class="fielddiv">
			<span class="titleStart"><strong>Comments :</strong></span>
			<?php 
			 if($eventDetails['Post']['type']=='comment'){ ?><span>Post Comment :</span><?php
				echo $this->Form->input('Post.data', array('div'=>false, 'label'=>false, 'type'=>'textarea','class'=>'dashInpfld validate[required]', 'maxlength'=>50, 'required'=>false)); 
			 } else if($eventDetails['Post']['type']=='image') { ?>
			 	 <div class="dvPreview"><?php 
			 	 
			 	 echo $this->Html->link($this->Html->image(SITE_PATH.'img/postImage/'.$eventDetails['Post']['data'], array('alt' => 'post', 'border' => '0', 'width' => '60', 'height' => '60')), SITE_PATH.'img/postImage/'.$eventDetails['Post']['data'], array('escape' => false,'target' =>'_blank'));
			 
			 	 ?></div>
				
			 <?php } else if($eventDetails['Post']['type']=='video') { ?>
			
			 <div class="dvPreview"><?php  
			 echo $this->Html->link($this->Html->image(SITE_PATH.'img/video.jpeg', array('alt' => 'post', 'border' => '0', 'width' => '60', 'height' => '60')), SITE_PATH.'img/postVideo/'.$eventDetails['Post']['data'], array('escape' => false,'target' =>'_blank'));
			 
			 
			 ?></div>
		  <?php } ?>
						
		</div><br />
		
		
		<div class="fielddiv">
			<span class="titleStart"><strong>Post Date :</strong></span>
			<?php echo ($eventDetails['Post']['created']!= "") ? $eventDetails['Post']['created'] : 'N/A'; ?>
						
		</div><br />
		
		  
		 
					 
		<div class="clear"></div>
		
		<div class="clear"></div>
	
		<div class="clear"></div>
	</fieldset>
	</div>
  </div>
 </div>