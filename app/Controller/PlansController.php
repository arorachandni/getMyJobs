<?php
class PlansController extends AppController {

	public $components = array('My','Resize');
	public $uses = array('User','UserFeedback','Feature');

	function beforeFilter() {
	 	parent::beforeFilter();
		if (!empty($this->Auth)) {				
			
		}
	}

	
	/* FUNCTION FOR TO SHOW MEETSCAPE PLAN
	 CREATED ON - 28th Oct 2015
	 FILE : view/plans/admin_meetscape_plan.ctp */
	public function admin_index(){
		$this->layout = 'Admin/default';
		$this->loadModel('MinutesPlan');	
		$data = $this->MinutesPlan->find('all'); 
		$this->paginate = array('order' => 'MinutesPlan.id ASC', 'limit' => '20');
		$this->set('plans', $this->paginate('MinutesPlan'));	 
	}

	/* FUNCTION FOR EDIT THE MEETSCAPE PLAN
	 CREATED ON - 8June 2016
	 FILE : view/plans/admin_edit_plan.ctp */
	public function admin_edit_plan($id =null){
		$this->layout = 'Admin/default';
		$this->loadModel('MinutesPlan');

		$plan = $this->MinutesPlan->find('first', array(
						'conditions'=> array('id'=> $id)
						));

		if(!empty($this->request->data)){
			$this->MinutesPlan->save($this->request->data);
			$this->Session->setFlash(__('Your Plan has been Changed! ', true), 'message', array('class' => 'message-green'));
			$this->redirect(array('action'=> 'index', 'admin' => true));

		}else{
			$this->request->data = $plan;
		}
	}
    
	/* FUNCTION FOR EDIT THE PLAN
	 CREATED ON - 8June 2016
	 FILE : view/plans/admin_edit_plan.ctp */
	public function admin_add_plan($id =null){
		$this->layout = 'Admin/default';
		$this->loadModel('MinutesPlan');

		if(!empty($this->request->data)){
			$this->MinutesPlan->save($this->request->data);
			$this->Session->setFlash(__('Your Plan has added ', true), 'message', array('class' => 'message-green'));
			$this->redirect(array('action'=> 'index', 'admin' => true));

		}
	}
	
	/* FUNCTION TO SHOW THE UPGRADED FEATURES 
	 CREATED ON - 19th NOV 2015
	 FILE : view/plans/admin_features.ctp */
	function admin_features(){
		$this->layout = 'Admin/default';
		$this->paginate = array('limit' => '20');
		$this->set('features', $this->paginate('Feature'));	 
	}

	/* FUNCTION FOR ADD THE FEATURE
	 CREATED ON - 19th NOV 2015
	 FILE : view/plans/admin_add_feature.ctp */
	function admin_addFeature(){
		$this->layout = 'Admin/default';
		if(!empty($this->data)){
			$this->Feature->save($this->data);
			$this->Session->setFlash(__('Your Feature has been Added! ', true), 'message', array('class' => 'message-green'));
			$this->redirect(array('action'=> 'features', 'admin' => true));
		}		
	}

	/* FUNCTION FOR EDIT THE FEATURE
	 CREATED ON - 19th NOV 2015
	 FILE : view/interests/admin_edit_feature.ctp */
	public function admin_editFeature($id =null){
		$this->layout = 'Admin/default';
		$feature = $this->Feature->find('first', array(
						'conditions'=> array('Feature.id'=> $id)
						));

		if(!empty($this->request->data)){
			$this->Feature->save($this->request->data);
			$this->Session->setFlash(__('Your feature has been Changed! ', true), 'message', array('class' => 'message-green'));
			$this->redirect(array('action'=> 'features', 'admin' => true));

		}else{
			$this->request->data = $feature;
		}
	}

}
?>