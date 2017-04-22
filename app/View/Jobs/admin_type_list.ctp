<div class="dashmidMain">			
	<div class="dashRight">
		<div class="dashMid">
					<div class="clr">&nbsp;</div>
			<?php echo $this->Session->flash();?>
	<h3>Hunt Type Lists (Total Hunt : <?php echo $total_hunt;?>)</h3>
	<br />
	<div class="transFilt">
	<?php echo $this->Form->create('User', array('action'=>'admin_type_list')); ?>
       	<div class="transFilt-L" >
          
            <?php echo $this->Form->text('Hunt.hunt_title', array('class' => 'testInp', 'label' => false, 'placeholder'=>'Search By Title','required' => false)); ?>
        </div>
		
		<div class="transFilt-R">
			<?php echo $this->Form->submit('Search', array('div'=>false, 'label'=>false, 'class'=>'submitBtn'));?>
		</div>
      
        <?php echo $this->Form->end(); ?>
		
		</div>
    <div class="clr">&nbsp;</div>

	  <?php if (! empty($type_list)){?>
		<div class="appoiTable2">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<th width="10%" class="pl">Sr.no.</th>
					<th width="15%"><?php echo $this->Paginator->sort("Hunt Title",__("hunt_title")); ?></th>
					
					
					<th width="15%"><?php echo $this->Paginator->sort("status",__("Status")); ?></th>

					<th width="15%"><?php echo $this->Paginator->sort("created",__("Date")); ?></th>
					<th width="20%">Action</th>
				  </tr>
				
				  <?php $counter = 0;
				  foreach($type_list as $huntData) { 
				  	if($counter%2 == 0)
						$tableClass = 'p1';
					else
						$tableClass = 'odd';
				  ?>
				  <tr class="<?php echo $tableClass;?>">
				  	
					<td align="center"> <?php echo $counter+1; ?></td>

					<td><?php echo $huntData['HuntType']['title']; ?></td>

				
					<td><?php if($huntData['HuntType']['status'] == 1 ) { echo "Active"; } else { echo "Inactive"; } ?></td>

					

					<td><span><?php echo date('M d, Y' , strtotime($huntData['HuntType']['created'])); ?></span></td>
					<td>

					<?php $id = $huntData['HuntType']['id']; 
					$model = 'HuntType';
					?>
				

					<?php echo  $this->Html->image("admin/edit-icon.png", array("alt" => "",'url' => array('controller' => 'users', 'action' => 'edit_type', 'admin' => true, $id)));?>
					
					
					<?php echo $this->Form->postLink(
							$this->Html->tag( 'img', '', array( 'src' => SITE_PATH.'img/admin/delete-icon.png')),
								array("controller"=>"users","action"=>"delete/".$id.'/'.$model,"admin"=>true),
								array("confirm"=>"Do You Really Want to Delete this Hunt type?","escape" => false,'title'=>'Delete')
						);
					?>
				  </tr>
				  
				  <?php $counter++; } ?>
			</table>
		</div>
						
		<?php echo $this->Element('admin/pagination'); }  else{ ?>
		<div style="text-align:center; color:#FF0000;">!! No Hunt found !!</div>
	<?php } ?>
		
		
		<div class="clear"></div>

</div>
