<div class="dashmidMain">			
	<div class="dashRight">
		<div class="dashMid">
					<div class="clr">&nbsp;</div>
			<?php echo $this->Session->flash();?>
	<h3>Comment Replies (Total Comment : <?php echo $total_reply;?>)</h3>
	<br />
	<div class="transFilt">
	<?php echo $this->Form->create('Post', array('action'=>'post_comment_reply_list/'.$comment_id)); ?>
       	<div class="transFilt-L" >
          	<?php 
            
            echo $this->Form->text('username', array('class' => 'testInp', 'label' => false, 'placeholder'=>'Search By Username','required' => false)); ?>
        </div>
		
		<div class="transFilt-R">
			<?php echo $this->Form->submit('Search', array('div'=>false, 'label'=>false, 'class'=>'submitBtn'));?>
		</div>
        <?php echo $this->Form->end(); ?>
	</div>
    <div class="clr">&nbsp;</div>
     
	  <?php   if (!empty($reply_list)){?>
		<div class="appoiTable2">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<th width="8%" class="pl">Sr.no.</th>
					
					<th width="20%"><?php echo $this->Paginator->sort("Reply",__("Reply")); ?></th>
					
					<th width="10%"><?php echo $this->Paginator->sort("username",__("User Name")); ?></th>
					
					<th width="10%"><?php echo $this->Paginator->sort("Date",__("Date")); ?></th>
						
					<th width="15%">Action</th>
				  </tr>
				
				  <?php 
				  //pr($hunt_list);die;
				  $counter = 0;
				  foreach($reply_list as $CommentData) { 
				  	if($counter%2 == 0)
						$tableClass = 'p1';
					else
						$tableClass = 'odd';
				  ?>
				  <tr class="<?php echo $tableClass;?>">
				  	<td align="center"> <?php echo (($page*$pagesize+$counter)-$pagesize)+1; ?></td>
                    <td><?php echo $CommentData['Reply']['comment']; ?></td>
                    <td><?php 
                    $user_info=$this->My->userInfo($CommentData['Reply']['user_id']);
                    echo $user_info['User']['username']; ?></td>
					

					<td><span><?php echo date('M d, Y' , strtotime($CommentData['Reply']['date'])); ?></span></td>
					<td>
					<?php $id = $CommentData['Reply']['id']; 
					      $model = 'Reply'; 
					?>
					
					
					<?php echo $this->Form->postLink(
							$this->Html->tag( 'img', '', array( 'src' => SITE_PATH.'img/admin/delete-icon.png')),
								array("controller"=>"posts","action"=>"delete_post_comment_reply/".$id.'/'.$comment_id,"admin"=>true),
								array("confirm"=>"Do You Really Want to Delete this reply?","escape" => false,'title'=>'Delete')
						);
					?>
					</td>
					
				  </tr>
				  
				  <?php $counter++; } ?>
			</table>
		</div>
						
		<?php echo $this->Element('admin/pagination'); }  else{ ?>
		<div style="text-align:center; color:#FF0000;">!! No Comments found !!</div>
	<?php } ?>

		<div class="clear"></div>
</div>