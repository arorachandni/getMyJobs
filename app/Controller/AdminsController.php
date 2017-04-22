<?php
    App::uses('AppController', 'Controller');

    class AdminsController extends AppController {

        public $name = 'Admins';
        public $components = array('My');
        public $uses = array('EmailTemplate');

        function beforeFilter()
		{ 
            parent::beforeFilter();
            $this->Auth->userModel = 'Admin';
            $this->Auth->fields = array('username' => 'username', 'password' => 'password');
            if (!empty($this->Auth))
                $this->Auth->allowedActions = array('admin_sign_in', 'admin_forgot_password','admin_sign_out');
        }

        //FUNCTION FOR ADMIN LOGIN START
        public function admin_sign_in() {
		    $this->layout = 'Admin/sign_in';	
		    if($this->Session->check('Auth.Admin')){           
                $this->redirect('/admin/admins/dashboard/');
            }
		    if (!empty($this->data)){ 
                $this->Admin->recursive = -1;
				$adminArr = $this->Admin->find('first', array('conditions' => array('username' => ($this->request->data['Admin']['username']), 'password' => $this->Auth->password($this->request->data['Admin']['password']) )));
			
				if (!empty($adminArr)) {
                        if ($this->Auth->login($adminArr)){
						   if ($this->request->data['Admin']['remember_me'] == 1) {
							$cookieTime = "365 days"; 
							$this->Cookie->write('rememberMe', $this->request->data, true, $cookieTime);							
							}else{
								$this->Cookie->delete('rememberMe');
							}
                            $this->redirect('/admin/admins/dashboard/');
							}else {
                            $this->Session->setFlash(__('Invalid Username or Password.', true), 'message', array('class' => 'red'));                 
                          }
                } else {
                    $this->Session->setFlash(__('Invalid Username or Password.', true), 'message', array('class' => 'red'));
                }
            }
			if($this->Cookie->read('rememberMe')){
				$this->request->data=$this->Cookie->read('rememberMe');
			}
    }
 

        //FUNCTION FOR ADMIN DASHBOARD START
        function admin_dashboard() { 
            $this->layout = 'Admin/default'; 
                 
	   }

        //FUNCTION FOR ADMIN SIGN OUT START		
        public function admin_sign_out() {   

		    if ($this->Session->check('Auth.Admin')==1) {
                if ($this->Session->delete('Auth.Admin')){
                    $this->redirect('/admin/admins/sign_in');
				}	
            }else{
			  $this->redirect('/admin/admins/sign_in');
			}
        }
		
		//FUNCTION FOR ADMIN SIGN OUT END

        //FUNCTION FOR CHANGING THE ADMIN PROFILE START
        public function admin_change_profile() {
            if (!empty($this->request->data)) {
				$this->request->data['Admin']['id']= convert_uudecode(base64_decode($this->request->data['Admin']['id']));
				if ($this->Admin->save($this->request->data)) {
                    $this->Session->setFlash(__('Admin Profile Updated Successfully.', true), 'message', array('class' => 'message-green'));
                    $this->redirect('/admin/admins/change_profile/');
                }else
                    $this->Session->setFlash(__('Please Correct Following Error.', true), 'message', array('class' => 'message-red'));
            }
            
            $this->request->data = $this->Admin->findById($this->Session->read('Auth.Admin.Admin.id'));
			$this->request->data['Admin']['id']=base64_encode(convert_uuencode($this->request->data['Admin']['id']));
        }

		public function admin_change_email_admin() {	        
            if (!empty($this->request->data)) { 
                if ($this->Admin->save($this->request->data,false)) {
                    $this->Session->setFlash(__('Admin Email Updated Successfully.', true), 'message', array('class' => 'message-green'));
                    $this->redirect('/admin/admins/change_email_admin/');
                }else
                    $this->Session->setFlash(__('Please Correct Following Error.', true), 'message', array('class' => 'message-red'));
            }
			else
				$this->request->data =  $this->Admin->findById($this->Session->read('Auth.Admin.Admin.id'));
        }
        //FUNCTION FOR CHANGING THE ADMIN PROFILE END

        //FUNCTION FOR CHANGING THE ADMIN PASSWORD START
        public function admin_change_password() {
            if (!empty($this->request->data)) { 
				$adminCount = $this->Admin->find('count', 
										array('conditions' => 
											array('Admin.id' => $this->request->data['Admin']['id'], 'Admin.password' => $this->Auth->password($this->request->data['Admin']['current_password'])
											)
										)
									);
                if ($adminCount > 0)
                {
					if ($this->request->data['Admin']['new_password'] == $this->request->data['Admin']['confirm_password']) 
                    {
                        $saveData['id'] = $this->request->data['Admin']['id'];
                        $password = $this->request->data['Admin']['new_password'];
                        $saveData['password'] = $this->Auth->password($password);
                        if ($this->Admin->save($saveData))
                        {
                            /*$link = SITE_PATH.'admin' ;
                            $admin =  $this->My->adminDetails();
                            $replace = array('{{AdminEmail}}', '{{UserName}}', '{{AdminPassword}}', '{{Link}}',  '{{Signature}}', '{{SitePath}}', '{{SiteName}}');
                            $with = array($admin['Admin']['email'], $admin['Admin']['username'], $password, $link, EMAIL_SIGNATURE,  SITE_PATH, SITE_NAME,);
                            $this->send_email_template($replace,$with,"AdminResetPassword",EMAIL_ADMIN_FROM,$admin['Admin']['email']); */
                            
                            $this->Session->setFlash(__('Password Updated Successfully.', true), 'message', array('class' => 'message-green'));
                            $this->redirect('/admin/admins/change_password/');
                        }else
                            $this->Session->setFlash(__('Please Try Later.', true), 'message', array('class' => 'message-red'));
                    }else
                        $this->Session->setFlash(__('Both Passwords Should be Same.', true), 'message', array('class' => 'message-red'));
                }else
                    $this->Session->setFlash(__('Invalid Current Password.', true), 'message', array('class' => 'message-red'));
            }
			else
					$this->request->data =  $this->Admin->findById($this->Session->read('Auth.Admin.Admin.id'));
        }

    /* FUNCTION FOR EDIT USER START
     CREATED ON - 25 SEP 2015 
     File : "view/admin/admin_view_profile" */
    public function admin_viewProfile()
    {
        $adminDetails = $this->My->adminDetails();
        $this->set(compact('adminDetails'));       
    }
    
        
}
?>