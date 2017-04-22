<?php
App::uses('AppModel', 'Model');
class Attendee extends AppModel {
   public $actsAs = array('Containable');
   var $primaryKey = 'id';
  }
?>
