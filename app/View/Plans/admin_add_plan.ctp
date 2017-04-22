<script type="text/javascript">	
	var jqr = jQuery.noConflict(); 
	jqr(document).ready(function(){
		jqr("#MinutesPlanAdminAddPlanForm").validationEngine();	
	});	
</script>

<div class="dashmidMain">			
	<div class="dashRight">
		<div class="dashMid">
		<div class="clr">&nbsp;</div>
		
		<?php echo $this->Session->flash();?>
	
		<div class="">Add Plan</div>
		<?php echo $this->Html->link('Back', 'javascript://', array('onclick'=>'window.history.back();','class' => 'addevent fr')); ?>		
		<?php 
			echo $this->Form->create('MinutesPlan');
			echo $this->Form->hidden('MinutesPlan.id');
		?>

	       <div class="dashfrmBx">
		    
		 	<div class="dashinp-L">
				<span>Title:</span>
				
				<?php echo $this->Form->input('title', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'dashInpfld validate[required]', 'error'=>false, 'required'=>false)); ?>
			</div>
	        </br>
	        
			<div class="dashinp-L">
				<span>Minutes:</span>
				<?php echo $this->Form->input('minutes', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'dashInpfld validate[required]', 'error'=>false, 'required'=>false)); ?>
			</div>
	        </br>
	        <div class="dashinp-L">
				<span>Price:</span>
				<?php echo $this->Form->input('price', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'dashInpfld validate[required]', 'error'=>false, 'required'=>false,'onkeyup' => "this.value=this.value.replace(/[^0-9\.]/g,'');")); ?>
			</div>
	        </br>
	        <div class="dashinp-L">
				<span>Features:</span>
				<?php echo $this->Form->input('feature', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'dashInpfld validate[required]', 'error'=>false, 'required'=>false,'maxlength'=>50)); ?>
			</div>
	        </br>
	        <div class="dashinp-L">
				<span>Description:</span>
				
				<?php echo $this->Form->input('description', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'dashInpfld validate[required]', 'error'=>false, 'required'=>false)); ?>
			</div>
	        </br>
			 <div class="norbtnmain">
				<?php echo $this->Form->submit('Add', array('div'=>false, 'label'=>false, 'class'=>'submitBtn'));?>
			</div>
			<div class="clr"></div>
		</div>
			<div class="clr"></div>
		<?php echo $this->Form->end();?>
		</div>
	</div>
	</div>
</div>
