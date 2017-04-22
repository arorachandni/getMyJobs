<script type="text/javascript">	
	var jqr = jQuery.noConflict(); 
	jqr(document).ready(function(){
		jqr("#UserAdminEditUserForm").validationEngine();	
	});	
</script>
<style type="text/css">
    input[type=radio] {
       margin:3px;
       width:23px;
    }
</style>
<div class="dashmidMain">			
			<div class="dashRight">
				<div class="dashMid">
				<div class="clr">&nbsp;</div>
	<!-- DISPLAY MESSAGE START -->
	<?php echo $this->Session->flash();?>
	<!-- DISPLAY MESSAGE END -->
	<div class="">Edit User Details</div>
	<?php echo $this->Html->link('Back', 'javascript://', array('onclick'=>' window.history.back();','class' => 'addevent fr')); ?>		
	<?php 
		echo $this->Form->create('User', array('action'=>'admin_edit_girl','type'=> 'file'));
		echo $this->Form->hidden('User.id');
		
	?>

       <div class="dashfrmBx">
	    <div class="dashinp-L">
			<span>User Name:</span>
			<?php echo $this->Form->input('User.user_name', array('div'=>false, 'label'=>false, 'type'=>'text','class'=>'dashInpfld validate[required]', 'maxlength'=>100, 'required'=>false)); ?>
		</div>
		</br>
	 	<div class="dashinp-L">
			<span>First Name:</span>
			
			<?php echo $this->Form->input('User.first_name', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'dashInpfld validate[required]', 'error'=>false, 'required'=>false)); ?>
			</div>
          <br />
		  <div class="dashinp-L">
			<span>Last Name:</span>
			
			<?php echo $this->Form->input('User.last_name', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'dashInpfld validate[required]', 'error'=>false, 'required'=>false)); ?>
			</div>
          <br />
		
		<div class="dashinp-L">
			<span>Birthday:</span>
			<?php $maxYear = date('Y') - 18;
                  $minYear = $maxYear - 60;
                  $day=date('d',strtotime($this->request->data['User']['birth_date']));
                  
                  $this->request->data['User']['day'] = $day;
                  $month=date('m',strtotime($this->request->data['User']['birth_date']));
                  $this->request->data['User']['month'] = $month;
                  $year=date('Y',strtotime($this->request->data['User']['birth_date']));
                  $this->request->data['User']['year'] = $year;


		echo $this->Form->day('User.day', array('div'=>false, 'label'=>false, 'type'=>'select','class'=>'selectDate editprofInp validate[required]', 'error'=>false, 'required'=>false,'empty'=> 'Day','value'=> $day));?>
		<?php echo $this->Form->month('User.month', array('div'=>false, 'label'=>false, 'type'=>'select','class'=>'selectDate editprofInp validate[required]', 'error'=>false, 'required'=>false,'empty'=> 'Month','value'=> $month));?>
		<?php echo $this->Form->Year('User.year',$minYear , $maxYear, array('div'=>false, 'label'=>false, 'type'=>'select','class'=>'selectDate editprofInp validate[required]', 'error'=>false, 'required'=>false,'empty'=> 'Year','value'=> $year));?>
		</div>
            <br/>

		
		<div class="dashinp-L">
			<span>Email:</span>
			<?php echo $this->Form->input('User.email', array('div'=>false, 'label'=>false, 'type'=>'text','class'=>'dashInpfld validate[required]', 'maxlength'=>100, 'required'=>false)); ?>
		</div>
		</br />
		  <div class="dashinp-L">
		<span>State :</span>
			<?php 
			 $stateArr = $this->My->fetchStates();
			 //pr($stateArr);die;
			echo $this->Form->input('User.state', array('div'=>false, 'label'=>false, 'type'=>'select','class'=>'dashInpfld validate[required]', 'maxlength'=> 50, 'required'=>false, 'options'=> $stateArr, 'empty'=> 'Select State')); ?>
		</div>
		<br/>
		 <div class="dashinp-L">
		<span>City :</span>
			<?php 
			$cityArr = $this->My->fetchCities();
			echo $this->Form->input('User.city', array('div'=>false, 'label'=>false, 'type'=>'select','class'=>'dashInpfld validate[required]', 'maxlength'=>50, 'required'=>false, 'options'=> $cityArr, 'empty'=> 'Select City')); ?>
		</div>
		<br/>
		<div class="dashinp-L">
		<span>Zip code :</span>
			<?php echo $this->Form->input('User.zip_code', array('div'=>false, 'label'=>false, 'type'=>'text','class'=>'dashInpfld validate[required]', 'maxlength'=>50, 'required'=>false)); ?>
		</div>
		<br/>
		<div class="dashinp-L">
		<span>Image :</span>
			<?php echo $this->Form->input('User.image', array('div'=>false, 'label'=>false, 'type'=>'file','class'=>'fileupload', 'required'=>false)); ?> 
	    <div class="clr"></div>		
		<div class="dvPreview"></div>
		</div>
		<br/>
		<div class="norbtnmain">
			<?php echo $this->Form->submit('Save', array('div'=>false, 'label'=>false, 'class'=>'submitBtn'));?>
		</div>
		<div class="clr"></div>
	</div>
		<div class="clr"></div>
	<?php echo $this->Form->end();?>
	</div>
</div>
</div>
</div>