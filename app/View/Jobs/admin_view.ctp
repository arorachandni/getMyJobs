<div class="dashmidMain">			
			<div class="dashRight">
				<div class="dashMid">
					<div class="clr">&nbsp;</div>
			<?php echo $this->Session->flash();?>
	<h3>User Details</h3>
	
		
		<div class="appoiTable2">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
							  <tr>
								<th width="16%" class="pl">Sr.no.</th>
								<th width="30%">name</th>
								<th width="18%">Date</th>
								<th width="18%">Time</th>
								<th width="18%">Status</th>
							  </tr>
							  <?php if (! empty($userAqq)){?>
							  <?php foreach($userAqq as $userData) { ?>
							  <tr>
								<td class="pl">1</td>
								<td><?php echo $userData['User']['full_name']; ?>Alex Backwith <br> <small><?php echo $userData['User']['city']; ?></small></td>
								<td><span>Nov 23, 2013</span></td>
								<td>3:00 PM</td>
								<td>Checked In</td>
							  </tr>
							  <tr class="odd">
								<td class="pl">2</td>
								<td>Jhon Methew <br> <small>New York</small></td>
								<td><span>Nov 23, 2013</span></td>
								<td>3:00 PM</td>
								<td>Checked In</td>
							  </tr>
							 <tr>
								<td class="pl">3</td>
								<td>Annie <br> <small>New York</small></td>
								<td><span>Nov 23, 2013</span></td>
								<td>3:00 PM</td>
								<td>Checked In</td>
							  </tr>
							  <tr class="odd">
								<td class="pl">4</td>
								<td>Eric Backwith <br> <small>New York</small></td>
								<td><span>Nov 23, 2013</span></td>
								<td>3:00 PM</td>
								<td>Checked In</td>
							  </tr>
							  <tr>
								<td class="pl">5</td>
								<td>Allison Freadman <br> <small>New York</small></td>
								<td><span>Nov 23, 2013</span></td>
								<td>3:00 PM</td>
								<td>Checked In</td>
							  </tr>
							 <tr class="odd">
								<td class="pl">6</td>
								<td>Johan <br> <small>New York</small></td>
								<td><span>Nov 23, 2013</span></td>
								<td>3:00 PM</td>
								<td>Checked In</td>
							  </tr>
							  <?php } }?>
							</table>
						</div>
		
		
		
		<div class="clear"></div>
	</fieldset>
</div>