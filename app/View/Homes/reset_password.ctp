<script type="text/javascript"> 
    $(document).ready(function(){
        $("#UserResetPasswordForm").validationEngine();         
       });
</script>

<div class="blackOverLay open2"></div>
<div class="resetPassword open">
	<div class="inerReset">
        <?= $this->Html->image("frontend/loginHd.png", array("alt" => "",'class'=>'loginHd')); ?>

       <?= $this->Form->create('User'); ?>
        <div class="signInHd">Reset Password</div>

           <?= $this->Session->flash();?>
           
        <span  class="error-message"></span>
		 
		 <?= $this->Form->input('User.email', array('class'=>'loginInput  validate[required, custom[email]]', 'div' => false, 'label'=> false, 'placeholder' => 'Email','id' =>'inputEmail')); ?>

		<?= $this->Form->input('User.new_password', array('class'=>'loginInput  validate[required]', 'div' => false, 'label'=> false, 'placeholder' => 'New Password', 'id' =>'inputPassword', 'type' => 'password')); ?>

		<?= $this->Form->input('User.confirm_password', array('class'=>'loginInput  validate[required,equals[inputPassword]]', 'div' => false, 'label'=> false, 'placeholder' => 'Confirm Password', 'type' => 'password' )); ?>
		
			<?= $this->Form->input('Change Password & Sign in', array('type'=>'submit', 'class'=> 'signInBtn', 'div' => false, 'label'=> false)); ?>		

       <?= $this->Form->end(); ?>
    </div>
</div>