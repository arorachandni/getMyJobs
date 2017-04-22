<div class="dashmidMain">			
			<div class="dashRight">
				<div class="dashMid">
					<div class="clr">&nbsp;</div>
	<h3>Abuse Post</h3>

	 <?= $this->Html->link('Back', 'javascript://', array('onclick'=>' window.history.back();','class' => 'addevent fr')); ?>
	  <div style="clear:both;"></div>

	<div class="dashfrmBx">
	<fieldset>
		
		<div class="fielddiv">
			<span class="titleStart"><strong>Comments :</strong></span>
			<?php //pr($eventDetails); die;
			 if($eventDetails['Post']['type']=='comment'){ ?><span>Post Comment :</span><?php
				//echo $this->Form->input('Post.data', array('div'=>false, 'label'=>false, 'type'=>'textarea','class'=>'dashInpfld validate[required]', 'maxlength'=>50, 'required'=>false)); 
				echo $eventDetails['Post']['data'];
			 } else if($eventDetails['Post']['type']=='image') { ?>
			 	 <div class="dvPreview"><?php 
			 	 echo $this->Html->link($this->Html->image(SITE_PATH.'img/postImage/'.$eventDetails['Post']['data'], array('alt' => 'post', 'border' => '0', 'width' => '60', 'height' => '60')), SITE_PATH.'img/postImage/'.$eventDetails['Post']['data'], array('escape' => false,'target' =>'_blank'));
			 
			 	 ?></div>
				
			 <?php } else if($eventDetails['Post']['type']=='video') { ?>
			
			 <div class="dvPreview"><?php  
			  echo $this->Html->link($this->Html->image(SITE_PATH.'img/videoThumb/'.$eventDetails['Post']['thumburl'], array('alt' => 'post', 'border' => '0', 'width' => '60', 'height' => '60')), SITE_PATH.'img/postVideo/'.$eventDetails['Post']['data'], array('escape' => false,'target' =>'_blank'));
			  echo $this->Html->link($this->Html->image(SITE_PATH.'img/video-icon.png', array('alt' => 'post', 'border' => '0', 'width' => '30', 'height' => '30' , 'class'=>'iicon')), SITE_PATH.'img/postVideo/'.$eventDetails['Post']['data'], array('escape' => false,'target' =>'_blank'));
			 ?></div>
		  <?php } ?>
						
		</div><br />
		
		
		<div class="fielddiv">
			<span class="titleStart"><strong>Post Date :</strong></span>
			<?php echo ($eventDetails['Post']['created']!= "") ? $eventDetails['Post']['created'] : 'N/A'; ?>
						
		</div><br />
		
		  
		   <input class="submitBtn" type="button"  id="showuser" value="User List Who Report This Post">
		
		 <br />
		  <br />
		   <br />
		 
					 
		<div class="clear"></div>
		
		 <?php if (! empty($user_list)){?>
		<div class="appoiTable2" id="listuser" style="display:none;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				   <tr>
					<th width="5%" class="pl">Sr.no.</th>
					<th width="10%"><?php echo $this->Paginator->sort("user_name",__("User Name")); ?></th>
					<th width="10%"><?php echo $this->Paginator->sort("",__("Image")); ?></th>
					<th width="10%"><?php echo $this->Paginator->sort("email",__("Email")); ?></th>
					<th width="10%"><?php echo $this->Paginator->sort("status",__("Status")); ?></th>
					<th width="10%"><?php echo $this->Paginator->sort("created",__("Registration Date")); ?></th>
				<!--	<th width="10%"><?php echo $this->Paginator->sort("Event List",__("Event List")); ?></th> -->
					
				  </tr>
				
				  <?php
				  
				   $counter = 0;
				  foreach($user_list as $userData) { 
				  	if($counter%2 == 0)
						$tableClass = 'p1';
					else
						$tableClass = 'odd';
				  ?>
				  <tr class="<?php echo $tableClass;?>">
				  	
					<td align="center"> <?php echo $counter+1; ?></td>
                   
					<td><?php echo $userData['User']['username']; ?></td>
					<td><?php 
					$userImg = $this->My->fetchUserImage($userData['User']['id']);
					if(!empty($userImg)){
					 echo $this->Html->image(SITE_PATH.'img/userImg/'.$userImg, array('alt' => 'post', 'border' => '0', 'width' => '100', 'height' => '100'));
					 } else {
					 	echo $this->Html->image(SITE_PATH.'img/noimage.ico', array('alt' => 'post', 'border' => '0', 'width' => '100', 'height' => '100'));
					 }
					 ?></td>
					<td><?php echo $userData['User']['email']; ?></td>
					<td><?php if($userData['User']['status']==0 || $userData['User']['status']==2){echo "DeActivate";} else {echo "Activate";} ?></td>
					
					<td><span><?php echo date('M d, Y' , strtotime($userData['User']['created'])); ?></span></td>
				<!--	 <td><?php echo $this->Html->link('User Events',array('controller'=>'manages','action'=>'event_list',$userData['User']['id']),array('rel'=> 'Event List','data-placement' => 'left','data-original-title' => 'Edit','class'=> 'event_link','escape'=> false  ));?></td>
					-->
				  </tr>
				  
				  <?php $counter++; } }?>
			</table>
		</div>
		 
					 
		<div class="clear"></div>
		
		
		
		<div class="clear"></div>
	
		<div class="clear"></div>
	</fieldset>
	</div>
  </div>
 </div>
 
 <script>
 $(document).ready(function(){
  $("#showuser").click(function(){
  $("#listuser").toggle("slow");
  });
 });

 </script>