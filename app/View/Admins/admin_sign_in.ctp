<!-- VALIDATION ENGINE START -->

<script type="text/javascript">	

	$(document).ready(function(){

		$("#AdminAdminSignInForm").validationEngine()	

	});	

</script>
<!-- VALIDATION ENGINE END -->

<!-- DISPLAY MESSAGE START -->
<?php echo $this->Session->flash();?>
<!-- DISPLAY MESSAGE END -->

	<?php echo $this->Form->create('Admin', array('url'=>array('')));?>
	<?php echo $this->Form->input('Admin.username', array('div'=>false, 'label'=>false, 'type'=>'text', 'error'=>false, 'placeholder'=>'Username','class'=>'loginInp validate[required,custom[onlyLetterNumber]]', 'maxlength'=>50, 'required'=>false)); 

		?>
	<?php echo $this->Form->input('Admin.password', array('div'=>false, 'label'=>false, 'type'=>'password', 'error'=>false, 'Placeholder'=>'Password','class'=>'loginInp validate[required]', 'maxlength'=>70, 'required'=>false)); 

		?>
	<div class="remme">

	<?php echo $this->Form->input('Admin.remember_me', array('div'=>false, 'label'=>false, 'type'=>'checkbox', 'error'=>false));?>&nbsp;<label>Remember Me</label>

	<?php // echo $this->Html->link('Forgot Password', '/admin/admins/forgot_password/', array('escape'=>false));?>		

	</div>
	<div class="">
		<?php
			echo $this->Form->submit('Log In', array('class'=>'loginBtn', 'div'=>false, 'label'=>false));

		?>
	</div>


	<?php echo $this->Form->end();?>

