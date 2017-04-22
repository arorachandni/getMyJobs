<div class="dashmidMain">			
			<div class="dashRight">
				<div class="dashMid">
					<div class="clr">&nbsp;</div>
			<?= $this->Session->flash();?>
	<h3>Email Templates List</h3>
	</br>
	<div class="transFilt">
	<?= $this->Form->create('Mail'); ?>
       	<div class="transFilt-L" >
          
            <?= $this->Form->text('Mail.mail_name', array('class' => 'testInp', 'label' => false, 'placeholder'=>'Search By Template Name','required' => false)); ?>
        </div>
		
		<div class="transFilt-R">
								<?= $this->Form->submit('Search', array('div'=>false, 'label'=>false, 'class'=>'submitBtn'));?>
							</div>
      
        <?= $this->Form->end(); ?>
		
		</div>
    <div class="clr">&nbsp;</div>

	  <?php if (! empty($template_list)){?>
		<div class="appoiTable2">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							  <tr>
							
								<th width="10%" class="pl">Sr.no.</th>
							
								<th width="40%"><?= $this->Paginator->sort("email_title",__("Email Template Name")); ?></th>
							
								<th width="20%"><?= $this->Paginator->sort("modified",__("Last Modified")); ?></th>
							
								<th width="20%">Action</th>
							  </tr>
							
							  <?php $counter = 0;
							  foreach($template_list as $template) { 
							  	if($counter%2 == 0)
									$tableClass = 'p1';
								else
									$tableClass = 'odd';
							  ?>
							  <tr class="<?= $tableClass;?>">
								
								<td align="center"> <?= $counter+1; ?></td>

								<td><?= $template['Mail']['mail_title']; ?></td>
								<td><span><?= date('M d, Y' , strtotime($template['Mail']['modified'])); ?></span></td>
								
								<td>
									<?php $id = $template['Mail']['id']; ?>
								
									<a href="<?= SITE_PATH ?>admin/cms/editTemplate/<?= $id; ?>">
									<img src= "<?= SITE_PATH ?>img/admin/edit-icon.png" />
									</a>
								</td>
						
							  </tr>
							  
							  <?php $counter++; } ?>
						</table>
		</div>
						
		<?= $this->Element('admin/pagination'); }  else{ ?>
		<div style="text-align:center; color:#FF0000;">!! No User found !!</div>
	<?php } ?>
		
		
		<div class="clear"></div>
	</fieldset>
</div>
<style>
.appoiTable2 th a{
    background: #35c9ce none repeat scroll 0 0;
    color: #fff;
    font-size: 13px;
    padding: 15px 0;
    text-align: left;
    text-transform: uppercase;
}
</style>