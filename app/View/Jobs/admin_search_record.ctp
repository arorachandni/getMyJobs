<!-- for fancybox Start -->
<?php
	echo $this->Html->Css('fancyboxcss/jquery.fancybox-1.3.4');
	echo $this->Html->Script('fancyboxjs/jquery.fancybox-1.3.4.pack.js');
?>
<script type="text/javascript">
	$(document).ready(function(){
		//$("a.fancyclass").fancybox();
	});
</script>
<script>
var allVals = [];

        $(function () {
           $('#mydiv input').click(function(){
			
			$(this).each(function(){
			if(this.checked){
			  //alert(1)
			  allVals.push($(this).val());
				//console.log(allVals);
				 $('#txtValue').val(allVals)
			}
			else{
			   allVals.pop($(this).val());
				//console.log(allVals);
			  $('#txtValue').val(allVals)
			}
			});
			});
        });
</script>
<!-- for fancybox End -->

<div class="dashmidMain">			
			<div class="dashRight">
				<div class="dashMid">
					<div class="clr">&nbsp;</div>
	<!-- DISPLAY MESSAGE START -->
	<?php echo $this->Session->flash();?>
	<!-- DISPLAY MESSAGE END -->
	<h3>Manage Search Records</h3>
	</br>
	<!--<div class="transFilt">
	<?php echo $this->Form->create(); ?>
							<div class="transFilt-L">
							<?php echo $this->Form->text('SearchResult.first_name', array('class' => 'testInp', 'placeholder'=>'Search By Name', 'label' => false, 'required' => false)); ?>
								
							</div>
							<div class="transFilt-R">
								 <?php echo $this->Form->text('SearchResult.email', array('class' => 'testInp', 'placeholder'=>'Search By Email', 'label' => false, 'required' => false)); ?>
							</div>
							<div class="transFilt-R">
								<?php echo $this->Form->submit('Search', array('div'=>false, 'label'=>false, 'class'=>'submitBtn'));?>
							</div>
							<div class="clr"></div>
							<?php echo $this->Form->end(); ?>
	 </div>--->
        
	
	
	 <div>
	<?php 
        echo $this->Form->create('Page',array('action'=>'record_export_csv'));
      ?>
	  <?php echo $this->Form->input('SearchResult.hid', array('div'=>false, 'label'=>false, 'type'=>'hidden', 'id'=>'txtValue', 'error'=>false)); ?>
	  
		<?php echo $this->Form->submit('export', array('div'=>false, 'label'=>false,  'class'=>'exportBtn'));?>		
	
						<?php echo $this->Form->end(); ?>	
						
						</div>
 		<div class="dashfrmBx">
		
		<div class="appoiTable2">
		
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
							  <tr>
					<th width="5%" class="pl"></th>
							
								<th width="10%" class="pl"><!--<input type = "checkbox" name= "mul_chk">-->Sr.no.</th>
								<!--<th width="10%">Name</th>
								<th width="20%">Email</th>-->
								<th width="30%">Destination</th>
								<th width="20%">Start-End</th>
								<th width="10%">Total Guest</th>
								<th width="20%">Searched On</th>
								<th width="30%">View</th>
                                								
							  </tr>
							  <?php if (! empty($viewListing)){?>
						<?php
							$counter = 0;
							foreach($viewListing as $listing){ //pr($listing);die;
								if($counter%2 == 0)
									$tableClass = 'p1';
								else
									$tableClass = 'odd';
			?>
							
							<tr class="<?php echo $tableClass;?>">
						<td><div id="mydiv"><?php echo $this->Form->input('SearchResult.chk', array('div'=>false, 'type'=>'checkbox', 'id'=>'chk', 'value'=> $listing['SearchResult']['id'], 'label'=>false, 'class'=>'checkboxInpt','error'=>false, 'required'=>false)); 
		?> </div></td>
			    <td align="center"><?php echo $counter+1; ?></td>
								<!--<td><span><?php echo $listing['User']['first_name']; ?></span></td>
								<td><?php echo $listing['User']['email'];?></td>--> 
								<td><?php echo $listing['SearchResult']['keyword'] ?></td>
								<td><?php echo $listing['SearchResult']['check_in'].'-'.$listing['SearchResult']['check_out'] ?></td>
							
								<td><?php echo $listing['SearchResult']['guest'] ?></td>
			<td><?php echo $listing['SearchResult']['created'] ?></td>					
			<td><a href=<?php echo SITE_PATH.'admin/pages/view_record/'.$listing['SearchResult']['id']?> class="yellow">View</a></td>					
							  </tr>
							  
							  <?php $counter++; } }?>
							</table>
						</div>
		
		</div>	
	<div class="clr"></div>
	
<style>
.exportBtn{
Float:right; background:#1597a6 ; padding:5px 10px; border-radius:3px; color:#fff; text-transform:uppercase; margin-top:-15px; display:inline-block;
border:0;

}

</style>