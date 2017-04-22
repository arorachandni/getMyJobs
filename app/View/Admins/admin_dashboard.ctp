<div class="dashmidMain">			
	<div class="dashRight">
		<div class="dashMid">
			<?php echo $this->Session->flash();?>
	<br />
		<div class="transFilt">
	        <div class="dashImage" >
	         <?php echo $this->Html->link($this->Html->image("admin/users.jpg", array("alt" => "")),array('controller'=>'users','action' => 'user_list','admin'=>true), array('escape' => false)); ?>
	        	
			</div>
			<div class="dashImage">
	        	<?php echo $this->Html->link($this->Html->image("admin/cms1.jpg", array("alt" => "")),array('controller'=>'cms','action' => 'pages','admin'=>true), array('escape' => false)); ?>
				
			</div>
		</div>
	
    <div class="clr">&nbsp;</div>
	
   </div>
</div>
</div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.4.6/socket.io.js'></script>
  <script src="http://code.jquery.com/jquery-1.11.1.js"></script>
<script>
  var socket = io('http://localhost:8083');
    socket.connect();
    socket.emit('message', $('#m').val());
    $('#m').val('');
    return false;

</script>