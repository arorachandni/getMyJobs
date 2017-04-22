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
			<span class="titleStart"><strong>Event Title :</strong></span>
			<?php echo ($eventDetails['Event']['event_title']!= "") ? $eventDetails['Event']['event_title'] : 'N/A'; ?>
						
		</div><br />
		
		<div class="fielddiv">
			<span class="titleStart"><strong>Event Location :</strong></span>
			<?php echo ($eventDetails['Event']['location']!= "") ? $eventDetails['Event']['location'] : 'N/A'; ?>
						
		</div><br />
		
		<div class="fielddiv">
			<span class="titleStart"><strong>Event Create Date :</strong></span>
			<?php echo ($eventDetails['Event']['createdon']!= "") ? date('M d, Y H:i:s',strtotime($eventDetails['Event']['createdon'])) : 'N/A'; ?>
						
		</div><br />
		<div class="fielddiv">
			<span class="titleStart"><strong>Description :</strong></span>
			<p><?php echo ($eventDetails['Event']['description']!= "") ? $eventDetails['Event']['description'] : 'N/A'; ?></p>
						
		</div><br />
		<div class="fielddiv">
			<span class="titleStart"><strong>Start Date :</strong></span>
			<?php echo ($eventDetails['Event']['eventdate'] != '0000-00-00') ? date('M d, Y',strtotime($eventDetails['Event']['eventdate'])) : 'N/A'?>
		</div></br>
		
         <div class="fielddiv">
			<span class="titleStart"><strong>Start Time :</strong></span>
			<?php echo ($eventDetails['Event']['start_at'] != '0000-00-00') ? date('M d, Y H:i:s',strtotime($eventDetails['Event']['start_at'])) : 'N/A'?>
		</div></br>
		 <div class="fielddiv">
			<span class="titleStart"><strong>End Time :</strong></span>
			<?php echo ($eventDetails['Event']['end_at'] != '0000-00-00') ? date('M d, Y H:i:s',strtotime($eventDetails['Event']['end_at'])) : 'N/A'?>
		</div></br>
		<div class="fielddiv">
			<span class="titleStart"><strong>Event Type :</strong></span>
			<?php echo ($eventDetails['Event']['eventype']== 0) ? 'Public' : 'Private'; ?>
			</div>			
		<br />
		  <div class="fielddiv">
			<span class="titleStart"><strong>Image :</strong></span>
			<?php $eventImg = $eventDetails['Upload']['url'];
		   if(!empty($eventDetails['Upload']['url'])!='' || $eventDetails['Upload']['url'] !=null)  {
		  	 echo $this->Html->image(SITE_PATH.'img/eventbanner/'.$eventDetails['Upload']['url'], array('alt' => 'UserProfile', 'border' => '0', 'width' => '100', 'height' => '100')); 
		   }
		   else {
		  	 echo $this->Html->image(SITE_PATH.'img/no_image_thumb.gif', array('alt' => 'post', 'border' => '0', 'width' => '100', 'height' => '100'));
		   }
				?>
				
		
		
		</div><br />
		 
		 <input class="submitBtn" type="button"  id="showuser" value="User List Who Report This Event">
		
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