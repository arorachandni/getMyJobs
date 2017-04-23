<!DOCTYPE html>
	<html class="k-ff k-ff26" dir="ltr" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
		
		<meta charset="utf-8">
		<link rel="shortcut icon" href="#">
		<meta name="keywords" content="Orber">
		<meta name="description" content="Orber">
		<title>Myjobs::Admin Panel </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
        <?php
            echo $this->Html->meta('icon');
            echo $this->Html->css('admin/stylesheet');
			echo $this->Html->css('admin/tablet');
			echo $this->Html->css('admin/mobile');
			echo $this->Html->css('admin/custom');
			
            echo $this->Html->script('admin/jquery');
            echo $this->Html->script('admin/function');
			/* ----- Code for Validation Engine Start ----- */
            echo $this->Html->css('validation/validationEngine.jquery');
            echo $this->Html->css('validation/template');
            echo $this->Html->css('validation/customMessages.css');
            
            echo $this->Html->css('admin/datepic.css');
            echo $this->Html->css('admin/jquery.timepicker.css');
			
            
            echo $this->Html->script('validation/jquery-1.7.2.min');
            echo $this->Html->script('validation/languages/jquery.validationEngine-en');
            echo $this->Html->script('validation/jquery.validationEngine');
            echo $this->Html->script('admin/datetimepicker/datepicker');
            echo $this->Html->script('admin/datetimepicker/jquery.timepicker');
			echo $this->Html->css('bootstrap/bootstrap.min');
			echo $this->Html->script('jquery/jquery.min');
			
			echo $this->Html->script('bootstrap/bootstrap.min');
			
			
            /* ----- Code for Validation Engine End ------ */
        ?>
        
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.23.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.23.0/mapbox-gl.css' rel='stylesheet' />
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v1.3.0/mapbox-gl-geocoder.js'></script>
<link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v1.3.0/mapbox-gl-geocoder.css' type='text/css' />
    
    </head>
    <body class="inerbackground">
        <!-- MAIN CONTAINER START -->
        <div class="main-cont">
		   <div class="dashCont">
            <!-- HEADER START -->
            <div class="dashMain">
			  <?php echo $this->Element('admin/admin_header'); ?>
		    </div>
            <!-- HEADER END -->
		<div class="dashmidMain">
                     <?php echo $this->Element('admin/left_navigation'); ?>
          
            <div class="dashRight">
			    <div class="dashMid">
               
             </div>
		</div>
                <!-- MAIN CONTENT START -->
                <?php echo $content_for_layout; ?>
                <!-- MAIN CONTENT END -->
           </div>
           
        </div>
	</div>
      <script type="text/javascript">
    $(document).ready(function(){
        $(".custom-select-flt").each(function(){
            $(this).wrap("<span class='select-wrapper-flt'></span>");
            $(this).after("<span class='holder-flt'></span>");
        });
        $(".custom-select-flt").change(function(){
            var selectedOption = $(this).find(":selected").text();
            $(this).next(".holder-flt").text(selectedOption);
        }).trigger('change');
    })
</script>
    </body>
</html>