<?php
App::uses('AppModel', 'Model');
class CmsPage extends AppModel {
   public $actsAs = array('Containable');
   var $primaryKey = 'id'; 
    
   /* public $belongsTo = array(
		 'User'=>array(
		  'className'=>'User',
		  'foreignKey'=>'user_id'
		 ),
		 'Upload'=>array(
		  'className'=>'Upload',
		  'foreignKey'=>'upload_id'
		 )
	);  */
  }
?>
