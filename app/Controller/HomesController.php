<?php
class HomesController extends AppController {

	public $name = 'Homes';
	public $helpers = array('Html', 'Form', 'Session', 'Text');
	public $components = array();

	function beforeFilter() {
	 	parent::beforeFilter();
	 	if (!empty($this->Auth)) {
			$this->Auth->allowedActions = array('index');
		}	
	}
    
	
	/* FUNCTION FOR HOME PAGE
	 CREATED ON - 20June 2016 */

    public function index() {
	    $this->layout = 'home';			
		       
    }
	
}
?>