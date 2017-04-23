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
      <th><?php echo $this->Paginator->sort("job_title",__("Job Title")); ?></th>
      <th><?php echo $this->Paginator->sort("job_description",__("Job Description")); ?></th>
      <th><?php echo $this->Paginator->sort("project_budget",__("Price")); ?></th>
	  <th><?php echo $this->Paginator->sort("category",__("Cetagory")); ?></th>
      <th><?php echo $this->Paginator->sort("typeofproject",__("Project TYpe")); ?></th>
	  <th><?php echo $this->Paginator->sort("Created",__("Job Date")); ?></th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
   <?php if (!empty($job_list)){
	   $counter = 0;
		foreach($job_list as $jobData) { 
			if($counter%2 == 0)
				$tableClass = 'p1';
			else
				$tableClass = 'odd';
	   ?>
    <tr>
      <th scope="row"><?php echo $counter + 1;?></th>
      <td><?php echo $jobData['Job']['job_title']; ?></td>
      <td><?php echo $jobData['Job']['job_description']; ?></td>
      <td><?php if($jobData['Job']['paytype']==2) { echo $jobData['Job']['project_budget']; } else { echo "Hourly";  }  ?></td>
	  <td><?php echo $this->My->getCategoryName($jobData['Job']['category']); ?>>><?php echo $this->My->getSubCategoryName($jobData['Job']['sub_category']); ?></td>
		<td><?php if($jobData['Job']['typeofproject']==1){echo "On Going";} else if($jobData['Job']['typeofproject']==2) {echo "One Time";} else { echo "Not Sure";} ?></td>
	  <td><?php  
		$timestamp=strtotime($jobData['Job']['created']); 
		echo date('Y-m-d h:i:s A', $timestamp);
	  ?></td>
	  <td><?php 
	  $id = $jobData['Job']['id'];
	  $model="Job";
	  if( $jobData['Job']['job_status'] == 1 ) {
							$accountStatusIcon = "deactivate-icon.png";
							$statusTitle = "Deactivate the account";
							$link = "admin/jobs/updateStatus/".$id."/0/".$model;
							
						}else {
							$accountStatusIcon = "activate.png";
							$statusTitle = "Activate The Account";
							$link = "admin/jobs/updateStatus/".$id."/1/".$model;
							
							}
	  echo  $this->Html->image("admin/view-icon.png", array("alt" => "",'url' => array('controller' => 'jobs', 'action' => 'view_job', 'admin' => true, $id), 'title'=>'View Job'));?>
	  <a id="<?php echo $id; ?>"  href="<?php echo SITE_PATH.$link; ?>" <?php if( $jobData['Job']['job_status'] == 1 ) { ?>onclick="return confirm('Are you sure want Deactivate the user account?');" <?php } else { ?> onclick="return confirm('Are you sure want Activate the user account?');"<?php } ?> >
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