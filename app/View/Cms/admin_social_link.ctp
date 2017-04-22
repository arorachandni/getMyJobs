<div class="dashmidMain">			
	<div class="dashRight">
		<div class="dashMid">
			<div class="clr">&nbsp;</div>
		<!-- DISPLAY MESSAGE START -->
		<?php echo $this->Session->flash();?>
		<!-- DISPLAY MESSAGE END -->

		<h3>Manage Social Link</h3>
		</br>
		
		<div class="dashfrmBx">
		 <?php if (! empty($links)){?>
			<div class="appoiTable2">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<th width="10%" class="pl"><!--<input type = "checkbox" name= "mul_chk">-->Sr.no.</th>
						<th width="30%"><?php echo $this->Paginator->sort("name",__("Name")); ?></th>
						<th width="40%"><?php echo $this->Paginator->sort("link",__("Link Url")); ?></th>
						<th width="20%">Action</th>
								
					</tr>
							 
					<?php
						$counter = 0;
						foreach($links as $link){ 
							if($counter%2 == 0)
								$tableClass = 'p1';
							else
								$tableClass = 'odd';
					?>
							
					<tr class="<?php echo $tableClass;?>">
							
						<td align="center"><!--<input type = "checkbox" name= "chk">--> <?php echo $counter+1; ?></td>
						<td><?php echo $link['SocialLink']['name']; ?></td>
						<td><?php echo $link['SocialLink']['link'] ?></td> 
						<td>
						<?php $id = $link['SocialLink']['id']; 

							echo  $this->Html->image("admin/edit-icon.png", array("alt" => "",'url' => array('controller' => 'Cms', 'action' => 'editLink', $id),'title'=>'Edit Social Link'));
						?>
							
							</td>
					</tr>
					<?php $counter++; } ?>
				</table>
			</div>
			<?php echo $this->Element('admin/pagination'); }  else{ ?>
				<div style="text-align:center; color:#FF0000;">!! No Category found !!</div>
		<?php } ?>
		</div>	
	<div class="clr"></div>
