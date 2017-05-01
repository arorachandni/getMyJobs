<div class="dashmidMain">			
	<div class="dashRight">
		<div class="dashMid">
		 <?php echo $this->Form->create('User',array('action'=>'admin_user_list')); ?>
		<div class="row topHeader">
			<div class="col-sm-4">
			<?php 
			 $countryArr = $this->My->fetchCategories();
			 //pr($stateArr);die;
			echo $this->Form->input('Category.id', array('div'=>false, 'label'=>false, 'type'=>'select','class'=>'dashInpfld validate[required]', 'maxlength'=> 50, 'required'=>false, 'options'=> $countryArr, 'empty'=> 'Search By Category')); ?>
			</div>
			<div class="col-sm-4"><?php echo $this->Form->text('Job.job_title', array('class' => 'testInp', 'label' => false, 'placeholder'=>'Search By job title','required' => false)); ?></div>
			<div class="col-sm-4"><?php  echo $this->Form->submit('Search', array('div'=>false, 'label'=>false, 'class'=>'submitBtn')); ?></div>			
	</div>
	<?php echo $this->Form->end(); ?>
		<table class="table table-inverse">
  <thead>
    <tr>
      <th>#</th>
      <th><?php echo $this->Paginator->sort("proposal",__("Proposal Description")); ?></th>
      <th><?php echo $this->Paginator->sort("project_budget",__("Price")); ?></th>
	  <th><?php echo $this->Paginator->sort("answer",__("Answers")); ?></th>
	  <th><?php echo $this->Paginator->sort("Created",__("Job Date")); ?></th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
   <?php  if (!empty($praposal_list)){
	   $counter = 0;
		foreach($praposal_list as $pData) { 
			if($counter%2 == 0)
				$tableClass = 'p1';
			else
				$tableClass = 'odd';
	   ?>
    <tr>
      <th scope="row"><?php echo $counter + 1;?></th>
      <td><?php echo substr($pData['Proposal']['proposal'],0,100);//$pData['Proposal']['proposal']; ?></td>
	  <td><?php echo $pData['Proposal']['price']; ?></td>
      <td><?php echo $pData['Proposal']['answers']; ?></td>
      <td><?php  
		$timestamp=strtotime($pData['Proposal']['created']); 
		echo date('Y-m-d h:i:s A', $timestamp);
	  ?></td>
	  <td><?php 
	  $id = $pData['Proposal']['id'];
	  $model="Proposal";
	  if( $pData['Proposal']['p_status'] == 1 ) {
							$accountStatusIcon = "deactivate-icon.png";
							$statusTitle = "Deactivate the account";
							$link = "admin/jobs/updateStatus/".$id."/0/".$model;
							
						}else {
							$accountStatusIcon = "activate.png";
							$statusTitle = "Activate The Account";
							$link = "admin/jobs/updateStatus/".$id."/1/".$model;
							
							}
	  echo  $this->Html->image("admin/view-icon.png", array("alt" => "",'url' => array('controller' => 'jobs', 'action' => 'view_proposal', 'admin' => true, $id), 'title'=>'View Proposal'));?>
	  <a id="<?php echo $id; ?>"  href="<?php echo SITE_PATH.$link; ?>" <?php if( $pData['Proposal']['p_status'] == 1 ) { ?>onclick="return confirm('Are you sure want Deactivate the user account?');" <?php } else { ?> onclick="return confirm('Are you sure want Activate the user account?');"<?php } ?> >
						<img src= "<?php echo SITE_PATH ?>img/admin/<?php echo $accountStatusIcon ?>" title="<?php echo $statusTitle ?>" />
					</a>
	  </td>
	</tr>
   <?php $counter ++; 
   
   
   } echo $this->Element('admin/pagination');  } ?>
    
    
  </tbody>
</table>
		</div>
	</div>
</div>