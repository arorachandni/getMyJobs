<div class="dashmidMain">			
	<div class="dashRight">
		<div class="dashMid">
					<div class="clr">&nbsp;</div>
			<?php echo $this->Session->flash();?>
	<h3>Emails List (Total Email : <?php echo $total_user;?>)</h3>
	<br />
	
    <div class="clr">&nbsp;</div>

	  <?php if (! empty($user_list)){?>
		<div class="appoiTable2">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				   <tr>
					<th width="5%" class="pl">Sr.no.</th>
					<th width="10%"><?php echo $this->Paginator->sort("user_name",__("User Name")); ?></th>
					<th width="10%"><?php echo $this->Paginator->sort("email",__("Email")); ?></th>
					
				  </tr>
				
				  <?php
				  
				   $counter = 0;
				  foreach($user_list as $userData) { 
				  	if($counter%2 == 0)
						$tableClass = 'p1';
					else
						$tableClass = 'odd';
				  ?>
				  <tr class="<?php echo $tableClass;?>">
				  	
					<td align="center"> <?php echo (($page*$pagesize+$counter)-$pagesize)+1; ?></td>
                   
					<td><?php echo $userData['User']['username']; ?></td>
					
					<td><?php echo $userData['User']['email']; ?></td>
					
				  </tr>
				  
				  <?php $counter++; } ?>
			</table>
		</div>
						
		<?php echo $this->Element('admin/pagination'); }  else{ ?>
		<div style="text-align:center; color:#FF0000;">!! No User found !!</div>
	<?php } ?>
		
		
		<div class="clear"></div>

</div>
