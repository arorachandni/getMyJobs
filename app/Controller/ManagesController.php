<?php
class ManagesController extends AppController {

	public $name = 'Manages';
	public $helpers = array('Html', 'Form','GoogleMap');
	public $components = array('Api');

	function beforeFilter() {
	 	parent::beforeFilter();
	 		
	}
  
	public function admin_view_photo($id=NULL) {
	    $this->layout = 'Admin/default';
        $this->loadModel('Photo');		
		if (!empty($id)) {
			$conditions['conditions'] = array( "CompleteTask.id" => $id);
			$this->CompleteTask->recursive=-1;
			$photoArr = $this->CompleteTask->find( "first", $conditions );
			//pr($compDetails);die;
			$this->set(compact('photoArr'));
    	}          
    }
	
	public function admin_contact_list(){
	 $this->layout = 'Admin/default';
     $this->loadModel('Contact');
	 $conditions = array();
	
	 $totCont = $this->Contact->find('count',array('conditions'=>$conditions)); 
	
    $this->paginate = array('order' => 'Contact.id DESC', 'limit' => '20');
    $this->set('contact_list', $this->paginate('Contact', $conditions));
	$this->set(compact('totCont'));
	}
	
	public function admin_club_list(){
	 $this->layout = 'Admin/default';
   	 $this->loadModel('Club');
	 $conditions = array();
	
	 if (!empty($this->data['Club']['club_name'])) {
       $conditions['Club.club_name LIKE'] = '%'.trim($this->data['Club']['club_name']);
    }
	if (!empty($this->data['Club']['city'])) {
       $conditions['City.city_name LIKE'] = '%'.trim($this->data['Club']['city']);
    }
	if (!empty($this->data['Club']['state'])) {
       $conditions['State.state_name LIKE'] = '%'.trim($this->data['Club']['state']);
    }
	if (!empty($this->data['Club']['zip_code'])) {
       $conditions['Club.zip_code'] = $this->data['Club']['zip_code'];
    }
	
	$totCont = $this->Club->find('count',array('conditions'=>$conditions)); 
	$this->Club->unbindModel(array('hasMany' => array('FollowClub')), true);
	$this->paginate = array('order' => 'Club.id DESC', 'limit' => '20');
    $this->set('club_list', $this->paginate('Club', $conditions));
	//pr($this->paginate('Club', $conditions));die;
	$this->set(compact('totCont'));
	}

	
	public function admin_view_club($id=NULL) {
	    $this->layout = 'Admin/default';
        $this->loadModel('Club');		
		if (!empty($id)) {
			$conditions['conditions'] = array( "Club.id" => $id);
			$clubDetails = $this->Club->find( "first", $conditions);
			$this->set(compact('clubDetails'));
    	}          
    }
	
	/* FUNCTION FOR EDIT Club START
	 CREATED ON - 13 June 2016 */
	 public function admin_add_club() {
	    Controller::loadModel('Club');
	    
        if(!empty($this->request->data)){                          
		     //UPLOAD IMAGE
				$allowed_types = unserialize(ALLOWED_IMAGE_TYPES);
			    $continue = 'true';
			    $logoName = '';
			    if ($this->request->data['Club']['image']['name'] != '') {
				if (in_array($this->request->data['Club']['image']['type'], $allowed_types)) {
					
					$fileName = $this->My->uploadFile('../webroot/img/clubImg/', $this->request->data['Club']['image']);
					$imgpath = "../webroot/img/clubImg/".$fileName;
					$this->Resize->resize($imgpath, 250, 100);
					if ($fileName != '')
						$this->request->data['Club']['image'] = $fileName;
				}else {
					$this->Session->setFlash(__('Please Upload only *.gif, *.jpg, *.png image only!', true), 'message', array('class' => 'message-red'));
					$continue = 'false';
				}
			   }	
				//END OF CODE
			  if ($continue == 'true') {	
			
			if($this->Club->save($this->request->data)){
				$this->Session->setFlash(__('Logo Added Successfully!!', true), 'message', array('class'=>'message-green'));
				$this->redirect('/admin/manages/club_list');
			 }
			}else{
				$this->Session->setFlash(__('Please correct the errors', true), 'message', array('class'=>'message-red'));
			}
		}
    }
	
	/*************EDIT Club*****************/
	 public function admin_edit_club($id=NULL) {
	     Controller::loadModel('Club');
		 if(!empty($this->request->data)){
		     //UPLOAD IMAGE
				$allowed_types = unserialize(ALLOWED_IMAGE_TYPES);
			    $continue = 'true';
			    $logoName = '';
			    if ($this->request->data['Club']['image']['name'] != '') {
				if (in_array($this->request->data['Club']['image']['type'], $allowed_types)) {
					
					$fileName = $this->My->uploadFile('../webroot/img/clubImg/', $this->request->data['Club']['image']);
					$imgpath = "../webroot/img/clubImg/".$fileName;
					$this->Resize->resize($imgpath, 250, 100);
					if ($fileName != ''){
					    //UNLINK IMAGE FROM FOLDER
			            $this->My->unlinkImg($id, 'Club', 'clubImg');
					    //END OF CODE
						$this->request->data['Club']['image'] = $fileName;
						}
				}else {
					$this->Session->setFlash(__('Please Upload only *.gif, *.jpg, *.png image only!', true), 'message', array('class' => 'message-red'));
					$continue = 'false';
				}
			   }else{
                 unset($this->request->data['Club']['image']);
                }			   
				//END OF CODE
			  if ($continue == 'true') { 	
			  if($this->Club->save($this->request->data)){
				$this->Session->setFlash(__('Club Updated Successfully.', true), 'message', array('class'=>'message-green'));
				$this->redirect('/admin/manages/club_list');
			 }
			}else{
				$this->Session->setFlash(__('Please correct the errors', true), 'message', array('class'=>'message-red'));
			}
		}
		
		if (!empty($id)) {
			$this->data = $this->Club->findById($id);
    	}          
    }
	
	public function admin_category_list(){
	 $this->layout = 'Admin/default';
     $this->loadModel('Category');
	 $conditions = array();
	
	 $totCont = $this->Category->find('count',array('conditions'=>$conditions)); 
	
    $this->paginate = array('order' => 'Category.id DESC', 'limit' => '20');
    $this->set('category_list', $this->paginate('Category', $conditions));
	//pr($this->paginate('Category', $conditions));die;
	$this->set(compact('totCont'));
	}
	

	
	/* FUNCTION FOR EDIT Club START
	 CREATED ON - 13 June 2016 */
	 public function admin_add_category() {
	    Controller::loadModel('Category');
	    
        if(!empty($this->request->data)){                          
		   if($this->Category->save($this->request->data)){
				$this->Session->setFlash(__('Logo Added Successfully!!', true), 'message', array('class'=>'message-green'));
				$this->redirect('/admin/manages/category_list');
			 }else{
				$this->Session->setFlash(__('Please correct the errors', true), 'message', array('class'=>'message-red'));
			}
		}
    }
	
	/*************EDIT Club*****************/
	 public function admin_edit_category($id=NULL) {
	     Controller::loadModel('Category');
		 if(!empty($this->request->data)){
		      if($this->Category->save($this->request->data)){
				$this->Session->setFlash(__('Category Updated Successfully.', true), 'message', array('class'=>'message-green'));
				$this->redirect('/admin/manages/category_list');
			 }
		}
		if (!empty($id)) {
			$this->data = $this->Category->findById($id);
    	} 
		      
    }
	
	public function admin_view_contact($id=NULL) {
	    $this->layout = 'Admin/default';
        $this->loadModel('Contact');		
		if (!empty($id)) {
			$conditions['conditions'] = array( "Contact.id" => $id);
			$contactDetails = $this->Contact->find( "first", $conditions );
			$this->set(compact('contactDetails'));
    	}          
    }
	
	public function admin_state_list(){
	 $this->layout = 'Admin/default';
     $this->loadModel('State');
	 $conditions = array();
	
	 $totCont = $this->State->find('count',array('conditions'=>$conditions)); 
	
    $this->paginate = array('order' => 'State.state_name ASC', 'limit' => '20');
    $this->set('state_list', $this->paginate('State', $conditions));
	$this->set(compact('totCont'));
	}
	
	/* FUNCTION FOR ADD STATE
	 CREATED ON - 22 June 2016 */
	 public function admin_add_state() {
	    Controller::loadModel('State');
	    
        if(!empty($this->request->data)){                          
		   if($this->State->save($this->request->data)){
				$this->Session->setFlash(__('State Added Successfully!!', true), 'message', array('class'=>'message-green'));
				$this->redirect('/admin/manages/state_list');
			 }else{
				$this->Session->setFlash(__('Please correct the errors', true), 'message', array('class'=>'message-red'));
			}
		}
    }
	
	public function admin_city_list(){
	 $this->layout = 'Admin/default';
     $this->loadModel('City');
	 $conditions = array();
	
	 $totCont = $this->City->find('count',array('conditions'=>$conditions)); 
	
    $this->paginate = array('order' => 'City.city_name ASC', 'limit' => '20');
    $this->set('city_list', $this->paginate('City', $conditions));
	$this->set(compact('totCont'));
	}
	/* FUNCTION FOR ADD CITY
	 CREATED ON - 22 June 2016 */
	 public function admin_add_city() {
	    Controller::loadModel('State');
		Controller::loadModel('City');
	    if(!empty($this->request->data)){
		   $stateId = $this->request->data['City']['state_id'];
		   $conditions = array('State.id'=> $stateId);
		   $getCityArr = $this->State->find('first',array('conditions'=> $conditions));
		   $this->request->data['City']['state'] = $getCityArr['State']['state_name'];
		   if($this->City->save($this->request->data)){
				$this->Session->setFlash(__('City Added Successfully!!', true), 'message', array('class'=>'message-green'));
				$this->redirect('/admin/manages/city_list');
			 }else{
				$this->Session->setFlash(__('Please correct the errors', true), 'message', array('class'=>'message-red'));
			}
		}
    }
	
	public function admin_event_list($user_id=null){
	
	$type='';
	if(isset($this->request->named['page'])){
		$page=$this->request->named['page'];
	} else {
		$page=1;
	}
	$pagesize=10;
	 $this->layout = 'Admin/default';
     $this->loadModel('Event');
	 $conditions = array();
	 
	 if(!isset($this->request->query['type'])) {
	 	if (isset($user_id)) {
       		$conditions['Event.user_id'] = $user_id;
       	} else {
       	 if (!empty($this->data['Event']['event_title'])) {
       			$conditions['Event.event_title LIKE'] = '%'.trim($this->data['Event']['event_title']).'%';
    	 }
     		//$this->redirect('/admin/admins/dashboard');
     	}
	 	
	 } else  {
	 	$type=$this->request->query['type'];
		 $this->set('type',$type);
		if($type=="upcoming") {
			$conditions['Event.start_at  > ']=date('Y-m-d H:i:s');
		} else {
			$conditions['Event.start_at  < ']=date('Y-m-d H:i:s');
		}
	 }
     if (!empty($this->data['Event']['event_title'])) {
       $conditions['Event.event_title LIKE'] = '%'.trim($this->data['Event']['event_title']).'%';
     }
     if (!empty($user_id)) {
       $conditions['Event.user_id'] = $user_id;
       $this->set('user_id',$user_id);
     }
	 $this->Event->recursive = 1;
     $data = $this->Event->find('all',array('conditions'=>$conditions, 'fields'=> array('Event.id', 'Event.event_title')));
     $this->Event->bindMOdel(array('belongsTo' => array(
                'User' => array(
                    'className' => 'User',
                    'foreignKey' => 'user_id',
					'fields'=> array('User.username')
                )
            )
		));
	$total_event = count($data);
    $this->paginate = array('order' => 'Event.id DESC', 'limit' => $pagesize);
	
    $this->set('event_list', $this->paginate('Event', $conditions));
	$this->set(compact('total_event'));
	$this->set('page',$page);
	$this->set('pagesize',$pagesize);
	$this->set('type',$type);
	
	}
	
	/* FUNCTION FOR ADD EVENT START
	 CREATED ON - 16 June 2016 */
	 public function admin_add_event() {
	    Controller::loadModel('Event');
	    Controller::loadModel('Upload');
	   
	    $upload_array=array();
        if(!empty($this->request->data)){                           
		     //UPLOAD IMAGE
		   //  pr($this->request->data); die;
				$allowed_types = unserialize(ALLOWED_IMAGE_TYPES);
			    $continue = 'true';
			    $logoName = '';
			    if ($this->request->data['Upload']['url']['name'] != '') {
				if (in_array($this->request->data['Upload']['url']['type'], $allowed_types)) {
					
					$fileName = $this->My->uploadFile('../webroot/img/eventImg/', $this->request->data['Event']['url']);
					$imgpath = "../webroot/img/eventImg/".$fileName;
					$this->Resize->resize($imgpath, 250, 100);
					if ($fileName != '')
						$this->request->data['Upload']['url'] = $fileName;
				}else {
					$this->Session->setFlash(__('Please Upload only *.gif, *.jpg, *.png image only!', true), 'message', array('class' => 'message-red'));
					$continue = 'false';
				}
			   }	
				//END OF CODE
			  if ($continue == 'true') { 	
			
			if($this->Event->save($this->request->data)){
				$event_id = $this->Event->id;
				$upload_array['Upload']['event_id']=$event_id;
				$upload_array['Upload']['upload_for']='banner';
				$upload_array['Upload']['user_id']=1;
				$upload_array['Upload']['media_type']='image';
				$this->Upload->save($upload_array);
				$this->Session->setFlash(__('Event Saved Successfully!!', true), 'message', array('class'=>'message-green'));
				$this->redirect('/admin/manages/event_list');
			 }
			}else{
				$this->Session->setFlash(__('Please correct the errors', true), 'message', array('class'=>'message-red'));
			}
		}
    }
	
	/*************EDIT Event*****************/
	 public function admin_edit_event($id=NULL,$type=NULL) {
	     Controller::loadModel('Event');
	     Controller::loadModel('Upload');
	     $upload_array=array();
		 if(!empty($this->request->data)){
		     //UPLOAD IMAGE
				$allowed_types = unserialize(ALLOWED_IMAGE_TYPES);
			    $continue = 'true';
			    $logoName = '';
			    if ($this->request->data['Upload']['url']['name'] != '') {
				if (in_array($this->request->data['Upload']['url']['type'], $allowed_types)) {
					$fileName = $this->My->uploadFile('../webroot/img/eventbanner/', $this->request->data['Upload']['url']);
					$imgpath = "../webroot/img/eventbanner/".$fileName;
					//$this->Resize->resize($imgpath, 250, 100);
					if ($fileName != ''){
					    //UNLINK IMAGE FROM FOLDER
			            //$this->My->unlinkImg($id, 'Event', 'eventImg');
					    //END OF CODE
						$upload_array['Upload']['url'] = $fileName;
						}
				}else {
					$this->Session->setFlash(__('Please Upload only *.gif, *.jpg, *.png image only!', true), 'message', array('class' => 'message-red'));
					$continue = 'false';
				}
			   }else{
			   	 unset($this->request->data['Upload']['url']);
                 $upload_array['Upload']['url']=$this->request->data['Event']['url'];
                }			   
				//END OF CODE
				
			  $this->request->data['Event']['start_at']=$this->request->data['Event']['eventdate'].' '.date("H:i", strtotime($this->request->data['Event']['start_at']));
			  $this->request->data['Event']['end_at']=$this->request->data['Event']['endeventdate'].' '.date("H:i", strtotime($this->request->data['Event']['end_at']));
			//  pr($this->request->data); die;
			  if ($continue == 'true') { 	
			  if($this->Event->save($this->request->data)){
			   $upload_array['Upload']['id']=$this->request->data['Upload']['id'];
			  	$upload_array['Upload']['event_id']=$this->request->data['Event']['id'];
				$upload_array['Upload']['upload_for']='banner';
				$upload_array['Upload']['user_id']=57;
				$upload_array['Upload']['media_type']='image';
				//pr($upload_array); die;
				$this->Upload->save($upload_array);
				$this->Session->setFlash(__('Event Updated Successfully.', true), 'message', array('class'=>'message-green'));
				$this->redirect('/admin/manages/event_list/?type='.$type); exit;
			 }
			}else{
				$this->Session->setFlash(__('Please correct the errors', true), 'message', array('class'=>'message-red'));
			}
		}
		if (!empty($id)) {
			$this->data = $this->Event->findById($id);
			$this->set('start_at',date_format(new DateTime($this->data['Event']['start_at']), 'h:i a'));
			$this->set('end_at',date_format(new DateTime($this->data['Event']['end_at']), 'h:i a'));
			$event_data=$this->data;
			$event_data['Event']['banner']=$this->Api->fetchEventImage($this->data['Event']['upload_id']);
			$this->set('eventdata',$event_data);
			
    	}          
    }
	
	public function admin_view_event($id=NULL) {
	    $this->layout = 'Admin/default';
		
        Controller::loadModel('Event');		
		if (!empty($id)) {
			
			$conditions['recursive'] = 1;
			$this->Event->bindModel(array('hasOne' => array(
					 'Upload' => array(
            		 'className' => 'Upload',
            		 'conditions' => array('Upload.upload_for' => 'banner','Upload.event_id' => $id)
       				 )
				)
	 	    )); 
		    $conditions['conditions'] = array( "Event.id" => $id);
			$eventDetails = $this->Event->find( "first", $conditions );
			
			//pr($eventDetails);die;
			$this->set(compact('eventDetails'));
    	}          
    }
    
    public function admin_abuseevent_list() {
		$this->layout = 'Admin/default';
		 $this->loadModel('Event');
		  $this->loadModel('Abuse');
		 $conditions = array();
		
		if (!empty($this->data['Event']['event_title'])) {
		   $conditions['Event.event_title LIKE'] = '%'.trim($this->data['Event']['event_title']).'%';
		}
		 if (!empty($user_id)) {
		   $conditions['Event.user_id'] = $user_id;
		}
		$abuse_conditions['Abuse.event_id !=']=0;
			$data = $this->Abuse->find('all',array('conditions'=>$abuse_conditions));
			$i=0;
			$event_ids=array();
			foreach($data as $d) {
				array_push($event_ids,$d['Abuse']['event_id']);
		}
		
		$conditions['Event.id']=array_unique($event_ids);
		$this->Event->recursive = 1;
		$data = $this->Event->find('all',array('conditions'=>$conditions, 'fields'=> array('Event.id', 'Event.event_title')));
		$this->Event->bindMOdel(array('belongsTo' => array(
					'User' => array(
						'className' => 'User',
						'foreignKey' => 'user_id',
						'fields'=> array('User.username')
					)
				)
		));
		$total_event = count($data);
		$this->paginate = array('order' => 'Event.id DESC', 'limit' => '20');
		//pr($this->paginate('Event', $conditions));die;
		$this->set('event_list', $this->paginate('Event', $conditions));
		$this->set(compact('total_event'));
	}
    
    public function admin_abuse_eventdetail($id=NULL) {
	    $this->layout = 'Admin/default';
		Controller::loadModel('Event');	
		Controller::loadModel('Abuse');		
		Controller::loadModel('User');			
		if (!empty($id)) {
			
			$conditions['recursive'] = 1;
			$this->Event->bindModel(array('hasOne' => array(
					 'Upload' => array(
            		 'className' => 'Upload',
            		 'conditions' => array('Upload.upload_for' => 'banner','Upload.event_id' => $id)
       				 )
				)
	 	    )); 
	 	    
	 	     
	 	    $user_list=$this->Abuse->find('all',array('conditions'=>array('Abuse.event_id'=>$id)));
	 	   	$i=0;
	 	    $user_array=array();
	 	    foreach($user_list as $user) {
	 	    	$user_array[$i]=$user['Abuse']['user_id'];
	 	    	$i++;
	 	    }
	 	    $user_array=array_unique($user_array);
	 	    
	 	    if($user_array) {
	 	    	$user_conditions['User.id']=$user_array;
	 	    	
	 	    	$data = $this->User->find('all',array('conditions'=>$user_conditions)); 
	 	    	$total_user = count($data);
				$this->paginate = array('order' => 'User.id DESC', 'limit' => '20');
				$this->set('user_list', $this->paginate('User', $user_conditions));
				$this->set(compact('total_user'));
	 	    } 
	 	    
	 	    
		    $conditions['conditions'] = array( "Event.id" => $id);
			$eventDetails = $this->Event->find( "first", $conditions );
			$this->set(compact('eventDetails'));
    	}          
    }
	/* FUNCTION FOR EDIT Club START
	 CREATED ON - 17 June 2016 */
	 
	public function admin_appointment_list(){
	 $this->layout = 'Admin/default';
     $this->loadModel('Appointment');
	 $conditions = array();
	 
    if (!empty($this->data['User']['user_name'])) {
       $conditions['User.user_name LIKE'] = '%'.trim($this->data['User']['user_name']).'%';
    }
	 $totCont = $this->Appointment->find('count',array('conditions'=> $conditions)); 
     $this->paginate = array('order' => 'Appointment.id DESC', 'limit' => '20');
	 //pr($this->paginate('Appointment', $conditions));die;
     $this->set('appointment_list', $this->paginate('Appointment', $conditions));
	 $this->set(compact('totCont'));
	}
	
	
	/* FUNCTION FOR EDIT Club START
	 CREATED ON - 14 June 2016 */
    public function admin_photovideo_list(){
	 $this->layout = 'Admin/default';
     $this->loadModel('PhotoVideo');
	 $conditions = array();
	
	 $totCont = $this->PhotoVideo->find('count',array('conditions'=>$conditions)); 
	 $this->PhotoVideo->bindMOdel(array('belongsTo' => array(
                'User' => array(
                    'className' => 'User',
                    'foreignKey' => 'user_id',
					'fields'=> array('User.user_name')
                )
            )
		) );
    $this->paginate = array('order' => 'PhotoVideo.id DESC', 'limit' => '20');
    $this->set('phVideo_list', $this->paginate('PhotoVideo', $conditions));
	
	//pr($this->paginate('PhotoVideo', $conditions));die;
	$this->set(compact('totCont'));
	}


   	
}
?>