<!-- VALIDATION ENGINE START -->
<script type="text/javascript"> 
    $(document).ready(function(){
        $("#UserIndexForm").validationEngine();
        $("#deactivateAccount").validationEngine();
          
    }); 
</script>
<!-- VALIDATION ENGINE END -->
<div class="rightCon">
     <div class="innerContainer">
     	<div class="topMainHd">
        	<div class="mainHd2">
            	<h1>Settings</h1>
                <span>Change your account settings</span>
            </div>
            <!-- Call to element for Setting Navigation --   -->
            <?php echo $this->element('frontend/setting_navigation');?>
            <div class="clearfix"></div>
        </div>
        <?php echo $this->Form->create("User"); ?>
        <div class="resetPass">
        	<h2>Reset Password</h2>
            <?php echo $this->Session->flash();?>
            <ul class="rePass">
            	<li>
                    <?php echo $this->Form->input('User.email', array('div'=>false, 'label'=>false, 'class'=>'input validate[required, custom[email]]', 'error'=>false, 'required'=>false,'placeholder' => "Email Address")); ?>
                </li>
                <li>
                    <?php echo $this->Form->input('User.new_password', array('div'=>false, 'label'=>false, 'type'=>'password', 'class'=>'input validate[required, minSize[8]]', 'error'=>false, 'required'=>false,'placeholder' => "New Password")); ?>
                </li>
                <li>
                    <?php echo $this->Form->input('User.confirm_password', array('div'=>false, 'label'=>false, 'type'=>'password', 'class'=>'input validate[required,equals[UserNewPassword],minSize[8]]', 'error'=>false, 'required'=>false,'placeholder' => "Confirm Password")); ?>
                </li>

                <li><?php echo $this->Form->submit('Reset', array('div'=>false, 'label'=>false, 'class'=>'btns'));?>
               </li>
            </ul>
        </div>
        <?php echo $this->Form->end(); ?>
        <div class="deactiveAcc">
        <?php echo $this->Form->create("User",array('url'=>array('controller'=>'settings','action'=>'deactivate'),'id'=>'deactivateAccount')); ?>
        <h2>Deactivate Your Account</h2>
        	<ul>
            	<li><?php echo $this->Form->checkbox('deactivate_status', array('hiddenField' => false,'div'=>false,'label'=>'false','class'=>'validate[required]')); ?>Deactivate My Account</li>
                <?php echo $this->Form->hidden('id',array('value'=>$this->Session->read('Auth.User.User.id'))); ?>
                <li><?php echo $this->Form->submit('Submit', array('div'=>false, 'label'=>false, 'class'=>'btns'));?></li>
            </ul>
        <?php echo $this->Form->end(); ?>
        </div>
     </div>
</div>