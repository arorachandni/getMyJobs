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
		echo $this->Form->create('User', array('action'=>'admin_edit_user','type'=> 'file'));
		echo $this->Form->hidden('User.id');
		
	?>

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
		<span>Country :</span>
			<?php 
			 $countryArr = $this->My->fetchCountriesforuser();
			 
			 ?>
			  <select class="dashInpfld validate[required]" name="data[User][iso]">
			 
			 <?php 
			 if(isset($code)) { ?>
			 	<option value="<?php echo $code; ?>"><?php echo $cvalue; ?></option>
			<?php }
			 ?>
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
		<!--<div class="dashinp-L">
		<span>Address :</span>
			<?php echo $this->Form->input('User.address', array('div'=>false, 'label'=>false, 'type'=>'textarea','class'=>'dashInpfld validate[required]', 'maxlength'=>50, 'required'=>false)); ?>
		</div>
		<br/> -->
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
			echo $this->Form->input('Upload.id',array('div'=>false,'type'=>'hidden','value'=>$userdata['Upload']['id']));
			echo $this->Form->input('url',array('div'=>false,'type'=>'hidden','value'=>$userdata['Upload']['url']));
			echo $this->Form->input('Upload.url', array('div'=>false, 'label'=>false, 'type'=>'file','class'=>'fileupload', 'required'=>false)); ?> 
	    <div class="clr"></div>		
		<div class="dvPreview"><?php  
		if(!empty($userdata['Upload']['url'])!='' || $userdata['Upload']['url'] !=null)  {
		   echo $this->Html->image(SITE_PATH.'img/userImg/'.$userdata['Upload']['url'], array('alt' => 'UserProfile', 'border' => '0', 'width' => '100', 'height' => '100')); 
		   }
		   else {
		   echo $this->Html->image(SITE_PATH.'img/noimage.ico', array('alt' => 'post', 'border' => '0', 'width' => '100', 'height' => '100'));
		   }
		 
		 ?></div>
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