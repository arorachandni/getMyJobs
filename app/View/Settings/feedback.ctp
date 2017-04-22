<!-- VALIDATION ENGINE START -->
<script type="text/javascript"> 
    $(document).ready(function(){
        $("#UserFeedbackFeedbackForm").validationEngine()  
    }); 
</script>
<!-- VALIDATION ENGINE END -->
<div class="rightCon">
     <div class="innerContainer">
     	<div class="topMainHd">
        	<div class="mainHd2">
            	<h1>Settings</h1>
                <span>Give your valuable feedback</span>
            </div>

    <!-- --- Call to element for Setting Navigation ----   -->
            <?= $this->element('frontend/setting_navigation');?>

            <div class="clearfix"></div>
        </div>
        <?= $this->Session->flash();?>

         <?= $this->Form->create("UserFeedback"); ?>
        <div class="resetPass feedback">
            
        	<h2>Feedback</h2>
            <ul class="rePass">
            	<li><?= $this->Form->input('subject',array('class'=>'input validate[required]', 'div' => false, 'label'=> false, 'required'=>false, 'error'=>false, 'placeholder' => 'Subject')); ?>
                <!-- <input type="text" class="input" placeholder="Feedback Subject"> --></li>
                <li><!-- <textarea class="input" placeholder="Your Feedback"></textarea> -->
                <?= $this->Form->textarea('message',array('class'=>'input validate[required]', 'div' => false, 'label'=> false, 'required'=>false, 'error'=>false, 'placeholder' => 'Your Feedback')); ?></li>
                <li><?= $this->Form->submit('Submit', array('div'=>false, 'label'=>false, 'class'=>'btns'));?></li>
            </ul>
        </div>
        <?php echo $this->Form->end();?>
     </div>
</div>