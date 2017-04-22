<script type="text/javascript">	
	var jqr = jQuery.noConflict(); 
	jqr(document).ready(function(){
		jqr("#UserAdminEditUserForm").validationEngine();	
	});	
</script>

<div class="dashmidMain">			
			<div class="dashRight">
				<div class="dashMid">
				<div class="clr">&nbsp;</div>
	<!-- DISPLAY MESSAGE START -->
	<?= $this->Session->flash();?>
	<!-- DISPLAY MESSAGE END -->
	<div class="">Edit Email Template Details</div>
	<?= $this->Html->link('Back', 'javascript://', array('onclick'=>' window.history.back();','class' => 'addevent fr')); ?>		
	<?php 
		echo $this->Form->create('Mail');
		echo $this->Form->hidden('Mail.id');
	?>

       <div class="dashfrmBx">
	    
	 	<div class="dashinp-L">
			<span>Email Template Title:</span>
			
			<?= $this->Form->input('Mail.mail_title', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'dashInpfld validate[required]', 'error'=>false, 'required'=>false)); ?>
			</div>
          </br>

		   <div class="dashinp-L">
			<span>Variable: {Do Not Change}</span>
			<?= $this->Form->input('Mail.var', array('div'=>false, 'label'=>false, 'type'=>'text','class'=>'dashInpfld validate[required]', 'maxlength'=>50, 'required'=>false,'disabled' => true)); ?>
			</div>

		</br>
		<div class="dashinp-L-fck">
			<span>Description:</span>
			
			<?= $this->Fck->fckeditor(array('Mail', 'description'), $this->Html->base, $this->request->data['Mail']['description'], '70%', '450');?>

			</div>

		</br>
		 		<div class="norbtnmain">
			<?= $this->Form->submit('Update', array('div'=>false, 'label'=>false, 'class'=>'submitBtn'));?>
		</div>
		<div class="clr"></div>
	</div>
		<div class="clr"></div>
	<?= $this->Form->end();?>
	</div>
</div>
</div>
</div>