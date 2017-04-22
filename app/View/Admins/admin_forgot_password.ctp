<!-- VALIDATION ENGINE START -->
<script type="text/javascript">	
	$(document).ready(function(){
		$("#AdminAdminForgotPasswordForm").validationEngine()	
	});	
</script>
<!-- VALIDATION ENGINE END -->

<!-- DISPLAY MESSAGE START -->
<?php echo $this->Session->flash();?>
<!-- DISPLAY MESSAGE END -->

<div class="loginBox">
	<?php echo $this->Form->create('Admin', array('action'=>'admin_forgot_password'));?>
	<div class="">Forgot Password?</div>

	<div class="loginField">Email:</div>
	<div class="loginLabal">
		<?php echo $this->Form->input('Admin.email', array('div'=>false, 'label'=>false, 'type'=>'text', 'error'=>false, 'class'=>'loginInp validate[required,custom[email]]', 'maxlength'=>100, 'required'=>false)); echo $this->Form->error('Admin.email');
		?>
	</div>
	<div class="clr"></div>

	<div class="loginField"></div>
	<div class="loginLabal">
		<span style="float:right; margin-right:10px;">
			<?php echo $this->Html->link('Sign In', '/admin/admins/sign_in/', array('escape'=>false, 'style'=>'color:#FFFFFF;'));?>
		</span>
	</div>
	<div class="clr"></div>

	<div class="loginField"></div>
	<div class="">
		<?php
			echo $this->Form->submit('Submit', array('class'=>'loginBtn', 'div'=>false, 'label'=>false));
		?>
	</div>
	<div class="clr"></div>
	<?php echo $this->Form->end();?>
</div>
	<style>
	
	.loginBtn {
    background: #00a0b0 none repeat scroll 0 0;
    color: #ffffff;
    display: block;
    font-family: "Ubuntu-Bold";
    font-size: 17px;
    padding: 10px 0;
    text-align: center;
    transition: all 0.4s ease 0s;
	width:100%;
	border:none;
	 cursor:pointer;
}
.loginBtn:hover{ background:#02707b;}
	</style>