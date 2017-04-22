<div class="dashmidMain">			
	<div class="dashRight">
		<div class="dashMid">
					<div class="clr">&nbsp;</div>
			<?php echo $this->Session->flash();?>
	<h3>Events List (Total Event : <?php echo $total_event;?>)</h3>
	<br />
	<div class="transFilt">
	<?php if(isset($user_id)) {$u_id=$user_id;} else { $u_id='';} echo $this->Form->create('manages', array('action'=>'admin_event_list/'.$u_id)); ?>
       	<div class="transFilt-L" >
          	<?php echo $this->Form->text('Event.event_title', array('class' => 'testInp', 'label' => false, 'placeholder'=>'Search By Title','required' => false)); ?>
        </div>
		<div class="transFilt-R">
			<?php echo $this->Form->submit('Search', array('div'=>false, 'label'=>false, 'class'=>'submitBtn'));?>
		</div>
      	<?php echo $this->Form->end(); ?>
	</div>
    <div class="clr">&nbsp;</div>
     <?php if (! empty($event_list)){?>
		<div class="appoiTable2">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<th width="8%" class="pl">Sr.no.</th>
					<th width="7%"> Image </th>
					<th width="11%"><?php echo $this->Paginator->sort("event_title",__("Event Title")); ?></th>
					<th width="10%"><?php echo $this->Paginator->sort("eventype",__("Event Type")); ?></th>
					<th width="10%"><?php echo $this->Paginator->sort("user_name",__("User Name")); ?></th>
					<th width="4%"><?php echo $this->Paginator->sort("status",__("Status")); ?></th>
					<th width="10%"><?php echo $this->Paginator->sort("start_date",__("Start Date")); ?></th>
					<th width="9%"><?php echo $this->Paginator->sort("end_date",__("End Date")); ?></th>
					<th width="10%"><?php echo $this->Paginator->sort("Event Comments",__("Event Comments")); ?></th>
					<th width="9%"><?php echo $this->Paginator->sort("Event Posts",__("Event Posts")); ?></th>
					<th width="15%">Action</th>
				  </tr>
				
				  <?php 
				 // pr($event_list);die;
				  
				  $counter = 0;
				  foreach($event_list as $eventData) { 
				  	if($counter%2 == 0)
						$tableClass = 'p1';
					else
						$tableClass = 'odd';
				  ?>
				  <tr class="<?php echo $tableClass;?>">
				  	
					<td align="center"> <?php echo (($page*$pagesize+$counter)-$pagesize)+1; ?> </td>
                    <td align="left"><?php 
					$eventImg = $this->My->fetchEventImage($eventData['Event']['upload_id']);
					
					if(!empty($eventImg)){
					 
					 		  	echo $this->Html->link($this->Html->image(SITE_PATH.'img/eventbanner/'.$eventImg, array('alt' => 'post', 'border' => '0', 'width' => '40', 'height' => '40')), SITE_PATH.'img/eventbanner/'.$eventImg, array('escape' => false,'target'=>'_blank')
);

					// echo $this->Html->image(SITE_PATH.'img/eventbanner/'.$eventImg, array('alt' => 'post', 'border' => '0', 'width' => '40', 'height' => '40'));
					 } else {
					 echo $this->Html->image(SITE_PATH.'img/no_image_thumb.gif', array('alt' => 'post', 'border' => '0', 'width' => '40', 'height' => '40'));
					 }
					 ?></td>
					 
					<td><?php echo $eventData['Event']['event_title']; ?></td>
					<td><?php if($eventData['Event']['eventype'] == 1 ) { echo "Private"; } else { echo "Public"; } ?></td>
                    <td><?php echo $eventData['User']['username']; ?></td>
					<td><?php if($eventData['Event']['status'] == 1 ) { echo "Active"; } else { echo "Inactive"; } ?></td>
					<td><span><?php echo $eventData['Event']['start_at']; ?></span></td>
					<td><span><?php echo $eventData['Event']['end_at']; ?></span></td>
					<td><?php echo $this->Html->link('Events Comments ('.$this->My->getEventCommentCount($eventData['Event']['id']).')',array('controller'=>'posts','action'=>'post_list',$eventData['Event']['id'],'comment'),array('rel'=> 'Event List','data-placement' => 'left','data-original-title' => 'Edit','class'=> 'event_link','escape'=> false  ));?>
					<td><?php echo $this->Html->link('Events Posts ('.$this->My->getEventPostCount($eventData['Event']['id']).')',array('controller'=>'posts','action'=>'post_list',$eventData['Event']['id'],'any'),array('rel'=> 'Event List','data-placement' => 'left','data-original-title' => 'Edit','class'=> 'event_link','escape'=> false  ));?>
					</td>
					</td>
					<td>
					<?php $id = $eventData['Event']['id']; 
					      $model = 'Event'; 
					?>
					<?php echo  $this->Html->image("admin/view-icon.png", array("alt" => "",'url' => array('controller' => 'manages', 'action' => 'view_event', 'admin' => true, $id)));?>
                     <?php
						if( $eventData['Event']['status'] == 1 ) {
							$accountStatusIcon = "deactivate-icon.png";
							$statusTitle = "Deactivate";
							$link = "admin/users/updateStatus/".$id."/0/".$model;
							
						}else {
							$accountStatusIcon = "activate.png";
							$statusTitle = "Activate";
							$link = "admin/users/updateStatus/".$id."/1/".$model;
							
							}
						?>
						<?php echo  $this->Html->image("admin/edit-icon.png", array("alt" => "",'url' => array('controller' => 'manages', 'action' => 'edit_event', 'admin' => true, $id,$type), 'title'=>'Edit User'));?>
						
					<a id="<?php echo $id; ?>"  href="<?php echo SITE_PATH.$link; ?>" <?php if( $eventData['Event']['status'] == 1 ) { ?>onclick="return confirm('Are you sure want Deactivate this Event?');" <?php } else { ?> onclick="return confirm('Are you sure want Activate this Event?');"<?php } ?> >
						<img src= "<?php echo SITE_PATH ?>img/admin/<?php echo $accountStatusIcon ?>" title="<?php echo $statusTitle ?>" />
					</a>
					<?php echo $this->Form->postLink(
							$this->Html->tag( 'img', '', array( 'src' => SITE_PATH.'img/admin/delete-icon.png')),
								array("controller"=>"manages","action"=>"delete","admin"=>true,$id, $model),
								array("confirm"=>"Do You Really Want to Delete this Event?","escape" => false,'title'=>'Delete')
						);
					?>
					
				  </tr>
				  
				  <?php $counter++; } ?>
			</table>
		</div>
						
		<?php echo $this->Element('admin/pagination'); }  else{ ?>
		<div style="text-align:center; color:#FF0000;">!! No Event found !!</div>
	<?php } ?>

		<div class="clear"></div>
</div>