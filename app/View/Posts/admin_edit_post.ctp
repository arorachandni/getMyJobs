
<script type="text/javascript">	
	var jqr = jQuery.noConflict(); 
	jqr(document).ready(function(){
		jqr("#PostAdminEditPostForm").validationEngine()	
	});	
	
</script>
<script type="text/javascript">
jqr(function () {
         jqr('.datepicker').datepicker({
             changeMonth: true,
              changeYear: true,
              dateFormat: "yy-mm-dd",
              beforeShow: function (textbox, instance) {
              instance.dpDiv.css({
           });
          }
        });
        jqr('.myPicker').timepicker(
             {
             'step': '05',
             'minTime': '12:05am',
             'timeFormat': 'H:i:s',
             }
         );
		jqr('.myTimepicker').on('changeTime', function() {
             jqr('.mySpan').text($(this).val());
         });
	jqr('#subreg').on('click',function(){
     	if(jqr("input:checked").length == 0){
         var $messageDiv = jqr('#openmessage'); // get the reference of the div
          $messageDiv.show().html('Opening day is required! Please select atleat one.'); // show and set the message
         jqr('#openmessage').focus() ;
         setTimeout(function(){ $messageDiv.hide().html('');}, 10000);
         return false;
     }else{

          //jqr('#BrandOwnerCreatestoreForm').submit();
     }
});
});
 
</script>

<div class="dashmidMain">			
			<div class="dashRight">
				<div class="dashMid">
					<div class="clr">&nbsp;</div>
			<?php echo $this->Session->flash();?>
<div class="">Edit Post</div>			
	<?php 
	echo $this->Form->create('Post', array('action'=>'admin_edit_post','type'=> 'file'));
		echo $this->Form->hidden('Post.id');
		echo $this->Form->hidden('Post.event_id');
		echo $this->Form->hidden('Post.user_id');
		echo $this->Form->hidden('Post.type');
		echo $this->Form->hidden('Post.lat');
		echo $this->Form->hidden('Post.lng');
	?>	
	<div class="dashfrmBx">
		<div class="dashinp-L">
		<?php 
			 if($eventDetails['Post']['type']=='comment'){ ?><span>Post Comment :</span><?php
				echo $this->Form->input('Post.data', array('div'=>false, 'label'=>false, 'type'=>'textarea','class'=>'dashInpfld validate[required]', 'maxlength'=>50, 'required'=>false)); 
			 } else if($eventDetails['Post']['type']=='image') { ?>
			 	<span>Post Image :</span>
				<?php echo $this->Form->input('Post.data', array('div'=>false, 'label'=>false, 'type'=>'file','class'=>'fileupload', 'required'=>false)); ?>
				 <div class="dvPreview"><?php echo $this->Html->image(SITE_PATH.'img/postImage/'.$eventDetails['Post']['data'], array('alt' => 'post', 'border' => '0', 'width' => '100', 'height' => '100')); ?></div>
				
			 <?php } else if($eventDetails['Post']['type']=='video') { ?>
			 <span>Post Video :</span>
			 <div class="dvPreview"><?php  
			 echo $this->Form->input('Post.data', array('div'=>false, 'label'=>false, 'type'=>'file','class'=>'fileupload', 'required'=>false));
			 echo $this->Html->image(SITE_PATH.'img/postVideo/'.$eventDetails['Post']['data'], array('alt' => 'post', 'border' => '0', 'width' => '100', 'height' => '100')); 
			 
			 ?></div>
		  <?php } ?>
		</div>
		<br/>
		<br/>
		<div class="norbtnmain">
			<?php echo $this->Form->submit('Save', array('div'=>false, 'label'=>false, 'class'=>'submitBtn'));?>
		</div>
		<div class="clr"></div>
	</div>
				</div>
			</div>
			<?php echo $this->Form->end();?>
			<div class="clearfix"></div>
	</div>