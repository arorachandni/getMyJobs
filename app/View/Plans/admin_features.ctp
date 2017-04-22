<div class="dashmidMain">			
	<div class="dashRight">
		<div class="dashMid">
			<div class="clr">&nbsp;</div>
		<!-- DISPLAY MESSAGE START -->
		<?php echo $this->Session->flash();?>
		<!-- DISPLAY MESSAGE END -->

		<h3>Manage Upgrade Features</h3>
		</br>
		 <div class="transFilt">
	        <div class="transFilt-R">
				<?php echo $this->Html->link('Add',array('controller'=>'plans', 'action' => 'addFeature'),array('class' => 'submitBtn'));?>
			</div>
		</div> 	
		<div class="dashfrmBx">
		 <?php if (! empty($features)){?>
			<div class="appoiTable2">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<th width="10%" class="pl"><!--<input type = "checkbox" name= "mul_chk">-->Sr.no.</th>
						<th width="30%"><?php echo $this->Paginator->sort("name",__("Name")); ?></th>
						<th width="20%"><?php echo $this->Paginator->sort("status",__("Status")); ?></th>
						<th width="20%"><?php echo $this->Paginator->sort("modified",__("Modified on")); ?></th>
						<th width="20%">Action</th>
								
					</tr>
							 
					<?php
						$counter = 0;
						foreach($features as $feature){ 
							if($counter%2 == 0)
								$tableClass = 'p1';
							else
								$tableClass = 'odd';
					?>
							
					<tr class="<?php echo $tableClass;?>">
							
						<td align="center"><!--<input type = "checkbox" name= "chk">--> <?php echo $counter+1; ?></td>
						<td><?php echo $feature['Feature']['name']; ?></td>
						<td><?php if($feature['Feature']['status'] == 1 ) { echo "Active"; } else { echo "Inactive"; } ?></td> 
						<td><span><?php echo date('M d, Y h:i' , strtotime($feature['Feature']['modified'])); ?></span></td>
						<td>
						<?php $id = $feature['Feature']['id']; ?>
							

							<?php echo  $this->Html->image("admin/edit-icon.png", array("alt" => "",'url' => array('controller' => 'plans', 'action' => 'editFeature', $id),'title'=>'Edit Feature'));?>

							<?php
								if( $feature['Feature']['status'] == 1 ) {
									$accountStatusIcon = "deactivate-icon.png";
									$statusTitle = "Deactivate the Feature";
									$link = "admin/interests/updateStatus/Feature/".$id."/0";
									
								}else {
									$accountStatusIcon = "activate.png";
									$statusTitle = "Activate The Feature";
									$link = "admin/interests/updateStatus/Feature/".$id."/1";
									
									}
							?>
							<a id="<?php echo $id; ?>"  href="<?php echo SITE_PATH.$link; ?>" <?php if( $feature['Feature']['status'] == 1 ) { ?> onclick="return confirm('Are you sure want Deactivate this Feature?');" <?php } else { ?> onclick="return confirm('Are you sure want Activate this Feature?');"<?php } ?> >
							<img src= "<?php echo SITE_PATH ?>img/admin/<?php echo $accountStatusIcon ?>" title="<?php echo $statusTitle ?>" />
							</a>

							
							<?php /*echo $this->Form->postLink(
									$this->Html->tag( 'img', '', array( 'src' => SITE_PATH.'img/admin/delete-icon.png')),
									array("controller"=>"plans","action"=>"delete/","admin"=>true,$id,'Feature'),
									array("confirm"=>"Do You Really Want to Delete this Feature?","escape" => false,'title'=>'Delete')
									);*/
								?>
							
							</td>
					</tr>
					<?php $counter++; } ?>
				</table>
			</div>
			<?php echo $this->Element('admin/pagination'); }  else{ ?>
				<div style="text-align:center; color:#FF0000;">!! No Feature found !!</div>
		<?php } ?>
		</div>	
	<div class="clr"></div>
