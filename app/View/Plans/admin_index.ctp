<div class="dashmidMain">			
	<div class="dashRight">
		<div class="dashMid">
			<div class="clr">&nbsp;</div>
		<!-- DISPLAY MESSAGE START -->
		<?php echo $this->Session->flash();?>
		<!-- DISPLAY MESSAGE END -->

		<h3>Manage Plan</h3>
		</br>
	
		<div class="dashfrmBx">
		 <?php if (! empty($plans)){?>
			<div class="appoiTable2">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<th width="10%" class="pl">Sr.no.</th>
						<th width="10%"><?php echo $this->Paginator->sort("title",__("Title")); ?></th>
						<th width="10%"><?php echo $this->Paginator->sort("minutes",__("Minutes")); ?></th>
						
						<th width="10%"><?php echo $this->Paginator->sort("price",__("Price")); ?></th>
						<th width="10%"><?php echo $this->Paginator->sort("month",__("Feature")); ?></th>
						<th width="15%"><?php echo $this->Paginator->sort("description",__("Description")); ?></th>
						<th width="15%"><?php echo $this->Paginator->sort("modified",__("Modified")); ?></th>
						<th width="10%">Action</th>
								
					</tr>
							 
					<?php
						$counter = 0;
						foreach($plans as $plan){ 
							if($counter%2 == 0)
								$tableClass = 'p1';
							else
								$tableClass = 'odd';
					?>
							
					<tr class="<?php echo $tableClass;?>">
							
						<td align="center">
						<?php echo $counter+1; ?></td>
						<td><?php echo $plan['MinutesPlan']['title']; ?></td>
						<td><?php echo $plan['MinutesPlan']['minutes'];?></td> 
						<td><?php echo '$'.$plan['MinutesPlan']['price'];?></td> 
						<td><?php echo $plan['MinutesPlan']['feature'];?></td> 
						<td><?php echo $plan['MinutesPlan']['description'];?></td>
						<td><span><?php echo date('M d, Y h:i' , strtotime($plan['MinutesPlan']['modified'])); ?></span></td>
						<td>
							<?php echo  $this->Html->image("admin/edit-icon.png", array("alt" => "",'url' => array('controller' => 'plans', 'action' => 'edit_plan', $plan['MinutesPlan']['id'])));?>

					</tr>
					<?php $counter++; } ?>
				</table>
			</div>
			<?php echo $this->Element('admin/pagination'); }  else{ ?>
				<div style="text-align:center; color:#FF0000;">!! No Plan found !!</div>
		<?php } ?>
		</div>	
	<div class="clr"></div>
