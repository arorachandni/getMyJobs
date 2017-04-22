<script type="text/javascript">	
	var jqr = jQuery.noConflict(); 
	jqr(document).ready(function(){
		jqr("#AdsenseAdminEditAdsenseForm").validationEngine();	
	});	
</script>

<div class="dashmidMain">			
			<div class="dashRight">
				<div class="dashMid">
				<div class="clr">&nbsp;</div>
	<!-- DISPLAY MESSAGE START -->
	<?php echo $this->Session->flash();?>
	<!-- DISPLAY MESSAGE END -->
	<div class="">Edit Adsense</div>
	<?php echo $this->Html->link('Back', 'javascript://', array('onclick'=>' window.history.back();','class' => 'addevent fr')); ?>		
	<?php 
		echo $this->Form->create('Adsense');
		echo $this->Form->hidden('Adsense.id');
	?>

       <div class="dashfrmBx">
	    
	 	<div class="dashinp-L">
			<span>Adsense Name:</span>
			
			<?php echo $this->Form->input('Adsense.name', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'dashInpfld validate[required]', 'error'=>false, 'required'=>false)); ?>

			</div>
          </br>

		<div class="dashinp-L-fck">
			<span>Script:</span>
			 
			<?php echo $this->Form->textarea('Adsense.script_description', array('div'=>false, 'label'=>false, 'class'=>'validate[required]', 'error'=>false, 'required'=>false,'rows' => '10', 'cols' => '60')); ?>

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
