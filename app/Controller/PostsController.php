<?php
class PostsController extends AppController {

	public $name = 'Posts';
	public $helpers = array('Html', 'Form','My');
	public $components = array();

	function beforeFilter() {
	 	parent::beforeFilter();
	 		
	}
	
	public function admin_abusepost_list() {
			 $this->layout = 'Admin/default';
			 $this->loadModel('Event');
			 $this->loadModel('Post');
			 $this->loadModel('User');
			 $this->loadModel('Abuse');
			 $conditions = array();
			 
			if (!empty($this->data['Post']['data'])) {
				$user = $this->User->findByUsername($this->data['Post']['data'], array('fields' => 'User.id'));
				
				if($user) {
			  		$conditions['Abuse.user_id'] = $user['User']['id'];
			  	} 
			  	else {
			  		$conditions['Abuse.user_id'] = 0;
			  	}
			}
			$conditions['Abuse.post_id !=']=0;
			$data = $this->Abuse->find('all',array('conditions'=>$conditions));
			
			$i=0;
			$post_ids=array();
			foreach($data as $d) {
				array_push($post_ids,$d['Abuse']['post_id']);
			}
			//pr($post_ids);die;
			$post_conditions['Post.id']=$post_ids;
			
			$data = $this->Post->find('all',array('conditions'=>$post_conditions));
			$total_post = count($data);
			$this->paginate = array('order' => 'Post.id DESC', 'limit' => '20');
			$this->set('post_list', $this->paginate('Post', $post_conditions));
			$this->set(compact('total_post'));
	
	}
	public function admin_post_list($event_id=null , $type=NULL){
			 $ptype='';
			 $this->layout = 'Admin/default';
			 $this->loadModel('Event');
			 $this->loadModel('Post');
			  $this->loadModel('User');
			 $conditions = array();
			 if (!empty($event_id)) {
			 	$conditions['Post.event_id'] = $event_id;
			 	if($type=='comment') {
			 		$conditions['Post.type'] = $type;
			 		
			 	} else {
			 		$conditions['Post.type !='] ='comment';
			 	}
			 	
			 	$this->set('event_id',$event_id);
			}
			if(isset($this->request->named['page'])){
				$page=$this->request->named['page'];
			} else {
			$page=1;
			}
			$pagesize=10;
			
			if (!empty($this->data['Post']['data'])) {
				$user = $this->User->findByUsername($this->data['Post']['data'], array('fields' => 'User.id'));
				if($user) {
			  		$conditions['Post.user_id'] = $user['User']['id'];
			  	} 
			  	else {
			  		$conditions['Post.user_id'] = 0;
			  	}
			}
			//pr($conditions); die;
			$this->set('ptype',$type);
			$this->Post->recursive = 1;
			$data = $this->Post->find('all',array('conditions'=>$conditions, 'fields'=> array('Post.id', 'Post.data')));
			$total_post = count($data);
			$this->paginate = array('order' => 'Post.id DESC', 'limit' => $pagesize);
			//pr($this->paginate('Event', $conditions));die;
			$this->set('post_list', $this->paginate('Post', $conditions));
			$this->set(compact('total_post'));
			$this->set('page',$page);
			$this->set('pagesize',$pagesize);
	}
	
	function admin_comment_reply_list($post_id=NULL) {
			$this->loadModel('Post');
			$this->loadModel('Comment');
			$this->loadModel('User');
			$conditions = array();
			
			if(isset($this->request->named['page'])){
				$page=$this->request->named['page'];
			} else {
			$page=1;
			}
			$pagesize=10;
			if(empty($this->request['data']['Post']['username']))  {
			 if (!empty($post_id)) {
			 	$conditions['Comment.post_id'] = $post_id;
			 	$this->set('comment_id',$post_id);
			}
			}
			if (!empty($this->request['data']['Post']['username'])) {
				
				$user = $this->User->findByUsername($this->request['data']['Post']['username'], array('fields' => 'User.id'));
				if($user) { 
			  		$conditions['Comment.user_id'] = $user['User']['id'];
			  		$this->set('comment_id',$post_id);
			  	} 
			  	else {
			  		$conditions['Comment.user_id'] = 0;
			  		$this->set('comment_id',$post_id);
			  	}
			//	pr($conditions); die;
			}
			
			$this->Comment->recursive = 1;
			$data = $this->Comment->find('all',array('conditions'=>$conditions));
			$total_reply = count($data);
			$this->paginate = array('order' => 'Comment.id DESC', 'limit' => $pagesize);
			$this->set('reply_list', $this->paginate('Comment', $conditions));
			$this->set(compact('total_reply'));
			$this->set('page',$page);
			$this->set('pagesize',$pagesize);
			
	}
	function admin_comment_list($post_id=NULL) {
			$this->loadModel('Post');
			$this->loadModel('Comment');
			$this->loadModel('User');
			$conditions = array();
			
			if(isset($this->request->named['page'])){
				$page=$this->request->named['page'];
			} else {
			$page=1;
			}
			$pagesize=10;
			if(empty($this->request['data']['Post']['username']))  {
			 if (!empty($post_id)) {
			 	$conditions['Comment.post_id'] = $post_id;
			 	$this->set('comment_id',$post_id);
			}
			}
			if (!empty($this->request['data']['Post']['username'])) {
				
				$user = $this->User->findByUsername($this->request['data']['Post']['username'], array('fields' => 'User.id'));
				if($user) { 
			  		$conditions['Comment.user_id'] = $user['User']['id'];
			  		$this->set('comment_id',$post_id);
			  	} 
			  	else {
			  		$conditions['Comment.user_id'] = 0;
			  		$this->set('comment_id',$post_id);
			  	}
			//	pr($conditions); die;
			}
			
			$this->Comment->recursive = 1;
			$data = $this->Comment->find('all',array('conditions'=>$conditions));
			$total_comment = count($data);
			$this->paginate = array('order' => 'Comment.id DESC', 'limit' => $pagesize);
			$this->set('comment_list', $this->paginate('Comment', $conditions));
			$this->set(compact('total_comment'));
			$this->set('page',$page);
			$this->set('pagesize',$pagesize);
			
	}
	
	function admin_post_comment_reply_list($comment_id=NULL) {
			$this->loadModel('Post');
			$this->loadModel('Comment');
			$this->loadModel('Reply');
			$this->loadModel('User');
			$conditions = array();
			
			if(isset($this->request->named['page'])){
				$page=$this->request->named['page'];
			} else {
			$page=1;
			}
			$pagesize=10;
			if (empty($this->request['data']['Post']['username'])) {
			 if (!empty($comment_id)) {
			 	$conditions['Reply.comment_id'] = $comment_id;
			 	$this->set('comment_id',$comment_id);
			}
			}
			
			
			if (!empty($this->request['data']['Post']['username'])) {
				
				$user = $this->User->findByUsername($this->request['data']['Post']['username'], array('fields' => 'User.id'));
				if($user) { 
			  		$conditions['Reply.user_id'] = $user['User']['id'];
			  		$this->set('comment_id',$post_id);
			  	} 
			  	else {
			  		$conditions['Reply.user_id'] = 0;
			  		$this->set('comment_id',$post_id);
			  	}
			//	pr($conditions); die;
			}
			
			
			
			$this->Reply->recursive = 1;
			$data = $this->Reply->find('all',array('conditions'=>$conditions));
			$total_reply = count($data);
			$this->paginate = array('order' => 'Reply.id DESC', 'limit' => $pagesize);
			$this->set('reply_list', $this->paginate('Reply', $conditions));
			$this->set(compact('total_reply'));
			$this->set('page',$page);
			$this->set('pagesize',$pagesize);
	
	}
	
	function admin_delete_reply($rep_id=NUll,$post_id=NULL) {
		$this->loadModel('Comment');
		$this->Comment->delete($rep_id);
		if (!empty($post_id)) {
			 $this->set('comment_id',$post_id);
		}
		$this->Session->setFlash(__('Reply deleted', true), 'message', array('class' => 'message-green'));
		$this->redirect('/admin/posts/comment_reply_list/'.$post_id);
		
		
	}
	function admin_delete_post_comment_reply($reply_id=Null , $comment_id=NULL) {
	
		$this->loadModel('Reply');
		$this->Reply->delete($reply_id);
		if (!empty($comment_id)) {
			 $this->set('comment_id',$comment_id);
		}
		$this->Session->setFlash(__('Reply deleted', true), 'message', array('class' => 'message-green'));
		$this->redirect('/admin/posts/post_comment_reply_list/'.$comment_id);
	}
	
	function admin_add_post() { //echo $this->request->params['form']['postdata']['name']; die;
		if($this->request->is('post') && $this->data){  
				$this->layout='none';
				$this->loadModel('Post');
				if(empty($this->request->data['user_id'])){
					$error='Please provide user id.';
				}  else if(empty($this->request->data['event_id'])){
					$error='Please enter event id.';  
				} else if(empty($this->request->data['type'])){
					$error='Please enter type of post.';  
				} else {
					if($this->request->data['type']=='image') {
						if(isset($this->request->params['form']['postdata']['name'])){
							$filename = $this->request->params['form']['postdata']['name'];	
							$file_ext = substr($filename, strripos($filename, '.')); 
							if($file_ext=='.jpg' || $file_ext=='.jpeg' || $file_ext=='.png' || $file_ext=='.gif' || $file_ext=='.3gp' || $file_ext=='.wmv') {
								if($this->request->params['form']['postdata']['error'] == 0 ){
									$newfilename = uniqid('post-').$file_ext;
									$data['Post']['data'] = $newfilename;
									$imgpath = WWW_ROOT.'img/postImage/'.$newfilename;
									$image_url='img/postImage/';
									move_uploaded_file($this->request->params['form']['postdata']['tmp_name'],$imgpath);
								}
							}
						} else { $error='Please enter postdata(image,video,comments';   }
					} else if($this->request->data['type']=='video') {
					if(isset($this->request->params['form']['postdata']['name'])){
							$filename = $this->request->params['form']['postdata']['name'];	
							$file_ext = substr($filename, strripos($filename, '.')); 
							if($file_ext=='.mp4' || $file_ext=='.3gp' || $file_ext=='.wmv'|| $file_ext=='.avi'|| $file_ext=='.arf'|| $file_ext=='.mkv'|| $file_ext=='.mov') {
									if($this->request->params['form']['data']['error'] == 0 ){
										$newfilename = uniqid('post-').$file_ext;
										$data['Post']['data'] = $newfilename;
										$imgpath = WWW_ROOT.'img/postVideo/'.$newfilename;
										$image_url='img/postVideo/';
										move_uploaded_file($this->request->params['form']['postdata']['tmp_name'],$imgpath);
									}	
							} else { $error='Please enter right format of video (.mp4,.3gp , .wmv , arf , .mov , .mkv)'; }
						} else { $error='Please enter postdata(image,video,comments'; }
					} else {
						if(isset($this->request->data['postdata'])){
							$data['Post']['data'] = $this->request->data['postdata'];
						} else { $error='Please enter postdata(image,video,comments'; }
					}	
					$data['Post']['event_id'] = $this->request->data['event_id'];
					$data['Post']['user_id'] = $this->request->data['user_id'];
					$data['Post']['type'] = $this->request->data['type'];
					$this->Post->save($data, false);
					$post_id=$this->Post->getLastInsertId();
					//$postdata = $this->Post->findById($post_id);
				}
				if(!empty($error)){
					echo json_encode(array('status'=> '0', 'message'=> $error)); exit;
				} else {
					//echo json_encode(array('data'=>$postdata)); die;
					echo json_encode(array('status'=> '1','data'=>"Successfully posted")); die;
				}
		} else 
		{
			echo json_encode(array('status'=> '0', 'message'=> 'Please send as post method')); exit;
		}
	}
	public function admin_view_post($id=NULL,$user_id=null,$event_id=null) {
	
	    $this->layout = 'Admin/default';
		$this->loadModel('Post');	
		$this->loadModel('Upload');
		if (!empty($id)) {
			$conditions['recursive'] = -2;
			$this->Post->bindMOdel(array('hasOne' => array(
					'Upload' => array(
						'className' => 'Upload',
						'foreignKey'  => false,
						'conditions' => array(
							'AND' => array(
								array('Upload.user_id' => $user_id),
								array('Upload.event_id' => $event_id,'Upload.upload_for' => 'post')
							)
						),
					)
				)
	 	    ));
			$conditions['conditions'] = array( "Post.id" => $id);
			$eventDetails = $this->Post->find( "first", $conditions );
			
			//pr($eventDetails);die;
			$this->set(compact('eventDetails'));
    	}          
    }
    
    public function admin_view_abusepost($id=NULL,$user_id=null,$event_id=null) {
	
	    $this->layout = 'Admin/default';
		$this->loadModel('Post');	
		$this->loadModel('Abuse');
		$this->loadModel('Upload');
		$this->loadModel('User');
		if (!empty($id)) {
			$conditions['recursive'] = -2;
			$this->Post->bindMOdel(array('hasOne' => array(
					'Upload' => array(
						'className' => 'Upload',
						'foreignKey'  => false,
						'conditions' => array(
							'AND' => array(
								array('Upload.user_id' => $user_id),
								array('Upload.event_id' => $event_id,'Upload.upload_for' => 'post')
							)
						),
					)
				)
	 	    ));
	 	    
	 	    
	 	    
	 	     $user_list=$this->Abuse->find('all',array('conditions'=>array('Abuse.post_id'=>$id)));
	 	    
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
	 	    
	 	    
	 	    
			$conditions['conditions'] = array( "Post.id" => $id);
			$eventDetails = $this->Post->find( "first", $conditions );
			
			//pr($eventDetails);die;
			$this->set(compact('eventDetails'));
    	}          
    }
   
    
    /*************EDIT Event*****************/
	 public function admin_edit_post($id=NULL) {
	     Controller::loadModel('Post');
	     Controller::loadModel('Upload');
	     Controller::loadModel('Event');
	     $upload_array=array();
		 if(!empty($this->request->data)){
	//	pr($this->request->data); die;
		     //UPLOAD IMAGE
		     	$allowed_types = unserialize(ALLOWED_IMAGE_TYPES);
			    $continue = 'true';
			    $logoName = '';
			    if($this->request->data['Post']['type']=='image') {
			    		if ($this->request->data['Post']['data']['name'] != '') {
							if (in_array($this->request->data['Post']['data']['type'], $allowed_types)) {
								$fileName = $this->My->uploadFile('../webroot/img/postImage/', $this->request->data['Post']['data']);
								$imgpath = "../webroot/img/postImage/".$fileName;
								$this->Resize->resize($imgpath, 250, 100);
								if ($fileName != ''){
									//UNLINK IMAGE FROM FOLDER
									//$this->My->unlinkImg($id, 'Event', 'eventImg');
									//END OF CODE
									$upload_array['Post']['data'] = $fileName;
									}
						} else {
								$this->Session->setFlash(__('Please Upload only *.gif, *.jpg, *.png image only!', true), 'message', array('class' => 'message-red'));
								$continue = 'false';
						}
					    } else{
						  unset($this->request->data['Post']['data']);
						  $upload_array['Post']['data']=$this->request->data['Post']['data'];
						}	
                } else if($this->request->data['Post']['type']=='video') { 
                	if ($this->request->data['Post']['data']['name'] != '') {
							if (in_array($this->request->data['Post']['data']['type'], $allowed_types)) {
								$fileName = $this->My->uploadFile('../webroot/img/postImage/', $this->request->data['Post']['data']);
								$imgpath = "../webroot/img/postImage/".$fileName;
								$this->Resize->resize($imgpath, 250, 100);
								if ($fileName != ''){
									//UNLINK IMAGE FROM FOLDER
									//$this->My->unlinkImg($id, 'Event', 'eventImg');
									//END OF CODE
									$upload_array['Upload']['url'] = $fileName;
									}
						} else {
								$this->Session->setFlash(__('Please Upload only *.gif, *.jpg, *.png image only!', true), 'message', array('class' => 'message-red'));
								$continue = 'false';
						}
					    } else{
						  unset($this->request->data['Post']['data']);
						  $upload_array['Post']['data']=$this->request->data['Post']['data'];
						}
                
                } else {
                	$upload_array['Post']['data']=$this->request->data['Post']['data'];
                
                }
                $upload_array['Post']['id']=$this->request->data['Post']['id'];
                $upload_array['Post']['type']=$this->request->data['Post']['type'];
                $upload_array['Post']['event_id']=$this->request->data['Post']['event_id'];
                $upload_array['Post']['user_id']=$this->request->data['Post']['user_id'];
                $upload_array['Post']['lat']=$this->request->data['Post']['lat'];
                $upload_array['Post']['lng']=$this->request->data['Post']['lng'];
                //END OF CODE
				//pr($upload_array);
			  if ($continue == 'true') { 
			  //	$this->request->data['Post']['id']=
			 
			  if($this->Post->save($upload_array)){
			    $this->Session->setFlash(__('Post Updated Successfully.', true), 'message', array('class'=>'message-green'));
				$this->redirect('/admin/posts/post_list/'.$this->request->data['Post']['event_id']);
			 }
			}else{
				$this->Session->setFlash(__('Please correct the errors', true), 'message', array('class'=>'message-red'));
			}
		}
		if (!empty($id)) {
			$this->data = $this->Post->findById($id);
			$this->set('eventDetails',$this->data);
    	}          
    }
    
    
    
	
}
?>