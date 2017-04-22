<script type="text/javascript">	

	var flag = 0;
	$(document).ready(function(){
		
   		$('#CmsPageImage1').on('change',function(){
    		var name =  $(this).val();
    		
    		var ext=name.substring(name.lastIndexOf('.')+1);
    		if(ext == "jpg" || ext == "png" || ext == "jpeg" || ext == "gif"){
    			flag = 0;
    			$('#img-err1').text('');
    		}else{
    			flag = 1;
    			$('#img-err1').text('Please upload valid file.');
    		}
   		});
		
   		$("#CmsPageAdminEditPageForm").on('submit', function(){
   			if(flag != 0){
   				return false;
   			}else{
   				return true;
   			}
   		});
	});	

   
     
</script>

<div class="dashmidMain">			
			<div class="dashRight">
				<div class="dashMid">
				<div class="clr">&nbsp;</div>

	<?= $this->Session->flash();?>

	<div class="">Edit <?php echo $pagedata['CmsPage']['page_name']; ?> Link</div>
	<?= $this->Html->link('Back', 'javascript://', array('onclick'=>' window.history.back();','class' => 'addevent fr')); ?>		
	<?php 
		echo $this->Form->create('CmsPage',array());
		echo $this->Form->hidden('CmsPage.id');
	?>
	
       <div class="dashfrmBx">
	    
	 	<!-- <div class="dashinp-L">
			<span>Pages Name:</span>
			
			<?= $this->Form->input('CmsPage.page_name', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'dashInpfld validate[required]', 'error'=>false, 'required'=>false)); ?>
			</div>
          </br>
 -->
		  <div class="dashinp-L">
			<span>Link : </span>
			<?= $this->Form->input('CmsPage.title', array('div'=>false, 'label'=>false, 'type'=>'text','class'=>'dashInpfld validate[required]', 'maxlength'=>50, 'required'=>false)); ?>
			</div>

		</br>
		
		<!-- Homepage About us  -->
	<!--		<div class="dashinp-L-fck">
			<span>Description:</span>
			
			<?= $this->Fck->fckeditor(array('CmsPage', 'description'), $this->Html->base, $this->request->data['CmsPage']['description_eng'], '70%', '450');?>
			</div> -->
		</br>
		 <div class="norbtnmain">
			<?= $this->Form->submit('Update', array('div'=>false, 'label'=>false, 'class'=>'submitBtn'));?>
		</div>
		<div class="clr"></div>
	</div>
		<div class="clr"></div>
	<?= $this->Form->end();?>
	</div>
</div>
</div>
</div>
