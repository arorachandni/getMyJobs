<div class="rightCon">
     <div class="innerContainer">
     	<div class="topMainHd">
        	<div class="mainHd2">
            	<h1>Settings</h1>
                <span>Change your notification settings</span>
            </div>
            <!-- Call to element for Setting Navigation --   -->
            <?php echo $this->element('frontend/setting_navigation');?>

            <div class="clearfix"></div>
        </div>
        <?php echo $this->Session->flash();?>
            <?php echo $this->Form->create("User"); 
            echo $this->Form->hidden('User.id');?>
        	<div class="notificationBox">
            	<label class="notiCheckbox" for="chk1">
                    <?php echo $this->Form->checkbox('User.message_notification', array('hiddenField' => false));?>Messages</label>
                <label class="notiCheckbox"><?php echo $this->Form->checkbox('User.like_notification', array('hiddenField' => false));?>Liked You (Request)</label>
                <label class="notiCheckbox"><?php echo $this->Form->checkbox('User.viewed_notification', array('hiddenField' => false));?>Viewed Me</label>
                <label class="notiCheckbox"><?php echo $this->Form->checkbox('User.fav_notification', array('hiddenField' => false)); ?>Favorited You</label>
                <label class="notiCheckbox"><?php echo $this->Form->checkbox('User.matched_notification', array('hiddenField' => false)); ?>Matched</label>

                <div class="clearfix"></div>
                <?php echo $this->Form->submit('Submit', array('div'=>false, 'label'=>false, 'class'=>'btns notiBtns'));?>
            </div>
            <?php echo $this->Form->end(); ?>
     </div>
</div>