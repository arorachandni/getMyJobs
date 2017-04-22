
<script type="text/javascript">	
	var jqr = jQuery.noConflict(); 
	jqr(document).ready(function(){
		jqr("#EventAdminEditEventForm").validationEngine()	
	});	
	
</script>
<script type="text/javascript">
jqr(function () {
         jqr('.datepicker').datepicker({
             changeMonth: true,
              changeYear: true,
              dateFormat: "yy-mm-dd",
              beforeShow: function (textbox, instance) {
              instance.dpDiv.css({
           });
          }
        });
        jqr('.myPicker').timepicker(
             {
             'step': '05',
             'minTime': '12:05am',
             'timeFormat': 'h:i a',
             }
         );
		jqr('.myTimepicker').on('changeTime', function() {
             jqr('.mySpan').text($(this).val());
         });
	jqr('#subreg').on('click',function(){
     	if(jqr("input:checked").length == 0){
         var $messageDiv = jqr('#openmessage'); // get the reference of the div
          $messageDiv.show().html('Opening day is required! Please select atleat one.'); // show and set the message
         jqr('#openmessage').focus() ;
         setTimeout(function(){ $messageDiv.hide().html('');}, 10000);
         return false;
     }else{

          //jqr('#BrandOwnerCreatestoreForm').submit();
     }
});
});
 
</script>
<style>
      
        #map { height: 500px; }
    </style>
<div class="dashmidMain">			
			<div class="dashRight">
				<div class="dashMid">
					<div class="clr">&nbsp;</div>
			<?php echo $this->Session->flash();?>
<div class="">Edit Event</div>			
	<?php echo $this->Form->create('Event', array('type'=> 'file'));
	echo $this->Form->hidden('Event.id');
	
	?>	
		
	<div class="dashfrmBx">
			
		  <div class="dashinp-L">
			<span>Event Title:</span>
			<?php echo $this->Form->input('Event.event_title', array('div'=>false, 'label'=>false, 'type'=>'text','class'=>'dashInpfld validate[required]', 'maxlength'=>100, 'required'=>false)); ?>
		</div>
		<br/>
        <div class="dashinp-L">
		<span>Description :</span>
			<?php echo $this->Form->input('Event.description', array('div'=>false, 'label'=>false, 'type'=>'textarea','class'=>'dashInpfld validate[required]', 'maxlength'=>50, 'required'=>false)); ?>
		</div>
		<br/>
		<div class="dashinp-L">
			<span>Event Title:</span>
			<?php echo $this->Form->input('Event.location', array('div'=>false, 'label'=>false, 'type'=>'text','class'=>'dashInpfld validate[required]', 'maxlength'=>100, 'required'=>false)); ?>
		</div>
		<br/>
		 <div class="dashinp-L">
		<span>Event Date:</span>
			<?php echo $this->Form->input('Event.eventdate', array('div'=>false, 'label'=>false, 'type'=>'text','class'=>'dashInpfld validate[required] datepicker', 'maxlength'=>100, 'required'=>false)); ?>
			<?php
                                    // $var = htmlentities(__('Select End Date', true), ENT_COMPAT, "ISO8859-1");
                                  //   echo $this->Form->input('Event.eventdate', array('div'=>false, 'label'=>false, 'type'=>'text','class'=>'addCatInp calander datepicker', 'id'=>'datepicker','error'=>false, 'required'=>false,'placeholder'=> html_entity_decode($var)));
                                   //  echo $this->Form->error('Event.eventdate');
                                 ?>
		</div>
		<br/>
		 <div class="dashinp-L" >
		<span>Event End Date:</span>
			<?php echo $this->Form->input('Event.endeventdate', array('div'=>false, 'label'=>false, 'type'=>'text','class'=>'dashInpfld validate[required] datepicker', 'maxlength'=>100, 'required'=>false)); ?>
			<?php
                                    // $var = htmlentities(__('Select End Date', true), ENT_COMPAT, "ISO8859-1");
                                  //   echo $this->Form->input('Event.eventdate', array('div'=>false, 'label'=>false, 'type'=>'text','class'=>'addCatInp calander datepicker', 'id'=>'datepicker','error'=>false, 'required'=>false,'placeholder'=> html_entity_decode($var)));
                                   //  echo $this->Form->error('Event.eventdate');
                                 ?>
		</div>
		<br/>
		 <div class="dashinp-L">
		<span>Event Start Time:</span>
			<?php echo $this->Form->input('Event.start_at', array('div'=>false, 'label'=>false, 'type'=>'text','value'=> $start_at,'class'=>'dashInpfld timepicker myPicker validate[required]', 'maxlength'=>100, 'required'=>false)); 
			?>
		</div>
		<br/>
		 <div class="dashinp-L">
		<span>Event End Time:</span>
			<?php echo $this->Form->input('Event.end_at', array('div'=>false, 'label'=>false, 'type'=>'text','value'=> $end_at,'class'=>'dashInpfld timepicker myPicker validate[required]', 'maxlength'=>100, 'required'=>false)); 
			?>
		</div>
		<br/>
		 <div class="dashinp-L" >
		<span>Event Location:</span>
		<div style="display:none;">
			<?php echo $this->Form->input('Event.lat', array('div'=>false, 'label'=>false, 'type'=>'text','class'=>'dashInpfld validate[required]', 'maxlength'=>100, 'required'=>false)); ?>
			</br>
			<?php echo $this->Form->input('Event.lng', array('div'=>false, 'label'=>false, 'type'=>'text','class'=>'dashInpfld validate[required]', 'maxlength'=>100, 'required'=>false)); ?>
		</div>
			<div id='geocoder-container'></div>
			<div id='map'></div>
			<pre id='features' class='coordinates' style="display:none;"></pre>
			
		</div>
		<br/>
		
		 <div class="dashinp-L">
		<span>Event Type:</span>
			<?php 
			$options = array(
    		'1' => 'Private',
    		'0' => 'Public'
			);

			$attributes = array('div'=>false, 'label'=>false, 'type'=>'file','class'=>'validate[required] fileupload', 'required'=>false);
			echo $this->Form->radio('Event.eventype', $options, $attributes); ?>
		</div>
		<br/>
        <div class="dashinp-L">
		<span>Image :</span>
			<?php 
			
			echo $this->Form->input('Upload.id',array('div'=>false,'type'=>'hidden','value'=>$eventdata['Event']['upload_id']));
			echo $this->Form->input('url',array('div'=>false,'type'=>'hidden','value'=>$eventdata['Event']['banner']));
			echo $this->Form->input('Upload.url', array('div'=>false, 'label'=>false, 'type'=>'file','class'=>'fileupload', 'required'=>false)); ?> 
	    <div class="clr"></div>		
		<div class="dvPreview"><?php  
		
		if(!empty($eventdata['Event']['banner'])!='' || $eventdata['Event']['banner'] !=null)  {
		   echo $this->Html->image(SITE_PATH.'img/eventbanner/'.$eventdata['Event']['banner'], array('alt' => 'UserProfile', 'border' => '0', 'width' => '100', 'height' => '100')); 
		   }
		   else {
		   echo $this->Html->image(SITE_PATH.'img/no_image_thumb.gif', array('alt' => 'post', 'border' => '0', 'width' => '100', 'height' => '100'));
		   }
		?>
		
		</div>
		 </br>
		
        <br/>
		  
        <div class="norbtnmain">
			<?php echo $this->Form->submit('Save', array('div'=>false, 'label'=>false, 'class'=>'submitBtn'));?>
		</div>
		<div class="clr"></div>
	</div>
				</div>
			</div>
			<?php echo $this->Form->end();?>
			<div class="clearfix"></div>
	</div>
<script>
mapboxgl.accessToken = 'pk.eyJ1IjoidmlyaW5kcmFzaW5naCIsImEiOiJjaXNkNmM2a2swMDN2MnNudjdvNTRwM3QwIn0.ecjgUx1ZAUeZs6s_qbyMuA';
var isDragging;
var isCursorOverPoint;
var coordinates = document.getElementById('coordinates');
var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v9',
    center: [0, 0],
    zoom: 2
});
var geocoder = new mapboxgl.Geocoder({
    container: 'geocoder-container' // Optional. Specify a unique container for the control to be added to.
});
map.addControl(geocoder);
var geocode=new mapboxgl.Geocoder();
var canvas = map.getCanvasContainer();
var geojson = {
    "type": "FeatureCollection",
    "features": [{
        "type": "Feature",
        "geometry": {
            "type": "Point",
            "coordinates": [0, 0]
        }
    }]
};
function mouseDown() {
    if (!isCursorOverPoint) return;

    isDragging = true;
		
    // Set a cursor indicator
    canvas.style.cursor = 'grab';

    // Mouse events
   map.on('mousemove', onMove);
    map.on('mouseup', onUp);
}
function onMove(e) { 
    if (!isDragging) return;
    var coords = e.lngLat;
	//console.log(coords);
    // Set a UI indicator for dragging.
    canvas.style.cursor = 'grabbing';
    document.getElementById('EventLat').value=coords.lat;
    document.getElementById('EventLng').value=coords.lng;
    geojson.features[0].geometry.coordinates = [coords.lng, coords.lat];
  	map.getSource('point').setData(geojson);
}
function onUp(e) { 
    if (!isDragging) return;
    var coords = e.lngLat;

 	console.log(e.result);
    // Print the coordinates of where the point had
    // finished being dragged to on the map.
    var features = map.queryRenderedFeatures(e.point);
    //console.log(features[1].properties);
    document.getElementById('features').innerHTML = JSON.stringify(features, null, 2);
    
     geocoder.on('result', function(ev) {
	 console.log(ev.result);
        
    });
      $.ajax({
	   type: 'GET',
	   async:false,
	   url:'http://maps.googleapis.com/maps/api/geocode/json?latlng='+coords.lat+','+coords.lng+'&sensor=true',
	   success: function(response){ 
	   console.log(response.results[0].formatted_address);
	var gname='';
	if(typeof response.results[0].formatted_address===undefined) {
		gname='';
	} else {
		gname=response.results[0].formatted_address;
	}
		   
		  $("#geocoder-container input").val(gname);
		}, 
		error: function(e) {
		alert("error");
		   $.mobile.loading("hide");  
	   }
    });
    geojson.features[0].geometry.coordinates = [coords.lng, coords.lat];
  	map.getSource('point').setData(geojson);
  	isDragging = false;
    coordinates.style.display = 'block';
    coordinates.innerHTML = 'Longitude: ' + coords.lng + '<br />Latitude: ' + coords.lat;
    canvas.style.cursor = '';
    isDragging = false;
}

map.on('load', function() {

    // Add a single point to the map
    map.addSource('point', {
        "type": "geojson",
        "data": geojson
    });

    map.addLayer({
        "id": "point",
        "type": "circle",
        "source": "point",
        "paint": {
            "circle-radius": 10,
            "circle-color": "#3887be"
        }
    });
	// If a feature is found on map movement,
    // set a flag to permit a mousedown events.
    map.on('mousemove', function(e) {
        var features = map.queryRenderedFeatures(e.point, { layers: ['point'] });

        // Change point and cursor style as a UI indicator
        // and set a flag to enable other mouse events.
        if (features.length) {
            map.setPaintProperty('point', 'circle-color', '#3bb2d0');
            canvas.style.cursor = 'move';
            isCursorOverPoint = true;
            map.dragPan.disable();
        } else {
            map.setPaintProperty('point', 'circle-color', '#3887be');
            canvas.style.cursor = '';
            isCursorOverPoint = false;
            map.dragPan.enable();
        }
    });
	 geocoder.on('result', function(ev) {
	 console.log(ev.result);
        map.getSource('point').setData(ev.result.geometry);
    });
    // Set `true` to dispatch the event before other functions call it. This
    // is necessary for disabling the default map dragging behaviour.
    map.on('mousedown', mouseDown, true);
});
</script>