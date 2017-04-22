<?php

App::uses('AppController', 'Controller');

class CmsController extends AppController 
{
	public $name = 'Cms';
	public $helpers = array('Fck');
	public $components = array( 'My', 'Resize');
	public $uses = array('Contact', 'Mail', 'CmsPage');
	
	function beforeFilter(){
			parent::beforeFilter();			
			
			if (!empty($this->Auth)){
				$this->Auth->allowedActions = array();
			}
	}
	
	/* Functionality : Listing of contact on site
	Created on : 30 sep 2015
	File : 'view/cms/admin_contact_us.ctp' */
	public function admin_contact_us() {
	
	   $this->layout = 'Admin/default';
		$conditions = array();
		if(!empty($this->request->data))
		{
			$data = $this->request->data;
			
			if (!empty($data['Contact']['name'])) 
			{
				$conditions['Contact.name LIKE'] = '%'.trim($data['Contact']['name']).'%';
			}	
			if (!empty($data['Contact']['email'])) 
			{
				$conditions['Contact.email LIKE'] = '%'.trim($data['Contact']['email']).'%';
			} 
		}		
		$data = $this->Contact->find('all'); 
	
		$this->paginate = array('order' => 'Contact.id DESC', 'limit' => '20');
		$this->set('viewListing', $this->paginate('Contact', $conditions));	 
	}
	
	/* Functionality : View Message of Contact Person
	Created on : 30 sep 2015
	File : 'view/cms/admin_view_message.ctp' */
	public function admin_view_message($id = null) {	
	   $this->layout = 'Admin/default';	
		$result = $this->Contact->findById($id); 
		$this->set(compact('result'));
	}

	/* FUNCTION FOR LISTING OF EMAIL TEMPLATES
     CREATED ON -  1st OCT 2015 */ 
    public function admin_email_templates(){
        $this->layout = 'Admin/default';
		
        $conditions = array();
        if (!empty($this->request->data['Mail']['email_title'])) 
        {
            $conditions['Mail.mail_name LIKE'] = '%'.trim($this->request->data['EmailTemplate']['email_title']);
        }
        $data = $this->Mail->find('all'); 
        $this->paginate = array('order' => 'Mail.id ASC', 'limit' => '20');
        $this->set('template_list', $this->paginate('Mail', $conditions));
    
    }
	
	/* FUNCTION FOR EDIT USER START
	 CREATED ON - 25 SEP 2015 
	 File : "view/cms/admin_edit_profile" */
    public function admin_editTemplate($id=NULL){
	    $this->layout = 'Admin/default';		
		if (!empty($this->request->data)){ 			
			if ($this->Mail->save($this->request->data,false)) {
				$this->Session->setFlash(__('Data Updated Successfully.', true), 'message', array('class' => 'message-green'));
				$this->redirect('/admin/cms/email_templates');
			}else {
				$this->Session->setFlash(__('Please Correct Following Errors.', true), 'message', array('class' => 'message-red'));
			}
        }	
		if (!empty($id)) {
			$this->data = $this->Mail->findById($id);
    	}          
    }

    /* FUNCTION FOR LISTING OF EMAIL TEMPLATES
     CREATED ON -  5th OCT 2015 */ 
    public function admin_pages(){
        
        $conditions = array();
   
        if (!empty($this->request->data['CmsPage']['title'])) {
            $conditions['CmsPage.title LIKE'] = '%'.trim($this->request->data['CmsPage']['title']).'%';
        }
        $data = $this->CmsPage->find('all'); 
        $this->paginate = array('order' => 'CmsPage.id DESC', 'limit' => '20');
        $this->set('pages_list', $this->paginate('CmsPage', $conditions));
    }

    /* FUNCTION FOR EDIT CMS PAGES
	 CREATED ON - 5th Oct 2015 
	 File : "view/cms/admin_edit_page" */
    public function admin_editPage($id=NULL){ 
		if (!empty($this->request->data)){ 						
			$data = $this->request->data;
			$result = $this->CmsPage->findById($id);

			if ($this->CmsPage->save($data,false)) {
				$this->Session->setFlash(__('Data Updated Successfully.', true), 'message', array('class' => 'message-green'));
				$this->redirect('/admin/cms/pages');
			}else {
				$this->Session->setFlash(__('Please Correct Following Errors.', true), 'message', array('class' => 'message-red'));
			}
        }	
		if (!empty($id)) {
			$this->request->data = $this->CmsPage->findById($id);
			$this->set('pagedata',$this->request->data);
    	}          
    }

    /* Functionality : Listing of Social Links
	Created on : 29 sep 2015
	File : 'view/cms/admin_social_link.ctp' */
	public function admin_socialLink() {	
	   $this->layout = 'Admin/default';
		$data = $this->SocialLink->find('all'); 
	
		$this->paginate = array('order' => 'SocialLink.id DESC', 'limit' => '20');
		$this->set('links', $this->paginate('SocialLink'));	 
	}

	/* FUNCTION FOR EDIT SOCIAL LINK
	 CREATED ON - 29th Oct 2015 
	 File : "view/cms/admin_edit_link" */
    public function admin_editLink($id=NULL){
	    $this->layout = 'Admin/default';		
		if (!empty($this->request->data)){ 			
			if ($this->SocialLink->save($this->request->data)) {
				$this->Session->setFlash(__('Data Updated Successfully.', true), 'message', array('class' => 'message-green'));
				$this->redirect('/admin/cms/socialLink');
			}else {
				$this->Session->setFlash(__('Please Correct Following Errors.', true), 'message', array('class' => 'message-red'));
			}
        }	
		if (!empty($id)) {
			$this->data = $this->SocialLink->findById($id);
    	}          
    }

    /* Functionality : Listing of Profile Links
	Created on : 17th Nov 2015
	File : 'view/cms/admin_profile_link.ctp' */
	public function admin_profileLink() {	
	   $this->layout = 'Admin/default';
		$data = $this->ProfileLink->find('all'); 
		$this->paginate = array( 'limit' => '20');
		$this->set('links', $this->paginate('ProfileLink'));	 
	}

	/* FUNCTION FOR EDIT SOCIAL LINK
	 CREATED ON - 29th Oct 2015 
	 File : "view/cms/admin_edit_link" */
    public function admin_editProfileLink($id=NULL){
	    $this->layout = 'Admin/default';		
		if (!empty($this->request->data)){ 			
			if ($this->ProfileLink->save($this->request->data)) {
				$this->Session->setFlash(__('Data Updated Successfully.', true), 'message', array('class' => 'message-green'));
				$this->redirect('/admin/cms/profileLink');
			}else {
				$this->Session->setFlash(__('Please Correct Following Errors.', true), 'message', array('class' => 'message-red'));
			}
        }	
		if (!empty($id)) {
			$this->data = $this->ProfileLink->findById($id);
    	}          
    }

    /* Functionality : Listing of Google Adsense
	Created on : 11th Jan 2015
	File : 'view/cms/admin_adsense.ctp' */
	public function admin_adsense() {	
	   $this->layout = 'Admin/default';
	   $this->loadModel('Adsense');
		$data = $this->Adsense->find('all'); 
		$this->paginate = array( 'limit' => '20');
		$this->set('links', $this->paginate('Adsense'));	 
	} 

	/* FUNCTION FOR EDIT ADSENSE
	 CREATED ON - 11th Jan 2015 
	 File : "view/cms/admin_edit_adsense" */
    public function admin_edit_adsense($id=NULL){
	    $this->layout = 'Admin/default';	
	    $this->loadModel('Adsense');	
		if (!empty($this->request->data)){ 			
			if ($this->Adsense->save($this->request->data)) {
				$this->Session->setFlash(__('Data Updated Successfully.', true), 'message', array('class' => 'message-green'));
				$this->redirect('/admin/cms/adsense');
			}else {
				$this->Session->setFlash(__('Please Correct Following Errors.', true), 'message', array('class' => 'message-red'));
			}
        }	
		if (!empty($id)) {
			$this->data = $this->Adsense->findById($id);
    	}          
    }

} ?>
