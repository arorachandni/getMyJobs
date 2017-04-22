<div class="dashmidMain">			
	<div class="dashRight">
		<div class="dashMid">
			<div class="clr">&nbsp;</div>
		<!-- DISPLAY MESSAGE START -->
		<?php echo $this->Session->flash();?>
		<!-- DISPLAY MESSAGE END -->
		<h3>Notification Types</h3>
		</br>
		
		<div class="dashfrmBx">
		 <?php if (! empty($notifications)){?>
			<div class="appoiTable2">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<th width="10%" class="pl">Sr.no.</th>
						<th width="25%"><?php echo $this->Paginator->sort("name",__("Name")); ?></th>
						<th width="25%"><?php echo $this->Paginator->sort("modified",__("Modified On")); ?></th>
						<th width="20%"><?php echo $this->Paginator->sort("status",__("Status")); ?></th>
						<th width="20%">Action</th>
								
					</tr>
							 
					<?php
						$counter = 0;
						foreach($notifications as $notification){ 
							if($counter%2 == 0)
								$tableClass = 'p1';
							else
								$tableClass = 'odd';
					?>
							
					<tr class="<?php echo $tableClass;?>">
							
						<td align="center"><?php echo $counter+1; ?></td>
						<td><?php echo $notification['AdminNotification']['name']; ?></td>
						<td><span><?php echo date('M d, Y h:i' , strtotime($notification['AdminNotification']['modified'])); ?></span></td>
						
						<td><?php if($notification['AdminNotification']['status'] == 1 ) { echo "Active"; } else { echo "Inactive"; } ?></td> 
						
						<td>
						<?php $id = $notification['AdminNotification']['id']; ?>
							

							<?php
								if( $notification['AdminNotification']['status'] == 1 ) {
									$accountStatusIcon = "deactivate-icon.png";
									$statusTitle = "Deactivate the Notification Type";
									$link = "admin/interests/updateStatus/AdminNotification/".$id."/0";
									
								}else {
									$accountStatusIcon = "activate.png";
									$statusTitle = "Activate The Notification";
									$link = "admin/interests/updateStatus/AdminNotification/".$id."/1";
									
									}
							?>
							<a id="<?= $id; ?>"  href="<?= SITE_PATH.$link; ?>" <?php if( $notification['AdminNotification']['status'] == 1 ) { ?> onclick="return confirm('Are you sure want Deactivate this Notification Type?');" <?php } else { ?> onclick="return confirm('Are you sure want Activate this Notification Type?');"<?php } ?> >
							<img src= "<?= SITE_PATH ?>img/admin/<?= $accountStatusIcon ?>" title="<?= $statusTitle ?>" />
							</a>
							
							</td>
					</tr>
					<?php $counter++; } ?>
				</table>
			</div>
			<?php echo $this->Element('admin/pagination'); }  else{ ?>
				<div style="text-align:center; color:#FF0000;">!! No Interest found !!</div>
		<?php } ?>
		</div>	
	<div class="clr"></div>
