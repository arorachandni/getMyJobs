<div class="dashmidMain">			
	<div class="dashRight">
		<div class="dashMid">
					<div class="clr">&nbsp;</div>
			<?php echo $this->Session->flash();?>
	<h3>Girls Details (Total Girls : <?php echo $total_user;?>)</h3>
	<br />
	<div class="transFilt">
	<?php echo $this->Form->create('User',array('action'=>'admin_girls_list')); ?>
       	<div class="transFilt-L" >
          
            <?php echo $this->Form->text('User.user_name', array('class' => 'testInp', 'label' => false, 'placeholder'=>'Search By User Name','required' => false)); ?>
        </div>
		<div class="transFilt-L" >
            <?php echo $this->Form->text('User.city', array('class' => 'testInp', 'label' => false, 'placeholder'=>'Search By city','required' => false)); ?>
        </div> <div class="clr">&nbsp;</div>
		<div class="transFilt-L" >
            <?php echo $this->Form->text('User.state', array('class' => 'testInp', 'label' => false, 'placeholder'=>'Search By state','required' => false)); ?>
        </div>
		<div class="transFilt-L" >
            <?php echo $this->Form->text('User.zip_code', array('class' => 'testInp', 'label' => false, 'placeholder'=>'Search By zip code','required' => false)); ?>
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
					<th width="5%" class="pl">Sr.no.</th>
					<th width="8%"><?php echo __("Image"); ?></th>
					<th width="10%"><?php echo $this->Paginator->sort("user_name",__("User Name")); ?></th>
					
					<th width="15%"><?php echo $this->Paginator->sort("email",__("Email")); ?></th>
					<th width="7%"><?php echo $this->Paginator->sort("state",__("State")); ?></th>
					<th width="13%"><?php echo $this->Paginator->sort("city",__("City")); ?></th>
					<th width="10%"><?php echo $this->Paginator->sort("zip_code",__("Zip Code")); ?></th>
					
					<th width="10%"><?php echo $this->Paginator->sort("status",__("Status")); ?></th>

					<th width="10%"><?php echo $this->Paginator->sort("created",__("Date")); ?></th>
					<th width="25%">Action</th>
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
                    <td><?php echo $this->Image->resize('userImg/'.$userData['User']['user_image'], 50,50, array('alt'=> '')); ?></td>
					<td><?php echo $userData['User']['user_name']; ?></td>

					<td><?php echo $userData['User']['email']; ?></td>
					<td><?php echo $userData['State']['state_name']; ?></td>
					<td><?php echo $userData['City']['city_name']; ?></td>
					<td><?php echo $userData['User']['zip_code']; ?></td>

					<td><?php if($userData['User']['status'] == 1 ) { echo "Active"; } else { echo "Inactive"; } ?></td>

					

					<td><span><?php echo date('M d, Y' , strtotime($userData['User']['created'])); ?></span></td>
					<td>

					<?php $id = $userData['User']['id']; 
					      $model = 'User';  
					?>
					<?php echo  $this->Html->image("admin/view-icon.png", array("alt" => "",'url' => array('controller' => 'users', 'action' => 'view_user', 'admin' => true, $id), 'title'=>'View User'));?>

					<?php echo  $this->Html->image("admin/edit-icon.png", array("alt" => "",'url' => array('controller' => 'users', 'action' => 'edit_girl', 'admin' => true, $id), 'title'=>'Edit Girl'));?>
					
					<?php echo  $this->Html->image("admin/password-icon.png", array("alt" => "",'url' => array('controller' => 'users', 'action' => 'password_reset', 'admin' => true, $id), 'title'=> "Reset Girl's Password"));?>

	
					<?php
						if( $userData['User']['status'] == 1 ) {
							$accountStatusIcon = "deactivate-icon.png";
							$statusTitle = "Deactivate the account";
							$link = "admin/users/updateStatus/".$id."/0/".$model;
							
						}else {
							$accountStatusIcon = "activate.png";
							$statusTitle = "Activate The Account";
							$link = "admin/users/updateStatus/".$id."/1/".$model;
							
							}
						?>
					<a id="<?php echo $id; ?>"  href="<?php echo SITE_PATH.$link; ?>" <?php if( $userData['User']['status'] == 1 ) { ?>onclick="return confirm('Are you sure want Deactivate the girl account?');" <?php } else { ?> onclick="return confirm('Are you sure want Activate the user account?');"<?php } ?> >
						<img src= "<?php echo SITE_PATH ?>img/admin/<?php echo $accountStatusIcon ?>" title="<?php echo $statusTitle ?>" />
					</a>

				
					<?php echo $this->Form->postLink(
							$this->Html->tag( 'img', '', array( 'src' => SITE_PATH.'img/admin/delete-icon.png')),
								array("controller"=>"users","action"=>"delete","admin"=>true, $id,  $model),
								array("confirm"=>"Do You Really Want to Delete this Girl?","escape" => false, 'title'=>'Delete')
						);
					?>
				  </tr>
				  
				  <?php $counter++; } ?>
			</table>
		</div>
						
		<?php echo $this->Element('admin/pagination'); }  else{ ?>
		<div style="text-align:center; color:#FF0000;">!! No Girl found !!</div>
	<?php } ?>
		
		
		<div class="clear"></div>

</div>
