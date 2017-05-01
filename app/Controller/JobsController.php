<?php
class JobsController extends AppController {

	public $name = 'Jobs';
	public $helpers = array('Html', 'Form', 'Session', 'Text','My','Image');
	public $components = array( 'Session', 'Email', 'Auth','Cookie','My','Api');

	function beforeFilter() {
	 	parent::beforeFilter();
	 	
		$this->Auth->userModel = 'User';
		$this->Auth->userModel = 'Job';
		$this->Auth->fields = array('username' => 'username','password'=>'password');
		if (!empty($this->Auth)) {		
			$this->Auth->allowedActions = array('');
		}	
	}
    
	
	/* FUNCTION FOR VIEW USER PROFILE START
	 CREATED ON - 25 SEP 2015 */

    public function admin_view_job($id=NULL) {
	    $this->layout = 'Admin/default';			
		if (!empty($id)) {
			$conditions['conditions'] = array( "Job.id" => $id);
			$JobDetails = $this->Job->find( "first", $conditions );
			$this->set(compact('JobDetails'));
    	}          
    }
    
  /* FUNCTION FOR LISTING OF USER'S START
	 CREATED ON -  24th SEP 2015 */	

	public function admin_job_list(){
		 $this->layout = 'Admin/default';
		 $this->loadModel('Job');
		 $this->loadModel('Proposal');
		 $conditions = array();
		
		 if(isset($this->request->named['page'])){
		$page=$this->request->named['page'];
		} else {
		$page=1;
		}
		$pagesize=10;
		 
		if (!empty($this->data['Job']['cat_id'])) {
			
		   $conditions['Job.category'] = trim($this->data['Job']['cat_id']);
		}
		if (!empty($this->data['Job']['job_title'])) {
		   $conditions['Job.job_title LIKE'] = '%'.trim($this->data['Job']['job_title']).'%';
		}
		$this->Job->bindModel(array('hasMany' => array(
					 'Proposal' => array(
            		 'className' => 'Proposal',
            		 'conditions' => array('id' => 'Proposal.job_id')
       				 )
				)
	 	    ));
		$data = $this->Job->find('all',array('conditions'=>$conditions)); 
		$total_job = count($data);
		$this->paginate = array('order' => 'Job.id DESC', 'limit' => $pagesize);
		$this->set('job_list', $this->paginate('Job', $conditions));
		$this->set(compact('total_job'));
		$this->set('page',$page);
		$this->set('pagesize',$pagesize);
	}
	public function admin_praposal_list($id=null){
		 $this->layout = 'Admin/default';
		 $this->loadModel('Job');
		 $this->loadModel('Proposal');
		 $conditions = array();
		
		if (!empty($id)) {
		
				 if(isset($this->request->named['page'])){
				$page=$this->request->named['page'];
				} else {
				$page=1;
				}
				$pagesize=10;
				
				$conditions['Proposal.job_id'] = trim($id);
				$data = $this->Proposal->find('all',array('conditions'=>$conditions)); 
				
				$total_proposal = count($data);
				$this->paginate = array('order' => 'Proposal.id DESC', 'limit' => $pagesize);
				$this->set('praposal_list', $this->paginate('Proposal', $conditions));
				$this->set(compact('total_proposal'));
				$this->set('page',$page);
				$this->set('pagesize',$pagesize);
				
	 } else {
		 echo "No praposal found";
	 }
	}
	/* FUNCTION FOR VIEW USER PROFILE START
	 CREATED ON - 25 SEP 2015 */

    public function admin_view_proposal($id=NULL) {
	    $this->layout = 'Admin/default';
		$this->loadModel('Proposal');		
		if (!empty($id)) {
			$conditions['conditions'] = array( "Proposal.id" => $id);
			$ProposalDetails = $this->Proposal->find( "first", $conditions );
			$this->set(compact('ProposalDetails'));
    	}          
    }
	public function admin_email_list(){
		 $this->layout = 'Admin/default';
		 $this->loadModel('User');
		 $this->loadModel('Upload');
		 $conditions = array();
		if(isset($this->request->named['page'])){
		$page=$this->request->named['page'];
		} else {
		$page=1;
		}
		$pagesize=10;
		/*if (!empty($this->data['User']['state'])) {
		   $conditions['State.state_name LIKE'] = '%'.trim($this->data['User']['state']).'%';
		}
		if (!empty($this->data['User']['zip_code'])) {
		   $conditions['User.zip_code'] = $this->data['User']['zip_code'];
		} */
		$data = $this->User->find('all',array('conditions'=>$conditions)); 
		$total_user = count($data);
		$this->paginate = array('order' => 'User.id DESC', 'limit' => $pagesize);
		$this->set('user_list', $this->paginate('User', $conditions));
		$this->set(compact('total_user'));
		$this->set('page',$page);
		$this->set('pagesize',$pagesize);
	}
	
	/* FUNCTION FOR LISTING OF GIRL'S START
	 CREATED ON -  08 June 2016 */	

	public function admin_girls_list(){
	 $this->layout = 'Admin/default';
     $this->loadModel('User');
	$conditions = array('User.user_type'=> 2);
	
    if (!empty($this->data['User']['user_name'])) {
       $conditions['User.user_name LIKE'] = '%'.trim($this->data['User']['user_name']).'%';
    }
	if (!empty($this->data['User']['city'])) {
       $conditions['City.city_name LIKE'] = '%'.trim($this->data['User']['city']).'%';
    }
	if (!empty($this->data['User']['state'])) {
       $conditions['State.state_name LIKE'] = '%'.trim($this->data['User']['state']).'%';
    }
	if (!empty($this->data['User']['zip_code'])) {
       $conditions['User.zip_code'] = $this->data['User']['zip_code'];
    }
    $data = $this->User->find('all',array('conditions'=>$conditions)); 
    $total_user = count($data);
    $this->paginate = array('order' => 'User.id DESC', 'limit' => '20');
    $this->set('user_list', $this->paginate('User', $conditions));
	$this->set(compact('total_user'));
	}
	
	 /* FUNCTION FOR ADD USER BY ADMIN START
	 CREATED ON - 24 SEP 2015 */

    public function admin_add_user($id=NULL) {
	    $this->layout = 'Admin/default';
		$this->loadModel('User');
		$this->loadModel('Upload');
		$this->User->bindModel(array('hasOne' => array(
					 'Upload' => array(
            		 'className' => 'Upload',
            		 'conditions' => array('Upload.upload_for' => 'userprofile')
       				 )
				)
	 	    ));
	 	 $upl_arr=array();
		 if (!empty($this->request->data)) { 
		  // pr($this->request->data);  die;
		   //echo $this->request->data['User']['username'];
		    $chk_user = $this->Api->checkExitsUser($this->request->data['User']['username']);
		    $chk_email = $this->Api->checkExitsEmail($this->request->data['User']['email']);
		    	if($chk_user > 0) {
		    		$this->Session->setFlash(__('Username already exist ! ', true), 'message', array('class' => 'message-red'));
		    		return false;
		    	}
		    	if($chk_email > 0) {
		    		$this->Session->setFlash(__('Email already exist ! ', true), 'message', array('class' => 'message-red'));
		    		return false;
		    	}
		    if($chk_user == 0 && $chk_email == 0) {
			
				if($this->request->data['User']['password'] == $this->request->data['User']['confirm_password']){
				    
					$password = $this->request->data['User']['password'];
					$encryptPassword = $this->Auth->password($this->request->data['User']['password']);			
				    $this->request->data['User']['password'] = $encryptPassword;
                    
                    //UPLOAD IMAGE
				$allowed_types = unserialize(ALLOWED_IMAGE_TYPES);
			    $continue = 'true';
			    $logoName = '';
			    if ($this->request->data['Upload']['url']['name'] != '') {
				if (in_array($this->request->data['Upload']['url']['type'], $allowed_types)) {
					
					$fileName = $this->My->uploadFile('../webroot/img/userImg/', $this->request->data['Upload']['url']);
					$imgpath = "../webroot/img/userImg/".$fileName;
					$this->Resize->resize($imgpath, 100, 100);
					if ($fileName != '')
						$upl_arr['Upload']['url'] = $fileName;
				}else {
					$this->Session->setFlash(__('Please Upload only *.gif, *.jpg, *.png image only!', true), 'message', array('class' => 'message-red'));
					$continue = 'false';
				}
			   }	
			   
			  if(isset($this->request->data['User']['iso'])) {
			   $country = explode('_',$this->request->data['User']['iso']);
		    	$ioscode=$country['0'];
		    	$phonecode=$country['1'];
		    	$this->request->data['User']['iso']=$ioscode;
			   $this->request->data['User']['countrycode']=$phonecode;
		    }
			   $this->request->data['User']['status']=1;
			   
				//END OF CODE
				//$this->request->data['User']['iso']=$this->request->data['User']['countrycode'];
				
			  if ($continue == 'true') {
			  		if($this->User->save($this->request->data))
					{		
						//$this->User->save($this->request->data)
						$id = $this->User->id;
						$upl_arr['Upload']['user_id']=$id;
						$upl_arr['Upload']['upload_for']='userprofile';
						$upl_arr['Upload']['status']=1;	
						$upl_arr['Upload']['media_type']='image';
					//	pr($upl_arr); die;
						if(!$this->Upload->save($upl_arr)) {
						 	$this->Session->setFlash(__('User not saved ', true), 'message', array('class' => 'message-red'));
						}
						else {
						$upload_id=$this->Upload->getLastInsertId();
						$usr_arr['User']['id']=$id;
						$usr_arr['User']['upload_id']=$upload_id;
						$this->User->save($usr_arr);
						
						}
						$email_var = ['fullname'=> $this->request->data['User']['fullname'],'email'=> $this->request->data['User']['email'], 'password'=> $password];
						$email = $this->request->data['User']['email'];
						$this->send_mail($mail_slug ='register_new',$email_var, $from =EMAIL_ADMIN_FROM, $to = $email);
						$this->request->data = "";
						$this->Session->setFlash(__('User Added successfully ! ', true), 'message', array('class' => 'message-green'));
						$this->redirect('/admin/users/user_list');
					}
			  }else{
				$this->Session->setFlash(__('Please correct the errors', true), 'message', array('class'=>'message-red'));
			}		
			}else{
		  $this->Session->setFlash(__('Password and confirm Password should be same ! ', true), 'message', array('class' => 'message-red'));
		 }
		}else{
		  $this->Session->setFlash(__('Username and Email Address already exist ! ', true), 'message', array('class' => 'message-red'));
		 }
		}
	}
	
     /* FUNCTION FOR EDIT USER START
	 CREATED ON - 25 SEP 2015 */
    public function admin_edit_user($id=NULL) {
	    $this->loadModel('User');	
	    $this->loadModel('Upload');	
	    $this->User->bindModel(array('hasOne' => array(
					 'Upload' => array(
            		 'className' => 'Upload',
            		 'conditions' => array('Upload.upload_for' => 'userprofile')
       				 )
				)
	 	    ));
		if (!empty($this->request->data)) { 
			$data=$this->request->data;
			$upl_arr=array();
			//UPLOAD IMAGE
				$allowed_types = unserialize(ALLOWED_IMAGE_TYPES);
			    $continue = 'true';
			    $logoName = '';
			    if ($this->request->data['Upload']['url']['name'] != '') { 
				if (in_array($this->request->data['Upload']['url']['type'], $allowed_types)) {
					$fileName = $this->My->uploadFile('../webroot/img/userImg/', $this->request->data['Upload']['url']);
					$imgpath = "../webroot/img/userImg/".$fileName;
					$this->Resize->resize($imgpath, 100, 100);
					if ($fileName != ''){
					   //UNLINK IMAGE FROM FOLDER
			          //  $this->My->unlinkImg($id, 'User', 'userImg');
					    //END OF CODE
						$upl_arr['Upload']['url'] = $fileName;
						}
				}else {
					$this->Session->setFlash(__('Please Upload only *.gif, *.jpg, *.png image only!', true), 'message', array('class' => 'message-red'));
					$continue = 'false';
				}
			   }else{ 
                 unset($this->request->data['Upload']['url']);
                 $upl_arr['Upload']['url']=$this->request->data['User']['url'];
                 
                }			   
				//END OF CODE
			  if ($continue == 'true') {	
			//  pr($data); die;
			$upl_arr['Upload']['user_id']=$this->request->data['User']['id'];
			$upl_arr['Upload']['id']=$this->request->data['Upload']['id'];
			if(isset($this->request->data['User']['iso'])) {
			   $country = explode('_',$this->request->data['User']['iso']);
		    	$ioscode=$country['0'];
		    	$phonecode=$country['1'];
		    	$data['User']['iso']=$ioscode;
			   $data['User']['countrycode']=$phonecode;
		    }
		    
		  
		    
			if($this->User->saveAll($data)) {
				$this->Upload->save($upl_arr);
			 	$this->Session->setFlash(__('User Information Updated Successfully.', true), 'message', array('class' => 'message-green'));
			 	$this->redirect('/admin/users/user_list');
			}else {
				$this->Session->setFlash(__('Please Correct Following Errors.', true), 'message', array('class' => 'message-red'));
		    }
			}
	    }	
		if (!empty($id)) {
			$this->User->bindModel(array('hasOne' => array(
					 'Upload' => array(
            		 'className' => 'Upload',
            		 'conditions' => array('Upload.upload_for' => 'userprofile')
       				 )
				)
	 	    ));
	 	   
			$this->data = $this->User->findById($id);
			$this->set('code',$this->data['User']['iso'].'_'.$this->data['User']['countrycode']);
			$country_name=$this->Api->fetchCountryName($this->data['User']['iso']);
			$this->set('cvalue',$country_name);
			$this->set('userdata',$this->data);
			//pr($this->data); die;
    	}          
    }
	
	
	 /* FUNCTION FOR ADD USER BY ADMIN START
	 CREATED ON - 24 SEP 2015 */

    public function admin_add_girl($id=NULL) {
	    $this->layout = 'Admin/default';
		$this->loadModel('User');		
		 if (!empty($this->request->data)) { 
		    $chk_user = $this->My->checkExitsUser($this->request->data['User']['email']);		//pr($this->request->data);die;
		    if($chk_user == 0) {
				if($this->request->data['User']['password'] == $this->request->data['User']['confirm_password']){
				    $mailPass = $this->request->data['User']['password'];
					$password = $this->request->data['User']['password'];
					$encryptPassword = $this->Auth->password($this->request->data['User']['password']);			
				    $this->request->data['User']['password'] = $encryptPassword;
                    $this->request->data['User']['user_type'] = 2;					
					$this->request->data['User']['dob'] = date($this->request->data['User']['year']['year'].'-'.$this->request->data['User']['month']['month'].'-'.$this->request->data['User']['day']['day']);
					$allowed_types = unserialize(ALLOWED_IMAGE_TYPES);
			    $continue = 'true';
			    $logoName = '';
			    if ($this->request->data['User']['image']['name'] != '') {
				if (in_array($this->request->data['User']['image']['type'], $allowed_types)) {
					
					$fileName = $this->My->uploadFile('../webroot/img/userImg/', $this->request->data['User']['image']);
					$imgpath = "../webroot/img/userImg/".$fileName;
					$this->Resize->resize($imgpath, 225, 225);
					if ($fileName != '')
						$this->request->data['User']['user_image'] = $fileName;
				}else {
					$this->Session->setFlash(__('Please Upload only *.gif, *.jpg, *.png image only!', true), 'message', array('class' => 'message-red'));
					$continue = 'false';
				}
			   }	
				//END OF CODE
			  if ($continue == 'true') {
			  
					if($this->User->saveAll($this->request->data))
					{		
						$id = $this->User->id;	
						
						$email_var = ['firstName'=> $this->request->data['User']['first_name'], 'lastName'=> $this->request->data['User']['last_name'],'email'=> $this->request->data['User']['email'], 'password'=> $mailPass];
						$email = $this->request->data['User']['email'];
						$this->send_mail($mail_slug ='register_new',$email_var,$from =EMAIL_ADMIN_FROM, $to = $email);
						
						$this->request->data = "";
						$this->Session->setFlash(__('Girl Added successfully ! ', true), 'message', array('class' => 'message-green'));
						$this->redirect('/admin/users/girls_list');
					}
			  }else{
				$this->Session->setFlash(__('Please correct the errors', true), 'message', array('class'=>'message-red'));
			   }		
			}else{
		  $this->Session->setFlash(__('Password and confirm Password should be same ! ', true), 'message', array('class' => 'message-red'));
		 }
		}else{
		  $this->Session->setFlash(__('Email id already exist ! ', true), 'message', array('class' => 'message-red'));
		 }
		}
	}
	
     /* FUNCTION FOR EDIT USER START
	 CREATED ON - 25 SEP 2015 */
    public function admin_edit_girl($id=NULL) {
	    $this->loadModel('UserDetail');	
		if (!empty($this->request->data)) { 
			$data=$this->request->data;
			//pr($data);die;
			$data['User']['birth_date'] = date($data['User']['year']['year'].'-'.$data['User']['month']['month'].'-'.$data['User']['day']['day']);
			
			//UPLOAD IMAGE
				$allowed_types = unserialize(ALLOWED_IMAGE_TYPES);
			    $continue = 'true';
			    $logoName = '';
			    if ($this->request->data['User']['image']['name'] != '') {
				if (in_array($this->request->data['User']['image']['type'], $allowed_types)) {
					
					$fileName = $this->My->uploadFile('../webroot/img/userImg/', $this->request->data['User']['image']);
					$imgpath = "../webroot/img/userImg/".$fileName;
					$this->Resize->resize($imgpath, 250, 250);
					if ($fileName != ''){
					   //UNLINK IMAGE FROM FOLDER
			            //$this->My->unlinkImg($id, 'User', 'userImg');
					    //END OF CODE
						$data['User']['user_image'] = $fileName;
						}
				}else {
					$this->Session->setFlash(__('Please Upload only *.gif, *.jpg, *.png image only!', true), 'message', array('class' => 'message-red'));
					$continue = 'false';
				}
			   }else{
                 unset($this->request->data['User']['image']);
                }			   
				//END OF CODE
			  if ($continue == 'true') {
			  
			if ($this->User->saveAll($data)) {
			$this->Session->setFlash(__('User Information Updated Successfully.', true), 'message', array('class' => 'message-green'));
			
			$this->redirect('/admin/users/girls_list');
			}else {
			$this->Session->setFlash(__('Please Correct Following Errors.', true), 'message', array('class' => 'message-red'));
		    }
		  }	
        }	
		if (!empty($id)) {
			$this->data = $this->User->findById($id);
    	}          
    }
	
    /* FUNCTION FOR RESET THE PASSWORD FOR THE USER
	 CREATED ON - 1st OCT 2015 */	
	public function admin_password_reset( $user_id = NULL)
	{
		$this->layout = 'Admin/default';
		if($this->request->is( "post" ))
		{
			$data = $this->request->data; 			
			if($data['User']['new_password'] === $data['User']['confirm_password']) 
			{
				$new_password = $data['User']['new_password']; 
				$data['User']['password'] = $this->Auth->password($data['User']['new_password']);
				$this->User->id = $user_id;
				//pr($data);die;
				if($this->User->save( $data, false ))
				{
					$user_info = $this->My->findUserByID($user_id);
					
					$email_var = ['firstName'=> $user_info['User']['first_name'], 'lastName'=> $user_info['User']['last_name'], 'email'=> $user_info['User']['email'], 'password'=> $new_password]; 
					//pr($email_var);die;
					$this->send_mail($mail_slug ='reset_password', $email_var, $from =EMAIL_ADMIN_FROM, $to = $user_info['User']['email']);
					
					$this->Session->setFlash(__('Password has been changed successfully! ', true), 'message', array('class' => 'message-green'));
					$this->redirect( array( "action" => 'user_list', "admin" => true ));
				}
			}
			else 
			{
				$this->Session->SetFlash( __( "Password Mismatch." ), "default", array( "class" => "error" ));
				
			}
		}
		$options['conditions'] = array( "id" => $user_id );
		$options['recursive'] = -1;
		if( $this->User->find( "first", $options ) ) {
			$this->set( 'id', $user_id );
		}else{
			 $this->Session->setFlash(__('Invalid access ! ', true), 'message', array('class' => 'message-red'));
			$this->redirect(array("action"=>"dashboard","admin"=>true));
		}
	}
	
	
	/* FUNCTION FOR UPDATE STATUS FOR THE USER
	 CREATED ON - 1st OCT 2015 */

    public function admin_updateStatus($id=NULL , $status = null, $model= NULL)
    {
	    $this->layout = 'Admin/default';			
		Controller::loadModel($model);
		if (isset($id) && isset($status))
		{	
			$data[$model]['id'] = $id;
			$data[$model]['status'] = $status;
			$this->$model->save($data, false);
			$this->Session->setFlash(__('Status updated successfully ! ', true), 'message', array('class' => 'message-green'));
			$this->redirect($this->referer());
     	}     
    	else
    	{
    		$this->Session->setFlash(__('Invalid access ! ', true), 'message', array('class' => 'message-red'));
			$this->redirect($this->referer());
    	}     
    }
 

	/* FUNCTION FOR LISTING OF REPORT USER'S 
		 CREATED ON -  10th DEc 2015 */	

	public function admin_report_users(){
	 $this->layout = 'Admin/default';
     $this->loadModel('ReportUser');
	$conditions = array();
	//pr($this->data);die;
    if (!empty($this->data['User']['sender'])) {
       $conditions['Sender.name LIKE'] = '%'.trim($this->data['User']['sender']).'%';
    }
	
	if (!empty($this->data['User']['receiver'])) {
       $conditions['Receiver.name LIKE'] = '%'.trim($this->data['User']['receiver']).'%';
    }
    $data = $this->ReportUser->find('all'); 
    $this->paginate = array('order' => 'ReportUser.id DESC', 'limit' => '20');
    $this->set('user_list', $this->paginate('ReportUser', $conditions));
	
	}
	
	public function admin_task_list($huntId=NULL){
	
	 $this->layout = 'Admin/default';
     $this->loadModel('HuntTask');
	 $conditions = array('HuntTask.hunt_id'=> $huntId);
	
    if (!empty($this->data['HuntTask']['hunt_title'])) {
       $conditions['HuntTask.hunt_title LIKE'] = '%'.trim($this->data['HuntTask']['hunt_title']).'%';
    }
	
	$this->HuntTask->recursive = 2;
    $data = $this->HuntTask->find('all',array('conditions'=>$conditions, 'fields'=> array('HuntTask.id', 'HuntTask.task_title'))); 
	//pr($data);die;
	$total_task = count($data);
    $this->paginate = array('order' => 'HuntTask.id DESC', 'limit' => '20');
    $this->set('task_list', $this->paginate('HuntTask', $conditions));
	$this->set(compact('total_task'));
	}
	
	public function admin_view_task($id=NULL) {
	    $this->layout = 'Admin/default';
		Controller::loadModel('TaskQuestion');
        Controller::loadModel('HuntTask');		
		if (!empty($id)) {
			//$conditions['recursive'] = -1;
			$conditions['conditions'] = array( "HuntTask.id" => $id);
			$taskDetails = $this->HuntTask->find( "first", $conditions );
			//pr($taskDetails);die;
			$this->set(compact('taskDetails'));
			$conditions['conditions'] = array( "TaskQuestion.task_id" => $id);
			$questionArr = $this->TaskQuestion->find( "all", $conditions );
			//pr($questionArr);die;
			$this->set(compact('questionArr'));
    	}          
    }	
	
	 /*CREATED ON - 25 SEP 2015 */
	 public function admin_add_task() {
	    Controller::loadModel('HuntTask');
		Controller::loadModel('User');
		Controller::loadModel('Notification');
		Controller::loadModel('TaskQuestion');
	   if (!empty($this->request->data)) { 
	        $data = $this->request->data;
			 // pr($this->request->data);die;
			 $questions = $this->request->data['question'];
			
			 //pr($answers);die;
			//UPLOAD IMAGE
				$allowed_types = unserialize(ALLOWED_IMAGE_TYPES);
			    $continue = 'true';
			    $logoName = '';
			    if ($this->request->data['HuntTask']['image']['name'] != '') { 
				if (in_array($this->request->data['HuntTask']['image']['type'], $allowed_types)) {
					
					$fileName = $this->Custom->uploadFile('../webroot/img/taskImg/', $this->request->data['HuntTask']['image']);
					$imgpath = "../webroot/img/taskImg/".$fileName;
					$this->Resize->resize($imgpath, 300, 250);
					if ($fileName != ''){
						$data['HuntTask']['image'] = $fileName;
					}
				}else {
					$this->Session->setFlash(__('Please Upload only *.gif, *.jpg, *.png image only!', true), 'message', array('class' => 'message-red'));
					$continue = 'false';
				}
			   }	
				//END OF CODE
			  if ($continue == 'true') { 
			  $data['HuntTask']['hunt_id'] = $this->request->data['HuntTask']['hunt_id'];
			 if($data['HuntTask']['image']['name']== ''){
			     unset($data['HuntTask']['image']);
			 }
			 //pr($data);die('f');
			if ($this->HuntTask->save($data, false)) {
			$taskId = $this->HuntTask->id;
			  if(!empty($questions)){
			  $i=0;
			  foreach($questions as $quest):
			    $questArr = array();
				$answers = $this->request->data['answer'][$i];
				$questArr['TaskQuestion']['task_id'] = $taskId; 
			    $questArr['TaskQuestion']['question'] = $quest;
                $questArr['TaskQuestion']['answer'] = $answers;
				$this->TaskQuestion->create();
				$this->TaskQuestion->save($questArr, false);
			  $i++;	
			 endforeach;
			 }
			
			//SEND NOTIFICATION FOR ALL USER START CODE
			 /*$usersArr = $this->User->find('all', array('conditions'=> array('User.id'=> 12), 'fields'=> array('User.id', 'User.device_id')));
			 foreach($usersArr as $userInfo):
			  $deviceId = $userInfo['User']['device_id'];
			  $userId = $userInfo['User']['id'];
			  $msg = $this->request->data['HuntTask']['task_title'];
			    $notiArr = array();
			    $notiArr['Notification']['sender_id'] = 0;
				$notiArr['Notification']['receiver_id'] = $userId;
				$notiArr['Notification']['task_id'] = $taskId;
				$notiArr['Notification']['message'] = $msg; 
				$notiArr['Notification']['type'] = 'task'; 
				if($this->Notification->save($notiArr, false)){
				if(!empty($deviceId)){
				//$this->noti_driver($deviceId, $msg);
				}
				}
			 endforeach; */
			//END OF CODE
			$this->Session->setFlash(__('Task added Successfully.', true), 'message', array('class' => 'message-green'));
			$huntId = $this->request->data['HuntTask']['hunt_id'];
			$this->redirect('/admin/users/task_list/'.$huntId);
			}else{
			 $this->Session->setFlash(__('Please Correct Following Errors.', true), 'message', array('class' => 'message-red'));
			}
			}else {
			$this->Session->setFlash(__('Please Correct Following Errors.', true), 'message', array('class' => 'message-red'));
		    }
        }	
    }
	
	 public function admin_edit_task($id=NULL) {
	     Controller::loadModel('Hunt');
		 Controller::loadModel('HuntTask');
		 Controller::loadModel('TaskQuestion');
		 
		 $taskDetails = $this->HuntTask->find("first", array( 'conditions'=> array('HuntTask.id'=> $id), 'fields'=> array('HuntTask.hunt_id')));
		 $this->set(compact('taskDetails'));
			
		 $quesAnsArr = $this->TaskQuestion->find("all", array( 'conditions'=> array('TaskQuestion.task_id'=> $id), 'fields'=> array('TaskQuestion.id', 'TaskQuestion.question', 'TaskQuestion.answer')));
		 $this->set(compact('quesAnsArr'));
		if (!empty($this->request->data)) {
			//pr($this->request->data);die;
			$saveTask = $this->request->data;
			  //UPLOAD IMAGE
				$allowed_types = unserialize(ALLOWED_IMAGE_TYPES);
			    $continue = 'true';
			    $logoName = '';
			    if ($this->request->data['HuntTask']['image']['name'] != '') {
				if (in_array($this->request->data['HuntTask']['image']['type'], $allowed_types)) {
					
					$fileName = $this->Custom->uploadFile('../webroot/img/taskImg/', $this->request->data['HuntTask']['image']);
					//echo $fileName;die;
			       $imgpath = "../webroot/img/taskImg/".$fileName;
					//echo $imgpath;die;
					$this->Resize->resize($imgpath, 300, 250);
					if ($fileName != ''){
					    //UNLINK IMAGE FROM FOLDER
						$this->My->unlinkImg($id, 'HuntTask', 'taskImg');
						//END OF CODE
						$saveTask['HuntTask']['image'] = $fileName;
						}
				}else {
					$this->Session->setFlash(__('Please Upload only *.gif, *.jpg, *.png image only!', true), 'message', array('class' => 'message-red'));
					$continue = 'false';
				}
			   }	
				//END OF CODE
			if ($continue == 'true') {
			$saveTask['HuntTask']['id'] = $id;
			//pr($saveTask);die;
			if($saveTask['HuntTask']['image']['name']== ''){
			     unset($saveTask['HuntTask']['image']);
			 }
			if ($this->HuntTask->save($saveTask, false)) {
			 $questions = $this->request->data['question'];
			 $i=0;
			  foreach($questions as $quest):
			    $quesId = $this->request->data['ques_id'][$i];
				$answers = $this->request->data['answer'][$i];
				$questArr = array();
				$questArr['TaskQuestion']['id'] = $quesId;
				$questArr['TaskQuestion']['task_id'] = $id; 
			    $questArr['TaskQuestion']['question'] = $quest;
                $questArr['TaskQuestion']['answer'] = $answers;
				$this->TaskQuestion->create();
				$this->TaskQuestion->save($questArr, false);
			  $i++;	
			 endforeach;
			 
			$this->Session->setFlash(__('Task Updated Successfully.', true), 'message', array('class' => 'message-green'));
			
			$huntId = $this->request->data['HuntTask']['hunt_id'];
			$this->redirect('/admin/users/task_list/'.$huntId);
			}else {
			$this->Session->setFlash(__('Please Correct Following Errors.', true), 'message', array('class' => 'message-red'));
		    }
        }else{
				$this->Session->setFlash(__('Please correct the errors', true), 'message', array('class'=>'message-red'));
			}
		}
		if (!empty($id)) {
			$this->data = $this->HuntTask->findById($id);
    	}          
    }
	
}
?>