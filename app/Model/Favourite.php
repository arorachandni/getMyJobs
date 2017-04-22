<?php
App::uses('AppModel', 'Model');
class Favourite extends AppModel {
   public $actsAs = array('Containable');
   var $primaryKey = 'id'; 
    
     
  }
?>
