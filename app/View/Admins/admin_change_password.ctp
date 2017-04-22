<!-- VALIDATION ENGINE START -->
<script type="text/javascript">	
	$(document).ready(function(){
		$("#AdminAdminChangePasswordForm").validationEngine()	
	});	
</script>
<!-- VALIDATION ENGINE END -->

<div class="dashmidMain">			
			<div class="dashRight">
				<div class="dashMid">
					<div class="clr">&nbsp;</div>
				
<?php echo $this->Session->flash();?>
	<div class="">Change Login Password</div>
					<?php 
		echo $this->Form->create('Admin', array('action'=>'admin_change_password'));
		echo $this->Form->hidden('Admin.id');
	?>
		
	<div class="dashfrmBx">
					<div class="dashinp-L">
			<span>Current Password :</span>
			<?php echo $this->Form->password('Admin.current_password', array('div'=>false, 'label'=>false, 'class'=>'dashInpfld validate[required]', 'maxlength'=>50, 'error'=>false)); ?>
		</div>
             <br/>
		<div class="dashinp-L">
			<span>New Password :</span>
			<?php echo $this->Form->password('Admin.new_password', array('div'=>false, 'label'=>false, 'class'=>'dashInpfld validate[required]', 'maxlength'=>50, 'error'=>false)); ?>
		</div>
            <br/>
		<div class="dashinp-L">
			<span>Confirm Password :</span>
			<?php echo $this->Form->password('Admin.confirm_password', array('div'=>false, 'label'=>false, 'class'=>'dashInpfld validate[required,equals[AdminNewPassword]]', 'maxlength'=>50, 'error'=>false));?>
		</div>
          
		<div class="norbtnmain">
			<?php echo $this->Form->submit('Change Password', array('div'=>false, 'label'=>false, 'class'=>'submitBtn'));?>
		</div>
		<div class="clr"></div>
	</div>
				</div>
			</div>
			<?php echo $this->Form->end();?>
			<div class="clearfix"></div>
		
	</div>
<style>
.submitBtn  {
    background: #1597a6 none repeat scroll 0 0;
    color: #ffffff;
    display: inline-block;
    font-family: "Ubuntu-bold";
    font-size: 14px;
    padding: 10px 20px;
    text-transform: uppercase;
    transition: all 0.4s ease 0s;
}

</style>	