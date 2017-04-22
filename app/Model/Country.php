<?php
App::uses('AppModel', 'Model');
class Country extends AppModel {
	 public $useTable = 'country';
	 public $actsAs = array('Containable');
     var $primaryKey = 'id'; 
  }
?>
