<script type="text/javascript">	
	var jqr = jQuery.noConflict(); 
	jqr(document).ready(function(){
		jqr("#FeatureAdminAddFeatureForm").validationEngine()	
	
	});	
</script>

<div class="dashmidMain">			
	<div class="dashRight">
		<div class="dashMid">
			<div class="clr">&nbsp;</div>
	<?php echo $this->Session->flash();?>

	<div class="">Add Feature</div>			
	<?php echo $this->Form->create('Feature');?>	
		
	<div class="dashfrmBx">
			<div class="dashinp-L">
			<span>Name:</span>
			
			<?php echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'dashInpfld validate[required]', 'error'=>false, 'required'=>false)); ?>
			</div>
          </br>
		   
		<div class="norbtnmain">
			<?php echo $this->Form->submit('Save', array('div'=>false, 'label'=>false, 'class'=>'submitBtn'));?>
		</div>
		<div class="clr"></div>
	</div>
		<?php echo $this->Form->end();?>
	</div>
	</div>
	
	<div class="clearfix"></div>	
</div>
