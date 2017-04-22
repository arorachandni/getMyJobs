<!-- VALIDATION ENGINE START -->
<script type="text/javascript">	
	$(document).ready(function(){
		$("#UserPasswordResetForm").validationEngine()	
	});	
</script>
<!-- VALIDATION ENGINE END -->
<div class="dashmidMain">			
			<div class="dashRight">
				<div class="dashMid">
				<div class="clr">&nbsp;</div>
	<!-- DISPLAY MESSAGE START -->
	<?= $this->Session->flash();?>
	<!-- DISPLAY MESSAGE END -->
	<div class="">Reset User Password</div>
	<?= $this->Html->link('Back', 'javascript://', array('onclick'=>' window.history.back();','class' => 'addevent fr')); ?>		
	
			<?= $this->Form->create( "User", array( "url" => array( "action" => "password_reset", "admin" => true, $id ),'id'=>'UserPasswordResetForm')); ?>
			<div class="dashfrmBx">
	    
				<div class="dashinp-L">
					<span>New Password:</span>			
					<?= $this->Form->input('User.new_password', array('div'=>false, 'label'=>false, 'type'=>'password', 'class'=>'dashInpfld validate[required]', 'error'=>false, 'required'=>false)); ?>
				</div>
				</br>
				<div class="dashinp-L">
					<span>Confirm Password:</span>
					<?= $this->Form->input('User.confirm_password', array('div'=>false, 'label'=>false, 'type'=>'password','class'=>'dashInpfld validate[required,equals[UserNewPassword]]', 'maxlength'=>50, 'required'=>false)); ?>
				</div>
				<div class="norbtnmain">
					<?= $this->Form->submit('Save', array('div'=>false, 'label'=>false, 'class'=>'submitBtn'));?>
				</div>
			</div>
			</form>	
		</div>

	</div>
</div>
