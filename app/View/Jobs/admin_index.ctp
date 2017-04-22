<?php
//echo '<pre>'; print_r($viewListing); die;
echo $this->Html->Script('calender/jscal2.js');
echo $this->Html->Script('calender/lang/en.js');
echo $this->Html->Css('calender/jscal2.css');
echo $this->Html->Css('calender/border-radius.css');
echo $this->Html->Css('calender/steel/steel.css');
?>
<div class="rightMid">
	<!-- DISPLAY MESSAGE START -->
	<?php echo $this->Session->flash();?>
	<!-- DISPLAY MESSAGE END -->
	<div class="mainHd">Manage Users</div>
	
	<?php echo $this->Form->create(); ?>
    <div class="seacbox">

        <div class="cls1">
            <div class="labeltxt">Name</div>
            <?php echo $this->Form->text('User.name', array('class' => 'searchinput', 'label' => false, 'required' => false)); ?>
        </div>

        <div class="cls2">
            <div class="labeltxt">Email</div>
            <?php echo $this->Form->text('User.email', array('class' => 'searchinput', 'label' => false, 'required' => false)); ?>
        </div>

        <div class="cls2">
            <p></p>
            <div class="labeltxt">Created Date</div>
            <?php echo $this->Form->text('User.date_created', array('class' => 'searchinput', 'label' => false, 'required' => false)); ?>
        </div>

        <script type="text/javascript">
            var cal = Calendar.setup({
                onSelect: function(cal) { cal.hide() }
            });
            cal.manageFields("UserDateCreated", "UserDateCreated", "%Y-%m-%d");
        </script>

        <div class="clr"></div>


        <?php echo $this->Form->submit('Search', array('div' => false, 'class' => 'searcbtn')); ?>
        </div>
    <?php echo $this->Form->end(); ?>

	<div class="clr"></div>
	<?php
		if(!empty($viewListing)){
	?>
	<div>
		 <?php echo $this->Form->create('', array('action' => 'deleteall')); ?>
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr class="rpHd"> 
				<td width="10%"><input type="checkbox" id="select_all" onclick=" return SelectAll();" class="checkbox" /> S.No. </td>
				<td width="15%" align="center">First Name</td>
				<td width="15%" align="center">Last Nmae</td>
				<td width="20%" align="center">Email</td>
				<td width="10%" align="center">Date Added</td>
				<td width="10%" align="center">Status</td>
				<td width="20%" align="center">Options</td>
			</tr>
			
			<?php
				$counter = 0;
				foreach($viewListing as $listing){ //pr($listing);die;
					if($counter%2 == 0)
						$tableClass = 'rpFirstRow';
					else
						$tableClass = 'rpSecRow';
			?>
			<tr class="<?php echo $tableClass;?>">
				 
				 <td><input type="checkbox" value="<?php echo $listing['User']['id']; ?>" name="data[boxes][]" class="invite_class" /> <?php echo $counter+1;?>  </td>
				
				<td align="center"><?php echo $listing['User']['first_name']?></td>
				
				<td align="center"><?php echo $listing['User']['last_name']?></td>
				
				<td align="center"><?php echo $listing['User']['email'];?></td>
				
				<td align="center"><?php echo date('d M, Y', strtotime($listing['User']['date_created']));?></td>
				
				<td align="center"><?php
					if($listing['User']['user_status'] == '1'){
						$statusImage = 'admin/success.png';
						$newStatus = '0';
						$message = 'Deactivate';
					}else{
						$statusImage = 'admin/error.png';
						$newStatus = '1';
						$message = 'Activate';
					}
					echo $this->Html->link($this->Html->image($statusImage, array('alt'=>'', 'border'=>0)), '/admin/users/status_update_user/'.$listing['User']['id'].'/'.$newStatus.'/', array('escape'=>false, 'title'=>$message), 'Do You Really Want to '.$message.' this?');
				?></td>
				
			
				
				<td align="center"><?php
				    //Edit
					echo $this->Html->link($this->Html->image('admin/edit_icon.gif', array('alt'=>'', 'border'=>0)), '/admin/users/edit_user/'.$listing['User']['id'].'/', array('escape'=>false, 'title'=>'Edit'));
					//view
					echo $this->Html->link($this->Html->image('admin/view_icon.gif', array('alt'=>'', 'border'=>0)), '/admin/users/view/'.$listing['User']['id'].'/', array('escape'=>false, 'title'=>'View', 'class'=>'fancyclass'));
					//delete
					echo $this->Html->link($this->Html->image('admin/delete_icon.gif', array('alt'=>'', 'border'=>0)), '/admin/users/delete/'.$listing['User']['id'].'/User/', array('escape'=>false, 'title'=>'Delete', 'style'=>'margin-left:5px;'), 'Do You Really Want to Delete this User?');
				?></td>
				
			</tr>
			<?php
					$counter++;
				}
			?>
		</table>
	</div>
	<?php 
				echo $this->Form->submit('Delete Selected', array('onclick' => 'return isConfirm("UserDeleteallForm");', 'class' => 'delbtn' , 'style' => 'width: 104px;'));
		echo $this->Element('admin/pagination');
	      }else{ ?>
		<div style="text-align:center; color:#FF0000;">!! No User found !!</div>
	<?php } ?>
	<div class="clr"></div>
</div>