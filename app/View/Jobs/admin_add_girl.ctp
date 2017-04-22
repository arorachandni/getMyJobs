<script type="text/javascript">	
	var jqr = jQuery.noConflict(); 
	jqr(document).ready(function(){
		jqr("#UserAdminAddGirlForm").validationEngine()	
	
	});	
</script>

<div class="dashmidMain">			
			<div class="dashRight">
				<div class="dashMid">
					<div class="clr">&nbsp;</div>
			<?php echo $this->Session->flash();?>
<div class="">Add Girl</div>			
	<?php echo $this->Form->create('',array('type'=>'file'));?>	
		
	<div class="dashfrmBx">
			<div class="dashinp-L">
			<span>User Name:</span>
			<?php echo $this->Form->input('User.user_name', array('div'=>false, 'label'=>false, 'type'=>'text','class'=>'dashInpfld validate[required]', 'maxlength'=>100, 'required'=>false)); ?>
		</div>
		</br>
		   <div class="dashinp-L">
			<span>First Name:</span>
			<?php echo $this->Form->input('User.first_name', array('div'=>false, 'label'=>false, 'type'=>'text','class'=>'dashInpfld validate[required]', 'maxlength'=>100, 'required'=>false)); ?>
		</div>
		</br>
		  <div class="dashinp-L">
			<span>Last Name:</span>
			<?php echo $this->Form->input('User.last_name', array('div'=>false, 'label'=>false, 'type'=>'text','class'=>'dashInpfld validate[required]', 'maxlength'=>100, 'required'=>false)); ?>
		</div>
		</br>

		<div class="dashinp-L">
			<span>Birthday:</span>
			<?php $maxYear = date('Y') - 18;
                  $minYear = $maxYear - 60;?>
		<?php echo $this->Form->day('User.day', array('div'=>false, 'label'=>false, 'type'=>'select','class'=>'selectDate editprofInp validate[required]', 'error'=>false, 'required'=>false,'empty'=> 'Day'));?>
		<?php echo $this->Form->month('User.month', array('div'=>false, 'label'=>false, 'type'=>'select','class'=>'selectDate editprofInp validate[required]', 'error'=>false, 'required'=>false,'empty'=> 'Month'));?>
		<?php echo $this->Form->Year('User.year',$minYear , $maxYear, array('div'=>false, 'label'=>false, 'type'=>'select','class'=>'selectDate editprofInp validate[required]', 'error'=>false, 'required'=>false,'empty'=> 'Year'));?>
		</div>
            <br/>

		<div class="dashinp-L">
		<span>Email :</span>
			<?php echo $this->Form->input('User.email', array('div'=>false, 'label'=>false, 'type'=>'text','class'=>'dashInpfld validate[required,custom[email]]', 'maxlength'=>50, 'required'=>false)); ?>
		</div>
		 </br>
		 
		<div class="dashinp-L">
		<span>Password :</span>
			<?php echo $this->Form->input('User.password', array('div'=>false, 'label'=>false,'type'=>'password', 'class'=>'dashInpfld validate[required, minSize[8]]', 'maxlength'=>50, 'required'=>false)); ?>
		</div>
		</br>
		<div class="dashinp-L">
		<span>Confirm Password :</span>
			<?php echo $this->Form->input('User.confirm_password', array('div'=>false, 'label'=>false,'type'=>'password', 'class'=>'dashInpfld validate[required,equals[UserPassword], minSize[8]]', 'maxlength'=>50, 'required'=>false)); ?>
		</div>
		 </br>
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
        <br/>
		<div class="dashinp-L">
		<span>Image :</span>
			<?php echo $this->Form->input('User.image', array('div'=>false, 'label'=>false, 'type'=>'file','class'=>'validate[required] fileupload', 'required'=>false)); ?> 
	    <div class="clr"></div>		
		<div class="dvPreview"></div>
		</div>  
		<div class="norbtnmain">
			<?php echo $this->Form->submit('Save', array('div'=>false, 'label'=>false, 'class'=>'submitBtn'));?>
		</div>
		<div class="clr"></div>
	</div>
				</div>
			</div>
			<?php echo $this->Form->end();?>
			<div class="clearfix"></div>
		
	</div>
<style>
.submitBtn  {
    background: #1597a6 none repeat scroll 0 0;
    color: #ffffff;
    display: inline-block;
    font-family: "Ubuntu-bold";
    font-size: 14px;
    padding: 10px 20px;
    text-transform: uppercase;
    transition: all 0.4s ease 0s;
}

</style>	