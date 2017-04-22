<!-- VALIDATION ENGINE START -->
<script type="text/javascript">	
	$(document).ready(function(){
		$("#AdminAdminChangeEmailAdminForm").validationEngine()	
	});	
</script>
<!-- VALIDATION ENGINE END -->

		<!--Start of Dashbord-->
		<div class="dashmidMain">			
			<div class="dashRight">
		
				<div class="dashMid">
					
					<div class="clr">&nbsp;</div>
					<?php 
						echo $this->Form->create('Admin', array('action'=>'admin_change_email_admin','type'=>'file'));
						echo $this->Form->hidden('Admin.id');
					?>
				<?php echo $this->Session->flash();?>
				<div class="">Change Admin Email</div>
					<div class="dashfrmBx">
					
					<div class="clr"></div>
						
						</br>
					
						<div class="dashinp-L"><span>Email :</span><?php echo $this->Form->input('Admin.email', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'dashInpfld validate[required,custom[email]]',  'error'=>false, 'required'=>false)); ?>
						</div>
						</br>
						<div class="dashinp-L">
							<span style="color:red">Note : </span>Please enter Email ID in which you want like to Recieve Notifications eg. Contact us , Reset Password, User Registration etc.
						</div>
						</br>
						<div class="submitBtn1">
							<?php echo $this->Form->submit('Save', array('div'=>false, 'label'=>false, 'class'=>'submitBtn'));?>
						</div>
					</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
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
.lft.author{ float:left; width:250px;}
.lft.author img{border: 8px solid #FFFFFF; box-shadow: 0 0 6px rgba(0, 0, 0, 0.2); display:block; margin-top:10px;}
</style>
	</div>	

