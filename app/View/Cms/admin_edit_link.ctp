<script type="text/javascript">	
	var jqr = jQuery.noConflict(); 
	jqr(document).ready(function(){
		jqr("#SocialLinkAdminEditLinkForm").validationEngine();	
	});	
</script>

<div class="dashmidMain">			
	<div class="dashRight">
		<div class="dashMid">
		<div class="clr">&nbsp;</div>

		<div class="">Edit Social Link</div>
		<?= $this->Html->link('Back', 'javascript://', array('onclick'=>' window.history.back();','class' => 'addevent fr')); ?>		
		<?php 
			echo $this->Form->create('SocialLink');
			echo $this->Form->hidden('SocialLink.id');
		?>

	       <div class="dashfrmBx">	    
		 	<div class="dashinp-L">
				<span>Link Name:</span>
				
				<?= $this->Form->input('name', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'dashInpfld validate[required]', 'error'=>false, 'required'=>false)); ?>
			</div>
	        </br>
	        <div class="dashinp-L">
				<span>Link Url:</span>
				
				<?= $this->Form->input('link', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'dashInpfld validate[required, custom[url]]', 'error'=>false, 'required'=>false)); ?>
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
