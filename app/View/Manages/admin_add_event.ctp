
<script type="text/javascript">	
	var jqr = jQuery.noConflict(); 
	jqr(document).ready(function(){
		jqr("#EventAdminAddEventForm").validationEngine()	
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
<div class="">Add Event</div>			
	<?php echo $this->Form->create('Event', array('type'=> 'file'));?>	
		
	<div class="dashfrmBx">
			
		<div class="dashinp-L">
			<span>Event Title:</span>
			<?php echo $this->Form->input('Event.event_title', array('div'=>false, 'label'=>false, 'type'=>'text','class'=>'dashInpfld validate[required]', 'maxlength'=>100, 'required'=>false)); ?>
		</div>
		<br/>
        <div class="dashinp-L">
		<span>Description :</span>
			<?php echo $this->Form->input('Event.description', array('div'=>false, 'label'=>false, 'type'=>'textarea','class'=>'dashInpfld validate[required]', 'maxlength'=>50, 'required'=>false)); ?>
		</div>
		<br/>
		<div class="dashinp-L">
			<span>Location:</span>
			<?php echo $this->Form->input('Event.location', array('div'=>false, 'label'=>false, 'type'=>'text','class'=>'dashInpfld validate[required]', 'maxlength'=>100, 'required'=>false)); ?>
		</div>
		<br/>
		 <div class="dashinp-L">
		<span>Event Date:</span>
			<?php echo $this->Form->input('Event.eventdate', array('div'=>false, 'label'=>false, 'type'=>'text','class'=>'dashInpfld validate[required] datepicker', 'maxlength'=>100, 'required'=>false)); ?>
			<?php
                                    // $var = htmlentities(__('Select End Date', true), ENT_COMPAT, "ISO8859-1");
                                  //   echo $this->Form->input('Event.eventdate', array('div'=>false, 'label'=>false, 'type'=>'text','class'=>'addCatInp calander datepicker', 'id'=>'datepicker','error'=>false, 'required'=>false,'placeholder'=> html_entity_decode($var)));
                                   //  echo $this->Form->error('Event.eventdate');
                                 ?>
		</div>
		<br/>
		 <div class="dashinp-L">
		<span>Event Start Time:</span>
			<?php echo $this->Form->input('Event.start_at', array('div'=>false, 'label'=>false, 'type'=>'text','class'=>'dashInpfld timepicker myPicker validate[required]', 'maxlength'=>100, 'required'=>false)); 
			?>
		</div>
		<br/>
		 <div class="dashinp-L">
		<span>Event End Time:</span>
			<?php echo $this->Form->input('Event.end_at', array('div'=>false, 'label'=>false, 'type'=>'text','class'=>'dashInpfld timepicker myPicker validate[required]', 'maxlength'=>100, 'required'=>false)); 
			?>
		</div>
		<br/>
		 <div class="dashinp-L">
		<span>Event Latitude:</span>
			<?php echo $this->Form->input('Event.lat', array('div'=>false, 'label'=>false, 'type'=>'text','class'=>'dashInpfld validate[required]', 'maxlength'=>100, 'required'=>false)); ?>
		</div>
		<br/>
		 <div class="dashinp-L">
		<span>Event Longitude:</span>
			<?php echo $this->Form->input('Event.lng', array('div'=>false, 'label'=>false, 'type'=>'text','class'=>'dashInpfld validate[required]', 'maxlength'=>100, 'required'=>false)); ?>
		</div>
		<br/>
		 <div class="dashinp-L">
		<span>Event Type:</span>
		<?php 
			$options = array(
    		'1' => 'Private',
    		'0' => 'Public'
			);

			$attributes = array('div'=>false, 'label'=>false, 'type'=>'file','class'=>'validate[required] fileupload', 'required'=>false);
			echo $this->Form->radio('Event.eventype', $options, $attributes); ?>
			
		</div>
		<br/>
        <div class="dashinp-L">
		<span>Image :</span>
			<?php echo $this->Form->input('Upload.url', array('div'=>false, 'label'=>false, 'type'=>'file','class'=>'fileupload', 'required'=>false)); ?> 
	    <div class="clr"></div>		
		<div class="dvPreview"></div>
		</div>
		 </br>
		
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
