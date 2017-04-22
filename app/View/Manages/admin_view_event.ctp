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
			<?php echo ($eventDetails['Event']['description']!= "") ? $eventDetails['Event']['description'] : 'N/A'; ?>
						
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
		  	echo $this->Html->link(
   			 $this->Html->image(SITE_PATH.'img/eventbanner/'.$eventDetails['Upload']['url']), SITE_PATH.'img/eventbanner/'.$eventDetails['Upload']['url'], array('escape' => false,'target'=>'_blank')
);  }
		   else {
		  	 echo $this->Html->image(SITE_PATH.'img/no_image_thumb.gif', array('alt' => 'post', 'border' => '0', 'width' => '100', 'height' => '100'));
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