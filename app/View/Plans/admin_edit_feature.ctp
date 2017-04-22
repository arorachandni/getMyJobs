<script type="text/javascript">	
	var jqr = jQuery.noConflict(); 
	jqr(document).ready(function(){
		jqr("#MinutesPlanAdminEditPlanForm").validationEngine();	
	});	
</script>

<div class="dashmidMain">			
	<div class="dashRight">
		<div class="dashMid">
		<div class="clr">&nbsp;</div>
		<!-- DISPLAY MESSAGE START -->
		<?php echo $this->Session->flash();?>
		<!-- DISPLAY MESSAGE END -->
		<div class="">Edit Upgraded Feature</div>
		<?php echo $this->Html->link('Back', 'javascript://', array('onclick'=>' window.history.back();','class' => 'addevent fr')); ?>		
		<?php 
			echo $this->Form->create('Feature');
			echo $this->Form->hidden('Feature.id');
		?>

	       <div class="dashfrmBx">	    
		 	<div class="dashinp-L">
				<span> Name:</span>
				
				<?php echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'dashInpfld validate[required]', 'error'=>false, 'required'=>false)); ?>
			</div>
	        </br>
			 <div class="norbtnmain">
				<?php echo $this->Form->submit('Update', array('div'=>false, 'label'=>false, 'class'=>'submitBtn'));?>
			</div>
			<div class="clr"></div>
		</div>
			<div class="clr"></div>
		<?php echo $this->Form->end();?>
		</div>
	</div>
	</div>
</div>
