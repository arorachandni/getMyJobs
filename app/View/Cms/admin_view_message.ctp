<div class="dashmidMain">			
			<div class="dashRight">
				<div class="dashMid">
					<div class="clr">&nbsp;</div>
	<h3>Contact Details</h3>
	 <?= $this->Html->link('Back', 'javascript://', array('onclick'=>' window.history.back();','class' => 'addevent fr')); ?>
	  <div style="clear:both;"></div>
	<div class="dashfrmBx">
	<fieldset>
	  
		<div class="fielddiv">
			<span class="titleStart">Name :</span>
			<strong><?= $result['Contact']['name'];?></strong>
		</div></br>
		<div class="clear"></div>

       <div class="fielddiv">
			<span class="titleStart">Email :</span>
			<strong><?= $result['Contact']['email'];?></strong>
		</div></br>

		<div class="fielddiv">
			<span class="titleStart" >Subject :</span>
			<strong><?= $result['Contact']['subject'];?></strong>
		</div></br>

		<div class="fielddiv">
			<span class="titleStart">Message :</span>
			<strong><?= $result['Contact']['message'];?></strong>
		</div></br>

		<div class="fielddiv">
			<span class="titleStart" >Created :</span>
			<strong><?= date('M d, Y h:i' ,strtotime($result['Contact']['created']));?></strong>
		</div></br>

		<div class="clear"></div>
		
		<div class="clear"></div>
	
		</div>
		<div class="clear"></div>
	</fieldset>
	</div>
  </div>
 </div>