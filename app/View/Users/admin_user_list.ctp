<div class="dashmidMain">			
	<div class="dashRight">
		<div class="dashMid">
		 <?php echo $this->Form->create('User',array('action'=>'admin_user_list')); ?>
		<div class="row topHeader">
			<div class="col-sm-3">
			<?php 
			 //$countryArr = $this->My->fetchCategories();
			 //pr($stateArr);die;
			echo $this->Form->input('User.usertype', array('div'=>false, 'label'=>false, 'type'=>'select','class'=>'dashInpfld validate[required]', 'maxlength'=> 50, 'required'=>false, 'options'=> array('1'=>'Freelancer','2'=>'Work','3'=>'Company'), 'empty'=> 'Search By Usertype')); ?>
			</div>
			<div class="col-sm-3"><?php echo $this->Form->text('User.username', array('class' => 'testInp', 'label' => false, 'placeholder'=>'Search By user title','required' => false)); ?></div>
			
			<div class="col-sm-3"><?php  echo $this->Form->submit('Search', array('div'=>false, 'label'=>false, 'class'=>'submitBtn')); ?></div>			
	</div>
	<?php echo $this->Form->end(); ?>
		<table class="table table-inverse">
  <thead>
    <tr>
      <th>#</th>
      <th><?php echo $this->Paginator->sort("Name",__("firstname")); ?></th>
      <th><?php echo $this->Paginator->sort("Username",__("username")); ?></th>
      <th><?php echo $this->Paginator->sort("email",__("Email")); ?></th>
	  <th><?php echo $this->Paginator->sort("User Type",__("usertype")); ?></th>
	  <th><?php echo $this->Paginator->sort("Created",__("User Date")); ?></th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
   <?php if (!empty($user_list)){
	   $counter = 0;
		foreach($user_list as $userData) { 
			if($counter%2 == 0)
				$tableClass = 'p1';
			else
				$tableClass = 'odd';
	   ?>
    <tr>
      <th scope="row"><?php echo $counter + 1;?></th>
      <td><?php echo $userData['User']['firstname']." ".$userData['User']['lastname']; ?></td>
      <td><?php echo $userData['User']['username']; ?></td>
      <td><?php echo $userData['User']['email'];   ?></td>
	  <td><?php if($userData['User']['usertype']==1){echo "Freelancer";} else if($userData['User']['usertype']==2) {echo "work";}else if($userData['User']['usertype']==3) {echo "company";}   ?></td>
	  <td><?php  
		$timestamp=strtotime($userData['User']['created']); 
		echo date('Y-m-d h:i:s A', $timestamp);
	  ?></td>
	  <td><?php 
	  $id = $userData['User']['id'];
	  $model="User";
	  if( $userData['User']['status'] == 1 ) {
							$accountStatusIcon = "deactivate-icon.png";
							$statusTitle = "Deactivate the account";
							$link = "admin/users/updateStatus/".$id."/0/".$model;
							
						}else {
							$accountStatusIcon = "activate.png";
							$statusTitle = "Activate The Account";
							$link = "admin/users/updateStatus/".$id."/1/".$model;
							
							}
	  echo  $this->Html->image("admin/view-icon.png", array("alt" => "",'url' => array('controller' => 'users', 'action' => 'view_user', 'admin' => true, $id), 'title'=>'View User'));?>
	  <a id="<?php echo $id; ?>"  href="<?php echo SITE_PATH.$link; ?>" <?php if( $userData['User']['status'] == 1 ) { ?>onclick="return confirm('Are you sure want Deactivate the user account?');" <?php } else { ?> onclick="return confirm('Are you sure want Activate the user account?');"<?php } ?> >
						<img src= "<?php echo SITE_PATH ?>img/admin/<?php echo $accountStatusIcon ?>" title="<?php echo $statusTitle ?>" />
					</a>
	  </td>
	</tr>
   <?php $counter ++; 
   
   
   } echo $this->Element('admin/pagination');  } else { }
   ?>
   
  </tbody>
</table>
		</div>
	</div>
</div>