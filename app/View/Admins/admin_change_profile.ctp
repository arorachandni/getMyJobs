<!-- VALIDATION ENGINE START -->
<script type="text/javascript">	
	$(document).ready(function(){
		$("#AdminAdminChangeProfileForm").validationEngine()	
	});	
</script>
<!-- VALIDATION ENGINE END -->

		<!--Start of Dashbord-->
		<div class="dashmidMain">			
			<div class="dashRight">
		
				<div class="dashMid">
					
					<div class="clr">&nbsp;</div>

					<?php 
		echo $this->Form->create('Admin', array('action'=>'admin_change_profile','type'=>'file'));
		echo $this->Form->hidden('Admin.id');
	?><?= $this->Session->flash();?>

					<div class="dashfrmBx">
					<h3>Admin Edit Profile</h3>
					
					<div class="clr"></div>
						 
						<div class="chng_pro">
						<div class="dashinp-L"><span>First Name :</span><?php echo $this->Form->input('Admin.first_name', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'dashInpfld validate[required]',  'error'=>false, 'required'=>false)); echo $this->Form->error('Admin.first_name');?>
						</div>
						</br>
						<div class="dashinp-L"><span>Last Name :</span><?php echo $this->Form->input('Admin.last_name', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'dashInpfld validate[required]',  'error'=>false, 'required'=>false)); ?>
						</div>
						</br>
						<div class="dashinp-L"><span>User Name :</span><?php echo $this->Form->input('Admin.username', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'dashInpfld validate[required]',  'error'=>false, 'required'=>false)); ?>
						</div>
						</br>
						<div class="dashinp-L"><span>Mobile Number :</span><?php echo $this->Form->input('Admin.mobile_number', array('div'=>false, 'label'=>false, 'type'=>'text', 'class'=>'dashInpfld validate[required,custom[phone]]',  'error'=>false, 'required'=>false)); ?>
						</div>
						<br/>
						
						<div class="submitBtn1">
						<?= $this->Form->submit('Save', array('div'=>false, 'label'=>false, 'class'=>'submitBtn'));?>
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
