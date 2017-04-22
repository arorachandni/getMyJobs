<div class="dashmidMain">			
	<div class="dashRight">
		<div class="dashMid">
					<div class="clr">&nbsp;</div>
			<?php echo $this->Session->flash();?>
	<h3>User Listing</h3>
	<br />
	 <?php if (! empty($users)){?>
		<div class="transFilt">
	        <div class="transFilt-R">
				<?php echo $this->Html->link('Export CSV',array('controller'=>'reports', 'action' => 'exportUser/1'),array('class' => 'submitBtn'));?>
			</div>
		</div>
	<?php } ?>
    <div class="clr">&nbsp;</div>

	  <?php if (! empty($users)){?>
		<div class="appoiTable2">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<th width="10%" class="pl">Sr.no.</th>
					<th width="20%"><?php echo $this->Paginator->sort("name",__("Full Name")); ?></th>
					
					<th width="20%"><?php echo $this->Paginator->sort("email",__("Email")); ?></th>
					
					<th width="20%"><?php echo $this->Paginator->sort("status",__("Status")); ?></th>

					<th width="15%"><?php echo $this->Paginator->sort("created",__("Date")); ?></th>
					<th width="20%">Action</th>
				  </tr>
				
				  <?php $counter = 0;
				  foreach($users as $userData) { 
				  	if($counter%2 == 0)
						$tableClass = 'p1';
					else
						$tableClass = 'odd';
				  ?>
				  <tr class="<?php echo $tableClass;?>">
				  	
					<td align="center"> <?php echo $counter+1; ?></td>

					<td><?php echo $userData['User']['fullname']; ?></td>
					<td><?php echo $userData['User']['email']; ?></td>

					<td><?php if($userData['User']['status'] == 1 ) { echo "Active"; } else { echo "Inactive"; } ?></td>
					<td><span><?php echo date('M d, Y' , strtotime($userData['User']['created'])); ?></span></td>
					<td>

					<?php $id = $userData['User']['id']; ?>
					<?php echo  $this->Html->image("admin/view-icon.png", array("alt" => "",'url' => array('controller' => 'users', 'action' => 'view_user', 'admin' => true, $id)));?>
				  </tr>
				  
				  <?php $counter++; } ?>
			</table>
		</div>
						
		<?php echo $this->Element('admin/pagination'); }  else{ ?>
		<div style="text-align:center; color:#FF0000;">!! No User found !!</div>
	<?php } ?>		
		<div class="clear"></div>

</div>
