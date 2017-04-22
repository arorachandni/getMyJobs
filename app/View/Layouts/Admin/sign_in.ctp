<!DOCTYPE html>
	<html class="k-ff k-ff26" dir="ltr" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
		
		<meta charset="utf-8">
		<link rel="shortcut icon" href="#">
		<meta name="keywords" content="MeatScape.com.">
		<meta name="description" content="MeatScape.com">
		<title>Myjobs::Admin Panel </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <?php
            echo $this->Html->meta('icon');
            echo $this->Html->css('admin/stylesheet');
			echo $this->Html->css('admin/tablet');
			echo $this->Html->css('admin/mobile');
            
            echo $this->Html->script('admin/jquery');
            echo $this->Html->script('admin/function');			
            

            /* ----- Code for Validation Engine Start ----- */
            echo $this->Html->css('validation/validationEngine.jquery');
            echo $this->Html->css('validation/template');
            echo $this->Html->css('validation/customMessages.css');
            echo $this->Html->script('validation/jquery-1.7.2.min');
            echo $this->Html->script('validation/languages/jquery.validationEngine-en');
            echo $this->Html->script('validation/jquery.validationEngine');
            /* ----- Code for Validation Engine End ------ */
        ?>
    </head>
    <body>
    <div class="main-cont">
	 <div class="dashloginBg" style='background-color:#9F4576;'>
	  <div class="dash-loginBx">
		<div class="dashadmin-logo"><a href="#"><?php //echo $this->Html->image('admin/logo.png', array('alt' => false, 'style'=> 'width:100px;margin-top:10px;'));?></a></div>
		
        <!-- MAIN CONTAINER START -->
        <div class="loginFrmBx">
            <!-- LOGIN BOX CONTAINER START -->
            <?php echo $content_for_layout; ?>
            <!-- LOGIN BOX CONTAINER END -->
        </div>
	</div>
 </div>
</div>
        <!-- MAIN CONTAINER END -->
    </body>
</html>
