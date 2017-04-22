<div class="dashmidMain">			
			<div class="dashRight">
				<div class="dashMid">
					<div class="clr">&nbsp;</div>
			<?= $this->Session->flash();?>
	<h3>Cms Pages List</h3>
	</br>
	<!--<div class="transFilt">
	<?= $this->Form->create('CmsPage'); ?>
       	<div class="transFilt-L" >
          
            <?= $this->Form->text('CmsPage.page_name', array('class' => 'testInp', 'label' => false, 'placeholder'=>'Search By Page Name','required' => false)); ?>
        </div>
		
		<div class="transFilt-R">
								<?= $this->Form->submit('Search', array('div'=>false, 'label'=>false, 'class'=>'submitBtn'));?>
							</div>
      
        <?= $this->Form->end(); ?>
		
		</div> -->
    <div class="clr">&nbsp;</div>

	  <?php if (! empty($pages_list)){?>
		<div class="appoiTable2">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							  <tr>
							
								<th width="10%" class="pl">Sr.no.</th>
							
								<th width="40%"><?= $this->Paginator->sort("page_name",__("Link Name")); ?></th>
								<th width="40%"><?= $this->Paginator->sort("page_name",__("Page Name")); ?></th>
								<th width="20%"><?= $this->Paginator->sort("modified",__("Last Modified")); ?></th>
							
								<th width="20%">Action</th>
							  </tr>
							
							  <?php $counter = 0;
							  foreach($pages_list as $page) { 
							  	if($counter%2 == 0)
									$tableClass = 'p1';
								else
									$tableClass = 'odd';
							  ?>
							  <tr class="<?= $tableClass;?>">
								
								<td align="center"> <?= $counter+1; ?></td>

								<td><a href="http://<?= $page['CmsPage']['title']; ?>"><?= $page['CmsPage']['title']; ?></a></td>
								
								<td><?= $page['CmsPage']['page_name']; ?></td>
								<td><span><?= date('M d, Y' , strtotime($page['CmsPage']['modified'])); ?></span></td>
								
								<td>
									<?php $id = $page['CmsPage']['id']; ?>
								
									<a href="<?= SITE_PATH ?>admin/cms/editPage/<?= $id; ?>">
									<img src= "<?= SITE_PATH ?>img/admin/edit-icon.png" />
									</a>
								</td>
						
							  </tr>
							  
							  <?php $counter++; } ?>
						</table>
		</div>
						
		<?= $this->Element('admin/pagination'); }  else{ ?>
		<div style="text-align:center; color:#FF0000;">!! No Page found !!</div>
	<?php } ?>
		
		
		<div class="clear"></div>
	</fieldset>
</div>
