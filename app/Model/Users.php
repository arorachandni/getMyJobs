<?php
App::uses('AppModel', 'Model');
class Users extends AppModel {
   public $actsAs = array('Containable');
   var $primaryKey = 'id'; 
    
}
?>
