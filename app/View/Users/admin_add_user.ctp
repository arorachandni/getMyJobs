<script type="text/javascript">	
	var jqr = jQuery.noConflict(); 
	jqr(document).ready(function(){
		jqr("#UserAdminAddUserForm").validationEngine()	
	
	});	
</script>

<div class="dashmidMain">			
			<div class="dashRight">
				<div class="dashMid">
					<div class="clr">&nbsp;</div>
			<?php echo $this->Session->flash();?>
<div class="">Add User</div>			
	<?php echo $this->Form->create('',array('type'=>'file'));?>	
		
	<div class="dashfrmBx">
	    <div class="dashinp-L">
			<span>User Name:</span>
			<?php echo $this->Form->input('User.username', array('div'=>false, 'label'=>false, 'type'=>'text','class'=>'dashInpfld validate[required]', 'maxlength'=>100, 'required'=>false)); ?>
		</div>
		</br>
	 	<div class="dashinp-L">
			<span>Full Name:</span>
			
			<?php echo $this->Form->input('User.fullname', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'dashInpfld validate[required]', 'error'=>false, 'required'=>false)); ?>
			</div>
          <br />
		<div class="dashinp-L">
			<span>Email:</span>
			<?php echo $this->Form->input('User.email', array('div'=>false, 'label'=>false, 'type'=>'text','class'=>'dashInpfld validate[required]', 'maxlength'=>100, 'required'=>false)); ?>
		</div>
		</br />
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
		<span>Country :</span>
			<?php 
			 $countryArr = $this->My->fetchCountriesforuser();
		//	 pr($countryArr);die;
			 ?>
			  <select class="dashInpfld validate[required]" name="data[User][iso]">
			 <option>Select Country</option>
			 <?php foreach($countryArr as $carr) { ?>
			 	<option value="<?php echo $carr['Country']['iso'].'_'.$carr['Country']['phonecode']; ?>"><?php echo $carr['Country']['name']; ?></option>
			 <?php } ?>
			 </select>
		</div>
		<br/>
		<div class="dashinp-L">
		<span>Mobile :</span>
			<?php echo $this->Form->input('User.mobile', array('div'=>false, 'label'=>false, 'type'=>'text','class'=>'dashInpfld validate[required]', 'maxlength'=>50, 'required'=>false)); ?>
		</div>
		<br/>
		<!-- <div class="dashinp-L">
		<span>Address :</span>
			<?php echo $this->Form->input('User.address', array('div'=>false, 'label'=>false, 'type'=>'textarea','class'=>'dashInpfld validate[required]', 'maxlength'=>50, 'required'=>false)); ?>
		</div> -->
		<br/>
		<div class="dashinp-L">
		
			<?php 
			$options = array(
    		'1' => 'Male',
    		'0' => 'Female'
			);

			$attributes = array();
			echo $this->Form->radio('User.gender', $options, $attributes); ?>
		</div>
		<br/>
		<div class="dashinp-L">
		<span>Image :</span>
			<?php 
		
			echo $this->Form->input('Upload.url', array('div'=>false, 'label'=>false, 'type'=>'file','class'=>'fileupload', 'required'=>false)); ?> 
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