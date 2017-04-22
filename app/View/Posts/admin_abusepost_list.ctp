<div class="dashmidMain">			
	<div class="dashRight">
		<div class="dashMid">
					<div class="clr">&nbsp;</div>
			<?php echo $this->Session->flash();?>
	<h3>Event Posts (Total Post : <?php echo $total_post;?>)</h3>
	<br />
	<div class="transFilt">
	<?php echo $this->Form->create('posts', array('action'=>'admin_abusepost_list')); ?>
       	<div class="transFilt-L" >
          	
            <?php 
            
            echo $this->Form->text('Post.data', array('class' => 'testInp', 'label' => false, 'placeholder'=>'Search By Username','required' => false)); ?>
        </div>
		
		<div class="transFilt-R">
			<?php echo $this->Form->submit('Search', array('div'=>false, 'label'=>false, 'class'=>'submitBtn'));?>
		</div>
        <?php echo $this->Form->end(); ?>
		
		</div>
    <div class="clr">&nbsp;</div>
     
	  <?php  if (!empty($post_list)){?>
		<div class="appoiTable2">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<th width="8%" class="pl">Sr.no.</th>
					
					<th width="20%"><?php echo $this->Paginator->sort("Postdata",__("Postdata")); ?></th>
					<th width="20%"><?php echo $this->Paginator->sort("Report Count",__("Report Count")); ?></th>
					
					
					<!-- <th width="10%"><?php echo $this->Paginator->sort("username",__("User Name")); ?></th> -->
					
					<th width="9%"><?php echo $this->Paginator->sort("status",__("Status")); ?></th>

					<th width="10%"><?php echo $this->Paginator->sort("Date",__("Date")); ?></th>
						
					<th width="15%">Action</th>
				  </tr>
				
				  <?php 
				  //pr($hunt_list);die;
				  $counter = 0;
				  foreach($post_list as $postData) { 
				  	if($counter%2 == 0)
						$tableClass = 'p1';
					else
						$tableClass = 'odd';
				  ?>
				  <tr class="<?php echo $tableClass;?>">
				  	<td align="center"> <?php echo $counter+1; ?></td>
                    <td><?php 
                    if($postData['Post']['type']=='image') {
                    	echo $this->Html->link($this->Html->image(SITE_PATH.'img/postImage/'.$postData['Post']['data'], array('alt' => 'post', 'border' => '0', 'width' => '60', 'height' => '60')), SITE_PATH.'img/postImage/'.$postData['Post']['data'], array('escape' => false,'target' =>'_blank'));

                    } else if($postData['Post']['type']=='video') {
                    echo $this->Html->link($this->Html->image(SITE_PATH.'img/videoThumb/'.$postData['Post']['thumburl'], array('alt' => 'post', 'border' => '0', 'width' => '60', 'height' => '60')), SITE_PATH.'img/postVideo/'.$postData['Post']['data'], array('escape' => false,'target' =>'_blank'));
                    	
                    	 echo $this->Html->link($this->Html->image(SITE_PATH.'img/video-icon.png', array('alt' => 'post', 'border' => '0', 'width' => '30', 'height' => '30' , 'class'=>'picon')), SITE_PATH.'img/postVideo/'.$postData['Post']['data'], array('escape' => false,'target' =>'_blank'));
                    
                    	//echo $this->Html->image(SITE_PATH.'img/video.jpeg', array('alt' => 'post', 'border' => '0', 'width' => '50', 'height' => '50'));
                    	
                    	                    	
                    } else {
                    	echo $postData['Post']['data']; 
                    }
                     ?></td>
                    <td><?php echo $this->My->checkAbusePostCount($postData['Post']['id'])?></td>
                     <!-- <td><?php 
                    $user_info=$this->My->userInfo($postData['Post']['user_id']);
                    echo $user_info['User']['username']; ?></td> -->
					<td><?php if($postData['Post']['status'] == 1 ) { echo "Active"; } else { echo "Inactive"; } ?></td>

					<td><span><?php echo date('M d, Y' , strtotime($postData['Post']['created'])); ?></span></td>
					<td>
					<?php $id = $postData['Post']['id']; 
					      $model = 'Post'; 
					?>
					<?php echo  $this->Html->image("admin/view-icon.png", array("alt" => "",'url' => array('controller' => 'posts', 'action' => 'view_abusepost', 'admin' => true, $id,$postData['Post']['user_id'],$postData['Post']['event_id'])));?>
                     <?php
						if( $postData['Post']['status'] == 1 ) {
							$accountStatusIcon = "deactivate-icon.png";
							$statusTitle = "Deactivate";
							$link = "admin/users/updateStatus/".$id."/0/".$model;
							
						}else {
							$accountStatusIcon = "activate.png";
							$statusTitle = "Activate";
							$link = "admin/users/updateStatus/".$id."/1/".$model;
							
							}
						?>
						<?php echo  $this->Html->image("admin/edit-icon.png", array("alt" => "",'url' => array('controller' => 'posts', 'action' => 'edit_post', 'admin' => true, $id,$postData['Post']['event_id']), 'title'=>'Edit User'));?>
					<a id="<?php echo $id; ?>"  href="<?php echo SITE_PATH.$link; ?>" <?php if( $postData['Post']['status'] == 1 ) { ?>onclick="return confirm('Are you sure want Deactivate this Event?');" <?php } else { ?> onclick="return confirm('Are you sure want Activate this Event?');"<?php } ?> >
						<img src= "<?php echo SITE_PATH ?>img/admin/<?php echo $accountStatusIcon ?>" title="<?php echo $statusTitle ?>" />
					</a>
					<?php echo $this->Form->postLink(
							$this->Html->tag( 'img', '', array( 'src' => SITE_PATH.'img/admin/delete-icon.png')),
								array("controller"=>"posts","action"=>"delete","admin"=>true,$id, $model),
								array("confirm"=>"Do You Really Want to Delete this Event?","escape" => false,'title'=>'Delete')
						);
					?>
					
				  </tr>
				  
				  <?php $counter++; } ?>
			</table>
		</div>
						
		<?php echo $this->Element('admin/pagination'); }  else{ ?>
		<div style="text-align:center; color:#FF0000;">!! No Posts found !!</div>
	<?php } ?>

		<div class="clear"></div>
</div>