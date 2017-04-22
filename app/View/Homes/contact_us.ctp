<!-- VALIDATION ENGINE START -->
<script type="text/javascript">	
	
	$(document).ready(function(){
		$("#ContactContactUsForm").validationEngine();	
	});	
</script>
<!-- VALIDATION ENGINE END -->
<!--Start Top Heading-->
    <div class="contactHeading">Contact Us</div>
    <!--Start Top Heading-->
    <!--contact us-->
	
    <div class="formBox">
	<?php echo $this->Session->flash();?>
	<?= $this->Form->create('Contact', array('url'=>array('controller' => 'homes', 'action' => 'contactUs'))); ?>
    <span>Fields marked with (<label class="redStar">*</label>) are mandatory</span>
        <ul>
            <li class="fl"><?= $this->Form->input('name',array('class'=>'inputBx validate[required]', 'div' => false, 'label'=> false, 'required'=>false, 'error'=>false, 'placeholder' => 'Your Name', 'autofocus')); ?></li>
            <li class="fr"><?= $this->Form->input('mobile_number',array('class'=>'inputBx validate[required]', 'div' => false, 'label'=> false, 'required'=>false, 'error'=>false, 'placeholder' => 'Mobile No.', 'autofocus')); ?></li>
			
            <div class="clearfix"></div>
            <li class="fl"><?= $this->Form->input('email',array('class'=>'inputBx validate[required,custom[email]]', 'div' => false, 'label'=> false, 'required'=>false, 'error'=>false, 'placeholder' => 'Email Id', 'autofocus')); ?></li>
            <li class="fr"><?= $this->Form->input('subject',array('class'=>'inputBx validate[required]', 'div' => false, 'label'=> false, 'required'=>false, 'error'=>false, 'placeholder' => 'Subject', 'autofocus')); ?></li>       
            <div class="clearfix"></div>           
		   <li><?= $this->Form->textarea('message',array('class'=>'inputBx validate[required]', 'div' => false, 'label'=> false, 'required'=>false, 'error'=>false, 'placeholder' => 'Enter Message')); ?></li>
            <div class="clearfix"></div>
            <li><?= $this->Form->input('Submit', array('type'=>'submit', 'class'=> 'submitBtn', 'div' => false, 'label'=> false)); ?></li>
        </ul>
	<?= $this->Form->end(); ?>
    </div>
    <!--contact us-->